 <!-- Main Footer -->
 <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= ASSESTS_URL?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= ASSESTS_URL?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- sweet alert 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.19/sweetalert2.all.min.js" integrity="sha512-GmIrnMvDZVTtxE+7SdmKjUr3sSvwPMtitw6osbORBDp9sKneGyB3ZjcGjNfrUQ1SlpJXET+z5Cfb0QAj678izA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- bs-custom-file-input -->
<script src="<?= ASSESTS_URL?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


<!-- Summernote -->
<script src="<?= ASSESTS_URL?>plugins/summernote/summernote-bs4.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= ASSESTS_URL?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/jszip/jszip.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= ASSESTS_URL?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- AdminLTE -->
<script src="<?= ASSESTS_URL?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= ASSESTS_URL?>admin/js/general.js"></script>
</body>
</html>


<?php
    $success_msg=$this->session->flashdata('success');
    $error_msg=$this->session->flashdata('error');
    if(!empty($success_msg))
    {
        ?>
<script>
$(function() {
    alert_msg('success', "<?=$success_msg?>");
});
</script>
<?php
    } 
    if(!empty($error_msg))
    {
        ?>
<script>
$(function() {
    alert_msg('error', "<?=$error_msg?>");
});
</script>

<?php
    }
?>
