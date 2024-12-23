<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\MailFunctions;
use App\Helpers\SimpleImage;
use DB;
use Illuminate\Support\Facades\Validator;

class StudentDocument extends Base{

    protected $table = 'student_documents';
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
        $data = $obj = StudentDocument::where('id', $input['id'])->first();
        $rules = array(
            'document_type' => 'required|integer', 
            'country_id' => 'required', 
            'document_name' => 'required|not_allow_symbol|max:10000', 
            'description' => 'required|not_allow_symbol|max:10000', 
        );

        $rules['upload_file'] = 'required|mimes:pdf,docx';
        if($data){
            $rules['upload_file'] = 'nullable|mimes:pdf,docx';
        }
        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                
                $obj = StudentDocument::where('id', $input['id'])->firstOrNew();
                $obj->document_type = $input['document_type'];
                $obj->country_id = $input['country_id'];
                $obj->document_name = $input['document_name'];
                $obj->description = $input['description'];
                if (!empty($input['upload_file'])) {
                    $uploaded = $this->uploadImage($input['upload_file']);
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
            $data = StudentDocument::where('id', $input['id'])->first();
            if ($data) {
            	@unlink(base_path($data->document_path));
                $data->delete();
                $json['status'] = 1;
                $json['message'] = 'Deleted successfully';
            } else {
                $json['message'] = 'Something went wrong';
                $json['status'] = 2;
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