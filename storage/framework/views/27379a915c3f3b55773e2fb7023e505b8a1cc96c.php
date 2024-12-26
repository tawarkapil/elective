<?php $__env->startSection('title'); ?>
    <title>Addon & Events - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-dark"
            data-bg-img="<?php echo e(url('public/frontend/assets/images/blog-banner.jpg')); ?>">
            <div class="container pt-30 pb-30">
                <!-- Section Content -->
                <div class="section-content text-center">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h2 class="font-36 page_title">Expolore Addon & Events</h2>
                            <ol class="breadcrumb text-center mt-10 white">
                                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                <li class="active">Addon & Events</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="filter pt-30 pb-10 mb-30">
                    <form action="<?php echo e(url('events')); ?>">
                        <div class="row d-flex align-items-center justify-Content-center flex-wrap">
                            <div class="col-sm-1 col-xs-12">
                                <div class="form-group text-right mobile_text_center">
                                    <label><strong>Filter</strong></label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group mobile_mb_15">
                                    <?php echo Form::select('srch_program', ['' => 'All Programs'] + $programs, $srch_program, [
                                        'id' => 'srch_program',
                                        'class' => 'form-control',
                                    ]); ?>

                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-12">
                                <div class="d-flex align-items-center justify-Content-between mobile_mb_15">
                                    <div class="form-group price_filter">
                                        <?php echo Form::select('srch_price', ['' => 'All Price'] + Config::get('params.price_filter'), $srch_price, [
                                            'id' => 'srch_price',
                                            'class' => 'form-control',
                                        ]); ?>

                                    </div>
                                    <div class="form-group"> <button type="submit"
                                            class="btn btn-colored btn-theme-colored btn-flat pull-right login_btn"><i
                                                class="fa fa-filter" aria-hidden="true"></i> Apply</button> </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="blog-posts">
                            <?php if(count($events) > 0): ?>
                                <div class="row ">
                                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-12">
                                            <div class="d-flex flex-wrap mb-30 tours_blog">
                                                <div class="entry-header">
                                                    <div class="post-thumb thumb"> <img
                                                            src="<?php echo e(url('public/uploads/addons/' . $row->image)); ?>"
                                                            alt="" class="img-responsive img-fullwidth"> </div>
                                                </div>
                                                <div class="entry-content border-1px p-20">
                                                    <h3 class="entry-title mt-0 pt-0"><a
                                                            href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->title); ?> -
                                                            <?php echo e($row->getprogram->title); ?></a></h3>
                                                    <h5 class="text-theme-colored mb-20">
                                                        <?php echo e(ViewsHelper::displayAmount($row->payment_amount)); ?></h5>
                                                    <p class="text-left mb-20 font-13"><?php echo e($row->short_desc(190)); ?></p>
                                                    <a class="btn btn-dark btn-theme-colored btn-flat pull-left mt-0 quick-link-btn-hover"
                                                        href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-12">
                                        <?php echo $events->appends(request()->input())->links(); ?>

                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h2 class="mt-0">Oops! Not data Found</h2>
                                        <p>The page you were looking for could not be found.</p>
                                        <a class="btn btn-border btn-gray btn-transparent btn-circled"
                                            href="<?php echo e(url('/')); ?>">Return Home</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php echo $__env->make('frontend.pages._quick_contact_frm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/elective/resources/views/frontend/pages/events.blade.php ENDPATH**/ ?>