-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2014 at 08:35 PM
-- Server version: 5.5.37-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `admintem_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_title` varchar(255) NOT NULL,
  `contact_name` varchar(45) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `contact_content` text NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(11) NOT NULL DEFAULT '0',
  `post_time` datetime DEFAULT NULL,
  `poster_ip` varchar(20) DEFAULT NULL,
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_title`, `contact_name`, `contact_address`, `email`, `mobile`, `contact_content`, `publish`, `lock_status`, `post_time`, `poster_ip`, `publisher_id`, `publish_time`) VALUES
(114, 'Trang web rất đẹp', 'Phạm Đức Tùng', '28 Lạch Tray', 'ductungvn@gmail.com', '0912345678', 'trang web rat dep', 1, 1, '2013-05-28 16:05:12', '192.168.1.138', 0, '0000-00-00 00:00:00'),
(115, 'Trang web rất đẹp', 'Phạm Đức Tùng', '28 Lạch Tray', 'ductungvn@gmail.com', '0912345678', 'trang web rat dep', 1, 1, '2013-05-28 16:05:15', '192.168.1.138', 0, '0000-00-00 00:00:00'),
(116, 'tôi muốn đi du lịch nha trang', 'tùng', 'trần phú', 'tung@gmail.com', '0123456', 'tôi muốn đi du lịch nha trang', 1, 1, '2013-05-28 16:05:53', '192.168.1.138', 0, '0000-00-00 00:00:00'),
(117, 'toi muon hoi gia tour', 'Pham Duc Tung', '275 Lach Tray', 'tung@gmail.com', '0972862666', 'toi muon hoi gia tour', 1, 1, '2013-06-07 15:06:46', '192.168.1.138', 0, '0000-00-00 00:00:00'),
(118, 'toi muon hoi gia tour', 'Pham Duc Tung', '275 Lach Tray', 'tung@gmail.com', '0972862666', 'toi muon hoi gia tour', 1, 1, '2013-06-07 15:06:13', '192.168.1.138', 0, '0000-00-00 00:00:00'),
(119, 'toi muon hoi gia tour', 'Pham Duc Tung', '275 Lach Tray', 'tung@gmail.com', '0972862666', 'toi muon hoi gia tour', 1, 1, '2013-06-07 15:06:06', '192.168.1.138', 0, '0000-00-00 00:00:00'),
(120, 'toi muon hoi gia tour', 'Pham Duc Tung', '275 Lach Tray', 'tung@gmail.com', '0972862666', 'toi muon hoi gia tour', 1, 1, '2013-06-07 15:06:24', '192.168.1.138', 0, '0000-00-00 00:00:00'),
(121, 'toi muon hoi gia tour', 'Pham Duc Tung', '275 Lach Tray', 'tung@gmail.com', '0972862666', 'toi muon hoi gia tour', 1, 1, '2013-06-07 22:06:24', '192.168.1.102', 0, '0000-00-00 00:00:00'),
(122, 'toi muon hoi gia tour', 'Pham Duc Tung', '275 Lach Tray', 'tung@gmail.com', '0972862666', 'toi muon hoi gia tour', 1, 1, '2013-06-07 22:06:44', '192.168.1.102', 5, '2013-07-12 20:07:54'),
(123, 'Không cần nhập', 'pham duc tung', 'Không cần nhập', 'tug@gmail.com', '0123456789', 'test', 1, 1, '2014-06-20 23:06:22', '192.168.1.102', 0, '0000-00-00 00:00:00'),
(124, 'Không cần nhập', 'pham duc tung', 'Không cần nhập', 'a@gmail.com', '0123456789', 'tet', 1, 1, '2014-06-20 23:06:50', '192.168.1.102', 0, '0000-00-00 00:00:00'),
(125, 'Không cần nhập', 'pham duc tung', 'Không cần nhập', 'a@gmail.com', '0123456789', 'tet', 1, 1, '2014-06-20 23:06:36', '192.168.1.102', 0, '0000-00-00 00:00:00'),
(126, 'Không cần nhập', 'pham duc tung', 'Không cần nhập', 'a@gmail.com', '0123456789', 'tet', 1, 1, '2014-06-20 23:06:39', '192.168.1.102', 0, '0000-00-00 00:00:00'),
(127, 'Không cần nhập', 'pham duc tung', 'Không cần nhập', 'a@gmail.com', '0123456789', 'tet', 1, 1, '2014-06-20 23:06:42', '192.168.1.102', 0, '0000-00-00 00:00:00'),
(128, 'Không cần nhập', 'pham duc tung', 'Không cần nhập', 'tung@gmail.com', '0972862666', 'test', 1, 1, '2014-06-28 16:06:50', '192.168.1.112', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_name` varchar(200) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cover_image` varchar(100) DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `publish` int(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `view_counter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery_name`, `description`, `cover_image`, `created_time`, `created_id`, `last_modified_time`, `last_modified_id`, `order`, `status`, `lock_status`, `publish`, `publisher_id`, `publish_time`, `view_counter`) VALUES
(71, 'Giải bóng đá mùa xuân 2013', NULL, 'galleryimage_1366191933516e6f3d5aff0.jpg', '2013-04-17 16:04:33', 42, '0000-00-00 00:00:00', 0, 1, 0, 0, 1, 42, '2013-04-17 16:04:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL DEFAULT '0',
  `gallery_image` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(11) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `gallery_image`, `image_title`, `publish`, `order`, `lock_status`, `created_id`, `created_time`, `publisher_id`, `publish_time`) VALUES
(17, 71, 'galleryimage_1366192069516e6fc576069.jpg', 'bong da 1', 1, 1, 0, 42, '2013-04-17 16:04:49', 42, '2013-04-17 16:04:49'),
(18, 71, 'galleryimage_1366192081516e6fd11cacd.jpg', 'bong da 2', 1, 2, 0, 42, '2013-04-17 16:04:01', 42, '2013-04-17 16:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `log_client_access`
--

CREATE TABLE IF NOT EXISTS `log_client_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_ip` varchar(64) NOT NULL DEFAULT '0',
  `client_access_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=697 ;

--
-- Dumping data for table `log_client_access`
--

INSERT INTO `log_client_access` (`id`, `client_ip`, `client_access_time`) VALUES
(93, '192.168.1.101', '2013-05-23 23:05:24'),
(94, '192.168.1.101', '2013-05-24 08:05:55'),
(95, '192.168.1.101', '2013-05-24 09:05:56'),
(96, '192.168.1.101', '2013-05-24 10:05:22'),
(97, '192.168.1.101', '2013-05-24 11:05:19'),
(98, '192.168.1.101', '2013-05-24 11:05:22'),
(99, '192.168.1.101', '2013-05-24 11:05:32'),
(100, '192.168.1.101', '2013-05-24 14:05:54'),
(101, '192.168.1.101', '2013-05-24 14:05:18'),
(102, '192.168.1.101', '2013-05-24 14:05:58'),
(103, '192.168.1.101', '2013-05-24 14:05:27'),
(104, '192.168.1.101', '2013-05-24 14:05:26'),
(105, '192.168.1.101', '2013-05-24 14:05:54'),
(106, '192.168.1.101', '2013-05-24 14:05:24'),
(107, '192.168.1.101', '2013-05-24 14:05:31'),
(108, '192.168.1.101', '2013-05-24 14:05:32'),
(109, '192.168.1.101', '2013-05-24 14:05:36'),
(110, '192.168.1.101', '2013-05-24 14:05:24'),
(111, '192.168.1.101', '2013-05-24 14:05:39'),
(112, '192.168.1.101', '2013-05-24 14:05:59'),
(113, '192.168.1.101', '2013-05-24 14:05:49'),
(114, '192.168.1.101', '2013-05-24 14:05:58'),
(115, '192.168.1.101', '2013-05-24 14:05:15'),
(116, '192.168.1.101', '2013-05-24 15:05:02'),
(117, '192.168.1.101', '2013-05-24 15:05:15'),
(118, '192.168.1.101', '2013-05-24 15:05:34'),
(119, '192.168.1.101', '2013-05-24 15:05:10'),
(120, '192.168.1.101', '2013-05-24 15:05:25'),
(121, '192.168.1.101', '2013-05-24 15:05:17'),
(122, '192.168.1.101', '2013-05-24 15:05:14'),
(509, '192.168.1.138', '2013-07-31 17:37:32'),
(510, '192.168.1.138', '2013-07-31 17:46:11'),
(511, '192.168.1.138', '2013-07-31 17:46:16'),
(512, '192.168.1.100', '2013-07-31 21:21:46'),
(513, '192.168.1.100', '2013-07-31 22:08:45'),
(514, '192.168.1.100', '2013-07-31 22:30:40'),
(515, '192.168.1.100', '2013-07-31 22:34:22'),
(516, '192.168.1.100', '2013-07-31 22:40:57'),
(517, '192.168.1.100', '2013-07-31 22:41:21'),
(518, '192.168.1.100', '2013-07-31 22:41:48'),
(519, '192.168.1.100', '2013-07-31 22:45:16'),
(520, '192.168.1.100', '2013-07-31 22:51:17'),
(521, '192.168.1.100', '2013-07-31 22:52:03'),
(522, '192.168.1.100', '2013-07-31 22:53:09'),
(523, '192.168.1.100', '2013-07-31 22:56:11'),
(524, '192.168.1.100', '2013-07-31 22:56:26'),
(525, '192.168.1.100', '2013-07-31 23:05:23'),
(526, '192.168.1.100', '2013-07-31 23:06:30'),
(527, '192.168.1.100', '2013-07-31 23:06:45'),
(528, '192.168.1.100', '2013-07-31 23:08:53'),
(529, '192.168.1.100', '2013-07-31 23:10:44'),
(530, '192.168.1.100', '2013-07-31 23:10:58'),
(531, '192.168.1.100', '2013-07-31 23:11:21'),
(532, '192.168.1.100', '2013-07-31 23:11:38'),
(533, '192.168.1.102', '2013-08-01 21:41:29'),
(534, '192.168.1.102', '2013-08-01 21:50:00'),
(535, '192.168.1.102', '2013-08-01 21:50:44'),
(536, '192.168.1.102', '2013-08-01 21:50:49'),
(537, '192.168.1.102', '2013-08-01 21:51:48'),
(538, '192.168.1.102', '2013-08-01 21:51:54'),
(539, '192.168.1.102', '2013-08-01 21:52:56'),
(540, '192.168.1.102', '2013-08-01 22:04:18'),
(541, '192.168.1.102', '2013-08-01 22:07:07'),
(542, '192.168.1.102', '2013-08-01 22:13:17'),
(543, '192.168.1.102', '2013-08-01 22:14:46'),
(544, '192.168.1.102', '2013-08-01 22:15:23'),
(545, '192.168.1.102', '2013-08-01 22:18:08'),
(546, '192.168.1.102', '2013-08-01 22:19:45'),
(547, '192.168.1.102', '2013-08-01 22:34:26'),
(548, '192.168.1.101', '2013-08-25 14:29:09'),
(549, '192.168.1.101', '2013-08-25 14:29:21'),
(550, '192.168.1.101', '2013-08-25 14:33:16'),
(551, '192.168.1.101', '2013-08-25 14:34:21'),
(552, '192.168.1.101', '2013-08-25 14:55:09'),
(553, '192.168.1.101', '2013-08-25 16:45:37'),
(554, '192.168.1.101', '2013-08-25 16:47:33'),
(555, '192.168.1.101', '2013-08-25 16:48:14'),
(556, '192.168.1.101', '2013-08-25 16:48:44'),
(557, '192.168.1.101', '2013-08-25 17:11:33'),
(558, '192.168.1.101', '2013-08-25 17:11:56'),
(559, '192.168.1.101', '2013-08-25 17:13:28'),
(560, '192.168.1.101', '2013-08-25 17:13:47'),
(561, '192.168.1.101', '2013-08-25 17:21:57'),
(562, '192.168.1.101', '2013-08-25 17:24:17'),
(563, '192.168.1.101', '2013-08-25 17:25:21'),
(564, '192.168.1.101', '2013-08-25 17:26:08'),
(565, '192.168.1.101', '2013-08-25 17:28:26'),
(566, '192.168.1.101', '2013-08-25 17:28:41'),
(567, '192.168.1.101', '2013-08-25 17:30:21'),
(568, '192.168.1.101', '2013-08-25 17:33:57'),
(569, '192.168.1.101', '2013-08-25 17:34:01'),
(570, '192.168.1.101', '2013-08-25 17:35:15'),
(571, '192.168.1.101', '2013-08-25 17:38:51'),
(572, '192.168.1.101', '2013-08-25 17:40:20'),
(573, '192.168.1.101', '2013-08-25 17:43:50'),
(574, '192.168.1.101', '2013-08-25 17:46:46'),
(575, '192.168.1.101', '2013-08-25 17:46:49'),
(576, '192.168.1.101', '2013-08-25 17:48:14'),
(577, '192.168.1.101', '2013-08-25 17:51:15'),
(578, '192.168.1.2', '2014-06-18 16:36:17'),
(579, '192.168.1.2', '2014-06-18 16:48:27'),
(580, '192.168.1.2', '2014-06-18 16:51:40'),
(581, '192.168.1.2', '2014-06-18 16:58:03'),
(582, '192.168.1.2', '2014-06-18 17:01:52'),
(583, '192.168.1.2', '2014-06-18 17:03:29'),
(584, '192.168.1.103', '2014-06-18 22:06:27'),
(585, '192.168.1.103', '2014-06-18 22:17:33'),
(586, '192.168.1.103', '2014-06-18 22:18:07'),
(587, '192.168.1.103', '2014-06-18 22:18:48'),
(588, '192.168.1.103', '2014-06-18 22:19:12'),
(589, '192.168.1.103', '2014-06-18 22:19:22'),
(590, '192.168.1.103', '2014-06-18 22:20:13'),
(591, '192.168.1.103', '2014-06-18 22:21:59'),
(592, '192.168.1.103', '2014-06-18 22:22:25'),
(593, '192.168.1.103', '2014-06-18 22:22:35'),
(594, '192.168.1.103', '2014-06-18 22:23:37'),
(595, '192.168.1.103', '2014-06-18 22:23:55'),
(596, '192.168.1.103', '2014-06-18 22:32:03'),
(597, '192.168.1.103', '2014-06-18 22:32:25'),
(598, '192.168.1.103', '2014-06-18 22:33:56'),
(599, '192.168.1.103', '2014-06-18 22:34:03'),
(600, '192.168.1.103', '2014-06-18 22:34:07'),
(601, '192.168.1.103', '2014-06-18 22:34:35'),
(602, '192.168.1.103', '2014-06-18 22:35:24'),
(603, '192.168.1.103', '2014-06-18 22:36:43'),
(604, '192.168.1.103', '2014-06-18 22:36:51'),
(605, '192.168.1.103', '2014-06-18 22:41:53'),
(606, '192.168.1.103', '2014-06-18 23:12:29'),
(607, '192.168.1.103', '2014-06-18 23:12:53'),
(608, '192.168.1.103', '2014-06-18 23:13:32'),
(609, '192.168.1.103', '2014-06-18 23:13:38'),
(610, '192.168.1.103', '2014-06-18 23:14:54'),
(611, '192.168.1.103', '2014-06-18 23:15:55'),
(612, '192.168.1.3', '2014-06-19 09:07:00'),
(613, '192.168.1.3', '2014-06-19 09:10:29'),
(614, '192.168.1.3', '2014-06-19 09:10:40'),
(615, '192.168.1.3', '2014-06-19 15:00:42'),
(616, '192.168.1.3', '2014-06-19 15:36:26'),
(617, '192.168.1.102', '2014-06-19 22:53:31'),
(618, '192.168.1.8', '2014-06-20 09:03:42'),
(619, '192.168.1.8', '2014-06-20 14:30:11'),
(620, '192.168.1.8', '2014-06-20 14:33:24'),
(621, '192.168.1.8', '2014-06-20 17:29:53'),
(622, '192.168.1.8', '2014-06-20 17:30:03'),
(623, '192.168.1.8', '2014-06-20 17:32:01'),
(624, '192.168.1.101', '2014-06-22 22:11:23'),
(625, '192.168.1.101', '2014-06-22 22:11:44'),
(626, '192.168.1.7', '2014-06-23 11:12:01'),
(627, '192.168.1.7', '2014-06-23 16:14:14'),
(628, '192.168.1.102', '2014-06-23 22:55:38'),
(629, '192.168.1.4', '2014-06-24 10:15:25'),
(630, '192.168.1.4', '2014-06-24 10:52:02'),
(631, '192.168.1.4', '2014-06-24 14:32:57'),
(632, '192.168.1.4', '2014-06-24 15:29:49'),
(633, '192.168.1.4', '2014-06-24 15:35:11'),
(634, '192.168.1.4', '2014-06-24 15:35:23'),
(635, '192.168.1.4', '2014-06-24 15:36:22'),
(636, '192.168.1.4', '2014-06-24 15:37:10'),
(637, '192.168.1.4', '2014-06-24 15:37:39'),
(638, '192.168.1.4', '2014-06-24 15:38:42'),
(639, '192.168.1.4', '2014-06-24 15:40:24'),
(640, '192.168.1.4', '2014-06-24 15:41:01'),
(641, '192.168.1.4', '2014-06-24 15:42:36'),
(642, '192.168.1.4', '2014-06-24 15:43:31'),
(643, '192.168.1.4', '2014-06-24 15:47:16'),
(644, '192.168.1.4', '2014-06-24 15:47:24'),
(645, '192.168.1.4', '2014-06-24 15:51:36'),
(646, '192.168.1.4', '2014-06-24 15:52:43'),
(647, '192.168.1.4', '2014-06-24 15:58:18'),
(648, '192.168.1.4', '2014-06-24 15:59:30'),
(649, '192.168.1.4', '2014-06-24 15:59:59'),
(650, '192.168.1.4', '2014-06-24 16:00:58'),
(651, '192.168.1.4', '2014-06-24 16:01:37'),
(652, '192.168.1.4', '2014-06-24 16:02:34'),
(653, '192.168.1.4', '2014-06-24 16:03:14'),
(654, '192.168.1.4', '2014-06-24 16:03:58'),
(655, '192.168.1.4', '2014-06-24 16:04:16'),
(656, '192.168.1.4', '2014-06-24 16:05:37'),
(657, '192.168.1.4', '2014-06-24 16:05:37'),
(658, '192.168.1.4', '2014-06-24 16:05:37'),
(659, '192.168.1.4', '2014-06-24 16:05:38'),
(660, '192.168.1.4', '2014-06-24 16:05:38'),
(661, '192.168.1.4', '2014-06-24 16:05:38'),
(662, '192.168.1.4', '2014-06-24 16:06:49'),
(663, '192.168.1.4', '2014-06-24 16:25:47'),
(664, '192.168.1.4', '2014-06-24 16:25:57'),
(665, '192.168.1.4', '2014-06-24 16:32:45'),
(666, '192.168.1.4', '2014-06-24 16:33:07'),
(667, '192.168.1.4', '2014-06-24 16:34:05'),
(668, '192.168.1.4', '2014-06-24 16:34:29'),
(669, '192.168.1.4', '2014-06-24 16:34:51'),
(670, '192.168.1.4', '2014-06-24 16:35:12'),
(671, '192.168.1.4', '2014-06-24 16:35:42'),
(672, '192.168.1.4', '2014-06-24 16:45:31'),
(673, '192.168.1.4', '2014-06-24 16:49:43'),
(674, '192.168.1.4', '2014-06-24 16:50:04'),
(675, '192.168.1.4', '2014-06-24 16:51:20'),
(676, '192.168.1.4', '2014-06-24 16:58:59'),
(677, '192.168.1.4', '2014-06-24 17:01:04'),
(678, '192.168.1.4', '2014-06-24 17:01:51'),
(679, '192.168.1.4', '2014-06-24 17:02:39'),
(680, '192.168.1.4', '2014-06-24 17:05:49'),
(681, '192.168.1.4', '2014-06-24 17:06:14'),
(682, '192.168.1.101', '2014-06-24 22:23:34'),
(683, '192.168.1.101', '2014-06-24 22:26:04'),
(684, '192.168.1.101', '2014-06-24 22:27:12'),
(685, '192.168.1.101', '2014-06-24 22:27:51'),
(686, '192.168.1.101', '2014-06-24 22:28:05'),
(687, '192.168.1.101', '2014-06-24 22:28:58'),
(688, '192.168.1.101', '2014-06-24 22:29:05'),
(689, '192.168.1.101', '2014-06-24 22:29:12'),
(690, '192.168.1.101', '2014-06-24 22:29:12'),
(691, '192.168.1.102', '2014-06-25 22:46:46'),
(692, '192.168.1.102', '2014-06-25 23:19:04'),
(693, '192.168.1.2', '2014-06-26 09:43:25'),
(694, '192.168.1.2', '2014-06-26 09:59:48'),
(695, '192.168.1.2', '2014-06-26 09:59:52'),
(696, '192.168.1.2', '2014-06-26 16:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `news_article`
--

CREATE TABLE IF NOT EXISTS `news_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL,
  `article_brief` text NOT NULL,
  `article_content` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `publish` int(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `view_counter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `news_article`
--

INSERT INTO `news_article` (`id`, `article_title`, `article_brief`, `article_content`, `cover_image`, `status`, `publish`, `order`, `lock_status`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`, `view_counter`) VALUES
(56, 'Thần đồng piano Đức biểu diễn tại Việt Nam', 'Nữ nghệ sỹ dương cầm 22 tuổi Mona Asuka Ott sẽ là nhân vật chính của "Chương trình Hòa nhạc Hennessy" lần thứ 17 tại Nhà Hát Lớn Hà Nội vào ngày 12/6 tới.', '<div>\r\n	<strong>Nữ nghệ sỹ dương cầm 22 tuổi Mona Asuka Ott sẽ là nhân vật chính của "Chương trình Hòa nhạc Hennessy" lần thứ 17 tại Nhà Hát Lớn Hà Nội vào ngày 12/6 tới.</strong></div>\r\n<div>\r\n	<div>\r\n		Mona Asuka Ott sinh năm 1991 tại Munich, Đức và được coi là một trong những nghệ sĩ dương cầm trẻ xuất sắc nhất hiện nay. Cô cũng là nghệ sĩ trẻ tuổi nhất được mời biểu diễn trong chương trình hòa nhạc cổ điển Hennessy Concert Series tại Việt Nam.</div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<div style="text-align: center;">\r\n	<strong><img alt="" src="/public/files/images/piano.jpg" style="width: 482px; height: 300px;" /></strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<p>\r\n		Tờ Thời báo âm nhạc mới của Đức tháng 3/2011 viết về cô: “... Mona Asuka Ott diễn tấu vô cùng lôi cuốn, từ nốt nhạc đầu tiên cho tới nốt nhạc cuối cùng… khả năng làm chủ thành thục cây đàn và phong thái trình diễn tinh tế, thể hiện sự cảm nhận và am tường bản piano concerto số 2 của nhà soạn nhạc Rachmaninov”.</p>\r\n	<p>\r\n		Mona Asuka Ott sẽ chơi bản Sonate số 12, op. 26 cung La giáng trưởng nằm trong tập tác phẩm 32 bản sonate dành cho piano của Beethoven và hai bản Dạ khúc cung Đô thăng thứ, Op. 27 Số 1 và Dạ khúc cung Rê giáng trưởng, Op. 27 Số 2 của Chopin.&nbsp; Nhạc mục biểu diễn của Mona Asuka Ott còn có tác phẩm “Venezia e Napoli” (Venice và Napoli) của Liszt và Bốn khúc tức hứng, D899 của Schubert.</p>\r\n	<p>\r\n		Như thường lệ, chương trình chỉ diễn ra một đêm duy nhất nên buổi biểu diễn sẽ được truyền trực tiếp qua màn hình 500inch đặt tại Quảng trường Cách Mạng Tháng Tám trước Nhà Hát Lớn để phục vụ công chúng yêu nhạc cổ điển không có cơ hội vào trong Nhà hát.</p>\r\n	<p style="text-align: right;">\r\n		<em>(theo Vietnamnet)</em></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_137025519251ac6f585d37a.jpg', 0, 1, 24, 0, 5, '2013-06-03 17:06:32', 50, '2014-08-02 16:15:54', 50, '2014-08-02 16:15:54', 10),
(57, 'Myanmar - Nơi Bình Yên', 'Đất nước Myanmar cho đến nay vẫn được đánh giá là một trong những nơi bình yên nhất tại châu Á. Mặc dù về quốc gia giàu tài nguyên nhất thế giới nhưng về kinh tế vẫn bị kiệt quệ', '<div>\r\n	<strong>Đất nước Myanmar cho đến nay vẫn được đánh giá là một trong những nơi bình yên nhất tại châu Á. Mặc dù về quốc gia giàu tài nguyên nhất thế giới nhưng về kinh tế vẫn bị kiệt quệ, ảnh hưởng sau nhiều năm cấm vận của Mỹ và các nước phương Tây.</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" src="/public/files/images/mianma.jpg" style="width: 450px; height: 300px;" /></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Nhân dịp khảo sát các chương trình du lịch tôi cùng với một số cán bộ bên Du lịch Anz đến Myanmar khảo sát các tuyến điểm tại Myanmar. Du lịch Myanmar được khởi hành từ Hà Nội gần tới sân bay Yangon qua cánh cửa trên máy bay tôi cảm giác đang được đưa xuống một rừng vùng núi nào đó.</div>\r\n<div>\r\n	Qua quầy thủ tục an ninh rất sơ sài đơn giản cơ sở hệ thống sân bay không được hiện đại bằng sân bay Nội Bài của Việt Nam, lái xe và hướng dẫn viên&nbsp;du lịch&nbsp;Myanmar đưa chúng tôi về khách sạn. Qua các con phố tại Myamar đoàn chúng tôi cảm giác mình đang trở về những năm thập nhiên 90 của Việt Nam trở về trước, đường phố vắng vẻ hầu như không có một tiếng động cơ của xe máy, phương tiện vận chuyển ở Myanmar khá hiếm hầu như không có xe máy, phương tiện vận chuyển tại thành phố yangon chủ yếu là các xe ba bánh, xe bán tải, nhưng nhìn qua các phương tiện hầu như đều chuyên chở chật kín người.</div>\r\n<div>\r\n	Đến với đất nước Myanmar điểm dừng chân đầu tiên bạn phải ghé qua một ngôi chùa tại đất nước Phật giáo, nếu bỏ qua thực sự là một thiếu sót lớn. Tại Myanmar có hàng ngàn ngôi chùa lớn nhỏ, tại các ngôi chùa trên đất nước hầu hết được trang trí bằng kim loại vàng, và đá quý. Một ngôi chùa nổi tiếng tại Myanmar&nbsp; chúng tôi tham quan lần đầu tiên là ngôi chùa Shwedagon. Khi đến ngôi chùa Shwedagon cả đoàn đều trầm trồ ngạc nhiên về mức độ hoành tráng, mới bước chân vào chùa rất sạch sẽ, sân được lát đá cẩm thạch, ngước lên là một tháp lớn cao 99m vái vòm được dát bằng 8 tấn vàng, xung quanh là 64 ngôi chùa nhỏ và được mạ vàng tổng số vàng được dát lên các ngôi chùa là 60 tấn, các bức tượng và các&nbsp;cột tường bên trong được trang trí bằng các loại đá quý Kim cương, Ruby, Shapia, Jade, Prediot và nhiều loại đá quý khác…Quả thực đến gần ngôi chùa sẽ thấy được mức độ lộng lẫy hơn nữa vào trong chùa cảm giác rất nhẹ nhàng than thản.</div>\r\n<div>\r\n	Hành trình tiếp theo chúng tôi được đặt chân tới hồ Inle hồ nước lớn thứ hai tại châu Á, với diện tích hồ là 250km2, đây là nơi sinh sống hàng ngàn cư dân, đến hồ Inle nơi có nhiều điều chúng ta khám phá về văn hóa con người nơi đây, nhịp sống yên ả tách biệt với cuộc sống hiện đại, tìm hiểu bộ tộc cổ dài, các nghề thủ công truyền thống, cảnh đánh bắt cá sinh hoạt của người dân.</div>\r\n', 'articleimage_137025538751ac701b6c822.jpg', 0, 1, 25, 0, 5, '2013-06-03 17:06:47', 50, '2014-08-01 23:41:52', 50, '2014-08-01 23:41:52', 44),
(37, '‘Vua tiền mặt’ và những vụ thâu tóm ngàn tỷ', 'Kinh tế khó khăn khiến hàng chục ngàn doanh nghiệp bộc lộ những điểm yếu chết người. Đây là cơ hội để những đại gia lắm tiền, nhiều của tấn công các con mồi yếu thế. ', '<div>\r\n	<strong>Tung tiền gom DN</strong>\r\n	<p style="text-align: justify;">\r\n		"Báo cáo" hợp nhất kiểm toán ''2012 của'' Tập đoàn Masan (MSN) vừa được đưa ra cho thấy, trong năm vừa qua tập đoàn này đã mua công ty TNHH MTV Hoa Mười Giờ (HMG) và sử dụng thành công cụ đầu tư để mua 40% lợi ích của CTCP Việt Pháp sản xuất thức ăn gia súc (Proconco).</p>\r\n	<p style="text-align: justify;">\r\n		Tổng giá trị giao dịch là 2.028,01 tỷ đồng trong đó vốn chủ sở hữu của HMG là 10 triệu đồng còn 2.028 tỷ là do MSN cho HGM vay. Sau đó vốn chủ sở hữu cùng khoản vay của HMG được chuyển giao bằng giá gốc cho Masan Consumer - một công ty con của MSN.</p>\r\n	<p style="text-align: center;">\r\n		<img alt="" src="/public/files/images/20130403174510-ma1.jpg" style="width: 450px; height: 240px;" /></p>\r\n	<p style="text-align: justify;">\r\n		Ngay đầu năm 2013, CTCP Hàng tiêu dùng Ma San (Masan Consumer) cũng đã hoàn tất thương vụ mua lại 24,9% cổ phần, tương đương hơn 2 triệu cổ phiếu của CTCP Nước khoáng Vĩnh Hảo từ CTCP Đại lý Liên hiệp Vận chuyển (GMD). Mức giá mua lại được cho biết là 85.000 đồng/cổ phiếu, cao hơn khoảng 240% so với giá trên OTC.</p>\r\n	<p style="text-align: justify;">\r\n		Tập đoàn cũng cho biết sẽ tiếp tục đầu tư mua tối đa 100% cổ phần của một công ty trong lĩnh vực hàng tiêu dùng nhanh tại Việt Nam với tổng giá trị đầu tư tối đa là 700 tỷ đồng.</p>\r\n	<p style="text-align: center;">\r\n		&nbsp;</p>\r\n	<p style="text-align: justify;">\r\n		Trước đó, vụ thâu tóm thành công Vinacafe Biên Hòa hồi tháng 9/2011 thông qua chào mua công khai hơn 50% vốn điều lệ là một trong những thương vụ diễn ra đầy bất ngờ nhưng đã mang lại lợi ích lớn cho cổ đông cả hai phía.</p>\r\n	<p style="text-align: justify;">\r\n		Mở màn M&amp;A trên thị trường năm 2013, CTCP Hùng Vương đã hoành thành thương vụ thâu tóm CTCP Thức ăn Chăn nuôi Việt Thắng, với việc bỏ ra hàng trăm tỷ đồng để mua lại cổ phần, tăng tỷ lệ sở hữu từ 28,54% lên 55,31%.</p>\r\n	<p style="text-align: justify;">\r\n		Làn sóng M&amp;A trong khoảng hai năm gần đây diễn ra khá mạnh, riêng HVG đã thực hiện một loạt các thương vụ như mua thêm 5 triệu cổ phần CTCP Thực phẩm Sao Ta (FMC); tăng sở hữu tại CTCP Xuất nhập khẩu thủy sản An Giang (AGF) lên 51%; mua lại 18% cổ phần tại CTCP XNK Lâm Thủy sản Bến Tre (FBT); góp vốn mua 25% cổ phần của CTCP Chế biến Thủy sản Xuất khẩu Tắc Vân…</p>\r\n	<p style="text-align: justify;">\r\n		Nhiều DN lớn khác cũng dồn dập tung tiền thực hiện các thương vụ M&amp;A như: Địa ốc Đất Xanh (DXG) mua một loạt dự án BĐS, trong đó có hai block căn hộ tại dự án Thiên Lộc (quận Gò Vấp), mua toàn bộ căn hộ từ Sunview 5 (quận Thủ Đức)…; Kinh Đô (KDC) sáp nhập Vinabico; Cadivi mua Cáp Sài Gòn; Danh Khôi Á Châu mua dự án căn hộ chung cư Nhất Lan (quận Bình Tân); Tập đoàn DOJI mua 20% cổ phần của TienPhongBank; SHB-Habubank; Thiên Thanh tham gia vào việc tái cơ cấu của TrustBank...</p>\r\n	<p style="text-align: justify;">\r\n		Nhiều kế hoạch M&amp;A cũng đã được phác ra như: Coteccons tính thâu tóm Unicons và Phú Hưng Gia; PVFC hợp nhất với ngân hàng Phương Tây; Công ty Xuyên Thái Bình chào mua thêm 3,13 triệu cổ phiếu (tương đương 29%) của Công ty Xuất nhập khẩu Thủy sản Bến Tre; Sacombank-Eximbank…</p>\r\n	<p style="text-align: justify;">\r\n		<strong>Cơ hội cho người mua</strong></p>\r\n	<p style="text-align: justify;">\r\n		Trong hoạt động M&amp;A như trên cơ hội luôn nghiêng về bên mua bởi rất nhiều doanh nghiệp đang vật lộn trong giông bão. Không ít doanh nghiệp đuối sức và đang tìm phao cứu sinh bằng cách bán bớt tài sản.</p>\r\n	<p style="text-align: justify;">\r\n		Trong trường hợp mua Việt Thắng (VTF) DN sản xuất thức ăn chăn nuôi hàng đầu tại ĐBSCL, Hùng Vương đã hoàn thành chu trình khép kín để tiết kiệm chi phí thức ăn nuôi trồng thủy sản. Việc thâu tóm VTF và AGF được đánh giá sẽ giúp HVG thực hiện tham vọng chiếm 25 - 30% trên tổng kim ngạch xuất khẩu của ngành, khoảng 3 tỷ USD, vào năm 2015.</p>\r\n	<p style="text-align: justify;">\r\n		Thương vụ Cadivi mua lại cơ sở vật chất của Cáp Sài Gòn (CSG) cũng mang lại nhiều lợi ích cho bên mua. Theo đó, vụ M&amp;A CSG đã giúp Cadivi tiết kiệm rất nhiều thời gian và tiền bạc so với việc xây dựng nhà máy mới và giúp doanh nghiệp. Mức giá 90 tỷ đồng cho toàn bộ máy móc, thiết bị và hơn 45 ha đất được thuê đến năm 2053 là một món hời và có lẽ chỉ thực hiện được trong thời kỳ vàng M&amp;A như hiện nay.</p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_1367762417518665f10f18b.jpg', 0, 0, 9, 0, 43, '2013-04-07 09:04:18', 5, '2013-06-03 17:06:02', 50, '2014-07-31 11:25:42', 17),
(39, 'Hậu Giang: Gần 500 tỷ đồng xây dựng hệ thống xử lý chất thải rắn', 'Ngày 6-5, thông tin từ Văn phòng UBND tỉnh Hậu Giang, cho biết: Theo quy hoạch quản lý chất thải rắn trên địa bàn tỉnh từ nay đến năm 2015 cần hơn 137 tỷ đồng và giai đoạn đến 2025 là hơn 360 tỷ đồng để xây dựng hai nhà máy xử lý và bảy trạm trung chuyển chất thải.', '<div>\r\n	<b>Ngày 6-5, thông tin từ Văn phòng UBND tỉnh Hậu Giang, cho biết: Theo quy hoạch quản lý chất thải rắn trên địa bàn tỉnh từ nay đến năm 2015 cần hơn 137 tỷ đồng và giai đoạn đến 2025 là hơn 360 tỷ đồng để xây dựng hai nhà máy xử lý và bảy trạm trung chuyển chất thải.</b></div>\r\n<div style="text-align: center;">\r\n	<img alt="" src="/public/files/images/247233.jpg" style="width: 405px; height: 305px;" /></div>\r\n<div>\r\n	<div>\r\n		<p style="text-align: justify;">\r\n			Việc quy hoạch này căn cứ vào quy hoạch chung về kinh tế - xã hội của tỉnh, tốc độ gia tăng dân số, hệ thống y tế, các khu cụm công nghiệp. Dự báo đến năm 2015, tổng lượng chất thải rắn phát sinh từ nguồn thải sinh hoạt, chất thải rắn công nghiệp, chất thải y tế, chất thải rắn xây dựng là hơn 340 nghìn tấn/ngày (trong đó chất thải rắn nguy hại trên 36 tấn/ngày) và đến năm 2025 là hơn 732 nghìn tấn/ngày (trong đó chất thải rắn nguy hại là hơn 107 tấn/ngày). Tất cả nguồn chất thải này được xử lý bằng công nghệ xử lý nước rỉ rác và xử lý khí thải lò đốt tại nhà máy xử lý chất thải rắn ở xã Hòa An, huyện Phụng Hiệp, với diện tích quy hoạch đến năm 2015 là 20 ha và đến năm 2025 là 40 ha. Riêng đối với chất thải có thể tái sinh thì được thu hồi, chất thải có nguồn gốc hữu cơ dễ phân hủy sẽ được đem ủ sinh học làm phân vi sinh…</p>\r\n		<p style="text-align: justify;">\r\n			Đầu tư xây dựng nhà máy xử lý chất thải rắn sẽ giải quyết khó khăn cấp bách của bốn bãi rác trên địa bàn tỉnh hiện nay đang quá tải và khó xử lý triệt để mùi hôi, đó là: bãi rác ở xã Tấn Tiến, TP Vị Thanh; bãi rác ở xã Tân Long, huyện Phụng Hiệp; bãi rác ở thị trấn Long Mỹ, huyện Long Mỹ và bãi rác thị trấn Kinh Cùng, huyện Phụng Hiệp.</p>\r\n		<p style="text-align: right;">\r\n			<br />\r\n			<em>Theo Nhân dân Điện tử</em></p>\r\n	</div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_13678560145187d38eb072d.jpg', 0, 1, 11, 0, 43, '2013-05-06 23:05:14', 5, '2013-05-10 09:05:13', 50, '2014-06-24 22:53:30', 4),
(45, 'Sắp ban hành Thông tư về gói tín dụng 30.000 tỷ đồng', 'Ông Nguyễn Viết Mạnh – Vụ trưởng Vụ Tín dụng (Ngân hàng Nhà nước) cho biết, đã hoàn tất dự thảo Thông tư hướng dẫn gói tín dụng 30.000 tỷ đồng để sẵn sàng ban hành trong vài ngày tới.', '<div>\r\n	<strong>Ông Nguyễn Viết Mạnh – Vụ trưởng Vụ Tín dụng (Ngân hàng Nhà nước) cho biết, đã hoàn tất dự thảo Thông tư hướng dẫn gói tín dụng 30.000 tỷ đồng để sẵn sàng ban hành trong vài ngày tới.</strong></div>\r\n<div>\r\n	<p>\r\n		Tham dự buổi Tọa đàm “Khả năng hồi phục của thị trường bất động sản” ngày 9/5/2013 tại Báo Đầu tư, ông Nguyễn Viết Mạnh – Vụ trưởng Vụ Tín dụng Ngân hàng Nhà nước cho biết, Ngân hàng Nhà nước vừa phối hợp với Bộ Xây dựng hoàn thiện Thông tư quy định chính sách cho vay nhà ở theo Nghị quyết 02 của Chính phủ và dự kiến sẽ ký ban hành trong một vài ngày tới.</p>\r\n	<p>\r\n		Theo đó, Ngân hàng Nhà nước yêu cầu dành khoảng 30.000 tỷ đồng để cho vay các đối tượng là cán bộ công chức, lực lượng vũ trang, đối tượng thu nhập thấp để mua, thuê, thuê mua nhà ở xã hội và nhà ở thương mại chuyển đổi công năng sang nhà ở xã hội cũng như là các DN xây dựng các loại nhà ở này, với lãi suất thấp (6%/năm) và thời hạn dài (khoảng 10 năm đối với cá nhân, hộ gia đình và 5 năm đối với DN).</p>\r\n	<p>\r\n		Trong khi đó, ông Vũ Xuân Thiện, Phó Cục trưởng Cục Quản lý nhà và thị trường bất động sản (Bộ Xây dựng) cho biết, Bộ Xây dựng cũng đã hoàn tất dự thảo Thông tư quy định về đối tượng và điều kiện được vay để thuê, mua, thuê mua nhà ở xã hội và mua, thuê nhà ở thương mại có diện tích nhỏ hơn 70 m2 và có giá bán dưới 15 triệu đồng/m2 theo Nghị quyết 02 của Chính phủ. “Hiện dự thảo thông tư này đã được đặt lên bàn bộ trưởng”, ông Thiện nói. Nếu được ban hành, đây là thông tư thứ hai của Bộ Xây dựng hướng dẫn thực hiện Nghị quyết 02 của Chính phủ liên quan đến bất động sản.</p>\r\n	<p>\r\n		Bình luận về ý kiến để thị trường bất động sản “rơi tự do”, ông Võ Đại Lược, nguyên Viện trưởng Viện Nghiên cứu Kinh tế và Chính trị thế giới cho rằng, giá bất động sản tại nước ta trong 10 năm gần đây đã tăng lên 10 lần. Lý do cơ bản cho sự tăng giá phi lý này là tình trạng dòng vốn đầu cơ ào ạt đổ vào thị trường này với hy vọng thu lời nhanh do giá leo thang hàng ngày.</p>\r\n	<p>\r\n		“Dường như thị trường BĐS đã được thả nổi bùng phát và thậm chí còn được chính quyền các cấp hỗ trợ cho sự bùng phát đó bằng việc phê duyệt các quy hoạch, cấp phép,...”, ông Lược nói và cho rằng, hậu quả là cung vượt quá xa cầu thực tế và bong bong bất động sản nổ là điều khó tránh khỏi.</p>\r\n	<p>\r\n		Ở một góc nhìn khác, GS. TS Nguyễn Mại, nguyên Phó chủ nhiệm Ủy ban Nhà nước về hợp tác và đầu tư, Chủ tịch Hiệp hội Doanh nghiệp FDI nhìn nhận, việc phát triển ồ ạt nhiều dự án đô thị, nhà ở thời gian qua và việc để đóng băng quá dài thị trường bất động sản Việt Nam một phần bắt nguồn từ chính sách quá thoáng trước đó và các khoản tín dụng ngân hàng khá lớn đổ vào các doanh nghiệp bất động sản và nhà đầu cơ.</p>\r\n	<p>\r\n		Dẫn chứng về câu chuyện học thuyết “rơi tự do” của các nền kinh tế lớn như Mỹ, Anh Quốc vào những năm cuối thế kỷ trước đã thất bại như thế nào, ông Mại cho rằng, quan điểm Nhà nước không nên bơm tiền để cứu các doanh nghiệp bất động sản vì họ đã “ăn đủ” là rất phiến diện, không thấy rằng thị trường bất động sản vừa là kinh tế, vừa là xã hội, vì thế không thể để mặc thị trường tự điều tiết theo “bàn tay vô hình”.</p>\r\n	<p>\r\n		Ông Mại chỉ ra rằng, về kinh tế, việc để quá lâu tình trạng hàng chục ngàn căn hộ, hàng vạn biệt thự bỏ hoang gây lãng phí nghiêm trọng nguồn lực của đất nước, trong khi có thể và cần phải giải quyết nhanh hơn, hiệu quả hơn. Về vấn đề xã hội, nhà ở là một trong những nhu cầu thiết yếu của con người, chính sách nhà ở là một trong những chính sách quan trọng của Nhà nước.</p>\r\n	<p>\r\n		Phát biểu tại buổi tọa đàm, GS. TSKH Đặng Hùng Võ cho rằng, nói Nghị quyết 02/NQ – CP ngày 7/1/2013 của Chính phủ là văn bản giải cứu thị trường bất động sản, nhà đầu tư bất động sản là không đúng. Chúng ta phải xem đây là sự can thiệp cần thiết của Nhà nước vào thị trường, trong đó một dung lượng khá lớn của chính sách tập trung vào giải quyết nhà ở cho người lao động. Hướng của Nghị quyết cũng không tập trung chỉ cho các doanh nghiệp, đó là hướng nhằm bảo đảm tìm lối ra cho mọi khó khăn của nền kinh tế đất nước hiện nay.</p>\r\n	<p>\r\n		“Để thành tiếng, phải vỗ bằng 2 bàn tay”, ông Võ nói!</p>\r\n	<p style="text-align: center;">\r\n		<img alt="" src="/public/files/images/8.JPG" style="width: 400px; height: 300px;" /></p>\r\n	<p>\r\n		Theo TS. Nguyễn Trí Hiếu, thành viên HĐQT Ngân hàng Đại Dương (OceanBank), tháo gỡ khó khăn cho bất động sản hiện nay là việc phải làm. Nếu không làm thì không chỉ “sập tiệm” mấy ông kinh doanh bất động sản mà còn kéo theo nhiều ngành nghề khác từ nguyên vật liệu, xi măng, lao động, dịch vụ… nên chúng ta không thể để thị trường bất động sản “rơi tự do”.</p>\r\n	<p>\r\n		Ông Hiếu cho biết, nợ xấu trong lĩnh vực bất động sản hiện rơi vào khoảng 250 ngàn tỷ đồng. Trong đó 58% là các khoản nợ có tài sản đảm bảo bằng bất động sản. Một số công ty tư vấn cũng cho tôi biết, hàng tồn kho bất động sản hiện chiếm khoảng 140 ngàn tỷ giá trị hàng tồn kho hiện tại. 140 ngàn tỷ sản so với 250 nghìn tỷ nợ xấu có liên quan đến bất động sản có nghĩa là hàng tồn kho chiếm phần lớn số nợ xấu.</p>\r\n	<p>\r\n		Như vậy, rõ ràng phải giải quyết được nợ xấu mới giải quyết được hàng tồn kho, giải phóng được hàng tồn kho thì sẽ giải phóng được thị trường bất động sản. Nếu muốn phục hồi thị trường bất động sản, vấn đề nợ xấu phải được giải quyết và giải quyết một cách cấp bách, từ đó thị trường bất động sản có tính thanh khoản và kinh tế phát triển!</p>\r\n	<p>\r\n		“Theo tôi, các giải pháp mà Chính phủ đưa ra trong Nghị quyết 02/NQ – CP ngày 7/1/2013 về thị trường bất động sản là đúng hướng. Vấn đề là cần có sự vào cuộc một cách mạnh mẽ của tất các cơ quan chức năng; các ngân hàng thương mại xây dựng được những sản phẩm tín dụng hợp lý để người dân ngoài kia có thể mua nhà được…”, ông Hiếu bình luận!</p>\r\n	<p style="text-align: right;font-weight:bold;">\r\n		<em>Quang Hà </em></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_1368152733518c5a9d140ca.JPG', 0, 1, 17, 0, 5, '2013-05-10 09:05:33', 5, '2013-05-10 09:05:31', 50, '2014-06-24 22:53:30', 8),
(47, '14,7 triệu đồng/m2 căn hộ Vinaconex 7 tại Từ Liêm', 'VC7 Housing Complex số 136 Hồ Tùng Mậu được bán với giá từ 14,7 triệu đồng/m2, các căn hộ có diện tích từ 98m2 đến 149,5m2, được thiết kế từ 3 – 4 phòng ngủ.', '<div>\r\n	<strong>VC7 Housing Complex số 136 Hồ Tùng Mậu được bán với giá từ 14,7 triệu đồng/m2, các căn hộ có diện tích từ 98m2 đến 149,5m2, được thiết kế từ 3 – 4 phòng ngủ.</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" src="/public/files/images/VC7.jpg" style="width: 300px; height: 400px;" /></div>\r\n<div>\r\n	<p>\r\n		Công ty cổ phần Xây dựng số 7 (Vinaconex7 – mã chứng khoán VC7) vừa chào bán căn hộ tại dự án “VC7 Housing Complex”, số 136 Hồ Tùng Mậu, Từ Liêm, Hà Nội với mức giá khởi điểm từ 14.7tr/m2 áp dụng cho gói bàn giao thô.</p>\r\n	<p>\r\n		Các loại căn hộ chào bán có diện tích từ 98m2, 105m2, 128m2 đến 149,5m2, được thiết kế từ 3 – 4 phòng ngủ.</p>\r\n	<p>\r\n		VC7 Housing Complex là khu nhà ở bao gồm chung cư cao tầng và nhà thấp tầng tại trung tâm hành chính huyện Từ Liêm.</p>\r\n	<p>\r\n		Diện tích toàn khu là 14.000m2, với 32 căn nhà vườn thấp tầng, 2 khối tháp căn hộ 27 tầng với tổng vốn đầu tư khoảng 1.047 tỷ đồng.</p>\r\n	<p>\r\n		Dự án nằm trong quần thể khu đô thị Castle Plaza rộng 12ha bao gồm các khối căn hộ cao tầng, khách sạn 5 sao, khu trung tâm thương mại và trường học quốc tế, với khoảng cách địa lý tới các địa điểm trung tâm Cầu Giấy không quá 2km dự án được hưởng trọn vẹn hạ tầng hoàn thiện của khu vực.</p>\r\n	<p>\r\n		Trong đợt bán hàng này Vinaconex 7 kết hợp với ngân hàng Công Thương (Vietinbank) Chi nhánh Thăng Long tổ chức cho khách hàng vay mua nhà với lãi suất ưu đãi, đồng thời chủ đầu tư sẽ trao quà tặng cho 20 khách hàng đầu tiên 01 tivi trị giá 10 triệu đồng.</p>\r\n	<p style="text-align: right;">\r\n		<em>(theo Báo đầu tư)</em></p>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_1368327107518f03c3b32da.jpg', 0, 1, 19, 0, 5, '2013-05-11 09:05:14', 5, '2013-06-03 17:06:56', 50, '2014-06-24 22:53:30', 5),
(52, 'Một ngày trên sông Sài Gòn', 'Bỏ lại sau lưng những tòa nhà sừng sững và phố xá ồn ào đầy khói bụi, chúng tôi rời bến Bạch Đằng trên hai chiếc canô ngược sông Sài Gòn hướng ra Củ Chi.', '<div>\r\n	<strong>Bỏ lại sau lưng những tòa nhà sừng sững và phố xá ồn ào đầy khói bụi, chúng tôi rời bến Bạch Đằng trên hai chiếc canô ngược sông Sài Gòn hướng ra Củ Chi. Trời trong, nắng nhạt, canô lướt nhẹ trên mặt nước tạo cảm giác bồng bềnh, phấn chấn.</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" src="/public/files/images/song-sai-gon.jpg" style="width: 500px; height: 280px;" /></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div>\r\n	Vòng quanh bán đảo Thanh Đa, canô lướt qua dạ cầu Bình Triệu, Bình Phước rồi qua Phú Long. Lục bình giăng khắp mặt sông, hai bên bờ trải dài những vườn cây ăn trái xanh ngắt. Tiếp đến là Lái Thiêu với quang cảnh nhộn nhịp trên bến dưới thuyền.\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<p align="justify">\r\n		Các ghe thương hồ bận rộn vận chuyển lu khạp, chậu kiểng, chén bát từ các lò gốm lên thuyền đợi nước ròng, xuôi về TP.HCM rồi rẽ qua kênh Tẻ - kênh Đôi xuống các tỉnh đồng bằng sông Cửu Long hoặc sang tận Campuchia.</p>\r\n	<div align="justify">\r\n		Điểm dừng chân đầu tiên của chúng tôi là ngôi nhà ông Trần Văn Hổ - đốc phủ sứ thời Pháp thuộc - nằm trên đường Bạch Đằng, thị xã Thủ Dầu Một, Bình Dương. Công trình kiến trúc cổ theo dạng chữ đinh bằng gỗ quý được gia công, chạm trổ tinh xảo.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Dạo một vòng thị xã, một di tích lịch sử - văn hóa cấp quốc gia khác không thể bỏ qua là Hội Khánh cổ tự, tọa lạc trên lưng đồi giữa hàng cây cao bóng cả với tượng Phật Thích Ca nhập niết bàn dài 52m, đã được Trung tâm Sách kỷ lục trao quyết định xác lập tượng Phật nằm lớn nhất VN...</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Không như vùng hạ lưu lúc nào cũng đông đúc tàu thuyền, đường lên thượng nguồn sông Sài Gòn, nhất là đoạn vào địa phận Củ Chi càng lúc càng vắng vẻ. Thỉnh thoảng lại bắt gặp đàn cò trắng sải cánh giữa trời mây bồng bềnh. Cảnh vật thiên nhiên mộc mạc, yên bình.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Xế trưa canô băng ngang khu di tích địa đạo Bến Đình và không lâu sau đó đã cặp bờ di tích địa đạo Bến Dược. Nhìn mái đền Bến Dược mang dáng dấp kiến trúc đền đài cổ xưa cùng tháp chính vươn cao giữa bầu trời xanh, ai cũng vui bởi đã hoàn thành “sứ mệnh” khai phá tuyến du lịch trên sông bấy lâu còn bỏ ngỏ.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Chiều về, vẫn con nước ngầu đục, vẫn những đám lục bình trôi dập dềnh, những chiếc cầu bêtông đồ sộ ầm ì xe chạy trên đầu... nhưng cảnh vật đã đổi khác: ghe thuyền thong dong gác máy, trên bờ đê trẻ em đua nhau thả diều, từng đàn chim cò thong thả bay về phía rặng dừa xa xa. Mặt trời tựa khối cầu lửa đang chìm dần dưới dòng sông.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Một ngày du ngoạn trên sông Sài Gòn, dù còn “cưỡi ngựa xem hoa” nhưng cũng để chúng tôi ngộ ra bao điều mới lạ, đặc biệt tiềm năng du lịch vùng đất Thủ Dầu Một vốn được cho là khó thu hút du khách.</div>\r\n	<div align="right">\r\n		<em>(Báo Tuổi Trẻ)</em></div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_137025362851ac693cecb84.jpg', 0, 1, 20, 0, 5, '2013-06-03 17:06:28', 5, '2013-06-03 17:06:27', 50, '2014-06-24 22:53:30', 0),
(53, 'Du ngoạn Ngũ Hành Sơn', 'Cách trung tâm thành phố Đà Nẵng khoảng bảy cây số, Ngũ Hành Sơn là chốn thiền môn hoang sơ, tĩnh lặng, thu hút du khách đến khám phá.', '<div>\r\n	<strong>Cách trung tâm thành phố Đà Nẵng khoảng bảy cây số, Ngũ Hành Sơn là chốn thiền môn hoang sơ, tĩnh lặng, thu hút du khách đến khám phá, chiêm nghiệm, thoát ra khỏi cuộc sống ồn ào của phố thị. nơi đây là nơi lý tưởng cho các vị khách du lịch miền Trung</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" src="/public/files/images/ngu-hanh-son.jpg" style="width: 600px; height: 450px;" /></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Ngũ Hành Sơn là năm ngọn núi vươn ra như năm ngón tay có tên theo ngũ hành: Kim Sơn, Mộc Sơn, Thủy Sơn, Hỏa Sơn và Thổ Sơn. Những ngọn núi ấy thành tên từ thế kỷ 19 do vua Minh Mạng đặt. Có nhiều truyền thuyết về sự hình thành Ngũ Hành Sơn, trong đó có chuyện kể rằng: Ngày xưa, nơi đây là vùng biển hoang vu, chỉ có một ông già sống đơn độc trong túp lều tranh. Một hôm, trời đang sáng bỗng nhiên tối sầm, giông bão nổi lên, một con giao long rất lớn xuất hiện vùng vẫy trên bãi cát và một quả trứng khổng lồ. Lát sau, một con rùa vàng xuất hiện, tự xưng là thần Kim Quy, đào cát vùi quả trứng xuống và giao cho ông già nhiệm vụ bảo vệ giọt máu của Long Quân. Quả trứng càng ngày càng lớn, nhô lên cao, chiếm cả vùng đất rộng lớn. Vỏ trứng ánh lên đủ màu sắc xanh, đỏ, trắng, vàng, tím, lấp lánh như hòn gạch khổng lồ. Hôm khác, ông lão vừa chợp mắt thì nghe có tiếng lửa cháy, trong lòng trứng xuất hiện một cái hang rộng rãi, mát mẻ. Ông cầu cứu móng rùa- vật mà thần Kim Quy đã giao lại cho ông lúc ra đi rồi đặt lưng xuống ngủ thiếp luôn. Ông không biết đang xảy ra phép lạ: một cô gái xinh xắn bước ra từ trong trứng và nơi ông nằm là một trong năm hòn cẩm thạch vừa được hình thành từ năm mảnh vỏ trứng, sau thành năm 5 ngọn núi Ngũ Hành Sơn như bây giờ.</div>\r\n<div>\r\n	Cẩm thạch tại Ngũ Hành Sơn có màu ngũ sắc, phân chia theo từng núi: đá ở Thủy Sơn màu hồng, ở Mộc Sơn màu trắng, ở Hỏa Sơn màu đỏ, ở Kim Sơn màu thủy mặc và ở Thổ Sơn màu nâu. Thật thú vị khi dạo quanh Ngũ Hành Sơn, bước xuống các bậc cấp là lạc vào các cửa hàng bán đồ thủ công mỹ nghệ làm bằng đá Non nước. Nơi đây, có cơ man sản phẩm làm từ đá, đa dạng màu sắc và hình mẫu. Những tảng đá lớn được tạc thành các sản phẩm như: sư tử, voi, bệ đá…, nhỏ thành vòng đeo tay, một số mặt hàng lưu niệm.\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Ngọn Kim Sơn nằm ở phía Đông Nam, bên bờ sông Cổ Cò. Tại đây, xưa có Bến Ngự, nơi thuyền Vua cập bến mỗi khi du hành Ngũ Hành Sơn. Ngay dưới chân ngọn Kim Sơn có một hang động dài hơn 50m, rộng gần 10m, cao khoảng 10 - 15m. Lối vào động là những bậc đá tự nhiên, bên trong là những lớp thạch nhũ bám vào vách núi tạo thành hình tượng Quan Thế Âm Bồ Tát cao bằng người thật rất thanh tú. Tượng thạch nhũ này còn sinh động hơn nhờ lớp nhũ đá lấp lánh như dải kim tuyến phủ từ bờ vai đến gót chân tượng. Dưới chân tượng là con rồng đang cuộn mình giữa những làn sóng. Đặc biệt, phía sau Bồ Tát còn có một hình tượng nhỏ hơn trông như Thiện Tài đồng tử và bên trái là hình chim Khổng Tước, hai cánh xoè rộng toả khắp trần động.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Mộc Sơn nằm ở phía Đông, sát biển. Phía Đông và Nam là động cát, phía Bắc là ruộng và phía Tây là xóm làng. Tuy thuộc hành Mộc nhưng tại đây lại rất ít cây cối. Đỉnh núi đá bị xẻ thành những răng cưa giống như cái mồng gà trống nên có thể vì vậy mà còn có tên núi Mồng Gà. Trên hòn núi này không có chùa chiền, chỉ có một khối đá cẩm thạch màu trắng trông tựa người đang ngồi. Người địa phương gọi là Cô Mụ hay Bà Quan Âm.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Thuỷ Sơn là ngọn cao nhất trong Ngũ Hành Sơn. Đỉnh núi có 3 ngọn nằm ở 3 tầng, giống 3 ngôi sao Tam Thai ở đuôi chòm Đại Hùng Tinh nên còn có tên là núi Tam Thai. Ngọn cao nhất ở phía Tây Bắc gọi là Thượng Thai, ngọn phía Nam thấp hơn gọi là Trung Thai và ngọn phía Đông thấp nhất gọi là Hạ Thai. Các chùa chiền và hang động tập trung chủ yếu ở Thuỷ Sơn. Ở ngọn Thượng Thai có Vọng Giang Đài, tháp Phổ Đồng, chùa Từ Tâm, chùa Tam Tâm, chùa Tam Thai, Hành Cung, động Hoả Nghiêm, động Huyền Không, động Linh Nham và động Lăng Hư. Ở ngọn Trung Thai có hai cổng động Thiên Phước Địa, Văn Căn Nguyệt và các động Vân Thông, Thiên Long, hang Vân Nguyệt. Ngọn Hạ Thai có Vọng Hải Đài, chùa Linh Ứng, động Ngũ Cốc, Tàng Chân còn phía dưới núi là Giếng Tiên và động Âm Phủ. Khi đến Vọng Giang, du khách có thể phóng tầm mắt nhìn thấy dòng sông Cẩm Lệ, dòng sông Hàn đẹp như tranh vẽ... Du khách muốn thăm chùa Linh Ứng phải lên khoảng 108 tầng cấp, nếu đến chùa Tam Thai nằm ở phía Nam phải đi xa hơn những tầng cấp dài 156 bậc.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Thăm thú Thủy Sơn cũng quyến rũ du khách bởi tại đây đa dạng về thực vật. Cây Thiên Tuế cành lá sum suê thân quấn vào núi đá, trong những khe đá quanh năm ẩm ướt là nơi mọc của Thạch trường sanh. Rồi các loại cây khác như: Cây Cung - nhân - thảo (Amaryllis), Cảnh - thiên (Crassule), Mộc tê, Chương não, và loại cây Thử có tinh dầu dùng để trét ghe thuyền, cây Tứ quý có rễ dùng làm thuốc bổ, lọc huyết và tiêu thực. Bên cạnh đó là cơ man hoa dại cứ bung nở trong bốn mùa như điểm tô cho Ngũ Hành Sơn.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Hoả Sơn gồm hai ngọn và một đường đá nhô lên nối liền chúng với nhau. Ngọn phía Tây gần Kim Sơn là Dương Hoả Sơn, nằm trên bờ sông Cổ Cò. Ngày xưa, khi Đà Nẵng và Hội An còn giao lưu bằng đường thuỷ, ở đây có một ngã ba sông, ghe thuyền qua lại vô cùng tấp nập. Trên sườn núi phía Tây, mặt hướng về phía Bắc, đối diện với Kim Sơn có 3 chữ Hán rất to được khắc vào vách đá “Dương Hoả Sơn”. Trong núi Dương Hoả Sơn có các hang và chùa Phổ Sơn Đà. Còn ngọn ở phía Đông, gần đường đi Hội An là Âm Hoả Sơn với chóp núi nhô cao, sườn núi có nhiều thớ đá nằm nghiêng và chạy ngang tạo thành lát cắt, mỏm núi phía Đông có một hang đá thông từ sườn phía Nam ra sườn phía Bắc. Cây cối mọc xen dày ở các kẽ đá.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<p align="justify">\r\n		Thổ Sơn là ngọn núi nằm ở phía Bắc hòn Kim Sơn và phía Tây hòn Thủy Sơn. Đây là ngọn núi đất, thấp nhất nhưng cũng dài nhất, trông như con rồng nằm dài trên bãi cát. Phía Tây Thổ Sơn là đoạn sông Ba Chà. Núi có hai tầng, lô nhô những khối đá trên đỉnh, nhất là ở sườn phía Đông. Sườn phía Bắc dốc hơn, có những vách đá dựng đứng, hẹp và thấp. Thân núi có một lớp cỏ mỏng bao phủ, nhiều chỗ để lộ màu đất sét đỏ, gạch cổ thời Chiêm Thành.</p>\r\n	<div align="justify">\r\n		<br />\r\n		Ngũ Hành Sơn được ví như hòn non bộ khổng lồ giữa lòng thành phố Đà Nẵng. Khám phá Ngũ Hành Sơn trong nắng vàng hay tiết trời êm dịu, lưng thấm đẫm mồ hôi nhưng du khách luôn thấy nhẹ lòng, bỏ quên sau lưng bao chuyện thế gian.</div>\r\n	<div align="right">\r\n		<em>(Báo Quê Hương Online)</em></div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_137025382451ac6a00aeefc.jpg', 0, 1, 21, 0, 5, '2013-06-03 17:06:44', 5, '2013-06-03 17:06:17', 50, '2014-06-24 22:53:30', 19);
INSERT INTO `news_article` (`id`, `article_title`, `article_brief`, `article_content`, `cover_image`, `status`, `publish`, `order`, `lock_status`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`, `view_counter`) VALUES
(54, 'Vài nét về đất nước Nga', 'Sau khi được chiêm ngưỡng thành phố Moscow xinh đẹp, xin mời bạn tới nơi có một mê cung dưới lòng đất “Moscow Metrol” hay tàu điện ngầm.', '<div>\r\n	<strong>Sau khi được chiêm ngưỡng thành phố Moscow xinh đẹp, xin mời bạn tới nơi có một mê cung dưới lòng đất “Moscow Metrol” hay tàu điện ngầm. Tới Moscow bạn không thể không du ngoạn trong hệ thống tàu điện ngầm hiện đại và nổi tiếng nhất thế giới.</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" src="/public/files/images/nuoc-nga-mua-thu.jpg" style="width: 400px; height: 300px;" /></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Sau khi được chiêm ngưỡng thành phố Moscow xinh đẹp, xin mời bạn tới nơi có một mê cung dưới lòng đất “Moscow Metrol” hay tàu điện ngầm.\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Tới Moscow bạn không thể không du ngoạn trong hệ thống tàu điện ngầm hiện đại và nổi tiếng nhất thế giới. Chỉ với một tấm bản đồ tàu điện ngầm nhỏ gọn trong lòng bàn tay có bán tại khắp mọi nơi, và với 15 rúp (0.4 đô la) Bạn hãy một lần thưởng thức cảm giác đi tàu điện ngầm ở Nga. Với 150 ga metro (con số cũ) bắt đầu có mặt ở Moscow từ năm 1935, giờ đây metro đang có sức hấp dẫn mới lạ. Mỗi lần bước vào thang máy đi sâu xuống lòng đất người ta có cảm giác như đang đi vào tận trung tâm lòng đất. Bạn có thể đi lại tham quan hết những địa điểm nổi tiếng một cách dễ dàng bằng hệ thống tàu điện ngầm.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Hệ thống metro Moscow được xem là đẹp nhất thế giới. Hàng loạt các nhà ga của nó thực sự là những cung điện ngầm dưới đất. Tham gia tạo lập và trang trí cho chúng, có những hoạ sỹ và nhà điêu khắc nổi tiếng của Liên bang Xô-viết cũ, trong số đó, có các tên tuổi đã lừng danh như Pavel Korin, Alecsandr Deineka, Vera Mukhina. Bạn nên đặc biệt lưu ý rằng, việc xây dựng hệ thống metro đã không bị ngừng trệ, ngay cả trong những tháng năm ác liệt của Chiến Tranh Thế Giới Thứ Hai.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Hôm nay, dưới nền thành phố Moscow đã có cả một thành phố ngầm khổng lồ, với 11 tuyến đường. Ông Ðmitri Gaev đã cung cấp mấy số liệu thú vị mới nhất: 170 nhà ga, 276 km, đó là chặng dài đường metro, trong những ngày làm việc, thủ đô ngầm dưới đất Moscow chuyên chở từ 8.5 đến 9 triệu lượt người trong ngày. Vào những ngày cuối năm 2004 khi trận bão tuyết xảy đến lưu lượng vận chuyển của metro trong một ngày đêm lên tới 10 triệu lượt người. Metro Moscow được coi là ưu việt nhất trong các đường metro trên thế giới về độ an toàn và tần xuất các chuyến tàu, đặc biệt vào những giờ cao điểm.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Theo cách nhìn hệ thống điều khiển giao thông, thì có thể khẳng định metro của Moscow là độc đáo nhất, không có gì tương tự trên thế giới. Ðộc đáo về hệ thống bảo vệ trật tự công cộng, độc đáo về di chuyển nhanh. Khoảng cách giữa các đoàn tàu chỉ có 80 giây, ngắt quãng ngắn như vậy giữa các chuyến tàu đến và đi, thì ngoài Moscow, không ở đâu có được. Nó không đơn giản là phương tiện giao thông phổ biến, mà còn là công trình văn hóa - khoa học - nghệ thuật độc đáo và là niềm tự hào của mỗi người dân Nga. Ga metro đầu tiên của Nga được khởi công vào cuối những năm 20 của thế kỷ XX (1929-1933), nghĩa là cách đây hơn 70 năm.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Do có hệ thống thông gió tốt (bản thân tàu chạy đã thông gió rất mạnh), lại sâu trong lòng đất nên mùa hè trong metro rất mát, còn mùa đông thì ấm áp (dao động từ +18 đến +22 độ C), dù trên mặt đất nhiệt độ có thể từ -35 độ C (mùa đông) và đến +35 độ C (mùa hè). Metro Nga là sự kết hợp một cách hài hòa giữa hiện đại và cổ kính, và không phải ngẫu nhiên mà hầu hết các tour du lịch của Nga đều dành chương trình đi tham quan các ga metro. Hầu như ngày nào người ta cũng bắt gặp du khách chụp ảnh, quay video và miệng luôn thì thào thán phục. Trước hết, mỗi ga metro thực sự là một công trình kiến trúc nghệ thuật độc đáo mang tính lịch sử và rất... Nga.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Bàn tay, khối óc của các nhà bác học, kỹ sư, công nhân và cả nghệ nhân Nga đã tạo nên nhiều công trình nghệ thuật về kiến trúc. Những bức họa khổng lồ trên trần ga, các pho tượng, biểu tượng, hoa văn, họa tiết cả cổ kính lẫn hiện đại, đan xen cùng màu sắc hài hòa. Người ta có cảm tưởng đây là một góc của bảo tàng nghệ thuật chứ không phải công trình giao thông công cộng. 163 ga là 163 kiến trúc khác nhau và mang rõ nét từng chặng đường lịch sử hào hùng của nước Nga và Liên bang Xô Viết trước đây, đặc biệt lịch sử cận, hiện đại: Puskinskaia, Komsomolskaia, Park-Kultur, Cách mạng Tháng Mười, Thư viện Lenin...</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Các quầy sách, báo, tạp chí và quầy hoa tươi càng làm cho metro thêm phần đẹp rực rỡ. Có thể nói rằng tàu điện ngầm là phương tiện công cộng sạch nhất ở Nga. Người ta thường xuyên lau chùi, quét dọn, không bao giờ thấy rác, bụi bặm ở đây. Ðể giữ được sự sạch, đẹp như thế, ngoài công sức của các nhân viên phục vụ, còn phụ thuộc vào ý thức cao của hành khách. Người ta ví rằng trúng xổ số độc đắc còn dễ hơn bắt được ai đó hút thuốc lá khi bắt đầu vào cửa Metro. Bắt đầu từ nhà ga xây dựng đầu tiên ngay trên mặt đất trước khi xuống tàu điện ngầm bạn cũng được chiêm ngưỡng tu viện Zagorsk và rửa tội bằng dòng suối linh thiêng Zagorskdu. Cách thành phố Moscow 600km là thành phố Xanh Petecpua, thành phố của du lịch và những công trình nổi tiếng thế giới. Thành phố xinh đẹp nằm cạnh vịnh Phần Lan thuộc biển Ban-tích này hiện có 5 triệu dân. Trước năm 1918, St. Petersburg là thủ đô của nước Nga được Pie Ðại đế, vị vua nổi tiếng trong lịch sử nước Nga xây dựng vào năm 1703. Ðến nay, nó vừa tròn 300 năm tuổi. Với tuổi đời đó, St. Petersburg mang trên mình sức nặng của lịch sử, văn hóa và cả những cảnh quan thiên nhiên tuyệt đẹp. Mỗi năm, thành phố phương Bắc này có đến 8 tháng mùa đông. Vì thế, nếu bạn tới đây vào cuối tháng 5, đôi khi bạn vẫn được thưởng thức những trận tuyết đổ nhẹ vào tháng của mùa hè, song bạn cũng vẫn nhìn thấy những cây sồi, cây phong đứng đầy trên những lối đi hoặc trong các công viên đẹp như những khu rừng giữa phố chỉ vừa kịp khoác lên mình chiếc áo choàng xanh nõn của mùa xuân. Màu xanh mượt mà của lá vừa mới nhú đẹp đến nao lòng. Tháng 5 cũng là tháng bắt đầu của những đêm trắng ở St. Petersburg.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Ðêm trắng nước Nga đêm trắng là hiện tượng kỳ lạ diễn ra vào mùa hè ở nước Nga, đặc biệt là St. Petersburg ( Xanh Pêtécbua). Vào những lúc như vậy, đến tận nửa đêm ánh sáng mới tắt và 4 giờ sáng lại bừng lên. Hàng ngàn người Nga, hàng trăm ngàn du khách đã thức suốt đêm, đổ ra đường để vui chơi và chiêm ngưỡng cảnh tượng độc đáo này, những đêm trắng kỳ diệu, khách du lịch như đi lạc vào một thế giới hoàn toàn khác lạ, thực thực hư hư. Và họ thức suốt đêm để tận hưởng những khoảnh khắc kỳ diệu mà thiên nhiên đã ban tặng cho nước Nga. Mùa này, vào tầm 9 - 10 giờ đêm (khoảng 12-1 giờ đêm giờ Việt Nam), đi thuyền trên sông Nhê-va, du khách vẫn có thể nhìn ngắm ánh nắng vàng nhạt vương trên mái vòm bằng vàng của nhà thờ Thánh Isaac ở phía bên kia sông. Nhà thờ Thánh Isaac là một bảo tàng kiến trúc nghệ thuật nổi tiếng của St. Petersburg. Ðây là nhà thờ cao thứ 4 trên thế giới với độ cao từ chân đến đỉnh tháp là 101m.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Nhà thờ được coi là bảo tàng kiến trúc và hội họa lớn của nhân loại với khoảng 3.000 bức họa được làm bằng cách ghép từng mảnh đá nhỏ vào với nhau, với mái vòm được dát bằng vàng thật (ước khoảng gần 100kg) ở độ cao gần 100m, với 112 cây cột lớn, cao vút rất điển hình của kiến trúc châu Âu thế kỷ 18-19. Peterholf (Bảo tàng Cung điện Mùa Hè) và Hermintage (Bảo tàng Cung điện Mùa Ðông) cũng là những bảo tàng nổi tiếng vì những bộ sưu tập hội họa vĩ đại và những nét kiến trúc tuyệt vời được tạo nên bởi bàn tay và khối óc của con người. Ở cung điện Mùa Ðông, chỉ những bức tượng tạc bằng đá đặt trước các cửa phòng thế này thôi cũng đã cho thấy nét tinh xảo của người làm ra nó. Không như Cung điện Mùa Ðông nằm trong nội ô, Cung điện Mùa Hè nằm ở ngoại ô Tây Nam của thành phố.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Nó được xây dựng năm 1721, 18 năm sau khi thành phố St. Petersburg ra đời. Có người bảo Cung điện Mùa Hè có bóng dáng của Cung điện Véc-xây ở Pháp. Còn người Nga tự hào cho rằng Cung điện Mùa Hè của mình đẹp hơn Cung điện Véc-xây vì Cung điện Mùa Hè có nhiều đài phun nước lộng lẫy. Một vài nét gọi là phác họa. Vẻ đẹp St. Petersburg quả thật còn nhiều. Ðể nói cho hết, thật không dễ. Cung điện mùa Ðông được hoàn thành năm 1762 là nơi trị vì đất nước Nga của các triều đại vua chúa. Ngày nay được đổi thành Viện bảo tàng Hermitage, trong đó cất giữ những bộ sưu tập tranh vô cùng quí giá. Viện Smolny do Nữ hoàng Catherine xây năm 1700 để làm trường nội trú cho con em giới quý tộc.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Khi Cách mạng tháng Mười thành công, nơi đây là trụ sở chính phủ Xô-viết đầu tiên. St. Petersburg có hai công viên lớn và đẹp nhất nhì thế giới, đó là Công viên Hoàng gia (Palace Square), được xây dựng năm 1905, như một biểu trưng của vương triều Nga. Nhưng chính nơi đây đã xảy ra biến cố Ngày Chủ nhật đẫm máu (Bloody Sunday), khi hàng ngàn công nhân biểu tình dâng kiến nghị với Nga Hoàng Nicolas II đã bị binh sĩ nổ súng, tạo tiền đề cho cuộc cách mạng vô sản 1917.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Công viên tháng Chạp (Decembrists Square)—là công viên lớn thứ nhì ở St. Petersburg—được đặt tên theo biến cố xảy ra ngày 14-12-1825. Một nhóm sĩ quan theo chủ nghĩa cải lương đã tụ tập tại đây dự định lật đổ Sa Hoàng Nicolas II, nhưng thất bại. Hầu hết họ đã bị thủ tiêu hoặc bị đi đày. Pháo đài Peter &amp; Paul xây năm 1703 với thánh đường cùng tên, bên trong là nơi chôn cất thi hài các Sa hoàng. Cột trụ Alexandre (The Alexander Column) được dựng vào năm 1833 như khải hoàn môn cho chiến thắng Napoleon (1812). Ðược vẽ bởi Auguste de Montferrand, bằng đá vùng Karelia trong hai năm.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Bộ Tư lệnh Hải quân (The Admiralty) xây dựng năm 1823, do Andreyan Zakharov thực hiện Tượng Peter vĩ đại (Peter the Great Statue) hay còn gọi là Tượng Ðồng Kỵ Sĩ (The Bronze Horseman) do điêu khắc gia người Pháp Etienne Falconet tạo mẫu. Năm 1833, nhà thơ vĩ đại Puskin đã làm tượng đồng này trở nên bất tử khi viết bài thơ “The Bronze Horseman.” Và còn rất nhiều, như nhà hát Mariinskim, viện đại học St. Petersburg. Hơn nữa, St. Petersburg đã là niềm cảm hứng sáng tác cho các văn thi sĩ như Aleksandr Pushkin, Fyodor Dostoyevsky, Ivan Turgenev, Nicolai Gogol. Bạn phải mất cả ngày để thăm hàng trăm gian phòng trưng bày những tác phẩm hội họa, điêu khắc nổi tiếng để cảm nhận về một nước Nga hùng mạnh với ánh hào quang văn minh vẫn còn lấp lánh.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		<strong><span style="COLOR: #000080">Vài nét về thiên nhiên Nga </span></strong></div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Ðến với nước Nga, bạn sẽ thấy thiên nhiên đất nước này sẽ khiến cho bạn luôn có cảm giác choáng ngợp, ngây ngất như trước sự hùng vĩ, mênh mang, đa dạng, huyền diệu và pha lẫn một nỗi buồn bi tráng, dịu ngọt... Bắt đầu từ tháng Tư, mùa xuân của đất nước này đã về, cây cối lá mọc xanh dần, trong các mảnh vườn, bãi cỏ, những bông hoa cuống ngắn giống như cúc dại, mọc từng đôi nở bừng. Khoảng 10 ngày đầu tháng Năm là kỳ đẹp nhất của mùa xuân.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Nắng sậm vàng, ấm áp, nắng và đất trời dường như thôi thúc cỏ mọc xanh mướt và nếu bạn vào bất cứ khu rừng nào ở ngoại ô các thành phố lớn Moscow, Saint Peterburg, hay ở nông thôn, bạn sẽ thấy sức sống thiên nhiên thật vĩ đại: bạch dương, thông, phong, tùng... khoác áo mới và đung đưa hát trong gió nhẹ, những bông hoa linh lan trắng muốt khoe sắc tinh khiết, hoa bướm mỏng mảnh nhiều màu, hoa bồ công anh vàng rực... tất cả dệt thành một tấm thảm kỳ diệu. Các nhà ga xe lửa như Belorutskaia, Kurxkai, Abramsevo ở Moscow, ga ở Tula, ở Sanh Peterburg, Saratov... bắt đầu đông đúc và trong số đó du khách đến với nước Nga rất đông. Từ tháng Sáu đến hết tháng Tám, mùa hè ngự trị. Mùa hè có hoa tầm xuân dại nhiều màu nở rộ, các bà cụ Nga rất thích hái hoa này về ướp chè để uống cho thơm. Mùa hè ở Nga nóng vừa phải, nhưng thỉnh thoảng cũng có những ngày hơn 30 độ C. Bạn sẽ đi du ngoạn trên sông Moscow, Vonga, Heva, Danhev, sông Ðôn vừa ngắm cảnh vừa câu cá, sang tháng chín cho đến gần hết tháng Mười Một—đó là Mùa Thu Nga tuyệt vời. Mùa Thu ở Nga được nhà văn N.Tuốcghenhev tả rất thành công trong các truyện ngắn của mình, còn nhà danh họa I.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div align="justify">\r\n		Levintan thì dùng cây cọ vẽ nên bức “Mùa Thu Vàng” bất tử. Tháng Mười có vài tuần lá vàng rực, sáng bừng khắp những nơi có cây cối. Mùa Thu Nga là mùa của thi ca, mùa của tình yêu. Sau khi chiêm ngưỡng cảnh mùa thu vàng bạn hãy dành một giây lát ngước lên nhìn trời ngắm những đàn chim di cư đang bay ngang về vùng khí hậu ấm để tránh mùa đông Nga đang tới gần. Ðứng trước thiên nhiên Nga, con người ta, nhất là những người con người có tâm hồn nhạy cảm bạn rất dễ xuất khẩu thành thơ. Xin được mời bạn hãy đến thăm nước Nga vào dịp Thu này.</div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div style="text-align: right;">\r\n		<em>(Theo LifeStyle)</em></div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_137025399751ac6aad3f97b.jpg', 0, 1, 22, 0, 5, '2013-06-03 17:06:37', 0, '0000-00-00 00:00:00', 50, '2014-06-24 22:53:30', 10),
(55, '10 điểm cần khám phá ở Seoul', 'Nếu có dịp đến Seoul (Hàn Quốc), bạn sẽ choáng ngợp với những tòa nhà chọc trời, những shop thời trang sang trọng và rất nhiều điểm đến nổi tiếng.', '<div>\r\n	<strong>Nếu có dịp đến Seoul (Hàn Quốc), bạn sẽ choáng ngợp với những tòa nhà chọc trời, những shop thời trang sang trọng và rất nhiều điểm đến nổi tiếng. Nhưng nếu chỉ có 24giờ để khám phá thành phố này, chắc chắn bạn sẽ bối rối vì không biết đi chỗ nào bỏ chỗ nào. Sau đây là 10 điểm bạn nên khám phá khi đến Seoul.</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" src="/public/files/images/seoul.png" style="width: 500px; height: 332px;" /></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<div align="justify" class="posttext">\r\n		<strong>1. Cung Gyeongbok</strong></div>\r\n	<div align="justify" class="posttext">\r\n		Đây là cung điện nổi tiếng nhất Hàn Quốc, nằm phía cuối đại lộ chính của Seoul. Cung điện được xây dựng cuối năm 1300, đã từng bị phá hủy và được xây dựng lại trong một thời gian dài. Những tour du lịch của Anh thường đưa khách tới đây ba lần mỗi ngày để tìm hiểu kiến trúc truyền thống và vương triều xưa. Bạn sẽ mất ít nhất 1 giờ để đi vòng quanh các khu nhà và sảnh đường trong khuôn viên cung điện được bao quanh bởi các bức tường.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>2. Cung Changdeok </strong></div>\r\n	<div align="justify" class="posttext">\r\n		Nằm gần cung điện Gyeongbok (cung Gyeongbok nằm ở phía tây và cung điện Changdeok nằm ở phía đông). Đây là cung điện mang đậm phong cách Hàn Quốc nhất. Không khó để bạn có thể hình dung những khung cảnh xưa cũ khi đi dạo quanh toàn bộ khu này. Tại đây có một khu lớn nhất gồm những nhà bằng gỗ (hoặc hanok) truyền thống đặc trưng của người Hàn Quốc. Kiến trúc cung này được thiết kế hài hòa với thiên nhiên đặc trưng là những khu sân nhỏ, vòng ngoài được trang trí bằng những bức tường và mái ngói màu tối.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>3. Hệ thống cửa hàng bán lẻ Shinsegae</strong></div>\r\n	<div align="justify" class="posttext">\r\n		Đây là một trong ba chuỗi cửa hàng bán lẻ lớn trong thành phố (hai chuỗi khác là Lotte và Huyndai). Hệ thống này làm người mua hoa mắt với rất nhiều loại hàng hóa được bày bán. Từ con cá tươi nguyên đến món kim chi đặc trưng Hàn Quốc hay giày dép, vải vóc… Đối diện cửa hàng bên kia đường là gặp Ngân hàng Korea trên đường Chungmuro nằm giữa chợ Namdaemun và khu mua sắm Myeongdong. Ở đây bạn có thể đón xe điện ngầm đến ga Hoehyun hoặc đến trung tâm mua sắm Lotte với 10 phút đi bộ.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>4. Núi Bugaksan</strong></div>\r\n	<div align="justify" class="posttext">\r\n		Một trong những nơi tuyệt vời nhất để leo núi đó là núi Bugaksan. Từ đỉnh núi cao 342m, bạn có thể nhìn bao quát vẻ đẹp của cả thủ đô. Bạn có thể theo lại dấu chân của những lính đặc công đã từng leo lên núi này cách đây 40 năm để ám sát tổng thống nhưng không thành công. Pháo đài Seoul trước đây cũng bị đóng cửa vì lý do an ninh nhưng đã được mở cửa trở lại từ năm 2006 cho khách tham quan. Khi đến đây bạn nhớ mang theo passport.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>5. Itaewon </strong></div>\r\n	<div align="justify" class="posttext">\r\n		Đây là khu mua sắm giải trí nổi tiếng mà hầu hết du khách khi tới Seoul đều tìm tới. Khu này gồm các quán bar, câu lạc bộ, nhà hàng và các shop bán đủ loại hàng từ sản phẩm, đồ đạc đến đồ may sẵn, nữ trang, hàng thủ công… Một trong những câu lạc bộ nổi tiếng nhất ở đây là CLB Volume nằm ở tầng hầm của khách sạn Crown. Đến CLB này bạn sẽ có cơ hội thưởng thức tài nghệ của các tay DJ bậc nhất thế giới. Để đến đây, bạn đón xe điện ngầm line số 6 đến ga Naksapyeong. CLB này cách đó khoảng 500m, chỉ mở cửa từ 9 giờ tối.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>6. Khu chợ Namdaemun</strong></div>\r\n	<div align="justify" class="posttext">\r\n		Đây là một khu mua sắm tuyệt vời dường như mở suốt ngày đêm, chỉ trừ vài người bán lẻ nghỉ vào chủ nhật. Bạn có thể tìm thấy những bộ quần áo giá rẻ hoặc nhiều thứ khác như đồ dùng gia đình, vải vóc, nữ trang, thiết bị, đồ chơi, thực phẩm, hoa, đồ dùng văn phòng… Khu chợ này có hàng ngàn cửa hàng, người tham quan mua sắm đông đúc nên bạn chuẩn bị sẵn tinh thần sẽ bị va chạm khi đến đây. Nếu đói bụng, bạn có thể thử các món ăn đặc trưng của Hàn Quốc như món mandu gook – món xúp có rau và bánh gạo hấp, hay món bánh bindae duk. Để đến được đây, bạn đón xe điện ngầm line số 4 đến ga Hoehyeon. Du khách muốn biết thêm thông tin về chợ này xin gọi số 02-752-1913.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>7. Suối Cheonggyecheon</strong></div>\r\n	<div align="justify" class="posttext">\r\n		Dòng suối dài 5, 8km chảy ngay giữa thủ đô Seoul. Đây là một điểm nhấn nổi tiếng ở Seoul với nhiều công trình kiến trúc hiện đại dọc hai bên bờ sông. Bạn có thể đi bộ dọc con sông này để chiêm ngưỡng vẻ đẹp của nó với những dòng thác nhỏ, những cây cầu bắc qua sông. Bạn cũng đừng ngạc nhiên nếu bắt gặp các đôi tình nhân ở đây nhiều hơn ở công viên trung tâm New York.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>8. Đài tưởng niệm chiến tranh Hàn Quốc </strong></div>\r\n	<div align="justify" class="posttext">\r\n		Được gọi là đài tưởng niệm chiến tranh nhưng đây lại giống như khu bảo tàng lịch sử quân đội khổng lồ (vé vào cửa 3 USD). Ở đây trưng bày các loại xe tăng, máy bay, súng ống…</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>9. Tour tham quan</strong></div>\r\n	<div align="justify" class="posttext">\r\n		Seoul bằng xe buýt Nếu không muốn khám phá Seoul bằng taxi hay xe điện ngầm, bạn có thể làm một tour tham quan thành phố này bằng xe buýt. Với khoảng 10USD bạn có thể lên và xuống ít nhất được hai nơi đó là các khu chợ và tòa nhà N Seoul - một nơi lý tưởng để ngắm nhìn toàn thành phố. Xe chạy từ thứ ba đến chủ nhật từ 9giờ đến 19giờ tối, cũng có chuyến ban đêm từ 8giờ tối đến 10giờ tối.</div>\r\n	<div align="justify" class="posttext">\r\n		<br />\r\n		<strong>10. Ẩm thực Hàn Quốc </strong></div>\r\n	<div align="justify" class="posttext">\r\n		Đến Hàn Quốc một trong những thứ không thể bỏ qua đó là thưởng thức các món ăn. Với 15 USD bạn sẽ có một đĩa thức ăn với các món quen thuộc của xứ Hàn như japchae (miến trộn thịt bò và rau), doenjang jjigae (món hầm với pate, đậu, tàu hũ và rau hoặc thịt), sengsun ya-chae jeon (cá chiên với rau) hay món kalbi (thịt bò ướp gia vị nướng trên lưới sắt). Nhà hàng ở đây thường nằm trong hanok (nhà nhỏ làm bằng gỗ theo kiểu truyền thống).</div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'articleimage_137025419851ac6b76cefbd.png', 0, 1, 23, 0, 5, '2013-06-03 17:06:58', 0, '0000-00-00 00:00:00', 50, '2014-06-24 22:53:30', 9);

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `description` text,
  `publish` int(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`id`, `category_name`, `description`, `publish`, `publisher_id`, `publish_time`, `order`, `lock_status`, `parent_category_id`, `created`, `created_by`) VALUES
(12, 'Kinh tế', '', 1, 50, '2014-06-24 10:47:44', 3, 0, 0, '2013-05-06 22:05:00', 43),
(14, 'Văn hóa', 'Xã hội', 1, 50, '2014-06-24 10:47:44', 4, 0, 0, '2013-05-12 09:05:39', 5),
(16, 'Tin du lịch', 'Tin du lịch', 1, 50, '2014-07-31 16:18:57', 1, 0, 0, '2013-05-28 21:05:44', 5),
(17, 'Cẩm nang du lịch', 'Cẩm nang du lịch', 1, 50, '2014-06-24 10:47:44', 2, 0, 16, '2013-05-28 21:05:27', 5),
(18, 'Kinh tế Việt Nam', '', 1, 50, '2014-06-24 10:47:44', 5, 0, 12, '2013-07-25 22:41:56', 5),
(19, 'Văn hóa Việt Nam', '', 1, 50, '2014-06-24 10:47:44', 6, 0, 14, '2013-07-25 22:42:07', 5),
(20, 'Kinh tế thế giới', '', 1, 50, '2014-06-24 10:47:44', 7, 0, 12, '2013-07-25 22:42:18', 5),
(21, 'Tin du lịch 2', '', 1, 50, '2014-07-31 16:20:15', 8, 1, 16, '2014-07-31 16:20:15', 50);

-- --------------------------------------------------------

--
-- Table structure for table `news_category_article`
--

CREATE TABLE IF NOT EXISTS `news_category_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_article` (`category_id`,`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `news_category_article`
--

INSERT INTO `news_category_article` (`id`, `category_id`, `article_id`) VALUES
(143, 12, 56),
(104, 12, 39),
(127, 12, 37),
(141, 12, 57),
(98, 12, 45),
(126, 12, 47),
(125, 17, 52),
(124, 17, 53),
(122, 17, 54),
(123, 17, 55),
(140, 16, 57),
(142, 14, 57),
(144, 14, 56);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_brief` text NOT NULL,
  `page_content` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `system_page` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `publish` int(1) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_title`, `page_brief`, `page_content`, `cover_image`, `lock_status`, `system_page`, `order`, `publish`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`) VALUES
(1, 'Giới thiệu chung', 'Giới thiệu Công ty TNN CNT Logistics', '<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>\r\n', 'pageimage_1367683811518532e3d722c.png', 1, 1, 23, 1, 43, '2013-04-01 16:04:23', 50, '2014-06-28 16:09:57', 50, '2014-07-31 11:13:45'),
(42, 'Thông tin liên hệ', 'Thông tin liên hệ Công ty cổ phần thương mại và du lịch Ước Mơ Việt', '<h3>\r\n	Công ty TNHH CNT Logistics</h3>\r\n<h5>\r\n	Địa chỉ: ............</h5>\r\n<h5>\r\n	Điện thoại: ............</h5>\r\n<h5>\r\n	Văn phòng đại diện: ........</h5>\r\n', 'pageimage_1365583670516527362a670.png', 1, 1, 24, 1, 43, '2013-04-10 15:04:50', 50, '2014-06-28 16:10:26', 50, '2014-07-31 11:15:33'),
(43, 'Footer', 'Footer', '<h3>\r\n	<img alt="388ic logo" class="footer_logo" src="/public/files/images/388ic-logo-transparent.png" /> Công ty cổ phần xây lắp 388IC</h3>\r\n<hr />\r\n<p>\r\n	Địa chỉ: Lô 22 Lê Hồng Phong, Quận Ngô Quyền, Thành phố Hải Phòng</p>\r\n<p>\r\n	Điện thoại: 0313.247.365</p>\r\n<p>\r\n	Email: quyvm@388ic.vn</p>\r\n', 'pageimage_1366122023516d5e2766dd8.png', 1, 1, 20, 1, 43, '2013-04-16 21:04:23', 50, '2014-06-24 16:34:03', 50, '2014-06-24 16:55:38'),
(51, 'Header', 'Header', '<div>\r\n	<div style="padding: 10px 0;">\r\n		<div>\r\n			<span style="font-size:16px;"><strong>CÔNG TY CỔ PHẦN THƯƠNG MẠI VÀ DU LỊCH ƯỚC MƠ VIỆT</strong></span></div>\r\n		<div>\r\n			Trụ sở: Số 31 Đường Ngang Hạ Lũng - Đằng Hải - Hải An - thành phố Hải Phòng</div>\r\n		<div>\r\n			Điện thoại: +84-31-3.828.998 - Fax: +84-31-3.828.862</div>\r\n		<div>\r\n			Văn phòng đại diện: Số 31 Đường Ngang Hạ Lũng - Đằng Hải - Hải An - thành phố Hải Phòng</div>\r\n	</div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'pageimage_137007164451a9a25cea873.jpg', 1, 1, 25, 1, 5, '2013-06-01 14:06:25', 5, '2013-07-07 18:48:58', 5, '2013-07-07 18:48:58'),
(53, 'Tư vấn online', 'Tư vấn online', '<div class="box-right">\r\n	<div class="tittle-box-right">\r\n		<strong>TƯ VẤN ONLINE</strong></div>\r\n	<div class="content-right-online ">\r\n		<strong>Tư vấn kỹ thuật:</strong>\r\n		<ul>\r\n			<li class="phone">\r\n				<a href="">Mr: Hải - 0985.568.568</a></li>\r\n			<li class="phone">\r\n				<a href="">Mr: Hải - 0985.568.568</a></li>\r\n			<li class="mail">\r\n				<a href="">Email: info@kd.com</a></li>\r\n		</ul>\r\n	</div>\r\n</div>\r\n', 'pageimage_137526231851f8d66e82313.jpg', 1, 1, 26, 1, 5, '2013-07-31 16:18:38', 5, '2013-07-31 16:18:38', 50, '2014-07-30 23:48:54'),
(54, 'Tầm nhìn', 'Tầm nhìn Công ty TNHH CNT Logistics', '<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>\r\n', 'pageimage_140394652153ae8619bbd78.png', 0, 0, 27, 1, 50, '2014-06-28 16:08:42', 50, '2014-06-28 16:08:42', 50, '2014-06-28 16:08:42'),
(55, 'Sứ mệnh', 'Sứ mệnh của Công ty TNHH CNT Logistics', '<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>\r\n', 'pageimage_140394655353ae8639e8860.png', 0, 0, 28, 1, 50, '2014-06-28 16:09:13', 50, '2014-07-31 15:32:32', 50, '2014-07-31 15:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `module` varchar(150) NOT NULL,
  `controller` varchar(150) NOT NULL,
  `action` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=207 ;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Admin Control Panel Dashboard', 'admin', 'index', 'index'),
(2, 'Hiển thị các nhóm', 'admin', 'admin-group', 'index'),
(3, 'Thêm một nhóm mới', 'admin', 'admin-group', 'add'),
(4, 'Chỉnh sửa một nhóm', 'admin', 'admin-group', 'edit'),
(5, 'Xóa một nhóm', 'admin', 'admin-group', 'delete'),
(6, 'Xóa nhiều nhóm', 'admin', 'admin-group', 'multi-delete'),
(7, 'Thay đổi trạng thái nhóm', 'admin', 'admin-group', 'change-status'),
(8, 'Sắp xếp thứ tự nhóm', 'admin', 'admin-group', 'sort'),
(9, 'Liệt kê nhóm theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-group', 'filter'),
(10, 'Hiển thị các thành viên', 'admin', 'admin-user', 'index'),
(11, 'Thêm một thành viên mới', 'admin', 'admin-user', 'add'),
(12, 'Chỉnh sửa một thành viên', 'admin', 'admin-user', 'edit'),
(13, 'Xóa một thành viên', 'admin', 'admin-user', 'delete'),
(14, 'Xóa nhiều thành viên', 'admin', 'admin-user', 'multi-delete'),
(15, 'Thay đổi trạng thái thành viên', 'admin', 'admin-user', 'change-status'),
(17, 'Liệt kê thành viên theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-user', 'filter'),
(36, 'Hiển thị các cấp phép', 'admin', 'admin-permission', 'index'),
(37, 'Thêm cấp phép cho nhóm', 'admin', 'admin-permission', 'add'),
(39, 'Xóa nhiều cấp phép của một nhóm', 'admin', 'admin-permission', 'multi-delete'),
(38, 'Xóa cấp phép của một nhóm', 'admin', 'admin-permission', 'delete'),
(16, 'Sắp xếp thứ tự thành viên', 'admin', 'admin-user', 'sort'),
(44, 'Thay đổi ngôn ngữ hệ thống', 'admin', 'admin-language', 'change-language'),
(43, 'Hiển thị các ngôn ngữ hệ thống', 'admin', 'admin-language', 'index'),
(42, 'Liệt kê cấp phép theo lọc theo nhóm', 'admin', 'admin-permission', 'filter'),
(41, 'Xem thông tin thành viên', 'admin', 'admin-user', 'info'),
(40, 'Xem thông tin nhóm', 'admin', 'admin-group', 'info'),
(18, 'Login to system', 'admin', 'public', 'login'),
(19, 'Logout system', 'admin', 'public', 'logout'),
(45, 'Hiển thị các nhóm tin tức', 'admin', 'admin-news-category', 'index'),
(46, 'Thêm nhóm tin tức mới', 'admin', 'admin-news-category', 'add'),
(47, 'Chỉnh sửa một nhóm tin tức', 'admin', 'admin-news-category', 'edit'),
(48, 'Xóa một nhóm tin tức', 'admin', 'admin-news-category', 'delete'),
(49, 'Xóa nhiều nhóm tin tức', 'admin', 'admin-news-category', 'multi-delete'),
(50, 'Thay đổi trạng thái nhóm tin tức', 'admin', 'admin-news-category', 'change-status'),
(51, 'Sắp xếp thứ tự nhóm tin tức', 'admin', 'admin-news-category', 'sort'),
(52, 'Liệt kê nhóm tin tức theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-news-category', 'filter'),
(53, 'Hiển thị các tin tức', 'admin', 'admin-news-article', 'index'),
(54, 'Thêm tin tức mới', 'admin', 'admin-news-article', 'add'),
(55, 'Chỉnh sửa một tin tức', 'admin', 'admin-news-article', 'edit'),
(56, 'Xóa một tin tức', 'admin', 'admin-news-article', 'delete'),
(57, 'Xóa nhiều tin tức', 'admin', 'admin-news-article', 'multi-delete'),
(58, 'Thay đổi trạng thái tin tức', 'admin', 'admin-news-article', 'change-status'),
(59, 'Sắp xếp thứ tự tin tức', 'admin', 'admin-news-article', 'sort'),
(60, 'Liệt kê tin tức theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-news-article', 'filter'),
(61, 'Xem thông tin nhóm tin tức', 'admin', 'admin-news-category', 'info'),
(62, 'Xem tin tức', 'admin', 'admin-news-article', 'info'),
(63, 'Công bố (đăng) tin lên trang web', 'admin', 'admin-news-article', 'publish'),
(64, 'Hiển thị danh sách các trang nội dung', 'admin', 'admin-pages', 'index'),
(65, 'Thêm trang nội dung mới', 'admin', 'admin-pages', 'add'),
(66, 'Chỉnh sửa một trang nội dung', 'admin', 'admin-pages', 'edit'),
(67, 'Xóa một trang nội dung', 'admin', 'admin-pages', 'delete'),
(68, 'Xóa nhiều trang nội dung', 'admin', 'admin-pages', 'multi-delete'),
(69, 'Sắp xếp thứ tự trang nội dung', 'admin', 'admin-pages', 'sort'),
(70, 'Liệt kê trang theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-pages', 'filter'),
(71, 'Xem nội dung trang', 'admin', 'admin-pages', 'info'),
(72, 'Khóa/mở khóa trang nội dung', 'admin', 'admin-pages', 'change-lock-status'),
(73, 'Hiển thị danh sách các dịch vụ', 'admin', 'admin-service', 'index'),
(74, 'Thêm dịch vụ mới', 'admin', 'admin-service', 'add'),
(75, 'Chỉnh sửa một dịch vụ', 'admin', 'admin-service', 'edit'),
(76, 'Xóa một dịch vụ', 'admin', 'admin-service', 'delete'),
(77, 'Xóa nhiều dịch vụ', 'admin', 'admin-service', 'multi-delete'),
(78, 'Sắp xếp thứ tự các dịch vụ', 'admin', 'admin-service', 'sort'),
(79, 'Liệt kê dịch vụ theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-service', 'filter'),
(80, 'Xem dịch vụ', 'admin', 'admin-service', 'info'),
(81, 'Khóa/mở khóa trang dịch vụ', 'admin', 'admin-service', 'change-lock-status'),
(82, 'Công bố (đăng) dịch vụ lên trang web', 'admin', 'admin-service', 'publish'),
(83, 'Thay đổi featured service', 'admin', 'admin-service', 'change-featured-service'),
(84, 'Hiển thị danh sách các nhóm sản phẩm', 'admin', 'admin-product-category', 'index'),
(85, 'Thêm nhóm sản phẩm mới', 'admin', 'admin-product-category', 'add'),
(86, 'Chỉnh sửa một nhóm sản phẩm', 'admin', 'admin-product-category', 'edit'),
(87, 'Xóa một nhóm sản phẩm', 'admin', 'admin-product-category', 'delete'),
(88, 'Xóa nhiều nhóm sản phẩm', 'admin', 'admin-product-category', 'multi-delete'),
(89, 'Sắp xếp thứ tự các nhóm sản phẩm', 'admin', 'admin-product-category', 'sort'),
(90, 'Liệt kê nhóm sản phẩm theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-product-category', 'filter'),
(91, 'Xem thông tin nhóm sản phẩm', 'admin', 'admin-product-category', 'info'),
(92, 'Khóa/mở khóa nhóm sản phẩm', 'admin', 'admin-product-category', 'change-lock-status'),
(93, 'Công bố (đăng) nhóm sản phẩm lên trang web', 'admin', 'admin-product-category', 'publish'),
(94, 'Hiển thị danh sách các sản phẩm', 'admin', 'admin-product', 'index'),
(95, 'Thêm sản phẩm mới', 'admin', 'admin-product', 'add'),
(96, 'Chỉnh sửa sản phẩm', 'admin', 'admin-product', 'edit'),
(97, 'Xóa một sản phẩm', 'admin', 'admin-product', 'delete'),
(98, 'Xóa nhiều sản phẩm', 'admin', 'admin-product', 'multi-delete'),
(99, 'Sắp xếp thứ tự các sản phẩm', 'admin', 'admin-product', 'sort'),
(100, 'Liệt kê sản phẩm theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-product', 'filter'),
(101, 'Xem thông tin sản phẩm', 'admin', 'admin-product', 'info'),
(102, 'Khóa/mở khóa sản phẩm', 'admin', 'admin-product', 'change-lock-status'),
(103, 'Công bố (đăng) sản phẩm lên trang web', 'admin', 'admin-product', 'publish'),
(104, 'Hiển thị danh sách các gallery', 'admin', 'admin-gallery', 'index'),
(105, 'Thêm gallery mới', 'admin', 'admin-gallery', 'add'),
(106, 'Chỉnh sửa gallery', 'admin', 'admin-gallery', 'edit'),
(107, 'Xóa một gallery', 'admin', 'admin-gallery', 'delete'),
(108, 'Xóa nhiều gallery', 'admin', 'admin-gallery', 'multi-delete'),
(109, 'Sắp xếp thứ tự các gallery', 'admin', 'admin-gallery', 'sort'),
(110, 'Liệt kê gallery theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-gallery', 'filter'),
(111, 'Xem thông tin gallery', 'admin', 'admin-gallery', 'info'),
(112, 'Khóa/mở khóa gallery', 'admin', 'admin-gallery', 'change-lock-status'),
(113, 'Công bố (đăng) gallery lên trang web', 'admin', 'admin-gallery', 'publish'),
(114, 'Hiển thị danh sách các ảnh', 'admin', 'admin-gallery-image', 'index'),
(115, 'Upload ảnh mới', 'admin', 'admin-gallery-image', 'add'),
(116, 'Xóa một ảnh', 'admin', 'admin-gallery-image', 'delete'),
(117, 'Xóa nhiều ảnh', 'admin', 'admin-ga', ''),
(118, 'Xóa nhiều ảnh', 'admin', 'admin-gallery-image', 'multi-delete'),
(119, 'Sắp xếp thứ tự các ảnh', 'admin', 'admin-gallery-image', 'sort'),
(120, 'Liệt kê ảnh theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-gallery-image', 'filter'),
(121, 'Công bố (đăng) ảnh lên trang web', 'admin', 'admin-gallery-image', 'publish'),
(122, 'Hiển thị danh sách các contact', 'admin', 'admin-contact', 'index'),
(123, 'Xóa một contact', 'admin', 'admin-contact', 'delete'),
(124, 'Xóa nhiều contact', 'admin', 'admin-contact', 'multi-delete'),
(125, 'Liệt kê contact theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-contact', 'filter'),
(126, 'Sắp xếp thứ tự các contact', 'admin', 'admin-contact', 'sort'),
(127, 'Công bố (đăng) contact lên trang web', 'admin', 'admin-contact', 'publish'),
(128, 'Khóa/mở khóa contact', 'admin', 'admin-contact', 'change-lock-status'),
(129, 'Quản lý template - ảnh banner slide', 'admin', 'admin-template', 'banner'),
(130, 'Quản lý template - ảnh logo công ty', 'admin', 'admin-template', 'logo'),
(131, 'Quản lý template - ảnh sơ đồ công ty', 'admin', 'admin-template', 'company-map'),
(132, 'Quản lý template - xóa ảnh banner', 'admin', 'admin-template', 'banner-delete'),
(133, 'Xem thông tin bản thân', 'admin', 'admin-user', 'info-yourself'),
(134, 'Chỉnh sửa thông tin bản thân', 'admin', 'admin-user', 'edit-yourself'),
(135, 'Thay đổi mật khẩu', 'admin', 'admin-user', 'change-password'),
(136, 'Hiển thị các nhóm dự án', 'admin', 'admin-project-category', 'index'),
(137, 'Thêm nhóm dự án mới', 'admin', 'admin-project-category', 'add'),
(138, 'Chỉnh sửa một nhóm dự án', 'admin', 'admin-project-category', 'edit'),
(139, 'Xóa một nhóm dự án', 'admin', 'admin-project-category', 'delete'),
(140, 'Xóa nhiều nhóm dự án', 'admin', 'admin-project-category', 'multi-delete'),
(141, 'Sắp xếp thứ tự các nhóm dự án', 'admin', 'admin-project-category', 'sort'),
(142, 'Liệt kê nhóm dự án theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-project-category', 'filter'),
(143, 'Xem thông tin nhóm dự án', 'admin', 'admin-project-category', 'info'),
(144, 'Khóa/mở khóa nhóm dự án', 'admin', 'admin-project-category', 'change-lock-status'),
(145, 'Công bố (đăng) nhóm dự án lên trang web', 'admin', 'admin-project-category', 'publish'),
(146, 'Thay đổi trạng thái nhóm dự án', 'admin', 'admin-project-category', 'change-status'),
(147, 'Hiển thị các dự án', 'admin', 'admin-project', 'index'),
(148, 'Thêm dự án mới', 'admin', 'admin-project', 'add'),
(149, 'Chỉnh sửa một dự án', 'admin', 'admin-project', 'edit'),
(150, 'Xóa một dự án', 'admin', 'admin-project', 'delete'),
(151, 'Xóa nhiều dự án', 'admin', 'admin-project', 'multi-delete'),
(152, 'Sắp xếp thứ tự các dự án', 'admin', 'admin-project', 'sort'),
(153, 'Liệt kê dự án theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-project', 'filter'),
(154, 'Xem thông tin dự án', 'admin', 'admin-project', 'info'),
(155, 'Khóa/mở khóa dự án', 'admin', 'admin-project', 'change-lock-status'),
(156, 'Công cố (đăng) dự án lên trang web', 'admin', 'admin-project', 'publish'),
(157, 'Thay đổi trạng thái nhóm dự án', 'admin', 'admin-project', 'change-status'),
(158, 'Công bố (đăng) trang lên trang web', 'admin', 'admin-pages', 'publish'),
(159, 'Khóa/mở khóa nhóm tin tức', 'admin', 'admin-news-category', 'change-lock-status'),
(160, 'Công bố (đăng) nhóm tin tức lên trang web', 'admin', 'admin-news-category', 'publish'),
(161, 'Khóa/mở khóa tin tức', 'admin', 'admin-news-article', 'change-lock-status'),
(162, 'Hiển thị danh sách các nhóm tour', 'admin', 'admin-tour-category', 'index'),
(163, 'Thêm nhóm tour mới', 'admin', 'admin-tour-category', 'add'),
(164, 'Chỉnh sửa một nhóm tour', 'admin', 'admin-tour-category', 'edit'),
(165, 'Xóa một nhóm tour', 'admin', 'admin-tour-category', 'delete'),
(166, 'Xóa nhiều nhóm tour', 'admin', 'admin-tour-category', 'multi-delete'),
(167, 'Sắp xếp thứ tự các nhóm tour', 'admin', 'admin-tour-category', 'sort'),
(168, 'Liệt kê nhóm tour theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-tour-category', 'filter'),
(173, 'Hiển thị danh sách các tour', 'admin', 'admin-tour', 'index'),
(170, 'Xem thông tin nhóm tour', 'admin', 'admin-tour-category', 'info'),
(171, 'Khóa/mở khóa nhóm tour', 'admin', 'admin-tour-category', 'change-lock-status'),
(172, 'Công bố (đăng) nhóm tour lên trang web', 'admin', 'admin-tour-category', 'publish'),
(174, 'Thêm tour mới', 'admin', 'admin-tour', 'add'),
(175, 'Chỉnh sửa một tour', 'admin', 'admin-tour', 'edit'),
(176, 'Xóa một tour', 'admin', 'admin-tour', 'delete'),
(177, 'Xóa nhiều tour', 'admin', 'admin-tour', 'multi-delete'),
(178, 'Sắp xếp thứ tự các tour', 'admin', 'admin-tour', 'sort'),
(179, 'Liệt kê tour theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-tour', 'filter'),
(180, 'Xem thông tin tour', 'admin', 'admin-tour', 'info'),
(181, 'Khóa/mở khóa tour', 'admin', 'admin-tour', 'change-lock-status'),
(182, 'Công bố (đăng) tour lên trang web', 'admin', 'admin-tour', 'publish'),
(183, 'Hiển thị các nhóm dịch vụ', 'admin', 'admin-service-category', 'index'),
(184, 'Thêm nhóm dịch vụ mới', 'admin', 'admin-service-category', 'add'),
(185, 'Chỉnh sửa một nhóm dịch vụ', 'admin', 'admin-service-category', 'edit'),
(186, 'Xóa một nhóm dịch vụ', 'admin', 'admin-service-category', 'delete'),
(187, 'Xóa nhiều nhóm dịch vụ', 'admin', 'admin-service-category', 'multi-delete'),
(188, 'Sắp xếp thứ tự các nhóm dịch vụ', 'admin', 'admin-service-category', 'sort'),
(189, 'Liệt kê nhóm dịch vụ theo tùy chọn lọc, tìm kiếm...', 'admin', 'admin-service-category', 'filter'),
(190, 'Xem thông tin nhóm dịch vụ', 'admin', 'admin-service-category', 'info'),
(191, 'Khóa/mở khóa nhóm dịch vụ', 'admin', 'admin-service-category', 'change-lock-status'),
(192, 'Công bố (đăng) nhóm dịch vụ lên trang web', 'admin', 'admin-service-category', 'publish'),
(193, 'Quản lý template - video', 'admin', 'admin-template', 'video'),
(194, 'Quản lý template - các ảnh quảng cáo', 'admin', 'admin-template', 'advertise'),
(195, 'Quản lý template - xóa ảnh quảng cáo', 'admin', 'admin-template', 'advertise-delete'),
(196, 'Quản lý template - sửa­ ảnh quảng cáo', 'admin', 'admin-template', 'advertise-edit'),
(197, 'Hiển thị danh sách các thuộc tính sản phẩm', 'admin', 'admin-product-category-attribute', 'index'),
(198, 'Thêm thuộc tính sản phẩm mới', 'admin', 'admin-product-category-attribute', 'add'),
(199, 'Chỉnh sửa thuộc tính sản phẩm', 'admin', 'admin-product-category-attribute', 'edit'),
(200, 'Xóa một thuộc tính sản phẩm', 'admin', 'admin-product-category-attribute', 'delete'),
(201, 'Xóa nhiều thuộc tính sản phẩm', 'admin', 'admin-product-category-attribute', 'multi-delete'),
(202, 'Sắp xếp thứ tự các thuộc tính sản phẩm', 'admin', 'admin-product-category-attribute', 'sort'),
(203, 'Liệt kê các thuộc tính sản phẩm theo điều kiện lọc, tìm kiếm...', 'admin', 'admin-product-category-attribute', 'filter'),
(204, 'Xem thông tin thuộc tính sản phẩm', 'admin', 'admin-product-category-attribute', 'info'),
(205, 'Khóa/mở khóa thuộc tính sản phẩm', 'admin', 'admin-product-category-attribute', 'change-lock-status'),
(206, 'Công bố (đăng) thuộc tính sản phẩm lên trang web', 'admin', 'admin-product-category-attribute', 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_serial` varchar(255) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_brief` varchar(255) NOT NULL,
  `product_detail` mediumtext NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `special` tinyint(1) NOT NULL DEFAULT '0',
  `selloff` float NOT NULL DEFAULT '0',
  `author` varchar(200) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '10',
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `lock_status` int(11) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_serial`, `product_name`, `product_brief`, `product_detail`, `cover_image`, `price`, `manufacturer`, `special`, `selloff`, `author`, `order`, `publish`, `lock_status`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`, `product_category_id`) VALUES
(40, 'TDD-35KV', 'Tiếp địa di động 35kV', '', '<div>\r\n	Tiếp địa di động 35kV</div>\r\n', 'productimage_13774269115219dddf92363.jpg', 'Liên hệ', '', 0, 0, NULL, 13, 1, 0, 50, '2013-08-25 17:35:11', 50, '2013-08-25 17:35:11', 50, '2014-06-28 22:23:43', 58),
(41, 'BCC-MF24', 'Bình chữa cháy MFZ4', '', '<div>\r\n	<div style="color: rgb(52, 52, 52); font-family: Tahoma; font-size: 12px; line-height: 18px; background-color: rgb(255, 255, 255);">\r\n		<b style="font-family: Arial; font-size: small;">1. ƯU ĐIỂM CỦA BÌNH CHỮA CHÁY MFZ24 - ABC</b></div>\r\n	<div style="color: rgb(52, 52, 52); font-family: Tahoma; font-size: 12px; line-height: 18px; background-color: rgb(255, 255, 255);">\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; background-color: rgb(249, 249, 249);">Cơ chế của&nbsp;<b><u>bình chữa cháy</u></b>&nbsp;MFZ24 là tác dụng của CO2 làm loãng nồng độ hơi chất cháy trong vùng cháy và bên cạnh đó nó còn có tác dụng làm lạnh do CO2 ở dạng lỏng khi bay hơi sẽ thu nhiệt.</span></div>\r\n	<div style="color: rgb(52, 52, 52); font-family: Tahoma; font-size: 12px; line-height: 18px; background-color: rgb(255, 255, 255);">\r\n		&nbsp;</div>\r\n	<div>\r\n		<b><font face="Arial" size="2">2. CÁCH SỬ DỤNG BÌNH CHỮA CHÁY</font></b><b><font face="Arial" size="2">&nbsp;</font></b><b style="font-family: Arial; font-size: small;">MFZ24 - ABC</b></div>\r\n	<div>\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);">Khi có cháy xảy ra, di chuyển bình tới gần điểm cháy, giật chốt hãm.</span><br style="margin: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);" />\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);">Chọn đầu hướng ngọn lửa, hướng loa phun vào càng gần gốc lửa càng tốt.</span><br style="margin: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);" />\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);">Bóp (hay vặn) van để khí tự phun ra dập lửa.</span></div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774269795219de23cfce3.jpg', 'Liên hệ', '', 0, 0, NULL, 14, 1, 0, 50, '2013-08-25 17:36:19', 50, '2013-08-25 17:36:19', 50, '2014-06-28 22:23:43', 67),
(34, 'BCC-MT24', 'Bình chữa cháy MT24', 'Bình chữa cháy MT24', '<ul class="nav nav-tabs nav-justified product-info">\r\n	<li class="active">\r\n		<a data-toggle="tab" href="#thong-so-ky-thuat" role="tab">Thông số kỹ thuật</a></li>\r\n	<li>\r\n		<a data-toggle="tab" href="#bao-hanh" role="tab">Bảo hành</a></li>\r\n	<li>\r\n		<a data-toggle="tab" href="#lien-he-dat-hang" role="tab">Liên hệ đặt hàng</a></li>\r\n</ul>\r\n<div class="tab-content product-detail">\r\n	<div class="tab-pane active" id="thong-so-ky-thuat">\r\n		Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat</div>\r\n	<div class="tab-pane" id="bao-hanh">\r\n		Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh</div>\r\n	<div class="tab-pane" id="lien-he-dat-hang">\r\n		Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang</div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774259905219da465eaac.jpg', 'Liên hệ', 'China', 0, 0, NULL, 8, 1, 0, 43, '2013-04-07 09:04:43', 50, '2014-06-29 15:56:35', 50, '2014-06-29 15:56:35', 60),
(35, 'BCH-MT5', 'Bình cứu hỏa CO2 MT5', '', '<ul class="nav nav-tabs nav-justified product-info">\r\n	<li class="active">\r\n		<a data-toggle="tab" href="#thong-so-ky-thuat" role="tab">Thông số kỹ thuật</a></li>\r\n	<li>\r\n		<a data-toggle="tab" href="#bao-hanh" role="tab">Bảo hành</a></li>\r\n	<li>\r\n		<a data-toggle="tab" href="#lien-he-dat-hang" role="tab">Liên hệ đặt hàng</a></li>\r\n</ul>\r\n<div class="tab-content product-detail">\r\n	<div class="tab-pane active" id="thong-so-ky-thuat">\r\n		Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat Thong so ky thuat</div>\r\n	<div class="tab-pane" id="bao-hanh">\r\n		Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh Bao hanh</div>\r\n	<div class="tab-pane" id="lien-he-dat-hang">\r\n		Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang Lien he dat hang</div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774265055219dc490cb88.jpg', 'Liên hệ', 'China', 0, 0, NULL, 9, 1, 0, 43, '2013-04-07 09:04:53', 50, '2014-06-29 16:20:51', 50, '2014-06-29 16:20:51', 59),
(36, 'BCH-CTD', 'Bình cứu hỏa cầu tự động', '', '<div>\r\n	<div>\r\n		<div class="ss-ProductInfo">\r\n			<div>\r\n				<strong>1. ƯU ĐIỂM CỦA BÌNH CỨU HỎA CẦU TỰ ĐỘNG</strong></div>\r\n			<div>\r\n				<strong>Bình cứu hỏa</strong> tự&nbsp;động&nbsp;có cấu trúc đơn giản (có móc treo tường), hoạt động ổn định và ứng dụng thuận tiện, với khả năng dập lửa nhanh, hiệu quả cao liên tục trong suốt quá trình phun.&nbsp;</div>\r\n			<div>\r\n				Ứng dụng:&nbsp;chữa cháy do dầu, xăng, hơi gas và do phát sinh tia lửa điện. Sản phẩm được sử dụng rộng rãi ở các nhà máy,&nbsp;kho hàng, trạm bơm xăng,&nbsp;trạm biến thế, trạm viễn thông BTS&nbsp;và những nơi có chứa hoá chất…..Ngay khi có lửa (nhiệt độ &gt; 700C) bình cầu sẽ tự động kích hoạt từ 3 đến 5 giây, để dập tắt đám cháy..</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774264535219dc15abea5.jpg', 'Liên hệ', 'China', 0, 0, NULL, 10, 1, 0, 43, '2013-04-07 09:04:06', 50, '2013-08-25 17:27:33', 50, '2014-06-28 22:23:43', 59),
(39, 'TCD-35KV', 'Thảm cách điện 35kV', '', '<div>\r\n	<h3>\r\n		Thảm cách điện 35kV</h3>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774267865219dd62246f3.jpg', 'Liên hệ', '', 0, 0, NULL, 12, 1, 0, 50, '2013-08-25 17:33:06', 50, '2013-08-25 17:33:06', 50, '2014-06-28 22:23:43', 58),
(38, 'BCC-MT3', 'Bình chữa cháy khí CO2', '', '<div>\r\n	<div>\r\n		<strong>1. ƯU ĐIỂM CỦA BÌNH CHỮA CHÁY CO2:</strong></div>\r\n	<ul>\r\n		<li>\r\n			<strong><u>Bình chữa cháy</u></strong>&nbsp;CO2 là thiết bị chữa cháy bên trong chứa khí CO2 -790c được nén vào bình chịu áp lực cao, dùng để dập cháy, có độ tin cậy cao.,sử dụng, thao tác đơn giản thuận tiện, hiệu quả.</li>\r\n		<li>\r\n			Bình CO2 đạt hiệu rất cao khi chữa các đám cháy ở những nơi kín gió, trong phòng kín, buồng., hầm, các thiết bị.&nbsp; điện… sau khi dập tắt đám cháy không để lại dấu vết, không làm hư hỏng chất cháy.</li>\r\n	</ul>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774263165219db8c804a0.jpg', 'Liên hệ', '', 0, 0, NULL, 11, 1, 0, 50, '2013-08-25 17:25:16', 50, '2013-08-25 17:25:53', 50, '2014-06-28 22:23:43', 60),
(42, 'BCC-MT24', 'Bình chữa cháy MT24', '', '<div>\r\n	<div style="color: rgb(52, 52, 52); font-family: Tahoma; font-size: 12px; line-height: 18px; text-align: justify; background-color: rgb(255, 255, 255);">\r\n		<font face="Arial" size="2"><b>1. ƯU ĐIỂM CỦA BÌNH CHỮA CHÁY MT24</b></font></div>\r\n	<div style="color: rgb(52, 52, 52); font-family: Tahoma; font-size: 12px; line-height: 18px; text-align: justify; background-color: rgb(255, 255, 255);">\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; background-color: rgb(249, 249, 249);">Cơ chế của&nbsp;<b><u>bình chữa cháy</u></b>&nbsp;MT24 là tác dụng của CO2 làm loãng nồng độ hơi chất cháy trong vùng cháy và bên cạnh đó nó còn có tác dụng làm lạnh do CO2 ở dạng lỏng khi bay hơi sẽ thu nhiệt.</span></div>\r\n	<div style="color: rgb(52, 52, 52); font-family: Tahoma; font-size: 12px; line-height: 18px; text-align: justify; background-color: rgb(255, 255, 255);">\r\n		&nbsp;</div>\r\n	<div>\r\n		<b><font face="Arial" size="2">2. CÁCH SỬ DỤNG BÌNH CHỮA CHÁY</font></b><b><font face="Arial" size="2">&nbsp;</font></b><b style="font-family: Arial; font-size: small;">MT24</b></div>\r\n	<div>\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);">Khi có cháy xảy ra, di chuyển bình tới gần điểm cháy, giật chốt hãm.</span><br style="margin: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);" />\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);">Chọn đầu hướng ngọn lửa, hướng loa phun vào càng gần gốc lửa càng tốt.</span><br style="margin: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);" />\r\n		<span style="color: rgb(51, 51, 51); font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 21.75px; text-align: left; background-color: rgb(249, 249, 249);">Bóp (hay vặn) van để khí tự phun ra dập lửa.</span></div>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774270225219de4ed6720.jpg', 'Liên hệ', '', 0, 0, NULL, 15, 1, 0, 50, '2013-08-25 17:37:02', 50, '2013-08-25 17:37:02', 50, '2014-06-28 22:23:43', 67),
(43, 'BCC-CO2', 'Bình chữa cháy khí CO2', '', '<div>\r\n	<div>\r\n		<strong>1. ƯU ĐIỂM CỦA BÌNH CHỮA CHÁY CO2:</strong></div>\r\n	<ul>\r\n		<li>\r\n			<strong><u>Bình chữa cháy</u></strong>&nbsp;CO2 là thiết bị chữa cháy bên trong chứa khí CO2 -790c được nén vào bình chịu áp lực cao, dùng để dập cháy, có độ tin cậy cao.,sử dụng, thao tác đơn giản thuận tiện, hiệu quả.</li>\r\n		<li>\r\n			Bình CO2 đạt hiệu rất cao khi chữa các đám cháy ở những nơi kín gió, trong phòng kín, buồng., hầm, các thiết bị.&nbsp; điện… sau khi dập tắt đám cháy không để lại dấu vết, không làm hư hỏng chất cháy.</li>\r\n	</ul>\r\n	<div>\r\n		<strong>2. CÁCH SỬ DỤNG BÌNH CHỮA CHÁY CO2</strong></div>\r\n	<ul>\r\n		<li>\r\n			Khi xảy ra cháy, xách&nbsp;<u><em>bình chữa cháy</em></u>&nbsp;CO2 tiếp cận đám cháy, một tay cầm loa phun hướng vào gốc&nbsp; lửa tối thiểu là. 0,5m còn tay kia mở van bình hoặc bóp cò (tùy theo từng loại bình).&nbsp;</li>\r\n		<li>\r\n			Khí CO2 ở nhiệt độ –790C dưới dạng tuyết lạnh khi qua loa phun ra có tác dụng hạ thấp nhiệt độ của đám cháy (chữa cháy bằng phương. pháp làm lạnh).</li>\r\n		<li>\r\n			sau đó khí CO2&nbsp; bao phủ lên toàn bộ bề mặt của đám cháy làm giảm nồng độ của ôxy khuyếch tán vào vùng cháy, khi hàm lượng ôxy nhỏ. hơn 140/0 thì đám cháy sẽ tắt (Chữa cháy bằng phương pháp làm loãng nồng độ).</li>\r\n	</ul>\r\n</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 'productimage_13774270795219de871ad15.jpg', 'Liên hệ', '', 0, 0, NULL, 16, 1, 0, 50, '2013-08-25 17:37:59', 50, '2013-08-25 17:37:59', 50, '2014-06-28 22:23:43', 67),
(44, 'BCC-MF35', 'Bình chữa cháy xe đẩy MFZ35', '', '<div>\r\n	Thông số kỹ thuật Thông số kỹ thuật Thông số kỹ thuật</div>\r\n<div>\r\n	:::::</div>\r\n<div>\r\n	Bảo hành sản phẩm Bảo hành sản phẩm Bảo hành sản phẩm</div>\r\n<div>\r\n	:::::</div>\r\n<div>\r\n	Liên hệ đặt hàng Liên hệ đặt hàng Liên hệ đặt hàng</div>\r\n', 'productimage_13774271285219deb8613d2.jpg', 'Liên hệ', '', 0, 0, NULL, 17, 1, 0, 50, '2013-08-25 17:38:48', 50, '2014-06-28 23:20:40', 50, '2014-08-02 16:51:35', 67);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_category_attribute_id` int(11) NOT NULL,
  `attribute_value` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT '10',
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `lock_status` int(11) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `product_id`, `product_category_attribute_id`, `attribute_value`, `order`, `publish`, `lock_status`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`) VALUES
(27, 27, 1, '', 1, 0, 0, 43, '2013-04-06 14:04:26', 43, '2013-04-07 09:04:44', 5, '2013-07-15 22:41:55'),
(28, 28, 2, '', 2, 0, 0, 43, '2013-04-06 15:04:32', 43, '2013-04-07 09:04:36', 5, '2013-07-15 22:41:55'),
(29, 29, 3, '', 3, 0, 0, 43, '2013-04-06 15:04:19', 43, '2013-04-07 09:04:29', 5, '2013-07-15 22:41:55'),
(30, 30, 4, '', 4, 0, 0, 43, '2013-04-06 15:04:05', 43, '2013-04-07 09:04:22', 5, '2013-07-15 22:41:55'),
(31, 31, 1, '', 5, 0, 0, 43, '2013-04-06 16:04:35', 43, '2013-04-07 09:04:14', 5, '2013-07-15 22:41:55'),
(32, 32, 2, '', 6, 0, 0, 43, '2013-04-07 09:04:22', 0, '0000-00-00 00:00:00', 5, '2013-07-15 22:41:55'),
(33, 33, 3, '', 7, 0, 0, 43, '2013-04-07 09:04:14', 0, '0000-00-00 00:00:00', 5, '2013-07-15 22:41:55'),
(34, 34, 4, '', 8, 0, 0, 43, '2013-04-07 09:04:43', 0, '0000-00-00 00:00:00', 5, '2013-07-15 22:41:55'),
(35, 35, 62, '', 9, 1, 0, 43, '2013-04-07 09:04:53', 0, '0000-00-00 00:00:00', 5, '2013-07-15 22:42:04'),
(36, 36, 62, '', 10, 1, 0, 43, '2013-04-07 09:04:06', 5, '2013-07-12 20:34:26', 5, '2013-07-15 22:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `description` text,
  `cover_image` varchar(100) DEFAULT NULL,
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '10',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `publish` int(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category_name`, `description`, `cover_image`, `parent_category_id`, `created_time`, `created_id`, `last_modified_time`, `last_modified_id`, `order`, `status`, `lock_status`, `publish`, `publisher_id`, `publish_time`) VALUES
(58, 'Ủng - Găng tay - Thảm cách điện cao thế', 'Ủng - Găng tay - Thảm cách điện cao thế', '', 0, '2013-04-06 13:04:45', 43, '2013-08-25 16:47:30', 50, 3, 0, 0, 1, 50, '2014-06-24 22:43:13'),
(59, 'Bình cứu hỏa', 'Bình cứu hỏa', '', 0, '2013-04-06 14:04:06', 43, '2013-08-25 16:47:06', 50, 2, 0, 0, 1, 50, '2014-06-24 22:43:13'),
(60, 'Phòng cháy chữa cháy', 'Phòng cháy chữa cháy', '', 0, '2013-04-06 14:04:24', 43, '2013-08-25 16:46:47', 50, 10, 0, 0, 1, 50, '2014-06-24 22:43:13'),
(67, 'Bình chữa cháy', 'Bình chữa cháy', '', 0, '2013-08-25 16:48:13', 50, '2013-08-25 16:48:13', 50, 40, 0, 0, 1, 50, '2014-08-02 16:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_category_attribute`
--

CREATE TABLE IF NOT EXISTS `product_category_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(11) NOT NULL,
  `attribute_name` varchar(200) NOT NULL,
  `attribute_description` text,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '10',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `publish` int(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `product_category_attribute`
--

INSERT INTO `product_category_attribute` (`id`, `product_category_id`, `attribute_name`, `attribute_description`, `created_time`, `created_id`, `last_modified_time`, `last_modified_id`, `order`, `lock_status`, `publish`, `publisher_id`, `publish_time`) VALUES
(1, 58, 'Chiều rộng', 'Chiều rộng', '2013-04-06 13:04:45', 43, '0000-00-00 00:00:00', 0, 2, 1, 1, 5, '2013-07-21 15:37:32'),
(2, 59, 'Container khô', 'Container khô', '2013-04-06 14:04:06', 43, '0000-00-00 00:00:00', 0, 3, 1, 1, 5, '2013-07-21 15:37:32'),
(3, 60, 'Container văn phòng', 'Container văn phòng', '2013-04-06 14:04:24', 43, '0000-00-00 00:00:00', 0, 4, 1, 1, 5, '2013-07-21 15:37:32'),
(4, 61, 'Container chuyên dụng', 'Container chuyên dụng', '2013-04-06 14:04:37', 43, '2013-07-12 20:29:32', 5, 5, 1, 1, 5, '2013-07-21 15:37:32'),
(62, 58, 'Chiều dài', 'Chiều dài', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 1, 1, 5, '2013-07-21 23:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `image_name` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(11) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) NOT NULL,
  `project_brief` text NOT NULL,
  `project_content` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `publish` int(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `view_counter` int(11) NOT NULL DEFAULT '0',
  `project_category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_title`, `project_brief`, `project_content`, `cover_image`, `status`, `publish`, `order`, `lock_status`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`, `view_counter`, `project_category_id`) VALUES
(44, 'Trường mầm non Sao Việt, thành phố Hải Phòng', 'Trường mầm non Sao Việt, thành phố Hải Phòng', '<div>\r\n	Dự án trường mầm non Sao Việt, thành phố Hải Phòng</div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Quy mô: 6 tầng với tổng diện tích sàn xây dựng là 1.100 m2<br />\r\n	Địa điểm: Đường Thư Trung - phường Đằng Lâm - quận Hải An - Hải Phòng<br />\r\n	Công việc do OCDC thực hiện: Tư vấn giám sát thi công xây dựng</font></div>\r\n', 'projectimage_13678511815187c0ad71f35.png', 0, 1, 66, 0, 43, '2013-05-06 21:05:41', 50, '2014-08-01 23:29:44', 50, '2014-08-01 23:29:44', 0, 17),
(40, 'Khu đô thị Bắc Luân', 'Khu đô thị Bắc Luân', '<div>\r\n	Khu đô thị dọc tuyến biên giới sông Bắc Luân, thành phố Móng Cái, tỉnh Quảng Ninh</div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Quy mô: 70.2 ha<br />\r\n	Địa điểm: Phường Hải Hòa - thành phố Móng Cái - tỉnh Quảng Ninh<br />\r\n	Công việc do OCDC thực hiện:<br />\r\n	-Thiết kế quy hoạch tỷ lệ 1/500<br />\r\n	-Tập dự án và thiết kế cơ sở </font></div>\r\n', 'projectimage_13678352195187825309ab9.png', 0, 1, 2, 0, 43, '2013-05-06 10:05:16', 43, '2013-05-06 22:05:12', 50, '2014-06-24 22:35:05', 0, 10),
(41, 'Khu đô thị Trà Cổ', 'Khu đô thị Trà Cổ', '<div>\r\n	Khu đô thị, du lịch, dịch vụ Trà Cổ, thành phố Móng Cái, tỉnh Quảng Ninh</div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Quy mô: 90.88 ha<br />\r\n	Tổng mức đầu tư: 1.288 tỷ VND<br />\r\n	Địa điểm: Phường Trà Cổ - thành phố Móng Cái<br />\r\n	Chủ đầu tư: Công ty cổ phần Xây dựng và Phát triển công nghệ<br />\r\n	Thời gian thực hiện dự án: 2011<br />\r\n	Công việc do OCDC thực hiện:</font></div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">- Tư vấn lập dự án đầu tư và thiết kế cơ sở</font><br />\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">- Tư vấn thiết kế bản vẽ kỹ thuật thi công - Tổng dự toán </font></div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Khu đô thị - du lịch dịch vụ Trà Cổ, thành phố Móng Cái, tỉnh Quảng Ninh được đánh giá có vị trí đắc địa số 1 tại thành phố Móng Cái, rất thuận lợi cho việc giao thương hàng hóa. Với quy mô hơn 90 ha, khu đô thị - du lịch dịch vụ Trà Cổ được quy hoạch phát triển thành một khu dân cư đô thị hiện đại xanh sạch đầu tiên tại thành phố Móng Cái. </font></div>\r\n', 'projectimage_13678352105187824a67417.png', 0, 1, 3, 0, 43, '2013-05-06 10:05:14', 43, '2013-05-06 22:05:00', 50, '2014-06-24 22:35:05', 0, 10),
(42, 'Trung tâm triển lãm quốc tế Móng Cái', 'Trung tâm triển lãm quốc tế Móng Cái', '<div>\r\n	Dự án trung tâm triển lãm quốc tế Móng Cái</div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Quy mô: Tổng diện tích mặt bằng xây dựng là 05 ha. Tổng diện tích sàn xây dựng là 36.000 m3. Chiều cao: 08 tầng<br />\r\n	Tổng diện tích sàn: 36.600 m2<br />\r\n	Địa điểm: Thành phố Móng Cái - tỉnh Quảng Ninh<br />\r\n	Công việc do OCDC thực hiện: Tư vấn lập dự án đầu tư và thiết kế cơ sở</font></div>\r\n', 'projectimage_136783520251878242173c1.png', 0, 1, 44, 0, 43, '2013-05-06 10:05:29', 43, '2013-05-06 21:05:18', 50, '2014-06-24 22:35:05', 0, 10),
(43, 'Tòa nhà văn phòng Matexim Hải Phòng', 'Tòa nhà văn phòng Matexim Hải Phòng', '<div>\r\n	Dự án tòa nhà văn phòng Matexim Hải Phòng</div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Quy mô: 7 tầng với diện tích mặt bằng 578 m2, tổng diện tích sàn xây dựng là 2.549 m2<br />\r\n	Địa điểm: Lô 26BC - Khu đô thị mới ngã năm sân bay Cát Bi - đường Lê Hồng Phong - Hải Phòng<br />\r\n	Mục đích sử dụng: Làm văn phòng làm việc<br />\r\n	Công việc do OCDC thực hiện: Thiết kế bản vẽ kỹ thuật thi công - Tổng dự toán</font></div>\r\n', 'projectimage_1367836379518786dbbbedd.png', 0, 1, 55, 0, 43, '2013-05-06 10:05:17', 43, '2013-05-06 21:05:00', 50, '2014-06-24 22:35:05', 0, 10),
(45, 'Tòa nhà Sao Việt Plaza, thành phố Hải Phòng', 'Tòa nhà Sao Việt Plaza, thành phố Hải Phòng', '<div>\r\n	Dự án tòa nhà Sao Việt Plaza, thành phố Hải Phòng</div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Quy mô: 16 tầng nổi và 02 tầng hầm<br />\r\n	Diện tích mặt bằng: 2.046 m2. Diện tích sàn xây dựng: 22.465 m2. Chiều cao: 58.9 m<br />\r\n	Địa điểm: Số 20 Trần Phú - phường Máy Tơ - quận Ngô Quyền - Hải Phòng<br />\r\n	Mục đích sử dụng: Trung tâm thương mại, văn phòng cho thuê, căn hộ bán và cho thuê </font></div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Công việc do OCDC thực hiện: Tư vấn lập dự án đầu tư và thiết kế cơ sở</font></div>\r\n', 'projectimage_13678513885187c17cd08db.png', 0, 1, 77, 0, 43, '2013-05-06 21:05:08', 50, '2014-08-02 16:14:44', 50, '2014-08-02 16:14:44', 0, 14),
(39, 'Khu đô thị Hồng Vận', 'Khu đô thị Hồng Vận', '<div>\r\n	Khu đô thị Hồng Vận</div>\r\n<div>\r\n	<font color="#7c7c7c" face="Arial" style="font-size:13px;">Quy mô: 27.58 ha<br />\r\n	Tổng mức đầu tư: 130 tỷ VND<br />\r\n	Địa điểm: Đường Hùng Vương – Phường Ka Long – thành phố Móng Cái.<br />\r\n	Chủ đầu tư: Công ty cổ phần Quảng Thái<br />\r\n	Thời gian thực hiện dự án: 2010 - 2013<br />\r\n	Công việc do OCDC thực hiện:<br />\r\n	-Tư vấn quản lý dự án<br />\r\n	-Tư vấn thiết kế catalogue cho dự án </font></div>\r\n', 'projectimage_13678352275187825b2f58f.png', 0, 1, 1, 0, 43, '2013-05-06 10:05:02', 50, '2014-08-02 16:14:55', 50, '2014-08-02 16:14:55', 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE IF NOT EXISTS `project_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `description` text,
  `status` int(1) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `publish` int(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL DEFAULT '0',
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`id`, `category_name`, `description`, `status`, `order`, `publish`, `publisher_id`, `publish_time`, `lock_status`, `parent_category_id`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`) VALUES
(10, 'Dự án', 'Dự án', 1, 54, 1, 50, '2014-06-24 22:42:55', 0, 0, 5, '2013-05-06 10:05:40', 5, '2013-07-07 22:33:33'),
(14, 'Dự án con 1', '', 0, 55, 1, 50, '2014-06-24 22:42:55', 0, 10, 5, '2013-07-25 22:36:42', 5, '2013-07-25 22:36:42'),
(17, 'Dự án con 2', '', 0, 58, 1, 50, '2014-06-24 22:42:55', 0, 10, 5, '2013-07-25 22:40:32', 5, '2013-07-25 22:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_title` varchar(255) NOT NULL,
  `service_brief` text NOT NULL,
  `service_content` text NOT NULL,
  `price` varchar(255) NOT NULL DEFAULT 'Liên hệ',
  `cover_image` varchar(255) NOT NULL,
  `lock_status` int(11) NOT NULL,
  `publish` int(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `featured_service` int(1) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_title`, `service_brief`, `service_content`, `price`, `cover_image`, `lock_status`, `publish`, `order`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`, `featured_service`, `category_id`) VALUES
(45, 'Dịch vụ container', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dol', '<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>\r\n', '3.500.000 VNĐ', 'serviceimage_140403821953afec4b74c78.png', 0, 1, 2, 5, '2013-05-30 11:05:12', 50, '2014-06-29 17:37:00', 50, '2014-06-29 17:37:00', 1, 25),
(44, 'Thủ tục hải quan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor', '<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>\r\n', '4.000.000 VNĐ', 'serviceimage_140403859453afedc2e306b.png', 0, 1, 3, 5, '2013-05-30 11:05:45', 50, '2014-06-29 17:43:15', 50, '2014-06-29 17:43:15', 1, 19),
(46, 'Dịch vụ vận tải', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore', '<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>\r\n', '5.000.000 VNĐ', 'serviceimage_140403808553afebc5c79e8.png', 0, 1, 1, 5, '2013-06-03 16:06:31', 50, '2014-08-02 16:15:34', 50, '2014-08-02 16:15:34', 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `service_category`
--

CREATE TABLE IF NOT EXISTS `service_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `description` text,
  `status` int(1) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `publish` int(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL DEFAULT '0',
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `service_category`
--

INSERT INTO `service_category` (`id`, `category_name`, `description`, `status`, `order`, `publish`, `publisher_id`, `publish_time`, `lock_status`, `parent_category_id`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`) VALUES
(19, 'Thuê xe du lịch', 'Du lịch DreamViettral xin kính chào quý khách.', 0, 1, 1, 5, '2013-07-25 22:22:58', 0, 0, 5, '2013-05-30 10:05:02', 5, '2013-07-25 22:22:58'),
(25, 'Đại lý sơn Expo', 'Đại lý sơn Expo', 0, 5, 1, 50, '2014-07-31 11:25:32', 0, 0, 5, '2013-07-14 10:20:05', 5, '2013-07-14 10:20:05'),
(26, 'service category 3', 'ice category 3', 0, 6, 1, 5, '2013-07-25 22:22:41', 0, 19, 5, '2013-07-25 22:22:41', 5, '2013-07-25 22:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE IF NOT EXISTS `tour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `brief` text NOT NULL,
  `content` text NOT NULL,
  `duration` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `start_location` varchar(255) NOT NULL,
  `tour_path` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `homepage` int(1) NOT NULL DEFAULT '0',
  `publish` int(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `created_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `view_counter` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`id`, `title`, `brief`, `content`, `duration`, `price`, `start_time`, `start_location`, `tour_path`, `cover_image`, `homepage`, `publish`, `order`, `lock_status`, `created_id`, `created_time`, `last_modified_id`, `last_modified_time`, `publisher_id`, `publish_time`, `view_counter`, `category_id`) VALUES
(55, 'Đài Bắc - Đài Trung', 'Đài Bắc - Đài Trung', '<div>\r\n	Đài Bắc - Đài Trung Đài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài TrungĐài Bắc - Đài Trung</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Đài Bắc - Đài Trung', 'tourimage_136955676951a1c721143f7.jpg', 1, 1, 9, 0, 5, '2013-05-26 15:05:09', 5, '2013-05-26 15:05:55', 5, '2013-05-26 15:05:09', 1, 27),
(49, 'Tour Hải Phòng - Lào Cai - Sapa', 'Tour Hải Phòng - Lào Cai - Sapa', '<div>\r\n	Tour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - SapaTour Hải Phòng - Lào Cai - Sapa</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Lào Cai - Sapa - Hải Phòng', 'tourimage_136947596351a08b7b3b723.jpg', 1, 1, 3, 1, 5, '2013-05-25 16:05:23', 0, '0000-00-00 00:00:00', 5, '2013-05-25 16:05:23', 0, 16),
(50, 'Tour Hải Phòng - Ninh Bình - Bái Đính', 'Tour Hải Phòng - Ninh Bình - Bái Đính', '<div>\r\n	Tour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái ĐínhTour Hải Phòng - Ninh Bình - Bái Đính</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Ninh Bình - Bái Đính', 'tourimage_136947600551a08ba5d9d7a.jpg', 1, 1, 4, 0, 5, '2013-05-25 17:05:05', 0, '0000-00-00 00:00:00', 5, '2013-05-25 17:05:05', 0, 21),
(52, 'Quảng Châu', 'Quảng Châu', '<div>\n	Quảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng ChâuQuảng Châu</div>\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Quảng Châu', 'tourimage_136949610651a0da2a17962.jpg', 1, 1, 6, 0, 5, '2013-05-25 22:05:06', 0, '0000-00-00 00:00:00', 5, '2013-05-25 22:05:06', 0, 25),
(53, 'Bangkok', 'Bangkok', '<div>\r\n	BangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangko</div>\r\n<div>\r\n	kBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBangkokBa</div>\r\n<div>\r\n	ngkokBangkokBangkokBangkokBangkok</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Bangkok', 'tourimage_136949616251a0da624a54b.jpg', 1, 1, 7, 0, 5, '2013-05-25 22:05:02', 0, '0000-00-00 00:00:00', 5, '2013-05-25 22:05:02', 0, 28),
(54, 'Disneyland - Shopping', 'Disneyland - Shopping', '<div>\r\n	DisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneyland</div>\r\n<div>\r\n	DisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneyland</div>\r\n<div>\r\n	DisneylandDisneylandDisneylandDisneylandDisneylandDisneylandDisneyland</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - HongKong', 'tourimage_136949624651a0dab6949e9.jpg', 1, 1, 8, 0, 5, '2013-05-25 22:05:26', 0, '0000-00-00 00:00:00', 5, '2013-05-25 22:05:26', 4, 26),
(51, 'Nam Ninh', 'Nam Ninh', '<div>\r\n	Nam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam NinhNam Ninh</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Nam Ninh', 'tourimage_136949594451a0d988af270.jpg', 1, 1, 5, 0, 5, '2013-05-25 22:05:25', 0, '0000-00-00 00:00:00', 5, '2013-05-25 22:05:25', 0, 25),
(48, 'Tour Hải Phòng - Hạ Long - Tuần Châu', 'Tour Hải Phòng - Hạ Long - Tuần Châu', '<div>\r\n	Tour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần ChâuTour Hải Phòng - Hạ Long - Tuần Châu</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Hạ Long - Tuần Châu', 'tourimage_136947586951a08b1d2db42.jpg', 1, 1, 2, 1, 5, '2013-05-25 16:05:49', 0, '0000-00-00 00:00:00', 5, '2013-05-25 16:05:49', 7, 6),
(47, 'Tour Hải Phòng - Cát Bà - Cát Hải', 'Tour Hải Phòng - Cát Bà - Cát Hải', '<div>\r\n	Tour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát HảiTour Hải Phòng - Cát Bà - Cát Hải</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Cát Bà - Cát Hải', 'tourimage_136947579951a08ad7540a4.jpg', 1, 1, 1, 1, 5, '2013-05-25 16:05:39', 0, '0000-00-00 00:00:00', 5, '2013-05-25 16:05:39', 1, 5),
(56, 'Sa Pa trong sương', 'Sa Pa trong sương', '<div>\r\n	Sa Pa trong sương Sa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sươngSa Pa trong sương</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng -Sapa - Hải Phòng', 'tourimage_136962777051a2dc7a78094.jpg', 1, 1, 10, 0, 5, '2013-05-27 11:05:31', 0, '0000-00-00 00:00:00', 5, '2013-05-27 11:05:31', 0, 16),
(57, 'Sapa - Hà Khẩu', 'Sapa - Hà Khẩu', '<div>\r\n	Sapa - Hà Khẩu Sapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà KhẩuSapa - Hà Khẩu</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Sapa - Hà Khẩu', 'tourimage_136962783851a2dcbe9cf2c.jpg', 1, 1, 11, 0, 5, '2013-05-27 11:05:38', 0, '0000-00-00 00:00:00', 5, '2013-05-27 11:05:38', 1, 16),
(58, 'Dịu dàng nét Huế', 'Dịu dàng nét Huế', '<div>\r\n	Dịu dàng nét Huế Dịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét HuếDịu dàng nét Huế</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Hải Phòng', 'Hải Phòng - Huế - Hải Phòng', 'tourimage_136964381151a31b2341bb4.jpg', 1, 1, 12, 0, 5, '2013-05-27 15:05:51', 0, '0000-00-00 00:00:00', 5, '2013-05-27 15:05:51', 0, 17),
(59, 'Thanh Hóa - Huế - Quảng Bình', 'Tour du lịch Thanh Hóa - Huế - Quảng Bình chào đón quý khách', '<div>\r\n	Thanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng BìnhThanh Hóa - Huế - Quảng Bình</div>\r\n', '2 ngày / 3 đêm', '3 triệu', 'Thứ Hai hàng tuần', 'Thanh Hóa', 'Thanh Hóa - Huế - Quảng Bình', 'tourimage_136964458851a31e2cdb32f.jpg', 1, 1, 13, 0, 5, '2013-05-27 15:05:48', 5, '2013-05-27 22:05:18', 5, '2013-05-27 15:05:48', 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tour_category`
--

CREATE TABLE IF NOT EXISTS `tour_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `description` text,
  `publish` int(1) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order` int(11) NOT NULL DEFAULT '0',
  `lock_status` int(1) NOT NULL DEFAULT '0',
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tour_category`
--

INSERT INTO `tour_category` (`id`, `category_name`, `description`, `publish`, `publisher_id`, `publish_time`, `order`, `lock_status`, `parent_category_id`, `created`, `created_by`) VALUES
(2, 'Du lịch nước ngoài', 'Giới thiệu các tour Du lịch nước ngoài', 1, 0, '2013-05-21 00:00:00', 55, 0, 0, '0000-00-00 00:00:00', 42),
(3, 'Xuất phát từ Hải Phòng', 'Giới thiệu các tour Xuất phát từ Hải Phòng', 1, 0, '2013-05-21 00:00:00', 4, 0, 1, '0000-00-00 00:00:00', 5),
(4, 'Xuất phát từ Thanh Hóa', 'Giới thiệu các tour Xuất phát từ Thanh Hóa', 1, 0, '2013-05-21 00:00:00', 3, 0, 1, '2013-05-06 22:05:00', 43),
(5, 'Du lịch Cát Bà', 'Giới thiệu các tour Du lịch Cát Bà', 1, 0, '2013-05-21 00:00:00', 2, 0, 3, '2013-05-06 22:05:10', 43),
(6, 'Du lịch Hạ Long', 'Giới thiệu các tour Du lịch Hạ Long', 1, 0, '2013-05-21 00:00:00', 1, 0, 3, '2013-05-12 09:05:39', 5),
(1, 'Du lịch trong nước', 'Giới thiệu các tour Du lịch trong nước', 1, 0, '0000-00-00 00:00:00', 16, 0, 0, '2013-05-24 22:05:47', 5),
(25, 'Du lịch Trung Quốc', 'Giới thiệu các tour Du lịch Trung Quốc', 1, 0, '0000-00-00 00:00:00', 112, 0, 2, '2013-05-25 22:05:47', 5),
(16, 'Du lịch Sapa', 'Giới thiệu các tour Du lịch Sapa', 1, 0, '0000-00-00 00:00:00', 8, 0, 3, '2013-05-24 11:05:29', 5),
(17, 'Du lịch Huế', 'Giới thiệu các tour Du lịch Huế', 1, 0, '0000-00-00 00:00:00', 9, 0, 4, '2013-05-24 11:05:05', 5),
(26, 'Du lịch Hồng Kông', 'Giới thiệu các tour Du lịch Hồng Kông', 1, 0, '0000-00-00 00:00:00', 113, 0, 2, '2013-05-25 22:05:23', 5),
(27, 'Du lịch Đài Loan', 'Giới thiệu các tour Du lịch Đài Loan', 1, 0, '0000-00-00 00:00:00', 114, 0, 2, '2013-05-25 22:05:39', 5),
(21, 'Du lịch Ninh Bình', 'Giới thiệu các tour Du lịch Ninh Bình', 1, 0, '0000-00-00 00:00:00', 13, 0, 3, '2013-05-24 15:05:40', 5),
(28, 'Du lịch Thái Lan', 'Giới thiệu các tour Du lịch Thái Lan', 1, 0, '0000-00-00 00:00:00', 115, 0, 2, '2013-05-25 22:05:03', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `user_avatar` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT '0000-00-00',
  `register_date` datetime DEFAULT NULL,
  `register_ip` varchar(20) DEFAULT NULL,
  `visited_date` datetime DEFAULT NULL,
  `visited_ip` varchar(20) DEFAULT NULL,
  `active_code` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sign` text,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_avatar`, `password`, `email`, `first_name`, `last_name`, `birthday`, `register_date`, `register_ip`, `visited_date`, `visited_ip`, `active_code`, `status`, `sign`, `group_id`) VALUES
(5, 'tungpd', 'useravatar_13646579885157074429093.JPG', 'e8b21c2ac9ca7c8f081dffb273f473f6', 'tungpd@telnet.com.vn', 'Tung', 'Pham Duc', '1985-11-01', '2010-07-01 00:00:00', '127.0.0.1', '2010-07-01 00:00:00', '127.0.0.1', NULL, 1, '<div>\r\n	OCDC</div>\r\n', 2),
(50, 'admin', 'useravatar_1368085709518b54cd964a2.jpg', '0d7f943d633e49fb06fe6c53acabe3c5', 'administrator@ocdc.com.vn', 'Administrator', 'OCDC', '2013-05-09', '2013-05-09 14:05:29', '113.179.16.238', NULL, NULL, NULL, 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'none',
  `avatar` varchar(45) DEFAULT NULL,
  `ranking` varchar(45) DEFAULT NULL,
  `group_acp` tinyint(1) DEFAULT '0',
  `group_default` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT '0',
  `permission` varchar(20) NOT NULL DEFAULT 'limit',
  `status` tinyint(1) DEFAULT '0',
  `order` int(11) DEFAULT '99',
  `parent_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `group_name`, `type`, `avatar`, `ranking`, `group_acp`, `group_default`, `created`, `created_by`, `modified`, `modified_by`, `permission`, `status`, `order`, `parent_group_id`) VALUES
(1, 'Administrators', 'none', '', '', 1, 1, '2013-02-07 00:00:00', 1, '0000-00-00 00:00:00', 0, 'Full Access', 1, 1, 0),
(2, 'Managers', 'none', '', '', 1, 1, '2013-02-07 00:00:00', 1, '2013-03-17 16:03:16', 42, 'Limit Access', 1, 2, 3),
(4, 'Editors', 'none', '', '', 1, 1, '2013-02-07 00:00:00', 1, '2013-03-19 15:03:42', 42, 'Limit Access', 1, 3, 5),
(5, 'Members', 'none', '', '', 1, 1, '2013-02-07 00:00:00', 1, '2013-03-17 16:03:41', 42, 'Limit Access', 1, 4, 0),
(3, 'Content Managers', 'none', NULL, NULL, 1, 1, '2013-03-14 17:03:56', 5, '2013-03-21 15:03:39', 43, 'Limit Access', 1, 22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_privileges`
--

CREATE TABLE IF NOT EXISTS `user_group_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `privilege_group` (`privilege_id`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=283 ;

--
-- Dumping data for table `user_group_privileges`
--

INSERT INTO `user_group_privileges` (`id`, `privilege_id`, `group_id`, `status`) VALUES
(124, 53, 4, 1),
(137, 52, 3, 1),
(136, 51, 3, 1),
(135, 50, 3, 1),
(134, 49, 3, 1),
(133, 48, 3, 1),
(132, 47, 3, 1),
(131, 60, 4, 1),
(123, 46, 3, 1),
(122, 45, 3, 1),
(128, 57, 4, 1),
(64, 1, 5, 1),
(126, 55, 4, 1),
(129, 58, 4, 1),
(120, 43, 4, 1),
(113, 42, 2, 1),
(112, 41, 2, 1),
(111, 40, 2, 1),
(110, 39, 2, 1),
(97, 7, 2, 1),
(96, 6, 2, 1),
(109, 38, 2, 1),
(130, 59, 4, 1),
(121, 44, 4, 1),
(108, 37, 2, 1),
(107, 36, 2, 1),
(106, 17, 2, 1),
(95, 5, 2, 1),
(116, 4, 2, 1),
(105, 15, 2, 1),
(104, 14, 2, 1),
(103, 13, 2, 1),
(102, 12, 2, 1),
(101, 11, 2, 1),
(93, 3, 2, 1),
(88, 16, 2, 1),
(100, 10, 2, 1),
(99, 9, 2, 1),
(98, 8, 2, 1),
(70, 19, 5, 1),
(69, 18, 5, 1),
(92, 2, 2, 1),
(125, 54, 4, 1),
(127, 56, 4, 1),
(138, 62, 4, 1),
(139, 61, 3, 1),
(140, 63, 3, 1),
(141, 64, 4, 1),
(142, 65, 4, 1),
(143, 66, 4, 1),
(144, 67, 4, 1),
(145, 68, 4, 1),
(146, 69, 4, 1),
(147, 70, 4, 1),
(148, 71, 4, 1),
(149, 72, 3, 1),
(150, 73, 4, 1),
(151, 74, 4, 1),
(152, 75, 4, 1),
(153, 76, 4, 1),
(154, 77, 4, 1),
(155, 78, 4, 1),
(156, 79, 4, 1),
(157, 80, 4, 1),
(158, 81, 3, 1),
(159, 82, 3, 1),
(160, 83, 3, 1),
(161, 84, 4, 1),
(162, 85, 4, 1),
(163, 86, 4, 1),
(164, 87, 4, 1),
(165, 88, 4, 1),
(166, 89, 4, 1),
(167, 90, 4, 1),
(168, 91, 4, 1),
(169, 92, 3, 1),
(170, 93, 3, 1),
(171, 94, 4, 1),
(172, 95, 4, 1),
(173, 96, 4, 1),
(174, 97, 4, 1),
(175, 98, 4, 1),
(176, 99, 4, 1),
(177, 100, 4, 1),
(178, 101, 4, 1),
(179, 102, 3, 1),
(180, 103, 3, 1),
(181, 104, 4, 1),
(182, 105, 4, 1),
(183, 106, 4, 1),
(184, 107, 4, 1),
(185, 108, 4, 1),
(186, 109, 4, 1),
(187, 110, 4, 1),
(188, 111, 4, 1),
(189, 112, 3, 1),
(190, 113, 3, 1),
(191, 114, 4, 1),
(192, 115, 4, 1),
(193, 116, 4, 1),
(194, 117, 4, 1),
(195, 118, 4, 1),
(196, 119, 4, 1),
(197, 120, 4, 1),
(198, 121, 3, 1),
(199, 122, 4, 1),
(200, 123, 4, 1),
(201, 124, 4, 1),
(202, 125, 4, 1),
(203, 126, 4, 1),
(204, 127, 3, 1),
(205, 128, 3, 1),
(206, 129, 3, 1),
(207, 130, 3, 1),
(208, 131, 3, 1),
(209, 132, 3, 1),
(210, 133, 5, 1),
(211, 134, 5, 1),
(212, 135, 5, 1),
(213, 136, 4, 1),
(214, 137, 4, 1),
(215, 138, 4, 1),
(216, 139, 4, 1),
(217, 140, 4, 1),
(218, 141, 4, 1),
(219, 142, 4, 1),
(220, 143, 4, 1),
(221, 144, 3, 1),
(222, 145, 3, 1),
(223, 146, 3, 1),
(224, 147, 4, 1),
(225, 148, 4, 1),
(226, 149, 4, 1),
(227, 150, 4, 1),
(228, 151, 4, 1),
(229, 152, 4, 1),
(230, 153, 4, 1),
(231, 154, 4, 1),
(232, 155, 3, 1),
(233, 156, 3, 1),
(234, 157, 3, 1),
(235, 158, 3, 1),
(236, 159, 3, 1),
(237, 160, 3, 1),
(238, 161, 3, 1),
(239, 162, 4, 1),
(240, 163, 4, 1),
(241, 164, 4, 1),
(242, 165, 4, 1),
(243, 166, 4, 1),
(244, 167, 4, 1),
(245, 168, 4, 1),
(246, 170, 4, 1),
(247, 171, 3, 1),
(248, 172, 3, 1),
(249, 173, 4, 1),
(250, 174, 4, 1),
(251, 175, 4, 1),
(252, 176, 4, 1),
(253, 177, 4, 1),
(254, 178, 4, 1),
(255, 179, 4, 1),
(256, 180, 4, 1),
(257, 181, 3, 1),
(258, 182, 3, 1),
(259, 183, 4, 1),
(260, 184, 4, 1),
(261, 185, 4, 1),
(262, 186, 4, 1),
(263, 187, 4, 1),
(264, 188, 4, 1),
(265, 189, 4, 1),
(266, 190, 4, 1),
(267, 191, 3, 1),
(268, 192, 3, 1),
(269, 193, 3, 1),
(270, 194, 3, 1),
(271, 195, 3, 1),
(272, 196, 3, 1),
(273, 197, 4, 1),
(274, 198, 4, 1),
(275, 199, 4, 1),
(276, 200, 4, 1),
(277, 201, 4, 1),
(278, 202, 4, 1),
(279, 203, 4, 1),
(280, 204, 4, 1),
(281, 205, 3, 1),
(282, 206, 3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
