<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth,Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Encryption;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    function login(Request $request)
    {
        if(Auth::check()){
            return redirect('admin/dashboard');
        }
        $input = $request->all();
        return view('admin.auth.login',['input' => $input]);
    }

    
    function doLogin(Request $request){
        $input = $request->all();
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['email'] = $Encryption->decrypt($input['email'], $enckey);
        $input['password'] = $Encryption->decrypt($input['password'], $enckey);

        $rules = array(
            'email' => 'required|email|max:250',
            'password' => 'required|min:8|max:20',
        );

        $messages = array();
        $messages = array();
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->passes()){
            
            $remember_me = (isset($input['remember_me']) && $input['remember_me'] == 'Yes') ? true : false;
            if(Auth::attempt(['email' => $input['email'], 'password' => $input['password'], 'status' => 1], $remember_me)){
                if(Auth::guard('customer')->check()){
                    Auth::guard('customer')->logout();
                }
                $json['status'] = 1;
                $json['message'] = 'Login Successful';
                $json['redirect_url'] = url('admin/dashboard'); 
            } else {
                $json['status'] = 2;
                $json['message'] = 'The information entered is incorrect. Please check the email and password to ensure its correct.';
            }
        } else {
            $json['status'] = 0;
            $json['message'] = $validator->messages();
        }
        return json_encode($json);
       
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Session::flash('MSG','logout successful');
        return redirect()->intended('admin/login');
    }

    function forgetPassword(Request $request){
        if(Auth::check()){
            return redirect('admin/dashboard');
        }
        $input = $request->all();
        return view('admin.auth.forget-password', ['input' => $input]);
    }

    function submitforgetPassword(Request $request){
        $input = $request->all();
        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['email'] = $Encryption->decrypt($input['email'], $enckey);
        /**decrypt fields value***/
        $userObj =  new User();
        $response = $userObj->forgetPassword($input);
        return json_encode($response);

    }

    function resetPassword(Request $request, $token){

        if (Auth::check()) {
            return redirect('admin/dashboard');
        }
        if (strlen($token) > 0) {
            $userObj = new User();
            $userdata = $userObj->where('reset_key', $token)
            ->first();
            if (!empty($userdata)) {
                return view("admin.auth.resetpassword", array('request' => $request, "token" => $token, 'valid' => true));
            } else {
                return view("admin.auth.resetpassword", array('request' => $request, 'valid' => false));
            }
        } else {
            return view("admin.auth.resetpassword", array('request' => $request, 'valid' => false));
        }
        return view("admin.auth.resetpassword", array('request' => $request, 'valid' => false));
    }

    function submitresetPassword(Request $request){
        $input = $request->all();
        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['new_password'] = $Encryption->decrypt($input['new_password'], $enckey);
        $input['confirm_password'] = $Encryption->decrypt($input['confirm_password'], $enckey);
        /**decrypt fields value***/
        $userObj =  new User();
        $response = $userObj->submitResetPassword($input);
        return json_encode($response);
    }

}