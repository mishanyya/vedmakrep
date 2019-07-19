-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 13 2016 г., 10:03
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ved_mak`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admregi`
--

CREATE TABLE IF NOT EXISTS `admregi` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер',
  `login` varchar(255) NOT NULL COMMENT 'логин',
  `parol` varchar(255) NOT NULL COMMENT 'пароль',
  `vrepar` varchar(255) NOT NULL COMMENT 'врем. пароль',
  PRIMARY KEY (`nomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='вход для администратора' AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Структура таблицы `admregi_to`
--

CREATE TABLE IF NOT EXISTS `admregi_to` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер',
  `login` varchar(255) NOT NULL COMMENT 'логин',
  `email` varchar(255) NOT NULL COMMENT 'емэйл',
  `h1` text NOT NULL COMMENT 'имя',
  `h2` text NOT NULL COMMENT 'профессия',
  `koordinaty` text NOT NULL COMMENT 'координаты',
  `data` datetime NOT NULL COMMENT 'дата',
  `ip` varchar(255) NOT NULL COMMENT 'ip',
  `biografia` text NOT NULL COMMENT 'биография',
  `rod_zanyatiy` text NOT NULL COMMENT 'род занятий',
  `foto` varchar(255) NOT NULL COMMENT 'фото ',
  `title` varchar(255) NOT NULL COMMENT 'title',
  PRIMARY KEY (`nomer`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='админ 2' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Структура таблицы `fotog`
--

CREATE TABLE IF NOT EXISTS `fotog` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер',
  `login` varchar(255) NOT NULL COMMENT 'логин',
  `foto` varchar(255) NOT NULL COMMENT 'фото',
  PRIMARY KEY (`nomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='для фотографий' AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Структура таблицы `otzyvy`
--

CREATE TABLE IF NOT EXISTS `otzyvy` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер',
  `otkogo` varchar(255) NOT NULL COMMENT 'от кого',
  `otzyv` text NOT NULL COMMENT 'текст',
  `data` date NOT NULL COMMENT 'число',
  PRIMARY KEY (`nomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `regi`
--

CREATE TABLE IF NOT EXISTS `regi` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер',
  `login` varchar(255) NOT NULL COMMENT 'логин',
  `parol` varchar(255) NOT NULL COMMENT 'пароль',
  `name` varchar(255) NOT NULL COMMENT 'имя',
  `vrepar` varchar(255) NOT NULL COMMENT 'врем.пароль',
  `ip` varchar(255) NOT NULL COMMENT 'ip пользоваттеля',
  `data` datetime NOT NULL COMMENT 'дата и время регистрации',
  PRIMARY KEY (`nomer`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='данные пользователя' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Структура таблицы `soobsh`
--

CREATE TABLE IF NOT EXISTS `soobsh` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер',
  `login` varchar(255) NOT NULL COMMENT 'логин',
  `sms` text NOT NULL COMMENT 'текст сообщения',
  `data` datetime NOT NULL COMMENT 'дата и время сообщения',
  `proch` varchar(7) NOT NULL COMMENT '0-не прочитано, 1-прочитано',
  `komu` varchar(255) NOT NULL COMMENT 'кому',
  PRIMARY KEY (`nomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='сообщения и общение' AUTO_INCREMENT=63 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
