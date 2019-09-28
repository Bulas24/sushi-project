-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 19 2019 г., 16:10
-- Версия сервера: 5.5.62
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sushi`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_group`
--

CREATE TABLE `attribute_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attribute_group`
--

INSERT INTO `attribute_group` (`id`, `title`) VALUES
(6, 'Состав');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_product`
--

CREATE TABLE `attribute_product` (
  `attr_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attribute_product`
--

INSERT INTO `attribute_product` (`attr_id`, `product_id`) VALUES
(20, 51),
(21, 51),
(29, 36),
(30, 36),
(30, 38),
(31, 34),
(32, 43),
(33, 34),
(34, 34),
(34, 43),
(35, 43),
(38, 35);

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `attr_group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attr_group_id`) VALUES
(20, 'Горячие роллы', 6),
(21, 'Запеченные роллы', 6),
(22, 'Мексиканские роллы', 6),
(23, 'Новинки', 6),
(24, 'Популярные', 6),
(25, 'С ветчиной', 6),
(26, 'С кальмаром', 6),
(27, 'С крабом', 6),
(28, 'С креветкой', 6),
(29, 'С курицей', 6),
(30, 'С лососем', 6),
(31, 'С масляной рыбой', 6),
(32, 'С мидиями', 6),
(33, 'С овощами', 6),
(34, 'С тунцом', 6),
(35, 'С угрем', 6),
(36, 'Сладкие роллы', 6),
(37, 'Спринг роллы', 6),
(38, 'Филадельфия', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'brand_no_image.jpg',
  `description` text,
  `keywords` varchar(255) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `title`, `alias`, `img`, `description`, `keywords`, `content`) VALUES
(1, 'Casio', 'casio', '30a5bdd34920035b1c59a2975bb7e8e2.jpg', 'Casio Computer Co., Ltd. (яп. カシオ計算機株式会社 Касио кэйсанки кабусики гайся) — японский производитель электронных устройств. Корпорация основана в апреле 1946 года в Токио. Наиболее известна как производитель калькуляторов, аудио оборудования, КПК, фотокамер, музыкальных инструментов, планшетов и наручных часов.', 'wwwwww', '<p>CASIO - Всемирно известная марка родных, японских часов. Не было бы на земном шаре человека, который бы не знал о компании CASIO. Его происхождение уходит в глубокие сороковые годы прошлого века. Это фамилия семи основателей всемирно известных часов.</p>\r\n\r\n<p>Компания CASIO бесспорно является одним из мировых лидеров среди производителей часовой продукции. С самых первых выпусков CASIO является эталоном качественности, многофункциональности, оригинальности, разнообразия... много эпитетов можно подобрать в это слово.</p>\r\n\r\n<p>Корпоративное кредо CASIO - созидание и содействие. Оно отображает обязательство, данное компанией обществу - предлагать ему постоянно новые и полезные изделия, которые под силу произвести только CASIO.</p>\r\n'),
(2, 'Citizen', 'citizen', 'abt-2.jpg', 'Описание бренда часов Citizen', '', '<p>Контент бренда часов Citizen</p>\r\n'),
(3, 'Royal London', 'royal-london', 'abt-3.jpg', 'Описание бренда часов Royal London', '', '<p>Контент бренда часов Royal London</p>\r\n'),
(5, 'Diesel', 'diesel', '52d6d3bde21aebe12f1196235caecad5.jpg', 'Описание бренда часов Diesel', '', '<p>Дизайн часов Diesel можно описать всего двумя словами: смелый и дерзкий. Этот брэнд давно доказал, что его творения вне конкуренции, смелые и дерзкие, с урбанистическим духом, - носить Diesel - значит показать свою индивидуальность. Эти яркие цвета, ремни по ширине не уступающие брючным, дизайн как будто с другой планеты &ndash; все это скажет миру, что вы так же уникальны и позитивны как часы Diesel, которые вы носите.</p>\r\n\r\n<p>Часы Дизель могут быть какими угодно, только не обычными. Детали в часах привлекательны и современны, что делает часы подходящими для носки и с костюмом, и с джинсами. Наручные часы Diesel зарекомендовали себя как обязательный атрибут продвинутых и модных молодых людей, живущих яркой, динамичной жизнью. Часы Diesel имеют некоторые характерные черты, благодаря которым бренд выделяется на фоне других марок направления fashion. Настоящей находкой Diesel стал большой, а иногда просто огромный циферблат. Суть задумки проста: часы заметны и легко узнаваемы. Также сам спортивно-дерзкий стиль Diesel является популярным и востребованным во всем мире. Брэнд играет с разнообразными материалами &ndash; тут и кожа, и сталь, и пластик, и каучук, и силикон. В цветовой палитре бестселлерами являются природные расцветки &ndash; матовый темно коричневый, коричневый с золотистым шиммером, темно-зеленый синий, черный, а также игра контрастов &ndash; белый ремень с красной светодиодной подсветкой, желтое на черном. Среди коллекций есть классика, электронные модели, хронографы, часы с 5 часовыми зонами, знаменитые SBA.</p>\r\n'),
(6, 'Seico', 'seico', '6c953bebec250de488b1306776d2ecd2.jpg', 'описание бренда часов Seico', 'новый', '<p>Контент бренда часов Diesel</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `alias`, `parent_id`, `keywords`, `description`) VALUES
(17, 'Акция!Роллы 0р.', 'akciya-rolly-0r', 0, '', ''),
(18, 'Роллы', 'rolly', 0, '', ''),
(20, 'Пицца', 'picca', 0, '', ''),
(21, 'Сеты', 'sety', 0, '', ''),
(22, 'Горячие блюда', 'goryachie-blyuda', 0, '', ''),
(23, 'Новинки', 'novinki', 0, '', ''),
(24, 'Напитки', 'napitki', 0, '', ''),
(25, 'Добавки', 'dobavki', 0, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(10) NOT NULL,
  `symbol_right` varchar(10) NOT NULL,
  `value` float(15,2) NOT NULL,
  `base` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `title`, `code`, `symbol_left`, `symbol_right`, `value`, `base`) VALUES
(1, 'Рубль', 'RUB', '', '₽', 1.00, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_brand`
--

CREATE TABLE `gallery_brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery_brand`
--

INSERT INTO `gallery_brand` (`id`, `brand_id`, `img`) VALUES
(9, 1, '79cf50167253774c28c58430ff3ab4bf.jpg'),
(11, 1, 'a649dbf21c61b90ba95ead2489c00353.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `modification`
--

CREATE TABLE `modification` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `old_price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modification`
--

INSERT INTO `modification` (`id`, `product_id`, `title`, `price`, `old_price`) VALUES
(130, 35, 'C лососем(+100)', 250, 0),
(131, 40, '1л', 80, 0),
(191, 44, 'С креветками (+20)', 199, 0),
(192, 45, 'С угрем (+100)', 299, 0),
(193, 45, 'С маслянной рыбой', 199, 0),
(194, 47, 'С жаренным лососем', 250, 0),
(195, 47, 'С маслянной рыбой', 250, 0),
(200, 34, 'С лососем', 0, 150),
(201, 34, 'С угрем', 100, 200),
(202, 34, 'С креветкой', 150, 0),
(203, 34, 'С огурцом', 0, 0),
(204, 36, 'Большая', 250, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'Имя заказчика',
  `number` varchar(255) DEFAULT NULL COMMENT 'Телефон заказчика',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email Заказчика',
  `how_delivery` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0- доставка, 1- самовывоз',
  `pickup_address_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `time_add` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0- ближайшее время, 1- по времени time',
  `time` varchar(255) DEFAULT NULL COMMENT 'Время на когда заказ',
  `pay` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0- онлайн оплата, 1- оплата при доставке',
  `delivery` enum('0','1') DEFAULT NULL COMMENT '0- картой, 1- наличными',
  `change_money` varchar(255) DEFAULT NULL COMMENT 'Подготовить сдачу с этой суммы',
  `status` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0- новый, 1- в работе, 2-выполен, 3-оплачен, 4-Подготовлен',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `note` text,
  `note_man` varchar(255) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL COMMENT 'Адрес улица',
  `address_home` varchar(255) DEFAULT NULL COMMENT 'Адрес дом',
  `address_porch` varchar(255) DEFAULT NULL COMMENT 'Адрес подъезд',
  `address_floor` varchar(255) DEFAULT NULL COMMENT 'Адрес этаж',
  `address_apartment` varchar(255) DEFAULT NULL COMMENT 'Адрес квартира',
  `sum` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `number`, `email`, `how_delivery`, `pickup_address_id`, `time_add`, `time`, `pay`, `delivery`, `change_money`, `status`, `date`, `update_at`, `currency`, `note`, `note_man`, `address_street`, `address_home`, `address_porch`, `address_floor`, `address_apartment`, `sum`) VALUES
(74, 29, 'Второй сушиqw', '1221', 'arkad-plus22@mail.ru', '1', 7, '0', '', '1', '1', '2000', '1', '2019-09-12 05:44:21', '2019-09-14 07:55:40', 'RUB', NULL, 'Буйный', 'Крупской', '15', '2', '4', '22', 250),
(75, 29, 'Второй суши', '89135568555', 'arkad-plus@mail.ru', '1', 7, '0', '22 00 ', '1', '1', '', '1', '2019-09-12 05:45:39', '2019-09-19 03:01:56', 'RUB', NULL, '', '', '', '', '', '', 233),
(76, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '1', 0, '0', NULL, '1', NULL, NULL, '4', '2019-09-12 05:57:15', '2019-09-19 03:36:51', 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 483),
(77, 77, 'Коляен', '89113241518', 'user15kolizn@user.ru', '1', 0, '0', '21:00', '1', '1', '1500', '4', '2019-09-13 12:11:30', '2019-09-19 03:39:24', 'RUB', 'Домофон не работает', 'Связь по приезду22', 'Высотная11', '11', '2', '11', '21', 502),
(78, 29, 'Ron', '89135568444', 'arkad-plus@mail.ru', '1', 0, '0', NULL, '1', NULL, NULL, '4', '2019-09-13 12:15:39', '2019-09-19 03:38:30', 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 729),
(79, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '1', 0, '0', NULL, '1', NULL, NULL, '1', '2019-09-13 12:26:13', '2019-09-14 05:01:49', 'RUB', 'Позвонить по готовности', NULL, NULL, NULL, NULL, NULL, NULL, 312),
(80, 29, 'Алеша', '89135568444', 'user8@user.ru', '0', 0, '0', NULL, '1', '1', '1500', '2', '2019-09-13 12:27:59', '2019-09-14 04:53:38', 'RUB', '', NULL, 'Маркса', '8', '', '', '35', 1362),
(81, 90, 'Алесандр', '89122223334', 'arkad-122113plus@mail.ru', '0', 1, '0', '', '1', '0', '', '2', '2019-09-14 09:14:43', '2019-09-19 03:15:42', 'RUB', '', '', 'Робеспьера', '12', '', '', '', 233),
(83, 69, 'Коляв', '+79135568444', 'arkad-plus@mail.ru', '1', 6, '0', '', '1', '0', '', '0', '2019-09-15 05:40:44', NULL, 'RUB', 'Срочно', '', '', '', '', '', '', 233),
(84, 29, 'Коля', '89135568444', 'gogi@gog.ru', '1', 5, '1', '12:13', '1', '0', '', '0', '2019-09-15 05:42:53', NULL, 'RUB', '', 'Добавить палочки +2', '', '', '', '', '', 432),
(87, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-16 06:41:07', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 233),
(90, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-16 07:06:38', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 233),
(91, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-16 07:09:08', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 312),
(92, 95, 'Tx11Rez315OblivioN', '891131313133', 'arkad-plus@mail.ru', '1', 5, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:20:58', NULL, 'RUB', '', NULL, NULL, NULL, NULL, NULL, NULL, 233),
(93, 29, 'Tx11Rez315OblivioN', '89135568444', 'arkad-plus@mail.ru', '1', 5, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:23:35', NULL, 'RUB', '', NULL, NULL, NULL, NULL, NULL, NULL, 412),
(94, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '1', 5, '0', NULL, '1', NULL, NULL, '2', '2019-09-17 04:24:59', '2019-09-19 03:40:49', 'RUB', '', NULL, NULL, NULL, NULL, NULL, NULL, 412),
(95, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:26:34', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 412),
(96, 29, 'Tx11Rez315OblivioN', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:29:09', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 412),
(97, 29, 'Tx11Rez315OblivioN', '89135568444', 'arkad-plus@mail.ru', '1', 5, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:31:15', NULL, 'RUB', '', NULL, NULL, NULL, NULL, NULL, NULL, 412),
(98, 29, 'Tx11Rez315OblivioN', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:31:42', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 233),
(99, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:34:05', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 233),
(100, 29, 'Tx11Rez315OblivioNd', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-09-17 04:35:12', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 233),
(101, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:33:35', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(102, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '1', 5, '0', NULL, '1', NULL, NULL, '0', '2019-09-18 05:34:48', NULL, 'RUB', '', NULL, NULL, NULL, NULL, NULL, NULL, 233),
(103, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:35:05', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(104, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:36:39', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(105, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:36:52', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(106, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:43:05', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(107, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:43:20', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(108, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:44:45', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(109, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:46:00', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(110, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:46:41', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(111, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:47:55', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(112, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:48:03', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(113, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:48:14', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(114, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:48:20', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(115, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:48:37', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(117, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:48:48', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(118, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:49:02', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(119, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:49:46', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(120, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:49:57', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(121, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:50:16', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(123, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:51:59', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(124, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:52:15', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(125, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:52:22', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(126, 29, 'ыы', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:52:46', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(127, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:53:42', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(128, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:54:50', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 233),
(129, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:55:17', NULL, 'RUB', '', NULL, 'd', '15', '', '', '', 466),
(130, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '0', NULL, NULL, '0', '2019-09-18 05:55:34', NULL, 'RUB', '', NULL, 'd', '15', '', '', '', 466),
(131, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '0', NULL, '0', NULL, '1', '0', NULL, '0', '2019-09-18 05:55:57', NULL, 'RUB', '', NULL, 'Ленина', '15', '', '', '', 466),
(132, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '1', 5, '0', NULL, '1', NULL, NULL, '0', '2019-09-18 05:56:17', NULL, 'RUB', '', NULL, NULL, NULL, NULL, NULL, NULL, 466),
(133, 29, 'Второй суши', '89135568444', 'arkad-plus@mail.ru', '1', 5, '0', NULL, '1', NULL, NULL, '1', '2019-09-19 03:55:19', '2019-09-19 03:32:51', 'RUB', '', NULL, NULL, NULL, NULL, NULL, NULL, 1281);

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `qty`, `title`, `price`) VALUES
(141, 74, 49, 1, 'Мега суши', 100),
(142, 74, 35, 1, 'Роллы 1', 150),
(143, 75, 42, 1, 'Акция 2', 100),
(144, 75, 43, 1, 'Акция 3', 133),
(145, 76, 43, 1, 'Акция 3', 133),
(146, 76, 42, 1, 'Акция 2', 100),
(147, 76, 47, 1, 'Акция 6', 250),
(148, 77, 42, 1, 'Акция 2', 100),
(149, 77, 43, 1, 'Акция 3', 133),
(150, 77, 44, 1, 'Акция 4', 179),
(151, 77, 40, 1, 'Напитки 1', 40),
(152, 77, 41, 5, 'Добавки 1', 50),
(153, 78, 34, 1, 'Акция 1 (С угрем)', 100),
(154, 78, 35, 1, 'Роллы 1 (C лососем(+100))', 250),
(155, 78, 44, 1, 'Акция 4', 179),
(156, 78, 36, 1, 'Пицца 1', 200),
(157, 79, 43, 1, 'Акция 3', 133),
(158, 79, 44, 1, 'Акция 4', 179),
(159, 80, 42, 1, 'Акция 2', 100),
(160, 80, 43, 1, 'Акция 3', 133),
(161, 80, 44, 1, 'Акция 4', 179),
(162, 80, 35, 1, 'Роллы 1 (C лососем(+100))', 250),
(163, 80, 49, 1, 'Мега суши', 100),
(164, 80, 37, 1, 'Сеты 1', 600),
(165, 81, 42, 1, 'Акция 2', 100),
(166, 81, 43, 1, 'Акция 3', 133),
(170, 83, 43, 1, 'Акция 3', 133),
(171, 83, 42, 1, 'Акция 2', 100),
(172, 84, 42, 1, 'Акция 2', 100),
(173, 84, 43, 1, 'Акция 3', 133),
(174, 84, 44, 1, 'Акция 4 (С креветками (+20))', 199),
(180, 87, 43, 1, 'Акция 3', 133),
(181, 87, 42, 1, 'Акция 2', 100),
(186, 90, 43, 1, 'Акция 3', 133),
(187, 90, 42, 1, 'Акция 2', 100),
(188, 91, 44, 1, 'Акция 4', 179),
(189, 91, 43, 1, 'Акция 3', 133),
(190, 92, 43, 1, 'Акция 3', 133),
(191, 92, 42, 1, 'Акция 2', 100),
(192, 93, 43, 1, 'Акция 3', 133),
(193, 93, 42, 1, 'Акция 2', 100),
(194, 93, 44, 1, 'Акция 4', 179),
(195, 94, 42, 1, 'Акция 2', 100),
(196, 94, 43, 1, 'Акция 3', 133),
(197, 94, 44, 1, 'Акция 4', 179),
(198, 95, 42, 1, 'Акция 2', 100),
(199, 95, 43, 1, 'Акция 3', 133),
(200, 95, 44, 1, 'Акция 4', 179),
(201, 96, 42, 1, 'Акция 2', 100),
(202, 96, 43, 1, 'Акция 3', 133),
(203, 96, 44, 1, 'Акция 4', 179),
(204, 97, 42, 1, 'Акция 2', 100),
(205, 97, 43, 1, 'Акция 3', 133),
(206, 97, 44, 1, 'Акция 4', 179),
(207, 98, 42, 1, 'Акция 2', 100),
(208, 98, 43, 1, 'Акция 3', 133),
(209, 99, 42, 1, 'Акция 2', 100),
(210, 99, 43, 1, 'Акция 3', 133),
(211, 100, 42, 1, 'Акция 2', 100),
(212, 100, 43, 1, 'Акция 3', 133),
(213, 101, 42, 1, 'Акция 2', 100),
(214, 101, 43, 1, 'Акция 3', 133),
(215, 102, 42, 1, 'Акция 2', 100),
(216, 102, 43, 1, 'Акция 3', 133),
(217, 103, 42, 1, 'Акция 2', 100),
(218, 103, 43, 1, 'Акция 3', 133),
(219, 104, 42, 1, 'Акция 2', 100),
(220, 104, 43, 1, 'Акция 3', 133),
(221, 105, 42, 1, 'Акция 2', 100),
(222, 105, 43, 1, 'Акция 3', 133),
(223, 106, 42, 1, 'Акция 2', 100),
(224, 106, 43, 1, 'Акция 3', 133),
(225, 107, 42, 1, 'Акция 2', 100),
(226, 107, 43, 1, 'Акция 3', 133),
(227, 108, 42, 1, 'Акция 2', 100),
(228, 108, 43, 1, 'Акция 3', 133),
(229, 109, 42, 1, 'Акция 2', 100),
(230, 109, 43, 1, 'Акция 3', 133),
(231, 110, 42, 1, 'Акция 2', 100),
(232, 110, 43, 1, 'Акция 3', 133),
(233, 111, 42, 1, 'Акция 2', 100),
(234, 111, 43, 1, 'Акция 3', 133),
(235, 112, 42, 1, 'Акция 2', 100),
(236, 112, 43, 1, 'Акция 3', 133),
(237, 113, 42, 1, 'Акция 2', 100),
(238, 113, 43, 1, 'Акция 3', 133),
(239, 114, 42, 1, 'Акция 2', 100),
(240, 114, 43, 1, 'Акция 3', 133),
(241, 115, 42, 1, 'Акция 2', 100),
(242, 115, 43, 1, 'Акция 3', 133),
(245, 117, 42, 1, 'Акция 2', 100),
(246, 117, 43, 1, 'Акция 3', 133),
(247, 118, 42, 1, 'Акция 2', 100),
(248, 118, 43, 1, 'Акция 3', 133),
(249, 119, 42, 1, 'Акция 2', 100),
(250, 119, 43, 1, 'Акция 3', 133),
(251, 120, 42, 1, 'Акция 2', 100),
(252, 120, 43, 1, 'Акция 3', 133),
(253, 121, 42, 1, 'Акция 2', 100),
(254, 121, 43, 1, 'Акция 3', 133),
(257, 123, 42, 1, 'Акция 2', 100),
(258, 123, 43, 1, 'Акция 3', 133),
(259, 124, 42, 1, 'Акция 2', 100),
(260, 124, 43, 1, 'Акция 3', 133),
(261, 125, 42, 1, 'Акция 2', 100),
(262, 125, 43, 1, 'Акция 3', 133),
(263, 126, 42, 1, 'Акция 2', 100),
(264, 126, 43, 1, 'Акция 3', 133),
(265, 127, 42, 1, 'Акция 2', 100),
(266, 127, 43, 1, 'Акция 3', 133),
(267, 128, 42, 1, 'Акция 2', 100),
(268, 128, 43, 1, 'Акция 3', 133),
(269, 129, 42, 2, 'Акция 2', 200),
(270, 129, 43, 2, 'Акция 3', 266),
(271, 130, 42, 2, 'Акция 2', 200),
(272, 130, 43, 2, 'Акция 3', 266),
(273, 131, 42, 2, 'Акция 2', 200),
(274, 131, 43, 2, 'Акция 3', 266),
(275, 132, 42, 2, 'Акция 2', 200),
(276, 132, 43, 2, 'Акция 3', 266),
(277, 133, 43, 7, 'Акция 3', 931),
(278, 133, 42, 2, 'Акция 2', 200),
(279, 133, 34, 3, 'Акция 1', 150);

-- --------------------------------------------------------

--
-- Структура таблицы `pickup_address`
--

CREATE TABLE `pickup_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pickup_address`
--

INSERT INTO `pickup_address` (`id`, `title`) VALUES
(5, 'ул. Ленина, 112'),
(6, 'ул. Юности, 11'),
(7, 'ул. Мира, 36');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `content` text,
  `price` float NOT NULL DEFAULT '0',
  `old_price` float NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `keywords` varchar(255) DEFAULT NULL,
  `description` text,
  `img` varchar(255) NOT NULL DEFAULT 'no_image.jpg',
  `hit` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `alias`, `content`, `price`, `old_price`, `status`, `keywords`, `description`, `img`, `hit`) VALUES
(34, 17, 'Акция 1', 'akciya-1', '<p><strong>Запеченный ролл с курицей</strong> под шапкой из сыра Моцарелла, майонеза и шампиньонов</p>\r\n', 50, 150, '1', '', '', 'cebf8981da376ef7e6ab0ca252f11177.jpg', '0'),
(35, 18, 'Роллы 1', 'rolly-1', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 150, 0, '1', '', 'Запеченный ролл в мексиканской лепешке с огурцом и сыром под шапочкой из микса терагры, соуса спайси, моцареллы и грибов', '6151e75af12210197dd67bc9cfb8886a.jpg', '1'),
(36, 20, 'Пицца 1', 'picca-1', '<p>Пицца 1</p>\r\n', 200, 0, '1', '', ' Пицца с начинкой из четырех сыров: Моцарелла, Пармезан, Гауда, Дорблю.  Выберите размер круга', 'c1dee8d5a6f1ff5314654a788a59750e.jpg', '0'),
(37, 21, 'Сеты 1', 'sety-1', '<p>Сеты 1</p>\r\n', 600, 0, '1', '', 'Отличный вариант для БОЛЬШОЙ компании из 14 роллов! Филадельфия GOLD (2 порции), Унаги Филадельфия, Лава, Калифорния, Сливочный Сяке маки, Сливочный Унаги маки, Сяке темпура, Сяке маки (2 порции), Сяке кюри (2 порции), Унаги маки, Каппа маки', '9ffb5d899bbcfa6985433714f68d198b.jpg', '1'),
(38, 22, 'Горячие блюда 1', 'goryachie-blyuda-1', '<p>Горячие&nbsp; 1</p>\r\n', 300, 0, '1', '', 'Горячие', '76a77e6e1352317288d763d08dfb2c76.jpg', '0'),
(39, 23, 'Новинки 1', 'novinki-1', '<p>Новинки 1</p>\r\n', 220, 0, '1', '', 'Новинки', '03262af10fad0c4b722fc00cb43c1b96.jpg', '1'),
(40, 24, 'Напитки 1', 'napitki-1', '<p>Напитки 1</p>\r\n', 40, 0, '1', '', 'Напитки', '78348371813a62063c12c58905fd78cc.jpg', '1'),
(41, 25, 'Добавки 1', 'dobavki-1', '<p>Добавки 1</p>\r\n', 10, 0, '1', '', 'Добавки', '3ee0d5b251bb5133d936721d0a1d8042.jpg', '1'),
(42, 17, 'Акция 2', 'akciya-2', '<p><strong>Ролл в мексиканской</strong> сырной лепешке со сливочным сыром, курицей и пекинской капустой. Приправлен <em>соусом спайси</em></p>\r\n', 100, 0, '1', '', 'Ролл в мексиканской сырной лепешке', '2c41524adb0133e53c014b147e353be7.jpg', '0'),
(43, 17, 'Акция 3', 'akciya-3', '<p>Ролл с дальневосточным лососем (Россия), зеленым луком и сливочным сыром</p>\r\n', 133, 0, '1', '', '', 'd77b4f7b25ba93fd3aa9b1fd47c4821b.jpg', '0'),
(44, 17, 'Акция 4', 'akciya-4', '<p>Горячий ролл со сливочным сыром, лососем или креветками на выбор, крабовыми палочками. Панирован в сухарях, обжарен во фритюре и украшен сырным соусом Беб</p>\r\n', 179, 0, '1', '', '', 'a83e03040ccc568ba49452835f4e6877.jpg', '1'),
(45, 17, 'Акция 5', 'akciya-5', '<p>Любимый ролл под соусом Лава с икрой летучей рыбы и морским гребешком. Начинка на выбор</p>\r\n', 199, 0, '1', '', '', '1a21af8edb9c0f84eaaf412403ff7c93.jpg', '0'),
(47, 17, 'Акция 6', 'akciya-6', '<p>Ролл со сливочным сыром и огурцом в стружке тунца. <em><strong>Начинка на выбор:</strong></em></p>\r\n', 250, 0, '1', '', '', '42c6262339037aec8846a8943136f8e5.jpg', '1'),
(49, 18, 'Мега суши', 'mega-sushi', '', 100, 0, '1', '', 'Мега суши мега', 'ba6aaa0a956eee3163e7b11d14b75683.jpg', '1'),
(50, 17, 'Лучшие суши', 'luchshie-sushi', '', 150, 0, '1', '', 'Лучшие самые суши', '113adba6b0b783839612965b2492dbf9.jpg', '0'),
(51, 17, 'Акция 7', 'akciya-7', '<p>Ролл с креветками, огурцом, сливочным сыром и икрой Масаго</p>\r\n', 200, 0, '1', '', '', 'd7087dd62594d2012fc5fada1a9e76a1.jpg', '0'),
(71, 20, 'test', 'test', '', 1111, 0, '1', '', '', 'ad57ea840c8fce9ceed38a9f0aae8b90.jpg', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `prod_content`
--

CREATE TABLE `prod_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prod_content`
--

INSERT INTO `prod_content` (`id`, `product_id`, `title`, `value`) VALUES
(1, 35, 'Вес', '140г'),
(2, 35, 'Белки', '15г'),
(3, 35, 'Жиры', '10г'),
(4, 35, 'Углеводы', '35г'),
(25, 51, 'Ккал', '120'),
(26, 51, 'Углеводов', '14г'),
(27, 51, 'Кол-во в порции', '8'),
(28, 51, 'Белки', '10г');

-- --------------------------------------------------------

--
-- Структура таблицы `related_product`
--

CREATE TABLE `related_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `related_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_home` varchar(255) DEFAULT NULL,
  `address_porch` varchar(255) DEFAULT NULL,
  `address_floor` varchar(255) DEFAULT NULL,
  `address_apartment` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `name`, `address_street`, `address_home`, `address_porch`, `address_floor`, `address_apartment`, `role`, `number`) VALUES
(29, 'user1', '$2y$10$ocF4eJXt9ReYCcjkC4RC9OwqFGfUWhLSysxid6yL7V/wGYxw3qpJq', 'he14@mail.ru', 'Евгений', 'Крупской', '10', '3', '3', '24', 'admin', '89135568444'),
(35, 'user66', '$2y$10$neHtlBIayI2yf66j.fmJ9OdzRXOxybc3VRrXjDB/BEnimmqvIJsOS', 'user66@user.ru', 'Ron66', '1666вввв', NULL, NULL, NULL, NULL, 'user', '89135668544'),
(41, 'user11', '$2y$10$ta.AKdpqrz2Vk8KvmAn6MeZIiqq0g5gNXz21BHADEkNfNuEdkneei', 'user11@user.ru', 'dddd', '111', NULL, NULL, NULL, NULL, 'user', '83333458444'),
(43, 'user12', '$2y$10$YNzTFscL1i/7pgAwnDmWXOBQZbnHH1LtjMbi06sdY52AcCRw6/0i2', 'user12@user.ru', 'Roni', 'Парижской коммуны', '11', '4', '3', '45', 'user', '89145567444'),
(44, 'user13', '$2y$10$Hv.TbtnP1CfG4WKZhuG3deR7PxNqqM0HF/Sb2.oa9Dw2CE22iYFe.', 'user13@user.ru', 'User13', '11123ввввв', NULL, NULL, NULL, NULL, 'user', '891355455667'),
(45, 'user14', '$2y$10$KDvUfyv9mQ5GYoc91nrlsuH5kcMT3FgAkKhaaV4YeAYStD/EDgcpO', 'user14@user.ru', 'Ron', '11123ввввв', NULL, NULL, NULL, NULL, 'user', '8912125568444'),
(46, 'user15', '$2y$10$65GdHwNeaT2UZ9SlJXUYxukPTTh84iszGYuAUEVtEH/ZdUQhuNOIS', 'user15@user.ru', 'Ron', '11123ввввв', NULL, NULL, NULL, NULL, 'user', '89135968444'),
(47, 'user16', '$2y$10$ApZeVIJlHvyo7/q6.T9uFen0npIPHHy9DW8UJbrBHxyYrvliBd9HK', 'user16@user.ru', 'Ron', '11123ввввв', NULL, NULL, NULL, NULL, 'user', '89135568477'),
(48, 'user17', '$2y$10$ljHnZtQmC.9LLcUi1IeBWeygqj9NrhS3luMFSAL7MfeZtcg.RQ2hW', 'user17@user.ru', 'Ron', '1331', NULL, NULL, NULL, NULL, 'user', '89135568999'),
(66, NULL, '$2y$10$DimTLUdCIRtZ4.AaezcA7e3AsrlAJyNzKPRizFbjgv4w54tReiQ5K', 's@s.ru', 'Первый суши', 'в', 'в', '', '', '', 'user', '87777777777'),
(67, NULL, '', 's1@s1.ru', 'Второй суши', 'Ленина', '15', '2', '4', '22', 'user', '83333323'),
(69, NULL, '', 'userqsqsq31315@user.ru', 'Второй суши', 'd', 'd', '', '', '', 'user', '+79135568444'),
(70, NULL, '', 'us3131341441er8@user.ru', 'Второй суши', 'фы', 'ый', '', '', '', 'user', '8921131344'),
(71, NULL, '', 'user11214255@user.ru', 'Второй суши', 'Ленина', '12', '3', '32', '23', 'user', '8911313458444'),
(75, NULL, '', 'go12gi@gog.ru', 'Второй суши', 'Ленина', '2', '3', '4', '1', 'user', '1314414'),
(76, NULL, '', '13111ddd11@ru.cuo', 'Второй суши', 'в', 'в', '', '', '', 'user', '89112345655'),
(77, NULL, '', 'user15kolizn@user.ru', 'Коля', 'Высотная', '11', '2', '1', '21', 'user', '89113241518'),
(86, NULL, '', 'arkad-p313131lus@mail.ru', '1', 'Ленина', '3', '3', '', '', 'user', '131313138444'),
(87, NULL, '$2y$10$T15brQwf7LS0iJYdb3mRmuTo5ujYrrNLt6flGrF3MjHXQOABpvfZW', 'arkad-plu13145667s@mail.ru', 'Второй суши', 'Ленина', 'в2', 'в3', 'в4', 'в5', 'user', '891313144444'),
(88, NULL, '', '12131313arkad-plus@mail.ru', 'Второй суши13', 'Ленина314', 'в', '4', '5', '6', 'user', '891357788994'),
(89, 'use1313r5', '$2y$10$gtudvhZ3PJySFSLHa8O0Fu.riI4zzc6XMh.cABL7kqtdUQ42RDCj.', 'ar13131313kad-plus@mail.ru', '1', 'Ленина', '', '', '', '', 'user', '415151518444'),
(90, NULL, NULL, 'arkad-122113plus@mail.ru', 'Алесандр', 'Робеспьера', '12', '', '', '', 'user', '89122223334'),
(91, NULL, NULL, 'ar424254455kad-plus@mail.ru', 'Коля', 'Ленина', '15', '', '', '', 'user', '89588558444'),
(93, NULL, NULL, 'arka131313d-plus@mail.ru', 'Ronшшш', 'Ленина', '23', '3', '1', '23', 'user', '811112138444'),
(94, 'user111', '$2y$10$tDzdWrUeas1XlJyIgWdLm.t3aIhAefbPW4ui/7MR.Wc9o./PD3V76', 'adsaaddaad-plus@mail.ru', 'Второй сушиq', '', '', '', '', '', 'user', '864644646464'),
(95, NULL, NULL, 'arkad-plus@mail.ru', 'Tx11Rez315OblivioN', '', '', '', '', '', 'user', '891131313133');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attribute_group`
--
ALTER TABLE `attribute_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`attr_id`,`product_id`);

--
-- Индексы таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`),
  ADD KEY `attr_group_id` (`attr_group_id`);

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery_brand`
--
ALTER TABLE `gallery_brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `modification`
--
ALTER TABLE `modification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pickup_address_id` (`pickup_address_id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `pickup_address`
--
ALTER TABLE `pickup_address`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `hit` (`hit`);

--
-- Индексы таблицы `prod_content`
--
ALTER TABLE `prod_content`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `related_product`
--
ALTER TABLE `related_product`
  ADD PRIMARY KEY (`product_id`,`related_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `user_number_uindex` (`number`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attribute_group`
--
ALTER TABLE `attribute_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `gallery_brand`
--
ALTER TABLE `gallery_brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `modification`
--
ALTER TABLE `modification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT для таблицы `pickup_address`
--
ALTER TABLE `pickup_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `prod_content`
--
ALTER TABLE `prod_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
