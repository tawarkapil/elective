<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use App\Models\CustomerTrip;
use App\Models\Trip;
use App\Models\TripCustomers;
use App\Helpers\CommonHelper;
use App\Models\Destination;
use App\Models\Program;
use App\Models\Addon;
use App\Models\Tour;
use App\Models\Pricing;
use App\Helpers\ViewsHelper;
use Yajra\Datatables\Datatables;

class TripController extends Controller
{
    
    function index(Request $request){
        $input = $request->all();
        return view('frontend.trip.index', ['input' => $input]);
    }

    function ajaxLoad(Request $request){
        $input = $request->all();

        $builder = Trip::select('cust_trips.*', 'mst_programs.title as program_title', 'mst_destinations.title as destination_title');
         $builder->join('trip_customers','cust_trips.id','=','trip_customers.trip_id');
         $builder->join('customers','customers.customer_id','=','trip_customers.customer_id');
         $builder->join('mst_destinations','mst_destinations.id','=','cust_trips.destination_id');
         $builder->join('mst_programs','mst_programs.id','=','cust_trips.program_id');

         $builder->where('trip_customers.customer_id', Auth::guard('customer')->user()->customer_id);

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
                   return $row->program_title .' - '. $row->destination_title ; 
            })
            ->editColumn('status', function ($row) {
                   return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            }) 
            ->editColumn('action', function ($row) {
                $action = '<div class="<div class="text-nowrap text-center table-action" style="font-size:18px;">';
                $action .= '<a title="View" class="action-icon text-muted" href="'.url('my-trips/view/'.base64_encode($row->id)).'" > <i class="fa fa-eye" aria-hidden="true"></i> </a>';

                $action .= '<a title="Edit" class="action-icon text-muted" href="'.url('my-trips/addnew/'.base64_encode($row->id)).'" > <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                $action .= '</div>';
                return $action;
            })

        ->rawColumns(['cover_image', 'action'])->addIndexColumn()
        ->make(true);

    }

    function addnew(Request $request, $id = null){
        $id = base64_decode($id);
        $input = $request->all();
        $customerdata = Auth::guard('customer')->user();

        $data = Trip::where('id', $id)->where('customer_id', $customerdata->customer_id)->first();

        $destinations = Destination::where('status', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray(); 
        
        $programs = [];
        $tours = [];
        $addons = [];
        if($id && !$data){
            return abort(404);
        }

        if($data){
            $programs = Program::select('mst_programs.*')
            ->join('mst_destination_programs', 'mst_destination_programs.program_id', 'mst_programs.id')
            ->where('mst_destination_programs.destination_id', $data->destination_id)
            ->where('mst_programs.status', 1)->orderBy('mst_programs.title', 'ASC')->pluck('title', 'id')->toArray();

            $tours = Tour::where('destination', $data->destination_id)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
            $addons = Addon::where('program', $data->program_id)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        }

        return view('frontend.trip.addnew', compact(
            ['input', 'data', 'destinations', 'programs', 'tours', 'addons']
        ));
    }


    function loadPrograms(Request $request){
        $input = $request->all();
        $destination_id = isset($input['destination_id']) ? $input['destination_id'] : null;
        $programs = Program::select('mst_programs.*')
            ->join('mst_destination_programs', 'mst_destination_programs.program_id', 'mst_programs.id')
            ->where('mst_destination_programs.destination_id', $destination_id)
            ->where('mst_programs.status', 1)->orderBy('mst_programs.title', 'ASC')->pluck('title', 'id')->toArray();

        $tours = Tour::where('destination', $destination_id)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();

        $options = '<option value="">Please Select</option>';
        foreach($programs as $id => $val){
            $options .= '<option value="'.$id.'">'.$val.'</option>';
        }
        $tour_options = '';
        foreach($tours as $id => $val){
            $tour_options .= '<option value="'.$id.'">'.$val.'</option>';
        }

        $json['status'] = 1;
        $json['message'] = 'Loaded...';
        $json['option'] = $options;
        $json['tour_option'] = $tour_options;
        return json_encode($json);

    }


    function loadEvents(Request $request){
        $input = $request->all();
        $program_id = isset($input['program_id']) ? $input['program_id'] : null;
        $addons = Addon::where('program', $program_id)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();

        $options = '';
        foreach($addons as $id => $val){
            $options .= '<option value="'.$id.'">'.$val.'</option>';
        }

        $json['status'] = 1;
        $json['message'] = 'Loaded...';
        $json['option'] = $options;
        return json_encode($json);
    }

    public function addnewajax(Request $request)
    {
        $obj = new Trip();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function details(Request $request, $id = null) {
        $id = base64_decode($id);
        $data = Trip::where('id', $id)->first();
        
        if($id && !$data){
            return abort(404);
        }
        return view('admin.trip.view', ['request' => $request, 'data' => $data, 'tripcustomers' => $tripcustomers]);
    }

    public function loadPaymentSummary(Request $request){
        $input = $request->all();
        $duration = $input['duration'];
        $input['tour_ids'] = (isset($input['tour_ids'])) ? $input['tour_ids'] : [] ;
        $input['event_ids'] = (isset($input['event_ids'])) ? $input['event_ids'] : []  ;
        $programdata = Program::where('id', $input['program_id'])->first();

        $html = '';

        if($programdata && $duration > 0){

            $pricedata = Pricing::where('destination', $input['destination_id'])->first();
            if(!$pricedata){
              $json['status'] = 2;
              $json['message'] = 'Something went wrong';
              return json_encode($json);
            }

            $program_name = $programdata->title;
            $members = 1;

            $tours_payment = Tour::whereIn('id', $input['tour_ids'])->sum('payment_amount');
            $events_payment = Addon::whereIn('id', $input['event_ids'])->sum('payment_amount');
            $tours_name = Tour::whereIn('id', $input['tour_ids'])->pluck('title')->toArray();
            $events_name = Addon::whereIn('id', $input['event_ids'])->pluck('title')->toArray();

            $total_payment = 0;
            $destination_payment = 0;
            $extra_week_payment = 0;

            if($pricedata){
              if($input['duration'] <= 6){
                $ssj  = "week".$input['duration']."_payment";
                $destination_payment = $pricedata->{$ssj};

              }else{
                $destination_payment = $pricedata->week6_payment;
                $extra_week_payment = ($input['duration'] - 6) * $pricedata->extra_week_payment;
              }
            }

            $total_payment += ($members * $destination_payment) + ($members * $extra_week_payment);

            //$total_payment += $destination_payment;
            $total_payment += $tours_payment;
            $total_payment += $events_payment;

            $html = view('frontend.trip._ajax_load_payment_summary', [
                'program_name' => 'program_name', 
                'duration' => $duration, 
                'members' => $members, 
                'tours_payment' => $tours_payment, 
                'events_payment' => $events_payment, 
                'tours_name' => $tours_name, 
                'events_name' => $events_name, 
                'destination_payment' => $destination_payment,
                'total_payment' => $total_payment
            ]);
            $html = $html->render();
        }

        $json['status'] = 1;
        $json['message'] = 'Loaded...';
        $json['html'] = $html;
        return json_encode($json);
    }


    public function update_status(Request $request){
        $obj = new CustomerTrip();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }
}