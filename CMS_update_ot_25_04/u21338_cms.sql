-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 29 2021 г., 17:43
-- Версия сервера: 5.5.68-MariaDB-cll-lve
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u21338_cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `server_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Студии', NULL, '2', 1, '2021-03-06 14:17:47', '2021-03-06 14:17:47');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_freekassa`
--

CREATE TABLE IF NOT EXISTS `gateway_freekassa` (
  `id` int(8) NOT NULL,
  `name` varchar(250) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `link` varchar(128) NOT NULL,
  `store_id` int(8) NOT NULL,
  `key_public` varchar(128) NOT NULL,
  `key_secret` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL DEFAULT 'Пополнение баланса',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gateway_freekassa`
--

INSERT INTO `gateway_freekassa` (`id`, `name`, `fullname`, `link`, `store_id`, `key_public`, `key_secret`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free-Kassa', 'Free-Kassa.Ru', 'http://pay.freekassa.ru', 0, '0', '0', 'Пополнение баланса', 0, '2020-11-06 14:50:06', '2020-11-06 14:50:06');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_paylogs`
--

CREATE TABLE IF NOT EXISTS `gateway_paylogs` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `money` int(8) NOT NULL,
  `bonus` int(8) NOT NULL,
  `system` varchar(128) NOT NULL DEFAULT 'Unknown',
  `status` int(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gateway_paylogs`
--

INSERT INTO `gateway_paylogs` (`id`, `user_id`, `money`, `bonus`, `system`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:53:41', '2021-09-21 17:53:41'),
(4, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:53:45', '2021-09-21 17:53:45'),
(5, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:53:48', '2021-09-21 17:53:48'),
(6, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:54:32', '2021-09-21 17:54:32'),
(7, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:54:52', '2021-09-21 17:54:52'),
(8, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:56:27', '2021-09-21 17:56:27'),
(9, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:57:26', '2021-09-21 17:57:26'),
(10, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 17:58:36', '2021-09-21 17:58:36'),
(11, 1, 5, 0, 'Free-Kassa', 0, '2021-09-21 18:01:12', '2021-09-21 18:01:12'),
(12, 1, 5, 0, 'QiwiPay', 0, '2021-09-21 18:01:57', '2021-09-21 18:01:57'),
(13, 1, 5, 0, 'QiwiPay', 1, '2021-09-21 18:04:44', '2021-09-21 18:04:44'),
(14, 1, 5, 0, 'QiwiPay', 1, '2021-09-21 18:06:00', '2021-09-21 18:06:00'),
(15, 1, 10, 0, 'QiwiPay', 1, '2021-09-21 18:16:09', '2021-09-21 18:16:09'),
(16, 1, 5, 0, 'QiwiPay', 1, '2021-09-21 18:21:01', '2021-09-21 18:21:01');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_qiwi`
--

CREATE TABLE IF NOT EXISTS `gateway_qiwi` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `bill_id` varchar(128) NOT NULL DEFAULT '89897819453',
  `key_public` varchar(250) NOT NULL,
  `key_secret` varchar(250) NOT NULL,
  `theme_code` varchar(250) DEFAULT NULL,
  `description` varchar(128) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `gateway_qiwi`
--

INSERT INTO `gateway_qiwi` (`id`, `name`, `fullname`, `bill_id`, `key_public`, `key_secret`, `theme_code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Qiwi.com', 'QiwiPay', '+79380250769', '48e7qUxn9T7RytykVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iP4xMtGhRwdX9C5XejEMrmUst1v6kdX1jG1ddNTHjP3emoF5jv5YXqPnZsepGREYe3AnhwUdb38pSewtCfQSQbN9DpmsT4A93hsjGSTEp4T', 'eyJ2ZXJzaW9uIjoiUDJQIijtykkF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6IjN1azF3dS0wMCIsInVzZXJfaWQiOiI3OTM4MDI1MDc2OSIsInNlY3JldCI6ImFhMDI1NzU2OGZjMGEwNzNkYzVkNWI2NDRhZWEzMjc2NjhhYjllMjZiNDRlZDc2NTYzZmY0MWNmMTczODA5NjkifX0=', 'Eduard-V21HUqrI5R', 'Balance replenishment', 1, '2021-09-21 18:24:48', '2021-09-21 18:24:48');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_transact`
--

CREATE TABLE IF NOT EXISTS `gateway_transact` (
  `id` int(10) unsigned NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gateway_transact`
--

INSERT INTO `gateway_transact` (`id`, `user_id`, `gateway`, `amount`, `user_balance`, `charge`, `type`, `trx`, `refund`, `created_at`, `updated_at`) VALUES
(4, '1', 'Admin', '7022', '0.00', NULL, 0, 'f80325ab7ab55642', 0, '2021-02-20 08:50:59', '2021-02-20 08:50:59'),
(5, '1', 'QiwiPay', '5.00', '3770.00', NULL, 0, '49eddd037222439f', 0, '2021-09-21 18:06:00', '2021-09-21 18:06:00'),
(6, '1', 'QiwiPay', '10.00', '3780.00', NULL, 0, '4c2d7560250ac4e0', 0, '2021-09-21 18:16:09', '2021-09-21 18:16:09'),
(7, '1', 'QiwiPay', '5.00', '3785.00', NULL, 0, '3b3bbb05d59b812e', 0, '2021-09-21 18:21:01', '2021-09-21 18:21:01');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_unitpay`
--

CREATE TABLE IF NOT EXISTS `gateway_unitpay` (
  `id` int(8) NOT NULL,
  `name` varchar(250) NOT NULL DEFAULT 'UnitPay',
  `fullname` varchar(200) DEFAULT NULL,
  `link` varchar(128) NOT NULL DEFAULT 'https://unitpay.ru/pay/',
  `key_public` varchar(200) NOT NULL DEFAULT 'key_public',
  `key_secret` varchar(200) NOT NULL DEFAULT 'key_secret',
  `description` varchar(128) NOT NULL DEFAULT 'Пополнение баланса',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gateway_unitpay`
--

INSERT INTO `gateway_unitpay` (`id`, `name`, `fullname`, `link`, `key_public`, `key_secret`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UnitPay', 'UnitPay.Money', 'https://unitpay.money/pay', '0', '0', 'Пополнение баланса', 0, '2021-01-04 15:10:54', '2020-11-06 14:50:04');

-- --------------------------------------------------------

--
-- Структура таблицы `general_settings`
--

CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_offline` int(4) NOT NULL DEFAULT '0',
  `launcher_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix_cmd` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pex user %player% set prefix %prefix%',
  `base_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_currency` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COIN',
  `game_symbol` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COIN',
  `exch_rubs_to_coin` int(4) NOT NULL DEFAULT '2',
  `vote_gift_type` int(4) NOT NULL DEFAULT '1',
  `vote_gift_count` int(8) NOT NULL DEFAULT '20',
  `gateway_use` int(4) NOT NULL DEFAULT '0',
  `reg` tinyint(4) DEFAULT NULL,
  `email_verification` tinyint(4) DEFAULT NULL,
  `email_notification` tinyint(4) DEFAULT NULL,
  `vk_client_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `vk_client_secret` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vk_redirect_uri` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vk_group_id` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '172494684',
  `vk_group_token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '290e6f14206f0082fedae22d1bc4547b67676b7a36cae75cee21d5199100d045dd2e0afe3bdfd3fc15cf9',
  `vk_output_count` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
  `launcher_link_jar` text COLLATE utf8mb4_unicode_ci,
  `discord_server_id` bigint(20) DEFAULT NULL,
  `currency_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_admin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_message` longtext COLLATE utf8mb4_unicode_ci,
  `header_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_desc` text COLLATE utf8mb4_unicode_ci,
  `services_discount_status` int(4) NOT NULL DEFAULT '0',
  `services_discount_percent` int(3) NOT NULL DEFAULT '0',
  `services_discount_datetime` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sw_exchange` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_ratings` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_banlist` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_kits` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_prefixes` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_shop` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `invite_percent` int(4) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `description`, `site_offline`, `launcher_link`, `prefix_cmd`, `base_color`, `base_currency`, `currency_symbol`, `game_currency`, `game_symbol`, `exch_rubs_to_coin`, `vote_gift_type`, `vote_gift_count`, `gateway_use`, `reg`, `email_verification`, `email_notification`, `vk_client_id`, `vk_client_secret`, `vk_redirect_uri`, `vk_group_id`, `vk_group_token`, `vk_output_count`, `launcher_link_jar`, `discord_server_id`, `currency_rate`, `e_admin`, `e_sender`, `e_message`, `header_text`, `header_desc`, `services_discount_status`, `services_discount_percent`, `services_discount_datetime`, `sw_exchange`, `sw_ratings`, `sw_banlist`, `sw_kits`, `sw_prefixes`, `sw_shop`, `invite_percent`, `created_at`, `updated_at`) VALUES
(1, 'MCSTUDIO', 'Игровой проект Minecraft', 0, '/MCSTUDIO.exe', 'pex user %player% set prefix %prefix%', '777777', 'руб', 'рубл.', 'COIN', 'коин.', 100, 1, 20, 2, 1, 0, 0, '29463522', 'SjhIA5W4GipmTGmR3lPV', 'https://mcstudio.su/login/vk/auth', '29463522', '205cb03c205cb03c205cb03ce42028fa042205c205cb03c7f21296d5554d20042ede9cc', '6', '/MCSTUDIO.jar', 1, '77.73', 'admin@mcstudio.su', 'no-reply@mcstudio.su', 'Hi, {{name}},\r\n{{message}}', 'MCSTUDIO', 'Minecraft project', 0, 5, '2020-05-30T12:30', 'true', 'true', 'true', 'true', 'true', 'true', 5, '2018-06-04 00:06:40', '2021-09-29 14:43:39');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` int(8) NOT NULL,
  `category_id` int(8) NOT NULL,
  `item_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(32) NOT NULL,
  `price` int(32) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `server_id`, `category_id`, `item_id`, `count`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(17, 'MCSTUDIO', NULL, 2, 5, 'MCSTUDIO', 1, 10, 'b620c16ff6af1867a2cb2c4e43414246.png', 1, '2021-03-06 14:18:15', '2021-03-06 14:18:15');

-- --------------------------------------------------------

--
-- Структура таблицы `kits`
--

CREATE TABLE IF NOT EXISTS `kits` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` int(8) NOT NULL,
  `server_cmd` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(8) NOT NULL DEFAULT '1',
  `price` int(32) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `kits`
--

INSERT INTO `kits` (`id`, `name`, `description`, `server_id`, `server_cmd`, `count`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 'test', 'Набор ресурсов', 2, 'test', 1, 10, '7b1a5cb2011e9d4d22a2918b2b6d0ae6.png', 1, '2021-03-06 13:37:40', '2021-03-06 13:37:40');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_28_181913_create_sessions_table', 1),
(4, '2021_03_06_131209_create_promos_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `status`, `created_at`, `updated_at`) VALUES
('admin@mcstudio.su', 'LVmJcy6RVkkoRpEsI8HnQ4ZmqgSCvj', 0, '2021-02-28 15:07:05', '2021-02-28 15:07:05');

-- --------------------------------------------------------

--
-- Структура таблицы `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `server_id` int(8) NOT NULL,
  `term_days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30',
  `skin` int(4) NOT NULL DEFAULT '1',
  `skin_hd` int(4) NOT NULL DEFAULT '0',
  `cloak` int(4) NOT NULL DEFAULT '0',
  `cloak_hd` int(4) NOT NULL DEFAULT '0',
  `prefix` int(4) NOT NULL DEFAULT '0',
  `price` int(32) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `display_name`, `description`, `server_id`, `term_days`, `skin`, `skin_hd`, `cloak`, `cloak_hd`, `prefix`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'vip', 'VIP', NULL, 1, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 16:37:31', '2021-09-11 16:38:38'),
(2, 'premium', 'PREMIUM', NULL, 1, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 16:36:37'),
(3, 'vip', 'VIP', NULL, 2, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 16:36:52'),
(4, 'premium', 'PREMIUM', NULL, 2, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 16:36:57'),
(5, 'vip', 'VIP', NULL, 3, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 16:37:45'),
(6, 'premium', 'PREMIUM', NULL, 3, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(7, 'vip', 'VIP', NULL, 4, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(8, 'premium', 'PREMIUM', NULL, 4, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(9, 'vip', 'VIP', NULL, 5, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(10, 'premium', 'PREMIUM', NULL, 5, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(11, 'vip', 'VIP', NULL, 6, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(12, 'premium', 'PREMIUM', NULL, 6, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(13, 'vip', 'VIP', NULL, 7, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(14, 'premium', 'PREMIUM', NULL, 7, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(15, 'vip', 'VIP', NULL, 8, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(16, 'premium', 'PREMIUM', NULL, 8, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(17, 'vip', 'VIP', NULL, 9, '30', 1, 0, 1, 0, 0, 150, 'vip.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(18, 'premium', 'PREMIUM', NULL, 9, '30', 1, 1, 1, 1, 1, 350, 'premium.png', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `promos`
--

CREATE TABLE IF NOT EXISTS `promos` (
  `id` bigint(20) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `sales` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `promos`
--

INSERT INTO `promos` (`id`, `code`, `desc`, `type`, `value`, `active`, `sales`) VALUES
(2, 'SKIDKA10', 'Скидка 10%', 2, 10, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ratings_settings`
--

CREATE TABLE IF NOT EXISTS `ratings_settings` (
  `id` int(10) unsigned NOT NULL,
  `vote_gift_type` int(4) NOT NULL DEFAULT '1',
  `vote_gift_count` int(8) NOT NULL DEFAULT '20',
  `vote_gift_kit` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'kit vote',
  `link_mcrate` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://mcrate.su/project/ID',
  `link_topcraft` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://topcraft.ru/servers/ID/',
  `link_minecraftrating` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'http://minecraftrating.ru/server/ID/',
  `secret_mcrate` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'secret_key',
  `secret_topcraft` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'secret_key',
  `secret_minecraftrating` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'secret_key',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ratings_settings`
--

INSERT INTO `ratings_settings` (`id`, `vote_gift_type`, `vote_gift_count`, `vote_gift_kit`, `link_mcrate`, `link_topcraft`, `link_minecraftrating`, `secret_mcrate`, `secret_topcraft`, `secret_minecraftrating`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'kit vote', '1', 'https://topcraft.ru/servers/11386/', '0', '1234561', '6334b39fc07e2a021e1b61818124b2e5', '0', '2021-01-04 14:52:57', '2021-09-26 10:43:24');

-- --------------------------------------------------------

--
-- Структура таблицы `servers`
--

CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(16) NOT NULL,
  `name` varchar(32) DEFAULT 'Server',
  `description` varchar(250) DEFAULT 'Description',
  `ip` varchar(128) NOT NULL DEFAULT '127.0.0.1',
  `port` varchar(8) NOT NULL DEFAULT '25565',
  `online` int(8) NOT NULL DEFAULT '0',
  `slots` int(8) NOT NULL DEFAULT '0',
  `max_online` int(8) DEFAULT '0',
  `mysql_host` varchar(128) DEFAULT NULL,
  `mysql_base` varchar(128) DEFAULT NULL,
  `mysql_user` varchar(128) DEFAULT NULL,
  `mysql_pass` varchar(128) DEFAULT NULL,
  `mysql_port` varchar(128) DEFAULT NULL,
  `mysql_table_bans` varchar(128) DEFAULT NULL,
  `mysql_table_coin` varchar(128) DEFAULT NULL,
  `mysql_table_shop` varchar(128) DEFAULT NULL,
  `mysql_table_pref` varchar(128) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `servers`
--

INSERT INTO `servers` (`id`, `name`, `description`, `ip`, `port`, `online`, `slots`, `max_online`, `mysql_host`, `mysql_base`, `mysql_user`, `mysql_pass`, `mysql_port`, `mysql_table_bans`, `mysql_table_coin`, `mysql_table_shop`, `mysql_table_pref`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SandBox', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(2, 'TechnoMagic', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(3, 'MagicRPG', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(4, 'HiTech', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(5, 'HardMagicTech', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(6, 'Majestic', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(7, 'Wizard', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(8, 'Technology', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00'),
(9, 'Pixelmon', 'Description', '1', '1', 0, 0, 0, '1', '1', '1', '1', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-09-11 18:00:00', '2021-09-11 18:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1JXtKOnbDjcoqYFcYwnPWqJZtUYjLECN39QtIbAH', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJalUwWld4UllXbFlVMDFEZURoUGQwSnhRbUZSY1VFOVBTSXNJblpoYkhWbElqb2lWVnBWVFhaNmFHdExkekZpY0hkdlYzZGxaMVEwUmpOVU4xcE5NMFEzTkZoRU1FNVlVekpNYlVjdlpVMUZRbWREWkRWRFVWVk9ObVV5UlRRNU5FNWxaalU1TWs1cFZqZ3ljRzg1TUdOWVJuaFdSMFozWVZGM1ZVZ3lNekZrTjJvNWRHNUZVM1ZLTUVOSk4zVXhUVEpQZHk4eVQwWXZlVUZ0SzFsMU5saFhXWGxHZUhWdlNXZ3hWelJ4ZVVoU1kwUnBTemx2TUVsU1lsRk5Ta0pUU0VWNVlWQjFVRFJNZFZaeVpTdFpSVmRETTNkak1WcFJTbFpGZFROVGMyOTJNV0phY2pZNVdpdFZaVFJJTlVwT1ZtSmFSMW8zVFRSU2JWTjNZVVo1UTFkbFMzRkhVWGh6YlVWbE1HWlBUV3h0VldrM2IwMWpXREJMYlc1MVl6QldVbVZFYTFSUVp6VjNTbkl6VEhwQldFZzBOWFJwV1V4TE9YYzlQU0lzSW0xaFl5STZJamhqTVRFellqVTNaVEl3TnpWaVlUZGxaRGRoWVRCbU4yRTBaVGd4Wm1JNVpUTmhaV0ZqTXpJMk1UbGxNell3TWpBeU9Ea3daVFF5Tm1SbFltTTBOVGdpZlE9PQ==', 1632925681),
('2CFIeVCj2aaMWHpIu49O3NtgoiEZ8NCqZ9BrkFjj', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbE5wUzNCRldUZHZSMFpFWXpGbWQxZDBlRWRLTDNjOVBTSXNJblpoYkhWbElqb2lMek5NUVU1d2NHTkhUVTFJYkRsUlZqVjJSelY0VnpKemNTdFZZWFJ6ZHpreGN6Rm1ZM0JwTm01TFp5OXVkazVTUjFKWVJURnBSVmRsTmtOMFdYWTRWVGRTWVM5dGJsUmFka2RaVnpjM1luVlJPVU0xVWtaYVprcHBVV1JxZURaeWMxRnRPWEJMYUdnMVVUSmlVVEZLVTFoRWRVWjZPRVJoZW5abVFURXJUM1JIU0dKNU1GbDBNRlJWZUc4ek5rWlJPVVJXV0RremVWSmpNMlZKV0ZJNFdHdE9hR0oyU1Rsb1dFWkdNamhIWm1GVFdHbEhNRVF5WVc5aWRHdFJVSEJJYld4blUyZEVUa0p5VXl0UVV6WmhSbTFSWjJoRVZGTmlRVVphWmxCQlNrNWxjblpKWmpVeE9DOXdTSGRNVUUxT2ExTldVazVsTm1wNmRHaDFVM1JRZVROdFRFRjJNVEJaZG14UFdubGpjRkpvVFZKTWFIYzlQU0lzSW0xaFl5STZJbUZsWWpBNFl6SXlNamRqTmpRd01EUmtPVFF4TWpRd05qZ3pNV0V5TURCbU1EVTVOakUzWmpJMll6QmlZelV5TnpOa1pqZGpZV0l5TXpneU1qWTRPV1VpZlE9PQ==', 1632925742),
('4fI76lXOxzByy2MWp4L14eZne45bESKsmBgSnmHW', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJa05pU205NlRtUm9Wblo1U1ZGNlFVMHpiVmRsVlhjOVBTSXNJblpoYkhWbElqb2ljMkZJTkdSVVlYZGpkaTlOVms5M1kxcFdSbk41UW5Jd1VWQllNMlZ2TWpSWmFIUkxaeXMxYkV0aWRtbzJaVmgzTms5SVptcGpRVlpYVlRKcVlVRXdSMFoxY0d0WmNHdFRUa1l6UVhKdFYzcE5jSFJ2YjNsRGVISmtPR3A1T0V4elNUSkJVVkY1TlN0YU1rcDNXamRpTkVrMFNIaHBTMUUzU1dGR1pTdEJLM05MUTBGbVZHSXhRME5RVG5ReGNGZzVha3htV1hNNVVXWTVZVUpqZGpkRFZHUkJTbTkwUkdJdmFEZGxjVFprU0c1cFRYWmpSRmx0UjJJMldGcGxVbEpRV21SV1NIRlpUMnRqZEdSV2FGcHVkVGhzVjFGTmMxbGhabFpRV2taTlEwRkNWVXcyVkZaRFpUVjRjMWN4TTFKQlREVktRbkoxU2paVGFqaFZhRVZoY1U1V1ZsWnVXV3g2UjAxV1NHcFpTbGd4UlV4Tk5YYzlQU0lzSW0xaFl5STZJbVpsTURWa09XRXpOekk1WlROa1pqVXpNams0WWpRd05XWTFOREl5T0RVNFpqa3hOREZrTkRVNE1qYzJOemt4TldWbU1XUXdabVZqTXpaaE9URXdaVFlpZlE9PQ==', 1632925501),
('4NpnWgTlPLlX96NEohH3YLbRdvuPRLatMiZXONeM', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbmdyTW5KeGJHeG5ia1l6Tm5aTWQxUjNWM295Tm1jOVBTSXNJblpoYkhWbElqb2lXbFZtZFhOd05rUlVkalJIV1ZscFZIcGlibEY1Tm5KTlUwSnFaekU1UnpaR1kwRXpNVUZ5Vm1WQlNYSXJUazg1WVZkMlluSXZaRFYyT1U1c1UwcFhLeXMyY1ZCaU5VMVFVSGhNVVZGV1UxUTFkbmxzVUZwU1N5dHNLM1pWZVV0cmRqVjJlazV1ZGs1U2FXeEpTVkpwYURoRmFVRXdkMUJWTm5kMVQzbHFPWGRPVVVwa1VrTm5Sa013UTB4bGFHRkVaRGxUY1hWblRtcFZUWHBKU0ZWclZITkhPR3BKV0Uwck4zTTBWa1owTjFwa2NVUktLekZYTm0xa1RHVktTbWR6YlRNMEwzWTBRMjU1Ym5veVExRlZVV3gwVEZrNU1qUm1aMEp1VWxsU05VaG1kelpEZWpBMk5Hd3ZkelIwUnpGT056ZHNOV2xKYldSTmVVb3pRbTVNWTNGWWVYQlpOWHBvTTNCUFlXODRaalJ3VjA1c1VFRTlQU0lzSW0xaFl5STZJak0zWkRBM1kyTXdaVEk0WWpSalkyRTROek5rTnpZelkySTJZMlEyWW1SaFpEZGpNVGxqWVdGa1pEZ3lNamczTlRGaVl6ZzNOV1k0T0dWaVpERmlZbVFpZlE9PQ==', 1632925802),
('7HFYul5Vceif3wLy135tHy8iwyCu6jF5xRsPL7D7', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJa1pHTDFSTFEwNU5WRGN6YjB4eWNHdHRiVEJrYzBFOVBTSXNJblpoYkhWbElqb2liMk5KVHpaVFVUSnVZbEpNWVhWMVFrVjFhSFJrY3pRM1ptUlpLMmhTU0VwaGVHdDRiM2cxTWpnclNsbENTM2RXT0RsaVYyaGhTVEpCZW05S1lUSm5TbEZyVlUwclVHODJlWHBvUWtRelN6Rk5OMVZTWnk4MFYzQjJSbUpvY2taQlZHVTBSRTVTTTA1elJ6TmhRWFZKVVdVdk5GVk9hR3g2VUZOaVIybHRTalZ0TVRWamFWUnRjMjh6YUV4U05HVkdNVWRoUWpORE0yeEdWREJrTlhJNVUxUTVWRW92ZGl0amVWZHFZbGRPUTNaVGRXSlNkRVp0VUdKSldqTk5SMUpQY1doTFJUWTBja053TTFWQmJIWTRPR1EwYUVoWlFuQndVM1pHUjBaTlVITjVOVEYxTldaMFkzcHNVRzA0UkRGQ2NGcDRTM2hMVERWTk5VcEhLMUpIZVhCd1JsQlRWMFEwUVhWNFQwMTBkMEpFUVdobFUxRTlQU0lzSW0xaFl5STZJbUUwT0RNMVpqUXdPV0ZqT1dRMk4ySXpZakJpTmpaaE16QTJaakZpWVdZeFlXTmpaRGRsTjJaa04ySTBPR1UwWVRVeFlXWTFOMlExTW1JME5EUTJORFFpZlE9PQ==', 1632925382),
('7oL6ZrZ6hZtDUQbWowvfprdUUdmcg4ZAXO8NGCmu', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbGxYTjNscFZHWTRaMk5wWkZsbWJWcDNiV1Z5TTFFOVBTSXNJblpoYkhWbElqb2ljMHBIUTFCcGNFNXBObTUxTVZaM2NISnpkVWRDTjFkMWJFbHlUMHhaZFRaTFZYUndjRTVEZGt4ek4wTjZVRlJGUmtoaE1sazJSVFpwVUZwRVFVZGhUbkp2VjBaT0wyZEJWVzVEUzFwWlZWbzViV0pzTkV4eU1DdFFXbEpSZUZJd1lVdzROamxLUzI5UWVYRTFUbXhVWVVkclJXOWlUbVIyUmswdlVFZHRPVmxZZEZoRU9IbzFObEZZTlVnMWJUVjBUelJLU2xaMUwyTlhZMGczT1hwMlZWaGxiek01UjBWSlZHTndlRVZFTVRVMlEwWXlWRlJHVUZoV1VXTlVaak5tY2xCcmEwSlFjV1ptU3paa01IcE1hRTlOUXpWc1RtZElVVGRSTDFOS1VuTjJiblp6TnpaNVoxVlZUbU12UlZCcmFXOUxRM2w1ZHpVclN6aGpOMnRSWmtaVWFtdFBUbUp5YURCdVZEZDNibWxvUjFGTmVHYzlQU0lzSW0xaFl5STZJamxrT1RBMk1qa3dOMlprWVRaak5EUTFPVFF3TW1Rek5qSmlPRGN4WWpNMFkyRmhOell4WVdaaVpEVTFaalJqWlRNd01qTTBNVGt4Wm1ZeE1qUXhZVElpZlE9PQ==', 1632925321),
('9AW1N27qawT3vDZtFKlsGohsFwDOw1JsxOHNdkD5', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbFJ4WlNzM2VHSkZhRWxZY2tSeVdrWmhTV3hyTUdjOVBTSXNJblpoYkhWbElqb2lNbXhMYW5ORVppOXdkVkpSVTBWRlZ6bEpRakZ5YlRrNGRteGFPVVJzVFhsaVdqUnJPVEpLTmpabmRVVlBSbkozY0dwSWVqbEtWRU5VTDNoSWNVWXlZMWRuTDBaT0wyMWhTamxVVUV0cU1WTmFXVkZTYm1keksxTjZURXhXYlZKb09ETmhRa0ppTkhsVk9IUXdjbFJ0Wm1jeWRFaFFaMjlhVW1kcVdHaHBlVlZHU0dKSk1qVjZaVmh1YlVGek5HczVWbkZ1VVV4bmJrMVZOVkpIZW01NE1HUXJVbVowYmtJMWJVSTBaMGR2YUdWaFJVVkVXVU5pU0dRMFNWTlJRVXRvUzBoc1MwVmlRVEZGVTFkRWNsZFZLemg2WjB0NmFEUjRlWE54ZDBGTlFuZEJOR1Z5YUVwclYzaG5kazlyTHpsTlZqRXlTSG93YUdKRFpVRkxUWE5sYkU1U1ZtZHNTSE5HVURSUGNVSkNlRXh6Vm5SU1ZsRTlQU0lzSW0xaFl5STZJakV6WldKbU1qYzBaR0ZpTURJNU1tTXhOV1JtTkRRMlpXSmxOVGM1T1dNNE9XUmpNVEkwWkRjNFpqazFaV1E0WVRBeE1UTmpaamhqTmpGaVlqQm1NemdpZlE9PQ==', 1632925802),
('a2EIHeJ0y64ciTuEXoq7z5nlYkJkDv9RuXkLLcos', NULL, '46.174.50.5', 'Wget/1.14 (linux-gnu)', 'ZXlKcGRpSTZJbFJ4U1hCalJFOUtNVVpGUmtFNFJtdEVWbUp2V1VFOVBTSXNJblpoYkhWbElqb2lXV3hDUTJ0elJHUlhVamN3YzNZeWFtRkJVV2xqYmt0blkybElkMFYwTjNZelR6TmxSbVp4U1dkUlQybDVhMUpaTVVWdVQzWm9ibVJoV1dOUVRqWldTMXA2V0VocFlqTm9Va013UzJFM01YUjFPREJHYjJGTmVYVm9hR0ZEVVVVMWJFcFNkU3RFYkhvMVRXbG1XWFp2Ulc5TU5DczJjRVI1VmtkaFJYWkxVVnBMYXpOMlJGQkJjblpTSzJsYVIyOVVkV0Z6YlN0U2RsZENiWGhuVkV4a2FDczRaR2xSUlRSeGF6aDFOVlZOZDJNNGVGYzRUbXhqZEV4Q1FtMW5ja2c0UVVvM1FsSm9OQzlCZG1WNGJYQklUWGRSTVVoeEwzVnZMeTlGTUVGS1VHZFViVmsxTDA0clVIQXlkemRvYTJsNFlWRnBjR0ZKVEZWelJGbE1NVk14Vm5Ga1NVRldWaXRZYkdreGNHbDFSMGtyYVZKRFdtYzlQU0lzSW0xaFl5STZJbUl6WlRBelpXUTJNekZsWlRnek1qbGlOelZtWkRJd04yWm1ZV1UyT1RrNE1ETmlNelpsTmpKak1UZzJNVFpqT1RVellXWmhNalExTnpSaE5qZGtaVFFpZlE9PQ==', 1632926582),
('AamtPQPI0I557XkH5CKdK61erzWAkNvvm4kGAwlu', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbkk1VDI5dVZqZHllbFZ5YWxkSE5FY3laRFpRV1djOVBTSXNJblpoYkhWbElqb2lRVzFaWmxOMmRrZDRXR04xWlc5MmNHeFlhRlJUZFROUmR6SlBlUzlsYkdsbWEwRTJXakkzYmpkYVluTjJUbVo0UW5KT1ZUVTJNM1JSYWtWVk4wRlFOWEJSTVdsblZrWkhkMU56VHpWcE4wZE9TMjlKU0hSdVVGQndhbkpqY0d0TU0xZGpVMGhwT0RCb1FpOUxVVVpHY0ZGaVFraFplalpvVW14TUswMXVlV2h5SzBaUE9EZFljRWxhTDBsUE9HTnFRV1UxVVhVcmFFaEhOemxqY1hRNU1pdHJOM2hOUVdWUk0wTnhSMlJPWXpKMlFtTkVkbkI1ZHpaM2RteGlPRTk2YWxSM0x6TXpTM1psTlVKWmNVdFRTR2g1Wmpoek1XWTVRbUpuYUVWTGFtOU1SWEZuUmxGWU5IZzFaWGhrTTIxdkwwNDBlR0Z2ZEc0NWEyRnljbVJMVkRFMWVraGxPV2t5TXpkTlQwcHJVbUpKT0VkbGNrRTlQU0lzSW0xaFl5STZJall6Tnprek9UQXlaR1kzTnpZeFpqaGxOREZoTkRRMVpUQXlNVGMyWWpZMlkyRmxNV1l5WXpSaU9XRTBZV00yWldWak9HTmtZV1poTmprNE5EZGhNVGdpZlE9PQ==', 1632925321),
('aH223D8C8lhVC8OiV12DvufhjXSO8wZJPhUb07lC', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbHBMYjFwWFMzbFBUMlp6U0RkVk5sWTJiRXhRUmxFOVBTSXNJblpoYkhWbElqb2libXh1SzNKV2FXZHhSa281UmpoVVZFSkRhbE52VGtWblUxbGxNRVl3UjJ4NUt6aGxSSE5JZGk5a01rbG1NMHMxYzNwaWVqQjZhbmMzUTNWUGQwMUpSbmhVV0U1VlNtMXZRV05tV1ZaNk9HSlZiR2xFTjAxM2NVTkNUM280Y2toUlFVZFZjbVZYTldFcmEwdHNaM1phYmxwa05XOXRUMFZQVUhkUFIyMDNVa05ZU1hKUFNEaG1jV0ZUYkhVMFNHZFRXblV2ZUc5UU1rRk5MMHB6TUVsT2FtYzBSbVZUUmxGRldrSnRRVUo2ZHpCSGVqTTRRakZzYkV0UVVqVXlabTl2VjNOUFJGVTVMMkpUWTFOTWRWaHVkMDk1VkRGc2RqUTFla2N4VWxwV1ZuZHhXRU4yWkd3eVlVVlRaMUV6UTBOSVlsbEtPR0pGTDFZMmRFRkZNRk5vTjIwcmFIVlpiM2QxZFU1amFYSk1UV2xrZURONFRIYzlQU0lzSW0xaFl5STZJakZtWWpRM09ETmtZV0kzWlRGalpHRmxNREl5WkdFd1pUQTJNamd3WkdZeFlXVTRPR1V6TXpJME1tRXlZbVUyTkdNM00yTXpaVE5qWkdJeU9URTJNV0VpZlE9PQ==', 1632925742),
('baG4Fi49NCg8P95smbj3VXXvNfXIPlm91pqkcfEn', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJazU1VW1kSVoyeG1RMk5aUzFWWVVIZ3lWV04yWW1jOVBTSXNJblpoYkhWbElqb2lWVlJXVHpSVEwyVkhVVzUzUXpnd01EbEplbmhrVlhOSU4yVkJRVWxFYzNaSlRIcEpTMXBwZUUxeWFsQnJSbEowWkV0MFF5dDRRa2MxUkRjdmRYTmFaQzlWWW0xNGIycDNaeXRhYjI4d1dTOVhaVWhFWVVKQ1FVVnFWekV2U0dGUGFUUnVOV2c0T0VocGN6bE1Wa0pFYm1wVVIxaElhVkExVTNKc1JXcHhjbWRDYVhseVdYUjBZbEZpYVZGWVNXcDFRbm96UlhreE9DOVlOa2h4VldkcGVpOUhkR2hhUVhwWk9ESmFSa3g1VURaRWFVNUtiblUyU0ZGTlUyNUZTRGxYZGtOMGNXZFdSbXd3VTNFMFpFNWlWa04zV1RKVE1uQktkRlp2VmpNMFdFdG5aRFl2T0VjNEszWjZNa3RMUkZOV1NEaGhObEZCWkhCM1VXNXpTbXAxZVdWbk5WSmFVV0kwY0dGR1F5OTJVblJFWldjelJWRTlQU0lzSW0xaFl5STZJbVppTlRGaU16TTRNREUzWlRoa1pUZzNNbVZoT1dJMk4yWmhabU0yTVdaaVlqTXdNemcwWmpWaU5EWTJZVGRsWVRaak5EaG1aVFEzTlRnNE16YzBOakFpZlE9PQ==', 1632925681),
('BGMMGilY5T1gpQqcv9bUMfuKFgpGn9R7er4GGkPV', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbU00WTJsc2JIazBURWRITWsxck9HYzJaMFZpTTJjOVBTSXNJblpoYkhWbElqb2lhRXcwTTBnck4xWnBhWGh0T0hWS1RucEhZMHdyVG5velJGUkJTRXAzVTNaNVkyUm5ZbmxhVWpKUGNHVTVkMmRCY0V3cllWRnVOakJpT0M5UlpIcEpaV1pDYVZkMWRXVlJNbUp3ZW1GeGMyTkhNM0ZoY0ZGVFRUWjBiRXd3ZW10NVFVUldSakZUTVVkWlJEZFVUakJoYUVRMVVYaGpWMjFSY1VGNmJYWjZNekZtYTBWcGNYaGtjVkp4U0hOYWNDdG1RbWgxUkV0Q2NtNDNkMHc0VkZNMlZEbGxUVXhJVVRGUk1rMVNlRnBPYjFoRWNVbEZOalpVYVZkVWJFRmtSVXB1TmxSMVRrcExSWE5wVlM5VlYyZEpURXhsZWxwMWMwOXRhelpPYW1oWVdYZG1aMnRYTlM5TFlUSTJZWEJxTW1velYxRjRTSEZXZWxGa2MxbG5UbFZGUW5Cb1ZERm9ZVk55WVV4blMzaHlXSEJhUjFaVVkwRTlQU0lzSW0xaFl5STZJamRpTm1FellqTmhNRGt4TURVd05EZGxaakZqWWpBd05UUTRNemt4TW1KaVlXTTBOalUxWWpobU1HRmxOemhsTjJRMlpUWTNNVEpoTkRoaVlqZzJORGtpZlE9PQ==', 1632925862),
('cfnhrkpKFMdXRYlEPjUV3Q3uB723CtvZrTaVUJbI', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbFpoWjBNMWVYTnJiVVk1UW1JdlR5dHZWR3NyTjBFOVBTSXNJblpoYkhWbElqb2lkVVV6ZGtaVGVHUlFjRFZvU2psMGNubGpVR1JuTVRsdWJsSnhhSHBETVVkeWNFeFJOMXBzUkM5NGQzTTFTWEZwUVVoMlVrWnVaRFkxYUM5dlprbEZSeTlUZVhaMlRFaFZXRGhwVWtWa1JEaGlSalJDU2pGdVRrWm9TbU40TldGbWJpczVUbXhpYlV4SU5HRXZka1oyZURaU1pTdFRjakIwVGtnelNGQk9WaXMzV0VOaFJ5OHdlR2s0WWpCWlRrNVBNRGhOUjFGRFprRXpRamMxVDNwb1QzWmFiMWhOU1hWRVZFRXJZWE13SzBGcmNrZzBOelZVWXpsblZYUnFUWFF6VFhrelNrSTVPWFZWZFU5R1lsTndjRVZxUnpOYWNIZGFTMUpIU1RSVGJXYzVjWEJYY2xWMk5ubE1UblpuVFZCNVoyazFOVmhGY1RRdldHeHZSazVoVmxneFdXY3dNREIyYjNwT1J6aFJhMDUzTlRGWlZXYzlQU0lzSW0xaFl5STZJbVEzTlRVMU1EWXpNRGt4TVRrME16UmxOVEF5T0dZM05tWTFaamRtWkRWa1kyRmtaVFZoWmpFMlpESXdOR1ZrTURObVpUazBOell4TXpVMk1XSXpOV01pZlE9PQ==', 1632925861),
('cLTQAPcFcHvAX06rphPRaGuaatYJSOdOtfNlllnS', 1, '109.124.211.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.82 Safari/537.36', 'ZXlKcGRpSTZJalJ5ZEhjclV6azFiRTR4Y0VGdU5FeDNiR2xzVEZFOVBTSXNJblpoYkhWbElqb2lSRk12TUhoamNXaHBlVTlsWjNGUmNVbERNWEZyTjFwS2VFSnBSSHBWVERoMVZUaHdPVkIzTDNSM04xTnhOSFJEWTIxVVZscFVTR0p5VFdoSk1sZHVORTF3WlhaQll6VnZkRVpLVmpsVWJGcGljbWxwZDNjME5FMXphVXBPVjJaa1VuZFRNblJWVkhwaGNtb3lTemd2Y1cwcmVuZG9WbGhhZUhGMWNHaE9NR2cwZVN0VlNYRkZOa3hCVFhWVlkzQk5aWEZTVjFnNVJXMUZVVTAzUTJaWlpYY3lWR3BOWWpWSFpqRjZRV2RYVG5OWFVXSTBjMDR4TUc1TFZWSXliRVJSVFRSQmRHOVZTRGcyTWpKdUwwVjJPRWxXWTJGa2NFdzFkMGhJUldaSmRHVkZXRm95TmtJNFlYWldhVUp2V21OS1lrVllibmwxUVVwbE0xSm1NM2xtZEdFMVpFbE9kelZFYjFoNFFqSmhhbWxETXpkMFVGcFJlV3RaUTNsR2QxRk5aemxCTVc0dmJDOVBlR1p1UXl0ak5YRmphWEZxZVd4WFltTk1iVmxFT1hWeUwwRlVObEZoUVhoU01UaHdabTVwTTFCdllYVjNQVDBpTENKdFlXTWlPaUpqWVRsbU5HSTNPRFEyTW1WbE5tRmxNelk0Tm1KaU1EVXhObVppWlRobFpUQXpOVGczWmpWalpEUTRPR0ZqTm1FM056YzJNakkwT1dFM056VXdNbVJoSW4wPQ==', 1632925854),
('dXT17OfyVYNDXmmKHNdj8YWVVmh7xiOzy9mrpGFh', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbEJxVURoYVRtOXRUbWhNWWtaR1R6SlRSRWRYUjBFOVBTSXNJblpoYkhWbElqb2lja1lyV0ZsTk9VUnpWRlpwV0hKb05DdERVa0V4ZFVJMkwyRjVhMk13VkRKMmFIbHlVRWxRU0ZkMlVWUnBiamN6UlU5S1psaDVTVlZDTkVwUk1WZExjV3BQYTNOM1RWZDFVSGRtTXpSeWVIaG5UVVZvTUdsNFEwZFVWVlpZU1hOSFJDdHBhakJGWm1oelNDczRjM0ZtTWxnM2RITkhlVkZqUTNGQlJXTllNbkkyWlcwNVpXVnZPVXB6Tm0xc2JXNDBSRmg1YzFGbFlWVnZjamd6Um0xSksyRk9NWEJ3TkRSNU5HTkpXR1J1TWsxS1puSm1hWEprWVVWUFRHWlJkazFtUVZCSWIxcEtiak0zWTBKVGVFTkdkV2dyUkd4bk1HYzRjamRIWkZVNFluWXplR3RYU0VVMmVsWmxOaXRrUVdod2JERmFlSHB1ZVhaV04ydERaRUZpYW1KR0wyWklTU3RoZUhKcmNrcFlObHBNYkcxRVVHYzlQU0lzSW0xaFl5STZJakZoTXpJeE9HRXdOekptTURoaE1URXhaVFppTURVeU1XVmhNbU13TkRaalkyVXdNV1UzT0RWa09HVXdaalpqTURsalpqYzNabUUxTkRjME1tUmpOakVpZlE9PQ==', 1632925681),
('dYDIRPetAq9syOaNfaYCUpVerKJfefqI649edpHn', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJa1Z3UkhKS2MzRjNTVkpPWW5GU1ZHUmliWGRaY1hjOVBTSXNJblpoYkhWbElqb2lVRzVqVEVJNGVESTNRM2RuVW1SUlZHbG1iV1JOU1VWU01HdFlTRVpYV2xsSmN6VXhiMlZXTXpGNGRsZzVXRUZhV0RsUmNrZExRVkJzY0VKU1JraHNkR1ZLU0hCMFFtUnhSVmhHYW5VNWVESmtja2wzU1ZwM2RWZGlia1ZEVUdRdksxSTVSbE00U1VJeU5sSnBPREZzZDFCYVFWaEhMM2hIUlRrdk5HZzNkMHRhUlVoc1duZGhPVUZyT1dJNVlXNVBjMDAzV0VkRGFqUnVOVmhJTm5KV0sxZFpPSGxUUmpCaU5GRXJVbW8xYTJKcFVWVjZlV1JQUlU1R1RXdFJZVGwxTVVRNFUxTkRSVlJSYjA1M2FYZHlWa3AyWkZnM1ZFUllTV3B4TTFobGNtNXVjeko1TWt3clQwVmFMMXAwVERjNVkxSXljVU0xZVVOU2VUSnFRVFZzY1VWNmNIVndUMjgzYXpWMU9XYzRXVzVLYldoMWMyYzlQU0lzSW0xaFl5STZJakE0TldZd1kyVTROakJsTjJOaU1USmlObVV3TjJVNE1XRTFOMkZoTkRVMk5UVTNZVE01TW1RNE1tSmhNR1l6TXpZNVl6Z3haVGRtTURjME56RTRNak1pZlE9PQ==', 1632925263),
('E2PSCBGHz828G7jElzOZHi4cDrK90dTdksBjmTny', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJakJNV1U4dllURlJaMkZXYm5GeGVqa3laM2htVkdjOVBTSXNJblpoYkhWbElqb2liRVZST0VKSlEwbHdkM2xuWkVaNk1rVnJPUzlXV2tWamVtWXlXWEEwY0RnelVXZEtWbFF6YVRoSWVYUmhVMFpsWWpsUGNXaHRWamczSzBoekszUkpUWEY2VjJ4NVlsVXpTSGRPVUU1cWRuSjBlVmQ2WlUxUFZuVnBVVXhoVG5Oa055OU5jMDFhUjI5WE5XSm9kMkV3Tm5CNmNEWkxaRkp4TTNCVmVtNXZVbnBOYTBSTVNqSnNkM296TjFNNFIyMVJVMlIwTHpnMlEwUTFjWFZTUkVVckwyMUlMMk5IYm1oTFpGbDFiSGxVT0ZsaE1VcHljeTh3VWpGTWN5OTJaSE5DUlM5T0wwZDRXbFJ1TkROdVkzcE9RemRXVjJNelNHMTNhM2cxZDFSb05XcHNlVlZ6WVRGeWRsRlZPUzl3THpkV1JsUlFRMmhtV0VGWVltUndjVEYwY0VkeU1EWjVSREZsU25Ca2VGSnNUVXR6U2xadldXYzlQU0lzSW0xaFl5STZJbU0wTVRGaU1UY3lNemsyTnpJNVltTmxNamswTm1abFpXUmlabU13TldVMFpEZ3lORFUxWldZME9UbGlZVEF5WTJKbE5qTXpPVGszTlRVMFltWmpOREVpZlE9PQ==', 1632925442),
('f9z3Nd4zh38cfLgxC3zNsrMiURsTJNliJgTWTOEn', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJaTlLTmk5SmEwUlZkazQxWmpaclpISndWMVZ3ZFdjOVBTSXNJblpoYkhWbElqb2lWM0paWmpsRWMwRlhOeTlrY1ZnNE1XUklRWEZvTDNwdWVHMUlWRzVOV1d0UlkyVkljWEpvYWtwQ2RYTkdVRzV1U2xjMEwwdGplR3hLY1dsNWNXUk5aVU5OYTBvM0wwSnRSMnRuWms5VmVtSklabWNyYUZjM1lXWllVMlZXU3pOM04zZ3ZNVUZ1ZUZGcFRHVXdWQ3N4YlN0VVdsSk9ZVmRtTlZCcU5VSklZVFZOVEdzdlVqWXJjMHMxYURsbGEwbDZSVEJoYVdNNFQwcFdZVkJUTDBWcldqTnJVMlZ6V1M5MlJFbGxSRTVpWkdSUFYydExhbVJvYTNwaGJGRlJZVE14WWpRNGNYUkhkekpOWWtndmRVSkVhRFpzZFZoU1JXbHJOazUxT0dFNVZESlhhbnBRVjFWV2IyaEpZbVJhU21jNFkyTnFhbk13Vmt0aVdFZ3ZabUUwTmpFd2JFaFBSVWxKV0RsMFlXRlJZMGgwUzFWd1QyYzlQU0lzSW0xaFl5STZJbU14TURabE16Y3dPRGd6WVdFMlpUZzFPVEZpTURGaFlqTTVPR1EyWmpnM04yTTJZVFJpWXpoa05tVXhaVEprTVRZNE9EUTVZbUpqTVRBME16YzBNemtpZlE9PQ==', 1632925861),
('fpQlHEzs1qrfdFrQFQx7ajiVknCitmQ1kPALrvu4', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbVk0ZUZZeVVUVlFhVmRUVldkS1VGRjBhVkZTZDBFOVBTSXNJblpoYkhWbElqb2lVMHRYVVZCdUsxSkNhRTAzVnpkallWaFhMM2xTUWs1SVNIQk1VR2xpZERabmQzbHNhVFV2TkRCNlVVSlZNRzlPVVdSb1pGcEtkbWg2YVdweFRYWm9WV1ZzTjBWWVZuZ3hkVGxJVjB4TVRFVXZXbW96UmpOT1MwRlRNMGRuUjFSRWFHeHVPRFZXVGpOcVdtdG5VV3N6TkVKV1VUUTVOVzVzWjNablNqbG9hWHBrV0ZaWVJUYzBURzA1VVZaQ1IybEliRGRvU2pocVVWaGtjVE5MT0ZJemREWXJSeXRTYTJ0VVkxSjJlRkpKTVdwaksyUnNUbmhsY0hFeVoyMUZkM1ZMTlVFeGEySkNSRTlEUkZvNGQwWlpSbWxWVnpjM2JFdDRlV0pEYVdaaVRVdG1jVlZPVEM4d2FtZzNUbW95TlVoQ1ZrNWlXa3QzUlc5a2JFWTFPVkF2ZERWYVdETTBNRVl2TW5VdlowSjZObTQwYjNCTE1YYzlQU0lzSW0xaFl5STZJbVl6TldGa1pqUTNOMlptT0RNeFkyUmlOR00xTm1OaE5EWTJZalppT1dJek56VXhPRFl6WWpNNFlqQmxabUZsWlRJM01qbGxPR000WVdJd016aGhNMkVpZlE9PQ==', 1632925622),
('huYVYRFVUrqk5njCUGMltrDxezakUezffkqAPhpV', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbE5UT1RKbUsyVjNkR2RMZEhwWWIxbFZibFZUYmtFOVBTSXNJblpoYkhWbElqb2lhelJRTm5GcFJtRmxXRkpFTjBvcmJsUjJaWEpNV1RCS2FtNDNVVzlEU2pkTlNYbzFUbTV4Ym5GaFRrbHlOalpDWm1aemJtcE9WM05aZERSNU5HNURZVk5MTkZsSU1sbHJSelZxZDAxdVJFZ3lhRk5aVTNoeU5ERmlVVk5FUzA1TFNETlRSM0Z3ZVRKcFJqZ3ZSMnhMSzNKUVJFTm1hRlZpUzNScE1TdDVlWFJ3SzNWTlVucEVRWEJzT0RSYVZrazJaRlZ2UlhSRFFrbHVOMWhRVUVKQlJHWm1lWE5QVUVOVk4zRjFXU3RQTmxGbFdGQnJSRlI1VTJkR1Nrd3pVbk5LZDBORWMwTklaa3hqVEVKc1pEbG5TakJUVmxSYVpGZElkalJWT1VOWVkzQm1VelZ5ZGxoTldtTmpabTk1Y2toUWVFaDRURWxMV2tSTVFUVmpSbll3TDBGRVMzbzRXbkp1TVU5Nk5YVlNabTB5YVRJdmFIYzlQU0lzSW0xaFl5STZJalJoWlRJM05EQmxaRGszTlRFME1UTXpNVEV4WmpVNFl6SmpabVJqTkRjM09XWmpZVGhsWlRBeFlUa3pZMlZpTnpBME5UQXpNV0ZpWlRBMU1tUmpZVFlpZlE9PQ==', 1632925382),
('Ji8lZKFRq1GQTQi0smc6fGTPrdhIu2AHFXdjgMDX', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbVU0T0hBMlkwRTRjRmh4ZGxOUlNWUnZTME5xVlVFOVBTSXNJblpoYkhWbElqb2lkMFJYVW5FMFZtOURWVXhHVjNSWlJVSklhWEJEYVdWVkx6QlJSbk5CVG1vdmRXNXNRMjR4YURKNmNFRTJRVlJaY3pBNFlYTkZZV0V4ZERsMFoyaEpXWFJ2ZERRMk4wYzNaWFZEWlVSdGFWbFJObFpYY1c0eWVXaDJlR0ZyWXpkVmIzRktWR3h1U0hnd2MycFdiaXRzVTNjd1YzUnNlbWxPYVZWMldtWXJTSFpoTTJadlNEaExUekJYY2tabE0zaElRMkpWWTJ0blVVaDFXazl1TUdoTWIyMDRNVzFyVVVwdVFubFZVRFJFVjFGd1RIQmhiR00xU0dka1ZUWXpkbU5tUlZOck1UTldhMUJOYkV0NmVtUkNaMVJLTWpkR1JXTjBNWFpDTUVOV1QwUjJUMjEzZEZsclVqUlRSMG81T0dRd1NrcEJPRFEyV0d3Mk5YcGpNMUJ1VERGeGVGUkdiR2NyYkdJclFXVTJiVVZzYTFObFZVRTlQU0lzSW0xaFl5STZJamN6TW1SallqWXpZMkZpWWpSbU9UWmtNbUU0WlRnMk5USTVNbVZrWXpjNE5UQXlaRFU1TXpBeE5XVXhOREJoWXpNek1tTXpNR1F3TkdZME9UaG1aVGtpZlE9PQ==', 1632925262),
('KolljKgrkegvAg43C47kSYgiEcjc6IRHfTalKtQY', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbVZGU0hCMFZ6bHVjV2c1UkZKdWJVRkNLM0l5U1hjOVBTSXNJblpoYkhWbElqb2lWbTlTVlVob1RUY3dNVmgxYVdaTWVUZ3hUR00xY25SemVrb3ZZMnRDUVd4Qk9GUXdhbTFQV2tKeGMwTlZaVVZhWWpBclNUQTRlRm94YWpBdk9FeDJhekZuV0dOS2IwZFhRbE54YlVGU1ZucFhXalJoTmpkRlVEVTRRbGxxU1hsV2MzRXpNbWRtTVhZdmEzQlFlVU50VGxveVRqRm5lWGxITlVobWVIcGxORGhIWVRWQlVXWkNNVlpTZUhCeWFITjROV2xLZFVsb05GZDZZblphTm1wcFVGbHJNWE01UkdrNVJGTnlWREJwUTJOM2RuUkpUM1pPVG1nM1UxRTFhVkpTUTJsWFRUbDRSRXhtY0ROUlpVSTRZVzVHUjJjNFpXZFBNV0V3TUVSM09WRlpWbFowWjJGQmVYa3JUR2xJZW5sSllVaFFNRzV2YmxsaFpVOTFTbnBuVVRScE9IQlZZbXB0TlRkclpqSTRjVmh3ZWpaWlRsRTlQU0lzSW0xaFl5STZJalF5TmpkaVl6QTBNRFkyWWpFeFpUYzJPRGcwT1RFNVpETXhaakUyTm1Kak9HTXlNakZqTURoa05ERTJZamhpWVRNd1pqbGlOelJrTjJVd01UWTFaRFlpZlE9PQ==', 1632925142),
('LN0RSUOkmFuBabdGiZEe4W7mqYeDiQLwyBUnCZuw', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbEp0VVhkR2REbFlUVkZvWlVGUFdUa3ljamhJYlZFOVBTSXNJblpoYkhWbElqb2lSbU5MUlVwRWRVZHBRazFPUm05VlpTOWpWV2w1UVdKdVJrZEVLMDVYTlhJMlZpdExTekUzWmtKTmRrWTNjbE15Y1dReU5IY3ZNbGR3TjI4emRUbEJWblpoYVZOSWIzQnZjSEpSTVdsVVVVUktjekk0Um1VemFXWm9XSGsxYzNaUk1HUnpSMEZuTDBvNU1WbDBRVFZ6ZG5Sa0wxTk9XbWxFZVhWRFdIQkZNaXRoTkRSSFEzRXlZVVV5VDNGblZURk9SMjhyVFVOV1lYZHNOakl6V0RnM2NrZ3lWM0JoUWl0UFYxaGlabk53UTJoRFEyZG1VR3BwVG1Ka1JuRmtRVFVyTTJsamVraEJLMjVyVWpaeFpVeHZOMjFrTlVGMVRuSTNZV3RRWjIxcFZqVlRjbnB6TnpsRE9FbEJVR0ZvTTIxR1lrdzNUMUJOVmxwVlIxTmpSbTR2UVc5bU5VRklkMGd6WkdWWEt6aFNRVEJ0VVRWQ2JWRTlQU0lzSW0xaFl5STZJalJpWm1WaVpUY3dZalJsT0dKaU1URm1NRGs1TjJJMk1ESTVNRGxpWWpVNFpXTXlNRGt5WXpka01XRTNOV0ZtTWpCaE5XWTNaRGRqWlRSalpEQTVZMklpZlE9PQ==', 1632925441),
('mtCqOl6F7YTjjVhWyugOBeIT8GI88BBFq0KtYBT3', NULL, '46.174.50.5', 'Wget/1.14 (linux-gnu)', 'ZXlKcGRpSTZJbU13VDJwU1NHZFVVSHBYZDNwUVlrMDBhekZJWldjOVBTSXNJblpoYkhWbElqb2llVkZuWkRSUGFHNURRemNyY1RCd2JteFhPVEZqYUd4Uk5EaDRUVmhCZDJaT2FXTXlNblY2YzJWSFJXTTBSazgzZURSMVN6bFBVbFZYUTFwNlFXSmtVRTEzZVVwdmFITnFXRlI0Ykc1ck1HWmpXRWxKTTBWTU1GUTRNbXBSZVhwc1dFeHpUM1pGWVZsdmQxRjJSaXRwVjJsNmJXMWlZMGRLU1RWNE9YRjFaR2h4TUhKaVFUTkZVekJVZFdOdFkxaDBXUzl2Y3pncmFVRTVPR3BWY25WNVZrcFJkeXRxV0U1a1VsRnFabm8yTlc1cGFIaFNWMGhVWjNFclZrWmxWbE1yTm1GRFRWcHFLMnd3T0haRlZGTlVMek16ZDNOR0wzb3JiVE5ETldoMWNHRkplbEJwWVRWQ1ZsWlFTVVJyU2xWTVVHeHhiMk01U2poWk1tWlRkMjFzV2t4bGRFZE9iakIzTlZaYWJVUXJZWGhWT1RNMlFXYzlQU0lzSW0xaFl5STZJak00T0RjeVl6VmxPVFJtWlRSbVpXUXpaV1l6TjJNMllXSXdOVFkyTXpBMFpXSmxOakV4TVRaalpHVTBNakV6TXpFNVl6SmpOV0UxTXpVMk1qZG1OamNpZlE9PQ==', 1632926582),
('mudmaGueHyQ98KCuPEAZfdSYpPUZfmd20hpH7QUw', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbk5pVDJSMWJqZDVaWEpDVVd0dGMwa3dkMmd2T0djOVBTSXNJblpoYkhWbElqb2lRbEJPUWtKNlpVeEtSQ3RsTnpKcmFrbHJLM2hhS3pSWVYzWnZVM0oxYzIxNlNrdEtXa05ZTlhWWWNpOVpRa2hrWWxVeWNGSmxXWE5RTUVwRFowWk1TR3hVYTBOM01FWm5kVnA1YW04M2QwTTVSREZrT1ZVMmVrbHdjMWxPYldVMlZrdGFjV3B1ZHpsU1RFUnNUMVFyWjAwd2NEVkNiVzUzZG1sVmFVUXpSa3M1ZG05SU0zcE1lbXRRWTBoRU1FMUNNWFZvT0VoNVpUaDZTa2RKUmxKeU5uSkdSamRQYlVJck5EWXJkMk5zWlhjd1JGcHNTbmxxYVZCaFIzZHpkV2xMTVdkdUx6TnRRbnBSUXpVeGRFeGhRVTF4Um1OQlFXd3dlRGhGYUdwMVFWa3laWEpoUlZkUmRGWkNURk42VUdWaGFVVm1OWFZ2VWtFNVNqRmtWRVY2TjNwVFpFTjVaa3RSUld0alNtMWxjMlJQT1d0emJWRTlQU0lzSW0xaFl5STZJbVE1TkdFd09UTTVaVGMwTlRCa056RmhNV1poTldZMk16ZGxZakF5WlRaa1l6ZGhOell4TURObVptSTFZek5qTkRWalltRmpaVEU0WkRNMVkyWmpPR01pZlE9PQ==', 1632925561),
('muNugCChz97qLMUgJxTblKjdF8sr1NeF6043pKCb', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbUV3U1Zab1UwVjZXRWMwWnpKd1oybFBka2hSWjNjOVBTSXNJblpoYkhWbElqb2lWR05UT0dnMWFrUnhibE5oZVdZMlRFOW9jbnAyVDNSblFuTTFibUZ6WlVSTlQyWTBPVkIxVkZWSmVXVnRPSFZWZDNOWk1rSTFhWGRaZFZsVmMxa3hPREJ1UTJJM2VHdHBRMUZ3TWt4Wk4xSTFjMUZXYTNjMVZFeGFlbkJIUW1vM00yRnlTbEJ1UkdSeFRrdHdNbTFzT1hCVFprTlZSa3hvVW1NclV6Rm1NemQ2S3l0c1FXdG9NR0pLUlRoTVJrOXhkMUZ2YUhadGVUTXdPVFZ2VlZGSFUySkhLMVo1THpORGVXNU1hRFo0YkdSQmNrTmtURk5MVTNveVowMUdVRloyVml0VldsZERjelJaVDJSMlRXTXZha3RrWkdwUU9GQklVbFZEZEdSVlZFUmtSVEF4Tkhnd1JsSlRWVWhNWld0SFdsUnRhRkpUYWtsWFFuTjVNbmRNTjJOWVRteE5XVEpvWlZZMUx5OTJVV1ZzWVZCdlZuYzlQU0lzSW0xaFl5STZJalUzTW1FeU1USmtOV1E1TVRNd016UXdZMlptTURCaE5ETTNaVEk0TXpGaU1EbGlOMlkyT0dGa1ptWXhObUpoTURaaE1EazBaVEEwWm1Fell6QmhaREVpZlE9PQ==', 1632925382),
('nghyNknCiPGZL7TEHc48imiV83kiuMBFGwQsR8J2', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJa0kzZDNGRFNuRTBkVmhYYkRkUmFsUXhOV2MxYWxFOVBTSXNJblpoYkhWbElqb2lkR3h4WkRrck9YSlFPVTFYUlVkVWJWa3dRMUJoUlcwM2FGUXdaR2czT1dSTGNFd3lVWFp5Y3psbE5tY3dlRFpMV0VFeWJFbHVNRzFHTWt4WlVDdGtNRGR1UlZodkx6ZFdPVUpPUlhCU1NGbGFTMnRNUkhoRVRFcFlSREpyVjBKaVNFNXdNV0p5TDNGc1Z6RmpWelpOYXl0TlNVMUVOR0lyU0VsTWJXbHhkV1kxWlhOaVdFbDNVM1Z6VVU5S1VWQk9iRkIzV0dZdmJIWldVMWczUldWV1YwMW5VRTF5U0VwbllWcHRlRkJ2WWxocFdIZEhPRkpQWVVGMmVUTktNR1JYWlZSSWJuaFhjVmxaVjJ0TmRpdFZiM2N5YVVGR2NVTkVTM292TjFWdlptbHJaVXRJZDA5cWREUllNemR6Y3pRMVZtMDJja3BPUlhSVFFWZDZTVEF6TkhZeU4zSkRhMjFTZFVKSlpVdGthM0IwUWxsVVJrRTlQU0lzSW0xaFl5STZJamMwTkRCallXRTVZemxoTTJZNE1qTTRZVGsyWWpoak5HTXlOVE0wTURVelkyWXdNRFF4T0RrNU0yRm1NV014TTJSaVltVTNaVE5rTm1VNE0ySTFNMlVpZlE9PQ==', 1632925262),
('nqQYEagaG4DT24yuPW0WhfWQfcj6CUG6vyOFB40h', NULL, '46.174.50.5', 'Wget/1.14 (linux-gnu)', 'ZXlKcGRpSTZJbHA1WkZWck1HMHhZaTlsVW01a1FrSmhORm95Y21jOVBTSXNJblpoYkhWbElqb2lSbkI2U0N0SU4yUnRRMnBSTnpsTlpVWlNUbTVrZDB0NFR6bHhPV1ZYYWl0TlkzSk9Oa2x4WmxkRE1UVlNSRGs0YW5sV2MxZHVSRk5OWlcxb1UzZEdia2xUUVhaUWFqUk5kVkJxYW1SVVNWSmpaVWh5TlRBM1F6RlhWRFJpY1VWalVXd3JibFpXYW1scVVFVTFZbHBRWjNsTGN6TjJUa3RZU1V0M2RGSmhlVXhpYlcxQ2QxWlNWREZzWm5SdlkwaDVaakpHTkVOWWFpdEVTWGR2UldSblRVRjJiMmRVVTBSak1rZzBjRk5LWjFSVFNVSkRlalZ0THpBMFZXVXliVlZqYlRRclVWVjRNMXBZU0UwdmFYbE5VRFpqVjNNMFNIWlZTVlZrT1RaQ1JXMUZkR0prVFRFeVMwcEtWMlZWYVhCNk1rTkxZMWhOUVdkdlpURjVWVlUyWTNKNVVrWk9XSGM0UWpCNllrRnNOblZKYmxWMk9IYzlQU0lzSW0xaFl5STZJamhqTVdSaU1tRm1aVFV5TXpoaVlXRTFOV05qWlRRelpUUmpZVGhoT0RVMU9HSXdOemMwTW1Fd01EWmtPV1E0WVRZNE0yRXlPRGM1WVRJM056UmhOemtpZlE9PQ==', 1632926522),
('nVbdDnqyE8g2bU4FI3jRmAs3h9quXBNau8VpckVB', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJblJPT0RGVWVWaFFlSGxTWjBSbWVGTnhWVU5vVFZFOVBTSXNJblpoYkhWbElqb2liR3B3UzJablFuRXZRalpPV0VRMVdXOW1PR3hzZFRFclVGUjFZaTlHVlZCNFpGWnFlbUpETW5oTGRFdHFObFZRUmpaSFYzVjFObFl5UjFSVUsweEVaemx4UkVwQlRYWnVZMlJXYlRWa1dqSTNRWFZNWVRoS1NtRjNhMDVEU0hkSE5XbG5hVWszUzBwWWNVNUlaRGx6ZWtKQ2JuRkpSbGhvY0VwVFZuWXlNREJTZDNBNVdHcG1OM1ZqYTNselNYWkNSVXhXWVRsVlZtRmlLMDVuUjFWa2NFNW5aVkpUUlZacWJYTTVOMjlUTTJGMWFrbFlSbmhQTVRCT2ExSnpZa292TUZWSVJIYzJZa0pFVEZSRGJXUlhWMlpKZW5CMlV6bFJMMFVyVUZSTGJsaEZPRkZYWWxselVsQnpaVkJDVDNKbFMyWm9hMlZuV1ZVNVkwZzNiMWh3TXk5UVptSmFSMnBPYkVaSVVWSkZPWGhVY0ZGbU9GRTlQU0lzSW0xaFl5STZJbVV6WWpNMVpqQmhOVFZrWm1GaU9EVm1PV0ZsTWpNek0yVTVZV1V5T1dJek16bGhPVGs0TWpFek1XRmpOV05sT1RjNVlUVXlPREEwTVRneFpUVTBOeklpZlE9PQ==', 1632925202),
('R1A9gRBTwtdxuDp9UXGlBYLtA0d5VAZx1JAIQBcV', NULL, '46.174.50.5', 'Wget/1.14 (linux-gnu)', 'ZXlKcGRpSTZJa1ZvYW5OMU1GSXJPVU54WkRGSllVdFBSbU16VFVFOVBTSXNJblpoYkhWbElqb2lSMGRsUTIxWmRWQldTMFpzUkRWbk9UUmpaU3QwVkdORFRtbzBNRFpFY205QldFNVJjbUZrVG5GRmJXUnFPRlpSV1dKRmVreHlOMGs0ZVRoMlNtMXlRM0k1TW1OTWVWUlNWR2Q2VXpCMU4zUnFOMmNyWmpORFNVWTRPVXBsTWl0Q1FsWnhWVWRSYTFadlowdGxZMDVQWlZoamVFOXdUekZtYmsxTGMwSkJjRUZYT1ZwemFtWk5kRlJ6UmxsWk5qQXdTRmhDTDFGNGJtaG5lUzl2YlhoWVNFNW9UV0pLVUZGd1JrRnlObFpxZEVKWlRqbDNXRzlLY2psalN6SnpTRzF3YkZGaloxRlJkak5pTlU5bGVYSkhObmhFZFRGMFpubzJTbkpFVGxSaE1DOUlPR1I2Um1KdVNtZEViR3h5TkUxcWRIZG9MMmhqWjJwaFJXTndaMWR3V21ocFExVmtLMlY0T1RacGJGUm5VMkk1TXpkRWFYYzlQU0lzSW0xaFl5STZJakUxWWpNNU56SmpOMll4WlRabU4ySm1OVGhqTmpSbE16UTRZVEJtWXpaa09HVTRZMkkzWmpabE1qUmpOalE1TUdJME5UbGlZelk1TkRBMFpqTTFaVFFpZlE9PQ==', 1632926522),
('r9oiBeQJxJTR3MgE80hWPu6RXZ8p4e5KHjy9gUMw', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbkI2UWtSd2VWbDFaMWhDVFUxSVpEUkpRazVqUVdjOVBTSXNJblpoYkhWbElqb2lOazU0VFVoTU1sWk1WbmhuTDNocFpHUlpaemw2UWt4WGVIaE5WbnBuWTFwWE1IQkRialZyVGxjNE5YRk5OMWN5Tm1KemIyUldlVU01WW5aWU5GSklkV0UyWVVvd05HMXBNRVYyUzNKSFdHVk9VVXBWZDNkRVlVaGhibEJDVVhoVWNVd3JSREUwVTBseGQwTjNXWGxoZVc5alVYaFllaXRxY1VaRVlXTmhjbXhvVjJwV01rRjVOMFkwYzI1SWJHVnhWMkZ6U21WVVFqUk9WbFpxU0RSUGVrVjZNa1ZRUVcxR2NuaDVPV2x3ZGxaSFFrTmtOSEIzVjJGeWJUTnpTakVyZFdsUlducGpVV2huWmtRM1RFUlBPVEJ0U2xOa0szbFJPVWN5WmxKclJUSjRWbTVWUVZsdVl6bEhiRmgxWkdaNlF5dFpjVEFyWWk5WWJGbHBNbWxPUW5SMlRtTmlOMkYxU0hkcFZtTlNla1UyTHpkYWFVRTlQU0lzSW0xaFl5STZJalJrWkdObE56TmxOMk00TnpVd05UYzJObVZsTUdabVl6bG1Zek15T0RNMU5UYzBZakUzTkRjNE5qZ3lPR1F6TmpFeU9HVTJPV000TkRsaE5XRXdNVFFpZlE9PQ==', 1632925442),
('rODLzW5o2XRHMds3YbVDEMPFdfpVv7yBWjK6txhL', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbnBpT0VveFVXUmhWemRRVm10VlVVTnJibGhhWTFFOVBTSXNJblpoYkhWbElqb2liRXhGU0U5b2RYTlVSbVp0UVROcFFYVm9iMHBZYVU1NlYwTnlRVzlDWW1aNk5scHVPWGREVkZKbVNsWndNRko1ZFZGeWVGVjVjSEZ4Y2xjNE5YWm9OSEUwV0ZRNE9FTkJkbmg1UVUxVFZIWkJlVk4yZFM5SWNWUjFkMHRCWWpodU0zRktjMU5CVmsxNU5UbDRLekl3U0hrMFJpc3JWekZyVEhSclJETjVhME13VVU4eVNtUTJTa0k1VDJWc05uZzNWbE5TVDBSTVlsbFJOekZEZDBRemVrbDNSRzlIZHpZMkwxUlZVRGhZWTBoa1YySmpjMlk0ZDBWTFIwdHJXUzlXYzJocGF6Um9WMHhLU1ZFeWMxSjZlVzVXYTB0TGFqSnhaa2RyYkZOd09FaDJjelI0YzBORGNEWTFlR1JVY3pKc1JucDJkRUoySzFOQmQyWlFjbEEyTlZGaVlVSmthMFZpT0hCUFNubHplbUk0ZFhWalFWRTlQU0lzSW0xaFl5STZJakJsWkRFelpqQTVOV05sTjJNd1pUWmpObVF5WXpVeVpERXpabVZoT1Rrd09XRm1ZVE01TXpVd1pUY3lOMlZtTURNMU9XVTBaVFZpTWpZeU56RXlOelFpZlE9PQ==', 1632925561),
('sjJXs7kOnZOtgOfMePfgH7Sxdf1ZU1N8TccnT3YI', 1, '109.124.211.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.82 Safari/537.36', 'ZXlKcGRpSTZJbWN2UVRoRFZEazNNRll6VlRkQk4xUTRTMGRHSzJjOVBTSXNJblpoYkhWbElqb2lhV3hUTWtaVE1sSjFXVFJaVlhWaVZrTkpVMnMyUjJsblJuSTRjVGxKWnpsdFUwTkVWRGhEUW5Ka1JEVXdaVU5oTXl0d01UbHRiMDVpV0RsMFVHdEhUa3RsVW5Sa2VXYzJjVkZPYlV0TWIwRlBPREJ2WjNGelkycEpiVGRwU2t4d1IzWTFjMWxTUmtaRWIweEpjR3hGVUdneVUwZ3hOR1J0Tld0T2FWQk9aMVJFSzNkV2VFWXJhVUl4UVROb1FWVk1WV2d6TmpnMmJYUXdlSFJtYlhrNE5tdHFVbWw2UVhNeWJXcE1SamRLVERGU01IQjRSMlYyZGxsVE9Dc3dTbmRVYTNGUVpIZEVNRkZPWmtOV1FYbGlWMlJ5Y1V3clltVnlVMmRQVkd4VmVEaHdOREZ3YTNwdmRDOXJjMms0VkhWc1NFSXdaMGxNVUU1SGFEaGhWVmgwYzFGaVpubGlOM1ZqY1dwUldYaGFObXByU1dsMFIwTlZSV1IwTVRWVFdIUm5kREppTDNkeVMybFNSeXR0YWtGV0t6ZFROVkpwZG5Ka1ZVb3dWbXd3UVRKT2RHUndiVEptV1cxdVYwaFVNWEZYTURsRE5UVnFNbWRNVDNkWVlXZHNTV0pOUldGcFZGbFFhbWRsUnpaSGIwbEhPRUpGTlcxd2FYTlZVa3hNY1RWbFRUZ3JReTlvUW5SYWRDOURRVGhDVlRSS2NGZzNhR0pCT0hReFJqWTNNbkF3UzNwT0t6bG9hRk5xVFd4alExTnRSMVpoTDFCek4wTm9XV0Z0YmpGMmFsRlVNRkZ3VXpZdmFFUnVNMDlKT0d4bE4weFhlWGhxYVVsMmNERkhhMHR5Y1ZacFZpOWhkMmg0YmpnOUlpd2liV0ZqSWpvaU4yTTBOV0ppWWprMlpqVTBNV0psTlRKa1pUSmxZV0UzTW1VeVpEazNZMlJpWXpkbFlUZGxOVGRqWkRsbFpUY3lNRFV4TldRNE1EVmtZakJqWkdNNFl5Sjk=', 1632926619),
('tn7MQlvUeC7qx7A6JZ0vtU3e0cMt4L2582YQd5DW', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbGN6TW5Cc2NYTk5SM2RCVTIxTU4xQnhVVGxDV1hjOVBTSXNJblpoYkhWbElqb2lNblZLYTJGMFNIaHVZV2xNVWtNMFdFUTVRelExV0RsM1lrRlNTVmR4UW1ocU1WaGtSMUlyU1U5M09WQlRSMkYwVDAwclNrdHVOamxYTjIxck9WZFJRVTFEWVV0MlUzTkljelZYWlRBdlVFUk1MMkoyYXk5VU0yNWhXVU5qVEZSaFNWRnNWbk53ZGxKRGJpOXlPVGxvZW1RNGFsRllaV2hWTmtOTWRIbEZaM0pZV2xsd1RURkhVRlp5UjFWNGJtOWFMMUI1V1hZMWEwUkRabXBoUm05SmEydElVWEpvUTJSWmNHMHdMemxrVkRONWEyNXFhRGRRTjFaSGRYSm1NSFFyY1ZsTlR6TmxjMjlQZUZoSmMxcDViRFl2YlRSRVl6bFBiMmxCZWtGNFMwcEdNamxTT1dZMVFuaGhVM2R3UkdGRmNETTVORW94VEVsMFFVWldUMVpwWjBoMVQyOVJTWFZ5WnpKVWEyNTNTVzlOYWtKVEswRTlQU0lzSW0xaFl5STZJalU0Wm1Ka1lqTXpZV015Wm1NMk1qYzNPRGN6TlRVeE1UWTBNek13WVdVNFpURTRZamswWVRKaVkySmtOamN5T0dKa016Y3pNRGhqTnpreVpHTTVOVFlpZlE9PQ==', 1632925742),
('v7pxRk0P7dRSVKQ2m4BGiDp9gQzNtDQ20Zug8tkL', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbkJxTHpOdFRYTndWVzlOVnk5a1F6Qm5RbHBYTUZFOVBTSXNJblpoYkhWbElqb2lNbnBKZWpSR2JWZ3ZhbnBTT1ZkU1NXNUxkV2R4TUM5RFJIaEtOMWN6TkdodE1YSktaRTFtUW1kb2NtcDVOSFl2VVhKcFRuTm1OalpHZW5GMWRYbzNkbVE0WjFkb1RrZFdPRUZ6UzBKR05IcDJRblJTTkVsdGR6UTFWMVJUZVM5Rk4ySkNaMlkyUmxsbk1IcHNaWE1yYVhoV1ZqZE5jMk5tU3pOUk5ISTRXamQ2UVhSU1oyYzNWMFJ4TVRoMWJWSkZNVEJPUkdsR2ExVm5PWEZuVnpkNU9WUnlWVk5TZW5OdGRFazJjalpxUWpKUWRYcENaV2xNWkZOYWFXcGFSREJVY214b1RERklWamRRSzFObmFubFZjRTg1UlhrMGRqRnVRM2hyVlhwUWNUbHJiVTFyZUdwUmFGcFRXVlJVV0RoUmIzQmthM0lyWkdGVGQwVkVNUzlGZUdwTlZIZEtXSEoyTkdGVWFEUm5UMmgxVUZkb01FRTlQU0lzSW0xaFl5STZJbU01Wm1FME9EUXdPVFZtTnpreE56Qm1ZbU5sTWpVd01qUTFZVE14WXprd1lqZ3haams0TUdOa1lqQTFOV0kxT1RVNFlUSmxZMkV6TURVMk5qZzFORFVpZlE9PQ==', 1632925802),
('w3TBx5bLJ0SmnkDSAQdbHsI0KOMGVP4xAFU8mhxI', NULL, '46.174.50.5', 'Wget/1.14 (linux-gnu)', 'ZXlKcGRpSTZJbEF6TkVsUGRtMUtUMUl2WW5veVJtUlpkVlZzU1ZFOVBTSXNJblpoYkhWbElqb2lVRk5PZUhadWJGY3pZVmh5YjNGclVHdDNVeXRWU3pWSlp6bFlNV1Z3Ym5oWFZFNVhlbGh5VHpRNVNYZFRZVEZYZUdWdVIydDJWVVE0ZEVwdGVERllUSFZOUTBoaWVIRmxaM3B5VmpaVmNYSTJhR2N6V0cxcFJYQllSMkZ4UlVOaWVYQk1URzFxYWpkcFpVZHNWQzlHZDNrMVUwcFVhR2xpVTNOdGJFeG9aRVpUYzBSNlNsZHBUVmRsTHpWck5WUnZaamhVT1cxNE55OUdjM2x4YmxaU1l6TTFjbkk1UmpWdFV6UjNhVWwxWkdWR055OVBaakJyUkRSbGRYZEdWa1V2YVZGVGFuTTFlV1ZHWjBWbmRTOUpVa0ZFZVdWSmJsZFhZVXMxY0VWTE5HSm9OVkF6ZEV0eWIxWmtiV05HVVdoRmNFWTBTMDk0TjFaa1NFRkhZMjl0WWxneVFrUnNSRTk2ZVhwVU5rVjBSVnBzTlN0Vk5uYzlQU0lzSW0xaFl5STZJakl4TTJNNVl6RXpOelV3T0dJMVl6RXdOakU1TldFNU5USTFabVpqTXpOaE5XWmlZamsxTmpWaFltTmpOemc0TldJME5tRmhOakV6TWpZM05XWTBOVGdpZlE9PQ==', 1632926582),
('wcQev4stAGVl1JE3qO5dF6UA8R1tFwaTTDgUKih5', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbEprYjNveWFWWkxObGRVTkN0cVVqWnBkVzVvYlhjOVBTSXNJblpoYkhWbElqb2lOWEpEVEdsMGVqRm5kVkphWnpWbGVrbHlVMUYxUWpoU0syMTFTV3BSY2pKTVVIWkZaaTlaUTBwMFMzcElhblkxVHpSMFNWVk9hWE4xZFZwcWNIcHBTMFpyYmpGc1IwUTFTR0ZrUkRWbVdFNXhkMXBXVURVNFVEUTVZV0pwZUhsMlQwMHdiRFZTV2pKcGF6ZEViblIySzJodlZEUm5Na0V5U1ZORllXdFBSbmh2U0VWbWNrTm1lRXRPUVcxNVR6TTFTREl2UTBoaGNsaEVNVVJsTTNOVlprazRhbWhvUkdaYVVHTkdTMUZHTWxSVVZVNU5WWEJuVkVVM1NFY3ZNVFZQUmtWM1FWQkZhazUyTlhsUE0zZFNXRFpCWnpSMmVVSllRakk0YTFaRVJuRXpSMUJQU0RGUFl6SnljbWhqZEhwRFZYTTVLelJuVGpaU1puSTVPR0k0UVZFNVVDODNiM2MzTDBaaFIyZFRaRFpvZURneGQzYzlQU0lzSW0xaFl5STZJams0WldFNFkyUmlZVEl5Tm1ZeE0yVmxOalExWldZM05qQTVOelU0TlRBd056STBOamsyWlRVME5UVmxORFprTjJabVl6azRZemN3TXpNeE5qVmhZMkVpZlE9PQ==', 1632925622),
('wDt26Vl0iotYugMD0NL7WB5N97xwGJ4rK8h4JsVg', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbEpRYlVSdVRtbHJaR05QZGt0UE5WVTFkWEpqZUZFOVBTSXNJblpoYkhWbElqb2lXSFZSZFZSb1FtcDVaV05tVTBoUFREaG5WelJ4U21OM0sweHJXbXNyTUV0WVJrNWhOWFl6VEdjMVdsRlhaamxsTlZwck5qTXpUM3BFUkZsQmMyVkROSEZJV0dKdE5GUmxhREZqTUZwcU1VTlVPVTlxVDNOaVR6WnlURVJZZEhFMGR6TnZWbGN2U2pKUWJVRllkMFZoT0RaVk0xSlpaR3BLV25sVmJWRXdkakJLVlRCUFNqQXZjMnRhU1daU09TOTZVVlZDVGt0dGFWZHZjR3N6UW5saFUwSTFSR2RtY1RGYVNGY3pNRzQxVDIxVFpEVk9Wbk5wVGxNNE5XbFBXbXhwZDBsSlJYQXJNazlZTjA5YVpFaEdRa2RyU205eVpXdzJVQzlKZEdoU05uWXZaazFRWVdkWWMxaGhWRTk2TlhCNlVVZDJReTlNT1RCT1NYbEJUVkk0TW0xbFZEVk5hbUl5VDJVM1JsVnJhVE4wWTNoR2JVRTlQU0lzSW0xaFl5STZJbVJoTmpBek5qaGxOamhtTlRObVpUUTNZVE0zTkdWbE9UVTBOMlkwTW1WaVlqUmhORGhpTnpKalpqa3haamxrWTJJeE5qUTNZMlF5WmpWaU5XUXdOR1FpZlE9PQ==', 1632925502),
('X2ZzCwSL73tjRd9upOOeXmqkIONZkiZzoNTq1frF', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbEpuVG5SMWFTdFlOVVk1UkhaRGIzQTVXblZ3SzFFOVBTSXNJblpoYkhWbElqb2lkbTQ1UzBOdFNXY3ZXWGRPTW1oRWRIRTFRVVZPZVd4RFpGaFlkbGhPUjBndlpIRnVVM0JsU2xka1Z6Y3dVME00U25NNU1YZEtiV05oT0dzeFUzbG9kR0ZPZEVSaFNqSllUMUpFYzNWb1dYTk9hVko2ZW10aFJHUjBUamxHVUVkSU0wRlphV1pxUmtwTFJERjNOaXNyVFRKc05uZzJaazUyTlhaMWJVZ3hNMVpRTDA1dWVsWkpTM1ZRWjJkTmMwWnRWVnBIVG5WMGJqUmhWRU5yWWs5c1dVTlNRMUFyU0c5UVZYaG9hekpoWWxoWVNUbHNMMFZRTDFwMVZqbDRjRWtyZUdwMFZUQmFWRkEwU1VweE5tUnJTMHd6TkdOdUwyMW9SRTgwUjBkaVNURmxkVXRKYW5kR01sVjFMMUpaZEU0NGJUUjNOSGQ0WmxwdVNsUktiMFp4YVdOTFVFOUxaR3BLTVVrNEsxTkhlVUZUYlhoNk5XYzlQU0lzSW0xaFl5STZJamd4T0dReE1USmtaVEk1WVRGaE9UY3paalptTVRRM1pUa3pPVGszWW1WbU1qRmxabUZtTmpZellXVTNPR05pWXpRMU5qUm1NMk0xWVRFeFpUUmpNV0VpZlE9PQ==', 1632925561),
('XdVHIty5Ze6WoEeg2fF7H6TxVjFRRrXBKZQTmpLV', NULL, '46.174.50.5', 'Wget/1.14 (linux-gnu)', 'ZXlKcGRpSTZJa05rYm5kYU1HY3dVVzgxVFUwNWRXZEZVMDF0UVdjOVBTSXNJblpoYkhWbElqb2lkMGRwTW5JMlVEaEtXa3gwY0dWNlluaHhiR0pxZG04MGJXVlhZVzF0VG5aTVpHVlFRV1kzYkVaUlZFRm9ibk5ZY1hVek1FdG9MMUl2UjNObFVpOWtZbmR0VDBkaUx6TkRWM2xDTHpGWUwyaFRlR3RHVkZoNVJURnlSMDlJU3pSWk9ETTNOMnREWVRrelJqbHNlVzFxVlRCM2NrMXJRMkpNYjA1UmJGQjBWbVJOTlRsWlZuUkdhMGxJZW1GYWEwOHJSbkpFV2tkaWVtdE9ZWFI0Y2s5VFRsSlJRbnBJTVhWUWVWRnFOMDkzVlRoeGFuVnJZMmxUVW5semJ6VkVhbEo0TUhSQk1qVkNSVTlQVnpsWVNuQXdhV0pMYmpSeGVXMW5RVEExTURkTEwzQkZOWGRQU1RaNFpTdFZZVlJzUmtzeFUyaFVWRXBRZFdaWVJIbDVhbGR1VEhabVJUbEZVRmhLT0cxb2RuZDNhVnB5Y0UxVE9IYzlQU0lzSW0xaFl5STZJbVUyWkRrNE5UTTVNR1ZtTlRRelpHRXdNRGRsTXpCaFlqSmxPRGt3WkRrNE1UVTFPREU1Tm1VMU4yWTBaakkyWkRoaFpqQmpaVEkyWmpabE1qZ3pZelVpZlE9PQ==', 1632926522),
('XpirMbeuTWL7R70jdL9f2ljwfHx0YdKBcdc4Q04F', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJazlVTm5KcFVqSlVUbFlyTTJoRlV5OUlibE54ZVVFOVBTSXNJblpoYkhWbElqb2laR04xUlV4UGRta3ZSVTQyWTBkUU4wWktUakZ2TUVoMGRXMWtiVVJoU0dadmVIRlZOVE5sUW01eFZHWk5hRXh5WVVZNFRVdEhkRlZpVnpab1VsZHhRa0ZLYWsxS1dsWXhVQzh6UkcxT2RXMWpSREJOU1hSeE1sSllXREJDYUdOVFJXRm1WaTg0TUV4eWN6SXdVa2haYzFjeFNsSlFjR00zVWtaYVZHdHZlbkZTVHk5bk4zVnZkaTh2TkVaWVJGZ3hRMXBJYjBSelpVZ3dVME0yVDBSNVJFUjFhR3RVV0ZCVWVUQndNVWRxU1RONlpESlJOWGNyTmxaV01sYzRNM2t4VDFSUWEyMU5UV3RHUmtKMFQxSndRMDFLUTB4eGNqRlNkbXAyTXpCT1NEbHZOMDFxYjNKQ2JHcEJUMlYwVVc1aldGcFBjMDAwU0ZRMWIwRmtUMnAwVWxkVFJtMXpXalpDUjA1TlkzZFlhVkpwZVZGRVFuYzlQU0lzSW0xaFl5STZJamd6T0RBeU9USXdZemd3Wm1NMU5XUTNOek00T0Rsalpqa3dNR0l4TnpZek5XUmtOVEU0TTJVMFl6aGtOR0kzT1RFeE1UaGxZemhtWlRFeU1HUXpaVFVpZlE9PQ==', 1632925202),
('y9rS9RkeGE02O0sNwojMNUea3j1BY2a5kct6MLvc', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbkJDV2xSelVsbEVRMnQxYWpoMFRXRnBibVJvTTJjOVBTSXNJblpoYkhWbElqb2lTaTlaWTNkd1pXVnFXalYyVTJJeWJWTm5TWEpLTDFaTlRtRXlia3NyZDB0NEswY3ZPV2gzYWxsa01raDRNbVJOU25jNE1HdDJSakIxVTBaUlV6VTVjazl2VjFkcVEyTXhXbXBLUzFCeWQwOTJhekEyV0djMlpWSnhXR1p6ZUhGd1ZrMDBaVmhXZDFSQ2VHOUhRelpXU0Uwek5GSlhaVGxaYm5vd1FtRkVPRk5zWjNwd1YzTndTa1pKUm5JeGNETnljRlJLTkZWRE5tOHJPVU5DUnpJcmRtZzVibEpuZEZveFEwWnZRMEl5Um1WMVNqQkNURmRvYXpGdU1tTlhNR3RRUzNoSFRqbHFTa1ZxZFUxVlJVUmpSVWczZDFGRWVXNUtkVlJyZURWWE1uSndUeTkxZUc1UlFYUTBkbmRYTVdReGRHbDFUamxoWkU5Q1YzaEpXamhDYVc1blNXMUNlVFE1V25GWWNXdG5kMFpwWWxwc1NYYzlQU0lzSW0xaFl5STZJamxsTm1Sa01UQmhZbU5tTURRM05HRmhaR000WWpVME5UUXdaalprTURRME5UWmhNbU0wWkdRMU16TmpNVGM1TXpNek4yVmtNVEl6T1dFeU9HSmhNVEVpZlE9PQ==', 1632925501),
('YjdlzNWCL5vjW7sHrxBNVkoZBLk7kMr3IyuAx2TB', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbVZWVW04M1V6VTBOWEExU25WMVJ6TkNRbHBVVldjOVBTSXNJblpoYkhWbElqb2lia0ZFWmpOS04wdE9ObnBuT0c5WFpGVTFVVzQwUXpOWVJGRnJUMkUyVHl0c05pc3JTVFIzTTNrMmRXNVhVRGRaTlM5aFZVNURNRWRpYm14MlV6bGtUV1ZMWTI5b2JFeHpWV2g0YUdZelJWVlVVemMzV0haRlRHTlVObXBZUjNNMk0yMVpjRE5OTjJZelkyZHBlVmN2UjFGU01tbE9NbEY1ZVcwMmNIcDBjQ3RhZERVMlZGQnBjMU5SZFZNeGVDOWtPVFk0TldOVVZWWXlaM0Y2TW05NFRXMVBhRVZsWlVOMlZrODJhRFYzYkZVMFYyUnBibWxTYkdkQ1drTkxiMDAzVGxsVlFua3ljMkZNWTFwVVkxbHhZVGxqT1V0Q1pHeFdZekZVVVRBeGREbDFWRmx1VnpWeGRFSm9PRmR4WVZKWFdVUlBVM0ZWU1VOS1ZuWjNZamxDWldaQmMwNVZRbU55ZDNwdlMwRlFjVk5oVTNGa2NtYzlQU0lzSW0xaFl5STZJbU0xTWpBeU5qQmxORGhsWXpkaE5UYzVNMlE0TnpVeE9HWTRZV0l4T1RJM1lXUmtZelV3TXpZME1XTmhZMk5oTjJJd1ptVmtNemd5TUdZMVpUSmpZV0VpZlE9PQ==', 1632925622),
('ysmGpZwQYEc4uVkHv0mcXxZTDjQyb0TeBQS7HriE', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbmxFU3pFNFJpc3lOQzluTlhGWGJWQjZVVlZGVjJjOVBTSXNJblpoYkhWbElqb2lkblV4UjFCb0wydHRPRkJ6UjB4RFpqZ3lNWEpDT0RZemNpOVNlamxsZDBaaVVYVnZNR2g1YW1sUmNFNU9NSGRyYVhac05IUmFRVkJPTHpkRlJIZFpVa0ptTURsaU1XTndLMnhDUjJsM1RYSnlTMVp2V2pKT09GaHdVRkJZY1hCTFpVdGFRbnBaVEc4emMyaElla0l6TVN0RFJXZ3dka3BhVEN0T1EzVjNXVEZ3ZERkVVpuTkxSelZ4VG5wemRVNHZiVmhTT0RGcFFYUXpWRlJUUldOa1ZscEtkM2N6VERkdVdWZ3pVRlUxT1ROck56aFNkR050TUdOeVlXeEtOMkU0UzNSMFZtbHNlVkpTY3pCV1pVOXJXRFYzYjJaMFVVMU9Wek5NZWxGbGFFVmFSbTVaVUN0SGNIWlRjbk4xTVRSQ1pIaHZUa2x6VUdnclJqaHlWV3B2TTFOS1VrbFhNbTlCWWpJeWFHWnVNMjlDUkdSTFozYzlQU0lzSW0xaFl5STZJbU5tTlROa05HWXhOalE1TlRVeE9UTTNZakl4WlRObE1UTXhaRFExTXpFNE1UY3lZMkk1TXpWak1qSTVNelZtWWpSa01URmxZV0UzTVRFd1ptRXpaaklpZlE9PQ==', 1632925202),
('z0zVAtBDMwpXgVv8UY7sY59Xcl6UV4ZG4sYAOaPr', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbEpDUlVncllWYzBNbXhrTVRsaGRVTndZbHBtUldjOVBTSXNJblpoYkhWbElqb2lTa0YyVVNzemRsaFpiUzlOUXpaaU9HbDVWVVlyYm5SRVVqWnJSbE5NWnpGblVUbHBiSGRzUVc0eGVtTjZXVlpxZFdkUloybHdSRE5OYVZoSVNYWTJRMk51WlVnNFMyNTVZbFkzSzFOQlZYYzBabEZCWVVocWVTOW9hak5oVmt0Mk5XMUxjako1ZW1aQ2Rub3pjakpRVDNNeGRTczFZVEZxY0ZwNFJFcDRhV2MxVDNsd1ZXRXdjVFJGYXk4NVRGVnVaakZJVjBaQlVuRlRjbkY2Y1VSM04ydENlV0p3Tmxsa0sxTjZTMEZxU2s1RFNFdFNjME13UkUxd01saENaR3BXVUZnM2VtY3dkRWR5TjBoR2JuQjFTVlZaVm5CdmJTdHhhMWwyYUdkVGVGRnpkblJpVnpGa1pXOXlhM2w0UW5sM2IzRXpjR0pVVURORVFTdGhaMFp0V0U1aWFtVlljVEptVFRsaU5XTjZSbmR5VlZsQlNXYzlQU0lzSW0xaFl5STZJbUUxTmpRek9HSTVaR1k0T0RkallqQTRPR05qTVdVM01qVTFPR1F3WkRaaU9HWmtNbVJrWW1NME1UbG1aamN6TjJFM01UbGlOemd3Wm1RNE5UTXlORFVpZlE9PQ==', 1632925142),
('ZA3hkMXHxO5Lz27dX2PGLEseURt06r02jHf1ybO2', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbVppSzJRMmFYSkpXVTl3TWxkTVZISXpZM3BETDJjOVBTSXNJblpoYkhWbElqb2lhamRYVnk5dU1rNUJRV0ptYW1Gc1UxRnNSV1UxWkdZMVRFSm1Sa3RNVW1NME5FcHZTREY0U1RWbFl6WlJkR3hQZUhScU1VTlRaMkZYVEhSV1FVZHlOR0ZxZEdrMVUxWk5kbEJZUkdSbE1VWmpSRUp0VW1KamJVZFhRWFl5VlRsU2JtMTRObGR4TDJKTGQzRkZjRTlJTkZsSE1Vc3libkIzVTJOME4ydEJTazlpVDAxc2RHVnJLemRVYkZCTlVYQlRWVXRTV25GWlluTlNPV28xYW5aTWNHeFZaM1JCZVVORmIwVjZNbWxMUXpSTU9GbFJLMFZpT1RoRFpEZ3diV3hPUzNkUWFEZERaMWQ2UVhCR2FuQkJkMjloYmtKdk0xaDVNalpLY0RkVmNWUXdUVXhOYmpGR2MwUk5WME13Wm5WVVZYcFpWRkpWV0ZaTVFqVXZNbWt5ZVhaYVluRkRVWEF5WlVwRFNFVXpZMXAzYXpoRk5uYzlQU0lzSW0xaFl5STZJamt5TldJME1XWmpNelE1WkRkaE0yWXlPREUzWkRBME5UQmtOR0l6TXpjMk1HWTNOalV5TldNM1pUSTFNR1ZoTnpKak9USmlOV1U1WW1RNE5UbGxNelVpZlE9PQ==', 1632925142),
('zQtOrt0WKEA9jRwmI2KnbVe4NFVscDCRqgpPsjSA', NULL, '87.236.16.117', 'Wget/1.19.1 (linux-gnu)', 'ZXlKcGRpSTZJbFZ5WVZnNGFFVlZWRFJsWmpkWFIydEdOVWhtZFZFOVBTSXNJblpoYkhWbElqb2lWVWhzV0c1eWF6TXZaa1ZZV1dsMmNtVktNREk0U1hwaVJteEVTRGxPVUhnd1NsQlJjbGxPTlc1eVZtUnJVVk41VnpabmMwbDVjV3ROVGtOblQwTnRha0UwYkd4c2FtTTNTSEYxUzJaVE9YZzBTbnBtYlVadFpXOTZTVGRRYjBkVUx6VndVR1ZPUTFNdk5FNUdWeXRhYTBweVNTOWlUbEpUVlVGRlkxWlZXVTFTVkZWWmFXMXNiVkZOTTA5VGJWQkdXSEp3UlU0dmQwd3dkbVF2TjBOM2VGaHFVVkpUUlVsdGJqZGlZMmhtUm5GSWVWZDFZekEyUzBsQ1kwdGlkRWRxYm1jd1ZVSlFhR04wWWtSUVUxQnhXVWN3Y1hvemMyVTVVMjVVY0U5bFZVMXROR1JMUjB0WmRGSlFMMUJ6Y25OdFVXdExTR3hyT0dscmQwVTRlWEEzTVZKUGEzWklOakZRWWxWUFRtSkdjVlJHU2xOU2RVRTlQU0lzSW0xaFl5STZJbVZsTW1KbU9HTmlObUV5T0RJd09EWTNORFV5TldNd01tRmxaV1JsWW1FMU5qUmlNVEJqTVdRNU1HTXdOR0kzTVRWak1UVXhaVGN6TlRjM01qaGhOemtpZlE9PQ==', 1632925321);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vk_id` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vk_first_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vk_last_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `access` int(4) NOT NULL DEFAULT '0',
  `verification_time` datetime DEFAULT NULL,
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verify` int(4) NOT NULL DEFAULT '0',
  `balance_real` int(8) NOT NULL DEFAULT '0',
  `balance_game` int(16) NOT NULL DEFAULT '0',
  `kits_game` int(8) NOT NULL DEFAULT '0',
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_at` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inviter_id` int(16) NOT NULL DEFAULT '0',
  `inviter_income` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `logout` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `accessToken` char(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serverID` varchar(41) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `uuid`, `vk_id`, `vk_first_name`, `vk_last_name`, `ip_address`, `image`, `remember_token`, `status`, `access`, `verification_time`, `verification_code`, `email_verify`, `balance_real`, `balance_game`, `kits_game`, `api_key`, `auth_at`, `password_at`, `created_at`, `updated_at`, `inviter_id`, `inviter_income`, `logout`, `accessToken`, `serverID`) VALUES
(1, 'admin@mcstudio.su', 'Admin', '$2y$10$xChHe8QVu42egHwOJhspU.CucXXEovVakUsWGQeq32noSIBAL.J3i', '40c73079-eb42-3445-9f3c-c31a5964a44a', '', '', '', '109.124.211.207', '5e97f08226ec7.jpg', 'DY7y95rU6RIojoou2WJ0X12oshH1XPDvhY3ihZah3e7bA2COBMPg3OxfRljW', 1, 1, NULL, NULL, 1, 3785, 0, 0, '1tph46k6tukjQA2AjmZol3EFaOS9XEl', '1632926542', '2020-09-10 00:00:00', '2020-09-10 00:00:00', '2021-09-29 14:42:22', 0, '0', '0', 'f1a2b2a773b4f96c5dcaffd99896c380', '2338cd2215fdc3373be111f4b894d6871c2d2180'),
(28, 'Test@Test.ru', 'Test', '$2y$10$pzt1YfHRRW7LN38vBreCgON.3mjA7fUJsSYZL840qSpYjGnSULX/C', '444cf323-978c-3e83-9288-612345bfec67', '0', '0', '0', '109.124.211.207', NULL, NULL, 1, 0, '2021-09-26 13:44:22', NULL, 0, 1, 0, 0, 'm5L6zdazf2ZFsXWSEqPS3gj1sMrbPr', '1632653062', '0000-00-00 00:00:00', '2021-09-26 10:44:22', '2021-09-26 10:44:48', 0, '0', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_auth`
--

CREATE TABLE IF NOT EXISTS `users_auth` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_os` varchar(200) NOT NULL DEFAULT 'Unknown',
  `user_browser` varchar(200) NOT NULL DEFAULT 'Unknown',
  `type` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_auth`
--

INSERT INTO `users_auth` (`id`, `user_id`, `user_ip`, `user_os`, `user_browser`, `type`, `created_at`, `updated_at`) VALUES
(43, 27, '127.0.0.1', 'Windows', 'Chrome', 1, '2020-11-17 18:13:13', '2020-11-17 18:13:13'),
(44, 1, '127.0.0.1', 'Windows', 'Chrome', 1, '2021-01-04 13:17:36', '2021-01-04 13:17:36'),
(45, 1, '127.0.0.1', 'Windows', 'Chrome', 1, '2021-01-04 14:20:05', '2021-01-04 14:20:05'),
(46, 1, '127.0.0.1', 'Windows', 'Chrome', 1, '2021-01-12 14:03:41', '2021-01-12 14:03:41'),
(47, 1, '127.0.0.1', 'Windows', 'Chrome', 1, '2021-01-15 11:22:47', '2021-01-15 11:22:47'),
(48, 1, '127.0.0.1', 'Windows', 'Chrome', 1, '2021-01-18 20:18:50', '2021-01-18 20:18:50'),
(49, 1, '127.0.0.1', 'Windows', 'Chrome', 1, '2021-02-12 13:55:55', '2021-02-12 13:55:55'),
(50, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 14:57:18', '2021-02-28 14:57:18'),
(51, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:04:43', '2021-02-28 15:04:43'),
(52, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:08:36', '2021-02-28 15:08:36'),
(53, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:21:07', '2021-02-28 15:21:07'),
(54, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:21:56', '2021-02-28 15:21:56'),
(55, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:23:18', '2021-02-28 15:23:18'),
(56, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:55:28', '2021-02-28 15:55:28'),
(57, 1, '127.0.0.1', 'Windows', 'Chrome', 0, '2021-02-28 15:56:09', '2021-02-28 15:56:09'),
(58, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:56:22', '2021-02-28 15:56:22'),
(59, 1, '188.170.195.141', 'Windows', 'Yandex 21.8.1.468', 1, '2021-09-21 17:47:01', '2021-09-21 17:47:01'),
(60, 1, '109.124.211.207', 'Windows', 'Chrome 93.0.4577.82', 1, '2021-09-21 18:13:02', '2021-09-21 18:13:02'),
(61, 1, '94.25.170.97', 'Android', 'Chrome 93.0.4577.82', 1, '2021-09-21 18:20:02', '2021-09-21 18:20:02'),
(62, 28, '109.124.211.207', 'Windows', 'Firefox', 1, '2021-09-26 10:44:22', '2021-09-26 10:44:22'),
(63, 1, '109.124.211.207', 'Windows', 'Chrome 93.0.4577.82', 1, '2021-09-29 14:42:22', '2021-09-29 14:42:22');

-- --------------------------------------------------------

--
-- Структура таблицы `users_prefixes`
--

CREATE TABLE IF NOT EXISTS `users_prefixes` (
  `id` int(8) unsigned NOT NULL,
  `user_id` int(8) NOT NULL,
  `server_id` int(8) NOT NULL,
  `prefix_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `prefix_mine` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `prefix_full` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_privileges`
--

CREATE TABLE IF NOT EXISTS `users_privileges` (
  `id` int(8) unsigned NOT NULL,
  `user_id` int(8) NOT NULL,
  `server_id` int(8) NOT NULL,
  `privilege_id` int(8) unsigned NOT NULL,
  `privilege_term` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30',
  `privilege_price` int(32) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_ratings`
--

CREATE TABLE IF NOT EXISTS `users_ratings` (
  `id` int(8) unsigned NOT NULL,
  `user_id` int(8) NOT NULL,
  `votes` int(8) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gateway_freekassa`
--
ALTER TABLE `gateway_freekassa`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gateway_paylogs`
--
ALTER TABLE `gateway_paylogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gateway_qiwi`
--
ALTER TABLE `gateway_qiwi`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gateway_transact`
--
ALTER TABLE `gateway_transact`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gateway_unitpay`
--
ALTER TABLE `gateway_unitpay`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `kits`
--
ALTER TABLE `kits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ratings_settings`
--
ALTER TABLE `ratings_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_auth`
--
ALTER TABLE `users_auth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_prefixes`
--
ALTER TABLE `users_prefixes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_privileges`
--
ALTER TABLE `users_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- Индексы таблицы `users_ratings`
--
ALTER TABLE `users_ratings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `gateway_freekassa`
--
ALTER TABLE `gateway_freekassa`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `gateway_paylogs`
--
ALTER TABLE `gateway_paylogs`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `gateway_qiwi`
--
ALTER TABLE `gateway_qiwi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `gateway_transact`
--
ALTER TABLE `gateway_transact`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `gateway_unitpay`
--
ALTER TABLE `gateway_unitpay`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `kits`
--
ALTER TABLE `kits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `ratings_settings`
--
ALTER TABLE `ratings_settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `users_auth`
--
ALTER TABLE `users_auth`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT для таблицы `users_prefixes`
--
ALTER TABLE `users_prefixes`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users_privileges`
--
ALTER TABLE `users_privileges`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `users_ratings`
--
ALTER TABLE `users_ratings`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users_privileges`
--
ALTER TABLE `users_privileges`
  ADD CONSTRAINT `privileges_id` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
