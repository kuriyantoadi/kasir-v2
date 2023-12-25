<?php
include "../koneksi.php";
function anti_injection_username($data){
    //$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
    return $data;
  }
  $masuk = addslashes(trim($_POST['username']));

$sql = mysqli_query($koneksi, "SELECT * FROM user
                   WHERE username ='$masuk'");
$ketemu = mysqli_num_rows($sql);
echo $ketemu;
?>