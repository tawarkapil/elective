<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Customer;
use App\Models\TrackCustomerDevice; 
use Illuminate\Support\Facades\Validator;
use App\Helpers\Encryption;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Helpers\MailFunctions;
use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use Illuminate\Support\Facades\Auth;
use DB, Hash;

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
        if(Auth::guard('customer')->check()){
            return redirect('dashboard');
        }
        $input = $request->all();
        return view('frontend.auth.login',['input' => $input]);
    }

    function doLogin(Request $request){
        $input = $request->all();
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['email'] = $Encryption->decrypt($input['email'], $enckey);
        $input['password'] = $Encryption->decrypt($input['password'], $enckey);

        $rules = array(
            'email' => 'required|max:250',
            'password' => 'required|min:8|max:20',
        );

        
        $newnames  = [];
        $messages = [];
        $messages = array();
        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($newnames);
        if ($validator->passes())
        {

            $remember_me = (isset($input['remember_me']) && $input['remember_me'] == 'Yes') ? true : false;
            if(Auth::guard('customer')->attempt(['email' => $input['email'], 'password' => $input['password'], 'status' => 1], $remember_me)){

                if(Auth::check()){
                    Auth::logout();
                }

                $json['status'] = 1;
                $json['message'] = 'Login Successful';
                $json['redirect_url'] = url('dashboard');
            }else {
                $json['status'] = 2;
                $json['message'] = 'The information entered is incorrect. Please check the username and password to ensure its correct.';

            }
        } else {
            $json['status'] = 0;
            $json['message'] = $validator->messages();
            
        }
        return json_encode($json);
    }

    function logout(Request $request){
        Auth::guard('customer')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Session::flash('MSG','logout successful');
        return redirect()->intended('login');
    }

    function forgetPassword(Request $request){
        if(Auth::guard('customer')->check()){
            return redirect('dashboard');
        }
        $input = $request->all();
        return view('frontend.auth.forget-password', ['input' => $input]);
    }

    function submitforgetPassword(Request $request){
        $input = $request->all();
        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['email'] = $Encryption->decrypt($input['email'], $enckey);
        /**decrypt fields value***/
        $userObj =  new Customer();
        $response = $userObj->forgetPassword($input);
        return json_encode($response);

    }

    function resetPassword(Request $request, $token){

        if (Auth::guard('customer')->check()) {
            return redirect('dashboard');
        }
        if (strlen($token) > 0) {
            $userObj = new Customer();
            $userdata = $userObj->where('reset_key', $token)->first();
           
            if ($userdata) {
                $userdata->reset_key = $token;
                $userdata->save();

                return view("frontend.auth.resetpassword", array('request' => $request, "token" => $token, 'valid' => true));
            } else {
                return view("frontend.auth.resetpassword", array('request' => $request, 'valid' => false));
            }
        } else {
            return view("frontend.auth.resetpassword", array('request' => $request, 'valid' => false));
        }
        return view("frontend.auth.resetpassword", array('request' => $request, 'valid' => false));
    }

    function submitresetPassword(Request $request){
        $input = $request->all();
        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['new_password'] = $Encryption->decrypt($input['new_password'], $enckey);
        $input['confirm_password'] = $Encryption->decrypt($input['confirm_password'], $enckey);
        /**decrypt fields value***/
        $userObj =  new Customer();
        $response = $userObj->submitResetPassword($input);
        return json_encode($response);
    }

    function register(Request $request){
        if(Auth::guard('customer')->check()){
            return redirect('dashboard');
        }
        $input = $request->all();
        return view('frontend.auth.register',['input' => $input]);
    }

    function doRegister(Request $request){
        $input  = $request->all();
        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['email'] = $Encryption->decrypt($input['email'], $enckey);
        $input['password'] = $Encryption->decrypt($input['password'], $enckey);
        $input['confirm_password'] = $Encryption->decrypt($input['confirm_password'], $enckey);
        /**decrypt fields value***/
        $rules = array(
            'first_name' =>  'required|not_allow_symbol|max:50',
            'last_name' =>  'required|not_allow_symbol|max:50',
            'email' =>  'required|email:rfc,dns|unique:customers,email|min:8|max:255',
            'password' => 'required|strong_password|min:6|max:50',
            'confirm_password' => 'required|strong_password|same:password'
        );
        $messages = array();
        $v = \Validator::make($input, $rules);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $customer = new Customer();
                $customer->signup_activation_key = CommonHelper::getEncryptedKey();
                $customer->first_name = ucwords($input['first_name']);
                $customer->last_name = ucwords($input['last_name']);
                $customer->email = trim($input['email']);
                $customer->password = Hash::make($input['password']);
                $customer->status = 1;
                $customer->save();

                Auth::guard('customer')->attempt([
                    'email' => $input['email'], 
                    'password' => $input['password'], 
                    'status' => 1
                ]);

                DB::commit();
                $this->sendWelcomeMail($customer);
                $json['status'] = 1;
                $json['message'] = 'Registered Successfully';
                $json['redirect_url'] = url('dashboard');                

            }catch(\Exception $e){
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return json_encode($json);

    }

    function sendWelcomeMail($customer) {

        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = sprintf("Verification mail");
        $mailObj->toEmail = $customer->email;
        $html = $mailObj->sendmail("emails.frontend.welcome_email", ['customer' => $customer]);
    }

    function resendVerificaitonMail(){
        $custdata = Auth::guard('customer')->user();
        $data = Customer::where('customer_id', $custdata->customer_id)
        ->where('is_email_verify', 0)
        ->first();

        if(!$data){
            $jsondata['status'] = 2;
            $jsondata['message'] = 'You cannot perform this action';
            return $jsondata;
        }


        $today = date('Y-m-d');
        $custObj = new Customer();
        $otp = rand(111111, 999999);
        $data->signup_activation_key = CommonHelper::getEncryptedKey();
        $data->update();

        $this->email_confirmation_mail($data);
        $jsondata['status'] = 1;
        $jsondata['message'] = 'Email has been sent successfully';
        return $jsondata;
    }



    function email_confirmation_mail($customer) {
        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = sprintf("Verification mail");
        $mailObj->toEmail = $customer->email;
        $html = $mailObj->sendmail("emails.frontend.email_verification_mail", ['customer' => $customer]);
    }

    function confirmEmail(Request $request, $token = null){
        $input = $request->all();
        $valid = false;
        if (strlen($token) > 0) {
            $userObj = new Customer();
            $custdata = Customer::where('signup_activation_key', $token)->first();
            if ($custdata) {
                $valid = true;
                $custdata->signup_activation_key = "";
                $custdata->is_email_verify = 1;
                $custdata->update();
            }else{
                return redirect('dashboard');
            }
        }
        return view("frontend.auth.account_activation", array('request' => $request, "valid" => $valid, 'custdata' => $custdata));
    }
}