-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 18 2015 г., 07:09
-- Версия сервера: 5.5.25
-- Версия PHP: 5.4.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `apps`
--

-- --------------------------------------------------------

--
-- Структура таблицы `app`
--

CREATE TABLE IF NOT EXISTS `app` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `service` enum('google') NOT NULL DEFAULT 'google' COMMENT 'Сервис',
  `service_appname` varchar(255) NOT NULL COMMENT 'ID в сервисе',
  `name` varchar(255) NOT NULL COMMENT 'Название',
  `type` tinyint(1) NOT NULL COMMENT 'Тип',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Приложения' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `short_name` char(2) NOT NULL COMMENT 'Краткое название',
  `name` varchar(255) NOT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Страны' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `country_include_to_order`
--

CREATE TABLE IF NOT EXISTS `country_include_to_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT 'ID Заказа',
  `country_id` int(11) NOT NULL COMMENT 'ID Страны',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`country_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Страны, которые включены в заказ' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `goal`
--

CREATE TABLE IF NOT EXISTS `goal` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT 'Цель',
  `description` text NOT NULL COMMENT 'Описание',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Цели' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `goal`
--

INSERT INTO `goal` (`id`, `name`, `description`) VALUES
(1, 'Инсталляция', 'Выполнить установку приложения на устройство'),
(2, 'Голосование', 'Создать комментарий к приложению и оценить приложение '),
(3, 'Запуск', 'Выполнить комментирование, оценку и запуск приложения');

-- --------------------------------------------------------

--
-- Структура таблицы `goal_to_order`
--

CREATE TABLE IF NOT EXISTS `goal_to_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT 'ID Заказа',
  `goal_id` int(11) NOT NULL COMMENT 'ID Цели',
  `period_seconds` enum('0','60','3600','86400','604800') NOT NULL DEFAULT '0' COMMENT 'Время периодичности в секундах',
  `period_value` int(11) NOT NULL DEFAULT '0' COMMENT 'Значение множителя периода',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`goal_id`),
  KEY `goal_id` (`goal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Цели, которые включены в заказ' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID Пользователя',
  `app_id` int(11) NOT NULL COMMENT 'ID Приложения',
  `total_price` decimal(10,2) unsigned NOT NULL COMMENT 'Общая стоимость',
  `status` tinyint(1) NOT NULL COMMENT 'Статус выполнения',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`app_id`),
  KEY `app_id` (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заказы' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `payment_system`
--

CREATE TABLE IF NOT EXISTS `payment_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `short_name` varchar(50) NOT NULL COMMENT 'Краткое название',
  `name` varchar(255) NOT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Платёжные системы' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `payment_system`
--

INSERT INTO `payment_system` (`id`, `short_name`, `name`) VALUES
(1, 'WMR', 'Webmoney (RUB)');

-- --------------------------------------------------------

--
-- Структура таблицы `payment_system_to_user`
--

CREATE TABLE IF NOT EXISTS `payment_system_to_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID Пользователя',
  `payment_system_id` int(11) NOT NULL COMMENT 'ID Платёжной системы',
  `value` varchar(255) NOT NULL COMMENT 'ID в платёжной системе',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`payment_system_id`),
  KEY `payment_system_id` (`payment_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Платёжные системы пользователя' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `name` varchar(50) NOT NULL COMMENT 'Ник',
  `password` char(32) NOT NULL COMMENT 'Пароль',
  `salt` char(6) NOT NULL COMMENT 'Соль',
  `type` tinyint(1) NOT NULL COMMENT 'Тип',
  `balance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Текущий баланс в системе',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Пользователи' AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `country_include_to_order`
--
ALTER TABLE `country_include_to_order`
  ADD CONSTRAINT `country_include_to_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `country_include_to_order_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `goal_to_order`
--
ALTER TABLE `goal_to_order`
  ADD CONSTRAINT `goal_to_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `goal_to_order_ibfk_2` FOREIGN KEY (`goal_id`) REFERENCES `goal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`app_id`) REFERENCES `app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `payment_system_to_user`
--
ALTER TABLE `payment_system_to_user`
  ADD CONSTRAINT `payment_system_to_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_system_to_user_ibfk_2` FOREIGN KEY (`payment_system_id`) REFERENCES `payment_system` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
