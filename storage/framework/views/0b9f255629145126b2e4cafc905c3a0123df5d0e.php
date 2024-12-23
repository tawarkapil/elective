<div class="row list-dashed">
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div class="col-md-6"> 
      <article class="post clearfix maxwidth600 border-1px  mb-30">
         <div class="entry-header">
            <div class="post-thumb thumb">
               <?php if($row->upload_file == 'Video'): ?>
               <?php echo $row->youtube_url; ?>

               <?php elseif($row->upload_file == 'Image'): ?>
               <?php if(count($row->attachments) == 1): ?>
               <img alt="" src="<?php echo e(url($row->attachments[0]->attachment)); ?>" class="img-fullwidth img-responsive">
               <?php else: ?>
               <div class="widget-image-carousel">
                  <?php $__currentLoopData = $row->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="item">
                     <img src="<?php echo e(url($attach->attachment)); ?>" alt="">
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
               <?php endif; ?>
               <?php endif; ?> 
            </div> 
         </div>
         <div class="entry-content p-20">
		    <h5 class="entry-title"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->title); ?></a></h5>
            <ul class="list-inline font-12 mb-20 mt-10">
               <li><a class="text-theme-colored-blue" href="<?php echo e(($row->getcustomer) ?  $row->getcustomer->getDetailsPageUrl() : '#'); ?>"><?php echo e($row->author_name); ?> |</a></li>
               <li><span class="text-theme-colored-blue"><?php echo e(ViewsHelper::displayDate($row->created_at)); ?></span></li>
            </ul>
            <p class="mb-30 line-clamp"><?php echo e($row->short_desc(500)); ?> <!--<a href="<?php echo e($row->getDetailsPageUrl()); ?>">[...]</a>--></p>
			<div class="mb-30">
            <ul class="list-inline like-comment pull-left font-12 text-yellow" style="font-weight:bold;">
               <li><i class="pe-7s-comment"></i><?php echo e($row->comments->count()); ?></li>
               <!-- <li><i class="pe-7s-like2"></i>125</li> -->
            </ul>
            <a class="pull-right btn btn-dark btn-theme-colored btn-flat" href="<?php echo e($row->getDetailsPageUrl()); ?>"><i class="fa fa-angle-double-right text-theme-colored"></i> Read more</a>
			</div>
			<div class="clearfix"></div>
         </div>
      </article> 
   </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row pagination_container">
   <div class="col-md-12">
      <nav>
         <?php echo $data->render(); ?>

      </nav>
   </div>
</div><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/pages/_ajax_simple_blog.blade.php ENDPATH**/ ?>