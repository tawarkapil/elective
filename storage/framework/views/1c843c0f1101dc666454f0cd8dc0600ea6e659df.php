 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo e($total_students); ?></h3>

                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo e(url('admin/customers')); ?>"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>0</h3>

                <p>Total Trips</p>
              </div>
              <div class="icon">
                <i class="ion ion-plane"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo e($total_transaction_amt); ?></h3>

                <p>Total Transcation</p>
              </div>
              <div class="icon">
                <i class="ion ion-filing"></i>
              </div>
              <a href="<?php echo e(url('admin/user-transaction')); ?>"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo e($total_enquires); ?></h3>

                <p>Total Enquries</p>
              </div>
              <div class="icon">
                <i class="ion ion-iphone"></i>
              </div>
              <a href="<?php echo e(url('admin/enquiry')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Registered Students</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(count($recent_stundents) > 0): ?>
                    <?php $__currentLoopData = $recent_stundents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($key + 1); ?></td>
                      <td><?php echo e($val->full_name()); ?></td>
                      <td><?php echo e($val->email); ?></td>
                      <td><?php echo e($val->displayPhoneNumber()); ?></td>
                      <td class="text-center"><a class="text-muted" href="<?php echo e(url('admin/customers/view/'.base64_encode($val->customer_id))); ?>"><i class="fas fa-eye"></i></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                      <td class="text-center" colspan="12">No records found </td>
                    </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Trips</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Program</th>
                      <th>Destination</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(count($recent_trips) > 0): ?>
                    <?php $__currentLoopData = $recent_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($key + 1); ?></td>
                      <td><?php echo e($val->title); ?></td>
                      <td><?php echo e(($val->getprogram) ? $val->getprogram->title : 'N/A'); ?></td>
                      <td><?php echo e(($val->getdestination) ? $val->getdestination->title : 'N/A'); ?></td>
                      <td class="text-center"><a class="text-muted" href="<?php echo e(url('admin/trips/view/'.base64_encode($val->id))); ?>"><i class="fas fa-eye"></i></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                      <td class="text-center" colspan="12">No records found </td>
                    </tr>
                    <?php endif; ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>



      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>