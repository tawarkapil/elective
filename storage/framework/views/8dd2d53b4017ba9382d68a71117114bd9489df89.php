<?php $__env->startSection('title'); ?>

<title><?php echo e($data->title); ?>(<?php echo e($data->getprogram->title); ?>) - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Start main-content -->

<div class="main-content">

   <!-- Section: inner-header -->

   <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/uploads/addons/'.$data->image)); ?>">

      <div class="container pt-30 pb-30">

         <!-- Section Content -->

         <div class="section-content text-center">

            <div class="row">

               <div class="col-md-12 text-center">

                  <h2 class="font-36 page_title"><?php echo e($data->title); ?> - <?php echo e($data->getprogram->title); ?></h2>

                  <ol class="breadcrumb text-center mt-10 white">

                     <li><a href="#">Home</a></li>

                     <li class="active">Addon/Event Details</li>

                  </ol>

               </div>

            </div>

         </div>

      </div>

   </section>

   <div class="second_navigation text-capitalize">

      <div class="container">

         <ul class="second_menu mb-0">

            <?php if($data->attachments && count($data->attachments) > 0): ?>

            <li><a href="#highlights-tab">Highlights</a></li>

            <?php endif; ?>

            <li><a href="#overview-tab">Overview</a></li>

            <li><a href="#what-include-tab">What's Included</a></li>

            <li><a href="#pricing-tab">Prices</a></li>

            <li><a href="#inquiry-tab">Inquiry</a></li>

         </ul>

      </div>

   </div>

   <?php if($data->attachments && count($data->attachments) > 0): ?>

   <!-- Section: Highlights -->

   <section id="highlights-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Highlights</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="section-content">

            <div class="row">

               <div class="col-md-12">

                  <div class="news-carousel owl-nav-top mb-sm-80" data-dots="true">

                     <?php $__currentLoopData = $data->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="item"> 
                        <div class="card effect__hover">
                          <div class="card__front">
                              <img src="<?php echo e(url($attach->attachment)); ?>" class="img-fullwidth" style="height: 100%; object-fit: cover;">
                          </div>
                          <div class="card__back" data-bg-color="#e0e0e0">
                            <div class="card__text">
                              <div class="display-table-parent p-30">
                                <div class="display-table">
                                  <div class="display-table-cell">
                                    <?php echo $attach->description; ?>

                                   </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                     </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </section>

   <?php endif; ?>

   <!-- Section: Highlights -->

   <section id="overview-tab" class="divider parallax layer-overlay overlay-deep" style="background-color: #DDD;">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Overview</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">

            <div class="col-md-6 text-center"> 

               <img class="intro_img" src="<?php echo e(url('public/uploads/addons/'.$data->image)); ?>" alt="medical students"> 

            </div>

            <div class="col-md-6">

               <?php echo $data->description; ?>


            </div>

         </div>

      </div>

   </section>

   <section id="what-include-tab" class="divider grey_bg">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">What's Included</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">

            <div class="col-md-6"> 

               <?php echo $data->what_include_description; ?>


            </div>

            <div class="col-md-6 text-center"> 

               <img class="img-fullwidth" src="<?php echo e(url('public/frontend/assets/images/about-3.jpg')); ?>" alt=""> 

            </div>

         </div>

      </div>

   </section>

   <!-- Section: Highlights -->

   <section id="pricing-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Prices</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">

            <div class="col-md-6 text-center"> 

               <img class="intro_img" src="<?php echo e(url('public/frontend/assets/images/about-3.jpg')); ?>" alt="medical students"> 

            </div>

            <div class="col-md-6">

               <?php echo $data->price_description; ?>


            </div>

         </div>

      </div>

   </section>

   <?php echo $__env->make('frontend.pages._quick_contact_frm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<!-- end main-content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

<style type="text/css">

   .thumbnail{

      height: 310px;

   }

   .thumbnail img{

      height: 100%;

      width: 100%;

      object-fit: cover;

   }

</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/frontend/pages/event-details.blade.php ENDPATH**/ ?>