@extends('frontend.layouts.dashboard_app')
@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">
                  @if($page == 'visa-flights')
                  Visa & Flights
                  @elseif($page == 'insurance')
                  Insurance
                  @elseif($page == 'health-safety')
                  Health & Safety
                  @elseif($page == 'packing-list')
                  Packing List
                  @endif
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">
                     @if($page == 'visa-flights')
                     Visa & Flights
                     @elseif($page == 'insurance')
                     Insurance
                     @elseif($page == 'health-safety')
                     Health & Safety
                     @elseif($page == 'packing-list')
                     Packing List
                     @endif
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">
                        <!-- <i class="far fa-chart-bar"></i> -->
                        @if($page == 'visa-flights')
                        Visa & Flights
                        @elseif($page == 'insurance')
                        Insurance
                        @elseif($page == 'health-safety')
                        Health & Safety
                        @elseif($page == 'packing-list')
                        Packing List
                        @endif
                     </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     @if($page == 'visa-flights')
                     <p>Start early! Initiating your visa application in advance ensures a smooth and stress-free process. Aim to begin about 3 months before your planned departure. Here are a few tips to help you carefully plan for your visa: </p>
                     <p>
                     <ul class="list-icon theme-colored listnone pl-0">
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Passport Validity:</b> Ensure your passport is valid for more than 6 months beyond your planned departure date from the destination. This is a standard requirement for many countries and is crucial for a hassle-free travel and visa process.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Visa Guide:</b> Once your deposit payment is made and destination chosen, we will upload tailored visa guidance in the Important Resources section.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Cover Letter:</b> To facilitate your visa application, you may download a cover letter from Electives Global. </span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Final Visa Document:</b> Please upload your confirmed visa document in this section. Please check the Visa-on-arrival box if you are not getting a visa prior to departure from your home country.</span> </li>
                     </ul>
                     </p>
                     <label>Important Notice Regarding Visa and Immigration Information:</label>
                     <p>
                        We want to ensure you have the most accurate information, and while everything we share about visas and immigration is correct at the time of writing, governments might alter their immigration laws unexpectedly.
                     </p>
                     <p>In the event of such changes, we'll do our best to promptly inform you if it impacts your elective. It's crucial to note that Electives Global cannot be held responsible for any modifications made by immigration authorities, nor for any associated costs resulting from these changes.</p>
                     <?php 
                        $system_documents = ViewsHelper::getSystemDocuments(2); 
                        $student_documents = Config::get('params.student_documents')[2];
                        ?>
                     @if(count($system_documents) > 0 || count($student_documents) > 0)
                     <p>
                     <h4 class="pagesub_title">Important Resources in this section: </h4>
                     @if(count($system_documents) > 0)
                     <h5>For you:</h5>
                     @foreach($system_documents as $row)
                     <div>{{ $row->document_name }} (<a style="font-weight:600;" target="_blank" href="{{ url($row->document_path) }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                     @endforeach
                     @endif
                     @if(count($student_documents) > 0)
                     <h5>For us:</h5>
                     @foreach($student_documents as $key => $val)
                     <div>
                        {{ $val }}
                        <div class="form-group">
                           <label for="form_attachment"><strong>Upload</strong></label>
                           <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
                           <small>Maximum upload file size: 12 MB</small>
                        </div>
                     </div>
                     @endforeach
                     @endif
                     </p>
                     @endif
                     =======================================================
                     <p>It’s time to start booking your flight! </p>
                     <p>
                     <div>Important points in this section:</div>
                     <ul class="list-icon theme-colored listnone pl-0">
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Flights Destination Guide:</b> Prior to booking, kindly review the Flights Destination Guide in the Important Resources Section, offering essential details tailored to your chosen destination.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Personalized welcome:</b> At your destination airport’s arrival gate, look out for our friendly Electives Global staff. They'll be waiting with a sign displaying your full name, ready to take you to your accommodation to grab a hot meal and settle in.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Submit your Flight Details:</b> Kindly share your flight details promptly upon booking to ensure a smooth pickup at the designated airport. You may share your flight details by filling in the information below or alternatively uploading your itinerary in the Important Resources Section.</span></li>
                     </ul>
                     </p>
                     <p>
                        <b>Note:</b> Your specified arrival date is crucial, as our arrangements are tailored to the information you provide. We appreciate your cooperation, as deviations from the specified date and time may impact on our ability to guarantee your arrangements.
                     </p>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="media bg-deep p-30 mb-20">
                              <h5 style="font-weight:600;">Arrival Flight</h5>
                              <table class="table flight_info">
                                 <tr>
                                    <th style="width:50%">Airline Name</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Flight Number</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Departure Airport</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Departure Date and Time</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Arrival Airport</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Arrival Date and Time</th>
                                    <td></td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="media bg-deep p-30 mb-20 min_hlarge">
                              <h5 style="font-weight:600;">Return Flight</h5>
                              <table class="table flight_info">
                                 <tr>
                                    <th style="width:50%">Airline Name</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Flight Number</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Departure Airport</th>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <th style="width:50%">Departure Date and Time</th>
                                    <td></td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <?php 
                        $system_documents = ViewsHelper::getSystemDocuments(3); 
                        $student_documents = Config::get('params.student_documents')[3];
                        ?>
                     @if(count($system_documents) > 0 || count($student_documents) > 0)
                     <p>
                     <h4>Important Resources in this section: </h4>
                     @if(count($system_documents) > 0)
                     <h5>For you:</h5>
                     @foreach($system_documents as $row)
                     <div>{{ $row->document_name }} (<a style="font-weight:600;" target="_blank" href="{{ url($row->document_path) }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                     @endforeach
                     @endif
                     @if(count($student_documents) > 0)
                     <h5>For us:</h5>
                     @foreach($student_documents as $key => $val)
                     <div>
                        {{ $val }}
                        <div class="form-group">
                           <label for="form_attachment"><strong>Upload</strong></label>
                           <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
                           <small>Maximum upload file size: 12 MB</small>
                        </div>
                     </div>
                     @endforeach
                     @endif
                     </p>
                     @endif
                     @elseif($page == 'insurance')
                     <p>Travel confidently knowing Electives Global has got you covered! Insurance for your elective is priced into your elective cost at no additional charge. We do not allow any elective without insurance coverage. Here’s what you need to know:</p>
                     <p>
                     <div>Important points in this section:</div>
                     <ul class="list-icon theme-colored listnone pl-0">
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Coverage for Elective Period:</b> Note that Electives Global covers insurance costs specifically for the duration of your elective. It's essential to thoroughly examine the insurance plan and its extension policy to fully grasp the extent of your coverage, particularly if you have plans to explore the country post-program.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Insurance Documentation:</b> Download your digital card, plan coverage details, and any other important forms from the Important Resources section.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Support:</b> Should you encounter any issues during your journey, do not hesitate to reach out to us. </span></li>
                     </ul>
                     </p>
                     <?php 
                        $system_documents = ViewsHelper::getSystemDocuments(4); 
                        $student_documents = Config::get('params.student_documents')[4];
                        ?>
                     @if(count($system_documents) > 0 || count($student_documents) > 0)
                     <p>
                     <h4>Important Resources in this section: </h4>
                     @if(count($system_documents) > 0)
                     <h5>For you:</h5>
                     @foreach($system_documents as $row)
                     <div>{{ $row->document_name }} (<a style="font-weight:600;" target="_blank" href="{{ url($row->document_path) }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                     @endforeach
                     @endif
                     @if(count($student_documents) > 0)
                     <h5>For us:</h5>
                     @foreach($student_documents as $key => $val)
                     <div>
                        {{ $val }} 
                        <div class="form-group">
                           <label for="form_attachment"><strong>Upload</strong></label>
                           <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
                           <small>Maximum upload file size: 12 MB</small>
                        </div>
                     </div>
                     @endforeach
                     @endif
                     </p>
                     @endif
                     @elseif($page == 'health-safety')
                     <p>Ensuring your health and safety during your elective is a top priority for Electives Global. Important points to note on this: </p>
                     <p>
                     <ul class="list-icon theme-colored listnone pl-0">
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Health Guidelines and Tips:</b> Receive comprehensive health recommendations tailored to your destination, including vaccination requirements and health precautions. </span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Safety Protocols:</b> We provide detailed safety protocols, including emergency contact numbers and safety measures specific to your host country and placement.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>24/7 Support:</b> Our team is available around the clock to assist with any health or safety concerns that may arise during your elective.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Regular Updates:</b> Stay informed with regular updates on any health or safety advisories relevant to your destination.</span></li>
                     </ul>
                     </p>
                     <p>Please peruse our Health and Safety Guide in the Important Resources section. At Electives Global, you can focus on your learning and exploration, knowing that you have a strong support system for your health and safety.</p>
                     <?php 
                        $system_documents = ViewsHelper::getSystemDocuments(5); 
                        $student_documents = Config::get('params.student_documents')[5];
                        ?>
                     @if(count($system_documents) > 0 || count($student_documents) > 0)
                     <p>
                     <h4>Important Resources in this section: </h4>
                     @if(count($system_documents) > 0)
                     <h5>For you:</h5>
                     @foreach($system_documents as $row)
                     <div>{{ $row->document_name }} (<a style="font-weight:600;" target="_blank" href="{{ url($row->document_path) }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                     @endforeach
                     @endif
                     @if(count($student_documents) > 0)
                     <h5>For us:</h5>
                     @foreach($student_documents as $key => $val)
                     <div>
                        {{ $val }}
                        <div class="form-group">
                           <label for="form_attachment"><strong>Upload</strong></label>
                           <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
                           <small>Maximum upload file size: 12 MB</small>
                        </div>
                     </div>
                     @endforeach
                     @endif
                     </p>
                     @endif
                     @elseif($page == 'packing-list')
                     <p>As you gear up for your elective adventure, we've crafted the ultimate packing list to ensure you're well-prepared for the journey ahead. From clinical essentials to exploration must-haves, this guide blends practicality with excitement. Pack light, pack smart, and get ready for an elective experience filled with unforgettable moments!  </p>
                     <?php 
                        $system_documents = ViewsHelper::getSystemDocuments(6); 
                        $student_documents = Config::get('params.student_documents')[6];
                        ?>
                     @if(count($system_documents) > 0 || count($student_documents) > 0)
                     <p>
                     <h4>Important Resources in this section: </h4>
                     @if(count($system_documents) > 0)
                     <h5>For you:</h5>
                     @foreach($system_documents as $row)
                     <div>{{ $row->document_name }} (<a style="font-weight:600;" target="_blank" href="{{ url($row->document_path) }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                     @endforeach
                     @endif
                     @if(count($student_documents) > 0)
                     <h5>For us:</h5>
                     @foreach($student_documents as $key => $val)
                     <div>
                        {{ $val }} 
                        <div class="form-group">
                           <label for="form_attachment"><strong>Upload</strong></label>
                           <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
                           <small>Maximum upload file size: 12 MB</small>
                        </div>
                     </div>
                     @endforeach
                     @endif
                     </p>
                     @endif
                     @endif
                  </div>
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
@endsection