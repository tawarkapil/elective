<?php $__env->startSection('title'); ?>
<title>Documents - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
              <h2 class="text-white mt-10">Documents</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">Documents</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 
    
 <?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="divider">
    <div class="container">
      <div class="row">
       
        <div class="col-md-12">
          <div class="border-1px p-30 mb-0 bg-white pt-10">
            <div class="section-container">
                <h4>Upload documents</h4>
                <div>
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Document Type</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php $__currentLoopData = Config::get('params.student_documents'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainkey => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($i); ?></td>
                              <td><?php echo e(Config::get('params.system_documents')[$mainkey]); ?></td>
                              <td><?php echo e($val); ?></td>
                              <td>
                                <?php if(isset($student_document[$mainkey][$key])): ?>
                                <span class="text-success">Uploaded</span> 
                                <?php else: ?>
                                <span class="text-danger">Not Uploaded</span>
                                <?php endif; ?>
                              </td>
                              <td class="text-center">
                                <a title="Upload" href="#" class="text-muted uploadDocumentsBtn mr-5">
                                  <i class="fa fa-cloud"></i>
                                </a>
                                <?php if(isset($student_document[$mainkey][$key])): ?>
                                <a target="_blank" title="Download" class="text-muted" href="<?php echo e($student_document[$mainkey][$key]->document_path); ?>"><i class="fa fa-download"></i></a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php $i += 1; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                      </tbody>
                    </table>
                </div>
            </div>
          </div>
          </div>

          <div class="col-md-12">
            <br>
          </div>


          <div class="col-md-12">
          <div class="border-1px p-30 mb-0 bg-white pt-10">
            <div class="section-container">
                <h4>Guide documents</h4>
                <div>
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Document Type</th>
                          <th>Name</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($system_documents) > 0): ?>
                          <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td><?php echo e(Config::get('params.system_documents')[$val->document_type]); ?></td>
                            <td><?php echo e($val->document_name); ?></td>
                            <td class="text-center">
                              <a target="_blank" class="text-muted" href="<?php echo e(url($val->document_path)); ?>"><i class="fa fa-download"></i></a>
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
  </section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/dashboard/guide-documents.blade.php ENDPATH**/ ?>