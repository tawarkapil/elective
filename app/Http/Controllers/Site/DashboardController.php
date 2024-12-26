<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\StudentDocument;
use App\Models\SystemDocument;
use App\Models\OurMember;
use App\Models\Application;
use App\Models\ProgramCall;
use App\Models\Tour;
use App\Models\Addon;
use App\Models\CustomerTrip;
use Auth;

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
        return view('frontend.dashboard.index', ['input' => $input]);
    }

    function guide(Request $request){
         $input = $request->all();
        return view('frontend.dashboard.guide', ['input' => $input]);
    }

    function myelective(Request $request){
        
        $input = $request->all();
        $ourmembers = OurMember::get();
        $array = [];
        $data = Application::where('customer_id', \Auth::guard('customer')->user()->customer_id)->with(['getprogram','getdestination'])->first();
        $array['programName']     = ($data) ? $data->getprogram->title : null;
        $array['destinationName'] = ($data) ? $data->getdestination->title.' - ' . $data->getdestination->getcountry->name : null;
        $array['ArrivalDate']     = ($data) ? $data->trip_start_date : null;
        $array['duration']        = ($data) ? $data->duration : null;
        $array['destination']     = ($data) ? $data->getdestination->id : 0;
        $calls  = ProgramCall::where('application',$data->id)->get();
        
        // print_r($array);die;
        $summaryConf = \ViewsHelper::getApplicationSummary($array);
        $customerTrip = CustomerTrip::where('application_id', $data->id)->first();
        // tour and addons get
        $tour = Tour::where('destination',$data->destination)->get();
        $addon = Addon:: where('program',$data->program)->get();
        //view files retun with data
        return view('frontend.dashboard.myelective', ['customerTrip'=>$customerTrip,'calls'=>$calls, 'summaryConf'=>  $summaryConf, 'tour'=>$tour,'addon'=>$addon,'applicatinData'=>$data,'input' => $input, 'ourmembers' => $ourmembers]);
    }

    function myAddOnEvents(Request $request){
         $input = $request->all();
        return view('frontend.dashboard.my-addon-events', ['input' => $input]);
    }

    function myTours(Request $request){
         $input = $request->all();
        return view('frontend.dashboard.my-tours', ['input' => $input]);
    }

    function guidegroup(Request $request){
         $input = $request->all();
        return view('frontend.dashboard.guide-group', ['input' => $input]);
    }

    function guideblogs(Request $request){
         $input = $request->all();
        return view('frontend.dashboard.guide-blogs', ['input' => $input]);
    }

    function guidedocuments(Request $request){
         $input = $request->all();
         $system_documents = SystemDocument::where('country_id', 113)->get();
         $documents = StudentDocument::where('customer_id', \Auth::guard('customer')->user()->customer_id)->get();
         $student_document = [];
         foreach($documents as $key => $row){
               $student_document[$row->document_type][$row->student_doc_type] = $row;
         }
        return view('frontend.dashboard.guide-documents', ['input' => $input, 'system_documents' => $system_documents, 'student_document' => $student_document]);
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
}