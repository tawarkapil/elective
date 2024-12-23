<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\SimpleImage;
use Config;
use Session;

class Plan extends Base {
    //public $num;
    protected $table = 'membership_plans';
    public $primaryKey = "id";
    /*
      All model relations arrives here
    */
    function getByKey($key) {
        return $this->where($this->primaryKey, $key)->first();
    }

    function addNew($input) {
        $pdata = $obj = $this->getByKey($input['id']);
        $rules = array(
            'plan_title' => 'required|not_allow_symbol|min:3|max:250',
            'membership_type' => 'required|not_allow_symbol|in:Junior,Silver,Gold,Platinum',
            'price' => 'required|numeric|min:0|max:100000', 
            'description' => 'nullable|not_allow_symbol_m|max:10000', 
            'validity' => 'required|numeric|max:100', 
            'extra_features' => 'required|not_allow_symbol|min:1|max:1000',
            'status' => 'required|in:0,1'
        );
        // $newnames = array(
        //     'category_status' => 'Status',
        // );
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        //$v->setAttributeNames($newnames);
        if ($v->passes()) {
            if (empty($pdata)) {
                $obj = new Plan();
            }
            $obj->plan_title = $input['plan_title'];
            $obj->price = $input['price'];
            $obj->membership_type = $input['membership_type'];
            $obj->description = $input['description'];
            $obj->validity = $input['validity'];
            $obj->status = $input['status'];
            $obj->show_company_details = isset($input['show_company_details']) ? 1 : 0;
            //$obj->can_view_buyers = isset($input['can_view_buyers']) ? 1 : 0;
            $obj->can_contact_buyers = isset($input['can_contact_buyers']) ? 1 : 0;
            $obj->notifications_of_new_posting = isset($input['notifications_of_new_posting']) ? 1 : 0;
            $obj->daily_market_watch = isset($input['daily_market_watch']) ? 1 : 0;
            $obj->extra_features = $input['extra_features'];
            $obj->save();
            $json['message'] = 'Saved successfully';
            $json['status'] = 1;
        } else {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }
}