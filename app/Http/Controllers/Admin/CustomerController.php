<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\StudentDocument;
use App\Models\CustomerTrip;
use App\Helpers\ViewsHelper;
use App\Helpers\CommonHelper;
use Yajra\Datatables\Datatables;
use Config, Session;
use Validator;
use DB;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    function index(Request $request){
        $input = $request->all();
        return view('admin.customer.index', ['input' => $input]);

    }

    function ajaxLoad(Request $request)
    {
        $input = $request->all();
        $builder = Customer::select('*');
        $builder->where(function ($query) use ($input) {
            if (isset($input['srch_start_date'])) {
                $query->whereDate('updated_at', '>=', date('Y-m-d', strtotime($input['srch_start_date'])));
            }
            if (isset($input['srch_end_date'])) {
                $query->whereDate('updated_at', '<=', date('Y-m-d', strtotime($input['srch_end_date'])));
            }
        });
        return Datatables::of($builder)->filter(function ($query) use ($input)
        {
            $query->where(function ($query) use ($input)
            {
                if (isset($input['search']['value']) && strlen($input['search']['value']) > 0)
                {
                    $query->where(function ($query) use ($input)
                    {
                        $srch = $input['search']['value'];
                        $name_arr = explode(' ', $srch);
                        if (isset($name_arr[0]))
                        {
                            $query->where('first_name', 'LIKE', '%' . $name_arr[0] . '%');
                        }
                        if (isset($name_arr[1]))
                        {
                            $query->where('last_name', 'LIKE', '%' . $name_arr[1] . '%');
                        }
                    })->orWhere('dial_code', 'LIKE', '%' . $input['search']['value'] . '%')->orWhere('phone_number', 'LIKE', '%' . $input['search']['value'] . '%')->orWhere('last_name', 'LIKE', '%' . $input['search']['value'] . '%')->orWhere('email', 'LIKE', '%' . $input['search']['value'] . '%');
                }
            });
        })->editColumn('first_name', function ($row)
        {
            return $row->full_name();
        })
        ->editColumn('email', function ($row)
                {
                    return $row->email;
                })
        ->editColumn('created_at', function ($row)
                {
                    return ViewsHelper::displayDate($row->created_at, true);
                })
        ->editColumn('phone_number', function ($row)
                {
                    return $row->displayPhoneNumber();
                })
        ->editColumn('action', function ($row)
        {
            $action = '<div class="action-btn">';
            $action .= '<a class="action-icon text-muted mr-2" href="' . url('admin/customers/view/' . base64_encode($row->customer_id)) . '" title="View" data-key="' . base64_encode($row->customer_id) . '"><i class="fa fa-eye"></i></a>';
            // $action .= '<a class="action-icon text-muted  mr-2" href="'.url('/admin/customers/addnew/'.base64_encode($row->customer_id)).'" title="Edit"><i class="fa fa-edit"></i></a>';
             

            if ($row->status == 1){
                $action .= '<a  class="action-icon mr-2 text-muted registeration_link_btn" href="#" title="Reset Password" data-key="' . base64_encode($row->customer_id) . '" data-name="' . $row->full_name() . '" ><i class="fa fa-lock"></i></a>';
            }

            
            if($row->status == 0){
                $action .= '<a class="action-icon  mr-2 text-muted update_status" href="#" title="Change Status" data-status="1"  data-key="'.base64_encode($row->customer_id).'"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>';
            }else{
                $action .= '<a class="action-icon mr-2 text-muted update_status" href="#" title="Change Status" data-status="0" data-key="'.base64_encode($row->customer_id).'"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>';
            }
            $action .= '</div>';
            return $action;
        })->rawColumns(['type', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

   public function details(Request $request, $customer_id)
       {
           $customer_id = base64_decode($customer_id);
           $data = Customer::where('customer_id', $customer_id)->first();
           if (!$data){
               return abort(404);
           }

           $recent_trips = CustomerTrip::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();

           $documents = StudentDocument::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
   
           return view('admin.customer.view', [
               'request' => $request, 
               'data' => $data, 
               'recent_trips' => $recent_trips,
               'documents' => $documents
            ]);
       }

    public function reset_pass_admin(Request $request){
        $obj = new Customer();
        $input = $request->all();
        $input['customer_id'] = base64_decode($input['customer_id']);
        $data = $obj->resetPassEmailAdmin($input);
        $jsondata['status'] = 1;
        $jsondata['message'] = 'Mail sent Successfully';
        return $jsondata;
    }

    function addnew(Request $request, $customer_id = null){
        $input = $request->all();
        $customer_id = base64_decode($customer_id);
        $data = Customer::where('customer_id', $customer_id)->first();
        $default_country = 38;
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'country_id')->toArray();
        $states = State::where('country_id', $default_country)->orderBy('name', 'ASC')->pluck('name', 'state_id')->toArray();
        if($data){
            $states = State::where('country_id', $data->country)->orderBy('name', 'ASC')->pluck('name', 'state_id')->toArray();
        }
        return view('admin.customer.addnew', compact(['input', 'data', 'countries', 'states', 'default_country']));
    }

    function submitFrm(Request $request)
    {
        $input = $request->all();
        $obj = new Customer();
        $input['customer_id'] = base64_decode($input['customer_id']);
        $response = $obj->addNew($input);
        return json_encode($response);
    }

    function triggerRegisterationLink(Request $request)
    {
        $input = $request->all();
        $obj = new Customer();
        $input['customer_id'] = base64_decode($input['customer_id']);
        $response = $obj->triggerRegisterationLink($input);
        return json_encode($response);
    }

    public function update_status(Request $request)
    {
        $obj = new Customer();
        $input = $request->all();
        $input['customer_id'] = base64_decode($input['customer_id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }
}