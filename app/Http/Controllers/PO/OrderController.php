<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Order::with('createdBy')
                ->when(Auth::user()->hasRole('Admin Logistik'), function ($q) {
                    $q->where('status', 'INPUT');
                })
                ->when(Auth::user()->hasRole('Admin Gudang'), function ($q) {
                    $q->where('status', 'DITERIMA ADMIN GUDANG');
                })
                ->when(Auth::user()->hasRole('Customer'), function ($q) {
                    $q->where('user_id', Auth::user()->id);
                })
                ->where('is_selesai', 0)
                ->whereHas('orderProducts')
                ->orderByDesc('tanggal');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_by', function ($row) {
                    return $row->createdBy->name;
                })
                ->addColumn('status', function ($row) {
                    return '<span class="badge badge-info">'.$row->status.'</span>';
                })
                ->addColumn('action', 'po.action')
                ->rawColumns(['action', 'status'])
                ->make();
        }
        return view('po.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('po.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            'tanggal'   => 'required|date',
            'no_po'     => 'required',
            'user_id'   => 'required'
        ]);

        $order = Order::create([
            'tanggal'   => $request->tanggal,
            'no_po'     => 'PO.00'.$request->no_po.'.'.now()->format('m').'.'.now()->format('y'),
            'user_id'   => $request->user_id
        ]);

        return redirect()->route('po.order-produk.show', $order->id)->with('success', 'Data PO berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('orderProducts', 'createdBy')->find(Crypt::decrypt($id));

        return view('po.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        $data = Order::find($id);
        $data->delete();

        return response()->json([
            'success'   => true,
            'data'      => $data
        ], 200);
    }
}
