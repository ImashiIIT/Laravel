<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\RoleDataTable;
use Spatie\Permission\Models\Role;
use \Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller


{
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('role-permission.role.index');
    }

    public function create()
    {
        return view('role-permission.role.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);
        Role::create([
            'name'=>$request->name
        ]);
        return redirect('roles')->with('status','Role Created');
    }
    public function edit(Role $role)
    {
    return view('role-permission.role.edit', [
        'role' => $role
    ]);        
    }

    public function update(Request $request, Role $role){
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);
        $role->update([
            'name'=>$request->name
        ]);
        return redirect('roles')->with('status','Role Updated Successfully');
    }
    
    public function destroy($roleId){
        $roles=Role::find($roleId);
        $roles->delete();
       return redirect('roles')->with('status', 'Role Deleted Successfully');
        
    }
    public function addPermissionToRole($roleId)
{
    $role = Role::findOrFail($roleId);
    $permission = Permission::get();
    $rolePermissions = $role->permissions()->pluck('id')->toArray();

    return view('role-permission.role.add-permissions', compact('role', 'permission', 'rolePermissions'));
}

    public function givePermissionToRole(Request $request, $roleId)
{
    $request->validate([
        'permission' => 'required|array'
    ]);

    $role = Role::findOrFail($roleId);

    // Filter out non-existing permissions
    $validPermissions = Permission::whereIn('id', $request->permission)->pluck('id');
    
    // Update role permissions
    $role->syncPermissions($validPermissions);

    return redirect('roles')->with('status', 'Permissions Assigned Successfully');
}

}
