<?php
session_start();
require_once("../../koneksi.php");
$id     = addslashes(trim($_POST['username']));
$pass   = addslashes(trim(md5($_POST['password'])));

$query = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$id' AND password='$pass' AND status_aktif='1'"); // Membandingkan kode & password
  if(mysqli_num_rows($query) == 0){
      header("location:index.php?pesan=gagal");
    } else{
      $row = mysqli_fetch_array($query);
      if ($row['level'] == 1 ){ // Membandingkan level
        $_SESSION['id_user']        =   $row['id_user'];
        $_SESSION['super_admin']    =   $row['level'];
        header("Location:../super_admin/index.php?hal=beranda&pesan=successLogin"); 
      } else if ($row['level'] == 2){
        $_SESSION['id_user']=$row['id_user'];
        $_SESSION['kasir']=$row['level'];
        header("Location:../kasir/index.php?hal=beranda&pesan=successLogin");
      } else if ($row['level'] == 3){
        $_SESSION['id_user']=$row['id_user'];
        $_SESSION['investor']=$row['level'];
        header("Location:../investor/index.php?hal=beranda&pesan=successLogin");
      } else {
        header("location:index.php?pesan=gagalTerjadiKesalahan");
      }
    }
?>