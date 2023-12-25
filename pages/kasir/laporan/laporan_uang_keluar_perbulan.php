<?php
  include('../../../koneksi.php');
  session_start(); //Mendapatkan Session
  if(!isset($_SESSION['kasir'])){
    ?>
    <script >
        alert("Anda harus login terlebih dahulu");
        document.location="../login/index.php";
    </script>
    <?php
  }

  date_default_timezone_set('Asia/Jakarta');
  function tglIndonesia($str){
        $tr   = trim($str);
        $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
        return $str;
    }

  $thn              = addslashes(trim($_GET['tahun']));
  $bln              = addslashes(trim($_GET['bulan']));

  $bulan = $bln;
  if ($bulan == 1) {
    $new_bulan = 'Januari';
  } else if ($bulan == 2){
    $new_bulan = 'Febuari';
  } else if ($bulan == 3){
    $new_bulan = 'Maret';
  } else if ($bulan == 4){
    $new_bulan = 'April';
  } else if ($bulan == 5){
    $new_bulan = 'Mei';
  } else if ($bulan == 6){
    $new_bulan = 'Juni';
  } else if ($bulan == 7){
    $new_bulan = 'Juli';
  } else if ($bulan == 8){
    $new_bulan = 'Agustus';
  } else if ($bulan == 9){
    $new_bulan = 'September';
  } else if ($bulan == 10){
    $new_bulan = 'Oktober';
  } else if ($bulan == 11){
    $new_bulan = 'November';
  } else if ($bulan == 12){
    $new_bulan = 'Desember';
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Uang Keluar Per <?= $new_bulan.' '.$thn ?></title>
    <link href="../../../template_beck_end/images/<?= $logo_website ?>" rel="icon">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="../../../template_beck_end/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body onload="print()">
  <center>
    <table>
      <tr>
        <td>
          <center>
            <img src="../../../template_beck_end/images/<?= $logo_website ?>" style="width: 150px; height: 150px;">
            <h3><?= $nama_website ?></h3>
            <h5>Alamat    : <?= $alamat_website ?></h5>
            <h5>Telepon   : <?= $no_telepon_website ?></h5>
          </center>
        </td>
      </tr>
    </table>
    <h5>Laporan Total Uang Keluar Per <?= $new_bulan.' '.$thn ?></h5>
    <?php
        $query = mysqli_query($koneksi,"SELECT * FROM t_uang_keluar WHERE YEAR(tanggal_uang_keluar)=$thn AND MONTH(tanggal_uang_keluar)=$bln");
        if(mysqli_num_rows($query) == 0){
        echo '<b>TIDAK ADA UANG KELUAR</b>';
        } else { 
    ?>
  </center>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Tanggal Uang Keluar</th>
        <th>Kode Transaksi</th>
        <th>Nama</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = mysqli_query($koneksi, "SELECT * FROM t_uang_keluar WHERE YEAR(tanggal_uang_keluar)=$thn AND MONTH(tanggal_uang_keluar)=$bln ORDER BY tanggal_uang_keluar ASC");
        while ($hasil_transaksi = mysqli_fetch_array($query)) {
          $kode_transaksi                 = $hasil_transaksi['kode_transaksi'];
            $nama_barang               = $hasil_transaksi['nama_barang'];
            $jumlah_uang               = $hasil_transaksi['jumlah_uang'];
            $tanggal_uang_keluar               = $hasil_transaksi['tanggal_uang_keluar'];
            $diproses_oleh                      = $hasil_transaksi['diproses_oleh'];
      ?>
      <tr>
        <td><?= tglblnthn($tanggal_uang_keluar) ?></td>
        <td><?= $kode_transaksi ?></td>
        <td><?= $nama_barang ?></td>
        <td><?= 'Rp '.number_format($jumlah_uang) ?></td>
      <?php } ?>
      <?php
        $query_kode_total_pendapatan   = mysqli_query($koneksi, "SELECT SUM(jumlah_uang) AS total_pendapatan FROM t_uang_keluar WHERE YEAR(tanggal_uang_keluar)=$thn AND MONTH(tanggal_uang_keluar)=$bln");
        $sql_total_pendapatan          = mysqli_fetch_array($query_kode_total_pendapatan); 
        $sql_total_pendapatan          = $sql_total_pendapatan['total_pendapatan'];
      ?>
      <tr>
        <td>Total Uang Keluar Pada Bulan <?= $new_bulan.' Tahun '.$thn ?></td>
        <td><?= 'Rp. '.number_format($sql_total_pendapatan) ?></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
<?php } ?>