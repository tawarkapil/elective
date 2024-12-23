@include('emails.frontend.template.header') 
   <p style="font-size:14px; margin-bottom:15px; line-height: 22px;"><b>Hi {{ $customer->full_name() }}</b>,</p>
    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
      Thank you for registering with {{ ViewsHelper::getConfigKeyData('website_title') }}. As a part of our policy, a member has to verify their email address. Please verify your email by clicking the below button:
    </p>
    <div style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        <a style="color:#b00403; font-weight:bold;" target="_blank" href="{{ url('confirm-account/' . $customer->signup_activation_key) }}">
            Verify Email
        </a>
    </div>


<p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    If you have any further questions please email 
    {{ ViewsHelper::getConfigKeyData('support_email') }}
</p>
@include('emails.frontend._signature') 
@include('emails.frontend.template.footer') 