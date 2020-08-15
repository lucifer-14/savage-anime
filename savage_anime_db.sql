-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2020 at 12:03 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `savage_anime_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `animes`
--

CREATE TABLE `animes` (
  `id` int(11) NOT NULL,
  `name1` varchar(200) NOT NULL,
  `name2` varchar(200) DEFAULT NULL,
  `name3` varchar(200) DEFAULT NULL,
  `season` int(11) NOT NULL,
  `animeType` varchar(8) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `genre` varchar(200) NOT NULL,
  `releasedDate_Month` varchar(15) NOT NULL,
  `releasedDate_Year` varchar(4) NOT NULL,
  `status` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animes`
--

INSERT INTO `animes` (`id`, `name1`, `name2`, `name3`, `season`, `animeType`, `photo`, `description`, `genre`, `releasedDate_Month`, `releasedDate_Year`, `status`, `active`) VALUES
(1, 'Naruto', 'a', '', 1, 'Series', '\r\n../user_img/5f36ef80bc153.jpg', 'He is a ninja boy who wants to be Hokage. He will train his best to reach his goal.', 'Action', 'April', '2014', 'Completed', 1),
(5, 'No Game no Life', '', '', 1, 'Series', '\r\n../user_img/5f36efaf7a7af.jpg', '', 'Adventure, Ecchi, Fantasy', 'March', '2018', 'Completed', 1),
(6, 'Haikyu!', '', '', 1, 'Series', '\r\n../user_img/5f36efc3b1737.jpg', 'Just sample', 'Sports, Comedy', 'August', '2000', 'Completed', 1),
(49, 'Kings Avatar', 'Quanzhi Gaoshou', '', 1, 'Series', '\r\n../user_img/5f36ef9f5092b.jpg', 'Esports Anime', 'Action, Adventure, Esports', 'April', '2018', 'Completed', 1),
(50, 'Your Name', 'Kimi no Na wa', '', 0, 'Movie', '\r\n../user_img/5f36f0b237c23.jpg', 'Romance anime', 'Romance', 'March', '2017', 'Completed', 1),
(54, 'Tokyo Ghoul', '', '', 1, 'Series', '\r\n../user_img/5f36f08f2a690.jpg', 'GHouls and humans', 'Action, Horror', 'February', '2017', 'Completed', 1),
(55, 'Tokyo Ghoul', '', '', 2, 'Series', '\r\n../user_img/5f36f0a0ab527.jpg', 'Second season of Tokyo Ghoul.', 'Action, Horror', 'March', '2018', 'Completed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `latestDate` datetime NOT NULL,
  `animeId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `episode`, `url`, `latestDate`, `animeId`, `active`) VALUES
(1, 1, 'lol', '2020-08-10 11:37:33', 1, 1),
(2, 3, 'lol3', '2020-08-10 22:07:27', 5, 1),
(3, 2, 'hola', '2020-08-10 11:38:48', 5, 1),
(4, 1, '1', '2020-08-10 21:50:52', 5, 1),
(5, 2, NULL, '0000-00-00 00:00:00', 1, 1),
(6, 4, 'lol5', '2020-08-12 14:38:38', 5, 1),
(7, 1, 'yn1', '2020-08-12 09:35:22', 50, 1),
(8, 1, NULL, '2020-08-12 00:00:00', 49, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favouritedanimes`
--

CREATE TABLE `favouritedanimes` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `animeId` int(11) NOT NULL,
  `processedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favouritedanimes`
--

INSERT INTO `favouritedanimes` (`id`, `userId`, `animeId`, `processedDate`) VALUES
(7, 2, 49, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `towatchlist`
--

CREATE TABLE `towatchlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `animeId` int(11) NOT NULL,
  `processedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `registeredDate` datetime NOT NULL,
  `photo` varchar(50) NOT NULL,
  `role` varchar(7) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `isDeactivated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `gender`, `registeredDate`, `photo`, `role`, `active`, `isDeactivated`) VALUES
(1, 'SystemAdmin', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'tharhtetnyann@gmail.com', '09263110011', 'Male', '2020-08-09 08:45:45', '\r\n../user_img/5f36e63a55d2c.jpg', 'Admin', 1, 0),
(2, 'User1', '202cb962ac59075b964b07152d234b70', 'user1@gmail.com', '0954147901', 'Male', '2020-08-10 07:38:25', 'user_img/5f363f318b1d5.jpg', 'User', 1, 0),
(3, 'User2', '250cf8b51c773f3f8dc8b4be867a9a02', 'user2@gmail.com', '092631100111', 'Female', '2020-08-10 23:57:03', '', 'User', 1, 0),
(4, 'User3', '202cb962ac59075b964b07152d234b70', 'user3@gmail.com', '09443198300', 'Male', '2020-08-14 12:57:08', '', 'User', 1, 0),
(5, 'User4', '250cf8b51c773f3f8dc8b4be867a9a02', 'user4@gmail.com', '095989403', 'Male', '2020-08-14 13:06:54', 'user_img/5f36376fc5bbf.jpg', 'User', 1, 0),
(6, 'User5', '202cb962ac59075b964b07152d234b70', 'user5@gmail.com', '09263440443', 'Male', '2020-08-14 13:37:53', '\r\nuser_img/5f36e26db62d5.jpg', 'User', 1, 0),
(9, 'ssafs', '202cb962ac59075b964b07152d234b70', 'aasf@gmail.com', '34424', 'Female', '2020-08-15 11:02:20', '', 'User', 1, 0),
(10, 'tt', '202cb962ac59075b964b07152d234b70', 'sss@gmail.com', '24', 'Female', '2020-08-15 11:04:36', '', 'User', 1, 0),
(11, 'ss', '698d51a19d8a121ce581499d7b701668', '11@gmail.com', '11', 'Female', '2020-08-15 11:10:26', '', 'User', 1, 0),
(12, '22', 'b6d767d2f8ed5d21a44b0e5886680cb9', '22@gmail.com', '22', 'Male', '2020-08-15 11:12:16', '', 'User', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `animeId` int(11) NOT NULL,
  `monthlyVisits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `animeId`, `monthlyVisits`) VALUES
(3, 1, 22),
(4, 5, 140),
(5, 6, 12),
(6, 49, 34),
(7, 50, 5),
(8, 54, 1),
(9, 55, 0);

-- --------------------------------------------------------

--
-- Table structure for table `watchhistory`
--

CREATE TABLE `watchhistory` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `episodeId` int(11) NOT NULL,
  `processedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watchhistory`
--

INSERT INTO `watchhistory` (`id`, `userId`, `episodeId`, `processedDate`) VALUES
(26, 1, 1, '0000-00-00 00:00:00'),
(27, 2, 6, '2020-08-14 02:00:25'),
(28, 2, 6, '2020-08-14 02:00:36'),
(29, 2, 5, '2020-08-14 02:00:42'),
(30, 2, 8, '2020-08-14 02:01:02'),
(31, 2, 8, '2020-08-14 02:02:24'),
(32, 2, 8, '2020-08-14 02:15:10'),
(33, 2, 8, '2020-08-14 02:17:14'),
(34, 2, 8, '2020-08-14 02:19:35'),
(35, 2, 8, '2020-08-14 02:19:57'),
(36, 2, 8, '2020-08-14 02:20:43'),
(37, 2, 8, '2020-08-14 02:23:43'),
(38, 2, 8, '2020-08-14 02:23:48'),
(39, 2, 8, '2020-08-14 02:25:34'),
(40, 2, 8, '2020-08-14 02:25:37'),
(41, 2, 8, '2020-08-14 02:26:13'),
(42, 2, 8, '2020-08-14 02:27:12'),
(43, 2, 8, '2020-08-14 02:28:08'),
(44, 2, 8, '2020-08-14 02:28:54'),
(45, 2, 8, '2020-08-14 02:29:57'),
(46, 2, 8, '2020-08-14 02:30:07'),
(47, 2, 8, '2020-08-14 02:30:09'),
(48, 2, 8, '2020-08-14 02:30:41'),
(49, 2, 8, '2020-08-14 02:30:57'),
(50, 2, 8, '2020-08-14 02:31:13'),
(51, 2, 8, '2020-08-14 02:32:00'),
(52, 2, 6, '2020-08-14 02:35:13'),
(53, 2, 6, '2020-08-14 02:35:33'),
(54, 2, 6, '2020-08-14 02:36:31'),
(55, 2, 6, '2020-08-14 02:53:16'),
(56, 2, 6, '2020-08-14 02:56:10'),
(57, 2, 6, '2020-08-14 02:57:48'),
(58, 2, 6, '2020-08-14 02:58:33'),
(59, 2, 6, '2020-08-14 02:58:51'),
(60, 2, 6, '2020-08-14 02:59:15'),
(61, 2, 6, '2020-08-14 02:59:53'),
(62, 2, 6, '2020-08-14 02:59:57'),
(63, 2, 6, '2020-08-14 03:00:03'),
(64, 2, 6, '2020-08-14 03:00:27'),
(65, 2, 6, '2020-08-14 03:00:29'),
(66, 2, 6, '2020-08-14 03:01:06'),
(67, 2, 6, '2020-08-14 03:01:15'),
(68, 2, 6, '2020-08-14 03:07:29'),
(69, 2, 6, '2020-08-14 03:07:47'),
(70, 2, 6, '2020-08-14 03:08:07'),
(71, 2, 6, '2020-08-14 03:10:24'),
(72, 2, 6, '2020-08-14 03:10:26'),
(73, 2, 6, '2020-08-14 03:12:44'),
(74, 2, 6, '2020-08-14 03:14:05'),
(75, 2, 6, '2020-08-14 03:15:18'),
(76, 2, 6, '2020-08-14 03:15:25'),
(77, 2, 6, '2020-08-14 03:16:05'),
(78, 2, 6, '2020-08-14 03:16:52'),
(79, 2, 6, '2020-08-14 03:19:05'),
(80, 2, 6, '2020-08-14 03:20:40'),
(81, 2, 6, '2020-08-14 03:24:19'),
(82, 0, 6, '2020-08-14 08:25:35'),
(83, 2, 7, '2020-08-14 08:29:03'),
(84, 2, 6, '2020-08-14 08:31:49'),
(85, 2, 6, '2020-08-14 08:36:46'),
(86, 2, 6, '2020-08-14 08:37:08'),
(87, 2, 6, '2020-08-14 08:38:54'),
(88, 2, 6, '2020-08-14 08:40:04'),
(89, 2, 6, '2020-08-14 08:40:27'),
(90, 2, 6, '2020-08-14 08:40:30'),
(91, 2, 6, '2020-08-14 08:40:59'),
(92, 2, 6, '2020-08-14 08:41:56'),
(93, 2, 6, '2020-08-14 08:43:01'),
(94, 2, 6, '2020-08-14 08:43:39'),
(95, 2, 6, '2020-08-14 08:44:18'),
(96, 2, 6, '2020-08-14 08:44:48'),
(97, 2, 6, '2020-08-14 08:45:54'),
(98, 2, 6, '2020-08-14 08:46:59'),
(99, 2, 6, '2020-08-14 08:47:17'),
(100, 2, 6, '2020-08-14 08:47:36'),
(101, 2, 6, '2020-08-14 08:47:49'),
(102, 2, 6, '2020-08-14 08:48:04'),
(103, 2, 6, '2020-08-14 08:48:24'),
(104, 2, 6, '2020-08-14 08:48:59'),
(105, 2, 6, '2020-08-14 09:03:15'),
(106, 2, 6, '2020-08-14 09:04:21'),
(107, 2, 6, '2020-08-14 09:04:43'),
(108, 2, 6, '2020-08-14 09:05:03'),
(109, 2, 6, '2020-08-14 09:05:47'),
(110, 2, 6, '2020-08-14 09:06:28'),
(111, 2, 6, '2020-08-14 09:06:32'),
(112, 2, 6, '2020-08-14 09:07:10'),
(113, 2, 6, '2020-08-14 09:07:29'),
(114, 2, 6, '2020-08-14 09:09:06'),
(115, 2, 6, '2020-08-14 09:09:38'),
(116, 2, 6, '2020-08-14 09:10:12'),
(117, 2, 6, '2020-08-14 09:10:53'),
(118, 2, 6, '2020-08-14 09:11:20'),
(119, 2, 6, '2020-08-14 09:16:00'),
(120, 2, 6, '2020-08-14 09:18:26'),
(121, 2, 6, '2020-08-14 09:23:30'),
(122, 2, 6, '2020-08-14 09:25:27'),
(123, 2, 3, '2020-08-14 09:25:39'),
(124, 2, 3, '2020-08-14 09:27:11'),
(125, 2, 3, '2020-08-14 09:27:32'),
(126, 2, 3, '2020-08-14 09:27:46'),
(127, 2, 3, '2020-08-14 09:27:58'),
(128, 2, 3, '2020-08-14 09:28:16'),
(129, 2, 3, '2020-08-14 09:28:34'),
(130, 2, 3, '2020-08-14 09:28:44'),
(131, 2, 3, '2020-08-14 09:29:02'),
(132, 2, 3, '2020-08-14 09:31:44'),
(133, 2, 3, '2020-08-14 09:32:16'),
(134, 2, 3, '2020-08-14 09:32:43'),
(135, 2, 3, '2020-08-14 09:33:29'),
(136, 2, 3, '2020-08-14 09:33:39'),
(137, 2, 3, '2020-08-14 09:34:35'),
(138, 2, 3, '2020-08-14 09:35:08'),
(139, 2, 6, '2020-08-14 09:35:13'),
(140, 2, 6, '2020-08-14 09:37:29'),
(141, 2, 6, '2020-08-14 09:37:58'),
(142, 2, 6, '2020-08-14 09:41:09'),
(143, 2, 6, '2020-08-14 09:41:40'),
(144, 2, 6, '2020-08-14 09:41:49'),
(145, 2, 6, '2020-08-14 09:43:06'),
(146, 2, 6, '2020-08-14 09:43:54'),
(147, 2, 6, '2020-08-14 09:44:04'),
(148, 2, 6, '2020-08-14 09:44:29'),
(149, 2, 6, '2020-08-14 09:44:38'),
(150, 2, 6, '2020-08-14 09:45:10'),
(151, 2, 6, '2020-08-14 09:46:43'),
(152, 2, 6, '2020-08-14 09:49:36'),
(153, 2, 6, '2020-08-14 09:49:52'),
(154, 2, 6, '2020-08-14 09:49:54'),
(155, 2, 6, '2020-08-14 09:50:14'),
(156, 2, 6, '2020-08-14 09:50:27'),
(157, 2, 4, '2020-08-14 09:50:50'),
(158, 2, 4, '2020-08-14 09:51:34'),
(159, 2, 4, '2020-08-14 09:51:53'),
(160, 2, 6, '2020-08-14 09:52:27'),
(161, 2, 2, '2020-08-14 09:52:32'),
(162, 2, 2, '2020-08-14 09:58:19'),
(163, 2, 0, '2020-08-14 09:58:28'),
(164, 2, 0, '2020-08-14 09:58:50'),
(165, 2, 8, '2020-08-14 09:58:53'),
(166, 2, 6, '2020-08-14 09:59:58'),
(167, 2, 3, '2020-08-14 10:00:03'),
(168, 2, 8, '2020-08-14 10:00:13'),
(169, 2, 6, '2020-08-14 10:02:38'),
(170, 2, 4, '2020-08-14 12:08:07'),
(172, 2, 4, '2020-08-14 12:09:36'),
(173, 2, 4, '2020-08-14 12:09:43'),
(174, 2, 6, '2020-08-14 12:09:52'),
(175, 2, 2, '2020-08-14 12:10:02'),
(176, 2, 4, '2020-08-14 12:10:09'),
(177, 2, 3, '2020-08-14 12:10:12'),
(178, 2, 2, '2020-08-14 12:10:16'),
(179, 2, 8, '2020-08-14 12:10:45'),
(180, 2, 2, '2020-08-14 12:10:54'),
(181, 5, 6, '2020-08-14 13:07:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animeId` (`animeId`);

--
-- Indexes for table `favouritedanimes`
--
ALTER TABLE `favouritedanimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `animeId` (`animeId`);

--
-- Indexes for table `towatchlist`
--
ALTER TABLE `towatchlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `animeId` (`animeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watchhistory`
--
ALTER TABLE `watchhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`,`episodeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animes`
--
ALTER TABLE `animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `favouritedanimes`
--
ALTER TABLE `favouritedanimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `towatchlist`
--
ALTER TABLE `towatchlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `watchhistory`
--
ALTER TABLE `watchhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
