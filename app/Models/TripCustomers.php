<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\MailFunctions;
use DB;
use Validator;
use Illuminate\Support\Str;
use Auth;

class TripCustomers extends Base{

    protected $table = 'trip_customers';
    public $primaryKey = 'id';

    protected $fillable = [
        'trip_id',
        'customer_id',
        'type',
        'status',
    ];

    function getcustomer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }
}