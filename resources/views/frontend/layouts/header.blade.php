 <!-- preloader -->
   <div id="preloader">
      <div id="spinner">
         <div class="preloader-dot-loading">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
         </div>
      </div>
   </div>
     <!-- Header -->
  <header class="header">
    
    <div class="header-nav header-nav navbar-fixed-top header-dark navbar-white navbar-transparent navbar-sticky-animated">
      <div class="header-top blue_bg_color sm-text-center">
        <div class="container">
          <div class="pull-left">
            <ul class="second_menu mb-0 pl-0 upper-top-menu">
              <li>
                <div id="google_translate_element" ></div>
              </li>
            </ul>


              
              <script type="text/javascript">
                function googleTranslateElementInit() {
                  new google.translate.TranslateElement({
                    pageLanguage: 'en',
                     includedLanguages : 'hi,en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                  }, 'google_translate_element');
                }

                // function googleTranslateElementInit() {
                //     new google.translate.TranslateElement({
                //       pageLanguage: 'en,hi', 
                //       includedLanguages : 'hi,en',
                //       layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                //     }, 'google_translate_element');
                // }
              </script>
              <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          </div>
          <div class="pull-right">
            
             <ul class="second_menu mb-0 pl-0 upper-top-menu">
              @if(Auth::guard('customer')->check())
                <!-- <li><a href="{{ url('invoice-payments') }}">Invoice &amp; Payments</a></li>
                <li><a href="{{ url('community') }}">Community</a></li>
                <li><a href="{{ url('emergency-info') }}">Emergency</a></li>
                <li><a href="{{ url('guide-documents') }}">All Documents</a></li> -->
             @endif

                <li><a href="{{ url('about-us') }}">About Us</a></li>
                <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
            </ul>
            
          </div>
        </div>
      </div>

      <div class="header-nav-wrapper">
        <div class="container-fluid p-40 pt-10 pb-10">
          <nav id="menuzord-right" class="menuzord orange text-uppercase">
            
             <a href="{{ url('/') }}" class="logo_title menuzord-brand"><img src="{{ url('public/frontend/assets/logo/logo.png') }}"></a>
            
            <ul class="menuzord-menu">
                <li><a href="{{ url('destinations') }}">Destinations</a></li>
                <li><a href="{{ url('programs') }}">Programs</a></li>
                <li><a href="{{ url('prices') }}">Prices</a></li>
                @if(Auth::guard('customer')->check())
                <li><a href="{{ url('volunteer') }}">Volunteers</a></li>
                @endif
                <li><a href="{{ url('trips') }}">Trips</a></li>
                <li><a href="{{ url('blogs') }}">Blogs</a></li>
                <!-- <li>
                  <ul class="dropdown" style="right: auto; display: none;">
                    <li><a href="{{ url('blogs') }}">Blogs List</a></li>
                    <li><a href="{{ url('blogs-timeline') }}">Blogs Timeline</a></li>
                  </ul>
                </li> -->

                <li><a href="{{ url('tours') }}">Itinerary</a></li>
                <li><a href="{{ url('events') }}">Events</a></li>

               <!--  <li><a href="#">More<span class="indicator"></span></a>
                  <ul class="dropdown" style="right: auto; display: none;">
                    <li><a href="{{ url('about-us') }}">About Us</a></li>
                    <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                  </ul>
                </li>
                  -->
                 @if(Auth::guard('customer')->check())
                 <!-- <li>
                    <div class="btn-group">
                      <button type="button" class="dropdown-toggle toggle_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #164058;padding: 2px;padding-left: 10px;padding-right: 10px;border-radius: 3px;color: #f5b61b;font-weight: 700;">
                        <span  style="margin-right: 10px;margin-top: 5px;font-size: 14px;">{{ Auth::guard('customer')->user()->first_name }}</span>
                          <img src="{{ ViewsHelper::displayUserProfileImage(Auth::guard('customer')->user()) }}" class="profile_image" /> 
                      </button>
                      <ul class="dropdown-menu" style="left: -50px;">
                      <li><a href="{{ url('dashboard') }}"><i class="fa fa-tachometer mr-10 text-theme-colored" aria-hidden="true"></i> Dashboard</a></li>
                      <li><a href="{{ url('profile') }}"><i class="fa fa-user mr-10 text-theme-colored" aria-hidden="true"></i> My Profile</a></li>
                      <li><a href="{{ url('change-password') }}"><i class="fa fa-lock mr-10 text-theme-colored" aria-hidden="true"></i> Change Password</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out mr-10 text-theme-colored" aria-hidden="true"></i> Logout</a></li>
                      </ul>
                    </div>
                  </li> -->

                  @else
                 @endif
                  <li><a style="padding: 7px 16px 5px;margin-top: 5px;" href="{{ url('login') }}" class="btn btn-colored btn-dark btn-flat pull-right login_btn mr-2">LOGIN</a></li>
                  <li><a style="padding: 7px 16px 5px;margin-top: 5px;" href="{{ url('register') }}" class="btn btn-colored btn-theme-colored btn-flat pull-right login_btn">APPLY NOW</a></li>
              </ul>
          </nav>
        </div>
      </div>

    </div>
   </header>