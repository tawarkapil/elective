@include('emails.frontend.template.header') 
   <p><b>Hi {{ $userObj->first_name }}</b>,</p>
   
    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        You recently requested to reset your password for your {{ ViewsHelper::getConfigKeyData('website_title') }} Membership account. Click the button below to reset it. 
    </p>
    
    
  
    <p  style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        <a style="color:#b00403; font-weight:bold;" target="_blank" href="{{ url('resetpassword/' . $userObj->reset_key) }}">
            Reset your password
        </a>
    </p>

    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    	If you did not request a password reset, please ignore this email. This password reset is only valid for the next 30 minutes. 
    </p>
 

 <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
If you have any further questions please email {{ ViewsHelper::getConfigKeyData('support_email') }}

    </p>
@include('emails.frontend._signature') 
@include('emails.frontend.template.footer') 