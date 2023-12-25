<?php
include "../../../koneksi.php";
session_start();
$id_dari_session_header             = $_SESSION['id_user'];
//Proses Tambah
if(isset($_POST['tambah'])){
  $username             = addslashes(trim($_POST['username']));
  $nama                 = addslashes(trim($_POST['nama']));
  $email                = addslashes(trim($_POST['email']));
  $level                = addslashes(trim($_POST['level']));
  $status_aktif         = addslashes(trim($_POST['status_aktif']));
  $password             = md5($username);

  $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
  if(mysqli_num_rows($query) == 0){
  $sql = mysqli_query($koneksi, "INSERT INTO user values('','$username','$password','$nama','$email','$level','$status_aktif')");
    if ($sql) { 
      header("Location: ../index.php?hal=pengguna&pesan=successTambah");
    } else {
      header("Location: ../index.php?hal=pengguna&pesan=gagal");
    }
  }else {
    header("Location: ../index.php?hal=pengguna&pesan=duplikat");
  }
}

//Proses Ubah
if(isset($_POST['ubah'])){
    $id_user        = addslashes(trim($_POST['id_user']));
    $nama           = addslashes(trim($_POST['nama']));
    $email          = addslashes(trim($_POST['email']));
    $level          = addslashes(trim($_POST['level']));
    $status_aktif   = addslashes(trim($_POST['status_aktif']));

    $sql = mysqli_query($koneksi, "UPDATE user SET nama='$nama',email='$email',level='$level',status_aktif='$status_aktif' WHERE id_user='$id_user'");
      if ($sql) { 
        header("Location: ../index.php?hal=pengguna&pesan=successUpdate");
      } else {
        header("Location: ../index.php?hal=pengguna&pesan=gagalPerbaharui");
      }
  }

  //Proses Ubah
if(isset($_POST['update_profil'])){
  $nama           = addslashes(trim($_POST['nama']));
  $email          = addslashes(trim($_POST['email']));
  $password       = addslashes(trim($_POST['password']));
  $mdpassword     = addslashes(trim(md5($_POST['password'])));

  if(empty($password)) {
    //kondisi password kosong
    $sql = mysqli_query($koneksi, "UPDATE user SET nama='$nama',email='$email' WHERE id_user='$id_dari_session_header'");
    if ($sql) { 
        header("Location: ../index.php?hal=profil&pesan=successUpdate");
      } else {
        header("Location: ../index.php?hal=profil&pesan=gagalPerbaharui");
    }
  } else {
    //kondisi password isi
    $sql = mysqli_query($koneksi, "UPDATE user SET nama='$nama',email='$email',password='$mdpassword' WHERE id_user='$id_dari_session_header'");
    if ($sql) { 
        header("Location: ../index.php?hal=profil&pesan=successUpdate");
      } else {
        header("Location: ../index.php?hal=profil&pesan=gagalPerbaharui");
    }
  }
}
?>