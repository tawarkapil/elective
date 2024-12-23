<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Role;
use App\Helpers\ViewsHelper;
use App\Helpers\CommonHelper;
use Yajra\Datatables\Datatables;
use Config;

class UserController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    function UsersList(Request $request){
        $input = $request->all();
        $roles = Role::pluck('role_title', 'role_id')->toArray();
        return view('admin.user.list', ['input' => $input, 'roles' => $roles]);
    }
    
    function ajaxUserTable(Request $request){
        $input = $request->all();
        $builder = User::select('users.*')
          ->join('roles','users.role_id','=','roles.role_id');
        $builder->where(function($query) use($input){
            if(isset($input['srch_start_date'])){
                $query->whereDate('users.created_at','>=', date('Y-m-d', strtotime($input['srch_start_date'])));
        }
        if(isset($input['srch_end_date'])){
            $query->whereDate('users.created_at','<=', date('Y-m-d', strtotime($input['srch_end_date'])));
        }

        if(isset($input['srch_role'])){
            $query->where('users.role_id', $input['srch_role']);
        }
    });
    return  Datatables::of($builder)->filter(function ($query ) use($input)
    {
        $query->where(function($query) use($input){
        if (isset($input['search']['value']) && strlen($input['search']['value'])>0) {
            $query->where(function($query) use($input){
                        $srch = $input['search']['value'];
                        $name_arr = explode(' ', $srch);
                        if(isset($name_arr[0])){
                            $query->where('first_name', 'LIKE', '%'.$name_arr[0].'%');
                        }
                        if(isset($name_arr[1])){
                            $query->where('last_name', 'LIKE', '%'.$name_arr[1].'%');
                        }
                    })->orWhere('last_name', 'LIKE', '%'.$input['search']['value'].'%')->orWhere('email', 'LIKE', '%'.$input['search']['value'].'%')->orWhere('roles.role_title', 'LIKE', '%'.$input['search']['value'].'%');
            }
            });
            })
            ->editColumn('first_name', function ($row) {
                return $row->full_name();
            })

            ->editColumn('email', function ($row) {
                return $row->email;
            })

            ->editColumn('created_at', function ($row) {
                return ViewsHelper::displayDate($row->created_at, true);
            })

            ->editColumn('roles.role_title', function ($row) {
                return $row->getrole->role_title;
            })
            
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap">';
                if(ViewsHelper::checkUserAccess('users_edit')){
                    $action .= '<a href="'.url('admin/users/addnew/'.base64_encode($row->id)).'" data-toggle="tooltip" data-original-title="Edit"> <i data-feather="edit-2" class="text-inverse m-r-10"></i> </a>';
                 }


                if(ViewsHelper::checkUserAccess('users_change_status')){
                    if($row->status == 0){
                        $action .= '<a class="update_status" data-status="1"  data-key="'.base64_encode($row->id).'" data-toggle="tooltip" data-original-title="Change Status"> <i data-feather="compass" class="text-inverse m-r-10"></i> </a>';

                    }else{

                        $action .= '<a class="update_status" data-status="0"  data-key="'.base64_encode($row->id).'" data-toggle="tooltip" data-original-title="Change Status"> <i data-feather="compass" class="text-inverse m-r-10"></i> </a>';
                    }
                }
                $action .= '</div>';
                return $action;
            })
        ->rawColumns(['type', 'action'])->addIndexColumn()
        ->make(true);
    }

    public function addnew(Request $request, $user_id = null){
        $user_id = base64_decode($user_id);
      $user_data = [];
        if(isset($user_id)){
           $obj = new User();
           $user_data = $obj->getUserProfile($user_id);
        }
       $role_data = Role::orderBy('created_at', 'DESC')->get();
       return view('admin.user.addnew',['request' => $request, 'user_data' => $user_data, 'role_data' => $role_data]);
    }
    
    public function update_status(Request $request)
    {
        $userObj = new User();
        $input = $request->all();
        $input['user_id'] = base64_decode($input['user_id']);
        $data = $userObj->updateUserStatus($input);
        return json_encode($data);
    }


    function createpassword(Request $request, $token){

        
        if (strlen($token) > 0) {
            $userObj = new User();
            $userdata = $userObj->where('reset_key', $token)->first();
            if (!empty($userdata)) {
                return view("admin.user.createpassword", array('request' => $request, "token" => $token, 'valid' => true));
            } else {
                return view("admin.user.createpassword", array('request' => $request, 'valid' => false));
            }
        } else {
            return view("admin.user.createpassword", array('request' => $request, 'valid' => false));
        }
        return view("admin.user.createpassword", array('request' => $request, 'valid' => false));
    }

    function submitCreatePassword(Request $request){
        $input = $request->all();
        $userObj =  new User();
        $response = $userObj->subCreatePassword($input);
        return json_encode($response);
    }

    public function addnewajax(Request $request)
    {
        $userObj = new User();
        $input = $request->all();
        $input['user_id'] = base64_decode($input['user_id']);
        $data = $userObj->addNewUser($input);
        return json_encode($data);
    }
}