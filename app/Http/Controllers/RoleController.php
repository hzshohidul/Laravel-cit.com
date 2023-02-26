<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    //Role Page view
    function role(){
        $permissiongola = Permission::all();
        $rolegola = Role::all();
        $usergola = User::all();
        return view('admin.role.role', [
            'permissiondatagola' => $permissiongola,
            'roledatagola' => $rolegola,
            'usergola' => $usergola,
        ]);
    }
    //Permission Store
    function permission_store(RoleRequest $request){
        Permission::create([
            'name' => $request->permission_name,
        ]);
        return back()->withSuccesspermission('Permission Insert Successfully.');
    }
    //Role Store
    function role_store(Request $request){
        $role = Role::create([
            'name' => $request->role_name,
        ]);
        $role->givePermissionTo($request->permissiongola);
        return back()->withSuccessrole('Role Insert Successfully.');
    }
    //Assign Role
    function assign_role(Request $request){
        $userid = User::find($request->user_id);
        $userid->assignRole($request->role_id);
        return back()->withAssignrole('Role Insert Successfully.');
    }
    //Remove Role
    function remove_role($user_idta){
        $user = User::find($user_idta);
        $user->syncRoles([]);
        $user->syncPermissions([]);
        return back()->with('roledelete','Role Delete Successfully.');
    }
    //edit Role With Permission
    function edit_rolewith_permission($user_idta){
        $user_info_gola = User::find($user_idta);
        $permission_gola = Permission::all();
        return view('admin.role.edit_user_permission',[
            'user_info_gola' => $user_info_gola,
            'permission_gola' => $permission_gola,
        ]);
    }
    //Permission Update
    function permission_update(Request $request){
        $user = User::find($request->user_id);
        $permissions = $request->permission;
        $user->syncPermissions($permissions);
        return back()->with('permission_update','Role Updated Successfully.');
    }
}
