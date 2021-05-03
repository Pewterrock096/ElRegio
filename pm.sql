-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2019 a las 01:12:00
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
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`) VALUES
(1, 'Local'),
(2, 'Seguridad'),
(3, 'Nacional'),
(4, 'CDMX'),
(5, 'Estados'),
(6, 'Negocios'),
(7, 'Internacional'),
(8, 'Deportes'),
(9, 'Gente'),
(10, 'Vida'),
(11, 'Ciencia'),
(12, 'Automotriz'),
(13, 'Viajes'),
(14, 'Opinion'),
(15, 'Reporte Ciudadano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `calificación` int(11) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `usuario`, `nota`, `comentario`, `calificación`, `fecha`) VALUES
(2, 26, 38, 'asd', 0, '2019-11-20 00:09:26'),
(3, 26, 38, 'prueeeba', 0, '2019-11-20 00:09:54'),
(4, 25, 42, 'asd', 0, '2019-11-20 18:10:08');

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
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `idNota` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `autor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cuerpo` longtext NOT NULL,
  `calificación` int(11) NOT NULL DEFAULT '0',
  `visitas` bigint(11) NOT NULL DEFAULT '0',
  `Reporte` int(11) NOT NULL DEFAULT '0',
  `img` varchar(20) NOT NULL DEFAULT 'jpg',
  `vid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idNota`, `titulo`, `autor`, `categoria`, `fecha`, `cuerpo`, `calificación`, `visitas`, `Reporte`, `img`, `vid`) VALUES
(1, 'asd', 1, 3, '2019-11-08 00:00:00', 'asdadas', 3, 6, 0, '', ''),
(2, 'Se ampara Coello Trejo contra posible captura', 3, 4, '2019-11-09 00:37:35', 'Cd. de México, México (08 noviembre 2019).- Javier Coello Trejo, abogado de Emilio Lozoya, presentó ante un juez federal una demanda de amparo contra cualquier posible orden de aprehensión que pudiera haber sido librada en su contra.', 2, 9, 0, '', ''),
(3, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 1, '', ''),
(4, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', -1, 35, 1, '', ''),
(5, 'asd', 1, 3, '2019-11-08 00:00:00', 'asdadas', 3, 6, 0, '', ''),
(6, 'Se ampara Coello Trejo contra posible captura', 3, 4, '2019-11-09 00:37:35', 'Cd. de México, México (08 noviembre 2019).- Javier Coello Trejo, abogado de Emilio Lozoya, presentó ante un juez federal una demanda de amparo contra cualquier posible orden de aprehensión que pudiera haber sido librada en su contra.', 2, 9, 0, '', ''),
(7, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 1, '', ''),
(8, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 3, 1, '', ''),
(9, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 1, '', ''),
(10, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 0, 0, '', ''),
(11, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(12, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 4, 0, '', ''),
(13, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(14, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 0, 0, '', ''),
(15, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(16, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 1, 0, '', ''),
(17, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(18, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 0, 0, '', ''),
(19, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(20, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 1, 0, '', ''),
(21, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(22, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 0, 0, '', ''),
(23, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(24, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 1, 0, '', ''),
(25, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(26, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 0, 0, '', ''),
(27, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(28, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 1, 0, '', ''),
(29, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(30, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 0, 0, '', ''),
(31, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(32, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 1, 0, '', ''),
(33, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(34, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 0, 0, '', ''),
(35, 'Capturan a ladrón tras reportes en chat', 3, 1, '2019-11-09 09:00:49', 'Monterrey, México (09 noviembre 2019).- Reportes por medio de un grupo de WhatsApp sobre el robo de un celular a una residente de la Colonia Roma, en el sur de Monterrey, provocó la detención inmediata del presunto ladrón.\r\n\r\nInocente C., de 27 años, fue detenido por el grupo de policías la Guardia Auxiliar de Monterrey antes que intentara escapar con el teléfono en su poder.', 0, 0, 0, '', ''),
(36, 'Dan golpe en banco; se llevan $30 mil', 3, 1, '2019-11-09 09:01:39', 'Monterrey, México (09 noviembre 2019).- Una banda de tres ladrones armados que sólo querían billetes de 500 pesos asaltaron ayer un Banco Santander, de donde se apoderaron de 30 mil pesos, en San Nicolás.\r\n\r\nDe acuerdo a las investigaciones, los delincuentes presuntamente pueden ser vecinos de la Fomerrey 34.', 0, 1, 0, '', ''),
(37, 'test', 26, 1, '2019-11-19 23:30:32', 'test', 0, 1, 1, 'jpg', NULL),
(38, 'test', 26, 1, '2019-11-19 23:31:27', 'test', 0, 7, 1, 'jpg', NULL),
(39, 'test', 26, 1, '2019-11-19 23:32:33', 'test', 0, 0, 1, 'jpg', NULL),
(40, 'test3', 26, 5, '2019-11-19 23:35:38', 'test3', 1, 17, 1, 'jpg', NULL),
(41, 'lkll', 25, 10, '2019-11-20 17:31:58', 'jnkj', 0, 2, 1, 'jpg', NULL),
(42, 'lkll', 25, 10, '2019-11-20 17:33:26', 'jnkj', 0, 2, 1, 'jpg', NULL),
(43, 'lkll', 25, 10, '2019-11-20 17:38:06', 'jnkj', 0, 1, 1, 'jpg', NULL),
(44, 'lkll', 25, 10, '2019-11-20 17:38:41', 'jnkj', 0, 0, 1, 'jpg', NULL);

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
-- Estructura de tabla para la tabla `subscripciones`
--

CREATE TABLE `subscripciones` (
  `idSubscripcion` int(11) NOT NULL,
  `subscriptor` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subscripciones`
--

INSERT INTO `subscripciones` (`idSubscripcion`, `subscriptor`, `usuario`) VALUES
(3, 3, 3),
(6, 25, 3),
(7, 25, 25);

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
  `contra` varchar(50) NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT '0',
  `tipo` int(11) NOT NULL,
  `ext` varchar(20) NOT NULL DEFAULT 'jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `correo`, `contra`, `puntos`, `tipo`, `ext`) VALUES
(1, 'nombre', 'apellido', 'test@gmail.com', '123PorMi', 0, 0, ''),
(3, 'test', 'test2', 'test3', 'test4', 0, 2, ''),
(4, 'aa', 'bb', 'aa@bb.com', '1234', 0, 0, ''),
(5, 'aa', 'bb', 'aa@bb.com', '1234', 0, 0, ''),
(6, 'aa', 'bb', 'aa@bb.com', '1234', 0, 0, ''),
(7, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(8, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(9, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(10, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(11, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(12, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(13, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(14, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(15, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(16, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(17, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(18, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(19, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(20, 'aa', 'vv', 'correito1', '1234', 0, 2, 'jpg'),
(21, 'vgf', 'fgd', '444', '444', 0, 2, 'jpg'),
(22, 'vgf', 'fgd', '444', '444', 0, 2, 'jpg'),
(23, 'vgf', 'fgd', '444', '444', 0, 2, 'jpg'),
(24, 'sd', 'fd', '123', '456', 0, 2, 'jpg'),
(25, 'gg', 'ff', '555', '444', 0, 2, 'jpg'),
(26, 'ff', 'dd', 'cc', 'cc', 0, 2, 'jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`);

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
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idNota`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `subscripciones`
--
ALTER TABLE `subscripciones`
  ADD PRIMARY KEY (`idSubscripcion`);

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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `idNota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `subscripciones`
--
ALTER TABLE `subscripciones`
  MODIFY `idSubscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
