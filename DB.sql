-- phpMyAdmin SQL Dump
-- version 10.4.20-MariaDB
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021-11-04 16:27:00
-- サーバのバージョン： Apache/2.4.48
-- PHP のバージョン: PHP 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `word`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--
CREATE TABLE admin (
  id int AUTO_INCREMENT NOT NULL,
  name varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  created datetime NULL DEFAULT NULL,
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- テーブルのデータのダンプ `admin`
--

INSERT INTO admin (id, name, password) VALUES
(1, 'admin','pass');
-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--
CREATE TABLE users (
  id int AUTO_INCREMENT NOT NULL,
  name varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  created datetime NULL DEFAULT NULL,
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- テーブルの構造 `shugoData`
--

CREATE TABLE shugoData (
  id int AUTO_INCREMENT NOT NULL,
  user_id int NOT NULL,
  text varchar(255) NOT NULL,
  created datetime NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `shugoData`
--

INSERT INTO shugoData (user_id, text) VALUES
(1,'私は');
-- --------------------------------------------------------


--
-- テーブルの構造 `jutugoData`
--

CREATE TABLE jutugoData (
  id int AUTO_INCREMENT NOT NULL,
  user_id int NOT NULL,
  text varchar(255) NOT NULL,
  created datetime NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `jutugoData`
--

INSERT INTO jutugoData (user_id, text) VALUES
(1,'楽しい');
-- --------------------------------------------------------


