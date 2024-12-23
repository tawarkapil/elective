<div id="page-refresh-container">
  <div id="page-refresh-box">

<?php 
  $system_documents = ViewsHelper::getSystemDocuments($sectionId);
?>
<?php if(count($system_documents) > 0): ?>
<p>
  <h4>Important Documents and Resources in this section:</h4>
  <h5>For you:</h5>
  <?php $__currentLoopData = $system_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="mb-10"><?php echo e($row->document_name); ?> (<a style="font-weight:600;" target="_blank" href="<?php echo e(url($row->document_path)); ?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</p>
<?php endif; ?>


<?php 
  $student_documents = ViewsHelper::getStudentDocuments($sectionId);
?>
<?php if(count($student_documents) > 0): ?>
<p>
  <h4>Important Documents and Resources in this section:</h4>
  <h5>For us:</h5>
    <?php $__currentLoopData = $student_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="mb-10 normalFileUploadContainer"><?php echo e($row); ?>

        <div style="overflow:hidden;display: none;"> 
        <form>
            <input type="file" class="normalFileUploadInp" id="document_files<?php echo e($key); ?>" data-document="<?php echo e($key); ?>" data-section="<?php echo e($sectionId); ?>"  name="document_files"/> 
         </form>
        </div>
        (<a style="cursor: pointer;" class="action-icon normalFileUploadBtn" title="Upload file" data-document="<?php echo e($key); ?>">
           <i class="fa fa-cloud-upload" ></i> Upload
        </a>) 
        <div class="documents-progressbar-container"></div>

        <?php  
        $fileArr = ViewsHelper::displayStudentDocumentFile($sectionId, $key); 
        ?>

        <?php if(count($fileArr) > 0): ?>
        <a style="color: green;font-weight: 600; font-style: italic;" target="_blank" href="<?php echo e($fileArr['path']); ?>"><?php echo e($fileArr['filename']); ?></a>
        <?php endif; ?>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</p>
<?php endif; ?>
</div>
</div><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/common/_documents_section.blade.php ENDPATH**/ ?>