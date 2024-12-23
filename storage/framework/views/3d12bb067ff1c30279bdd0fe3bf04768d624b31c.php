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

              <h2 class="text-white mt-10">My Blogs</h2>

            </div>

            <div class="col-sm-4">

              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 

                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>

                <li class="active">My Blogs</li>

              </ol>

            </div>

          </div>

        </div>

      </div>

    </section> 

 <?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Section: Registration Form -->

    <section class="divider">

      <div class="container">

        <div class="row"> 

          <div class="col-md-12">

            <div class="white_box">

              <div class="card-header">



                <div class="pull-right">

                    <a href="<?php echo e(url('my-blogs/addnew')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>

                    <button type="button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" title="Filter" class="btn waves-effect waves-light btn-warning"><i class="fa fa-filter"></i> Filter</button>

                </div>

              </div>

              <!-- /.card-header -->

              <div class="clearfix mb-10"></div>

              <div class="row collapse" id="collapseExample">

                   <div class="col-lg-12">

                      <div class="filter-main-box">

                         <form name="filterFrm" id="filterFrm">

                            <div class="row">

                               <div class="col-lg-4 col-md-6">

                                  <div class="form-group">

                                     <label>Start Date</label>

                                     <input class="form-control custom-date-pickeer" type="text" name="srch_start_date" id="srch_start_date" autocomplete="off">

                                  </div>

                               </div>

                               <div class="col-lg-4 col-md-6">

                                  <div class="form-group">

                                     <label>End Date</label>

                                     <input class="form-control custom-date-pickeer" type="text" name="srch_end_date" id="srch_end_date" autocomplete="off">

                                  </div>

                               </div>

                               <div class="col-lg-4 col-md-6">

                                  <div style="margin-top: 32px;">

                                     <a class="btn btn-secondary text-light mr-1 resetBtn" type="button">Reset</a>

                                     <a class="btn btn-info text-light searchBtn" type="submit">Go</a>

                                  </div>

                               </div>

                            </div>

                         </form>

                      </div>

                   </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <table class="table table-bordered" style="width:100%;" id="custom-ajax-tbl">

                          <thead>

                            <tr>

                             <th>#</th>

                             <!-- <th>Image</th> -->

                             <th>Title</th>

                             <!-- <th>Author Name</th> -->

                             <th>Status</th>

                             <th class="all">Date</th>

                             <th class="all">Action</th>

                          </tr>

                          </thead>

                          <tbody>

                          </tbody>

                        </table>

                    </div>

                </div>

            </div>

          </div>

        </div>

      </div>

    </section>

  </div>

  <!-- end main-content -->



   <div class="modal fade" id="viewContentMdl">

   <div class="modal-dialog modal-md">

      <div class="modal-content">

         <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

         </div>

         <div class="modal-body">

         </div>

      </div>

   </div>

</div>

<!-- 



<div class="modal fade" id="submitFrmMdl">

   <div class="modal-dialog modal-lg">

      <div class="modal-content">

         <form name="submitFrm" id="submitFrm">

            <div class="modal-header bg-primary">

               <h4 class="modal-title float-left" id="page_headline"> Add New</h4>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>

            <div class="modal-body">

               <div class="row">

                <div class="col-lg-3">

                 <div class="form-group">

                    <label for="image">Image <span class="required text-danger">*</span></label><br/>

                    <input type="file" id="image" name="image">

                 </div>

              </div>

              <div class="col-lg-2">

                 <div class="imgDisplayBx"></div>

              </div>

               <div class="col-lg-12">

                  <div class="form-group">

                     <label for="title">Title <span class="required text-danger">*</span></label>

                     <input type="text" class="form-control" id="title" name="title">

                  </div>

               </div>



               <div class="col-lg-6">

                  <div class="form-group">

                     <label for="name">Author Name <span class="required text-danger">*</span></label>

                     <input type="text" class="form-control" id="name" name="name">

                  </div>

               </div>

               <div class="col-lg-6">

                  <div class="form-group">

                     <label for="status">Status <span class="required text-danger">*</span></label>

                     <?php echo Form::select('status', [ '' => 'Please Select', 1 => 'Active', 0 => 'Inactive'], null, ['id' => 'status', 'class' => 'form-control']); ?>


                  </div>

               </div>

               <div class="col-lg-12">

                  <div class="form-group">

                     <label for="description">Description <span class="required text-danger">*</span></label>

                     <textarea class="form-control" rows="5" id="description" name="description"></textarea>

                  </div>

               </div>



               </div>

               

            </div>

            <div class="modal-footer">

               <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>

               <button type="submit" id="submitBtn" name="submitBtn" class="btn btn-success"> Save </button>

            </div>

         </form>

      </div>

     

   </div>

   

</div>

 -->



<div class="modal fade text-left" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel111" aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

      <div class="modal-content">

         <div class="modal-header bg-primary">

            <h5 class="modal-title white pull-left" id="myModalLabel111">Change Status</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <i class="fa fa-times"></i>

            </button>

         </div>

         <div class="modal-body">

           <div class="modal-content-value"></div>

         </div>

         <div class="modal-footer text-right">

            <button data-dismiss="modal" class="btn btn-danger">CANCEL</button> 

            <button class="btn btn-success confirm_status">CONFIRM</button>

         </div>

      </div>

   </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/panel/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/panel/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/panel/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/panel/assets/plugins/daterangepicker/daterangepicker.css')); ?>" />



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?> 

<script src="<?php echo e(url('public/panel/assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>

<script src="<?php echo e(url('public/panel/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(url('public/panel/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script> 

<script src="<?php echo e(url('public/panel/assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/blogs/index.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/blogs/index.blade.php ENDPATH**/ ?>