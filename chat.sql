-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2025 at 06:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blocked_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `user_id`, `blocked_user_id`, `created_at`, `updated_at`) VALUES
(2, 5, 1, '2024-09-08 04:30:32', '2024-09-08 04:30:32'),
(3, 1, 5, '2024-09-08 04:47:22', '2024-09-08 04:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Happy', '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(2, 'Sad', '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(3, 'Angry', '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(4, 'Love', '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(5, 'Beautiful', '2024-08-18 01:52:58', '2024-08-18 01:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Itaque cum vitae ea aut consequuntur ut. Sed dicta exercitationem porro impedit. Minus et voluptas et commodi illum ex.', 17, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(2, 'Eligendi fuga laborum illo nihil. Dolor ipsam aspernatur qui vel beatae pariatur. Corporis officia nobis magni ut maiores nemo. Excepturi nam a totam quos. Magni eos amet ratione cupiditate magni quas numquam.', 7, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(3, 'Accusantium sed id beatae nulla et eveniet. Sit illo minus praesentium corporis. Voluptatem voluptates repellat voluptate iusto. Autem dicta dolor culpa dolorum.', 17, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(4, 'Officia sunt quia amet vel nesciunt animi ipsam. Est excepturi et reiciendis possimus ut impedit sunt. Ullam iste officia et cumque cumque debitis maiores.', 11, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(5, 'Reprehenderit magni perspiciatis ea libero. Rerum exercitationem iste voluptatem repudiandae fuga deserunt. Consequuntur voluptatibus ut nemo.', 5, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(6, 'Nulla asperiores et velit. Qui et necessitatibus et voluptatem a ut sit. Possimus cumque sapiente porro ducimus. Unde est at neque veniam voluptatem quia.', 15, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(7, 'Dolor recusandae quae dolores reiciendis impedit recusandae occaecati. Corrupti maiores cumque maiores molestiae.', 9, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(8, 'Ut est voluptate consequuntur suscipit delectus. Corporis sed qui fugiat occaecati. Minus eligendi eveniet necessitatibus voluptas.', 3, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(9, 'Quos ipsam culpa quidem. Vel sit sit libero neque est molestiae quas. Rerum magnam laborum id dolores harum natus deserunt.', 1, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(10, 'Commodi non porro similique iusto quaerat. Enim est facilis itaque culpa quas voluptatum libero. Error sint consequatur suscipit.', 18, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(11, 'Eos ratione iste et consequatur dolore nobis. Illo aut commodi illum mollitia tempora maxime aut. Nisi a qui sunt deserunt.', 20, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(12, 'In incidunt sed non ullam laborum corrupti quis. Ab magnam ut cum atque nobis praesentium. Assumenda doloribus animi nulla velit velit ut molestiae.', 14, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(13, 'Quibusdam sunt commodi aliquid non veritatis ducimus. Placeat et sed perferendis facilis sint. Ut aut facilis et rerum perspiciatis. Est dolor qui quos temporibus facilis voluptatem voluptatum.', 15, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(14, 'Omnis modi natus quia recusandae. Fugit dolorem amet excepturi blanditiis omnis laudantium magni. Dolore consectetur nihil dolorum suscipit inventore. Aut quia iste non nostrum qui et.', 10, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(15, 'Eius dolorem ut mollitia nisi. Cumque in non expedita est non est repellat. Magnam ex occaecati ut excepturi tenetur cumque quia. Numquam voluptatum sed exercitationem voluptatum autem voluptate ipsum omnis. Ipsa earum quia atque quae earum porro nulla.', 10, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(16, 'Doloribus accusantium earum porro occaecati nisi rerum odio. Cumque et possimus doloribus hic explicabo iste. Ullam voluptates dolor et rem dignissimos.', 5, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(17, 'Qui qui deleniti voluptates aut. In facere voluptatem fugit. Tempora eos quasi facere voluptatum.', 19, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(18, 'Accusamus expedita molestiae qui qui sint mollitia. Sunt ea qui occaecati tempora vitae et consectetur. Consectetur suscipit eum officiis.', 18, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(19, 'Aut ex quae dicta omnis nulla ipsum dolor. Cum inventore maxime fugiat beatae ut quo rem. Incidunt enim consequuntur exercitationem voluptas praesentium. Quo porro laudantium tempore tempora tempore inventore harum.', 8, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(20, 'Qui tenetur voluptatibus quos dignissimos pariatur est itaque qui. Ullam natus cupiditate aut excepturi hic ut quia qui. Recusandae odit enim quidem maiores nemo. Inventore reprehenderit rem omnis corrupti omnis.', 5, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(21, 'Reprehenderit soluta et veritatis quo mollitia. Molestiae ea ut natus voluptatem consequatur et. Quasi est qui fuga eos nesciunt nobis qui esse. Porro fuga commodi necessitatibus dolorem.', 4, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(22, 'Corrupti ducimus doloremque unde exercitationem. Doloremque sunt nobis et optio error nostrum reprehenderit. Maiores voluptatem et omnis nostrum cupiditate. Natus qui ex voluptas est.', 14, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(23, 'Dicta unde aperiam est et ut. Qui soluta quis eius. Sit quaerat sit fugit quo velit. Aliquid voluptatum quo eos et omnis voluptates fugiat.', 4, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(24, 'Aliquam non molestias ratione cum harum. Porro culpa qui ducimus officia quas. Reiciendis quisquam illum iste reiciendis est rerum explicabo qui.', 20, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(25, 'Delectus dolorem labore enim nihil sunt ut facilis. Nobis quia consequuntur quia occaecati vero unde. Ad quos rerum quas laboriosam.', 14, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(26, 'Non et quos nostrum et temporibus fugiat voluptas molestias. Magni hic eum exercitationem placeat velit facere. Sit numquam recusandae iure quos iste accusamus.', 16, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(27, 'Est quibusdam odio aliquid deleniti esse. Incidunt autem accusantium fugiat. Distinctio esse magnam maxime facilis qui. Eum sapiente ipsa perferendis.', 4, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(28, 'Sunt fugit laudantium id asperiores. Eos in consequuntur non sequi. Dicta ratione expedita aliquid in reprehenderit.', 12, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(29, 'Aut placeat nam dolores. Temporibus numquam distinctio exercitationem omnis aut saepe. Libero ut autem incidunt laudantium. Ut quae tenetur debitis quisquam magnam labore ullam.', 7, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(30, 'Iure minus ut eum. Ipsum molestias est deserunt. Sit harum aut velit. Fuga voluptas aliquam quam enim culpa maiores.', 1, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(31, 'Sint ipsa possimus quia voluptatibus molestias aperiam eum ut. Voluptates eveniet quasi animi vel odit aut. Consequuntur ratione veniam perspiciatis esse. Qui fuga sunt nobis molestiae quia est.', 19, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(32, 'Debitis ducimus corporis quod cumque. Fugiat laborum qui autem consectetur voluptas. Eum est cum assumenda et.', 8, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(33, 'Qui ipsum iusto adipisci asperiores accusantium molestiae. Velit illo blanditiis omnis tempore expedita. Quasi minus odit quaerat.', 3, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(34, 'Sunt earum velit voluptate et voluptatem doloribus. Consectetur quasi voluptates dolor rem quas est. Et perspiciatis quis veniam ab et.', 3, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(35, 'Excepturi aspernatur exercitationem saepe aut. Libero et aut vitae accusantium eos blanditiis. Magni non eaque doloribus optio ut occaecati est. Maiores et reiciendis ipsa soluta quod sed quia.', 11, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(36, 'Consequuntur maiores rem quisquam iusto et repellat mollitia voluptatem. Nam voluptatem quod mollitia.', 20, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(37, 'Labore molestiae totam qui laboriosam voluptate. Fugit aut at alias sed distinctio aliquid. Non quibusdam delectus ullam ipsum accusamus occaecati libero saepe.', 8, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(38, 'Quae laudantium minus sit aut. Rerum repellendus sunt voluptatem dolor dolor. Soluta ea voluptatibus in non. Ab numquam laborum voluptas hic laboriosam quo vitae.', 17, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(39, 'Repellat deleniti dignissimos dolor enim assumenda doloremque. Sit aspernatur reiciendis id asperiores omnis qui. Suscipit voluptas qui repudiandae ut et fugiat nam. Sed impedit cumque est debitis qui et.', 11, 1, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(40, 'Molestias sit quae alias. Quaerat et eos suscipit dolorem est ea. Ut optio adipisci animi eum. Voluptas ex non est aut illum.', 8, 2, '2024-08-18 01:52:58', '2024-08-18 01:52:58'),
(42, 'somin', 21, 3, '2024-08-18 06:39:15', '2024-08-18 06:39:15'),
(43, 'ssssssssssshhhhhhhhhhh', 28, 3, '2024-08-18 09:45:09', '2024-08-18 09:45:09'),
(44, 'ssssss', 75, 3, '2024-08-21 07:39:26', '2024-08-21 07:39:26'),
(45, 'sss', 67, 2, '2024-08-21 08:32:28', '2024-08-21 08:32:28'),
(46, 'aaa', 77, 3, '2024-08-21 09:34:27', '2024-08-21 09:34:27'),
(47, 'hok ako', 77, 3, '2024-08-21 09:38:53', '2024-08-21 09:38:53'),
(48, 'AAAAAAAAAAAAAAAAAAAAAAAAAAA', 77, 3, '2024-08-22 04:14:02', '2024-08-22 04:14:02'),
(49, 'ASAksisufdfuhdfugfij', 79, 1, '2024-08-26 11:03:45', '2024-08-26 11:03:45'),
(50, 'ssss', 85, 3, '2024-08-26 11:55:55', '2024-08-26 11:55:55'),
(51, 'Comment', 88, 12, '2024-08-27 01:54:26', '2024-08-27 01:54:26'),
(52, 'hi', 88, 12, '2024-08-27 02:12:10', '2024-08-27 02:12:10'),
(53, 'lee', 89, 3, '2024-08-28 01:23:41', '2024-08-28 01:23:41'),
(54, 'bar ko lee lae', 89, 1, '2024-08-28 01:26:30', '2024-08-28 01:26:30'),
(55, 'br lar', 91, 1, '2024-09-05 06:50:43', '2024-09-05 06:50:43'),
(56, 'ဆရာကြီးလားမင်းက', 91, 3, '2024-09-05 06:52:12', '2024-09-05 06:52:12'),
(57, 'ma hok', 91, 1, '2024-09-05 06:56:43', '2024-09-05 06:56:43'),
(58, 'hgh', 91, 3, '2024-09-06 23:37:36', '2024-09-06 23:37:36'),
(59, 'ကြိုက်ကြလား ဘော်ဒါတို့', 94, 17, '2025-06-11 08:25:21', '2025-06-11 08:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `followed_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `followed_id`, `created_at`, `updated_at`) VALUES
(8, 12, 2, NULL, NULL),
(9, 3, 12, NULL, NULL),
(10, 1, 12, NULL, NULL),
(11, 5, 1, NULL, NULL),
(12, 1, 3, NULL, NULL),
(15, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_path`, `file_type`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(116, 'photos/fUASBOs7uCQRTmzeAYlLvr74NafFkDmFUmed1K7L.jpg', 'photo', 93, 3, '2024-12-05 07:22:16', '2024-12-05 07:22:16'),
(117, 'photos/pr6amWmKMdHhntGtetEYCq8JiNC8PqlpKJO4MT8d.jpg', 'photo', 94, 17, '2025-06-11 08:24:55', '2025-06-11 08:24:55'),
(118, 'photos/hvmWiuxMzhtLlwMw0mWZEIo3a2jsqXAnzlKRNk3R.jpg', 'photo', 94, 17, '2025-06-11 08:24:55', '2025-06-11 08:24:55'),
(119, 'photos/QU6AVoFqwSL2CMEvUw3bLz43YZWzlMmrC0MOOtnp.jpg', 'photo', 94, 17, '2025-06-11 08:24:55', '2025-06-11 08:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`, `read_at`) VALUES
(2, 3, 1, 'Hi', '2024-08-29 09:23:46', '2024-09-08 04:19:26', '2024-09-08 04:19:26'),
(4, 1, 3, 'LEE LAR', '2024-08-29 09:45:41', '2024-09-07 00:53:31', '2024-09-07 00:53:31'),
(5, 5, 6, 'hi', '2024-08-29 09:52:22', '2024-08-29 09:52:22', NULL),
(6, 5, 3, 'TharGyi LEE LAR', '2024-08-29 10:43:13', '2024-08-29 10:43:13', NULL),
(7, 3, 6, 'a', '2024-08-29 10:45:31', '2024-08-29 10:45:31', NULL),
(8, 3, 5, 'AA', '2024-08-29 10:50:44', '2024-09-08 03:46:40', '2024-09-08 03:46:40'),
(9, 5, 3, 'LEE PAL', '2024-08-30 10:44:12', '2024-08-30 10:44:12', NULL),
(10, 3, 5, 'AA', '2024-08-30 10:44:32', '2024-09-08 03:46:40', '2024-09-08 03:46:40'),
(12, 3, 12, 'Hi', '2024-09-03 02:46:44', '2024-09-03 02:46:44', NULL),
(13, 3, 1, 'ဘာလုပ်နေလဲ', '2024-09-05 06:47:30', '2024-09-08 04:19:26', '2024-09-08 04:19:26'),
(14, 1, 3, 'bar maa ma lpoe buu', '2024-09-05 06:47:54', '2024-09-07 00:53:31', '2024-09-07 00:53:31'),
(15, 3, 1, 'Hehe', '2024-09-07 00:19:03', '2024-09-08 04:19:26', '2024-09-08 04:19:26'),
(16, 9, 3, 'Hi', '2024-09-07 00:34:58', '2024-09-07 01:05:04', '2024-09-07 01:05:04'),
(17, 9, 3, 'hi', '2024-09-07 00:35:26', '2024-09-07 01:05:04', '2024-09-07 01:05:04'),
(18, 3, 9, 'AA', '2024-09-07 01:05:08', '2024-09-07 01:17:49', '2024-09-07 01:17:49'),
(19, 9, 3, 'Hey', '2024-09-07 01:17:57', '2024-12-05 07:31:23', '2024-12-05 07:31:23'),
(20, 9, 3, 'Bar Lope', '2024-09-07 01:18:05', '2024-12-05 07:31:23', '2024-12-05 07:31:23'),
(21, 9, 3, 'Hi', '2024-09-07 01:35:02', '2024-12-05 07:31:23', '2024-12-05 07:31:23'),
(22, 1, 5, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2024-09-08 04:12:36', '2024-09-08 04:30:27', '2024-09-08 04:30:27'),
(23, 1, 5, 'Hi', '2024-09-08 04:30:59', '2024-09-08 04:31:12', '2024-09-08 04:31:12'),
(24, 5, 1, 'cccc', '2024-09-08 04:46:23', '2024-09-08 04:47:09', '2024-09-08 04:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_16_085012_create_posts_table', 1),
(6, '2024_08_17_163552_create_file_details_table', 1),
(7, '2024_08_17_164028_create_categories_table', 1),
(8, '2024_08_17_164219_create_comments_table', 1),
(9, '2024_08_18_142745_create_media_table', 2),
(10, '2024_08_18_163250_create_media_table', 3),
(11, '2024_08_21_133226_add_new_fields_users', 4),
(12, '2024_08_25_163017_create_follows_table', 5),
(13, '2024_08_28_152059_create_messages_table', 6),
(14, '2024_09_06_123647_add_is_admin_to_users_table', 7),
(15, '2024_09_07_053607_add_banned_to_users_table', 8),
(16, '2024_09_07_065057_add_read_at_to_messages_table', 9),
(17, '2024_09_08_105250_create_blocks_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('alice@gmail.com', '$2y$10$7NOExBLu3sDrhYLwA/.XmucUDluBJ6T4c2jmFLBf2Qi6Fk2pt6Ogq', '2024-08-18 06:06:50'),
('yewinthat20001@gmail.com', '$2y$10$n9JSlAT0ZlNKXCqogbu5eOnjcNeNgQQ1WH9uvfIlFejoExlXblLw2', '2024-09-08 06:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `user_id` int(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `body`, `user_id`, `created_at`, `updated_at`) VALUES
(93, 1, 'fggf', 'dghyt', 3, '2024-12-05 07:22:16', '2024-12-05 07:22:16'),
(94, 2, 'hehehe', 'AAAAAAAAAAAAAAAA', 17, '2025-06-11 08:24:54', '2025-06-11 08:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `banned`) VALUES
(1, 'Aliceggg', 'alice@gmail.com', '2024-08-18 01:52:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hg07osDcVEO3w4zxVFW9af6V3myfKbbv0FmoSARqcFicfJO8uL0BpR0CkCWZ', '2024-08-18 01:52:58', '2024-09-08 03:44:54', '1725632062.jpg', 0, 0),
(2, 'Bob', 'bob@gmail.com', '2024-08-18 01:52:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aeEv05rVpYBMgdXFmCDnCK6DxRfeMlVC9WR5PByTojSvJvtt0lOOMKeqANOF', '2024-08-18 01:52:58', '2024-09-08 03:31:04', '1724250332.jpg', 0, 0),
(3, 'AyeMinNaing1', 'waim20214@gmail.com', NULL, '$2y$10$nPFe1DiorPj0YKTIQ7wFTu7.BcwTTOEsWxQrnj4UgNnbOoH/04YsW', 'ta1dNXgxcSqiHqaCMRfr28G2jbwMIYaXyXXwXl5ZXzkf2BDFhbaEyX7XnJtm', '2024-08-18 06:38:03', '2024-09-09 06:06:13', '1725885373.jpg', 1, 0),
(5, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'waim20216@gmail.com', NULL, '$2y$10$tEb8VKvz4zM0XC288KfNT.CjnBebJMBm.QyR6k0Z/1iRTt2IsB9DC', NULL, '2024-08-26 12:04:17', '2024-09-08 03:26:40', '1724698952.png', 1, 0),
(6, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'admin1@gmail.com', NULL, '$2y$10$MydeZzBdGw7FtbIIAyZix.jygGd0Y8G1vSSQB4fHttGUA3MQ8jL5u', NULL, '2024-08-26 12:11:42', '2024-08-26 12:11:42', '1724698952.png', 0, 0),
(7, 'Khant min wai123', 'admin3@gmail.com', NULL, '$2y$10$mKTJaQoSjAZxtkzeYNprDexKs7eJ3gslYqgjIRjpR4qDFZv98PdW.', NULL, '2024-08-26 12:14:26', '2024-08-26 12:14:26', NULL, 0, 0),
(8, 'Wai Min Khant123', 'pyaephyomg1@gmail.com', NULL, '$2y$10$dhMkWXsWotvXBM6QOioFJOhDIMhcl.Gxojd6SkTYxPr5JfjHSLzvO', NULL, '2024-08-26 12:15:52', '2024-08-26 12:15:52', NULL, 0, 0),
(9, 'SSSSSSSS', 'aliceong@gmail.com', NULL, '$2y$10$EdqozVOw63k125e.0Sl5p.4E9zWFlBrbJU5HY6Bn6sNuEaK8Wjlg.', NULL, '2024-08-26 12:19:51', '2024-08-26 12:19:51', NULL, 0, 0),
(10, 'gg gg', 'waim20219@gmail.com', NULL, '$2y$10$N9KmDvQ1KBE/dh9j4ZpT8eC6F4xTzU/Zr.F6cF36oTVSoE9tDgnCy', NULL, '2024-08-26 12:25:18', '2024-08-26 12:25:18', NULL, 0, 0),
(11, 'Khant min wai', 'admin44@gmail.com', NULL, '$2y$10$R3BOqcyz5mq3T5HYfKVRWufOwdhiNqy5H9LNR.8D9GPt052RFmdQu', NULL, '2024-08-26 12:26:12', '2024-08-26 12:26:12', NULL, 0, 0),
(12, 'adminqw', 'adkmin@gmail.com', NULL, '$2y$10$vd1SN3QENy9PYzJVAC71TekrbIvUUSmBmR.2Yb6Edh.WLGkntbr8S', NULL, '2024-08-26 12:31:27', '2024-08-26 12:32:32', '1724698952.png', 0, 0),
(13, 'adminA', 'pyaephyomg9@gmail.com', NULL, '$2y$10$W7ndzGDBqVPdJDzLCTkj3O.gav73463qhIhggxEyBrglcoqiVPWQG', NULL, '2024-08-26 12:42:36', '2024-08-26 12:42:47', '1724699567.jpg', 0, 0),
(14, 'Khant min wai', 'yewinthat20001@gmail.com', NULL, '$2y$10$UnD/rG5ATE1DjJbAnMEH8.7HnRIqeIF4eABZxXLp/lVatiUyfT5qW', NULL, '2024-09-08 06:31:48', '2024-09-08 06:32:15', '1725800535.jpg', 0, 0),
(15, 'waiminkhant12345', 'waim20222@gmail.com', NULL, '$2y$10$pkGYXdUhF0so7bnh1.WWEexEglw8GNDQWdOSWTWeML9tA3FgbGyJW', NULL, '2025-01-26 06:40:54', '2025-01-26 06:41:36', '1737897096.jfif', 0, 0),
(16, 'Hein', 'waim2021356@gmail.com', NULL, '$2y$10$LHRH4p.llZ9pvI5Apv3p8.JjHbFdVMXT9yrgI2ccp3BaRHKJJEVmG', NULL, '2025-05-30 22:57:41', '2025-05-30 22:58:02', '1748669282.jfif', 0, 0),
(17, 'palmar', 'waim202131@gmail.com', NULL, '$2y$10$pk50MMJGs5PZ7CD0O/IlV.G.jJIIySRxAAOnX.e.gePyDFLi/NNOC', NULL, '2025-06-09 07:40:30', '2025-06-09 07:41:06', '1749478266.jfif', 0, 0),
(18, 'Myat', 'myat@gmail.com', NULL, '$2y$10$T8w4A5NzP.7tD4xN.SmW..dU4Jg7GhkmjiakmGpx3wiucYpfv2MDK', NULL, '2025-06-09 07:55:24', '2025-06-09 07:56:27', '1749479187.jpg', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blocks_user_id_blocked_user_id_unique` (`user_id`,`blocked_user_id`),
  ADD KEY `blocks_blocked_user_id_foreign` (`blocked_user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `follows_follower_id_followed_id_unique` (`follower_id`,`followed_id`),
  ADD KEY `follows_followed_id_foreign` (`followed_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_blocked_user_id_foreign` FOREIGN KEY (`blocked_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_followed_id_foreign` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
