-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 19 2017 г., 19:29
-- Версия сервера: 5.7.19-17-beget-5.7.19-17-1-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `n90933wx_staffbs`
--
CREATE DATABASE IF NOT EXISTS `n90933wx_staffbs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `n90933wx_staffbs`;

-- --------------------------------------------------------

--
-- Структура таблицы `contribution`
--
-- Создание: Ноя 19 2017 г., 12:06
-- Последнее обновление: Ноя 19 2017 г., 15:06
--

DROP TABLE IF EXISTS `contribution`;
CREATE TABLE `contribution` (
  `id` int(10) UNSIGNED NOT NULL,
  `efficiency` int(3) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `experience` int(4) NOT NULL,
  `salary` int(10) NOT NULL,
  `staff_id` int(10) UNSIGNED DEFAULT NULL,
  `information_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contribution`
--

INSERT INTO `contribution` (`id`, `efficiency`, `qualification`, `experience`, `salary`, `staff_id`, `information_id`) VALUES
(2, 95, 'Бакалавр', 5, 25000, 2, 2),
(3, 100, 'Магистр', 20, 45000, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `information`
--
-- Создание: Ноя 19 2017 г., 12:06
-- Последнее обновление: Ноя 19 2017 г., 16:01
--

DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(4) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `staff_id` int(10) UNSIGNED DEFAULT NULL,
  `contribution_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `information`
--

INSERT INTO `information` (`id`, `email`, `age`, `gender`, `staff_id`, `contribution_id`) VALUES
(2, 'alice@mail.com', 25, 'женский', 2, 2),
(3, 'ivanov@mail.com', 40, 'мужской', 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--
-- Создание: Ноя 19 2017 г., 12:07
-- Последнее обновление: Ноя 19 2017 г., 15:06
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `information_id` int(10) UNSIGNED DEFAULT NULL,
  `contribution_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `name`, `surname`, `information_id`, `contribution_id`) VALUES
(2, 'Алиса', 'Иванова', 2, 2),
(3, 'Иван', 'Иванов', 3, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contribution`
--
ALTER TABLE `contribution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `information_id` (`information_id`);

--
-- Индексы таблицы `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `contribution_id` (`contribution_id`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `information_id` (`information_id`),
  ADD KEY `contribution_id` (`contribution_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contribution`
--
ALTER TABLE `contribution`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `information`
--
ALTER TABLE `information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `contribution`
--
ALTER TABLE `contribution`
  ADD CONSTRAINT `contribution_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contribution_ibfk_2` FOREIGN KEY (`information_id`) REFERENCES `information` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `information_ibfk_2` FOREIGN KEY (`contribution_id`) REFERENCES `contribution` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`information_id`) REFERENCES `information` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`contribution_id`) REFERENCES `contribution` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
