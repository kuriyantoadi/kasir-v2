<?php
    include "koneksi.php";

    $sql = mysqli_query($koneksi, "TRUNCATE TABLE barang_masuk");
    $sql = mysqli_query($koneksi, "TRUNCATE TABLE kategori");
    $sql = mysqli_query($koneksi, "TRUNCATE TABLE keranjang");
    $sql = mysqli_query($koneksi, "TRUNCATE TABLE produk");
    $sql = mysqli_query($koneksi, "TRUNCATE TABLE transaksi");
    $sql = mysqli_query($koneksi, "TRUNCATE TABLE t_uang_keluar");
?>