<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::find($id);
            $order->update([
                'tanggal_kirim' => now(),
                'status'        => 'DELIVERY ORDER',
                'is_selesai'    => 1,
                'gudang_id'     => auth()->user()->id 
            ]);
    
            foreach($order->orderProducts as $prod) {
                $prod->produkTipe->decrement('stok', $prod->qty);

                $prod->produkTipe->stoks()->create([
                    'tanggal'       => now(),
                    'stok_keluar'   => $prod->qty,
                    'is_stok_masuk' => 0
                ]);
            }
    
            DB::commit();

            return redirect()->route('po.order.index')->with('success', 'Data PO berhasil dikirim ke Customer & Data Stok Produk berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('po.order.index')->with('error', 'Data PO gagal dikirim '.$e->getMessage());
        }
    }
}
