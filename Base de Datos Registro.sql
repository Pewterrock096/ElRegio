-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2019 a las 06:41:57
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pm`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AUTORES_Select` ()  READS SQL DATA
SELECT `idAutor`, `autor` FROM `autor`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CATEGORIAS_Select` ()  READS SQL DATA
SELECT `idCategoria`, `nombre` FROM `categorias`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CATEGORIAS_SelectById` (IN `id` INT)  READS SQL DATA
SELECT `idCategoria`, `nombre` FROM `categorias` WHERE `idCategoria` = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `COMENTARIO_Add` (IN `idusuario` INT, IN `idnota` INT, IN `comentario` TEXT, IN `fecha` VARCHAR(150))  MODIFIES SQL DATA
INSERT INTO `Comentario`(`idUsuario`, `idNota`, `comentario`, `fecha`) VALUES (idusuario,idnota,comentario,fecha)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `COMENTARIO_SelectById` (IN `id` INT)  READS SQL DATA
SELECT `idComentario`, c.`idUsuario`, `idNota`, `comentario`, `fecha`, `nombre`, `apellido` FROM `Comentario` AS c JOIN usuario AS u ON c.`idUsuario` = u.`idUsuario` WHERE `idNota` = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `IMAGEN_Add` (IN `idNota` INT, IN `cantidad` INT)  MODIFIES SQL DATA
INSERT INTO `imagen`(`idNota`, `cantidad`) VALUES (idNota, cantidad)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `IMAGEN_SelectById` (IN `id` INT)  READS SQL DATA
SELECT `idImagen`, `idNota`, `cantidad` FROM `imagen` WHERE `idNota` = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NOTA_Add` (IN `usuario` INT, IN `titulo` VARCHAR(150), IN `cuerpo` TEXT, IN `categoria` INT, IN `fecha` VARCHAR(150))  MODIFIES SQL DATA
INSERT INTO `nota`(`idUsuario`, `Titulo`, `Cuerpo`, `Categoria`, `fecha`) VALUES (usuario, titulo, cuerpo, categoria, fecha)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NOTA_SelectByCategory` (IN `cate` VARCHAR(50))  READS SQL DATA
SELECT `idNota`, n.`idUsuario`, `Titulo`, `Cuerpo`, `Categoria`, `fecha`, u.`nombre`, u.`apellido` FROM `nota` AS n JOIN `usuario` AS u ON n.`idUsuario` = u.`idUsuario` WHERE `Categoria` = cate$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NOTA_SelectById` (IN `id` INT)  READS SQL DATA
SELECT `idNota`, n.`idUsuario`, `Titulo`, `Cuerpo`, `Categoria`,`fecha`, u.`nombre`, u.`apellido`, c.`nombre` AS cat FROM `nota` AS n JOIN usuario AS u on n.`idUsuario` = u.idUsuario JOIN `categorias` AS c ON n.`Categoria` = c.`idCategoria` WHERE `idNota` = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NOTA_SelectLast` ()  READS SQL DATA
SELECT `idNota`, `idUsuario`, `Titulo`, `Cuerpo`, `Categoria`, `fecha` FROM `nota` ORDER BY `idNota` DESC LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `OPINION_Add` (IN `idAutor` INT, IN `titulo` VARCHAR(150), IN `opinion` TEXT, IN `categoria` INT, IN `fecha` VARCHAR(150))  MODIFIES SQL DATA
INSERT INTO `opinion`(`autor`,`titulo`, `opinion`, `categoria`, `fecha`) VALUES (idAutor, titulo, opinion, categoria, fecha)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `OPINION_SelectById` (IN `idAutor` INT)  READS SQL DATA
SELECT `idOpinion`, o.`autor` AS id, a.`autor` AS nombre, `titulo`, `opinion`, `categoria`, `fecha`, c.`nombre` AS cat FROM `opinion` AS o JOIN `autor` AS a ON o.`autor` = a.`idAutor` JOIN `categorias` AS c ON o.`categoria` = c.`idCategoria` WHERE o.`autor` = idAutor$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `OPINION_SelectById2` (IN `idOpinion` INT)  READS SQL DATA
SELECT `idOpinion`, o.`autor` AS id, a.`autor` AS nombre, `titulo`, `opinion`, `categoria`, `fecha`, c.`nombre` AS cat FROM `opinion` AS o JOIN `autor` AS a ON o.`autor` = a.`idAutor` JOIN `categorias` AS c ON o.`categoria` = c.`idCategoria` WHERE `idOpinion` = idOpinion$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `USUARIO_Add` (IN `nombre` VARCHAR(150), IN `apellido` VARCHAR(150), IN `correo` VARCHAR(150), IN `contra` VARCHAR(50))  MODIFIES SQL DATA
INSERT INTO `usuario`(`nombre`, `apellido`, `correo`, `contra`) VALUES (nombre, apellido, correo, contra)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `USUARIO_Login` (IN `correo` VARCHAR(150), IN `contra` VARCHAR(50))  READS SQL DATA
SELECT `idUsuario`, `nombre`, `apellido`, `correo`, `contra` FROM `usuario` WHERE `correo` = correo AND `contra` = contra$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `contra` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `correo`, `contra`) VALUES
(1, 'nombre', 'apellido', 'test@gmail.com', '123PorMi'),
(3, 'test', 'test2', 'test3', 'test4'),
(4, 'aa', 'bb', 'aa@bb.com', '1234'),
(5, 'aa', 'bb', 'aa@bb.com', '1234'),
(6, 'aa', 'bb', 'aa@bb.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
