<?php
namespace App\Models;

class Notification extends Base
{
    protected $table = 'notifications';
    public $primaryKey = 'id';

    function getByKey($key){
        return $this->where($this->primaryKey,$key)->first();
    }


    function displayNotifText(){
    	$notif = $this->notification;
    	if($this->view_url){
	    	$url = '<a target="_blank" href="'.url($this->view_url).'">Click to view</a>';
	    	$notif = str_replace("Click to view", $url, $notif);
	    	
            $url = '<a target="_blank" href="'.url($this->view_url).'">clicking here</a>';
            $notif = str_replace("clicking here", $url, $notif);
            
            $url = '<a target="_blank" href="'.url($this->view_url).'">click here</a>';
	    	$notif = str_replace("click here", $url, $notif);
    	}

        $notif = str_replace(" the same", '', $notif);
        $notif = str_replace("details", 'information', $notif);

    	return $notif;


    }

    

}