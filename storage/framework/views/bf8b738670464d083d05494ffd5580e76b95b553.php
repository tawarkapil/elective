 <?php $__env->startSection('title'); ?>

<title>In-country  - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<!-- Start main-content -->
<div class="main-content dashboard">
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">
        <div class="container pt-30 pb-30">
            <!-- Section Content -->

            <div class="section-content">
                <div class="row">
                    <div class="col-sm-8 xs-text-center">
                        <h2 class="text-white mt-10">In-country </h2>
                    </div>

                    <div class="col-sm-4">
                        <ol class="breadcrumb white mt-10 text-right xs-text-center">
                            <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                            <li class="active">In-country </li>
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
					    
						<ul id="myTab" class="nav nav-tabs boot-tabs">
						  <li class="active"><a href="#in-country-tab" data-toggle="tab">In-country</a></li>
						  <li><a href="#orientation-tab" data-toggle="tab">Orientation</a></li>
						  <li><a href="#accommodation-tab" data-toggle="tab">Accommodation</a></li>
						  <li><a href="#hospital-center-tab" data-toggle="tab">Hospital/Center</a></li>
						  <li><a href="#mid-elective-check-in-tab" data-toggle="tab">Mid-Elective Check-in</a></li>
						  <li><a href="#testimonial-tab" data-toggle="tab">Testimonial</a></li>
						  <li><a href="#departure-tab" data-toggle="tab">Departure</a></li>
						</ul>
					
                        <div id="myTabContent" class="tab-content p-0">
						
						
                          <div role="tabpanel" class="tab-pane active" id="in-country-tab">  
                              <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">In-country </h4>
                                  <p>Welcome to your home away from home! </p>
                                  <p>We’re thrilled to be part of your exciting journey as you embark on this unique and enriching experience in a new country. Here at Electives Global, we're committed to ensuring your in-country elective is not just educational, but also a time of personal growth and cultural immersion. A little glimpse of this main phase:</p>
                                  <p>
                                    <ul class="list-icon theme-colored listnone pl-0">
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Orientation:</b> Get acclimated to your new environment with an orientation session upon arrival. We'll cover local customs, safety guidelines, and your elective specifics.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Hospital or Center Placement:</b> Dive into your elective, where you'll gain hands-on experience and learn from local healthcare professionals. </span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Ongoing Support:</b> Our in-country team is always available to assist you, ensuring a smooth and enriching elective experience. Our in-country team is in constant communication with our head office, ensuring there is always a comprehensive support system in place for you. </span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Cultural Immersion:</b> Embrace the unique opportunity to immerse yourself in the local culture, food, and community life.</span></li>
                                    </ul>
                                  </p>


                                  <div class="pt-50">
                                    <a href="#orientation-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Orientation <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                          </div>


                            <div role="tabpanel" class="tab-pane" id="orientation-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                    <h4 class="pagesub_title">Orientation</h4>
                                    <p>At Electives Global, orientation is a four-part process designed to ease your transition into both the local and hospital environments:</p>
                                    <p>
                                      <ul class="list-icon theme-colored listnone pl-0">
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> A Warm Welcome:</b> Our orientation begins with a heartfelt welcome from our in-country team. This session includes a warm introduction to local staff and fellow elective students. You are now at home as part of the Electives Global family.</span></li>
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Country and Local Environment Orientation:</b> This segment provides essential insights into the local culture, customs, safety, and health practices. It&#39;s aimed at helping you navigate and
                                        respect the local community and environment.</span></li>
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Hospital/Center Orientation:</b> The final part involves a detailed introduction to your hospital placement. This includes an overview of the departments, understanding the professional do&#39;s
                                        and don&#39;ts, and familiarizing yourself with the hospital/center protocols.</span></li>
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> Q&amp;As:</b> An open forum to address any initial queries or concerns you might have.</span></li>
                                      </ul>
                                    </p>
                                   
                                   <p>
                                      If you have not already printed a copy of the orientation and country guides, you will be provided with a copy of them at orientation.
                                    </p>

                                    <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(9); 
                                      $student_documents = Config::get('params.student_documents')[9];
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
                                      <a href="#accommodation-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Accommodation  <i class="fa fa-arrow-circle-right"></i></a>
                                      <br>
                                  </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="accommodation-tab">
                              <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Accommodation</h4>
                                  <p>Welcome to your home away from home! Details of your accommodation will be uploaded in this section one month to your elective. Here’s what you can expect:  </p>
                                  <p>
                                    <ul class="list-icon theme-colored listnone pl-0">
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Amenities for Comfort:</b> Your accommodation includes fresh bedding, Wi-Fi, and laundry services. </span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Community Spaces:</b> Benefit from communal areas for socializing and relaxation. Safety First: With 24/7 professional security, your safety is a priority.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Meals and Kitchen Access:</b> The kitchen is available for your use at any time. All food will be provided, with a fresh meal cooked daily upon your return from the hospital. If you have any specific dietary requirements that you did not indicate in your application, please notify the program coordinator. </span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Daily Commute:</b> Transportation is provided to and from the placement. Details of this will be provided during orientation. 
                                      Explore Local Life and Sites: Discover nearby amenities and interact with the local community for a richer experience. Be sure to mix fun with work!</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Emergency Support:</b> Our local accommodation coordinator is always available for any concerns or emergencies.</span></li>
                                    </ul>
                                  </p>

                                  <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(10); 
                                      $student_documents = Config::get('params.student_documents')[10];
                                    ?>
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a target="_blank" href="<?php echo e(url($row->document_path)); ?>">Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?> (<a href="#">Upload</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>

                                  <div class="pt-50">
                                    <a href="#hospital-center-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Hospital/Center <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="hospital-center-tab">
                              <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Hospital/Center </h4>
                                  <p>Details of your hospital/center placement will be uploaded in this section one month to your elective. Here’s what you can expect:</p>
                                  <p>
                                    
                                    <ul class="list-icon theme-colored listnone pl-0">
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> Hospital/Center Orientation:</b> You will be familiarized with the center’s layout, departments, and staff on your first day at the center. This orientation is crucial for understanding the center’s protocols and procedures.</span></li>
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> Assigned Departments:</b> Depending on your elective focus, you will be assigned to specific departments.</span></li>
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> Mentorship and Support:</b> Experienced healthcare professionals will mentor and guide you, offering valuable insights into healthcare practices.</span></li>
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> Health and Safety Protocols:</b> Learn and adhere to all health and safety regulations specific to the center’s setting.</span></li>
                                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> Opportunity for Diverse Learning:</b> Embrace the chance to learn about unique healthcare conditions and treatments pertinent to the region.</span></li>
                                    </ul>
                                  </p>

                                  <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(11); 
                                      $student_documents = Config::get('params.student_documents')[11];
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
                                        <div><?php echo e($val); ?> (<a href="#">Upload</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>

                                  <div class="pt-50">
                                    <a href="#mid-elective-check-in-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next : Mid-Elective Check-in <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="mid-elective-check-in-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Mid-Elective Check-in</h4>
                                  <p>The Mid-Elective Check-In is a pivotal point in your elective journey with Electives Global. Scheduled during the midpoint of your elective, this check-in aims to assess your progress, experiences, and any feedback from your hospital placement. </p>
                                  <p>
                                     <ul class="list-icon theme-colored listnone pl-0">
                                       <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Scheduling:</b> A specific date and time for the Mid-Elective Check-In will be set one week prior to the midpoint of your elective, ensuring you have ample time to prepare. The details regarding the check-in will be uploaded in this section, providing clear guidelines on how to proceed.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Program Advisor Interaction:</b> The check-in involves a dedicated call with your Program Advisor, who will offer support and guidance based on feedback received from your hospital placement and our team.</li>
                                     <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Feedback and Support:</b> This session is an opportunity to provide feedback about your experiences, discuss challenges, and receive advice. It's also a time to celebrate your achievements and plan for the remaining part of your elective.</li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Tailored Guidance:</b> The insights gained during this check-in allow us to tailor ongoing support and ensure that the remainder of your elective is as beneficial and fulfilling as possible.</li>
                                    </ul>
                                  </p>

                                  <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(12); 
                                      $student_documents = Config::get('params.student_documents')[12];
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
                                        <div><?php echo e($val); ?> (<a href="#">Upload</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <div class="pt-50">
                                    <a href="#testimonial-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Testimonial  <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="testimonial-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Testimonial</h4>
                                  <p>The Testimonials section is a platform for you to share your elective journey with the Electives Global community and beyond: </p>
                                 <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(13); 
                                      $student_documents = Config::get('params.student_documents')[13];
                                    ?>
                                    <?php if(count($system_documents) > 0 || count($student_documents) > 0): ?>
                                    <p>
                                      <h4>Important Resources in this section: </h4>
                                      <?php if(count($system_documents) > 0): ?>
                                        <h5>For you:</h5>
                                        <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div><?php echo e($row->document_name); ?> (<a target="_blank" href="<?php echo e(url($row->document_path)); ?>">Download</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                      <?php if(count($student_documents) > 0): ?>
                                      <h5>For us:</h5>
                                        <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($val); ?> (<a href="#">Upload</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <div class="pt-50">
                                    <a href="#departure-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Departure <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="departure-tab">
                                <div class="border-1px p-30 mb-0 bg-white pt-10">
                                  <h4 class="pagesub_title">Departure</h4>
                                  <p>Time flies, and it’s hard to believe your elective is wrapping up! We hope your experience has been nothing short of incredible, filled with learning, friendships, and memorable moments. A few reminders at this point: </p>
                                  <p>
                                    <ul class="list-icon theme-colored listnone pl-0">
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Logbook Sign Off:</b> Ensure your log book is signed off. </span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Flight Details Reminder:</b> If not already done so, please don’t forget to upload your return flight details in the 'Flights' section. This ensures we can arrange your airport transfer smoothly.</span></li>
                                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Stay Connected:</b> Even as you depart, remember that the connections and friendships you've made during your elective are lasting. We urge you to stay in touch with the people and the community you've become a part of.</span></li>
                                    </ul>
                                  </p>
                                  <p>Safe travels, and we look forward to hearing all about your experience when you’re back home!</p>

                                  <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(14); 
                                      $student_documents = Config::get('params.student_documents')[14];
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
                                        <div><?php echo e($val); ?> (<a href="#">Upload</a>)</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                  <!-- <div class="pt-50">
                                    <a href="<?php echo e(url('after-my-elective')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: After My Elective <i class="fa fa-arrow-circle-right"></i></a>
                                    <br>
                                </div> -->
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12 form-group mt-10">
                  <a href="<?php echo e(url('after-my-elective')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: After My Elective <i class="fa fa-arrow-circle-right"></i></a>
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

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/static-pages/inCountry.blade.php ENDPATH**/ ?>