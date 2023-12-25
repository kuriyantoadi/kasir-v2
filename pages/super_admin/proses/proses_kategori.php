<?php
include "../../../koneksi.php";
//Proses Tambah
if(isset($_POST['tambah'])){
  $nama_kategori    = addslashes(trim($_POST['nama_kategori']));
  $status_aktif     = addslashes(trim($_POST['status_aktif']));
  $key_kategori     = md5(date('Ymdhis'));

  $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama_kategori='$nama_kategori'");
  if(mysqli_num_rows($query) == 0){
  $sql = mysqli_query($koneksi, "INSERT INTO kategori values('','$nama_kategori','$status_aktif','$key_kategori')");
    if ($sql) { 
      header("Location: ../index.php?hal=kategori&pesan=successTambah");
    } else {
      header("Location: ../index.php?hal=kategori&pesan=gagal");
    }
  }else {
    header("Location: ../index.php?hal=kategori&pesan=duplikat");
  }
}

//Proses Ubah
if(isset($_POST['ubah'])){
    $key_kategori       = addslashes(trim($_POST['key_kategori']));
    $nama_kategori      = addslashes(trim($_POST['nama_kategori']));
    $status_aktif       = addslashes(trim($_POST['status_aktif']));
  
    $sql = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama_kategori',status_kategori='$status_aktif' WHERE key_kategori='$key_kategori'");
      if ($sql) { 
        header("Location: ../index.php?hal=kategori&pesan=successUpdate");
      } else {
        header("Location: ../index.php?hal=kategori&pesan=gagalPerbaharui");
      }
  }

//Proses Hapus
if(isset($_POST['hapus'])){
    $key_kategori       = addslashes(trim($_POST['key_kategori']));
  
    $sql = mysqli_query($koneksi, "DELETE FROM kategori WHERE key_kategori='$key_kategori'");
      if ($sql) { 
        header("Location: ../index.php?hal=kategori&pesan=successHapus");
      } else {
        header("Location: ../index.php?hal=kategori&pesan=gagalHapus");
      }
  }
?>