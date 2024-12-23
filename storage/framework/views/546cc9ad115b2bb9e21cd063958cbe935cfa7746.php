<?php $__env->startSection('title'); ?>

<title><?php echo e($data->title); ?> - <?php echo e($data->getcountry->name); ?> - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

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

            <div class="col-md-12 text-center">

              <h2 class="font-36 page_title"><?php echo e($data->title); ?> - <?php echo e($data->getcountry->name); ?></h2>

              <ol class="breadcrumb text-center mt-10 white">

                <li><a href="#">Home</a></li> 

                <li class="active">Destination Details</li>

              </ol>

            </div>

          </div>

        </div>

      </div>

    </section>

  

  <div class="second_navigation text-capitalize">

       <div class="container">

          <ul class="second_menu mb-0">

            <li><a href="#highlights-tab">Highlights</a></li>

            <li><a href="#overview-tab">Overview</a></li>

            <?php if(count($programs) > 0): ?>

            <li><a href="#programs-tab">Programs</a></li>

            <?php endif; ?>

            <?php if(count($trips) > 0): ?>

            <li><a href="#group_trip-tab">Group Trips</a></li>

            <?php endif; ?>

            <li><a href="#support-tab">Support</a></li>

            <?php if(count($tours) > 0): ?>

            <li><a href="#tours-tab">Tours</a></li>

            <?php endif; ?>

            <?php if(count($blogsdata) > 0): ?>

            <li><a href="#blog-tab">Blog</a></li>

            <?php endif; ?>

            <?php if(count($members) > 0): ?>

            <li><a href="#meet_the_team-tab">Meet the Team</a></li> 

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

               <img class="intro_img" src="<?php echo e(url('public/uploads/destinations/'.$data->image)); ?>" alt="medical students"> 

            </div>

            <div class="col-md-6">

               <?php echo $data->description; ?>


            </div>

         </div>

      </div>

   </section>

  

  



   <!-- Section: Programs -->

    <?php if(count($programs) > 0): ?>

    <section id="programs-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container pb-80">

        <div class="section-title text-center">

          <div class="row">

            <div class="col-md-8 col-md-offset-2">

              <h3 class="text-uppercase mt-0">Programs</h3>

              <div class="title-icon title-icon-white">
                   <i class="fa fa-user-md"></i>
              </div>

              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

            </div>

          </div>

        </div>

        <div class="section-content">

    

        <div class="news-carousel owl-nav-top mb-sm-80">

              <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <div class="item">

                  <article class="post clearfix maxwidth600 mb-30">

                    <div class="entry-header">

                      <div class="post-thumb thumb"> <img src="<?php echo e(url('public/uploads/programs/'.$row->image)); ?>" alt="" class="img-responsive img-fullwidth"> </div>

                      </div>

                    <div class="entry-content border-1px p-20">

                      <h5 class="entry-title mt-0 pt-0"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->title); ?></a></h5>

                      <p class="text-left mb-20 mt-15 font-13"><?php echo e($row->short_desc(200)); ?></p>

                      <a class="btn btn-dark btn-theme-colored btn-xs btn-flat pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>

                      <div class="clearfix"></div>

                    </div>

                  </article>

                </div>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

           </div>

    

        </div>

      </div>

    </section>

    <?php endif; ?>

    <?php if(count($trips) > 0): ?>

    <section  id="group_trip-tab" class="divider parallax layer-overlay overlay-deep" style="background-color: #DDD;">

      <div class="container mt-30 mb-30 pt-30 pb-30">

        <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Group Trip</h3>

                  <div class="title-icon">

                     <i class="flaticon-charity-hand-holding-a-heart"></i>

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

                                <a class="btn btn-dark btn-theme-colored btn-xs btn-flat pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>

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

                <?php endif; ?>

            </div>

          </div>

        </div>

      </div>

    </section>

    <?php endif; ?>



    <section id="support-tab" class="divider parallax fullscreen" data-parallax-ratio="0.1" data-bg-img="<?php echo e(url('public/frontend/assets/images/support.jpg')); ?>">

      <div class="display-table">

        <div class="display-table-cell">

          <div class="container pt-300 pb-30">

            <div class="row">

              <div class="col-md-8 col-md-offset-2 text-center">

                <div class="pb-50 pt-30">

                   <h3 class="text-uppercase text-white bg-dark-transparent-light font-30 inline-block border-left-theme-color-2-4px border-right-theme-color-2-4px pl-30 pr-30 mb-5 pt-5 pb-5">Our Support</h3>

                  <h1 class="text-uppercase text-white mt-0 inline-block bg-theme-colored-transparent border-left-theme-color-2-6px border-right-theme-color-2-6px pl-40 pr-40 pt-5 pb-5 font-48">Please Contact Us</h1>

                  <p class="font-16 text-white">Every day we bring hope to millions of children in the world's<br> hardest places as a sign of God's unconditional love. </p>

                  <a href="#" class="btn btn-colored btn-lg btn-theme-colored pl-20 pr-20">Contact Us</a> 

         <p class="font-16 text-white pt-20">Or call us at +1 (91) 123 45879 to learn more.</p>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

    <?php if(count($tours) > 0): ?>

    <section  id="tours-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container mt-30 mb-30 pt-30 pb-30">

        <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">TOURS</h3>

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

                <?php if(count($tours) > 0): ?>

                  <div class="row ">

                   <div class="col-md-12">

                    <div class="news-carousel owl-nav-top mb-sm-80">

                      <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <div class="item">

                          <article class="post clearfix maxwidth600 mb-30">

                            <div class="entry-header">

                              <div class="post-thumb thumb"> <img src="<?php echo e(url('public/uploads/tours/'.$row->image)); ?>" alt="" class="img-responsive img-fullwidth"> </div>

                              </div>

                            <div class="entry-content border-1px p-20">

                              <h5 class="entry-title mt-0 pt-0"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->title); ?> - <?php echo e($row->getdestination->title); ?>(<?php echo e($row->getdestination->getcountry->name); ?>) </a></h5>

                              <h6 class="text-theme-colored mb-5"><?php echo e(ViewsHelper::displayAmount($row->payment_amount)); ?></h6>

                              <p class="text-left mb-20 font-13"><?php echo e($row->short_desc(190)); ?></p>

                              <a class="btn btn-dark btn-theme-colored btn-xs btn-flat pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>

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



    <?php if(count($members) > 0): ?>

   <!-- Section: Teams -->

    <section id="meet_the_team-tab" class="divider parallax layer-overlay overlay-deep">

      <div class="container pb-80">

        <div class="section-title text-center">

          <div class="row">

            <div class="col-md-8 col-md-offset-2">

              <h3 class="text-uppercase mt-0">Meet Our Teams</h3>

              <div class="title-icon title-icon-white">
                 <i class="fa fa-user-md"></i>
             </div>

              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

            </div>

          </div>

        </div>

        <div class="section-content">

          <div class="news-carousel owl-nav-top mb-sm-80">

            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="item">

              <div class="volunteer border bg-white-fa maxwidth400 p-30" style="min-height: 508px;">

                <div class="thumb"><img alt="" style="height:300px; width: 100%; object-fit: cover;" src="<?php echo e(url('public/uploads/our-member/'.$member->cover_image)); ?>" class="img-fullwidth img-circle"></div>

                <div class="info">

                  <h4 class="name"><a href="#" class="text-theme-colored"><?php echo e($member->name); ?></a></h4>

                  <h6 class="occupation"><?php echo e($member->designation); ?></h6>

                  <p><?php echo e($member->short_desc(100)); ?></p>

                  

                </div>

              </div>

            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



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

                        <a class="btn btn-flat btn-dark btn-theme-colored btn-sm pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>

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
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/pages/destination-details.blade.php ENDPATH**/ ?>