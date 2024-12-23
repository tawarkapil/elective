<?php
namespace App\Http\Middleware;

use Closure, Auth;
use App\Models\Permission;
use App\Models\PermissionRole;
use Config;

class ActiveUserPermission
{

	public function handle($request, Closure $next){

		if(Auth::check()){
			$obj = new Permission();
			$data = $obj
	                 ->join('permission_role','permission_role.permission_id','=','permissions.permission_id')->where('permission_role.role_id', Auth::user()->role_id)->where('is_set', 1)->pluck('permissions.slug')->toArray();
		Config::set('ACTIE_USER_PERMISSIONS', $data);
		}

	    return $next($request);
	 }

}