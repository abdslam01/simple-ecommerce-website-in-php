-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2020 at 02:18 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id12753165_proj`
--

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
(51, 'Ordinateur Portble', 3500, 'img/black-laptop.jpg', 8);

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
(3, 'écouteurs', 120, 'img/headphones.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `token`) VALUES
(8, 'Abdessalam', 'zomiix246@gmail.com', '1aeb77097ec68710d996bf884f0c8d7a22823187', 'd8fffac2a1d91ce9fd6d8c98ad39cb37746f8701'),
(9, 'Abd ', 'phenixa@outlook.fr', '2e855aa226fc8b43085df415f6b1159e93df12a4', '12a2c56ad0a24e19453c6962adff0efdee60db9d'),
(10, 'youness', 'tobahfhrvr@gmail.com', 'aa44ec4eaffc843f55f37b0958a58a9e3ae71c02', '926bf49419d522439efd234ecf8c7ebe4f271a77'),
(11, 'moha', 'mabrok.00025@gmail.com', 'be207c21beaa67b47d88a2180c25ca78a7aef07c', '7cbde987e7b288d69b612b0fce075edb89d962ec'),
(12, 'Test', 'zomiix246@gmail.com', '012e871e0fe8d3dc32d86f51e70f6911130de319', '3d20f33c4067b2e67e0e5b4ae2f9a9f048eb06ae'),
(14, 'Boghroch', 'bighrach@gmail.com', 'd2d0eefb9b5f70c0973dd56c092bc8d73c0a5ba1', '047fa4d1d03fe0dccd44b973528e265dd985b8de'),
(15, 'olala', 'aaaaaa@gmail.com', '732f26afb319e1b9b669dcb71a9d350aef7e7332', 'a0d3fe3ef864cf4f794b8477461e63d8dcb7a93b'),
(16, 'hhh', 'jhhh@ijh', 'f0d660f1ebdf15b87ca8f83e0b872b1b3909a96f', 'f0f13f2f87b528df060da15c772edc841c920a8b'),
(17, 'User', 'user@user.user', '89884b61c198a4e41ea03b7d6fdabd2f3d6d9e07', 'c5bbb38243d1ca6975a64a3b87ad95ea0b0ae5ef'),
(18, 'ayoub', 'a@a.com', '1f060fcad10a29b5ee39c321d1914dcca24c5aef', '5a5d8949b80f4b307e538f0984e5ce133d9de2a0'),
(19, 'ahmed', 'ahmed@gmail.com', 'cc23d84cbd27d076a5a71882e537509281240c7e', 'b3883111c7370dc12853ec063a8aae5f72eb150e'),
(20, 'Omar', 'abcdelouafi@gmail.com', 'cc23d84cbd27d076a5a71882e537509281240c7e', '363de26132c0d216709cba72fe250383c54c25cc'),
(21, 'te', 'aarezrae@areae.com', 'bc4331c461ea5a489f87fe5bca945c2edc3de6ab', '541f7e14cb7ba8243eacb1b778776f1083fcea9c');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
