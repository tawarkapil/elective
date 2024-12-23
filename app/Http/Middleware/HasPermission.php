<?php
namespace App\Http\Middleware;

use Closure, Auth;
use App\Models\Permission;
use App\Models\PermissionRole;

class HasPermission
{

public function handle($request, Closure $next,$permissions){

    $permissions_array = explode('|', $permissions);
    // $user = $this->auth->user();
    foreach($permissions_array as $permission){
        if($this->hasPermission($permission)){
            return $next($request);
        }
    }

    return abort(404);
 }


 function hasPermission($permission_slug){
    if(in_array($permission_slug, \Config::get('ACTIE_USER_PERMISSIONS'))){
        return true;
    }
    return false;

 }
}

?>