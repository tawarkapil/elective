<?php

namespace App\Models;

class State extends Base{

    protected $table = 'states';
    public $primaryKey = 'id';

   
    function getByKey($key){
        return $this->where($this->primaryKey,$key)->first();
    }
}