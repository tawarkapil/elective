<?php $__env->startSection('title'); ?>
<title>My Elective - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Elective</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active">My Elective</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">  
           <div class="card card-warning card-outline">
             <div class="card-header">
                <h3 class="card-title">My Elective</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool personalFrmToggle" data-card-widget="collapse" title="Collapse">
                   <i class="fas fa-minus"></i>
                   </button>
                </div>
             </div>
             <div class="card-body">
                <ul class="list-icon theme-colored listnone pl-0">
                  <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span> <span>Date : 16 Nov, 2024 05:36 PM</span></li>
                  <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span> <span>Destination : Kathmandu - Nepal</span></li>
                  <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span> <span>Program : Dental & Dental Assistant</span></li>
                  <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span> <span>Add-ons : Asdf - Arusha(Tanzania), PHP Developer - Kathmandu(Nepal)</span></li>
                  <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span> <span>Tours : New Tours - Dental & Dental Assistant, New Tours - Dental & Dental Assistant, New Tours - Dental & Dental Assistant</span></li>
                  <li class="check_list mb-2"><span><i class="fa fa-check-circle"></i></span> <span>Group Trip : (Group Id and link to group)</span></li>
                </ul>
             </div>
             <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card card-warning card-outline collapsed-card">
             <div class="card-header">
                <h3 class="card-title">Program Advisor</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool contactFrmToggle" data-card-widget="collapse" title="Collapse">
                   <i class="fas fa-plus"></i>
                   </button>
                </div>
             </div>
             <div class="card-body" style="display: none;">

              <div class="timeline">
              <!-- timeline item -->
              <?php for($i = 1; $i <= 3; $i++): ?>
              <div>
                <i class="fas fa-phone bg-blue"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header"><a href="#">Call <?php echo e($i); ?> </a></h3>
                  <div class="timeline-body">
                    <b>Call Description : </b>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                    quora plaxo ideeli hulu weebly balihoo...
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <?php endfor; ?>
            </div>
             <!-- /.card-body -->
           </div>
          </div>
          <!-- /.card -->

          <div class="card card-warning card-outline collapsed-card">
             <div class="card-header">
                <h3 class="card-title">Program Coordinator</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool studiesFrmToggle" data-card-widget="collapse" title="Collapse">
                   <i class="fas fa-plus"></i>
                   </button>
                </div>
             </div>
             <div class="card-body" style="display: none;">
              <div class="row">
                <?php $__currentLoopData = $ourmembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                  <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                     <h2 class="lead"><b><?php echo e($row->name.'('.$row->designation.')'); ?></b></h2>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-8">
                          <!-- <h2 class="lead"><b><?php echo e($row->name.'('.$row->designation.')'); ?></b></h2> -->
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <?php echo e($row->getdestination->title); ?> - <?php echo e($row->getdestination->getcountry->name); ?></li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> + 800 - 12 12 23 52</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> <?php echo e($row->email); ?></li>
                          </ul>
                        </div>
                        <div class="col-4 text-center">
                          <img style="height: 85px;border: 1px solid #DDD;width: 85px;object-fit: cover;" src="<?php echo e(url('public/uploads/our-member/'.$row->cover_image)); ?>" alt="user-avatar" class="img-circle img-fluid">
                        </div>
                        <div class="col-md-12">
                          <p class="text-muted text-sm"><?php echo $row->description; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

                
             </div>
             <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div> 
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.dashboard_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/dashboard/myelective.blade.php ENDPATH**/ ?>