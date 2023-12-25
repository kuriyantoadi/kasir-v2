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

  $kategori_produk              = addslashes(trim($_GET['kategori_produk']));

    $query_get_nama_kategori   = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori=$kategori_produk");
    $sql_get_nama_kategori          = mysqli_fetch_array($query_get_nama_kategori); 
    $result_nama_kategori          = $sql_get_nama_kategori['nama_kategori'];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan So Produk <?= $result_nama_kategori ?> Pada Tanggal <?= tglblnthnjam(date('Y-m-d h:i:s')); ?></title>
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
            <img src="../../../template_beck_end/images/<?= $logo_website ?>" style="width: 75px; height: 75px;">
            <h3><?= $nama_website ?></h3>
            <h5>Alamat    : <?= $alamat_website ?></h5>
            <h5>Telepon   : <?= $no_telepon_website ?></h5>
          </center>
        </td>
      </tr>
    </table>
    <h5>Laporan So Produk <?= $result_nama_kategori ?> Pada Tanggal <?= tglblnthnjam(date('Y-m-d h:i:s')); ?></h5>
    <?php
        $query = mysqli_query($koneksi,"SELECT
        * 
    FROM
        kategori AS ktg
        RIGHT JOIN produk AS pdk ON pdk.id_kategori_produk = ktg.id_kategori
        INNER JOIN user AS usr ON pdk.diproses_oleh = usr.id_user WHERE pdk.id_kategori_produk='$kategori_produk'");
        if(mysqli_num_rows($query) == 0){
        echo '<b>TIDAK ADA DATA</b>';
        } else { 
    ?>
  </center>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Kategori Produk</th>
        <th>Nama Produk</th>
        <th>Stok Di Sistem</th>
        <th>Stok Tersedia</th>
        <th>Hasil</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = mysqli_query($koneksi, "SELECT
        * 
    FROM
        kategori AS ktg
        RIGHT JOIN produk AS pdk ON pdk.id_kategori_produk = ktg.id_kategori
        INNER JOIN user AS usr ON pdk.diproses_oleh = usr.id_user WHERE pdk.id_kategori_produk='$kategori_produk' ORDER BY pdk.nama_produk ASC");
        while ($hasil_transaksi = mysqli_fetch_array($query)) {
          $nama_produk          = $hasil_transaksi['nama_produk'];
          $nama_kategori        = $hasil_transaksi['nama_kategori'];
          $stok                 = $hasil_transaksi['stok'];
      ?>
      <tr>
        <td><?= $nama_kategori ?></td>
        <td><?= $nama_produk ?></td>
        <td><?= $stok ?></td>
        <td></td>
        <td></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
<?php } ?>