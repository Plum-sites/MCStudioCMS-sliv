-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 06 2021 г., 18:19
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `server_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Студии', NULL, '2', 1, '2021-03-06 14:17:47', '2021-03-06 14:17:47');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_freekassa`
--

CREATE TABLE `gateway_freekassa` (
  `id` int(8) NOT NULL,
  `name` varchar(250) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `link` varchar(128) NOT NULL,
  `store_id` int(8) NOT NULL,
  `key_public` varchar(128) NOT NULL,
  `key_secret` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL DEFAULT 'Пополнение баланса',
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gateway_freekassa`
--

INSERT INTO `gateway_freekassa` (`id`, `name`, `fullname`, `link`, `store_id`, `key_public`, `key_secret`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free-Kassa', 'Free-Kassa.Ru', 'http://www.free-kassa.ru/merchant/cash.php', 0, '0', '0', 'Пополнение баланса', 0, '2020-11-06 14:50:06', '2020-11-06 14:50:06');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_paylogs`
--

CREATE TABLE `gateway_paylogs` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `money` int(8) NOT NULL,
  `bonus` int(8) NOT NULL,
  `system` varchar(128) NOT NULL DEFAULT 'Unknown',
  `status` int(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_transact`
--

CREATE TABLE `gateway_transact` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gateway_transact`
--

INSERT INTO `gateway_transact` (`id`, `user_id`, `gateway`, `amount`, `user_balance`, `charge`, `type`, `trx`, `refund`, `created_at`, `updated_at`) VALUES
(3, '1', 'Admin', '7621', '0.00', NULL, 0, 'c791cad63881bc8c', 0, '2020-11-06 14:39:17', '2020-11-06 14:39:17'),
(4, '1', 'Admin', '7022', '0.00', NULL, 0, 'f80325ab7ab55642', 0, '2021-02-20 08:50:59', '2021-02-20 08:50:59');

-- --------------------------------------------------------

--
-- Структура таблицы `gateway_unitpay`
--

CREATE TABLE `gateway_unitpay` (
  `id` int(8) NOT NULL,
  `name` varchar(250) NOT NULL DEFAULT 'UnitPay',
  `fullname` varchar(200) DEFAULT NULL,
  `link` varchar(128) NOT NULL DEFAULT 'https://unitpay.ru/pay/',
  `key_public` varchar(200) NOT NULL DEFAULT 'key_public',
  `key_secret` varchar(200) NOT NULL DEFAULT 'key_secret',
  `description` varchar(128) NOT NULL DEFAULT 'Пополнение баланса',
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gateway_unitpay`
--

INSERT INTO `gateway_unitpay` (`id`, `name`, `fullname`, `link`, `key_public`, `key_secret`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UnitPay', 'UnitPay.Money', 'https://unitpay.money/pay', '0', '0', 'Пополнение баланса', 0, '2021-01-04 15:10:54', '2020-11-06 14:50:04');

-- --------------------------------------------------------

--
-- Структура таблицы `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_offline` int(4) NOT NULL DEFAULT 0,
  `launcher_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix_cmd` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pex user %player% set prefix %prefix%',
  `base_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_currency` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COIN',
  `game_symbol` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COIN',
  `exch_rubs_to_coin` int(4) NOT NULL DEFAULT 2,
  `vote_gift_type` int(4) NOT NULL DEFAULT 1,
  `vote_gift_count` int(8) NOT NULL DEFAULT 20,
  `gateway_use` int(4) NOT NULL DEFAULT 0,
  `reg` tinyint(4) DEFAULT NULL,
  `email_verification` tinyint(4) DEFAULT NULL,
  `email_notification` tinyint(4) DEFAULT NULL,
  `vk_client_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `vk_client_secret` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vk_redirect_uri` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vk_group_id` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '172494684',
  `vk_group_token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '290e6f14206f0082fedae22d1bc4547b67676b7a36cae75cee21d5199100d045dd2e0afe3bdfd3fc15cf9',
  `vk_output_count` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
  `launcher_link_jar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discord_server_id` bigint(20) DEFAULT NULL,
  `currency_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_admin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services_discount_status` int(4) NOT NULL DEFAULT 0,
  `services_discount_percent` int(3) NOT NULL DEFAULT 0,
  `services_discount_datetime` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sw_exchange` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_ratings` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_banlist` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_kits` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_prefixes` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `sw_shop` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `invite_percent` int(4) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `description`, `site_offline`, `launcher_link`, `prefix_cmd`, `base_color`, `base_currency`, `currency_symbol`, `game_currency`, `game_symbol`, `exch_rubs_to_coin`, `vote_gift_type`, `vote_gift_count`, `gateway_use`, `reg`, `email_verification`, `email_notification`, `vk_client_id`, `vk_client_secret`, `vk_redirect_uri`, `vk_group_id`, `vk_group_token`, `vk_output_count`, `launcher_link_jar`, `discord_server_id`, `currency_rate`, `e_admin`, `e_sender`, `e_message`, `header_text`, `header_desc`, `services_discount_status`, `services_discount_percent`, `services_discount_datetime`, `sw_exchange`, `sw_ratings`, `sw_banlist`, `sw_kits`, `sw_prefixes`, `sw_shop`, `invite_percent`, `created_at`, `updated_at`) VALUES
(1, 'MCSTUDIO', 'Игровой проект Minecraft', 0, '/MCSTUDIO.exe', 'pex user %player% set prefix %prefix%', '777777', 'руб', 'рубл.', 'COIN', 'коин.', 100, 1, 20, 1, 1, 0, 0, '29463522', 'SjhIA5W4GipmTGmR3lPV', 'https://mcstudio.su/login/vk/auth', '29463522', '205cb03c205cb03c205cb03ce42028fa042205c205cb03c7f21296d5554d20042ede9cc', '6', '/MCSTUDIO.jar', 1, '77.73', 'admin@hype-mc.ru', 'no-reply@mcstudio.su', 'Hi, {{name}},\r\n{{message}}', 'MCSTUDIO', 'Minecraft project', 0, 5, '2020-05-30T12:30', 'true', 'true', 'true', 'true', 'true', 'true', 5, '2018-06-04 00:06:40', '2021-01-26 14:05:38');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` int(8) NOT NULL,
  `category_id` int(8) NOT NULL,
  `item_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(32) NOT NULL,
  `price` int(32) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `server_id`, `category_id`, `item_id`, `count`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(17, 'MCSTUDIO', NULL, 2, 5, 'MCSTUDIO', 1, 10, 'b620c16ff6af1867a2cb2c4e43414246.png', 1, '2021-03-06 14:18:15', '2021-03-06 14:18:15');

-- --------------------------------------------------------

--
-- Структура таблицы `kits`
--

CREATE TABLE `kits` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` int(8) NOT NULL,
  `server_cmd` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(8) NOT NULL DEFAULT 1,
  `price` int(32) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `kits`
--

INSERT INTO `kits` (`id`, `name`, `description`, `server_id`, `server_cmd`, `count`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 'test', 'Набор ресурсов', 2, 'test', 1, 10, '7b1a5cb2011e9d4d22a2918b2b6d0ae6.png', 1, '2021-03-06 13:37:40', '2021-03-06 13:37:40');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `status`, `created_at`, `updated_at`) VALUES
('maximcska@gmail.com', '2wKzeuSFNnTMZqtF0uV4Iy5a8Pm193', 0, '2021-01-04 14:05:08', '2021-01-04 14:05:08'),
('admin@mcstudio.su', 'LVmJcy6RVkkoRpEsI8HnQ4ZmqgSCvj', 0, '2021-02-28 15:07:05', '2021-02-28 15:07:05');

-- --------------------------------------------------------

--
-- Структура таблицы `privileges`
--

CREATE TABLE `privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` int(8) NOT NULL,
  `term_days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30',
  `skin` int(4) NOT NULL DEFAULT 1,
  `skin_hd` int(4) NOT NULL DEFAULT 0,
  `cloak` int(4) NOT NULL DEFAULT 0,
  `cloak_hd` int(4) NOT NULL DEFAULT 0,
  `prefix` int(4) NOT NULL DEFAULT 0,
  `price` int(32) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `display_name`, `description`, `server_id`, `term_days`, `skin`, `skin_hd`, `cloak`, `cloak_hd`, `prefix`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 'vip', 'VIP', NULL, 2, '30', 1, 1, 0, 0, 0, 90, '8503420a34e43933fd8d62f18d08efef.png', 1, '2020-10-07 16:12:22', '2020-10-07 16:13:17'),
(7, 'premium', 'Premium', NULL, 2, '30', 1, 1, 1, 0, 0, 149, 'c1f44c8a7793973d5b319741c6c14447.png', 1, '2020-10-07 16:13:09', '2020-10-07 16:13:09');

-- --------------------------------------------------------

--
-- Структура таблицы `promos`
--

CREATE TABLE `promos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `sales` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `promos`
--

INSERT INTO `promos` (`id`, `code`, `desc`, `type`, `value`, `active`, `sales`) VALUES
(2, 'SKIDKA10', 'Скидка 10%', 2, 10, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ratings_settings`
--

CREATE TABLE `ratings_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `vote_gift_type` int(4) NOT NULL DEFAULT 1,
  `vote_gift_count` int(8) NOT NULL DEFAULT 20,
  `vote_gift_kit` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'kit vote',
  `link_mcrate` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://mcrate.su/project/ID',
  `link_topcraft` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://topcraft.ru/servers/ID/',
  `link_minecraftrating` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'http://minecraftrating.ru/server/ID/',
  `secret_mcrate` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'secret_key',
  `secret_topcraft` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'secret_key',
  `secret_minecraftrating` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'secret_key',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ratings_settings`
--

INSERT INTO `ratings_settings` (`id`, `vote_gift_type`, `vote_gift_count`, `vote_gift_kit`, `link_mcrate`, `link_topcraft`, `link_minecraftrating`, `secret_mcrate`, `secret_topcraft`, `secret_minecraftrating`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'kit vote', '1', 'Admin', '0', '1234561', '1', '0', '2021-01-04 14:52:57', '2021-02-25 16:35:09');

-- --------------------------------------------------------

--
-- Структура таблицы `servers`
--

CREATE TABLE `servers` (
  `id` int(16) NOT NULL,
  `name` varchar(32) DEFAULT 'Server',
  `description` varchar(250) DEFAULT 'Description',
  `ip` varchar(128) NOT NULL DEFAULT '127.0.0.1',
  `port` varchar(8) NOT NULL DEFAULT '25565',
  `online` int(8) NOT NULL DEFAULT 0,
  `slots` int(8) NOT NULL DEFAULT 0,
  `max_online` int(8) DEFAULT 0,
  `mysql_host` varchar(128) DEFAULT NULL,
  `mysql_base` varchar(128) DEFAULT NULL,
  `mysql_user` varchar(128) DEFAULT NULL,
  `mysql_pass` varchar(128) DEFAULT NULL,
  `mysql_port` varchar(128) DEFAULT NULL,
  `mysql_table_bans` varchar(128) DEFAULT NULL,
  `mysql_table_coin` varchar(128) DEFAULT NULL,
  `mysql_table_shop` varchar(128) DEFAULT NULL,
  `mysql_table_pref` varchar(128) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `servers`
--

INSERT INTO `servers` (`id`, `name`, `description`, `ip`, `port`, `online`, `slots`, `max_online`, `mysql_host`, `mysql_base`, `mysql_user`, `mysql_pass`, `mysql_port`, `mysql_table_bans`, `mysql_table_coin`, `mysql_table_shop`, `mysql_table_pref`, `status`, `created_at`, `updated_at`) VALUES
(2, 'HiTech', 'Description', '89.163.204.9', '25583', 0, 0, 11, '89.163.204.9', 's1684_hta', 'u1684_boU1PRXZhW', 'EUEGIiraV!WiekVi+s!WiVKn', '3306', 'litebans_bans', 'iConomy', 'purchases', 'permissions', 1, '2021-03-06 13:23:33', '2021-03-06 13:23:33');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pglGK9rVauZGzi94YWPdWMe9dwxz9HUmNjPKLmdQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'ZXlKcGRpSTZJalJOUmtJeVIyUnZkekJuYjJSemRUTlJObUZvZGtFOVBTSXNJblpoYkhWbElqb2lNa1JCZFUxVFNYVTVUa1JvZG5GTVQwVTBZemhJVm1OcWNXWm5UbnBRU2tOWVNURnpjMDF2Ykdzd1ZXZFpOek0zU0hSWmFuVmtWVXRWYkdNeWFteE9RMUI1WVhSVFpWcExlVzl6VUZWRWRFdEpXVGswTVhaNk5qbE9kMEpJVjJrelR6SmlXVlp6U2toUFdYVldVazlIVFUwdk5FUkZhM1JvVWtOMlZ6WmFUREpTVGtaRmRXOVNiWFl3UTBoR1EwZzJhWEZMZUVOT1UyMXhTWEl2SzBreWRrbExTVFZ0VWsxT2NHRkxUMjh2VlVaaU1IVnlhVmN3U2tJemVFWklWa05yTWtKMFYzaFdUR3RsZFdrNVdFRkVRMlJXTHpkWlprVkROV1V5Y1dGSlZWVkdWMWhJYW0xeU5VcDJXaXRwVEc4dll6UmtUV1kzUkZkUmNUaFFiR2t6Tm5sbk1rUnhjakp3VTJkeVVsZFZNa3N4UkVsR1RXWmhlSGxLT0hodFZHMVBlbU5IYWxwdlIwTlpSMHhQYVhGeFEzQnhRWEIyUmtGeGVHWlFWMWhYV1dWcGNHWlpLM0JEV2tGNk1VOXRVblZoTUhoT1QyNW1UbWhLVlhOMlEwaE1iSEEzVTJwNFdXUTNkMEZ5YVdwM09IaGFUbEJ0VWpBdloyaEhaMVJUVldwck1XcEtXRzB5UlROaGVFYzFkazgxYWpaUGIyVldVbVF6YzJWc09YVlRjME5aY2sxaFZtUTFUemQ0UlQwaUxDSnRZV01pT2lJNVpqWm1ZVFpsWTJOa09HUm1aak5pTXpFM1pXSTNPREpsTXpaaVkySmxPREZsWkdGbE5UQmtaamd3TURVNU16UmhNalk1Wm1JNU5EbGhOVGN5WlRVNUluMD0=', 1615041700);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `access` int(4) NOT NULL DEFAULT 0,
  `verification_time` datetime DEFAULT NULL,
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verify` int(4) NOT NULL DEFAULT 0,
  `balance_real` int(8) NOT NULL DEFAULT 0,
  `balance_game` int(16) NOT NULL DEFAULT 0,
  `kits_game` int(8) NOT NULL DEFAULT 0,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_at` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inviter_id` int(16) NOT NULL DEFAULT 0,
  `inviter_income` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `logout` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `accessToken` char(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serverID` varchar(41) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `uuid`, `vk_id`, `vk_first_name`, `vk_last_name`, `ip_address`, `image`, `remember_token`, `status`, `access`, `verification_time`, `verification_code`, `email_verify`, `balance_real`, `balance_game`, `kits_game`, `api_key`, `auth_at`, `password_at`, `created_at`, `updated_at`, `inviter_id`, `inviter_income`, `logout`, `accessToken`, `serverID`) VALUES
(1, 'admin@mcstudio.su', 'Admin', '$2y$10$xChHe8QVu42egHwOJhspU.CucXXEovVakUsWGQeq32noSIBAL.J3i', '40c73079-eb42-3445-9f3c-c31a5964a44a', '', '', '', '127.0.0.1', '5e97f08226ec7.jpg', 'DY7y95rU6RIojoou2WJ0X12oshH1XPDvhY3ihZah3e7bA2COBMPg3OxfRljW', 1, 1, NULL, NULL, 1, 3765, 0, 0, '1tph46k6tukjQA2AjmZol3EFaOS9XEl', '1615041663', '2020-09-10 00:00:00', '2020-09-10 00:00:00', '2021-03-06 14:41:36', 0, '0', '0', 'f1a2b2a773b4f96c5dcaffd99896c380', '2338cd2215fdc3373be111f4b894d6871c2d2180');

-- --------------------------------------------------------

--
-- Структура таблицы `users_auth`
--

CREATE TABLE `users_auth` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_os` varchar(200) NOT NULL DEFAULT 'Unknown',
  `user_browser` varchar(200) NOT NULL DEFAULT 'Unknown',
  `type` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(58, 1, '127.0.0.1', 'Windows', 'Chrome 88.0.4324.190', 1, '2021-02-28 15:56:22', '2021-02-28 15:56:22');

-- --------------------------------------------------------

--
-- Структура таблицы `users_prefixes`
--

CREATE TABLE `users_prefixes` (
  `id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) NOT NULL,
  `server_id` int(8) NOT NULL,
  `prefix_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `prefix_mine` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `prefix_full` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_privileges`
--

CREATE TABLE `users_privileges` (
  `id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) NOT NULL,
  `server_id` int(8) NOT NULL,
  `privilege_id` int(8) UNSIGNED NOT NULL,
  `privilege_term` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30',
  `privilege_price` int(32) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_privileges`
--

INSERT INTO `users_privileges` (`id`, `user_id`, `server_id`, `privilege_id`, `privilege_term`, `privilege_price`, `status`, `created_at`, `updated_at`) VALUES
(10, 1, 2, 6, '1617629289', 81, 1, '2021-03-06 13:28:09', '2021-03-06 13:28:09');

-- --------------------------------------------------------

--
-- Структура таблицы `users_ratings`
--

CREATE TABLE `users_ratings` (
  `id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) NOT NULL,
  `votes` int(8) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `gateway_freekassa`
--
ALTER TABLE `gateway_freekassa`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `gateway_paylogs`
--
ALTER TABLE `gateway_paylogs`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `gateway_transact`
--
ALTER TABLE `gateway_transact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `gateway_unitpay`
--
ALTER TABLE `gateway_unitpay`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `kits`
--
ALTER TABLE `kits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `ratings_settings`
--
ALTER TABLE `ratings_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `users_auth`
--
ALTER TABLE `users_auth`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `users_prefixes`
--
ALTER TABLE `users_prefixes`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users_privileges`
--
ALTER TABLE `users_privileges`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users_ratings`
--
ALTER TABLE `users_ratings`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users_privileges`
--
ALTER TABLE `users_privileges`
  ADD CONSTRAINT `privileges_id` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
