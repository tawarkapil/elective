<?php

namespace App\Models;

class Country extends Base{

    protected $table = 'countries';
    public $primaryKey = 'id';

   
    function getByKey($key){
        return $this->where($this->primaryKey,$key)->first();
    }
}