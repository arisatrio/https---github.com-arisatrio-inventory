<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrderPrintController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $order = Order::with('orderProducts', 'createdBy')->find($id);

        return view('po.show-print', compact('order'));
    }
}
