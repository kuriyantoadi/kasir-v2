<?php
  include('../../../koneksi.php');
  session_start(); //Mendapatkan Session
  if(!isset($_SESSION['super_admin'])){
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

  $tanggal              = addslashes(trim($_GET['tanggal']));
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Uang Keluar Per <?= tglblnthn($tanggal) ?></title>
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
    <h5>Laporan Uang Keluar Per <?= tglblnthn($tanggal) ?></h5>
    <?php
        $query = mysqli_query($koneksi,"SELECT * FROM t_uang_keluar WHERE tanggal_uang_keluar LIKE '%$tanggal%' ORDER BY tanggal_uang_keluar ASC");
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
        $query = mysqli_query($koneksi, "SELECT * FROM t_uang_keluar WHERE tanggal_uang_keluar LIKE '%$tanggal%' ORDER BY tanggal_uang_keluar ASC");
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
      </tr>
      <?php } ?>
      <?php
        $query_kode_total_pendapatan   = mysqli_query($koneksi, "SELECT SUM(jumlah_uang) AS total_pendapatan FROM t_uang_keluar WHERE tanggal_uang_keluar LIKE '%$tanggal%'");
        $sql_total_pendapatan          = mysqli_fetch_array($query_kode_total_pendapatan); 
        $sql_total_pendapatan          = $sql_total_pendapatan['total_pendapatan'];
      ?>
      <tr>
        <td>Total Uang Keluar Pada <?= tglblnthn($tanggal) ?></td>
        <td><?= 'Rp. '.number_format($sql_total_pendapatan) ?></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
<?php } ?>