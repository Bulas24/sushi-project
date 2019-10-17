-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 16 2019 г., 07:43
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
-- Структура таблицы `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`id`, `title`, `img`) VALUES
(1, 'bnr11', 'slider_1920x560_derzhim_tceni-1920x560-1920x560.jpg'),
(2, 'dnr23', 'slider_1920x560_roll-1920x560.jpg'),
(4, 'newbnr1', '58fa0f5769580af2faca5e67e6920557.jpg'),
(5, 'newbnr2', '71af9ec14c2aca1db27fdbb82d981d61.jpg');

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
(1, 29, 'Второй суши', '89135568555', 'he14@mail.ru', '1', 7, '0', '', '1', '1', '', '1', '2019-10-15 08:32:04', '2019-10-15 05:03:32', 'RUB', NULL, 'fsf', '', '', '', '', '', 233),
(2, 33, 'Второй суши', '895555568444', 'para2017dd@yandex.ru', '1', 6, '0', '', '1', '0', '', '2', '2019-10-15 08:33:31', '2019-10-15 05:03:43', 'RUB', '', '', '', '', '', '', '', 183),
(3, 29, 'Второй суши', '666666666666', 'he14@mail.ru', '0', 7, '1', '15-00', '1', '1', '2000', '0', '2019-10-15 09:00:36', NULL, 'RUB', NULL, 'Больше васаби', 'Ленина', '15', '', '', '22', 50),
(4, 34, 'Коля', '111111111111', 'arkad-p111lus@mail.ru', '0', NULL, '0', NULL, '1', NULL, NULL, '0', '2019-10-16 04:31:52', NULL, 'RUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 233);

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
(1, 1, 42, 1, 'Акция 2', 100),
(2, 1, 43, 1, 'Акция 3', 133),
(3, 2, 34, 1, 'Акция 1', 50),
(4, 2, 43, 1, 'Акция 3', 133),
(5, 3, 34, 1, 'Акция 1', 50),
(6, 4, 42, 1, 'Акция 2', 100),
(7, 4, 43, 1, 'Акция 3', 133);

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
  `role` enum('user','admin','manager') NOT NULL DEFAULT 'user',
  `number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `name`, `address_street`, `address_home`, `address_porch`, `address_floor`, `address_apartment`, `role`, `number`) VALUES
(29, 'user1', '$2y$10$ocF4eJXt9ReYCcjkC4RC9OwqFGfUWhLSysxid6yL7V/wGYxw3qpJq', 'he14@mail.ru', 'Евгений', 'Крупской', '10', '3', '3', '24', 'admin', '89135568444'),
(30, 'user2', '$2y$10$hC/.eyfWwXnclhYcYqmDOOTRhDsDp167HJ84Qpo1fm4MvdErU.Kqa', '11arkad-plus@mail.ru', 'Коля', 'a', 'a', '', '', '', 'manager', '666611161166'),
(32, 'user3', '$2y$10$gkcFkuZ2C4lELYDk8NzFBObFtc.Gda70gZSAbR9zl2jW/QQc7PnfO', 'arka11d-plus@mail.ru', 'Коля', '', '', '', '', '', 'manager', '891355228444'),
(33, NULL, NULL, 'para2017dd@yandex.ru', 'Второй суши', '', '', '', '', '', 'user', '895555568444'),
(34, NULL, NULL, 'arkad-p111lus@mail.ru', 'Коля', '', '', '', '', '', 'user', '111111111111');

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
-- Индексы таблицы `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
