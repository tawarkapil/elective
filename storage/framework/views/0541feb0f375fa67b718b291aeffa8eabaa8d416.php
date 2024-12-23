<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0"> 
                  <?php if($page == 'orientation-logbook'): ?>
                  Orientation Logbook
                  <?php elseif($page == 'accommodation'): ?>
                  Accommodation
                  <?php elseif($page == 'hospital-center'): ?>
                  Hospital/Center
                  <?php elseif($page == 'departure'): ?>
                  Departure
                  <?php endif; ?>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item active">
                     <?php if($page == 'orientation-logbook'): ?>
                     Orientation Logbook
                     <?php elseif($page == 'accommodation'): ?>
                     Accommodation
                     <?php elseif($page == 'hospital-center'): ?>
                     Hospital/Center
                     <?php elseif($page == 'departure'): ?>
                     Departure
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
                        <!-- <i class="far fa-chart-bar"></i> -->
                        <?php if($page == 'orientation-logbook'): ?>
                        Orientation Logbook
                        <?php elseif($page == 'accommodation'): ?>
                        Accommodation
                        <?php elseif($page == 'hospital-center'): ?>
                        Hospital/Center
                        <?php elseif($page == 'departure'): ?>
                        Departure
                        <?php endif; ?>
                     </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <?php if($page == 'orientation-logbook'): ?>
                     <p>At Electives Global, orientation is a four-part process designed to ease your transition into both the local and hospital environments:</p>
                     <p>
                     <ul class="list-icon theme-colored listnone pl-0">
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b> A Warm Welcome:</b> Our orientation begins with a heartfelt welcome from our in-country team. This session includes a warm introduction to local staff and fellow elective students. You are now at home as part of the Electives Global family.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Country and Local Environment Orientation:</b> This segment provides essential insights into the local culture, customs, safety, and health practices. It&#39;s aimed at helping you navigate and
                           respect the local community and environment.</span>
                        </li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Hospital/Center Orientation:</b> The final part involves a detailed introduction to your hospital placement. This includes an overview of the departments, understanding the professional do&#39;s
                           and don&#39;ts, and familiarizing yourself with the hospital/center protocols.</span>
                        </li>
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
                     <?php elseif($page == 'accommodation'): ?>
                     <p>Welcome to your home away from home! Details of your accommodation will be uploaded in this section one month to your elective. Here’s what you can expect:  </p>
                     <p>
                     <ul class="list-icon theme-colored listnone pl-0">
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Amenities for Comfort:</b> Your accommodation includes fresh bedding, Wi-Fi, and laundry services. </span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Community Spaces:</b> Benefit from communal areas for socializing and relaxation. Safety First: With 24/7 professional security, your safety is a priority.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Meals and Kitchen Access:</b> The kitchen is available for your use at any time. All food will be provided, with a fresh meal cooked daily upon your return from the hospital. If you have any specific dietary requirements that you did not indicate in your application, please notify the program coordinator. </span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Daily Commute:</b> Transportation is provided to and from the placement. Details of this will be provided during orientation. 
                           Explore Local Life and Sites: Discover nearby amenities and interact with the local community for a richer experience. Be sure to mix fun with work!</span>
                        </li>
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
                     <?php elseif($page == 'hospital-center'): ?>
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
                     <?php elseif($page == 'departure'): ?>
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
<?php echo $__env->make('frontend.layouts.dashboard_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/static-pages/inCountry.blade.php ENDPATH**/ ?>