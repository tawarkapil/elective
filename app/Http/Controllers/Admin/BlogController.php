<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\Blogs;
use App\Models\Comment;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class BlogController extends BaseController
{
    public function index(Request $request)
    {
        return view("admin.blogs.index", ["request" => $request]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $builder = new Blogs();
        // $builder = $obj->select('blogs.*', 'cust_trips.title as trip_title')->join("cust_trips", "blogs.trip_id", "=", "cust_trips.id");

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
                            $query->where('title', 'LIKE', '%'.$srch.'%')
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
                $action = '<div class="text-nowrap text-center table-action">';
                $action .= '<a title="View" class="action-icon text-muted" href="'.url('admin/blogs/view/'.base64_encode($row->id)).'" > <i class="fa fa-eye" aria-hidden="true"></i> </a>';
                if($row->status == 0){
                    $action .= '<a class="action-icon  mr-2 text-muted update_status" href="#" title="Change Status" data-status="1"  data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>';
                }else{
                    $action .= '<a class="action-icon mr-2 text-muted update_status" href="#" title="Change Status" data-status="0" data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>';
                }
                $action .= '</div>';
                return $action;
            })

        ->rawColumns(['image', 'description', 'action'])->addIndexColumn()
        ->make(true);
    }


    public function details(Request $request, $id = null) {
        $id = base64_decode($id);
        $data = Blogs::where('id', $id)->first();
        if (!$data) {
            return abort(404);
        }
        $comments = Comment::where('blog_id', $data->id)->orderBy('created_at', 'desc')->get();
        return view('admin.blogs.view', ['request' => $request, 'data' => $data, 'comments' => $comments]);
    }

    public function addnewajax(Request $request)
    {
        $obj = new Blogs();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function get_content(Request $request)
    {
        $id = $request->input("id");
        $id = base64_decode($id);
        $data = Blogs::where('id', $id)->first();
        if($data){
            $json["image"] = '<div style="border: 1px solid #DDD;padding: 3px;background-size: cover;"><img src="'.url('public/uploads/blogs/'.$data->image) .'" width="100%"></div>';
            $json["title"] = $data->title;
            $json["name"] = $data->name;
            $json["cstatus"] = $data->status;
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
}