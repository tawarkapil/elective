<?php $__env->startSection('title'); ?>
<title>Dashboard - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
              <h2 class="text-white mt-10">Dashboard</h2>
            </div>
          </div>
        </div>
      </div>
    </section> 

<?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    

<!------sidebar start--------->

<!------sidebar end--------->

    <!-- Section: Registration Form -->
    <section class="divider">
      <div class="container">
        <div class="row"> 
		
		  <div class="col-md-4">
		    <div class="dashboard_profile_blog text-center mb-30">
		       <img src="<?php echo e(ViewsHelper::displayUserProfileImage(Auth::guard('customer')->user())); ?>" class="profile_image" /> 
			    <h4 class="text-yellow user_name"> Hey <?php echo e(Auth::guard('customer')->user()->full_name()); ?>! </h4>
                <p class="d-flex align-items-center mb_15"><span class="info_dicon"><i class="fa fa-envelope" aria-hidden="true"></i></span> <span class="info_dlabel"><?php echo e(Auth::guard('customer')->user()->email); ?></span></p>
                <?php if(Auth::guard('customer')->user()->phone_number): ?>
        				  <p class="d-flex align-items-center mb_15"><span class="info_dicon"><i class="fa fa-phone" aria-hidden="true"></i></span><span class="info_dlabel"><?php echo e(Auth::guard('customer')->user()->displayPhoneNumber()); ?></span></p>
                <?php endif; ?>
                <?php if(Auth::guard('customer')->user()->university): ?>
        				  <p class="d-flex align-items-center mb_15"><span class="info_dicon"><i class="fa fa-university" aria-hidden="true"></i></span> <span class="info_dlabel"><?php echo e(Auth::guard('customer')->user()->university); ?></span></p>
                <?php endif; ?>
				 
			</div>	
		  </div>
          <div class="col-md-8">
            <div class="border-1px p-30 bg-white mb-30"> 
              <p class="text-theme-colored-blue"><strong>Welcome to Your Dashboard - Your Elective’s Nerve Center – Where Everything Comes Together!</strong></p>
             <p>
              We're thrilled to have you on board for what promises to be an unforgettable journey in the upcoming weeks. This is your launchpad for everything you need to prepare for, enjoy, and reflect on your healthcare elective. </p>
              <p>The Elective’s Global Dashboard for Electives Global is a comprehensive and dynamic interface designed to enhance your elective experience. This intuitive platform is aimed at ensuring a seamless and enriching elective planning process, enabling students to have a well-organized and enjoyable learning experience. Here’s a concise overview of your private space at Electives Global:  </p>
              
		</div>
	</div>	
		
		 <div class="col-md-12"> 
		    <div class="border-1px p-30 bg-white mb-30"> 
		      <p>
                <b class="text-theme-colored-blue">Comprehensive Sections:</b> Catering to different phases of your elective journey. 
              <ol>
                <li>Home</li>
                <li>My Elective</li>
                <li>Predeparture Prep</li>
                <li>In-Country</li>
                <li>After My Elective</li>
              </ol>
            </p>
              <p><b class="text-theme-colored-blue">Progress Bars:</b> Visual tracking of your journey's progression.</p>

              <p><b class="text-theme-colored-blue">Mobile Responsiveness:</b> Access and manage your dashboard on the go.</p>
              <p><b class="text-theme-colored-blue">Document Management:</b> Upload and download key documents like passport scans, visa details, orientation briefs, country guides etc.</p>
			</div>
        </div>	
        <div class="col-md-6"> 
		    <div class="border-1px p-30 bg-white mb-30 dashboard_features"> 		
              <h4 class="text-theme-colored-blue">Interactive Features:</h4>
              <p>
                <ul class="list theme-colored check">
                  <li>Pre-Elective Mandates: Stay on top of necessary preparations.</li>
                  <li>Blogs: Share your experiences and insights.</li>
                  <li>Group Interaction: Engage with peers on similar electives.</li>
                  <li>Funding Opportunities: Explore avenues for elective funding.</li>
                </ul>
              </p> 
			 </div>
        </div>	
		
        <div class="col-md-6"> 
		    <div class="border-1px p-30 bg-white mb-30 dashboard_features">  

              <h4 class="text-theme-colored-blue">Additional Resources:</h4>
              <p>
                <ul class="list theme-colored check">
                  <li>Program Advice and Scheduled Meetings: Leverage expertise of mentors for professional development.</li>
                  <li>Program Coordination: Seamless logistical support.</li>
                  <li>Add-ons/Events: Enrich your elective with additional experiences.</li>
                  <li>Tours/Activities: Explore and grow beyond academics.</li>
                </ul>
              </p>
              
          </div>
        </div>
		
		<div class="col-md-12">
		<a href="<?php echo e(url('guide')); ?>" class="btn btn-border btn-theme-colored pull-right">Start here <i class="fa fa-arrow-circle-right"></i></a>
		<br>
	  </div>
		
      </div>
    </section>
  </div>
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<style type="text/css">
  .inner-header {
      padding: 137px 0 50px 0;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/dashboard/index.blade.php ENDPATH**/ ?>