-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 29 2019 г., 10:11
-- Версия сервера: 5.7.24-0ubuntu0.16.04.1
-- Версия PHP: 5.6.38-3+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pdd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `prefix_payment_bill`
--

CREATE TABLE `prefix_payment_bill` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `price` float NOT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `callback` varchar(200) COLLATE utf8_bin NOT NULL,
  `params` varchar(500) COLLATE utf8_bin NOT NULL,
  `date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_payment` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `prefix_payment_bill`
--
ALTER TABLE `prefix_payment_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price` (`price`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `date_create` (`date_create`),
  ADD KEY `date_payment` (`date_payment`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `prefix_payment_bill`
--
ALTER TABLE `prefix_payment_bill`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;