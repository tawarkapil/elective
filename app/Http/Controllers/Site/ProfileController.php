<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Auth;

use App\Models\Country;
use App\Models\State;
use App\Models\Region;
use App\Models\Transaction;
use App\Models\CustomerActivityLog;
use App\Models\Attachment;
use App\Helpers\Encryption;
use Str;
use App\Jobs\FileUploadJob;
use AwsHelper;

class ProfileController extends Controller
{

    public function profile(Request $request){
        $input = $request->all();
        $data = Auth::guard('customer')->user();
        $default_country = 38;
        $countries = Country::orderBy('name', 'ASC')->orderBy('name', 'ASC')->pluck('name', 'country_id')->toArray();
        $states = [];
        $states = State::where('country_id', $data->country)->orderBy('name', 'ASC')->pluck('name', 'state_id')->toArray();
        return view('frontend.profile.index', [
            'input' => $input, 
            'data' => $data, 
            'countries' => $countries, 
            'states' => $states,
            'default_country' => $default_country
        ]);
    }

    public function personalInfoFrm(Request $request){
        $input = $request->all();
        $obj = new Customer();
        $response = $obj->personalInfoFrm($input);
        return json_encode($response);
    }

    public function socialFrm(Request $request){
        $input = $request->all();
        $input['customer_id'] = Auth::guard('customer')->user()->customer_id;
        $obj = new Customer();
        $response = $obj->socialFrm($input);
        return json_encode($response);
    }

    public function contactDetailsFrm(Request $request){
        $input = $request->all();
        $input['customer_id'] = Auth::guard('customer')->user()->customer_id;
        $obj = new Customer();
        $response = $obj->contactDetailsFrm($input);
        return json_encode($response);
    }

    public function studiesDetailsFrm(Request $request){
        $input = $request->all();
        $input['customer_id'] = Auth::guard('customer')->user()->customer_id;
        $obj = new Customer();
        $response = $obj->studiesDetailsFrm($input);
        return json_encode($response);
    }

    public function gallaryFrm(Request $request){
        $input = $request->all();
        $input['customer_id'] = Auth::guard('customer')->user()->customer_id;
        $obj = new Customer();
        $response = $obj->gallaryFrm($input);
        return json_encode($response);
    }

    function changePassword(Request $request){
        $input = $request->all();
        if(!Auth::guard('customer')->check()){
            return redirect('login');
        }
        return view('frontend.profile.changepassfrm',['input' => $input]);
    }

     function submitProfilePicForm(Request $request){
        $input = $request->all();
        $obj = new Customer();
        $response = $obj->submitProfilePicForm($input);
        return json_encode($response);
    }

    public function submitchangePassword(Request $request){
        $input = $request->all();
        if(!Auth::guard('customer')->check()){
            return redirect('login');
        }
        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['old_password'] = $Encryption->decrypt($input['old_password'], $enckey);
        $input['new_password'] = $Encryption->decrypt($input['new_password'], $enckey);
        $input['confirm_password'] = $Encryption->decrypt($input['confirm_password'], $enckey);
        /**decrypt fields value***/
        $obj = new Customer();
        $response = $obj->changePassword($input);
        return json_encode($response);
    }


    function removeAttachmentFile(Request $request){
        $input = $request->all();
        $upload_file = (isset($input['upload_file'])) ? $input['upload_file'] : null;
        $filePath = base_path($upload_file);
        if(file_exists($filePath)){
            Attachment::where('attachment', $input['upload_file'])->delete();
            @unlink($filePath);
        }
        $json['status'] = 1;
        $json['message'] = '';
        return json_encode($json);;

    }


    public function uploadChunkFile(Request $request){
        $input = $request->all();
        $uploaderMines = 'jpg|png|jpeg';
        $maxSizeMb = 2;

        $fieldName = 'attachments';
        $rules[$fieldName] = 'required|chckcstmdocumentminetype:'.str_replace('|', ',', $uploaderMines);


        $v = \Validator::make($input, $rules);
        if ($v->passes()) {    
            $obj = new Customer();
            $json = $obj->uploadChunkFile($fieldName, $uploaderMines, $maxSizeMb);
            if(isset($json['uploaded_fileurl'])){
                $attachObj = new Attachment();
                $attachObj->type = 'CUSTOMER_GALLARY';
                $attachObj->ref_id = Auth::guard('customer')->user()->customer_id;
                $attachObj->attachment = $json['uploaded_filekey'];
                $attachObj->save();
            }
        }else{
            $json[$fieldName][0]['name'] = $input[$fieldName]->getClientOriginalName();
            $json[$fieldName][0]['error'] = $v->errors()->first();
            $json[$fieldName][0]['type'] = $input[$fieldName]->getMimetype();
        }
        return json_encode($json);
    }

}