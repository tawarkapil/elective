<?php
namespace App\Models;

use App\Helpers\CommonHelper;
use App\Helpers\ViewsHelper;
use App\Helpers\MailFunctions;
use DB;
use Validator;
use Illuminate\Support\Str;
use Auth;
use Config;

class TripExtraActivity extends Base{
	
    protected $table = 'trip_exta_activities';
    public $timestamps = false;
}