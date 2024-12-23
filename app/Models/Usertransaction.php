<?php

namespace App\Models;

use App\Helpers\CommonHelper as CommonHelper;
use App\Helpers\ViewsHelper as Views;
use App\Helpers\SimpleImage;
use App\Models\User\User;
use App\Models\Membershipplan;
use Request;
use Config;
use Session;

class Usertransaction extends Base{

    protected $table = 'user_transactions';
    public $primaryKey = "id";

    

    /*

      All model relations arrives here

     */

    

    function getPageByKey($key){
        return $this->where($this->primaryKey , $key)->first();
    }

    function getList(){
        $query = new Usertransaction();
        $srchinput = Request::all();
        if(isset($srchinput['terms']) && strlen($srchinput['terms']) > 0){
             $query = $query->where(function($query) use($srchinput){
                $query->where('customer_name', 'LIKE', '%'.$srchinput['terms'].'%');
                $query->orWhere('customer_email', 'LIKE', '%'.$srchinput['terms'].'%');
                $query->orWhere('customer_phone_number', 'LIKE', '%'.$srchinput['terms'].'%');
                $query->orWhere('txn_id', 'LIKE', '%'.$srchinput['terms'].'%');
                
            });
        }
        if(isset($srchinput['payment_date']) && strlen($srchinput['payment_date']) > 0){
            $query = $query->where(function($query) use($srchinput){
                $date_arr  = explode(' - ', $srchinput['payment_date']);
                $start_date = date('Y-m-d', strtotime($date_arr[0]));
                $end_date = date('Y-m-d', strtotime($date_arr[1]));
                $query->whereBetween('payment_date', [$start_date." 00:00:00", $end_date." 23:59:59"]);
            });
        }

        if(isset($srchinput['deposite_type']) && strlen($srchinput['deposite_type']) > 0){
            $query = $query->where(function($query) use($srchinput){
                if($srchinput['deposite_type'] == 'PayU Money'){
                    $query->where('payment_mode', 'PayU Money');
                }else{
                    $query->where('payment_mode', '!=' , 'PayU Money');
                }
            });
        }
        return $query->paginate(10);

    }
  
    function getuser(){
        return $this->belongsTo('App\Models\User\User', 'user_id', 'user_id');
    }
  
    function getplan(){
        return $this->belongsTo('App\Models\UserMembership', 'user_membership_id', 'user_membership_id');
    }
}

   
