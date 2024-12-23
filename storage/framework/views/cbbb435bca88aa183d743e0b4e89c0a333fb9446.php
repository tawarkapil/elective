 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0"><?php echo e($countrydata->name); ?>'s Document</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/dashboard')); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a class="text-muted" href="<?php echo e(url('admin/system-documents')); ?>">Documents</a></li>
                  <li class="breadcrumb-item active"><?php echo e($countrydata->name); ?>'s Document</li>
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
                     <h4 class="card-title float-left">Documents</h4>
                     <button class="addNewBtn btn btn-primary float-right"> <i class="fa fa-plus fa-sm"></i> Add New</button>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Document type</th>
                                    <th>Document Name</th>
                                    <th class="text-center" style="width: 150px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php $i = 1; ?>
                                 <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td>
                                       <?php echo e(Config::get('params.system_documents')[$val->document_type]); ?>

                                    </td>
                                    <td>
                                       <a target="_blank" href="<?php echo e(url($val->document_path)); ?>"> <?php echo e($val->document_name); ?> </a>
                                    </td>
                                    <td>
                                       <div class="text-nowrap text-center table-action">
                                          <a title="Edit" class="editBtn action-icon text-muted" data-key="<?php echo e($val->id); ?>" data-name="<?php echo e(Config::get('params.system_documents')[$val->document_type]); ?>" href="#" > <i class="fa fa-edit" aria-hidden="true"></i> </a>

                                          <a title="Delete" class="deleteBtn action-icon text-muted" data-key="<?php echo e($val->id); ?>" data-name="<?php echo e(Config::get('params.system_documents')[$val->document_type]); ?>" href="#" > <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                       </div>
                                    </td>
                                 </tr>
                                 <?php $i += 1; ?>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
               <div class="col-lg-12">
                 <div class="form-group">
                    <label for="upload_file">Upload File <span class="required text-danger">*</span></label><br/>
                    <input type="file" id="upload_file" name="upload_file">

                    <div class="imgDisplayBx"></div>
                 </div>
              </div>
           </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="document_name">Document Name <span class="required text-danger">*</span></label>
                     <input type="text" class="form-control"  id="document_name" name="document_name">
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="document_type">Document Type <span class="required text-danger">*</span></label>
                     <?php echo Form::select('document_type', ['' => 'Please Select'] + Config::get('params.system_documents'), null, ['id' => 'document_type', 'class' => 'form-control']); ?>

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
      <!-- /.modal-description -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection("styles"); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("scripts"); ?>
<script type="text/javascript">
    var country_id = "<?php echo e($countrydata->country_id); ?>";
</script>
<script src="https://cdn.ckeditor.com/4.11.1/full-all/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo e(url('public/panel/custom/system-documents/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/admin/system-documents/view.blade.php ENDPATH**/ ?>