 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Enquiry View</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/dashboard')); ?>">Home</a></li>
               <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/enquiry')); ?>">Enquiries</a></li>
               <li class="breadcrumb-item active">Enquiry View</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Information</h4>
               </div>
               <div class="card-body ribbon-box pb-1">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Name</label>
                           <p><?php echo e($data->name); ?></p>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group has-danger">
                           <label class="control-label">Phone Number</label>
                           <p><?php echo e($data->phone_number); ?></p>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group has-danger">
                           <label class="control-label">Email Address</label>
                           <p><?php echo e($data->email); ?></p>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group has-danger">
                           <label class="control-label">Institution</label>
                           <p><?php echo e($data->institution); ?></p>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group has-danger">
                           <label class="control-label">Subject</label>
                           <p><?php echo e($data->subject); ?></p>
                        </div>
                     </div>
                      <div class="col-md-12">
                        <div class="form-group has-danger">
                           <label class="control-label">Message</label>
                           <p><?php echo e($data->message); ?></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/admin/enquiry/view.blade.php ENDPATH**/ ?>