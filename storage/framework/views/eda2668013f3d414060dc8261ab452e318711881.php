<div class="row">
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <article class="post clearfix maxwidth600 mb-30">
              <div class="entry-header">
                <div class="post-thumb thumb"> <img src="<?php echo e(ViewsHelper::getTripCoverImage($row)); ?>" alt="" class="img-responsive img-fullwidth"> </div>
                </div>
              <div class="entry-content border-1px p-20">
                <h5 class="entry-title mt-0 pt-0"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->short_title(40)); ?></a></h5>
                <p class="text-left mb-20 mt-15 font-13"><?php echo e($row->short_desc(150)); ?></p>
                <a class="btn btn-dark btn-theme-colored btn-flat pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>
               <ul class="list-inline entry-date pull-right font-12 mt-5">
                   <li><a class="text-theme-colored-blue" href="#"><?php echo e($row->getcustomer->full_name()); ?> |</a></li>
                   <li><span class="text-theme-colored-blue"><?php echo e(ViewsHelper::displayDate($row->created_at)); ?></span></li>
               </ul>
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
</div><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/pages/_ajax_trip.blade.php ENDPATH**/ ?>