<?php
namespace App\Models;

use DB;
use Auth;

class Comment extends Base {
    protected $table = 'blog_comments';
    public $primaryKey = "id";

    function getcustomer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }


    function commentSubmitFrm($input){
        $data = $obj = $this->where('id', $input['id'])->first();
        $rules = array(
            'comment' => 'required|not_allow_symbol|max:10000',
        );

        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $blogdata = Blogs::where('id', $input['blog_id'])->where('status', 1)->first();
                if(!$blogdata){
                    $json['status'] = 2;
                    $json['message'] = 'Invalid blog found';
                    return $json;
                }

                if (empty($data)) {
                    $obj = new Comment();
                }
                $obj->comment = ucfirst($input['comment']);
                $obj->customer_id = Auth::guard('customer')->user()->customer_id;
                $obj->blog_id = $blogdata->id;
                $obj->status = 1;
                $obj->save();

                DB::commit();
                $json['message'] = 'Saved successfully';
                $json['status'] = 1;
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
        $updata = Comment::where('id', $input['id'])->first();
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

}
