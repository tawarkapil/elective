 <!-- Footer -->
<footer id="footer" class="footer pb-0" data-bg-img="<?php echo e(url('public/frontend/assets/images/footer-bg.png')); ?>" data-bg-color="#25272e">
 <div class="container pb-20">
    <div class="row multi-row-clearfix">
      <div class="col-sm-6 col-md-6">
          <div class="widget dark">  <a href="<?php echo e(url('/')); ?>" class="logo_title">Electives <span class="text-theme-colored">Global</span></a><!--  <img alt="" src="images/logo-wide-white.png"> -->
            <p class="font-12 mt-10 mb-10">CharityFund is a library of corporate and business templates with predefined web elements which helps you to build your own site. CharityFund is a library of corporate and business templates with predefined web elements which helps you to build your own site. CharityFund is a library of corporate and business templates with predefined web elements which helps you to build your own site. </p>
            <ul class="styled-icons icon-dark mt-20">
                <li><a href="#" data-bg-color="#3B5998"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" data-bg-color="#02B0E8"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" data-bg-color="#05A7E3"><i class="fa fa-skype"></i></a></li>
                <li><a href="#" data-bg-color="#A11312"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#" data-bg-color="#C22E2A"><i class="fa fa-youtube"></i></a></li>
             </ul>
          </div>
        </div>
     <!--  <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">Twitter Feed</h5>
            <div class="twitter-feed list-border clearfix" data-username="Envato" data-count="2"><span>Loading!</span></div>
          </div>
        </div> -->
       <div class="col-sm-6 col-md-3">
          <div class="widget dark">
             <h5 class="widget-title line-bottom">Quick Links</h5>
             <ul class="list-border list theme-colored angle-double-right">
                <li><a href="<?php echo e(url('about-us')); ?>">About Us</a></li>
                <li><a href="<?php echo e(url('contact-us')); ?>">Contact Us</a></li>
                <li><a href="<?php echo e(url('privacy-policy')); ?>">Privacy Policy</a></li>
                <li><a href="<?php echo e(url('terms-conditions')); ?>">Terms of Use</a></li>
             </ul>
          </div>
       </div>
       <div class="col-sm-6 col-md-3">
         <div class="widget dark">
             <h5 class="widget-title line-bottom">Quick Contact</h5>
             <ul class="list-border list theme-colored angle-double-right">
                <li><a href="#">+(012) 345 6789</a></li>
                <li><a href="#">hello@yourdomain.com</a></li>
                <li><a href="#" class="lineheight-20">121 King Street, Melbourne Victoria 3000, Australia</a></li>
             </ul>
             
          </div>
       </div>
    </div>
 </div>
 <div class="container-fluid bg-theme-colored p-20">
    <div class="row text-center">
       <div class="col-md-12">
          <p class="text-white font-11 m-0">Copyright &copy; <?php echo e(date('Y')); ?> Elective Global. All Rights Reserved</p>
       </div>
    </div>
 </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

 <div class="modal fade text-left" id="delConfirmationMdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" style="color:#FFF;">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    Are you sure you want delete this records ?
                </div>
            </div>
            <div class="modal-footer text-right">
                <button data-dismiss="modal" class="btn btn-danger">CANCEL</button>
                <button class="btn btn-success delConfirmationBtn">CONFIRM</button>
            </div>
        </div>
    </div>
</div><?php /**PATH /home1/digital5/public_html/elective/resources/views/frontend/layouts/footer.blade.php ENDPATH**/ ?>