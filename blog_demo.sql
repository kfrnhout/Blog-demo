-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2021 at 08:44 PM
-- Server version: 5.7.35
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `subtitel` varchar(255) NOT NULL,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `preview_text` text NOT NULL,
  `main_text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`id`, `titel`, `subtitel`, `published_at`, `preview_text`, `main_text`, `image`, `archived`) VALUES
(1, 'First post', 'just to test', '2021-08-14 10:03:26', 'preview text', 'full text', NULL, 0),
(2, 'post 2', 'post 2 sub', '2021-08-14 14:13:47', 'post 2 preview', 'post 2 full', NULL, 0),
(3, 'post 3', 'post 3 sub', '2021-08-14 14:14:01', 'post 3 preview', 'post 3 full', NULL, 0),
(4, 'post 4', 'post 4 sub', '2021-08-14 14:14:43', 'post 4 preview', 'post 4 full', NULL, 0),
(5, 'post 5', 'post 5 sub', '2021-08-14 14:14:52', 'post 5 preview', 'post 5 full', NULL, 0),
(6, 'post 6', 'post 6 sub', '2021-08-14 14:15:10', 'post 6 previe', 'post 6 full', NULL, 0),
(7, 'Eerste Konijn gaat naar school', 'en hij heeft een rugtas', '2021-08-15 16:16:08', 'Voor het eerst woord een konijn nu toegelaten als scholier', 'Sins kort worden konijnen nu toegelaten in het openbaar onderwijs, hijbij een foto van de eerste konijn scholier', 'Bunny-with-backpack-611921a84f2a0.jpg', 0),
(8, 'test', 'test', '2021-08-15 16:40:45', '<p>test</p>', '<p>test</p>', NULL, 1),
(9, 'Long test', 'Long test', '2021-08-16 16:04:04', '<p>test testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>', '<p>test testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>', NULL, 1),
(10, 'Lorem Ipsum', 'Lorem Ipsum', '2021-08-17 16:17:15', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In erat sem, pretium eleifend tristique id, iaculis sollicitudin enim. Ut ac ultrices quam. In vitae elit nec orci consectetur molestie. Duis condimentum ligula sit amet ipsum interdum scelerisque. Curabitur nec libero vitae nulla rhoncus porttitor quis id sem. Nullam est nibh, volutpat eu lectus sit amet, interdum pharetra lacus. Sed eget pharetra felis. Praesent commodo vel tortor a bibendum. Nullam lobortis odio et leo pharetra bibendum. Fusce a diam non sem scelerisque commodo. Suspendisse vitae dolor ut urna congue fermentum.</p>', '<p>Vestibulum laoreet, erat sit amet imperdiet faucibus, ipsum lacus ornare augue, in dapibus enim quam non velit. Duis maximus eu diam sed interdum. In dictum tempor dolor ut euismod. Integer molestie imperdiet metus non rhoncus. Maecenas ultrices nisl est. Etiam nulla magna, lacinia at felis sed, vulputate vulputate arcu. In luctus lectus quis dui rhoncus convallis.</p>\r\n\r\n<p>Pellentesque ultrices lectus sem, ut placerat ante molestie sit amet. Cras rutrum lobortis orci, id iaculis ligula aliquet eu. Suspendisse orci ipsum, pellentesque at augue nec, condimentum feugiat augue. Phasellus finibus purus eget est aliquet, sed volutpat mi pharetra. Mauris molestie turpis risus, a eleifend ligula vestibulum vitae. Fusce iaculis, justo tincidunt fermentum fringilla, felis dolor venenatis sapien, quis posuere lectus dui non libero. Quisque bibendum ornare tincidunt. Quisque massa ipsum, consectetur id rhoncus pharetra, sagittis vitae neque. Donec enim neque, tincidunt vitae turpis non, auctor ultrices ipsum. Sed et volutpat metus, nec laoreet augue. Suspendisse consectetur ante ac urna bibendum, vitae lobortis dolor efficitur. Vestibulum a orci id erat tempor euismod vel vitae arcu. Integer finibus tristique mi a mollis.</p>\r\n\r\n<p>Quisque et luctus lacus. Morbi id urna sapien. Praesent ullamcorper ornare turpis. Quisque in lectus tempor, tempor arcu eget, volutpat nisi. Mauris id velit porta, placerat metus sit amet, porta leo. Morbi vel dui semper, posuere eros ut, accumsan sem. Praesent pellentesque sed mauris in dapibus.</p>\r\n\r\n<p>Phasellus elementum purus nisi, vitae eleifend leo iaculis vel. Sed sodales, mi quis viverra venenatis, dolor mi aliquet est, ut lobortis tellus est sit amet nibh. Cras porttitor libero et quam malesuada, in hendrerit nulla pulvinar. Etiam et sem nec nibh iaculis aliquam. Fusce ornare urna felis, sit amet vehicula dolor euismod quis. Nunc efficitur bibendum purus, ut egestas metus varius vel. Curabitur eget commodo dui. Aenean efficitur ante a dolor auctor varius. Aliquam magna neque, euismod non convallis in, congue ut elit.</p>', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`id`, `post_id`, `username`, `text`, `timestamp`) VALUES
(1, 7, 'kat', '<p>kat</p>', '2021-08-16 16:20:51'),
(2, 7, 'kat', '<p>geen kat</p>', '2021-08-16 17:10:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
