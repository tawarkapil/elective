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

class Pricing extends Base{

    protected $table = 'mst_pricing';
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
    
    function addNew($input) {
        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'title' => 'required|not_allow_symbol|min:3|max:250', 
            'destination' => 'required',
            'status' => 'required|in:0,1',
            'description' => 'required|not_allow_symbol|max:10000', 
            'week1_payment' => 'required|numeric|min:1|max:10000',
            'week2_payment' => 'required|numeric|min:1|max:10000',
            'week3_payment' => 'required|numeric|min:1|max:10000',
            'week4_payment' => 'required|numeric|min:1|max:10000',
            'week5_payment' => 'required|numeric|min:1|max:10000',
            'week6_payment' => 'required|numeric|min:1|max:10000',
            'extra_week_payment' => 'required|numeric|min:1|max:10000',
        );

        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                if (empty($data)) {
                    $obj = new Pricing();
                }
                $obj->title = ucfirst($input['title']);
                $obj->destination = $input['destination'];
                $obj->week1_payment = $input['week1_payment'];
                $obj->week2_payment = $input['week2_payment'];
                $obj->week3_payment = $input['week3_payment'];
                $obj->week4_payment = $input['week4_payment'];
                $obj->week5_payment = $input['week5_payment'];
                $obj->week6_payment = $input['week6_payment'];
                $obj->extra_week_payment = $input['extra_week_payment'];
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

    function updateStatus($input){
        $updata = Pricing::where('id', $input['id'])->first();
        if($updata){
            $updata->updated_at = date('Y-m-d H:i:s');
            $updata->status = $input['status'];
            $updata->save();
            $json['status'] = 1;
            $json['message'] = 'Saved Successfully';
            $json['redirect_url'] = url('admin/pricing');
            $json['success'] = 1;
        }else{
            $json['status'] = 2;
            $json['message'] = 'Tour not found.';
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