<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\Pricing;
use App\Models\Destination;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class PricingController extends BaseController
{
    public function index(Request $request)
    {
        $destinationdata = Destination::where('status', 1)->orderBy('title', 'ASC')->get();

        foreach($destinationdata as $row){
            $destinations[$row->id] = $row->title.' - '.$row->getcountry->name;
        }
        return view("admin.pricing.index", ["request" => $request, 'destinations' => $destinations]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new Pricing();
        $builder = $obj->select('mst_pricing.*', 'mst_destinations.title as destination_title')
        ->join("mst_destinations", "mst_pricing.destination", "=", "mst_destinations.id");;

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
                            ->where('mst_pricing.title', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_pricing.payment_amount', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_destinations.title', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_pricing.description', 'LIKE', '%'.$srch.'%');

                            $arr = [1 => 'Active', 0 => 'Inactive'];
                            $status_arr =CommonHelper::FILTER_ARRAY_VALUES_REGEXP("/".$input['search']['value']."/i",  $arr);
                            $status_arr = array_keys($status_arr);
                            if(isset($status_arr[0])){
                                $query->orWhereIn('mst_pricing.status', $status_arr);
                            }
                       });
                    }
                });
            })

            ->editColumn('title', function ($row) {
                   return $row->title; 
            })
            ->editColumn('mst_destinations.title', function ($row) {
                return $row->destination_title; 
            })
            ->editColumn('name', function ($row) {
                   return $row->name; 
            })
            ->editColumn('status', function ($row) {
                   return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('description', function ($row) {
                $html = '<a href="#" data-key="'.$row->id.'" class="open_view_description_btn">View description</a><div id="open_description_box_'.$row->id.'" style="display: none;">'.$row->description.'</div>';
                   return $html; 
            }) 
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            })
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';
                $action .= '<a title="View" class="action-icon text-muted"  href="'.url('admin/pricing/view/'.base64_encode($row->id)).'" > <i class="fa fa-eye" aria-hidden="true"></i> </a>';
                $action .= '<a title="Edit" class="editBtn action-icon text-muted" data-key="'.base64_encode($row->id) .'" href="#" > <i class="fa fa-edit" aria-hidden="true"></i> </a>';
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

    public function addnewajax(Request $request)
    {
        $obj = new Pricing();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function get_content(Request $request)
    {
        $id = $request->input("id");
        $id = base64_decode($id);
        $data = Pricing::where('id', $id)->first();
        if($data){
            $json["title"] = $data->title;
            $json["destination"] = $data->destination;
            $json["week1_payment"] = $data->week1_payment;
            $json["week2_payment"] = $data->week2_payment;
            $json["week3_payment"] = $data->week3_payment;
            $json["week4_payment"] = $data->week4_payment;
            $json["week5_payment"] = $data->week5_payment;
            $json["week6_payment"] = $data->week6_payment;
            $json["extra_week_payment"] = $data->extra_week_payment;
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
        $obj = new Pricing();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }

    public function details(Request $request, $id = null) {
        $id = base64_decode($id);
        $data = Pricing::where('id', $id)->first();
        if (!$data) {
            return abort(404);
        }
        return view('admin.pricing.view', ['request' => $request, 'data' => $data]);
    }
}