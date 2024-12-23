<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\MailFunctions;
use App\Helpers\SimpleImage;
use DB;
use Illuminate\Support\Facades\Validator;

class Attachment extends Base{

    protected $table = 'attachments';
    public $primaryKey = 'id';

   

    function displayAttachment(){
        $file = $this->attachment;
        $explodeArr = explode('/', $file);
        return end($explodeArr);
    }
    
    function getByKey($key){
        return $this->where($this->primaryKey,$key)->first();
    }


     function addNew($input) {
        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'description' => 'required|not_allow_symbol|max:10000', 
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
                
                $obj = Attachment::where('id', $input['id'])->firstOrNew();
                $obj->description = $input['description'];
                $obj->ref_id = base64_decode($input['ref_id']);
                $obj->type = $input['type'];
                if (!empty($input['image'])) {
                    $uploaded = $this->uploadImage($input['image']);
                    if ($uploaded['status'] == 0) {
                        $json['error'] = 2;
                        $json['error_mess'] = $uploaded['error'];
                        return $json;
                    }
                    if ($uploaded['status'] == 1) {
                        $obj->attachment = $uploaded['file_name'];
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
}