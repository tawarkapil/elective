<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <img src="{{ url('public/panel/assets/dist/img/avatar-2388584_640.png') }}" style="width: 32px;" alt="User Avatar" class="img-size-50 mr-1 img-circle"> Hello, {{ Auth::user()->full_name() }}
      </a>
      <div class="dropdown-menu dropdown-menu-right">
       
        <a href="{{ url('admin/profile') }}" class="dropdown-item">
          <h3 class="dropdown-item-title">
            Profile
          </h3>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ url('admin/change-password') }}" class="dropdown-item">
          <h3 class="dropdown-item-title">
             Change Password
          </h3>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ url('admin/logout') }}" class="dropdown-item">
          <h3 class="dropdown-item-title">
             Logout
          </h3>
        </a>
        
      </div>
    </li>
  </ul>
</nav>