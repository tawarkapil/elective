<?php
namespace App\Models;
use App\Helpers\CommonHelper as CommonHelper;
use App\Helpers\ViewsHelper as Views;
use App\Helpers\SimpleImage;
use Config;
use Session;
use Carbon\Carbon;
use DB;

class Category extends Base {
    protected $table = 'mst_categories';
    public $primaryKey = "id";
    /*
      All model relations arrives here
    */
    function getByKey($key) {
        return $this->where($this->primaryKey, $key)->first();
    }

    function getPostCount(){
        return Blogs::where('category_id', $this->id)->where('status', 1)->count();
    }
    
    function addNew($input) {
        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'title' => 'required|not_allow_symbol|min:3|max:250', 
            'description' => 'required|not_allow_symbol|max:10000', 
            'category' => 'required|in:1,2,3',
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
                    $obj = new Program();
                }
                $obj->title = ucfirst($input['title']);
                $obj->category = $input['category'];
                $obj->description = $input['description'];
                $obj->status = $input['status'];
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

}