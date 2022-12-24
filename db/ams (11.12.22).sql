-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2022 at 05:20 PM
-- Server version: 8.0.27
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_cashes`
--

DROP TABLE IF EXISTS `bank_cashes`;
CREATE TABLE IF NOT EXISTS `bank_cashes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `current_balance` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bank_cashes`
--

INSERT INTO `bank_cashes` (`id`, `voucher_no`, `name`, `current_balance`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SL000001', 'Bkash', '1400', NULL, 1, 1, 1, '2022-12-10 09:47:50', '2022-12-10 12:48:41'),
(3, 'SL000002', 'Rocket', '800', NULL, 1, 1, 1, '2022-12-10 09:58:14', '2022-12-10 12:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `company_name`, `contact_person_name`, `designation`, `mobile`, `email`, `address`, `details`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Mr. A', 'exam.com', 'Mr. Wahid', 'Programmer', '01745778890', 'wh@gmail.com', 'Dhaka, BD.', NULL, 1, 1, '2022-12-01 22:51:10', '2022-12-01 22:51:36'),
(2, 'Md. Habib', '3doctors', 'Mr. Jhon', 'Senior Programmer', '01723456700', 'hb@gmail.com', 'Rajshahi, BD.', 'argent', 1, 1, '2022-12-01 22:54:16', '2022-12-01 22:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `costings`
--

DROP TABLE IF EXISTS `costings`;
CREATE TABLE IF NOT EXISTS `costings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `due` varchar(255) DEFAULT NULL,
  `payment_note` varchar(191) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `costings`
--

INSERT INTO `costings` (`id`, `invoice_no`, `invoice_date`, `attachment`, `vendor_name`, `product_name`, `price`, `quantity`, `subtotal`, `grand_total`, `paid_amount`, `due`, `payment_note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'SL000001', '2022-12-03', NULL, '2', '[\"Item-2\",\"Item-1\"]', '[\"1\",\"4\"]', '[\"2\",\"4\"]', '[\"2\",\"16\"]', '18', '10', '10', 'paid', 1, 1, '2022-12-02 14:23:33', '2022-12-03 05:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `costing_inventories`
--

DROP TABLE IF EXISTS `costing_inventories`;
CREATE TABLE IF NOT EXISTS `costing_inventories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `costing_id` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `subtotal` text,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `costing_inventories`
--

INSERT INTO `costing_inventories` (`id`, `costing_id`, `invoice_no`, `product_name`, `quantity`, `price`, `subtotal`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, '2', 'SL000001', 'Item-1', '4', '4', '16', NULL, NULL, NULL, NULL),
(5, '2', 'SL000001', 'Item-2', '2', '1', '2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` text,
  `position` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `mobile`, `address`, `position`, `dept`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Atik Hasan', 'ak@gmail.com', '01745677792', 'Dhaka, BD.', 'Manager', 'dev', 'Old employee', 1, 1, '2022-12-01 23:55:39', '2022-12-01 23:55:53'),
(2, 'Mamun', 'mamun@gmail.com', '01745668990', NULL, 'Designation-1', 'Android', NULL, 1, 1, '2022-12-01 23:56:46', '2022-12-01 23:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_date` varchar(255) NOT NULL,
  `project_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `expense_head` varchar(255) DEFAULT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `voucher_no` varchar(255) DEFAULT NULL,
  `expense_details` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `payment_note` text,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_date`, `project_name`, `expense_head`, `receiver`, `voucher_no`, `expense_details`, `amount`, `total`, `source`, `attachment`, `payment_note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '02/12/2022', NULL, '1', 'Mamun', 'SL000001', '[\"Oct-22\",\"Nov-22\"]', '[\"200\",\"220\"]', '420', '1', 'efds.jpg', 'paid', 1, 1, '2022-12-02 00:09:27', '2022-12-02 00:09:27'),
(2, '02/12/2022', 'ERP', '2', NULL, 'SL000002', '[\"St-1\",\"St-2\"]', '[\"200\",\"50\"]', '250', '2', 'download-4).jpg', 'paid', 1, 1, '2022-12-02 10:37:06', '2022-12-02 10:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

DROP TABLE IF EXISTS `expense_heads`;
CREATE TABLE IF NOT EXISTS `expense_heads` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  `status` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `name`, `code`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Stationary', '102', NULL, NULL, 1, 1, '2022-12-01 17:31:56', '2022-12-01 17:31:56'),
(1, 'Salary', '101', 'first', NULL, 1, 1, '2022-12-01 17:31:36', '2022-12-01 17:33:05'),
(3, 'Office Expense', '103', NULL, NULL, 1, 1, '2022-12-01 17:32:13', '2022-12-01 17:32:13'),
(4, 'Entertainment', '104', NULL, NULL, 1, 1, '2022-12-01 17:32:35', '2022-12-01 17:32:35'),
(5, 'Conveyance', '105', NULL, NULL, 1, 1, '2022-12-01 17:32:53', '2022-12-01 17:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `income_heads`
--

DROP TABLE IF EXISTS `income_heads`;
CREATE TABLE IF NOT EXISTS `income_heads` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  `status` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `income_heads`
--

INSERT INTO `income_heads` (`id`, `name`, `code`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Income Source-2', '202', 'testing purpose...', NULL, 1, 1, '2022-12-01 17:34:49', '2022-12-01 17:35:00'),
(1, 'Income Source-1', '201', NULL, NULL, 1, 1, '2022-12-01 17:34:24', '2022-12-01 17:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `assign_date` varchar(255) DEFAULT NULL,
  `submission_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `address` text,
  `description` text,
  `file` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `client_name`, `assign_date`, `submission_date`, `status`, `total_cost`, `total_price`, `address`, `description`, `file`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SQ', '1', '2022-12-01', '2022-12-15', 'running', '10000', '15000', 'Dhaka, BD.', 'Testing purpose', 'what_is_image_Processing.jpg', 1, 1, '2022-12-01 23:14:12', '2022-12-01 23:14:42'),
(3, 'ERP', '2', '2022-12-02', '2022-12-12', 'complete', '10000', '13000', NULL, NULL, NULL, 1, 1, '2022-12-01 23:21:26', '2022-12-01 23:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_groups`
--

DROP TABLE IF EXISTS `ledger_groups`;
CREATE TABLE IF NOT EXISTS `ledger_groups` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_names`
--

DROP TABLE IF EXISTS `ledger_names`;
CREATE TABLE IF NOT EXISTS `ledger_names` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_types`
--

DROP TABLE IF EXISTS `ledger_types`;
CREATE TABLE IF NOT EXISTS `ledger_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=315 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(291, '2014_10_12_000000_create_users_table', 2),
(292, '2014_10_12_100000_create_password_resets_table', 2),
(293, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(294, '2019_08_19_000000_create_failed_jobs_table', 2),
(295, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(296, '2022_10_22_140735_create_costings_table', 2),
(297, '2022_10_23_041859_create_categories_table', 2),
(298, '2022_10_23_051220_create_inventories_table', 2),
(299, '2022_10_27_164559_create_expenses_table', 2),
(300, '2022_10_28_040532_create_vendors_table', 2),
(301, '2022_10_30_065616_create_clients_table', 2),
(302, '2022_11_01_043837_create_employees_table', 2),
(303, '2022_11_02_033600_create_bank_cashes_table', 2),
(304, '2022_11_02_041249_create_sells_table', 2),
(305, '2022_11_02_170557_create_ledger_types_table', 2),
(306, '2022_11_02_170731_create_ledger_groups_table', 2),
(307, '2022_11_02_170755_create_ledger_names_table', 2),
(308, '2022_11_03_164659_create_expense_heads_table', 2),
(309, '2022_11_03_164826_create_income_heads_table', 2),
(310, '2022_11_06_032331_create_products_table', 2),
(311, '2022_11_17_050809_create_costing_inventories_table', 2),
(312, '2022_11_23_063744_create_salaries_table', 2),
(313, '2022_11_24_085350_create_profits_table', 2),
(267, '2022_11_30_184824_create_sessions_table', 1),
(314, '2022_11_30_190450_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `unit_price` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `description` text,
  `file` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `unit`, `unit_price`, `stock`, `description`, `file`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Item-1', 'pc', '4', '19', 'first', 'efds.jpg', 1, 1, '2022-12-01 23:23:17', '2022-12-03 05:55:32'),
(2, 'Item-2', 'pcs', '1', '21', NULL, NULL, 1, 1, '2022-12-01 23:25:08', '2022-12-03 05:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `profits`
--

DROP TABLE IF EXISTS `profits`;
CREATE TABLE IF NOT EXISTS `profits` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `voucher_no` varchar(191) DEFAULT NULL,
  `income_head` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `expense_head` varchar(191) DEFAULT NULL,
  `giver` varchar(255) DEFAULT NULL,
  `receiver` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `amount` varchar(191) DEFAULT NULL,
  `total` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `project_name` varchar(191) DEFAULT NULL,
  `description` text,
  `payment_note` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `attachment` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `profits`
--

INSERT INTO `profits` (`id`, `date`, `voucher_no`, `income_head`, `expense_head`, `giver`, `receiver`, `amount`, `total`, `source`, `project_name`, `description`, `payment_note`, `attachment`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '10-12-2022', 'SL000001', NULL, NULL, NULL, NULL, NULL, '1000', '1', NULL, NULL, NULL, NULL, 'cr', 1, 1, '2022-12-10 09:47:50', '2022-12-10 09:47:50'),
(3, '10-12-2022', 'SL000002', NULL, NULL, NULL, NULL, NULL, '700', '3', NULL, NULL, NULL, NULL, 'cr', 1, 1, '2022-12-10 09:58:14', '2022-12-10 10:27:50'),
(7, '10-12-2022', 'SL000003', '1', NULL, 'Md. Habib', NULL, NULL, '500', '1', NULL, 'test', 'paid', NULL, 'cr', 1, 1, '2022-12-10 11:41:26', '2022-12-10 11:41:26'),
(9, '10-12-2022', 'SL000004', '2', NULL, 'Md. Habib', NULL, NULL, '100', '3', 'SQ', NULL, NULL, NULL, 'cr', 1, 1, '2022-12-10 12:04:02', '2022-12-10 12:04:02'),
(11, '11/12/2022', 'SL000005', NULL, '1', NULL, 'Mamun', '[\"100\"]', '100', '1', 'SQ', '[\"test-1\"]', NULL, NULL, 'dr', 1, 1, '2022-12-10 12:30:09', '2022-12-10 12:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
CREATE TABLE IF NOT EXISTS `salaries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
CREATE TABLE IF NOT EXISTS `sells` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `sell_amount` varchar(255) DEFAULT NULL,
  `sell_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('R9z34ZwiuMJ6wlKAIxVQPYRmFGZofU69CtbimYsp', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicmV1TWhocURqenlJOVlPckNYbWZMNDRtc2txQm9pNzJiWXVHSDJqTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0L2Ftcy9wdWJsaWMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTY3MDc3MzA1Mjt9fQ==', 1670779166);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text,
  `two_factor_recovery_codes` text,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$bJNet1h.fAVkH3H4UIIqeuRkSUnG8RlDAatWJRCxfhcP3ssa0yf8m', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-01 22:43:25', '2022-12-01 22:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `website` varchar(255) DEFAULT NULL,
  `details` text,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `company_name`, `contact_person_name`, `designation`, `mobile`, `email`, `address`, `website`, `details`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Rakib Hasan', 'FleetHost', 'Mr. HR', 'Senior Programmer', '01723457789', 'rk@gmail.com', 'Dhaka, BD.', 'FleetHostBD.com', 'This is for test....', 1, 1, '2022-12-01 23:00:08', '2022-12-01 23:00:25'),
(2, 'AGD Snadre', 'example', 'Mr. zim', 'Programmer', '01745678112', 'zm@gmail.com', 'Rajshahi, BD.', 'example.com', NULL, 1, 1, '2022-12-01 23:01:50', '2022-12-01 23:02:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
