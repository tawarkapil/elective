<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CommonHelper as CommonHelper;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRole extends Model {

    protected $table = 'permission_role';
    protected $primaryKey = 'permission_role_id';
    
    
    
    public function getPermissionRoleByRoleId($id){
        return PermissionRole::whereRole_id($id)->get();
    }

    public function permissionSet($input) {

        $roles  = Role::get();
        $permissions = Permission::orderBy('permission_id', 'ASC')->get();

        $inppermissions = isset($input['permission']) ? $input['permission'] : false;

        if($permissions){
            foreach($permissions as $key => $permission){
                foreach($roles as $role){
                    if(isset($inppermissions[$role->role_id][$permission->permission_id]))
                    {

                        $checkdata = $obj = PermissionRole::where('role_id', $role->role_id)->where('permission_id', $permission->permission_id)->first();
                        if(!$checkdata){
                            $obj = new PermissionRole();
                            $obj->role_id = $role->role_id;
                            $obj->permission_id = $permission->permission_id;
                        }

                        $checkParent = $role->isCheckedParent($role->role_id, $permission->permission_group, $permission->permission_id);

                        $obj->is_set = ($checkParent) ? 1 : 0;
                        $obj->save();

                    }

                    else{

                        $checkdata = $noCheckobj = PermissionRole::where('role_id', $role->role_id)->where('permission_id', $permission->permission_id)->first();
                        if(!$checkdata){
                            $noCheckobj = new PermissionRole();
                            $noCheckobj->role_id = $role->role_id;
                            $noCheckobj->permission_id = $permission->permission_id;
                        }

                        $noCheckobj->is_set = 0;
                        $noCheckobj->save();

                    }

                }

            }


            // $similler_level = Permission::where('level', '>', 0)->pluck('permission_id')->toArray();
            
            // foreach ($roles as $key => $role) {

            //     $checklevel = PermissionRole::where('role_id', $role->role_id)->whereIn('permission_id', $similler_level)->where('is_set', 0)->first();
            //     if($checklevel){
            //         foreach ($similler_level as $key => $permission_id) {

            //             $checkdata = $obj = PermissionRole::where('role_id', $role->role_id)->where('permission_id', $permission_id)->first();
            //             if(!$checkdata){
            //                 $obj = new PermissionRole();
            //                 $obj->role_id = $role->role_id;
            //                 $obj->permission_id = $permission_id;
            //             }

            //             $obj->is_set = 0;
            //             $obj->save();

            //         }   
            //     }
                    
            // }


            $json['status'] = 1;
            $json['message'] = 'Saved Successfully';
        }else{
            $json['status'] = 2;
        $json['message'] = "Something went wrong";

        }








        
        return $json;
    }
    
}
