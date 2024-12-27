<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-warning elevation-1">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ url('public/frontend/assets/logo/logo.png') }}"
            alt="{{ ViewsHelper::getConfigKeyData('website_title') }}" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ Request::is('dashboard') ? 'menu-open' : '' }}">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/dashboard.png') }}">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('profile') ? 'menu-open' : '' }}">
                    <a href="{{ url('profile') }}" class="nav-link {{ Request::is('profile') ? 'active' : '' }}">
                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/profile.png') }}">

                        <p>Profile</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('application') ? 'menu-open' : '' }}">
                    <a href="{{ url('application') }}"
                        class="nav-link {{ Request::is('application') ? 'active' : '' }}">

                        <img class="img-size-20 m-1"
                            src="{{ url('public/frontend/dashboard/icons/Application.png') }}">
                        <p>Application</p>
                    </a>
                </li>

                <?php
                $main_menu = false;
                if (Request::is('application-documents') || Request::is('guide-documents')) {
                    $main_menu = true;
                }
                
                ?>

                <li class="nav-item {{ $main_menu ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $main_menu ? 'active' : '' }}">
                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/Documents.png') }}">
                        <!-- <i class="nav-icon fas fa-circle"></i> -->
                        <p>
                            Documents
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if ($main_menu) @else style="display: none; " @endif>
                        <li class="nav-item {{ Request::is('application-documents/*') ? 'menu-open' : '' }}">
                            <a href="{{ url('application-documents') }}"
                                class="nav-link {{ Request::is('application-documents') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Mandatory Docs
                                </p>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('guide-documents/*') ? 'menu-open' : '' }}">
                            <a href="{{ url('guide-documents') }}"
                                class="nav-link {{ Request::is('guide-documents') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Guide Docs
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('my-elective') ? 'menu-open' : '' }}">
                    <a href="{{ url('my-elective') }}"
                        class="nav-link {{ Request::is('my-elective') ? 'active' : '' }}">
                        <img class="img-size-20 m-1"
                            src="{{ url('public/frontend/dashboard/icons/My Elective.png') }}">

                        <p>My Elective</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('my-trips/my-group') }}" class="nav-link">
                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/My Group.png') }}">
                        <p>My Groups</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('my-blogs') ? 'menu-open' : '' }}">
                    <a href="{{ url('my-blogs') }}" class="nav-link {{ Request::is('my-blogs') ? 'active' : '' }}">

                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/blog.png') }}">
                        <p>My Blogs</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('community') ? 'menu-open' : '' }}">
                    <a href="{{ url('community') }}" class="nav-link {{ Request::is('community') ? 'active' : '' }}">
                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/Community.png') }}">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <p>Community</p>
                    </a>
                </li>

                <?php
                $main_menu = false;
                if (Request::is('pre-depature/*') || Request::is('in-country/*') || Request::is('after-my-elective/*')) {
                    $main_menu = true;
                }
                
                ?>

                <li class="nav-item {{ $main_menu ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $main_menu ? 'active' : '' }}">
                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/timeline.png') }}">
                        <!-- <i class="nav-icon fas fa-circle"></i> -->
                        <p>
                            Timeline
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if ($main_menu) @else style="display: none; " @endif>
                        <li class="nav-item {{ Request::is('pre-depature/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('pre-depature/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Predeparture
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview"
                                @if (Request::is('pre-depature/*')) @else style="display: none; " @endif>
                                <li class="nav-item {{ Request::is('pre-depature/visa-flights') ? 'menu-open' : '' }}">
                                    <a href="{{ url('pre-depature/visa-flights') }}"
                                        class="nav-link {{ Request::is('pre-depature/visa-flights') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Visa & Flights</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('pre-depature/insurance') ? 'menu-open' : '' }}">
                                    <a href="{{ url('pre-depature/insurance') }}"
                                        class="nav-link {{ Request::is('pre-depature/insurance') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Insurance</p>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Request::is('pre-depature/health-safety') ? 'menu-open' : '' }}">
                                    <a href="{{ url('pre-depature/health-safety') }}"
                                        class="nav-link {{ Request::is('pre-depature/health-safety') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Health & Safety</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('pre-depature/packing-list') ? 'menu-open' : '' }}">
                                    <a href="{{ url('pre-depature/packing-list') }}"
                                        class="nav-link {{ Request::is('pre-depature/packing-list') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Packing List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ Request::is('in-country/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('in-country/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    In- Country
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview"
                                @if (Request::is('in-country/*')) @else style="display: none;" @endif>
                                <li
                                    class="nav-item {{ Request::is('in-country/orientation-logbook') ? 'menu-open' : '' }}">
                                    <a href="{{ url('in-country/orientation-logbook') }}"
                                        class="nav-link {{ Request::is('in-country/orientation-logbook') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Orientation & Log Book </p>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('in-country/accommodation') ? 'menu-open' : '' }}">
                                    <a href="{{ url('in-country/accommodation') }}"
                                        class="nav-link {{ Request::is('in-country/accommodation') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Accommodation</p>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Request::is('in-country/hospital-center') ? 'menu-open' : '' }}">
                                    <a href="{{ url('in-country/hospital-center') }}"
                                        class="nav-link {{ Request::is('in-country/hospital-center') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Hospital/Center</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('in-country/departure') ? 'menu-open' : '' }}">
                                    <a href="{{ url('in-country/departure') }}"
                                        class="nav-link {{ Request::is('in-country/departure') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Departure</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ Request::is('after-my-elective/*') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ Request::is('after-my-elective/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    After My Elective
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview"
                                @if (Request::is('after-my-elective/*')) @else style="display: none;" @endif>
                                <li
                                    class="nav-item {{ Request::is('after-my-elective/logbook') ? 'menu-open' : '' }}">
                                    <a href="{{ url('after-my-elective/logbook') }}"
                                        class="nav-link {{ Request::is('after-my-elective/logbook') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Log Book</p>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Request::is('after-my-elective/certificate-of-completion') ? 'menu-open' : '' }}">
                                    <a href="{{ url('after-my-elective/certificate-of-completion') }}"
                                        class="nav-link {{ Request::is('after-my-elective/certificate-of-completion') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Certificate of Completion</p>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Request::is('after-my-elective/work-with-us') ? 'menu-open' : '' }}">
                                    <a href="{{ url('after-my-elective/work-with-us') }}"
                                        class="nav-link {{ Request::is('after-my-elective/work-with-us') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> Work with us</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{ Request::is('my-testimonials') ? 'menu-open' : '' }}">
                    <a href="{{ url('my-testimonials') }}"
                        class="nav-link {{ Request::is('my-testimonials') ? 'active' : '' }}">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <img class="img-size-20 m-1"
                            src="{{ url('public/frontend/dashboard/icons/Testimonials.png') }}">
                        <p>Testimonials</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('invoice-payments') ? 'menu-open' : '' }}">
                    <a href="{{ url('invoice-payments') }}"
                        class="nav-link {{ Request::is('invoice-payments') ? 'active' : '' }}">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <img class="img-size-20 m-1" src="{{ url('public/frontend/dashboard/icons/invoice.png') }}">
                        <p>Invoice & Payments</p>
                    </a>
                </li>

                <li class="nav-item  {{ Request::is('fund-my-elective') ? 'menu-open' : '' }}">
                    <a href="{{ url('fund-my-elective') }}"
                        class="nav-link  {{ Request::is('fund-my-elective') ? 'active' : '' }}">
                        <img class="img-size-20 m-1"
                            src="{{ url('public/frontend/dashboard/icons/piggy-bank.png') }}">
                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <p>Fund My Elective</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('emergency-info') ? 'menu-open' : '' }}">
                    <a href="{{ url('emergency-info') }}"
                        class="nav-link {{ Request::is('emergency-info') ? 'active' : '' }}">
                        <img class="img-size-20 m-1"
                            src="{{ url('public/frontend/dashboard/icons/emergency-call.png') }}">
                        <p>Emergency</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
