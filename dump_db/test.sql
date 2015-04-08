-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `categories_list`;
CREATE TABLE `categories_list` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(40) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  UNIQUE KEY `index` (`index`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `categories_list` (`index`, `category`, `parent_id`) VALUES
(9,	'Автомобили с пробегом',	1000),
(109,	'Новые автомобили',	1000),
(14,	'Мотоциклы и мототехника',	1000),
(81,	'Грузовики и спецтехника',	1000),
(11,	'Водный транспорт',	1000),
(10,	'Запчасти и аксессуары',	1000),
(24,	'Квартиры',	1001),
(23,	'Комнаты',	1001),
(25,	'Дома, дачи, коттеджи',	1001),
(26,	'Земельные участки',	1001),
(85,	'Гаражи и машиноместа',	1001),
(42,	'Коммерческая недвижимость',	1001),
(86,	'Недвижимость за рубежом',	1001),
(111,	'Вакансии (поиск сотрудников)',	1002),
(112,	'Резюме (поиск работы)',	1002),
(114,	'Предложения услуг',	1003),
(115,	'Запросы на услуги',	1003),
(27,	'Одежда, обувь, аксессуары',	1004),
(29,	'Детская одежда и обувь',	1004),
(30,	'Товары для детей и игрушки',	1004),
(28,	'Часы и украшения',	1004),
(88,	'Красота и здоровье',	1004),
(21,	'Бытовая техника',	1005),
(20,	'Мебель и интерьер',	1005),
(87,	'Посуда и товары для кухни',	1005),
(82,	'Продукты питания',	1005),
(19,	'Ремонт и строительство',	1005),
(106,	'Растения',	1005),
(32,	'Аудио и видео',	1006),
(97,	'Игры, приставки и программы',	1006),
(31,	'Настольные компьютеры',	1006),
(98,	'Ноутбуки',	1006),
(99,	'Оргтехника и расходники',	1006),
(96,	'Планшеты и электронные книги',	1006),
(84,	'Телефоны',	1006),
(101,	'Товары для компьютера',	1006),
(105,	'Фототехника',	1006),
(33,	'Билеты и путешествия',	1007),
(34,	'Велосипеды',	1007),
(83,	'Книги и журналы',	1007),
(36,	'Коллекционирование',	1007),
(38,	'Музыкальные инструменты',	1007),
(102,	'Охота и рыбалка',	1007),
(39,	'Спорт и отдых',	1007),
(103,	'Знакомства',	1007),
(89,	'Собаки',	1008),
(90,	'Кошки',	1008),
(91,	'Птицы',	1008),
(92,	'Аквариум',	1008),
(93,	'Другие животные',	1008),
(94,	'Товары для животных',	1008),
(116,	'Готовый бизнес',	1009),
(40,	'Оборудование для бизнеса',	1009),
(1006,	'Бытовая техника',	NULL),
(1005,	'Для дома и дачи',	NULL),
(1004,	'Личные вещи',	NULL),
(1003,	'Услуги',	NULL),
(1002,	'Работа',	NULL),
(1001,	'Недвижимость',	NULL),
(1000,	'Транспорт',	NULL),
(1007,	'Хобби и отдых',	NULL),
(1008,	'Животные',	NULL),
(1009,	'Для бизнеса',	NULL);

DROP TABLE IF EXISTS `cities_list`;
CREATE TABLE `cities_list` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(20) NOT NULL,
  UNIQUE KEY `index` (`index`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cities_list` (`index`, `city`) VALUES
(641780,	'Новосибирск'),
(641490,	'Барабинск'),
(641510,	'Бердск'),
(641600,	'Искитим'),
(641630,	'Колывань'),
(641680,	'Краснообск'),
(641710,	'Куйбышев'),
(641760,	'Мошково'),
(641790,	'Обь'),
(641800,	'Ордынское'),
(641970,	'Черепаново');

DROP TABLE IF EXISTS `explanations`;
CREATE TABLE `explanations` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `private` enum('0','1') NOT NULL,
  `seller_name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `allow_mails` enum('','checked') NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `location_id` varchar(6) DEFAULT NULL,
  `category_id` varchar(3) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(3000) DEFAULT NULL,
  `price` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `explanations` (`id`, `private`, `seller_name`, `email`, `allow_mails`, `phone`, `location_id`, `category_id`, `title`, `description`, `price`) VALUES
(3,	'1',	'Виктор',	'моя',	'checked',	'8952',	'641780',	'26',	'Первое объявление',	'мое первое объявление',	'1000'),
(4,	'',	'Второй',	'вторая@почта',	'checked',	'8777777799',	'641510',	'25',	'второе объявление',	'это второе',	'2000'),
(5,	'1',	'третий',	'',	'',	'89524581263',	'641600',	'81',	'третье',	'',	'3000'),
(6,	'',	'444444444',	'444',	'',	'444444',	'641800',	'112',	'4444',	'4444444',	'44'),
(7,	'',	'пятое',	'555@555',	'',	'23134986531',	'641970',	'26',	'это 5-е',	'',	'555');

-- 2015-04-08 13:39:18
