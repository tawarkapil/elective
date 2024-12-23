<?php
namespace App\Models;
use App\Helpers\CommonHelper as CommonHelper;
use App\Helpers\ViewsHelper as Views;
use App\Helpers\SimpleImage;
use Config;
use Session;
use Auth;
use DB;
use App\Models\Traits\FileUploadTrait;

class Blogs extends Base {

    use FileUploadTrait;

    protected $table = 'blogs';
    public $primaryKey = "id";
    /*
      All model relations arrives here
    */
    function getByKey($key) {
        return $this->where($this->primaryKey, $key)->first();
    }

    function getcustomer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }

    function getBlogsCount(){
        return Blogs::where('category_id', $this->id)->where('status', 0)->count();
    }

    function getcategory(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    function gettrip(){
        return $this->belongsTo('App\Models\CustomerTrip', 'trip_id', 'id');
    }

    function displayAttachment(){
        $file = $this->attachment;
        $explodeArr = explode('/', $file);
        return end($explodeArr);
    }

    function attachments(){
      return $this->hasMany('App\Models\Attachment', 'ref_id', 'id')->where('type', 'Blog');
    }

    function comments(){
      return $this->hasMany('App\Models\Comment', 'blog_id', 'id');
    }

    function getAttachmentArr(){
      return Attachment::where('ref_id', $this->id)->where('type', 'Blog')->pluck('attachment')->toArray();
    }
    
    function addNew($input) {
        $input['attachments'] = explode(',', $input['attachments']);
        $rules = array(
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'title' => 'required|not_allow_symbol|max:10000',
            'category_id' => 'required|exists:mst_categories,id', 
            'description' => 'required|not_allow_symbol|max:10000', 
            'tags' => 'required|array',
            //'trip_id' => 'required',
            'upload_file' => 'nullable|in:Image,Video',
        );

        if(isset($input['upload_file']) && $input['upload_file'] == 'Image'){
            $rules['attachments'] = 'required|array';
            $rules['attachments.*'] = 'required';
        }

        if(isset($input['upload_file']) && $input['upload_file'] == 'Video'){
            $rules['youtube_url'] = 'required';
        }
        


        $newnames = array();
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
                $data = $obj = Blogs::where('id', $input['id'])->first();
                if (empty($data)) {
                    $obj = new Blogs();
                    $obj->customer_id = Auth::guard('customer')->user()->customer_id;
                }
              //  $tripdata = TripCustomers::where('id', $input['trip_id'])->first();
                $obj->title = ucfirst($input['title']);
                $obj->author_name = Auth::guard('customer')->user()->full_name();
                $obj->category_id = $input['category_id'];
                $obj->description = $input['description'];
                //$obj->trip_id = $input['trip_id'];
                //$obj->program_id = $tripdata->program_id;
                //$obj->destination_id = $tripdata->destination_id;
                $obj->tags = implode(',', $input['tags']);
                $obj->status = 1;
                $obj->upload_file = null;
                $obj->youtube_url = null;
                $obj->upload_file = $input['upload_file'];
               
                if(isset($input['upload_file']) && $input['upload_file'] == 'Video'){
                    $existUploadFiles = Attachment::where('ref_id', $obj->id)->where('type', 'Blog')->get();
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
                    $obj->youtube_url = $input['youtube_url'];
                }

                $obj->save();


               
                if(isset($input['upload_file']) && $input['upload_file'] == 'Image'){
                    if(isset($input['attachments']) && count($input['attachments']) > 0){
                        $newUploadFiles = $input['attachments'];
                        $existUploadFiles = Attachment::where('ref_id', $obj->id)->where('type', 'Blog')->pluck('attachment', 'id')->toArray();
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
                              $attachObj->type = 'Blog';
                              $attachObj->ref_id = $obj->id;
                              $attachObj->attachment = $singleFile;
                              $attachObj->save();
                              //File upload Job dispatch
                            }

                          }
                        }
                    }
                }else{
                    $existUploadFiles = Attachment::where('ref_id', $obj->id)->where('type', 'Blog')->pluck('attachment', 'id')->toArray();
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
                }

                foreach($input['tags'] as $tag){
                    $obj = MstTag::where('name', $tag)->firstOrNew();
                    $obj->name = ucwords($tag);
                    $obj->save();
                }
                $json['message'] = 'Saved successfully';
                $json['redirect_url'] = url('my-blogs');
                $json['status'] = 1;
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        } else {
            $json['status'] = 0;
            $errMessage = [];
            foreach($v->messages()->toArray() as $key => $error){
                if (strpos($key, 'attachments') !== false) {
                    $errMessage['attachments'] = $error;
                }else{
                    $errMessage[$key] = $error;
                }
            }
            $json['message'] = $errMessage;
        }
        return $json;
    }

    function uploadImage($file, $id = false) {
        $imgConf = Config::get("params.blogs_image");
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
        $updata = Blogs::where('id', $input['id'])->first();
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
        return url('blogs/info/'.str_replace(' ', '-', strtolower($this->title)).'/'.base64_encode($this->id));
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