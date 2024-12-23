<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\PermissionRole;

class PermissionController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    function index(Request $request){
        $input = $request->all();
        $roles  = Role::get();
        $group = Permission::select('*')->orderBy('permission_id', 'ASC')->groupBy('permission_group')->get();

        $group_permissions = false;
        foreach($group as $grp){
            $group_permissions[$grp->permission_group]['group_name'] = $grp->group_name;
            $group_permissions[$grp->permission_group]['permissions'] = Permission::where('permission_group', $grp->permission_group)->orderBy('sort', 'ASC')->get();
        }

        return view('admin.permission.index', ['input' => $input, 'roles' => $roles, 'group_permissions' => $group_permissions]);

    }

    public function permissionSet(Request $request)
    {
        $permissionRoleObj = new PermissionRole();
        $input = $request->all();
        $data = $permissionRoleObj->permissionSet($input);
        return json_encode($data);
    }

}