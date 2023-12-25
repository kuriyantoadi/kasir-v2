<?php
include "../../../koneksi.php";
session_start();
$id_session             = $_SESSION['id_user'];
//Proses Tambah
if(isset($_POST['tambah_uang_keluar'])){
  $tanggal_uang_keluar        = addslashes(trim($_POST['tanggal_uang_keluar']));
  $kode_transaksi        = addslashes(trim($_POST['kode_transaksi']));
  $nama_barang       = addslashes(trim($_POST['nama_barang']));
  $jumlah_uang       = addslashes(trim($_POST['jumlah_uang']));

  $sql = mysqli_query($koneksi, "INSERT INTO t_uang_keluar values('','$kode_transaksi','$nama_barang','$jumlah_uang','$tanggal_uang_keluar','$id_session')");
    if ($sql) { 
      header("Location: ../index.php?hal=uang_keluar&pesan=successTambah");
    } else {
      header("Location: ../index.php?hal=uang_keluar&pesan=gagal");
    }
}

else if(isset($_POST['ubah'])){
    $tanggal_uang_keluar       = addslashes(trim($_POST['tanggal_uang_keluar']));
    $id_uang_keluar      = addslashes(trim($_POST['id_uang_keluar']));
    $nama_barang       = addslashes(trim($_POST['nama_barang']));
    $jumlah_uang       = addslashes(trim($_POST['jumlah_uang']));
  
    $sql = mysqli_query($koneksi, "UPDATE t_uang_keluar SET nama_barang='$nama_barang',jumlah_uang='$jumlah_uang',tanggal_uang_keluar='$tanggal_uang_keluar' WHERE id_uang_keluar='$id_uang_keluar'");
      if ($sql) { 
        header("Location: ../index.php?hal=uang_keluar&pesan=successUpdate");
      } else {
        header("Location: ../index.php?hal=uang_keluar&pesan=gagalPerbaharui");
      }
  }
?>