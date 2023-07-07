<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\ProdukStok;
use App\Models\ProdukTipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->ajax()) {
            $data = ProdukTipe::with('stokMasuk', 'stokKeluar');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produk->name.' '.$row->name.' '.$row->ukuran;
                })
                ->addColumn('stok_masuk', function ($row) {
                    return $row->stokMasuk->sum('stok_masuk');
                })
                ->addColumn('stok_keluar', function ($row) {
                    return $row->stokKeluar->sum('stok_keluar');
                })
                ->editColumn('stok', function ($row) {
                    return $row->stok;
                })
                ->addColumn('action', '-')
                ->make(true);
        }

        return view('laporan.report-stok');
    }
}
