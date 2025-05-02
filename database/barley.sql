-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 01:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(35) NOT NULL,
  `harga` int(35) NOT NULL,
  `stok` int(35) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `gambar`, `id_kategori`) VALUES
(37, 'Bika', 20000, 18, 'bika.jpg', 8),
(38, 'Getuk', 15000, 20, 'getuk.jpg', 8),
(39, 'Klepon', 20000, 20, 'klepon.jpg', 8),
(40, 'Kue cucur', 20000, 20, 'kue cucur.jpg', 8),
(41, 'Kue lumpur', 15000, 20, 'kue lumpur.jpg', 8),
(42, 'Kue Pancong', 15000, 19, 'kue pancong.jpg', 8),
(43, 'Kue Putu', 15000, 20, 'kue putu.jpg', 8),
(44, 'Pukis', 20000, 20, 'pukis.jpg', 8),
(46, 'Putu Wayang', 20000, 20, 'putu wayang.jpg', 8),
(47, 'Serabi', 20000, 20, 'serabi.jpg', 8),
(48, 'Kembang Goyang', 20000, 20, 'kembang goyang.jpg', 10),
(49, 'Kue Choco Chips', 20000, 20, 'kue choco chips.jpg', 10),
(50, 'Kue Coklat', 20000, 20, 'kue coklat.jpg', 10),
(51, 'Kue Jahe', 20000, 20, 'kue jahe.jpg', 10),
(52, 'Kue Kacang Tanah', 20000, 20, 'kue kacang tanah.jpg', 10),
(53, 'Kue Kastangel', 20000, 20, 'kue kastangel.jpg', 10),
(54, 'Kue Kering Keju', 20000, 20, 'kue kering keju.jpg', 10),
(55, 'Kue Mentega', 20000, 20, 'kue mentega.jpg', 10),
(56, 'Kue Nastar', 20000, 20, 'kue nastar.jpg', 10),
(57, 'Kue Pastel Abon', 20000, 20, 'kue pastel abon.jpg', 10),
(58, 'Kue Putri Salju', 20000, 20, 'kue putri salju.jpg', 10),
(59, 'Banana Muffin', 20000, 20, 'banana muffin.jpg', 13),
(60, 'Blueberry crumble muffin', 20000, 20, 'blueberry crumble muffin.jpg', 13),
(61, 'Chesee muffin', 20000, 20, 'chesee muffin.jpg', 13),
(62, 'Chocochip muffin', 20000, 20, 'chocochip muffin.jpg', 13),
(63, 'Chocolate Muffin', 20000, 20, 'chocolate muffin.jpg', 13),
(64, 'Espresso Banana Muffins', 20000, 20, 'espresso banana muffins.jpg', 13),
(65, 'Muffin Tape Keju', 20000, 20, 'muffin tape keju.jpg', 13),
(66, 'Muffin Ubi Merah', 20000, 20, 'muffin ubi merah.jpg', 13),
(67, 'Stroberi Muffin', 20000, 20, 'stroberi muffin.jpg', 13),
(68, 'Chocolate Cupcakes', 20000, 20, 'chocolate cupcakes.jpg', 14),
(69, 'Chocolate Cupcakes with Raspberry', 20000, 20, 'chocolate cupcakes with raspberry buttercream.jpg', 14),
(70, 'Coffee Cupcake', 20000, 20, 'coffee cupcake.jpg', 14),
(71, 'Berry Cupcake', 20000, 20, 'berry cupcake.jpg', 14),
(72, 'Lollipop Cupcake', 20000, 20, 'lollipop cupcake.jpg', 14),
(73, 'Vanilla Cupcake', 20000, 20, 'vanilla cupcake.jpg', 14);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(8, 'Kue Basah'),
(10, 'Kue Kering'),
(13, 'Muffin'),
(14, 'Cupcake');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `harga_barang` int(25) NOT NULL,
  `jumlah_beli` int(25) NOT NULL,
  `status` varchar(30) NOT NULL,
  `waktu` datetime(6) NOT NULL,
  `total` int(25) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `harga_barang`, `jumlah_beli`, `status`, `waktu`, `total`, `id_barang`, `id_pengguna`) VALUES
(70, 20000, 2, 'proses kirim', '2025-04-28 00:00:00.000000', 40000, 37, 2),
(71, 15000, 1, 'proses kirim', '2025-04-28 00:00:00.000000', 15000, 42, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `hak` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `jenis_kelamin`, `tgl_lahir`, `username`, `password`, `hak`) VALUES
(1, 'Barley Bakery Admin', 'Laki-laki', '1997-02-25', 'admin', 'admin', 'admin'),
(2, 'Devi ', 'Perempuan', '2003-02-20', 'devi', 'devi', 'pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `subtotal` int(25) NOT NULL,
  `status_transaksi` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` int(15) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `waktu_transaksi`, `subtotal`, `status_transaksi`, `alamat`, `no_hp`, `id_pengguna`) VALUES
(61, '2021-05-05', 180000, 'selesai', 'Jl. Mangga No. 5', 2147483647, 2),
(62, '2021-05-12', 95000, 'selesai', 'Jl. Anggrek No. 21', 2147483647, 2),
(63, '0000-00-00', 250000, 'lunas', 'Jl. Melati No. 8', 2147483647, 2),
(64, '2021-06-02', 120000, 'diproses', 'Jl. Kenanga No. 3', 2147483647, 2),
(65, '2021-06-15', 75000, 'selesai', 'Jl. Flamboyan No. 15', 2147483647, 2),
(66, '2021-06-19', 300000, 'dikirim', 'Jl. Sakura No. 7', 2147483647, 2),
(67, '0000-00-00', 150000, 'selesai', 'Jl. Merdeka No. 10', 2147483647, 2),
(68, '0000-00-00', 75000, 'diproses', 'Jl. Sudirman No. 45', 2147483647, 2),
(69, '0000-00-00', 200000, 'dikirim', 'Jl. Gatot Subroto No. 22', 2147483647, 2),
(70, '0000-00-00', 90000, 'selesai', 'Jl. Thamrin No. 8', 2147483647, 2),
(71, '0000-00-00', 180000, 'dikirim', 'Jl. Asia Afrika No. 17', 2147483647, 2),
(72, '0000-00-00', 120000, 'selesai', 'Jl. Diponegoro No. 33', 2147483647, 2),
(73, '0000-00-00', 250000, 'diproses', 'Jl. Hayam Wuruk No. 12', 2147483647, 2),
(74, '0000-00-00', 80000, 'selesai', 'Jl. Pahlawan No. 5', 2147483647, 2),
(75, '0000-00-00', 160000, 'dikirim', 'Jl. Ahmad Yani No. 19', 2147483647, 2),
(76, '0000-00-00', 95000, 'selesai', 'Jl. Surya Kencana No. 7', 2147483647, 2),
(77, '0000-00-00', 210000, 'diproses', 'Jl. Cihampelas No. 88', 2147483647, 2),
(78, '0000-00-00', 130000, 'selesai', 'Jl. Dago No. 21', 2147483647, 2),
(79, '0000-00-00', 70000, 'dikirim', 'Jl. Braga No. 14', 2147483647, 2),
(80, '0000-00-00', 175000, 'selesai', 'Jl. Riau No. 29', 2147483647, 2),
(81, '0000-00-00', 220000, 'diproses', 'Jl. Sumatra No. 11', 2147483647, 2),
(82, '0000-00-00', 110000, 'selesai', 'Jl. Jawa No. 3', 2147483647, 2),
(83, '0000-00-00', 140000, 'dikirim', 'Jl. Kalimantan No. 9', 2147483647, 2),
(84, '0000-00-00', 190000, 'selesai', 'Jl. Sulawesi No. 16', 2147483647, 2),
(85, '0000-00-00', 85000, 'diproses', 'Jl. Papua No. 25', 2147483647, 2),
(86, '0000-00-00', 300000, 'dikirim', 'Jl. Bali No. 13', 2147483647, 2),
(87, '2025-04-28', 55000, 'proses kirim', 'devi', 2147483647, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
