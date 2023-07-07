<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProdukTipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_tipe_id'    => 'required',
            'qty'               => 'required|numeric'
        ]);

        $prod = ProdukTipe::find($request->produk_tipe_id);
        $order = Order::find($request->order_id);

        $orderProd = OrderProduct::updateOrCreate(['id' => $request->id], [
            'order_id'      => $order->id,
            'produk_tipe_id'=> $prod->id,
            'harga'         => $prod->harga,
            'qty'           => $request->qty
        ]);
        $orderProd->update([
            'sub_total'     => $orderProd->harga*$orderProd->qty
        ]);

        $order->update([
            'total'         => $order->orderProducts->sum('sub_total'),
            'ppn'           => (($order->orderProducts->sum('sub_total'))*11)/100,
            'grand_total'   => $order->orderProducts->sum('sub_total') + (($order->orderProducts->sum('sub_total'))*11)/100,
        ]);

        return response()->json([
            'success' => true,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if($request->ajax()) {
            $data = OrderProduct::with('produkTipe', 'produkTipe.produk')->where('order_id', $id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produkTipe->produk->name.' '.$row->produkTipe->name.' '.$row->produkTipe->ukuran;
                })
                ->addColumn('action', 'po.action-produk')
                ->rawColumns(['action'])
                ->make('true');
        }
        $order = Order::find($id);
        $produks = ProdukTipe::with('produk')->get();

        return view('po.create-produk', compact('order', 'produks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = OrderProduct::find($id);

        return response()->json([
            'success'   => true,
            'data'      => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = OrderProduct::find($id);
        $data->order->decrement('total', $data->sub_total);
        $data->order->decrement('grand_total', $data->sub_total);

        $data->delete();

        $order = Order::find($data->order_id);
        $order->update([
            'ppn'   => $data->order->orderProducts->sum('sub_total') + (($data->order->orderProducts->sum('sub_total'))*11)/100,
        ]);

        if($order->ppn == 0) {
            $order->update(['grand_total' => 0]);
        }

        return response()->json([
            'success' => true,
        ], 200);
    }
}
