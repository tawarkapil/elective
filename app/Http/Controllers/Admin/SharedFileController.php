<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\SharedFile;
use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use Yajra\Datatables\Datatables;

class SharedFileController extends Controller
{

    public $mainObj;
    public $viewPath;

    function __construct(){
        $this->mainObj = new SharedFile();
        $this->viewPath = 'admin.shared-file';
    }

    function amlfcHosted(Request $request){
        $input = $request->all();
        return view($this->viewPath.'.index', ['input' => $input, 'ltype' => 'amlfc-hosted']);
    }

    function memberPosted(Request $request){
        $input = $request->all();
        return view($this->viewPath.'.index', ['input' => $input, 'ltype' => 'member-posted']);
    }

    function ajaxLoad(Request $request){
        $input = $request->all();
        $ltype = $input['ltype'];
        
        $obj = $this->mainObj;

        $builder = $obj->select('shared_files.*');
        if($ltype == 'amlfc-hosted'){
            $builder->leftJoin('users','users.id','=','shared_files.created_by')->where('shared_files.created_type', 1);
        }else{
            $builder->leftJoin('customers','customers.customer_id','=','shared_files.created_by')->where('shared_files.created_type', 2);
        }

        $builder->where(function($query) use ($input){
            $query->where('shared_files.is_submitted', 1)
            ->orWhere(function($query) use($input){
                $query->where('shared_files.is_submitted', 0)->where('shared_files.created_type', 1)->where('shared_files.created_by', Auth::user()->id);
            });

        })->where(function($query) use($input){
                if(isset($input['srch_start_date'])){
                        $query->whereDate('shared_files.created_at','>=', date('Y-m-d', strtotime($input['srch_start_date'])));
                }
                if(isset($input['srch_end_date'])){
                    $query->whereDate('shared_files.created_at','<=', date('Y-m-d', strtotime($input['srch_end_date'])));
                }

                if(isset($input['srch_status'])){
                    if(isset($input['srch_status'])){
                        if($input['srch_status'] == 1){
                            $query->where('shared_files.is_submitted',  0);
                        }

                        if($input['srch_status'] == 2){
                            $query->where('shared_files.is_submitted',  1)->where('shared_files.status',  0)
                                ->where('shared_files.created_by',  Auth::user()->id)
                                ->where('shared_files.created_type', 1);
                        }

                        if($input['srch_status'] == 3){
                            $query->where('shared_files.is_submitted',  1)->where('shared_files.status',  0)
                                ->where('shared_files.created_by', '!=', Auth::user()->id)
                                ->where('shared_files.created_type', 1);
                        }

                        if($input['srch_status'] == 4){
                            $query->where('shared_files.is_submitted',  1)->where('shared_files.status',  1);
                        }

                        if($input['srch_status'] == 5){
                            $query->where('shared_files.is_submitted',  1)->where('shared_files.status',  2);
                        }

                         if($input['srch_status'] == 6){
                            $query->where('shared_files.is_submitted',  1)->where('shared_files.status',  3);
                        }
                    }
                }
            });
        return  Datatables::of($builder)->filter(function ($query ) use($input){
            $query->where(function($query) use($input){
                if (isset($input['search']['value']) && strlen($input['search']['value'])>0) {
                    $query->where(function($query) use($input){
                        $srch = $input['search']['value'];
                        $query->where('shared_files.file_name', 'LIKE', '%'.$srch.'%');
                        $query->orWhere('shared_files.file_type', 'LIKE', '%'.$srch.'%');
                        $query->orWhere('shared_files.description', 'LIKE', '%'.$srch.'%');

                        // $arr = \Config::get('params.shared_file_status');
                        // $status_arr =CommonHelper::FILTER_ARRAY_VALUES_REGEXP("/".$input['search']['value']."/i",  $arr);
                        // $status_arr = array_keys($status_arr);
                        // if(isset($status_arr[0])){
                        //     $query->orWhereIn('shared_files.status', $status_arr);
                        // }
                    })->orWhere(function($query) use($input){
                        $ltype = $input['ltype'];
                        if($ltype == 'amlfc-hosted'){
                            $srch = $input['search']['value'];
                            $name_arr = explode(' ', $srch, 2);
                            if(isset($name_arr[0])){
                                $query->where('users.first_name', 'LIKE', '%'.$name_arr[0].'%');
                            }
                            if(isset($name_arr[1])){
                                $query->where('users.last_name', 'LIKE', '%'.$name_arr[1].'%');
                            }
                        }
                    })->orWhere(function($query) use($input){
                        $ltype = $input['ltype'];
                        if($ltype == 'member-posted'){
                            $srch = $input['search']['value'];
                            $name_arr = explode(' ', $srch, 2);
                            if(isset($name_arr[0])){
                                $query->where('customers.first_name', 'LIKE', '%'.$name_arr[0].'%');
                            }
                            if(isset($name_arr[1])){
                                $query->where('customers.last_name', 'LIKE', '%'.$name_arr[1].'%');
                            }
                        }
                    });
                }
            });
            })

            ->editColumn('selectInp', function ($row) {
                   return '<div class="custom-control custom-checkbox"><input type="checkbox" name="selectInp" class="custom-control-input single-check-box" id="customCheck'.$row->id.'" value="'.$row->id.'"><label class="custom-control-label" for="customCheck'.$row->id.'"></label></div>';
            })

            ->editColumn('file_name', function ($row) {
                   return $row->file_name; 
            })
            ->editColumn('file_type', function ($row) {
                   return $row->file_type; 
            })
            ->editColumn('status', function ($row) {
                return $row->displayStatus();
            })
            ->editColumn('created_by', function ($row) {
                 return $row->displayCreatedBy();  
            })
            ->editColumn('created_at', function ($row) {  
                return ViewsHelper::displayDate($row->created_at);  
            })
            ->editColumn('action', function ($row) use($input) {
                $ltype = $input['ltype'];
                $action = '<div class="text-nowrap">';
                if($row->is_submitted == 1){
                    $action .= '<a href="'.url('admin/shared-files/view/'.base64_encode($row->id)).'" data-toggle="tooltip" data-original-title="View"> <i data-feather="eye" class="text-inverse m-r-10"></i></a> ';
                }

                if($row->status < 3 && $row->created_type == 1 && $row->created_by == Auth::user()->id && ViewsHelper::checkUserAccess('amlfc_shared_files_add')){

                    $action .= '<a href="'.url('admin/shared-files/addnew/'.base64_encode($row->id)).'" data-toggle="tooltip" data-original-title="Edit"> <i data-feather="edit-2" class="text-inverse m-r-10"></i> </a>';
                }

                if($row->document_file){
                    $action .= '<a href="'.ViewsHelper::getSharedFile($row) .'" class="allow_download_cstm"  data-toggle="tooltip" data-original-title="Download"> <i data-feather="download" class="text-inverse m-r-10"></i></a>';
                }


                if(     
                    $row->status == 0 && $row->is_submitted == 1 &&
                    (($ltype =='amlfc-hosted' && ViewsHelper::checkUserAccess('amlfc_shared_files_approve_reject')) || 
                    ($ltype =='member-posted' && ViewsHelper::checkUserAccess('member_shared_files_approve_reject')))
                ){
                    $action .= '<a href="#" class="updateStatusBtn" data-status="1" data-id="'.base64_encode($row->id).'"  data-toggle="tooltip" data-original-title="Approve">  <i data-feather="check" class="text-inverse text-success m-r-10"></i></a>';
                    
                    $action .= '<a href="#" class="updateStatusBtn" data-status="2" data-id="'.base64_encode($row->id).'" data-toggle="tooltip" data-original-title="Reject">  <i data-feather="x" class="text-inverse text-danger m-r-10"></i></a>';
                }

                if(     
                    $row->status == 1 && 
                    (($ltype =='amlfc-hosted' && ViewsHelper::checkUserAccess('amlfc_shared_files_flag')) || 
                    ($ltype =='member-posted' && ViewsHelper::checkUserAccess('member_shared_files_flag')))
                ){
                    $action .= '<a href="#" class="updateStatusBtn" data-status="3" data-id="'.base64_encode($row->id).'" data-toggle="tooltip" data-original-title="Flagged"> <i data-feather="flag" class="text-inverse"></i></a>';
                }

                if( 
                    ($ltype =='amlfc-hosted' && ViewsHelper::checkUserAccess('amlfc_shared_files_delete')) || 
                    ($ltype =='member-posted' && ViewsHelper::checkUserAccess('member_shared_files_delete'))
                ){

                    $action .= '<a href="#" class="deleteBtn" data-id="'.base64_encode($row->id).'" data-toggle="tooltip" data-original-title="Delete"> <i data-feather="trash-2" class="text-inverse m-r-10"></i> </a>';
                }

                $action .= '</div>';
                return $action;
            })

        ->rawColumns(['selectInp', 'first_name', 'created_by', 'action'])->addIndexColumn()
        ->make(true);

    }

    public function addnew(Request $request, $id = null){
        $input = $request->all();
        $data = false;
        $id = base64_decode($id);
        $obj = $this->mainObj;
        if($id){
            $data = $obj->where('id', $id)->where('created_type', 1)->where('created_by', Auth::user()->id)
            ->where('status', '<', 3)
            ->first();
            if(!$data){
                abort(404);
            }
        }

        return view($this->viewPath.'.addnew',['input' => $input, 'data' => $data]);
    }

    public function addnewajax(Request $request)
    {
        $obj = $this->mainObj;
        $input = $request->all();
        $input['file_id'] = base64_decode($input['file_id']);
        $data = $obj->addNew($input);
        return json_encode($data);
    }

     public function details(Request $request, $id){
        $input = $request->all();
        $id = base64_decode($id);
        $obj = $this->mainObj;
        $data = $obj->where('id', $id)->where('is_submitted', 1)->first();
        if(!$data){
            abort(404);
        }

        // Log Activity
        if(\Session::has('ACTIVITY_VISITOR') && \Session::get('ACTIVITY_VISITOR') == 'SHARED_FILES_VIEW'.$data->id){
        
        }else{
            $activityArr['activity_type'] = 1;
            $activityArr['activity'] = 'View Shared File';
            $activityArr['url'] = 'admin/shared-files/view/'.base64_encode($data->id);
            $activityArr['created_type'] = 1;
            $activityArr['created_by'] = Auth::user()->id;
            \App\Helpers\ActivityHelper::insertActivityLog($activityArr);

            \Session::put('ACTIVITY_VISITOR', 'SHARED_FILES_VIEW'.$data->id);
        }
        return view($this->viewPath.'.view',['input' => $input, 'data' => $data]);
    }


    public function downloadFile(Request $request, $id){
      $input = $request->all();
      $obj = $this->mainObj;

      $input['file_id'] = base64_decode($id);
      $data = $obj->getByKey($input['file_id']);
      if($data){
        $image = \Config::get("file_params.shared_files");

        $base_path = base_path($image['base_path']);
        if (!empty($data)) {
            $base_path = $base_path . '/'  . $data->document_file;
            $path = url($image['path'] . "/" .  $data->document_file);
        } else {
            $base_path = "";
        }

        if (!file_exists($base_path)) {
            return redirect('admin/');
        }
        //$headers = array('Content-Type: application/pdf');
        if($data->document_file){
            return \Response::download($base_path);

        }
      }else{
        return redirect('admin/shared-files');
      }
    }

    public function preview(Request $request, $id){
          $input = $request->all();
          $obj = $this->mainObj;
          $id = base64_decode($id);
          $data = $obj->getByKey($id);
          if($data){
            $image = \Config::get("file_params.shared_files");
            $base_path = base_path($image['base_path']);
            if (!empty($data)) {
                $base_path = $base_path . '/'  . $data->document_file;
                $path = url($image['path'] . "/" .  $data->document_file);
            } else {
                $base_path = "";
            }
            if (!file_exists($base_path)) {
                return \Redirect::back();
            }
            $extension = pathinfo($path)['extension'];
            if(in_array(strtolower($extension), ['doc', 'docx'])){
                return view('frontend.common.preview', ['url' => $path, 'title' => $data->file_name]);
            }else{
                $path = $image['path'] . "/" .  $data->document_file;
                return response()->file(base_path($path));
            }
          }else{
            return \Redirect::back();
          }
        }

    function deleteSelected(Request $request){
        $input = $request->all();
        $obj = $this->mainObj;
        $input['file_id'] = base64_decode($input['file_id']);
        $data = $obj->deleteSelected($input);
        return json_encode($data);
    }


    function submitUpdateStatusFrm(Request $request){
        $input = $request->all();
        $obj = $this->mainObj;
        $input['file_id'] = base64_decode($input['file_id']);
        $data = $obj->submitUpdateStatusFrm($input);
        return json_encode($data);
    }

    function checkAllAction(Request $request){
        $input = $request->all();
        $obj = $this->mainObj;
        $data = $obj->checkAllAction($input);
        return json_encode($data);
    }


    public function uploadChunkFile(Request $request){
        $input = $request->all();
        $uploaderMines = \Config::get('constants.allowFiles.pdf');
        $maxSizeMb = \Config::get('constants.allowFileSize');

        $fileSettings = \App\Models\FileSetting::first();
        if($fileSettings){
            $maxSizeMb = $fileSettings->max_size;
            $uploaderMines = str_replace(',', '|', $fileSettings->allow_files);
        }
        
        $fieldName = 'document_file';
        $rules[$fieldName] = 'required|chckcstmdocumentminetype:'.str_replace('|', ',', $uploaderMines);


        $v = \Validator::make($input, $rules);
        if ($v->passes()) {    
            $obj = $this->mainObj;
            $json = $obj->uploadChunkFile($fieldName, $uploaderMines, $maxSizeMb);
        }else{
            $json[$fieldName][0]['name'] = $input[$fieldName]->getClientOriginalName();
            $json[$fieldName][0]['error'] = $v->errors()->first();
            $json[$fieldName][0]['type'] = $input[$fieldName]->getMimetype();
        }
        return json_encode($json);
    }
}