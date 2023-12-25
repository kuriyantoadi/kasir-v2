<?php
include "../../../koneksi.php";
session_start();
$oleh                       = $_SESSION['id_user'];
//Proses Tambah
if(isset($_POST['tambah'])){
  $id_kategori              = addslashes(trim($_POST['id_kategori']));
  $id_produk                = addslashes(trim($_POST['id_produk']));
  $banyaknya                = addslashes(trim($_POST['banyaknya']));
  $kode_keranjang           = addslashes(trim($_POST['kode_keranjang']));
  $key_keranjang            = $kode_keranjang;
  
  $query_cari_produk        = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk=$id_produk");
  $sql_cari_produk          = mysqli_fetch_array($query_cari_produk);
  $harga                    = $sql_cari_produk['harga_produk'];
  $stok                     = $sql_cari_produk['stok'];

  $var_kurangi_stok         = $stok - $banyaknya;
 
  $var = '/^[0-9]*$/';

  if(!preg_match($var,$banyaknya)){
    header("Location: ../index.php?hal=keranjang&pesan=gagal");
    } else {
      if ($stok >= $banyaknya) {
        $query = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE kode_keranjang='$kode_keranjang' AND id_produk='$id_produk' AND oleh='$oleh'");
        if(mysqli_num_rows($query) == 0){
        $sql = mysqli_query($koneksi, "INSERT INTO keranjang values('','$kode_keranjang','$id_produk','$banyaknya','$harga','2',NOW(),'$key_keranjang','$oleh')");
        $sql = mysqli_query($koneksi, "UPDATE produk SET stok='$var_kurangi_stok' WHERE id_produk='$id_produk'");
          if ($sql) { 
            header("Location: ../index.php?hal=keranjang&pesan=successTambah");
          } else {
            header("Location: ../index.php?hal=keranjang&pesan=gagal");
          }
        }else {
          header("Location: ../index.php?hal=keranjang&pesan=duplikat");
        }
      } else {
        header("Location: ../index.php?hal=keranjang&pesan=gagalStokKurang");
      }
  } 
}

//Proses Ubah
if(isset($_POST['ubah'])){
    $id_keranjang       = addslashes(trim($_POST['id_keranjang']));
    $qty_produk         = addslashes(trim($_POST['qty_produk']));

    $query_cari_produk        = mysqli_query($koneksi,"SELECT
    * 
  FROM
    produk AS pdk
    INNER JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk WHERE krj.id_keranjang=$id_keranjang");
    $sql_cari_produk          = mysqli_fetch_array($query_cari_produk);
    $qty_produk_t_krj         = $sql_cari_produk['qty_produk'];
    $qtystok_t_pdk            = $sql_cari_produk['stok'];
    $id_produk                = $sql_cari_produk['id_produk'];

    $step_satu                = $qtystok_t_pdk + $qty_produk_t_krj;
    $step_dua                 = $step_satu - $qty_produk;
    
    //echo 'Qty awal '.$qty_produk_t_krj.' <br>';
    //echo 'Request '.$qty_produk.'<br>';
    //echo 'Stok tersedia '.$qtystok_t_pdk.' <br>';
    //echo 'stok di gudang di tambah qty awal '.$step_satu.'<br>';
    //echo 'hasil penjumlahan stok di kurang request '.$step_dua.'<br>';
    //echo 'Hasil akhir '.$step_dua.'<br>';

    $var = '/^[0-9]*$/';

    if(!preg_match($var,$qty_produk)){
      header("Location: ../index.php?hal=keranjang&pesan=gagal");
    } else {
      if ($step_satu >= $qty_produk){
        //echo 'ok';
        //die();
        $sql = mysqli_query($koneksi, "UPDATE keranjang SET qty_produk='$qty_produk' WHERE id_keranjang='$id_keranjang' AND oleh='$oleh'");
        $sql = mysqli_query($koneksi, "UPDATE produk SET stok='$step_dua' WHERE id_produk='$id_produk'");
          if ($sql) { 
            header("Location: ../index.php?hal=keranjang&pesan=successUpdate");
          } else {
            header("Location: ../index.php?hal=keranjang&pesan=gagalPerbaharui");
          }
      } else {
        //echo 'gagal';
        //die();
        header("Location: ../index.php?hal=keranjang&pesan=gagalStokKurang");
      }
    }
  }

//Proses Hapus
if(isset($_POST['hapus_keranjang_peitem'])){
    $id_keranjang       = addslashes(trim($_POST['id_keranjang']));
    $query_cari_produk        = mysqli_query($koneksi,"SELECT
    * 
  FROM
    produk AS pdk
    INNER JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk WHERE krj.id_keranjang=$id_keranjang");
    $sql_cari_produk          = mysqli_fetch_array($query_cari_produk);
    $qty_produk_t_krj         = $sql_cari_produk['qty_produk'];
    $qtystok_t_pdk            = $sql_cari_produk['stok'];
    $id_produk                = $sql_cari_produk['id_produk'];

    $step_satu                = $qtystok_t_pdk + $qty_produk_t_krj;    
  
    $sql = mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang' AND oleh='$oleh'");
    $sql = mysqli_query($koneksi, "UPDATE produk SET stok='$step_satu' WHERE id_produk='$id_produk'");
      if ($sql) { 
        header("Location: ../index.php?hal=keranjang&pesan=successHapus");
      } else {
        header("Location: ../index.php?hal=keranjang&pesan=gagalHapus");
      }
  }

  //Proses Tambah Transaksi
  if(isset($_POST['bayar_dan_cetak'])){
    $total_qty                = addslashes(trim($_POST['total_qty']));
    $kode_keranjang           = addslashes(trim($_POST['kode_keranjang']));
    $total_bayar_hidden       = addslashes(trim($_POST['total_bayar_hidden']));
    $catatan                  = addslashes(trim($_POST['catatan']));
    $dari_mana_mengetahui     = addslashes(trim($_POST['dari_mana_mengetahui']));
    $result_lainya            = addslashes(trim($_POST['result_lainya']));
    $key_keranjang            = md5($kode_keranjang);
   
    $sql = mysqli_query($koneksi, "INSERT INTO transaksi values('','$kode_keranjang','$total_qty','$total_bayar_hidden','$catatan',NOW(),'$key_keranjang','$oleh','$dari_mana_mengetahui','$result_lainya')");
    $sql = mysqli_query($koneksi, "UPDATE keranjang SET status_keranjang='1' WHERE kode_keranjang='$kode_keranjang' AND oleh='$oleh'");
      if ($sql) { 
        header("Location: ../invoice.php?kode_keranjang=".$kode_keranjang);
      } else {
        header("Location: ../index.php?hal=keranjang&pesan=gagal");
      }
    }

    //Proses Hapus Transaksi
  if(isset($_POST['hapus_transaksi'])){
    $kode_keranjang       = addslashes(trim($_POST['kode_keranjang']));

    $sql = mysqli_query($koneksi, "DELETE FROM keranjang WHERE kode_keranjang='$kode_keranjang'");
    $sql = mysqli_query($koneksi, "DELETE FROM transaksi WHERE kode_keranjang='$kode_keranjang'");
      if ($sql) { 
        header("Location: ../index.php?hal=transaksi&pesan=successHapus");
      } else {
        header("Location: ../index.php?hal=transaksi&pesan=gagalHapus");
      }
  }
?>