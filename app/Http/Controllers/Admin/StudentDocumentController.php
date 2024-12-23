<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\OurMember;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class StudentDocumentController extends BaseController
{
    public function index(Request $request)
    {
        return view("admin.student-documents.index", ["request" => $request]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new OurMember();
        $builder = $obj->select('*');

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
                            ->orWhere('designation', 'LIKE', '%'.$srch.'%')
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
            ->editColumn('cover_image', function ($row) {

                $html = '<img src="'.url('public/uploads/student-documents/'.$row->cover_image) .'" style="border: 1px solid #DDD;padding: 1px;height: 80px;width: 90px;">';

                  return $html; 
            })
            ->editColumn('designation', function ($row) {
                   return $row->designation; 
            })
            ->editColumn('name', function ($row) {
                   return $row->name; 
            })
            ->editColumn('description', function ($row) {
                $html = '<a href="#" data-key="'.$row->id.'" class="open_view_description_btn">View description</a><div id="open_description_box_'.$row->id.'" style="display: none;">'.$row->description.'</div>';
                   return $html; 
            }) 
            ->editColumn('status', function ($row) {
                   return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            }) 
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';
                $action .= '<a title="Edit" class="editBtn action-icon text-muted" data-key="'.base64_encode($row->id) .'" href="#" > <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                $action .= '<a title="Delete" class="deleteBtn action-icon text-muted" data-key="'.base64_encode($row->id) .'" href="#" > <i class="fa fa-trash" aria-hidden="true"></i> </a>';

                if($row->status == 0){
                    $action .= '<a class="action-icon  mr-2 text-muted update_status" href="#" title="Change Status" data-status="1"  data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>';
                }else{
                    $action .= '<a class="action-icon mr-2 text-muted update_status" href="#" title="Change Status" data-status="0" data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>';
                }
                $action .= '</div>';
                return $action;
            })

        ->rawColumns(['cover_image', 'description', 'action'])->addIndexColumn()
        ->make(true);
    }

    public function deleteSelected(Request $request)
    {
        $obj = new OurMember();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->deleteSelected($input);
        return json_encode($data);
    }
}