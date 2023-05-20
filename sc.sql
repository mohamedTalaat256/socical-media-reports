-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 09:44 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sc`
--

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` bigint(20) NOT NULL,
  `title` varchar(220) NOT NULL,
  `post_id` int(11) NOT NULL,
  `related_to_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `attachments` text NOT NULL,
  `send_status` int(11) NOT NULL,
  `recive_status` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `title`, `post_id`, `related_to_id`, `content`, `attachments`, `send_status`, `recive_status`, `status`, `created_at`, `updated_at`) VALUES
(12, 'wrong flight', 18, 3, 'mohamed\r\n\r\nldskfslkdfsfd sdlkfsdlkfnsdf sd fls dklf sd fs ldkf sld flksd flsd fkls dflk sdfkl', '1647724212midomiod.jpg', 1, 0, 0, '2022-03-19 17:10:12', '2022-03-21 22:25:54'),
(13, 'bad service', 19, 5, 'asdsadfasdf', '1647724364demo3.jpg|1647724364demo4.jpg', 1, 0, 2, '2022-03-19 17:12:44', '2022-05-03 06:10:18'),
(14, 'soso soso post', 19, 1, 'hello', '164789136112.png', 1, 0, 0, '2022-03-21 15:36:01', '2022-03-21 22:18:42'),
(15, 'uouo', 18, 1, 'jjjjj', '16480009396f6794e6b53042f2c9433fb9a30f3588.jpg', 1, 0, 2, '2022-03-22 22:02:19', '2022-05-03 06:48:46'),
(16, 'hiiiiiiiiiii', 19, 1, 'xxxxxxxxxxxxxxxxxxxxx', '16483273162.png', 1, 0, 1, '2022-03-26 16:41:56', '2022-05-03 06:09:17'),
(17, 'wer', 1124, 1, 'wertwertwert', '', 1, 0, 2, '2022-05-03 10:17:59', '2022-05-03 17:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `sender_is_admin` int(11) NOT NULL,
  `complain_id` int(11) NOT NULL,
  `related_to_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `send_status` int(11) NOT NULL,
  `recieve_status` int(11) NOT NULL,
  `seen_status` int(11) NOT NULL,
  `is_updated_to_seen_on_sender` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_is_admin`, `complain_id`, `related_to_id`, `body`, `send_status`, `recieve_status`, `seen_status`, `is_updated_to_seen_on_sender`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 1, 'hello', 1, 0, 1, 1, '2022-03-22 00:12:26', '2022-03-21 22:12:41'),
(2, 1, 14, 1, 'ok', 1, 0, 1, 1, '2022-03-22 00:13:27', '2022-03-21 22:13:29'),
(3, 0, 14, 1, 'to ok', 1, 0, 1, 1, '2022-03-22 00:13:41', '2022-03-21 22:13:43'),
(4, 1, 14, 1, 'how are you', 1, 0, 1, 1, '2022-03-22 00:13:57', '2022-03-21 22:13:59'),
(5, 0, 14, 1, 'i\'am fine', 1, 0, 1, 1, '2022-03-22 00:14:11', '2022-03-21 22:14:12'),
(6, 1, 14, 1, 'i wish to be fine always', 1, 0, 1, 1, '2022-03-22 00:14:41', '2022-03-21 22:14:43'),
(7, 0, 14, 1, 'i\'am good', 1, 0, 1, 1, '2022-03-22 00:15:08', '2022-03-21 22:15:10'),
(8, 0, 14, 1, 'what about you?', 1, 0, 1, 1, '2022-03-22 00:15:16', '2022-03-21 22:15:18'),
(9, 1, 14, 1, 'good', 1, 0, 1, 1, '2022-03-22 00:15:32', '2022-03-21 22:15:33'),
(10, 0, 14, 1, 'thank god', 1, 0, 1, 1, '2022-03-22 00:15:51', '2022-03-21 22:15:53'),
(11, 0, 14, 1, 'what are you doing', 1, 0, 1, 1, '2022-03-22 00:17:48', '2022-03-21 22:17:48'),
(12, 1, 14, 1, 'i\'am reading', 1, 0, 1, 1, '2022-03-22 00:18:04', '2022-03-21 22:18:05'),
(13, 0, 14, 1, 'read what?', 1, 0, 1, 1, '2022-03-22 00:18:19', '2022-03-21 22:18:20'),
(14, 1, 14, 1, 'an interesting book', 1, 0, 1, 1, '2022-03-22 00:18:41', '2022-03-21 22:18:43'),
(16, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 00:24:47', '2022-03-21 22:24:48'),
(17, 0, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 00:24:53', '2022-03-21 22:24:54'),
(18, 0, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 00:25:38', '2022-03-21 22:25:39'),
(19, 0, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 00:25:49', '2022-03-22 21:41:04'),
(20, 0, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 00:25:54', '2022-03-22 21:41:04'),
(21, 1, 13, 5, 'hi', 1, 0, 0, 0, '2022-03-22 23:38:04', '2022-03-22 23:38:04'),
(22, 1, 12, 3, 'hello', 1, 0, 1, 1, '2022-03-22 23:40:43', '2022-03-22 21:41:05'),
(23, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:41:24', '2022-03-22 21:42:32'),
(24, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:42:15', '2022-03-22 21:42:32'),
(25, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:42:39', '2022-03-22 21:42:40'),
(26, 1, 12, 3, 'ss', 1, 0, 1, 1, '2022-03-22 23:44:07', '2022-03-22 21:44:26'),
(27, 0, 12, 3, 'si', 1, 0, 1, 1, '2022-03-22 23:44:38', '2022-03-22 21:44:40'),
(28, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:45:01', '2022-03-22 21:47:53'),
(29, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:48:05', '2022-03-22 21:48:07'),
(30, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:48:18', '2022-03-22 21:49:22'),
(31, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:49:16', '2022-03-22 21:49:22'),
(32, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:49:28', '2022-03-22 21:49:30'),
(33, 1, 12, 3, 'lolo', 1, 0, 1, 1, '2022-03-22 23:49:38', '2022-03-22 21:49:39'),
(34, 1, 12, 3, 'okokok', 1, 0, 1, 1, '2022-03-22 23:49:56', '2022-03-22 21:49:58'),
(35, 1, 12, 3, 'lolo', 1, 0, 1, 1, '2022-03-22 23:50:17', '2022-03-22 21:50:19'),
(36, 1, 12, 3, 'hi', 1, 0, 1, 1, '2022-03-22 23:51:26', '2022-03-22 21:51:28'),
(37, 1, 12, 3, 'p', 1, 0, 1, 1, '2022-03-22 23:51:45', '2022-03-22 21:51:54'),
(38, 1, 12, 3, 'lolo', 1, 0, 1, 1, '2022-03-22 23:52:09', '2022-03-22 21:52:11'),
(39, 1, 12, 3, 'lolo', 1, 0, 1, 1, '2022-03-22 23:52:20', '2022-03-22 21:52:24'),
(40, 1, 14, 1, 'hi', 1, 0, 1, 1, '2022-03-22 23:54:13', '2022-03-22 21:54:19'),
(41, 0, 15, 1, 'hi', 1, 0, 1, 1, '2022-03-23 00:02:39', '2022-03-22 22:02:45'),
(42, 1, 15, 1, 'how are you', 1, 0, 1, 1, '2022-03-23 00:03:07', '2022-03-22 22:08:05'),
(43, 0, 15, 1, 'iam fine', 1, 0, 1, 1, '2022-03-23 00:03:20', '2022-03-22 22:03:21'),
(44, 0, 14, 1, 'hi', 1, 0, 1, 1, '2022-03-23 00:11:58', '2022-03-22 22:12:30'),
(45, 0, 14, 1, 'lo', 1, 0, 1, 1, '2022-03-23 00:12:19', '2022-03-22 22:12:30'),
(46, 0, 14, 1, 'lo', 1, 0, 1, 1, '2022-03-23 00:12:59', '2022-03-22 22:13:00'),
(47, 0, 14, 1, 'lo', 1, 0, 1, 1, '2022-03-23 00:13:39', '2022-03-22 22:13:40'),
(48, 1, 12, 3, 'mi', 1, 0, 0, 0, '2022-03-23 00:14:16', '2022-03-23 00:14:16'),
(49, 0, 15, 1, 'ff', 1, 0, 1, 1, '2022-03-23 00:14:34', '2022-03-22 22:15:08'),
(50, 0, 15, 1, 'sf', 1, 0, 1, 1, '2022-03-23 00:14:50', '2022-03-22 22:15:08'),
(51, 1, 15, 1, 'dfg', 1, 0, 1, 1, '2022-03-26 17:15:10', '2022-03-26 15:15:12'),
(52, 1, 15, 1, 'f', 1, 0, 1, 1, '2022-03-26 17:18:35', '2022-03-26 15:18:37'),
(53, 1, 15, 1, 'ppp', 1, 0, 1, 1, '2022-03-26 17:23:14', '2022-03-26 15:23:46'),
(54, 0, 15, 1, 'hh', 1, 0, 1, 1, '2022-03-26 17:23:51', '2022-03-26 15:23:53'),
(55, 0, 14, 1, 'gg', 1, 0, 1, 1, '2022-03-26 17:24:01', '2022-03-26 15:37:03'),
(56, 1, 15, 1, 'fgh', 1, 0, 1, 1, '2022-03-26 17:24:26', '2022-03-26 15:42:01'),
(57, 1, 15, 1, 'jjj', 1, 0, 1, 1, '2022-03-26 17:29:34', '2022-03-26 15:42:01'),
(58, 1, 14, 1, 'gg', 1, 0, 1, 1, '2022-03-26 17:30:49', '2022-03-26 15:37:04'),
(59, 0, 14, 1, 'wer', 1, 0, 1, 1, '2022-03-26 19:05:19', '2022-03-26 17:06:00'),
(60, 1, 14, 1, 'ok', 1, 0, 1, 1, '2022-03-26 19:06:06', '2022-03-26 17:06:07'),
(61, 0, 14, 1, 'sdf', 1, 0, 1, 1, '2022-03-26 19:06:18', '2022-03-26 17:06:19'),
(62, 0, 14, 1, 'look', 1, 0, 1, 1, '2022-03-26 20:23:51', '2022-03-26 18:24:01'),
(63, 1, 14, 1, 'hi', 1, 0, 1, 1, '2022-03-26 20:24:22', '2022-03-26 18:24:23'),
(64, 1, 13, 5, 'Hi', 1, 0, 0, 0, '2022-03-26 20:32:00', '2022-03-26 20:32:00'),
(65, 0, 16, 1, 'Hi', 1, 0, 1, 1, '2022-03-26 20:33:53', '2022-03-26 18:33:59'),
(66, 1, 16, 1, 'اهلا', 1, 0, 1, 1, '2022-03-26 20:34:16', '2022-03-26 18:34:19'),
(67, 0, 16, 1, 'اخبارك؟', 1, 0, 1, 1, '2022-03-26 20:34:30', '2022-03-26 18:34:32'),
(68, 1, 16, 1, 'تمام', 1, 0, 1, 1, '2022-03-26 20:34:39', '2022-03-26 18:34:41'),
(69, 1, 16, 1, 'ko', 1, 0, 1, 1, '2022-04-05 23:15:01', '2022-04-05 21:15:02'),
(70, 0, 16, 1, 'lllllllllp', 1, 0, 1, 1, '2022-04-05 23:15:08', '2022-04-05 21:15:10'),
(71, 1, 17, 1, 'hi', 1, 0, 0, 0, '2022-05-03 12:20:48', '2022-05-03 12:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2022_02_21_200557_create_posts_table', 1),
(4, '2022_02_21_214535_create_sources_table', 2),
(5, '2022_02_26_205349_create_relateds_table', 3),
(6, '2014_01_07_073615_create_tagged_table', 4),
(7, '2014_01_07_073615_create_tags_table', 4),
(8, '2016_06_29_073615_create_tag_groups_table', 4),
(9, '2016_06_29_073615_update_tags_table', 4),
(10, '2020_03_13_083515_add_description_to_tags_table', 4),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `email`, `password`, `phone`, `image`, `organization_id`, `created_at`, `updated_at`) VALUES
(1, 'egybt_air', 'egybt_air@gmail.com', '$2y$10$dh0.P7336haPx.L5ig/sNeA9B8zrWAUpcLrGiUS7LYw.7Km/erVAu', '01235487954', '1647915591download.png', 3, '2022-03-17 00:10:56', '2022-03-22 00:19:51'),
(2, 'Tesla', 'tesla@gmail.com', '$2y$10$7d9wLpu9wN.Fk1YHq0O41uctcJU1u0B5auvkgphHKI40aCmciyWqG', '012200245545', '1647907953download.png', 1, '2022-03-16 23:29:24', '2022-03-21 22:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenshots` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_to` text CHARACTER SET utf8mb4 NOT NULL,
  `user` int(11) NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `complain_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `link`, `source`, `type`, `creator_name`, `creator_image`, `creator_link`, `short_desc`, `long_desc`, `images`, `screenshots`, `keyword`, `related_to`, `user`, `status`, `complain_status`, `created_at`, `updated_at`) VALUES
(7, '2022-07-11', 'https://www.facebook.com/795015290/posts/10165977525060291/?d=n', 1, '1', 'احمد الجيوچي', '164893884703078CEA-D754-4477-8C49-BA5815F2D81C.jpeg', '', 'تعليق ايجابي للمصر للطيران وبعض التعليقات', '', '1648938847B990F8B4-79C0-4CD0-A8D2-BEE0CB4BF245.jpeg', '164893884744A7FB78-6F66-4424-ADB1-DA194F4354F8.jpeg', 'مصرللطيران', 'Cabin Crew,Catering Services', 5, 'Positive', 1, '2022-04-02 22:34:07', '2022-04-02 22:34:07'),
(9, '2022-07-11', 'https://www.facebook.com/100024524799057/posts/1192051458289003/?d=n', 1, '1', 'Shahira barakat', '', '', 'تعليق ييضمن تلميحات للبيع مصر للطيران', '', '', '1648939741E30D462D-CEDC-4C31-9839-8837E52FBFFC.jpeg', 'مصر للطيران', '', 5, 'N/A', 1, '2022-04-02 22:49:01', '2022-04-02 22:49:01'),
(12, '2022-07-11', 'https://www.facebook.com/889110289/posts/10166073577415290/?d=n', 1, '1', 'Ramy Armanious', '', '', 'تعليق سياسي للمصر للطيران', '', '', '16489406635257CA04-4D97-4667-AB9E-3A6B0E26B07A.jpeg|1648940663D636DF61-08A4-4A8F-9B21-C9F083935255.jpeg', 'مصر للطيران', '', 5, 'N/A', 1, '2022-04-02 23:04:23', '2022-04-02 23:04:23'),
(13, '2022-07-11', 'https://twitter.com/emaarw/status/1508010450444824578?s=24&t=3jaNUVy-7ohbKkUdjma0GQ', 2, '1', 'راجي وخلاص', '', '', 'تعليق سياسي للمصر للطيران', '', '', '164894099047E9E361-35D5-41B0-92D1-08568305AE93.jpeg', 'مصر للطيران', '', 5, 'N/A', 1, '2022-04-02 23:09:50', '2022-04-02 23:09:50'),
(14, '2022-07-11', 'https://twitter.com/i4harold/status/1508012224518008835?s=24&t=DsdilA35XVUSCpHQEqsyKQ', 2, '1', 'Harold deeming', '', '', 'تعليق ايجابي للمصر للطيران', '', '', '1648941269CCD760D6-F36E-472C-B927-193E48112537.jpeg', 'مصرللطيران', '', 5, 'Positive', 1, '2022-04-02 23:14:29', '2022-04-02 23:14:29'),
(15, '2022-07-11', 'https://twitter.com/goudaphotograph/status/1508054688922587139?s=24&t=xi-yG7byWNZJjC5LFuoUeA', 2, '1', '', '', '', 'شكوي علي غلاء اسعار تذاكر مصر للطيران', '', '', '16489416875236C156-A11E-41F5-97EA-E43DEF6EBDC0.jpeg', 'مصر للطيران', 'Tickets', 5, 'Negative', 1, '2022-04-02 23:21:27', '2022-04-02 23:21:27'),
(16, '2022-07-11', 'https://twitter.com/mhmdabw68838972/status/1508069026123157508?s=24&t=K3QnuWsukQhORxJXDHBrdw', 2, '1', '', '', '', 'تعليق سلبيي للمصر للطيران', '', '', '16489419377D297492-D221-45EE-BB06-ED4E8C044E90.jpeg', 'مصرللطيران', '', 5, 'Negative', 1, '2022-04-02 23:25:37', '2022-04-02 23:25:37'),
(17, '2022-07-11', 'https://twitter.com/alzahranifr/status/1508067970588852233?s=24&t=2o4mT4KljZIypujwkblx9w', 2, '1', '', '', '', 'شكوي لعدم الرد علي الايميلات', '', '', '164894538962FFF149-ADE0-48E3-AB08-8754186E0FD6.jpeg', 'Egyptair', 'Call Center', 5, 'Negative', 1, '2022-04-03 00:23:09', '2022-04-03 00:23:09'),
(18, '2022-07-12', 'https://twitter.com/anshumansureka/status/1508354525953941506?s=24&t=2IVFg4f16tEoVuPlnbCJhQ', 2, '1', '', '', '', 'شكوي للمصر للطيران خدمه سيئه في المطار', '', '', '1648945732DF8349C9-A1D2-4F5F-9915-7712253A8BCC.jpeg', 'Egyptair', 'Station', 5, 'Negative', 1, '2022-04-03 00:28:52', '2022-04-03 00:28:52'),
(19, '2022-07-12', 'https://www.facebook.com/100003225663220/posts/5195141467269991/?d=n', 1, '1', 'فيصل سلطان الشريف', '', '', 'شكوي عامه للمصر للطيران والمضيفه والوجبه والطائره ولم يذكر الرحله', '', '', '164894606313521D55-0A93-4099-A414-36DDD5708B76.jpeg', 'مصر للطيران', 'Cabin Crew,Catering Services,Maintenance', 5, 'Negative', 1, '2022-04-03 00:34:23', '2022-04-03 00:34:23'),
(20, '2022-07-12', 'https://twitter.com/gabr7a/status/1508410271043313670?s=24&t=NMMzGCrigbInI0HwgsNK3g', 2, '1', '', '', '', 'سخريه لخدمه العملاء', '', '', '16489464004BBD7870-06B2-44FE-AFA1-85E68F348756.jpeg', 'Egyptair', 'Call center', 5, 'Negative', 1, '2022-04-03 00:40:00', '2022-04-03 00:43:42'),
(21, '2022-07-12', 'https://twitter.com/deniselinden9/status/1508422672467779585?s=24&t=KDShhGKMcIjK-TdEevHrSA', 2, '1', '', '', '', 'شكوي لخدمه العملاء لعدم الرد علي التليفون والايميلات والرسائل', '', '', '1648946889F62CE433-6476-430B-9DAB-600620E9AB78.jpeg', 'Egyptair', 'Call Center', 5, 'Negative', 1, '2022-04-03 00:48:09', '2022-04-03 00:48:09'),
(22, '2022-07-12', 'https://twitter.com/selsaber/status/1508434277788446727?s=24&t=OTfy1HwvcRhq-rBnelY0Ww', 2, '1', '', '', '', 'شكوي لغلاء اسعار التذاكر', '', '', '1648947177DD0B06CB-96C3-43BB-BA73-E787E58D1C90.jpeg', 'مصر للطيران', 'Tickets', 5, 'Negative', 1, '2022-04-03 00:52:57', '2022-04-03 00:52:57'),
(23, '2022-07-12', 'https://twitter.com/deniselinden9/status/1508459910585098244?s=24&t=BEkhti-L2KmLnijS_sJUJw', 2, '1', '', '', '', 'شكوي للcustomer Service', '', '', '1648947597E5654BBB-0DBE-4146-A8A0-839A2DEF31DB.jpeg', 'Egyptair', 'Call Center', 5, 'Negative', 1, '2022-04-03 00:59:57', '2022-04-03 00:59:57'),
(24, '2022-07-13', 'https://twitter.com/ahmad__rashed/status/1508809895054917635?s=24&t=uYWiyWl2u9Jk00mTYisLlQ', 2, '1', '', '', '', 'شكوي لعدم استيراد التذكره', '', '', '1648947925C1B638D8-03FB-4ED0-9D69-0CC67BB182F4.jpeg', '', 'Tickets', 5, 'Negative', 1, '2022-04-03 01:05:25', '2022-04-03 01:05:25'),
(25, '2022-07-13', 'https://twitter.com/3laayousef/status/1508786518810316800?s=24&t=bvNIZXiBGWJD4-yuAHJKHg', 2, '1', '', '', '', 'شكوي لخدمه العملاء', '', '', '1648948077827DB569-C670-43EC-8EE8-907FF4995F1F.jpeg', 'Egyptair', 'WE Care,Call Center', 5, 'Negative', 1, '2022-04-03 01:07:57', '2022-04-03 01:07:57'),
(26, '2022-07-13', 'https://twitter.com/baeabroad/status/1508771251187331076?s=24&t=bApKRILKeHv5hWFNSlUuvw', 2, '1', '', '', '', 'شكوي لخدمه العملاء جنوب افريقيا', '', '', '', '', 'Call Center', 5, 'Negative', 1, '2022-04-03 01:10:16', '2022-04-03 01:10:16'),
(27, '2022-07-13', 'https://twitter.com/mesw93/status/1508819306494238743?s=24&t=mKqwFD4EVTXy3xL0ENW_ww', 2, '1', '', '', '', 'شكوي ان الويب سيت لا يعمل', '', '', '', 'Egyptair', 'Tickets,Call Center', 5, 'Negative', 1, '2022-04-03 01:14:01', '2022-04-03 01:14:01'),
(28, '2022-07-13', 'https://twitter.com/al_chemist1906/status/1508821474446086148?s=24&t=hwnJGkzaznI_HzhtIez3jQ', 2, '1', '', '', '', 'تعليق سلبي علي customer service يشعر بخيبه امل علي كل الخدمات', '', '', '164894879849AF100D-3B54-4278-9FE0-76B4101FCA40.jpeg', '', 'Call Center', 5, 'Negative', 1, '2022-04-03 01:19:58', '2022-04-03 01:19:58'),
(29, '2022-07-14', 'https://twitter.com/nicovince4/status/1509474012937793539?s=24&t=RzMx2DGp1-EX1kFB_bKA7Q', 2, '1', '', '', '', 'شكوي للويب سيت لا يتعرف علي المدن المغادره والوصول بنجامينا وباريس', '', '', '16489550318B514F43-55A1-49BF-92DC-36B1B2EB2251.jpeg', '', '', 5, 'Negative', 1, '2022-04-03 03:03:51', '2022-04-03 03:03:51'),
(30, '2022-07-14', 'https://twitter.com/melomashabane/status/1509466850463293453?s=24&t=RzMx2DGp1-EX1kFB_bKA7Q', 2, '1', '', '', '', 'شكوي للويب سيت وخدمه العملاء', '', '', '16489551780761F960-1744-4CCA-B643-1000A2A524B6.jpeg', '', 'WE Care,Call Center', 5, 'Negative', 1, '2022-04-03 03:06:18', '2022-04-03 03:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `related`
--

CREATE TABLE `related` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `related`
--

INSERT INTO `related` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Maintenance', '2022-02-28 11:16:44', '2022-04-18 16:57:44'),
(2, 'Cabin Crew', '2022-02-28 11:16:53', '2022-02-28 11:16:53'),
(3, 'Tickets', '2022-02-28 11:17:04', '2022-02-28 11:17:04'),
(4, 'Baggage', '2022-02-28 11:18:53', '2022-02-28 11:18:53'),
(5, 'Catering Services', '2022-02-28 11:19:47', '2022-02-28 11:19:47'),
(6, 'Call Center', '2022-02-28 11:20:07', '2022-02-28 11:20:07'),
(7, 'Station', '2022-02-28 11:20:21', '2022-02-28 11:20:21'),
(8, 'WE Care', '2022-03-01 10:23:34', '2022-03-01 10:23:34'),
(9, 'Website', '2022-04-10 01:55:56', '2022-04-10 01:55:56'),
(10, 'Customer Service', '2022-04-10 01:56:29', '2022-04-10 01:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE `sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `name`, `desc`, `image`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', 'Posts, Comments', '<i class=\" fab fa-facebook text-primary icon-2x mr-2\"></i>', '#3445E5', NULL, '2022-02-24 15:02:44'),
(2, 'Twitter', 'Posts, Comments', '<i class=\" fab fa-twitter text-info icon-2x mr-2\"></i>', '#8950FC', NULL, '2022-02-24 15:02:49'),
(3, 'Youtube', 'videos, comments', '<i class=\"  fab fa-youtube text-danger icon-2x mr-2\"></i>', '#F64E60', '2022-02-22 17:43:55', '2022-02-24 15:02:55'),
(4, 'Instagram', 'posts, comments', '<i class=\" fab fa-instagram text-danger icon-2x mr-2\"></i>', '#F64E60', '2022-02-22 17:51:23', '2022-02-24 15:03:02'),
(5, 'Google', 'posts, comments', '<i class=\"  fab fa-google text-primary icon-2x mr-2\"></i>', '#3445E5', '2022-02-22 21:48:15', '2022-02-24 15:03:06'),
(6, 'LinkedIn', 'calls, sms', '<i class=\"  fab fa-linkedin text-success icon-2x mr-5\"></i>', '#1BC5BD', '2022-02-22 21:53:34', '2022-02-24 15:03:12'),
(7, 'Tiktok', 'tiktok', '<i class=\"fab fa-tiktok  text-dark icon-2x mr-2\"></i>', '#000', NULL, NULL),
(8, 'Newspaper', 'Newspaper', ' <i class=\"far fa-newspaper text-dark icon-2x mr-2\"></i> ', '#666666', NULL, NULL),
(9, 'Others', 'Others', '<i class=\" fas fa-globe text-info icon-2x mr-2\"></i>', '#4200BF', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Social Post'),
(2, 'Article'),
(3, 'Ads'),
(4, 'Opinion'),
(5, 'Blog'),
(6, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_permission` int(11) NOT NULL,
  `read_permission` int(11) NOT NULL,
  `edit_permission` int(11) NOT NULL,
  `delete_permission` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `image`, `job`, `add_permission`, `read_permission`, `edit_permission`, `delete_permission`, `progress`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Makram', 'ahmed.makram@egyptair.com', '$2y$10$dh0.P7336haPx.L5ig/sNeA9B8zrWAUpcLrGiUS7LYw.7Km/erVAu', 'Admin', 'AM.jpg', 'Admin', 1, 0, 1, 1, 1, NULL, '2022-04-04 18:02:25'),
(2, 'Ihab Mahmoud', 'ihab@socialmedia.com', '$2y$10$GLyq7sw2h41I/Bz/Bpqoru7Sq7Es0BRIfYO5balpa7K/zkBunGJUK', 'Editor', 'Ihab.jpg', 'Editor', 1, 1, 1, 0, 0, NULL, '2022-04-03 13:00:31'),
(4, 'Merna Khedr', 'merna@socialmedia.com', '$2y$10$odegZAtAcAeqOJqRTTzcfOqg0aJXJx2/h/3uef/HyeYFAuhDzT/jy', 'Editor', '1648933416Merna.jpg', 'Editor', 1, 1, 1, 0, 0, NULL, '2022-04-04 17:53:44'),
(5, 'Ola Onga', 'ola@socialmedia.com', '$2y$10$3ntxFTEAIzAH6jSTZCUfWupMf1d494mdxvZpLD6yXp7IUayV15qx.', 'Editor', '16515716146f6794e6b53042f2c9433fb9a30f3588.jpg', 'Editor', 1, 1, 1, 0, 0, NULL, '2022-05-03 07:53:34'),
(6, 'Hagar Mahmoud', 'hagar@socialmedia.com', '$2y$10$6OYpHggLR7AY5EOXFXGgJOXdHAdFqfDgsGUJv3N/wT/JQG2Fr12ky', 'Editor', '', 'Editor', 1, 1, 1, 0, 0, '2022-04-04 19:47:13', '2022-04-04 17:49:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `related`
--
ALTER TABLE `related`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
