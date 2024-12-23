<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth,Session;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Encryption;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\State;
use App\Models\Region;
use App\Models\MembershipLevel;
use App\Models\CustomerMembershipLevel;
use App\Models\TempCustomer;
use App\Models\BillingAddress;
use App\Models\CompanyAddress;
use App\Models\Transaction;
use App\Models\PasswordTrack;
use App\Helpers\MailFunctions;
use Hash, DB, Config;
use Illuminate\Support\Str;
use Stripe;
use ViewsHelper, CommonHelper;

class RegisterController extends Controller
{


    function preRegister(Request $request){
        $input = $request->all();
        if(Auth::guard('customer')->check()){
            return redirect('dashboard');
        }

        $associate = MembershipLevel::where('slug', 'associate')->first();
        $student = MembershipLevel::where('slug', 'student')->first();
        $educator = MembershipLevel::where('slug', 'educator')->first();

        return view('frontend.auth.pre-register',['input' => $input, 'associate' => $associate, 'student' => $student, 'educator' => $educator]);
    }

    function register(Request $request, $membership_level){
        $input = $request->all();
        if(Auth::guard('customer')->check()){
            return redirect('dashboard');
        }

        $membership_levels = ['associate' => 1, 'student' => 2, 'educator' => 3];

        if(!in_array($membership_level, array_keys($membership_levels))){
            return redirect('pre-register');
        }

        $countries = Country::orderBy('name', 'ASC')->get();
        $regions = Region::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $membership_lvl = MembershipLevel::where('id', $membership_levels[$membership_level])->first();
        $states = [];
        $billing_states = [];
        $company_states = [];
        $temp_data = false;

        $steps = isset($input['steps']) ? $input['steps'] : 1;

        $register_token = isset($input['register-token']) ? $input['register-token'] : '';
        if($register_token){
            $temp_data = TempCustomer::where('token', $register_token)->first();
            if(!$temp_data || ($temp_data && $temp_data->membership_level != $membership_levels[$membership_level])){
                return abort(404);
            }
            $states = State::where('country_id', $temp_data->country)->orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
            $billing_states = State::where('country_id', $temp_data->billing_country)->orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
            $company_states = State::where('country_id', $temp_data->company_country)->orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
            $steps = (($steps - 1) >  $temp_data->steps) ? $temp_data->steps + 1 : $steps;
        }

        $active_steps = $steps;

        return view('frontend.auth.register',[
            'input' => $input, 
            'temp_data' => $temp_data, 
            'countries' => $countries, 
            'states' => $states, 
            'billing_states' => $billing_states, 
            'regions' => $regions, 
            'membership_lvl' => $membership_lvl, 
            'steps' => $steps, 
            'active_steps' => $active_steps, 
            'membership_level' => $membership_level, 
            'company_states' => $company_states
        ]);
    }


    function registerStep1(Request $request){
        $input  = $request->all();

        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['email'] = $Encryption->decrypt($input['email'], $enckey);
        $input['confirm_email'] = $Encryption->decrypt($input['confirm_email'], $enckey);
        $input['username'] = $Encryption->decrypt($input['username'], $enckey);
        /**decrypt fields value***/

        $temp_data = $customer = TempCustomer::where('email', $input['email'])->first();

        if(!$temp_data || ($temp_data && $temp_data->token != $input['register-token'])){
            if(isset($input['password'])){
                $input['password'] = $Encryption->decrypt($input['password'], $enckey);
                $input['confirm_password'] = $Encryption->decrypt($input['confirm_password'], $enckey);
            }
        }

        $checkRejectedMember = Customer::where('email', $input['email'])->first();
        $rejectMemberdata = false;
        if($checkRejectedMember && $checkRejectedMember->activeMembershipLevel->status == 2){
            $rejectMemberdata = $checkRejectedMember;
        }


        $rules = array(
            'first_name' =>  'required|not_allow_symbol|min:3|max:50',
            'last_name' =>  'required|not_allow_symbol|min:3|max:50',
            'username' =>  'required|alpha_num|unique:customers,username|min:3|max:100',
            'confirm_email' =>  'required|email:rfc,dns|same:email|max:250',
            'country_code' => 'required|not_allow_symbol|max:10',
            'dial_code' => 'required',
            'phone_number' =>  'required|integer|digits_between:10,15',
            'membership_level' => 'required|exists:membership_level,id',
            'dob' => 'required|date|before:-18 years',
            'address' => 'required|not_allow_symbol|min:3|max:250',
            'country' => 'required|exists:countries,id',
            'state' => 'nullable|exists:states,id',
            'city' => 'required|not_allow_symbol|min:3|max:100',
            'postal_code' => 'nullable|alpha_num|not_allow_symbol|min:3|max:15',
            'region' => 'required|exists:regions,id',
        );


        if(isset($input['country']) && $input['country'] == 231){
            $rules['postal_code'] = 'required|alpha_num|not_allow_symbol|min:3|max:15';
        }

        $membership_levels = [1 => 'associate', 2 => 'student', 3 => 'educator'];
        $membership_level = $membership_levels[$input['membership_level']];

        if($rejectMemberdata){
            $rules['username'] = 'required|alpha_num|min:3|max:250|unique:customers,username,' . $rejectMemberdata->customer_id . ',customer_id';
            $rules['challenging_rejection'] = 'required|';
            if(isset($input['challenging_rejection']) && $input['challenging_rejection'] == 'Yes'){
                $rules['challenging_rejection_description'] = 'required|not_allow_symbol|min:10|max:5000';
            }else{
                $rules['challenging_rejection_description'] = 'nullable|not_allow_symbol|min:10|max:5000';
            }

            if($membership_level == 'educator'){
                $rules['email'] = 'required|email:rfc,dns|profession_email|min:8|max:250|unique:customers,email,' . $rejectMemberdata->customer_id . ',customer_id';
                //$rules['username'] = 'required|alpha_num|unique:customers,username|min:3|max:100';
                //$rules['email'] = 'required|email:rfc,dns|unique:customers,email|profession_email|min:8|max:255';
            }else{
                $rules['email'] = 'required|email:rfc,dns|min:8|max:250|unique:customers,email,' . $rejectMemberdata->customer_id . ',customer_id';;
            }   
        }else{
            if($membership_level == 'educator'){
                $rules['email'] = 'required|email:rfc,dns|unique:customers,email|profession_email|min:8|max:255';

            }else{
                $rules['email'] = 'required|email:rfc,dns|unique:customers,email|min:8|max:255';
            }
        }

        if(!$temp_data || ($temp_data && $temp_data->token != $input['register-token'])){
            if(isset($input['password'])){
                $rules['password'] = 'required|strong_password|min:8|max:15';
                $rules['confirm_password'] = 'required|same:password';
            }
        }
        $messages = array();
        $newnames = [
            'dob' => 'date of birth',
        ];
        //echo "<pre>";print_r($rules);die;
        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {

            DB::beginTransaction();
            try{

                $checkUsernameExist = TempCustomer::where('username', $input['username'])->where('email','!=', $input['email'])->first();

                if($checkUsernameExist){
                    $json['status'] = 0;
                    $json['message'] = $v->errors()->add('username', "The usename has already been taken.");
                    return json_encode($json);
                }

                if(!$temp_data){
                    $customer = new TempCustomer();
                }

                if(!$temp_data || ($temp_data && $temp_data->token != $input['register-token'])){
                    $customer->token = Str::random(100);
                }
                $customer->membership_level = $input['membership_level'];
                $customer->first_name = $input['first_name'];
                $customer->last_name = $input['last_name'];
                $customer->email = trim($input['email']);
                $customer->username = trim($input['username']);
                $customer->country_code = $input['country_code'];
                $customer->dial_code = $input['dial_code'];
                $customer->phone_number = $input['phone_number'];
                
                if(!$temp_data || ($temp_data && $temp_data->token != $input['register-token'])){
                    if(isset($input['password'])){
                        $customer->password = Hash::make($input['password']);
                    }
                }

                $customer->dob = date('Y-m-d', strtotime($input['dob']));
                $customer->address = $input['address'];
                $customer->country = $input['country'];
                $customer->state = $input['state'];
                $customer->city = $input['city'];
                $customer->postal_code = $input['postal_code'];
                $customer->region = $input['region'];
                if(isset($input['challenging_rejection']) && $input['challenging_rejection'] == 'Yes'){
                    $customer->challenging_rejection = isset($input['challenging_rejection']) ? $input['challenging_rejection'] : null;
                    $customer->challenging_rejection_description = isset($input['challenging_rejection_description']) ? $input['challenging_rejection_description'] : null;

                }
                $customer->region = $input['region'];
                $customer->steps = 1;
                $customer->save();


                if($rejectMemberdata){
                    $this->copyRejectMemberToTempData($rejectMemberdata, $customer, $input);
                }

                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Step1 Completed Successfully';
                $json['redirect_url'] = url('register/'.$membership_level.'?register-token='.$customer->token.'&steps=2&register_id='.$customer->id);
                $json['register_token'] = $customer->token;
                $json['customer_temp_id'] = $customer->id;
                    // all good
            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = 'Something went wrong';
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return json_encode($json);

    }


    function copyRejectMemberToTempData($rejectMemberdata, $customer, $input){
        $customer->challenging_rejection = $input['challenging_rejection'];
        if(isset($input['challenging_rejection']) && $input['challenging_rejection'] == 'Yes'){
            $customer->challenging_rejection_description = $input['challenging_rejection_description'];
        }

        $customer->accept_terms = 0;

        $billingObj = BillingAddress::where('customer_id', $rejectMemberdata->customer_id)->first();
        if($billingObj){
            //$customer->same_as_address = $billingObj->same_as_address;
            $customer->billing_first_name = $billingObj->first_name;
            $customer->billing_last_name = $billingObj->last_name;
            $customer->billing_address = $billingObj->address;
            $customer->billing_country = $billingObj->country;
            $customer->billing_state = $billingObj->state;
            $customer->billing_city = $billingObj->city;
            $customer->billing_postal_code = $billingObj->postal_code;
            $customer->billing_region = $billingObj->region;
        }
        
        if($customer && $customer->membership_level == 1){
            $companyObj = CompanyAddress::where('customer_id', $rejectMemberdata->customer_id)->first();
            if($companyObj){
                $customer->company_name = $companyObj->company_name;
                $customer->title_for_function = $companyObj->title_for_function;
                $customer->company_address = $companyObj->address;
                $customer->company_country = $companyObj->country;
                $customer->company_state = $companyObj->state;
                $customer->company_city = $companyObj->city;
                $customer->company_postal_code = $companyObj->postal_code;
                $customer->company_region = $companyObj->region;
                $customer->company_phone_number = $companyObj->phone_number;
                $customer->company_website = $companyObj->website;
            }
        }else{
            $customer->company_name = null;
            $customer->title_for_function = null;
            $customer->company_address = null;
            $customer->company_country = null;
            $customer->company_state = null;
            $customer->company_city = null;
            $customer->company_postal_code = null;
            $customer->company_phone_number = null;
            $customer->company_website = null;
            $customer->company_region = null;
        }

        if($customer && $customer->membership_level == 2){
            $customer->student_id =  $rejectMemberdata->student_id;
            $customer->student_university = $rejectMemberdata->student_university;
            $customer->student_level = $rejectMemberdata->student_level;
        }else{
            $customer->student_id =  null;
            $customer->student_university = null;
            $customer->student_level = null;
        }


        
        if($customer && $customer->membership_level == 3){
            $customer->educator_university = $rejectMemberdata->educator_university;
            $customer->educator_role = $rejectMemberdata->educator_role;
        }else{
            $customer->educator_university = null;
            $customer->educator_role = null;
        }

        $customer->save();
        if($customer && $customer->membership_level != 1){
            $companyObj = CompanyAddress::where('customer_id', $rejectMemberdata->customer_id)->first();
            if($companyObj){
                $companyObj->delete();
            }
        }
        return true;
    }



    function registerStep2(Request $request){
        $input  = $request->all();
        $checkdata = $customer = TempCustomer::where('token', $input['register-token'])->first();
        if(!$checkdata){
            $json['status'] = 2;
            $json['message'] = 'Something went wrong.';
            return json_encode($json);
        }

        if($customer && $customer->membership_level == 1){
            $rules = array(
                'company_name' =>  'required|not_allow_symbol|min:3|max:250',
                'title_for_function' =>  'required|not_allow_symbol|min:3|max:250',
                'company_address' =>  'nullable|not_allow_symbol|min:3|max:250',
                'company_country' =>  'nullable|exists:countries,id',
                'company_state' =>  'nullable|exists:states,id',
                'company_city' =>  'nullable|not_allow_symbol|min:3|max:100',
                'company_postal_code' =>  'nullable|alpha_num|not_allow_symbol|min:3|max:15',
                'company_region' =>  'nullable|exists:regions,id',
                'company_phone_number' =>  'nullable|integer|digits_between:10,20',
                'company_website' =>  'nullable|url|max:1024',
            );

            // if(isset($input['company_country']) && $input['company_country'] == 231){
            //     $rules['company_postal_code'] = 'required|max:15';
            // }

        }
        elseif($customer && $customer->membership_level == 2){
            $student_levels = implode(',', array_keys(\Config::get('params.student_levels')));

            $rules = array(
                'student_id' =>  'nullable|alpha_num|min:3|max:250',
                'student_university' =>  'required|not_allow_symbol|min:3|max:250',
                'student_level' =>  'required|in:'.$student_levels,
            );
        }elseif($customer && $customer->membership_level == 3){
            $educator_roles = implode(',', array_keys(\Config::get('params.educator_roles')));

            $rules = array(
                'educator_university' =>  'required|not_allow_symbol|min:3|max:250',
                'educator_role' =>  'required|in:'.$educator_roles,
            );
        }
        $messages = array();
        
        $newnames['company_name'] =  'Company Name';
        $newnames['title_for_function'] =  'Title or function';
        $newnames['company_address'] =  'Address';
        $newnames['company_country'] =  'Country';
        $newnames['company_state'] =  'State';
        $newnames['company_city'] =  'City';
        $newnames['company_postal_code'] =  'Postal Code';
        $newnames['company_region'] =  'Region';
        $newnames['company_phone_number'] =  'Phone Number';
        $newnames['company_website'] =  'Website';
        $newnames['student_university'] =  'University';
        $newnames['educator_university'] =  'University';

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {


            DB::beginTransaction();
            try{
                $membership_levels = [1 => 'associate', 2 => 'student', 3 => 'educator'];
                $membership_level = $membership_levels[$customer->membership_level];

                if($customer && $customer->membership_level == 1){
                    $customer->company_name = $input['company_name'];
                    $customer->title_for_function = $input['title_for_function'];
                    $customer->company_address = $input['company_address'];
                    $customer->company_country = $input['company_country'];
                    $customer->company_state = $input['company_state'];
                    $customer->company_city = $input['company_city'];
                    $customer->company_postal_code = $input['company_postal_code'];
                    $customer->company_region = $input['company_region'];
                    $customer->company_phone_number = $input['company_phone_number'];
                    $customer->company_website = $input['company_website'];
                }elseif($customer && $customer->membership_level == 2){
                     $customer->student_id = $input['student_id'];
                     $customer->student_university = $input['student_university'];
                     $customer->student_level = $input['student_level'];
                }elseif($customer && $customer->membership_level == 3){
                     $customer->educator_university = $input['educator_university'];
                     $customer->educator_role = $input['educator_role'];
                }
                $customer->steps = 2;
                $customer->save();

                DB::commit();

                $json['status'] = 1;
                $json['message'] = 'Step2 Completed Successfully';
                $json['redirect_url'] = url('register/'.$membership_level.'?register-token='.$customer->token.'&steps=3&register_id='.$customer->id);
            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = 'Something went wrong';
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
            return json_encode($json);
        }
        return json_encode($json);

    }


    function registerStep3(Request $request){
        $input  = $request->all();

        $rules = array(
            'payment_method' =>  'required|in:Online,Offline',
            //'same_as_address' =>  'required',
            'billing_address' =>  'required|not_allow_symbol|min:3|max:250',
            'billing_country' =>  'required|exists:countries,id',
            'billing_first_name' =>  'required|not_allow_symbol|min:3|max:50',
            'billing_last_name' =>  'required|not_allow_symbol|min:3|max:50',
            'billing_city' =>  'required|not_allow_symbol|min:3|max:50',
            'billing_postal_code' =>  'nullable|alpha_num|not_allow_symbol|min:3|max:15',
            'billing_region' =>  'required|exists:regions,id',
        );

        if(isset($input['billing_country']) && $input['billing_country'] == 231){
            $rules['billing_postal_code'] = 'required|alpha_num|not_allow_symbol|min:3|max:15';
        }

        $newnames = array(
            'billing_first_name' => 'First Name',
            'billing_last_name' => 'Last Name',
            'billing_address' => 'Address',
            'billing_country' => 'Country',
            'billing_state' => 'State',
            'billing_city' => 'City',
            'billing_postal_code' => 'Postal Code',
            'billing_phone_number' => 'Phone Number',
        );
        $messages = array();
        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {

            DB::beginTransaction();
            try{
                $checkdata = $customer = TempCustomer::where('token', $input['register-token'])->first();
                $membership_levels = [1 => 'associate', 2 => 'student', 3 => 'educator'];
                $membership_level = $membership_levels[$customer->membership_level];

                if(!$checkdata){
                    $json['status'] = 2;
                    $json['message'] = 'Something went wrong.';
                    return json_encode($json);
                }
                
                $customer->payment_method = $input['payment_method'];
                $customer->same_as_address = isset($input['same_as_address']) ? $input['same_as_address'] : 0;
                $customer->billing_first_name = $input['billing_first_name'];
                $customer->billing_last_name = $input['billing_last_name'];
                $customer->billing_address = $input['billing_address'];
                $customer->billing_country = $input['billing_country'];
                $customer->billing_state = $input['billing_state'];
                $customer->billing_city = $input['billing_city'];
                $customer->billing_postal_code = $input['billing_postal_code'];
                $customer->billing_region = $input['billing_region'];
                $customer->steps = 3;
                $customer->save();
                DB::commit();

                $json['status'] = 1;
                $json['message'] = 'Step3 Completed Successfully';
                $json['redirect_url'] = url('register/'.$membership_level.'?register-token='.$customer->token.'&steps=4&register_id='.$customer->id);
             } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = 'Something went wrong';
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return json_encode($json);

    }


    function registerStep4(Request $request){
        $input  = $request->all();


        $temp_data = $customer = TempCustomer::where('token', $input['register-token'])->first();
        if(!$temp_data){
            $json['status'] = 2;
            $json['message'] = 'Something went wrong.';
            return json_encode($json);
        }

        if($temp_data->payment_method == 'Online'){
            /**decrypt fields value***/
            $enckey=$input['enckey'];
            $Encryption = new Encryption();
        }

        $rules = [];
        $rules['accept_terms'] = 'required';

        $messages = array();
        $v = \Validator::make($input, $rules);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $checkdata = $customer = TempCustomer::where('token', $input['register-token'])->first();
                $membership_levels = [1 => 'associate', 2 => 'student', 3 => 'educator'];
                $membership_level = $membership_levels[$customer->membership_level];
                $membership_lvl = MembershipLevel::where('id', $customer->membership_level)->first();

                $striperesponse = false;
                if($temp_data->payment_method == 'Online'){
                    Stripe\Stripe::setApiKey(\ViewsHelper::getStripePaymentInfo('STRIPE_SECRET'));
                    $striperesponse = Stripe\Charge::create ([
                            "amount" => $membership_lvl->amount * 100,
                            "currency" => "usd",
                            "source" => $input['stripeToken'],
                            "description" => $membership_lvl->name
                    ]);
                }

                $customer->accept_terms = $input['accept_terms'];
                $customer->steps = 4;
                $customer->save();

               $maintableObj = $this->copyInMainTable($customer);

                //Auth::guard('customer')->loginUsingId($maintableObj->customer_id, true);
                $customer->delete();

                if($striperesponse && $striperesponse->paid == 1 && $temp_data->payment_method == 'Online'){
                    /*Transaction details added*/
                    $transObj = new Transaction();
                    $transObj->customer_id = $maintableObj->customer_id;
                    $transObj->payment_mode = 'Online';
                    $transObj->trans_id = $striperesponse->id;
                    $transObj->amount = $striperesponse->amount/100;
                    $transObj->payment_status = 'Paid';
                    $transObj->payment_date = date('Y-m-d H:i:s');
                    $transObj->save();

                    $start_date = date('Y-m-d');
                    $end_date = date('Y-m-d', strtotime('+ '.($membership_lvl->duration * 365).' days'));

                    $start_date = date('Y-m-01', strtotime($start_date));
                    $end_date = date('Y-m-t', strtotime($end_date));

                    if($maintableObj->activeMembershipLevel){
                        $maintableObj->activeMembershipLevel->current_membership = 0;
                        $maintableObj->activeMembershipLevel->save();
                    }


                    $custLevelObj = new CustomerMembershipLevel();
                    $custLevelObj->customer_id = $maintableObj->customer_id;
                    $custLevelObj->type = 1;
                    $custLevelObj->trans_id = $transObj->id;
                    $custLevelObj->payment_method = 'Online';
                    $custLevelObj->payment_status = 1;
                    $custLevelObj->level_id = $membership_lvl->id;
                    $custLevelObj->amount = $membership_lvl->amount;
                    $custLevelObj->designation = $membership_lvl->designation;
                    $custLevelObj->status = 0;
                    $custLevelObj->expire_duration = $membership_lvl->duration;
                    $custLevelObj->start_date = $start_date;
                    $custLevelObj->end_date = $end_date;
                    $custLevelObj->save();


                    $transObj->customer_membership_level = $custLevelObj->id;
                    $transObj->save();
                    
                    $maintableObj->customer_membership_level = $custLevelObj->id;
                    $maintableObj->save();

                    //Customer Activity Log
                    $custActivityArr['customer_id'] = $maintableObj->customer_id;
                    $custActivityArr['heading'] = 'Registered for Membership';
                    $custActivityArr['activity_date'] = date('Y-m-d H:i:s');
                    $custActivityArr['ref_type'] = 1;
                    $custActivityArr['ref_id'] = $transObj->id;;
                    
                    \App\Helpers\ActivityHelper::insertCustomerActivityLog($custActivityArr);


                    $json['status'] = 1;
                    $json['message'] = 'Step4 Completed Successfully';
                    $json['redirect_url'] = url('payment-success/'.base64_encode($transObj->id).'/'.base64_encode($maintableObj->customer_id));
                }else if ($temp_data->payment_method == 'Offline'){

                    $start_date = date('Y-m-d');
                    $end_date = date('Y-m-d', strtotime('+ '.($membership_lvl->duration * 365).' days'));

                    $start_date = date('Y-m-01', strtotime($start_date));
                    $end_date = date('Y-m-t', strtotime($end_date));


                    if($maintableObj->activeMembershipLevel){
                        $maintableObj->activeMembershipLevel->current_membership = 0;
                        $maintableObj->activeMembershipLevel->save();
                    }

                    $custLevelObj = new CustomerMembershipLevel();
                    $custLevelObj->customer_id = $maintableObj->customer_id;
                    $custLevelObj->type = 1;
                    $custLevelObj->payment_method = 'Offline';
                    $custLevelObj->payment_status = 0;
                    $custLevelObj->level_id = $membership_lvl->id;
                    $custLevelObj->amount = $membership_lvl->amount;
                    $custLevelObj->designation = $membership_lvl->designation;
                    $custLevelObj->expire_duration = $membership_lvl->duration;
                    $custLevelObj->status = 0;
                    $custLevelObj->start_date = $start_date;
                    $custLevelObj->end_date = $end_date;
                    $custLevelObj->save();

                    $maintableObj->customer_membership_level = $custLevelObj->id;
                    $maintableObj->save();


                    // Notification
                    $getNotifRoles = \ViewsHelper::getNotifRoles('member_view');
                    $ref_arr = \App\Models\User::whereIn('role_id', $getNotifRoles)->pluck('email', 'id')->toArray();
                    $notifArr['ref_arr'] = $ref_arr;
                    $notifArr['heading'] = 'New Member';
                    $notifArr['notification'] = 'A new member '.$maintableObj->full_name().' has registered in the system. Please click here to view the details. ';
                    $notifArr['view_url'] = 'admin/customers/view/'.base64_encode($maintableObj->customer_id);

                    \App\Helpers\NotificationHelper::addAdminNotif($notifArr);
                    
                    $this->sendNewMemberMailToAdmin($maintableObj, array_values($ref_arr));


                    //Customer Activity Log
                    $custActivityArr['customer_id'] = $maintableObj->customer_id;
                    $custActivityArr['heading'] = 'Registered for Membership';
                    $custActivityArr['activity_date'] = date('Y-m-d H:i:s');
                    $custActivityArr['ref_type'] = 1;
                    $custActivityArr['ref_id'] = null;
                    
                    \App\Helpers\ActivityHelper::insertCustomerActivityLog($custActivityArr);

                    $this->sendWelcomeMailOffline($maintableObj);

                    $json['status'] = 1;
                    $json['message'] = 'Step4 Completed Successfully';
                    $json['redirect_url'] = url('register-success/'.$maintableObj->signup_activation_key);

                }else{
                    $json['status'] = 2;
                    $json['message'] = 'Something went wrong.';
                    return json_encode($json);
                }

                DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = 'Something went wrong';
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return json_encode($json);

    }

    function copyInMainTable($tempCustomer){
        $customer = Customer::where('email', $tempCustomer->email)->first();
        if(!$customer){
            $customer = new Customer();
        }
        $customer->signup_activation_key = Str::random(100);;
        $customer->first_name = $tempCustomer->first_name;
        $customer->last_name = $tempCustomer->last_name;
        $customer->email = $tempCustomer->email;
        $customer->username = $tempCustomer->username;
        $customer->country_code = $tempCustomer->country_code;
        $customer->dial_code = $tempCustomer->dial_code;
        $customer->contact_number = $tempCustomer->phone_number;
        $customer->password = $tempCustomer->password;
        $customer->dob = $tempCustomer->dob;
        $customer->address = $tempCustomer->address;
        $customer->country = $tempCustomer->country;
        $customer->state = $tempCustomer->state;
        $customer->city = $tempCustomer->city;
        $customer->postal_code = $tempCustomer->postal_code;
        $customer->region = $tempCustomer->region;

        $customer->student_id = $tempCustomer->student_id;
        $customer->student_university = $tempCustomer->student_university;
        $customer->student_level = $tempCustomer->student_level;
        $customer->educator_university = $tempCustomer->educator_university;
        $customer->educator_role = $tempCustomer->educator_role;

        $customer->same_as_address = $tempCustomer->same_as_address;
        //$customer->payment_method = $tempCustomer->payment_method;
        $customer->membership_level = $tempCustomer->membership_level;
        $customer->accept_terms = $tempCustomer->accept_terms;

        $customer->password_set_at = date("Y-m-d H:i:s", strtotime("+90 day"));
        // $customer->challenging_rejection = $tempCustomer->challenging_rejection;
        // $customer->challenging_rejection_description = $tempCustomer->challenging_rejection_description;
        $customer->save();
        $customer->member_number = \CommonHelper::generateMemberNumber($customer->customer_id);
        $customer->save();


        $trackObj = new PasswordTrack();
        $trackObj->type = 1;
        $trackObj->ref_id = $customer->customer_id;
        $trackObj->password = $customer->password;
        $trackObj->updated_at = date('Y-m-d H:i:s');
        $trackObj->save();

        $billingAddObj = BillingAddress::where('customer_id', $customer->customer_id)->first();
        if(!$billingAddObj){
            $billingAddObj = new BillingAddress();
        }

        $billingAddObj->customer_id = $customer->customer_id;
        $billingAddObj->first_name = $tempCustomer->billing_first_name;
        $billingAddObj->last_name = $tempCustomer->billing_last_name;
        $billingAddObj->address = $tempCustomer->billing_address;
        $billingAddObj->country = $tempCustomer->billing_country;
        $billingAddObj->state = $tempCustomer->billing_state;
        $billingAddObj->city = $tempCustomer->billing_city;
        $billingAddObj->postal_code = $tempCustomer->billing_postal_code;
        $billingAddObj->region = $tempCustomer->billing_region;
        $billingAddObj->save();
        
        if($tempCustomer->membership_level == 1){
            $companyAddObj = CompanyAddress::where('customer_id', $customer->customer_id)->first();
            if(!$companyAddObj){
                $companyAddObj = new CompanyAddress();
            }
            $companyAddObj->customer_id = $customer->customer_id;
            $companyAddObj->company_name = $tempCustomer->company_name;
            $companyAddObj->title_for_function = $tempCustomer->title_for_function;
            $companyAddObj->address = $tempCustomer->company_address;
            $companyAddObj->country = $tempCustomer->company_country;
            $companyAddObj->state = $tempCustomer->company_state;
            $companyAddObj->city = $tempCustomer->company_city;
            $companyAddObj->postal_code = $tempCustomer->company_postal_code;
            $companyAddObj->region = $tempCustomer->company_region;
            $companyAddObj->website = $tempCustomer->company_website;
            $companyAddObj->phone_number = $tempCustomer->company_phone_number;
            $companyAddObj->save();
        }
        return $customer;
    }


    function ajaxloadstate(Request $request){
        $input = $request->all();
        $country_id = $input['country_id'];
        $states = State::where('country_id', $country_id)->orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $json['status'] = 1;
        $json['message'] = '';
        $json['states'] = $states;
        return json_encode($json);
    }

    function paymentSuccess(Request $request, $transId, $customerId){
        $transId = base64_decode($transId);
        $customerId = base64_decode($customerId);
        $checkTrans = Transaction::where('id', $transId)->where('customer_id', $customerId)->first();
        if(!$checkTrans){
            return abort(404);
        }
        $customer = Customer::where('customer_id', $customerId)->first();

        // Notification
        $getNotifRoles = \ViewsHelper::getNotifRoles('member_view');
        $ref_arr = \App\Models\User::whereIn('role_id', $getNotifRoles)->pluck('email', 'id')->toArray();
        $notifArr['ref_arr'] = $ref_arr;
        $notifArr['heading'] = 'New Member';
        $notifArr['notification'] = 'A new member '.$customer->full_name().' has registered in the system. Please click here to view the details. ';
        $notifArr['view_url'] = 'admin/customers/view/'.base64_encode($customer->customer_id);

        \App\Helpers\NotificationHelper::addAdminNotif($notifArr);

        $this->sendNewMemberMailToAdmin($customer, array_values($ref_arr));


        //Customer Activity Log
        // $custActivityArr['customer_id'] = $customer->customer_id;
        // $custActivityArr['heading'] = 'Registered for Membership';
        // $custActivityArr['activity_date'] = date('Y-m-d H:i:s');
        // // $custActivityArr['sub_heading'] = 1;
        // // $custActivityArr['ref_type'] = \Auth::user()->id;
        // // $custActivityArr['ref_id'] = \Auth::user()->id;
        // // $custActivityArr['view_url'] = \Auth::user()->id;

        // \App\Helpers\ActivityHelper::insertCustomerActivityLog($custActivityArr);

        $this->sendWelcomeMailOnline($customer, $checkTrans);
        return redirect('register-success/'.$customer->signup_activation_key);

    }

    function sendWelcomeMailOffline($obj, $transdata = null) {
        $emailtemplate = \App\Models\EmailTemplate::where('template_slug', 'welcome_mail_offline')->first();
        $link = url('confirm-account/' . $obj->signup_activation_key);
        $replace_macros = array(
          '{FIRST_NAME}' => $obj->first_name,
          '{FULL_NAME}' => $obj->full_name(),
          '{VERIFY_BUTTON}' => CommonHelper::setLink($link, 'Verify Email'),
          '{LOGIN_LINK}' => url('login'),
        );
        $template_html = \CommonHelper::setEmailTemplateContent($emailtemplate->body, $replace_macros);


        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = $emailtemplate->subject;
        $mailObj->template_id = $emailtemplate->id;
        $mailObj->toEmail = $obj->email;
        $html = $mailObj->sendmail("emails.dynamic_template", ['template_html' => $template_html]);
    }

    function sendWelcomeMailOnline($obj, $transdata = null) {
        $emailtemplate = \App\Models\EmailTemplate::where('template_slug', 'welcome_mail_online')->first();
        $link = url('confirm-account/' . $obj->signup_activation_key);
        $replace_macros = array(
          '{FIRST_NAME}' => $obj->first_name,
          '{FULL_NAME}' => $obj->full_name(),
          '{VERIFY_BUTTON}' => CommonHelper::setLink($link, 'Verify Email'),
          '{MEMBERSHIP_NAME}' => ($obj->activeMembershipLevel) ? $obj->activeMembershipLevel->MembershipLevel->name : 'N/A',
          '{LOGIN_LINK}' => url('login'),
        );
        $template_html = \CommonHelper::setEmailTemplateContent($emailtemplate->body, $replace_macros);


        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = $emailtemplate->subject;
        $mailObj->template_id = $emailtemplate->id;
        $mailObj->toEmail = $obj->email;
        if($transdata){
            CommonHelper::add_attachment($mailObj, $transdata);
        }
        $html = $mailObj->sendmail("emails.dynamic_template", ['template_html' => $template_html]);
    }

    function sendNewMemberMailToAdmin($customer, $emails) {

        $emailtemplate = \App\Models\EmailTemplate::where('template_slug', 'new_customer_mail_to_admin')->first();
        
        $replace_macros = array(
          '{CUSTOMER_NAME}' => $customer->full_name(),
          '{LOGIN_LINK}' => url('admin/login'),
        );
        $template_html = \CommonHelper::setEmailTemplateContent($emailtemplate->body, $replace_macros);


        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = $emailtemplate->subject;
        $mailObj->template_id = $emailtemplate->id;
        $mailObj->toEmail = $emails;

        $html = $mailObj->sendmail("emails.dynamic_template", ['template_html' => $template_html]);
        return $html;
    }



    function registerSuccess(Request $request, $token){
        $customerdata = Customer::where('signup_activation_key', $token)->first();
        if(!$customerdata){
            return abort(404);
        }

        if($customerdata->activeMembershipLevel->payment_status == 0 && $customerdata->activeMembershipLevel->status == 0){
            return view('frontend.auth.register_success', ['page_view' => 'payment_pending']);
        } 
        if($customerdata->activeMembershipLevel->payment_status == 1 && $customerdata->activeMembershipLevel->status == 0){
            return view('frontend.auth.register_success', ['page_view' => 'approval_pending']);
        }
        return redirect('dashboard');
        //return view('frontend.auth.register_success', ['customerdata' => $customerdata]);
    }

    function thankYou(Request $request){
        if(!Auth::guard('customer')->check()){
            return redirect('login');
        }

        if(Auth::guard('customer')->user()->activeMembershipLevel->payment_status == 0 && Auth::guard('customer')->user()->activeMembershipLevel->status == 0){
            return view('frontend.auth.thankYou', ['page_view' => 'payment_pending']);
        } 
        if(Auth::guard('customer')->user()->activeMembershipLevel->payment_status == 1 && Auth::guard('customer')->user()->activeMembershipLevel->status == 0){
            return view('frontend.auth.thankYou', ['page_view' => 'approval_pending']);
        }
        
        return redirect('dashboard');
    }


    function thankUnauthorized(Request $request){
        if(!Auth::guard('customer')->check()){
            return redirect('login');
        }

        if(Auth::guard('customer')->user()->activeMembershipLevel->status == 2){
            return view('frontend.auth.almfc_unauthorized', ['page_view' => 'membeship_reject', 'data' => Auth::guard('customer')->user()]);
        }else if(Auth::guard('customer')->user()->activeMembershipLevel->status == 3){
            return view('frontend.auth.almfc_unauthorized', ['page_view' => 'membership_cancel', 'data' => Auth::guard('customer')->user()]);
        }



        return redirect('dashboard');
    }

    function printTermsCondition(Request $request){
        $input = $request->all();
        $html = view('frontend.auth.registeration_condition',['input' => $input]);
        $html = $html->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function checkRejectedMember(Request $request){
        $input = $request->all();
        $email = (isset($input['email'])) ? $input['email'] : null;
        $customer = Customer::where('email', $email)->first();
        if($customer && $customer->activeMembershipLevel->status == 2){
            $json['status'] = 1;
            $json['message'] = 'Loaded..';
            $json['customerdata'] = $customer;
            $json['customerdata']['dob'] = date('d-m-Y', strtotime($customer->dob));
            $json['states'] = State::where('country_id', $customer->country)->orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        }else{
            $json['status'] = 0;
            $json['message'] = 'Loaded..';
        }
        return json_encode($json);
    }
}