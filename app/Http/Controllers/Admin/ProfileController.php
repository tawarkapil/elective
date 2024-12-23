<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

use App\Helpers\Encryption;
use Auth;

class ProfileController extends Controller
{

    public function updateProfile(Request $request){
        $input = $request->all();
        $data = Auth::user();
        return view('admin.profile.index', ['input' => $input, 'data' => $data]);
    }

    public function submitupdateProfile(Request $request){
        $input = $request->all();
        $userObj = new User();
        $input['user_id'] = Auth::user()->id;
        $response = $userObj->updateProfile($input);
        return json_encode($response);
    }

    function changePassword(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('admin/login');
        }
        $input = $request->all();
        return view('admin.profile.changepassfrm',['input' => $input]);
    }

    public function submitchangePassword(Request $request){
        $input = $request->all();
        /**decrypt fields value***/
        $enckey=$input['enckey'];
        $Encryption = new Encryption();
        $input['old_password'] = $Encryption->decrypt($input['old_password'], $enckey);
        $input['new_password'] = $Encryption->decrypt($input['new_password'], $enckey);
        $input['confirm_password'] = $Encryption->decrypt($input['confirm_password'], $enckey);
        /**decrypt fields value***/
        $userObj = new User();
        $response = $userObj->changePassword($input);
        return json_encode($response);
    }

    public function uploadChunkFile(Request $request){
        $input = $request->all();
        $fileType = $input['profile_image']->getClientMimeType();
        
        $uploaderMines = \Config::get('constants.allowFiles.image');
        $maxSizeMb = \Config::get('constants.allowFileSize');
        $fieldName = 'profile_image';
        $rules[$fieldName] = 'required|chckcstmmimestype:image';

        $v = \Validator::make($input, $rules);
        if ($v->passes()) {    
            $obj = new User();
            $json = $obj->uploadChunkFile($fieldName, $uploaderMines, $maxSizeMb);
        }else{
            $json[$fieldName][0]['name'] = $input[$fieldName]->getClientOriginalName();
            $json[$fieldName][0]['error'] = $v->errors()->first();
            $json[$fieldName][0]['type'] = $input[$fieldName]->getMimetype();
        }
        return json_encode($json);
    }

}