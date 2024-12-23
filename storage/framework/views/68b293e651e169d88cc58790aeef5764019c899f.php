<?php $__env->startSection('title'); ?>
<title>Profile - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Start main-content -->
  <div class="main-content dashboard">
  
    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">
      <div class="container pt-30 pb-30">
      
        <div class="section-content">
          <div class="row"> 
            <div class="col-sm-8 xs-text-center">
              <h2 class="text-white mt-10">Profile</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">Profile</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 
    

    <!-- Section: Registration Form -->
    <?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="divider">
      <div class="container">
        <?php echo $__env->make('frontend.layouts.stepprogressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="white_box">
            <ul id="myTab" class="nav nav-tabs boot-tabs">
              <li class="active"><a href="#personalInfoTab" data-toggle="tab">Personal Info</a></li>
              <li><a href="#addressTab" data-toggle="tab">Address & Social Links</a></li>
              <li><a href="#gallaryTab" data-toggle="tab">Gallaries</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="personalInfoTab">
                 <form name="personalInfoFrm" id="personalInfoFrm">
                        <h4 class="pagesub_title">Profile</h4>
						
						<div class="d-flex mobile_d_block">
						
                        <div class="row g-3 mr-10">

                            <div class="col-sm-2">
                                <div class="profile_image_box">
                                    <img style="height: 100%;width: 100%;object-fit: cover;" src="<?php echo e(ViewsHelper::displayUserProfileImage($data)); ?>" class="update-pic-cls"/>
                                    <div style="height:0px;overflow:hidden"> 
                                        <input type="file" id="profile_image" name="profile_image"/> 
                                    </div>
                                    <a  class="camera_icon" onclick="profile_image.click();">
                                        <i class=" fa fa-camera"></i>
                                    </a>
                                </div>
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
                              <div class="input-group d-flex">
                                 <div class="input-group-prepend">
                                    <?php echo $__env->make('frontend.common._country_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 </div>
                                 <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?php echo e(($data) ? $data->phone_number : ''); ?>"/>
                              </div>
                           </div>
                           <div class="col-sm-4 form-group">
                              <label class="form-label" for="dob">Date of Birth <span class="required text-danger">*</span></label>
                              <input type="text" name="dob" id="dob" class="form-control custom-date-pickeer" autocomplete="off" value="<?php echo e(($data && $data->dob) ? date('d-m-Y', strtotime($data->dob)) : ''); ?>" />
                           </div>

                            <div class="col-sm-4 form-group">
                              <label class="form-label" for="gender">Gender <span class="required text-danger">*</span></label>

                              <div class="d-flex">
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
					   </div>
                       <div class="row">
                           <div class="col-sm-4 form-group">
                              <label class="form-label" for="university">Your University <span class="required text-danger">*</span></label>
                              <input type="text" name="university" id="university" class="form-control" value="<?php echo e(($data) ? $data->university : ''); ?>" />
                           </div>
                           <div class="col-sm-4 form-group">
                              <label class="form-label" for="year_of_study">Year of Study <span class="required text-danger">*</span></label>
                              <?php echo Form::select('year_of_study', ['' => 'Please Select'] + Config::get('params.year_of_studies'), ($data) ? $data->year_of_study : null, ['id' => 'year_of_study', 'class' => 'form-control']); ?>

                           </div>

                           <div class="col-sm-4 form-group">
                              <label class="form-label" for="graduation_date">Your Graduation Date <span class="required text-danger">*</span></label>
                              <input type="text" name="graduation_date" id="graduation_date" class="form-control custom-date-pickeer" value="<?php echo e(($data) ? $data->graduation_date : ''); ?>" placeholder="Eg. - 06/2015" />
                           </div>

                           <div class="col-lg-12">                        
                                <label class="form-label" for="profile_type">Please be aware that the content of your profile on our platform is set to be publicly viewable by default. You may check the “Private” box if you would like to keep your profile or some information private. <span class="required text-danger">*</span></label>

                              <div class="d-flex">
                                  <div class="icheck-primary d-inline mr-2">
                                    <input type="radio" id="public" name="profile_type" <?php if(!$data || ($data && $data->profile_type == 1)): ?> checked="" <?php endif; ?> value="1">
                                    <label for="public"> Public
                                    </label>
                                  </div>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="private" name="profile_type" value="2" <?php if(!$data || ($data && $data->profile_type == 2)): ?> checked="" <?php endif; ?>>
                                    <label for="private">Private
                                    </label>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-4 form-group">
                              <label class="form-label" for="referral_you">How did you hear about us?<span class="required text-danger">*</span></label>
                              <?php echo Form::select('referral_you', ['' => 'Please Select'] + Config::get('params.referral_dropdown'), ($data) ? $data->referral_you : null, ['id' => 'referral_you', 'class' => 'form-control']); ?>

                           </div>
                           <div class="col-sm-4 form-group referral_box other_refrral_box" <?php if(in_array($data->referral_you, ['Referral', 'Other'])): ?> <?php else: ?> style="display:none;" <?php endif; ?>>
                              <label class="form-label" for="referral_name">Name <span class="required text-danger">*</span></label>
                              <input type="text" name="referral_name" id="referral_name" class="form-control" value="<?php echo e(($data) ? $data->referral_name : ''); ?>" />
                           </div>

                           <div class="col-sm-4 form-group referral_box" <?php if(in_array($data->referral_you, ['Referral'])): ?> <?php else: ?> style="display:none;" <?php endif; ?>>
                              <label class="form-label" for="referral_contact_number">Contact Number <span class="required text-danger">*</span></label>
                              <input type="text" name="referral_contact_number" id="referral_contact_number" class="form-control custom-date-pickeer" value="<?php echo e(($data) ? $data->referral_contact_number : ''); ?>" />
                           </div>
                       </div>

                       <div class="row">
                            <div class="col-sm-12 form-group">
                              <label class="form-label" for="about_me">About Me <span class="required text-danger">*</span></label>
                              <textarea type="text" name="about_me" id="about_me" class="form-control" rows="10" autocomplete="off"><?php echo e(($data) ? $data->about_me : ''); ?></textarea>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-4 col-sm-offset-4 form-group">
                                <button class="btn btn-dark btn-block btn-xl">Submit</button>
                           </div>
                        </div>
                   </form>
              </div>
              <div class="tab-pane fade" id="addressTab">
                 <form name="addressAndSocialFrm" id="addressAndSocialFrm">
                        <h4>Address</h4>  
                       <div class="row">
                            <div class="col-sm-12 form-group">
                              <label class="form-label" for="address">Address <span class="required text-danger">*</span></label>
                              <textarea name="address" id="address" class="form-control"><?php echo e(($data) ? $data->address : ''); ?></textarea>
                           </div>
                           <div class="col-sm-3 form-group">
                              <label class="form-label" for="country">Country <span class="required text-danger">*</span></label>
                              <?php echo Form::select('country', ['' => 'Select Country'] + $countries, ($data) ? $data->country : $default_country, ['id' => 'country', 'class' => 'form-control']); ?>

                           </div>
                           <div class="col-sm-3 form-group">
                              <label class="form-label" for="state">State/Province/County <span class="required text-danger">*</span></label>
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
                       </div>


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
                       <div class="row">
                           <div class="col-sm-4 col-sm-offset-4 form-group">
                                <button class="btn btn-dark btn-block btn-xl">Submit </button>
                           </div>
                        </div>
                   </form>
              </div>
              <div class="tab-pane fade" id="gallaryTab">
                    <form name="gallaryFrm" id="gallaryFrm">
                        <div class="row">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-lg-6 col-lg-offset-3">
                                <label for="attachments"></label>
                                <div class="form-group files">
                                    <input type="file" id="uploadFiles" name="attachments" class="form-control" multiple="">
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated video-progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                 <div class="gallery-isotope grid-5 gutter-small clearfix displayUploadedFileName" data-lightbox="gallery">
                                    <?php if(isset($data->attachments) && count($data->attachments) > 0 ): ?>
                                        <?php $__currentLoopData = $data->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div class="gallery-item documentfileContainer" data-key="<?php echo e($file->attachment); ?>" >
                                            <div class="thumb">
                                              <img class="img-fullwidth imagefit_cover" src="<?php echo e(ViewsHelper::getBlogImage($file)); ?>" alt="project">
                                              <div class="overlay-shade"></div>
                                              <div class="icons-holder">
                                                <div class="icons-holder-inner">
                                                  <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                                    <a data-lightbox="image" href="<?php echo e(ViewsHelper::getBlogImage($file)); ?>"><i class="fa fa-plus"></i></a>
                                                    <a href="#"><i class="fa fa-trash removeUploadFile"></i></a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                   </form>
                </div> 
            </div>
          </div>
          <div class="row">
                <div class="col-md-12">
                    <br>
                    <a href="<?php echo e(url('application')); ?>" class="btn btn-border btn-theme-colored pull-right">Next : Application <i class="fa fa-arrow-circle-right"></i></a>
                    <br>
                </div>
          </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/frontend/assets/plugins/daterangepicker/daterangepicker.css')); ?>" />
<style type="text/css">
    .white_box {
        background-color: #fff;
        padding: 0;
        padding-top: 0;
    }

    .files input {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
        padding: 70px 0px 100px 35%;
        text-align: center !important;
        margin: 0;
        width: 100% !important;
    }
    .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
     }
    .files{ position:relative}
    .files:after {  pointer-events: none;
        position: absolute;
        top: 60px;
        left: 0;
        width: 50px;
        right: 0;
        height: 60px;
        content: "";
        display: block;
        margin: 0 auto;
        background-size: 100%;
        background-repeat: no-repeat;
    }

    .files:before {
        position: absolute;
        bottom: 10px;
        left: 0;  pointer-events: none;
        width: 100%;
        right: 0;
        height: 45px;
        content: " or drag it here. ";
        display: block;
        margin: 0 auto;
        color: #133d59;
        font-weight: 600;
        text-transform: capitalize;
        text-align: center;
    }

    .bg-success{
        background-color: green;
    }

   .bg-warning{
      background-color: yellow;
   }

   .video-progress-bar {
       height: 12px;
       border-radius: 5px;
   }

   .progress{
       display: none;
       height: 12px;
       margin-top: 6px;
   }

   .progress-bar span.percent{
    display: none !important;
   }

   .gallery-isotope{
        position: unset !important;
        height: auto !important;
        display: inline-flex;
        flex-wrap: wrap;
        width: 100%;
   }
   .gallery-isotope.grid-5 .gallery-item{
    position: unset !important;
    height: 200px !important;
   }

   .gallery-isotope .gallery-item, .gallery-isotope .gallery-item .thumb, .gallery-isotope .gallery-item .thumb img{
        height: 100%;
   }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    var states = <?php echo json_encode($states, true) ?>;
    var country_code = "<?php echo e(($data) ? $data->country_code : 'CA'); ?>";
    var dial_code = "<?php echo e(($data) ? $data->dial_code : '1'); ?>";
    var default_country = "<?php echo e($default_country); ?>";

    var uploaderMines = "jpg|png|jpeg";
   var maxSizeMb = 2;
   var attachments = <?php echo ($data) ? json_encode($data->getAttachmentArr()) : json_encode([]); ?>;

  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/vendor/jquery.ui.widget.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/jquery.fileupload.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/jquery.fileupload-process.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/jquery.fileupload-validate.js')); ?>"></script>
<script src="<?php echo e(url('public/frontend/assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/profile/index.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/frontend/profile/index.blade.php ENDPATH**/ ?>