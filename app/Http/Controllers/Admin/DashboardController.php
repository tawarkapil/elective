<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Transaction;
use App\Models\CustomerTrip;
use ViewsHelper;


class DashboardController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    function index(Request $request){

    	$input = $request->all();
        $total_students = Customer::where('status', 1)->count();
        $total_trip = 0;
        $total_transaction_amt = Transaction::sum('payment_amount');
        $total_enquires = Enquiry::count();
        $recent_stundents = Customer::orderBy('created_at', 'desc')->take(5)->get();
        $recent_trips = CustomerTrip::orderBy('created_at', 'desc')->take(5)->get();
       
        return view('admin.dashboard.index',['input' => $input, 'total_students' => $total_students, 'total_trip' => $total_trip, 'total_transaction_amt' => $total_transaction_amt, 'total_enquires' => $total_enquires, 'recent_stundents' => $recent_stundents, 'recent_trips' => $recent_trips]);
    }

    function ajaxloadstate(Request $request){
        $input = $request->all();
        $country_id = $input['country_id'];
        $states = State::where('country_id', $country_id)->orderBy('name', 'ASC')->pluck('name', 'state_id')->toArray();
        $json['status'] = 1;
        $json['message'] = '';
        $json['states'] = $states;
        return json_encode($json);
    }

    public function deleteUploadFiles(Request $request){
        $input = $request->all();
        $upload_file = (isset($input['upload_file'])) ? $input['upload_file'] : null;
        $filePath = base_path($upload_file);
        if(file_exists($filePath)){
            @unlink($filePath);
        }
        $json['status'] = 1;
        $json['message'] = '';
        return json_encode($json);
    }
}