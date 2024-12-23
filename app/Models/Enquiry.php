<?php
namespace App\Models;


use Config;
use DB;
use App\Helpers\MailFunctions;

class Enquiry extends Base {
    public $num;
    protected $table = 'enquiry';
    public $primaryKey = "id";
    /*
      All model relations arrives here
    */

    function getByKey($key) {
        return $this->where($this->primaryKey, $key)->first();
    }

    function getprogram(){
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    } 

    function displayPhoneNumber(){
        if($this->phone_number){
            return '+'.$this->dial_code.'-'.$this->phone_number;
        }
        return 'N/A';
    }

    function addNew($input){
        $rules = [
            'subject' => 'required|not_allow_symbol|max:250', 
            'name' => 'required|not_allow_symbol|max:250', 
            'message' => 'required|not_allow_symbol|max:5000', 
            'email' => 'required|email|max:100', 
            'phone_number' => 'required|numeric|digits_between:10,15',
            'institution' => 'required|not_allow_symbol|max:250', 
            //'program' => 'required|not_allow_symbol|max:250', 
        ];
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $obj = new Enquiry();
                $obj->name = $input['name'];
                $obj->email = $input['email'];
                $obj->phone_number = $input['phone_number'];
                $obj->subject = $input['subject'];
                $obj->institution = $input['institution'];
                //$obj->program_id = $input['program'];
                $obj->message = $input['message'];
                $obj->save();
                $this->send_contact_mail_to_admin($obj);
                $json['status'] = 1;
                $json['message'] = "Thank you for contact us. We will contact with you soon.";
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
    
    function send_contact_mail_to_admin($contactdata) {
        $admin_data = User::where('role_id', 1)->first();
        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = sprintf("Contact Mail | " . \ViewsHelper::getConfigKeyData('website_title'));
        $mailObj->toEmail = $admin_data->email;
        $html = $mailObj->sendmail("emails.frontend.contact_to_admin_mail", ['contactdata' => $contactdata]);
        return $html;
    }
}