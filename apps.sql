SET FOREIGN_KEY_CHECKS = 0;

-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2015 at 02:54 PM
-- Server version: 5.1.40
-- PHP Version: 5.4.42

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE IF NOT EXISTS `app` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `service` enum('google') NOT NULL DEFAULT 'google' COMMENT 'Сервис',
  `service_appname` varchar(255) NOT NULL COMMENT 'ID в сервисе',
  `name` varchar(255) NOT NULL COMMENT 'Название',
  `type` tinyint(1) NOT NULL COMMENT 'Тип (0 - бесплатное, 1 - платное)',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Приложения' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `app`
--


-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `short_name` char(2) NOT NULL COMMENT 'Краткое название',
  `name` varchar(255) NOT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Страны' AUTO_INCREMENT=243 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `short_name`, `name`) VALUES
(1, '', 'Российская Федерация'),
(2, '', 'Украина'),
(3, '', 'Соединенные Штаты Америки'),
(7, '', 'Алжирская Народная Демократическая Республика'),
(14, '', 'Аргентинская Республика'),
(15, '', 'Республика Армения'),
(17, '', 'Австралия'),
(18, '', 'Австрийская Республика'),
(19, '', 'Азербайджанская Республика'),
(24, '', 'Республика Беларусь'),
(25, '', 'Королевство Бельгия'),
(35, '', 'Федеративная Республика Бразилия'),
(38, '', 'Республика Болгария'),
(41, '', 'Королевство Камбоджа'),
(43, '', 'Канада'),
(48, '', 'Республика Чили'),
(49, '', 'Китайская Народная Республика'),
(59, '', 'Республика Хорватия'),
(62, '', 'Республика Кипр'),
(63, '', 'Чешская Республика'),
(64, '', 'Королевство Дания'),
(67, '', 'Доминиканская Республика'),
(68, '', 'Республика Эквадор'),
(69, '', 'Арабская Республика Египет'),
(73, '', 'Эстонская Республика'),
(78, '', 'Финляндская Республика'),
(79, '', 'Французская Республика'),
(85, '', 'Грузия'),
(86, '', 'Федеративая Республика Германия'),
(89, '', 'Греческая Республика'),
(94, '', 'Республика Гватемала'),
(103, '', 'Hong Kong'),
(104, '', 'Венгерская Республика'),
(105, '', 'Республика Исландия'),
(106, '', 'Республика Индия'),
(107, '', 'Республика Индонезия'),
(108, '', 'Исламская Республика Иран'),
(109, '', 'Республика Ирак'),
(110, '', 'Ирландия'),
(112, '', 'Государство Израиль'),
(113, '', 'Итальянская Республика'),
(115, '', 'Япония'),
(117, '', 'Иорданское Хашимитское Королевство'),
(118, '', 'Республика Казахстан'),
(122, '', 'Республика Корея'),
(124, '', 'Кыргызская Республика'),
(126, '', 'Латвийская Республика'),
(127, '', 'Ливанская Республика'),
(132, '', 'Литовская Республика'),
(133, '', 'Великое Герцогство Люксембург'),
(134, '', 'Macao'),
(135, '', 'бывшая югославская Республика Македония'),
(138, '', 'Малайзия'),
(141, '', 'Республика Мальта'),
(149, '', 'Республика Молдова'),
(151, '', 'Монголия'),
(152, '', 'Черногория'),
(154, '', 'Королевство Марокко'),
(159, '', 'Федеративная Демократическая Республика Непал'),
(160, '', 'Королевство Нидерландов'),
(162, '', 'Новая Зеландия'),
(169, '', 'Королевство Норвегия'),
(170, '', 'Occupied Palestinian Territory'),
(180, '', 'Республика Польша'),
(181, '', 'Португальская Республика'),
(185, '', 'Румыния'),
(197, '', 'Королевство Саудовская Аравия'),
(199, '', 'Республика Сербия'),
(204, '', 'Словацкая Республика'),
(205, '', 'Республика Словения'),
(211, '', 'Королевство Испания'),
(212, '', 'Демократическая Социалистическая Республика Шри-Ланка'),
(217, '', 'Королевство Швеция'),
(218, '', 'Швейцарская Конфедерация'),
(220, '', 'Taiwan, Province of China'),
(221, '', 'Республика Таджикистан'),
(223, '', 'Королевство Таиланд'),
(229, '', 'Тунисская Республика'),
(230, '', 'Турецкая Республика'),
(231, '', 'Туркменистан'),
(235, '', 'Объединенные Арабские Эмираты'),
(236, '', 'Соединенное Королевство Великобритании и Северной Ирландии'),
(239, '', 'Республика Узбекистан'),
(242, '', 'Социалистическая Республика Вьетнам');

-- --------------------------------------------------------

--
-- Table structure for table `country_include_to_order`
--

CREATE TABLE IF NOT EXISTS `country_include_to_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT 'ID Заказа',
  `country_id` int(11) NOT NULL COMMENT 'ID Страны',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`country_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Страны, которые включены в заказ' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `country_include_to_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE IF NOT EXISTS `goal` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT 'Цель',
  `description` text NOT NULL COMMENT 'Описание',
  `base_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Цели' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`id`, `name`, `description`, `base_price`) VALUES
(1, 'Инсталляция', 'Скачать и установить приложение', 6.00),
(2, 'Инсталляция и голосование', 'Скачать и установить приложение, оценить его и оставить отзыв', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `goal_to_order`
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

--
-- Dumping data for table `goal_to_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID Пользователя',
  `app_id` int(11) NOT NULL COMMENT 'ID Приложения',
  `vote_mark_id` int(11) DEFAULT NULL COMMENT 'Оценка для голосования',
  `name` varchar(255) NOT NULL COMMENT 'Название приложения',
  `ref_link` varchar(255) NOT NULL COMMENT 'Ссылка для переадресации',
  `description` text NOT NULL COMMENT 'Описание заказа',
  `icon_filename` varchar(255) NOT NULL COMMENT 'Иконка',
  `total_users` int(11) NOT NULL COMMENT 'Общее количество исполнителей',
  `total_price` decimal(10,2) unsigned NOT NULL COMMENT 'Общая стоимость',
  `status` tinyint(1) NOT NULL COMMENT 'Статус выполнения',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`app_id`),
  KEY `app_id` (`app_id`),
  KEY `vote_mark_id` (`vote_mark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заказы' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `order`
--


-- --------------------------------------------------------

--
-- Table structure for table `payment_system`
--

CREATE TABLE IF NOT EXISTS `payment_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `short_name` varchar(50) NOT NULL COMMENT 'Краткое название',
  `name` varchar(255) NOT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Платёжные системы' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payment_system`
--

INSERT INTO `payment_system` (`id`, `short_name`, `name`) VALUES
(1, 'WMR', 'Webmoney (RUB)');

-- --------------------------------------------------------

--
-- Table structure for table `payment_system_to_user`
--

CREATE TABLE IF NOT EXISTS `payment_system_to_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID Пользователя',
  `payment_system_id` int(11) NOT NULL COMMENT 'ID Платёжной системы',
  `value` varchar(255) NOT NULL COMMENT 'ID в платёжной системе',
  PRIMARY KEY (`id`),
  KEY `payment_system_id` (`payment_system_id`),
  KEY `user_id` (`user_id`,`payment_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Платёжные системы пользователя' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `payment_system_to_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'min_output_amount', '100');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID Пользователя',
  `order_id` int(11) NOT NULL COMMENT 'ID Заказа',
  `status` int(11) NOT NULL COMMENT 'Статус выполнения',
  `app_comment` text NOT NULL,
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`order_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `task`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ID Пользователя',
  `payment_system_to_user_id` int(11) DEFAULT NULL COMMENT 'ID Кошелька Пользователя',
  `type` tinyint(1) NOT NULL COMMENT 'Тип операции',
  `amount` decimal(10,2) NOT NULL COMMENT 'Сумма операции',
  `status` tinyint(1) NOT NULL COMMENT 'Статус операции',
  `comment_admin` varchar(255) NOT NULL COMMENT 'Примечания админа',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`payment_system_to_user_id`),
  KEY `payment_system_to_user_id` (`payment_system_to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `transaction`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaction_wm`
--

CREATE TABLE IF NOT EXISTS `transaction_wm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LMI_MODE` tinyint(1) NOT NULL COMMENT 'Указывает, в каком режиме выполнялась обработка запроса на платеж. Может принимать два значения: 0: Платеж выполнялся в реальном режиме, средства переведены с кошелька покупателя на кошелек продавца; 1: Платеж выполнялся в тестовом режиме, средства реальн',
  `LMI_PAYMENT_AMOUNT` decimal(10,2) NOT NULL COMMENT 'Сумма, которую заплатил покупатель. Дробная часть отделяется точкой.',
  `LMI_PAYEE_PURSE` varchar(255) NOT NULL COMMENT 'Кошелек продавца, на который покупатель совершил платеж. Формат - буква и 12 цифр.',
  `LMI_PAYMENT_NO` int(11) NOT NULL COMMENT ' В этом поле передается номер покупки в соответствии с системой учета продавца, полученный сервисом с веб-сайта продавца.',
  `LMI_PAYER_WM` int(11) NOT NULL COMMENT ' WM-идентификатор покупателя, совершившего платеж.',
  `LMI_PAYER_PURSE` varchar(255) NOT NULL COMMENT ' WM-кошелек покупателя, совершающего платеж.',
  `LMI_PAYER_COUNTRYID` char(2) NOT NULL COMMENT 'двухбуквенный ISO https://ru.wikipedia.org/wiki/ISO_3166-1 код страны текущего местонахождения, которая указана плательщиком',
  `LMI_PAYER_PCOUNTRYID` char(2) NOT NULL COMMENT 'двухбуквенный ISO https://ru.wikipedia.org/wiki/ISO_3166-1 код страны выдачи паспорта, если паспортные данные указаны плательщиком',
  `LMI_PAYER_IP` char(15) NOT NULL COMMENT 'IP-адрес плательщика в момент совершения платежа',
  `LMI_SYS_INVS_NO` int(11) NOT NULL COMMENT ' Номер счета в системе WebMoney Transfer, выставленный покупателю от имени продавца в процессе обработки запроса на выполнение платежа сервисом Web Merchant Interface. Является уникальным в системе WebMoney Transfer.',
  `LMI_SYS_TRANS_NO` int(11) NOT NULL COMMENT ' Номер платежа в системе WebMoney Transfer, выполненный в процессе обработки запроса на выполнение платежа сервисом Web Merchant Interface. Является уникальным в системе WebMoney Transfer.',
  `LMI_SYS_TRANS_DATE` char(17) NOT NULL COMMENT 'Дата и время реального прохождения платежа в системе WebMoney Transfer в формате "YYYYMMDD HH:MM:SS".',
  `LMI_HASH` char(64) NOT NULL COMMENT 'Контрольная подпись оповещения о выполнении платежа, которая используется для проверки целостности полученной информации и однозначной идентификации отправителя. Алгоритм формирования описан в разделе Контрольная подпись данных о платеже.',
  `LMI_PAYMENT_DESC` varchar(255) NOT NULL COMMENT 'Примечание к платежу, передается для контроля продавцом отсутствия искажений в примечании к платежу. Данное поле передается после обработки функцией URLEncode. Так как форма, передаваемая с сайта продавца на платежный сайт системы передается через клиентс',
  `status` tinyint(1) NOT NULL COMMENT 'Статус Транзакции',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `transaction_wm`
--

INSERT INTO `transaction_wm` (`id`, `LMI_MODE`, `LMI_PAYMENT_AMOUNT`, `LMI_PAYEE_PURSE`, `LMI_PAYMENT_NO`, `LMI_PAYER_WM`, `LMI_PAYER_PURSE`, `LMI_PAYER_COUNTRYID`, `LMI_PAYER_PCOUNTRYID`, `LMI_PAYER_IP`, `LMI_SYS_INVS_NO`, `LMI_SYS_TRANS_NO`, `LMI_SYS_TRANS_DATE`, `LMI_HASH`, `LMI_PAYMENT_DESC`, `status`, `creation_date`, `change_date`, `description`) VALUES
(1, 0, 0.00, '', 0, 0, '', '', '', '', 0, 0, '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a:0:{}'),
(2, 0, 0.00, '', 0, 0, '', '', '', '', 0, 0, '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a:0:{}'),
(3, 0, 0.00, '', 0, 0, '', '', '', '', 0, 0, '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a:0:{}'),
(4, 0, 0.00, '', 0, 0, '', '', '', '', 0, 0, '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a:0:{}'),
(5, 0, 0.00, '', 0, 0, '', '', '', '', 0, 0, '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'YTowOnt9'),
(6, 1, 70.00, 'R101111803389', 0, 2147483647, 'R101111803389', 'UA', 'UA', '178.94.95.100', 192, 984, '20150707 12:52:15', '55C47770185EC6276C3946723355199F2339862EBEA6C3075526585B01202599', 'Оплата за услуги', 0, '2015-07-07 13:31:32', '2015-07-07 13:31:32', 'a:16:{s:8:"LMI_MODE";s:1:"1";s:18:"LMI_PAYMENT_AMOUNT";s:5:"70.00";s:15:"LMI_PAYEE_PURSE";s:13:"R101111803389";s:14:"LMI_PAYMENT_NO";s:1:"0";s:12:"LMI_PAYER_WM";s:12:"261613619335";s:15:"LMI_PAYER_PURSE";s:13:"R101111803389";s:19:"LMI_PAYER_COUNTRYID";s:2:"UA";s:20:"LMI_PAYER_PCOUNTRYID";s:2:"UA";s:12:"LMI_PAYER_IP";s:13:"178.94.95.100";s:15:"LMI_SYS_INVS_NO";s:3:"192";s:16:"LMI_SYS_TRANS_NO";s:3:"984";s:18:"LMI_SYS_TRANS_DATE";s:17:"20150707 12:52:15";s:8:"LMI_HASH";s:64:"55C47770185EC6276C3946723355199F2339862EBEA6C3075526585B01202599";s:16:"LMI_PAYMENT_DESC";s:30:"Оплата за услуги";s:8:"LMI_LANG";s:5:"ru-RU";s:10:"LMI_DBLCHK";s:3:"SMS";}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `country_id` int(11) DEFAULT NULL COMMENT 'Страна пользователя',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `name` varchar(50) NOT NULL COMMENT 'Ник',
  `password` char(32) NOT NULL COMMENT 'Пароль',
  `salt` char(6) NOT NULL COMMENT 'Соль',
  `type` tinyint(1) NOT NULL COMMENT 'Тип',
  `balance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Текущий баланс в системе',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания',
  `change_date` datetime NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Пользователи' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `country_id`, `email`, `name`, `password`, `salt`, `type`, `balance`, `creation_date`, `change_date`) VALUES
(1, 0, 'oleg_freedom@rambler.ru', 'Freedom', '09b4e9677ef07b721c66ab70689bc0d4', 'd7mbsx', 0, 0.00, '2015-06-18 15:43:04', '2015-06-18 15:43:04'),
(2, 0, 'hherher@test.com', 'trtrtr', '16b50b39f99b4ae8d6e04742b5a828d7', '2js8n3', 1, 0.00, '2015-06-18 16:04:37', '2015-06-18 16:04:37'),
(3, 0, 'hherher1@test.com', 'trtrtr', '2010fe0241b19a3e36a3342ac8261877', 'qrtq0g', 1, 0.00, '2015-06-18 16:05:21', '2015-06-18 16:05:21'),
(4, NULL, 'test@test.com', 'TestTest', '0af229eff17ece2604be6aab5d76c434', 'yit76m', 1, 0.00, '2015-07-09 14:54:08', '2015-07-09 14:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip` char(15) NOT NULL,
  `result` tinyint(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `result` (`result`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `ip`, `result`, `creation_date`) VALUES
(1, 1, '127.0.0.1', 1, '2015-07-08 15:17:49'),
(2, 1, '127.0.0.1', 1, '2015-07-08 15:18:11'),
(3, 1, '127.0.0.1', 1, '2015-07-08 15:28:37'),
(4, 1, '127.0.0.1', 0, '2015-07-08 15:28:58'),
(5, 1, '127.0.0.1', 0, '2015-07-08 15:29:08'),
(6, 1, '127.0.0.1', 0, '2015-07-08 15:29:52'),
(7, 1, '127.0.0.1', 0, '2015-07-08 17:25:19'),
(8, 1, '127.0.0.1', 1, '2015-07-08 17:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `vote_mark`
--

CREATE TABLE IF NOT EXISTS `vote_mark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `vote_mark`
--

INSERT INTO `vote_mark` (`id`, `name`) VALUES
(1, '5'),
(2, '4'),
(3, '3'),
(4, '4 или 5'),
(5, 'от 3 до 5'),
(6, '3 или 4');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `country_include_to_order`
--
ALTER TABLE `country_include_to_order`
  ADD CONSTRAINT `country_include_to_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `country_include_to_order_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goal_to_order`
--
ALTER TABLE `goal_to_order`
  ADD CONSTRAINT `goal_to_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `goal_to_order_ibfk_2` FOREIGN KEY (`goal_id`) REFERENCES `goal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`app_id`) REFERENCES `app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`vote_mark_id`) REFERENCES `vote_mark` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `payment_system_to_user`
--
ALTER TABLE `payment_system_to_user`
  ADD CONSTRAINT `payment_system_to_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_system_to_user_ibfk_2` FOREIGN KEY (`payment_system_id`) REFERENCES `payment_system` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`payment_system_to_user_id`) REFERENCES `payment_system_to_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_login`
--
ALTER TABLE `user_login`
  ADD CONSTRAINT `user_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS = 1;