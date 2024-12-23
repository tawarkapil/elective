<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\MailFunctions;
use DB;
use Validator;
use Illuminate\Support\Str;
use Auth;

class CustomerTrip extends Base{

    protected $table = 'cust_trips';
    public $primaryKey = 'id';

    function getcustomer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }

    function getprogram(){
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    }

    function getdestination(){
        return $this->belongsTo('App\Models\Destination', 'destination_id', 'id');
    }


    function updateStatus($input){
        $updata = CustomerTrip::where('id', $input['id'])->first();
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


    function getDetailsPageUrl(){
        return url('trips/info/'.str_replace(' ', '-', strtolower($this->title)).'/'.base64_encode($this->id));
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