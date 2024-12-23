<div class="card card-warning card-outline">
   <div class="tab-content">
    <div class="card-header">
      <h5 class="text-uppercase">Summary</h5>
    </div>
     <div class="card-body box-profile">
      <div>
        <div class="float-left">
          <h6 class="mb-0 text-uppercase">Registration Fee :</h6>
          <small>Due on application</small>
        </div>  
        <div class="float-right"><h5><?php echo e(ViewsHelper::displayAmount($summaryConf['regiterationFees'])); ?></h5></div>
        <div class="clearfix"></div>
        <div class="dropdown-divider"></div>
      </div>
      <div>
         <div class="float-left">
            <h6 class="mb-0 mt-3 text-uppercase">Trip Details:</h6>
         </div>  
         <div class="clearfix"></div>
         <?php if($summaryConf['programName']): ?>
         <ul class="list-group mt-1 mb-0">
           <li class="list-group-item">
              <span><?php echo e($summaryConf['programName']); ?></span>
           </li>
           <li class="list-group-item">
              <span><?php echo e($summaryConf['destinationName']); ?></span>
           </li>
           <li class="list-group-item">
              <span>Arrival date:  </span> <span class="float-right"><?php echo e(ViewsHelper::displayDate($summaryConf['ArrivalDate'])); ?></span>
           </li>
           <li class="list-group-item">
              <span>Hospital placement:    </span> <span class="float-right"> <?php echo e($summaryConf['duration']); ?> weeks</span>
           </li>
           <li class="list-group-item">
              <b class="text-uppercase">Placement Fee:</b> <b class="float-right"> <?php echo e(ViewsHelper::displayAmount($summaryConf['trip_total'])); ?></b>
           </li>
        </ul>
        <?php endif; ?>
      </div>
        
      </div>
      <div class="card-footer">
        <h5 class="float-left text-uppercase">Total </h5>
        <h5 class="float-right"><?php echo e(ViewsHelper::displayAmount($summaryConf['grand_total'])); ?> </h5>
      </div>
   </div>
</div>
<?php if($stepName == 'summary'): ?>
<div class="form-group">
   <button type="button" class="btn btn-block bg-gradient-success btn-lg">Pay Now</button>
   <img src="<?php echo e(url('public/common/card-img.png')); ?>" style="width: 100%;margin-top: 25px;">
</div>
<?php endif; ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/profile/_summary.blade.php ENDPATH**/ ?>