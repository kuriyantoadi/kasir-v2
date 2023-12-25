<?php
include "../koneksi.php";
function anti_injection_nama_produk($data){
    //$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
    return $data;
  }
  $masuk = addslashes(trim($_POST['nama_produk']));

$sql = mysqli_query($koneksi, "SELECT * FROM produk
                   WHERE nama_produk ='$masuk'");
$ketemu = mysqli_num_rows($sql);
echo $ketemu;
?>