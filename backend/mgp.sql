-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para moneygrowpro
CREATE DATABASE IF NOT EXISTS `moneygrowpro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `moneygrowpro`;

-- Volcando estructura para tabla moneygrowpro.accions
CREATE TABLE IF NOT EXISTS `accions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referenciaPago` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `plataforma` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idUsuarioFk` int(11) NOT NULL,
  `idFaseFk` int(11) NOT NULL,
  `estatus` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT 'solicitando',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.accions: ~24 rows (aproximadamente)
DELETE FROM `accions`;
/*!40000 ALTER TABLE `accions` DISABLE KEYS */;
INSERT INTO `accions` (`id`, `referenciaPago`, `plataforma`, `idUsuarioFk`, `idFaseFk`, `estatus`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(29, 'pago 1', NULL, 24, 3, 'aprobado', NULL, '2020-08-28 18:34:55', '2020-08-29 15:31:33'),
	(30, 'usuario1', NULL, 25, 2, 'aprobado', NULL, '2020-08-28 18:38:43', '2020-08-28 19:50:33'),
	(31, 'usuario2', NULL, 26, 2, 'aprobado', NULL, '2020-08-28 18:51:17', '2020-08-28 20:14:09'),
	(32, 'usuario3', NULL, 27, 2, 'aprobado', NULL, '2020-08-28 19:07:30', '2020-08-28 20:23:07'),
	(33, 'usuario4', NULL, 28, 2, 'aprobado', NULL, '2020-08-28 19:07:30', '2020-08-29 15:31:33'),
	(34, 'usuario1.1', NULL, 29, 1, 'aprobado', NULL, '2020-08-28 19:34:57', '2020-08-28 19:35:17'),
	(35, 'usuario1.2', NULL, 30, 1, 'aprobado', NULL, '2020-08-28 19:36:49', '2020-08-28 19:37:01'),
	(36, 'usuario1.3', NULL, 31, 1, 'aprobado', NULL, '2020-08-28 19:38:36', '2020-08-28 19:38:46'),
	(39, 'usuario 2.1', NULL, 33, 1, 'aprobado', NULL, '2020-08-28 19:57:28', '2020-08-28 19:58:06'),
	(40, 'usuario 2.2', NULL, 34, 1, 'aprobado', NULL, '2020-08-28 20:02:28', '2020-08-28 20:02:41'),
	(41, 'usuario 2.3', NULL, 35, 1, 'aprobado', NULL, '2020-08-28 20:04:15', '2020-08-28 20:04:29'),
	(43, 'usuario 2.4', NULL, 36, 1, 'aprobado', NULL, '2020-08-28 20:14:01', '2020-08-28 20:14:09'),
	(44, 'usuario 3.1', NULL, 37, 1, 'aprobado', NULL, '2020-08-28 20:18:16', '2020-08-28 20:18:25'),
	(45, 'usuario3.2', NULL, 38, 1, 'aprobado', NULL, '2020-08-28 20:20:33', '2020-08-28 20:20:40'),
	(46, 'usuario 3.3', NULL, 39, 1, 'aprobado', NULL, '2020-08-28 20:21:44', '2020-08-28 20:21:51'),
	(47, 'usuario3.4', NULL, 40, 1, 'aprobado', NULL, '2020-08-28 20:22:54', '2020-08-28 20:23:07'),
	(49, 'usuario 4.1', NULL, 42, 1, 'aprobado', NULL, '2020-08-28 20:29:31', '2020-08-28 20:29:39'),
	(50, 'usuario 4.2', NULL, 43, 1, 'aprobado', NULL, '2020-08-28 20:30:37', '2020-08-28 20:30:47'),
	(51, 'usuario 4.3', NULL, 44, 1, 'aprobado', NULL, '2020-08-28 20:32:21', '2020-08-28 20:32:35'),
	(64, 'usuario5.1', NULL, 46, 1, 'aprobado', NULL, '2020-08-29 01:04:14', '2020-08-29 01:04:35'),
	(153, 'culo pues', NULL, 42, 1, 'aprobado', NULL, '2020-08-29 06:45:35', '2020-08-29 15:31:33'),
	(237, 'creada por cambio de fase 2', NULL, 28, 1, 'aprobado', NULL, '2020-08-29 15:31:33', '2020-08-29 15:31:33'),
	(238, 'creada por cambio de fase 3', NULL, 24, 1, 'aprobado', NULL, '2020-08-29 15:31:33', '2020-08-29 15:31:33'),
	(239, 'tanchiviris', NULL, 47, 1, 'aprobado', NULL, '2020-08-29 16:07:45', '2020-08-29 16:15:27'),
	(240, 'tostiarepa', 'Payeer', 28, 1, 'solicitando', NULL, '2020-08-29 17:45:16', '2020-08-29 17:45:16');
/*!40000 ALTER TABLE `accions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.corporacion
CREATE TABLE IF NOT EXISTS `corporacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAccionEnvioFk` int(11) NOT NULL DEFAULT '0',
  `entrada` double(8,2) DEFAULT NULL,
  `salida` double(8,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.corporacion: ~1 rows (aproximadamente)
DELETE FROM `corporacion`;
/*!40000 ALTER TABLE `corporacion` DISABLE KEYS */;
INSERT INTO `corporacion` (`id`, `idAccionEnvioFk`, `entrada`, `salida`, `fecha`) VALUES
	(2, 33, 0.00, 0.00, '2020-08-29 11:31:33');
/*!40000 ALTER TABLE `corporacion` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.countries: ~194 rows (aproximadamente)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Afganistán', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(2, 'Albania', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(3, 'Alemania', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(4, 'Andorra', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(5, 'Angola', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(6, 'Antigua y Barbuda', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(7, 'Arabia Saudita', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(8, 'Argelia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(9, 'Argentina', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(10, 'Armenia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(11, 'Australia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(12, 'Austria', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(13, 'Azerbaiyán', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(14, 'Bahamas', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(15, 'Bangladés', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(16, 'Barbados', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(17, 'Baréin', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(18, 'Bélgica', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(19, 'Belice', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(20, 'Benín', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(21, 'Bielorrusia', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(22, 'Birmania/Myanmar', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(23, 'Bolivia', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(24, 'Bosnia y Herzegovina', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(25, 'Botsuana', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(26, 'Brasil', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(27, 'Brunéi', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(28, 'Bulgaria', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(29, 'Burkina Faso', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(30, 'Burundi', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(31, 'Bután', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(32, 'Cabo Verde', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(33, 'Camboya', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(34, 'Camerún', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(35, 'Canadá', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(36, 'Catar', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(37, 'Chad', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(38, 'Chile', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(39, 'China', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(40, 'Chipre', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(41, 'Ciudad del Vaticano', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(42, 'Colombia', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(43, 'Comoras', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(44, 'Corea del Norte', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(45, 'Corea del Sur', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(46, 'Costa de Marfil', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(47, 'Costa Rica', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(48, 'Croacia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(49, 'Cuba', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(50, 'Dinamarca', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(51, 'Dominica', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(52, 'Ecuador', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(53, 'Egipto', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(54, 'El Salvador', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(55, 'Emiratos Árabes Unidos', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(56, 'Eritrea', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(57, 'Eslovaquia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(58, 'Eslovenia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(59, 'España', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(60, 'Estados Unidos', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(61, 'Estonia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(62, 'Etiopía', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(63, 'Filipinas', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(64, 'Finlandia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(65, 'Fiyi', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(66, 'Francia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(67, 'Gabón', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(68, 'Gambia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(69, 'Georgia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(70, 'Ghana', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(71, 'Granada', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(72, 'Grecia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(73, 'Guatemala', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(74, 'Guyana', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(75, 'Guinea', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(76, 'Guinea ecuatorial', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(77, 'Guinea-Bisáu', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(78, 'Haití', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(79, 'Honduras', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(80, 'Hungría', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(81, 'India', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(82, 'Indonesia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(83, 'Irak', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(84, 'Irán', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(85, 'Irlanda', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(86, 'Islandia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(87, 'Islas Marshall', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(88, 'Islas Salomón', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(89, 'Israel', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(90, 'Italia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(91, 'Jamaica', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(92, 'Japón', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(93, 'Jordania', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(94, 'Kazajistán', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(95, 'Kenia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(96, 'Kirguistán', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(97, 'Kiribati', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(98, 'Kuwait', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(99, 'Laos', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(100, 'Lesoto', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(101, 'Letonia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(102, 'Líbano', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(103, 'Liberia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(104, 'Libia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(105, 'Liechtenstein', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(106, 'Lituania', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(107, 'Luxemburgo', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(108, 'Macedonia del Norte', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(109, 'Madagascar', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(110, 'Malasia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(111, 'Malaui', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(112, 'Maldivas', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(113, 'Malí', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(114, 'Malta', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(115, 'Marruecos', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(116, 'Mauricio', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(117, 'Mauritania', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(118, 'México', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(119, 'Micronesia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(120, 'Moldavia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(121, 'Mónaco', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(122, 'Mongolia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(123, 'Montenegro', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(124, 'Mozambique', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(125, 'Namibia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(126, 'Nauru', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(127, 'Nepal', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(128, 'Nicaragua', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(129, 'Níger', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(130, 'Nigeria', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(131, 'Noruega', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(132, 'Nueva Zelanda', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(133, 'Omán', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(134, 'Países Bajos', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(135, 'Pakistán', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(136, 'Palaos', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(137, 'Panamá', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(138, 'Papúa Nueva Guinea', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(139, 'Paraguay', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(140, 'Perú', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(141, 'Polonia', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(142, 'Portugal', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(143, 'Reino Unido', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(144, 'República Centroafricana', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(145, 'República Checa', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(146, 'República del Congo', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(147, 'República Democrática del Congo', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(148, 'República Dominicana', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(149, 'República Sudafricana', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(150, 'Ruanda', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(151, 'Rumanía', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(152, 'Rusia', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(153, 'Samoa', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(154, 'San Cristóbal y Nieves', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(155, 'San Marino', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(156, 'San Vicente y las Granadinas', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(157, 'Santa Lucía', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(158, 'Santo Tomé y Príncipe', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(159, 'Senegal', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(160, 'Serbia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(161, 'Seychelles', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(162, 'Sierra Leona', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(163, 'Singapur', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(164, 'Siria', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(165, 'Somalia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(166, 'Sri Lanka', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(167, 'Suazilandia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(168, 'Sudán', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(169, 'Sudán del Sur', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(170, 'Suecia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(171, 'Suiza', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(172, 'Surinam', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(173, 'Tailandia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(174, 'Tanzania', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(175, 'Tayikistán', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(176, 'Timor Oriental', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(177, 'Togo', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(178, 'Tonga', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(179, 'Trinidad y Tobago', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(180, 'Túnez', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(181, 'Turkmenistán', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(182, 'Turquía', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(183, 'Tuvalu', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(184, 'Ucrania', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(185, 'Uganda', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(186, 'Uruguay', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(187, 'Uzbekistán', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(188, 'Vanuatu', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(189, 'Venezuela', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(190, 'Vietnam', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(191, 'Yemen', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(192, 'Yibuti', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(193, 'Zambia', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(194, 'Zimbabue', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.fases
CREATE TABLE IF NOT EXISTS `fases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.fases: ~6 rows (aproximadamente)
DELETE FROM `fases`;
/*!40000 ALTER TABLE `fases` DISABLE KEYS */;
INSERT INTO `fases` (`id`, `nombre`) VALUES
	(1, 'bono arranque'),
	(2, 'bono impulsor'),
	(3, 'bono constructor'),
	(4, 'bono productor'),
	(5, 'bono emprendedor'),
	(6, 'bono capitalizacion'),
	(7, 'fundador 6k');
/*!40000 ALTER TABLE `fases` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.files: ~0 rows (aproximadamente)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.historico_retiro
CREATE TABLE IF NOT EXISTS `historico_retiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUserFk` int(11) NOT NULL,
  `referencia` text,
  `monto_retiro` double(8,2) NOT NULL,
  `plataforma` text NOT NULL,
  `estatus` varchar(191) NOT NULL DEFAULT 'proceso',
  `fecha` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.historico_retiro: ~0 rows (aproximadamente)
DELETE FROM `historico_retiro`;
/*!40000 ALTER TABLE `historico_retiro` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_retiro` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.intensityfitness
CREATE TABLE IF NOT EXISTS `intensityfitness` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAccionEnvioFk` int(11) NOT NULL DEFAULT '0',
  `entrada` double(8,2) DEFAULT NULL,
  `salida` double(8,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.intensityfitness: ~1 rows (aproximadamente)
DELETE FROM `intensityfitness`;
/*!40000 ALTER TABLE `intensityfitness` DISABLE KEYS */;
INSERT INTO `intensityfitness` (`id`, `idAccionEnvioFk`, `entrada`, `salida`, `fecha`) VALUES
	(2, 33, 6.00, 0.00, '2020-08-29 11:31:33');
/*!40000 ALTER TABLE `intensityfitness` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.migrations: ~15 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(6, '2016_06_01_000004_create_oauth_clients_table', 1),
	(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
	(8, '2019_05_06_182611_create_statuses_table', 1),
	(9, '2019_09_01_183948_create_payment_methods_table', 1),
	(10, '2019_09_30_150950_create_permission_tables', 1),
	(11, '2019_10_01_134421_create_notifications_table', 1),
	(12, '2019_10_01_135029_create_notification_user_table', 1),
	(13, '2019_10_01_193837_create_countries_table', 1),
	(14, '2019_10_09_163104_create_files_table', 1),
	(15, '2019_10_09_180657_create_relation_file_table', 1),
	(16, '2020_04_18_004136_create_accions_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.model_has_permissions: ~0 rows (aproximadamente)
DELETE FROM `model_has_permissions`;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.model_has_roles: ~38 rows (aproximadamente)
DELETE FROM `model_has_roles`;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 2),
	(1, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 5),
	(2, 'App\\Models\\User', 7),
	(2, 'App\\Models\\User', 8),
	(2, 'App\\Models\\User', 12),
	(2, 'App\\Models\\User', 13),
	(2, 'App\\Models\\User', 14),
	(2, 'App\\Models\\User', 15),
	(2, 'App\\Models\\User', 16),
	(2, 'App\\Models\\User', 17),
	(2, 'App\\Models\\User', 18),
	(2, 'App\\Models\\User', 19),
	(2, 'App\\Models\\User', 20),
	(2, 'App\\Models\\User', 21),
	(2, 'App\\Models\\User', 22),
	(2, 'App\\Models\\User', 23),
	(2, 'App\\Models\\User', 24),
	(2, 'App\\Models\\User', 25),
	(2, 'App\\Models\\User', 26),
	(2, 'App\\Models\\User', 27),
	(2, 'App\\Models\\User', 28),
	(2, 'App\\Models\\User', 29),
	(2, 'App\\Models\\User', 30),
	(2, 'App\\Models\\User', 31),
	(2, 'App\\Models\\User', 32),
	(2, 'App\\Models\\User', 33),
	(2, 'App\\Models\\User', 34),
	(2, 'App\\Models\\User', 35),
	(2, 'App\\Models\\User', 36),
	(2, 'App\\Models\\User', 37),
	(2, 'App\\Models\\User', 38),
	(2, 'App\\Models\\User', 39),
	(2, 'App\\Models\\User', 40),
	(2, 'App\\Models\\User', 41),
	(2, 'App\\Models\\User', 42),
	(2, 'App\\Models\\User', 43),
	(2, 'App\\Models\\User', 44),
	(2, 'App\\Models\\User', 45),
	(2, 'App\\Models\\User', 46),
	(2, 'App\\Models\\User', 47);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.notifications: ~0 rows (aproximadamente)
DELETE FROM `notifications`;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.notification_user
CREATE TABLE IF NOT EXISTS `notification_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notification_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `viewed_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_user_notification_id_foreign` (`notification_id`),
  KEY `notification_user_user_id_foreign` (`user_id`),
  CONSTRAINT `notification_user_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`),
  CONSTRAINT `notification_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.notification_user: ~0 rows (aproximadamente)
DELETE FROM `notification_user`;
/*!40000 ALTER TABLE `notification_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_user` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_access_tokens: ~60 rows (aproximadamente)
DELETE FROM `oauth_access_tokens`;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('012d2c442cd7a20719b7d0d9c3ecb68ba6696279fc398662d64c282ff4dc65be12cf2335232a9ec8', 16, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:44:31', '2020-08-28 00:44:31', '2021-08-28 00:44:31'),
	('02ececa4b589111cf7bfaefa37a22797b505ed01be8b75e9cb75a5a266870e8668a8a0bc2315646b', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:37:48', '2020-04-18 00:37:48', '2021-04-18 00:37:48'),
	('03b4faf505eaee1f56e076c0a49adbb755e4c045996bf7e8e33568afcc3da214c639d118303f1a20', 41, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:25:35', '2020-08-28 20:25:35', '2021-08-28 20:25:35'),
	('077b1ef2a84f2947efca694cefc3611d5c0c503a9905d73375b9b5fb345ad3c26e3f2898ce4cb2f3', 7, 1, 'Personal Access Token', '[]', 0, '2020-08-27 23:36:15', '2020-08-27 23:36:15', '2021-08-27 23:36:15'),
	('0f364305bb9e431e9ecf4cec0522c49ca65b871c0944e3f268c6e66d47d1886ee38b9f1a455b74cb', 7, 1, 'Personal Access Token', '[]', 0, '2020-08-27 17:20:54', '2020-08-27 17:20:54', '2021-08-27 17:20:54'),
	('1953175656444b2191a11a252cbc30e089f872bd2b914ae8d66350b4c289c043a19bb18e9b91966b', 3, 1, 'Personal Access Token', '[]', 0, '2020-08-29 18:13:45', '2020-08-29 18:13:45', '2021-08-29 18:13:45'),
	('1ed982e3ffa980b5207530942054bffa1ae2b3577033c1d4cf29e8cabdb26c12b9657d24a4cc26b9', 46, 1, 'Personal Access Token', '[]', 0, '2020-08-29 01:03:54', '2020-08-29 01:03:54', '2021-08-29 01:03:54'),
	('279fbcc852d7f9ccab099f9e420120bcef2c04641d3f6f296bfdd7f159e8b5d52b814b0b9d0035c6', 44, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:31:59', '2020-08-28 20:31:59', '2021-08-28 20:31:59'),
	('27c759edb348e0564be415c4a6b590cd10d4cab664dbf8ce2f9bce4daa793d5ddc19ca7c77af0571', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 03:10:46', '2020-04-18 03:10:46', '2021-04-18 03:10:46'),
	('2a6d51336be1985530d654aab88361ad8ddb05c0c52523fad820112330d083f728b056df29b2eda5', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-20 14:41:29', '2020-04-20 14:41:29', '2021-04-20 14:41:29'),
	('350ff182665956219e864bdcccb8bcff56a46e5573df51e88f1d731f65fa067481ec288989328a1b', 23, 1, 'Personal Access Token', '[]', 0, '2020-08-28 16:02:22', '2020-08-28 16:02:22', '2021-08-28 16:02:22'),
	('3af326fed08f04fffe522de1994cad5ee41fe35f975b996e8197f591877fd291d6f37477c27a4497', 25, 1, 'Personal Access Token', '[]', 0, '2020-08-28 18:38:18', '2020-08-28 18:38:18', '2021-08-28 18:38:18'),
	('3c2e4d745db0ed0a06b234e1fe77db470608c50b8d09c674b6dc04e79573c17d47d21b4299b87b80', 28, 1, 'Personal Access Token', '[]', 0, '2020-08-29 01:15:54', '2020-08-29 01:15:54', '2021-08-29 01:15:54'),
	('3df0c0cf44e4dfa76a2deb188441a5bb8cc635324499b78ca698daa089c409f06e9e62b846657629', 43, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:30:24', '2020-08-28 20:30:24', '2021-08-28 20:30:24'),
	('40284091cb1e333a901fc0c6617d3afc1f4cfe1baad951fcd635ffab1eae5e03844eae634989cdd9', 14, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:41:26', '2020-08-28 00:41:26', '2021-08-28 00:41:26'),
	('447f3c8ee5b1a76639dc0bd55a44eec4a78bd422b28f5f5e04ca67e85263e569b569e3db74d2e599', 28, 1, 'Personal Access Token', '[]', 0, '2020-08-28 19:21:14', '2020-08-28 19:21:14', '2021-08-28 19:21:14'),
	('460f617e7fa9d9c13a2148347372edce635429a4d0cd6610a0e5f3df64ec8061f9927a45813b1927', 36, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:08:49', '2020-08-28 20:08:49', '2021-08-28 20:08:49'),
	('4832d553d14c674df48cf31ba5073850ca96b14b4fd2cdcde652b3fbb7b8415f4a02fa12f11e8859', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-20 14:33:38', '2020-04-20 14:33:38', '2021-04-20 14:33:38'),
	('4aeae8857198e33cc4014fa1d27945e69fc3e2dbddb261e0a720a0f15211b6aa381a240cf0a6a2e9', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:35:28', '2020-04-18 00:35:28', '2021-04-18 00:35:28'),
	('4cf88aff32965d96d5cb2cc6a4ec7e6fb60b19fa82acd86da8c703a96ba97ccb77226c9d1da69829', 2, 1, 'Personal Access Token', '[]', 0, '2020-04-17 23:40:16', '2020-04-17 23:40:16', '2021-04-17 23:40:16'),
	('4d28117353e9ddec769c9c1646fb592eb39e5918ec7006d929c10731a9e598318db8b45c9ca58b09', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-17 23:41:41', '2020-04-17 23:41:41', '2021-04-17 23:41:41'),
	('4f376dcb08bbf14369185769212ef6b49b65547ace11041b8546a942256ed291c04a6565391081aa', 12, 1, 'Personal Access Token', '[]', 0, '2020-08-27 23:44:01', '2020-08-27 23:44:01', '2021-08-27 23:44:01'),
	('52c20832d9a0b36a55accb227c136dc734e45d9ba1d2b0cb9e10373723691c7f2496dd82f9aff25f', 18, 1, 'Personal Access Token', '[]', 0, '2020-08-28 01:03:20', '2020-08-28 01:03:20', '2021-08-28 01:03:20'),
	('57c17d5db3187a630275756202fcc6b2702cfc4a98cbbeeac800e3aa75186f753f4c5be823c087c5', 42, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:29:14', '2020-08-28 20:29:14', '2021-08-28 20:29:14'),
	('5a0cc138535a1e4db3a0165b1f143c6909a5f547b4731c79043b2457ed8ec4ecc61c6789601a4448', 31, 1, 'Personal Access Token', '[]', 0, '2020-08-28 19:37:50', '2020-08-28 19:37:50', '2021-08-28 19:37:50'),
	('5b36820c9783aa165dcb4fe32055b83c24089c24bb899cfabe173205448ddd21caa3cc9958ef788f', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 05:56:49', '2020-04-18 05:56:49', '2021-04-18 05:56:49'),
	('601734df806aa9a2560d2756586878b8d294270e61c3a8155b7b79b178ca5cfefae17c74b2dda11c', 21, 1, 'Personal Access Token', '[]', 0, '2020-08-28 01:30:02', '2020-08-28 01:30:02', '2021-08-28 01:30:02'),
	('656016960a626c4bfe5a624264828ebd9647374710929633985f9bec124d483bc2b095209e4518bc', 19, 1, 'Personal Access Token', '[]', 0, '2020-08-28 01:20:11', '2020-08-28 01:20:11', '2021-08-28 01:20:11'),
	('744d9c2fc4892d173062bfbb67a34ce41e9fc5098c41b415cce41930416eb9c59aeeb4eaf96b8d9f', 45, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:36:14', '2020-08-28 20:36:14', '2021-08-28 20:36:14'),
	('79050d6f68ab8a5f5a14671004c0a6448e5105ad424d65e660aac17ac585bf008086704381b58538', 8, 1, 'Personal Access Token', '[]', 0, '2020-08-27 23:35:12', '2020-08-27 23:35:12', '2021-08-27 23:35:12'),
	('7a1fc955d36554e4e5d4f61eb972d62d9c3e192de0472c08556d20ee832a0075cef11e6b9714aa57', 28, 1, 'Personal Access Token', '[]', 0, '2020-08-29 16:32:18', '2020-08-29 16:32:18', '2021-08-29 16:32:18'),
	('7ee9f754bff249058ec94cffce52f0dec587808d7183149892c4980a9056b8218ea92b1c91c7bc74', 32, 1, 'Personal Access Token', '[]', 0, '2020-08-28 19:39:36', '2020-08-28 19:39:36', '2021-08-28 19:39:36'),
	('80ad8e42cbb3246394ec98c79b85e70100f66720fd482e2e72f7a89bdcdd450075cdf077beb63cce', 20, 1, 'Personal Access Token', '[]', 0, '2020-08-28 01:26:31', '2020-08-28 01:26:31', '2021-08-28 01:26:31'),
	('823fb11047bb4b953e0e8f274fdcfa40901f978635479b5b9226439ee0d75a5a1496072da3942398', 24, 1, 'Personal Access Token', '[]', 0, '2020-08-28 18:34:40', '2020-08-28 18:34:40', '2021-08-28 18:34:40'),
	('86ac121f583b214b7497ef471e6befb395ac886119fd2478a09f7beadfc56d91e613dbe021159b07', 17, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:47:54', '2020-08-28 00:47:54', '2021-08-28 00:47:54'),
	('878c6c766880f649f6319be3eaeb1db52455baea3763985edb8513fcbdd9309661527f9703a1b7e0', 47, 1, 'Personal Access Token', '[]', 0, '2020-08-29 16:07:30', '2020-08-29 16:07:30', '2021-08-29 16:07:30'),
	('93424545f77e82e3216373c22a73355ffaaa89494abadedf63ce7dcfd7d6251dd5e652f3b0859154', 15, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:42:21', '2020-08-28 00:42:21', '2021-08-28 00:42:21'),
	('98160cf02bf66bd017900cf17d290eb64da3be59ea1d0fb8760ee4066d14e352d366dc9ccc7f3707', 26, 1, 'Personal Access Token', '[]', 0, '2020-08-28 18:44:44', '2020-08-28 18:44:44', '2021-08-28 18:44:44'),
	('9b4e81fbe6b35ed4fe1fc7967301f24c8bf91eeabac9133b3d0b97a73e16a1ba481ab2caa13b0c99', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:35:51', '2020-04-18 00:35:51', '2021-04-18 00:35:51'),
	('a4f403143994e4fd1a99f39c9d5ad8ebfb134591864204439f8c2e07c58bd705456936596bd1efcf', 38, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:19:17', '2020-08-28 20:19:17', '2021-08-28 20:19:17'),
	('af6ac8ea0b4d653fcece1092effefed8681cd154eeba59b48b027d03196f4fc6565df6ec3631d3f8', 7, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:51:13', '2020-08-28 00:51:13', '2021-08-28 00:51:13'),
	('b19eb48405d70e8e0d5f037cb572f3966fe14b11d90f91d2a06d41c4cf819306752e485c7d213529', 16, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:52:56', '2020-08-28 00:52:56', '2021-08-28 00:52:56'),
	('b29893eb63d85e36d182e18d2dd669568ba26951fbc3f44a5c547362bbbfb5e3afdd738dcdeacd08', 7, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:46:46', '2020-08-28 00:46:46', '2021-08-28 00:46:46'),
	('b5c9ed826989ad771a4dc91eb0489ac13b256709bcb95531154f6d42cdb0118a9836f01b05909834', 34, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:01:08', '2020-08-28 20:01:08', '2021-08-28 20:01:08'),
	('bdb84b11ccc9ea1c676d402ffc75782a6d53374c0c470b0aa6adad247c16cd87e2905a99af51ea62', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 05:24:07', '2020-04-18 05:24:07', '2021-04-18 05:24:07'),
	('be31a896ddb627e2f7cbbc84b9f4351ef9d41a52b582c13fadb61dcbfa225254f6357ce3c32ef73d', 35, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:03:38', '2020-08-28 20:03:38', '2021-08-28 20:03:38'),
	('be7bec1931d9d5c1775fa4908af7c5a2704aa12b81bc39089c38a29c8be7a34254a5fba5f213df02', 39, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:21:25', '2020-08-28 20:21:25', '2021-08-28 20:21:25'),
	('c6f34a066eebfabade3fa70a43e131b314b3a7629859c02a22619d9b045cd91eb3de0300ca86fff1', 30, 1, 'Personal Access Token', '[]', 0, '2020-08-28 19:36:30', '2020-08-28 19:36:30', '2021-08-28 19:36:30'),
	('c85a9bfb7fdb09072684e92aab762024648c0d209068b61d4f648eb2855edcbee1d9089b32ea8d70', 4, 1, 'Personal Access Token', '[]', 0, '2020-08-26 21:55:46', '2020-08-26 21:55:46', '2021-08-26 21:55:46'),
	('d139a0979d432be44c6abc747b7a881c74c0c093eda5de94eb0256fe1a425f6b36193cff46c6ed42', 37, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:18:03', '2020-08-28 20:18:03', '2021-08-28 20:18:03'),
	('d1571b403c8f04307684061d28f4c8fa74a6a731cb9c82e81c5647932545ef0118c39a70d8db81d1', 3, 1, 'Personal Access Token', '[]', 0, '2020-08-26 20:15:16', '2020-08-26 20:15:16', '2021-08-26 20:15:16'),
	('d63d33e9ea05bf34d4be97a06044236c0118f21600c8bc8354aa7cbe81e19cf3c16445604d5c6833', 33, 1, 'Personal Access Token', '[]', 0, '2020-08-28 19:56:03', '2020-08-28 19:56:03', '2021-08-28 19:56:03'),
	('daa5b2e584e3500260ac902f6d0d2f2d98e4f638e6de28cfc768bdcb3605a33fcb8b31f63405aec9', 5, 1, 'Personal Access Token', '[]', 0, '2020-08-26 22:09:35', '2020-08-26 22:09:35', '2021-08-26 22:09:35'),
	('dbba43d8ef89cfbc8ada2b01565e0a2b633e92405361c06311caf116f4a4186b420bb05b0556179e', 13, 1, 'Personal Access Token', '[]', 0, '2020-08-28 00:40:18', '2020-08-28 00:40:18', '2021-08-28 00:40:18'),
	('dc2fa0f3666ad9d7dc63d2ecd82279bd3f27d82e1e021b83af029a5c909d4b7a90eb476067fa3ded', 8, 1, 'Personal Access Token', '[]', 0, '2020-08-27 21:59:52', '2020-08-27 21:59:52', '2021-08-27 21:59:52'),
	('e0e6290cf3e3e5bced1a4271263a1b4ba8b9d7d25496a6ba6efce8eab9afb87974a5249579617a63', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:36:04', '2020-04-18 00:36:04', '2021-04-18 00:36:04'),
	('e1ff1f3ecfbf310a5d7e28608d4e8ea3722ac134677993e45f9133445306e4de4307fe3e0008f79f', 27, 1, 'Personal Access Token', '[]', 0, '2020-08-28 19:07:17', '2020-08-28 19:07:17', '2021-08-28 19:07:17'),
	('e762122f4dd82942c02e8a2a517d79152dd0349a0554974dbbaf8ce2cdd73d47e6d8dfa9c4df8258', 42, 1, 'Personal Access Token', '[]', 0, '2020-08-29 01:48:38', '2020-08-29 01:48:38', '2021-08-29 01:48:38'),
	('ebeca831365419cb1087d2b5f525e71d2b28f0c1f644e06e6bbf8c1b63a45345ec4fec5c9a037456', 22, 1, 'Personal Access Token', '[]', 0, '2020-08-28 01:33:52', '2020-08-28 01:33:52', '2021-08-28 01:33:52'),
	('eedc1695c430826f25c9e229cee93a06ce5b5618f21c9b2d8588551b6628fc009010d677dd82b242', 40, 1, 'Personal Access Token', '[]', 0, '2020-08-28 20:22:34', '2020-08-28 20:22:34', '2021-08-28 20:22:34'),
	('f6b0cd39adbe28675c1b68ad0c53b38de0e4d7d4a120ca6ef7d44e76d38f98764ac2888340ad4c74', 29, 1, 'Personal Access Token', '[]', 0, '2020-08-28 19:34:20', '2020-08-28 19:34:20', '2021-08-28 19:34:20'),
	('f7000cb7b3baaa1c299410d37e743ece94e5d4b0629011f4a17fa9301a26c30530b42a04de17200a', 42, 1, 'Personal Access Token', '[]', 0, '2020-08-29 01:16:43', '2020-08-29 01:16:43', '2021-08-29 01:16:43');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_auth_codes: ~0 rows (aproximadamente)
DELETE FROM `oauth_auth_codes`;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_clients: ~2 rows (aproximadamente)
DELETE FROM `oauth_clients`;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'o9F4E8XEn24VtE2xqRnQt8MEzUebRxALt8Ode2Xu', 'http://localhost', 1, 0, 0, '2020-04-17 23:38:58', '2020-04-17 23:38:58'),
	(2, NULL, 'Laravel Password Grant Client', 'V3cJnPHmPZUqO6SSLFywu9E400ZazSzeNwvHRH2C', 'http://localhost', 0, 1, 0, '2020-04-17 23:38:58', '2020-04-17 23:38:58');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_personal_access_clients: ~0 rows (aproximadamente)
DELETE FROM `oauth_personal_access_clients`;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2020-04-17 23:38:58', '2020-04-17 23:38:58');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_refresh_tokens: ~0 rows (aproximadamente)
DELETE FROM `oauth_refresh_tokens`;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.payment_methods
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.payment_methods: ~5 rows (aproximadamente)
DELETE FROM `payment_methods`;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Efectivo', NULL, '2020-04-17 23:38:32', '2020-04-17 23:38:32'),
	(2, 'Tarjeta de débito', NULL, '2020-04-17 23:38:32', '2020-04-17 23:38:32'),
	(3, 'Tarjeta de crédito', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(4, 'Cheque', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(5, 'Transferencia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.permissions: ~44 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'user-list', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(2, 'user-store', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(3, 'user-update', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(4, 'user-destroy', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(5, 'office-list', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(6, 'office-store', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(7, 'office-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(8, 'office-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(9, 'passenger-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(10, 'passenger-store', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(11, 'passenger-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(12, 'passenger-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(13, 'collaborator-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(14, 'collaborator-store', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(15, 'collaborator-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(16, 'collaborator-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(17, 'vacation-record-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(18, 'vacation-record-store', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(19, 'vacation-record-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(20, 'vacation-record-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(21, 'task-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(22, 'task-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(23, 'task-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(24, 'task-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(25, 'payment-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(26, 'payment-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(27, 'payment-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(28, 'payment-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(29, 'service-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(30, 'service-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(31, 'service-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(32, 'service-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(33, 'prospect-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(34, 'prospect-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(35, 'prospect-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(36, 'prospect-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(37, 'client-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(38, 'client-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(39, 'client-update', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(40, 'client-destroy', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(41, 'propoal-list', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(42, 'propoal-store', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(43, 'propoal-update', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(44, 'propoal-destroy', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.referido
CREATE TABLE IF NOT EXISTS `referido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAccionFk` int(11) DEFAULT '0',
  `idUserReferidoFk` int(11) DEFAULT '0',
  `idUsuarioDuenoFk` int(11) DEFAULT NULL,
  `idAccionReferidoFk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.referido: ~23 rows (aproximadamente)
DELETE FROM `referido`;
/*!40000 ALTER TABLE `referido` DISABLE KEYS */;
INSERT INTO `referido` (`id`, `idAccionFk`, `idUserReferidoFk`, `idUsuarioDuenoFk`, `idAccionReferidoFk`) VALUES
	(38, 30, 24, 25, 29),
	(39, 31, 24, 26, 29),
	(40, 32, 24, 27, 29),
	(41, 33, 24, 28, 29),
	(42, 34, 25, 29, 30),
	(43, 35, 25, 30, 30),
	(44, 36, 25, 31, 30),
	(48, 38, 25, 32, 30),
	(49, 39, 26, 33, 31),
	(50, 40, 26, 34, 31),
	(51, 41, 26, 35, 31),
	(53, 43, 26, 36, 31),
	(54, 44, 27, 37, 32),
	(55, 45, 27, 38, 32),
	(56, 46, 27, 39, 32),
	(57, 47, 27, 40, 32),
	(59, 49, 28, 42, 33),
	(60, 50, 28, 43, 33),
	(61, 51, 28, 44, 33),
	(298, 153, 28, 42, 33),
	(299, 237, 29, 28, 34),
	(300, 238, 29, 24, 34),
	(307, 239, 46, 47, 64);
/*!40000 ALTER TABLE `referido` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.relation_file
CREATE TABLE IF NOT EXISTS `relation_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rel_id` int(10) unsigned NOT NULL,
  `file_id` int(10) unsigned NOT NULL,
  `table_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_file_file_id_foreign` (`file_id`),
  CONSTRAINT `relation_file_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.relation_file: ~0 rows (aproximadamente)
DELETE FROM `relation_file`;
/*!40000 ALTER TABLE `relation_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `relation_file` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.roles: ~0 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(2, 'Cliente', 'web', NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.role_has_permissions: ~44 rows (aproximadamente)
DELETE FROM `role_has_permissions`;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.saldo
CREATE TABLE IF NOT EXISTS `saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUserFk` int(11) DEFAULT NULL,
  `entrada` double(8,2) DEFAULT NULL,
  `salida` double(8,2) DEFAULT NULL,
  `concepto` text,
  `idAccionFk` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.saldo: ~5 rows (aproximadamente)
DELETE FROM `saldo`;
/*!40000 ALTER TABLE `saldo` DISABLE KEYS */;
INSERT INTO `saldo` (`id`, `idUserFk`, `entrada`, `salida`, `concepto`, `idAccionFk`, `fecha`) VALUES
	(3, 28, 2.00, 0.00, 'Bono Arranque', 33, '2020-08-29 11:31:33'),
	(4, 46, 1.00, 0.00, 'Bono por referido', 239, '2020-08-29 12:15:27'),
	(5, 28, 2.00, 0.00, 'Bono Arranque', 33, '2020-08-29 11:31:33'),
	(6, 28, 0.00, 1.50, 'Bono Arranque', 33, '2020-08-29 11:31:33'),
	(7, 28, 30.00, 0.00, NULL, NULL, '2020-08-29 13:35:43');
/*!40000 ALTER TABLE `saldo` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.solicitudretiro
CREATE TABLE IF NOT EXISTS `solicitudretiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUserFk` int(11) DEFAULT NULL,
  `montoSolicitado` double(8,2) DEFAULT NULL,
  `plataforma` text,
  `estatus` varchar(191) DEFAULT 'solicitando',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.solicitudretiro: ~0 rows (aproximadamente)
DELETE FROM `solicitudretiro`;
/*!40000 ALTER TABLE `solicitudretiro` DISABLE KEYS */;
INSERT INTO `solicitudretiro` (`id`, `idUserFk`, `montoSolicitado`, `plataforma`, `estatus`, `fecha`) VALUES
	(1, 28, 10.00, 'Airtm', 'solicitando', '2020-08-29 13:36:12');
/*!40000 ALTER TABLE `solicitudretiro` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.statuses: ~2 rows (aproximadamente)
DELETE FROM `statuses`;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` (`id`, `type`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'general', 'Activo', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(2, 'general', 'Inactivo', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_documento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idReferido` int(11) DEFAULT NULL,
  `premiun` int(11) NOT NULL DEFAULT '0',
  `posicion` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_deleted_at_unique` (`email`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.users: ~24 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `avatar`, `email_verified_at`, `password`, `n_documento`, `link`, `idReferido`, `premiun`, `posicion`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '1092edgar@gmail.com', 'Edgar', 'Gomez', NULL, NULL, '$2y$10$KMZuA5rjWIhjU62P4Tj8c.wOQWhNsykmqWSShJYv5AwdlkuSxFQX6', NULL, 'culo', 5, 1, 1, NULL, '2020-04-17 23:38:48', '2020-04-17 23:38:48', NULL),
	(3, 'hectormarrero91@gmail.com', 'jhonathan', 'rodriguez', NULL, NULL, '$2y$10$vMoJ8YKi8XStSha/8ObD2eijeTwvzf85BVw8MUuierdRfp9kEWnru', '6666', 'fN3eLuj7no', 5, 1, 1, NULL, '2020-04-17 23:41:37', '2020-04-18 03:06:50', NULL),
	(24, 'cr@gmail.com', 'cristina', 'meleant', NULL, NULL, '$2y$10$WNmVcDRuwkMe/5fhMop5huNAbYY1kHdV9kB/BHKXGVjKIryfRph42', '123456', 's4aA2HmF9D', NULL, 1, 1, NULL, '2020-08-28 18:34:25', '2020-08-29 01:37:38', NULL),
	(25, 'usuario1@gmail.com', 'usuario1', 'usuario1', NULL, NULL, '$2y$10$iBzG9PHuYRyBuf.eeIiuIOCR45JTkIYz.Crzy/ixqNGuS.Ejm5r0e', '3334534', '8vrjuDiBhd', 24, 1, 1, NULL, '2020-08-28 18:37:56', '2020-08-28 18:42:58', NULL),
	(26, 'usuario2@gmail.com', 'usuario2', 'usuario2', NULL, NULL, '$2y$10$VYMF.Dmzj2zfM.Sk9jd72OoTnBzXreEjRof.1RJ.OqhN1Teilb/du', '3334534', '6YB8WYsXMR', 24, 1, 1, NULL, '2020-08-28 18:44:28', '2020-08-28 18:51:25', NULL),
	(27, 'usuario3@gmail.com', 'usuario3', 'usuario3', NULL, NULL, '$2y$10$UvemrJMP7CWVgcNJjzOTee4eGiAdiOEOQgfEa7h9qnR9t1gDShe7a', '3334534', 'F4SHOCTcE7', 24, 1, 1, NULL, '2020-08-28 19:07:04', '2020-08-28 19:07:37', NULL),
	(28, 'usuario4@gmail.com', 'usuario4', 'usuario4', NULL, NULL, '$2y$10$vk7ahTFo9uSg.viulJ6quundTjdmjvLz.G60rMJ.yJrMTxJ2F.r/O', '3334534', 'pGxnQXvCV8', 24, 1, 1, NULL, '2020-08-28 19:20:59', '2020-08-28 19:21:49', NULL),
	(29, 'usuario11@gmail.com', 'usuario11', 'usuario11', NULL, NULL, '$2y$10$zwFerCmuW8GjZKAeeOOYKO3Xq63RKJxvXeuZATKUqfLkTVW0vP0xO', '3334534', 'm50xgTEp2i', 25, 1, 1, NULL, '2020-08-28 19:34:06', '2020-08-28 19:35:17', NULL),
	(30, 'usuario12@gmail.com', 'usuario12', 'usuario12', NULL, NULL, '$2y$10$6CARjl5v7bgy/.DDvQ/cbOxuB8/aM5EhggsIvQghpY8IRvyVCrIQO', '3334534', 'dU6fNfMNYq', 25, 1, 1, NULL, '2020-08-28 19:36:19', '2020-08-28 19:37:01', NULL),
	(31, 'usuario13@gmail.com', 'usuario13', 'usuario13', NULL, NULL, '$2y$10$0CMi.gkPG9I7zFpV0/36q.W3oAQrO502OmtIVpjKi2iLT0DySPdai', '3334534', '8yQX268AdH', 25, 1, 1, NULL, '2020-08-28 19:37:40', '2020-08-28 19:38:46', NULL),
	(32, 'usuario14@gmail.com', 'usuario14', 'usuario14', NULL, NULL, '$2y$10$IbO3Ndivm9WOKinKt5Q95e4SyRUSVpe/Ddc76XG9Kbo9q36YWDXCG', '3334534', '8xUL0WPyhr', 25, 1, 1, NULL, '2020-08-28 19:39:23', '2020-08-28 19:45:35', NULL),
	(33, 'usuario21@gmail.com', 'usuario21', 'usuario21', NULL, NULL, '$2y$10$T7yoWq0f6KCNsO1eooUW1OzknyWtOkbORtI9Kj3Y4EJvlDMIUvqKm', '3334534', 't3CmRMm09s', 26, 1, 1, NULL, '2020-08-28 19:52:04', '2020-08-28 19:58:06', NULL),
	(34, 'usuario22@gmail.com', 'usuario22', 'usuario22', NULL, NULL, '$2y$10$rdYd0MZ0SVf2QEPyqfuNieRfxTW9rFNKO7sme/RofYvm4/yfczuwi', '3334534', 'bR1iI76vYZ', 26, 1, 1, NULL, '2020-08-28 20:00:03', '2020-08-28 20:02:41', NULL),
	(35, 'usuario23@gmail.com', 'usuario23', 'usuario23', NULL, NULL, '$2y$10$.XlXApQy/L2v7m15S6ZMSeCiT.3nNBK7P7dE2uL0ukU.xFIGEO2HW', '3334534', '5aF4sDfumY', 26, 1, 1, NULL, '2020-08-28 20:03:26', '2020-08-28 20:04:29', NULL),
	(36, 'usuario24@gmail.com', 'usuario24', 'usuario24', NULL, NULL, '$2y$10$E18rJ4Ej0DbHqZCq3kvVzuqRekuL9FXekQbeMWD1u/kKLeN9jqxem', '3334534', 'mpoGTJsAK9', 26, 1, 1, NULL, '2020-08-28 20:08:45', '2020-08-28 20:09:53', NULL),
	(37, 'usuario31@gmail.com', 'usuario31', 'usuario31', NULL, NULL, '$2y$10$KASKggxuFJiyrDa2ZRxcU.07J7ZvQE7Q7RzRBPsqgSK1/cl7lOoIa', '3334534', 'QEzAcT1OC4', 27, 1, 1, NULL, '2020-08-28 20:17:48', '2020-08-28 20:18:25', NULL),
	(38, 'usuario32@gmail.com', 'usuario32', 'usuario32', NULL, NULL, '$2y$10$HtDouLhFxnuT4xCmzRBvwOecJuXS/EtJ8R7EqeXQstUey8PE4uG4e', '3334534', 'prHe55eIzJ', 27, 1, 1, NULL, '2020-08-28 20:19:04', '2020-08-28 20:20:40', NULL),
	(39, 'usuario33@gmail.com', 'usuario33', 'usuario33', NULL, NULL, '$2y$10$F19O8or2qkJKfGkztg/Zv.mxshhgcihJ0JFU6HN8uqUpR/Pw9DhGe', '3334534', 'xsDHpXb2M3', 27, 1, 1, NULL, '2020-08-28 20:21:09', '2020-08-28 20:21:51', NULL),
	(40, 'usuario34@gmail.com', 'usuario34', 'usuario34', NULL, NULL, '$2y$10$qOwy1Ar.C.vGtq5OFMV.muxrbe7jW9GP6dFrC4SsV1m5Dy3aWi.xa', '3334534', 'JUU26FAXoV', 27, 1, 1, NULL, '2020-08-28 20:22:25', '2020-08-28 20:23:07', NULL),
	(42, 'usuario41@gmail.com', 'usuario41', 'usuario41', NULL, NULL, '$2y$10$9rhjw7rbGHUykPXvMofxReSzx2NPY0U/P8scyv.RLsbuJOAxK7LKW', '3334534', '1TNIP4ukBS', 28, 1, 1, NULL, '2020-08-28 20:28:47', '2020-08-28 20:29:39', NULL),
	(43, 'usuario42@gmail.com', 'usuario42', 'usuario42', NULL, NULL, '$2y$10$W/by3cd/mNQt/47Kjtt5xeeDs6tyK3LyhNxMKGqThclTgac5ADn4q', '3334534', 'R84h3ArLJB', 28, 1, 1, NULL, '2020-08-28 20:30:13', '2020-08-28 20:30:47', NULL),
	(44, 'usuario43@gmail.com', 'usuario43', 'usuario43', NULL, NULL, '$2y$10$HPBcnYhpzwDv9BBgMcbYkeYifsaWlgoHxWPVaR/mWX1vHnBZmdrcS', '3334534', 'SYmVnQHZZc', 28, 1, 1, NULL, '2020-08-28 20:31:46', '2020-08-28 20:32:35', NULL),
	(45, 'usuario44@gmail.com', 'usuario44', 'usuario44', NULL, NULL, '$2y$10$S7mxDyPbVWyuPDVJ/jaJHOD3SE2ja4NPVvyzREFpGrcp1WtO9P7V2', '3334534', 'F68iBE2ylV', 28, 1, 1, NULL, '2020-08-28 20:36:12', '2020-08-28 20:37:20', NULL),
	(46, 'usuario51@gmail.com', 'usuario51', 'usuario51', NULL, NULL, '$2y$10$rADmkOyv9TSU67UD0AJ65.nr9FdUvEFnaUf0cHyGMHYgxMAeDfuee', '3334534', '58LaHzL83o', 28, 1, 1, NULL, '2020-08-29 01:03:43', '2020-08-29 01:04:35', NULL),
	(47, 'tancho@gmail.com', 'tancho', 'tancho', NULL, NULL, '$2y$10$54vcvdjoxfhZprlEpZ8oFer/zByt9PTE4JtcPS73rzXL0J6/b86Ne', '3334534', '45oMhzF8Y7', 46, 1, 1, NULL, '2020-08-29 16:07:16', '2020-08-29 16:07:55', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
