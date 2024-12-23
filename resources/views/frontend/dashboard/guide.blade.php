@extends('frontend.layouts.dashboard_app')
@section('title')
<title>Guide - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<!-- Start main-content -->
<div class="main-content dashboard">
<section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="{{ url('public/frontend/assets/images/contact-us.jpg') }}">
   <div class="container pt-30 pb-30">
      <!-- Section Content -->
      <div class="section-content">
         <div class="row">
            <div class="col-sm-8 xs-text-center">
               <h2 class="text-white mt-10">User Guide</h2>
            </div>
            <div class="col-sm-4">
               <ol class="breadcrumb white mt-10 text-right xs-text-center">
                  <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                  <li class="active">User Guide</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
@include('frontend.layouts.sidebar')
<!-- Section: Registration Form -->
<section class="divider">
   <div class="container">

      @include('frontend.layouts.stepprogressbar')
      
      <div class="row">
         <div class="col-md-12">
            <div class="border-1px p-30 mb-0 bg-white">
               <div class="section-container">
                  <h4 class="text-theme-colored-blue"> Welcome {{ Auth::guard('customer')->user()->full_name() }}! </h4>
                  <p>We're thrilled to welcome you to Electives Global! We've tailored a friendly and intuitive flow to enhance your elective experience, guiding you step by step through this exciting journey. This section gives a summary of the process, and we encourage you to peruse through to get a good idea of the steps ahead. </p>
                  <p>Please note that the timelines provided are approximate and serve as a rough guide to help you navigate through the various stages. Due to our extensive network, programs with Electives Global can be processed much quicker depending on the destination and hospital regulations of the placement. We're here to support you every step of the way! </p>
                  <p>Okay, lets jump in: </p>
               </div>
               <div class="panel-group toggle">
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle1"><span class="open-sub"></span>Within 2 weeks of Logging in </a> </div>
                     </div>
                     <div id="toggle1" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Complete Profile and Application:</b> Set up your profile and application. This is your first step in unlocking all the amazing features and resources Electives Global presents. Enter your personal and academic details and submit your elective preference. Select an Add-On experience if you would like to. Need help with this? Contact us. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Note:</b> Please note the importance of submitting your deposit payment within the initial two weeks. This step is essential to maintain your active status on the dashboard to continue your elective journey. However, we understand that situations can arise. If you find yourself in this position, please don't hesitate to contact us to reinstate your registration.</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle2"><span class="open-sub"></span>As soon as you are accepted </a> </div>
                     </div>
                     <div id="toggle2" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Join our community:</b> Our WhatsApp community, social media platforms and Youtube provide a dynamic platform for connecting with program coordinators, mentors, fellow students, ambassadors, and alumni.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Start or Join a Group:</b> Use this unique opportunity to select and connect with fellow students for your travel. Wait... did you know Group trips get discounts too?! </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Start your Blogs:</b> Share your journey. By doing this you also automatically enter our ongoing “Global Elective Spotlight” raffles for a chance to get a discount on your elective! A little tip: videos get more points! </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Add a Tour:</b> Choose from an array of exciting tours and excursions, handpicked in partnership with local companies.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Go through the visa guide, pre-departure and in-country guidance sections:</b> This will ensure you are appropriately prepared for your trip. Ensure your passport does not expire until at least 6 months after your return. Upload your Visa document. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Start a Funding Campaign:</b> As doctors running Electives Global, we know how challenging funding can be as we go through our healthcare-based education systems. We’ve integrated a ton of funding resources and streamlined the process of funding your elective if you need to.</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle3"><span class="open-sub"></span>3 months before departure </a> </div>
                     </div>
                     <div id="toggle3" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Do a Health Checklist:</b> Get your vaccinations and other medicines that are needed for your trip. Revisit the Health and Safety Predeparture Prep. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Upload Visa Doc:</b> If you have not already uploaded your visa document to our portal, please do so at your earliest convenience. If you are obtaining your visa upon arrival at your destination, you may disregard this section. This will depend on country immigration regulations and this information should be verified from the Visa Guide in your dashboard. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Pay your balance:</b> If you have a balance to pay for your elective, this is the time to pay it.  </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Pre-elective Discussion:</b> Ensure you have completed the pre-elective call with your program advisor/s. </span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle4"><span class="open-sub"></span>1-2 months before departure </a> </div>
                     </div>
                     <div id="toggle4" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Upload Flight Details:</b> Upload your flight itinerary or fill in the provided form notifying us of your flight details. This is important information for us so that we can arrange your airport transfers. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Check Insurance:</b> All your insurance details for your trip are found in this section. All students are provided with travel insurance, and it is crucial at this point to ensure that Electives Global has all the required insurance form feedback from you if needed. Additionally, make sure to review the insurance plan and extension policy to understand the coverage and any additional options available. This is especially important if you are planning to tour the country after your program is complete. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>View Accommodation and Hospital/Center Details:</b> As your departure approaches, we will provide you with detailed information about your accommodation and hospital placement. This crucial update will include names, contact numbers, and addresses to ease your transition and help you familiarize yourself with your upcoming living and working environments.</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle5"><span class="open-sub"></span>3 weeks before departure </a> </div>
                     </div>
                     <div id="toggle5" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Check out the Packing List:</b> This is a good time to review the packing list we have provided to ensure you have everything you need. If you find any items missing or need to make last-minute purchases, this gives you ample time to prepare.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Financial Preparedness:</b> Ensure that your credit/debit cards are valid throughout your trip and inform your card company about your overseas expenditures to avoid any service disruptions. For efficient money management tips while abroad, consult the country guide in your dashboard. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Print Helpful Resource Docs:</b> It's a good idea for students to print out useful resources available in the dashboard, such as orientation guides, country guides, and other documents. Having these physical copies can be handy for quick reference throughout the journey. However, if you're unable to do so, don't worry – we can provide these documents upon your arrival.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Logbook Reminder:</b> Remember to carry your University/College Logbook with you to fulfil your elective requirements. If you do not have a logbook from your university, Electives Global provides one. This ensures that all your learning and activities are systematically recorded, meeting the requirements of your academic program.</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle6"><span class="open-sub"></span>1 week before departure </a> </div>
                     </div>
                     <div id="toggle6" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Health Checklist:</b> Start any medicines e.g anti-malarial tablets if necessary. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Forward Emergency Page Details:</b> Send your emergency contact the information from the dashboard’s emergency page, along with any other important information you would like your emergency contact to know about your trip. Print out vital documents for your trip, including visa details and arrival procedures.</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle7"><span class="open-sub"></span>On Arrival </a> </div>
                     </div>
                     <div id="toggle7" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Airport Meet and Greet:</b> Upon your arrival, a member of the Electives Global team will be there to welcome you at the airport. To ensure easy identification, they will be holding a sign displaying your full name.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Get some Food and Rest:</b> A welcome meal will be waiting for you, socialize with the team and fellow travelers if you’re up to it, and get some rest after your journey. </span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle8"><span class="open-sub"></span>Orientation and In-Country </a> </div>
                     </div>
                     <div id="toggle8" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Orientation:</b> Your program coordinator will introduce you to our in-country team and take you through orientation.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Receive Support Docs:</b> If you haven't already printed out your helpful resources such as the orientation and country guides from the dashboard, we will provide you with these during orientation. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Placement Work Commencement:</b> As your program begins, all specific details will be managed by your program coordinator, hospital staff and in-country staff. This ensures a seamless start to your experience. Our head office is in constant contact with in-country staff. Remember, support from our head office is always available to assist you throughout your placement.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Blog Reminder:</b> Ensure to continue writing about your journey!</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Mid – Elective Check-in:</b> To ensure that your elective experience is smooth and enriching, a check-in call will be conducted midway through your program with your program advisor/s. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Fulfil Elective Requirements:</b> Prior to completing your elective, ensure your logbook is duly signed. Kindly upload the final signature page in the portal for our team to verify. This is essential for us to issue you a completion certificate.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Departure and Airport Transfer:</b> As your elective draws to a close, departure procedures will be coordinated by our team to ensure a smooth transition. This includes arranging airport transfers, ensuring you have all necessary documents for travel, and providing any last-minute assistance.</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="panel">
                     <div class="panel-heading">
                        <div class="panel-title"> <a data-toggle="collapse" href="#toggle9"><span class="open-sub"></span>After Your Elective </a> </div>
                     </div>
                     <div id="toggle9" class="panel-collapse collapse">
                        <div class="panel-body pl-0 pt-20">
                           <ul class="list-icon theme-colored listnone">
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Submit Logbook:</b> Please upload the final signature page of your logbook. 
                                 Post-elective Debrief: Engage in a comprehensive debrief session which focuses on reflecting on your elective, discussing your achievements, challenges, and learning outcomes.</span> 
                              </li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Receive Certificate of Completion:</b> Upon successful completion, all students receive a certificate recognizing your participation and achievements in a structured global healthcare elective. If selected, you will further be contacted to receive a Letter of Recommendation (LOR), which can be a valuable addition to your professional portfolio.</span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Submit Blogs and Testimonials:</b> Share your journey and insights through blogs and testimonials. You can continue publishing blogs long after your elective is over by logging in to your dashboard as an alumni. </span></li>
                              <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span> <b>Work with Us:</b> Post-elective, some students may find opportunities to work with Electives Global as Ambassadors. This is an invitation to join us in various capacities, reflecting recognition of exceptional engagement or skills. Even though ambassador spaces are limited, we encourage all students to apply.</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
          <div class="col-md-12">
              <br>
              <a href="{{ url('profile') }}" class="btn btn-border btn-theme-colored pull-right">Next : Profile <i class="fa fa-arrow-circle-right"></i></a>
          </div>
         
      </div>
</section>
</div>
<!-- end main-content -->
@stop
@section('styles')
<style type="text/css">
  .listnone{
    list-style: none;
    padding-left: 0;
  }

  .panel-title a{
    font-weight: bold;
    font-size: 16px !important;
  }
</style>
@stop
@section('scripts')
<script type="text/javascript">
   $(function () {
     $('[data-toggle="tooltip"]').tooltip()
   })
</script>
@stop