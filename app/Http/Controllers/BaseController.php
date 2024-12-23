<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRole;
use Config;
use Auth;

class BaseController extends Controller{

	public $user;

	function __construct(Request $request){
		// parent::__construct();
     
	    // $this->middleware(function ($request, $next) {
	    //     $this->user= Auth::user();
	    //    // $this->dbsetup($this->user);
	    //     return $next($request);
	    // });

	 //    print_r($request->user());die;
		// $obj = new Permission();
		// $data = $obj->select('permissions.permission_slug')
		// 			->join('permission_role','permission_role.permission_id','=','permissions.permission_id')->where('permission_role.role_id', $this->user->role_id)->where('is_set', 1)->get()->toArray();
		// 			echo "<pre>"; print_r($data);die;

		// View::share ( 'ACTIVE_USERS_PERMISSIONS',  $data);
	}

}