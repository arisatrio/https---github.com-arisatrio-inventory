<?php

namespace App\Http\Controllers\Admin\Gudang;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\TipeProdukRequest;
use App\Models\Produk;
use App\Models\ProdukTipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TipeProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = ProdukTipe::withTrashed()->with('produk')->withSum('stoks', 'stok_masuk')
                ->when($request->status !== 'All', function ($query) use ($request) {
                    if ($request->status === 'Active') {
                        return $query->whereNull('deleted_at');
                    }
                    return $query->whereNotNull('deleted_at');
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produk->name;
                })
                ->addColumn('sum_stok', function ($row) {
                    return $row->stoks_sum_stok_masuk.' '.$row->produk->satuan;
                })
                ->addColumn('status', 'admin._status')
                ->addColumn('action', 'gudang._action')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $produks = Produk::all();

        return view('gudang.tipe.index', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipeProdukRequest $request)
    {
        ProdukTipe::updateOrCreate(['id' => $request->id], $request->validated());

        return response()->json([
            'success' => true,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ProdukTipe::find($id);

        return response()->json([
            'success'   => true,
            'data'      => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProdukTipe::withTrashed()->find($id);
        
        if($data->trashed()) {
            $data->restore();
        } else {
            $data->delete();
        }

        return response()->json([
            'success' => true,
        ], 200);   
    }
}
