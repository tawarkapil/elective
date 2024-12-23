<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth,Session;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Encryption;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\State;
use App\Models\Region;
use App\Models\MembershipLevel;
use App\Models\CustomerMembershipLevel;
use App\Models\TempCustomer;
use App\Models\BillingAddress;
use App\Models\CompanyAddress;
use App\Models\Transaction;
use App\Models\PasswordTrack;
use App\Helpers\MailFunctions;
use Hash, DB, Config;
use Illuminate\Support\Str;
use Stripe;
use ViewsHelper, CommonHelper;

class StaticController extends Controller
{


    function fundMyElective(Request $request){
    	$input = $request->all();
    	return view('frontend.static-pages.fundMyElective', ['input' => $input]);
    }

    function preDepature(Request $request, $page = null){
    	$input = $request->all();
        $pagesArr = ['visa-flights', 'insurance', 'health-safety', 'packing-list'];
        if(!in_array($page, $pagesArr)){
            return abort(404);
        }
    	return view('frontend.static-pages.preDepature', ['input' => $input, 'page' => $page]);
    }

    function inCountry(Request $request, $page = null){
    	$input = $request->all();
        $pagesArr = ['orientation-logbook', 'accommodation', 'hospital-center', 'departure'];
        if(!in_array($page, $pagesArr)){
            return abort(404);
        }
    	return view('frontend.static-pages.inCountry', ['input' => $input, 'page' => $page]);
    }

    function afterMyElective(Request $request, $page = null){
    	$input = $request->all();
        $pagesArr = ['logbook', 'certificate-of-completion', 'work-with-us'];
        if(!in_array($page, $pagesArr)){
            return abort(404);
        }
    	return view('frontend.static-pages.afterMyElective', ['input' => $input, 'page' => $page]);
    } 

    function invoicePayments(Request $request){
    	$input = $request->all();
    	return view('frontend.static-pages.invoicePayments', ['input' => $input]);
    }

    function community(Request $request){
    	$input = $request->all();
    	return view('frontend.static-pages.community', ['input' => $input]);
    }

    function emergencyInfo(Request $request){
    	$input = $request->all();
    	return view('frontend.static-pages.emergencyInfo', ['input' => $input]);
    }
}