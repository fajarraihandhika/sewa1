-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2026 at 12:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(120) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `id_type` enum('ktp','sim','paspor') DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `foto_id` varchar(255) DEFAULT NULL,
  `nomor_sim` varchar(50) DEFAULT NULL,
  `foto_sim` varchar(255) DEFAULT NULL,
  `is_verified` enum('pending','verified','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `kode_type` varchar(120) NOT NULL,
  `merk` varchar(120) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `kode_type`, `merk`, `no_plat`, `warna`, `tahun`, `harga`, `status`, `gambar`) VALUES
(6, 'SDN', 'Avanza', 'W 4 HYU', 'Merah', '2020', '300000.00', '0', 'Galeri_Gambar_Mobil_Avanza_2020-54.png'),
(9, 'SUV', 'Toyota Fortuner', 'B 1234 TUF', 'Putih', '2022', '850000.00', '0', 'fortuner.png'),
(10, 'SUV', 'Honda CRV', 'B 5678 HCV', 'Putih', '2021', '780000.00', '1', 'crv.png\r\n'),
(11, 'SUV', 'Mitsubishi Pajero', 'B 9012 MPJ', 'Abu-Abu', '2023', '950000.00', '0', 'pajero.png\r\n'),
(13, 'MPV', 'Toyota Innova', 'D 3344 INV', 'Hitam', '2022', '550000.00', '1', 'innova.png\r\n'),
(14, 'MPV', 'Mitsubishi Xpander', 'D 5566 XPD', 'Putih', '2021', '450000.00', '0', 'xpander.png\r\n'),
(15, 'SDN', 'Honda Civic', 'F 7788 HCV', 'Putih', '2022', '700000.00', '1', 'civic.png\r\n'),
(16, 'SDN', 'Toyota Camry', 'F 9900 TCM', 'Hitam', '2023', '950000.00', '1', 'camry.png\r\n'),
(17, 'SDN', 'BMW 320i', 'F 2233 BMW', 'Putih', '2021', '1200000.00', '0', 'bmw.png'),
(18, 'CITY', 'Honda Brio', 'A 4455 HBR', 'Kuning', '2020', '300000.00', '1', 'brio.png'),
(19, 'CITY', 'Toyota Agya', 'A 6677 TAG', 'Merah', '2021', '280000.00', '1', 'agya.png'),
(20, 'CITY', 'Daihatsu Ayla', 'A 8899 DAY', 'Merah', '2019', '250000.00', '0', 'ayla.png'),
(21, 'PREMIUM', 'Mercedes Benz C200', 'B 1111 MBC', 'Putih', '2023', '2500000.00', '1', 'mercedes.png'),
(22, 'PREMIUM', 'BMW 520i', 'B 2222 BMW', 'Hitam', '2022', '2700000.00', '1', 'bmw55.png'),
(23, 'PREMIUM', 'Toyota Alphard', 'B 3333 ALP', 'Hitam', '2024', '3000000.00', '0', 'alphard.png\r\n'),
(24, 'TRUK', 'Mitsubishi Colt Diesel', 'L 4444 MCD', 'Kuning', '2020', '800000.00', '1', 'truk.png'),
(25, 'TRUK', 'Hino Dutro', 'L 5555 HND', 'Hijau', '2021', '950000.00', '1', 'hino.png'),
(26, 'TRUK', 'Isuzu Elf Box', 'L 6666 IEB', 'Putih', '2022', '1100000.00', '0', 'ISUZU.png'),
(27, 'MINIBUS', 'Toyota Hiace', 'N 7777 THC', 'Putih', '2023', '1500000.00', '1', 'hiace.png'),
(28, 'MINIBUS', 'Isuzu Elf', 'N 8888 IEL', 'Silver', '2021', '1300000.00', '1', 'elf.png'),
(29, 'MINIBUS', 'Hyundai H1', 'N 9999 HH1', 'Silver', '2022', '1700000.00', '0', 'hyundai.png');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id_rental` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tanggal_rental` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_rental` varchar(100) NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id_supir` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id_supir`, `nama`, `no_telepon`, `alamat`, `foto`, `status`) VALUES
(1, 'Iqbal Rifqiyadi', '089645678765', 'Perum 1', 'ayla1.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_rental` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tanggal_rental` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL,
  `status_rental` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `kode_type` varchar(50) NOT NULL,
  `nama_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`) VALUES
(1, 'SDN', 'Sedan\r\n'),
(2, 'SUV', 'Sport Utility Vehicle'),
(3, 'MPV', 'Multi Purpose Vehicle'),
(4, 'CITY', 'City Car'),
(5, 'PREMIUM', 'Premium'),
(6, 'TRUK', 'Pick-Up'),
(7, 'MINIBUS', 'Minibus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `status` enum('aktif','nonaktif','pending') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `no_hp`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Fajar Raihandhika', 'admin@cafe.com', '0895337154300', '$2y$10$Ow0rh740j0uWEybJQsKGoOKqyVL.FvNRRLyaQeWpFjU9QCx2aP2G6', 'admin', '', '2026-05-20 01:03:10'),
(2, 'Fajar Raihandhika_18', 'fajar.raihandhika123@gmail.com', '0895337154300', '$2y$10$xK6oaxXMgT/INl3RXN5jueFLt38NHfPyp.P.CCE/nn9fG7/bDN2aG', 'customer', '', '2026-05-20 13:23:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supir`
--
ALTER TABLE `supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
