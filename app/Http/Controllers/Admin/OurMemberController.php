<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\OurMember;
use App\Models\Destination;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class OurMemberController extends BaseController
{
    public function index(Request $request)
    {

        $destinationdata = Destination::where('status', 1)->orderBy('title', 'ASC')->get();

        foreach($destinationdata as $row){
            $destinations[$row->id] = $row->title.' - '.$row->getcountry->name;
        }
        return view("admin.our-member.index", ["request" => $request, 'destinations' => $destinations]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new OurMember();
        $builder = $obj->select('mst_our_members.*', 'mst_destinations.title as destination_title')
        ->join("mst_destinations", "mst_our_members.destination", "=", "mst_destinations.id");

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
                            ->where('mst_our_members.name', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_our_members.email', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_destinations.title', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_our_members.designation', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_our_members.description', 'LIKE', '%'.$srch.'%');

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

                $html = '<img src="'.url('public/uploads/our-member/'.$row->cover_image) .'" style="border: 1px solid #DDD;padding: 1px;height: 80px;width: 90px;">';

                  return $html; 
            })
            ->editColumn('mst_destinations.title', function ($row) {
                   return $row->destination_title; 
            })
            ->editColumn('name', function ($row) {
                $html = '<div class="media"><img src="'.url('public/uploads/our-member/'.$row->cover_image).'" alt="'. $row->name.'('.$row->designation.')'.'" class="img-size-50 mr-3 img-circle"><div class="media-body"><h3 class="dropdown-item-title">'. $row->name.'(<small>'.$row->designation.'</small>)'.'</h3><p class="text-sm">'.$row->email.'</p></div></div>';
                   return $html; 
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

        ->rawColumns(['name', 'description', 'action'])->addIndexColumn()
        ->make(true);
    }

    public function addnewajax(Request $request)
    {
        $obj = new OurMember();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function get_content(Request $request)
    {
        $id = $request->input("id");
        $id = base64_decode($id);
        $data = OurMember::where('id', $id)->first();
        if($data){
            $json["cover_image"] = '<div style="border: 1px solid #DDD;padding: 3px;background-size: cover;"><img src="'.url('public/uploads/our-member/'.$data->cover_image) .'" width="100%"></div>';
            $json["name"] = $data->name;
            $json["email"] = $data->email;
            $json["destination"] = $data->destination;
            $json["designation"] = $data->designation;
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
        $obj = new OurMember();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
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