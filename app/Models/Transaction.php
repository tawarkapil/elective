<?php
namespace App\Models;

use Illuminate\Support\Facades\Crypt;

class Transaction extends Base{

    protected $table = 'transactions';
    public $primaryKey = 'id';


    /*********** Encrypted Fields ***********/

    public function getTransIdAttribute($value) {
        if($value){
            return Crypt::decryptString($value);
        }
        return $value;
    }

    public function setTransIdAttribute($value) {
        if(!$value){
            return null;
        }
        $this->attributes['trans_id'] = Crypt::encryptString($value);
    }

    /*********** Encrypted Fields ***********/

   
    function getByKey($key){
        return $this->where($this->primaryKey,$key)->first();
    }


    function customerMembershipLevel(){
    	return $this->hasOne('App\Models\CustomerMembershipLevel', 'id', 'customer_membership_level');
    }
}