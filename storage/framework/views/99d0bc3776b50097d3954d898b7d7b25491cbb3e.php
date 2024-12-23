<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('admin/dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Profile</h3>
          </div>

          <div class="card-body">
                <form  name="submitFrm" id="submitFrm">
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <label for="first_name">First Name <span class="required text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo e($data->first_name); ?>" > 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="last_name">Last Name <span class="required text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo e($data->last_name); ?>" > 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="email">Email <span class="required text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="email" readonly="" value="<?php echo e($data->email); ?>" > 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary float-right">Save Profile</button>
                        </div>
                    </div>

                </form

          </div>
        </div>
      </div>
    </section>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(url('public/panel/custom/auth/update-profile.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>


  
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/admin/profile/index.blade.php ENDPATH**/ ?>