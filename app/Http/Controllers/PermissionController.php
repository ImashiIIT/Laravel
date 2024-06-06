<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PermissionDataTable;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    
    public function index(PermissionDataTable $dataTable)
    {
        return $dataTable->render('role-permission.permission.index');
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);
        Permission::create([
            'name' => $request->name
        ]);
        return redirect()->route('permission.index')->with('status', 'Permission Created');
    }

    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);
        $permission->update([
            'name' => $request->name
        ]);
        return redirect()->route('permission.index')->with('status', 'Permission Updated Successfully');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permission.index')->with('status', 'Permission Deleted Successfully');
    }
}
