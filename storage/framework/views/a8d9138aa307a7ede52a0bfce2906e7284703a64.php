<?php $__env->startSection('title'); ?>

<title>Fund My Elective - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

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

              <h2 class="text-white mt-10">Fund My Elective</h2>

            </div>

            <div class="col-sm-4">

              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 

                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>

                <li class="active">Fund My Elective</li>

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
            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container">
                  <h4 class="pagesub_title">Fund My Elective</h4>
                  <p>Doctors and healthcare professionals are at the helm of Electives Global, and we understand the financial challenges of our healthcare education systems. Our firsthand experiences drive our commitment to providing support and resources to ease the added burden of elective costs for our students. This section of your dashboard is an innovative feature designed to help you financially empower your elective journey.</p>
                  <p>
                    <ul class="list-icon theme-colored listnone pl-0">
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Create Your Campaign:</b> Easily set up a personalized fundraising campaign to cover your elective expenses.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Seamless Integration:</b> Funds raised are directly applied to your elective&#39;s payment, integrating smoothly with our payment system.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Reflect on Your Profile:</b> Your campaign will be visible on your profile page, showcasing your initiative to potential supporters.<span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Share and Gather Support:</b> Spread the word about your campaign to friends, family, and networks to gather support.</span></li>
                     <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Access Fundraising Resources:</b> We&#39;ve compiled valuable resources to guide your fundraising efforts. These can be downloaded from the &#39;Important Resources&#39; section, providing you with tips and strategies to effectively raise funds for your elective. These tools are designed to enhance your fundraising skills and maximize your campaign&#39;s success.</span></li>
                    </ul>
                  </p>

                  <?php 
                  $system_documents = ViewsHelper::getSystemDocuments(1);
                  ?>
                  <?php if(count($system_documents) > 0): ?>
                  <p>

                    <h4>Important Documents and Resources in this section:</h4>
                    <h5>For you:</h5>
                      <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </p>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-md-12 form-group mt-10">
          <a href="<?php echo e(url('pre-depature')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: Pre-elective Discussion <i class="fa fa-arrow-circle-right"></i></a>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/frontend/static-pages/fundMyElective.blade.php ENDPATH**/ ?>