-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 11, 2019 at 10:10 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `homeland_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_head_tb`
--

CREATE TABLE `account_head_tb` (
  `id` int(11) NOT NULL,
  `account_head_code` varchar(25) NOT NULL,
  `account_head_type` varchar(225) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_head_tb`
--

INSERT INTO `account_head_tb` (`id`, `account_head_code`, `account_head_type`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'D_001', 'Investor', 0, '2019-08-22 01:52:23', '2019-08-22 01:52:23'),
(2, 'D_002', 'Project', 0, '2019-08-24 08:37:16', '2019-08-24 08:37:16'),
(3, 'D_003', 'Bank', 0, '2019-08-25 17:26:56', '2019-08-25 17:26:56'),
(4, 'D_004', 'PaymentOrder', 0, '2019-08-25 17:26:56', '2019-08-25 17:26:56'),
(5, 'D_005', 'PurchaseGuarantee', 0, '2019-08-26 01:21:51', '2019-08-26 01:21:51'),
(6, 'D_006', 'Daily Expends', 0, '2019-08-31 03:14:34', '2019-08-31 03:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `bank_detail_tb`
--

CREATE TABLE `bank_detail_tb` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `total_loan_amount` int(25) NOT NULL,
  `left_amount` int(25) DEFAULT NULL,
  `loan_date` varchar(25) NOT NULL,
  `description` varchar(225) NOT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_detail_tb`
--

INSERT INTO `bank_detail_tb` (`id`, `bank_id`, `total_loan_amount`, `left_amount`, `loan_date`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(14, 4, 1100000, NULL, '09/09/2019', 'first period for bank load', 0, '2019-09-09 17:38:22', '2019-09-09 17:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `bank_expense_tb`
--

CREATE TABLE `bank_expense_tb` (
  `id` int(11) NOT NULL,
  `account_head_type` int(11) NOT NULL,
  `loan_transfer_id` int(11) NOT NULL,
  `payment_type` varchar(11) NOT NULL,
  `payback_amount` int(30) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_expense_tb`
--

INSERT INTO `bank_expense_tb` (`id`, `account_head_type`, `loan_transfer_id`, `payment_type`, `payback_amount`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 3, 9, 'Cash', 1000, 'something', 0, '2019-09-09 20:35:15', '2019-09-09 20:35:15'),
(2, 3, 9, 'Cash', 10000, 'september', 0, '2019-09-10 01:06:14', '2019-09-10 01:06:14'),
(3, 3, 9, 'Cash', 1000, 'september  2', 0, '2019-09-10 01:45:06', '2019-09-10 01:45:06'),
(4, 3, 10, 'Bank', 10000, 'for first paid for bank', 0, '2019-09-10 02:28:10', '2019-09-10 02:28:10'),
(5, 3, 9, 'Bank', 88000, 'for payback', 0, '2019-09-10 05:12:22', '2019-09-10 05:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `bank_tb`
--

CREATE TABLE `bank_tb` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_tb`
--

INSERT INTO `bank_tb` (`id`, `code`, `name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(4, 'B_001', 'Ayarwady', 0, '2019-09-09 16:24:06', '2019-09-09 16:24:06'),
(5, 'B_002', 'KBZ', 0, '2019-09-09 16:24:15', '2019-09-09 16:24:15'),
(6, 'B_003', 'CB', 0, '2019-09-09 16:24:27', '2019-09-09 16:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `cash_book_tb`
--

CREATE TABLE `cash_book_tb` (
  `id` int(11) NOT NULL,
  `specification_id` int(11) NOT NULL,
  `account_head_id` int(11) NOT NULL,
  `payment_type` varchar(11) NOT NULL,
  `income` int(25) DEFAULT '0',
  `expend` int(25) DEFAULT '0',
  `balance` int(25) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cash_book_tb`
--

INSERT INTO `cash_book_tb` (`id`, `specification_id`, `account_head_id`, `payment_type`, `income`, `expend`, `balance`, `created_at`, `updated_at`, `description`, `deleted_flag`) VALUES
(1, 3, 1, 'Cash', 100000, 0, 100000, '2019-09-08 03:35:29', '2019-09-08 03:35:29', 'something', 0),
(2, 3, 1, 'Cash', 100000, 0, 200000, '2019-09-08 03:35:47', '2019-09-08 03:35:47', 'something 2', 0),
(3, 1, 1, 'Bank', 300000, 0, 500000, '2019-09-08 03:36:02', '2019-09-08 03:36:02', 'project fees', 0),
(4, 2, 1, 'Bank', 400000, 0, 900000, '2019-09-08 03:37:09', '2019-09-08 03:37:09', 'change to bank transfer', 0),
(5, 1, 6, 'Cash', 0, 100000, 800000, '2019-09-08 05:02:26', '2019-09-08 05:02:26', 'for stationary', 0),
(6, 1, 6, 'Bank', 0, 100000, 700000, '2019-09-08 07:30:45', '2019-09-08 07:30:45', 'for testing', 0),
(7, 3, 6, 'Cash', 0, 100000, 600000, '2019-09-09 04:44:53', '2019-09-09 04:44:53', 'for salary', 0),
(8, 1, 6, 'Cash', 0, 1000, 599000, '2019-09-09 04:50:46', '2019-09-09 04:50:46', 'stationary', 0),
(9, 3, 1, 'Cash', 5000, 0, 604000, '2019-09-09 04:51:23', '2019-09-09 04:51:23', 'for stationary', 0),
(10, 4, 2, 'cash', 90000, 0, 694000, '2019-09-09 06:37:03', '2019-09-09 06:37:03', 'for project income', 0),
(11, 2, 6, 'Bank', 0, 1000, 693000, '2019-09-09 09:07:53', '2019-09-09 09:07:53', 'aaa', 0),
(12, 3, 6, 'Bank', 0, 100000, 593000, '2019-09-09 14:28:05', '2019-09-09 14:28:05', 'salary for homlamd', 0),
(13, 4, 2, 'Bank', 0, 100000, 493000, '2019-09-09 15:00:15', '2019-09-09 15:00:15', 'for project expense', 0),
(14, 4, 3, 'bank', 1000000, 0, 1493000, '2019-09-09 17:38:22', '2019-09-09 17:38:22', 'first period for bank load', 0),
(15, 4, 3, 'bank', 100000, 0, 1593000, '2019-09-09 19:10:54', '2019-09-09 19:10:54', 'bank loan', 0),
(16, 9, 3, 'Cash', 0, 1000, 1592000, '2019-09-09 20:35:15', '2019-09-09 20:35:15', 'something', 0),
(17, 9, 3, 'Cash', 0, 10000, 1582000, '2019-09-10 01:06:14', '2019-09-10 01:06:14', 'september', 0),
(18, 9, 3, 'Cash', 0, 1000, 1581000, '2019-09-10 01:45:06', '2019-09-10 01:45:06', 'september  2', 0),
(19, 10, 3, 'Bank', 0, 10000, 1571000, '2019-09-10 02:28:10', '2019-09-10 02:28:10', 'for first paid for bank', 0),
(20, 3, 2, 'cash', 1000, 0, 1572000, '2019-09-10 03:06:50', '2019-09-10 03:06:50', 'ppo', 0),
(21, 3, 1, 'Bank', 100000, 0, 1672000, '2019-09-10 04:46:14', '2019-09-10 04:46:14', 'for investor income', 0),
(22, 4, 6, 'Bank', 0, 100000, 1572000, '2019-09-10 04:47:01', '2019-09-10 04:47:01', 'for stationary', 0),
(23, 3, 6, 'Bank', 0, 100000, 1472000, '2019-09-10 04:53:59', '2019-09-10 04:53:59', 'for stationary', 0),
(24, 4, 6, 'Bank', 0, 100000, 1372000, '2019-09-10 04:55:34', '2019-09-10 04:55:34', 'for homeland', 0),
(25, 9, 3, 'Bank', 0, 88000, 1284000, '2019-09-10 05:12:22', '2019-09-10 05:12:22', 'for payback', 0),
(26, 3, 1, 'Cash', 7000, 0, 1291000, '2019-09-10 05:13:45', '2019-09-10 05:13:45', 'for cash', 0);

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invester_detail_tb`
--

CREATE TABLE `invester_detail_tb` (
  `investor_detail_id` int(11) NOT NULL,
  `investor_id` int(11) NOT NULL,
  `payment_type` varchar(11) DEFAULT NULL,
  `amount` int(25) NOT NULL,
  `description` text,
  `remark` text,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invester_detail_tb`
--

INSERT INTO `invester_detail_tb` (`investor_detail_id`, `investor_id`, `payment_type`, `amount`, `description`, `remark`, `delete_flag`, `created_at`, `updated_at`) VALUES
(28, 3, 'Cash', 100000, 'something', NULL, 0, '2019-09-08 03:35:29', '2019-09-08 03:35:29'),
(29, 3, 'Cash', 100000, 'something 2', NULL, 0, '2019-09-08 03:35:47', '2019-09-08 03:35:47'),
(30, 1, 'Bank', 300000, 'project fees', NULL, 0, '2019-09-08 03:36:02', '2019-09-08 03:36:02'),
(31, 2, 'Bank', 400000, 'change to bank transfer', NULL, 0, '2019-09-08 03:37:09', '2019-09-08 03:37:09'),
(32, 3, 'Cash', 5000, 'for stationary', NULL, 0, '2019-09-09 04:51:23', '2019-09-09 04:51:23'),
(33, 3, 'Bank', 100000, 'for investor income', NULL, 0, '2019-09-10 04:46:14', '2019-09-10 04:46:14'),
(34, 3, 'Cash', 7000, 'for cash', NULL, 0, '2019-09-10 05:13:45', '2019-09-10 05:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `invester_tb`
--

CREATE TABLE `invester_tb` (
  `id` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invester_tb`
--

INSERT INTO `invester_tb` (`id`, `code`, `name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'I_001', 'Aung Khit Paing', 0, '2019-08-21 15:21:46', '2019-08-21 15:21:46'),
(2, 'I_002', 'Aung Khant Kyaw', 0, '2019-08-21 15:35:39', '2019-08-21 15:35:39'),
(3, 'I_003', 'U Aung Myo Minn', 0, '2019-08-21 16:35:28', '2019-08-21 16:35:28'),
(4, 'I_004', 'Theingiiii', 0, '2019-08-31 04:52:23', '2019-08-31 04:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `investor_income_tb`
--

CREATE TABLE `investor_income_tb` (
  `id` int(11) NOT NULL,
  `investor_id` int(11) NOT NULL,
  `total_income_balance` int(25) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investor_income_tb`
--

INSERT INTO `investor_income_tb` (`id`, `investor_id`, `total_income_balance`, `delete_flag`, `created_at`, `updated_at`) VALUES
(11, 3, 312000, 0, '2019-09-08 03:35:29', '2019-09-08 03:35:29'),
(12, 1, 300000, 0, '2019-09-08 03:36:02', '2019-09-08 03:36:02'),
(13, 2, 400000, 0, '2019-09-08 03:37:09', '2019-09-08 03:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `loan_detail_tb`
--

CREATE TABLE `loan_detail_tb` (
  `id` int(11) NOT NULL,
  `bank_detail_id` int(11) NOT NULL,
  `payment_type` varchar(11) DEFAULT NULL,
  `loan_amount` int(30) DEFAULT '0',
  `loan_date` varchar(25) DEFAULT NULL,
  `payback_amount` int(30) DEFAULT '0',
  `payback_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_detail_tb`
--

INSERT INTO `loan_detail_tb` (`id`, `bank_detail_id`, `payment_type`, `loan_amount`, `loan_date`, `payback_amount`, `payback_date`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(9, 4, 'bank', 1000000, '09/09/2019', 100000, NULL, 'first period for bank load', 0, '2019-09-09 17:38:22', '2019-09-09 17:38:22'),
(10, 4, 'bank', 100000, '09/10/2019', 10000, NULL, 'bank loan', 0, '2019-09-09 19:10:54', '2019-09-09 19:10:54');

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
(3, '2019_07_18_165305_create_stocks_table', 1),
(4, '2019_07_19_180711_create_estimates_table', 1),
(5, '2019_07_19_185629_create_suppliers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_expense_category`
--

CREATE TABLE `office_expense_category` (
  `id` int(11) NOT NULL,
  `expense_category_name` text NOT NULL,
  `expense_category_code` varchar(30) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office_expense_category`
--

INSERT INTO `office_expense_category` (`id`, `expense_category_name`, `expense_category_code`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Stationary', 'OS_001', 0, '2019-09-09 02:56:58', '2019-09-09 02:56:58'),
(2, 'Patrol', 'P_001', 0, '2019-09-09 04:39:09', '2019-09-09 04:39:09'),
(3, 'Salary', 'S_009', 0, '2019-09-09 04:39:20', '2019-09-09 04:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `office_expense_detail_tb`
--

CREATE TABLE `office_expense_detail_tb` (
  `office_expense_detail_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `expense_category` int(11) NOT NULL,
  `payment_type` varchar(11) NOT NULL,
  `amount` int(30) NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office_expense_detail_tb`
--

INSERT INTO `office_expense_detail_tb` (`office_expense_detail_id`, `project_id`, `expense_category`, `payment_type`, `amount`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Cash', 100000, 'for stationary', 0, '2019-09-08 12:43:54', '2019-09-08 12:43:54'),
(2, 4, 1, 'Bank', 100000, 'for testing', 0, '2019-09-08 12:43:54', '2019-09-08 12:43:54'),
(3, 4, 2, 'Bank', 1000, 'aaa', 0, '2019-09-09 09:07:53', '2019-09-09 09:07:53'),
(4, 4, 3, 'Bank', 100000, 'salary for homlamd', 0, '2019-09-09 14:12:13', '2019-09-09 14:12:13'),
(7, 4, 1, 'Bank', 100000, 'for stationary', 0, '2019-09-10 04:47:01', '2019-09-10 04:47:01'),
(8, 3, 1, 'Bank', 100000, 'for stationary', 0, '2019-09-10 04:53:59', '2019-09-10 04:53:59'),
(9, 3, 1, 'Bank', 100000, 'for stationary', 0, '2019-09-10 04:53:59', '2019-09-10 04:53:59'),
(10, 4, 1, 'Bank', 100000, 'for homeland', 0, '2019-09-10 04:55:34', '2019-09-10 04:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `office_expense_tb`
--

CREATE TABLE `office_expense_tb` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `expense_category` int(11) NOT NULL,
  `total_expense_balance` int(30) NOT NULL,
  `delete_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office_expense_tb`
--

INSERT INTO `office_expense_tb` (`id`, `project_id`, `expense_category`, `total_expense_balance`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 501000, 0, '2019-09-08 14:54:14', '2019-09-08 14:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_order_detail_tb`
--

CREATE TABLE `payment_order_detail_tb` (
  `id` int(11) NOT NULL,
  `payment_order_id` int(11) NOT NULL,
  `receive_amount` int(30) DEFAULT NULL,
  `receive_date` varchar(25) DEFAULT NULL,
  `install_amount` int(30) DEFAULT NULL,
  `install_date` varchar(25) DEFAULT NULL,
  `payment_type` varchar(25) NOT NULL,
  `description` text,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_order_income_tb`
--

CREATE TABLE `payment_order_income_tb` (
  `id` int(11) NOT NULL,
  `payment_order_id` int(11) NOT NULL,
  `total_income_balance` int(25) NOT NULL,
  `left_amount` int(30) DEFAULT NULL,
  `with_draw` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_order_tb`
--

CREATE TABLE `payment_order_tb` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_order_tb`
--

INSERT INTO `payment_order_tb` (`id`, `code`, `name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'PO_001', 'for thilawa', 0, '2019-08-25 16:33:09', '2019-08-25 16:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `project_detail_tb`
--

CREATE TABLE `project_detail_tb` (
  `project_detail_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `transfer_type` varchar(11) NOT NULL,
  `amount` int(30) NOT NULL,
  `description` text NOT NULL,
  `remark` text,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_detail_tb`
--

INSERT INTO `project_detail_tb` (`project_detail_id`, `project_id`, `payment_type`, `transfer_type`, `amount`, `description`, `remark`, `delete_flag`, `created_at`, `updated_at`) VALUES
(9, 4, 'cash', 'income', 90000, 'for project income', NULL, 0, '2019-09-09 06:37:03', '2019-09-09 06:37:03'),
(10, 3, 'cash', 'income', 1000, 'ppo', NULL, 0, '2019-09-10 03:06:50', '2019-09-10 03:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `project_expense_detail_tb`
--

CREATE TABLE `project_expense_detail_tb` (
  `project_expense_detail_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `transfer_type` varchar(25) NOT NULL,
  `amount` int(30) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `remark` text,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_expense_detail_tb`
--

INSERT INTO `project_expense_detail_tb` (`project_expense_detail_id`, `project_id`, `payment_type`, `transfer_type`, `amount`, `description`, `remark`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 4, 'Bank', 'expense', 100000, 'for project expense', NULL, 0, '2019-09-09 14:46:33', '2019-09-09 14:46:33'),
(2, 4, 'Bank', 'expense', 100000, 'for project expense', NULL, 0, '2019-09-09 15:00:15', '2019-09-09 15:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `project_expense_tb`
--

CREATE TABLE `project_expense_tb` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `total_expense_balance` int(30) NOT NULL DEFAULT '0',
  `delete_flag` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_expense_tb`
--

INSERT INTO `project_expense_tb` (`id`, `project_id`, `total_expense_balance`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 4, 200000, 0, '2019-09-09 14:46:33', '2019-09-09 14:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `project_income_tb`
--

CREATE TABLE `project_income_tb` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `total_income_balance` int(25) NOT NULL DEFAULT '0',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_income_tb`
--

INSERT INTO `project_income_tb` (`id`, `project_id`, `total_income_balance`, `delete_flag`, `created_at`, `updated_at`) VALUES
(5, 4, 90000, 0, '2019-09-09 06:37:03', '2019-09-09 06:37:03'),
(6, 3, 1000, 0, '2019-09-10 03:06:50', '2019-09-10 03:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `project_tb`
--

CREATE TABLE `project_tb` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_tb`
--

INSERT INTO `project_tb` (`id`, `code`, `name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(3, 'P_001', 'MyProject', 0, '2019-08-24 10:43:44', '2019-08-24 10:43:44'),
(4, 'P_002', 'Homeland project', 0, '2019-08-24 10:44:00', '2019-08-24 10:44:00'),
(5, 'P_003', 'homeland project 2', 0, '2019-09-10 04:59:22', '2019-09-10 04:59:22'),
(6, 'P_004', 'homeland project 3333', 0, '2019-09-10 04:59:57', '2019-09-10 04:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_guarantee_detail_tb`
--

CREATE TABLE `purchase_guarantee_detail_tb` (
  `id` int(11) NOT NULL,
  `purchase_guarantee_id` int(11) NOT NULL,
  `receive_amount` int(30) DEFAULT NULL,
  `receive_date` varchar(25) DEFAULT NULL,
  `install_amount` int(30) DEFAULT NULL,
  `install_date` varchar(25) DEFAULT NULL,
  `payment_type` varchar(25) NOT NULL,
  `description` text,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_guarantee_income_tb`
--

CREATE TABLE `purchase_guarantee_income_tb` (
  `id` int(11) NOT NULL,
  `purchase_guarantee_id` int(11) NOT NULL,
  `total_income_balance` int(25) NOT NULL,
  `left_amount` int(30) DEFAULT NULL,
  `with_draw` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_guarantee_tb`
--

CREATE TABLE `purchase_guarantee_tb` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_guarantee_tb`
--

INSERT INTO `purchase_guarantee_tb` (`id`, `code`, `name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'PG_001', 'PG Number 1', 0, '2019-08-26 02:26:53', '2019-08-26 02:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `record_histroies_tb`
--

CREATE TABLE `record_histroies_tb` (
  `record_id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `account_head_type` int(30) NOT NULL,
  `transaction_amount` int(30) NOT NULL DEFAULT '0',
  `remark` text NOT NULL,
  `created_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `is_avaliable` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `pay_amount` int(11) NOT NULL,
  `left_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_head_tb`
--
ALTER TABLE `account_head_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_detail_tb`
--
ALTER TABLE `bank_detail_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_expense_tb`
--
ALTER TABLE `bank_expense_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_tb`
--
ALTER TABLE `bank_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_book_tb`
--
ALTER TABLE `cash_book_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invester_detail_tb`
--
ALTER TABLE `invester_detail_tb`
  ADD PRIMARY KEY (`investor_detail_id`);

--
-- Indexes for table `invester_tb`
--
ALTER TABLE `invester_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investor_income_tb`
--
ALTER TABLE `investor_income_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_detail_tb`
--
ALTER TABLE `loan_detail_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_expense_category`
--
ALTER TABLE `office_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_expense_detail_tb`
--
ALTER TABLE `office_expense_detail_tb`
  ADD PRIMARY KEY (`office_expense_detail_id`);

--
-- Indexes for table `office_expense_tb`
--
ALTER TABLE `office_expense_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_order_detail_tb`
--
ALTER TABLE `payment_order_detail_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_order_income_tb`
--
ALTER TABLE `payment_order_income_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_order_tb`
--
ALTER TABLE `payment_order_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_detail_tb`
--
ALTER TABLE `project_detail_tb`
  ADD PRIMARY KEY (`project_detail_id`);

--
-- Indexes for table `project_expense_detail_tb`
--
ALTER TABLE `project_expense_detail_tb`
  ADD PRIMARY KEY (`project_expense_detail_id`);

--
-- Indexes for table `project_expense_tb`
--
ALTER TABLE `project_expense_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_income_tb`
--
ALTER TABLE `project_income_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_tb`
--
ALTER TABLE `project_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_guarantee_detail_tb`
--
ALTER TABLE `purchase_guarantee_detail_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_guarantee_income_tb`
--
ALTER TABLE `purchase_guarantee_income_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_guarantee_tb`
--
ALTER TABLE `purchase_guarantee_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record_histroies_tb`
--
ALTER TABLE `record_histroies_tb`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `account_head_tb`
--
ALTER TABLE `account_head_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank_detail_tb`
--
ALTER TABLE `bank_detail_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bank_expense_tb`
--
ALTER TABLE `bank_expense_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank_tb`
--
ALTER TABLE `bank_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cash_book_tb`
--
ALTER TABLE `cash_book_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invester_detail_tb`
--
ALTER TABLE `invester_detail_tb`
  MODIFY `investor_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `invester_tb`
--
ALTER TABLE `invester_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `investor_income_tb`
--
ALTER TABLE `investor_income_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `loan_detail_tb`
--
ALTER TABLE `loan_detail_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `office_expense_category`
--
ALTER TABLE `office_expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `office_expense_detail_tb`
--
ALTER TABLE `office_expense_detail_tb`
  MODIFY `office_expense_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `office_expense_tb`
--
ALTER TABLE `office_expense_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_order_detail_tb`
--
ALTER TABLE `payment_order_detail_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_order_income_tb`
--
ALTER TABLE `payment_order_income_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_order_tb`
--
ALTER TABLE `payment_order_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_detail_tb`
--
ALTER TABLE `project_detail_tb`
  MODIFY `project_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_expense_detail_tb`
--
ALTER TABLE `project_expense_detail_tb`
  MODIFY `project_expense_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_expense_tb`
--
ALTER TABLE `project_expense_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_income_tb`
--
ALTER TABLE `project_income_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_tb`
--
ALTER TABLE `project_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_guarantee_detail_tb`
--
ALTER TABLE `purchase_guarantee_detail_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_guarantee_income_tb`
--
ALTER TABLE `purchase_guarantee_income_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_guarantee_tb`
--
ALTER TABLE `purchase_guarantee_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `record_histroies_tb`
--
ALTER TABLE `record_histroies_tb`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
