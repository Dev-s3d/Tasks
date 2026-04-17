-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 18 أبريل 2026 الساعة 00:12
-- إصدار الخادم: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tasks`
--

-- --------------------------------------------------------

--
-- بنية الجدول `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','done') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `status`, `created_at`) VALUES
(12, 2, 'test', 'test', 'pending', '2026-04-16 10:32:51'),
(13, 1, 'Finish PHP Project', 'Complete the OOP structure and database integration', 'pending', '2026-04-16 12:04:13'),
(14, 1, 'Read a Book', 'Read at least 30 pages from a productivity book', 'done', '2026-04-16 12:04:13'),
(15, 1, 'Workout', 'Go to the gym for 1 hour', 'pending', '2026-04-16 12:04:13'),
(16, 1, 'Buy Groceries', 'Milk, eggs, bread, and fruits', 'done', '2026-04-16 12:04:13'),
(17, 1, 'Study JavaScript', 'Learn about DOM manipulation and events', 'pending', '2026-04-16 12:04:13'),
(18, 1, 'Meeting with Team', 'Discuss project progress and next steps', 'pending', '2026-04-16 12:04:13'),
(19, 1, 'Clean Workspace', 'Organize desk and remove unnecessary items', 'done', '2026-04-16 12:04:13');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Dev.s3d', 's@hotmail.com', '$2y$10$50xzBDiTLac5h5Q8EcX5AOjkG5o6G8pIYkMd07Dp87XodfXDCVpJK', '2026-04-13 14:03:40'),
(2, 'Nora', 'test@hotmail.com', '$2y$10$50xzBDiTLac5h5Q8EcX5AOjkG5o6G8pIYkMd07Dp87XodfXDCVpJK', '2026-04-15 14:09:06'),
(3, 'sara', 'sara@hotmail.com11', '$2y$10$50xzBDiTLac5h5Q8EcX5AOjkG5o6G8pIYkMd07Dp87XodfXDCVpJK', '2026-04-15 14:32:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
