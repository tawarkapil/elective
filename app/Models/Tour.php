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

class Tour extends Base{

    protected $table = 'mst_tours';
    public $primaryKey = 'id';

     /*
      All model relations arrives here
    */
    function getByKey($key) {
        return $this->where($this->primaryKey, $key)->first();
    }

    function getdestination(){
        return $this->hasOne('App\Models\Destination', 'id', 'destination');
    }

     function displayAttachment(){
        $file = $this->attachment;
        $explodeArr = explode('/', $file);
        return end($explodeArr);
    }

    function attachments(){
      return $this->hasMany('App\Models\Attachment', 'ref_id', 'id')->where('type', 'Tour');
    }
    function getAttachmentArr(){
      return Attachment::where('ref_id', $this->id)->where('type', 'Tour')->pluck('attachment')->toArray();
    }

    function displayAttachmentsHtml(){
        $html = '';
        $attachdata = Attachment::where('ref_id', $this->id)->where('type', 'Tour')->get();
        foreach($attachdata as $attach){
            $html .= '<div class="col-sm-2"><div class="documentfileContainer" data-key="'.$attach->attachment.'"><img src="'.url($attach->attachment).'" class="img-fluid mb-2" alt="white sample"><a href="#" class="removeImgBtn"><i class="fa fa-times removeUploadFile"></i></a></div></div>';
        }

        return $html;

    }
    
    function addNew($input) {
        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'title' => 'required|not_allow_symbol|min:3|max:250', 
            'description' => 'required|not_allow_symbol|max:10000', 
            'itinerary_destination' => 'required|not_allow_symbol_desc|max:10000', 
            'what_included' => 'required|not_allow_symbol_desc|max:10000', 
            'what_to_expect' => 'required|not_allow_symbol_desc|max:10000', 
            'price_description' => 'required|not_allow_symbol_desc|max:10000', 
            'additional_information' => 'required|not_allow_symbol_desc|max:10000', 
            'destination' => 'required',
            'payment_amount' => 'required|numeric|min:1|max:10000',
            'status' => 'required|in:0,1'
        );

        $rules['image'] = 'required|mimes:jpeg,jpg,png';
        if($data){
            $rules['image'] = 'nullable|mimes:jpeg,jpg,png';
        }

        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                if (empty($data)) {
                    $obj = new Tour();
                }
                $obj->title = ucfirst($input['title']);
                $obj->destination = $input['destination'];
                $obj->payment_amount = $input['payment_amount'];
                $obj->description = $input['description'];
                $obj->itinerary_destination = $input['itinerary_destination'];
                $obj->what_included = $input['what_included'];
                $obj->what_to_expect = $input['what_to_expect'];
                $obj->price_description = $input['price_description'];
                $obj->additional_information = $input['additional_information'];
                $obj->status = $input['status'];
                if (!empty($input['image'])) {
                    $uploaded = $this->uploadImage($input['image']);
                    if ($uploaded['status'] == 0) {
                        $json['error'] = 2;
                        $json['error_mess'] = $uploaded['error'];
                        return $json;
                    }
                    if ($uploaded['status'] == 1) {
                        $obj->image = $uploaded['file_name'];
                    }
                }

                $obj->save();
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


    function uploadImage($file, $id = false) {
        $imgConf = Config::get("params.tour_image");
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

    function updateStatus($input){
        $updata = Tour::where('id', $input['id'])->first();
        if($updata){
            $updata->updated_at = date('Y-m-d H:i:s');
            $updata->status = $input['status'];
            $updata->save();
            $json['status'] = 1;
            $json['message'] = 'Saved Successfully';
            $json['redirect_url'] = url('admin/tours');
            $json['success'] = 1;
        }else{
            $json['status'] = 2;
            $json['message'] = 'Tour not found.';
        }
        return $json;
    }
    
    function deleteSelected($input) {
        DB::beginTransaction();
        try{
            $data = $this->getByKey($input['id']);
            if ($data) {
                $data->delete();
                $json['status'] = 1;
                $json['message'] = 'Deleted successfully';
            } else {
                $json['message'] = trans('messages.error.delete');
                $json['status'] = 0;
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $json['status'] = 2;
            $json['message'] = $e->getMessage();
        }
        return $json;
    }

    function getDetailsPageUrl(){
        return url('tours/info/'.str_replace(' ', '-', strtolower($this->title)).'/'.base64_encode($this->id));
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

}