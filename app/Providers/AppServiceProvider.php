<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

    	if (class_exists('Swift_Preferences')) {
    		\Swift_Preferences::getInstance()->setTempDir(storage_path().'/tmp');
    	} else {
    		\Log::warning('Class Swift_Preferences does not exists');
    	}

        \Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);

        });


        \Validator::extend('not_allow_symbol', function ($attribute, $value) {
            $search = '*';
            $fieldsName = [
                'content', 
                'description', 
                'body', 
                'highlight_description', 
                'what_include_description', 
                'price_description'
            ];
            
            if(in_array($attribute, $fieldsName)){
                $new_val = strip_tags($value);
                $new_val = html_entity_decode($new_val);
            }else{
                $new_val = $value;
            }

           

            if(preg_match("/</i", $new_val) || preg_match("/>/i", $new_val) || strpos($new_val,'*') !== false){
                return false;
            }

            return true;

        }, 'Invalid format. < > * characters are not allowed.');



        \Validator::extend('not_allow_symbol_desc', function ($attribute, $value) {
            $new_val = strip_tags($value);
            $new_val = html_entity_decode($new_val);
            if(preg_match("/</i", $new_val) || preg_match("/>/i", $new_val) || strpos($new_val,'*') !== false){
                return false;
            }
            return true;
        }, 'Invalid format. < > * characters are not allowed.');


        \Validator::extend('not_allow_symbol_m', function ($attribute, $value) {
            $search = '*';
            $new_val = $value;
            if(preg_match("/</i", $new_val) || preg_match("/>/i", $new_val) || strpos($new_val,'*') !== false){
                return false;
            }

            return true;

        }, 'Invalid format. < > * characters are not allowed.');


        \Validator::extend('check_valid_gcaptcha', function ($attribute, $value) {
            $captcha = $value;
            $secretKey = \Config::get('params.gcaptcha.secret_key');
            $ip = $_SERVER['REMOTE_ADDR'];
            // post request to server
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents($url);
            $responseKeys = json_decode($response,true);
            // should return JSON with success as true
            if($responseKeys["success"]) {
                    return true;
            }
            return false;

        }, 'Invalid captcha.');


        \Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            // Contain at least one uppercase/lowercase letters, one number and one special char
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/', (string)$value);
        }, 'Please enter 1 uppercase, 1 lowercase, 1 number and 1 symbol in your password.');


        \Validator::extend('profession_email', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            if( strpos($value, '@gmail') == true ||
                strpos($value, '@yahoo') == true ||
                strpos($value, '@hotmail') == true ||
                strpos($value, '@aol') == true ||
                strpos($value, '@live') == true ||
                strpos($value, '@rediffmail') == true ||
                strpos($value, '@wanadoo') == true ||
                strpos($value, '@msn') == true ||
                strpos($value, '@free') == true ||
                strpos($value, '@ymail') == true
            ){
                return false;
            }

            return true;
        });

        \Validator::extend('chckcstmdocumentminetype', function ($attribute, $value, $parameters) {
            $uploadMineType = $value->getClientMimeType();
            $status = false;
            foreach($parameters as $singleparam){
                if($singleparam == 'doc'){
                    if($uploadMineType == 'application/msword'){
                        $status = true;
                        break;
                    }
                }elseif($singleparam == 'docx'){
                    if($uploadMineType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
                        $status = true;
                        break;
                    }

                }elseif($singleparam == 'pdf'){
                    if($uploadMineType == 'application/pdf'){
                        $status = true;
                        break;
                    }

                }elseif($singleparam == 'jpg'){
                    if($uploadMineType == 'image/jpeg'){
                        $status = true;
                        break;
                    }

                }elseif($singleparam == 'jpeg'){
                    if($uploadMineType == 'image/jpeg'){
                        $status = true;
                        break;
                    }

                }elseif($singleparam == 'png'){
                    if($uploadMineType == 'image/png'){
                        $status = true;
                        break;
                    }

                }
            }
            return $status;
        }, 'Invalid file type uploaded.');
    }
}
