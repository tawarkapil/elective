 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Documents</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Documents</li>
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
                <h3 class="card-title float-left">Documents</h3>
               <!--  <div class="float-right">
                    <button type="button" class="btn bg-gradient-primary addNewBtn"><i class="fa fa-plus"></i> Add New</button>
                    <button type="button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" title="Filter" class="btn waves-effect waves-light btn-warning"><i class="fa fa-filter"></i> Filter</button>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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
                             <th>Country Name</th>
                             <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                           <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                              <td><?php echo e($key + 1); ?></td>
                              <td><?php echo e($row->name); ?></td>
                              <td>
                                 <div class="text-nowrap table-action">
                                    <a title="View" class="action-icon text-muted" href="<?php echo e(url('admin/system-documents/view/'.base64_encode($row->country_id))); ?>" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                 </div>
                              </td>
                           </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                    </div>
                </div>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/system-documents/index.blade.php ENDPATH**/ ?>