<?php
namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use App\Helpers\CommonHelper;
use App\Helpers\MailFunctions;
use DB;
use Request;
use Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Traits\FileUploadTrait;

Class Customer extends Authenticatable{

    use FileUploadTrait;

    protected $table = 'customers';
    public $primaryKey = "customer_id";


    /*
      All model relations arrives here
    
    */
   

    function full_name(){
        return $this->first_name . ' ' . $this->last_name;
    }


    function getByKey($id){
        return $this->where($this->primaryKey, $id)->first();
    }

    function getcountry(){
        return $this->belongsTo('App\Models\Country', 'country', 'country_id');
    }  

    function getstate(){
        return $this->belongsTo('App\Models\State', 'state', 'state_id');
    }


    function displayAttachment(){
        $file = $this->attachment;
        $explodeArr = explode('/', $file);
        return end($explodeArr);
    }

    function attachments(){
      return $this->hasMany('App\Models\Attachment', 'ref_id', 'customer_id')->where('type', 'CUSTOMER_GALLARY');
    }
    function getAttachmentArr(){
      return Attachment::where('ref_id', $this->customer_id)->where('type', 'CUSTOMER_GALLARY')->pluck('attachment')->toArray();
    }

    function displayAttachmentsHtml(){
        $html = '';
        $attachdata = Attachment::where('ref_id', $this->customer_id)->where('type', 'CUSTOMER_GALLARY')->get();
        foreach($attachdata as $attach){
            $html .= '<div class="col-sm-2"><div class="documentfileContainer" data-key="'.$attach->attachment.'"><img src="'.url($attach->attachment).'" class="img-fluid mb-2" alt="white sample"><a href="#" class="removeImgBtn"><i class="fa fa-times removeUploadFile"></i></a></div></div>';
        }

        return $html;
    }
 


    function displayPhoneNumber(){
        if($this->phone_number){
            return '+'.$this->dial_code.'-'.$this->phone_number;
        }
        return 'N/A';
    }

    function displayAddress(){
        $html = $this->address. ', '.$this->city. ', ';
        
        if($this->getstate){
            $html = $html.$this->getstate->name. ', ';
        }

        if($this->getcountry){
            $html = $html.$this->getcountry->name. '-';
        }

        $html = $html.$this->zip_code;
        return $html;
    }

    function getDetailsPageUrl(){
        return url('volunteer/info/'.str_replace(' ', '-', strtolower($this->full_name())).'/'.base64_encode($this->customer_id));
    }

    /* Profile Complete Percentage */
     function getProfileComplitionPerc(){
        $single_perc = 100/3;
        $perc = $single_perc * $this->profile_steps;
        $perc = round($perc);
        if($perc >= 100){
            return 100;
        }
        return $perc;
    }

    
    function resetPassEmailAdmin($input)
    {
        $custObj = new Customer();
        $data = $custObj->where('customer_id', $input['customer_id'])->first();
        $data->reset_key = CommonHelper::getEncryptedKey();    //set unique reset password key
        $data->update();
        $this->sendPasswordResetEmail($data);

    }

    function changePassword($input)
    {
        $rules = array(
            'old_password' => 'required|min:6|max:20',
            'new_password' => 'required|strong_password|min:6|max:20',
            'confirm_password' => 'required|same:new_password',
        );
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        if ($v->passes())
        {
            $userdata = Auth::guard('customer')->user();
            
            if (Hash::check($input['new_password'], $userdata->password)){
                $json['status'] = 2;
                $json['message'] = "New password cannot be same as previous old passwords.";
                return $json;
            }

            if (!Hash::check($input['old_password'], $userdata->password))
            {
                $json['status'] = 2;
                $json['message'] = trans('messages.error_changepassword');
            }
            else
            {
                $userdata->password = Hash::make(trim($input['new_password']));
                $userdata->save();
                $json['status'] = 1;
                $json['message'] = trans('messages.success_changepassword');
                $json['redirect_url'] = url('dashboard');
            }
        }
        else
        {
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
            'email' => 'required|email:rfc,dns|min:6|max:100',
        );
        $newnames = array(
            'email' => "Email",
        );
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes())
        {
            $custObj = new Customer();
            $data = $custObj->where('email', $input['email'])->first();
            if (!empty($data))
            {
                $data->reset_key = CommonHelper::getEncryptedKey();
                $data->update();
                $this->sendForgetPasswordEmail($data);
                $json['status'] = 1;
                $json['message'] = trans('messages.customer_success_sendmail_resetpassword');
            }
            else
            {
                $json['status'] = 0;
                $json['message'] = $v->errors()
                    ->add('email', "This account does not exist.");
            }
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    function submitResetPassword($input)
    {
        $rules = array(
            'new_password' => 'required|strong_password|min:6|max:20',
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
            $updata = Customer::where('reset_key', $input['reset_key'])->first();
            if (!empty($updata))
            {
                $password = $input['new_password'];
                $updata->password = Hash::make($password);
                $updata->reset_key = "";
                $updata->password_set = 1;
                $updata->save();
                $json['status'] = 1;
                $json['message'] = trans('messages.success_changepassword');
                $json['redirect_url'] = url('login');
            }
            else
            {
                $json['status'] = 2;
                $json['message'] = trans('messages.user_error_not_valid');
            }
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

     function sendForgetPasswordEmail($userObj){

        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = 'Forget Password';
        $mailObj->toEmail = $userObj->email;
        $html = $mailObj->sendmail("emails.frontend.reset_password", ['userObj' => $userObj]);
        return $html;
    }

    function sendPasswordResetEmail($userObj){

        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = 'Create Password';
        $mailObj->toEmail = $userObj->email;
        $html = $mailObj->sendmail("emails.frontend.user_create_password", ['userObj' => $userObj]);
        return $html;
    }

    function addNew($input){
        $customer = Customer::where('customer_id', $input['customer_id'])->first();
        $rules = array(
            'profile_image' => 'nullable|mimes:jpeg,jpg,png',
            'first_name' =>  'required|not_allow_symbol|min:3|max:50',
            'last_name' =>  'required|not_allow_symbol|min:3|max:50',
            'country_code' => 'required|not_allow_symbol',
            'dial_code' => 'required|not_allow_symbol',
            'phone_number' =>  'required|numeric|digits_between:7,15',
            'occupation' => 'required|not_allow_symbol|min:3|max:250',
            'about_me' => 'required|not_allow_symbol|min:3|max:5000',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'google_url' => 'nullable|url',
            'address' => 'nullable|not_allow_symbol|min:3|max:250',
            'country' => 'required|exists:countries,country_id',
            'state' => 'required|exists:states,state_id',
            'city' => 'required|not_allow_symbol|min:3|max:50',
            'zipcode' => 'required|alpha_num|min:2|max:10',
            'dob' => 'required',
            'gender' => 'required'
        );

        if(!$customer){
            $rules['email'] = 'required|email:rfc,dns|min:8|max:100|unique:customers,email,' . $input['customer_id'] . ',customer_id';
        }

        $messages = array();
        $newnames = array();

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                if(!$customer){
                    $customer = new Customer();
                    $customer->signup_activation_key = Str::random(100);;
                    $customer->email = $input['email'];
                }
                $customer->first_name = $input['first_name'];
                $customer->last_name = $input['last_name'];
                $customer->country_code = $input['country_code'];
                $customer->dial_code = $input['dial_code'];
                $customer->phone_number = $input['phone_number'];
                $customer->dob = date('Y-m-d', strtotime($input['dob']));
                $customer->gender = $input['gender'];
                $customer->occupation = $input['occupation'];
                $customer->about_me = $input['about_me'];
                $customer->facebook_url = $input['facebook_url'];
                $customer->twitter_url = $input['twitter_url'];
                $customer->instagram_url = $input['instagram_url'];
                $customer->google_url = $input['google_url'];
                $customer->country = $input['country'];
                $customer->state = $input['state'];
                $customer->city = $input['city'];
                $customer->zip_code = $input['zipcode'];
                $customer->address = $input['address'];
                if (!empty($input['profile_image'])) {
                    $uploaded = $this->uploadImage($input['profile_image']);
                    if ($uploaded['status'] == 0) {
                        $json['error'] = 2;
                        $json['error_mess'] = $uploaded['error'];
                        return $json;
                    }
                    if ($uploaded['status'] == 1) {
                        $customer->profile_image = $uploaded['file_name'];
                    }
                }
                $customer->status = 1;
                $customer->save();

                if ($customer->status == 1 && $customer->password_set == 0){
                    //send create password mail to user
                    $customer->reset_key = Str::random(100);
                    $customer->save();
                    $this->sendPasswordResetEmail($customer);
                }
                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Saved Successfully';
                $json['redirect_url'] = url('admin/customers');
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    function updateStatus($input){
        $updata = Customer::where('customer_id', $input['customer_id'])->first();
        if($updata){
            $updata->updated_at = date('Y-m-d H:i:s');
            $updata->status = $input['status'];
            $updata->save();

            if ($updata->status == 1 && $updata->password_set == 0){
                //send create password mail to user
                $updata->reset_key = Str::random(100);
                $updata->save();
                $this->sendPasswordResetEmail($updata);
            }
            $json['status'] = 1;
            $json['message'] = 'Saved Successfully';
            $json['redirect_url'] = url('admin/customers');
            $json['success'] = 1;
        }else{
            $json['status'] = 2;
            $json['message'] = 'Customer not found.';
        }
        return $json;
    }

    function personalInfoFrm($input){
        $customer = Auth::guard('customer')->user();
        $rules = array(
            'first_name' =>  'required|not_allow_symbol|min:3|max:50',
            'last_name' =>  'required|not_allow_symbol|min:3|max:50',
            'dob' =>  'required|date',
            'gender' =>  'required|in:1,2,3,4',
            'nationality' => 'required|not_allow_symbol|min:3|max:500',
            'about_me' => 'required|not_allow_symbol|min:3|max:5000'
        );
        $messages = array();
        $newnames = array();

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                if(!$customer){
                   $json['status'] = 2;
                   $json['message'] = 'Something went wrong';
                   return $json;
                }
                $customer->first_name = $input['first_name'];
                $customer->last_name = $input['last_name'];
                $customer->dob = date('Y-m-d', strtotime($input['dob']));
                $customer->gender = $input['gender'];
                $customer->nationality = $input['nationality'];
                $customer->about_me = $input['about_me'];
                $customer->save();
                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Saved Successfully';
                $json['redirect_url'] = url('application');
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }


    function contactDetailsFrm($input){
        $customer = Auth::guard('customer')->user();
        $rules = array(
            'phone_number' => 'required|numeric|digits_between:7,15',
            'address1' => 'required|not_allow_symbol|min:3|max:250',
            'address2' => 'required|not_allow_symbol|min:3|max:250',
            'country' => 'required|exists:countries,country_id',
            'city' => 'required|not_allow_symbol|min:3|max:50',
            'zip_code' => 'required|alpha_num|min:2|max:10',
            'email' => 'required|email:rfc,dns|min:8|max:100|unique:customers,email,' . $input['customer_id'] . ',customer_id',
        );

        $messages = array();
        $newnames = array();

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $customer->email = $input['email'];
                $customer->phone_number = $input['phone_number'];
                $customer->address1 = $input['address1'];
                $customer->address2 = $input['address2'];
                $customer->country = $input['country'];
                $customer->city = $input['city'];
                $customer->zip_code = $input['zip_code'];
                $customer->save();
                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Saved Successfully';
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    function studiesDetailsFrm($input){
        $customer = Auth::guard('customer')->user();
        $rules = array(
            'university' => 'required|not_allow_symbol|min:3|max:250',
            'degree_title' => 'required|not_allow_symbol|min:3|max:250',
            'year_of_study' => 'required|in:1,2,3,4,5,6',
            'graduation_date' => 'required|date_format:Y',
        );

        $messages = array();
        $newnames = array();

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $customer->university = $input['university'];
                $customer->degree_title = $input['degree_title'];
                $customer->year_of_study = $input['year_of_study'];
                $customer->graduation_date = $input['graduation_date'];
                $customer->save();
                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Saved Successfully';
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    function socialFrm($input){
        $customer = Auth::guard('customer')->user();

        if(!$input['facebook_url'] && !$input['twitter_url'] && !$input['instagram_url'] && !$input['google_url']){
            $json['status'] = 2;
            $json['message'] = 'Please select atleast one social url';
            return $json;
        }

        $rules = array(
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'google_url' => 'nullable|url'
        );

        $messages = array();
        $newnames = array();

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $customer->facebook_url = $input['facebook_url'];
                $customer->twitter_url = $input['twitter_url'];
                $customer->instagram_url = $input['instagram_url'];
                $customer->google_url = $input['google_url'];
                $customer->save();
                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Saved Successfully';
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }


    function submitProfilePicForm($input){
      $rules = array(
            'profile_image' => 'required|mimes:jpeg,jpg,png',
        );
        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);

        if ($v->passes()) {
         if (!empty($input['profile_image'])){
                $uploaded = $this->uploadImage($input['profile_image']);
                if ($uploaded['status'] == 0){
                    $json['error'] = 2;
                    $json['error_mess'] = $uploaded['error'];
                }else{
                  $data = Auth::guard('customer')->user();
                    $data->profile_image = $uploaded['file_name'];
                    $data->save();
                    $json['status'] = 1;
                    $json['message'] = 'Profile image updated successfully';
                    $json['avatar'] = \ViewsHelper::displayUserProfileImage($data);
                }
            }else{
               $json['error'] = 2;
                $json['error_mess'] = 'File does not exist.';
            }
        }else{
         $json['status'] = 0;
            $json['message'] = $v->messages();
        }

        return $json;
   }

    function uploadImage($file, $id = false) {
        $imgConf = Config::get("params.customer_image");
        $allowed = $imgConf['mimes'];
        $mimeType = $file->getMimeType();
        if (!in_array($mimeType, $allowed)) {
            return array("status" => 0, 'error' => 'Image should be a .jpg or a .png file . Recommended file size should be maximum 2.5MB');
        }

        $path = base_path($imgConf['base_path']);
        if (!is_dir($path)) {
            umask(0);
            mkdir($path, 0777, true);
            chmod($path, 0777); //incase mkdir fails
            
        }
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $fileName = time() . "_" . rand(11111, 99999) . "_" . time() . '.' . $extension; // renameing image
        $file->move($path, $fileName); // uploading file to given path
        if ($file->isValid()) {
            return array("status" => 0, 'error' => $file->getError());
        }
        
        return array('status' => 1, 'file_name' => $fileName, 'path' => $path);
    }



    function gallaryFrm($input) {
        $customerdata = Auth::guard('customer')->user();
        $input['attachments'] = explode(',', $input['attachments']);
        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'gallary_type' => 'required|in:public,private', 
        );

        $newnames = array();
        $rules['attachments'] = 'nullable|array';
        $rules['attachments.*'] = 'nullable';

        if(isset($input['attachments'])){
            foreach($input['attachments'] as $key => $document_file){
               $newnames['attachments.' . $key] = 'Attachments';
            }
        }
        
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $customerdata->gallary_type = $input['gallary_type'];
                $customerdata->save();

                if(isset($input['attachments']) && count($input['attachments']) > 0){
                    $newUploadFiles = $input['attachments'];
                    $existUploadFiles = Attachment::where('ref_id', $customerdata->customer_id)->where('type', 'CUSTOMER_GALLARY')->pluck('attachment', 'id')->toArray();
                    foreach($existUploadFiles as $docId => $attachment){
                      if(!in_array($attachment, $input['attachments'])){
                            unset($existUploadFiles[$docId]);
                            $filePath = base_path($attachment);
                            if(file_exists($filePath)){
                                @unlink($filePath);
                            }
                          Attachment::where('id', $docId)->delete();
                      }
                    }
                    $insertedArr = array_diff($newUploadFiles, $existUploadFiles);

                    if(count($insertedArr) > 0){
                      foreach($insertedArr as $singleFile){
                        if($singleFile){
                          $attachObj = new Attachment();
                          $attachObj->type = 'CUSTOMER_GALLARY';
                          $attachObj->ref_id = $customerdata->customer_id;
                          $attachObj->attachment = $singleFile;
                          $attachObj->save();
                          //File upload Job dispatch
                        }

                      }
                    }
                }else{
                    Attachment::where('ref_id', $customerdata->customer_id)->where('type', 'CUSTOMER_GALLARY')->delete();
                }

                $json['message'] = 'Saved successfully';
                $json['status'] = 1;
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        } else {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    function short_about_me($length = 50) {
        $desc = $this->about_me;
        if (strlen($desc) > $length) {
            $desc = strip_tags(CommonHelper::htmldata($desc));
            return substr($desc, 0, $length) . "...";
        }
        return strip_tags(CommonHelper::htmldata($desc));
    }


    function quickContactFrm($input){
        $data = Customer::where('customer_id', $input['customer_id'])->first();
        if (!$data){
           $json['status'] = 2;
           $json['message'] = 'You have tried contact to invalid volunteer.';
           return $json;
        }

        $rules = array(
            'subject' => 'required|not_allow_symbol|min:3|max:1000',
            'message' => 'required|not_allow_symbol|min:3|max:5000',
        );
        $newnames = array(
            'email' => "Email",
        );
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()){
            $this->quickContactMail($data, $input);
            $json['status'] = 1;
            $json['message'] = 'Mail sent Successfully.';
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

    function quickContactMail($customerdata, $input){

        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = 'Quick Contact';
        $mailObj->toEmail = $customerdata->email;
        $html = $mailObj->sendmail("emails.frontend.quick_contact_mail", ['customerdata' => $customerdata, 'input' => $input]);
        return $html;
    }
}