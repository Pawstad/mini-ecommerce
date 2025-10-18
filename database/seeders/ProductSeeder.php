<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kategori yang sudah ada
        $fiksi = Category::where('category_name', 'Fiksi')->first();
        $nonFiksi = Category::where('category_name', 'Non Fiksi')->first();
        $baru = Category::where('category_name', 'Baru')->first();
        $bekas = Category::where('category_name', 'Bekas')->first();

        // Pastikan kategori ditemukan
        if (!$fiksi || !$nonFiksi || !$baru || !$bekas) {
            $this->command->error('⚠️ Pastikan kategori Fiksi, Non Fiksi, Baru, dan Bekas sudah ada di tabel categories.');
            return;
        }

        // Daftar produk dengan 2 kategori (utama dan kondisi)
        $products = [
            [
                'product_name' => 'One Piece Vol. 1',
                'author' => 'Eiichiro Oda',
                'publisher' => 'Shueisha',
                'isbn' => '9784088725093',
                'pages' => 200,
                'product_description' => 'Petualangan Luffy untuk menjadi Raja Bajak Laut dimulai!',
                'product_quantity' => 30,
                'product_price' => 65000,
                'product_image' => 'one_piece.jpg',
                'categories' => [$fiksi->id, $baru->id],
            ],
            [
                'product_name' => 'Napoleon and the Dinosaur',
                'author' => 'George Ellis',
                'publisher' => 'Oxford',
                'isbn' => '9780199219032',
                'pages' => 180,
                'product_description' => 'Kisah imajinatif pertemuan Napoleon dengan makhluk prasejarah.',
                'product_quantity' => 10,
                'product_price' => 72000,
                'product_image' => 'napoleon_dino.jpg',
                'categories' => [$fiksi->id, $bekas->id],
            ],
            [
                'product_name' => 'Atomic Habits',
                'author' => 'James Clear',
                'publisher' => 'Penguin Random House',
                'isbn' => '9780735211292',
                'pages' => 320,
                'product_description' => 'Panduan membangun kebiasaan kecil yang membawa perubahan besar.',
                'product_quantity' => 25,
                'product_price' => 95000,
                'product_image' => 'atomic_habits.jpg',
                'categories' => [$nonFiksi->id, $baru->id],
            ],
            [
                'product_name' => 'Harry Potter and the Sorcerer\'s Stone',
                'author' => 'J.K. Rowling',
                'publisher' => 'Bloomsbury',
                'isbn' => '9780747532699',
                'pages' => 350,
                'product_description' => 'Petualangan Harry Potter di tahun pertamanya di Hogwarts.',
                'product_quantity' => 20,
                'product_price' => 85000,
                'product_image' => 'harry_potter.jpg',
                'categories' => [$fiksi->id, $baru->id],
            ],
            [
                'product_name' => 'Learning PHP, MySQL & JavaScript: With HTML5, CSS, and jQuery',
                'author' => 'Robin Nixon',
                'publisher' => 'O\'Reilly Media',
                'isbn' => '9781491978917',
                'pages' => 832,
                'product_description' => 'Comprehensive guide to building dynamic, data-driven websites using PHP, MySQL, JavaScript, and modern web technologies.',
                'product_quantity' => 20,
                'product_price' => 550000,
                'product_image' => 'learning_php.jpg',
                'categories' => [$nonFiksi->id, $baru->id],
            ],
            [
                'product_name' => 'The Art of Thinking Clearly',
                'author' => 'Rolf Dobelli',
                'publisher' => 'HarperCollins',
                'isbn' => '9780062219695',
                'pages' => 384,
                'product_description' => 'Bagaimana bias kognitif mempengaruhi pengambilan keputusan kita.',
                'product_quantity' => 18,
                'product_price' => 88000,
                'product_image' => 'the_art_of_thingking_clearly.jpg',
                'categories' => [$nonFiksi->id, $bekas->id],
            ],
            [
                'product_name' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'isbn' => '9789791227204',
                'pages' => 529,
                'product_description' => 'Novel inspiratif tentang perjuangan anak-anak Belitung.',
                'product_quantity' => 20,
                'product_price' => 85000,
                'product_image' => 'laskar_pelangi.jpg',
                'categories' => [$fiksi->id, $bekas->id],
            ],
        ];

        // Masukkan produk dan hubungkan ke 2 kategori
        foreach ($products as $data) {
            $product = Product::create([
                'product_name' => $data['product_name'],
                'author' => $data['author'],
                'publisher' => $data['publisher'],
                'isbn' => $data['isbn'],
                'pages' => $data['pages'],
                'product_description' => $data['product_description'],
                'product_quantity' => $data['product_quantity'],
                'product_price' => $data['product_price'],
                'product_image' => $data['product_image'],
            ]);

            $product->categories()->attach($data['categories']);
        }
    }
}
