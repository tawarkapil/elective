
<?php $__env->startSection('title'); ?>
<title>Expolore Group Trip - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/blog-banner.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="font-36 page_title">Expolore Group Trip</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="active">Expolore Group Trip</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row ">

          <div class="col-md-9 blog-pull-right">
            <div class="blog-posts">

                <?php if(count($data) > 0): ?>
                  <?php echo $__env->make('frontend.pages._ajax_trip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php else: ?>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h2 class="mt-0">Oops! Not data Found</h2>
                      <p>The page you were looking for could not be found.</p>
                      <a class="btn btn-border btn-gray btn-transparent btn-circled" href="<?php echo e(url('/')); ?>">Return Home</a>
                    </div>
                  </div>
                  <?php endif; ?>
            </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">By Location</h5>
                <div class="search-form">
                  <form>
                    <div class="input-group">
                      <input type="text" placeholder="Click to Search" class="form-control search-input">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">Programs</h5>
                <ul class="list-divider list-border" style="list-style: none; padding:0;">
                  <li><a href="<?php echo e(url('blogs')); ?>"><i class="fa fa-check-square-o mr-10 text-black-light"></i>All Categories</li>
                   <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(url('blogs')); ?>?category=<?php echo e($row->id); ?>"><i class="fa fa-check-square-o mr-10 text-black-light"></i> <?php echo e($row->title); ?><span> (0)</span></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">Durations</h5>
                <div class="tags">
                  <a href="#">All Duration</a>
                  <?php $__currentLoopData = Config::get('params.trip_durations'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#"><?php echo e($row); ?></a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/pages/trips.blade.php ENDPATH**/ ?>