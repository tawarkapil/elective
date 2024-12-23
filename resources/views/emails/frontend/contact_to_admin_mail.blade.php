@include('emails.frontend.template.header') 
<p>Hello, </p>
<p>
    {{ $contactdata->name }} wants to contact on your site.
</p>
<p>
    <h3>{{ $contactdata->email }} is contact user email address</h3>
</p>
<div>
    Thank You,
</div>
@include('emails.frontend.template.footer')