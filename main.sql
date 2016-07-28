-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Лип 28 2016 р., 17:49
-- Версія сервера: 5.5.45
-- Версія PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `main`
--

-- --------------------------------------------------------

--
-- Структура таблиці `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `position`) VALUES
(1, 'Компьютерные игры', 'Обсуждение компьютерных игр разных жанров', 1),
(2, 'Политика', 'Говорим про политические события в СНГ и за рубежом', 2),
(3, 'История', 'Все про события прошлого разных эпох', 3);

-- --------------------------------------------------------

--
-- Структура таблиці `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `parent_forum` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL DEFAULT '/img/forum_icon.png',
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `parent_forum` (`parent_forum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп даних таблиці `forums`
--

INSERT INTO `forums` (`id`, `category_id`, `parent_forum`, `title`, `description`, `icon`, `position`) VALUES
(1, 1, NULL, 'MOBA игры', 'MOBA игры', '/img/forum_icon.png', 1),
(2, 1, NULL, 'Шутеры', 'Шутеры', '/img/forum_icon.png', 2),
(3, 1, NULL, 'Стратегии', 'Стратегии', '/img/forum_icon.png', 3),
(4, 3, NULL, 'Античность', 'Античность', '/img/forum_icon.png', 1),
(5, 3, NULL, 'Средневековье', 'Средневековье', '/img/forum_icon.png', 2),
(6, 3, NULL, 'Новая эпоха', 'Новая эпоха', '/img/forum_icon.png', 3),
(7, 3, NULL, 'Новейшее время', 'Новейшее время', '/img/forum_icon.png', 4),
(8, 2, NULL, 'Страны СНГ', 'Страны СНГ', '/img/forum_icon.png', 1),
(9, 2, NULL, 'Северная Атлантика', 'Северная Атлантика', '/img/forum_icon.png', 2),
(10, 2, NULL, 'Азия и Африка', 'Азия и Африка', '/img/forum_icon.png', 3),
(11, 1, 1, 'Dota 2', 'Dota 2', '/img/forum_icon.png', 1),
(12, 1, 1, 'League of Legends', 'League of Legends', '/img/forum_icon.png', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп даних таблиці `topics`
--

INSERT INTO `topics` (`id`, `forum_id`, `user_id`, `title`, `date_created`, `ip`) VALUES
(1, 1, 1, 'Dota 2 Обсуждение', '2016-07-28 10:52:11', '127.0.0.1'),
(7, 1, 1, 'Лига Легенд стоит ли играть?', '2016-07-28 10:55:19', '127.0.0.1'),
(8, 1, 1, 'HOTS - лучший герой', '2016-07-28 10:58:19', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL DEFAULT '/img/no_avatar.jpg',
  `money` int(11) NOT NULL DEFAULT '0',
  `date_registration` datetime NOT NULL,
  `date_last_visit` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `avatar`, `money`, `date_registration`, `date_last_visit`, `ip`) VALUES
(1, 'Scorpion', '19951953', '/img/no_avatar.jpg', 0, '2016-07-26 21:58:03', '2016-07-26 21:58:19', '176.106.197.212');

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_ibfk_2` FOREIGN KEY (`parent_forum`) REFERENCES `forums` (`id`),
  ADD CONSTRAINT `forums_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
