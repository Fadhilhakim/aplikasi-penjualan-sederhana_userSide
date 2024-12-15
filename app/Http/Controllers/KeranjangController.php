<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\shopping_cart;
use App\Models\Product;
use App\Models\OrderRequest;

class KeranjangController extends Controller
{
    public function store($id)
    {

        // Pastikan pengguna login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan produk ke keranjang.');
        }

        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Simpan data ke tabel shopping_cart
        shopping_cart::create([
            'user_id' => $userId,
            'product_id' => $id,
            'quantity' => 1,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index() {

        $products = Product::withSum('sales', 'quantity')->get()->map(function ($product) {
            $product->discounted_price = $product->price - ($product->price * ($product->discount_value / 100));
            return $product;
        });

        $keranjang = shopping_cart::with('product') // Mengambil data produk terkait
        ->where('user_id', Auth::id()) // Ambil data berdasarkan user_id yang sedang login
        ->get()
        ->groupBy('product_id') // Kelompokkan berdasarkan product_id
        ->map(function ($group) {
            // Hitung jumlah quantity untuk setiap group produk
            $totalQuantity = $group->sum('quantity');
            $firstItem = $group->first(); // Ambil item pertama dalam grup
            $product = $firstItem->product; // Ambil produk dari item pertama

            return (object)[
                'shopping_cart_id' => $firstItem->id, // ID dari shopping_cart
                'product' => $product, // Informasi produk
                'total_quantity' => $totalQuantity // Total quantity untuk produk ini
            ];
        });


        return view('keranjang', ['products' => $products, 'keranjang' => $keranjang]);

    } 

    public function destroy($id)
    {
        $item = shopping_cart::find($id);

        if ($item) {
            $item->delete();
            return back();
        }

        return back();
    }

    public function pindahkanKeOrderRequests()
    {
        // Ambil data dari shopping_cart berdasarkan user yang login
        $shoppingCartItems = shopping_cart::where('user_id', Auth::id())->get();

        // Iterasi setiap item di shopping_cart
        foreach ($shoppingCartItems as $item) {
            // Simpan data ke tabel order_requests
            OrderRequest::create([
                'user_id' => $item->user_id, // ID user
                'product_id' => $item->product_id, // ID produk
                'quantity' => $item->quantity, // Jumlah produk
                'payment' => 'Null', 
                'address' => 'Null', 
                'status' => 'BELUM BAYAR', // Status default
            ]);
        }

        // Hapus data dari shopping_cart setelah dipindahkan
        shopping_cart::where('user_id', Auth::id())->delete();

        // Redirect atau tampilkan pesan sukses
        return redirect('/payment')->with('success', 'Silahkan Selesaikan Pembayaran');
    }


    
}
