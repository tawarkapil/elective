<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="{{ url('public/frontend/assets/logo/logo-icon.png') }}" alt="{{ ViewsHelper::getConfigKeyData('website_title') }}" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if(ViewsHelper::notificationCount(2) > 0)
        <span class="badge badge-warning navbar-badge noti count-notif remove-count-bell">{{ ViewsHelper::notificationCount(2) }}</span>
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header text-left">Notifications</span>
        <div class="dropdown-divider"></div>

        @if(count(ViewsHelper::getNotifications(2)) > 0)
        @foreach(ViewsHelper::getNotifications(2) as $value)
        <a href="{{ url('notifications') }}" class="dropdown-item">
          <p>{{ $value->notification }}
          </p>
          <p>
            <span class="float-right text-muted text-sm">{{ $value->created_at->diffForHumans() }}</span>
          </p>
        </a>
        <div class="clearfix"></div>
        <div class="dropdown-divider"></div>

        @endforeach
          @else
          <a href="javascript:void(0)" class="message-item">
             <p class="text-center">No Notification found</p>
          </a>
          <div class="dropdown-divider"></div>
          @endif
        <a href="{{ url('notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <!-- <i class="fas fa-bars"></i>  -->
        <b>
        <img src="{{ ViewsHelper::displayUserProfileImage(Auth::guard('customer')->user()) }}" alt="User Avatar" style="width:30px;height: 30px;" class="img-size-50 img-circle mr-1"> Rahul</b>
      </a>
      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a href="{{ url('profile') }}" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <div class="media-body">
              <h3 class="dropdown-item-title">Profile</h3>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
         <a href="{{ url('change-password') }}" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <div class="media-body">
              <h3 class="dropdown-item-title">Change Password</h3>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
         <a href="{{ url('logout') }}" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <div class="media-body">
              <h3 class="dropdown-item-title">Logout</h3>
            </div>
          </div>
          <!-- Message End -->
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->