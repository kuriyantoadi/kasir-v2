<?php include "../../koneksi.php";
session_start();
if(!isset($_SESSION['kasir'])){
    ?>
    <script >
        alert("Silahkan login terlebih dahulu");
        document.location="../login/index.php";
    </script>
    <?php
}
?>
<?php
    $id_dari_session_header             = $_SESSION['id_user'];
    // query get id_dari_session
    $query_get_id_session_header        = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user=$id_dari_session_header");
    $sql_session_header                 = mysqli_fetch_array($query_get_id_session_header);
    $get_id_session_header              = $sql_session_header['id_user'];
    $get_username_header                = $sql_session_header['username'];
    $get_nama_lengkap_session_header    = $sql_session_header['nama'];
    $get_email_header                   = $sql_session_header['email'];
    $get_level_header                   = $sql_session_header['level'];

    $sql = mysqli_query($koneksi, "UPDATE produk SET status_produk='2' WHERE stok='0'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $nama_website ?></title>
  <!-- Favicon-->
  <link rel="icon" href="../../template_beck_end/images/<?= $logo_website ?>" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../template_beck_end/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/summernote/summernote-bs4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../template_beck_end/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../template_beck_end/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../template_beck_end/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- DataTables Serverside -->
  <script src="../../template_beck_end/jquery/jquery-3.5.1.js"></script>
  <script src="../../template_beck_end/jquery/jquery.dataTables.min.js"></script>
  <script src="../../template_beck_end/jquery/dataTables.bootstrap4.min.js"></script>
  <!-- ChartJs -->
  <script type="text/javascript" src="../../template_beck_end/chartjs/Chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type='text/javascript'>
    $(window).load(function(){
    $("#dari_mana_mengetahui").change(function() {
    			console.log($("#dari_mana_mengetahui option:selected").val());
    			if ($("#dari_mana_mengetahui option:selected").val() == 'Lainnya') {
    				$('#result_lainya').prop('hidden', false);
    			} else {
    				$('#result_lainya').prop('hidden', 'true');
    			}
    		});
    });
  </script>
  <!-- fungsi input hanya angka saja -->
  <script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
  
      return false;
      return true;
    }
  </script>
  <!-- selesai fungsi input angka saja -->
  <!-- ini fungsi untuk cek nama kategori -->
  <script>
  $(document).ready(function(){
    $("#nama_kategori").blur(function(){
      // tampilkan animasi loading saat pengecekan ke database
      $('#pesan_nama_kategori').html(' <img src="../../template_beck_end/images/loading.gif" width="20" height="20"> checking ...');
      var nama_kategori = $(this).val();
      $.ajax({
      type:'POST',
      url:'../../ajax/cek_nama_kategori.php',
      data: 'nama_kategori=' + nama_kategori,
      success: function(data){
        if(data==0){
            $("#pesan_nama_kategori").html('<img src="../../template_beck_end/images/tick.png"> Nama kategori bisa ditambahkan!');
            $('#nama_kategori').css('border', '1px #090 solid');
        }
        else{
            $("#pesan_nama_kategori").html('<img src="../../template_beck_end/images/cross.png"> Nama kategori sudah ada!');
            $('#nama_kategori').css('border', '1px #C33 solid');
            $("#nama_kategori").val('');
        }
      }
      });
    })
  });
  </script> 
  <!-- END CEK nama kategori -->
  <!-- ini fungsi untuk cek nama produk -->
  <script>
  $(document).ready(function(){
    $("#nama_produk").blur(function(){
      // tampilkan animasi loading saat pengecekan ke database
      $('#pesan_nama_produk').html(' <img src="../../template_beck_end/images/loading.gif" width="20" height="20"> checking ...');
      var nama_produk = $(this).val();
      $.ajax({
      type:'POST',
      url:'../../ajax/cek_nama_produk.php',
      data: 'nama_produk=' + nama_produk,
      success: function(data){
        if(data==0){
            $("#pesan_nama_produk").html('<img src="../../template_beck_end/images/tick.png"> Nama produk bisa ditambahkan!');
            $('#nama_produk').css('border', '1px #090 solid');
        }
        else{
            $("#pesan_nama_produk").html('<img src="../../template_beck_end/images/cross.png"> Nama produk sudah ada!');
            $('#nama_produk').css('border', '1px #C33 solid');
            $("#nama_produk").val('');
        }
      }
      });
    })
  });
  </script> 
  <!-- END CEK nama kategori -->
  <!-- ini fungsi untuk cek username -->
  <script>
  $(document).ready(function(){
    $("#username").blur(function(){
      // tampilkan animasi loading saat pengecekan ke database
      $('#pesan_username').html(' <img src="../../template_beck_end/images/loading.gif" width="20" height="20"> checking ...');
      var username = $(this).val();
      $.ajax({
      type:'POST',
      url:'../../ajax/cek_username.php',
      data: 'username=' + username,
      success: function(data){
        if(data==0){
            $("#pesan_username").html('<img src="../../template_beck_end/images/tick.png"> Username bisa digunakan!');
            $('#username').css('border', '1px #090 solid');
        }
        else{
            $("#pesan_username").html('<img src="../../template_beck_end/images/cross.png"> Username sudah ada!');
            $('#username').css('border', '1px #C33 solid');
            $("#username").val('');
        }
      }
      });
    })
  });
  </script> 
  <!-- END CEK nama kategori -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../template_beck_end/images/<?= $logo_website ?>" alt="<?= $nama_website ?>" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light"><?= $get_nama_lengkap_session_header?> / Kasir</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


     <!-- Sidebar Menu -->
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Master Produk
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="index.php?hal=kategori" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Produk</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="index.php?hal=produk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="index.php?hal=transaksi_barang_masuk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi Barang Masuk</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-header">Transaksi</li>
          <li class="nav-item">
            <a href="index.php?hal=menu_keranjang" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Master Keranjang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?hal=transaksi" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Data Transaksi
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="index.php?hal=uang_keluar" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Uang Keluar
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Master Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=laporan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Transaksi</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="index.php?hal=laporan_barang_masuk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang Masuk</p>
                </a>
              </li> -->
              <!--<li class="nav-item">
                <a href="index.php?hal=laporan_so_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan So Produk</p>
                </a>
              </li>-->
              <!-- <li class="nav-item">
                <a href="index.php?hal=laporan_uang_keluar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Uang Keluar</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!--<li class="nav-header">Pengguna</li>
          <li class="nav-item">
            <a href="index.php?hal=pengguna" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Master Pengguna</p>
            </a>
          </li>-->
          <li class="nav-header">Profil</li>
          <li class="nav-item">
            <a href="index.php?hal=profil" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Profil Saya</p>
            </a>
          </li>
          <!--<li class="nav-header">Pengaturan Toko</li>
          <li class="nav-item">
            <a href="index.php?hal=pengaturan" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Konfigurasi Toko</p>
            </a>
          </li>-->
          <li class="nav-item">
            <a href="keluar.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>