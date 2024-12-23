<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">
                  <?php if($page == 'logbook'): ?>
                  Logbook
                  <?php elseif($page == 'certificate-of-completion'): ?>
                  Certificate of Completion
                  <?php elseif($page == 'work-with-us'): ?>
                  Work with Us
                  <?php endif; ?>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item active">
                     <?php if($page == 'logbook'): ?>
                     Logbook
                     <?php elseif($page == 'certificate-of-completion'): ?>
                     Certificate of Completion
                     <?php elseif($page == 'work-with-us'): ?>
                     Work with Us
                     <?php endif; ?>
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
                        <?php if($page == 'logbook'): ?>
                        Logbook
                        <?php elseif($page == 'certificate-of-completion'): ?>
                        Certificate of Completion
                        <?php elseif($page == 'work-with-us'): ?>
                        Work with Us
                        <?php endif; ?>
                     </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <?php if($page == 'logbook'): ?>
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
                     <div>
                        <?php echo e($val); ?> 
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
                     <?php elseif($page == 'certificate-of-completion'): ?>
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
                           Care and Compassion: Assessing the student's ability to demonstrate empathy, understanding, and a compassionate approach when interacting with patients and colleagues.</span>
                        </li>
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
                     <?php elseif($page == 'work-with-us'): ?>
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
                     <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.dashboard_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/static-pages/afterMyElective.blade.php ENDPATH**/ ?>