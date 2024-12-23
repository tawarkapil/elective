<?php $__env->startSection('title'); ?>

<title>Blogs - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

 <!-- Start main-content -->

  <div class="main-content dashboard">

  

    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">

      <div class="container pt-30 pb-30">

        <!-- Section Content -->

        <div class="section-content">

          <div class="row"> 

            <div class="col-sm-8 xs-text-center">

              <h2 class="text-white mt-10">Add Blog</h2>

            </div>

            <div class="col-sm-4">

              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 

                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>

                <li><a href="<?php echo e(url('my-blogs')); ?>">My Blogs</a></li>

                <li class="active">Add Blog</li>

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

        <div class="row">

          

          <div class="col-md-12">

            <div class="white_box">

              <!-- /.card-header -->

              <div class="row" style="border-bottom: 1px solid #DDD;margin-bottom: 20px;">

                 <div class="col-lg-12">

                    <h4>Blog</h4>

                 </div>

              </div>

                 <form name="submitFrm" id="submitFrm">

                     <div class="row">

                        <div class="col-lg-6">

                           <div class="form-group">

                              <label for="title">Title <span class="required text-danger">*</span></label>

                              <input type="text" class="form-control" id="title" name="title" value="<?php echo e(($data) ? $data->title : ''); ?>">

                           </div>

                        </div>



                        <div class="col-lg-6">

                           <div class="form-group">

                              <label for="category_id">Category <span class="required text-danger">*</span></label>

                              <?php echo Form::select('category_id', ['' => 'Please Select'] + $categories, ($data) ? $data->category_id : null, ['id' => 'category_id', 'class' => 'form-control']); ?>


                           </div>

                        </div>



                        <div class="col-lg-6">

                           <div class="form-group">

                              <label for="category_id">Trip <span class="required text-danger">*</span></label>

                              <?php echo Form::select('trip_id', ['' => 'Please Select'] + $trips, ($data) ? $data->trip_id : null, ['id' => 'trip_id', 'class' => 'form-control']); ?>


                           </div>

                        </div>

                        <div class="col-lg-6">

                           <div class="form-group">

                              <label for="tags">Tags <span class="required text-danger">*</span></label>

                              <select name="tags[]" id="tags" class="form-control" multiple="true">

                                 <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                 <option <?php if($data && in_array($val, explode(',', $data->tags))): ?> selected="selected" <?php endif; ?> value="<?php echo e($val); ?>"><?php echo e($val); ?></option>

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              </select>

                           </div>

                        </div>





                        <!-- <div class="col-lg-6">

                           <div class="form-group">

                              <label for="upload_type">Do you want upload some memories</label>

                              <div class="d-flex">

                                 <div class="icheck-primary d-inline mr-2">

                                   <input type="radio" id="upload_type_yes" name="upload_type"  value="1" <?php if($data && $data->upload_type == 1): ?> checked="" <?php endif; ?>>

                                   <label for="upload_type_yes">Yes</label>

                                 </div>

                                 <div class="icheck-primary d-inline">

                                   <input type="radio" id="image_type_no" name="upload_type" value="2" <?php if(!$data || ($data && $data->upload_type == 2)): ?> checked="" <?php endif; ?> >

                                   <label for="image_type_no">No</label>

                                 </div>

                             </div>

                           </div>

                        </div>
 -->


                        <div class="col-lg-6 upload_file_bx">

                           <div class="form-group">

                              <label for="upload_file">Which you will be upload Image(s) or Video <span class="required text-danger">*</span></label>

                              <div class="d-flex">

                                 <div class="icheck-primary d-inline mr-2">

                                   <input type="radio" id="upload_file_image" name="upload_file"  value="Image" <?php if(!$data || ($data && $data->upload_file == 'Image')): ?> checked="" <?php endif; ?>>

                                   <label for="upload_file_image">Images</label>

                                 </div>

                                 <div class="icheck-primary d-inline">

                                   <input type="radio" id="image_type_video" name="upload_file" value="Video" <?php if($data && $data->upload_file == 'Video'): ?> checked="" <?php endif; ?> >

                                   <label for="image_type_video">Video</label>

                                 </div>

                             </div>

                           </div>

                        </div>

                     </div>



                     <div class="row youtube_url_bx" <?php if($data && $data->upload_file == 'Video'): ?>  <?php else: ?> style="display:none;" <?php endif; ?>>

                        <div class="col-lg-12">

                           <div class="form-group">

                              <label for="youtube_url">Youtube Url <span class="required text-danger">*</span></label>

                              <textarea name="youtube_url" id="youtube_url" class="form-control" rows="3" placeholder="Please enter embeded code"><?php echo e(($data) ? $data->youtube_url : ''); ?></textarea>

                           </div>

                        </div>

                     </div>

                    <div class="row image_upload_bx" <?php if(!$data || ($data && $data->upload_file == 'Image')): ?> <?php else: ?>  style="display:none;" <?php endif; ?>>

                        <?php echo @csrf_field(); ?>




                        <div class="col-md-6">

                          <div class="form-group">

                            <label class="control-label" for="attachments">Upload Image(s) </label>

                            <div class="input-group"> 

                                <input type="file" class="custom-file-input" name="attachments" id="uploadFiles" multiple="">

                              </div>

                            </div>

                            <div class="progress">

                                <div class="progress-bar progress-bar-striped progress-bar-animated video-progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>

                            </div>

                        </div>

                        

                        <div class="col-md-12">

                            <!-- <div class="displayUploadedFileName"> -->

                                <div class="gallery-isotope grid-5 gutter-small clearfix displayUploadedFileName" data-lightbox="gallery">

                                    <?php if(isset($data->attachments) && count($data->attachments) > 0 ): ?>

                                        <?php $__currentLoopData = $data->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                          <div class="gallery-item documentfileContainer" data-key="<?php echo e($file->attachment); ?>" >

                                            <div class="thumb">

                                              <img class="img-fullwidth" src="<?php echo e(ViewsHelper::getBlogImage($file)); ?>" alt="project">

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

                            <!-- </div> -->

                        </div>

                     </div>

                     <div class="row">

                        <div class="col-lg-12">

                           <div class="form-group">

                              <label for="description">Description <span class="required text-danger">*</span></label>

                              <textarea class="form-control" rows="5" id="description" name="description"><?php echo ($data) ? $data->description : ''; ?></textarea>

                           </div>

                        </div>

                     </div>

                     <div class="row">

                        <div class="col-sm-4 col-sm-offset-4 form-group">
                              <button class="btn btn-dark btn-block btn-xl" type="submit" id="submitBtn" name="submitBtn"> Submit </button>

                  </div>

                  </div>



                  </form>



          </div>

        </div>

      </div>

    </section>

  </div>

  <!-- end main-content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style type="text/css">

   .cke_toolbar_last{

      display: none !important;

   }

   .dataTables_scrollHeadInner{

      width: 100%;

   }



   .select2-container--default .select2-selection--multiple{

          line-height: 40px;

          border: 1px solid #ccc;

          border-radius: 0px;

   }



   .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {

       background-color: #f5b61b;

       color: white;

   }



   .bg-success{

      background-color: green;

   }



   .bg-warning{

      background-color: yellow;

   }



   .video-progress-bar {

       height: 20px;

       border-radius: 5px;

   }

   .progress{

       display: none;

       height: 20px;

       margin-top: 6px;

   }

</style>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?> 

<script type="text/javascript">

   var id = "<?php echo e(($data) ? base64_encode($data->id) : 0); ?>";

   var uploaderMines = "jpg|png|jpeg";

   var maxSizeMb = 2;

   var attachments = <?php echo ($data) ? json_encode($data->getAttachmentArr()) : json_encode([]); ?>;

</script>

<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/vendor/jquery.ui.widget.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/jquery.fileupload.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/jquery.fileupload-process.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(url('public/common/jquery-file-upload/js/jquery.fileupload-validate.js')); ?>"></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.ckeditor.com/4.11.1/full-all/ckeditor.js"></script>

<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/blogs/addnew.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/blogs/addnew.blade.php ENDPATH**/ ?>