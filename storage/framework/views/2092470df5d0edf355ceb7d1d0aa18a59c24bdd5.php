<?php $__env->startSection('title'); ?>
<title>After My Elective - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Start main-content -->
  <div class="main-content dashboard">
    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-sm-8 xs-text-center">
              <h2 class="text-white mt-10">After My Elective</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">After My Elective</li>
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
						  <li class="active"><a href="#after-my-elective-tab" data-toggle="tab">After My Elective</a></li>
						  <li><a href="#log-book-tab" data-toggle="tab">Log Book</a></li>
						  <li><a href="#post-elective-debrief-tab" data-toggle="tab">Post-elective Debrief</a></li>
						  <li><a href="#certificate-of-completion-tab" data-toggle="tab">Certificate of Completion</a></li>
						  <li><a href="#blogs-tab" data-toggle="tab">Blogs</a></li>
						  <li><a href="#work-with-us-tab" data-toggle="tab">Work with Us</a></li>
						</ul> 
			  
                  <div id="myTabContent" class="tab-content p-0">
                    <div role="tabpanel" class="tab-pane active" id="after-my-elective-tab">  
                        <div class="border-1px p-30 mb-0 bg-white pt-10">
                            <h4 class="pagesub_title">After My Elective </h4>
                            <p>This section is designed to support your transition back and to help you continue leveraging your experience. </p>
                            <p>Every story is unique, and your experiences during your elective are no exception. Whether you've discovered a newfound passion, built lasting friendships, or are now inspired to delve deeper into global health issues, each narrative is a valuable addition to the tapestry of experiences at Electives Global. We celebrate this diversity and encourage you to share your unique story with us.</p>
                            <p>
                              <div>Here’s a quick overview of this section:</div>
                              <ul class="list-icon theme-colored listnone pl-0">
                              <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Share your story:</b> Whatever your emotions or discoveries post-elective, we at Electives Global are eager to hear about them. Go to the My Blogs section to write about your experiences, share your thoughts with the community, and join in for a post-elective debrief with your program advisor.</span></li>
                              <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Access Certificate of Completion:</b> Upon submitting your log book sign off page and post-elective debrief, kindly download your Certificate of Completion from the dashboard. This certificate is a testament to your hard work, dedication, and the skills you've gained, serving as a valuable addition to your professional portfolio.</span></li>
                              <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Work with us:</b> Explore opportunities to work with Electives Global.</span></li>
                              <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Professional Development:</b> Upon completing your elective, your profile with Electives Global will automatically update to an alumnus profile, fostering ongoing engagement with our global community. However, this transition is entirely optional, and you may choose to opt out. Our alumni network serves as a valuable resource for continued growth and connection, celebrating the diverse paths and successes of our budding professionals. We take great pride in witnessing the remarkable achievements and heights our alumni reach.</span></li>
                              </ul>
                            </p>
                            <div class="pt-50">
                              <a href="#log-book-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Log Book <i class="fa fa-arrow-circle-right"></i></a>
                              <br>
                          </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="log-book-tab">
                        <div class="border-1px p-30 mb-0 bg-white pt-10">
                            <h4 class="pagesub_title">Log Book</h4>
                            <p><b>Congratulations</b> on reaching this significant milestone in your elective journey! As you conclude this enriching phase, we invite you to complete the Log Book section. </p>
                            <p>
                              This step involves uploading the fulfilment page of your log book, duly signed, to certify the completion of your elective. 
                            </p>
                            <?php 
                                $system_documents = ViewsHelper::getSystemDocuments(15); 
                                $student_documents = Config::get('params.student_documents')[15];
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
                              <a href="#post-elective-debrief-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Post-elective Debrief  <i class="fa fa-arrow-circle-right"></i></a>
                              <br>
                          </div>
                        </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="post-elective-debrief-tab">
                        <div class="border-1px p-30 mb-0 bg-white pt-10">
                            <h4 class="pagesub_title">Post-elective Debrief</h4>
                            <p>Post-Elective Debrief: Reflection and Growth</p>
                            <p>
                              The post-elective debrief is a vital part of your journey, providing an opportunity to reflect on your experiences and growth. Here's what it entails:
                            </p>
                            <p>
                              <ul class="list-icon theme-colored listnone pl-0">
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Scheduled Call with Program Advisor:</b> A specific date and time for the debrief will be set about two weeks after your return, ensuring you have settled back home and have had the space and time to reflect on your experiences. These details will be uploaded in this section.</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Reflective Learning:</b> This is a chance to discuss your experiences, challenges, and achievements during the elective. Use this opportunity to reflect on how the elective has impacted your personal and professional development.</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Feedback and Insights:</b> Share your insights and feedback about the elective. Your input is invaluable in enhancing the experience for future students.</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Future Directions:</b> Discuss your future aspirations and how your elective experience might influence your career path.</span></li>
                                
                              </ul>
                            </p>
                            <p>
                              This debrief is not a conclusion, but a stepping stone to your future in healthcare, enriched by your elective experiences.
                            </p>

                            <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(16); 
                                      $student_documents = Config::get('params.student_documents')[16];
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
                              <a href="#certificate-of-completion-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Certificate of Completion  <i class="fa fa-arrow-circle-right"></i></a>
                              <br>
                          </div>
                        </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="certificate-of-completion-tab">
                        <div class="border-1px p-30 mb-0 bg-white pt-10">
                            <h4 class="pagesub_title">Certificate of Completion </h4>
                            <p class="text-theme-colored-blue"><strong>Congratulations <?php echo e(Auth::guard('customer')->user()->full_name()); ?>!</strong> </p>
                            <p>
                              You’ve reached the finish line of your elective journey! Your dedication and hard work have brought you to this significant milestone. In recognition of your achievements, your Certificate of Completion will be available in this section of the dashboard upon the conclusion of your elective. This certificate is not only a testament to your commitment and learning but also a valuable addition to your professional portfolio.
                            </p>
                            <p>We are thrilled to acknowledge your success and are excited to see the paths you will explore in your future endeavors.</p>
                            <p><b>Alumni Network:</b> Upon receiving your Certificate of Completion we extend an invitation for you to join the Electives Global Alumni. Your active participation through your dashboard profile and community network will greatly enhance the experience of new students. By sharing your insights, offering guidance, and engaging in alumni activities, you contribute significantly to the development and support of those embarking on similar journeys. This involvement not only enriches our community networks but also continues the legacy of collaborative learning and mutual growth within Electives Global.</p>
                            <p><b>Letters of Recommendation:</b> At Electives Global, we closely observe and understand the activities and performance of our students. When we identify a student's exceptional performance, our program coordinators, hospital staff, mentors, and advisors may consider offering a Recommendation Letter to support their career advancement. </p>
                            <p>
                              <div>This gesture is made at the organization's discretion and may involve but not be limited to: </div>
                               <ul class="list-icon theme-colored listnone pl-0">
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Proactivity and Participation:</b> Involvement in ward rounds, extra work, and supporting junior students.</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Academic Ability:</b> Teaching and support staff may highlight the student's intellectual capabilities and academic prowess.</span></li>
                               <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Critical Thinking:</b> Mentors may highlight the student’s problem-solving and critical thinking skills.</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Passion for healthcare:</b> This criterion looks at how deeply a student is motivated and committed to healthcare, demonstrating a genuine interest and eagerness to learn, grow, and contribute positively to the field.</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Character and Behavior:</b> Focus on how the student's character traits contribute to their potential success in healthcare.
                                Care and Compassion: Assessing the student's ability to demonstrate empathy, understanding, and a compassionate approach when interacting with patients and colleagues.</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Cultural Immersion and Patient Interaction:</b> Emphasis on how the student adapts to and respects diverse cultural environments, particularly in their interactions with patients from various backgrounds. This criterion assesses the student's ability to effectively communicate and empathize with patients in a culturally sensitive manner.</span></li>
                                
                              </ul>
                            </p>
                            <p>
                             LORs from our leadership team reflect our commitment to recognizing and aiding the professional growth of outstanding students in our programs. If selected, you will be contacted by our team.
                            </p>

                            <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(17); 
                                      $student_documents = Config::get('params.student_documents')[17];
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
                              <a href="#blogs-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Blogs  <i class="fa fa-arrow-circle-right"></i></a>
                              <br>
                          </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="blogs-tab">
                        <div class="border-1px p-30 mb-0 bg-white pt-10">
                            <h4 class="pagesub_title">Blogs </h4>
                           
                            <p>Your personal experiences and insights carry immense value and sharing them can have a profound impact. Your narratives and reflections offer a unique perspective that can enlighten and motivate others embarking on similar journeys. Whether it’s about the challenges you overcame, the cultural insights you gained, or the professional growth you experienced, your story can make a difference</p>
                            <p>
                              <div>This gesture is made at the organization's discretion and may involve but not be limited to: </div>
                              <ul class="list-icon theme-colored listnone pl-0">
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Enhance your narrative:</b> Each entry you make to the “My Blogs” section is a chance to delve deeper into your journey, capturing unique moments and insights. Remember, your blogs could also shine in our 'Global Elective Spotlight', offering opportunities for recognition and rewards!</span></li>
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Testimonial Contribution:</b> We would be truly grateful if you could share your experiences in a testimonial. Your unique perspective is invaluable to us and to future students. Whether in written form or as a video, your insights and reflections on your time with us would be greatly appreciated.</li>
                              </ul>
                            </p>

                            <?php 
                                      $system_documents = ViewsHelper::getSystemDocuments(18); 
                                      $student_documents = Config::get('params.student_documents')[18];
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
                              <a href="#work-with-us-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next: Work with Us  <i class="fa fa-arrow-circle-right"></i></a>
                              <br>
                          </div>
                        </div>
                    </div> 


                    <div role="tabpanel" class="tab-pane" id="work-with-us-tab">
                        <div class="border-1px p-30 mb-0 bg-white pt-10">
                            <h4 class="pagesub_title">Work with Us </h4>
                           
                            <p>Ambassador Program: Join Our Team</p>
                            <p>
                              <div>Electives Global invites select students to become ambassadors, representing and sharing the values of our organization. If you have a passion for global health, excellent communication skills, and a desire to inspire others, this opportunity is for you.</div>
                              <ul class="list-icon theme-colored listnone pl-0">
                                <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Selection Process:</b> Exceptional students may be contacted directly for this role. However, all interested students are encouraged to apply.</span></li>
                                 <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>How to Apply:</b> If you're interested in becoming an ambassador, please reach out to us at ambassadors@electivesglobal.com. We welcome your enthusiasm and are eager to hear from you. </span></li>
                                 <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Earn, Learn and Grow:</b> As an ambassador, you'll have the opportunity to earn as you make an impact, grow your network, and work closely with a team dedicated to healthcare globally.</span> </li>

                              </ul>
                            </p>
                            <?php 
                                $system_documents = ViewsHelper::getSystemDocuments(19); 
                                $student_documents = Config::get('params.student_documents')[19];
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
                        </div>
                    </div>




                  </div>
              </div>
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
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/static-pages/afterMyElective.blade.php ENDPATH**/ ?>