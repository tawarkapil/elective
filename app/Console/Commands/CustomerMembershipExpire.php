<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomerMembershipLevel;
use App\Helpers\MailFunctions;
use Carbon\Carbon;
use ViewsHelper, CommonHelper;

class CustomerMembershipExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custmembership:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will be decide which Membership has been Expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $obj = new CustomerMembershipLevel();
        $this->checkAndSendExpiryMail(90);
        $this->checkAndSendExpiryMail(60);
        $this->checkAndSendExpiryMail(30);
        $this->checkAndSendExpiryMail(15);
        $this->checkAndSendExpiryMail(7);
        $this->checkAndSendExpiryMail(1);
        // get for expire records
        $date = date('Y-m-d');
        $data = CustomerMembershipLevel::where('status', 1)->whereDate('end_date', '<=', $date)->get();
        foreach ($data as $key => $value)
        {
            $value->status = 4;
            $value->update();
            if ($value->type == 1)
            {
                // Notification
                $getNotifRoles = \ViewsHelper::getNotifRoles('member_view');
                $ref_arr = \App\Models\User::whereIn('role_id', $getNotifRoles)->pluck('email', 'id')
                    ->toArray();
                $notifArr['ref_arr'] = $ref_arr;
                $notifArr['heading'] = 'Membership Expired';
                $notifArr['notification'] = $value
                    ->membershipLevel->name . ' Membership level of ' . $value
                    ->customer
                    ->full_name() . ' is expiring in ' . date('F,Y', strtotime($value->end_date)).'. Please click here to view the details.';
                $notifArr['view_url'] = 'admin/customers/view/' . base64_encode($value->customer_id);
                \App\Helpers\NotificationHelper::addAdminNotif($notifArr);

                //Customer Activity Log
                $custActivityArr['customer_id'] = $value->customer_id;
                $custActivityArr['heading'] = 'Membership Expired';
                $custActivityArr['activity_date'] = $value->end_date;
                // $custActivityArr['sub_heading'] = 1;
                // $custActivityArr['ref_type'] = \Auth::user()->id;
                // $custActivityArr['ref_id'] = \Auth::user()->id;
                //$custActivityArr['view_url'] = 'membership/renew-now';
                \App\Helpers\ActivityHelper::insertCustomerActivityLog($custActivityArr);
            }
            else
            {
                // Notification
                $getNotifRoles = \ViewsHelper::getNotifRoles('member_view');
                $ref_arr = \App\Models\User::whereIn('role_id', $getNotifRoles)->pluck('email', 'id')
                    ->toArray();
                $notifArr['ref_arr'] = $ref_arr;
                $notifArr['heading'] = 'Certification Expired';
                $notifArr['notification'] = $value
                    ->membershipLevel->name . ' Certification of ' . $value
                    ->customer
                    ->full_name() . ' is expiring in ' . date('F,Y', strtotime($value->end_date)).'. Please click here to view the details.';
                $notifArr['view_url'] = 'admin/customers/view/' . base64_encode($value->customer_id);
                \App\Helpers\NotificationHelper::addAdminNotif($notifArr);
                $custActivityArr['customer_id'] = $value->customer_id;
                $custActivityArr['heading'] = 'Certification Expired';
                $custActivityArr['activity_date'] = $value->end_date;
                $custActivityArr['sub_heading'] = $value
                    ->membershipLevel->name . ' has been expired.';
                // $custActivityArr['ref_type'] = \Auth::user()->id;
                // $custActivityArr['ref_id'] = \Auth::user()->id;
                //$custActivityArr['view_url'] = 'membership/renew-now';
                \App\Helpers\ActivityHelper::insertCustomerActivityLog($custActivityArr);
            }
            $this->send_expired_mail($value);
        }
        echo "final Cron run successfuly at " . date('d-m-Y H:i:s');
    }

    
    function checkAndSendExpiryMail($from = 90)
    {
        $obj = new CustomerMembershipLevel();
        // 90 days notification for membership/Certificate
        $date = date('Y-m-d', strtotime('+' . $from . ' days'));
        //echo "<pre>";print_r($date);die;
        $data = CustomerMembershipLevel::where('status', 1)->whereDate('end_date', $date)->get();
        foreach ($data as $key => $value)
        {
            if ($value->type == 1)
            {
                // Notification
                $getNotifRoles = \ViewsHelper::getNotifRoles('member_view');
                $ref_arr = \App\Models\User::whereIn('role_id', $getNotifRoles)->pluck('email', 'id')
                    ->toArray();
                $notifArr['ref_arr'] = $ref_arr;
                $notifArr['heading'] = 'Membership Expired';
                $notifArr['notification'] = $value
                    ->membershipLevel->name . ' Membership level of ' . $value
                    ->customer
                    ->full_name() . ' is expiring in ' . date('F,Y', strtotime($value->end_date)).'. Please click here to view the details.';
                $notifArr['view_url'] = 'admin/customers/view/' . base64_encode($value->customer_id);
                \App\Helpers\NotificationHelper::addAdminNotif($notifArr);
                if ($from == 90)
                {
                    //Customer Activity Log
                    $custActivityArr['customer_id'] = $value->customer_id;
                    $custActivityArr['heading'] = 'Membership Expiry';
                    $custActivityArr['activity_date'] = $value->end_date;
                    $custActivityArr['view_url'] = 'membership/renew-now';
                    \App\Helpers\ActivityHelper::insertCustomerActivityLog($custActivityArr);
                }

            }else{
                
                // Notification
                $getNotifRoles = \ViewsHelper::getNotifRoles('member_view');
                $ref_arr = \App\Models\User::whereIn('role_id', $getNotifRoles)->pluck('email', 'id')
                    ->toArray();
                $notifArr['ref_arr'] = $ref_arr;
                $notifArr['heading'] = 'Certification Expired';
                $notifArr['notification'] = $value
                    ->membershipLevel->name . ' Certification of ' . $value
                    ->customer
                    ->full_name() . ' is expiring in ' . date('F,Y', strtotime($value->end_date)).'. Please click here to view the details.';
                $notifArr['view_url'] = 'admin/customers/view/' . base64_encode($value->customer_id);
                \App\Helpers\NotificationHelper::addAdminNotif($notifArr);
                if ($from == 90)
                {
                    //Customer Activity Log
                    $custActivityArr['customer_id'] = $value->customer_id;
                    $custActivityArr['heading'] = 'Certification Expiry';
                    $custActivityArr['sub_heading'] = $value
                        ->membershipLevel->name . ' Certification will be expire soon.';
                    $custActivityArr['activity_date'] = $value->end_date;
                    $custActivityArr['view_url'] = 'recertification/step1/' . base64_encode($level->level_id);
                    \App\Helpers\ActivityHelper::insertCustomerActivityLog($custActivityArr);
                }
            }
            $this->send_expiry_mail($value, $from);
        }
    }

    function send_expiry_mail($data, $from)
    {
        $user = $data->customer;
        $link = url('login');
        if ($data->type == 1)
        {
            $emailtemplate = \App\Models\EmailTemplate::where('template_slug', 'membership_expiry')->first();
            $replace_macros = array(
                '{FIRST_NAME}' => $user->first_name,
                '{FULL_NAME}' => $user->full_name() ,
                '{MEMBERSHIP_NAME}' => $data->membershipLevel->name,
                '{CUSTOMER_NAME}' => $user->full_name() ,
                '{EMAIL}' => $user->email,
                '{END_DATE}' => date('F, Y', strtotime($data->end_date)) ,
                '{DAYS}' => $from,
                '{LOGIN_LINK}' => url('login'),
            );
        }
        else
        {
            $emailtemplate = \App\Models\EmailTemplate::where('template_slug', 'certificate_expiry')->first();
            $replace_macros = array(
                '{FIRST_NAME}' => $user->first_name,
                '{FULL_NAME}' => $user->full_name() ,
                '{COURSE_NAME}' => $data->membershipLevel->name,
                '{CUSTOMER_NAME}' => $user->full_name() ,
                '{EMAIL}' => $user->email,
                '{END_DATE}' => date('F, Y', strtotime($data->end_date)) ,
                '{DAYS}' => $from,
                '{LOGIN_LINK}' => url('login'),
            );
        }
        $template_html = \CommonHelper::setEmailTemplateContent($emailtemplate->body, $replace_macros);
        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = $emailtemplate->subject;
        $mailObj->template_id = $emailtemplate->id;
        $mailObj->toEmail = $user->email;
        $html = $mailObj->sendmail("emails.dynamic_template", ['template_html' => $template_html]);
        return $html;
    }

    function send_expired_mail($data)
    {
        $user = $data->customer;
        $link = url('login');
        if ($data->type == 1)
        {
            $emailtemplate = \App\Models\EmailTemplate::where('template_slug', 'membership_expired')->first();
            $replace_macros = array(
                '{FIRST_NAME}' => $user->first_name,
                '{FULL_NAME}' => $user->full_name() ,
                '{MEMBERSHIP_NAME}' => $data->membershipLevel->name,
                '{CUSTOMER_NAME}' => $user->full_name() ,
                '{EMAIL}' => $user->email,
                '{END_DATE}' => date('F, Y', strtotime($data->end_date)) ,
                '{LOGIN_LINK}' =>  url('login'),
            );
        }
        else
        {
            $emailtemplate = \App\Models\EmailTemplate::where('template_slug', 'certificate_expired')->first();
            $replace_macros = array(
                '{FIRST_NAME}' => $user->first_name,
                '{FULL_NAME}' => $user->full_name() ,
                '{COURSE_NAME}' => $data->membershipLevel->name,
                '{CUSTOMER_NAME}' => $user->full_name() ,
                '{EMAIL}' => $user->email,
                '{END_DATE}' => date('F, Y', strtotime($data->end_date)) ,
                '{LOGIN_LINK}' => url('login'),
            );
        }
        $template_html = \CommonHelper::setEmailTemplateContent($emailtemplate->body, $replace_macros);
        $mailObj = new MailFunctions();
        $mailObj->auto = true;
        $mailObj->subject = $emailtemplate->subject;
        $mailObj->template_id = $emailtemplate->id;
        $mailObj->toEmail = $user->email;
        $html = $mailObj->sendmail("emails.dynamic_template", ['template_html' => $template_html]);
        return $html;
    }
 
}
