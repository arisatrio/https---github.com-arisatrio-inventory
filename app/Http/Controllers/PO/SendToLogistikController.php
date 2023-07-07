<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SendToLogistikController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $order = Order::find($id);
        $order->update([
            'status'        => 'DITERIMA ADMIN GUDANG',
            'logistik_id'   => auth()->user()->id 
        ]);

        return redirect()->route('po.order.index')->with('success', 'Data PO berhasil dikirim ke Admin Gudang');
    }
}
