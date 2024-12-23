<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add New</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/dashboard')); ?>">Home</a></li>
             <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/customers')); ?>">Customer</a></li>
              <li class="breadcrumb-item active">Add New</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-left">Add New</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form name="submitFrm" id="submitFrm">
                    <div class="row g-3">
                        <div class="col-sm-2">
                            <div class="profile_image_box" style="border: 1px solid #DDD;width: 90px;height: 100px;padding: 3px;">
                                <img style="height: 100%;width: 100%;object-fit: cover;" src="<?php echo e(ViewsHelper::displayUserProfileImage($data)); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                          <label class="form-label" for="profile_image">Profile Image</label>
                          <input type="file" name="profile_image" id="profile_image" class="form-control"/>
                        </div>
                    </div>
                    <br>
                    <div class="row g-3">
                       <div class="col-sm-4 form-group">
                          <label class="form-label" for="email">Email <span class="required text-danger">*</span></label>
                          <input type="text" name="email" id="email" class="form-control" value="<?php echo e(($data) ? $data->email : ''); ?>" <?php echo e(($data) ? 'disabled' : ''); ?> />
                       </div>
                       <div class="col-sm-4 form-group">
                          <label class="form-label" for="first_name">First Name <span class="required text-danger">*</span></label>
                          <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo e(($data) ? $data->first_name : ''); ?>" />
                       </div>
                       <div class="col-sm-4 form-group">
                          <label class="form-label" for="last_name">Last Name <span class="required text-danger">*</span></label>
                          <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo e(($data) ? $data->last_name : ''); ?>" />
                       </div>
                       <div class="col-sm-4 phone_number_container">
                          <label class="form-label" for="phone_number">Your Phone No <span class="required text-danger">*</span></label>
                          <div class="input-group">
                             <div class="input-group-prepend">
                                <?php echo $__env->make('admin.common._country_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                             </div>
                             <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?php echo e(($data) ? $data->phone_number : ''); ?>"/>
                          </div>
                       </div>
                       <div class="col-sm-4 form-group">
                          <label class="form-label" for="dob">Date of Birth <span class="required text-danger">*</span></label>
                          <input type="text" name="dob" id="dob" class="form-control custom-date-pickeer" autocomplete="off" value="<?php echo e(($data && $data->dob) ? date('d-m-Y', strtotime($data->dob)) : ''); ?>" />
                       </div>

                       <div class="col-sm-4 form-group">
                          <label class="form-label" for="occupation">Occupation <span class="required text-danger">*</span></label>
                          <input type="text" name="occupation" id="occupation" class="form-control" value="<?php echo e(($data) ? $data->occupation : ''); ?>" />
                       </div>

                        <div class="col-sm-4 form-group">
                          <label class="form-label" for="gender">Gender <span class="required text-danger">*</span></label>

                          <div>
                              <div class="icheck-primary d-inline mr-2">
                                <input type="radio" id="male" name="gender" <?php if(!$data || ($data && $data->gender == 1)): ?> checked="" <?php endif; ?> value="1">
                                <label for="male"> Male
                                </label>
                              </div>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="female" name="gender" value="2" <?php if($data && $data->gender == 2): ?> checked="" <?php endif; ?>>
                                <label for="female">Female
                                </label>
                              </div>
                          </div>
                       </div>
                   </div>

                   <div class="row">
                        <div class="col-sm-12 form-group">
                          <label class="form-label" for="about_me">About Me <span class="required text-danger">*</span></label>
                          <textarea type="text" name="about_me" id="about_me" class="form-control" rows="5" autocomplete="off"><?php echo e(($data) ? $data->about_me : ''); ?></textarea>
                       </div>
                   </div>
                   <br>
                    <h4>Social Links</h4>
                   <div class="row">
                       <div class="col-sm-6 form-group">
                          <label class="form-label" for="facebook_url">Facebook Url</label>
                          <input type="text" name="facebook_url" id="facebook_url" class="form-control" value="<?php echo e(($data) ? $data->facebook_url : ''); ?>" />
                       </div>
                       <div class="col-sm-6 form-group">
                          <label class="form-label" for="instagram_url">Instagram Url</label>
                          <input type="text" name="instagram_url" id="instagram_url" class="form-control" value="<?php echo e(($data) ? $data->instagram_url : ''); ?>" />
                       </div>
                       <div class="col-sm-6 form-group">
                          <label class="form-label" for="twitter_url">Twitter Url</label>
                          <input type="text" name="twitter_url" id="twitter_url" class="form-control" value="<?php echo e(($data) ? $data->twitter_url : ''); ?>" />
                       </div>
                       <div class="col-sm-6 form-group">
                          <label class="form-label" for="google_url">Google+ Url</label>
                          <input type="text" name="google_url" id="google_url" class="form-control" value="<?php echo e(($data) ? $data->google_url : ''); ?>" />
                       </div>
                   </div>
                  
                    <h4>Address</h4>
                   <div class="row">
                       

                       <div class="col-sm-3 form-group">
                          <label class="form-label" for="country">Country <span class="required text-danger">*</span></label>
                          <?php echo Form::select('country', ['' => 'Select Country'] + $countries, ($data) ? $data->country : $default_country, ['id' => 'country', 'class' => 'form-control']); ?>

                       </div>
                       <div class="col-sm-3 form-group">
                          <label class="form-label" for="state">State/Island <span class="required text-danger">*</span></label>
                          <?php echo Form::select('state', ['' => 'Select State'] + $states, ($data) ? $data->state : null, ['id' => 'state', 'class' => 'form-control']); ?>

                       </div>
                       <div class="col-sm-3 form-group">
                          <label class="form-label" for="city">City <span class="required text-danger">*</span></label>
                          <input type="text" name="city" id="city" class="form-control"  value="<?php echo e(($data) ? $data->city : ''); ?>"/>
                       </div>
                       <div class="col-sm-3 form-group">
                          <label class="form-label" for="zipcode">Zipcode <span class="required text-danger">*</span></label>
                          <input type="text" name="zipcode" id="zipcode" class="form-control"  value="<?php echo e(($data) ? $data->zip_code : ''); ?>"/>
                       </div>
                       <div class="col-sm-12">
                          <label class="form-label" for="address">Address</label>
                          <textarea name="address" id="address" class="form-control"><?php echo e(($data) ? $data->address : ''); ?></textarea>
                       </div>
                       <div class="col-12 mt-3">
                          <button type="submit" class="btn btn-primary float-right"> Submit </button>
                       </div>
                    </div>
               </form>
               
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('before-styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/panel/assets/plugins/daterangepicker/daterangepicker.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/frontend/assets/libs/select2/dist/css/select2.min.css')); ?><?php echo e(Config::get('params.app_version')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    var states = <?php echo json_encode($states, true) ?>;
    var country_code = "<?php echo e(($data) ? $data->country_code : 'CA'); ?>";
    var dial_code = "<?php echo e(($data) ? $data->dial_code : '1'); ?>";
    var default_country = "<?php echo e($default_country); ?>";
    var customer_id = "<?php echo e(($data) ? base64_encode($data->customer_id) : 0); ?>";

  </script>

<script src="<?php echo e(url('public/panel/assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('public/panel/custom/customer/addnew.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/admin/customer/addnew.blade.php ENDPATH**/ ?>