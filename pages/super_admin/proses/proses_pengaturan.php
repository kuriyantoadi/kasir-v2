<?php
include "../../../koneksi.php";

//Proses Ubah
if(isset($_POST['update_toko'])){
    $nama        = addslashes(trim($_POST['nama']));
    $alamat      = addslashes(trim($_POST['alamat']));
    $no_telepon  = addslashes(trim($_POST['no_telepon']));
    $email       = addslashes(trim($_POST['email']));
    
    //PROSES FOTO
    $foto           = $_FILES['foto']['name'];
    $tmp            = $_FILES['foto']['tmp_name'];
    $fotobaru       = date('dmYHis').$foto;
    $format         = $_FILES['foto']['type'];

    $path           = "../../../template_beck_end/images/".$fotobaru;
    
    if (empty($foto)){
        //kondisi foto kosong
        $sql = mysqli_query($koneksi, "UPDATE setting_website SET nama_website='$nama',alamat_website='$alamat',no_telepon_website='$no_telepon',email_website='$email'");
        if ($sql) { 
          header("Location: ../index.php?hal=pengaturan&pesan=successUpdate");
        } else {
          header("Location: ../index.php?hal=pengaturan&pesan=gagalPerbaharui");
        }
    } else {
        //kondisi dengan foto
        if ($format == "image/png" || $format == "image/jpeg") {
          $sql = mysqli_query($koneksi, "UPDATE setting_website SET logo_website='$fotobaru',nama_website='$nama',alamat_website='$alamat',no_telepon_website='$no_telepon',email_website='$email'");
          if ($sql) { 
            move_uploaded_file($tmp, $path); 
            header("Location: ../index.php?hal=pengaturan&pesan=successUpdate");
          } else {
            header("Location: ../index.php?hal=pengaturan&pesan=gagalPerbaharui");
          }  

				} else {
          header("Location: ../index.php?hal=pengaturan&pesan=gagalPerbaharui");
				}
    }
  }
?>