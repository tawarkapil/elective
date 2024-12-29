<?php

namespace App\Models;
use DB;
use Illuminate\Support\Facades\Validator;

class ProgramCall extends Base
{
    protected $table  = 'program_calls';

    protected $fillable = [
        'title',
        'description',
        'status',
        'application'
    ];

    function addNew($input) {
        $data = $obj = $this->getByKey($input['id']);
        $rules = array(
            'description' => 'required|not_allow_symbol|max:10000', 
            'title' => 'required|not_allow_symbol|max:250', 
            
        );
        
        $newnames = array();
        $messages = array();
        
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                
                $obj = ProgramCall::where('id', $input['id'])->firstOrNew();
                $obj->description = $input['description'];
                $obj->application = $input['application'];
                $obj->title = $input['title'];
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

    function getByKey($key){
        return $this->where($this->primaryKey,$key)->first();
    }
}