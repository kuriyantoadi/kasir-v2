<?php
include "../koneksi.php";
function anti_injection_nama_kategori($data){
    //$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
    return $data;
  }
  $masuk = addslashes(trim($_POST['nama_kategori']));

$sql = mysqli_query($koneksi, "SELECT * FROM kategori
                   WHERE nama_kategori ='$masuk'");
$ketemu = mysqli_num_rows($sql);
echo $ketemu;
?>