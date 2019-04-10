-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 09:01 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpro_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `_id` int(11) NOT NULL,
  `userName` varchar(16) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`_id`, `userName`, `firstName`, `lastName`, `email`, `password`, `reg_date`) VALUES
(1, 'rkanik', 'RK', 'Anik', 'rk.anik.773@gmail.com', '$2y$10$fx3GNpgMuxPWzVrirWfiHepEftTj5AdCbz/csMjf9LsNnZGqSulMy', '2019-03-28 05:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `imgur_images`
--

CREATE TABLE `imgur_images` (
  `_id` int(11) NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imgur_images`
--

INSERT INTO `imgur_images` (`_id`, `post_id`, `src`) VALUES
(9, '9a4829cd-552b-4ae5-bf27-2393889896d3', 'https://i.imgur.com/aHVBFpX.jpg'),
(10, 'd6fc25c6-500e-4f1c-a3b1-eda00acec136', 'https://i.imgur.com/7SRzK5C.png'),
(13, '2ecf4d8c-3c01-4362-8813-a6af3aee171b', 'https://i.imgur.com/UpvEMeE.jpg'),
(14, '2ecf4d8c-3c01-4362-8813-a6af3aee171b', 'https://i.imgur.com/HI1Lp88.jpg'),
(15, '2ecf4d8c-3c01-4362-8813-a6af3aee171b', 'https://i.imgur.com/TEFsApt.jpg'),
(16, '2ecf4d8c-3c01-4362-8813-a6af3aee171b', 'https://i.imgur.com/qmld2E0.jpg'),
(17, 'dc8bb410-20d1-4344-ad04-e3e9cfd9e2a3', 'https://i.imgur.com/mI0e5O1.jpg'),
(18, 'dc8bb410-20d1-4344-ad04-e3e9cfd9e2a3', 'https://i.imgur.com/NZD7kQf.jpg'),
(19, 'dc8bb410-20d1-4344-ad04-e3e9cfd9e2a3', 'https://i.imgur.com/KZFj4V4.jpg'),
(20, '7a6416da-4efc-4cff-a314-5198a1c8a433', 'https://i.imgur.com/7U5HeT2.jpg'),
(21, '7a6416da-4efc-4cff-a314-5198a1c8a433', 'https://i.imgur.com/C0kVN6p.jpg'),
(22, '7a6416da-4efc-4cff-a314-5198a1c8a433', 'https://i.imgur.com/xXWcKpN.jpg'),
(23, '08d6d2ff-23cc-4518-96d4-614ae0a02dfb', 'https://i.imgur.com/8Y9t6wl.jpg'),
(24, '08d6d2ff-23cc-4518-96d4-614ae0a02dfb', 'https://i.imgur.com/pxGs798.jpg'),
(25, '08d6d2ff-23cc-4518-96d4-614ae0a02dfb', 'https://i.imgur.com/hfZYQ4Q.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `_id` varchar(255) NOT NULL,
  `mcat_id` int(11) NOT NULL,
  `scat_id` int(11) NOT NULL,
  `seller_id` varchar(255) NOT NULL,
  `pName` varchar(127) NOT NULL,
  `price` int(11) NOT NULL,
  `a_price` int(11) NOT NULL,
  `d_price` int(11) DEFAULT NULL,
  `pDesc` text NOT NULL,
  `queued` tinyint(1) NOT NULL DEFAULT '1',
  `viewed` int(11) DEFAULT '0',
  `ordered` int(11) DEFAULT '0',
  `comment` int(11) DEFAULT '0',
  `rating` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`_id`, `mcat_id`, `scat_id`, `seller_id`, `pName`, `price`, `a_price`, `d_price`, `pDesc`, `queued`, `viewed`, `ordered`, `comment`, `rating`, `created_at`, `updated_at`) VALUES
('08d6d2ff-23cc-4518-96d4-614ae0a02dfb', 1, 20, '577f746c-4707-49a7-ae8a-b23f70088009', 'Leather Wallet for Men', 21, 0, NULL, 'Product details of Black Leather Wallet for Men\n\nMain Material: Genuine Leather\nPerfectly fit in your pocket\nComfortable to carry\nBrand: Chowdhury Products\nProduct Type: Wallet\nColor: Black\nStandard and smart design\nVisiting: credit card chamber\nMain Material: Genuine Leather\nPerfectly fit in your pocket\n\nA wallet is a small, flat case that can be used to carry such personal items as cash, credit cards, and identification documents, photographs, transit pass, gift cards, business cards and other paper or laminated cards.', 0, 0, 0, 0, NULL, '2019-04-06 08:11:51', '2019-04-06 08:11:28'),
('2ecf4d8c-3c01-4362-8813-a6af3aee171b', 6, 16, '8d8b5b80-2742-4835-b43c-45c88e40b5d7', 'T1 Tact Military Grade Super Tough Smart Watch', 47, 0, NULL, 'Please do not wear it when taking a shower or go swimming & do not press any buttons under water.', 0, 0, 0, 0, NULL, '2019-04-01 14:55:39', '2019-04-01 05:29:13'),
('7a6416da-4efc-4cff-a314-5198a1c8a433', 8, 19, '83467c9c-27fe-4de8-86d9-593bbb34fcf0', 'Xiaomi MI9', 450, 389, 399, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus cumque amet assumenda, provident accusamus ex!', 0, 0, 1, 0, NULL, '2019-04-06 13:50:17', '2019-04-03 15:48:58'),
('9a4829cd-552b-4ae5-bf27-2393889896d3', 1, 9, '8d8b5b80-2742-4835-b43c-45c88e40b5d7', 'Sweater', 215, 0, NULL, 'aworiawrjkafjkljafa', 1, NULL, NULL, NULL, NULL, '2019-04-01 14:19:32', '2019-03-31 20:56:06'),
('d6fc25c6-500e-4f1c-a3b1-eda00acec136', 1, 2, '8d8b5b80-2742-4835-b43c-45c88e40b5d7', 'Blue T-Shirt', 12, 0, NULL, 'Sadawrafsetsetsetgstsetst', 1, NULL, NULL, NULL, NULL, '2019-04-01 14:19:37', '2019-03-31 21:18:02'),
('dc8bb410-20d1-4344-ad04-e3e9cfd9e2a3', 8, 18, '8d8b5b80-2742-4835-b43c-45c88e40b5d7', 'Samsung Galaxy S10 Plus', 1050, 0, NULL, '6.3-inch Super AMOLED Capacitive Touchscreen, 1440 x 3040 pixels with Corning Gorilla Glass 6\nAndroid OS, Qualcomm Snapdragon 855, Octa-Core (1x2.8GHz & 3x2.4GHz & 4x1.7GHz), Adreno 640 GPU\nInternal Memory: 128GB, 6GB RAM - microSD Up to 512GB\nTri 12MP(f/1.5-2.4, Dual Pixel PDAF) + 12MP(f/2.4, AF, OIS) + 16MP(f/2.2, 12mm) Camera\'s with LED Flash, Auto-HDR, Panorama\nDual 10MP(f/1.9, Dual Pixel PDAF) & 8MP(f/2.2, depth sensor) with LED Flash, Auto-HDR, Panorama', 0, 0, 0, 0, NULL, '2019-04-03 07:41:11', '2019-04-03 07:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`_id`, `title`) VALUES
(5, 'Babies & Toys'),
(3, 'Electronics'),
(4, 'Health & Beauty'),
(1, 'Men\'s Fashion'),
(8, 'Smartphones'),
(7, 'Sports & Outdoors'),
(6, 'Watches'),
(2, 'Women\'s Fashion');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `pc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`_id`, `title`, `pc_id`) VALUES
(1, 'Shirts', 1),
(2, 'T-Shirts', 1),
(3, 'Panjabi & Fatua', 1),
(4, 'Jeans', 1),
(5, 'Polo Shirts', 1),
(6, 'Pant', 1),
(7, 'Bags', 1),
(8, 'Suits', 1),
(9, 'Sweater', 1),
(10, 'Jackets & Coats', 1),
(11, 'Hoodies', 1),
(12, 'Sneekers', 1),
(13, 'Sandals', 1),
(14, 'Boots', 1),
(15, 'Formal Shoes', 1),
(16, 'Digital Watch', 6),
(17, 'Analog Watch', 6),
(18, 'Samsung', 8),
(19, 'Xiaomi', 8),
(20, 'Wallets', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile_sellers`
--

CREATE TABLE `profile_sellers` (
  `_id` varchar(64) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `shopName` varchar(64) NOT NULL,
  `phone` varchar(24) NOT NULL,
  `rating` int(2) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `district` varchar(64) NOT NULL,
  `zip` int(16) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_sellers`
--

INSERT INTO `profile_sellers` (`_id`, `firstName`, `lastName`, `email`, `password`, `shopName`, `phone`, `rating`, `age`, `gender`, `district`, `zip`, `address`, `created_at`, `updated_at`) VALUES
('1', 'Md Rasel', 'Khandkar', 'rk@gmail.com', '', 'RK SHOP', '01703577953', NULL, 22, 'male', 'Dhaka', 1215, 'greenroad,farmgate', '2019-03-28 10:10:24', '2019-03-28 10:10:24'),
('3', 'Nihal', 'Hasan', 'nihal94839@gmail.com', '', 'Smart watch', '0984846', NULL, NULL, NULL, 'Jamdadafaf', 26404, 'afgsgsdg,sgsgsggsgsg', '2019-03-27 19:43:28', '2019-03-28 09:49:25'),
('577f746c-4707-49a7-ae8a-b23f70088009', 'Rasel', 'Khandkar', 'rasel.khandkar@gmail.com', '$2y$10$3dfdlbeAPJAOHe95psYwi.VDj.vhCDYyCZDu14JwsDpCzVGpE29wC', 'Watch House', '01703577953', NULL, NULL, NULL, 'Dhaka', 1215, '147/4 East Razabazar, Dhaka 1215', '2019-04-04 03:39:58', '2019-04-04 03:39:58'),
('83467c9c-27fe-4de8-86d9-593bbb34fcf0', 'aweawe', 'awetfjg', 'fugfmn xbv', '$2y$10$o8pxDLTRyMir0HfQpl/z1uyGq.ASfNVnAxBp0iOfVHcQRBokDaN1S', 'wae', '3475868', NULL, NULL, NULL, 'nghdfgv', 3435, 'fgufnbsdvfg', '2019-04-03 02:12:02', '2019-04-03 02:12:02'),
('8d8b5b80-2742-4835-b43c-45c88e40b5d7', 'Jahid', 'Khan', 'jahid9878@gmail.com', '', 'Cell Bazar', '02145789654', NULL, NULL, NULL, 'Dhaka', 1215, 'Farmgate,Dhaka', '2019-04-01 14:22:30', '2019-04-01 14:22:30'),
('de6eee97-ad6a-4c67-b145-db6a1f71063c', 'Lonnie J.', 'Cardenas', 'LonnieJCardenas@teleworm.us', '$2y$10$Zr6HtjHeECcvjWWc1q6bBuPjTMBvELE6OrsnGJif5L29Szy0xlKkW', 'Smart Gadgets', '312-994-9424', NULL, NULL, NULL, 'IL', 60605, '4210 Nash Street\nChicago, IL 60605', '2019-04-04 21:10:18', '2019-04-04 21:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `seller_cats`
--

CREATE TABLE `seller_cats` (
  `_id` int(8) NOT NULL,
  `title` varchar(64) NOT NULL,
  `fo_aw_class` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller_cats`
--

INSERT INTO `seller_cats` (`_id`, `title`, `fo_aw_class`) VALUES
(1, 'Dashboard', 'fa-home'),
(2, 'Post ad', 'fa-upload'),
(3, 'Queued posts', 'fa-list-alt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `_id` varchar(64) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(127) NOT NULL,
  `userName` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_of_birth` timestamp NULL DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `pro_src` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`_id`, `firstName`, `lastName`, `email`, `userName`, `password`, `created_at`, `updated_at`, `date_of_birth`, `gender`, `pro_src`) VALUES
('28c710c7-250d-479a-83c3-ac0283923872', 'RK', 'Anik', 'rasel15-7040@diu.edu.bd', 'rkanik', '$2y$10$GSM2PuBj6W2GOoXO0W7qaOZA5TsGy9xsp6YEkETnkxXdfuo.oEt2q', '2019-04-02 19:57:47', '2019-04-02 19:57:47', NULL, NULL, NULL),
('565b265f-c30c-4d03-8fe2-6976d44f8658', 'RK', 'Anik', 'rkanik@gmail.com', 'rkanik007', '$2y$10$uUTPfJeKL9EclFLKeOBluejMwnZ0cDSK1b4lTibf09vidGS9CHH2m', '2019-04-07 20:41:35', '0000-00-00 00:00:00', '1997-02-01 18:00:00', 'Male', NULL),
('accc3081-18b4-4517-ab5e-57bc74b2ac50', 'Manuel M.', 'Tomlinson', 'ManuelMTomlinson@armyspy.com', 'Tomlinson', '$2y$10$i1nhwtTWF2rBuA18s7zT7eiOk2xDI5cjxErZp/QL8uCpGSkXQz4Ni', '2019-04-06 18:15:01', '2019-04-06 18:15:01', NULL, NULL, NULL),
('f9ca1870-f770-4257-aa09-b20eb00618dc', 'Sharon C.', 'Miller', 'SharonCMiller@dayrep.com', 'Miller', '$2y$10$eutWvjEzOsWle2RtCSvQWuiNW59DfzLTHMy5pdV1xCsyOdlyHZmt2', '2019-04-08 13:36:09', '0000-00-00 00:00:00', NULL, 'Female', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `u_id` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`_id`, `street`, `city`, `state`, `zip`, `country`, `u_id`, `updated_at`) VALUES
(1, '147/4 East Razabazar, Dhaka 1215', 'Dhaka', 'Dhaka', 1215, 'Bangladesh', '565b265f-c30c-4d03-8fe2-6976d44f8658', '2019-04-07 20:48:20'),
(3, '1896 Heritage Road', 'Fresno', 'CA', 93721, 'United States', 'f9ca1870-f770-4257-aa09-b20eb00618dc', '2019-04-07 21:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_main_cats`
--

CREATE TABLE `user_main_cats` (
  `_id` int(8) NOT NULL,
  `title` varchar(64) NOT NULL,
  `fo_aw_class` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_main_cats`
--

INSERT INTO `user_main_cats` (`_id`, `title`, `fo_aw_class`) VALUES
(12, 'Womens', 'fa-female'),
(13, 'Mens', 'fa-male'),
(15, 'Phones', 'fa-mobile'),
(16, 'Gadgets', 'fa-headset'),
(18, 'Kids toys', 'fa-baby');

-- --------------------------------------------------------

--
-- Table structure for table `user_phones`
--

CREATE TABLE `user_phones` (
  `_id` int(11) NOT NULL,
  `phone` varchar(24) DEFAULT NULL,
  `u_id` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_phones`
--

INSERT INTO `user_phones` (`_id`, `phone`, `u_id`, `updated_at`) VALUES
(1, '01703577953', '565b265f-c30c-4d03-8fe2-6976d44f8658', '2019-04-07 21:04:26'),
(2, '559-728-5583', 'f9ca1870-f770-4257-aa09-b20eb00618dc', '2019-04-07 21:02:12'),
(3, NULL, '536fb698-b698-4975-83b0-4a15f58face2', '2019-04-09 06:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_socials`
--

CREATE TABLE `user_socials` (
  `_id` int(11) NOT NULL,
  `fb` varchar(127) DEFAULT NULL,
  `gm` varchar(127) DEFAULT NULL,
  `tw` varchar(127) DEFAULT NULL,
  `ins` varchar(127) DEFAULT NULL,
  `uid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_cats`
--

CREATE TABLE `user_sub_cats` (
  `_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_cats`
--

INSERT INTO `user_sub_cats` (`_id`, `title`, `m_id`) VALUES
(20, 'Sharee', 12),
(21, 'Lehenga', 12),
(22, 'Shirt', 13),
(23, 'Jeans', 13),
(24, 'Panjabi', 13),
(25, 'Shoes', 13),
(26, 'Glasses', 13),
(27, 'Watch', 13),
(28, 'Headphones', 16),
(29, 'Powerbank', 16),
(30, 'Action camera', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`_id`) USING HASH,
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `imgur_images`
--
ALTER TABLE `imgur_images`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `profile_sellers`
--
ALTER TABLE `profile_sellers`
  ADD PRIMARY KEY (`_id`) USING HASH,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `seller_cats`
--
ALTER TABLE `seller_cats`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`_id`) USING HASH,
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- Indexes for table `user_main_cats`
--
ALTER TABLE `user_main_cats`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `user_phones`
--
ALTER TABLE `user_phones`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `user_socials`
--
ALTER TABLE `user_socials`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `user_sub_cats`
--
ALTER TABLE `user_sub_cats`
  ADD PRIMARY KEY (`_id`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imgur_images`
--
ALTER TABLE `imgur_images`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `seller_cats`
--
ALTER TABLE `seller_cats`
  MODIFY `_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_main_cats`
--
ALTER TABLE `user_main_cats`
  MODIFY `_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_phones`
--
ALTER TABLE `user_phones`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_socials`
--
ALTER TABLE `user_socials`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sub_cats`
--
ALTER TABLE `user_sub_cats`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
