<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryOrderPrintController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $order = Order::with('orderProducts', 'createdBy')->find($id);

        return view('po.surat-jalan-print', compact('order'));
    }
}
