<?php
  //Include file header.php
  include 'header.php';
  //cek session, kalo ga ada, lempar ke login.
  if(isset($_GET['hal'])){
      switch($_GET['hal']){
          //view data
            case 'beranda'                  : include 'beranda.php'; break;
            case 'kategori'                 : include 'data/kategori.php'; break;
            case 'produk'                   : include 'data/produk.php'; break;
            case 'keranjang'                : include 'data/keranjang.php'; break;
            case 'menu_keranjang'           : include 'data/menu_keranjang.php'; break;
            case 'transaksi'                : include 'data/transaksi.php'; break;
            case 'uang_keluar'              : include 'data/uang_keluar.php'; break;
            case 'laporan'                  : include 'data/laporan.php'; break;
            case 'pengguna'                 : include 'data/pengguna.php'; break;
            case 'profil'                   : include 'data/profil.php'; break;
            case 'pengaturan'               : include 'data/pengaturan.php'; break;
            case 'transaksi_barang_masuk'   : include 'data/transaksi_barang_masuk.php'; break;
            case 'laporan_barang_masuk'     : include 'data/laporan_barang_masuk.php'; break;
            case 'laporan_so_barang'        : include 'data/laporan_so_barang.php'; break;
            case 'laporan_uang_keluar'      : include 'data/laporan_uang_keluar.php'; break;
            default : include '404.php';
      }
  }else{
      include 'beranda.php';
  }
  //Include file footer.php
  include 'footer.php';

?>