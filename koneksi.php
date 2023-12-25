<?php

$koneksi = mysqli_connect("localhost","root","","kasir");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

date_default_timezone_set('Asia/Jakarta');

$tz                             = 'Asia/Jakarta';
$dt                             = new DateTime("now", new DateTimeZone($tz));
$timestamp                      = $dt->format('G:i');
$tgltamp                        = $dt->format('Y-m-d H:i:s');

$sql_setweb                     = mysqli_query($koneksi,"SELECT * FROM setting_website");
$datasetweb                     = mysqli_fetch_assoc($sql_setweb);
$nama_website                   = strip_tags($datasetweb['nama_website']);
$alamat_website                 = strip_tags($datasetweb['alamat_website']);
$no_telepon_website             = strip_tags($datasetweb['no_telepon_website']);
$email_website                  = strip_tags($datasetweb['email_website']);
$logo_website                   = strip_tags($datasetweb['logo_website']);

function tglblnthnjam($get_tgl_bln_thn_jam) {
    $get_waktunya       = date('H:i:s', strtotime($get_tgl_bln_thn_jam));
    $get_tanggalnya     = date('Y-m-d', strtotime($get_tgl_bln_thn_jam));
    //pecah tanggal
    $pch_tgl=explode("-",$get_tanggalnya);
    $thn=$pch_tgl[0];
    $bln=$pch_tgl[1];
    $tgl=$pch_tgl[2];
    
    switch($bln){
    case 1 : {
      $bln = 'Januari';
    } break;
    case 2 : {
      $bln = 'Febuari';
    } break;
    case 3 : {
      $bln = 'Maret';
    } break;
    case 4 : {
      $bln = 'April';
    } break;
    case 5 : {
      $bln = 'Mei';
    } break;
    case 6 : {
      $bln = 'Juni';
    } break;
    case 7 : {
      $bln = 'Juli';
    } break;
    case 8 : {
      $bln = 'Agustus';
    } break;
    case 9 : {
      $bln = 'September';
    } break;
    case 10 : {
      $bln = 'Oktober';
    } break;
    case 11 : {
     $bln = 'November';
    } break;
    case 12 : {
     $bln = 'Desember';
    } break;
    default : {
      $bln = 'Tidak Diketahui';
    } break;
    }
     $tglblnthn =  $tgl.' '.$bln.' ' .$thn.' '.$get_waktunya;
     return $tglblnthn;
  }
  
  function tglblnthn($get_tgl_bln_thn) {
    $get_waktunya             = date('H:i:s', strtotime($get_tgl_bln_thn));
    $get_tanggalnya           = date('Y-m-d', strtotime($get_tgl_bln_thn));
    //pecah tanggal
    $pch_tgl=explode("-",$get_tanggalnya);
    $thn=$pch_tgl[0];
    $bln=$pch_tgl[1];
    $tgl=$pch_tgl[2];
    
    switch($bln){
    case 1 : {
      $bln = 'Januari';
    } break;
    case 2 : {
      $bln = 'Febuari';
    } break;
    case 3 : {
      $bln = 'Maret';
    } break;
    case 4 : {
      $bln = 'April';
    } break;
    case 5 : {
      $bln = 'Mei';
    } break;
    case 6 : {
      $bln = 'Juni';
    } break;
    case 7 : {
      $bln = 'Juli';
    } break;
    case 8 : {
      $bln = 'Agustus';
    } break;
    case 9 : {
      $bln = 'September';
    } break;
    case 10 : {
      $bln = 'Oktober';
    } break;
    case 11 : {
     $bln = 'November';
    } break;
    case 12 : {
     $bln = 'Desember';
    } break;
    default : {
      $bln = 'Tidak Diketahui';
    } break;
    }
     $tglblnthn =  $tgl.' '.$bln.' ' .$thn;
     return $tglblnthn;
  }

  $tanggal_hari_ini_dari_koneksi  = date('Y-m-d');
  $bulan_tahun_ini_dari_koneksi   = date('Y-m');
  $nows                           = strtotime(date('Y-m-d'));
  $satuharilalu                   = date('Y-m-d',strtotime('-1 day',$nows));
  $duaharilalu                    = date('Y-m-d',strtotime('-2 day',$nows));
  $tigaharilalu                   = date('Y-m-d',strtotime('-3 day',$nows));
  $empatharilalu                  = date('Y-m-d',strtotime('-4 day',$nows));
  $limaharilalu                   = date('Y-m-d',strtotime('-5 day',$nows));
  $enamharilalu                   = date('Y-m-d',strtotime('-6 day',$nows));
  $tujuharilalu                   = date('Y-m-d',strtotime('-7 day',$nows));
  $end                            = date('Y-m-d');

  $query_total_kategori           = mysqli_query($koneksi, "SELECT COUNT(id_kategori) AS JUMLAH FROM kategori");
  $result_kategori                = mysqli_fetch_array($query_total_kategori);
  $total_jumlah_kategori          = $result_kategori['JUMLAH'];

  $query_total_produk             = mysqli_query($koneksi, "SELECT COUNT(id_produk) AS JUMLAH FROM produk");
  $result_produk                  = mysqli_fetch_array($query_total_produk);
  $total_jumlah_produk            = $result_produk['JUMLAH'];         

  $query_total_transaksi_kemarin  = mysqli_query($koneksi, "SELECT COUNT(id_transaksi) AS JUMLAH FROM transaksi WHERE tanggal_transaksi LIKE '%$satuharilalu%'");
  $result_transaksi_kemarin       = mysqli_fetch_array($query_total_transaksi_kemarin);
  $total_jumlah_transaksi_kemarin = $result_transaksi_kemarin['JUMLAH'];

  $query_total_transaksi_today    = mysqli_query($koneksi, "SELECT COUNT(id_transaksi) AS JUMLAH FROM transaksi WHERE tanggal_transaksi LIKE '%$tanggal_hari_ini_dari_koneksi%'");
  $result_transaksi_today         = mysqli_fetch_array($query_total_transaksi_today);
  $total_jumlah_transaksi_today   = $result_transaksi_today['JUMLAH'];

  $query_total_transaksi_bln_ini  = mysqli_query($koneksi, "SELECT COUNT(id_transaksi) AS JUMLAH FROM transaksi WHERE tanggal_transaksi LIKE '%$bulan_tahun_ini_dari_koneksi%'");
  $result_transaksi_bln_ini       = mysqli_fetch_array($query_total_transaksi_bln_ini);
  $total_jumlah_transaksi_bln_ini = $result_transaksi_bln_ini['JUMLAH'];

  $query_pendapatan_hari_ini      = mysqli_query($koneksi, "SELECT SUM(total_harga) AS JUMLAH FROM transaksi WHERE tanggal_transaksi LIKE '%$tanggal_hari_ini_dari_koneksi%'");
  $result_pendapatan_hari_ini     = mysqli_fetch_array($query_pendapatan_hari_ini);
  $total_pendapatan_hari_ini      = $result_pendapatan_hari_ini['JUMLAH'];
  
  $query_pendapatan_hari_ini_t      = mysqli_query($koneksi, "SELECT SUM(total_harga) AS JUMLAH FROM transaksi WHERE tanggal_transaksi LIKE '%$tanggal_hari_ini_dari_koneksi%' AND metode_pembayaran='Tunai'");
  $result_pendapatan_hari_ini_t     = mysqli_fetch_array($query_pendapatan_hari_ini_t);
  $total_pendapatan_hari_ini_t      = $result_pendapatan_hari_ini_t['JUMLAH'];
  
  $query_uang_keluar_hari_ini      = mysqli_query($koneksi, "SELECT SUM(jumlah_uang) AS JUMLAH FROM t_uang_keluar WHERE tanggal_uang_keluar LIKE '%$tanggal_hari_ini_dari_koneksi%'");
  $result_uang_keluar_hari_ini     = mysqli_fetch_array($query_uang_keluar_hari_ini);
  $total_uang_keluar_hari_ini      = $result_uang_keluar_hari_ini['JUMLAH'];
  
  $query_uang_keluar_kemarin      = mysqli_query($koneksi, "SELECT SUM(jumlah_uang) AS JUMLAH FROM t_uang_keluar WHERE tanggal_uang_keluar LIKE '%$satuharilalu%'");
  $result_uang_keluar_keluar_kemarin     = mysqli_fetch_array($query_uang_keluar_kemarin);
  $total_uang_keluar_keluar_kemarin      = $result_uang_keluar_keluar_kemarin['JUMLAH'];

  $query_pendapatan_bln_ini       = mysqli_query($koneksi, "SELECT SUM(total_harga) AS JUMLAH FROM transaksi WHERE tanggal_transaksi LIKE '%$bulan_tahun_ini_dari_koneksi%'");
  $result_pendapatan_bln_ini      = mysqli_fetch_array($query_pendapatan_bln_ini);
  $total_pendapatan_bln_ini       = $result_pendapatan_bln_ini['JUMLAH'];

  $query_pendapatan_kmr_ini       = mysqli_query($koneksi, "SELECT SUM(total_harga) AS JUMLAH FROM transaksi WHERE tanggal_transaksi LIKE '%$satuharilalu%'");
  $result_pendapatan_kmr_ini      = mysqli_fetch_array($query_pendapatan_kmr_ini);
  $total_pendapatan_kmr_ini       = $result_pendapatan_kmr_ini['JUMLAH'];

?>
