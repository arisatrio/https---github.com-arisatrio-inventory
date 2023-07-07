<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->ajax()) {
            $data = Order::with('createdBy')
                ->when(Auth::user()->hasRole('Customer'), function ($q) {
                    $q->where('user_id', Auth::user()->id);
                })
                ->where('is_selesai', 1)
                ->orderByDesc('tanggal');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('no_surat_jalan', function ($row) {
                    return '0'.$row->id;
                })
                ->editColumn('grand_total', function ($row) {
                    return number_format($row->grand_total, 3);
                })
                ->addColumn('created_by', function ($row) {
                    return $row->createdBy->name;
                })
                ->addColumn('action', 'po.action')
                ->rawColumns(['action'])
                ->make();
        }

        return view('laporan.report-order');
    }
}
