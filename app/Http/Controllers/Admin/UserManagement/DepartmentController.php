<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use App\Models\Department;
use Yajra\DataTables\Facades\DataTables;


class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $departments = Department::withTrashed()
                ->when($request->status !== 'All', function ($query) use ($request) {
                    if ($request->status === 'Active') {
                        return $query->whereNull('deleted_at');
                    }
                    return $query->whereNotNull('deleted_at');
                })
                ->latest();

            return DataTables::eloquent($departments)
                ->addIndexColumn()
                ->addColumn('status', 'admin._status')
                ->addColumn('action', 'admin.user-management.department.action')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.user-management.department.index');
    }

    public function store(DepartmentRequest $request)
    {
        Department::withTrashed()->updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department saved successfully'
        ], 201);
    }

    public function edit($id)
    {
        $department = Department::withTrashed()->find($id);
        return response()->json([
            'success' => true,
            'data' => $department
        ], 200);
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return response()->json([
            'success' => true,
        ], 200);
    }

    public function restore($id)
    {
        $department = Department::withTrashed()->find($id);
        $department->restore();
        return response()->json([
            'success' => true,
        ], 200);
    }
}
