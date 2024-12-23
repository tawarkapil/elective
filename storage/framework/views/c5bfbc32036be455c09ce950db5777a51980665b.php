 <?php $__env->startSection('title'); ?>

<title>Pre-Depature - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>

<!-- Start main-content -->

<div class="main-content dashboard">
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">
        <div class="container pt-30 pb-30">
            <!-- Section Content -->

            <div class="section-content">
                <div class="row">
                    <div class="col-sm-8 xs-text-center">
                        <h2 class="text-white mt-10">Pre-Depature</h2>
                    </div>

                    <div class="col-sm-4">
                        <ol class="breadcrumb white mt-10 text-right xs-text-center">
                            <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>

                            <li class="active">Pre-Depature</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	 <?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Section: Registration Form -->

    <section class="divider">
        <div class="container">

          <?php echo $__env->make('frontend.layouts.stepprogressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
               

                <div class="col-md-12">
                    <div class="white_box p-0">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#predeparture-tab" data-toggle="tab">Pre-Depature</a></li>
                            <li><a href="#visa-tab" data-toggle="tab">Visas</a></li>
                            <li><a href="#flights-tab" data-toggle="tab">Flights</a></li>
                            <li><a href="#insurance-tab" data-toggle="tab">Insurance</a></li>

                            <li><a href="#health-safety-tab" data-toggle="tab">Health & Safety</a></li>
                            <li><a href="#packing-list-tab" data-toggle="tab">Packing List</a></li>
							<li><a href="#pre-elective-discussion-tab" data-toggle="tab">Pre-elective Discussion</a></li>
							<li><a href="#log-book-tab" data-toggle="tab">Log Book</a></li>
                        </ul>

                        <div id="myTabContent" class="tab-content p-0">


                          <div role="tabpanel" class="tab-pane active" id="predeparture-tab">  
                              <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Pre-Depature</h4>
                                  <p>Welcome to the thrilling Predeparture preparation phase of your Electives Global journey! Here's how we'll assist you in gearing up for your journey:</p>
                                  <p>
                                  <ul class="list-icon theme-colored listnone pl-0">
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Comprehensive Checklists:</b> We provide detailed checklists to ensure nothing is overlooked. From essential documents to packing essentials, we've got you covered.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Useful Resources:</b> Access a wealth of resources tailored to make your preparation seamless. Learn about your destination, cultural norms, and what to expect at your placement.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Regular Updates:</b> Stay on track with regular updates and reminders about key pre-departure milestones. Keep a lookout for the notifications on your dashboard as well.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Personalized Support:</b> Our dedicated team is here to guide you through each aspect of your preparation. Whether it's visa advice, travel tips, or health and safety guidelines, we're just a call or message away.</span></li>
                                    </ul>
                                  </p>
                                 <p>
                                    We share in your excitement and are committed to ensuring that your preparation is as enriching and stress-free as possible. 
                                  </p>
                                  <p>Let's jump in and make sure everything is good to go!</p>

                                  <div class="pt-50">
                                    <a href="#visa-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Visas <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                          </div>


                            <div role="tabpanel" class="tab-pane" id="visa-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                    <h4 class="pagesub_title">Visas</h4>
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
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4 class="pagesub_title">Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?>

										   <div class="form-group">
											  <label for="form_attachment"><strong>Upload</strong></label>
											  <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
											  <small>Maximum upload file size: 12 MB</small>
											</div>
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>

                                    <div class="pt-50">
                                      <a href="#flights-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Flights  <i class="fa fa-arrow-circle-right"></i></a>
                                      <br>
                                  </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="flights-tab">
                              <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Flights</h4>
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
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?>

										  <div class="form-group">
											  <label for="form_attachment"><strong>Upload</strong></label>
											  <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
											  <small>Maximum upload file size: 12 MB</small>
											</div>
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <div class="pt-50">
                                    <a href="#insurance-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Insurance <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="insurance-tab">
                              <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Insurance Coverage</h4>
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
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?> 
										   <div class="form-group">
											  <label for="form_attachment"><strong>Upload</strong></label>
											  <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
											  <small>Maximum upload file size: 12 MB</small>
											</div> 
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <div class="pt-50">
                                    <a href="#health-safety-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Health and Safety <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="health-safety-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Health and Safety</h4>
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
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?>

										   <div class="form-group">
											  <label for="form_attachment"><strong>Upload</strong></label>
											  <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
											  <small>Maximum upload file size: 12 MB</small>
											</div> 
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <div class="pt-50">
                                    <a href="#packing-list-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Packing List  <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="packing-list-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Packing List</h4>
                                  <p>As you gear up for your elective adventure, we've crafted the ultimate packing list to ensure you're well-prepared for the journey ahead. From clinical essentials to exploration must-haves, this guide blends practicality with excitement. Pack light, pack smart, and get ready for an elective experience filled with unforgettable moments!  </p>
                                  <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(6); 
                                      $student_documents = Config::get('params.student_documents')[6];
                                    ?>
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?> 
										   <div class="form-group">
											  <label for="form_attachment"><strong>Upload</strong></label>
											  <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
											  <small>Maximum upload file size: 12 MB</small>
											</div> 
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <div class="pt-50">
                                    <a href="#pre-elective-discussion-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Pre-elective Discussion  <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="pre-elective-discussion-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Pre-elective Discussion</h4>
                                  <p>The Pre-Elective Discussion is an essential step in preparing you for your elective experience. This discussion occurs before you depart from your home country and serves to ensure you are fully prepared for the journey ahead. Here’s what to expect: </p>
                                  <p>
                                    <ul class="list-icon theme-colored listnone pl-0">
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Scheduling:</b> A specific date and time for your pre-elective discussion will be set about 3 months prior to your departure. The details regarding the discussion will be uploaded in this section, providing clear guidelines on how to proceed.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Initial Briefing:</b> Participate in an in-depth briefing with your Program Advisor, focusing on the academic aspects of your upcoming elective. This session is designed to thoroughly discuss the expectations, goals, and educational objectives of your placement. This further helps tailor the experience to your educational and professional aspirations. </span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Addressing Queries and Concerns:</b> A perfect opportunity to raise any questions or concerns you might have.</span></li>
                                    </ul>
                                  </p>
                                  <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(7); 
                                      $student_documents = Config::get('params.student_documents')[7];
                                    ?>
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?> 
										   <div class="form-group">
											  <label for="form_attachment"><strong>Upload</strong></label>
											  <input id="form_attachment" name="form_attachment" class="file upload_button" type="file" multiple data-show-upload="false" data-show-caption="true">
											  <small>Maximum upload file size: 12 MB</small>
											</div>
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <div class="pt-50">
                                    <a href="#log-book-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Log Book <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="log-book-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Log Book</h4>
                                  <p>The Log Book section of Electives Global is an essential component of your elective journey. It's designed to meticulously document your learning and experiences, ensuring that every aspect of your professional development is captured and recognized.</p>
                                  <p>Note that you may also refer to this section when in-country. </p>
                                  <p>
                                    <div>A few important points:</div>
                                    <ul class="list-icon theme-colored listnone pl-0">
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Electives Global Tailored Log Books:</b> Students receive log books based on their study year and expertise, ensuring a personalized and relevant documentation tool.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Priority to University-Provided Log Books:</b> If you have a log book from your educational institution, it should be your primary documentation tool. We will not provide a log book in this case.</span> </li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Proactivity:</b> Having a log book promotes a proactive approach to your elective. It's not just a tool for documentation but also a means for you to actively engage in your learning and professional development. This proactive engagement is key to maximizing the benefits of your elective experience.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Tailor Your Experience Further:</b> You may upload your log book in advance to help us understand your requirements better. We can then customize your elective to meet specific logbook or credit needs. This is optional.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Professional Exemption:</b> If you are a professional enhancing your career with Electives Global, we do not provide a log book. You may contact us if you would prefer one.</span></li>

                                    </ul>
                                  </p>

                                  <p>
                                    <h4>Important actions in this section: </h4>
                                    <label><input type="checkbox"> Check this box if your school provides you with a log book. </label>
                                    <label><input type="checkbox"> Check this box if your log book fulfilment contributes to your ongoing curriculum credits.  </label>

                                  </p>

                                  <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(8); 
                                      $student_documents = Config::get('params.student_documents')[8];
                                    ?>
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div>
										     
										<div class="upload_document_box bg-deep p-20 mb-20">
										   <h5 class="updocument_title">Download Documents:</h5>
										   
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Passport : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div>
                                                          <div class="document_nane"><i class="fa fa-file-o mr-10" aria-hidden="true"></i> My Passport</div> 						  
													 </div>
												</div>
										   </div>
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Travel insurance : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div>
                                                          <div class="document_nane"><i class="fa fa-picture-o mr-10" aria-hidden="true"></i> My Travel insurance</div> 						  
													 </div>
												</div>
										   </div>
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Driving permit : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div>
                                                          <div class="document_nane"><i class="fa fa-cloud-upload" aria-hidden="true"></i> My Driving permit</div> 						  
													 </div>
												</div>
										   </div>
										   
										   </div>
										  
										  </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
										  
									  <h4>For you:</h4>
                                         <div>
										     
										<div class="upload_document_box bg-deep p-20 mb-20">
										   <h5 class="updocument_title">Download Documents:</h5>
										   
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Passport : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-download" aria-hidden="true"></i></div>
                                                          						  
													 </div>
												</div>
										   </div>
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Travel insurance : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-download" aria-hidden="true"></i></div>
                                                           						  
													 </div>
												</div>
										   </div>
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Driving permit : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-download" aria-hidden="true"></i></div>
                                                          						  
													 </div>
												</div>
										   </div>
										   
										   </div>
										  
										  </div>
									  
									  
									  
                                      <h4>For us:</h4>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?> 
										
										<div class="upload_document_box bg-deep p-20 mb-20">
										   <h5 class="updocument_title">Upload Documents:</h5>
										   
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Passport : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div>
                                                          <div class="document_nane"><i class="fa fa-file-o mr-10" aria-hidden="true"></i> My Passport</div> 						  
													 </div>
												</div>
										   </div>
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Travel insurance : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div>
                                                          <div class="document_nane"><i class="fa fa-picture-o mr-10" aria-hidden="true"></i> My Travel insurance</div> 						  
													 </div>
												</div>
										   </div>
										   <div class="row mb-30">
										        <div class="col-md-3">
												     <label>Driving permit : </label> 
												</div>
												<div class="col-md-8">
												     <div class="upload_document">
													      <div class="upload_icon mr-20"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div>
                                                          <div class="document_nane"><i class="fa fa-cloud-upload" aria-hidden="true"></i> My Driving permit</div> 						  
													 </div>
												</div>
										   </div>
										   
										   </div>
										   
										   
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 form-group mt-10">
                  <a href="<?php echo e(url('in-country')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: In country <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- end main-content -->

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('styles'); ?> 
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?> 
<script type="text/javascript">
  $(function(){
    $('body').on('click', '.trigger-btn', function(e){
      e.preventDefault();
      var triggerTab = $(this).attr('href');
      $(window).animate({scrollTop:0}, 'slow');
      $('#myTab').find('li').removeClass('active');
      $('#myTab').find('a[href="'+triggerTab+'"]').parent().addClass('active');
      $('#myTabContent').find('.tab-pane').removeClass('in').removeClass('active');
      $(triggerTab).addClass('in').addClass('active');

    });
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/static-pages/preDepature.blade.php ENDPATH**/ ?>