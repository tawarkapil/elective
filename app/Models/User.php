<?php
namespace App\Models;

use App\Helpers\MailFunctions;
use App\Helpers\CommonHelper;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Carbon\Carbon;
use Config;
use AwsHelper;
use App\Models\Traits\FileUploadTrait;
use App\Jobs\FileUploadJob;

class User extends Authenticatable
{
   
    protected $table = 'users';
    public $primaryKey = "id";
    
    /*
      All model relations arrives here
    */


    public function getFullNameAttribute(){
        
       return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function getUserProfile($user_id)
    {
        return $this->where('id', $user_id)->first();
    }

    function full_name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    function getrole()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'role_id');
    }

    function displayUserType(){
        return $this->getrole->role_title;
    }

    function displayFullNameWithRole(){
        return $this->full_name(). '('.$this->displayUserType().')';
    }

    function getByKey($key)
    {
        return $this->where($this->primaryKey, $key)->first();
    }

    function changePassword($input)
    {
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|strong_password|min:8|max:20',
            'confirm_password' => 'required|same:new_password',
        );
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        if ($v->passes())
        {
            $userdata = Auth::user();
            if (!Hash::check($input['old_password'], $userdata->password)){
                $json['status'] = 2;
                $json['message'] = "Old Password does not match";
            }else{
                $userdata->password = Hash::make(trim($input['new_password']));
                $userdata->save();
                $json['status'] = 1;
                $json['message'] = 'Password changed successfully';
                $json['redirect_url'] = url('admin/dashboard');
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    /********************************************/
    // forget pasword process start
    /********************************************/

    function forgetPassword($input)
    {
        $rules = array(
            'email' => 'required|email:rfc,dns|min:8|max:250',
        );
        $newnames = array(
            'email' => "Email",
        );
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes())
        {
            $userObj = new User();

            $data = $userObj->where('email', $input['email'])->first();
            if (!empty($data))
            {

                if ($data->status == 1){
                    $data->reset_key = CommonHelper::getEncryptedKey();
                    $data->update();
                    $this->sendPasswordResetEmail($data);
                    $jsondata['status'] = 1;
                    $jsondata['message'] = 'Please check your email for reset password instructions.';
                }
                else
                {
                    $jsondata['status'] = 2;
                    $jsondata['message'] = "You are not authorized to access.";

                }
            }
            else
            {
                $jsondata['status'] = 0;
                $jsondata['message'] = $v->errors()
                    ->add('email', "The information entered is incorrect. Please check and enter correct details.");
            }
        }
        else
        {
            $jsondata['status'] = 0;
            $jsondata['message'] = $v->messages();
        }
        return $jsondata;
    }

    function submitResetPassword($input)
    {
        $rules = array(
            'new_password' => 'required|strong_password|min:8|max:20',
            'confirm_password' => 'required|same:new_password',
        );
        $newnames = array(
            'new_password' => "New Password",
            'confirm_password' => "Confirm Password",
        );
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes())
        {
            $updata = User::where('reset_key', $input['reset_key'])->first();

            if (!empty($updata)){
                $password = $input['new_password'];
                $updata->password = \Hash::make(trim($password));
                $updata->reset_key = "";
                $updata->save();

                $json['status'] = 1;
                $json['message'] = 'Password changed successfully';
                $json['redirect_url'] = url('admin/login');
            }
            else
            {
                $json['status'] = 2;
                $json['message'] = 'Invalid Token';
            }
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    function sendPasswordResetEmail($obj){
        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = sprintf("Password Reset");
        $mailObj->toEmail = $obj->email;
        $html = $mailObj->sendmail("emails.admin.reset_password", ['userObj' => $obj]);
        return $html;
    }

    /********************************************/
    // forget pasword process start
    /********************************************/

    public function updateUserStatus($input)
    {
        $userObj = new User();
        $user_id = $input['user_id'];

        $status = $input['status'];
        $updata = $userObj->getUserProfile($user_id);
        if($updata){
            $updata->updated_at = date('Y-m-d H:i:s');
            $updata->status = $status;
            $updata->save();

            if ($updata->status == 1 && $updata->password_set == 0){
                //send create password mail to user
                $this->sendCreatePasswordEmail($updata);
            }
            $json['status'] = 1;
            $json['message'] = 'Status changed successfully';
            $json['redirect_url'] = url('admin/users');
            $json['success'] = 1;
        }else{
            $json['status'] = 1;
            $json['message'] = 'User not found';

        }
        
        return $json;
    }

    function addNewUser($input)
    {
        $user = $userObj = $this->getByKey($input['user_id']);
        $role_ids = Role::pluck('role_id')->toArray();
        $role_ids_string = implode(',', $role_ids);
        $rules = array(
            'first_name' => 'required|not_allow_symbol|min:3|max:50',
            'last_name' => 'required|not_allow_symbol|min:3|max:50',
            'status' => 'required|in:0,1',

        );

        if (empty($user)){
            $rules['role_id'] = 'required|in:' . $role_ids_string;
            $rules['email'] = 'required|email:rfc,dns|min:8|max:250|unique:users,email,' . $input['user_id'] . ',id';
        }
        $newnames = array(
            'role_id' => 'Role',
        );

        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes())
        {
            if (empty($user))
            {
                $userObj = new User();
            }

            $userObj->first_name = $input['first_name'];
            $userObj->last_name = $input['last_name'];
            if (empty($user)){
                $userObj->email = $input['email'];
                $userObj->role_id = $input['role_id'];
            }
            $userObj->status = $input['status'];

            if (empty($user))
            {
                $userObj->reset_key = CommonHelper::getEncryptedKey();
                $userObj->save();

                if ($userObj->status == 1 && $userObj->password_set == 0)
                {
                    //send create password mail to user
                    $this->sendCreatePasswordEmail($userObj);
                }
                $json['status'] = 1;
                $json['message'] = 'Saved successfully';
                $json['redirect_url'] = url('admin/users');
            }
            else
            {

                if ($userObj->status == 1 && $userObj->password_set == 0)
                {
                    $this->sendCreatePasswordEmail($userObj);
                }
                $userObj->update();
                $json['status'] = 1;
                $json['message'] = 'Updated successfully';
                $json['redirect_url'] = url('admin/users');
            }
            $json['success'] = 1;
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;

    }

    function updateProfile($input)
    {
        $user = $userObj = $this->getByKey($input['user_id']);
        $rules = array(
            'first_name' => 'required|not_allow_symbol|min:3|max:50',
            'last_name' => 'required|not_allow_symbol|min:3|max:50',
        );

        $newnames = array();
        $messages = array();

        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes())
        {
            if (empty($user))
            {
                $userObj = new User();
            }
            $userObj->first_name = $input['first_name'];
            $userObj->last_name = $input['last_name'];
            $userObj->save();

            $json['status'] = 1;
            $json['message'] = 'Saved successfully';
            $json['redirect_url'] = url('admin/profile');
            
            $json['success'] = 1;
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;

    }
}