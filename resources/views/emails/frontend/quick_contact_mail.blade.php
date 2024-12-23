@include('emails.frontend.template.header') 
<p style="font-size:14px; margin-bottom:15px; line-height: 22px;"><b>Dear {{ $customerdata->full_name() }}</b>,</p>

<p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
	{{ Auth::guard('customer')->user()->full_name() }} has sent a contact request for below reason : 
    <ul>
        <li>Subject : {{ $input['subject'] }}</li>
        <li>Message : {{ $input['message'] }}</li>
    </ul>
</p>
@include('emails.frontend._signature') 
@include('emails.frontend.template.footer') 