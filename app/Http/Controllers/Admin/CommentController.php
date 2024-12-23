<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\Comment;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class CommentController extends BaseController
{
    public function index(Request $request)
    {
        return view("admin.comment.index", ["request" => $request]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new Comment();
        $builder = $obj->select('blog_comments.*', 'blogs.title as blog_title')
        ->join('customers','customers.customer_id','=','blog_comments.customer_id')
        ->join('blogs','blogs.id','=','blog_comments.blog_id');

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
                    if (isset($input['search']['value']) && strlen($input['search']['value']) > 0){
                        $srch = $input['search']['value'];
                        $query->where(function ($query) use ($input){
                            $srch = $input['search']['value'];
                            $name_arr = explode(' ', $srch);
                            if (isset($name_arr[0])){
                                $query->where('customers.first_name', 'LIKE', '%'.$name_arr[0].'%');
                            }

                            if (isset($name_arr[1])){
                                $query->where('customers.last_name', 'LIKE', '%'.$name_arr[1].'%');
                            }
                        })
                        ->orWhere('customers.last_name', 'LIKE', '%'.$srch.'%')
                        ->orWhere('blogs.title', 'LIKE', '%'.$srch.'%')
                        ->orWhere('comment', 'LIKE', '%'.$srch.'%');

                        $arr = [1 => 'Active', 0 => 'Inactive'];
                        $status_arr =CommonHelper::FILTER_ARRAY_VALUES_REGEXP("/".$input['search']['value']."/i",  $arr);
                        $status_arr = array_keys($status_arr);
                        if(isset($status_arr[0])){
                            $query->orWhereIn('status', $status_arr);
                        }   
                    }
                });
            })
            ->editColumn('customers.first_name', function ($row) {
                return $row->getcustomer->full_name(); 
            })
            
            ->editColumn('blogs.title', function ($row) {
                return $row->blog_title; 
            })
            ->editColumn('status', function ($row) {
                return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            }) 
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';
                if($row->status == 0){
                    $action .= '<a class="action-icon  mr-2 text-muted update_status" href="#" title="Change Status" data-status="1"  data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>';
                }else{
                    $action .= '<a class="action-icon mr-2 text-muted update_status" href="#" title="Change Status" data-status="0" data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>';
                }

                $action .= '</div>';


                return $action;
            })

        ->rawColumns(['action'])->addIndexColumn()
        ->make(true);
    }

    public function update_status(Request $request)
    {
        $obj = new Comment();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }

    
}