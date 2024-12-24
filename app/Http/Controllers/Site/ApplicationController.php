<?php
namespace App\Http\Controllers\Site;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Transaction;
use App\Models\Destination;
use App\Models\Program;
use App\Models\Tour;
use App\Models\Addon;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Str;
use Auth;
use Stripe;
use Config;

class ApplicationController extends BaseController{


    function application(Request $request, $stepName = 'basic'){
        // print_r($stepName);die;
    	$input = $request->all();
        $active_steps = 1;
    	$programs = Program::where('status', 1)->pluck('title', 'id')->toArray();
        $programs = ['' => 'Please Select'] + $programs;
        $data = Application::where('customer_id', Auth::guard('customer')->user()->customer_id)->first();
        $destinations = ['' => 'Please Select'];
        
        if($data){
            $active_steps = $data->step;
        }

        if($data){
        $destinations = Destination::select('mst_destinations.*')
            ->join('mst_destination_programs', 'mst_destination_programs.destination_id', 'mst_destinations.id')
            ->where('mst_destination_programs.program_id', $data->program)
            ->where('mst_destinations.status', 1)
            ->groupBy('mst_destinations.id')
            ->pluck('mst_destinations.title', 'mst_destinations.id')
            ->toArray();
            $destinations = ['' => 'Please Select'] + $destinations;
        }

        if(!$data){
            $data = Auth::guard('customer')->user();
        }

        $default_country = 38;
        $countries = Country::orderBy('name', 'ASC')->orderBy('name', 'ASC')->pluck('name', 'country_id')->toArray();
        $states = [];
        $states = State::where('country_id', $data->country)->orderBy('name', 'ASC')->pluck('name', 'state_id')->toArray();


        $tours = Tour::where('destination', $data->destination)->get();
        $addons = Addon::where('program', $data->program)->get();

        return view('frontend.profile.application', ['input' => $input, 'data' => $data, 'programs' => $programs, 'destinations' => $destinations, 'countries' => $countries, 'stepName' => $stepName, 'active_steps' => $active_steps, 'tours' => $tours, 'addons' => $addons]);
    }

    public function acceptTermAndCondition(Request $request){
        $input = $request->all();
        $rules = [
            'accept_terms_condition' => 'required|in:Yes',
            'g-recaptcha-response' => 'required|check_valid_gcaptcha'
        ];

        $newnames  = [
            'verification_email' => 'email',
            'g-recaptcha-response' => 'captcha',
        ];

        $v = \Validator::make($input, $rules);
        $v->setAttributeNames($newnames);

        if ($v->passes()){
            $input['customer_id'] = 1;

            $data = Application::where('customer_id', $input['customer_id'])->first();
            if(!$data){
                $json['status'] = 2;
                $json['message'] = 'You have not completed your application. Before making a deposit, you need to complete your application.';
                return json_encode($json);
            }

            $data->payable_amount = \Config::get('params.registeration_deposit');
            $data->accept_terms_condition = $input['accept_terms_condition'];
            //$data->payment_token = Str::random(105);
            $data->save();

            $json['redirect_url'] = url('application/deposit-payment');
            $json['status'] = 1;
            $json['message'] = 'Verification mail sent successfully.';
        }else{
            $json['status'] = 0;
            $json['message'] = $v->messages(); 
        }

        return json_encode($json);
    }


    public function depositPayment(Request $request){

        $input['customer_id'] = 1;
        $user = Auth::guard('customer')->user();
        $data = Application::where('customer_id', $user->customer_id)->first();
        if(!$data || ($data && $data->accept_terms_condition != 'Yes')){
            return redirect('application');
        }
        
        return view('frontend.profile.deposit-payment', ['input' => $input, 'data' => $data,'amount'=>400]);
    }

    public function stripepayment(Request $request){
        $input =  $request->all();
        $obj = new Application();
        // print_r($obj);die;
        // $input['customer_id'] = 1;
        $response = $obj->stripepaymentRegistrationFee($input);
        return json_encode($response);
    }

    function paymentSuccess(Request $request, $payment_token){

        $input = $request->all();
        $input['customer_id'] = 1;
        
        $invoicedata = Transaction::where('customer_id', $input['customer_id'])->where('payment_token', $payment_token)->first();
        if(!$invoicedata){
            return redirect()->back()->with('messages','Invalid service');   
        }
        
        return view('frontend.profile.payment-success', ['input' => $input, 'invoicedata' => $invoicedata]);
    }

    public function loadDestination(Request $request){
        $input =  $request->all();
        $destinations = Destination::select('mst_destinations.*')
        ->join('mst_destination_programs', 'mst_destination_programs.destination_id', 'mst_destinations.id')
        ->where('mst_destination_programs.program_id', $input['program'])
        ->where('mst_destinations.status', 1)->groupBy('mst_destinations.id')->pluck('mst_destinations.title', 'mst_destinations.id')->toArray();

        $destinations = ['' => 'Please Select'] + $destinations;
        $html = '';
        foreach($destinations as $key => $val){
            $html .= '<option value="'.$key.'">'.$val.'</option>';
        }
        $json['status'] = 1;
        $json['message'] = 'Loaded successfully';
        $json['html'] = $html;
        return json_encode($json);
    }

    public function personalInfoFrm(Request $request){
        $input =  $request->all();
        $obj = new Application();
        $input['customer_id'] = \Auth::guard('customer')->user()->customer_id;
        $response = $obj->personalInfoFrm($input);
        return json_encode($response);
    }

    public function submitFrm(Request $request){
        $input =  $request->all();
        $obj = new Application();
        $input['customer_id'] = \Auth::guard('customer')->user()->customer_id;
        $response = $obj->submitFrm($input);
        return json_encode($response);
    }

    function applicationDocuments(Request $request){
    	$input = $request->all();
        return view('frontend.profile.application-documents', ['input' => $input]);
    }

    function studentDocumentsUpload(Request $request){
        $input = $request->all();
        $input['loan_id'] = 1;
        $obj = new Application();
        $response = $obj->studentDocumentsUpload($input);
        return json_encode($response);
    }

    function loadPaymentSummary(Request $request){
        $input = $request->all();
        
        $destination = Destination::where('id', $input['destination'])->first();
        $program     = Program::where('id', $input['program'])->first();
        $array['programName'] = ($program) ? $program->title : null;
        $array['destinationName'] = ($destination) ? $destination->title.' - ' . $destination->getcountry->name : null;
        $array['ArrivalDate'] = ($input['trip_start_date']) ? $input['trip_start_date'] : null;
        $array['duration'] = $input['duration'];
        $array['destination'] = ($destination) ? $destination->id : 0;

        $summaryConf = \ViewsHelper::getApplicationSummary($array);
        $html = view('frontend.profile._summary', ['summaryConf' => $summaryConf]);
        $response['status'] = 1;
        $response['message'] = 'loaded';
        $response['html'] = $html->render();
        return json_encode($response);
    }
}