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

class DestinationProgram extends Base{
	
    protected $table = 'mst_destination_programs';

    function getprogram(){
    	return $this->hasOne('App\Models\Program', 'id', 'program_id');
    }
}