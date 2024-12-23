<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="<?php echo e(url('public/frontend/assets/logo/logo-icon.png')); ?>" alt="<?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?>" height="60" width="60">
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
        <?php if(ViewsHelper::notificationCount(2) > 0): ?>
        <span class="badge badge-warning navbar-badge noti count-notif remove-count-bell"><?php echo e(ViewsHelper::notificationCount(2)); ?></span>
        <?php endif; ?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header text-left">Notifications</span>
        <div class="dropdown-divider"></div>

        <?php if(count(ViewsHelper::getNotifications(2)) > 0): ?>
        <?php $__currentLoopData = ViewsHelper::getNotifications(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(url('notifications')); ?>" class="dropdown-item">
          <p><?php echo e($value->notification); ?>

          </p>
          <p>
            <span class="float-right text-muted text-sm"><?php echo e($value->created_at->diffForHumans()); ?></span>
          </p>
        </a>
        <div class="clearfix"></div>
        <div class="dropdown-divider"></div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <a href="javascript:void(0)" class="message-item">
             <p class="text-center">No Notification found</p>
          </a>
          <div class="dropdown-divider"></div>
          <?php endif; ?>
        <a href="<?php echo e(url('notifications')); ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <!-- <i class="fas fa-bars"></i>  -->
        <b>
        <img src="<?php echo e(ViewsHelper::displayUserProfileImage(Auth::guard('customer')->user())); ?>" alt="User Avatar" style="width:30px;height: 30px;" class="img-size-50 img-circle mr-1"> Rahul</b>
      </a>
      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a href="<?php echo e(url('profile')); ?>" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <div class="media-body">
              <h3 class="dropdown-item-title">Profile</h3>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
         <a href="<?php echo e(url('change-password')); ?>" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <div class="media-body">
              <h3 class="dropdown-item-title">Change Password</h3>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
         <a href="<?php echo e(url('logout')); ?>" class="dropdown-item">
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
<!-- /.navbar --><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/layouts/dashboard_header.blade.php ENDPATH**/ ?>