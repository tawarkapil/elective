@include('emails.admin.template.header') 
   <p style="font-size:14px; margin-bottom:15px; line-height: 22px;"><b>Hi {{ $userObj->first_name }}</b>,</p>
   
    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        You recently requested to reset your password for your {{ ViewsHelper::getConfigKeyData('website_title') }} account. Click the button below to reset it. 
    </p>
    
    
  
    <div  style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        <a style="color:#b00403; font-weight:bold;" target="_blank" href="{{ url('admin/resetpassword/' . $userObj->reset_key) }}">
            Reset your password
        </a>
    </div>

    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    	If you did not request a password reset, please ignore this email. 
    </p>
 

 <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
If you have any further questions please email {{ ViewsHelper::getConfigKeyData('support_email') }}

    </p>
@include('emails.admin._signature') 
@include('emails.admin.template.footer') 