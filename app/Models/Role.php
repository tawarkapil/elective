<?php

namespace App\Models;

class Role extends Base
{

    protected $table = 'roles';
    public $primaryKey = "role_id";
    /*

      All model relations arrives here

     */




    function isChecked($role_id, $permission_id) {
        $prObj = new PermissionRole();
        $prole = $prObj->where("permission_id", $permission_id)->where("role_id", $role_id)->where('is_set', 1)->first();
        if ($prole)
            return true;
        else {
            return false;
        }
    }

    function isCheckedParent($role_id, $group_name, $permission_id = null){
        if($permission_id){
            $permissdata = Permission::where('permission_id', $permission_id)->first();
            if($permissdata && $permissdata->parent){
                return true;
            }
        }
        $prentdata = Permission::where('permission_group', $group_name)->where('parent', 1)->first();
        if($prentdata){
            $response = $this->isChecked($role_id, $prentdata->permission_id);
            return $response;
        }

        return false;
    }
}