<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function tesadmin() {
        return view('admin.tes');
    }



    public function viewOrder() {
        $orders = Order::all();
        return view('admin.vieworder', compact('orders'));
    }

    public function changeStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
