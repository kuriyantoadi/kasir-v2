<?php
include "../../../koneksi.php";
session_start();
$id_session             = $_SESSION['id_user'];
//Proses Tambah
if(isset($_POST['tambah'])){
  $nama_produk          = addslashes(trim($_POST['nama_produk']));
  $kategori_produk      = addslashes(trim($_POST['kategori_produk']));
  $harga                = addslashes(trim($_POST['harga']));
  $stok                 = addslashes(trim($_POST['stok']));
  $status_aktif         = addslashes(trim($_POST['status_aktif']));
  $key_produk           = md5(date('Ymdhis'));

  $var = '/^[0-9]*$/';

  if(!preg_match($var,$harga)) {
    header("Location: ../index.php?hal=produk&pesan=gagal");
  } else {
    $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk='$nama_produk'");
    if(mysqli_num_rows($query) == 0){
    $sql = mysqli_query($koneksi, "INSERT INTO produk values('','$nama_produk','$kategori_produk','$harga','$stok','$status_aktif','$key_produk','$id_session','$tgltamp')");
      if ($sql) { 
        header("Location: ../index.php?hal=produk&pesan=successTambah");
      } else {
        header("Location: ../index.php?hal=produk&pesan=gagal");
      }
    }else {
      header("Location: ../index.php?hal=produk&pesan=duplikat");
    }
  }
}

//Proses Ubah
if(isset($_POST['ubah'])){
    $key_produk       = addslashes(trim($_POST['key_produk']));
    $nama_produk      = addslashes(trim($_POST['nama_produk']));
    $kategori_produk  = addslashes(trim($_POST['kategori_produk']));
    $harga_produk     = addslashes(trim($_POST['harga_produk']));
    $stok             = addslashes(trim($_POST['stok']));
    $status_aktif     = addslashes(trim($_POST['status_aktif']));

    $sql = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama_produk',id_kategori_produk='$kategori_produk',harga_produk='$harga_produk',stok='$stok',status_produk='$status_aktif' WHERE key_produk='$key_produk'");
      if ($sql) { 
        // echo "berhasil";
        header("Location: ../index.php?hal=produk&pesan=successUpdate");
      } else {
        // echo "gagal";
        header("Location: ../index.php?hal=produk&pesan=gagalPerbaharui");
      }
  }

//Proses Hapus
if(isset($_POST['hapus'])){
    $key_produk       = $_POST['key_produk'];
  
    $sql = mysqli_query($koneksi, "DELETE FROM produk WHERE key_produk='$key_produk'");
      if ($sql) { 
        header("Location: ../index.php?hal=produk&pesan=successHapus");
      } else {
        header("Location: ../index.php?hal=produk&pesan=gagalHapus");
      }
  }
?>