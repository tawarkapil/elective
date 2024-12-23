<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Enquiry;
use App\Models\Program;
use App\Helpers\Encryption;
use Str;

class PageController extends Controller
{
	 function contact(Request $request) {
        $programs = Program::orderBy('title', 'desc')->pluck('title', 'id')->toArray();
        return view('frontend.pages.contact', ['request' => $request, 'programs' => $programs]);
    }

    function contactfrm(Request $request) {
        $input = $request->all();
        $obj = new Enquiry();
        $response = $obj->addNew($input);
        return json_encode($response);
    }

    function termsConditions(Request $request) {
        return view('frontend.pages.terms-conditions', ['request' => $request]);
    }

    function aboutUs(Request $request) {
        return view('frontend.pages.about-us', ['request' => $request]);
    }

    
    function privacyPolicy(Request $request) {
        return view('frontend.pages.privacy-policy', ['request' => $request]);
    }
}