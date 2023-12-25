-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2023 pada 16.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `kode_produk` varchar(3) NOT NULL,
  `qty` varchar(3) NOT NULL,
  `harga_per_item` varchar(10) NOT NULL,
  `diproses_oleh` varchar(10) NOT NULL,
  `tanggal_input` varchar(50) NOT NULL,
  `key_barang_masuk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `status_kategori` enum('1','2') NOT NULL,
  `key_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `kode_keranjang` varchar(50) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `qty_produk` varchar(3) NOT NULL,
  `harga_satuan` varchar(10) NOT NULL,
  `status_keranjang` enum('1','2') NOT NULL,
  `tgl_keranjang` datetime NOT NULL,
  `key_keranjang` varchar(50) NOT NULL,
  `oleh` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `id_kategori_produk` int(2) NOT NULL,
  `harga_produk` varchar(10) NOT NULL,
  `stok` varchar(3) NOT NULL,
  `status_produk` enum('1','2') NOT NULL,
  `key_produk` varchar(255) NOT NULL,
  `diproses_oleh` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_website`
--

CREATE TABLE `setting_website` (
  `nama_website` varchar(100) NOT NULL,
  `alamat_website` varchar(255) NOT NULL,
  `no_telepon_website` varchar(16) NOT NULL,
  `email_website` varchar(50) NOT NULL,
  `logo_website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `setting_website`
--

INSERT INTO `setting_website` (`nama_website`, `alamat_website`, `no_telepon_website`, `email_website`, `logo_website`) VALUES
('NAMA TOKO SENDIRI', 'ALAMAT TOKO ANDA', '021 123 456', 'cheesebox@gmail.com', '21112022232250Pastel Ilustrasi Logo Makanan Ringan Keripik Kentang (1).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_keranjang` varchar(50) NOT NULL,
  `jumlah_yang_dibeli` varchar(3) NOT NULL,
  `total_harga` varchar(16) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `tanggal_transaksi` varchar(50) NOT NULL,
  `key_transaksi` varchar(50) NOT NULL,
  `oleh` varchar(3) NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `keterangan_pembayaran` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_uang_keluar`
--

CREATE TABLE `t_uang_keluar` (
  `id_uang_keluar` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jumlah_uang` varchar(50) NOT NULL,
  `tanggal_uang_keluar` varchar(50) NOT NULL,
  `diproses_oleh` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `status_aktif` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `level`, `status_aktif`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', '1', '1'),
(2, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir', 'kasir@gmail.com', '2', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `t_uang_keluar`
--
ALTER TABLE `t_uang_keluar`
  ADD PRIMARY KEY (`id_uang_keluar`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_uang_keluar`
--
ALTER TABLE `t_uang_keluar`
  MODIFY `id_uang_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
