-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 04 juil. 2022 à 11:25
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `diagram_v3`
--

-- --------------------------------------------------------

--
-- Structure de la table `dmg_content`
--
DROP TABLE IF EXISTS `dmg_content`;

CREATE TABLE IF NOT EXISTS `dmg_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domain_id` bigint(20) DEFAULT 0,
  `type_id` bigint(20) DEFAULT 0,
  `label` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `comp_image` text DEFAULT NULL,
  `comp_description` text DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `dmg_content`;

ALTER TABLE `dmg_content`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

--
-- Structure de la table `dmg_content_type`
--
DROP TABLE IF EXISTS `dmg_content_type`;

CREATE TABLE `dmg_content_type` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `label` varchar(100) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `code` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `dmg_content_type`;

INSERT INTO `dmg_content_type` (`id`, `code`, `label`) VALUES
(1, 'NOTICE', 'Contenu de la notice pour un slide'),
(2, 'QUESTION', 'Contenu de la question pour un nœud'),
(3, 'VARIABLE', 'Contenu de la zone variable pour un slide'),
(4, 'RESULT', 'Contenu de la zone result pour un slide');

COMMIT;

--
-- Structure de la table `dmg_slide`
--
DROP TABLE IF EXISTS `dmg_slide`;

CREATE TABLE IF NOT EXISTS `dmg_slide` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `type_id` bigint(20) DEFAULT 1,
  `reference` int(11) DEFAULT 0,
  `label` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `sequence` decimal(5,2) DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `image_display` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `notice_id` bigint(20) DEFAULT 0,
  `process_id` bigint(20) DEFAULT 0,
  `variable_contentid` bigint(20) DEFAULT 0,
  `result_contentid` bigint(20) DEFAULT 0,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `dmg_slide`;

ALTER TABLE `dmg_slide`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

--
-- Structure de la table `dmg_slide_result`
--
DROP TABLE IF EXISTS `dmg_slide_result`;

CREATE TABLE IF NOT EXISTS `dmg_slide_result` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) DEFAULT 0,
  `slide_id` bigint(20) DEFAULT 0,
  `field_id` bigint(20) DEFAULT 0,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `dmg_slide_result`;

ALTER TABLE `dmg_slide_result`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

--
-- Structure de la table `dmg_slide_type`
--
DROP TABLE IF EXISTS `dmg_slide_type`;

CREATE TABLE IF NOT EXISTS `dmg_slide_type` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `label` varchar(100) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `code` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `dmg_slide_type`;

INSERT INTO `dmg_slide_type` (`id`, `code`, `label`) VALUES
(1, 'STANDARD', '#standard'),
(2, 'PROCESS', '#process');

COMMIT;

--
-- Structure de la table `dmg_slide_variable`
--
DROP TABLE IF EXISTS `dmg_slide_variable`;

CREATE TABLE IF NOT EXISTS `dmg_slide_variable` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) DEFAULT 0,
  `slide_id` bigint(20) DEFAULT 0,
  `field_id` bigint(20) DEFAULT 0,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `dmg_slide_variable`;

ALTER TABLE `dmg_slide_variable`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

--
-- Alter table `dmg_diagram`
--

ALTER TABLE `dmg_diagram` 
  ADD COLUMN IF NOT EXISTS `description` text DEFAULT NULL
;

--
-- Alter table `dmg_node`
--

ALTER TABLE `dmg_node` 
  ADD COLUMN IF NOT EXISTS `slide_id` bigint(20) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `question_id` bigint(20) DEFAULT 0
;

COMMIT;
