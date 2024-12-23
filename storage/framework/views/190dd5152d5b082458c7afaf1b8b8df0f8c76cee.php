<?php $__env->startSection('title'); ?>
<title>Contact Us - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>  
 <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="text-theme-colored font-36">Contact Us</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="active">Contact Us</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>
    <!-- Divider: Contact -->
    <section class="divider">
      <div class="container">
        <div class="row pt-30">
          <div class="col-md-4">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="icon-box left media bg-deep p-10 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 text-theme-colored"></i></a>
                  <div class="media-body"> <strong>OUR OFFICE1 Information</strong>
                    <p>+325 12345 65478</p>
                    <p>supporte@yourdomin.com</p>
                    <p>#405, Lan Streen, Los Vegas, USA</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="icon-box left media bg-deep p-10 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 text-theme-colored"></i></a>
                  <div class="media-body"> <strong>OUR OFFICE1 Information</strong>
                    <p>+325 12345 65478</p>
                    <p>supporte@yourdomin.com</p>
                    <p>#405, Lan Streen, Los Vegas, USA</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="icon-box left media bg-deep p-10 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 text-theme-colored"></i></a>
                  <div class="media-body"> <strong>OUR OFFICE1 Information</strong>
                    <p>+325 12345 65478</p>
                    <p>supporte@yourdomin.com</p>
                    <p>#405, Lan Streen, Los Vegas, USA</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <h3 class="line-bottom mt-0 mb-30">Interested in discussing?</h3>
            
            <!-- Contact Form -->
            <form id="gblContactSubmitFrm" name="gblContactSubmitFrm">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="name">Name <span class="required text-danger">*</span></label>
                    <input name="name" id="name" class="form-control" type="text" placeholder="Enter Name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="email">Email <span class="required text-danger">*</span></label>
                    <input name="email" id="email" class="form-control" type="text" placeholder="Enter Email">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="subject">Subject <span class="required text-danger">*</span></label>
                    <input name="subject" id="subject" class="form-control" type="text" placeholder="Enter Subject">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="phone_number">Phone <span class="required text-danger">*</span></label>
                    <input name="phone_number" id="phone_number" class="form-control" type="text" placeholder="Enter Phone">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="institution">institution <span class="required text-danger">*</span></label>
                    <input name="institution" id="institution" class="form-control" type="text" placeholder="Institution">
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="program">Program <span class="required text-danger">*</span></label>
                    <?php echo Form::select('program', ['' => 'Please Select'] + $programs, null, ['id' => 'program', 'class' => 'form-control']); ?>

                  </div>
                </div>

              </div>
              <div class="form-group">
                <label for="message">Message <span class="required text-danger">*</span></label>
                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Enter Message"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-dark btn-theme-colored btn-flat">Send your message</button>
              </div>
            </form>
            <!-- Contact Form Validation-->
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container-fluid p-0">
        <div class="row">

          <!-- Google Map HTML Codes -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5456.163483134849!2d144.95177475051227!3d-37.81589041361766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4dd5a05d97%3A0x3e64f855a564844d!2s121+King+St%2C+Melbourne+VIC+3000%2C+Australia!5e0!3m2!1sen!2sbd!4v1556130803137!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>

        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/pages/contact.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

     
      
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/pages/contact.blade.php ENDPATH**/ ?>