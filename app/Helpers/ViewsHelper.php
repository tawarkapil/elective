<?php

namespace App\Helpers;

use App\Models\ConfigData;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Location;
use App\Models\Program;
use App\Models\Pricing;
use App\Models\Notification;
use App\Models\StudentDocument;
use App\Models\SystemDocument;
use App\Models\Promotion;
use App\Models\Event;
use Config;
use Auth;
use AwsHelper;


class ViewsHelper {

    public static function getConfigKeyData($key){
        $configdata = ConfigData::where('def_key', $key)->first();
        if($configdata){
            return $configdata->def_value;
        }

        return '';

    }


    public static function getStripePaymentInfo($slug = 'STRIPE_KEY'){
        $data = PaymentSetting::first();
        if($data){
            if($slug == 'STRIPE_KEY'){
                return ($data->payment_mode == 'Live') ? $data->live_publish_key : $data->test_publish_key;
            }else{
                return ($data->payment_mode == 'Live') ? $data->live_secret_key : $data->test_secret_key;
            }
        }
        return env($slug);
    }


    public static function displayAmount($amount, $sign = true){
        //print_r($amount);die;

        $amount = (float)$amount;
        if($sign)
        {
           return 'US $'.number_format($amount, 2);
        }
         return '$'.number_format($amount, 2);
    }

    public static  function displayNumberFromat($amount){
        return number_format($amount, 2);

    }


    public static function displayDate($date, $time = false){
        if($date){
            if($time){
              return  date('d M, Y h:i A', strtotime($date));
            }
            return date('d M, Y', strtotime($date));
        }
        return '';
    }


    public static function getTripCoverImage($obj, $size = "200_200") {
        if($obj && $obj->cover_image){
             return url('public/uploads/cust_trips/'.$obj->cover_image);
        }
        return url('public/common/no-image.png');
    }



    public static function displayUserProfileImage($obj) {
        if($obj && $obj->profile_image){
            return url('public/uploads/customers/'.$obj->profile_image);
        }
        return url('public/common/no-image.png');
    }

    public static function getBlogImage($file){
        return url($file->attachment);
    }

    public static function checkUserAccess($permission_slug){

        if(in_array($permission_slug, \Config::get('ACTIE_USER_PERMISSIONS'))){
            return true;
        }
        return false;
    }

    public static function getLocations(){
        $locations = Location::pluck('name', 'id')->toArray();
        return $locations;
    }

    public static  function getNotifications($type = 2){
        if($type == 2){
           $notifications = Notification::where('type', 2)->where('ref_id', Auth::guard('customer')->user()->customer_id)->orderBy('created_at', 'DESC')->take(10)->get();
        }else{
            $notifications = Notification::where('type', 1)->where('ref_id', Auth::user()->id)->orderBy('created_at', 'DESC')->take(10)->get();
        }
        return $notifications;
    }


    public static  function notificationCount($type = 2){
        if($type == 2){
           $notifications = Notification::where('type', 2)->where('ref_id', Auth::guard('customer')->user()->customer_id)->where('is_read', 0)->count();
        }else{
            $notifications = Notification::where('type', 1)->where('ref_id', Auth::user()->id)->where('is_read', 0)->count();
        }
        return $notifications;
    }

    public static function getProgramsList(){
        $programs = Program::where('status', 1)->orderBy('title', 'desc')->pluck('title', 'id')->toArray();
        return $programs;
    }

    public static function getSystemDocuments($document_type){
        $data = SystemDocument::where('document_type', $document_type)->where('country_id', 113)->get();
        return $data;
    }

    public static function getStudentDocuments($type){
        return Config::get('params.student_documents')[$type];
    }

    public static function displayStudentDocumentFile($document_type, $student_doc_type){
        $arr = [];
        $data = StudentDocument::where('customer_id', \Auth::guard('customer')->user()->customer_id)
                ->where('document_type', $document_type)
                ->where('student_doc_type', $student_doc_type)
                ->first();
        if($data){
            return [
                'filename' => $data->document_name,
                'path' => url($data->document_path)

            ];
        }

        return $arr;
    }

    public static function getSelectLang(){
        return 'in';
    }

    public static function getApplicationSummaryArray($data){
        $array['programName'] = ($data->getprogram) ? $data->getprogram->title : null;
       $array['destinationName'] = ($data->getdestination) ? $data->getdestination->title.' - ' . $data->getdestination->getcountry->name : null;
       $array['ArrivalDate'] = ($data->trip_start_date) ? $data->trip_start_date : null;
       $array['duration'] = ($data->duration) ? $data->duration : 0;
       $array['destination'] = ($data->destination) ? $data->destination : 0;
       return$array;

    }
    public static function getApplicationSummary($array)
    {
        $summaryConf = [];
        $summaryConf['regiterationFees'] = 400;
        $summaryConf['programName'] = $array['programName'];
        $summaryConf['destinationName'] = $array['destinationName'];
        $summaryConf['ArrivalDate'] = $array['ArrivalDate'];
        $summaryConf['duration'] = $array['duration'];

        $pricedata = Pricing::where('destination', $array['destination'])->first();
        $restOfWeek = $array['duration'] - 6;
        $mainAmnt = $restAmnt = 0;

        if($pricedata){
            if($restOfWeek > 0){
                $mainAmnt = $pricedata->week6_payment;
                $restAmnt = $pricedata->extra_week_payment * $restOfWeek;
            }else{
                $mainAmnt = $pricedata->{'week'.$array['duration'].'_payment'};
            }
        }
        $summaryConf['trip_total'] = $mainAmnt + $restAmnt;
        $summaryConf['grand_total'] = $summaryConf['regiterationFees'] + $summaryConf['trip_total'];
        return $summaryConf;
        // code...
    }
    

}