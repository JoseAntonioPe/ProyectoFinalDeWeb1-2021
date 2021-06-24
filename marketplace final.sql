-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2021 at 12:18 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `aumentarVistas` (IN `aidanuncio` INT(10) UNSIGNED)  NO SQL
UPDATE anuncio
SET anuncio.vistas = anuncio.vistas + 1
WHERE anuncio.id_anuncio = aidanuncio$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearAnuncio` (IN `aidusuario` INT(10) UNSIGNED, IN `aidcategoria` INT(10) UNSIGNED, IN `atitulo` TEXT, IN `adescripcion` TEXT, IN `aprecio` INT(5) UNSIGNED, IN `afotografia` MEDIUMBLOB, IN `avistas` INT(5) UNSIGNED, IN `ahabilitado` VARCHAR(150))  NO SQL
INSERT INTO anuncio (id_usuario, id_categoria, titulo, descripcion, precio, fotografia, fecha, vistas, habilitado) VALUES (aidusuario, aidcategoria, atitulo, adescripcion, aprecio, afotografia, CURRENT_TIMESTAMP(), avistas, ahabilitado)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarAnuncio` (IN `aidanuncio` INT(5) UNSIGNED)  NO SQL
DELETE FROM anuncio WHERE aidanuncio=id_anuncio$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaAnuncios` ()  NO SQL
SELECT `anuncio`.`id_anuncio`, `usuario`.`id_usuario`, `usuario`.`nombres`, `usuario`.`apellidos`, `categoria`.`id_categoria`, `categoria`.`cat_titulo`, `anuncio`.`titulo`, `anuncio`.`descripcion`, `anuncio`.`precio`, `anuncio`.`fotografia`, `anuncio`.`fecha`, `anuncio`.`vistas`, `anuncio`.`habilitado`, `usuario`.`telefono`
FROM `anuncio` 
	LEFT JOIN `usuario` ON `anuncio`.`id_usuario` = `usuario`.`id_usuario` 
	LEFT JOIN `categoria` ON `anuncio`.`id_categoria` = `categoria`.`id_categoria`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaAnunciosPorCategoria` (IN `aidcategoria` INT(10))  SELECT `anuncio`.`id_anuncio`, `usuario`.`id_usuario`, `usuario`.`nombres`, `usuario`.`apellidos`, `categoria`.`id_categoria`, `categoria`.`cat_titulo`, `anuncio`.`titulo`, `anuncio`.`descripcion`, `anuncio`.`precio`, `anuncio`.`fotografia`, `anuncio`.`fecha`, `anuncio`.`vistas`, `anuncio`.`habilitado`, `usuario`.`telefono`
FROM `anuncio` 
	LEFT JOIN `usuario` ON `anuncio`.`id_usuario` = `usuario`.`id_usuario` 
	LEFT JOIN `categoria` ON `anuncio`.`id_categoria` = `categoria`.`id_categoria`
WHERE anuncio.id_categoria = aidcategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaAnunciosPorTitulo` (IN `atitulo` TEXT)  SELECT `anuncio`.`id_anuncio`, `usuario`.`id_usuario`, `usuario`.`nombres`, `usuario`.`apellidos`, `categoria`.`id_categoria`, `categoria`.`cat_titulo`, `anuncio`.`titulo`, `anuncio`.`descripcion`, `anuncio`.`precio`, `anuncio`.`fotografia`, `anuncio`.`fecha`, `anuncio`.`vistas`, `anuncio`.`habilitado`, `usuario`.`telefono`
FROM `anuncio` 
	LEFT JOIN `usuario` ON `anuncio`.`id_usuario` = `usuario`.`id_usuario` 
	LEFT JOIN `categoria` ON `anuncio`.`id_categoria` = `categoria`.`id_categoria` WHERE anuncio.titulo LIKE CONCAT('%',atitulo,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaCategorias` ()  SELECT *
FROM categoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAnuncio` (IN `aidanuncio` INT(10) UNSIGNED, IN `aidusuario` INT(10) UNSIGNED, IN `aidcategoria` INT(10) UNSIGNED, IN `atitulo` TEXT, IN `adescripcion` TEXT, IN `aprecio` INT UNSIGNED, IN `ahabilitado` VARCHAR(150))  NO SQL
UPDATE anuncio SET id_categoria = aidcategoria, titulo = atitulo, descripcion = adescripcion, precio = aprecio, habilitado = ahabilitado WHERE id_anuncio = aidanuncio AND id_usuario = aidusuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAnuncioFotografia` (IN `aidanuncio` INT(10), IN `aidusuario` INT(10), IN `afotografia` MEDIUMBLOB)  UPDATE anuncio
SET anuncio.fotografia = afotografia
WHERE anuncio.id_anuncio = aidanuncio AND anuncio.id_usuario = aidusuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerAnuncio` (IN `aidanuncio` INT UNSIGNED)  NO SQL
SELECT `anuncio`.`id_anuncio`, `usuario`.`id_usuario`, `usuario`.`nombres`, `usuario`.`apellidos`, `categoria`.`id_categoria`, `categoria`.`cat_titulo`, `anuncio`.`titulo`, `anuncio`.`descripcion`, `anuncio`.`precio`, `anuncio`.`fotografia`, `anuncio`.`fecha`, `anuncio`.`vistas`, `anuncio`.`habilitado`, `usuario`.`telefono`
FROM `anuncio`
	LEFT JOIN `usuario` ON `anuncio`.`id_usuario` = `usuario`.`id_usuario` 
	LEFT JOIN `categoria` ON `anuncio`.`id_categoria` = `categoria`.`id_categoria` WHERE anuncio.id_anuncio = aidanuncio$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerAnunciosNuevos` ()  NO SQL
SELECT * 
FROM anuncio
WHERE DATE(fecha) = CURRENT_DATE()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerMasVistosAutos` ()  NO SQL
SELECT `anuncio`.`id_anuncio`, `usuario`.`nombres`, `usuario`.`apellidos`, `categoria`.`cat_titulo`, `anuncio`.`titulo`, `anuncio`.`descripcion`, `anuncio`.`precio`, `anuncio`.`fotografia`, `anuncio`.`fecha`, `anuncio`.`vistas`, `anuncio`.`habilitado`, `usuario`.`telefono` 
FROM `anuncio` 
	LEFT JOIN `usuario` ON `anuncio`.`id_usuario` = `usuario`.`id_usuario` 
	LEFT JOIN `categoria` ON `anuncio`.`id_categoria` = `categoria`.`id_categoria`
 WHERE categoria.id_categoria = 6   
    ORDER BY anuncio.vistas DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerMasVistosCasas` ()  NO SQL
SELECT `anuncio`.`id_anuncio`, `usuario`.`nombres`, `usuario`.`apellidos`, `categoria`.`cat_titulo`, `anuncio`.`titulo`, `anuncio`.`descripcion`, `anuncio`.`precio`, `anuncio`.`fotografia`, `anuncio`.`fecha`, `anuncio`.`vistas`, `anuncio`.`habilitado`, `usuario`.`telefono`
FROM `anuncio` 
	LEFT JOIN `usuario` ON `anuncio`.`id_usuario` = `usuario`.`id_usuario` 
	LEFT JOIN `categoria` ON `anuncio`.`id_categoria` = `categoria`.`id_categoria`
 WHERE categoria.id_categoria = 5   
    ORDER BY anuncio.vistas DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerMisAnuncios` (IN `aidusuario` INT)  SELECT `anuncio`.`id_anuncio`, `usuario`.`id_usuario`, `usuario`.`nombres`, `usuario`.`apellidos`, `categoria`.`id_categoria`, `categoria`.`cat_titulo`, `anuncio`.`titulo`, `anuncio`.`descripcion`, `anuncio`.`precio`, `anuncio`.`fotografia`, `anuncio`.`fecha`, `anuncio`.`vistas`, `anuncio`.`habilitado`, `usuario`.`telefono`
FROM `anuncio` 
	LEFT JOIN `usuario` ON `anuncio`.`id_usuario` = `usuario`.`id_usuario` 
	LEFT JOIN `categoria` ON `anuncio`.`id_categoria` = `categoria`.`id_categoria`WHERE anuncio.id_usuario = aidusuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarUsuario` (IN `anombres` VARCHAR(150), IN `aapellidos` VARCHAR(150), IN `aemail` VARCHAR(150), IN `apassword` VARCHAR(150), IN `atelefono` INT(10))  NO SQL
INSERT INTO usuario (nombres, apellidos, email, password, telefono) VALUES (anombres, aapellidos, aemail, apassword, atelefono)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anuncio`
--

CREATE TABLE `anuncio` (
  `id_anuncio` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `titulo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(10) NOT NULL,
  `fotografia` mediumblob DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vistas` int(10) NOT NULL,
  `habilitado` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(10) NOT NULL,
  `cat_titulo` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `cat_titulo`) VALUES
(1, 'Cocina'),
(2, 'Electrónicos'),
(3, 'Entretenimiento'),
(4, 'Indumentaria'),
(5, 'Inmuebles'),
(6, 'Vehiculos');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `nombres` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres`, `apellidos`, `email`, `password`, `telefono`) VALUES
(5, 'Juan', 'Perez', 'jperez@gmail.com', 'MTIzNDU2', 75669988),
(6, 'Jose', 'Gutierrez', 'jgutierrez@gmail.com', 'MTIzNDU2', 70015659);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`id_anuncio`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_categoria_2` (`id_categoria`),
  ADD KEY `id_usuario_2` (`id_usuario`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_categoria_2` (`id_categoria`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `id_anuncio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncio_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
