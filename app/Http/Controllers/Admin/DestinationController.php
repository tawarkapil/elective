<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use App\Models\Destination;
use App\Models\Program;
use App\Models\DestinationProgram;
use App\Models\Country;
use ViewsHelper;
use CommonHelper;
use UserHelper;

class DestinationController extends BaseController
{
    public function index(Request $request)
    {
        $programs = Program::where('status', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->toArray();
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'country_id')->toArray();
        return view("admin.destination.index", ["request" => $request, 'countries' => $countries, 'programs' => $programs]);
    }

    public function ajax_list(Request $request) {
        $input = $request->all();
        $obj = new Destination();
        $builder = $obj->select('mst_destinations.*', 'countries.name as country_name')
        //->join("mst_programs", "mst_destinations.program", "=", "mst_programs.id")
        ->join("countries", "mst_destinations.country", "=", "countries.country_id");

        $builder->where(function($query) use($input){
            if(isset($input['srch_start_date'])){
                $query->whereDate('mst_destinations.updated_at','>=', date('Y-m-d', strtotime($input['srch_start_date'])));
            }
            if(isset($input['srch_end_date'])){
                $query->whereDate('mst_destinations.updated_at','<=', date('Y-m-d', strtotime($input['srch_end_date'])));
            } 
            
        });

        return  Datatables::of($builder)->filter(function ($query ) use($input){
                $query->where(function($query) use($input){
                    if (isset($input['search']['value']) && strlen($input['search']['value'])>0) {
                        $query->where(function($query) use($input){
                            $srch = $input['search']['value'];
                            $query
                            ->where('mst_destinations.title', 'LIKE', '%'.$srch.'%')
                            ->orWhere('countries.name', 'LIKE', '%'.$srch.'%')
                            ->orWhere('mst_destinations.description', 'LIKE', '%'.$srch.'%');

                            $arr = [1 => 'Active', 0 => 'Inactive'];
                            $status_arr =CommonHelper::FILTER_ARRAY_VALUES_REGEXP("/".$input['search']['value']."/i",  $arr);
                            $status_arr = array_keys($status_arr);
                            if(isset($status_arr[0])){
                                $query->orWhereIn('status', $status_arr);
                            }
                       });
                    }
                });
            })

            ->editColumn('image', function ($row) {
                $html = '';
                if($row->image){
                    $html = '<img src="'.url('public/uploads/destinations/'.$row->image) .'" style="border: 1px solid #DDD;padding: 1px;height: 80px;width: 90px;">';
                }

                  return $html; 
            })

            ->editColumn('subject', function ($row) {
                   return $row->subject; 
            })
             ->editColumn('countries.name', function ($row) {
                return $row->country_name; 
            })
            ->editColumn('programs', function ($row) {
                $programIds = $row->getPrograms();
                $programs = Program::whereIn('id', $programIds)->pluck('title')->toArray();
                $html = '<ul>';
                foreach($programs as $program){
                    $html .= '<li>'.$program.'</li>';
                }
                $html .= '</ul>';
                return $html; 
            })
            
            ->editColumn('name', function ($row) {
                   return $row->name; 
            })
            ->editColumn('status', function ($row) {
                   return ($row->status) ? 'Active' : 'Inactive'; 
            })
            ->editColumn('description', function ($row) {
                $html = '<a href="#" data-key="'.$row->id.'" class="open_view_description_btn">View description</a><div id="open_description_box_'.$row->id.'" style="display: none;">'.$row->description.'</div>';
                   return $html; 
            }) 
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            })
            ->editColumn('action', function ($row) {
                $action = '<div class="text-nowrap text-center table-action">';

                $action .= '<a title="View" class="action-icon text-muted"  href="'.url('admin/destinations/view/'.base64_encode($row->id)).'" > <i class="fa fa-eye" aria-hidden="true"></i> </a>';
                $action .= '<a title="Edit" class="editBtn action-icon text-muted" data-key="'.base64_encode($row->id) .'" href="#" > <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                if($row->status == 0){
                    $action .= '<a class="action-icon  mr-2 text-muted update_status" href="#" title="Change Status" data-status="1"  data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-danger fa fa-times font-medium-1"></i></a>';
                }else{
                    $action .= '<a class="action-icon mr-2 text-muted update_status" href="#" title="Change Status" data-status="0" data-key="'.base64_encode($row->id).'"><i class="badge-circle badge-circle-success fa fa-check-circle font-medium-1"></i></a>';
                }
                $action .= '</div>';
                return $action;
            })

        ->rawColumns(['image', 'programs', 'description', 'action'])->addIndexColumn()
        ->make(true);
    }

    public function addnewajax(Request $request)
    {
        $obj = new Destination();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

    public function get_content(Request $request)
    {
        $id = $request->input("id");
        $id = base64_decode($id);
        $data = Destination::where('id', $id)->first();
        if($data){
            $json["image"] = '';
            if($data->image){
             $json["image"] = '<div style="border: 1px solid #DDD;padding: 3px;background-size: cover;"><img src="'.url('public/uploads/destinations/'.$data->image) .'" width="100%"></div>';
            }
            
            // $json["attachments_html"] = $data->displayAttachmentsHtml();
            // $json["attachments"] = $data->getAttachmentArr();

            $json["title"] = $data->title;
            $json["programs"] = $data->getPrograms();
            $json["country"] = $data->country;
            $json["cstatus"] = $data->status;
            $json["description"] = $data->description;
            $json["status"] = 1;
            $json["message"] = 'Loaded...';
        }else{
            $json["status"] = 0;
            $json["message"] = 'Something went wrong.';
        }
    return json_encode($json);
    }

    public function update_status(Request $request)
    {
        $obj = new Destination();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->updateStatus($input);
        return json_encode($data);
    }

    public function deleteSelected(Request $request)
    {
        $obj = new Destination();
        $input = $request->all();
        $input['id'] = base64_decode($input['id']);
        $data = $obj->deleteSelected($input);
        return json_encode($data);
    }

    public function uploadChunkFile(Request $request){
        $input = $request->all();
        $uploaderMines = 'jpg|png|jpeg';
        $maxSizeMb = 2;

        $fieldName = 'attachments';
        $rules[$fieldName] = 'required|chckcstmdocumentminetype:'.str_replace('|', ',', $uploaderMines);


        $v = \Validator::make($input, $rules);
        if ($v->passes()) {    
            $obj = new Destination();
            $json = $obj->uploadChunkFile($fieldName, $uploaderMines, $maxSizeMb);
        }else{
            $json[$fieldName][0]['name'] = $input[$fieldName]->getClientOriginalName();
            $json[$fieldName][0]['error'] = $v->errors()->first();
            $json[$fieldName][0]['type'] = $input[$fieldName]->getMimetype();
        }
        return json_encode($json);
    }

    public function details(Request $request, $id = null) {
        $id = base64_decode($id);
        $data = Destination::where('id', $id)->first();
        if (!$data) {
            return abort(404);
        }
        $programIds = DestinationProgram::where('destination_id', $data->id)->pluck('program_id')->toArray();
        $programs = Program::whereIn('id', $programIds)->pluck('title')->toArray();
        return view('admin.destination.view', ['request' => $request, 'data' => $data, 'programs' => $programs]);
    }
}