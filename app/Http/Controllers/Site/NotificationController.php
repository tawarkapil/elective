<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Notification;
use App\Helpers\ViewsHelper;
use App\Helpers\CommonHelper;
use Yajra\Datatables\Datatables;

class NotificationController extends Controller
{

    public $mainObj;
    public $viewPath;

    function __construct(){
        $this->mainObj = new Notification();
        $this->viewPath = 'frontend.notification';
    }

    function notificationList(Request $request){
        $input = $request->all();
        return view($this->viewPath.'.index', ['input' => $input]);
    }

    function ajaxLoad(Request $request){
        $input = $request->all();
        $builder = Notification::select('notifications.*')
        ->where('notifications.ref_id', Auth::guard('customer')->user()->customer_id)->where('notifications.type', 2)
        ->join('customers','customers.customer_id','=','notifications.ref_id');

        return  Datatables::of($builder)->filter(function ($query ) use($input){
                $query->where(function($query) use($input){
                    if (isset($input['search']['value']) && strlen($input['search']['value'])>0) {
                        $query->where(function($query) use($input){
                            $srch = $input['search']['value'];
                            $query->where('notifications.notification', 'LIKE', '%'. $srch.'%');
                        });
                        
                    }
                });
            })
            ->editColumn('notification', function ($row) {
                if($row->is_read == 0){
                   $row->is_read  = 1;
                   $row->save(); 
                }
                return $row->displayNotifText(); 
            })
            ->editColumn('created_at', function ($row) {
                 return ViewsHelper::displayDate($row->created_at, true);  
            })
            ->editColumn('heading', function ($row) {
                if($row->view_url){
                    return $row->heading;  
                }else{
                    return $row->heading;
                }
            })

        ->rawColumns(['heading', 'notification'])->addIndexColumn()
        ->make(true);

    }

    function read_notification(Request $request){
        $notification = Notification::where('type', 2)->where('ref_id',Auth::guard('customer')->user()->customer_id)->orderBy('id', 'DESC')->take(10)->get();
        foreach($notification as $notif)
        {
            if($notif->is_read ==0){
                $notif->is_read =1;
                $notif->save();
            }
        }
        $json['status'] = 1;
        $json['message'] = '';
        $count_notif = Notification::where('type', 2)->where('is_read',0)->where('ref_id',Auth::guard('customer')->user()->customer_id)->orderBy('id','DESC')->count();
        $json['count_notif'] = $count_notif;
        return json_encode($json);
    }
}