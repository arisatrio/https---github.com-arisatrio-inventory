<?php

namespace App\Http\Controllers\Admin\Gudang;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\StokProdukRequest;
use App\Models\ProdukStok;
use App\Models\ProdukTipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = ProdukStok::with('produkTipe', 'produkTipe.produk')
                ->where('is_stok_masuk', 1)
                ->orderByDesc('tanggal');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produkTipe->produk->name.' '.$row->produkTipe->name.' '.$row->produkTipe->ukuran;
                })
                ->addColumn('action', 'gudang.stok._action')
                ->rawColumns(['action'])
                ->make(true);
        }
        $produks = ProdukTipe::with('produk')->get();

        return view('gudang.stok.index', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StokProdukRequest $request)
    {
        ProdukStok::updateOrCreate(['id' => $request->id], $request->validated());

        return response()->json([
            'success' => true,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ProdukStok::find($id);

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
        $data = ProdukStok::find($id);
        $data->delete();

        return response()->json([
            'success' => true,
        ], 200);
    }
}
