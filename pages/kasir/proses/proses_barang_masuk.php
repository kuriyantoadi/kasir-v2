<?php
include "../../../koneksi.php";
session_start();
$id_session             = $_SESSION['id_user'];
//Proses Tambah
if(isset($_POST['tambah'])){
  $id_produk        = addslashes(trim($_POST['id_produk']));
  $banyaknya        = addslashes(trim($_POST['banyaknya']));
  $harga_beli       = addslashes(trim($_POST['harga_beli']));
  $key_barang_masuk = md5(date('Ymdhis'));
  
  //Proses cek stok di t-produk
  $query_id_produk            = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk=$id_produk");
  $sql_id_produk              = mysqli_fetch_array($query_id_produk);
  $get_stok_produk            = $sql_id_produk['stok'];
  $hasil_stok_produk          = $get_stok_produk + $banyaknya;

  $sql = mysqli_query($koneksi, "INSERT INTO barang_masuk values('','$id_produk','$banyaknya','$harga_beli','$id_session','$tgltamp','$key_barang_masuk')");
  $sql = mysqli_query($koneksi, "UPDATE produk SET stok='$hasil_stok_produk',status_produk='1' WHERE id_produk='$id_produk'");
    if ($sql) { 
      header("Location: ../index.php?hal=transaksi_barang_masuk&pesan=successTambah");
    } else {
      header("Location: ../index.php?hal=transaksi_barang_masuk&pesan=gagal");
    }
}

//Proses Hapus
if(isset($_POST['hapus'])){
    $key_barang_masuk       = addslashes(trim($_POST['key_barang_masuk']));
    
    //Proses ambil data stok dari barang masuk
    $query_key_barang_masuk            = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE key_barang_masuk='$key_barang_masuk'");
    $sql_key_barang_masuk              = mysqli_fetch_array($query_key_barang_masuk);
    $get_id_produk                     = $sql_key_barang_masuk['kode_produk'];
    $get_stok_produk                   = $sql_key_barang_masuk['qty'];

    //Proses ambil data stok dari produk
    $query_stok            = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$get_id_produk'");
    $sql_stok              = mysqli_fetch_array($query_stok);
    $get_qty_produk        = $sql_stok['stok'];

    $hasil_qty_produk      = $get_qty_produk - $get_stok_produk;
    
    $sql = mysqli_query($koneksi, "DELETE FROM barang_masuk WHERE key_barang_masuk='$key_barang_masuk'");
    $sql = mysqli_query($koneksi, "UPDATE produk SET stok='$hasil_qty_produk' WHERE id_produk='$get_id_produk'");
      if ($sql) { 
        header("Location: ../index.php?hal=transaksi_barang_masuk&pesan=successHapus");
      } else {
        header("Location: ../index.php?hal=transaksi_barang_masuk&pesan=gagalHapus");
      }
  }
?>