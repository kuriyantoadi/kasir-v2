<?php
	include '../koneksi.php';
 
	echo "<option value=''>Pilih Kategori</option>";
    $query_produk   = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
    while ($r = mysqli_fetch_array($query_produk)) {
        echo " <option  value='".$r['id_kategori']."'>".$r['nama_kategori']."</option>";
    }
?>