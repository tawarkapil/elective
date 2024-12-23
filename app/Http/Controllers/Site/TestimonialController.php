<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\Testimonial;
use ViewsHelper;
use CommonHelper;
use UserHelper;
use Auth;

class TestimonialController extends BaseController
{
    public function index(Request $request)
    {
        return view("frontend.testimonial.index", ["request" => $request]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new Testimonial();
        $builder = $obj->select('*');//->where('created_type', 1)->where('created_by', Auth::user()->user()->customer_id);

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
                            ->orWhere('name', 'LIKE', '%'.$srch.'%')
                            ->orWhere('subject', 'LIKE', '%'.$srch.'%')
                            ->orWhere('content', 'LIKE', '%'.$srch.'%');

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

             ->editColumn('subject', function ($row) {
                   return $row->subject; 
            })
            
            ->editColumn('name', function ($row) {
                   return $row->name; 
            })
            ->editColumn('status', function ($row) {
                   return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('content', function ($row) {
                $html = '<a href="#" data-key="'.$row->id.'" class="open_view_content_btn">View Content</a><div id="open_content_box_'.$row->id.'" style="display: none;">'.$row->content.'</div>';
                   return $html; 
            }) 
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            })
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';
                $action .= '<a title="Edit" class="editBtn btn btn-tool" data-key="'.base64_encode($row->id) .'" href="#" > <i class="fas fa-pen" aria-hidden="true"></i> </a>';
                //$action .= '<a title="Delete" class="deleteBtn action-icon text-muted" data-key="'.base64_encode($row->id) .'" href="#" > <i class="fa fa-trash" aria-hidden="true"></i> </a>';

                if($row->status == 0){
                    $action .= '<a class="btn btn-tool update_status" href="#" title="Change Status" data-status="1"  data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>';
                }else{
                    $action .= '<a class="btn btn-tool update_status" href="#" title="Change Status" data-status="0" data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>';
                }
                $action .= '</div>';
                return $action;
            })

        ->rawColumns(['content', 'action'])->addIndexColumn()
        ->make(true);
    }

    public function addnewajax(Request $request)
    {
        $obj = new Testimonial();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function get_content(Request $request)
    {
        $id = $request->input("id");
        $id = base64_decode($id);
        $data = Testimonial::where('id', $id)->first();
        if($data){
            $json["subject"] = $data->subject;
            $json["name"] = $data->name;
            $json["cstatus"] = $data->status;
            $json["content"] = $data->content;
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
        $obj = new Testimonial();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }

    public function deleteSelected(Request $request)
    {
        $obj = new Testimonial();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->deleteSelected($input);
        return json_encode($data);
    }
}