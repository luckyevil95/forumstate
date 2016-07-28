-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 176.106.197.212:3306
-- Время создания: Июл 29 2016 г., 01:17
-- Версия сервера: 5.5.50
-- Версия PHP: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `main`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `position`) VALUES
(1, 'Компьютерные игры', 'Обсуждение компьютерных игр разных жанров', 1),
(2, 'Политика', 'Говорим про политические события в СНГ и за рубежом', 2),
(3, 'История', 'Все про события прошлого разных эпох', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_forum` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL DEFAULT '/img/forum_icon.png',
  `position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forums`
--

INSERT INTO `forums` (`id`, `category_id`, `parent_forum`, `title`, `description`, `keywords`, `icon`, `position`) VALUES
(1, 1, NULL, 'MOBA игры', 'MOBA игры', 'MOBA игры', '/img/forum_icon.png', 1),
(2, 1, NULL, 'Шутеры', 'Шутеры', 'Шутеры', '/img/forum_icon.png', 2),
(3, 1, NULL, 'Стратегии', 'Стратегии', 'Стратегии', '/img/forum_icon.png', 3),
(4, 3, NULL, 'Античность', 'Античность', 'Античность', '/img/forum_icon.png', 1),
(5, 3, NULL, 'Средневековье', 'Средневековье', 'Средневековье', '/img/forum_icon.png', 2),
(6, 3, NULL, 'Новая эпоха', 'Новая эпоха', 'Новая эпоха', '/img/forum_icon.png', 3),
(7, 3, NULL, 'Новейшее время', 'Новейшее время', 'Новейшее время', '/img/forum_icon.png', 4),
(8, 2, NULL, 'Страны СНГ', 'Страны СНГ', 'Страны СНГ', '/img/forum_icon.png', 1),
(9, 2, NULL, 'Северная Атлантика', 'Северная Атлантика', 'Северная Атлантика', '/img/forum_icon.png', 2),
(10, 2, NULL, 'Азия и Африка', 'Азия и Африка', 'Азия и Африка', '/img/forum_icon.png', 3),
(11, 1, 1, 'Dota 2', 'Dota 2', 'Dota 2', '/img/forum_icon.png', 1),
(12, 1, 1, 'League of Legends', 'League of Legends', 'League of Legends', '/img/forum_icon.png', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `forum_id`, `user_id`, `title`, `date_created`, `ip`) VALUES
(1, 1, 1, 'Dota 2 Обсуждение', '2016-07-28 10:52:11', '127.0.0.1'),
(7, 1, 1, 'Лига Легенд стоит ли играть?', '2016-07-28 10:55:19', '127.0.0.1'),
(8, 1, 1, 'HOTS - лучший герой', '2016-07-28 10:58:19', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL DEFAULT '/img/no_avatar.jpg',
  `money` int(11) NOT NULL DEFAULT '0',
  `date_registration` datetime NOT NULL,
  `date_last_visit` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `avatar`, `money`, `date_registration`, `date_last_visit`, `ip`) VALUES
(1, 'Scorpion', '19951953', '/img/no_avatar.jpg', 0, '2016-07-26 21:58:03', '2016-07-26 21:58:19', '176.106.197.212');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `parent_forum` (`parent_forum`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `forums_ibfk_2` FOREIGN KEY (`parent_forum`) REFERENCES `forums` (`id`);

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
