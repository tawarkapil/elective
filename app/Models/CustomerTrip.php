<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\MailFunctions;
use DB;
use Validator;
use Illuminate\Support\Str;
use Auth;
use Config;

class CustomerTrip extends Base{

    protected $table = 'cust_trips';
    public $primaryKey = 'id';

    function getcustomer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }

    function getprogram(){
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    }

    function getdestination(){
        return $this->belongsTo('App\Models\Destination', 'destination_id', 'id');
    }


    function updateStatus($input){
        $updata = CustomerTrip::where('id', $input['id'])->first();
        if($updata){
            $updata->updated_at = date('Y-m-d H:i:s');
            $updata->status = $input['status'];
            $updata->save();
            $json['status'] = 1;
            $json['message'] = 'Saved Successfully';
            $json['redirect_url'] = url('admin/blogs');
            $json['success'] = 1;
        }else{
            $json['status'] = 2;
            $json['message'] = 'Blog not found.';
        }
        return $json;
    }


    function getDetailsPageUrl(){
        return url('trips/info/'.str_replace(' ', '-', strtolower($this->title)).'/'.base64_encode($this->id));
    }

    function short_desc($length = 100) {
        $desc = $this->description;
        if (strlen($desc) > $length) {
            $desc = strip_tags(CommonHelper::htmldata($desc));
            return substr($desc, 0, $length) . "...";
        }
        return strip_tags(CommonHelper::htmldata($desc));
    }

    function short_title($length = 25) {
        $desc = $this->title;
        if (strlen($desc) > $length) {
            return substr($desc, 0, $length) . "...";
        }
        return $desc;
    }

    function uploadImage($file, $id = false) {
        $imgConf = Config::get("params.cust_trips_image");
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

    function addNew($input) {
        //$input['attachments'] = explode(',', $input['attachments']);
        if(isset($input['id'])){
            $data = $obj = $this->getByKey($input['id']);
        }
        
        $rules = array(
            'title' => 'required|not_allow_symbol|min:3|max:250', 
            'description' => 'required|not_allow_symbol|max:10000', 
        );
        $rules['image'] = 'required|mimes:jpeg,jpg,png';
        // if($data){
        //     $rules['image'] = 'nullable|mimes:jpeg,jpg,png';
        // }

        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                if (empty($data)) {
                    $obj = new CustomerTrip();
                }
                $obj->title = ucfirst($input['title']);
                $obj->customer_id = Auth::guard('customer')->user()->customer_id;
                $obj->description = $input['description'];
                $obj->application_id = $input['application_id'];
                
                if (!empty($input['image'])) {
                    $uploaded = $this->uploadImage($input['image']);
                    if ($uploaded['status'] == 0) {
                        $json['error'] = 2;
                        $json['error_mess'] = $uploaded['error'];
                        return $json;
                    }
                    if ($uploaded['status'] == 1) {
                        $obj->cover_image = $uploaded['file_name'];
                    }
                }
                $obj->save();
                
                $tripCustObj = TripCustomers::where('trip_id', $obj->id)->where('customer_id', $obj->customer_id)->firstOrNew();
                $tripCustObj->type = 1;
                $tripCustObj->trip_id = $obj->id;
                $tripCustObj->customer_id = $obj->customer_id;
                $tripCustObj->status = 1;
                $tripCustObj->save();

                $json['message'] = 'Saved successfully';
                $json['status'] = 1;
                $json['url'] = $obj->getDetailsPageUrl();
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



}