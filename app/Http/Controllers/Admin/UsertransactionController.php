<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Usertransaction;
use App\Models\Plan;
use Yajra\Datatables\Datatables;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class UsertransactionController extends BaseController {

    public function index(Request $request) {
        $plans = Plan::orderBy('plan_title', 'ASC')->pluck('plan_title', 'id')->toArray();
        return view('admin.usertransaction.index', ['request' => $request, 'plans' => $plans]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new Usertransaction();
        $builder = $obj->select('user_transactions.*', 'customers.first_name', 'customers.last_name', 'customers.email', 'customers.phone_number', 'membership_plans.plan_title');
         $builder->join('customers','customers.customer_id','=','user_transactions.customer_id');
         $builder->join('membership_plans','membership_plans.id','=','user_transactions.plan_id');

        $builder->where(function($query) use($input){
            if(isset($input['srch_start_date'])){
                $query->whereDate('user_transactions.updated_at','>=', date('Y-m-d', strtotime($input['srch_start_date'])));
            }
            if(isset($input['srch_end_date'])){
                $query->whereDate('user_transactions.updated_at','<=', date('Y-m-d', strtotime($input['srch_end_date'])));
            } 

            if(isset($input['srch_plan_type'])){
                $query->where('user_transactions.plan_id', $input['srch_plan_type']);
            } 
            
        });

        return  Datatables::of($builder)->filter(function ($query ) use($input){
                $query->where(function($query) use($input){
                    if (isset($input['search']['value']) && strlen($input['search']['value'])>0) {
                        $query->where(function($query) use($input){
                            $srch = $input['search']['value'];
                            $query
                            ->orWhere('membership_plans.plan_title', 'LIKE', '%'.$srch.'%')
                            ->orWhere('customers.name', 'LIKE', '%'.$srch.'%')
                            ->orWhere('customers.email', 'LIKE', '%'.$srch.'%')
                            ->orWhere('customers.phone_number', 'LIKE', '%'.$srch.'%')
                            ->orWhere('amount', 'LIKE', '%'.$srch.'%');
                            //->orWhere('payment_mode', 'LIKE', '%'.$srch.'%');

                            $arr = [0 => 'Pending', 1 => 'Paid', 2 => 'Failed'];
                            $status_arr =CommonHelper::FILTER_ARRAY_VALUES_REGEXP("/".$input['search']['value']."/i",  $arr);
                            $status_arr = array_keys($status_arr);
                            if(isset($status_arr[0])){
                                $query->orWhereIn('status', $status_arr);
                            }
                            
                       });
                    }
                });
            })
            
            ->editColumn('customers.first_name', function ($row) {
                   return $row->first_name.' '.$row->last_name; 
            })
            ->editColumn('customers.email', function ($row) {
                   return $row->email.'<br>'.$row->phone_number; 
            })
            ->editColumn('membership_plans.plan_title', function ($row) {
                   return $row->plan_title; 
            })
            ->editColumn('status', function ($row) {
                $statusArr = [0 => 'Pending', 1 => 'Paid', 2 => 'Failed'];
                   return isset($statusArr[$row->status]) ? $statusArr[$row->status] : 'N/A'; 
            })

            ->editColumn('amount', function ($row) {  
                return ViewsHelper::displayAmount($row->amount);  
            })
           
            ->editColumn('updated_at', function ($row) {  
                return ViewsHelper::displayDate($row->updated_at);  
            })
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';
                $action .= '<a class="action-icon text-muted" title="View" href="'. url('admin/user-transaction/detail/'.base64_encode($row->id)).'"> <i class="fa fa-eye" aria-hidden="true"></i> </a>';
                
                $action .= '</div>';
                return $action;
            })

        ->rawColumns(['customers.email', 'amount', 'action'])->addIndexColumn()
        ->make(true);
    }

   
    public function detail(Request $request, $id = null) {
        $id = base64_decode($id);
        $data = Usertransaction::where('id', $id)->first();
        if (!$data) {
            return abort(404);
        }
        return view('admin.usertransaction.view', ['request' => $request, 'data' => $data]);
    }
}