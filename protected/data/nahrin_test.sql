-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 09 2013 г., 18:26
-- Версия сервера: 5.1.66-0+squeeze1-log
-- Версия PHP: 5.3.3-7+squeeze17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `nahrin_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_attributes`
--

CREATE TABLE IF NOT EXISTS `shopyii_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type_field` varchar(10) NOT NULL,
  `type_attr` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица динмических полей товара' AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `shopyii_attributes`
--

INSERT INTO `shopyii_attributes` (`id`, `slug`, `name`, `type_field`, `type_attr`) VALUES
(1, 'svoystva', 'Свойства', 'textarea', 'mainlist'),
(2, 'rekomendacii', 'Рекомендации', 'textarea', 'mainlist'),
(3, 'pishchevaya-cennost', 'Пищевая ценность', 'textarea', 'mainlist'),
(4, 'sposob-primeneniya', 'Способ применения', 'textarea', 'mainlist'),
(5, 'obem', 'Объем', 'input', 'single');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_attributes_groups`
--

CREATE TABLE IF NOT EXISTS `shopyii_attributes_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `shopyii_attributes_groups`
--

INSERT INTO `shopyii_attributes_groups` (`id`, `name`) VALUES
(1, 'Продукты питания'),
(2, 'Бытовая химия');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_attributes_groups_and_attributes`
--

CREATE TABLE IF NOT EXISTS `shopyii_attributes_groups_and_attributes` (
  `attribute_group_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`attribute_group_id`,`attribute_id`),
  KEY `fk_shopyii_attributes_groups_has_shopyii_attributes_shopyii_idx` (`attribute_id`),
  KEY `fk_shopyii_attributes_groups_has_shopyii_attributes_shopyii_idx1` (`attribute_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shopyii_attributes_groups_and_attributes`
--

INSERT INTO `shopyii_attributes_groups_and_attributes` (`attribute_group_id`, `attribute_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_attributes_value`
--

CREATE TABLE IF NOT EXISTS `shopyii_attributes_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shopyii_attributes_value_shopyii_products1_idx` (`product_id`),
  KEY `fk_shopyii_attributes_value_shopyii_attributes1_idx` (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица значений динамических атрибутов товара' AUTO_INCREMENT=137 ;

--
-- Дамп данных таблицы `shopyii_attributes_value`
--

INSERT INTO `shopyii_attributes_value` (`id`, `product_id`, `attribute_id`, `value`) VALUES
(82, 15, 1, '<p>\r\n	          Свойства товара\r\n</p>'),
(83, 15, 2, '<p>\r\n	          рекомендации файыуайцуа\r\n</p>'),
(84, 15, 3, '<p>\r\n	          Ценность пищевая\r\n</p>'),
(85, 15, 4, '<p>\r\n	как применять\r\n</p>'),
(86, 15, 5, '300 мл'),
(87, 3, 1, '<ul>\r\n	<li>восстанавливает запасы железа в организме</li>\r\n	<li>улучшает кровоснабжение сердечной мышцы, укрепляет сердце</li>\r\n	<li>понижает кровяное давление</li>\r\n	<li>препятствует образованию тромбов и предупреждает развитие атеросклероза</li>\r\n	<li>укрепляет иммунитет и сопротивляемость организма простудным заболеваниям</li>\r\n	<li>улучшает зрение, в том числе ночное</li>\r\n	<li>укрепляет кровеносные сосуды и улучшает кровоснабжение органов</li>\r\n	<li>обладает мягким диуретическим эффектом</li>\r\n	<li>нормализует деятельность желудка и кишечника</li>\r\n</ul>'),
(88, 3, 2, '<p>\r\n	 йцуайцуа\r\n</p>'),
(89, 3, 3, '<p>\r\n	 йцуайцуайцу\r\n</p>'),
(90, 3, 4, '<p>\r\n	 йцуайцуацу\r\n</p>'),
(91, 3, 5, '400 мл'),
(92, 16, 1, '<p>\r\n	   wqwbdwl''iy;jhg\r\n</p>'),
(93, 16, 2, '<p>\r\n	   g,mgetryup[drzseAWQ#Wp\r\n</p>'),
(94, 16, 3, '<p>\r\n	   tcyuiuyzserawesrctfgvybuhjnimko,lpmko[\r\n</p>'),
(95, 16, 4, '<p>\r\n	   xdtfcgyvcfzserxdtgvybuhjnimkjiuhdr\r\n</p>'),
(96, 16, 5, '260 мл'),
(97, 17, 1, '<p>\r\n	  aseyuictdrseawq\r\n</p>'),
(98, 17, 2, '<p>\r\n	 wrdrewQWse\r\n</p>'),
(99, 17, 3, '<p>\r\n	 zsdWRAEsdrfd\r\n</p>'),
(100, 17, 4, '<p>\r\n	 zsdfgfdsertd\r\n</p>'),
(101, 17, 5, '266 мл'),
(102, 18, 1, '<p>\r\n	                      qwgufsae</p>'),
(103, 18, 2, '<p>\r\n	                      esterdftsecg</p>'),
(104, 18, 3, ''),
(105, 18, 4, '<p>\r\n	                      szdcghfdsdrfyrsthr</p>'),
(106, 18, 5, '299 мл'),
(112, 20, 1, '<p>\r\n	 qwefqwefqw\r\n</p>'),
(113, 20, 2, '<p>\r\n	 qwefqwefq\r\n</p>'),
(114, 20, 3, '<p>\r\n	 qwefqwef\r\n</p>'),
(115, 20, 4, '<p>\r\n	 qwefqwefqwe\r\n</p>'),
(116, 20, 5, '455 мл'),
(117, 24, 1, '<p>\r\n	цуайцуа\r\n</p>'),
(118, 24, 2, '<p>\r\n	йцуайцу\r\n</p>'),
(119, 24, 3, '<p>\r\n	айцуа\r\n</p>'),
(120, 24, 4, '<p>\r\n	йцуайцу\r\n</p>'),
(121, 24, 5, '145 мл'),
(122, 25, 1, ''),
(123, 25, 2, '<p>\r\n	йцуайцуа\r\n</p>'),
(124, 25, 3, '<p>\r\n	йцуайцу\r\n</p>'),
(125, 25, 4, ''),
(126, 25, 5, ''),
(127, 26, 1, '<p>\r\n	qef\r\n</p>'),
(128, 26, 2, ''),
(129, 26, 3, ''),
(130, 26, 4, '<p>\r\n	qwefqwef\r\n</p>'),
(131, 26, 5, '120 мл'),
(132, 27, 1, '<p>\r\n	wqef</p>'),
(133, 27, 2, '<p>\r\n	qwef</p>'),
(134, 27, 3, '<p>\r\n	qwef</p>'),
(135, 27, 4, ''),
(136, 27, 5, '244 шт');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_brands`
--

CREATE TABLE IF NOT EXISTS `shopyii_brands` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `meta_title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shopyii_brands`
--

INSERT INTO `shopyii_brands` (`id`, `name`, `slug`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Нарин', 'narin', '', '', ''),
(3, 'Юстрих-Косметикс', 'yustrih-kosmetiks', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_category`
--

CREATE TABLE IF NOT EXISTS `shopyii_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `meta_title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `shopyii_category`
--

INSERT INTO `shopyii_category` (`id`, `slug`, `name`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(21, 'zdorove-detey', 'Здоровье детей', '', '', ''),
(22, 'liniya-dlya-muzhchin', 'Линия для мужчин', '', '', ''),
(23, 'liniya-dlya-zhenshchin', 'Линия для женщин', '', '', ''),
(24, 'ochishchenie-organizma', 'Очищение организма', '', '', ''),
(25, 'pishchevaritelnaya-sistema', 'Пищеварительная система', '', '', ''),
(26, 'silnyy-immunitet', 'Сильный иммунитет', '', '', ''),
(27, 'zdorovoe-serdce-i-sosudy', 'Здоровое сердце и сосуды', '', '', ''),
(28, 'zritelnaya-sistema', 'Зрительная система', '', '', ''),
(29, 'zdorovye-sustavy', 'Здоровые суставы', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_category_and_product`
--

CREATE TABLE IF NOT EXISTS `shopyii_category_and_product` (
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `fk_shopyii_category_has_shopyii_products_shopyii_products1_idx` (`product_id`),
  KEY `fk_shopyii_category_has_shopyii_products_shopyii_category1_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shopyii_category_and_product`
--

INSERT INTO `shopyii_category_and_product` (`product_id`, `category_id`) VALUES
(3, 22),
(3, 25),
(15, 22),
(15, 23),
(16, 23),
(16, 25),
(17, 22),
(17, 27),
(18, 27),
(18, 29),
(20, 23),
(20, 25),
(20, 28),
(24, 21),
(25, 21),
(25, 23),
(25, 24),
(25, 28),
(26, 21),
(26, 23),
(26, 29),
(27, 22),
(27, 25),
(27, 28);

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_configs`
--

CREATE TABLE IF NOT EXISTS `shopyii_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `param` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `param` (`param`),
  KEY `date_update` (`date_update`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица конфигурации приложения' AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `shopyii_configs`
--

INSERT INTO `shopyii_configs` (`id`, `param`, `value`, `date_update`) VALUES
(3, 'contact_email', 'info@bcard.com', '2013-10-07 17:55:51'),
(4, 'contact_title', 'Контактные данные', '2013-10-07 17:55:51'),
(5, 'contact_content', '<p>\r\n	        Уважаемые клиенты, если у вас возникли вопросы, претензии или жалобы касающиеся работы нашего магазина или представленного на его страницах товара, пожалуйста, обратитесь в службу поддержки клиентов, используя форму.\r\n</p>\r\n<h3>Телефоны центра поддержки </h3>\r\n<p>\r\n	        Техническая поддержка, вопросы по работе сайта<br>\r\n	     +380 (97) 285-55-45, Александр\r\n</p>\r\n<p>\r\n	        Консультативная помощь<br>\r\n	     +380 (97) 491-26-10, Татьяна\r\n</p>\r\n<h3>Написать письмо в службу поддержки клиентов</h3>', '2013-10-07 17:55:51'),
(6, 'meta_keywords', 'Ключевые слова', '2013-10-07 17:56:49'),
(7, 'meta_description', 'Описание сайта', '2013-10-07 17:56:49'),
(8, 'meta_title', 'Nanrin Ukraine', '2013-10-07 17:56:49'),
(19, 'mainpage_news', '2', '2013-10-08 14:32:34'),
(20, 'mainpage_popular_products', '3;16;17', '2013-10-08 14:32:34'),
(21, 'mainpage_new_products', '25;26;27', '2013-10-08 14:32:34');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_currency`
--

CREATE TABLE IF NOT EXISTS `shopyii_currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `symbol` varchar(45) NOT NULL,
  `rounding` char(1) NOT NULL DEFAULT 'c',
  `position_symbol` char(1) NOT NULL,
  `iso_code` char(3) NOT NULL,
  `rate` decimal(6,4) NOT NULL,
  `percentage` smallint(6) NOT NULL DEFAULT '0',
  `main` tinyint(1) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `shopyii_currency`
--

INSERT INTO `shopyii_currency` (`id`, `name`, `symbol`, `rounding`, `position_symbol`, `iso_code`, `rate`, `percentage`, `main`, `date_create`, `date_update`) VALUES
(2, 'Доллар', '$', 'c', 'l', 'USD', '1.0000', 20, 1, '2013-10-04 17:30:14', '2013-10-08 19:01:41'),
(3, 'Баллы', 'бал.', '', 'r', 'BAL', '0.0416', 0, 0, '2013-10-04 17:52:29', '2013-10-04 23:02:36'),
(4, 'Гривны', 'грн', '', 'r', 'UAN', '8.0200', 0, 0, '2013-10-04 17:54:57', '2013-10-05 09:34:01');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_mod_news`
--

CREATE TABLE IF NOT EXISTS `shopyii_mod_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `content_short` text NOT NULL,
  `content_full` text NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `meta_title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_name` (`slug`),
  KEY `date_update` (`date_update`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='News' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `shopyii_mod_news`
--

INSERT INTO `shopyii_mod_news` (`id`, `slug`, `name`, `content_short`, `content_full`, `active`, `meta_title`, `meta_description`, `meta_keywords`, `date_create`, `date_update`) VALUES
(1, 'vegetariancy', 'Вегетарианцы', '<p>\r\n	Cуществуют различные формы вегетарианства:</p><ul>\r\n	\r\n<li>лакто-вегетарианство: мясо, яйца и рыба не употребляется;</li>	\r\n<li>лакто-ово-вегетарианство: мясо и, по возможности, рыба не употребляются. Эти люди едят яйца, молоко и молочные продукты;</li></ul>', '<blockquote>\r\n	          Для того чтобы организм мог усваивать железо из растительных продуктов, необходимо присутствие витамина С (содержащегося, например, в овощах и фруктах).\r\n</blockquote><p>\r\n	             Существуют различные формы вегетарианства:</p><ul>\r\n	\r\n<li>лакто-вегетарианство: мясо, яйца и рыба не употребляется;</li>	\r\n<li>лакто-ово-вегетарианство: мясо и, по возможности, рыба не употребляются. Эти люди едят яйца, молоко и молочные продукты;</li>	\r\n<li>строгое вегетарианство: исключаются любые продукты животного происхождения (мясо, рыба, яйца, молоко, молочные продукты и даже мед). Со временем такая форма вегетарианства может привести к недостатку питательных веществ (протеинов), витаминов (В12) и минералов (кальция, железа). Такое вегетарианство не рекомендуется детям, подросткам, беременным и кормящим женщинам, спортсменам высокого уровня. Эта категория людей имеет повышенную потребность в питательных веществах, витаминах и минералах.</li></ul><p>\r\n	                    Лакто-ово-вегетарианцы и лакто вегетарианцы должны учитывать следующие моменты:</p><p>\r\n	                    Для удовлетворения потребности организма в белках, каждый прием пищи должен включать продукты, содержащие протеин высокой питательной ценности.</p><p>\r\n	                    Например:</p><ul>\r\n	\r\n<li>тофу (соевый творог);</li>	\r\n<li>яйца;</li>	\r\n<li>сыр, творог;</li>	\r\n<li>бобовые.</li></ul><p>\r\n	                    Основным источником железа и витамина В12 являются продукты животного происхождения, в основном мясо.</p><p>\r\n	                    Для того чтобы организм мог усваивать железо из растительных продуктов, необходимо присутствие витамина С (содержащегося, например, в овощах и фруктах).</p><p>\r\n	                    Потребность в витамине B12 может быть покрыта за счет регулярного употребления сыра, яиц и рыбы.</p><p>\r\n	                    Источник: Мелани Берже, дипломированный диетолог</p>', 1, '', '', '', '2013-09-10 22:39:28', '2013-10-08 00:04:10'),
(2, 'neperenosimost-glyutena', 'Непереносимость глютена', '<p>\r\n	    Глютен – это растительный белок, содержащийся в зернах различных злаков. Благодаря его связывающим свойствам, становится возможным хлебопечение.</p><p>\r\n	    Обычно питательные вещества (протеины, жиры, углеводы, витамины и минералы) перерабатываются в тонком кишечнике и усваиваются организмом. Для оптимального усвоения слизистая оболочка кишечника содержит ворсинки. В случае непереносимости глютена количество этих ворсинок недостаточно, или они полностью отсутствуют, что приводит к плохой усвояемости питательных веществ. Возможны следующие проявления</p>', '<p>\r\n	    Глютен – это растительный белок, содержащийся в зернах различных злаков. Благодаря его связывающим свойствам, становится возможным хлебопечение.</p><p>\r\n	<strong>Возможные симптомы</strong></p><p>\r\n	    Обычно питательные вещества (протеины, жиры, углеводы, витамины и минералы) перерабатываются в тонком кишечнике и усваиваются организмом. Для оптимального усвоения слизистая оболочка кишечника содержит ворсинки. В случае непереносимости глютена количество этих ворсинок недостаточно, или они полностью отсутствуют, что приводит к плохой усвояемости питательных веществ. Возможны следующие проявления:</p><ul>\r\n	\r\n<li>боли в желудке, метеоризм;</li>	\r\n<li>диарея или, наоборот, констипация;</li>	\r\n<li>липиды в кале;</li>	\r\n<li>тошнота и рвота;</li>	\r\n<li>дефицит витаминов и минералов (железа, кальция, витамина В12...)</li>	\r\n<li>потеря веса;</li>	\r\n<li>задержка в росте и развитии у детей.</li></ul><p>\r\n	<strong>Терапия</strong></p><p>\r\n	    Лечение заключается в исключении из рациона некоторых злаков и продуктов из этих злаков.</p>', 1, '', '', '', '2013-09-10 22:43:45', '2013-10-08 14:57:40');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_mod_pages`
--

CREATE TABLE IF NOT EXISTS `shopyii_mod_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `meta_title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_name` (`slug`),
  KEY `date_update` (`date_update`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Static pages' AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `shopyii_mod_pages`
--

INSERT INTO `shopyii_mod_pages` (`id`, `slug`, `name`, `content`, `active`, `meta_title`, `meta_description`, `meta_keywords`, `date_create`, `date_update`) VALUES
(1, 'sertifikaty', 'Сертификаты', '<p>\r\n	                                  Мы ожидаем копий сертификатов. Скоро выложим их на этой странице.\r\n</p>', 1, '', '', '', '2013-09-09 20:40:42', '2013-10-07 18:55:36'),
(2, 'about', 'О компании', '<p>\r\n	Торговая марка\r\n</p>\r\n<p>\r\n	 <strong>Полезное тоже может быть вкусным</strong>\r\n</p>\r\n<p>\r\n	   Нарин это семейная швейцарская компания, главный офис которой находится в городе Сарнен. С 1954 года Нарин тщательнейшим образом развивает научную базу и производство. Вся продукция разрабатывается в собственных лабораториях и распространяется собственными силами. Поскольку Нарин использует ингредиенты только высшего сорта, продукты обладают исключительным вкусом и питательными свойствами.\r\n</p>\r\n<p>\r\n	   На сегодняшний день Нарин является одним из самых крупных предприятий прямых продаж в Швейцарии. Благодаря активному обмену мнений между производителем и потребителем, компания способна быстро реагировать на пожелания наших клиентов. Тем более что никакая другая форма сотрудничества не дает такой возможности общения и индивидуального подхода, как прямые продажи.\r\n</p>\r\n<p>\r\n	   Нарин является членом VDF, швейцарской ассоциации прямых продаж.\r\n</p>\r\n<p>\r\n	 <strong>Дело не только во вкусе</strong>\r\n</p>\r\n<p>\r\n	   Правильное питание и физическая активность – вот два необходимых условия, чтобы дожить до преклонных лет и остаться в хорошей физической форме. Каждый может способствовать этому долголетию. Что же касается нас, мы ежедневно вносим свой вклад в здоровое питание, как посредством наших научных изысканий, так и наших продуктов, которые, несомненно, нечто гораздо большее, чем просто пища. По иронии письма, на наших продуктах этот вклад чаще всего выражен словами «мало» или «меньше» …\r\n</p>\r\n<ul>\r\n	<li>мало или не содержит жиров</li>\r\n	<li>мало или не содержит сахара</li>\r\n	<li>мало или не содержит соли</li>\r\n	<li>меньше калорий</li>\r\n	<li>по возможности, не содержит аллергенов (глютена, лактозы)</li>\r\n</ul>\r\n<p>\r\n	 <strong>Нарин является синонимом качества и надежности</strong>\r\n</p>\r\n<p>\r\n	   На обработку поступает только самое высококачественное сырье, из которого, благодаря проверенной рецептуре, рождаются шедевры, полезные и приятные на вкус.\r\n</p>\r\n<p>\r\n	   Мы трепетно относимся к окружающей среде. От момента основания наша компания взяла курс на экологичные технологии. Мы никогда не использовали нефтепродукты для отопления – вместо этого у нас установлены тепловые насосы. Сложные системы теплоотбора уменьшают выбросы CO2. В 2005 году, когда мы увеличили вдвое производственную и складскую базу, наше потребление энергии выросло всего на 30%.\r\n</p>\r\n<p>\r\n	 <strong>Сертификаты</strong>\r\n</p>\r\n<ul>\r\n	<li>ISO 9001:2000</li>\r\n	<li>bio. Bi-31227 для биологических продуктов</li>\r\n	<li>FVO 333 для завода по переработке мяса</li>\r\n	<li>MIBD 2435 для завода по переработке молока</li>\r\n</ul>', 1, '', '', '', '2013-09-09 20:40:42', '2013-09-10 23:43:49'),
(3, 'help', 'Помощь', '<p>\r\n	<em>Я бы хотел получить персональные рекомендации</em>\r\n</p>\r\n<p>\r\n	Мы будем рады проконсультировать Вас лично. Свяжитесь с нами, чтобы мы могли договориться о встрече.\r\n</p>\r\n<p>\r\n	<em>Как я могу оплатить?</em>\r\n</p>\r\n<p>\r\n	Вы можете оплатить заказ кредитной или дебетовой картой Visa или MasterCard сразу после оформления, оплатить счет в любом отделении банка или рассчитаться наличными при получении. Условия\r\n</p>\r\n<p>\r\n	<em>Что делать, если товар отсутствует или поврежден?</em>\r\n</p>\r\n<p>\r\n	Мы делаем все возможное, чтобы удовлетворить наших клиентов. Тем не менее, если подобные проблемы возникнут, пожалуйста, сообщите нам об этом безотлагательно.\r\n</p>\r\n<p>\r\n	Если Вы не полностью удовлетворены качеством продукции, мы тотчас заменим ее.Контакты\r\n</p>\r\n<p>\r\n	<em>Будет ли моя личная информация в безопасности?</em>\r\n</p>\r\n<p>\r\n	Ваша личная информация используется исключительно компанией Нарин и не передается третьим лицам. Условия\r\n</p>\r\n<p>\r\n	<em>Есть ли в продуктах Нарин генетически модифицированные ингредиенты?</em>\r\n</p>\r\n<p>\r\n	Нарин не использует генетически модифицированные ингредиенты в своих продуктах.\r\n</p>\r\n<p>\r\n	<em>У меня сахарный диабет, целиакия или непереносимость отдельных ингредиентов</em>\r\n</p>\r\n<p>\r\n	Многие продукты Нарин пригодны к употреблению при сахарном диабете и целиакии. Вы можете найти более подробную информацию об этом в разделе Советы\r\n</p>', 1, '', '', '', '2013-09-09 20:40:42', '2013-09-09 18:22:18'),
(5, 'oplata-i-dostavka', 'Оплата и доставка', '<p>\r\n	 Скоро мы разместим здесь информацию про оплату и доставку\r\n</p>', 1, '', '', '', '2013-09-09 20:40:42', '2013-09-09 20:41:53'),
(6, 'sotrudnichestvo', 'Сотрудничество', '<p>\r\n	 Вы можете с нами сотрудничать, скоро узнаете как=)\r\n</p>', 1, '', '', '', '2013-09-09 20:40:42', '2013-09-09 20:42:45'),
(7, 'kak-stat-partnerom', 'Как стать партнером?', '<p>\r\n	Очень просто! Скоро мы расскажем вам об этом. Ожидайте заполнения этой страницы=)\r\n</p>', 1, '', '', '', '2013-09-09 20:40:42', '2013-09-10 19:39:59');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_mod_promo_kits`
--

CREATE TABLE IF NOT EXISTS `shopyii_mod_promo_kits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `percentage` smallint(6) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `timertype` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `stop` datetime NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `meta_title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `shopyii_mod_promo_kits`
--

INSERT INTO `shopyii_mod_promo_kits` (`id`, `percentage`, `active`, `timertype`, `name`, `stop`, `description`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `date_create`, `date_update`) VALUES
(1, 30, 1, 1, 'Здоровая семья', '2013-10-11 10:55:00', '<p>Количество наборов <strong>ограничено</strong>!</p>', 'zdorovaya-semya', '', '', '', '2013-10-09 00:50:36', '2013-10-09 15:01:56'),
(2, 30, 1, 0, 'Бабушкина аптечка', '2013-10-11 08:50:00', '<p>Его покупают все!</p><p>Не упусти шанс!</p>', 'babushkina-aptechka', '', '', '', '2013-10-09 09:40:38', '2013-10-09 15:02:32');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_products`
--

CREATE TABLE IF NOT EXISTS `shopyii_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) unsigned NOT NULL,
  `attr_group_id` int(10) unsigned NOT NULL,
  `slug` varchar(200) NOT NULL,
  `article` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `amount` smallint(5) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `meta_title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `date_update` datetime NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `article_UNIQUE` (`article`),
  KEY `fk_shopyii_products_shopyii_brands1_idx` (`brand_id`),
  KEY `fk_shopyii_products_shopyii_attributes_groups1_idx` (`attr_group_id`),
  KEY `date_update` (`date_update`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица продуктов' AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `shopyii_products`
--

INSERT INTO `shopyii_products` (`id`, `brand_id`, `attr_group_id`, `slug`, `article`, `name`, `description`, `price`, `amount`, `active`, `meta_title`, `meta_description`, `meta_keywords`, `date_update`, `date_create`) VALUES
(3, 3, 1, 'narosan-krasnaya-yagoda', 'BR-98883', 'Наросан красная ягода', '<p>\r\n	                                                                                 Основа для приготовления напитка с экстрактом сои, комплексом антиоксидантов, кальцием и магнием.\r\n</p>\r\n<ul>\r\n	<li>Восстанавливает гормональный баланс в организме женщины</li>\r\n	<li>Обладает антиоксидантным действием</li>\r\n	<li>Улучшает состояние кожи</li>\r\n	<li>Снижает уровень глюкозы и холестерина в крови</li>\r\n	<li>Способствует повышению прочности костной ткани</li>\r\n</ul>', '1000.00', 56, 1, '', '', '', '2013-10-02 17:44:45', '2013-09-11 18:10:00'),
(15, 3, 1, 'novyy-produkt', 'FD-6345', 'Еловый сироп', '<p>\r\n	          Сироп с экстрактом побегов ели, фенхеля и витамином C\r\n</p>\r\n<p>\r\n	          Повышает адаптационные возможности организма\r\n</p>\r\n<p>\r\n	          Способствует заживлению слизистых оболочек\r\n</p>\r\n<p>\r\n	          Оказывает стимулирующее действие на кроветворение\r\n</p>\r\n<p>\r\n	          Обладает противовирусной активностью\r\n</p>', '247.00', 5, 0, '', '', '', '2013-10-06 13:46:43', '2013-09-23 17:06:07'),
(16, 3, 1, 'zelenyy-chay-s-myatoy-perechnoy', 'SF-67578', 'Зеленый чай с мятой перечной', '<p>\r\n	    Пастилки с экстрактом зеленого чая, мяты перечной и комплексом антиоксидантов (витамин E, C, бета-каротин, селен)\r\n</p>\r\n<p>\r\n	    Защищает клеточные мембраны\r\n</p>\r\n<p>\r\n	    Укрепляет сердце и сосуды\r\n</p>\r\n<p>\r\n	    Повышает иммунный потенциал организма\r\n</p>\r\n<p>\r\n	    Стимулирует синтез мужских половых гормонов\r\n</p>\r\n<p>\r\n	    Снижает уровень холестерина\r\n</p>', '292.00', 33, 1, '', '', '', '2013-10-02 17:44:05', '2013-10-02 17:15:30'),
(17, 1, 1, 'mozhzhevelovyy-sirop', 'DF-5574', 'Можжевеловый сироп', '<p>\r\n	  Сироп с экстрактом горного можжевельника\r\n</p>\r\n<p>\r\n	  Укрепляет нервную систему\r\n</p>\r\n<p>\r\n	  Усиливает обмен веществ\r\n</p>\r\n<p>\r\n	  Способствует очищению крови\r\n</p>\r\n<p>\r\n	  Обладает противовоспалительным свойством\r\n</p>', '247.00', 36, 1, '', '', '', '2013-10-02 17:44:32', '2013-10-02 17:18:09'),
(18, 1, 1, 'ehinacina', 'SG-2335', 'Эхинацина', '<p>\r\n	                        Сироп ежевики с эхинацеей и витамином C</p><p>\r\n	                        Улучшает естественные защитные силы организма</p><p>\r\n	                        Оказывает противовирусное действие</p><p>\r\n	                        Обладает антибактериальной активностью</p><p>\r\n	                        Стимулирует заживление ран</p>', '236.00', 0, 1, '', '', '', '2013-10-08 01:00:30', '2013-10-02 17:20:51'),
(20, 1, 1, 'narosan-apelsin', 'NAR-455', 'Наросан Апельсин', '<p>\r\n	  Сок апельсина и ананаса с добавлением экстракта зародышей пшеницы, витаминов и магния\r\n</p>\r\n<p>\r\n	  Укрепляет сердце\r\n</p>\r\n<p>\r\n	  Пополняет энергетические запасы клеток\r\n</p>\r\n<p>\r\n	  Усиливает защитные силы организма\r\n</p>\r\n<p>\r\n	  Способствует улучшению памяти\r\n</p>\r\n<p>\r\n	  Рекомендуется при повышенных эмоциональных нагрузках\r\n</p>', '352.00', 56, 1, '', '', '', '2013-10-06 13:33:32', '2013-10-06 13:07:56'),
(24, 1, 1, 'narosan-apelsin-chechevica', 'NAR-4554', 'Наросан Апельсин Чечевица', '<p>\r\n	Сок апельсина и ананаса с добавлением экстракта зародышей пшеницы, витаминов и магния\r\n</p>\r\n<p>\r\n	Укрепляет сердце\r\n</p>\r\n<p>\r\n	Пополняет энергетические запасы клеток\r\n</p>\r\n<p>\r\n	Усиливает защитные силы организма\r\n</p>\r\n<p>\r\n	Способствует улучшению памяти\r\n</p>\r\n<p>\r\n	Рекомендуется при повышенных эмоциональных нагрузках\r\n</p>', '236.00', 15, 1, '', '', '', '2013-10-06 13:37:20', '2013-10-06 13:36:31'),
(25, 3, 1, 'narosan-tropik', 'NAR-155', 'Наросан Тропик', '<p>\r\n	 Сок апельсина, манго, папайи, ананаса и маракуйи с добавлением экстракта зародышей пшеницы, сока алоэ вера, витаминов и цинка\r\n</p>\r\n<p>\r\n	 Содержание сока – 70%\r\n</p>\r\n<p>\r\n	 Источник цинка, 12 витаминов и природных антиоксидантов\r\n</p>\r\n<p>\r\n	 Усиливает иммунную защиту\r\n</p>\r\n<p>\r\n	 Способствует повышению работоспособности\r\n</p>\r\n<p>\r\n	 Нормализует деятельность пищеварительного тракта\r\n</p>\r\n<p>\r\n	 Повышает прочность и эластичность сосудов\r\n</p>', '213.00', 70, 1, '', '', '', '2013-10-06 13:46:06', '2013-10-06 13:41:08'),
(26, 1, 1, 'narosan-chernika', 'SG-200', 'Наросан Черника', '<p>\r\n	 Сок черники и лимона с добавлением витаминов, экстракта пыльцы, железа и меди\r\n</p>\r\n<p>\r\n	 Содержание сока – 74%\r\n</p>\r\n<p>\r\n	 Источник железа, меди и 12 витаминов в сбалансированном соотношении\r\n</p>\r\n<p>\r\n	 Укрепляет кровеносные сосуды и улучшает кровоснабжение органов\r\n</p>\r\n<p>\r\n	 Улучшает передачу нервных импульсов\r\n</p>\r\n<p>\r\n	 Повышает защитные силы организма\r\n</p>\r\n<p>\r\n	 Обладает антиоксидантным действием\r\n</p>', '75.00', 754, 1, '', '', '', '2013-10-06 13:43:08', '2013-10-06 13:42:47'),
(27, 1, 1, 'sok-aloe-vera', 'FR-699', 'Сок Алоэ Вера', '<p>\r\n	 Прозрачный сок алоэ из мякоти свежих листьев</p><p>\r\n	 Увеличивает природные защитные силы организма</p><p>\r\n	 Улучшает работу и состояние желудочно-кишечного тракта</p><p>\r\n	 Стабилизирует и регулирует все функции организма</p><p>\r\n	 Обладает противовоспалительным и болеутоляющим свойством</p><p>\r\n	 Улучшает состояние кожи и слизистых оболочек</p>', '100.00', 100, 1, '', '', '', '2013-10-08 19:02:10', '2013-10-06 13:45:16');

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_products_featured`
--

CREATE TABLE IF NOT EXISTS `shopyii_products_featured` (
  `owner_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`owner_id`,`product_id`),
  KEY `fk_shopyii_products_has_shopyii_products_shopyii_products2_idx` (`product_id`),
  KEY `fk_shopyii_products_has_shopyii_products_shopyii_products1_idx` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shopyii_products_featured`
--

INSERT INTO `shopyii_products_featured` (`owner_id`, `product_id`) VALUES
(15, 3),
(17, 3),
(25, 3),
(27, 3),
(3, 15),
(16, 15),
(20, 15),
(15, 16),
(17, 16),
(18, 16),
(20, 16),
(25, 16),
(27, 16),
(3, 17),
(15, 17),
(20, 17),
(27, 17),
(3, 18),
(15, 18),
(16, 18),
(17, 18),
(27, 18),
(25, 20),
(27, 20),
(25, 24),
(27, 24),
(27, 25),
(27, 26);

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_products_mod_promo_kits`
--

CREATE TABLE IF NOT EXISTS `shopyii_products_mod_promo_kits` (
  `products_id` int(10) unsigned NOT NULL,
  `promo_kit_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`products_id`,`promo_kit_id`),
  KEY `fk_shopyii_products_has_shopyii_mod_promotional_sets_mlmsho_idx` (`promo_kit_id`),
  KEY `fk_shopyii_products_has_shopyii_mod_promotional_sets_mlmsho_idx1` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shopyii_products_mod_promo_kits`
--

INSERT INTO `shopyii_products_mod_promo_kits` (`products_id`, `promo_kit_id`) VALUES
(16, 1),
(17, 1),
(18, 1),
(24, 1),
(3, 2),
(16, 2),
(17, 2),
(18, 2),
(20, 2),
(25, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `shopyii_uploads`
--

CREATE TABLE IF NOT EXISTS `shopyii_uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `parent_model` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `filename` varchar(40) NOT NULL,
  `role` char(11) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Загруженные файлы' AUTO_INCREMENT=92 ;


--
-- Структура таблицы `shopyii_users`
--

CREATE TABLE IF NOT EXISTS `shopyii_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `banned` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `role` varchar(5) NOT NULL DEFAULT 'user',
  `phone` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_lastvisit` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `date_update` (`date_update`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей' AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `shopyii_users`
--

INSERT INTO `shopyii_users` (`id`, `email`, `password`, `banned`, `role`, `phone`, `name`, `surname`, `firstname`, `address`, `date_create`, `date_update`, `date_lastvisit`) VALUES
(1, 'raficone@gmail.com', '7833c79773776845a2adde435a55e1e8', 0, 'admin', '', 'Виталий', 'Воскобович', 'Валерьевич', '', '2013-09-09 20:40:42', '2013-10-07 21:21:02', '2013-10-06 15:37:04'),
(2, 'khlipun@gmail.com', '7833c79773776845a2adde435a55e1e8', 0, 'admin', '', 'Александр', 'Хлипун', 'Александрович', '', '2013-09-09 20:40:42', '2013-10-09 16:20:33', '2013-09-09 20:40:42'),
(9, 'alexbordun@gmail.com', '7833c79773776845a2adde435a55e1e8', 0, 'admin', '', 'Бордун', 'Александ', 'Неизвестно', '', '2013-10-09 15:41:55', '2013-10-09 15:41:55', '0000-00-00 00:00:00'),
(10, 'test@gmail.com', '7833c79773776845a2adde435a55e1e8', 0, 'admin', '', 'Тестер', 'Тестеровой', 'Тестерович', '', '2013-10-09 17:12:50', '2013-10-09 17:12:50', '0000-00-00 00:00:00');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `shopyii_attributes_groups_and_attributes`
--
ALTER TABLE `shopyii_attributes_groups_and_attributes`
  ADD CONSTRAINT `fk_shopyii_attributes_groups_has_shopyii_attributes_shopyii_a1` FOREIGN KEY (`attribute_group_id`) REFERENCES `shopyii_attributes_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shopyii_attributes_groups_has_shopyii_attributes_shopyii_a2` FOREIGN KEY (`attribute_id`) REFERENCES `shopyii_attributes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `shopyii_attributes_value`
--
ALTER TABLE `shopyii_attributes_value`
  ADD CONSTRAINT `fk_shopyii_attributes_value_shopyii_attributes1` FOREIGN KEY (`attribute_id`) REFERENCES `shopyii_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shopyii_attributes_value_shopyii_products1` FOREIGN KEY (`product_id`) REFERENCES `shopyii_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shopyii_category_and_product`
--
ALTER TABLE `shopyii_category_and_product`
  ADD CONSTRAINT `fk_shopyii_category_has_shopyii_products_shopyii_category1` FOREIGN KEY (`category_id`) REFERENCES `shopyii_category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shopyii_category_has_shopyii_products_shopyii_products1` FOREIGN KEY (`product_id`) REFERENCES `shopyii_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shopyii_products`
--
ALTER TABLE `shopyii_products`
  ADD CONSTRAINT `fk_shopyii_products_shopyii_attributes_groups1` FOREIGN KEY (`attr_group_id`) REFERENCES `shopyii_attributes_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shopyii_products_shopyii_brands1` FOREIGN KEY (`brand_id`) REFERENCES `shopyii_brands` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shopyii_products_featured`
--
ALTER TABLE `shopyii_products_featured`
  ADD CONSTRAINT `fk_shopyii_products_has_shopyii_products_shopyii_products1` FOREIGN KEY (`owner_id`) REFERENCES `shopyii_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shopyii_products_has_shopyii_products_shopyii_products2` FOREIGN KEY (`product_id`) REFERENCES `shopyii_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `shopyii_products_mod_promo_kits`
--
ALTER TABLE `shopyii_products_mod_promo_kits`
  ADD CONSTRAINT `fk_shopyii_products_has_shopyii_mod_promotional_sets_shopyii_1` FOREIGN KEY (`products_id`) REFERENCES `shopyii_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shopyii_products_has_shopyii_mod_promotional_sets_shopyii_2` FOREIGN KEY (`promo_kit_id`) REFERENCES `shopyii_mod_promo_kits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
