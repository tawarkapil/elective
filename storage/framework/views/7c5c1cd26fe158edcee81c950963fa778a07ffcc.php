<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo e(date('Y')); ?> <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

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
</div><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/layouts/footer.blade.php ENDPATH**/ ?>