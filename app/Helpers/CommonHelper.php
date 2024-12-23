<?php
namespace App\Helpers;

use Config;
use App\Models\User;
use App\Models\Customer;
use App\Models\NotificationRule;
use Twilio\Rest\Client;
use App\Models\TrackCustomerDevice;

class CommonHelper {


    public static function randomKey() {
        return mt_rand(10000, 999999);
    }

    public static function getEncryptedKey() {
        $randomKey = 0;
        $randomKey2 = 0;
        do {
            $randomKey = CommonHelper::randomKey();
            $randomKey2 = CommonHelper::randomKey();
        } while ($randomKey == $randomKey2);

        return md5($randomKey2 . time());
    }


    static public function nohtmldata($text) {
        $text = CommonHelper::cleaninputdata($text);
        $text = htmlspecialchars($text);
        return $text;
    }

    public static function htmldata($text) {
        $text = CommonHelper::uncleaninputdata($text);
        $text = htmlspecialchars_decode($text);
        return $text;
    }

    static public function cleaninputdata($text) {

        return stripslashes($text);
    }

    static public function uncleaninputdata($text) {

        return addslashes($text);
    }

    static public function spacetounderscore($text) {
        return str_replace(" ", "_", $text);
    }

    public static function getHttpReffer() {
        if (isset($_SERVER['HTTP_REFERER']))
            return $_SERVER['HTTP_REFERER'];
        else
            return false;
    }

     public static function get_client_ip() {   
        $ipaddress = '';    
        if (getenv('HTTP_CLIENT_IP'))   
            $ipaddress = getenv('HTTP_CLIENT_IP');  
        else if(getenv('HTTP_X_FORWARDED_FOR')) 
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');    
        else if(getenv('HTTP_X_FORWARDED')) 
            $ipaddress = getenv('HTTP_X_FORWARDED');    
        else if(getenv('HTTP_FORWARDED_FOR'))   
            $ipaddress = getenv('HTTP_FORWARDED_FOR');  
        else if(getenv('HTTP_FORWARDED'))   
           $ipaddress = getenv('HTTP_FORWARDED');   
        else if(getenv('REMOTE_ADDR'))  
            $ipaddress = getenv('REMOTE_ADDR'); 
        else    
            $ipaddress = 'UNKNOWN'; 
        return $ipaddress;  
    }

    public static function getIpData($ip) {
        $url = "http://ip-api.com/php/";
        $content = @file_get_contents($url);
        return $content = unserialize($content);
    }

    public static function FILTER_ARRAY_VALUES_REGEXP($basis, $array, $flag_invert = 0){
        $found = [];
        
        foreach ($array as $key => $val) {
            if(isset($flag_invert) && $flag_invert == 1)
            {
                if(!preg_match($basis, $val)){
                     $found[$key] = $val;
                }
            } else {
                if(preg_match($basis, $val)){
                     $found[$key] = $val;
                }
            }
        }
        return $found;
    }


    public static function getAdminUserEmails($apntmntObj){
        $emails = User::where('status', 1)->pluck('email')->toArray();
        if(count($emails) > 0){
            return $emails;
        }
        return ViewsHelper::getConfigKeyData('admin_email');
    }


    public static function generateMemberNumber($id){
       $number = str_pad(($id-1), 3, "0", STR_PAD_LEFT);
       return 'AMLFC1'.$number;
    }

    public static function createSlug($str, $delimiter = '-'){
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;

    } 

    public static function get_domain($url)
    {
      $pieces = parse_url($url);
      $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
      if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
      }
      return false;
    }


    public static function formatContent($string){
        $pattern = "/<p[^>]*><\\/p[^>]*>/"; 
        //$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";  use this pattern to remove any empty tag
        return preg_replace($pattern, '', $string); 
    }


    public static function setEmailTemplateContent($emailtemplate, $replace_macros){
        $html = strtr($emailtemplate, $replace_macros);
        return html_entity_decode($html);
    }

    public static function setLink($link, $button_name){
        return '<a style="color:#b00403; font-weight:bold;" target="_blank" href="'.$link.'">'.$button_name.'</a>';
    }


    public static function add_attachment($mailObj, $transdata){
    

        $data = $transdata;
        $customerdata = Customer::where('customer_id', $transdata->customer_id)->first();

        $invoicehtml = view('frontend.profile._payment_invoice',['data' => $data, 'customerdata' => $customerdata]);

        $mpdf = new \Mpdf\Mpdf(['tempDir' => storage_path('tmp')]);
        $html = $mpdf->WriteHTML($invoicehtml);
        $pdf = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);
        $mailObj->attached_file = $pdf;
        $mailObj->attached_html = $invoicehtml->render();
        
        return true;
    }


    public static function add_attachment2($mailObj, $transdata){
    

        $data = $transdata;
        $customerdata = Customer::where('customer_id', $transdata->customer_id)->first();

        $invoicehtml = view('frontend.profile._payment_invoice2',['data' => $data, 'customerdata' => $customerdata]);

        $mpdf = new \Mpdf\Mpdf(['tempDir' => storage_path('tmp')]);
        $html = $mpdf->WriteHTML($invoicehtml);
        $pdf = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);
        $mailObj->attached_file = $pdf;
        $mailObj->attached_html = $invoicehtml->render();
        
        return true;
    }


    // public static function makeClickableLinks($string) {
    //     $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i'; 
    //     $string = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $string);
    //     return $string;
    // }


    public static function generateUniqueUsername($first_name, $last_name){
        $first_name = strtolower(trim($first_name));//data coming from user
        $last_name  = strtolower(trim($last_name));//data coming from user
        $username  = $first_name.$last_name;
        $count =  Customer::where('username', 'LIKE', '%'.$username.'%')->count();
        $username = CommonHelper::checkUniqueUsername($username, $count);
        
        return $username;
    }


    public static function checkUniqueUsername($username, $count){
        $new_username = $username;
        if($count > 0){
            $new_username = $username.$count;
        }

        $checkUnique =  Customer::where('username', $new_username)->first();
        if($checkUnique){
            $count = $count + 1;
            $new_username = CommonHelper::checkUniqueUsername($username, $count);
        }

        // print_r($new_username);die;
        return $new_username;
    }


     public static function getBrowser() { 
        $u_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
        }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
        }elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        $ub = 'Unknow browser';
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
        $bname = 'Internet Explorer';
        $ub = "MSIE";
        }elseif(preg_match('/Firefox/i',$u_agent)){
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
        }elseif(preg_match('/OPR/i',$u_agent)){
        $bname = 'Opera';
        $ub = "Opera";
        }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        $bname = 'Google Chrome';
        $ub = "Chrome";
        }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        $bname = 'Apple Safari';
        $ub = "Safari";
        }elseif(preg_match('/Netscape/i',$u_agent)){
        $bname = 'Netscape';
        $ub = "Netscape";
        }elseif(preg_match('/Edge/i',$u_agent)){
        $bname = 'Edge';
        $ub = "Edge";
        }elseif(preg_match('/Trident/i',$u_agent)){
        $bname = 'Internet Explorer';
        $ub = "MSIE";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        // see how many we have
        if(isset($matches['browser'])){
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= (isset($matches['version']) && isset($matches['version'][0])) ? $matches['version'][0] : 0;
                }else {
                    $version= (isset($matches['version']) && isset($matches['version'][1])) ? $matches['version'][1] : 0;
                }
            }else {
                $version= (isset($matches['version']) && isset($matches['version'][0])) ? $matches['version'][0] : 0;
            }
        }

        // check if we have a number
        if ($version==null || $version=="") {
            $version="?";
        }

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    } 

    public static function checkCustomerAlreadyLoginThisDevice(){
        
        return true;
    }

}