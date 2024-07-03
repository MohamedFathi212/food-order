-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2024 at 12:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int UNSIGNED NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(19, 'sondos khaled', 'sondos25', '143669d416b2e27be591983881d06451'),
(20, 'Hadeel Khaked', 'Hadeel145', '42d31dbb9ed1a596994b7b8316434652'),
(21, 'bataol khaled ', 'batool456', '1a7860e2951a0394b0d268cfa393f205'),
(22, 'Ali Fathy', ' ALId698', 'c8fb3baebac9466d33f22042698425d5'),
(23, 'Mohamed Ahmed', 'MohamedFathi22', 'c73577517a644f21b6c9a0949714a72e'),
(24, 'osam ahmed', 'osam14', 'e10adc3949ba59abbe56e057f20f883e'),
(25, 'haidy Ali', 'Hady412', '8115e7c229e0b9a0160e8ccacc0efbb2'),
(26, 'gaber hassan', 'gaber12', 'e10adc3949ba59abbe56e057f20f883e'),
(27, 'admin', 'admin', 'e82c4b19b8151ddc25d4d93baf7b908f');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(6, 'Memo-menu', 'Category_622.jpg', 'Yes', 'Yes'),
(9, 'Pizza', 'Pizza.jpg', 'No', 'Yes'),
(14, 'menu-burger', 'Category_569.jpg', 'Yes', 'Yes'),
(15, 'Burger', 'burger.jpg', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(4, 'Best Burger', 'Burger with Ham, Pineapple and lots of cheese.', 4.00, 'Food_Name_212.jpg', 14, 'Yes', 'Yes'),
(5, 'Sadeko Momo', 'Best Spicy Momo Winter', 6.00, 'Food_Name_971.jpg', 16, 'Yes', 'Yes'),
(6, 'Smoky BBQ Specials', 'Best Firewood Pizza in Town', 5.00, 'menu-pizza.jpg', 9, 'Yes', 'Yes'),
(7, 'Dumplings Specials', 'Chicken Dumping with herps from Mountains  ', 5.00, 'menu-momo.jpg', 6, 'yes', 'yes'),
(8, 'Mixed Pizza', 'Pizza with Chicken, Ham,Buff,Mushroom and Vegetables', 10.00, 'menu-pizza.jpg', 9, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int UNSIGNED NOT NULL,
  `food` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_contact` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(2, 'Best Burger', 4.00, 3, '12', '2024-07-01 22:59:51', 'Ordered', 'Ahmed Fathi', '0104562378', 'mohamed34@gmail.com', 'Almakarataa ,Zagazig,Cairo'),
(4, 'Best Burger', 4.00, 1, '4', '2024-07-02 00:29:19', 'Ordered', 'Hadeel Khaled', '01142796590', 'hadeelkha@gmail.com', 'ALtawheed,Zagazig,Cairo.'),
(5, 'Sadeko Momo', 6.00, 5, '30', '2024-07-02 00:41:06', 'Cancelled', 'Mennaa Ahmed ', '01030880645', 'mennaahme@gmail.com', 'Almatraiddd,zagazigg,egyppt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
