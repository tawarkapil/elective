<?php $__env->startSection('title'); ?>

<title><?php echo e($data->title); ?> - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

 <!-- Start main-content -->

  <div class="main-content">

    <!-- Section: inner-header -->

    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/destination-bg.jpg')); ?>">

      <div class="container pt-30 pb-30">

        <!-- Section Content -->

        <div class="section-content text-center">

          <div class="row"> 

            <div class="col-md-6 col-md-offset-3 text-center">

              <h2 class="font-36 page_title"><?php echo e($data->title); ?>


              </h2>

              <ol class="breadcrumb text-center mt-10 white">

                <li><a href="#">Home</a></li> 

                <li class="active">Program Details</li>

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

              <li><a href="#common_condition-tab">Common Conditions</a></li>

              <li><a href="#programs_focus_points-tab">Program Focus Points</a></li>

              <?php if(count($destination) > 0): ?>

              <li><a href="#destination-tab">Destination</a></li>

              <?php endif; ?>

              <?php if(count($trips) > 0): ?>

              <li><a href="#group_trip-tab">Group Trips</a></li>

              <?php endif; ?>

              <?php if(count($blogsdata) > 0): ?>

              <li><a href="#blog-tab">Blog</a></li>

              <?php endif; ?>

              <?php if(count($events) > 0): ?>

              <li><a href="#events-tab">Events & Addons</a></li>

              <?php endif; ?>

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

               <img class="intro_img" src="<?php echo e(url('public/uploads/programs/'.$data->image)); ?>" alt="medical students"> 

            </div>

            <div class="col-md-6">

               <?php echo $data->description; ?>


            </div>

         </div>

      </div>

   </section>

   <section id="common_condition-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Common Conditions</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">

            <div class="col-md-6"> 

               <?php echo $data->common_condition; ?>


            </div>

            <div class="col-md-6 text-center"> 

               <img class="img-fullwidth" src="<?php echo e(url('public/frontend/assets/images/about-3.jpg')); ?>" alt=""> 

            </div>

         </div>

      </div>

   </section>



   <!-- Section: Highlights -->

   <section id="programs_focus_points-tab" class="divider parallax layer-overlay overlay-deep" style="background-color:#DDD;">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Program Focus Points</h3>

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

               <?php echo $data->program_focus_point; ?>


            </div>

         </div>

      </div>

   </section>

   

   <?php if(count($destination) > 0): ?>

  <section id="destination-tab" class="video_section">

      <div class="container pt-70">

        <div class="section-title text-center">

          <div class="row">

            <div class="col-md-8 col-md-offset-2">

              <h3 class="text-uppercase mt-0 text-white">Destinations</h3>

             <div class="title-icon title-icon-white">
                <i class="fa fa-user-md"></i>
            </div>

              <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-md-12">

            <div class="news-carousel owl-nav-top mb-sm-80" data-dots="true">

              <?php $__currentLoopData = $destination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <div class="item">

                <article class="post clearfix maxwidth600 mb-sm-30">
				
				  <div class="entry-header">
                    <div class="post-thumb thumb">
					     <img src="<?php echo e(url('public/uploads/destinations/'.$row->image)); ?>" alt="Destination" class="destination_album">
					</div>
				  </div> 
                  <div class="entry-content border-1px p-20"> 

                    <h5 class="entry-title mt-0 pt-0 text-white"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->title); ?> - <?php echo e($row->getcountry->name); ?></a></h5>

                    <p class="text-left mb-0 mt-15 font-13"><?php echo e($row->short_desc()); ?></p>

                    <div class="clearfix"></div>

                  </div>

                </article>

              </div>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





            </div>

          </div>

        </div>

      </div>

  </section>

  <?php endif; ?>

  <?php if(count($trips) > 0): ?>

   <section  id="group_trip-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container mt-30 mb-30 pt-30 pb-30">

        <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Group Trip</h3>

                 <div class="title-icon title-icon-white">
                   <i class="fa fa-user-md"></i>
                 </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>





        <div class="row ">

          <div class="col-md-12">

            <div class="blog-posts">

                <?php if(count($trips) > 0): ?>

                  <div class="row ">

                   <div class="col-md-12">

                    <div class="news-carousel owl-nav-top mb-sm-80">

                      <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <div class="item">

                            <article class="post clearfix maxwidth600 mb-30">

                              <div class="entry-header">

                                <div class="post-thumb thumb"> <img src="<?php echo e(ViewsHelper::getTripCoverImage($row)); ?>" alt="" class="img-responsive img-fullwidth"> </div>

                                </div>

                              <div class="entry-content border-1px p-20">

                                <h5 class="entry-title mt-0 pt-0"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->short_title(40)); ?></a></h5>

                                <p class="text-left mb-20 mt-15 font-13"><?php echo e($row->short_desc(150)); ?></p>

                                <a class="btn btn-dark btn-theme-colored btn-flat pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>

                                <ul class="list-inline entry-date pull-right font-12 mt-5">

                                  <li><a class="text-theme-colored-blue" href="#"><?php echo e($row->getcustomer->full_name()); ?> |</a></li>

                                  <li><span class="text-theme-colored-blue"><?php echo e(ViewsHelper::displayDate($row->created_at)); ?></span></li>

                                </ul>

                                <div class="clearfix"></div>

                              </div>

                            </article>

                         </div>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                   </div>

                </div>

                <?php else: ?>

                  <div class="row">

                    <div class="col-md-12 text-center">

                      <h2 class="mt-0">Oops! Not data Found</h2>

                      <p>The page you were looking for could not be found.</p>

                      <a class="btn btn-border btn-gray btn-transparent btn-circled" href="<?php echo e(url('/')); ?>">Return Home</a>

                    </div>

                  </div>

                <?php endif; ?>

            </div>

          </div>

        </div>

      </div>

    </section>

  <?php endif; ?>

  <?php if(count($blogsdata) > 0): ?>

  <section id="blog-tab"  class="bg-theme-colored-transparent-deep">

      <div class="container pt-70">

        <div class="section-title text-center">

          <div class="row">

            <div class="col-md-8 col-md-offset-2">

              <h3 class="text-uppercase mt-0">Blogs</h3>

              <div class="title-icon">

                <i class="flaticon-charity-hand-holding-a-heart"></i>

              </div>

              <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

            </div>

          </div>

        </div>

         <div class="row">

          <div class="col-md-12">

            <div class="news-carousel owl-nav-top mb-sm-80" data-dots="true">



               <?php $__currentLoopData = $blogsdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="item">

                  <article class="post clearfix maxwidth600 mb-sm-30">

                    <div class="entry-header">

                      <div class="post-thumb thumb"> 

                        <?php if($row->upload_file == 'Video'): ?>

                          <?php echo $row->youtube_url; ?>


                          <?php elseif($row->upload_file == 'Image'): ?>

                          <img alt="" src="<?php echo e(url($row->attachments[0]->attachment)); ?>" class="img-fullwidth img-responsive">

                          <?php else: ?>

                          <img src="<?php echo e(url('public/common/no-image.png')); ?>" alt="" class="img-responsive img-fullwidth" style="height: 205px;"> 

                        <?php endif; ?> 

                      </div>

                    </div>

                    <div class="entry-content border-1px p-20">

                      <h5 class="entry-title mt-0 pt-0"><a title="<?php echo e($row->title); ?>" href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->short_title(40)); ?></a></h5>

                      <p class="text-left mb-20 mt-15 font-13 text-justify"><?php echo e($row->short_desc(100)); ?></p>

                      <a class="btn btn-flat btn-dark btn-theme-colored pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>

                      <ul class="list-inline entry-date pull-right font-12 mt-5">

                        <li><a href="<?php echo e(($row->getcustomer) ?  $row->getcustomer->getDetailsPageUrl() : '#'); ?>"><?php echo e($row->author_name); ?></a></li> | <li><span><?php echo e(ViewsHelper::displayDate($row->created_at)); ?></span></li>

                      </ul>

                      <div class="clearfix"></div>

                    </div>

                  </article>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

          </div>

      </div><!----/row---->

      </div>

  </section>

  <?php endif; ?>

  <?php if(count($events) > 0): ?>

  <section  id="events-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container mt-30 mb-30 pt-30 pb-30">

        <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">EVENTS & ADDONS</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

        <div class="row ">

          <div class="col-md-12">

            <div class="blog-posts">

                <?php if(count($events) > 0): ?>

                  <div class="row ">

                   <div class="col-md-12">

                    <div class="news-carousel owl-nav-top mb-sm-80">

                      <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <div class="item">

                          <article class="post clearfix maxwidth600 mb-30">

                            <div class="entry-header">

                              <div class="post-thumb thumb"> <img src="<?php echo e(url('public/uploads/addons/'.$row->image)); ?>" alt="" class="img-responsive img-fullwidth"> </div>

                              </div>

                            <div class="entry-content border-1px p-20">

                              <h5 class="entry-title mt-0 pt-0"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->title); ?> - <?php echo e($row->getprogram->title); ?></a></h5>

                              <h6 class="text-theme-colored mb-5"><?php echo e(ViewsHelper::displayAmount($row->payment_amount)); ?></h6>

                              <p class="text-left mb-20 font-13"><?php echo e($row->short_desc(190)); ?></p>

                              <a class="btn btn-dark btn-theme-colored btn-flat pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>

                              <div class="clearfix"></div>

                            </div>

                          </article>

                        </div>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                   </div>

                </div>

                <?php endif; ?>

            </div>

          </div>

        </div>

      </div>

  </section>

  <?php endif; ?>



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
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/frontend/pages/programs-details.blade.php ENDPATH**/ ?>