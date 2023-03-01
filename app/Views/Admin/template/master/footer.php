</div>
  <!-- End of Main Content -->
     <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><?= $footerTitle; ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('admin/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <?=script_tag('public/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>  
    
    <!-- Core plugin JavaScript-->
    <?=script_tag('public/assets/admin/vendor/jquery-easing/jquery.easing.min.js')?>  
    
    <!-- Custom scripts for all pages-->
    <?=script_tag('public/assets/admin/js/sb-admin-2.min.js')?>  
      
   
    <!-- Page level plugins -->
    <?=script_tag('public/assets/admin/vendor/datatables/jquery.dataTables.min.js')?>  
    <?=script_tag('public/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')?>  
    
    <!-- Page level custom scripts -->
    <?=script_tag('public/assets/admin/js/demo/datatables-demo.js')?>  
    
    <!--Full Calendar-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <?=link_tag('public/assets/frontend/css/jquery.datetimepicker.css')?>   

<?= script_tag('public/assets/frontend/js/jquery.datetimepicker.full.min.js') ?>

<?= script_tag('public/assets/admin/js/myscript.js') ?>


</body>

</html>