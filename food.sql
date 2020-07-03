-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2020 at 09:11 AM
-- Server version: 10.3.22-MariaDB-1ubuntu1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `days_foods`
--

CREATE TABLE `days_foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days_foods`
--

INSERT INTO `days_foods` (`id`, `date`, `food_id`, `created_at`, `updated_at`) VALUES
(36, '2020-07-02 19:30:00', 18, '2020-07-02 10:49:59', '2020-07-02 10:49:59'),
(37, '2020-07-02 19:30:00', 19, '2020-07-02 10:49:59', '2020-07-02 10:49:59'),
(38, '2020-07-02 19:30:00', 20, '2020-07-02 10:50:00', '2020-07-02 10:50:00'),
(39, '2020-07-03 19:30:00', 21, '2020-07-02 10:50:10', '2020-07-02 10:50:10'),
(40, '2020-07-03 19:30:00', 22, '2020-07-02 10:50:10', '2020-07-02 10:50:10'),
(41, '2020-07-03 19:30:00', 23, '2020-07-02 10:50:10', '2020-07-02 10:50:10'),
(45, '2020-07-04 19:30:00', 23, '2020-07-03 04:48:52', '2020-07-03 04:48:52'),
(46, '2020-07-04 19:30:00', 17, '2020-07-03 04:48:52', '2020-07-03 04:48:52'),
(47, '2020-07-04 19:30:00', 26, '2020-07-03 04:48:52', '2020-07-03 04:48:52'),
(48, '2020-07-04 19:30:00', 22, '2020-07-03 04:49:30', '2020-07-03 04:49:30'),
(49, '2020-07-05 19:30:00', 18, '2020-07-03 05:54:20', '2020-07-03 05:54:20'),
(52, '2020-07-05 19:30:00', 19, '2020-07-03 07:01:43', '2020-07-03 07:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `image`, `description`, `created_at`, `updated_at`) VALUES
(17, 'عدس پلو', 'nuE7N9qoXQExwcGpFyNaWVqgLiXP42A1Ag26y5ab.jpeg', NULL, '2020-07-01 17:11:04', '2020-07-01 17:11:04'),
(18, 'چلو جوجه کباب', 'IXnj2EsfIsCHri64EeKTrPMDVFwkmHPkkYuANELt.jpeg', NULL, '2020-07-01 17:11:24', '2020-07-03 05:54:51'),
(19, 'چلو خورش قیمه', 'db4YerBkpgpL21v1yonYQD6jovddY6qBiEwlcOPM.jpeg', NULL, '2020-07-01 17:11:36', '2020-07-01 17:11:36'),
(20, 'چلو کباب کوبیده', 'NFDQtjGgYpDvdYATc5yZ5onsSSMlmUBDtJyTe2mW.jpeg', NULL, '2020-07-01 17:11:51', '2020-07-01 17:11:51'),
(21, 'خوراک جوجه', 'RLECuqHfU6OBrpgKXJMifh9zau6JWjJOhCnmpUQm.jpeg', NULL, '2020-07-01 17:12:03', '2020-07-01 17:12:03'),
(22, 'خوراک قیمه', 'SiF8bXzhCEJdszqBVPUlGUdtFp4Crg7RW2zXyXnp.jpeg', NULL, '2020-07-01 17:12:15', '2020-07-01 17:12:15'),
(23, 'خوراک کوبیده', 'Qr8Mmd6qwV3H5lUGULh4CjDV1OKOQJTA0kCEbCaj.jpeg', NULL, '2020-07-01 17:12:24', '2020-07-01 17:12:24'),
(24, 'زرشک پلو با مرغ', 'iTEZmQ9v5DJkct5odaW8Rp2PYuZyrapQGA5nUvlY.jpeg', NULL, '2020-07-01 17:12:43', '2020-07-01 17:12:43'),
(25, 'شوید پلو با گوشت', 'aYViaAYTu4q21bFSaysgR04ZHtmo4GauGgN7BxGi.jpeg', NULL, '2020-07-01 17:12:56', '2020-07-01 17:12:56'),
(26, 'غذای رژیمی', 'UgdMEXgJqqVtKQaWjr1kmax7ccvLkxPJbsyGQ4NV.jpeg', NULL, '2020-07-01 17:13:13', '2020-07-01 17:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_06_30_203837_create_foods_table', 1),
(4, '2020_06_30_203845_create_days_foods_table', 1),
(5, '2020_06_30_203855_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `days_food_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `days_food_id`, `created_at`, `updated_at`) VALUES
(1, 106, 36, '2020-07-02 12:40:20', '2020-07-03 04:45:55'),
(10, 1, 36, '2020-07-02 19:33:13', '2020-07-02 19:33:13'),
(11, 1, 41, '2020-07-02 19:33:17', '2020-07-03 08:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `api_token`, `national_code`, `personal_code`, `level`, `created_at`, `updated_at`) VALUES
(1, 'مدیر', 'سیستم', 'admin', '$2y$10$j/LwZw8fQtjI03HIKT4GHum0xXFnEEmISpZbcPFZMJdvzHdTKTQPO', '9EEQRlIIQsJ0kkJywFYKjUa7Rv6omWEIWGPiVYo2QW1LRdR9Aqb4QLVzzrVf', '0000000000', '0000000000', '1', NULL, NULL),
(106, 'محمد رضا', 'زمانی میقان', '60000002', '$2y$10$jsAdQIpxmxn.6ev0syJz0OAl/z5tt2ufAM4osNR30cebgmgEiSZTS', '8JYydtQ3wyGOu4m2aECeCKYdL8sbdwTZqB8VhkMJ3Lo4chHt8eHaH8wONjZU', '4591712265', '60000002', '2', NULL, NULL),
(107, 'محمد', 'رزازان', '60000003', '$2y$10$csJemnIetmYRbs0Y0Qwa3eZrqzCJLqygzeKkt5zyW30bhHDyB13tW', 'qSiHfjrm6f1fpIKHU1ZfMST21a4yKYxTZCGuCy4hb0K7hoYCUt07nRkG7LNB', '4591128237', '60000003', '2', NULL, NULL),
(108, 'منیره', 'رزازان', '60000004', '$2y$10$hbzrOcRQbhuQ3sgm88FlRO6WuLTDjpmIMViQfYTqvIE9UwjetlOGS', 'CboWldNlo26B5o9zqnvZUYOjNyoBKKJgPTlmdebIGnlMi3G98AvbSVVPEqe1', '4591324648', '60000004', '2', NULL, NULL),
(109, 'رضا', 'بیاری', '60000005', '$2y$10$dJT/PwARP4BfZ5kQafzrs.AlNJ2XDiDpEfxlknDidF/Rmckw0R0bi', 'FImvcT3kVR6JoMBDxDw4SVEhbpX9jJTxuFQHhHXfLL4LXWK2cnYuyLmFXINp', '4591287017', '60000005', '2', NULL, NULL),
(110, 'حسن', 'زمانی', '60000006', '$2y$10$Hn0AIzP0Z2MaNHp2GAIqgOgp9v2ieN/3cdzV39R6cS8TIZbl/luo2', 'vJu8db0SsghAqZsVUwMl94AanyohoTNkVxqL7K1vrsBeMBEHfIXFEeTnCfBZ', '4591771059', '60000006', '2', NULL, NULL),
(111, 'زهرا', 'زمانی میقان', '60000008', '$2y$10$3kz6kJtUzj0bjrchi3GrcObRRFF45LMzV.TUaFA9anWTfyuOlXgC2', 'xy6k7PGrHCqPKm7x37EnnUV0LeUCIQ7SB0vUocCjWwjGvt3vi2felj7yWWCu', '4592216121', '60000008', '2', NULL, NULL),
(112, 'محمد کاظم', 'قاضی محسنی', '60000009', '$2y$10$bryJGwwYWmvzx23jUdFZgeF2bBvwqwo4nhX58NcgxpxG7fFUrjgmu', 'lOm2WGsZWjY61lRc9g7nozo9TdG0D14YjwKOKlSUChqgBkktzct5dLQHOHyU', '4889167005', '60000009', '2', NULL, NULL),
(113, 'زهرا', 'سنجری', '60000010', '$2y$10$nUj4m6JGDZzSas/cvBt2bObOOIjbUIlJW20Kknzm3u8cF4SbyMlT2', '3zitNk1QMOwQVNHN0uLOnfyOsHNbvFCuafGrA8yA778ObFiOqC83UKYoK3ch', '4592216210', '60000010', '2', NULL, NULL),
(114, 'هادی', 'خواجه', '60000011', '$2y$10$zYbBbYpymvLvdbnvkIH0q.vgwsYr7.psoqkem.yMIkmq/MdbKxZ5q', 'B9Xh74FvpjdxiJMx48REFZX0iJoVVoxkRCB2LtdvcxVsOBYy4SPPwuUQxf1S', '4889798943', '60000011', '2', NULL, NULL),
(115, 'محسن', 'یوز باشی', '60000012', '$2y$10$Z6CI84Gpn9CZJgapU3mfk.Biq0g2tlMmkEwCyZwERrVoi4Jk0wiOC', 'WFMtjAwEjJfxEphCjq2bE3pN65s67DqySGr9aHdcqb1lHsZmnUyEnYkcymWc', '4591378500', '60000012', '2', NULL, NULL),
(116, 'محمد', 'عرب عامری', '60000013', '$2y$10$D/W1bkpcrAWS7x0dOqi1euLnNOuLFwvZgTVvCzEp5PbPOd.tXmB7G', 'yAk5EFjmDwibhBuDIT022x1wLJ5hx1uHVWRSJe7xh58IyAMER47IiSFpok7q', '4591328211', '60000013', '2', NULL, NULL),
(117, 'محسن', 'رویانی نژاد', '60000014', '$2y$10$fTc0EHOCJQx5I0xMNQOIp.m0mCIp84BdBKI.XTV6k4c8NpCGM.uIm', 'AjsVz6qS8FbJBxseyAnGs4MPbaBOTm00Pgv6s7Z7ZSt8vJ1Mo3LcNf9Jre9l', '4592113977', '60000014', '2', NULL, NULL),
(118, 'ابراهیم', 'عرب محمدی', '60000015', '$2y$10$.26.9FVnUahonf7GsX5TNe/aNdZVFimnZMNaRaxfZhhaPg/Bq2Uhi', 'PrJDH7fLFA2PchxwVrwN29JO1ejohesaInUtt45IBzC7mOe31tcFgp2c99p7', '4591324419', '60000015', '2', NULL, NULL),
(119, 'محمد', 'مهدوی میقان', '60000016', '$2y$10$x4Q/BHHK1C6VF/dQuPj9y.lZ9.Ds0ilg7Epnt3LNLu08a3jaxII66', 'ECcOzmKa86bGAmIdlVEncpO7Aw8dGDqqZDMcT3xf9pI4ANpYv4QTUYQVvftA', '4590450429', '60000016', '2', NULL, NULL),
(120, 'حمید', 'نصرتی', '60000017', '$2y$10$1MXuE8vLt34BSkWorg.H0Ofiw03dWIVv6kGfxNzjEFWuwZsQ6Nl6G', 'wYNu6dsvjXGyKKZ322NtbZOCpJUky63P9AhjKitAuCDKUt9jeP5IQAoeqYNt', '4592114779', '60000017', '2', NULL, NULL),
(121, 'احسان', 'شاه بیکی', '60000018', '$2y$10$yroC9X292nfYD9uzrxAVC.9Bo.JMrdl9rvTpyJmLmxQP3dXQIMzmC', 'o63Emk1eJFFSX7cYSNBsZUqJR0v2NvS3ADDY6PFr39ijZPXdzsGqWJSKzqnz', '4592098765', '60000018', '2', NULL, NULL),
(122, 'نگار', 'حیدری', '60000019', '$2y$10$IIa7QBHE7PuwOIMo8uq3leLr6DI1NJkflc5UUgtimfRIJqQ.IPZfy', 'QAwkxrGQh3pSjpe0iHMDFhoAgLQDVN1XdAJefWiPv18sJMiGkgcqAX3fwcmS', '4580065611', '60000019', '2', NULL, NULL),
(123, 'مژده', 'نیک جو', '60000020', '$2y$10$lTqd0hn8r34AwDygwAAFfOiwMZ.5WlEMPMumV3B5UdxVT18fipfxy', 'EmnJp2u8c0A9uziFC3XU2CJgNINZ8ABPZVIE8Y7Rqd8MsF66mLzONHCjHWe2', '4579938704', '60000020', '2', NULL, NULL),
(124, 'عباس', 'طاهران پور', '60000022', '$2y$10$qhUcaJKfRtV7K5V0xriiwum9K7AF7vy6A0Sdfmae/756j8SEWvzhe', 'Lbp8qw7fTegHOdsAo2NwTTIYSK0tL7vPCvWhc6nrAek7HrwnwLYEHtVhhmii', '4579868854', '60000022', '2', NULL, NULL),
(125, 'مهدی', 'عرب عامری', '60000023', '$2y$10$CxBbRiD6N9eavDNWCTKkjeFYRYxd20IHNplsH/Ub2/bquYFIYyPE2', '8d8Esfq95LOXSFf9u2oD5QQ62zSKeraVWjgvsKolEnBlHua5imoSWOp25U6K', '4592070951', '60000023', '2', NULL, NULL),
(126, 'امیر مهدی', 'شبانی', '60000024', '$2y$10$sh2OZfT.9PzWNhyaluOKD.1seASnEW53tcCo3G/rLo5hgoIK5kgam', '1qD6j9EeRJMBCqB8C8Vmx7jEnam1EilkNLOZY3nVNqRkcUIJb4KZPqXbDAqS', '4592104307', '60000024', '2', NULL, NULL),
(127, 'حسین', 'زمانی', '60000025', '$2y$10$zfDpwpEUjMdJedtwfeLcYeFXaNysFMEPiJ/a39Z4Wa.aeFdNsO5ze', 'bt5WCXZykuAKH5MTJJqSnFoyJ8r0ixzTOIkosPKTyrEAjxOTYlALL2zlIieU', '4591802361', '60000025', '2', NULL, NULL),
(128, 'سجاد', 'واعظیان', '60000026', '$2y$10$NySga/1RnVSQph02cbjOc.vHkS5JeLS8Lk0npKZjx/UyRzS66nUwC', 'De5EwYUElU1ZV3g3jnlXIZ7KXxCx5778Icob92dsHy1q0sxhDp4OZl7XmbgH', '4592171381', '60000026', '2', NULL, NULL),
(129, 'امیر', 'باقری جام خانه', '60000028', '$2y$10$OhxuwjJyJLKfEPUOfMYv/uT3G7.1ZQoE5T6I6b1A1rA/btwF4ErIi', '67lDGINIwJjILBR9gYJmSQuoJx9D1Sz21QCfd6zptGD6FrQMcRYCMD6BuYZM', '4592122763', '60000028', '2', NULL, NULL),
(130, 'علی اصغر', 'غفاری توران', '60000029', '$2y$10$wrwvsH/v4IyCF2E8a9uqUeIqvNeQMq.t4cfZy5xCLxdoEUCZrjUbu', 'd8snt2NRQvBK5e5hfOO6fZui3UgOaeb85ViUEhpVA7pXAH21xJGONOkbBQlx', '4879738026', '60000029', '2', NULL, NULL),
(131, 'سید محمد', 'بیطرف', '60000030', '$2y$10$j6spJ8HmnxBHLH6KIFqnDul4lJ.LJxYXpaZC97Kk4FAdjSs1Hq6L.', 'uSKIK0ewIs0rMbt9SEWec91dqRzJP7BdTKj115LX3tb4bU7LW7CY0oO13X7Y', '4592147332', '60000030', '2', NULL, NULL),
(132, 'مهدی', 'قلی زاده', '60000031', '$2y$10$5nJMiA8vm4W1Li0tLwYNResto1NxX8.O.ASGiOjaSqgkxUp/33QTG', '5Q7RWyBWrY8pLGbmmgQdyZn7FXFREuMn4bQsmE2LSI15N1xNtNirY7flQsFh', '4580009789', '60000031', '2', NULL, NULL),
(133, 'میثم', 'مهاجری', '60000032', '$2y$10$tZzJ4BpPAjaMIRGuyGpQ.OYmWl9g4AteDsQOAtaTYN.SsBNI6XXHO', 'z2qXH6fq3zTqHVvJ98cdC4QRTKdo32r06rncu3B4MkkMflArjafP2z4jR102', '4592229576', '60000032', '2', NULL, NULL),
(134, 'علی', 'نادعلی', '60000033', '$2y$10$HJ3bDoWNiwUTuRyp5YHrC.LOHNtsy1tMWGZRqQw77Tn8/1JMMm1rW', '0rgelQtLMiD9egbtn6JL4BXRsvxnNIUqYa9AmHnPLH9xAhcBFY7nXJQNsz6E', '4869891832', '60000033', '2', NULL, NULL),
(135, 'محمد رضا', 'شاهکوئی', '60000035', '$2y$10$U2rHLKo3aN96MFkzaZPiTO7NKjUoiGXGf4fIQrNl1ErsqHpe0ymMu', 'lp6GzZARXet9fSnV4A6a6iL9eEuxnrWLnoNqpRRAa8TY9iEczAspHoX0FedQ', '4580181832', '60000035', '2', NULL, NULL),
(136, 'محمد مهدی', 'زمانی', '60000037', '$2y$10$zIExaEAJMsw4Zt79tdUGr.9PUZkS007YmLX1HNIIZHOuVhShuWL7m', 'SdynoByTVgcwmevCjM9Tzzt3VN6Vc6u58MQHwT9f0YBdwfV3uRhsr9PCKQH2', '2269482271', '60000037', '2', NULL, NULL),
(137, 'علی', 'کلاته ملائی', '60000038', '$2y$10$CBZbJMe2Fd.CU3zMsYKj7..4Gl60QRymxU4DG4.rhmlmK6tFqJ0i.', 'DLyegmrB7Iz2kpZdL1nSiusIvTJV68zwkK4MzltSmThYUZepovlsMyMxmMDa', '4591358070', '60000038', '2', NULL, NULL),
(138, 'علی اکبر', 'خادمی', '60000039', '$2y$10$b.avArJgA3PEUbOstpLQ7.go8nYS6Dhk6EqXTTYRQaQvHl52UtxF2', 'l45fAtbg3KXOVG6kWDqnupvWLvvIjVMtMHtLnHosp2ua1ilbdZOy4GvOww11', '4580047958', '60000039', '2', NULL, NULL),
(139, 'هادی', 'عرب عامری', '60000040', '$2y$10$kk2Gf2Ghb/2B1urL2QtwBOBWL4XyFq1cpIkinI6/S8rhibV0H7oJG', 'ZhH27uHgHxITud3uWv3xJDNcom4qDRCYgDLCtVaaJd519i6eT8W7qIlsUMoG', '4580181522', '60000040', '2', NULL, NULL),
(140, 'سعید', 'عرب عامری', '60000042', '$2y$10$iiSxXgFggoE93/oS7LU8eukXJbpds1t2TrVKBdjn2qwnnPXXqD6Pu', '1i0Ux9sCLlED7xQJHtUrWWr9JwIjzT6FwJQbErOPcW7qoLJwvsinBzEXAOGN', '4580150562', '60000042', '2', NULL, NULL),
(141, 'غلامرضا', 'یاقوتی', '60000048', '$2y$10$DXj98VBQ6ulHv.lRWtuxVOanCbpD7Uvg9fngr5Fs8NjdKMyKZ/0dC', 'RhmkuJvV28MQ2SKRqRxY1cO5vfXFv3vMl9ejPk4LeganFt47fHE2Zxd8fjzY', '4591171507', '60000048', '2', NULL, NULL),
(142, 'مجید', 'محمد خانی', '60000051', '$2y$10$V38fRc5knCwLBM9U8yag6uh6p5ZflpiA6CDzZWAInZOz1CWJ1MJ8m', 'IEKbdcl5eH5dtShWyTQxxoje6twuL6Wh17p9G0JJmMC4y2sNzuZ9tOr8CYAx', '4591310329', '60000051', '2', NULL, NULL),
(143, 'مینا', 'ابراهیمی', '60000052', '$2y$10$uhojnA.tEJq7wQE49.me9e8jmNzzDU9iwK4vDXB2dET7dbRBisewq', 'eajO64h3TewSwfo6yArPczPWQvVcN1CDvQ6XZRNSuULJ6CGIvnfzkFjLbbdf', '4592157389', '60000052', '2', NULL, NULL),
(144, 'ستاره', 'آقائیان', '60000053', '$2y$10$M2PVry835LofRMNtbpvniuVIItdxbpdF2ew6rzxiHDovXezevK8Fa', '6Qs0PWMLoyShc1aZEoQr1Do1WTmJUcFrR6dRzk7ocCZnbn6LIYpKi6UGY0fu', '4592162390', '60000053', '2', NULL, NULL),
(145, 'رضا', 'ولی زاده', '60000054', '$2y$10$XSmJnY8CYyuNPK5C84caUerbVnYyXvB3ia4bk701DH8y7MD6DaVDS', 'lW1IxluBL8yWrtBtCcRz6V1j2m4bZuBGCvmQnpm9Y16PwG17JljZH7dPWx38', '4580134321', '60000054', '2', NULL, NULL),
(146, 'شهاب', 'مرادی کلارده', '60000055', '$2y$10$qWbrKeJC8VmxnIAeyxA1U.zgPltL3jAJxD18AMHePtkWvs7UAPUa6', 'n98DUwT1IuwA6OLnBVQzSzrUSReNMJs3HQlRlaN5Qmrj9ndZo1v8Y5KvQeQ7', '5170025793', '60000055', '2', NULL, NULL),
(147, 'مجید', 'مویدی', '60000056', '$2y$10$xgRYW9cifiUAUSW557WZC.5r2CJLHjWvTA4FAbSterRXB7i5s4i0W', 'maKBQdvJXkuyZZL0CzK6LRcQOsPW5JtW2ndrHtlTUZs03Svg8SBoxTDbOJKn', '4591335151', '60000056', '2', NULL, NULL),
(148, 'سامان', 'غیاثی', '60000057', '$2y$10$QZLe/MfmFdlIBjh.5Gn5XOfzoBwm5ZYl3MoXVn5FuCW/3EaWvqmmC', '3D5UNXADvYDrR45h1BeTSsGu6LRemYszyNaLtSGTx0yfjLJKIvUTaqrZGc3w', '4580173635', '60000057', '2', NULL, NULL),
(149, 'حمید رضا', 'یزدانی', '60000058', '$2y$10$ipaUN3SvJE8BWgqOnuIjcu.OGHa6QPOsCJSS0lNmIa72rtusBQ/7y', 'DFE2Rlfd6Z2uZIGuX6yrPRYnP4kSIDgSctXatlVWwFSCZKpBw4imJ1M4lwKJ', '2248867042', '60000058', '2', NULL, NULL),
(150, 'مریم', 'معینی', '60000059', '$2y$10$x/BktGoEVZYou.yT2R3TKulx6F4zkQ0qaKAjJ8WoPwLlrPQA1tljy', 'eCu7eRLmkcDjHLDxXgzW6fxabL7kRHe9VXHk4n2UL1SbpKxVzcjiwuzHkPkg', '0082677621', '60000059', '2', NULL, NULL),
(151, 'محمد حسن', 'نصرتی', '60000060', '$2y$10$Qc6SoH4Fw4yEGkex7b1qn.ckt0GP9BuXBBMEgibQdIjcee7nfK7xO', 'izz6zqHHmXNM9IBmuTfMVf7SgtwZqCHN1MS0VfSqYvxj1G32UxuBVVG2zUvG', '4591286185', '60000060', '2', NULL, NULL),
(152, 'محمد رضا', 'جباری', '60000061', '$2y$10$NKBvL1rgVZBa1qyIioHyCuDWLj3kkMhfSK2Xe.1c6ESLckMjtpfhO', 'ERd5H0dBsRq23wp5h0Wg9StOZmTfXynYyHZZ1l8ArlTsTGxRWwqbjcuhgi9b', '4580127404', '60000061', '2', NULL, NULL),
(153, 'محمد', 'بهجت', '60000062', '$2y$10$/vWRtVe7CVsRxr8IuQwBmeXqqXDGG87BNC9IAQKKvj6Fs/PHffosS', 'W7Cgla24CfpVDYG07F80gqKrivjfSPqmPMmE8bmxqR7dQcj8xaLDl6fcJ52C', '0067600093', '60000062', '2', NULL, NULL),
(154, 'محمد', 'شمس', '60000064', '$2y$10$l0izAIhHkeEl.OW1FAMHte/j1OAhAwAMALM8fZuUWFvMx7Jn38Y3u', 'frjzKWBl2wBS3CXhw8bPdz5HnACa0hBZrrGC2lg43Rl9IWi0gMUAPsvOQKJv', '4592072332', '60000064', '2', NULL, NULL),
(155, 'شکوفه', 'محمدی', '60000065', '$2y$10$Y.VI3qb3OwrjZ9X6cHIMYeOWGjaa2flnNNFcKYKdtSjql7HkCWNOK', 'v6PtiGN2CL5ZknCWwpbTzDoETrP3IuuAEW9m71m9OIjWiPwNaxNfObfJYNzs', '4580220420', '60000065', '2', NULL, NULL),
(156, 'حسین', 'بیاری', '60000066', '$2y$10$dY667GiPeBUM/Pp8Q2FHmuCSHdF7XUiQOyo.zpyxka.GQgkxluM9m', '9NuGQyxbxsgjCW5zrXRlbSCurDBQ08YkrBzd3996d741PzplWFt35cwB7G9G', '4592174161', '60000066', '2', NULL, NULL),
(157, 'مسعود', 'دربانیان', '60000067', '$2y$10$WLD4nrdsD8P2.DnS.1cg5.1/n1UaFPjnQomSpsDU.LeElcJy4cN6y', '5kxFsYW9uwtzEXl1qcHJJFXfXSpWNgCbC8kcxF4pBLhd43UqVA2dv9hPT1u6', '4592102231', '60000067', '2', NULL, NULL),
(158, 'امید علی', 'ذوقی', '60000068', '$2y$10$wZKQJEMJSvmheaP.xRjZVOa32gyc8gOk7tYSgyNqqzNqUCkkNxR8C', '7oCsfgBejJqRMGzztuVPbMJOulJzZZpHfzAQRkbxd5ybR7rov6qwNcbFOchc', '4591202801', '60000068', '2', NULL, NULL),
(159, 'محمد علی', 'فلاحتی', '60000069', '$2y$10$pIq.hmGZGSYyS0CxXOLhwu5T1eXVyFmY9KugNNTlaiGRpol6IPw4q', 'vlQBF9rumhoqBsnf0DVROmXRc8sfBLbHApZhxmk7QTSsAMLseJHlZOh5U0Zg', '5209470131', '60000069', '2', NULL, NULL),
(160, 'حسین', 'میقانی', '60000070', '$2y$10$OWWW7FpT68CZhlbwfelrMeJeFb.CwF7buE9gdYuSmsPePEYCQESi.', 'EHq3uYgNS3P0Ox0nhqIV46tJKGAQLGBn4dB5OJN0lzMiZGU3wGvGT9F8cOla', '4592218353', '60000070', '2', NULL, NULL),
(161, 'مصطفی', 'اصغری', '60000071', '$2y$10$yp1ismd3DkE9w4Gp14g/B.TwgGjjcIj7mOg3YSBdHXEN9YC6xY/BG', 'XkJs1lWTu17pfFmUErXgc913vtsGdaPaMO4sBCkdTBo0k4SIa2XQBMDfeeJW', '4592102517', '60000071', '2', NULL, NULL),
(162, 'محسن', 'صدیقی', '60000072', '$2y$10$RUkmWIUofvSPtAtw9HxR4um8gohJMGbb6QiLy2HxWUGSERhkp3n1W', 'xFLb0mXD6XFVX7jZogQinvrkJUMOdcmQd0ljPQu4Pp38Q4TolScAIp9BizC1', '0015547760', '60000072', '2', NULL, NULL),
(163, 'بنیامین', 'عامریان', '60000073', '$2y$10$C/j1v030QCTC25lkezvEQO76vrT.oOGaRC6c1HyZzzz06KrHnJt42', 'lCt4njjst6lQjhzFoUbvHprIChlCk0s6ZskfVvZq2Hx5EEm4RcjpLdF2bPDC', '4580013573', '60000073', '2', NULL, NULL),
(164, 'مهدی', 'نقوی', '60000075', '$2y$10$Ltx.TiRHFEGCanuqKNFvxOfc7JFJwu7lpO68.Ag7cib0nIKZUmYwO', '3KcPLd3u7n9fp4HqqbSllWhWgML9RElPmie6Iq7A9fF4UEaPmZlhMPyVlK4d', '4591298205', '60000075', '2', NULL, NULL),
(165, 'رضا', 'فرزاد نیا', '60000076', '$2y$10$tmOKQHP28/riH74Jqglr8eNqugimfOSqUQxiydfwWccHuKoWJUcVy', 'CKomvpM4WeHQD1WQjI7wlhLxKUOc595zO6qXEizLMW3rpndfkc6tV5dYeaLV', '1740931009', '60000076', '2', NULL, NULL),
(166, 'محسن', 'عرب عامری', '60000077', '$2y$10$cKxAvlJZJCRoM0ajVQZxy.b6DubW5e.UUKdDaDJ9skjtO.L7R4NKi', 'xKPvVqF2W6h7Fzksz9yxkXIIIDGhugeIQ0OYpR6Xpagru4aIOfWH1fXvG5RB', '4591325441', '60000077', '2', NULL, NULL),
(167, 'عباس', 'فضلی', '60000078', '$2y$10$gyJPMRQG8GPnBkX.jH6Qxuuac9/Q4HtbFEPOOwderBbrsRkhDiKEe', '4UIfUAeMmBVIAKtILTrRvGxepXEMftersPSMux1jnPIX5jKK0SgCPRyN95Vx', '5209835995', '60000078', '2', NULL, NULL),
(168, 'محمد', 'نادعلی', '60000079', '$2y$10$aAH5O31kPNpg1emGcBB0vOvk7j7c9KkzN5fsAwrwqTjRN2vTSSgPi', 'pKQ5VSkJ5IreKxIoReeRMvMSRa7KGfEUcxuwuMozcDOYIAXY1mSZzpsYJ8hO', '4592241241', '60000079', '2', NULL, NULL),
(169, 'غلامعلی', 'کاظمی', '60000081', '$2y$10$c/eIVSShbT3r6lZMnkKORuFC.VYADYfA0ouUHRKxRXwyt0oczux3.', 'VRWUk60i8nxftj559GRevIs0VrWYSq4Vsv3n9qKfLZz5JcdX0g9jUWpergiq', '0056345682', '60000081', '2', NULL, NULL),
(170, 'مجید', 'مختاری', '60000082', '$2y$10$vdTjKgLrysSVNc9O9WCRXebrZZcMfeR6en5ovck.RzqPCKTmiq0Ni', 'YcuwfBGqNRXNFcnLKeJtFIdNf8Kvfj3qxKMpEmttuCi2OdNCYfGwkwO0UYxw', '4580088697', '60000082', '2', NULL, NULL),
(171, 'الیاس', 'شامبیاتی', '60000083', '$2y$10$.vvqkZ3espgFVOlgUUUR.OvMCT5D6Mn9wDnHxwEyci3AQPMTY9Z.C', '6isgne7GWUYXozC5NkKEeC0A9O0cKX95BnRCFocEGh0RYBKFvOlvvI2fzIGK', '4592037359', '60000083', '2', NULL, NULL),
(172, 'سید سجاد', 'شکوهی', '60000084', '$2y$10$jrIG08XdzNorreGQSK20LOLVvsJTYDBR4WuKQOjuf/g.5iLtLcsBi', 'ootilk95V1xHyVCQ8VyN6rtSopp9V4ZFI68YyXUe2UZ4LhjFyzKEBMxfy2DS', '2560088355', '60000084', '2', NULL, NULL),
(173, 'عماد', 'محمدی', '60000085', '$2y$10$AeEy/KILtGeI2ne9/0TqNuD27kikM0/wBszJoNkZkktsR3KOfC/iy', 'PSguZJ3EJuk6ULFKmUW0LgLLQ49CJfy90wI82uO20Hk4FQVC7BptCUK9fWsM', '4580058720', '60000085', '2', NULL, NULL),
(174, 'مجتبی', 'علیزاده', '60000086', '$2y$10$8Uj9AzyXi2Wa5FrhF0WDOe5Hvq6pPY4s4aQQje1l5BiIS5C3gpQam', 'A5ruZmPTU3nlKXkc2bGZsVAsD1CMG6kX4Z2lk8tmzcFXFs6zfmvF96KFIeEB', '4580080920', '60000086', '2', NULL, NULL),
(175, 'مهدی', 'خوش آبادی', '60000087', '$2y$10$QmLx3/7JhcGL9.rwFRSxfepCsxzKHG8X6m8I2ppY8PjmcBAyB0O9O', 'UJFJpEX4aI5Tt9NgLBF8tPDzFaSfi9KAmRNHR1y2uxMExg4GGNRGMFOFvIOi', '4592160649', '60000087', '2', NULL, NULL),
(176, 'محسن', 'حاجی زاده', '60000088', '$2y$10$5fVDJ.hLWE6sHsJPrkTid.pNxzjlYJc1Wt/dmsA5/i2MliTEdxr46', 'qMPC1tozCMzI4AM6ownjN5TjTIctDiV4iUIN6B0TQULt2PctVN0bxEG40Tm9', '0750088389', '60000088', '2', NULL, NULL),
(177, 'حسن', 'نکوئی', '60000089', '$2y$10$4/yudGwy2ZodGng3B1TnC.gG3SGKdJ4sFtJcbRz4ZROWKAbEGW5kO', 'O2krWzj6N6tAVLCn8xdcERxNQJL1I9Mz4Y2xQwp7ZKGQ7uMxjvWCUfRqqAjH', '6240004227', '60000089', '2', NULL, NULL),
(178, 'حسن', 'رحیمی', '60000090', '$2y$10$zO2d7PwVCGsQWjGE8YTDvun7F5h79Ow0ihY0oaB1gnKT4EjapjLey', '7eRk9NjKavVR87mMRDSuoYsyDE2bIkTxxclfBpTsm2RtiTKzgzxkuqcFJjuU', '0055997244', '60000090', '2', NULL, NULL),
(179, 'رحمت اله', 'نقوی شاهکوه', '60000092', '$2y$10$FuGnhn44mwkQg5LmwUWN.OjYCsYlBWR1G5E53CyRRGjDmDaaDUJbG', 'XCgN02okD3cR910CtRDZFv2I7yp8ZyoVGM01quR36rQFNZK05Ze7lB3Ym4h0', '4592237595', '60000092', '2', NULL, NULL),
(180, 'مهدی', 'میرغفوریان', '60000130', '$2y$10$HEcDuRqbVA/8VvCddt0Y7ujH/lA.q5AODaDakMVtiv6/0559.YCmi', 'MeoB3Wl18H4IpWmHjtYPwqszScTpLesKpvvO5REmE4DaCv96NlSRHvFwXMNQ', '4580018001', '60000130', '2', NULL, NULL),
(181, 'امین', 'سلیمانی', '60000131', '$2y$10$wnCuE29XpIh7u1zhBRghBOhPfDayT.6dPYaj7Cj1GIq4Ouq7.7CBm', 'UgQdBcgxUdiq3oZKLMKTzvsRaGS75WWbJE02kxzWbKPqc5WF7PTkZOshALjh', '4592168526', '60000131', '2', NULL, NULL),
(182, 'حسین', 'عرب زینلی', '60000132', '$2y$10$j18pKYBu1AYKl17e6jJCwO1R9oFgTpC9lcbJsaxl97li6mx4YyRVa', 'HeUZ25YVVSbjLnW0PDRwPC4XYwGjEXVjw35H9yaHar6Nl2ZXQdhST2Bkgn0p', '4592206436', '60000132', '2', NULL, NULL),
(183, 'روح اله', 'ولی زاده', '60000133', '$2y$10$aZaW7Ttanb5rGNw.EzHp0O2dho5N39kyWdkfIhWiycWY0YlB5zG1u', 'VFlcUGCKq7nAweTS2QqTqQ8dVSXVBHAwJ9o8eZEfpQ7s0aS086Nx4ti7qoz2', '4591358161', '60000133', '2', NULL, NULL),
(184, 'رضا', 'عجمی', '60000136', '$2y$10$59jraf369FmyRnH6oZUtieIzO6.vzePyj3IAQ1Y35hL7DaqAEryNW', 'iETPbhZ4wmhGEA3UmWrsLgRty6GiKCq1vbNG15iYal45En297ZWiQBDhVVIo', '4580161718', '60000136', '2', NULL, NULL),
(185, 'محسن', 'اسمعیلی', '60000137', '$2y$10$9tJdBwlAL.I9PtP4aYXzg.kVSZJ1ZikTXUcrShljUeVuOV91eXFEa', 'N1QzZhToa4N9FdPalWmPMit73AGhpnHh6btD5NQOJBcUeLnWDqqIRaSv6cQ3', '4591370267', '60000137', '2', NULL, NULL),
(186, 'سید هاشم', 'میر علی اکبری', '60000139', '$2y$10$ysAkvcH7wrRTivY4yEcqr.F12xz.2xsR5fYg9NCnnM/zdbdmcUi6q', 'kU4Ujx2hbA8XmevRykJRL6QX6Jceg4eazSgEcxdpLBW9IXDNdKUSnrZbdRPh', '4570061222', '60000139', '2', NULL, NULL),
(187, 'محمد علی', 'قلیان', '60000140', '$2y$10$U9WCeV/r7EBAQrIbo0xgZOK68795r7gRCFdIsfqHz38MU0voOvDWC', 'Ca9milNBRNW1EWVV46DYkX7XII0fYjIxQSwKKZiJ9yt8qQwfHtUdP8XKpqqD', '5200002702', '60000140', '2', NULL, NULL),
(188, 'جواد', 'بذری', '60000141', '$2y$10$jd8o4yJm5Nn2zNp.cihTxuD5HwKoLgVGg5CEIOt68dKpq/.teVzxa', 'UV8CXoaTTbM2r0VA1v7DMzX1S8hOABzn07Vctxpi7eEAP3KcnngXgFfD2xUb', '4592105419', '60000141', '2', NULL, NULL),
(189, 'مهدی', 'محمد مغانی', '60000142', '$2y$10$P9yr32xDFbJubbrr./mvHugMFkXcbangEyy7TQV2SAfom6sIq5kmq', 'CdH17YiJZJagNRG0pbc7ChcloK62SIG1S2ZbLLlOmv7Jzb5NPEbPBGjEkd9d', '4580275782', '60000142', '2', NULL, NULL),
(190, 'مسعود', 'کردی', '60000143', '$2y$10$G/DmJrLgNDGZ39.7GCfRr.Y2XlyO0EK/db5jCgCthjBOIWsoLwxk.', 'ImFTBCjeTbuSVGe56NVi9FQmzcGGEQyCx3Bp4890lHgZ30z4gLsJhGNdbRsc', '4580269993', '60000143', '2', NULL, NULL),
(191, 'میلاد', 'عضدی', '60000144', '$2y$10$LNL.d8QsrUGzg3LJqgTAUeuHpr9DAKMQBIY7Pcf283VrG3MZF1Kou', 'mZB0Jethbwq7csnwjeLx4BZVTlwM8QgCIaKgO3dBhpJhUilo3I0XnyBYnfgo', '0310125693', '60000144', '2', NULL, NULL),
(192, 'داود', 'عباسی', '60000145', '$2y$10$IuBJAZ21un6Phh7vwk7ivuEpC3KIGkRdOFkF5HIFs/yiwfTDyvkRG', 'jr4G0VmcO8i1rOhUIymd7QdT20f9TyFThbizGCXSQnIrMagAalQYZCyGnA0a', '4592142756', '60000145', '2', NULL, NULL),
(193, 'ذبیح ا...', 'فرومدی', '60000146', '$2y$10$dUN1iFDMQi2p7HSmy0HgwujOqZvzbkNpHMUUMeZf4hWb6hNywl4Oy', 'buB0lEUBjum3iwhxFvXlxqKS5jDH0l4NxuwuVmp0OIptGyiuNA1JZ8aeSbSc', '4580105346', '60000146', '2', NULL, NULL),
(194, 'مصطفی', 'تیموری', '60000147', '$2y$10$PnzZPHhM3AaSOXFUZ6N8MuwjdSA/KajzgDHBpSq6A0JRAk288mZYG', 'Hws8suxeDw7rqCSPCyoAOe8d2bukZCshANDCW4FXm9SWCpVePAihlHOURWmM', '2160098426', '60000147', '2', NULL, NULL),
(195, 'پوریا', 'یونس آبادی', '60000148', '$2y$10$Q4Ln/7Wn7Vc8WRW8dIdRLeZ6H87EeLIk2vdyrJA7VIcvxn/Q3nXli', 'WJ2DJhXMoVLcBj61IjE6rBmIP9bB9eaANbTbwjg58CJhqo2JuURQJ5BAAJ2N', '4580236084', '60000148', '2', NULL, NULL),
(196, 'علی', 'اسماعیلی', '60000149', '$2y$10$fWHr6HRcuyHvgUil0Lrj0u80alFayUBZb7phokRJeY4Zm1JEg0Kwu', 'mOqljcje9HKK93szKXaLHR6JuwhrTcbfxcBhkty6xxxE44yCsD3IY0hntnsg', '4580274891', '60000149', '2', NULL, NULL),
(197, 'ابوافضل', 'موسوی', '60000150', '$2y$10$nQtQmmVZmkbh0XzeX0Ti3.onwFwATk6bipJo2RaaCIWlHX8o0FNq.', 'z3XQCpozjTx72FKRnxZnfYzvtld0JvdWHiFaz1oI4uhcL5FoMYtA8CBUm0Aj', '4580030044', '60000150', '2', NULL, NULL),
(198, 'حمزه', 'ملک', '60000151', '$2y$10$i6W4Q82AfR3UiK44dQ4hneG3F1F77sL17P4kbL3N9rD81ZwIN3K/y', 'NwyV6eGWEzoSZ6ZzkKe9zESW6F8cuxzJEahaeBIj7tXqoyaA1jjIP86lb4hd', '2121685421', '60000151', '2', NULL, NULL),
(199, 'محسن', 'قربانعلی', '60000152', '$2y$10$pBmAb2jakj7oszV27ItHa.nvTQQz2bVngQq7J8oyHrRHleFUMF.Gi', 'lZb9zSYLOlcrZH6INtf7ysmdEC2JghbiAimTtt5yTuZvQsZ5qHnxaUt1cW3K', '4580260791', '60000152', '2', NULL, NULL),
(200, 'میلاد', 'عبیری', '60000153', '$2y$10$/V/f80jOrfI5vvGEw.iM/e.IuPKTlW5wAnqV5dVkUf/ma9bj9XUIq', 'UME9CHMOHFWBQ6wCE2LEZphLHbehCM0nfb4WdELxOWgVHP7gcs2ncFRckdPx', '4579898583', '60000153', '2', NULL, NULL),
(201, 'نوید', 'رضایی', '60000154', '$2y$10$A2YmEyeujkiM3Ttnag3ME.BL.YB215xYS4k4bX3bVEkcFeaMgNNJa', 'WLg6846foVIM8jMVoneAmJe5TCHB1nJkaZzQROZAP9VpkMKBcqH0rReQE7Fj', '0670276170', '60000154', '2', NULL, NULL),
(202, 'علیرضا', 'حیدری', '60000163', '$2y$10$ft66kDAQysI./s4fVRYAVutgYyYeBCbgaV48Ze9E4BV5L.5xO.shS', 'javVuAeS8fUb3t5lfXdeBrGVIozTEM7HWfDBnOlE1MnaXIB8g7UCDkJ8YvTp', '4580171276', '60000163', '2', NULL, NULL),
(203, 'جلال', 'نیک جو', '60000164', '$2y$10$oSdVmZBwh5ChsWjgfXFvr.LO2hubTQeJrOdd2qp37VhRu5JyPAqMS', 'WFTHId44xskcqeqM1rkJutVu9SlTTpgwKDsppAiDixYtrzDhWzxV3IRpvp2H', '4570107230', '60000164', '2', NULL, NULL),
(204, 'هادی', 'عامری', '60000165', '$2y$10$7agdW4S7FhN5fiMDpv4ugOtnu9yb2vnj0cl6SZU78m57T5tgObh22', 'pMhUGpsPOagqRCCEc5g1WEHtQJTZQhA9sywkjJRfcImKjx0Bj4zCiAf4WxsM', '5209950654', '60000165', '2', NULL, NULL),
(205, 'محمد', 'محسنی', '60000166', '$2y$10$ceY63KP9EPf.lBf9BOB4h.Gol6u4VNnE4JFd1dX/AXU2jDCO2Hid2', 'qk9PGsjGep50h0qP4hqfBQSCe8rkfAdd7ER0LiNKcYG99Utn0VTWBLGzkHpP', '2110049588', '60000166', '2', NULL, NULL),
(206, 'حسین', 'باباحسینی', '60000167', '$2y$10$E/Ood0lsW0ptYVxHUVxNAOVEPxeXvGvkwJjmaoV4ME.sg3/hNMB4m', 'r7Z02Pgr41gLgttiTQBlifw54fzwBhN21NITjNTqBsosvTJqpXWUlfUi1krf', '4580216342', '60000167', '2', NULL, NULL),
(207, 'علی', 'فاضلی', '60000168', '$2y$10$G8x5TWFMS1oP7wwICjWgVeG0uJaEHGCnsPc29hwWCfox36NiHPfdq', 'ZJhXOBhbfIFj7CSTJ7JdpMA0uUnRBqzMZt91a5PEZoXLa0kMmbWTczWZbIzn', '5200062829', '60000168', '2', NULL, NULL),
(208, 'احمد', 'یوسفی', '60000169', '$2y$10$GK0PklKqeJXjLoO9x9.EOO5olkLugw3TQt1ETAbQese9mHj6TnK5.', 'VMarcV4GyQlLLwV2azl8wgmDdbJYbkcunfKLLSznJ4IEzhdV4Drw4V311F4A', '4592232089', '60000169', '2', NULL, NULL),
(209, 'محمد', 'حقیقت پناه', '60000170', '$2y$10$Nvxx59fp9fXI.WOEGstcLu3MENdrW/RWuXQ9MhuT4W0cWjAFgx372', 'OD53R9WezLpIhZ3gOS6MKv0kQUWRD1voBEuYiIKpwVqtCCEX9XHW8m6BFMm8', '4580035526', '60000170', '2', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `days_foods`
--
ALTER TABLE `days_foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `days_foods_food_id_foreign` (`food_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_days_food_id_foreign` (`days_food_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_personal_code_unique` (`personal_code`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `days_foods`
--
ALTER TABLE `days_foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `days_foods`
--
ALTER TABLE `days_foods`
  ADD CONSTRAINT `days_foods_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_days_food_id_foreign` FOREIGN KEY (`days_food_id`) REFERENCES `days_foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
