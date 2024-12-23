<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Enquiry;
use Yajra\Datatables\Datatables;
use ViewsHelper;
use Config;
use CommonHelper;

class EnquiryController extends BaseController {
    public function index(Request $request) {
        return view('admin.enquiry.index', ['request' => $request]);
    }
    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new Enquiry();
        $builder = $obj->select('*');
        $builder->where(function ($query) use ($input) {
            if (isset($input['srch_start_date'])) {
                $query->whereDate('updated_at', '>=', date('Y-m-d', strtotime($input['srch_start_date'])));
            }
            if (isset($input['srch_end_date'])) {
                $query->whereDate('updated_at', '<=', date('Y-m-d', strtotime($input['srch_end_date'])));
            }
        });
        return Datatables::of($builder)->filter(function ($query) use ($input) {
            $query->where(function ($query) use ($input) {
                if (isset($input['search']['value']) && strlen($input['search']['value']) > 0) {
                    $query->where(function ($query) use ($input) {
                        $srch = $input['search']['value'];
                        $query->orWhere('name', 'LIKE', '%' . $srch . '%')->orWhere('phone_number', 'LIKE', '%' . $srch . '%')->orWhere('subject', 'LIKE', '%' . $srch . '%')->orWhere('message', 'LIKE', '%' . $srch . '%')->orWhere('email', 'LIKE', '%' . $srch . '%');
                    });
                }
            });
        })->editColumn('created_at', function ($row) {
            return ViewsHelper::displayDate($row->created_at);
        }) ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';
                $action .= '<a class="action-icon text-muted" title="View" href="'. url('admin/enquiry/view/'.base64_encode($row->id)).'"> <i class="fa fa-eye" aria-hidden="true"></i> </a>';
                
                $action .= '</div>';
                return $action;
            })->rawColumns(['message', 'action'])->addIndexColumn()->make(true);
    }

    public function details(Request $request, $id){
       $id = base64_decode($id);
       $data = Enquiry::where('id', $id)->first();
       if (!$data){
           return abort(404);
       }

       return view('admin.enquiry.view', [
           'request' => $request, 
           'data' => $data, 
        ]);
   }   
}