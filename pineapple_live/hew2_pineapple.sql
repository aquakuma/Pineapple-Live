-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-01-18 21:27:11
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hew2_pineapple`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `access_logs`
--

CREATE TABLE `access_logs` (
  `log_id` int(11) NOT NULL,
  `uri` text DEFAULT NULL,
  `ipaddress` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_pw` char(32) NOT NULL,
  `family_name` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `ban_history`
--

CREATE TABLE `ban_history` (
  `ban_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `ban_start_date` datetime NOT NULL,
  `ban_end_date` datetime NOT NULL,
  `ban_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `chat`
--

CREATE TABLE `chat` (
  `live_id` int(11) NOT NULL,
  `chat_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_content` text DEFAULT NULL,
  `chat_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `chat_report`
--

CREATE TABLE `chat_report` (
  `chat_report_id` int(11) NOT NULL,
  `live_id` int(11) NOT NULL,
  `chat_number` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `reporter_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `delete_record`
--

CREATE TABLE `delete_record` (
  `delete_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `live_report_id` int(11) NOT NULL,
  `product_report_id` int(11) NOT NULL,
  `vedio_report_id` int(11) NOT NULL,
  `chat_report_id` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite_list`
--

CREATE TABLE `favorite_list` (
  `user_id` int(11) NOT NULL,
  `favorite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `live`
--

CREATE TABLE `live` (
  `live_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `sum_live_tip` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `live_products`
--

CREATE TABLE `live_products` (
  `live_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `live_report`
--

CREATE TABLE `live_report` (
  `live_report_id` int(11) NOT NULL,
  `live_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `reporter_id` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_list`
--

CREATE TABLE `order_list` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `shipping_date` date DEFAULT NULL,
  `tracking_number` varchar(64) DEFAULT NULL,
  `delivery_days` varchar(64) DEFAULT NULL,
  `receipt_date` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `cancel_date` datetime DEFAULT NULL,
  `summary` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `ppoint_charge`
--

CREATE TABLE `ppoint_charge` (
  `user_id` int(11) NOT NULL,
  `charge` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(64) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_inventory` int(11) DEFAULT NULL,
  `product_maker` varchar(64) DEFAULT NULL,
  `image_id` varchar(255) DEFAULT NULL,
  `product_number` varchar(64) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `size` varchar(64) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `products_size`
--

CREATE TABLE `products_size` (
  `product_id` int(11) NOT NULL,
  `product_size` varchar(10) NOT NULL,
  `product_inventory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_report`
--

CREATE TABLE `product_report` (
  `product_report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reporter_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `report_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `report_category`
--

CREATE TABLE `report_category` (
  `report_id` int(11) NOT NULL,
  `report_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `tip`
--

CREATE TABLE `tip` (
  `live_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `ppoint` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_password` char(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `family_name` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `furigana_family_name` varchar(64) DEFAULT NULL,
  `furigana_first_name` varchar(64) DEFAULT NULL,
  `user_icon` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_zip` char(7) DEFAULT NULL,
  `tel` varchar(13) DEFAULT NULL,
  `ban_count` int(11) NOT NULL,
  `delete_date` datetime DEFAULT NULL,
  `ppoint` int(11) DEFAULT NULL,
  `bank` varchar(64) DEFAULT NULL,
  `bank_id` varchar(64) DEFAULT NULL,
  `bank_account` varchar(64) DEFAULT NULL,
  `card_number` char(16) DEFAULT NULL,
  `card_cvv` char(5) DEFAULT NULL,
  `card_valid` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `video_title` varbinary(64) NOT NULL,
  `views` int(11) NOT NULL,
  `upload_date` datetime NOT NULL,
  `delete_date` datetime DEFAULT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `video_report`
--

CREATE TABLE `video_report` (
  `vedio_report_id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `reporter_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- テーブルのインデックス `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- テーブルのインデックス `ban_history`
--
ALTER TABLE `ban_history`
  ADD PRIMARY KEY (`ban_id`),
  ADD UNIQUE KEY `ban_id` (`ban_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`live_id`,`chat_number`),
  ADD UNIQUE KEY `live_id` (`live_id`,`chat_number`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `chat_report`
--
ALTER TABLE `chat_report`
  ADD PRIMARY KEY (`chat_report_id`),
  ADD UNIQUE KEY `chat_report_id` (`chat_report_id`),
  ADD KEY `live_id` (`live_id`,`chat_number`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `reporter_id` (`reporter_id`);

--
-- テーブルのインデックス `delete_record`
--
ALTER TABLE `delete_record`
  ADD PRIMARY KEY (`delete_id`),
  ADD UNIQUE KEY `delete_id` (`delete_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `chat_report_id` (`chat_report_id`),
  ADD KEY `live_report_id` (`live_report_id`),
  ADD KEY `product_report_id` (`product_report_id`),
  ADD KEY `vedio_report_id` (`vedio_report_id`);

--
-- テーブルのインデックス `favorite_list`
--
ALTER TABLE `favorite_list`
  ADD PRIMARY KEY (`user_id`,`favorite_id`),
  ADD KEY `favorite_id` (`favorite_id`);

--
-- テーブルのインデックス `live`
--
ALTER TABLE `live`
  ADD PRIMARY KEY (`live_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `live_products`
--
ALTER TABLE `live_products`
  ADD PRIMARY KEY (`live_id`,`product_id`);

--
-- テーブルのインデックス `live_report`
--
ALTER TABLE `live_report`
  ADD PRIMARY KEY (`live_report_id`),
  ADD UNIQUE KEY `live_report_id` (`live_report_id`),
  ADD KEY `live_id` (`live_id`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `reporter_id` (`reporter_id`);

--
-- テーブルのインデックス `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- テーブルのインデックス `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `ppoint_charge`
--
ALTER TABLE `ppoint_charge`
  ADD PRIMARY KEY (`user_id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD UNIQUE KEY `product_id_2` (`product_id`,`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `products_size`
--
ALTER TABLE `products_size`
  ADD PRIMARY KEY (`product_id`,`product_size`);

--
-- テーブルのインデックス `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- テーブルのインデックス `product_report`
--
ALTER TABLE `product_report`
  ADD PRIMARY KEY (`product_report_id`),
  ADD UNIQUE KEY `product_report_id` (`product_report_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `reporter_id` (`reporter_id`);

--
-- テーブルのインデックス `report_category`
--
ALTER TABLE `report_category`
  ADD PRIMARY KEY (`report_id`),
  ADD UNIQUE KEY `report_id` (`report_id`);

--
-- テーブルのインデックス `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- テーブルのインデックス `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`live_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- テーブルのインデックス `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `video_report`
--
ALTER TABLE `video_report`
  ADD PRIMARY KEY (`vedio_report_id`),
  ADD UNIQUE KEY `vedio_report_id` (`vedio_report_id`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `reporter_id` (`reporter_id`),
  ADD KEY `video_id` (`video_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=880;

--
-- テーブルの AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `ban_history`
--
ALTER TABLE `ban_history`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `chat_report`
--
ALTER TABLE `chat_report`
  MODIFY `chat_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `delete_record`
--
ALTER TABLE `delete_record`
  MODIFY `delete_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `live`
--
ALTER TABLE `live`
  MODIFY `live_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `live_report`
--
ALTER TABLE `live_report`
  MODIFY `live_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `product_report`
--
ALTER TABLE `product_report`
  MODIFY `product_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `video_report`
--
ALTER TABLE `video_report`
  MODIFY `vedio_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `ban_history`
--
ALTER TABLE `ban_history`
  ADD CONSTRAINT `ban_history_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ban_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`live_id`) REFERENCES `live` (`live_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `chat_report`
--
ALTER TABLE `chat_report`
  ADD CONSTRAINT `chat_report_ibfk_1` FOREIGN KEY (`live_id`,`chat_number`) REFERENCES `chat` (`live_id`, `chat_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `chat_report_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report_category` (`report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `chat_report_ibfk_3` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `delete_record`
--
ALTER TABLE `delete_record`
  ADD CONSTRAINT `delete_record_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `delete_record_ibfk_2` FOREIGN KEY (`chat_report_id`) REFERENCES `chat_report` (`chat_report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `delete_record_ibfk_3` FOREIGN KEY (`live_report_id`) REFERENCES `live_report` (`live_report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `delete_record_ibfk_4` FOREIGN KEY (`product_report_id`) REFERENCES `product_report` (`product_report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `delete_record_ibfk_5` FOREIGN KEY (`vedio_report_id`) REFERENCES `video_report` (`vedio_report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `favorite_list`
--
ALTER TABLE `favorite_list`
  ADD CONSTRAINT `favorite_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `favorite_list_ibfk_2` FOREIGN KEY (`favorite_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `live`
--
ALTER TABLE `live`
  ADD CONSTRAINT `live_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `live_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `live_report`
--
ALTER TABLE `live_report`
  ADD CONSTRAINT `live_report_ibfk_1` FOREIGN KEY (`live_id`) REFERENCES `live` (`live_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `live_report_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report_category` (`report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `live_report_ibfk_3` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `ppoint_charge`
--
ALTER TABLE `ppoint_charge`
  ADD CONSTRAINT `ppoint_charge_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `product_report`
--
ALTER TABLE `product_report`
  ADD CONSTRAINT `product_report_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_report_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report_category` (`report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_report_ibfk_3` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `tip`
--
ALTER TABLE `tip`
  ADD CONSTRAINT `tip_ibfk_1` FOREIGN KEY (`live_id`) REFERENCES `live` (`live_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tip_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `video_report`
--
ALTER TABLE `video_report`
  ADD CONSTRAINT `video_report_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `report_category` (`report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `video_report_ibfk_2` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `video_report_ibfk_3` FOREIGN KEY (`video_id`) REFERENCES `video` (`video_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
