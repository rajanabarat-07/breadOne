-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 04:50 AM
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
-- Database: `breadone`
--

-- --------------------------------------------------------

--
-- Table structure for table `bo-admin`
--

CREATE TABLE `bo-admin` (
  `id_admin` int(11) NOT NULL,
  `name_admin` varchar(50) NOT NULL,
  `password_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-admin`
--

INSERT INTO `bo-admin` (`id_admin`, `name_admin`, `password_admin`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bo-bom`
--

CREATE TABLE `bo-bom` (
  `id_bom` varchar(11) NOT NULL,
  `id_ingredient` varchar(11) NOT NULL,
  `id_product` varchar(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `require_ingredient` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-bom`
--

INSERT INTO `bo-bom` (`id_bom`, `id_ingredient`, `id_product`, `name_product`, `require_ingredient`) VALUES
('BOM0001', 'I0001', 'P0001', 'Bolu Petak Pandan Keju Ceres', '4'),
('BOM0001', 'I0002', 'P0001', 'Bolu Petak Pandan Keju Ceres', '150'),
('BOM0001', 'I0003', 'P0001', 'Bolu Petak Pandan Keju Ceres', '125'),
('BOM0001', 'I0004', 'P0001', 'Bolu Petak Pandan Keju Ceres', '100'),
('BOM0001', 'I0005', 'P0001', 'Bolu Petak Pandan Keju Ceres', '75'),
('BOM0001', 'I0006', 'P0001', 'Bolu Petak Pandan Keju Ceres', '5'),
('BOM0001', 'I0007', 'P0001', 'Bolu Petak Pandan Keju Ceres', '50'),
('BOM0001', 'I0008', 'P0001', 'Bolu Petak Pandan Keju Ceres', '50'),
('BOM0001', 'I0009', 'P0001', 'Bolu Petak Pandan Keju Ceres', '5'),
('BOM0002', 'I0001', 'P0002', 'Cake BF Coklat Siram Valentine Edition', '6'),
('BOM0002', 'I0002', 'P0002', 'Cake BF Coklat Siram Valentine Edition', '150'),
('BOM0002', 'I0003', 'P0002', 'Cake BF Coklat Siram Valentine Edition', '100'),
('BOM0002', 'I0010', 'P0002', 'Cake BF Coklat Siram Valentine Edition', '30'),
('BOM0002', 'I0009', 'P0002', 'Cake BF Coklat Siram Valentine Edition', '5'),
('BOM0002', 'I0011', 'P0002', 'Cake BF Coklat Siram Valentine Edition', '250'),
('BOM0002', 'I0012', 'P0002', 'Cake BF Coklat Siram Valentine Edition', '100'),
('BOM0003', 'I0001', 'P0003', 'Cup Cake', '2'),
('BOM0003', 'I0002', 'P0003', 'Cup Cake', '100'),
('BOM0003', 'I0003', 'P0003', 'Cup Cake', '100'),
('BOM0003', 'I0013', 'P0003', 'Cup Cake', '75'),
('BOM0003', 'I0014', 'P0003', 'Cup Cake', '50'),
('BOM0003', 'I0009', 'P0003', 'Cup Cake', '5'),
('BOM0003', 'I0015', 'P0003', 'Cup Cake', '5'),
('BOM0004', 'I0003', 'P0004', 'Milk Bun', '300'),
('BOM0004', 'I0014', 'P0004', 'Milk Bun', '150'),
('BOM0004', 'I0016', 'P0004', 'Milk Bun', '5'),
('BOM0004', 'I0002', 'P0004', 'Milk Bun', '40'),
('BOM0004', 'I0001', 'P0004', 'Milk Bun', '1'),
('BOM0004', 'I0013', 'P0004', 'Milk Bun', '40'),
('BOM0004', 'I0005', 'P0004', 'Milk Bun', '5'),
('BOM0005', 'I0003', 'P0005', 'Roti Jala Keju', '150'),
('BOM0005', 'I0001', 'P0005', 'Roti Jala Keju', '1'),
('BOM0005', 'I0014', 'P0005', 'Roti Jala Keju', '250'),
('BOM0005', 'I0007', 'P0005', 'Roti Jala Keju', '50'),
('BOM0005', 'I0017', 'P0005', 'Roti Jala Keju', '9'),
('BOM0005', 'I0005', 'P0005', 'Roti Jala Keju', '6'),
('BOM0005', 'I0013', 'P0005', 'Roti Jala Keju', '10');

-- --------------------------------------------------------

--
-- Table structure for table `bo-cart`
--

CREATE TABLE `bo-cart` (
  `id_cart` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_product` varchar(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `qty_cart` int(11) NOT NULL,
  `price_cart` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bo-category`
--

CREATE TABLE `bo-category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-category`
--

INSERT INTO `bo-category` (`id_category`, `name_category`) VALUES
(7, 'Roti Mini'),
(9, 'Kue Ulang Tahun'),
(10, 'Kue Bolu'),
(11, 'Dessert'),
(12, 'Pudding'),
(13, 'Cup Cake'),
(14, 'Donat'),
(15, 'Milk Bun');

-- --------------------------------------------------------

--
-- Table structure for table `bo-customer`
--

CREATE TABLE `bo-customer` (
  `id_customer` int(11) NOT NULL,
  `name_customer` varchar(50) NOT NULL,
  `password_customer` varchar(255) NOT NULL,
  `image_customer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-customer`
--

INSERT INTO `bo-customer` (`id_customer`, `name_customer`, `password_customer`, `image_customer`) VALUES
(11, 'customer setia', '$2y$10$gHzJhVVusrOQPhBgzHcdF.awKavDokRQOcr/BohmdmKMvMfDe4nFK', '67f384e9a5579.jpg'),
(12, 'customer', '$2y$10$bcb1yf1sTA0mHB83akrWV.wEDmnuWBuYsjFVNMIzNecQV0MJssrwW', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bo-income`
--

CREATE TABLE `bo-income` (
  `invoice` varchar(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date_income` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-income`
--

INSERT INTO `bo-income` (`invoice`, `total_price`, `date_income`) VALUES
('INV0001', 35000, '2025-04-08 22:47:25'),
('INV0002', 432000, '2025-04-09 05:27:41'),
('INV0004', 58000, '2025-04-09 07:55:38'),
('INV0006', 77000, '2025-04-14 08:17:12'),
('INV0006', 70000, '2025-04-14 08:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `bo-ingredient`
--

CREATE TABLE `bo-ingredient` (
  `id_ingredient` varchar(100) NOT NULL,
  `name_ingredient` varchar(200) NOT NULL,
  `qty_ingredient` varchar(10) NOT NULL,
  `unit_ingredient` varchar(10) NOT NULL,
  `price_ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-ingredient`
--

INSERT INTO `bo-ingredient` (`id_ingredient`, `name_ingredient`, `qty_ingredient`, `unit_ingredient`, `price_ingredient`) VALUES
('I0001', 'Telur Ayam', '953', 'Butir', 2000),
('I0002', 'Gula Pasir', '1000', 'gr', 5000),
('I0003', 'Tepung Terigu', '100000', 'gr', 5000),
('I0004', 'Santan Cair', '900', 'ml', 5000),
('I0005', 'Minyak Sayur', '821', 'ml', 2000),
('I0006', 'Pasta Pandan', '995', 'ml', 1000),
('I0007', 'Keju Parut', '500', 'gr', 14000),
('I0008', 'Ceres', '950', 'gr', 5000),
('I0009', 'Baking Powder', '935', 'ml', 10000),
('I0010', 'Coklat Bubuk', '1000', 'gr', 15000),
('I0011', 'Dark cooking chocolate', '1000', 'gr', 20000),
('I0012', 'Whipping cream cair', '1000', 'ml', 15000),
('I0013', 'Mentega', '10000', 'gr', 15000),
('I0014', 'Susu Cair', '10000', 'ml', 10000),
('I0015', 'Vanilla Extract', '940', 'ml', 15000),
('I0016', 'Ragi', '950', 'gr', 16000),
('I0017', 'Garam', '919', 'g', 500);

-- --------------------------------------------------------

--
-- Table structure for table `bo-order`
--

CREATE TABLE `bo-order` (
  `id_order` int(11) NOT NULL,
  `invoice` varchar(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_product` varchar(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `qty_cart` int(11) NOT NULL,
  `price_cart` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_cart` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-order`
--

INSERT INTO `bo-order` (`id_order`, `invoice`, `id_customer`, `id_product`, `name_product`, `qty_cart`, `price_cart`, `status`, `date_cart`) VALUES
(37, 'INV0001', 12, 'P0005', 'Roti Jala Keju', 5, 7000, 'Pesanan Telah Diambil', '2025-04-08 22:47:25'),
(38, 'INV0002', 12, 'P0001', 'Bolu Petak Pandan Keju Ceres', 1, 52000, 'Pesanan Telah Diambil', '2025-04-09 05:27:41'),
(39, 'INV0002', 12, 'P0003', 'Cup Cake', 10, 15000, 'Pesanan Telah Diambil', '2025-04-09 05:27:41'),
(40, 'INV0002', 12, 'P0004', 'Milk Bun', 10, 23000, 'Pesanan Telah Diambil', '2025-04-09 05:27:41'),
(41, 'INV0003', 11, 'P0003', 'Cup Cake', 1, 15000, 'Pesanan Ditolak', '2025-04-09 07:38:31'),
(42, 'INV0003', 11, 'P0001', 'Bolu Petak Pandan Keju Ceres', 1, 52000, 'Pesanan Ditolak', '2025-04-09 07:38:31'),
(43, 'INV0004', 11, 'P0005', 'Roti Jala Keju', 4, 7000, 'Pesanan Telah Diambil', '2025-04-09 07:55:38'),
(44, 'INV0004', 11, 'P0003', 'Cup Cake', 2, 15000, 'Pesanan Telah Diambil', '2025-04-09 07:55:38'),
(45, 'INV0005', 12, 'P0001', 'Bolu Petak Pandan Keju Ceres', 500000, 52000, 'Pesanan Ditolak', '2025-04-09 14:33:35'),
(48, 'INV0006', 12, 'P0005', 'Roti Jala Keju', 10, 7000, 'Menunggu Pembayaran', '2025-04-14 08:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `bo-product`
--

CREATE TABLE `bo-product` (
  `id_product` varchar(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `price_product` int(10) NOT NULL,
  `image_product` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  `stock_product` int(10) NOT NULL,
  `life_product` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-product`
--

INSERT INTO `bo-product` (`id_product`, `name_product`, `price_product`, `image_product`, `id_category`, `stock_product`, `life_product`) VALUES
('P0001', 'Bolu Petak Pandan Keju Ceres', 52000, '67f5301de92ba.jpg', 10, 20, 7),
('P0002', 'Cake BF Coklat Siram Valentine Edition', 150000, '67f532cea8c6e.jpg', 9, 20, 7),
('P0003', 'Cup Cake', 15000, '67f533ee56efc.jpg', 13, 20, 3),
('P0004', 'Milk Bun', 23000, '67f534da8d81e.jpg', 15, 20, 3),
('P0005', 'Roti Jala Keju', 7000, '67f5441630787.jpg', 7, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bo-production`
--

CREATE TABLE `bo-production` (
  `id_log` int(11) NOT NULL,
  `id_product` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_production` date NOT NULL,
  `date_expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-production`
--

INSERT INTO `bo-production` (`id_log`, `id_product`, `quantity`, `date_production`, `date_expired`) VALUES
(7, 'P0001', 20, '2025-04-14', '2025-04-21'),
(8, 'P0002', 20, '2025-04-14', '2025-04-21'),
(9, 'P0003', 20, '2025-04-14', '2025-04-17'),
(10, 'P0004', 20, '2025-04-14', '2025-04-17'),
(11, 'P0005', 20, '2025-04-14', '2025-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `bo-step`
--

CREATE TABLE `bo-step` (
  `id_product` varchar(11) NOT NULL,
  `step_number` int(11) NOT NULL,
  `step_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bo-step`
--

INSERT INTO `bo-step` (`id_product`, `step_number`, `step_description`) VALUES
('P0001', 1, 'Panaskan oven pada suhu 170°C.'),
('P0001', 2, 'Kocok telur dan gula dengan mixer kecepatan tinggi hingga mengembang dan putih.'),
('P0001', 3, 'Masukkan tepung terigu dan baking powder, aduk rata dengan spatula.'),
('P0001', 4, 'Tambahkan santan, minyak sayur, dan pasta pandan, aduk rata perlahan.'),
('P0001', 5, 'Tuang adonan ke loyang petak yang sudah diolesi minyak atau dialasi baking paper.'),
('P0001', 6, 'Taburkan keju parut dan ceres di atasnya.'),
('P0001', 7, 'Panggang selama 30–35 menit atau hingga matang (tes tusuk).'),
('P0001', 8, 'Dinginkan sebelum dipotong dan disajikan.'),
('P0002', 1, 'Panaskan oven pada suhu 170°C.'),
('P0002', 2, 'Kocok telur dan gula hingga mengembang, kental dan pucat.'),
('P0002', 3, 'Ayak tepung terigu, coklat bubuk, dan baking powder, lalu masukkan ke adonan, aduk rata.'),
('P0002', 4, 'Tambahkan coklat leleh dan minyak sayur, aduk perlahan hingga tercampur rata.'),
('P0002', 5, 'Tuang ke loyang bulat diameter ±20 cm yang sudah diolesi minyak dan dialasi baking paper.'),
('P0002', 6, 'Panggang selama 35–40 menit atau hingga matang.'),
('P0002', 7, 'Panaskan whipping cream hingga hampir mendidih, lalu tuang ke potongan coklat, diamkan 1 menit.'),
('P0002', 8, 'Aduk hingga coklat meleleh dan menjadi ganache lembut.'),
('P0002', 9, 'Setelah cake dingin, siram dengan ganache dan ratakan permukaan.'),
('P0002', 10, 'Hias sesuai tema Valentine (contoh: dengan stroberi, taburan pink, coklat bentuk hati).'),
('P0003', 1, 'Panaskan oven ke suhu 170°C. Siapkan loyang muffin dan beri cup kertas.'),
('P0003', 2, 'Kocok telur dan gula hingga mengembang dan pucat.'),
('P0003', 3, 'Masukkan tepung dan baking powder yang sudah diayak, aduk perlahan.'),
('P0003', 4, 'Tambahkan susu cair, mentega leleh, dan vanilla extract, aduk rata.'),
('P0003', 5, 'Tuang adonan ke dalam cup, isi sekitar ¾ tinggi cup.'),
('P0003', 6, 'Panggang selama 20–25 menit atau hingga matang.'),
('P0003', 7, 'Dinginkan, lalu hias dengan topping sesuai selera.'),
('P0004', 1, 'Campurkan susu hangat, ragi, dan sedikit gula, aduk, diamkan 10 menit hingga berbuih.'),
('P0004', 2, 'Dalam mangkuk besar, campur tepung, sisa gula, dan garam.'),
('P0004', 3, 'Tambahkan telur dan campuran susu-ragi, uleni hingga setengah kalis.'),
('P0004', 4, 'Masukkan mentega, uleni lagi hingga adonan kalis dan elastis (±15 menit).'),
('P0004', 5, 'Diamkan adonan 1 jam hingga mengembang 2x lipat.'),
('P0004', 6, 'Kempiskan adonan, bagi menjadi 8–10 bagian, bulatkan.'),
('P0004', 7, 'Tata di loyang, diamkan lagi 30 menit untuk proofing kedua.'),
('P0004', 8, 'Panggang di oven suhu 180°C selama 20–25 menit sampai kecoklatan.'),
('P0004', 9, 'Setelah matang, olesi permukaan dengan mentega cair agar mengkilap dan lembut.'),
('P0005', 1, 'Campurkan tepung, telur, garam, dan susu cair. Aduk rata sampai tidak ada yang menggumpal.'),
('P0005', 2, 'Tambahkan minyak sayur dan keju parut, aduk kembali hingga tercampur.'),
('P0005', 3, 'Saring adonan agar lebih halus.'),
('P0005', 4, 'Masukkan adonan ke dalam botol saus berlubang kecil atau cetakan roti jala.'),
('P0005', 5, 'Panaskan pan anti lengket, olesi sedikit mentega.'),
('P0005', 6, 'Buat pola jala di atas pan menggunakan botol/cetakan tadi.'),
('P0005', 7, 'Masak dengan api kecil sampai matang (±1 menit), tidak perlu dibalik.'),
('P0005', 8, 'Angkat, lipat atau gulung sesuai selera, sajikan hangat.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bo-admin`
--
ALTER TABLE `bo-admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bo-bom`
--
ALTER TABLE `bo-bom`
  ADD KEY `id_ingredient` (`id_ingredient`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `bo-cart`
--
ALTER TABLE `bo-cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `bo-category`
--
ALTER TABLE `bo-category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `bo-customer`
--
ALTER TABLE `bo-customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `bo-ingredient`
--
ALTER TABLE `bo-ingredient`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Indexes for table `bo-order`
--
ALTER TABLE `bo-order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `bo-product`
--
ALTER TABLE `bo-product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_product_category` (`id_category`);

--
-- Indexes for table `bo-production`
--
ALTER TABLE `bo-production`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `bo-step`
--
ALTER TABLE `bo-step`
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bo-admin`
--
ALTER TABLE `bo-admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bo-cart`
--
ALTER TABLE `bo-cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `bo-category`
--
ALTER TABLE `bo-category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bo-customer`
--
ALTER TABLE `bo-customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bo-order`
--
ALTER TABLE `bo-order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `bo-production`
--
ALTER TABLE `bo-production`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bo-bom`
--
ALTER TABLE `bo-bom`
  ADD CONSTRAINT `bo-bom_ibfk_1` FOREIGN KEY (`id_ingredient`) REFERENCES `bo-ingredient` (`id_ingredient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bo-bom_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `bo-product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bo-cart`
--
ALTER TABLE `bo-cart`
  ADD CONSTRAINT `bo-cart_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `bo-customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bo-cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `bo-product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bo-order`
--
ALTER TABLE `bo-order`
  ADD CONSTRAINT `bo-order_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `bo-customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bo-order_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `bo-product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bo-product`
--
ALTER TABLE `bo-product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`id_category`) REFERENCES `bo-category` (`id_category`) ON DELETE CASCADE;

--
-- Constraints for table `bo-production`
--
ALTER TABLE `bo-production`
  ADD CONSTRAINT `bo-production_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `bo-product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bo-step`
--
ALTER TABLE `bo-step`
  ADD CONSTRAINT `bo-step_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `bo-product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
