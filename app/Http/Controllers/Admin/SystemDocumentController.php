<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\SystemDocument;
use App\Models\Country;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class SystemDocumentController extends BaseController
{
    public function index(Request $request)
    {
    	$countries = Country::whereIn('country_id', [216, 113])->get();
        return view("admin.system-documents.index", ["request" => $request, 'countries' => $countries]);
    }

    public function details(Request $request, $id)
    {
    	$id = base64_decode($id);
    	$countrydata = Country::where('country_id', $id)->first();
    	if(!$countrydata){
    		return abort(404);
    	}

    	$documents = SystemDocument::where('country_id', $countrydata->country_id)->get();
        return view("admin.system-documents.view", ["request" => $request, 'countrydata' => $countrydata, 'documents' => $documents]);
    }

    public function addnewajax(Request $request){
        $obj = new SystemDocument();
        $input = $request->all();
        $data = $obj->addNew($input);
        return json_encode($data);
    }

     public function get_content(Request $request){

     	$input = $request->all();

        $data = SystemDocument::where('id', $input['id'])->first();
        if($data){
            $json["document_path"] = '';
            if($data->document_path){
             $json["document_path"] = '<div style="margin-top:10px;"><a target="_blank" href="'.url($data->document_path) .'" width="100%">'. $data->document_name.' <i class="fa fa-download"></i></a></div>';
            }
            $json["document_type"] = $data->document_type;
            $json["document_name"] = $data->document_name;
            $json["description"] = $data->description;
        }
        
        $json["status"] = 1;
        $json["message"] = 'Loaded...';

    return json_encode($json);
    }

    public function deleteSelected(Request $request)
    {
        $obj = new SystemDocument();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->deleteSelected($input);
        return json_encode($data);
    }
}