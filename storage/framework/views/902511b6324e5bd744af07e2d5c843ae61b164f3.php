 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Destination View</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/destinations')); ?>">Destinations</a></li>
                  <li class="breadcrumb-item active">Destination View</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <section class="content" id="page-refresh-container">
      <div class="container-fluid" id="page-refresh-box">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title float-left">Destination View</h3>
                  </div>
                  <div class="card-body ribbon-box pb-1">
                     <div class="row">
                        <div class="col-md-2">
                           <label class="control-label">Image</label>
                           <div style="border: 1px solid #DDD;padding: 3px;background-size: cover;"><img src="<?php echo e(url('public/uploads/destinations/'.$data->image)); ?>" width="100%"></div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Title</label>
                              <p><?php echo e($data->title); ?></p>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Country</label>
                              <p><?php echo e(($data->getcountry) ? $data->getcountry->name : 'N/A'); ?></p>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="control-label">Status</label>
                              <p><?php echo e(($data->status == 1) ? 'Active' : 'Inactive'); ?></p>
                           </div>
                        </div>
                        <?php if(count($programs) > 0): ?>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="control-label">Programs</label>
                              <p><?php echo e(implode(', ', $programs)); ?></p>
                           </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                           <div class="form-group">

                              <div id="accordion">
                                 <div class="card card-secondary">
                                    <div class="card-header">
                                       <h4 class="card-title w-100">
                                          <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                          Overview
                                          </a>
                                       </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                                       <div class="card-body">
                                         <?php echo $data->description; ?>

                                       </div>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                     </div>
                     <!---/row--->
                  </div>
               </div>
               <div class="card">
                  <div class="card-header">
                     <h4 class="card-title float-left">Highlights</h4>
                     <button class="addNewBtn btn btn-primary float-right"> <i class="fa fa-plus fa-sm"></i> Add New</button>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 150px;">Image</th>
                                    <th>Description</th>
                                    <th class="text-center" style="width: 150px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if($data->attachments && count($data->attachments) > 0): ?>

                                 <?php $__currentLoopData = $data->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td>
                                       <img src="<?php echo e(url($val->attachment)); ?>" style="border: 1px solid #DDD;padding: 3px;height: 100px;width: 100px;">
                                    </td>
                                    <td><?php echo $val->description; ?></td>
                                    <td>
                                       <div class="text-nowrap text-center table-action">
                                          <a title="Edit" class="editBtn action-icon text-muted" data-key="<?php echo e(base64_encode($val->id)); ?>" href="#" > <i class="fa fa-edit" aria-hidden="true"></i> </a>
                                          <a title="Delete" class="deleteBtn action-icon text-muted" data-key="<?php echo e(base64_encode($val->id)); ?>" href="#" > <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                       </div>
                                    </td>
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
            </div>
         </div>
      </div>
   </section>
</div>


<!-- /.modal -->
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
               <div class="col-lg-4">
                 <div class="form-group">
                    <label for="image">Image <span class="required text-danger">*</span></label><br/>
                    <input type="file" id="image" name="image">
                 </div>
              </div>
              <div class="col-lg-2">
                 <div class="imgDisplayBx"></div>
              </div>
           </div>
            <div class="row">
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
      <!-- /.modal-description -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade text-left" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel111" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <h5 class="modal-title white" id="myModalLabel111">Change Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
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
<?php $__env->startSection("styles"); ?>
<style type="text/css">
   .cke_toolbar_last{
      display: none !important;
   }
   .dataTables_scrollHeadInner{
      width: 100%;
   }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("scripts"); ?>
<script type="text/javascript">
    var type = "Destination";
    var ref_id = "<?php echo e(base64_encode($data->id)); ?>";
</script>
<script src="https://cdn.ckeditor.com/4.11.1/full-all/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo e(url('public/panel/custom/common/upload_highlights.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/admin/destination/view.blade.php ENDPATH**/ ?>