@include('emails.admin.template.header') 
<p style="font-size:14px; margin-bottom:15px; line-height: 22px;"><b>Dear {{ $userObj->full_name() }}</b>,</p>

<p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
	Please click to below link form creating your password
    
</p>



<div  style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    <a style="color:#b00403; font-weight:bold;" target="_blank" href="{{ url('admin/users/createpassword/' . $userObj->reset_key) }}">
        {{ url('admin/users/createpassword/' . $userObj->reset_key) }}
    </a>
</div>
@include('emails.admin._signature') 
@include('emails.admin.template.footer') 