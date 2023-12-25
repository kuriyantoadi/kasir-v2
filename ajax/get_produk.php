<?php
	include '../koneksi.php';
    $get_id_kategori_nya = addslashes(trim($_POST['get_id_kategori_nya']));
	echo "<option value=''>Pilih Produk</option>";
    $query_produk   = mysqli_query($koneksi, "SELECT * FROM produk WHERE status_produk='1' AND id_kategori_produk=$get_id_kategori_nya ORDER BY nama_produk ASC");
    //$query_produk   = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY nama_produk ASC");
    while ($r = mysqli_fetch_array($query_produk)) {
        echo " <option  value='".$r['id_produk']."'>".$r['nama_produk']." - Harga Jual Rp. ".number_format($r['harga_produk'])."</option>";
    }
?> 