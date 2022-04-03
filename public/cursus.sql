-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 07:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lmsdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_setting`
--

CREATE TABLE `admin_setting` (
  `id` int(11) NOT NULL,
  `key_name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `key_name`, `value`) VALUES
(1, 'c_p', 'Copyright Policy<br>'),
(2, 'p_p', 'Privacy Policy<br>'),
(3, 'terms', 'terms'),
(4, 'logo', '/frontend/images/logo.svg'),
(5, 'favicon', '/frontend/images/fav.png'),
(6, 'admin_commission', '3'),
(7, 'currency_code', 'USD'),
(8, 'currency_symbole', '$'),
(9, 'notification', '0'),
(10, 'default_theme', 'night-mode'),
(11, 'instructor_verification', '0'),
(12, 'user_verification', '0'),
(13, 'facebook', 'facebook1'),
(14, 'twitter', 'twitter2'),
(15, 'linkedin', 'linkdin5'),
(16, 'Instagram', 'Instagram'),
(17, 'youtube', 'youtube'),
(18, 'pinterest', 'pinterest'),
(19, 'verification_subscriber', '500'),
(20, 'verification_sell', '100'),
(21, 'paypal', '0'),
(22, 'palypal_client_id', ''),
(23, 'stripe', '0'),
(24, 'stripe_pk', ''),
(25, 'stripe_sk', ''),
(26, 'razorpay', '0'),
(27, 'razoprpay_key', ''),
(28, 'seo_title', 'Online Courses - Anytime, Anywhere Cursus'),
(29, 'seo_description', 'is the world&#39;s largest destination for online courses. Discover an online course and start learning a new skill today.'),
(30, 'seo_meta', 'online,courses,learning,teaching'),
(31, 'seo_twitter_title', 'Online Courses - Anytime, Anywhere'),
(32, 'seo_canonical', 'https://coursearly.com/cursus/public/'),
(33, 'dark_logo', NULL),
(34, 'footer_logo', 'footerlpgo.png'),
(35, 'seo_image', 'seoimage.png'),
(36, 'flutterwave', '0'),
(37, 'flutterwave_key', ''),
(38, 'mollie', '0'),
(39, 'mollie_key', ''),
(40, 'paystack', '0'),
(41, 'paystack_key', ''),
(42, 'license_status', '0'),
(43, 'license_name', ''),
(44, 'license_key', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Photography', 1, '2021-05-18 02:26:36', '2021-06-25 22:27:01'),
(2, 'Marketing', 1, '2021-06-23 23:26:54', '2021-06-23 23:29:59'),
(3, 'Development', 1, '2021-06-23 23:27:30', '2021-06-23 23:27:30'),
(4, 'Business', 1, '2021-06-23 23:28:00', '2021-06-23 23:28:00'),
(5, 'Design', 1, '2021-06-23 23:28:08', '2021-06-23 23:28:08'),
(6, 'Music', 1, '2021-06-23 23:28:29', '2021-06-23 23:28:29'),
(7, 'IT & Software', 1, '2021-06-23 23:28:58', '2021-06-23 23:28:58'),
(8, 'Finance & Accounting', 1, '2021-06-25 22:23:15', '2021-06-25 22:23:15'),
(9, 'Office Productivity', 1, '2021-06-25 22:24:13', '2021-06-25 22:24:13'),
(10, 'Personal Development', 1, '2021-06-25 22:25:12', '2021-06-25 22:25:12'),
(11, 'Lifestyle', 1, '2021-06-25 22:26:11', '2021-06-25 22:26:11'),
(12, 'Health & Fitness', 1, '2021-06-25 22:27:49', '2021-06-25 22:27:49'),
(13, 'Teaching & Academics', 1, '2021-06-25 22:28:47', '2021-06-25 22:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `chat_group`
--

CREATE TABLE `chat_group` (
  `id` int(11) NOT NULL,
  `u_id` varchar(50) NOT NULL,
  `user_one` int(11) NOT NULL COMMENT 'teacher ',
  `user_two` int(11) NOT NULL COMMENT 'student ',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_chat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat_msg`
--

CREATE TABLE `chat_msg` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `msg` text CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `sender_id` varchar(11) DEFAULT 'student',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `subtitle` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `price` float DEFAULT 0,
  `discount_price` float DEFAULT 0,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `is_bestseller` int(11) NOT NULL DEFAULT 0,
  `cover_image` varchar(50) NOT NULL DEFAULT 'default.png',
  `promotional_video` varchar(50) DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 draft 1 active 2 waitfor approced 3 block 4 deactive ',
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0,
  `share` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `report_abues` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 1,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_ratings`
--

CREATE TABLE `course_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `star` int(11) NOT NULL DEFAULT 1,
  `msg` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_for` int(11) NOT NULL DEFAULT 0 COMMENT '0 = student 1 teacher ',
  `question` varchar(255) NOT NULL,
  `ans` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `faq_for`, `question`, `ans`, `created_at`, `updated_at`) VALUES
(2, 0, 'Account/Profile', 'Manage your account settings.', NULL, NULL),
(3, 1, 'Account/Profile', 'Manage your account settings.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `document` varchar(50) DEFAULT NULL,
  `msg` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headline` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_notification` int(11) NOT NULL DEFAULT 1,
  `push_notification` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_pro` int(11) NOT NULL DEFAULT 0,
  `popular` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_live` int(11) DEFAULT 0,
  `balance` float DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LOCAL',
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_discussions`
--

CREATE TABLE `instructor_discussions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `likes` text DEFAULT NULL,
  `dislikes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ins_verify`
--

CREATE TABLE `ins_verify` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `document` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = requsted 1 approved 2 reject',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hindi', 1, '2021-05-18 01:43:02', '2021-06-23 23:26:20'),
(3, 'English', 1, '2021-05-19 05:44:51', '2021-05-19 05:44:51'),
(5, 'Spanish', 1, '2021-06-23 23:24:32', '2021-06-23 23:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `laravel_fulltext`
--

CREATE TABLE `laravel_fulltext` (
  `id` int(10) UNSIGNED NOT NULL,
  `indexable_id` int(11) NOT NULL,
  `indexable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indexed_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `indexed_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laravel_fulltext`
--

INSERT INTO `laravel_fulltext` (`id`, `indexable_id`, `indexable_type`, `indexed_title`, `indexed_content`, `created_at`, `updated_at`) VALUES
(1, 1, 'BinshopsBlog\\Models\\BinshopsPostTranslation', '<script> function myFunction() {   alert(\"Hello\\nHow are you?\"); } myFunction(); </script>http://127.0.0.1:1011/en/blog/Technology Technology Update der', '<p>&lt;script&gt;<br />\r\nfunction myFunction() {<br />\r\n&nbsp; alert(&quot;Hello\\nHow are you?&quot;);<br />\r\n}</p>\r\n\r\n<p>myFunction();<br />\r\n&lt;/script&gt;</p>\r\n\r\n<p>&nbsp;</p> der der', '2021-06-15 04:37:37', '2021-07-01 07:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `file` varchar(50) NOT NULL,
  `volume` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike_courses`
--

CREATE TABLE `like_dislike_courses` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `for_what` int(11) NOT NULL COMMENT '0 = like 1 dislke',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `live_streams`
--

CREATE TABLE `live_streams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `embed_code` text NOT NULL,
  `enable_comment` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `likes` text DEFAULT NULL,
  `dislikes` text DEFAULT NULL,
  `share` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = live  0 stoped 2 ended ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_17_094523_create_permission_tables', 2),
(5, '2016_11_04_152913_create_laravel_fulltext_table', 3),
(6, '2020_10_16_004241_create_binshops_languages_table', 3),
(7, '2020_10_16_005400_create_binshops_categories_table', 3),
(8, '2020_10_16_005425_create_binshops_category_translations_table', 3),
(9, '2020_10_16_010039_create_binshops_posts_table', 3),
(10, '2020_10_16_010049_create_binshops_post_translations_table', 3),
(11, '2020_10_16_121230_create_binshops_comments_table', 3),
(12, '2020_10_16_121728_create_binshops_uploaded_photos_table', 3),
(13, '2020_10_22_132005_create_binshops_configurations_table', 3),
(14, '2021_01_24_205114_create_paytabs_invoices_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `who_is` int(11) NOT NULL DEFAULT 0 COMMENT '0 stdent 1 = teacher ',
  `title` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification_template`
--

CREATE TABLE `notification_template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `for_what` varchar(255) NOT NULL,
  `for_who` int(11) NOT NULL COMMENT '0 = both 1 student 2 teacher ',
  `email_title` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `noti_title` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification_template`
--

INSERT INTO `notification_template` (`id`, `for_what`, `for_who`, `email_title`, `subject`, `noti_title`, `created_at`, `updated_at`) VALUES
(2, 'Coerce Approved ', 2, 'hey {{instructor_name}} your {{course_title}} is Approved&nbsp; by admin', 'Coerce Approved', 'hey {{instructor_name}} your {{course_title}} is Approved  by admin', '2021-06-14 10:26:15', '2021-06-16 06:42:39'),
(3, 'Course Sell', 2, 'Course Sell', 'Course Sell', 'Course Sell', '2021-06-14 10:30:46', '2021-06-14 10:30:46'),
(4, 'Payout Update', 2, '<h6><b><u>{{instructor_name}} </u></b>your payout of <span style=\"background-color: rgb(255, 0, 0);\">{{amount}} </span>is<span style=\"font-family: Helvetica;\"> {{status}}</span> with remark of {{remark}}</h6>', 'Payout Update', '{{instructor_name}} your payout of {{amount}} is {{status}} with remark of {{remark}}', '2021-06-14 10:30:46', '2021-06-16 07:15:06'),
(5, 'Review Added', 2, 'Review Added', 'Review Added', 'Review Added', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Thanks For Review', 1, 'Thanks For Review', 'Thanks For Review', 'Thanks For Review', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Report Feedback', 1, 'Report Feedback', 'Report Feedback', 'Report Feedback {{name}}', '2021-06-14 10:42:01', '2021-06-14 09:22:20'),
(8, 'Coerce Block ', 2, 'Coerce Block ', 'Coerce Block ', 'Coerce Block ', '2021-06-14 10:42:01', '2021-06-14 10:42:01'),
(9, 'Live Now (Subscribe Institute )', 1, 'Live Now (Subscribe Institute )', 'Live Now (Subscribe Institute )', 'Live Now (Subscribe Institute )', '2021-06-14 10:43:31', '2021-06-14 10:43:31'),
(10, 'New Course (Subscribe Institute )', 1, 'New Course (Subscribe Institute )', 'New Course (Subscribe Institute )', 'New Course (Subscribe Institute )', '2021-06-14 10:43:31', '2021-06-15 10:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_token` varchar(255) NOT NULL,
  `admin_commission` float NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '$2y$10$Ss1tEOYhbVcEZmyH4F15R.l2WjwHXs/W0ns6eD7BtncID9tPP2Hra', '2021-06-14 06:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 proess 1 done 2 reject\r\n',
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paytabs_invoices`
--

CREATE TABLE `paytabs_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_code` int(10) UNSIGNED NOT NULL,
  `pt_invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_first_six_digits` int(10) UNSIGNED DEFAULT NULL,
  `card_last_four_digits` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role_create', 'web', NULL, NULL),
(2, 'role_edit', 'web', NULL, NULL),
(3, 'role_access', 'web', NULL, NULL),
(4, 'role_show', 'web', NULL, NULL),
(5, 'role_delete', 'web', NULL, NULL),
(6, 'user_create', 'web', NULL, NULL),
(7, 'user_edit', 'web', NULL, NULL),
(8, 'user_access', 'web', NULL, NULL),
(9, 'user_show', 'web', NULL, NULL),
(10, 'user_delete', 'web', NULL, NULL),
(11, 'language_create', 'web', NULL, NULL),
(12, 'language_edit', 'web', NULL, NULL),
(13, 'language_access', 'web', NULL, NULL),
(14, 'language_show', 'web', NULL, NULL),
(15, 'language_delete', 'web', NULL, NULL),
(16, 'category_create', 'web', NULL, NULL),
(17, 'category_edit', 'web', NULL, NULL),
(18, 'category_access', 'web', NULL, NULL),
(19, 'category_show', 'web', NULL, NULL),
(20, 'category_delete', 'web', NULL, NULL),
(21, 'sub_category_create', 'web', NULL, NULL),
(22, 'sub_category_edit', 'web', NULL, NULL),
(23, 'sub_category_access', 'web', NULL, NULL),
(24, 'sub_category_show', 'web', NULL, NULL),
(25, 'sub_category_delete', 'web', NULL, NULL),
(26, 'instructor_edit', 'web', NULL, NULL),
(27, 'instructor_access', 'web', NULL, NULL),
(28, 'instructor_show', 'web', NULL, NULL),
(29, 'course_access', 'web', NULL, NULL),
(30, 'course_show', 'web', NULL, NULL),
(31, 'verification_access', 'web', NULL, NULL),
(32, 'faq_create', 'web', NULL, NULL),
(33, 'faq_edit', 'web', NULL, NULL),
(34, 'faq_access', 'web', NULL, NULL),
(35, 'faq_show', 'web', NULL, NULL),
(36, 'faq_delete', 'web', NULL, NULL),
(37, 'student_edit', 'web', NULL, NULL),
(38, 'student_access', 'web', NULL, NULL),
(39, 'student_show', 'web', NULL, NULL),
(40, 'payout_access', 'web', NULL, NULL),
(41, 'setting_access', 'web', NULL, NULL),
(42, 'report_access', 'web', NULL, NULL),
(43, 'notification_access', 'web', NULL, NULL),
(44, 'feedback_access', 'web', NULL, NULL),
(45, 'lang_access', 'web', NULL, NULL),
(46, 'lang_create', 'web', NULL, NULL),
(47, 'lang_edit', 'web', NULL, NULL),
(48, 'lang_delete', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report_abuses`
--

CREATE TABLE `report_abuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin S', 'web', '2021-05-17 06:01:36', '2021-05-17 06:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `saved_courses`
--

CREATE TABLE `saved_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `special_discounts`
--

CREATE TABLE `special_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `percentage` float NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stream_comment`
--

CREATE TABLE `stream_comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stream_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `email_notification` int(11) NOT NULL DEFAULT 1,
  `push_notification` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'LOCAL',
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CSS', 1, 1, '2021-05-18 05:07:01', '2021-05-19 05:55:51'),
(3, 'JS', 1, 1, '2021-05-19 05:55:58', '2021-05-19 05:55:58'),
(4, 'Digital Marketing', 2, 1, '2021-06-23 23:31:46', '2021-06-23 23:31:46'),
(5, 'UI Design', 5, 1, '2021-06-23 23:32:04', '2021-06-23 23:32:04'),
(6, 'Full Stack Development', 3, 1, '2021-06-23 23:32:37', '2021-06-23 23:32:37'),
(7, 'B2B Business', 4, 1, '2021-06-23 23:32:58', '2021-06-23 23:32:58'),
(8, 'Python', 3, 1, '2021-06-25 22:42:23', '2021-06-25 22:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,  
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$T.D5PIkrrtFsQPIFa7njDuyghYbJptKrNe.tn1gr/YFiFoPzp5Iyi', 'F7z2CMQ6l05CEHN0kNLwYmENbuWPq0eGVNqfUXDDoPXQ79U4vKxPmeo4IeCR', NULL, '2021-06-24 05:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `web_language`
--

CREATE TABLE `web_language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(2) NOT NULL,
  `is_rtl` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_language`
--

INSERT INTO `web_language` (`id`, `name`, `short_name`, `is_rtl`, `created_at`, `updated_at`) VALUES
(1, 'Spanish', 'es', 0, '2021-06-19 12:07:17', '2021-06-19 12:07:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_setting`
--
ALTER TABLE `admin_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_group`
--
ALTER TABLE `chat_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_msg`
--
ALTER TABLE `chat_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_ratings`
--
ALTER TABLE `course_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `instructor_discussions`
--
ALTER TABLE `instructor_discussions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ins_verify`
--
ALTER TABLE `ins_verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laravel_fulltext`
--
ALTER TABLE `laravel_fulltext`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laravel_fulltext_indexable_type_indexable_id_unique` (`indexable_type`,`indexable_id`);
ALTER TABLE `laravel_fulltext` ADD FULLTEXT KEY `fulltext_title` (`indexed_title`);
ALTER TABLE `laravel_fulltext` ADD FULLTEXT KEY `fulltext_title_content` (`indexed_title`,`indexed_content`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_dislike_courses`
--
ALTER TABLE `like_dislike_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_streams`
--
ALTER TABLE `live_streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_template`
--
ALTER TABLE `notification_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytabs_invoices`
--
ALTER TABLE `paytabs_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `report_abuses`
--
ALTER TABLE `report_abuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `saved_courses`
--
ALTER TABLE `saved_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_discounts`
--
ALTER TABLE `special_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stream_comment`
--
ALTER TABLE `stream_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `web_language`
--
ALTER TABLE `web_language`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_setting`
--
ALTER TABLE `admin_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chat_group`
--
ALTER TABLE `chat_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_msg`
--
ALTER TABLE `chat_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_content`
--
ALTER TABLE `course_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_ratings`
--
ALTER TABLE `course_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_discussions`
--
ALTER TABLE `instructor_discussions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ins_verify`
--
ALTER TABLE `ins_verify`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laravel_fulltext`
--
ALTER TABLE `laravel_fulltext`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like_dislike_courses`
--
ALTER TABLE `like_dislike_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_streams`
--
ALTER TABLE `live_streams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_template`
--
ALTER TABLE `notification_template`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paytabs_invoices`
--
ALTER TABLE `paytabs_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `report_abuses`
--
ALTER TABLE `report_abuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saved_courses`
--
ALTER TABLE `saved_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `special_discounts`
--
ALTER TABLE `special_discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stream_comment`
--
ALTER TABLE `stream_comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_language`
--
ALTER TABLE `web_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
