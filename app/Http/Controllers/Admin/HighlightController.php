<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\Attachment;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class HighlightController extends BaseController{

    public function addnewajax(Request $request)
    {
        $obj = new Attachment();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function get_content(Request $request)
    {
        $id = $request->input("id");
        $id = base64_decode($id);
        $data = Attachment::where('id', $id)->first();
        if($data){
            $json["image"] = '';
            if($data->attachment){
             $json["image"] = '<div style="border: 1px solid #DDD;padding: 3px;background-size: cover;"><img src="'.url($data->attachment) .'" width="100%"></div>';
            }
            
            $json["description"] = $data->description;
            $json["status"] = 1;
            $json["message"] = 'Loaded...';
        }else{
            $json["status"] = 0;
            $json["message"] = 'Something went wrong.';
        }
    return json_encode($json);
    }

    public function update_status(Request $request)
    {
        $obj = new Attachment();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }

    public function deleteSelected(Request $request)
    {
        $obj = new Attachment();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->deleteSelected($input);
        return json_encode($data);
    }
}