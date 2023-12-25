<footer class="main-footer">
    <strong>Copyright &copy; 2023 <?= $nama_website ?> Version 2.1.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developer</b> 
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../template_beck_end/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../template_beck_end/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../template_beck_end/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../template_beck_end/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../template_beck_end/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../template_beck_end/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../template_beck_end/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../template_beck_end/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../template_beck_end/plugins/moment/moment.min.js"></script>
<script src="../../template_beck_end/plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../template_beck_end/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../template_beck_end/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../template_beck_end/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../template_beck_end/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../template_beck_end/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../template_beck_end/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../template_beck_end/plugins/jszip/jszip.min.js"></script>
<script src="../../template_beck_end/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../template_beck_end/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../template_beck_end/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../template_beck_end/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../template_beck_end/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../template_beck_end/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../template_beck_end/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../template_beck_end/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../template_beck_end/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../template_beck_end/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../template_beck_end/dist/js/pages/dashboard.js"></script>
<!-- SweetAlert2 -->
<script src="../../template_beck_end/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../template_beck_end/plugins/toastr/toastr.min.js"></script>
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: false,
      position: 'center',
      showConfirmButton: false,
      timer: 5000
    });

    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "successLogin"){ ?>
                $('.swalDefaultSuccess').ready(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Login berhasil, selamat datang <?= $get_nama_lengkap_session_header ?>',
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "successTambah"){ ?>
                $('.swalDefaultSuccess').ready(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil di tambah.',
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "gagalTerjadiKesalahan"){ ?>
                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Login gagal, terjadi kesalahan dengan sistem kami.',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "successUpdate"){ ?>
                $('.swalDefaultSuccess').ready(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil di perbaharui.',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "gagalPerbaharui"){ ?>
                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Data gagal diperbaharui.',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "gagalStokKurang"){ ?>
                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Data gagal ditambah, stok kurang. Silahkan kurangi jumlah qty',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "successHapus"){ ?>
                $('.swalDefaultSuccess').ready(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil di hapus.',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "gagalHapus"){ ?>
                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Data gagal dihapus.',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "duplikat"){ ?>
                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Data gagal ditambahkan, karena data sudah ada/duplikat.',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    <?php 
      if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
              if($pesan == "gagal"){ ?>
                $('.swalDefaultError').ready(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Data gagal ditambahkan, terjadi kesalahan.',
                    timerProgressBar: true
                })
                });
        <?php        
            }
        }
    ?>
    
  });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
