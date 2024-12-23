<?php $__env->startSection('title'); ?>

<title>Prices - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

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

              <h2 class="font-36 page_title">Prices</h2>

              <ol class="breadcrumb text-center mt-10 white">

                <li><a href="#">Home</a></li> 

                <li class="active">Prices</li>

              </ol>

            </div>

          </div>

        </div>

      </div>

    </section>

  

  <div class="second_navigation text-capitalize">

       <div class="container">

          <ul class="second_menu mb-0"> 
              <li><a href="#">Prices</a></li> 
              <li><a href="#whatsCovered">What’s Covered</a></li> 
              <li><a href="#registrationFee">Registration Fee</a></li> 
              <li><a href="#paymentOptions">Payment Options </a></li> 
              <li><a href="#support">Group Trips</a></li> 
              <li><a href="#fundMyTrip">Fund My Trip</a></li>
              <li><a href="#groupDiscount">Group Discount</a></li> 
              <li><a href="#tourDiscount">Tour Discount</a></li> 
              <li><a href="#blog">Optional Add Ons</a></li> 
        </ul> 

     </div>

  </div>

    <!-- Section: prices -->

    <section id="prices" class="divider parallax layer-overlay overlay-deep">

      <div class="container pb-80">

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

            <div class="col-md-12">

           <div class="table-responsive"> 

         <table class="table table-bordered">

                <thead class="blue_bg_color text-white"> 
                 <tr> 
                 <th>#</th> 
                 <th>Destination</th> 
                 <th>1 Weeks</th> 
                 <th>2 Weeks</th> 
                 <th>3 Weeks</th> 
                 <th>4 Weeks</th> 
                 <th>5 Weeks</th> 
                 <th>6 Weeks</th> 
                 <th>Every Extra Week</th> 
               </tr>
              </thead> 
               <tbody> 
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <tr class="active"> 
                    <th scope="row"><?php echo e($key + 1); ?></th> 
                    <td><?php echo e($val->getdestination->title.' - '. $val->getdestination->getcountry->name); ?></td> 
                    <td><?php echo e(ViewsHelper::displayAmount($val->week1_payment)); ?></td> 
                    <td><?php echo e(ViewsHelper::displayAmount($val->week2_payment)); ?></td> 
                    <td><?php echo e(ViewsHelper::displayAmount($val->week3_payment)); ?></td> 
                    <td><?php echo e(ViewsHelper::displayAmount($val->week4_payment)); ?></td> 
                    <td><?php echo e(ViewsHelper::displayAmount($val->week5_payment)); ?></td>
                    <td><?php echo e(ViewsHelper::displayAmount($val->week6_payment)); ?></td>
                    <td><?php echo e(ViewsHelper::displayAmount($val->extra_week_payment)); ?></td>
                 </tr> 
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               </tbody> 

              </table> 

            </div> 

              </div>

      </div> 

        

      </div>

    </section>
	
	<section style="background-color:#f7f7f7;"  id="whatsCovered" class="divider">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">What’s Covered</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">

            <div class="col-md-6"> 

              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

             <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			 
			 <ul style="font-weight:500;">
				<li>Start with 'Lorem ipsum dolor sit amet</li>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Start with centuries</li>
				<li>It has survived not only five centuries</li>
				<li>Lorem Ipsum has been the industry's</li>
			</ul>

            </div>

            <div class="col-md-6 text-center"> 

               <img class="img-fullwidth" src="<?php echo e(url('public/frontend/assets/images/side-view-hand-with-location-symbols.jpg')); ?>" alt=""> 

            </div>

         </div>

      </div>

   </section>
   
    <section id="registrationFee" class="blue_bg_color text-white"> 
     <div class="container pb-80">
	      
		<div class="row">
          <div class="col-md-6">
            <h3 class="text-uppercase mt-0 text-white">Registration Fee</h3>
			<h4 class="text-theme-colored">SECURE YOUR PLACE TODAY FOR A FIXED FEE OF $350 USD.</h4>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		  </div>
		  <div class="col-md-6">
           <h4 class="text-white">WHAT HAPPENS ONCE YOU REGISTER?</h4>
		   <ul style="font-weight:500;">
				<li>Start with 'Lorem ipsum dolor sit amet</li>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Start with centuries</li>
				<li>It has survived not only five centuries</li>
				<li>Lorem Ipsum has been the industry's</li>
			</ul>
		  </div>
		  
        </div>		  
	 
	 </div>
   </section>

    <section id="paymentOptions" class="divider parallax layer-overlay overlay-deep">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Payment Options</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div> 
		 
		<div class="row"> 
			<div class="text-center col-sm-6 mb-30">
			    <img src="<?php echo e(url('public/frontend/assets/images/stripe.png')); ?>" alt="">
			</div>
			<div class="text-center col-sm-6 mb-30">
			   <img src="<?php echo e(url('public/frontend/assets/images/paypal.png')); ?>" alt=""> 
			 </div> 
		</div> 
		 
		 
     </div> 
	 
</section> 	 

    <section style="background-color:#f7f7f7;" id="fundMyTrip" class="divider">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Fund My Trip</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">

            <div class="col-md-6"> 

              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 
			 
			 <ul style="font-weight:500;">
				<li>Start with 'Lorem ipsum dolor sit amet</li>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Start with centuries</li>
				<li>It has survived not only five centuries</li>
				<li>Lorem Ipsum has been the industry's</li>
			</ul>
			
			<div class="mt-20">
			   <a class="btn btn-flat btn-dark btn-theme-colored btn-lg pull-left mt-0 quick-link-btn-hover" href="https://elective.digitalshri.in/register">FundmyTrip</a>
			</div>

            </div>

            <div class="col-md-6 text-center"> 
               <img class="img-fullwidth" src="<?php echo e(url('public/frontend/assets/images/trip.jpg')); ?>" alt=""> 
            </div>

         </div>

      </div>

   </section>


    <section id="groupDiscount" class="divider">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Group Discount</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">

            <div class="col-md-6"> 

              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 
			 
			 <ul style="font-weight:500;">
				<li>Start with 'Lorem ipsum dolor sit amet</li>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Start with centuries</li>
				<li>It has survived not only five centuries</li>
				<li>Lorem Ipsum has been the industry's</li>
			</ul> 

            </div>

            <div class="col-md-6 text-center"> 
               <img class="img-fullwidth" src="<?php echo e(url('public/frontend/assets/images/trip.jpg')); ?>" alt=""> 
            </div>

         </div>

      </div>

   </section>
   
   <section style="background-color:#f7f7f7;" id="tourDiscount" class="divider">

      <div class="container">

         <div class="section-title text-center">

            <div class="row">

               <div class="col-md-8 col-md-offset-2">

                  <h3 class="text-uppercase mt-0">Tour Discount</h3>

                  <div class="title-icon title-icon-white">
                       <i class="fa fa-user-md"></i>
                  </div>

                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

               </div>

            </div>

         </div>

         <div class="row">
		 
		    <div class="col-md-6 text-center"> 
               <img class="img-fullwidth" src="<?php echo e(url('public/frontend/assets/images/trip.jpg')); ?>" alt=""> 
            </div>

            <div class="col-md-6"> 

              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 
			 
			 <ul style="font-weight:500;">
				<li>Start with 'Lorem ipsum dolor sit amet</li>
				<li>Lorem ipsum dolor sit amet</li>
				<li>Start with centuries</li>
				<li>It has survived not only five centuries</li>
				<li>Lorem Ipsum has been the industry's</li>
			</ul>
			
			<div class="mt-20">
			   <a class="btn btn-flat btn-dark btn-theme-colored btn-lg pull-left mt-0 quick-link-btn-hover" href="https://elective.digitalshri.in/register">FundmyTrip</a>
			</div>

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
.sticky {
    position:fixed;
    top:76px;
    z-index:999;
   }
</style>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/frontend/pages/pricing.blade.php ENDPATH**/ ?>