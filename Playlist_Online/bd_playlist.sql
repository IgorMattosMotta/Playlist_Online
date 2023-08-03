-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 21-Dez-2020 às 19:07
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_playlist`
--
CREATE DATABASE IF NOT EXISTS `bd_playlist` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `bd_playlist`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_musicas`
--

DROP TABLE IF EXISTS `tb_musicas`;
CREATE TABLE IF NOT EXISTS `tb_musicas` (
  `codigo_musica` int(11) NOT NULL,
  `nome_musica` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `compositor` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `resenha` varchar(80) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`codigo_musica`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `tb_musicas`
--

INSERT INTO `tb_musicas` (`codigo_musica`, `nome_musica`, `compositor`, `link`, `resenha`) VALUES
(1, 'Malvadão 2', 'Xamã', 'https://www.youtube.com/watch?v=h3_6p7I_UVM&ab_channel=BewrenSouzaBewrenSouza', 
'Música tranquila! ');
COMMIT;

































CREATE TABLE IF NOT EXISTS `tb_generos` (
  `codigo_genero` int(11) NOT NULL,
  `nome_genero` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `ritmo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `exemplo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `caracteristicas` varchar(80) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`codigo_genero`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `tb_generos`
--

INSERT INTO `tb_generos` (`codigo_genero`, `nome_genero`, `ritmo`, `exemplo`, `caracteristicas`) VALUES
(2, 'Trap', 'Lento', 'Kenny G', 
'O genero apresenta batidas fortes, porém mais tranquilo que generos como o Funk');
COMMIT;