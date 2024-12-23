<section id="inquiry-tab" class="divider grey_bg" data-bg-img="<?php echo e(url('public/frontend/assets/images/enquire-form-grey.jpg')); ?>">
  <div class="container pt-0 pb-0">
    <div class="row">
      <div class="col-md-7">
        <div class="blue_bg_color p-40">
          <h4 class="text-uppercase line-bottom text-white">Inquiry Form</h4>
          <!-- Paypal Both Onetime/Recurring Form Starts -->
          <form id="gblContactSubmitFrm" name="gblContactSubmitFrm" class="form-text-white">
            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="name">Full Name <span class="required text-white">*</span></label>
                    <input name="name" id="name" class="form-control" type="text" placeholder="Enter Name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="email">Email <span class="required text-white">*</span></label>
                    <input name="email" id="email" class="form-control" type="text" placeholder="Enter Email">
                  </div>
                </div>
              </div>
              <div class="row"> 
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="phone_number">Phone <span class="required text-white">*</span></label>
                    <input name="phone_number" id="phone_number" class="form-control" type="text" placeholder="Enter Phone">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="institution">Institution <span class="required text-white">*</span></label>
                    <input name="institution" id="institution" class="form-control" type="text" placeholder="Institution">
                  </div>
                </div>								<div class="col-sm-12">                  <div class="form-group">                    <label for="subject">Subject <span class="required text-white">*</span></label>                    <input name="subject" id="subject" class="form-control" type="text" placeholder="Enter Subject">                  </div>                </div>

                <!--<div class="col-sm-6">
                  <div class="form-group">
                    <label for="program">Program <span class="required text-white">*</span></label>
                    <?php echo Form::select('program', ['' => 'Please Select'] + ViewsHelper::getProgramsList(), null, ['id' => 'program', 'class' => 'form-control']); ?>

                  </div>
                </div>-->
              </div>
              <div class="row">
                <div class="col-sm-12 form-group">
                  <label for="message">Message <span class="required text-white">*</span></label>
                  <textarea name="message" id="message" class="form-control" rows="3" placeholder="Enter Message"></textarea>
                </div>
                <div class="col-sm-12">
                  <div class="form-group mb-20">
                    <button type="submit" class="btn btn-flat btn-dark mt-10 pl-30 pr-30 quick-link-btn-hover" data-loading-text="Please wait...">Contact Us</button>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="programs" class="divider parallax layer-overlay overlay-deep">
  <div class="container">
    <div class="section-title text-center">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h3 class="text-uppercase mt-0">Quick Links</h3>
          <div class="title-icon">
            <i class="fa fa-user-md"></i>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
        </div>
      </div>
    </div>
    <div class="section-content">

     <div class="row text-center">
      <div class="col-sm-4">
        <div class="icon-box iconbox-theme-colored blue_bg_color p-30">
          <a class="icon icon-dark icon-bordered icon-rounded icon-border-effect effect-rounded" href="<?php echo e(url('programs')); ?>">
            <i class="fa fa-tasks text-white"></i>
          </a>
          <h4 class="icon-box-title text-yellow">Programs</h4>
          <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias non nulla placeat, odio, qui dicta alias.</p>
          <a class="btn btn-flat btn-dark mt-15 quick-link-btn-hover" href="<?php echo e(url('programs')); ?>">Read more</a>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="icon-box iconbox-theme-colored blue_bg_color p-30">
          <a class="icon icon-dark icon-bordered icon-rounded icon-border-effect effect-rounded" href="<?php echo e(url('trips')); ?>">
            <i class="fa fa-group text-white"></i>
          </a>
          <h5 class="icon-box-title text-yellow">Group trips</h5>
          <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias non nulla placeat, odio, qui dicta alias.</p>
          <a class="btn btn-flat btn-dark mt-15 quick-link-btn-hover" href="<?php echo e(url('trips')); ?>">Read more</a>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="icon-box iconbox-theme-colored blue_bg_color p-30">
          <a class="icon icon-dark icon-bordered icon-rounded icon-border-effect effect-rounded" href="<?php echo e(url('destinations')); ?>">
            <i class="fa fa-map text-white"></i>
          </a>
          <h5 class="icon-box-title text-yellow">Destinations</h5>
          <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias non nulla placeat, odio, qui dicta alias.</p>
          <a class="btn btn-flat btn-dark mt-15 quick-link-btn-hover" href="<?php echo e(url('destinations')); ?>">Read more</a>
        </div>
      </div>
    </div>
    </div>
  </div>
</section><?php /**PATH /var/www/html/elective/resources/views/frontend/pages/_quick_contact_frm.blade.php ENDPATH**/ ?>