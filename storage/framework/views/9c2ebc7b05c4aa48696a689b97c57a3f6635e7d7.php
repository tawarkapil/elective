<?php $__env->startSection('title'); ?>

<title>Community - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

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

              <h2 class="text-white mt-10">Community</h2>

            </div>

            <div class="col-sm-4">

              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 

                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>

                <li class="active">Community</li>

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

        <div class="row"> 

          <div class="col-md-12">

            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container">
                  <h4>Join Our Community on WhatsApp : </h4>
                  <p>Connect with our dynamic community, including your mentors in the destination country, and network with fellow students across the world, and if applicable, those traveling on your trip in your own private Group Trip Community!</p>
                  <p>
                    <ul>
                      <li><b>Benefits:</b> Gain valuable insights, make new friends, receive real-time updates, and learn about your mentors and peers.</li>
                      <li><b>Group Trip (if applicable):</b> Join your specific group trip to know who you're traveling with. Plan excursions, share travel plans, and start bonding even before your journey begins.</li>
                      <li><b>Team Introduction:</b> Get to know your in-country team through group chats, facilitating a smoother transition upon arrival.</li>
                    </ul>
                  </p>
                  <p><b>How to Join:</b> Click the link to enter our WhatsApp group and specific trip groups. Don’t forget to introduce yourself and start engaging!</p>
                 <p>
                  <div><b>Connect on Our Social Media Platforms: </b></div>
                  </p>
                  <p>Broaden your interaction with the Electives Global community on Facebook, Instagram, X (Twitter) and other social media sites. Each platform offers unique ways to connect, share, and learn. Follow us to stay informed about events, share your experiences, and join discussions that broaden your elective journey.</p>

                  <p>By following us, you become part of a supportive network, expanding your connections and insights far beyond your immediate elective experience. </p>

                  <p><b>YouTube:</b> Our social media presence extends to our YouTube channel, where we offer a wealth of valuable information and engaging content. This platform is perfect for deeper engagement with the Electives Global experience, featuring informative videos, student testimonials, and interactive sessions. It's an excellent resource for gaining a more comprehensive understanding of the elective journey, listen in on other students’ experiences, tips for preparation, and insights into various global medical practices. </p>

                  <div class="pt-50">
                    <a href="<?php echo e(url('pre-depature')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: Pre-elective Discussion <i class="fa fa-arrow-circle-right"></i></a>
                    <br>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/static-pages/community.blade.php ENDPATH**/ ?>