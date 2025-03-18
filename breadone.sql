-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Mar 2025 pada 15.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `breadone`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bo-category`
--

CREATE TABLE `bo-category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bo-category`
--

INSERT INTO `bo-category` (`id_category`, `name_category`) VALUES
(1, 'Mini'),
(2, 'large');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bo-customer`
--

CREATE TABLE `bo-customer` (
  `id_customer` int(11) NOT NULL,
  `name_customer` varchar(50) NOT NULL,
  `password_customer` varchar(255) NOT NULL,
  `image_customer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bo-customer`
--

INSERT INTO `bo-customer` (`id_customer`, `name_customer`, `password_customer`, `image_customer`) VALUES
(4, 'helmy', '$2y$10$aki9H.2HpxMtJlpIiRuadOv849ztnb2pJfjRNI17VRBFwfcI.ieye', 'default.jpg'),
(5, 'helm', '$2y$10$zED8aSbf6O8nzVQlZ6aJAenDPcycNK2rvE2uYKP9gNMWO8cgAJCj6', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bo-product`
--

CREATE TABLE `bo-product` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `description_product` text DEFAULT NULL,
  `price_product` int(10) NOT NULL,
  `image_product` varchar(255) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bo-product`
--

INSERT INTO `bo-product` (`id_product`, `name_product`, `description_product`, `price_product`, `image_product`, `id_category`) VALUES
(1, 'Kismis 3 Isi', 'Cara Pembuatan', 15000, '', 1),
(19, 'Roti Bread One', 'Bread one merupakan Roti Terbaik di kota balige untuk saat ini.', 75000, 'roti.jpg', 2),
(20, 'Kismis', 'Cara Pembuatan', 15000, 'roti.jpg', 2),
(42, 'Roti Bread Two', 'Cara Pembuatan', 15000, '67d531613e68e.png', 1),
(43, 'Roti bakar isi bebek', 'Cara Pembuatan', 21313213, '67d7c78a4e3e5.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bo-category`
--
ALTER TABLE `bo-category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `bo-customer`
--
ALTER TABLE `bo-customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `bo-product`
--
ALTER TABLE `bo-product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_product_category` (`id_category`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bo-category`
--
ALTER TABLE `bo-category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `bo-customer`
--
ALTER TABLE `bo-customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `bo-product`
--
ALTER TABLE `bo-product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bo-product`
--
ALTER TABLE `bo-product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`id_category`) REFERENCES `bo-category` (`id_category`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
