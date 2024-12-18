<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OrderRequest;
use App\Models\OrderHistory;

class OrderRequestController extends Controller
{
    public function orderViews()
    {
        // Ambil semua data dari tabel order_requests
        $order_requests = OrderRequest::with(['user', 'product']) // Relasi dengan user dan produk
        ->where('user_id', Auth::id())
        ->get()
        ->groupBy(function ($order) {
            return $order->user_id . '-' . $order->status . '-' . $order->created_at;
        })
        ->map(function ($orders, $key) {
            [$user_id, $status] = explode('-', $key);

            // Ambil user terkait
            $user = $orders->first()->user;

            // Hitung total harga
            $totalPrice = $orders->sum(function ($order) {
                return intval($order->product->price) * $order->quantity;
            });

            // Ambil array produk dan jumlahnya
            $products_with_quantities = $orders->map(function ($order) {
                return [
                    'product_id' => $order->product->id,
                    'name' => $order->product->name,
                    'price' => intval($order->product->price),
                    'discount' => $order->product->discount,
                    'discount_value' => $order->product->discount_value,
                    'quantity' => $order->quantity,
                ];
            });

            return [
                'user' => $user->name,
                'email' => $user->email,
                'created_at' => $orders->last()->created_at,
                'total_quantity' => $orders->sum('quantity'),
                'total_price' => $totalPrice,
                'status' => $status,
                'id_pesanan' => $orders->first()->id,
                'payment' => $orders->first()->payment,
                'products_order' => $products_with_quantities,
            ];
        })
        ->sortByDesc('created_at'); // Urutkan berdasarkan created_at terbaru

        return $order_requests;
    }

    public function paymentView()
    {
        // Panggil fungsi orderViews untuk mendapatkan data
        $order_views = $this->orderViews();

        return view('payment', [
            'order_views' => $order_views, // Data pesanan yang sudah diolah
        ]);
    }

    public function pay() {
        $pay_order = $this->orderViews(); 

    }

    public function update(Request $request)
    {
        try {
            $update = OrderRequest::where('user_id', Auth::id())
            ->where('status', 'BELUM BAYAR')
            ->update([
                'payment' => $request['payment'],
                'address' => $request['address'],
                'status' => 'LUNAS',
            ]);
    
            if ($update === 0) {
                return redirect()->back()->with('error', 'UPS! Terjadi Kesalahan');
            }
            return redirect()->back()->with('success', 'Order Akan Segera Dikirim Ke Aamat Anda!');
        }  catch (\Exception $e) {

            return redirect()->back()->with('error','UPS! Terjadi Kesalahan'. $e->getMessage());

        }
    }

    public function barangDiterima($user, $date)
    {
        $order_views = $this->orderViews();
        try {
            foreach ($order_views as $key => $order) {
                OrderHistory::create([
                    'user_name'=> $user,
                    'user_email'=> $order['email'],
                    'order_date'=> $order['created_at'],
                    'total_quantity'=> $order['total_quantity'],
                    'total_price'=> $order['total_price'],
                    'status'=> $order['status'],
                    'payment'=> $order['payment'],
                    'products_order' => json_encode($order['products_order']->toArray()),
                ]);
            }

            OrderRequest::where('user_id', Auth::id())
            ->where('status', 'MENUNGGU KONFIRMASI')->where('created_at', $date)
            ->update([
                'status' => 'DITERIMA USER',
            ]);   

            // Kirim pesan sukses
            return back()->with('success', 'Pesanan Berhasil Diterima .');
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            // return dd($order_views->toArray()); 
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
