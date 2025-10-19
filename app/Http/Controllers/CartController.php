<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    // Show cart contents (stored in session)
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // load product details
        $items = [];
        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $qty,
                    'subtotal' => $product->product_price * $qty,
                ];
            }
        }

        return view('cart', ['items' => $items]);
    }

    // Add item to cart in session
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        $cart = $request->session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Remove single item from cart
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    // Clear entire cart
    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }

    // Update quantity for an item in cart (AJAX-friendly)
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        $cart = $request->session()->get('cart', []);
        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }
        $request->session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
    }

    // Show checkout form
    public function showCheckoutForm(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }
        return view('checkout_form');
    }

    // Process checkout with uploaded proof
    public function processCheckout(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_address' => 'required|string',
            'receiver_phone' => 'required|string|max:50',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,gif,pdf|max:5120',
        ]);

        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $userId = Auth::id() ?? null;

        // store payment proof
        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        $orders = [];
        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if (! $product) continue;

            $order = new Order();
            $order->user_id = $userId;
            $order->receiver_name = $request->input('receiver_name');
            $order->receiver_address = $request->input('receiver_address');
            $order->receiver_phone = $request->input('receiver_phone');
            $order->product_id = $product->id;
            $order->quantity = $qty;
            $order->price = $product->product_price;
            $order->total = $product->product_price * $qty;
            $order->payment_proof = $proofPath;
            $order->save();

            // reduce stock if available
            if ($product->product_quantity !== null) {
                $product->product_quantity = max(0, $product->product_quantity - $qty);
                $product->save();
            }

            $orders[] = $order;
        }

        $request->session()->forget('cart');

        return view('checkout_success', ['orders' => $orders]);
    }

    // Checkout: create orders for each cart item and clear cart
    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $userId = Auth::id() ?? null; // allow guest orders if desired

        $receiverAddress = $request->input('receiver_address', '');
        $receiverPhone = $request->input('receiver_phone', '');

        $orders = [];
        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if (! $product) continue;

            $order = new Order();
            $order->user_id = $userId;
            $order->product_id = $product->id;
            // optional receiver data (blank if not provided)
            $order->receiver_address = $receiverAddress;
            $order->receiver_phone = $receiverPhone;
            $order->quantity = $qty;
            $order->price = $product->product_price;
            $order->total = $product->product_price * $qty;
            $order->save();

            // reduce stock if available
            if ($product->product_quantity !== null) {
                $product->product_quantity = max(0, $product->product_quantity - $qty);
                $product->save();
            }

            $orders[] = $order;
        }

        // clear cart
        $request->session()->forget('cart');

        return view('checkout_success', ['orders' => $orders]);
    }

    // Buy now: adds single product to cart and redirects to checkout form
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        // set cart containing only this item to ensure checkout only contains it
        $cart = [$productId => $quantity];
        $request->session()->put('cart', $cart);

        return redirect()->route('checkout.form');
    }

    // public view of payment proof (for buyers who have the link)
    public function showPaymentProofPublic($id)
    {
        $order = Order::findOrFail($id);
        if (empty($order->payment_proof)) {
            abort(404);
        }
        $path = storage_path('app/public/' . $order->payment_proof);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function orderHistory()
    {
        // Get authenticated user
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan.');
        }
        
        // Get user's orders grouped by order date
        $orders = Order::where('user_id', $user->id)
                      ->with('product') // eager load product relationship
                      ->orderBy('created_at', 'desc')
                      ->get()
                      ->groupBy(function($date) {
                          return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d'); // group by date
                      });
        
        return view('order_history', compact('orders'));
    }
}
