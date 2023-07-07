<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CancelOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $order = Order::find($id);
        $order->update([
            'status'    => 'STOK KOSONG',
            'is_selesai'=> 1,
        ]);

        return redirect()->route('po.order.index')->with('success', 'Data PO berhasil dicancel, Stok Produk Kosong!');
    }
}
