<?php
namespace App\Helpers;

use App\Models\Notification;


Class NotificationHelper {

	public static function addAdminNotif($notifArr){
		if(count($notifArr['ref_arr']) > 0){
			$insert_arr = [];
			foreach($notifArr['ref_arr'] as $id => $email){
				$single_arr = [];
				$single_arr['type'] = 1;
				$single_arr['ref_id'] = $id;
				$single_arr['heading'] = $notifArr['heading'];
				$single_arr['notification'] = $notifArr['notification'];
				if(isset($notifArr['view_url'])){
					$single_arr['view_url'] = $notifArr['view_url'];
				}
				$single_arr['created_at'] = date('Y-m-d H:i:s');
				$single_arr['updated_at'] = date('Y-m-d H:i:s');
				
				$insert_arr[] = $single_arr;	
			}

			if(count($insert_arr) > 0){
				Notification::insert($insert_arr);
			}

		}

	}

	public static function addCustomerNotif($notifArr){
		$notifObj = new Notification();
		$notifObj->type = 2;
		$notifObj->ref_id = $notifArr['ref_id'];
		$notifObj->heading = $notifArr['heading'];
		$notifObj->notification = $notifArr['notification'];
		if(isset($notifArr['view_url'])){
			$notifObj->view_url = $notifArr['view_url'];
		}

		$notifObj->save();
		return true;
	}


	public static function addCommonNotif($notifArr){
		$notifObj = new Notification();
		$notifObj->type = $notifArr['type'];
		$notifObj->ref_id = $notifArr['ref_id'];
		$notifObj->heading = $notifArr['heading'];
		$notifObj->notification = $notifArr['notification'];
		if(isset($notifArr['view_url'])){
			$notifObj->view_url = $notifArr['view_url'];
		}

		$notifObj->save();
		return true;
	}

}