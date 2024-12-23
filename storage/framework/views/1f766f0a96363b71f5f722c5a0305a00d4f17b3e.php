
<?php
$step1cls = "active";
$step2cls = "";
$step3cls = "";
$step4cls = "";
$step5cls = "";
$step6cls = "";
$step7cls = "";
$step8cls = "";
$step9cls = "";
$step10cls = "";
$step11cls = "";
$step12cls = "";
$step13cls = "";

if(Request::is('profile')){
    $step2cls = "active";
}
if(Request::is('application') || Request::is('application-documents')){
    $step2cls = $step3cls = "active";
}
if(Request::is('my-elective')){
    $step2cls = $step3cls = $step4cls = "active";
}
if(Request::is('guide-add-ons-events')){
    $step2cls = $step3cls = $step4cls = $step5cls = "active";
}
if(Request::is('guide-tours')){
    $step2cls = $step3cls = $step4cls = $step5cls = $step6cls = "active";
}
if(Request::is('guide-group')){
    $step2cls = $step3cls = $step4cls = $step5cls = $step6cls = $step7cls = "active";
}
if(Request::is('guide-blogs')){
    $step2cls = $step3cls = $step4cls = $step5cls = $step6cls = $step7cls = $step8cls = "active";
}
if(Request::is('fund-my-elective')){
    $step2cls = $step3cls = $step4cls = $step5cls = $step6cls = $step7cls= $step8cls = $step9cls = "active";
}
if(Request::is('pre-depature')){
    $step2cls = $step3cls = $step4cls = $step5cls = $step6cls = $step7cls= $step8cls = $step9cls = $step10cls = "active";
}
if(Request::is('in-country')){
    $step2cls = $step3cls = $step4cls = $step5cls = $step6cls = $step7cls= $step8cls = $step9cls = $step10cls = $step11cls  = "active";
}
if(Request::is('after-my-elective')){
    $step2cls = $step3cls = $step4cls = $step5cls = $step6cls = $step7cls= $step8cls = $step9cls = $step10cls = $step11cls = $step12cls = "active";
}

?>

<!-- 
<div class="row justify-content-center">
    <div class="col-lg-12 mb-30 mt-10">
        <ul id="stepprogressbar">
            <li class="<?php echo e($step1cls); ?>" id="step1" data-toggle="tooltip" data-placement="top" title="Home"><strong>Step 1</strong></li>
            <li class="<?php echo e($step2cls); ?>" id="step2" data-toggle="tooltip" data-placement="top" title="Profile"><strong>Step 2</strong></li>
            <li class="<?php echo e($step3cls); ?>" id="step3" data-toggle="tooltip" data-placement="top" title="Application"><strong>Step 3</strong></li>
            <li class="<?php echo e($step4cls); ?>" id="step4" data-toggle="tooltip" data-placement="top" title="My Elective"><strong>Step 4</strong></li>
            <li class="<?php echo e($step5cls); ?>" id="step5" data-toggle="tooltip" data-placement="top" title="My Add-Ons/Event"><strong>Step 5</strong></li>
            <li class="<?php echo e($step6cls); ?>" id="step6" data-toggle="tooltip" data-placement="top" title="My Tours/ Activities"><strong>Step 6</strong></li>
            <li class="<?php echo e($step7cls); ?>" id="step7" data-toggle="tooltip" data-placement="top" title="My Groups"><strong>Step 7</strong></li>
            <li class="<?php echo e($step8cls); ?>" id="step8" data-toggle="tooltip" data-placement="top" title="My Blogs"><strong>Step 8</strong></li>
            <li class="<?php echo e($step9cls); ?>" id="step9" data-toggle="tooltip" data-placement="top" title="Fund My Elective"><strong>Step 9</strong></li>
            <li class="<?php echo e($step10cls); ?>" id="step10" data-toggle="tooltip" data-placement="top" title="Predeparture"><strong>Step 10</strong></li>
            <li class="<?php echo e($step11cls); ?>" id="step11" data-toggle="tooltip" data-placement="top" title="In-country"><strong>Step 11</strong></li>
            <li class="<?php echo e($step12cls); ?>" id="step12" data-toggle="tooltip" data-placement="top" title="After My Elective"><strong>Step 12</strong></li>
        </ul>
    </div>
</div> 
--><?php /**PATH /home1/digital5/public_html/elective/resources/views/frontend/layouts/stepprogressbar.blade.php ENDPATH**/ ?>