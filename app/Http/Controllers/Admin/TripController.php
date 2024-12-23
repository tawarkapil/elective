<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use App\Models\CustomerTrip;
use App\Models\TripCustomers;
use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use Yajra\Datatables\Datatables;

class TripController extends Controller
{
    
    function index(Request $request){
        $input = $request->all();
        return view('admin.trip.index', ['input' => $input]);
    }

    function ajaxLoad(Request $request){
        $input = $request->all();
        $obj = new CustomerTrip();
        $builder = $obj->select('cust_trips.*', 'customers.first_name', 'customers.last_name', 'mst_destinations.title as destination_title', 'mst_programs.title as program_title');
         $builder->join('customers','customers.customer_id','=','cust_trips.customer_id');
         $builder->leftJoin('mst_destinations','mst_destinations.id','=','cust_trips.destination_id');
         $builder->leftJoin('mst_programs','mst_programs.id','=','cust_trips.program_id');

        $builder->where(function($query) use($input){
            if(isset($input['srch_start_date'])){
                $query->whereDate('cust_trips.updated_at','>=', date('Y-m-d', strtotime($input['srch_start_date'])));
            }
            if(isset($input['srch_end_date'])){
                $query->whereDate('cust_trips.updated_at','<=', date('Y-m-d', strtotime($input['srch_end_date'])));
            } 
        });

        return  Datatables::of($builder)->filter(function ($query ) use($input){
                $query->where(function($query) use($input){
                    if (isset($input['search']['value']) && strlen($input['search']['value'])>0) {
                        $query->where(function($query) use($input){
                            $srch = $input['search']['value'];
                            $name_arr = explode(" ", $srch);
                            if (isset($name_arr[0])) {
                                $query->where("customers.first_name", "LIKE", "%" . $name_arr[0] . "%");
                            }
                            if (isset($name_arr[1])) {
                                $query->where("customers.last_name", "LIKE", "%" . $name_arr[1] . "%");
                            }

                            $arr = [1 => 'Active', 0 => 'Inactive'];
                            $status_arr =CommonHelper::FILTER_ARRAY_VALUES_REGEXP("/".$input['search']['value']."/i",  $arr);
                            $status_arr = array_keys($status_arr);
                            if(isset($status_arr[0])){
                                $query->orWhereIn('cust_trips.status', $status_arr);
                            }
                        })
                        ->orWhere('cust_trips.title', 'LIKE', '%'.$input['search']['value'].'%')
                        ->orWhere('mst_programs.title', 'LIKE', '%' . $input['search']['value'] . '%')
                        ->orWhere("mst_destinations.title", "LIKE", "%" . $input["search"]["value"] . "%");
                    }
                });
            })
            ->editColumn('cover_image', function($row){
                return '<div class="text-center"><img src="'.\ViewsHelper::getTripCoverImage($row).'" style="height: 60px;width: 60px;object-fit: cover;"></div>';
            })

            ->editColumn('customers.first_name', function ($row) {
                   return $row->first_name.' '.$row->last_name; 
            })

            ->editColumn('mst_programs.title', function ($row) {
                   return $row->program_title; 
            })

            ->editColumn('mst_destinations.title', function ($row) {
                   return $row->destination_title; 
            })

          
            ->editColumn('status', function ($row) {
                   return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            }) 
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';
                $action .= '<a title="View" class="action-icon text-muted" href="'.url('admin/trips/view/'.base64_encode($row->id)).'" > <i class="fa fa-eye" aria-hidden="true"></i> </a>';
                if($row->status == 0){
                    $action .= '<a class="action-icon  mr-2 text-muted update_status" href="#" title="Change Status" data-status="1"  data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>';
                }else{
                    $action .= '<a class="action-icon mr-2 text-muted update_status" href="#" title="Change Status" data-status="0" data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>';
                }

                $action .= '</div>';


                return $action;
            })

        ->rawColumns(['cover_image', 'action'])->addIndexColumn()
        ->make(true);

    }

    // public function addnew(Request $request, $id = null){
    //     $input = $request->all();
    //     $data = false;
    //     $id = base64_decode($id);
    //     $obj = $this->mainObj;
    //     if($id){
    //         $data = $obj->getByKey($id);
    //         if(!$data){
    //             abort(404);
    //         }
    //     }
    //     return view($this->viewPath.'.addnew',['input' => $input, 'data' => $data]);
    // }

    public function details(Request $request, $id = null) {
        $id = base64_decode($id);
        $data = CustomerTrip::where('id', $id)->first();
        if (!$data) {
            return abort(404);
        }
        $tripcustomers = TripCustomers::where('trip_id', $data->id)->orderBy('created_at', 'asc')->get();
        return view('admin.trip.view', ['request' => $request, 'data' => $data, 'tripcustomers' => $tripcustomers]);
    }


    public function update_status(Request $request){
        $obj = new CustomerTrip();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }

    public function addnewajax(Request $request){
        $obj = CustomerTrip();
        $input = $request->all();
        $input['presentation_id'] = base64_decode($input['presentation_id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }
}







