  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- Alerts -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- page script -->
<script>
  $(function() {
    <?php if ($indukmenu) : ?>
        var menu = document.getElementById('<?= $indukmenu ?>');
        menu.removeAttribute('class', true);
        menu.setAttribute('class', 'nav-link active');
    <?php endif; ?>
    <?php if ($submenu) : ?>
        var menu = document.getElementById('<?= $submenu ?>');
        menu.removeAttribute('class', true);
        menu.setAttribute('class', 'nav-link active');
        <?php if ($indukmenu) : ?>
            var tree = document.getElementById('<?= $indukmenu ?>tree');
            tree.removeAttribute('class', true);
            tree.setAttribute('class', 'nav-item menu-open');
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($this->session->userdata('successmsg')) : ?>
        toastr.success('<?= $this->session->userdata('successmsg') ?>');
        <?php
        $this->session->unset_userdata('successmsg');
        ?>
    <?php endif; ?>
    <?php if ($this->session->userdata('errormsg')) : ?>
        toastr.error('<?= $this->session->userdata('errormsg') ?>');
        <?php
        $this->session->unset_userdata('errormsg');
        ?>
    <?php endif; ?>
    <?php if ($this->session->userdata('infomsg')) : ?>
        toastr.info('<?= $this->session->userdata('infomsg') ?>');
        <?php
        $this->session->unset_userdata('infomsg');
        ?>
    <?php endif; ?>
  });
  function menuOpen(kodemenu) {
        var icon = document.getElementById(kodemenu + 'icon');
        if (icon.className == 'nav-icon fas fa-folder') {
            icon.removeAttribute('class', true);
            icon.setAttribute('class', 'nav-icon fas fa-folder-open');
        } else if (icon.className == 'nav-icon fas fa-folder-open') {
            icon.removeAttribute('class', true);
            icon.setAttribute('class', 'nav-icon fas fa-folder');
        }
    }
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


    $("#table1").DataTable({
      "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
              "<'row'<'col-sm-12 fixed-sticky'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
  });
</script>

</body>
</html>
