-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 16 Jun 2025 pada 10.13
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barley`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(35) NOT NULL,
  `harga` varchar(35) NOT NULL,
  `deskripsi` text,
  `stok` varchar(35) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_kategori` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `deskripsi`, `stok`, `gambar`, `id_kategori`) VALUES
(37, 'Bika', '20000', 'Kue khas Medan dengan tekstur kenyal dan aroma pandan yang kuat.', '0', 'bika.jpg', 8),
(38, 'Getuk', '15000', 'Kue tradisional dari singkong yang manis dan berwarna cerah.', '11', 'getuk.jpg', 8),
(39, 'Klepon', '20000', 'Bola ketan berisi gula merah yang meleleh, dilapisi kelapa parut.', '11', 'klepon.jpg', 8),
(40, 'Kue cucur', '20000', 'Kue goreng bertekstur berserat dan berasa manis legit.', '17', 'kue cucur.jpg', 8),
(41, 'Kue lumpur', '15000', 'Lembut dengan rasa santan dan taburan kismis di atasnya.', '20', 'kue lumpur.jpg', 8),
(42, 'Kue Pancong', '15000', 'Kue khas Betawi dari kelapa parut dan tepung beras.', '20', 'kue pancong.jpg', 8),
(43, 'Kue Putu', '15000', 'Berbentuk silinder isi gula merah dengan aroma pandan.', '20', 'kue putu.jpg', 8),
(44, 'Pukis', '20000', 'Kue lembut setengah lingkaran dengan berbagai topping.', '19', 'pukis.jpg', 8),
(46, 'Putu Wayang', '20000', 'Kue khas berbentuk unik dengan isian manis dan gurih.', '20', 'putu wayang.jpg', 8),
(47, 'Serabi', '20000', 'Kue dadar tebal dari tepung beras dan santan, kadang ditambahkan topping.', '20', 'serabi.jpg', 8),
(48, 'Kembang Goyang', '20000', 'Kue renyah berbentuk bunga dari adonan tepung dan santan.', '20', 'kembang goyang.jpg', 10),
(49, 'Kue Choco Chips', '20000', 'Kue kering dengan potongan cokelat chips di seluruh bagiannya.', '20', 'kue choco chips.jpg', 10),
(50, 'Kue Coklat', '20000', 'Kue kering rasa coklat pekat, manis dan sedikit pahit.', '19', 'kue coklat.jpg', 10),
(51, 'Kue Jahe', '20000', 'Kue kering dengan aroma dan rasa jahe yang hangat.', '20', 'kue jahe.jpg', 10),
(52, 'Kue Kacang Tanah', '20000', 'Kue kering berbahan kacang tanah yang gurih dan renyah.', '20', 'kue kacang tanah.jpg', 10),
(53, 'Kue Kastangel', '20000', 'Kue keju kering berbentuk kotak kecil, gurih dan renyah.', '20', 'kue kastangel.jpg', 10),
(54, 'Kue Kering Keju', '20000', 'Kue renyah dengan rasa keju yang dominan.', '20', 'kue kering keju.jpg', 10),
(55, 'Kue Mentega', '20000', 'Kue lembut dengan rasa mentega yang kaya.', '20', 'kue mentega.jpg', 10),
(56, 'Kue Nastar', '20000', 'Kue kering berisi selai nanas, khas Lebaran.', '20', 'kue nastar.jpg', 10),
(57, 'Kue Pastel Abon', '20000', 'Kue gurih isi abon sapi berbentuk pastel kecil.', '20', 'kue pastel abon.jpg', 10),
(58, 'Kue Putri Salju', '20000', 'Kue kering lembut bertabur gula halus.', '20', 'kue putri salju.jpg', 10),
(59, 'Banana Muffin', '20000', 'Muffin lembut dengan rasa pisang yang kuat.', '20', 'banana muffin.jpg', 13),
(61, 'Chesee muffin', '20000', 'Muffin keju yang gurih dan lembut.', '20', 'chesee muffin.jpg', 13),
(62, 'Chocochip muffin', '20000', 'Muffin cokelat dengan banyak choco chips.', '20', 'chocochip muffin.jpg', 13),
(63, 'Chocolate Muffin', '20000', 'Muffin coklat yang lembut dan moist.', '20', 'chocolate muffin.jpg', 13),
(65, 'Muffin Tape Keju', '20000', 'Muffin dengan campuran tape dan keju, rasa manis asam gurih.', '20', 'muffin tape keju.jpg', 13),
(66, 'Muffin Ubi Merah', '20000', 'Muffin berbahan dasar ubi merah, kaya serat dan warna alami.', '20', 'muffin ubi merah.jpg', 13),
(67, 'Stroberi Muffin', '20000', 'Muffin rasa stroberi dengan aroma segar.', '20', 'stroberi muffin.jpg', 13),
(69, 'Chocolate Cupcakes with Raspberry', '20000', 'Cupcake coklat dengan topping buttercream raspberry.', '20', 'chocolate cupcakes with raspberry buttercream.jpg', 14),
(70, 'Coffee Cupcake', '20000', 'Cupcake dengan rasa kopi yang kuat.', '20', 'coffee cupcake.jpg', 14),
(71, 'Berry Cupcake', '20000', 'Cupcake dengan rasa berbagai berry dan topping manis.', '20', 'berry cupcake.jpg', 14),
(72, 'Lollipop Cupcake', '20000', 'Cupcake lucu dengan dekorasi lollipop.', '20', 'lollipop cupcake.jpg', 14),
(73, 'Vanilla Cupcake', '20000', 'Cupcake rasa vanila klasik dengan topping lembut.', '20', 'vanilla cupcake.jpg', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(8, 'Kue Basah'),
(10, 'Kue Kering'),
(13, 'Muffin'),
(14, 'Cupcake');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `harga_barang` varchar(25) NOT NULL,
  `jumlah_beli` varchar(25) NOT NULL,
  `status` varchar(30) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `total` varchar(25) NOT NULL,
  `id_barang` int NOT NULL,
  `id_pengguna` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `harga_barang`, `jumlah_beli`, `status`, `waktu`, `total`, `id_barang`, `id_pengguna`) VALUES
(100, '20000', '1', 'proses kirim', '25-06-16', '20000', 37, 12),
(101, '15000', '1', 'proses kirim', '25-06-16', '15000', 38, 12),
(102, '20000', '1', 'proses kirim', '25-06-16', '20000', 39, 12),
(103, '15000', '2', 'proses kirim', '25-06-16', '30000', 38, 12),
(104, '20000', '1', 'proses kirim', '25-06-16', '20000', 39, 12),
(105, '20000', '1', 'proses kirim', '25-06-16', '20000', 40, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `hak` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `jenis_kelamin`, `tgl_lahir`, `username`, `password`, `hak`) VALUES
(1, 'Barley Bakery Admin', 'Laki-laki', '1997-02-25', 'admin', 'admin', 'admin'),
(2, 'Devi ', 'Perempuan', '2003-02-20', 'devi', 'devi', 'pengguna'),
(11, 'Asep Prayogi', 'Laki - Laki', '2005-01-06', 'Asep06', 'Asep06', 'pengguna'),
(12, 'Asep Prayogi', 'Laki - Laki', '2025-04-15', 'Asep', 'Asep', 'pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `waktu_transaksi` varchar(50) NOT NULL,
  `subtotal` varchar(25) NOT NULL,
  `status_transaksi` varchar(30) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_pengguna` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

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
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
