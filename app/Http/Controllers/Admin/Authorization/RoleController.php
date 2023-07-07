<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::when($request->status, function ($query) use ($request) {
                    if ($request->status == 'All') {
                        return $query->withTrashed();
                    }
                    if ($request->status == 'Active') {
                        return $query->whereNull('deleted_at');
                    }
                    return $query->whereNotNull('deleted_at');
                })
                ->withTrashed()
                ->latest();

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = $row->deleted_at ? 'Inactive' : 'Active';
                    $color = $row->deleted_at ? 'danger' : 'success';
                    return '<span class="badge badge-' . $color . '">' . $status . '</span>';
                })
                ->addColumn('action', 'admin.authorization.role.action')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.authorization.role.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'. $request->id . ',id'
        ]);

        Role::withTrashed()->updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully'
        ], 200);
    }

    public function edit($id)
    {
        $role = Role::withTrashed()->find($id);
        return response()->json([
            'success' => true,
            'data' => $role
        ], 200);
    }

    public function show($id)
    {
        $role = SpatieRole::find(Crypt::decrypt($id));
        $permission = Permission::all();

        $permission = $permission->each(function ($item, $key) {
            $name = explode(' ', $item['name']);
            $item['action'] = $name[0];
            $item['module'] = $name[1];
        });

        $permission = $permission->groupBy('module')->sortKeys();

        return view('admin.authorization.role.permission', compact('role', 'permission'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully'
        ], 200);
    }

    public function restore($id)
    {
        $role = Role::withTrashed()->find($id);
        $role->restore();

        return response()->json([
            'success' => true,
            'message' => 'Role restored successfully'
        ], 200);
    }
}
