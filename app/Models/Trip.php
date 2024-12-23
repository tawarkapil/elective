<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\MailFunctions;
use DB;
use Validator;
use Illuminate\Support\Str;
use Auth;

class Trip extends Base{

    protected $table = 'cust_trips';
    public $primaryKey = 'id';

   
    function getByKey($key){
        return $this->where($this->primaryKey,$key)->first();
    }


    function getcustomer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }

    function getmembers(){
        return $this->belongsTo('App\Models\TripCustomers', 'id', 'trip_id');
    }

    function getTourIds(){
      return TripExtraActivity::where('type', 'TOUR')->where('trip_id', $this->id)->pluck('ref_id')->toArray();
    }

    function getTourSum(){
      return TripExtraActivity::where('type', 'TOUR')->where('trip_id', $this->id)->sum('payment_amount'); 
    }

    function getToursName(){
      return Tour::whereIn('id', $this->getTourIds())->pluck('title')->toArray();
    }

    function getEventIds(){
      return TripExtraActivity::where('type', 'EVENT')->where('trip_id', $this->id)->pluck('ref_id')->toArray();
    }


    function getEventSum(){
      return TripExtraActivity::where('type', 'EVENT')->where('trip_id', $this->id)->sum('payment_amount'); 
    }

    function getEventsName(){
      return Addon::whereIn('id', $this->getEventIds())->pluck('title')->toArray();
    }

    function addNew($input) {

        $rules = array(
            'title' => 'required|not_allow_symbol|max:10000',
            'description' => 'required|not_allow_symbol|max:10000',
            'duration' => 'required|integer|min:1|max:50',
            'program_id' => 'required|exists:mst_programs,id',
            'destination_id' => 'required|exists:mst_destinations,id',
            'tour_ids' => 'nullable|array',
            'event_ids' => 'nullable|array',
            'tour_ids.*' => 'nullable|exists:mst_tours,id',
            'event_ids.*' => 'nullable|exists:mst_addons,id',
        );
        
        $newnames = array();  
        $messages = array();

        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            DB::beginTransaction();
            try{
                $pricedata = Pricing::where('destination', $input['destination_id'])->first();

                $programdata = Program::where('id', $input['program_id'])->first();
                $data = $obj = Trip::where('id', $input['id'])->first();
                if (empty($data)) {
                    $obj = new Trip();
                    $obj->customer_id = Auth::guard('customer')->user()->customer_id;
                }
                $obj->cover_image = $programdata->image;                
                $obj->title = ucfirst($input['title']);                
                $obj->description = $input['description'];
                $obj->program_id = $input['program_id'];
                $obj->destination_id = $input['destination_id'];
                $obj->duration = $input['duration'];
                //$obj->program_payment = $input['duration'];
                $obj->status = 1;
                $obj->save();

                TripExtraActivity::whereIn('type', ['TOUR', 'EVENT'])->where('trip_id', $obj->id)->delete();

                $tourIds = (isset($input['tour_ids'])) ? $input['tour_ids'] : [];

                $tours = Tour::whereIn('id', $tourIds)->get();
                foreach($tours as $tour){
                  $triptourObj = new TripExtraActivity();
                  $triptourObj->type = 'TOUR';
                  $triptourObj->ref_id = $tour->id;
                  $triptourObj->trip_id = $obj->id;
                  $triptourObj->payment_amount = $tour->payment_amount;
                  $triptourObj->save();
                }

                $addonIds = (isset($input['event_ids'])) ? $input['event_ids'] : [];
                $addons = Addon::whereIn('id', $addonIds)->get();
                foreach($addons as $addon){
                  $tripaddonObj = new TripExtraActivity();
                  $tripaddonObj->type = 'Event';
                  $tripaddonObj->ref_id = $addon->id;
                  $tripaddonObj->trip_id = $obj->id;
                  $tripaddonObj->payment_amount = $addon->payment_amount;
                  $tripaddonObj->save();
                }

                //Trip admin user added.
                $tripCustObj = TripCustomers::where('trip_id', $obj->id)->where('customer_id', $obj->customer_id)->firstOrNew();
                $tripCustObj->type = 1;
                $tripCustObj->trip_id = $obj->id;
                $tripCustObj->customer_id = $obj->customer_id;
                $tripCustObj->status = 1;
                $tripCustObj->save();

                $othercustomers = [];

                foreach($othercustomers as $customer_id){
                  $tripCustObj = TripCustomers::where('trip_id', $obj->id)->where('customer_id', $customer_id)->firstOrNew();
                  $tripCustObj->type = 2;
                  $tripCustObj->trip_id = $obj->id;
                  $tripCustObj->customer_id = $obj->customer_id;
                  $tripCustObj->status = 1;
                  $tripCustObj->save();
                }


                $total_payment = 0;
                $total_discount = 0;
                $total_tour_payment = 0;
                $total_event_payment = 0;

                //Total Payment Calculation
                $members = TripCustomers::where('trip_id', $obj->id)->count();
                $destination_payment = 0;
                $extra_week_payment = 0;
                if($pricedata){
                  if($input['duration'] <= 6){
                    $ssj  = "week".$input['duration']."_payment";
                    $destination_payment = $pricedata->{$ssj};

                  }else{
                    $destination_payment = $pricedata->week6_payment;
                    $extra_week_payment = ($input['duration'] - 6) * $pricedata->extra_week_payment;
                  }

                }
                $total_payment = ($members * $destination_payment) + ($members * $extra_week_payment);
                //

                //Total sum of tours & addons
                $total_tours_addons_payments = TripExtraActivity::whereIn('type', ['TOUR', 'EVENT'])->where('trip_id', $obj->id)->sum('payment_amount');
                $total_payment += $total_tours_addons_payments;
                //

                $obj->total_members = $members;
                $obj->destination_payment = $destination_payment;
                $obj->extra_week_payment = $extra_week_payment;
                $obj->total_payment = $total_payment;
                $obj->total_discount = $total_discount;
                $obj->save();


                $json['message'] = 'Saved successfully';
                $json['redirect_url'] = url('my-trips');
                $json['status'] = 1;
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                $json['status'] = 2;
                $json['message'] = $e->getMessage();
            }
        } else {
            $json['status'] = 0;
            $json['message'] = $v->messages();
        }
        return $json;
    }

}