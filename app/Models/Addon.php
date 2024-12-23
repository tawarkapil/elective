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
use App\Models\Traits\FileUploadTrait;

class Addon extends Base{

    use FileUploadTrait;

    protected $table = 'mst_addons';
    public $primaryKey = 'id';

     /*
      All model relations arrives here
    */
    function getByKey($key) {
        return $this->where($this->primaryKey, $key)->first();
    }

    function displayAttachment(){
        $file = $this->attachment;
        $explodeArr = explode('/', $file);
        return end($explodeArr);
    }

    function attachments(){
      return $this->hasMany('App\Models\Attachment', 'ref_id', 'id')->where('type', 'Addon');
    }
    function getAttachmentArr(){
      return Attachment::where('ref_id', $this->id)->where('type', 'Addon')->pluck('attachment')->toArray();
    }

    function displayAttachmentsHtml(){
        $html = '';
        $attachdata = Attachment::where('ref_id', $this->id)->where('type', 'Addon')->get();
        foreach($attachdata as $attach){
            $html .= '<div class="col-sm-2"><div class="documentfileContainer" data-key="'.$attach->attachment.'"><img src="'.url($attach->attachment).'" class="img-fluid mb-2" alt="white sample"><a href="#" class="removeImgBtn"><i class="fa fa-times removeUploadFile"></i></a></div></div>';
        }

        return $html;

    }

    function getprogram(){
        return $this->hasOne('App\Models\Program', 'id', 'program');
    }
    
    function addNew($input) {
        //$input['attachments'] = explode(',', $input['attachments']);

        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'title' => 'required|not_allow_symbol|min:3|max:250', 
            'description' => 'required|not_allow_symbol|max:10000', 
            'what_include_description' => 'required|not_allow_symbol|max:10000', 
            'price_description' => 'required|not_allow_symbol|max:10000', 
            'program' => 'required',
            'payment_amount' => 'required|numeric|min:1|max:10000',
            'status' => 'required|in:0,1'
        );

        $rules['image'] = 'required|mimes:jpeg,jpg,png';
        if($data){
            $rules['image'] = 'nullable|mimes:jpeg,jpg,png';
        }

        $newnames = array();
        // $rules['attachments'] = 'nullable|array';
        // $rules['attachments.*'] = 'nullable';

        // if(isset($input['attachments'])){
        //     foreach($input['attachments'] as $key => $document_file){
        //        $newnames['attachments.' . $key] = 'Attachments';
        //     }
        // }

        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                if (empty($data)) {
                    $obj = new Addon();
                }
                $obj->title = ucfirst($input['title']);
                $obj->program = $input['program'];
                $obj->payment_amount = $input['payment_amount'];
                $obj->description = $input['description'];
                $obj->what_include_description = $input['what_include_description'];
                $obj->price_description = $input['price_description'];
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

                // if(isset($input['attachments']) && count($input['attachments']) > 0){
                //     $newUploadFiles = $input['attachments'];
                //     $existUploadFiles = Attachment::where('ref_id', $obj->id)->where('type', 'Addon')->pluck('attachment', 'id')->toArray();
                //     foreach($existUploadFiles as $docId => $attachment){
                //       if(!in_array($attachment, $input['attachments'])){
                //             unset($existUploadFiles[$docId]);
                //             $filePath = base_path($attachment);
                //             if(file_exists($filePath)){
                //                 @unlink($filePath);
                //             }
                //           Attachment::where('id', $docId)->delete();
                //       }
                //     }
                //     $insertedArr = array_diff($newUploadFiles, $existUploadFiles);

                //     if(count($insertedArr) > 0){
                //       foreach($insertedArr as $singleFile){
                //         if($singleFile){
                //           $attachObj = new Attachment();
                //           $attachObj->type = 'Addon';
                //           $attachObj->ref_id = $obj->id;
                //           $attachObj->attachment = $singleFile;
                //           $attachObj->save();
                //           //File upload Job dispatch
                //         }

                //       }
                //     }
                // }else{
                //     Attachment::where('ref_id', $obj->id)->where('type', 'Addon')->delete();
                // }


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
        $imgConf = Config::get("params.addon_image");
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
            $json['redirect_url'] = url('admin/addons');
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
        return url('events/info/'.str_replace(' ', '-', strtolower($this->title)).'/'.base64_encode($this->id));
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