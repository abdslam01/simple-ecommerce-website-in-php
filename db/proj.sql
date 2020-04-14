-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2020 at 02:41 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `product_id`, `user_id`, `content`, `posted_at`) VALUES
(1, 7, 8, 'Tr&eacute;s Bon Produit', '2020-04-13 23:29:58'),
(2, 7, 8, 'Very good product', '2020-04-13 23:30:34'),
(3, 8, 8, 'Bon UHD Television', '2020-04-13 23:31:26'),
(4, 8, 8, 'Bon UHD Television', '2020-04-13 23:32:12'),
(5, 8, 8, '', '2020-04-13 23:34:14'),
(6, 8, 8, '', '2020-04-13 23:35:09'),
(7, 8, 8, '', '2020-04-13 23:35:40'),
(8, 8, 8, '', '2020-04-13 23:37:02'),
(9, 8, 8, 'bvhuvrujhvr', '2020-04-13 23:37:50'),
(10, 7, 8, 'last', '2020-04-14 00:00:54'),
(11, 1, 8, 'good computer', '2020-04-14 00:22:32'),
(12, 8, 8, 'done', '2020-04-14 00:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `prix` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id`, `title`, `prix`, `image`, `user_id`) VALUES
(18, 'Smartphone', 2000, 'img/phone.png', 18),
(19, 'écouteurs', 120, 'img/headphones.png', 18),
(21, 'Smartphone', 2000, 'img/phone.png', 18),
(23, 'Smartphone', 2000, 'img/phone.png', 18),
(24, 'Smartphone', 2000, 'img/phone.png', 18),
(25, 'Smartphone', 2000, 'img/phone.png', 18),
(27, 'Smartphone', 2000, 'img/phone.png', 18),
(28, 'Smartphone', 2000, 'img/phone.png', 18),
(29, 'écouteurs', 120, 'img/headphones.png', 18),
(30, 'Ordinateur Portble', 3500, 'img/black-laptop.jpg', 18),
(31, 'Ordinateur Portble', 3500, 'img/black-laptop.jpg', 18),
(34, 'Ordinateur Portble', 3500, 'img/black-laptop.jpg', 18),
(42, 'Smartphone', 2000, 'img/phone.png', 19),
(45, 'Smartphone', 2000, 'img/phone.png', 19),
(46, 'Smartphone', 2000, 'img/phone.png', 19),
(49, 'Ordinateur Portble', 3500, 'img/black-laptop.jpg', 21),
(50, 'écouteurs', 120, 'img/headphones.png', 21),
(61, 'Lunette VR', 500, 'img/lunette-vr.jpg', 24),
(66, 'Television UHD', 6500, 'img/television.jpg', 8),
(117, 'Smartphone', 2000, 'img/phone.png', 8),
(120, 'Lunette VR', 500, 'img/lunette-vr.jpg', 8),
(121, 'Lunette VR', 500, 'img/lunette-vr.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prix` int(5) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `title`, `prix`, `image`) VALUES
(1, 'Ordinateur Portble', 3500, 'img/black-laptop.jpg'),
(2, 'Smartphone', 2000, 'img/phone.png'),
(3, 'écouteurs', 120, 'img/headphones.png'),
(7, 'Lunette VR', 500, 'img/lunette-vr.jpg'),
(8, 'Television UHD', 6500, 'img/television.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `number`, `email`, `password`, `token`) VALUES
(8, 'Abdessalam', 'Abdessalam Bahafid', '0641236159', 'zomiix246@gmail.com', '1aeb77097ec68710d996bf884f0c8d7a22823187', 'd8fffac2a1d91ce9fd6d8c98ad39cb37746f8701'),
(9, 'Abd ', '', '', 'phenixa@outlook.fr', '2e855aa226fc8b43085df415f6b1159e93df12a4', '12a2c56ad0a24e19453c6962adff0efdee60db9d'),
(10, 'youness', '', '', 'tobahfhrvr@gmail.com', 'aa44ec4eaffc843f55f37b0958a58a9e3ae71c02', '926bf49419d522439efd234ecf8c7ebe4f271a77'),
(11, 'moha', '', '', 'mabrok.00025@gmail.com', 'be207c21beaa67b47d88a2180c25ca78a7aef07c', '7cbde987e7b288d69b612b0fce075edb89d962ec'),
(12, 'Test', '', '', 'zomiix246@gmail.com', '012e871e0fe8d3dc32d86f51e70f6911130de319', '3d20f33c4067b2e67e0e5b4ae2f9a9f048eb06ae'),
(14, 'Boghroch', '', '', 'bighrach@gmail.com', 'd2d0eefb9b5f70c0973dd56c092bc8d73c0a5ba1', '047fa4d1d03fe0dccd44b973528e265dd985b8de'),
(15, 'olala', '', '', 'aaaaaa@gmail.com', '732f26afb319e1b9b669dcb71a9d350aef7e7332', 'a0d3fe3ef864cf4f794b8477461e63d8dcb7a93b'),
(16, 'hhh', '', '', 'jhhh@ijh', 'f0d660f1ebdf15b87ca8f83e0b872b1b3909a96f', 'f0f13f2f87b528df060da15c772edc841c920a8b'),
(17, 'User', '', '', 'user@user.user', '89884b61c198a4e41ea03b7d6fdabd2f3d6d9e07', 'c5bbb38243d1ca6975a64a3b87ad95ea0b0ae5ef'),
(18, 'ayoub', '', '', 'a@a.com', '1f060fcad10a29b5ee39c321d1914dcca24c5aef', '5a5d8949b80f4b307e538f0984e5ce133d9de2a0'),
(19, 'ahmed', '', '', 'ahmed@gmail.com', 'cc23d84cbd27d076a5a71882e537509281240c7e', 'b3883111c7370dc12853ec063a8aae5f72eb150e'),
(20, 'Omar', '', '', 'abcdelouafi@gmail.com', 'cc23d84cbd27d076a5a71882e537509281240c7e', '363de26132c0d216709cba72fe250383c54c25cc'),
(21, 'te', '', '', 'aarezrae@areae.com', 'bc4331c461ea5a489f87fe5bca945c2edc3de6ab', '541f7e14cb7ba8243eacb1b778776f1083fcea9c'),
(24, 'Abd', '', '', 'Abd@abd.abd', '2cbbd925e68ff7d01ce2676b2a1efe260dafea40', '523f4816e46d27c230cc31ec2b5cb70a4277bd5e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_ibfk_1` (`product_id`),
  ADD KEY `users_ibfk_1` (`user_id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
