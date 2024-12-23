<?php
namespace app\Helpers;
use Config;
use Session;
use App\Helpers\ViewsHelper;

Class MailFunctions 
{
    public $name = null;
    public $config_data;
    public $subject;
    public $body;
    public $fromEmail;
    public $toEmail;
    public $auto = TRUE;
    public $headers = null;
    public $attached_file = null;
    public $attached_html = null;
    public $no_activity_store = null;
    public $print = false;
    function __construct() 
    {
        $this->config_data = Config::get("CONFIG_DATA");
    }
            
    function sendmail($file,$data){
        \Mail::send($file, $data, function ($message) {
            $from_email = \Config::get('mail.from.address');
            $from_name = \Config::get('mail.from.name');

            $message->from($from_email, $from_name);
            $message->to($this->toEmail);
            $message->subject($this->subject);
            if(!empty($this->attached_file)){
                $message->attachData($this->attached_file, 'documents.pdf');
            }
        });
    }

    function api_sendmail($file,$data)
    {
        $this->setHeader();
        $this->setBody();
       
        $is_sent = \Mail::send($file, $data, function ($message) {
            $message->from($this->fromEmail, $this->name);
            $message->to('rahulnagar8772@gmail.com'); //$this->toEmail
            $message->subject($this->subject);
            //if(!empty($this->attached_file))
            //$message->attach($this->attached_file, array $options = []);
            //$message->replyTo($this->toEmail);
            //$message->cc($this->toEmail);

        });

        return $is_sent;
        
    }
}