-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-12-26 11:47:38
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_08_php03`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_table_kadai`
--

CREATE TABLE `todo_table_kadai` (
  `id` int(11) NOT NULL,
  `todo` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `todo_table_kadai`
--

INSERT INTO `todo_table_kadai` (`id`, `todo`, `created_at`, `updated_at`, `image`, `title`) VALUES
(9, 'チーズ工場の風景\r\nを書きました', '2024-12-26 19:37:21', '2024-12-26 19:39:30', 'uploads/factory08.jpg', 'チーズ工場'),
(10, '今日は元気な\r\n雰囲気をしております\r\nどうでしょうか？', '2024-12-26 19:40:32', '2024-12-26 19:40:32', 'uploads/factory06.jpg', '牛男'),
(11, 'チーズが正常にできた場合は\r\nこのような形で出来上がります\r\n確認をお願いします', '2024-12-26 19:46:59', '2024-12-26 19:46:59', 'uploads/delicious_cheese.jpg', 'チーズの完成');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `todo_table_kadai`
--
ALTER TABLE `todo_table_kadai`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `todo_table_kadai`
--
ALTER TABLE `todo_table_kadai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
