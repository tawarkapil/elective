@extends('frontend.layouts.app')

@section('title')

<title>Prices - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>

@stop

@section('content')

 <!-- Start main-content -->

  <div class="main-content">

    <!-- Section: inner-header -->

     <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="{{ url('public/frontend/assets/images/destination-bg.jpg') }}">

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
                @foreach($data as $key => $val)
                 <tr class="active"> 
                    <th scope="row">{{ $key + 1 }}</th> 
                    <td>{{ $val->getdestination->title.' - '. $val->getdestination->getcountry->name }}</td> 
                    <td>{{ ViewsHelper::displayAmount($val->week1_payment) }}</td> 
                    <td>{{ ViewsHelper::displayAmount($val->week2_payment) }}</td> 
                    <td>{{ ViewsHelper::displayAmount($val->week3_payment) }}</td> 
                    <td>{{ ViewsHelper::displayAmount($val->week4_payment) }}</td> 
                    <td>{{ ViewsHelper::displayAmount($val->week5_payment) }}</td>
                    <td>{{ ViewsHelper::displayAmount($val->week6_payment) }}</td>
                    <td>{{ ViewsHelper::displayAmount($val->extra_week_payment) }}</td>
                 </tr> 
                 @endforeach

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

               <img class="img-fullwidth" src="{{ url('public/frontend/assets/images/side-view-hand-with-location-symbols.jpg') }}" alt=""> 

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
			    <img src="{{ url('public/frontend/assets/images/stripe.png') }}" alt="">
			</div>
			<div class="text-center col-sm-6 mb-30">
			   <img src="{{ url('public/frontend/assets/images/paypal.png') }}" alt=""> 
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
               <img class="img-fullwidth" src="{{ url('public/frontend/assets/images/trip.jpg') }}" alt=""> 
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
               <img class="img-fullwidth" src="{{ url('public/frontend/assets/images/trip.jpg') }}" alt=""> 
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
               <img class="img-fullwidth" src="{{ url('public/frontend/assets/images/trip.jpg') }}" alt=""> 
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
	
	

  

    @include('frontend.pages._quick_contact_frm')

</div>

  <!-- end main-content -->

@stop

@section('scripts')
@stop

@section('styles')
<style type="text/css">
.sticky {
    position:fixed;
    top:76px;
    z-index:999;
   }
</style>   

@stop