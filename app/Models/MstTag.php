<?php
namespace App\Models;
use App\Helpers\CommonHelper as CommonHelper;
use App\Helpers\ViewsHelper as Views;
use App\Helpers\SimpleImage;
use Config;
use Session;
use Carbon\Carbon;
use DB;

class MstTag extends Base {
    protected $table = 'mst_tags';
    public $primaryKey = "id";
}