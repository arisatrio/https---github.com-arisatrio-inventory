<?php

namespace App\Http\Controllers\Admin\Gudang;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\ProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Produk::withTrashed()
                ->when($request->status !== 'All', function ($query) use ($request) {
                    if ($request->status === 'Active') {
                        return $query->whereNull('deleted_at');
                    }
                    return $query->whereNotNull('deleted_at');
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', 'admin._status')
                ->addColumn('action', 'gudang._action')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('gudang.produk.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukRequest $request)
    {
        Produk::updateOrCreate(['id' => $request->id], $request->validated());

        return response()->json([
            'success' => true,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Produk::find($id);

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
        $data = Produk::withTrashed()->find($id);
        
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
