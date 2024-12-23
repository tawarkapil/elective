<?php
namespace App\Models;
use App\Helpers\CommonHelper as CommonHelper;
use App\Helpers\ViewsHelper as Views;
use App\Helpers\SimpleImage;
use Config;
use Session;
use Carbon\Carbon;
use DB;

class Testimonial extends Base {
    protected $table = 'testimonials';
    public $primaryKey = "id";
    /*
      All model relations arrives here
    */
    function getByKey($key) {
        return $this->where($this->primaryKey, $key)->first();
    }
    
    function addNew($input) {
        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'designation' => 'required|not_allow_symbol|max:10000',
            'name' => 'required|not_allow_symbol|min:3|max:250', 
            'content' => 'required|not_allow_symbol|max:10000', 
            'status' => 'required|in:0,1'
        );
        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                if (empty($data)) {
                    $obj = new Testimonial();
                }
                $obj->name = ucfirst($input['name']);
                $obj->designation = $input['designation'];
                $obj->status = $input['status'];
                $obj->content = $input['content'];
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

    function updateStatus($input){
        $updata = Testimonial::where('id', $input['id'])->first();
        if($updata){
            $updata->updated_at = date('Y-m-d H:i:s');
            $updata->status = $input['status'];
            $updata->save();
            $json['status'] = 1;
            $json['message'] = 'Saved Successfully';
            $json['redirect_url'] = url('admin/testimonials');
            $json['success'] = 1;
        }else{
            $json['status'] = 2;
            $json['message'] = 'Testimonial not found.';
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

    function sort_desc($length = 100) {
        $desc = $this->content;
        if (strlen($desc) > $length) {
            $desc = strip_tags(CommonHelper::htmldata($desc));
            return substr($desc, 0, $length) . "...";
        }
        return strip_tags(CommonHelper::htmldata($desc));
    }

    function sort_title($length = 25) {
        $desc = $this->heading;
        if (strlen($desc) > $length) {
            // $desc = substr($desc, $length);
            return substr($desc, 0, 100) . "...";
        }
        return $desc;
    }
}