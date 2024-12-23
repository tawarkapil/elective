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

class OurMember extends Base{

    protected $table = 'mst_our_members';
    public $primaryKey = 'id';


    function getdestination(){
        return $this->belongsTo('App\Models\Destination', 'destination', 'id');
    }

    function addNew($input) {
        $rules = array(
            'cover_image' => 'nullable|mimes:jpeg,jpg,png',
            'name' => 'required|not_allow_symbol|min:3|max:250',
            'email' => 'required|email|min:6|max:100',
            'destination' => 'required',
            'designation' => 'required|not_allow_symbol|min:3|max:250', 
            'description' => 'required|not_allow_symbol|max:10000', 
            'status' => 'nullable|in:1,0',
        );

        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $obj = OurMember::where('id', $input['id'])->firstOrNew();
                $obj->name = ucfirst($input['name']);
                $obj->email = $input['email'];
                $obj->destination = $input['destination'];
                $obj->designation = $input['designation'];
                $obj->description = $input['description'];
                if (!empty($input['cover_image'])) {
                    $uploaded = $this->uploadImage($input['cover_image']);
                    if ($uploaded['status'] == 0) {
                        $json['error'] = 2;
                        $json['error_mess'] = $uploaded['error'];
                        return $json;
                    }
                    if ($uploaded['status'] == 1) {
                        $obj->cover_image = $uploaded['file_name'];
                    }
                }
                $obj->status = $input['status'];
                $obj->save();
                DB::commit();

                $json['status'] = 1;
                $json['message'] = 'Saved successfully';
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
        $imgConf = Config::get("params.our_member_image");
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
        $updata = OurMember::where('id', $input['id'])->first();
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
            $data = $this->where('id', $input['id'])->first();
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

    function short_desc($length = 100) {
        $desc = $this->description;
        if (strlen($desc) > $length) {
            $desc = strip_tags(CommonHelper::htmldata($desc));
            return substr($desc, 0, $length) . "...";
        }
        return strip_tags(CommonHelper::htmldata($desc));
    }

}