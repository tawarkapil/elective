<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Config;
use Stripe;
use Auth;

class Application extends Base {

    protected $table = 'applications';
    public $primaryKey = "id";


    function getprogram(){
        return $this->hasOne('App\Models\Program', 'id', 'program');
    }

    function getdestination(){
        return $this->hasOne('App\Models\Destination', 'id', 'destination');
    }

    function personalInfoFrm($input){

        $rules = array(
            'first_name' =>  'required|not_allow_symbol|min:3|max:50',
            'last_name' =>  'required|not_allow_symbol|min:3|max:50',
            'dob' =>  'required|date',
            'gender' =>  'required|in:1,2,3,4',
            'nationality' => 'required|not_allow_symbol|min:3|max:500',
            'phone_number' => 'required|numeric|digits_between:7,15',
            'address1' => 'required|not_allow_symbol|min:3|max:250',
            'address2' => 'required|not_allow_symbol|min:3|max:250',
            'country' => 'required|exists:countries,country_id',
            'city' => 'required|not_allow_symbol|min:3|max:50',
            'zip_code' => 'required|alpha_num|min:2|max:10',
            //'email' => 'required|email:rfc,dns|min:8|max:100',
            'university' => 'required|not_allow_symbol|min:3|max:250',
            'degree_title' => 'required|not_allow_symbol|min:3|max:250',
            'year_of_study' => 'required|in:1,2,3,4,5,6',
            'graduation_date' => 'required|date_format:Y',
            'accept_terms_condition' => 'required|in:Yes',
        );

        $messages = array();
        $newnames = array();

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $appobj = Application::where('customer_id', $input['customer_id'])->firstOrNew();
                $appobj->customer_id = $input['customer_id'];
                $appobj->first_name = $input['first_name'];
                $appobj->last_name = $input['last_name'];
                $appobj->dob = date('Y-m-d', strtotime($input['dob']));
                $appobj->gender = $input['gender'];
                $appobj->nationality = $input['nationality'];
                $appobj->email = $input['email'];
                $appobj->phone_number = $input['phone_number'];
                $appobj->address1 = $input['address1'];
                $appobj->address2 = $input['address2'];
                $appobj->country = $input['country'];
                $appobj->city = $input['city'];
                $appobj->zip_code = $input['zip_code'];
                $appobj->university = $input['university'];
                $appobj->degree_title = $input['degree_title'];
                $appobj->year_of_study = $input['year_of_study'];
                $appobj->graduation_date = $input['graduation_date'];
                $appobj->save();
                if($appobj->step < 1){
                    $appobj->step = 1;
                    $appobj->save();
                }
                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Saved successfully.';
                $json['redirect_url'] = url('application/step/about-trip');
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

    function submitFrm($input){
        
        $rules = [];
        $rules['program'] =  'required';
        $rules['destination'] =  'required';
        $rules['trip_start_date'] =  'required|date';
        $rules['duration'] =  'required|integer|min:1|max:20';
        //$rules['education'] =  'required';
        $rules['educational_credits'] =  'required|in:Yes,No';
        $rules['preferences_allergies'] =  'required|max:255';
        $rules['other_preferences'] =  'required|max:255';

        $messages = array();
        $newnames = array();

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{

                $obj = Application::where('customer_id', $input['customer_id'])->first();
                if(!$obj){
                    $json['status'] = 2;
                    $json['message'] = 'Invalid Application selected';
                    return $json;
                }
                $obj->program =  $input['program'];
                $obj->destination =  $input['destination'];
                $obj->trip_start_date =  date('Y-m-d', strtotime($input['trip_start_date']));
                $obj->duration =  $input['duration'];
                $obj->educational_credits =  $input['educational_credits'];
                $obj->preferences_allergies =  $input['preferences_allergies'];
                $obj->other_preferences =  $input['other_preferences'];
                $obj->save();
                
                if($obj->step < 2){
                    $obj->step = 2;
                    $obj->save();
                }

                DB::commit();
                $json['status'] = 1;
                $json['message'] = 'Saved successfully.';
                $json['redirect_url'] = url('application/step/summary');
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

    function stripepayment($input){
        $rules['stripeToken'] = 'required';
        $messages = array();
        $newnames = array();
        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $input['customer_id'] = 1;

                $data = Application::where('customer_id', $input['customer_id'])->first();

                if(!$data || ($data && $data->accept_terms_condition != 'Yes')){
                    $json['status'] = 2;
                    $json['message'] = $e->getMessage();
                }

                $total_payable_amt = $data->payable_amount;
                $striperesponse = false;

                Stripe\Stripe::setApiKey(Config::get('stripe.secret_key'));
                $striperesponse = Stripe\Charge::create([
                    "amount" => $total_payable_amt * 100,
                    "currency" => "usd",
                    "source" => $input['stripeToken'],
                ]);
                
                $obj = new Transaction();
                $obj->payment_token = Str::random(105);
                $obj->customer_id = $data->customer_id;
                $obj->application_id = $data->id;
                $obj->transaction_id = strtoupper($striperesponse->id);
                $obj->payment_type = 'Stripe';
                $obj->payment_amount = $total_payable_amt;
                $obj->payment_date = date('Y-m-d H:i:s');
                $obj->status = 1;
                $obj->save();
                $obj->invoice_number = 'INV-'.$obj->id;
                $obj->save();

                DB::commit();
                $json['status'] = 1;
                $json['redirect_url'] = url('payment-success/'.$obj->payment_token);
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

    function parse_size($size) {
      $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
      $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
      if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
      }
      else {
        return round($size);
      }
    }

    function studentDocumentsUpload($input){

        $rules = array(
            'document_type' => 'required',
            'student_doc_type' => 'required',
            'document_file' => 'required',
        );
        $newnames = array();
        $messages = array();

        if (!empty($input['document_file'])){

            $getServerMaxFileSize = ini_get('upload_max_filesize');
            $uploadSize = $input['document_file']->getSize();
            
            if($this->parse_size($getServerMaxFileSize) < $uploadSize || !$uploadSize){
                $json['status'] = 2;
                $json['message'] = 'File size should be less then to '.$getServerMaxFileSize;
                return $json;
            }
        }
        
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()){

            DB::beginTransaction();
            try{
                $obj = $data = StudentDocument::where('customer_id', Auth::guard('customer')->user()->customer_id)
                ->where('document_type', $input['document_type'])
                ->where('student_doc_type', $input['student_doc_type'])
                ->firstOrNew();

                $obj->document_type = $input['document_type'];
                $obj->customer_id = Auth::guard('customer')->user()->customer_id;
                $obj->student_doc_type = $input['student_doc_type'];
                $obj->document_name = $input['document_file']->getClientOriginalName();
                if (!empty($input['document_file'])) {
                    $uploaded = $this->uploadDocuments($input['document_file'], $data);
                    if ($uploaded['status'] == 0) {
                        $json['error'] = 2;
                        $json['error_mess'] = $uploaded['error'];
                        return $json;
                    }
                    if ($uploaded['status'] == 1) {
                        $obj->document_path = $uploaded['file_name'];
                    }
                }
                $obj->save();


                $json['status'] = 1;
                $json['message'] = 'Uploaded successfully';
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        }else{
            $json['status'] = 2;
            $json['message'] = $v->errors()->first();
        }
        return $json;
    }

    function uploadDocuments($file, $data=null){
        $uploadDir = strtoupper(date('dMY'));
        $tempPath = 'storage/uploads/'.$uploadDir;
        $path = storage_path('uploads/'.$uploadDir).'/';
        if (!is_dir($path)) {
            umask(0);
            mkdir($path, 0777, true);
            chmod($path, 0777); //incase mkdir fails
            
        }
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $fileName = rand(111111, 999999).'_'.time(). '.' . $extension; // renameing image
        $file->move($path, $fileName); // uploading file to given path
        if ($file->isValid()) {
            return array("status" => 0, 'error' => $file->getError());
        }   
        return array('status' => 1, 'file_name' => $tempPath.'/'.$fileName, 'path' => $path);
    }

}
