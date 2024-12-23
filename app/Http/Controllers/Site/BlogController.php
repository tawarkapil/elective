<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\Blogs;
use App\Models\Comment;
use App\Models\Category;
use App\Models\MstTag;
use App\Models\CustomerTrip;
use App\Models\Attachment;
use ViewsHelper;
use CommonHelper;
use UserHelper;
use Auth;

class BlogController extends BaseController
{
    public function index(Request $request)
    {
        return view("frontend.blogs.index", ["request" => $request]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new Blogs();
        $builder = $obj->select('*')->where('customer_id', Auth::guard('customer')->user()->customer_id);

        $builder->where(function($query) use($input){
            if(isset($input['srch_start_date'])){
                $query->whereDate('updated_at','>=', date('Y-m-d', strtotime($input['srch_start_date'])));
            }
            if(isset($input['srch_end_date'])){
                $query->whereDate('updated_at','<=', date('Y-m-d', strtotime($input['srch_end_date'])));
            } 
            
        });

        return  Datatables::of($builder)->filter(function ($query ) use($input){
                $query->where(function($query) use($input){
                    if (isset($input['search']['value']) && strlen($input['search']['value'])>0) {
                        $query->where(function($query) use($input){
                            $srch = $input['search']['value'];
                            $query
                            ->orWhere('title', 'LIKE', '%'.$srch.'%')
                            ->orWhere('name', 'LIKE', '%'.$srch.'%')
                            ->orWhere('description', 'LIKE', '%'.$srch.'%');

                            $arr = [1 => 'Active', 0 => 'Inactive'];
                            $status_arr =CommonHelper::FILTER_ARRAY_VALUES_REGEXP("/".$input['search']['value']."/i",  $arr);
                            $status_arr = array_keys($status_arr);
                            if(isset($status_arr[0])){
                                $query->orWhereIn('status', $status_arr);
                            }
                            
                       });
                    }
                });
            })
            ->editColumn('image', function ($row) {

                $html = '<img src="'.url('public/uploads/blogs/'.$row->image) .'" style="border: 1px solid #DDD;padding: 1px;height: 80px;width: 90px;">';

                  return $html; 
            })
            ->editColumn('title', function ($row) {
                   return $row->title; 
            })
            
            ->editColumn('name', function ($row) {
                   return $row->name; 
            })
            ->editColumn('status', function ($row) {
                   return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            }) 
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action" style="font-size:18px;">';
                
                $action .= '<a title="View" target="_blank" class="action-icon text-muted" href="'.$row->getDetailsPageUrl().'" > <i class="fa fa-eye" aria-hidden="true"></i> </a>';

                $action .= '<a title="Edit" class="action-icon text-muted" href="'.url('my-blogs/addnew/'.base64_encode($row->id)).'" > <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                
                $action .= '<a title="Delete" class="deleteBtn action-icon text-muted" data-key="'.base64_encode($row->id) .'" href="#" > <i class="fa fa-trash" aria-hidden="true"></i> </a>';
                $action .= '</div>';


                return $action;
            })

        ->rawColumns(['image', 'description', 'action'])->addIndexColumn()
        ->make(true);
    }

    function addnew(Request $request, $id = null){
        $id = base64_decode($id);
        $input = $request->all();
        $customer_id = Auth::guard('customer')->user()->customer_id;
        $data = Blogs::where('id', $id)->where('customer_id', $customer_id)->first();
        if($id && !$data){
            return abort(404);
        }
        $categories = Category::where('status', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $trips = CustomerTrip::where('customer_id', Auth::guard('customer')->user()->customer_id)->where('status', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $tags = MstTag::orderBy('name', 'ASC')->pluck('name')->toArray();
        return view('frontend.blogs.addnew', compact(['input', 'data', 'categories', 'tags', 'trips']));
    }

    public function addnewajax(Request $request)
    {
        $obj = new Blogs();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function commentSubmitFrm(Request $request)
    {
        $obj = new Comment();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $input['blog_id'] = base64_decode($input['blog_id']);
        $data = $obj->commentSubmitFrm($input);
        return json_encode($data);
    }

    //public function get_content(Request $request)
    // {
    //     $id = $request->input("id");
    //     $id = base64_decode($id);
    //     $data = Blogs::where('id', $id)->first();
    //     if($data){
    //         $json["image"] = '<div style="border: 1px solid #DDD;padding: 3px;background-size: cover;"><img src="'.url('public/uploads/blogs/'.$data->image) .'" width="100%"></div>';
    //         $json["title"] = $data->title;
    //         $json["name"] = $data->name;
    //         $json["cstatus"] = $data->status;
    //         $json["description"] = $data->description;
    //         $json["status"] = 1;
    //         $json["message"] = 'Loaded...';
    //     }else{
    //         $json["status"] = 0;
    //         $json["message"] = 'Something went wrong.';
    //     }
    // return json_encode($json);
    // }

    public function update_status(Request $request)
    {
        $obj = new Blogs();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }

    public function deleteSelected(Request $request)
    {
        $obj = new Blogs();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->deleteSelected($input);
        return json_encode($data);
    }

    function removeAttachmentFile(Request $request){
        $input = $request->all();
        $id = base64_decode($input['attachment_id']);

        $obj = new Attachment();
        $data = $obj->getByKey($id);
        if($data){
            $data->delete();
          $json['status'] = 1;
          $json['message'] = 'Deleted successfully';
        }else{
          $json['status'] = 0;
          $json['message'] = 'Record not found';
        }
        return json_encode($json);

    }

    public function deleteUploadFiles(Request $request){
        $input = $request->all();
        $upload_file = (isset($input['upload_file'])) ? $input['upload_file'] : null;
        $filePath = base_path($upload_file);
        if(file_exists($filePath)){
            Attachment::where('attachment', $input['upload_file'])->delete();
            @unlink($filePath);
        }
        $json['status'] = 1;
        $json['message'] = '';
        return json_encode($json);
    }


    public function uploadChunkFile(Request $request){
        $input = $request->all();
        $uploaderMines = 'jpg|png|jpeg';
        $maxSizeMb = 2;

        $fieldName = 'attachments';
        $rules[$fieldName] = 'required|chckcstmdocumentminetype:'.str_replace('|', ',', $uploaderMines);


        $v = \Validator::make($input, $rules);
        if ($v->passes()) {    
            $obj = new Blogs();
            $json = $obj->uploadChunkFile($fieldName, $uploaderMines, $maxSizeMb);
        }else{
            $json[$fieldName][0]['name'] = $input[$fieldName]->getClientOriginalName();
            $json[$fieldName][0]['error'] = $v->errors()->first();
            $json[$fieldName][0]['type'] = $input[$fieldName]->getMimetype();
        }
        return json_encode($json);
    }
}