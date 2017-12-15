-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 15 2017 г., 07:43
-- Версия сервера: 5.5.56-MariaDB
-- Версия PHP: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  `status_id` tinyint(2) NOT NULL,
  `label` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `lists`
--

INSERT INTO `lists` (`id`, `user_id`, `add_time`, `status_id`, `label`) VALUES
(6, 11, 1513281808, 1, 'test'),
(7, 11, 1513282735, 1, 'test'),
(8, 11, 1513282736, 1, 'test'),
(9, 11, 1513282737, 1, 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` tinyint(2) NOT NULL,
  `permission` varchar(8) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `permission`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `unit_id`) VALUES
(1, 'meat', 1),
(2, 'test - 1', 1),
(3, 'test - 2', 1),
(4, 'test - 3', 1),
(5, 'test - 4', 1),
(6, 'test - 5', 1),
(7, 'test - 6', 1),
(8, 'test - 7', 1),
(9, 'test - 8', 1),
(10, 'test - 9', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products_lists`
--

CREATE TABLE `products_lists` (
  `product_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `products_lists`
--

INSERT INTO `products_lists` (`product_id`, `list_id`) VALUES
(1, 8),
(2, 7),
(2, 8),
(3, 7),
(3, 8),
(4, 7),
(4, 8),
(5, 7),
(5, 8),
(6, 7),
(6, 8),
(7, 7),
(7, 8),
(8, 7),
(8, 8),
(9, 7),
(9, 8),
(10, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` tinyint(2) NOT NULL,
  `status` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `status`) VALUES
(1, 'open'),
(2, 'close');

-- --------------------------------------------------------

--
-- Структура таблицы `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit` varchar(16) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `units`
--

INSERT INTO `units` (`id`, `unit`) VALUES
(1, 'kg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `surname` varchar(45) COLLATE utf8_bin NOT NULL,
  `registration_date` date NOT NULL,
  `login` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(45) COLLATE utf8_bin NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `permission_id` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `registration_date`, `login`, `password`, `email`, `permission_id`) VALUES
(11, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(12, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(13, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(14, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(15, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(16, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(17, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(18, 'TEST', 'TEST1', '0000-00-00', '', '', '', 1),
(19, 'Tadeus', 'Tunkevic', '2017-12-13', 'tade4ex', '098f6bcd4621d373cade4e832627b4f6', 'tade4ex@gmail.com', 1),
(20, 'Tadeus', 'Tunkevic', '2017-12-13', 'tade4ex', '098f6bcd4621d373cade4e832627b4f6', 'tade4ex@gmail.com', 1),
(21, 'Tadeus', 'Tunkevic', '2017-12-13', 'tade4ex', '098f6bcd4621d373cade4e832627b4f6', 'tade4ex@gmail.com', 1),
(22, 'Tadeus', 'Tunkevic', '2017-12-13', 'tade4ex', '098f6bcd4621d373cade4e832627b4f6', 'tade4ex@gmail.com', 1),
(23, 'Tadeus', 'Tunkevic', '2017-12-13', 'tade4ex', '098f6bcd4621d373cade4e832627b4f6', 'tade4ex@gmail.com', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users_lists`
--

CREATE TABLE `users_lists` (
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `users_lists`
--

INSERT INTO `users_lists` (`user_id`, `list_id`) VALUES
(11, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `users_products`
--

CREATE TABLE `users_products` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lists_users` (`user_id`),
  ADD KEY `fk_lists_statuses` (`status_id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_units` (`unit_id`);

--
-- Индексы таблицы `products_lists`
--
ALTER TABLE `products_lists`
  ADD PRIMARY KEY (`product_id`,`list_id`),
  ADD KEY `fk_products_lists_lists` (`list_id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_permissions` (`permission_id`);

--
-- Индексы таблицы `users_lists`
--
ALTER TABLE `users_lists`
  ADD PRIMARY KEY (`user_id`,`list_id`),
  ADD KEY `fk_users_lists_lists` (`list_id`);

--
-- Индексы таблицы `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `fk_users_products_products` (`product_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `fk_lists_statuses` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `fk_lists_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_units` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Ограничения внешнего ключа таблицы `products_lists`
--
ALTER TABLE `products_lists`
  ADD CONSTRAINT `fk_products_lists_lists` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`),
  ADD CONSTRAINT `fk_products_lists_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Ограничения внешнего ключа таблицы `users_lists`
--
ALTER TABLE `users_lists`
  ADD CONSTRAINT `fk_users_lists_lists` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`),
  ADD CONSTRAINT `fk_users_lists_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `fk_users_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_users_products_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
