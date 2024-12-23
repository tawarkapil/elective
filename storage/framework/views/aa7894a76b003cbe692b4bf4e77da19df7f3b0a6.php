<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo e(url('admin/dashboard')); ?>" class="brand-link text-center">
      <span class="brand-text font-weight-light "><?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?php echo e(url('admin/dashboard')); ?>" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
          <li class="nav-item">
            <a href="<?php echo e(url('admin/customers')); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Students</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('admin/trips')); ?>" class="nav-link">
              <i class="nav-icon fas fa-bus"></i>
              <p>Trips</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('admin/testimonials')); ?>" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>Testimonials</p>
            </a>
          </li>
          <?php
            $class = "";
            $displayblock = 'display:none;';
            if(Request::is('admin/blogs') || Request::is('admin/comments')){
                $class = "menu-is-opening menu-open";
                $displayblock = 'display:block;';
            }
          ?>
          <li class="nav-item <?php echo e($class); ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Blogs & Comments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="<?php echo e($displayblock); ?>">
              <li class="nav-item">
                <a href="<?php echo e(url('admin/blogs')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blogs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('admin/comments')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comments</p>
                </a>
              </li>
            </ul>
          </li>



         
          <li class="nav-item">
            <a href="<?php echo e(url('admin/system-documents')); ?>" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documents</p>
            </a>
          </li>



          <li class="nav-item">
            <a href="<?php echo e(url('admin/enquiry')); ?>" class="nav-link">
              <i class="nav-icon fas fa-phone"></i>
              <p>Enquires</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('admin/user-transaction')); ?>" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>User Transactions</p>
            </a>
          </li>
          <?php
            $class = "";
            $displayblock = 'display:none;';
            if(Request::is('admin/pricing') || Request::is('admin/destinations') || Request::is('admin/programs') || Request::is('admin/tours')  || Request::is('admin/addons')  || Request::is('admin/our-members')){
                $class = "menu-is-opening menu-open";
                $displayblock = 'display:block;';
            }
          ?>
          <li class="nav-item <?php echo e($class); ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Masters & Configration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="<?php echo e($displayblock); ?>">
              <li class="nav-item">
                <a href="<?php echo e(url('admin/pricing')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pricing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('admin/destinations')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Destinations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('admin/programs')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Programs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('admin/tours')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tours</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(url('admin/addons')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add-Ons & Events</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('admin/our-members')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Our Members</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>