-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 07:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `email`, `phone`, `image`, `product`, `price`, `quantity`, `total`, `added_at`) VALUES
(13, 5, 'dev', 'dev12@gmailcom', '9898811311', 'dabur_almond.jpg', 'Dabur Almond Hair Oil', 199.00, 1, 199.00, '2025-09-04 15:46:07'),
(15, 21, 'Komal', 'komalzala002@gmail.com', '9898811311', 'https://i.pinimg.com/736x/54/34/ef/5434efc685bbef1fdba1a3577a2e9d03.jpg', 'Clinicplus', 1.00, 1, 1.00, '2025-09-06 14:47:09'),
(16, 35, 'Komal', 'dev@gmail.com', '9898811311', 'https://i.pinimg.com/1200x/c9/5c/c6/c95cc6ed7b2267f94896c58def0bd715.jpg', 'Close-up', 122.00, 8, 976.00, '2025-09-25 17:47:34'),
(17, 36, 'komal', '', '', 'https://i.pinimg.com/1200x/c9/5c/c6/c95cc6ed7b2267f94896c58def0bd715.jpg', 'Close-up', 122.00, 1, 122.00, '2025-10-10 10:53:56'),
(18, 36, 'komal', '', '', 'https://i.pinimg.com/1200x/c9/5c/c6/c95cc6ed7b2267f94896c58def0bd715.jpg', 'Close-up', 122.00, 1, 122.00, '2025-10-10 10:54:02'),
(19, 37, 'Komal', 'fg@gmail.com', '9898811311', 'https://www.daburshop.com/cdn/shop/files/0_c044c80d-ea9d-4cea-bae7-8dc6ad64f4c4_380x380.png?v=1748334732', 'Dabur', 470.00, 7, 3290.00, '2025-10-10 10:55:04'),
(20, 41, 'DEV', 'dev0023@gmail.com', '9898811311', 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcSnMD5NReZ-hXza--eaND5tPveCgRcJE8k4MiK0mtz-drW4VK5bpQkbU1Y7OQS80GnLtbZH50pnhlsN9mX8IPLMFZxc05b3YDu-KajwCdvhxZ7U19C1KJTx', 'Pond\'s Niacinamide Lotion', 300.00, 4, 1200.00, '2025-10-12 16:29:51'),
(21, 48, 'rrr', 'rr@gmail.com', '8745236242', 'https://i.pinimg.com/1200x/c9/5c/c6/c95cc6ed7b2267f94896c58def0bd715.jpg', 'Close-up', 122.00, 4, 488.00, '2025-10-14 08:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT 'noimage.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `name`, `image`, `created_at`) VALUES
(2, 'Personal care products', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyuVfHN3VT6sYnhLq4mkavVFVfCWj3vlWgKiUZvD0Q19Z-yy7Q3bFXgkcavaslnIt0VuQ&usqp=CAU', '2025-09-18 13:24:40'),
(3, 'Grains', 'https://i.pinimg.com/1200x/3c/4a/bc/3c4abcfdcc900c070448e68a91f406bd.jpg', '2025-09-18 13:27:27'),
(6, 'Flour', 'https://i.pinimg.com/736x/0a/c8/d5/0ac8d55b69743370bf5b27829ae37c23.jpg', '2025-09-18 13:35:07'),
(8, 'Vagitable', 'https://previews.123rf.com/images/marialapina/marialapina1303/marialapina130300057/18512156-sack-of-potatoes-with-onion-and-garlic.jpg', '2025-09-18 13:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_reviews`
--

INSERT INTO `customer_reviews` (`id`, `name`, `rating`, `comment`, `submitted_at`) VALUES
(4, 'Komal', 5, 'good', '2025-09-03 14:17:36'),
(5, 'dev', 5, 'GOOD', '2025-09-25 17:44:21'),
(6, 'bggggggggggggggggggg', 3, 'bogassssss', '2025-10-11 00:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `phone`, `email`, `password`) VALUES
(21, 'Komal', '9898811311', 'komalzala002@gmail.com', '123'),
(22, 'Komal', '9898811311', 'premzala11111@gmail.com', '123'),
(23, 'Komal', '8320604925', 'premzala11111@gmail.com', '123'),
(24, 'Komal', '9898811311', 'premzala11111@gmail.com', '123'),
(31, 'Komal', '8320604925', 'zalakomal@gmail.com', '123'),
(32, 'dev', '9427494735', '2007dev@gmail.com', '14'),
(33, 'Komal', '9898811311', 'lzala002@gmail.com', '123'),
(34, 'raj', '9427494735', 'raj002@gmail.com', '12345'),
(35, 'Komal', '9898811311', 'dev@gmail.com', '123'),
(36, 'komal', '', '', 'admin'),
(37, 'Komal', '9898811311', 'fg@gmail.com', '123'),
(38, 'ram', '9427494735', 'ram@gmail.com', '456'),
(39, 'ram', '9427494735', 'ram3@gmail.com', '890'),
(40, 'amrita ramparia', '8160943330', 'amritaramparia@gmail.com', '3123456'),
(41, 'DEV', '9898811311', 'dev0023@gmail.com', '1234'),
(42, 'sita', '9427494735', 'sita002@gmail.com', '12345678'),
(43, 'rekha', '9898811321', 'rekha002@gmial.com', '$2y$10$c5ajG0MpRRhEHVsES4d37.uhuZvvYilvEpB2LuA0OGjjAvTWwXIXO'),
(44, 'ramji', '8745236242', 'rem123@gmail.com', '111'),
(45, 'ramji', '9898811311', 'ramji22@gmail.com', '111'),
(46, 'abc', '9427494735', 'abc00@gmail.com', 'aaa'),
(47, 'bcd', '9898811311', 'bcd00@gmail.com', 'bbb'),
(48, 'rrr', '8745236242', 'rr@gmail.com', 'rrr'),
(49, 'komalzala', '9898811311', 'kz@gmail.com', 'kz');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `product` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_type` enum('Online','COD') NOT NULL,
  `delivery_type` enum('Home Delivery','Shop Pickup') NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `image`, `product`, `price`, `quantity`, `total`, `payment_type`, `delivery_type`, `order_date`) VALUES
(2, 'Komal', '8745236242', 'vsdbgdngf b', 'hs_antidandruff.jpg', 'Head-Shoulder(Antidandruff)', 109.00, 1, 109.00, 'Online', 'Shop Pickup', '2025-08-27 05:31:32'),
(3, '°C-Map', '8745236242', 'asdf', 'https://www.bbassets.com/media/uploads/p/xl/40132873_2-parachute-pure-coconut-oil.jpg', 'Parachute Coconut Oil', 350.00, 1, 350.00, 'Online', 'Shop Pickup', '2025-08-27 07:11:06'),
(4, 'Komal', '8320604925', 'XYZ', 'dove_sope.jpg', 'LUX Soft Glow Rose & Vitamin E Soap-150g', 30.00, 6, 180.00, 'Online', 'Shop Pickup', '2025-09-04 15:21:31'),
(5, 'dev', '9427494735', 'ABC', 'https://ik.imagekit.io/wlfr/wellness/images/products/209567-1.jpg/tr:w-3840,c-at_max,cm-pad_resize,ar-1210-700,pr-true,f-auto,q-70,l-image,i-Wellness_logo_BDwqbQao9.png,lfo-bottom_right,w-200,h-90,c-at_least,cm-pad_resize,l-end', 'Parachute Coconut Oil', 65.00, 7, 455.00, 'COD', 'Home Delivery', '2025-09-04 16:33:03'),
(6, 'Komal', '8320604925', 'aaaaa', 'https://i.pinimg.com/736x/54/34/ef/5434efc685bbef1fdba1a3577a2e9d03.jpg', 'Clinicplus', 1.00, 1, 1.00, 'COD', 'Shop Pickup', '2025-09-22 16:07:01'),
(7, 'dev zala', '8849988420', 'you know my address', 'https://i.pinimg.com/736x/79/09/d5/7909d5d066104b65812fc45b8e423991.jpg', 'Clinicplus', 460.00, 1000, 460000.00, 'COD', 'Home Delivery', '2025-09-23 13:11:47'),
(8, 'krishna', '9726808447', 'yyyyyyyyyyyy', 'https://i.pinimg.com/736x/82/98/29/82982946873fb75e63a6e8d46a72af0f.jpg', 'Dabur', 194.00, 3, 582.00, 'Online', 'Shop Pickup', '2025-09-25 17:21:53'),
(9, 'Komal', '9898811311', 'QQQQQQQQQQQQQ', 'https://m.media-amazon.com/images/I/41eVP4nEwFL.jpg', 'Dove shampoo and conditioner pouch', 8.00, 6, 48.00, 'COD', 'Shop Pickup', '2025-09-25 17:46:03'),
(10, 'amrita ramparia', '9427494735', 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'https://i.pinimg.com/1200x/ad/bc/f3/adbcf37cef52cd7263e9c4f8b84f22b0.jpg', 'Sunsilk-Pink', 250.00, 1, 250.00, 'Online', 'Shop Pickup', '2025-10-11 00:38:46'),
(11, 'rrr', '8745236242', 'sfbgfbgrbrbrbfrbb', 'https://i.pinimg.com/1200x/c9/5c/c6/c95cc6ed7b2267f94896c58def0bd715.jpg', 'Close-up', 122.00, 4, 488.00, 'Online', 'Home Delivery', '2025-10-14 08:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT 'noimage.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `subcategory_id`, `name`, `description`, `image`, `created_at`) VALUES
(3, 3, 'Clinicplus', '', 'https://i.pinimg.com/736x/e9/be/67/e9be6742f0109a599d1d13e4745ca147.jpg', '2025-09-18 13:58:00'),
(4, 3, 'sunsilk', '', 'https://i.pinimg.com/736x/db/e3/25/dbe325e499567c4693327c0b84603272.jpg', '2025-09-18 14:02:10'),
(5, 4, 'Colgate', '', 'https://i.pinimg.com/736x/c1/29/0d/c1290d1dbc7352217ad7e65ff5618e1a.jpg', '2025-09-18 14:17:28'),
(6, 4, 'Close-Up', '', 'https://i.pinimg.com/1200x/c9/5c/c6/c95cc6ed7b2267f94896c58def0bd715.jpg', '2025-09-18 14:18:24'),
(7, 4, 'Dabur', '', 'https://i.pinimg.com/736x/82/98/29/82982946873fb75e63a6e8d46a72af0f.jpg', '2025-09-18 14:19:06'),
(8, 3, 'Dove', '', 'https://i.pinimg.com/736x/1a/3c/41/1a3c41e5ef87bb602d429877faff767c.jpg', '2025-09-18 14:35:53'),
(9, 3, 'Head & Shoulders', '', 'https://i.pinimg.com/736x/5f/62/1f/5f621fb959e10f41d98b24a8565d3df4.jpg', '2025-09-18 14:37:22'),
(11, 3, 'Loreal shampoo', '', 'https://i.pinimg.com/1200x/1e/01/00/1e010024eae789db947b97f494322f40.jpg', '2025-10-01 14:42:36'),
(13, 3, 'Keshking shampoo', '', 'https://i.pinimg.com/736x/29/15/ec/2915ec76d6cd742cbede1dcfb8e3c25c.jpg', '2025-10-01 14:44:58'),
(14, 4, 'Sensodyne Toothpaste', 'Sensodyne Pronamel Gentle Whitening Toothpaste', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3m8fYWkMfoD8dTQP0G9vAr5XbCxqJFchJgQ&s', '2025-10-10 15:48:14'),
(15, 4, 'Himalaya Complete Care Toothpaste', '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUzuE0vPMX4WdIB_bOfU93LUjKPHW7jnWPoQ&s', '2025-10-10 15:53:05'),
(16, 5, 'vaseline body lotion', '', 'https://5.imimg.com/data5/ECOM/Default/2024/6/428091958/II/MZ/DU/85949022/51hdkqvnhtl-sl1000-500x500.jpg', '2025-10-10 16:27:25'),
(19, 5, 'POND\'S Body Lotion', '', 'https://m.media-amazon.com/images/I/4147sJ6IAAL._SY300_SX300_QL70_FMwebp_.jpg', '2025-10-10 21:55:01'),
(20, 5, 'Nivea Body Milk Nourishing Lotion', '', 'https://www.bbassets.com/media/uploads/p/l/40178947_12-nivea-body-lotion-for-very-dry-skin-with-2x-almond-oil-for-men-women.jpg', '2025-10-10 22:01:51'),
(21, 6, 'Dettol', '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSj9LSaDNcp8lIle2cCKddY2R5BSBEjTXIa-A&s', '2025-10-10 22:31:21'),
(24, 6, 'Lifebuoy', '', 'https://m.media-amazon.com/images/I/41p1v6sRZJL._SY300_SX300_QL70_FMwebp_.jpg', '2025-10-11 01:06:25'),
(25, 6, 'Santoor Skin Softening Soap', '', 'https://www.bigbasket.com/media/uploads/groot/images/1112023-e804d688-banner-5-3.jpg', '2025-10-11 01:11:58'),
(26, 6, 'Dove', '', 'https://www.bbassets.com/media/uploads/p/l/40019053_5-dove-cream-beauty-bathing-bar-soap.jpg', '2025-10-11 01:18:28'),
(27, 9, 'Wheat', 'Daily Good Mp Sharbati Wheat --- 1KG', 'https://i.pinimg.com/736x/df/d1/40/dfd14051f7e95ae20804d6ed9e6e74dd.jpg', '2025-10-11 07:54:15'),
(28, 10, 'Onion', 'Onion', 'https://i.pinimg.com/736x/f9/97/38/f99738883642acea3c800caff14d66f2.jpg', '2025-10-13 15:32:09'),
(29, 11, 'Garlic', '', 'https://i.pinimg.com/1200x/24/3b/fc/243bfc9a4c83fb56eff67b85f71cc66c.jpg', '2025-10-13 15:43:23'),
(30, 12, 'Potato', '', 'https://i.pinimg.com/736x/1a/f0/f4/1af0f44c36a75fff5e1d2beb447c1b8f.jpg', '2025-10-13 15:52:36'),
(31, 13, 'Rice', '', 'https://c.ndtvimg.com/2023-08/brlp7gk_uncooked-rice-or-rice-grains_625x300_18_August_23.jpg?im=FaceCrop,algorithm=dnn,width=545,height=307', '2025-10-14 13:47:11'),
(32, 14, 'Bajra', '', 'https://5.imimg.com/data5/SELLER/Default/2022/1/LM/WG/LM/140653739/indian-pearl-millet-bajra--500x500.jpg', '2025-10-14 13:48:54'),
(33, 15, 'Chole chana', '', 'https://5.imimg.com/data5/SELLER/Default/2024/9/454062212/AV/CM/LF/193081573/kabuli-chole-chana.png', '2025-10-14 13:50:21'),
(34, 16, 'Masoor Dal', '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjQ256iEcRpnytApp2nxdEe4u_61iJMh70nQ&s', '2025-10-14 13:50:44'),
(35, 17, 'Chana Dal', '', 'https://vibrantliving.in/cdn/shop/files/ChanaDalSplit.jpg?crop=center&height=1200&v=1731059251&width=1200', '2025-10-14 13:51:05'),
(36, 18, 'Wheat Flour', '', 'https://t4.ftcdn.net/jpg/01/20/00/55/360_F_120005524_K3y8Ku1CDDsDpQeZqFYgBksKmWDK0RcB.jpg', '2025-10-14 15:04:47'),
(37, 19, 'Bajri Flour', '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbhS8-QDEFRegpXIXmUrSp6b4ZxWfLQSQyJA&s', '2025-10-14 15:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` enum('Yes','No') DEFAULT 'Yes',
  `image` varchar(255) DEFAULT 'noimage.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `product_id`, `name`, `description`, `price`, `stock`, `image`, `created_at`) VALUES
(2, 3, 'Clinicplus', 'Clinicplus-80ml', 120.00, 'Yes', 'https://i.pinimg.com/736x/e9/be/67/e9be6742f0109a599d1d13e4745ca147.jpg', '2025-09-18 14:03:54'),
(3, 4, 'Sunsilk-Pink', 'Sunsilk-pink-80ml', 150.00, 'Yes', 'https://i.pinimg.com/736x/db/e3/25/dbe325e499567c4693327c0b84603272.jpg', '2025-09-18 14:15:51'),
(4, 5, 'Colgate', 'Colgate-17g', 10.00, 'Yes', 'https://i.pinimg.com/736x/c1/29/0d/c1290d1dbc7352217ad7e65ff5618e1a.jpg', '2025-09-18 14:19:33'),
(7, 6, 'Close-up', 'close-up-150g', 122.00, 'Yes', 'https://i.pinimg.com/1200x/c9/5c/c6/c95cc6ed7b2267f94896c58def0bd715.jpg', '2025-09-18 14:24:36'),
(8, 7, 'Dabur', 'Dabur Red Tooth Paste : 100 g', 194.00, 'Yes', 'https://i.pinimg.com/736x/82/98/29/82982946873fb75e63a6e8d46a72af0f.jpg', '2025-09-18 14:25:27'),
(9, 9, 'Head & Shoulders', 'HEAD & SHOULDERS Smooth and Silky Anti-Dandruff Shampoo(180ml)', 205.00, 'Yes', 'https://i.pinimg.com/736x/5f/62/1f/5f621fb959e10f41d98b24a8565d3df4.jpg', '2025-09-18 14:39:07'),
(10, 8, 'Dove', 'Dove(180ml)', 205.00, 'Yes', 'https://i.pinimg.com/736x/1a/3c/41/1a3c41e5ef87bb602d429877faff767c.jpg', '2025-09-18 14:40:30'),
(11, 3, 'Clinicplus', 'Clinic Plus Strong & Long, Healthy Hair Shampoo (1L)', 949.99, 'Yes', 'https://i.pinimg.com/1200x/a9/c2/c1/a9c2c16b001d1064eb610d1ab1cdfda1.jpg', '2025-09-18 14:43:09'),
(12, 3, 'Clinicplus', 'Clinic Plus Strong & Long Shampoo (650 ml)', 460.00, 'Yes', 'https://i.pinimg.com/736x/79/09/d5/7909d5d066104b65812fc45b8e423991.jpg', '2025-09-18 14:45:18'),
(13, 3, 'Clinicplus', 'Clinic Plus Strong & Long Shampoo (6ml)', 1.00, 'Yes', 'https://i.pinimg.com/736x/54/34/ef/5434efc685bbef1fdba1a3577a2e9d03.jpg', '2025-09-18 14:46:38'),
(14, 4, 'Sunsilk-Black', 'Sunsilk Radiant Black Shine Shampoo, 80 ml', 170.00, 'Yes', 'https://i.pinimg.com/1200x/d7/e2/1b/d7e21bde636d1d9d152d5b35afb74bfd.jpg', '2025-09-20 17:03:02'),
(15, 4, 'Sunsilk-Black', 'Sunsilk-Black', 1.00, 'Yes', 'https://vrmshoppe.com/wp-content/uploads/2021/07/sunsilk-black-shine-shampoo-sachet-with-30extra800x80001525861732.jpg', '2025-09-20 17:09:53'),
(17, 4, 'Sunsilk-Pink', 'Sunsilk-Pink', 1.00, 'Yes', 'http://i.ebayimg.com/images/g/0ogAAOSw9-1kBx82/s-l1200.jpg', '2025-09-20 17:12:22'),
(18, 4, 'Sunsilk-Black', 'Sunsilk Radiant Black Shine Shampoo, 180 ml\r\n', 250.00, 'Yes', 'https://i.pinimg.com/1200x/d7/e2/1b/d7e21bde636d1d9d152d5b35afb74bfd.jpg', '2025-09-20 17:14:21'),
(19, 4, 'Sunsilk-Pink', 'Sunsilk-pink-180ml', 250.00, 'Yes', 'https://i.pinimg.com/1200x/ad/bc/f3/adbcf37cef52cd7263e9c4f8b84f22b0.jpg', '2025-09-20 17:15:11'),
(20, 8, 'Dove Daily Shine Shampoo and Conditioner Combo', 'Dove Daily Shine Shampoo 340ml & Dove Daily Shine Conditioner 175ml', 660.00, 'Yes', 'https://i.pinimg.com/1200x/9d/94/06/9d9406203bc93deaed9e23373fec13f7.jpg', '2025-09-20 17:20:59'),
(21, 8, 'Dove  conditioner', 'Dove Daily Shine Conditioner', 245.00, 'Yes', 'https://i.pinimg.com/736x/89/cb/aa/89cbaa50a9a8099b2964b98269984dfa.jpg', '2025-09-20 17:22:33'),
(22, 8, 'Dove', 'Dove Daily Shine Shampoo', 4.00, 'Yes', 'https://images-cdn.ubuy.co.in/649c51b4e583b272eb2c66ff-dove-hair-therapy-daily-shine-shampoo.jpg', '2025-09-20 17:24:24'),
(23, 8, 'Dove shampoo and conditioner pouch', 'Dove Intense Repair Shampoo And Conditioner Twin Sachet', 8.00, 'Yes', 'https://m.media-amazon.com/images/I/41eVP4nEwFL.jpg', '2025-09-20 17:25:37'),
(24, 9, 'Head-Shoulder', 'ead & Shoulders, Daily Shampoo, Classic Clean', 200.00, 'Yes', 'https://i.pinimg.com/736x/6a/a7/09/6aa709497dd99e8048d67aa7b2ce1aea.jpg', '2025-09-20 17:37:57'),
(26, 9, 'Head & Shoulders', 'Head & Shoulders-Cool Menthol Anti-Dandruff Shampoo 180 ml', 190.00, 'Yes', 'https://i.pinimg.com/736x/f8/5c/8f/f85c8fe0e44bf7baa5c4e8d2cdb41f42.jpg', '2025-09-20 17:40:41'),
(27, 9, 'Head-Shoulder-Shampoo & Conditioner', 'Head & Shoulders\r\n-Smooth & Silky 2 in 1 Anti Dandruff Shampoo & Conditioner 340 ml', 408.00, 'Yes', 'http://m.media-amazon.com/images/I/51TmpsUa8pL._UF1000,1000_QL80_.jpg', '2025-09-20 17:43:52'),
(28, 13, 'Keshking', 'Kesh King Anti-Hairfall Shampoo', 60.00, 'Yes', 'https://i.pinimg.com/736x/29/15/ec/2915ec76d6cd742cbede1dcfb8e3c25c.jpg', '2025-10-01 14:45:59'),
(29, 13, 'Keshking', 'Kesh King Anti Hairfall Shampoo(200ml)', 250.00, 'Yes', 'https://i.pinimg.com/1200x/b2/9a/19/b29a194a01c05ac2097f833f0945bfeb.jpg', '2025-10-01 14:47:16'),
(30, 13, 'Keshking', 'Kesh King Ayurvedic Anti-Hair Fall Shampoo (1L)', 950.00, 'Yes', 'https://i.pinimg.com/1200x/3c/38/35/3c383561f331562037d99182d093ffa1.jpg', '2025-10-01 14:49:25'),
(31, 13, 'Keshking', 'KESHKING ANTI HAIRFALL AYURVEDIC SHAMPOO', 2.00, 'Yes', 'https://img.thecdn.in/408135/SKU-1416_0-1732246651099.jpg?width=600&format=webp', '2025-10-01 14:51:40'),
(32, 11, 'L\'Oreal', 'L\'Oreal Paris Total Repair 5 (650ml)', 400.00, 'Yes', 'https://i.pinimg.com/1200x/1e/01/00/1e010024eae789db947b97f494322f40.jpg', '2025-10-01 17:11:45'),
(33, 11, 'L\'Oreal', 'L Oréal Paris Moisture Filling Shampoo, With Hyaluronic Acid, For Dry & Dehydrated Hair, Adds Shine & Bounce, Hyaluron Moisture 72H, 340Ml.', 230.00, 'Yes', 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTy8NFD-_yn-AltfOA4DpFP5a_4EwJd3_8GGBdoLVswgu7G3huK8g9tJfPHi0VQue33Hziw_CJ5W2gcp5C818G_vhqd6hgbpjcUim0i3ASd2IalIv4kvd0HJc4', '2025-10-01 17:13:53'),
(34, 11, 'L\'Oreal', 'L Oréal Paris Moisture Filling Shampoo, With Hyaluronic Acid, For Dry & Dehydrated Hair, Adds Shine & Bounce, Hyaluron Moisture 72H, 200ML.', 184.00, 'Yes', 'https://i.pinimg.com/1200x/6e/f4/4e/6ef44ef53ff4b0d1457de4f6a47e5a4c.jpg', '2025-10-01 17:16:39'),
(35, 11, 'L\'Oreal', 'L\'Oreal Paris Extraordinary Oil Nourishing Shampoo 180 ml', 219.00, 'Yes', 'https://i.pinimg.com/736x/39/79/90/3979905ca220dd15aa70e2c5edf5a950.jpg', '2025-10-01 17:19:39'),
(36, 11, 'L\'Oreal', 'L\'Oreal Paris Fall Resist 3X Anti-Hair Fall Shampoo, 180 ml', 271.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40024104_10-loreal-paris-fall-resist-3x-anti-hairfall-shampoo.jpg', '2025-10-01 17:21:08'),
(37, 7, 'Dabur', 'Dabur Red Toothpaste - 200g', 240.00, 'Yes', 'https://i.pinimg.com/1200x/82/98/29/82982946873fb75e63a6e8d46a72af0f.jpg', '2025-10-01 17:30:03'),
(38, 7, 'Dabur', 'Dabur Red Toothpaste - 500g', 470.00, 'Yes', 'https://www.daburshop.com/cdn/shop/files/0_c044c80d-ea9d-4cea-bae7-8dc6ad64f4c4_380x380.png?v=1748334732', '2025-10-01 17:31:35'),
(39, 14, 'Sensodyne', 'Sensodyne Pronamel Gentle Whitening Toothpaste-75gm', 240.00, 'Yes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpq3Ol6bQKjTciSHcvN27X-MBBXEL9I6CvmA&s', '2025-10-10 15:49:42'),
(40, 14, 'Sensodyne', 'Sensodyne Pronamel Gentle Whitening Toothpaste-100gm', 320.00, 'Yes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIHsxchak2UO33Y5HZwp6LGM8zpx6jbeptDw&s', '2025-10-10 15:51:01'),
(41, 15, 'Himalaya Complete Care Toothpaste', 'Himalaya Complete Care Toothpaste Healthy Gum 150G', 290.00, 'Yes', 'https://magicpills.in/wp-content/uploads/2021/09/71iAJiRJDoL._SL1500_.jpg', '2025-10-10 15:56:51'),
(42, 15, 'Himalaya Complete Care Toothpaste', 'Himalaya Complete Care Toothpaste Healthy Gum 100gm', 225.00, 'Yes', 'https://himalayawellness.in/cdn/shop/products/Complete-Care_1024x1024.jpg?v=1622100609', '2025-10-10 15:57:59'),
(43, 15, 'Himalaya Complete Care Toothpaste', 'Himalaya Complete Care Toothpaste Healthy Gum 50gm', 100.00, 'Yes', 'https://himalayawellness.in/cdn/shop/products/Complete-Care_1024x1024.jpg?v=1622100609', '2025-10-10 15:58:26'),
(44, 16, 'Vaseline Deep Moisture Body Lotion', 'Vaseline Deep Moisture Body Lotion |For Dry Skin|\r\n 200ml', 190.00, 'Yes', 'https://m.media-amazon.com/images/I/31QHBM9DT7L._SY300_SX300_QL70_FMwebp_.jpg', '2025-10-10 16:29:03'),
(45, 16, 'Vaseline Intensive Care Cocoa Glow Body Lotion', 'Vaseline Intensive Care Cocoa Glow Body Lotion 200 ml', 225.00, 'Yes', 'https://m.media-amazon.com/images/I/51w8Y8tiUxL._SY450_.jpg', '2025-10-10 16:30:14'),
(46, 16, 'Vaseline Healthy Bright', 'Vaseline Healthy Bright Daily Brightening Body Lotion,\r\nFor Healthy & Glowing Skin, 200 ml', 260.00, 'Yes', 'https://m.media-amazon.com/images/I/518B32hUTiL._SY450_.jpg', '2025-10-10 16:35:28'),
(47, 16, 'Vaseline Intensive Care Aloe Fresh Body Lotion', 'Vaseline Intensive Care Aloe Fresh Body Lotion 200 ml', 270.00, 'Yes', 'https://m.media-amazon.com/images/I/51SWKsdqWoL._SY450_.jpg', '2025-10-10 16:57:25'),
(48, 16, 'Vaseline Deep Moisture Body Lotion', 'Vaseline Deep Moisture Body Lotion |For Dry Skin |400ml', 310.00, 'Yes', 'https://m.media-amazon.com/images/I/51ZPHi1UbJL._SY450_.jpg', '2025-10-10 21:21:22'),
(49, 16, 'Vaseline Intensive Care Cocoa Glow Body Lotion', 'Vaseline Cocoa Glow Serum In Lotion, 400 ml', 560.00, 'Yes', 'https://m.media-amazon.com/images/I/51r7G9tLfLL._SY450_.jpg', '2025-10-10 21:23:54'),
(50, 19, 'POND\'S  Body Lotion', 'POND\'S Niacinamide Nourishing Body Lotion for Soft, Glowing Skin 90 ml', 120.00, 'Yes', 'https://m.media-amazon.com/images/I/4147sJ6IAAL._SY300_SX300_QL70_FMwebp_.jpg', '2025-10-10 21:56:27'),
(51, 19, 'Pond\'s Niacinamide Lotion', 'Pond\'s Niacinamide Lotion', 300.00, 'Yes', 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcSnMD5NReZ-hXza--eaND5tPveCgRcJE8k4MiK0mtz-drW4VK5bpQkbU1Y7OQS80GnLtbZH50pnhlsN9mX8IPLMFZxc05b3YDu-KajwCdvhxZ7U19C1KJTx', '2025-10-10 21:59:01'),
(52, 20, 'Nivea Nourishing Body Milk', 'Nivea Nourishing Body Milk, 600 ml', 760.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40178947_12-nivea-body-lotion-for-very-dry-skin-with-2x-almond-oil-for-men-women.jpg', '2025-10-10 22:05:02'),
(53, 20, 'Nivea Nourishing Body Milk', 'Nivea Body Milk Nourishing Lotion, 200 ml', 260.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/263113_16-nivea-body-lotion-for-very-dry-skin-nourishing-body-milk-with-2x-almond-oil-for-men-women.jpg', '2025-10-10 22:06:27'),
(54, 20, 'NIVEA Body Lotion Natural Glow', 'NIVEA Body Lotion Natural Glow,Cell Repair With Uva/Uvb Filters And Spf 15|50X Vitamin C For Even Skin Tone|400 Ml', 645.00, 'Yes', 'https://m.media-amazon.com/images/I/5166EB2FPcL._SY606_.jpg', '2025-10-10 22:08:35'),
(55, 20, 'NIVEA Body Lotion', 'NIVEA Body Lotion, Extra Whitening Cell Repair, SPF 15 & 50x Vitamin C, 120 ml', 220.00, 'Yes', 'https://assets.myntassets.com/w_412,q_30,dpr_3,fl_progressive,f_webp/assets/images/2025/AUGUST/11/8xBtNsXi_309412e41ca0423a9f46dee3c1cf4e4d.jpg', '2025-10-10 22:11:14'),
(56, 21, 'Dettol', 'Dettol Original Bath Soap', 45.00, 'Yes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSj9LSaDNcp8lIle2cCKddY2R5BSBEjTXIa-A&s', '2025-10-10 22:32:27'),
(57, 21, 'Dettol', 'DETTOL COOL MENTHOL SOAP 125G', 75.00, 'Yes', 'https://nmedicines.in/media/catalog/product/cache/11/image/586x/040ec09b1e35df139433887a97daa66f/d/e/dettol-cool-soap-500x500.jpg', '2025-10-10 22:34:13'),
(58, 21, 'Dettol', 'Dettol Skin Care Soap 125 G', 58.00, 'Yes', 'https://www.grocerslocal.in/media/catalog/product/cache/2c7666b95835e0d8816b2ed2e9c41efb/2/2/2201036818708_7.jpg', '2025-10-10 22:35:44'),
(59, 21, 'Dettol', 'Dettol Lime Fresh Bathing Soap Bar', 56.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40325668_1-dettol-lime-cool-body-soap.jpg', '2025-10-10 22:38:03'),
(64, 24, 'Lifebuoy', 'Lifebuoy Soap Bar - Lemon Fresh 56 g', 20.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40009315_4-lifebuoy-lemon-fresh-soap-bar.jpg', '2025-10-11 01:07:56'),
(65, 24, 'Lifebuoy', 'Lifebuoy soap', 20.00, 'Yes', 'https://m.media-amazon.com/images/I/41p1v6sRZJL._SY300_SX300_QL70_FMwebp_.jpg', '2025-10-11 01:08:52'),
(66, 24, 'Lifebuoy', 'Lifebuoy Soap Bar - Lemon Fresh 100g', 40.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40009315_4-lifebuoy-lemon-fresh-soap-bar.jpg', '2025-10-11 01:09:36'),
(67, 24, 'Lifebuoy', 'Lifebuoy soap', 40.00, 'Yes', 'https://m.media-amazon.com/images/I/41p1v6sRZJL._SY300_SX300_QL70_FMwebp_.jpg', '2025-10-11 01:10:11'),
(68, 25, 'Santoor Skin Softening Soap', 'Santoor Skin Moisturidsing Sandal & Turmeric Bathing Soap, 100 g', 45.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/100005805_12-santoor-bathing-soap-sandal-turmeric.jpg', '2025-10-11 01:14:15'),
(69, 25, 'Santoor Skin Softening Soap', 'Santoor Skin Moisturidsing Sandal & Turmeric Bathing Soap, 125g', 80.00, 'Yes', 'https://images.apollo247.in/pub/media/catalog/product/S/A/SAN0013_1-AUG23_1.jpg?tr=q-80,f-webp,w-400,dpr-3,c-at_max%20400w', '2025-10-11 01:16:44'),
(70, 26, 'Dove', 'Dove Cream Beauty Bathing Bar, 50 g', 25.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40019053_5-dove-cream-beauty-bathing-bar-soap.jpg', '2025-10-11 01:19:08'),
(71, 26, 'Dove', 'Dove Pink Radiance Serum Bar, 125 g', 82.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/m/40077771_11-dove-pinkrosa-beauty-bathing-bar.jpg?tr=w-154,q-80', '2025-10-11 01:20:58'),
(72, 26, 'Dove', 'Dove Cream Beauty Bathing Bar, 125g', 85.00, 'Yes', 'https://cdn.netmeds.tech/v2/plain-cake-860195/netmed/wrkr/products/assets/item/free/original/9rNCCOXTll-dove_cream_beauty_bathing_bar_pack_of_3_x_125_gm_161571_0_1.jpg', '2025-10-11 01:23:11'),
(73, 27, 'Wheat', 'Daily Good Mp Sharbati Wheat -- 1KG', 100.00, 'Yes', 'https://cdn.zeptonow.com/production/ik-seo/tr:w-470,ar-1200-1200,pr-true,f-auto,q-80/cms/product_variant/3b5e8a52-14ae-4ebf-8440-fcd63560ef30/Daily-Good-Mp-Sharbati-Wheat.jpeg', '2025-10-11 08:03:35'),
(74, 27, 'Wheat', 'Daily Good Mp Sharbati Wheat -- 5KG', 480.00, 'Yes', 'https://cdn.zeptonow.com/production/ik-seo/tr:w-470,ar-1200-1200,pr-true,f-auto,q-80/cms/product_variant/3b5e8a52-14ae-4ebf-8440-fcd63560ef30/Daily-Good-Mp-Sharbati-Wheat.jpeg', '2025-10-11 08:04:24'),
(75, 27, 'Wheat', 'Daily Good Mp Sharbati Wheat -- 10KG', 850.00, 'Yes', 'https://cdn.zeptonow.com/production/ik-seo/tr:w-470,ar-1200-1200,pr-true,f-auto,q-80/cms/product_variant/3b5e8a52-14ae-4ebf-8440-fcd63560ef30/Daily-Good-Mp-Sharbati-Wheat.jpeg', '2025-10-11 08:05:26'),
(76, 27, 'Wheat', 'Daily Good Mp Sharbati Wheat -- 10KG', 850.00, 'Yes', 'https://cdn.zeptonow.com/production/ik-seo/tr:w-470,ar-1200-1200,pr-true,f-auto,q-80/cms/product_variant/3b5e8a52-14ae-4ebf-8440-fcd63560ef30/Daily-Good-Mp-Sharbati-Wheat.jpeg', '2025-10-11 08:11:46'),
(77, 28, 'Onion', 'Onion 20₹ per KG', 20.00, 'Yes', 'https://i.pinimg.com/736x/f9/97/38/f99738883642acea3c800caff14d66f2.jpg', '2025-10-13 15:33:17'),
(78, 28, 'Onion', 'White Onion 25Rupee per KG', 25.00, 'Yes', 'https://i.pinimg.com/736x/48/75/c9/4875c96aed3a66c3c7145a137eb8f343.jpg', '2025-10-13 15:36:56'),
(79, 29, 'Garlic', 'Garlic 30rupee per KG', 30.00, 'Yes', 'https://i.pinimg.com/1200x/24/3b/fc/243bfc9a4c83fb56eff67b85f71cc66c.jpg', '2025-10-13 15:44:30'),
(80, 29, 'Garlic', 'Garlic Peeled\r\nNet Qty: 100 g', 40.00, 'Yes', 'https://i.pinimg.com/736x/c0/91/e5/c091e5479a571e82616e9e974da06d24.jpg', '2025-10-13 15:47:02'),
(81, 29, 'Garlic', 'Garlic 50rupee per KG', 50.00, 'Yes', 'https://i.pinimg.com/736x/ef/b0/3a/efb03afe79fc22dffa6b99b63a833e4f.jpg', '2025-10-13 15:50:10'),
(82, 30, 'Potato', 'Potato 30rupee per KG', 30.00, 'Yes', 'https://i.pinimg.com/736x/1a/f0/f4/1af0f44c36a75fff5e1d2beb447c1b8f.jpg', '2025-10-13 15:54:04'),
(83, 30, 'Potato', 'Potato 35rupee per KG', 35.00, 'Yes', 'https://i.pinimg.com/736x/8e/b6/2b/8eb62b50dbcce5e9569458870e7c2d87.jpg', '2025-10-13 15:55:25'),
(84, 31, 'Basmati Rice', 'Daawat Rozana Super Basmati Rice, 5 kg', 370.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40075197_7-daawat-basmati-rice-rozana-super-90.jpg', '2025-10-14 13:57:58'),
(85, 31, 'Basmati Rice', 'Daawat Rozana Super Basmati Rice, 1 kg', 100.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40075196_6-daawat-basmati-rice-rozana-super-90.jpg', '2025-10-14 13:59:00'),
(86, 31, 'India Gate Basmati Rice', 'India Gate Basmati Rice - Rozana, 5 kg', 390.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/283426_5-india-gate-basmati-rice-feast-rozzana.jpg', '2025-10-14 14:01:34'),
(87, 31, 'Fortune Basmati Rice', 'Fortune Basmati Rice/Basmati Chawal - Rozana, \r\n1 kg (dubar basmati rice)', 120.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40022616_9-fortune-rozana-basmati-rice-suitable-for-daily-cooking.jpg', '2025-10-14 14:03:23'),
(88, 31, 'India Gate Basmati Rice', 'India Gate Basmati Rice - Rozana, 5 kg', 390.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/283426_5-india-gate-basmati-rice-feast-rozzana.jpg', '2025-10-14 14:33:32'),
(89, 32, 'Bajra', 'Royal Bajra, 1 kg Pouch', 70.00, 'Yes', 'https://5.imimg.com/data5/SELLER/Default/2022/1/LM/WG/LM/140653739/indian-pearl-millet-bajra--500x500.jpg', '2025-10-14 14:39:23'),
(90, 32, 'Bajra', 'Royal Bajra, 2 kg Pouch', 140.00, 'Yes', 'https://5.imimg.com/data5/SELLER/Default/2022/1/LM/WG/LM/140653739/indian-pearl-millet-bajra--500x500.jpg', '2025-10-14 14:40:45'),
(91, 33, 'Chole chana', 'Tata Sampann Kabuli Chana/Chole, 500 g', 100.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/30004672_10-tata-sampann-unpolished-kabuli-chana.jpg', '2025-10-14 14:42:35'),
(92, 33, 'Chole chana', 'Kabuli Chana/Chole, 500 g', 80.00, 'Yes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTi-RAfVf_eM4vGyXMD0SMEkpJqMa1bLF1sgA&s', '2025-10-14 14:43:53'),
(93, 33, 'Chole chana', 'Kabuli Chana/Chole, 500 g', 85.00, 'Yes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTi-RAfVf_eM4vGyXMD0SMEkpJqMa1bLF1sgA&s', '2025-10-14 14:44:23'),
(94, 34, 'Masoor Dal', 'Masoor Dal, 1 kg', 120.00, 'Yes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjQ256iEcRpnytApp2nxdEe4u_61iJMh70nQ&s', '2025-10-14 14:46:00'),
(95, 34, 'Masoor Dal', 'Tata Sampann Unpolished Masoor Dal - Whole, 1 kg', 150.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/30002286_10-tata-sampann-unpolished-masoor-dal-whole.jpg', '2025-10-14 14:46:30'),
(96, 34, 'Masoor Dal', 'Masoor Dal, 1 kg', 125.00, 'Yes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjQ256iEcRpnytApp2nxdEe4u_61iJMh70nQ&s', '2025-10-14 14:47:21'),
(97, 35, 'Chana Dal', 'Chana Dal - Desi Unpolished, 1 kg Pouch', 130.00, 'Yes', 'https://5.imimg.com/data5/MA/DU/ZZ/SELLER-9030733/chana-dal-bhujiya-500x500.jpg', '2025-10-14 14:49:49'),
(98, 35, 'Chana Dal', 'Tata Sampann Unpolished Chana Dal, 1 kg', 153.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40000290_11-tata-sampann-unpolished-chana-dal.jpg', '2025-10-14 14:51:46'),
(99, 36, 'Wheat Flour', 'Fortune Chakki Atta, 5 kg', 220.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40120174_6-fortune-chakki-fresh-atta-100-atta-0-maida.jpg', '2025-10-14 15:05:30'),
(100, 36, 'Wheat Flour', 'Aashirvaad Shudh Chakki Atta, 10 kg', 480.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40127505_9-aashirvaad-shudh-chakki-atta.jpg', '2025-10-14 15:06:24'),
(101, 36, 'Wheat Flour', 'Aashirvaad Shudh Chakki Atta, 5 kg', 240.00, 'Yes', 'https://www.bbassets.com/media/uploads/p/l/40127505_9-aashirvaad-shudh-chakki-atta.jpg', '2025-10-14 15:07:17'),
(102, 37, 'Bajri Flour', 'Bajri Flour 1KG', 50.00, 'Yes', 'https://cdn11.bigcommerce.com/s-dd74nsspbq/images/stencil/1280x1280/products/693/4639/bajra-whole-and-flour__38615.1732009951.jpg?c=1', '2025-10-14 15:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT 'noimage.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `image`, `created_at`) VALUES
(3, 2, 'Shampoo', 'https://thumbs.dreamstime.com/b/composition-containers-global-cosmetics-brands-poznan-poland-dec-plastic-body-care-products-including-widely-available-106604090.jpg', '2025-09-18 13:46:34'),
(4, 2, 'Toothpaste', 'https://c8.alamy.com/comp/2Y004NA/colgate-a-brand-of-oral-hygiene-products-such-as-toothpastes-toothbrushes-mouthwashes-and-dental-floss-produced-by-american-consumer-goods-company-2Y004NA.jpg', '2025-09-18 13:47:45'),
(5, 2, 'Body-Lotion', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzlNeW8sOOEXnaX5uodfdW04DyP-iT7I8xvA&s', '2025-09-18 13:48:20'),
(6, 2, 'Soap', 'https://basketpoint.in/cdn/shop/collections/SP01170006-1.jpg?v=1717784055', '2025-09-18 13:49:54'),
(9, 3, 'Wheat', 'https://i.pinimg.com/1200x/34/86/19/34861903f1e59a38eabcbbc7b80a9067.jpg', '2025-10-11 07:47:05'),
(10, 8, 'Onion', 'https://i.pinimg.com/736x/f9/97/38/f99738883642acea3c800caff14d66f2.jpg', '2025-10-13 15:31:34'),
(11, 8, 'Garlic', 'https://i.pinimg.com/1200x/24/3b/fc/243bfc9a4c83fb56eff67b85f71cc66c.jpg', '2025-10-13 15:40:35'),
(12, 8, 'Potato', 'https://i.pinimg.com/736x/1a/f0/f4/1af0f44c36a75fff5e1d2beb447c1b8f.jpg', '2025-10-13 15:52:21'),
(13, 3, 'Rice', 'https://c.ndtvimg.com/2023-08/brlp7gk_uncooked-rice-or-rice-grains_625x300_18_August_23.jpg?im=FaceCrop,algorithm=dnn,width=545,height=307', '2025-10-14 13:41:43'),
(14, 3, 'Bajra', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRacqRPW6twTnyHDTgA_tb88y1Ml8wZwETbdxEhtcxGJfJnVfR0C0CnXa7hBaGsiJxMkBA&usqp=CAU', '2025-10-14 13:42:40'),
(15, 3, 'Chole chana', 'https://5.imimg.com/data5/SELLER/Default/2024/9/454062212/AV/CM/LF/193081573/kabuli-chole-chana.png', '2025-10-14 13:43:25'),
(16, 3, 'Masoor Dal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjQ256iEcRpnytApp2nxdEe4u_61iJMh70nQ&s', '2025-10-14 13:44:47'),
(17, 3, 'Chana Dal', 'https://vibrantliving.in/cdn/shop/files/ChanaDalSplit.jpg?crop=center&height=1200&v=1731059251&width=1200', '2025-10-14 13:45:26'),
(18, 6, 'Wheat Flour', 'https://t4.ftcdn.net/jpg/01/20/00/55/360_F_120005524_K3y8Ku1CDDsDpQeZqFYgBksKmWDK0RcB.jpg', '2025-10-14 15:04:09'),
(19, 6, 'Bajri Flour', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbhS8-QDEFRegpXIXmUrSp6b4ZxWfLQSQyJA&s', '2025-10-14 15:08:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_types`
--
ALTER TABLE `product_types`
  ADD CONSTRAINT `product_types_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
