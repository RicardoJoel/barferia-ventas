-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2022 a las 22:28:32
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `precisoo_barferia_ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afps`
--

CREATE TABLE `afps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `afps`
--

INSERT INTO `afps` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Habitat', 'HBT', NULL, NULL, NULL),
(2, 'Integra', 'ITG', NULL, NULL, NULL),
(3, 'Prima', 'PRM', NULL, NULL, NULL),
(4, 'Profuturo', 'PFT', NULL, NULL, NULL),
(5, 'ONP', 'ONP', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `banks`
--

INSERT INTO `banks` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Banco de Comercio', 'COM', NULL, NULL, NULL),
(2, 'Banco de Crédito BCP', 'BCP', NULL, NULL, NULL),
(3, 'Banco Interamericano de Finanzas', 'BIF', NULL, NULL, NULL),
(4, 'Banco Pichincha', 'PCH', NULL, NULL, NULL),
(5, 'BBVA', 'BBV', NULL, NULL, NULL),
(6, 'Citibank Perú', 'CIT', NULL, NULL, NULL),
(7, 'Interbank', 'IBK', NULL, NULL, NULL),
(8, 'Mibanco', 'MIB', NULL, NULL, NULL),
(9, 'Scotiabank Perú', 'SCT', NULL, NULL, NULL),
(10, 'Banco GNB Perú', 'GNB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centers`
--

CREATE TABLE `centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nemo` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubigeo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_ubigeo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `centers`
--

INSERT INTO `centers` (`id`, `code`, `name`, `nemo`, `type`, `address`, `ubigeo_id`, `other_ubigeo`, `ref`, `lat`, `lng`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'L2021001', 'Comas', 'CMS', 'T', 'Vicente Angulo 274, Comas, Perú', 1290, NULL, NULL, -11.9486116, -77.062932, '2021-10-01 00:00:00', '2021-10-28 18:00:09', NULL),
(2, 'L2021002', 'Santiago de Surco', 'SRC', 'T', 'Jirón Ricardo Aicardi 224, Santiago de Surco, Perú', 1320, NULL, NULL, -12.1269448, -76.9930795, '2021-10-01 00:00:00', '2021-10-28 18:00:44', NULL),
(3, 'L2021003', 'San Juan de Lurigancho', 'SJL', 'T', 'Avenida 13 de Enero 2143, San Juan de Lurigancho, Perú', 1312, NULL, NULL, -11.995261, -77.0053922, '2021-10-01 00:00:00', '2021-10-29 11:39:47', NULL),
(4, 'L2021004', 'Pueblo Libre', 'PLB', 'T', 'Av. Alejandro Bertello Bollati 1080, Cercado de Lima 15088, Perú', 1301, NULL, NULL, -12.065896, -77.0733276, '2021-10-01 00:00:00', '2021-10-28 18:10:45', NULL),
(5, 'L2021005', 'Centro de producción 1 (SJL)', 'CP1', 'F', 'Avenida 13 de Enero 2143, San Juan de Lurigancho, Perú', 1312, NULL, NULL, -11.995261, -77.0053922, '2021-10-01 00:00:00', '2021-10-28 18:02:03', NULL),
(6, 'L2021006', 'Centro de producción 2 (VES)', 'CP2', 'F', '', NULL, NULL, NULL, 0, 0, '2021-10-01 00:00:00', '2021-12-29 16:30:28', '2021-12-29 16:30:28'),
(7, 'L2021007', 'Los Olivos', 'OLV', 'T', 'Cochas 5088, Los Olivos, Perú', 1297, NULL, 'A una cuadra del óvalo Huandoy', -11.9746887, -77.082912, '2021-10-27 12:19:47', '2021-12-29 16:30:20', '2021-12-29 16:30:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choices`
--

CREATE TABLE `choices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_detail_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `choices`
--

INSERT INTO `choices` (`id`, `sale_detail_id`, `product_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 9, 1, '2022-01-08 15:19:10', '2022-01-08 15:19:10', NULL),
(2, 1, 4, 1, '2022-01-08 15:19:10', '2022-01-08 15:19:10', NULL),
(3, 1, 6, 1, '2022-01-08 15:19:11', '2022-01-08 15:19:11', NULL),
(4, 1, 5, 0, '2022-01-08 15:19:11', '2022-01-08 15:19:11', NULL),
(5, 1, 3, 0, '2022-01-08 15:19:11', '2022-01-08 15:19:11', NULL),
(6, 1, 1, 0, '2022-01-08 15:19:11', '2022-01-08 15:19:11', NULL),
(7, 1, 2, 0, '2022-01-08 15:19:12', '2022-01-08 15:19:12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `commissions`
--

INSERT INTO `commissions` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Comisión sobre el sueldo', NULL, NULL, NULL),
(2, 'Comisión mixta', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mob_pattern` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `mob_pattern`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Afganistán', '+93', '', NULL, NULL, NULL),
(2, 'Albania', '+355', '', NULL, NULL, NULL),
(3, 'Alemania', '+49', '', NULL, NULL, NULL),
(4, 'Andorra', '+376', '', NULL, NULL, NULL),
(5, 'Angola', '+244', '', NULL, NULL, NULL),
(6, 'Anguila', '+1264', '', NULL, NULL, NULL),
(7, 'Antigua y Barbuda', '+1268', '', NULL, NULL, NULL),
(8, 'Antillas Neerlandesas', '+599', '', NULL, NULL, NULL),
(9, 'Arabia Saudita', '+966', '', NULL, NULL, NULL),
(10, 'Argelia', '+213', '', NULL, NULL, NULL),
(11, 'Argentina', '+54', '', NULL, NULL, NULL),
(12, 'Armenia', '+374', '', NULL, NULL, NULL),
(13, 'Aruba', '+297', '', NULL, NULL, NULL),
(14, 'Australia', '+61', '', NULL, NULL, NULL),
(15, 'Austria', '+43', '', NULL, NULL, NULL),
(16, 'Autoridad Palestina', '+970', '', NULL, NULL, NULL),
(17, 'Azerbaiyán', '+994', '', NULL, NULL, NULL),
(18, 'Bahamas', '+1242', '', NULL, NULL, NULL),
(19, 'Bahrain', '+973', '', NULL, NULL, NULL),
(20, 'Bangladesh', '+880', '', NULL, NULL, NULL),
(21, 'Barbados', '+1246', '', NULL, NULL, NULL),
(22, 'Belarus', '+375', '', NULL, NULL, NULL),
(23, 'Bélgica', '+32', '', NULL, NULL, NULL),
(24, 'Belice', '+501', '', NULL, NULL, NULL),
(25, 'Benín', '+229', '', NULL, NULL, NULL),
(26, 'Bermuda', '+1441', '', NULL, NULL, NULL),
(27, 'Bolivia', '+591', '', NULL, NULL, NULL),
(28, 'Bosnia/Herzegovina', '+387', '', NULL, NULL, NULL),
(29, 'Botsuana', '+267', '', NULL, NULL, NULL),
(30, 'Brasil', '+55', '', NULL, NULL, NULL),
(31, 'Brunéi', '+673', '', NULL, NULL, NULL),
(32, 'Bulgaria', '+359', '', NULL, NULL, NULL),
(33, 'Burkina Faso', '+226', '', NULL, NULL, NULL),
(34, 'Burundi', '+257', '', NULL, NULL, NULL),
(35, 'Bután', '+975', '', NULL, NULL, NULL),
(36, 'Camboya', '+855', '', NULL, NULL, NULL),
(37, 'Camerún', '+237', '', NULL, NULL, NULL),
(38, 'Chad', '+235', '', NULL, NULL, NULL),
(39, 'Chile', '+56', '', NULL, NULL, NULL),
(40, 'China', '+86', '', NULL, NULL, NULL),
(41, 'Chipre', '+357', '', NULL, NULL, NULL),
(42, 'Colombia', '+57', '', NULL, NULL, NULL),
(43, 'Comoras', '+269', '', NULL, NULL, NULL),
(44, 'Congo (República Democrática)', '+243', '', NULL, NULL, NULL),
(45, 'Congo (República)', '+242', '', NULL, NULL, NULL),
(46, 'Corea (Norte)', '+850', '', NULL, NULL, NULL),
(47, 'Corea (Sur)', '+82', '', NULL, NULL, NULL),
(48, 'Costa de Marfil', '+225', '', NULL, NULL, NULL),
(49, 'Costa Rica', '+506', '', NULL, NULL, NULL),
(50, 'Croacia', '+385', '', NULL, NULL, NULL),
(51, 'Cuba', '+53', '', NULL, NULL, NULL),
(52, 'Diego García', '+246', '', NULL, NULL, NULL),
(53, 'Dinamarca', '+45', '', NULL, NULL, NULL),
(54, 'Dominica', '+1767', '', NULL, NULL, NULL),
(55, 'Ecuador', '+593', '', NULL, NULL, NULL),
(56, 'Egipto', '+20', '', NULL, NULL, NULL),
(57, 'El Salvador', '+503', '', NULL, NULL, NULL),
(58, 'Emiratos Árabes Unidos', '+971', '', NULL, NULL, NULL),
(59, 'Eritrea', '+291', '', NULL, NULL, NULL),
(60, 'Eslovaquia', '+421', '', NULL, NULL, NULL),
(61, 'Eslovenia', '+386', '', NULL, NULL, NULL),
(62, 'España', '+34', '', NULL, NULL, NULL),
(63, 'Estonia', '+372', '', NULL, NULL, NULL),
(64, 'Etiopía', '+251', '', NULL, NULL, NULL),
(65, 'Filipinas', '+63', '', NULL, NULL, NULL),
(66, 'Finlandia', '+358', '', NULL, NULL, NULL),
(67, 'Fiyi', '+679', '', NULL, NULL, NULL),
(68, 'Francia', '+33', '', NULL, NULL, NULL),
(69, 'Gabón', '+241', '', NULL, NULL, NULL),
(70, 'Gambia', '+220', '', NULL, NULL, NULL),
(71, 'Georgia', '+995', '', NULL, NULL, NULL),
(72, 'Ghana', '+233', '', NULL, NULL, NULL),
(73, 'Gibraltar', '+350', '', NULL, NULL, NULL),
(74, 'Granada', '+1473', '', NULL, NULL, NULL),
(75, 'Grecia', '+30', '', NULL, NULL, NULL),
(76, 'Groenlandia', '+299', '', NULL, NULL, NULL),
(77, 'Guadalupe (Antillas Francesas)', '+590', '', NULL, NULL, NULL),
(78, 'Guatemala', '+502', '', NULL, NULL, NULL),
(79, 'Guernsey', '+44', '', NULL, NULL, NULL),
(80, 'Guinea', '+224', '', NULL, NULL, NULL),
(81, 'Guinea Ecuatorial', '+240', '', NULL, NULL, NULL),
(82, 'Guinea-Bisáu', '+245', '', NULL, NULL, NULL),
(83, 'Guyana', '+592', '', NULL, NULL, NULL),
(84, 'Guyana Francesa', '+594', '', NULL, NULL, NULL),
(85, 'Haití', '+509', '', NULL, NULL, NULL),
(86, 'Holanda', '+31', '', NULL, NULL, NULL),
(87, 'Honduras', '+504', '', NULL, NULL, NULL),
(88, 'Hong Kong', '+852', '', NULL, NULL, NULL),
(89, 'Hungría', '+36', '', NULL, NULL, NULL),
(90, 'India', '+91', '', NULL, NULL, NULL),
(91, 'Indonesia', '+62', '', NULL, NULL, NULL),
(92, 'Irán', '+98', '', NULL, NULL, NULL),
(93, 'Iraq', '+964', '', NULL, NULL, NULL),
(94, 'Irlanda', '+353', '', NULL, NULL, NULL),
(95, 'Isla de Man', '+44', '', NULL, NULL, NULL),
(96, 'Isla de San Martín', '+1721', '', NULL, NULL, NULL),
(97, 'Islandia', '+354', '', NULL, NULL, NULL),
(98, 'Islas Caimán', '+1345', '', NULL, NULL, NULL),
(99, 'Islas Cook', '+682', '', NULL, NULL, NULL),
(100, 'Islas de Cabo Verde', '+238', '', NULL, NULL, NULL),
(101, 'Islas Feroe', '+298', '', NULL, NULL, NULL),
(102, 'Islas Malvinas', '+500', '', NULL, NULL, NULL),
(103, 'Islas Marianas del Norte', '+1670', '', NULL, NULL, NULL),
(104, 'Islas Marshall', '+692', '', NULL, NULL, NULL),
(105, 'Islas Mauricio', '+230', '', NULL, NULL, NULL),
(106, 'Islas Salomón', '+677', '', NULL, NULL, NULL),
(107, 'Islas Turcas y Caicos', '+1649', '', NULL, NULL, NULL),
(108, 'Islas Vírgenes Británicas', '+1284', '', NULL, NULL, NULL),
(109, 'Israel', '+972', '', NULL, NULL, NULL),
(110, 'Italia', '+39', '', NULL, NULL, NULL),
(111, 'Jamaica', '+1876', '', NULL, NULL, NULL),
(112, 'Japón', '+81', '', NULL, NULL, NULL),
(113, 'Jersey', '+44', '', NULL, NULL, NULL),
(114, 'Jordania', '+962', '', NULL, NULL, NULL),
(115, 'Kazajistán', '+7', '', NULL, NULL, NULL),
(116, 'Kenia', '+254', '', NULL, NULL, NULL),
(117, 'Kirguizistán', '+996', '', NULL, NULL, NULL),
(118, 'Kiribati', '+686', '', NULL, NULL, NULL),
(119, 'Kuwait', '+965', '', NULL, NULL, NULL),
(120, 'Laos', '+856', '', NULL, NULL, NULL),
(121, 'Lesoto', '+266', '', NULL, NULL, NULL),
(122, 'Letonia', '+371', '', NULL, NULL, NULL),
(123, 'Líbano', '+961', '', NULL, NULL, NULL),
(124, 'Liberia', '+231', '', NULL, NULL, NULL),
(125, 'Libia', '+218', '', NULL, NULL, NULL),
(126, 'Liechtenstein', '+423', '', NULL, NULL, NULL),
(127, 'Lituania', '+370', '', NULL, NULL, NULL),
(128, 'Luxemburgo', '+352', '', NULL, NULL, NULL),
(129, 'Macau', '+853', '', NULL, NULL, NULL),
(130, 'Macedonia', '+389', '', NULL, NULL, NULL),
(131, 'Madagascar', '+261', '', NULL, NULL, NULL),
(132, 'Malasia', '+60', '', NULL, NULL, NULL),
(133, 'Malaui', '+265', '', NULL, NULL, NULL),
(134, 'Maldivas', '+960', '', NULL, NULL, NULL),
(135, 'Malí', '+223', '', NULL, NULL, NULL),
(136, 'Malta', '+356', '', NULL, NULL, NULL),
(137, 'Marruecos', '+212', '', NULL, NULL, NULL),
(138, 'Martinica', '+596', '', NULL, NULL, NULL),
(139, 'Mauritania', '+222', '', NULL, NULL, NULL),
(140, 'México', '+52', '', NULL, NULL, NULL),
(141, 'Micronesia', '+691', '', NULL, NULL, NULL),
(142, 'Moldova', '+373', '', NULL, NULL, NULL),
(143, 'Mónaco', '+377', '', NULL, NULL, NULL),
(144, 'Mongolia', '+976', '', NULL, NULL, NULL),
(145, 'Montenegro', '+382', '', NULL, NULL, NULL),
(146, 'Montserrat', '+1664', '', NULL, NULL, NULL),
(147, 'Mozambique', '+258', '', NULL, NULL, NULL),
(148, 'Myanmar (Birmania)', '+95', '', NULL, NULL, NULL),
(149, 'Namibia', '+264', '', NULL, NULL, NULL),
(150, 'Nauru', '+674', '', NULL, NULL, NULL),
(151, 'Nepal', '+977', '', NULL, NULL, NULL),
(152, 'Nicaragua', '+505', '', NULL, NULL, NULL),
(153, 'Níger', '+227', '', NULL, NULL, NULL),
(154, 'Nigeria', '+234', '', NULL, NULL, NULL),
(155, 'Noruega', '+47', '', NULL, NULL, NULL),
(156, 'Nueva Caledonia', '+687', '', NULL, NULL, NULL),
(157, 'Nueva Zelanda', '+64', '', NULL, NULL, NULL),
(158, 'Omán', '+968', '', NULL, NULL, NULL),
(159, 'Pakistán', '+92', '', NULL, NULL, NULL),
(160, 'Palaos', '+680', '', NULL, NULL, NULL),
(161, 'Panamá', '+507', '', NULL, NULL, NULL),
(162, 'Papúa Nueva Guinea', '+675', '', NULL, NULL, NULL),
(163, 'Paraguay', '+595', '', NULL, NULL, NULL),
(164, 'Perú', '+51', '', NULL, NULL, NULL),
(165, 'Polonia', '+48', '', NULL, NULL, NULL),
(166, 'Portugal', '+351', '', NULL, NULL, NULL),
(167, 'Qatar', '+974', '', NULL, NULL, NULL),
(168, 'Reino Unido', '+44', '', NULL, NULL, NULL),
(169, 'República Centroafricana', '+236', '', NULL, NULL, NULL),
(170, 'República Checa', '+420', '', NULL, NULL, NULL),
(171, 'República Dominicana', '+1', '', NULL, NULL, NULL),
(172, 'Reunión', '+262', '', NULL, NULL, NULL),
(173, 'Ruanda', '+250', '', NULL, NULL, NULL),
(174, 'Rumania', '+40', '', NULL, NULL, NULL),
(175, 'Rusia', '+7', '', NULL, NULL, NULL),
(176, 'Saipán (Islas Marianas del Norte)', '+1670', '', NULL, NULL, NULL),
(177, 'Samoa', '+685', '', NULL, NULL, NULL),
(178, 'Samoa Americana', '+1684', '', NULL, NULL, NULL),
(179, 'San Cristóbal/Nieves', '+1869', '', NULL, NULL, NULL),
(180, 'San Marino', '+378', '', NULL, NULL, NULL),
(181, 'San Pedro/Miquelón', '+508', '', NULL, NULL, NULL),
(182, 'San Vicente/Granadinas', '+1784', '', NULL, NULL, NULL),
(183, 'Santa Lucía', '+1758', '', NULL, NULL, NULL),
(184, 'Santo Tomé/Príncipe', '+239', '', NULL, NULL, NULL),
(185, 'Senegal', '+221', '', NULL, NULL, NULL),
(186, 'Serbia', '+381', '', NULL, NULL, NULL),
(187, 'Seychelles', '+248', '', NULL, NULL, NULL),
(188, 'Sierra Leona', '+232', '', NULL, NULL, NULL),
(189, 'Singapur', '+65', '', NULL, NULL, NULL),
(190, 'Siria', '+963', '', NULL, NULL, NULL),
(191, 'Sri Lanka', '+94', '', NULL, NULL, NULL),
(192, 'Suazilandia', '+268', '', NULL, NULL, NULL),
(193, 'Sudáfrica', '+27', '', NULL, NULL, NULL),
(194, 'Sudán', '+249', '', NULL, NULL, NULL),
(195, 'Sudán Meridional', '+211', '', NULL, NULL, NULL),
(196, 'Suecia', '+46', '', NULL, NULL, NULL),
(197, 'Suiza', '+41', '', NULL, NULL, NULL),
(198, 'Suriname', '+597', '', NULL, NULL, NULL),
(199, 'Tailandia', '+66', '', NULL, NULL, NULL),
(200, 'Taiwán', '+886', '', NULL, NULL, NULL),
(201, 'Tanzania', '+255', '', NULL, NULL, NULL),
(202, 'Tayikistán', '+992', '', NULL, NULL, NULL),
(203, 'Territorio australiano', '+672', '', NULL, NULL, NULL),
(204, 'Togo', '+228', '', NULL, NULL, NULL),
(205, 'Tokelau', '+690', '', NULL, NULL, NULL),
(206, 'Tonga', '+676', '', NULL, NULL, NULL),
(207, 'Trinidad y Tobago', '+1868', '', NULL, NULL, NULL),
(208, 'Túnez', '+216', '', NULL, NULL, NULL),
(209, 'Turkmenistán', '+993', '', NULL, NULL, NULL),
(210, 'Turquía', '+90', '', NULL, NULL, NULL),
(211, 'Tuvalu', '+688', '', NULL, NULL, NULL),
(212, 'Ucrania', '+380', '', NULL, NULL, NULL),
(213, 'Uganda', '+256', '', NULL, NULL, NULL),
(214, 'Uruguay', '+598', '', NULL, NULL, NULL),
(215, 'Uzbekistán', '+998', '', NULL, NULL, NULL),
(216, 'Vanuatu', '+678', '', NULL, NULL, NULL),
(217, 'Venezuela', '+58', '', NULL, NULL, NULL),
(218, 'Vietnam', '+84', '', NULL, NULL, NULL),
(219, 'Yemen', '+967', '', NULL, NULL, NULL),
(220, 'Yibuti', '+253', '', NULL, NULL, NULL),
(221, 'Zambia', '+260', '', NULL, NULL, NULL),
(222, 'Zimbabue', '+263', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `document_type_id`, `country_id`, `code`, `name`, `lastname`, `birthdate`, `document`, `email`, `mobile`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 164, 'C2021001', 'Talía Ximena', 'Gimenez Lindo', '1988-07-14', '70689935', 'talia@gmail.com', '991 267 284', '01 632 0902', '2021-10-12 12:31:29', '2021-11-11 08:18:10', NULL),
(2, NULL, 164, 'C2021002', 'Emilia', 'Perez', NULL, NULL, NULL, NULL, NULL, '2021-10-12 15:27:53', '2021-10-12 15:27:53', NULL),
(3, NULL, 164, 'C2021003', 'Diego', 'Pacheco', NULL, NULL, NULL, NULL, NULL, '2021-10-12 15:49:05', '2021-10-12 15:49:05', NULL),
(4, 1, 164, 'C2021004', 'Jorgito', 'Antunez de Mayolo', '2003-10-18', '98593485', 'jorge.antunez@gmail.com', '989 898 989', '01 984 3273', '2021-10-19 17:18:37', '2021-12-28 15:02:42', NULL),
(5, 1, 164, 'C2021005', 'Melissa', 'Samillán', NULL, '40687592', 'issis.sam@hotmail.com', '966 530 462', NULL, '2021-10-28 18:14:56', '2021-10-28 18:14:56', NULL),
(6, NULL, 164, 'C2021006', 'Ri', 'B', NULL, NULL, NULL, NULL, NULL, '2021-11-03 14:59:52', '2021-11-03 14:59:52', NULL),
(7, NULL, 164, 'C2021007', 'j', 'l', NULL, NULL, NULL, NULL, NULL, '2021-11-03 16:56:11', '2021-11-03 16:56:11', NULL),
(8, NULL, 164, 'C2021008', 'a', 'o', NULL, NULL, NULL, NULL, NULL, '2021-11-03 17:02:05', '2021-11-03 17:02:05', NULL),
(9, NULL, 164, 'C2021009', 'ore', 'ooire', NULL, NULL, NULL, NULL, NULL, '2021-11-03 17:12:56', '2021-11-03 17:12:56', NULL),
(10, NULL, 164, 'C2021010', 'o', 'o', NULL, NULL, NULL, NULL, NULL, '2021-11-03 21:52:21', '2021-11-03 21:52:21', NULL),
(11, NULL, 164, 'C2021011', 'x', 'y', NULL, NULL, NULL, NULL, NULL, '2021-11-04 10:05:44', '2021-11-04 10:05:44', NULL),
(12, NULL, 164, 'C2021012', 'x', 'y', NULL, NULL, NULL, NULL, NULL, '2021-11-04 10:08:21', '2021-11-04 10:08:21', NULL),
(13, NULL, 164, 'C2021013', 'f', 'f', NULL, NULL, NULL, NULL, NULL, '2021-11-04 10:11:04', '2021-11-04 10:11:04', NULL),
(14, NULL, 164, 'C2021014', 'q', 'q', NULL, NULL, NULL, NULL, NULL, '2021-11-04 10:16:01', '2021-11-04 10:16:01', NULL),
(15, NULL, 164, 'C2021015', 'z', 'z', NULL, NULL, NULL, NULL, NULL, '2021-11-04 10:29:27', '2021-11-04 10:29:27', NULL),
(16, NULL, 164, 'C2021016', 't', 'y', NULL, NULL, NULL, NULL, NULL, '2021-11-04 10:58:22', '2021-11-04 10:58:22', NULL),
(17, NULL, 164, 'C2021017', 'fsadk', 'fñasld', NULL, NULL, NULL, NULL, NULL, '2021-11-05 10:52:25', '2021-11-05 10:52:25', NULL),
(18, NULL, 164, 'C2021018', 'fkooksf', 'jfsdjfsdo', NULL, NULL, NULL, NULL, NULL, '2021-11-05 10:54:57', '2021-11-05 10:54:57', NULL),
(19, NULL, 164, 'C2021019', 'fds', 'fsd', NULL, NULL, NULL, NULL, NULL, '2021-11-05 11:08:19', '2021-11-05 11:08:19', NULL),
(20, NULL, 164, 'C2021020', 'po', 'po', NULL, NULL, NULL, NULL, NULL, '2021-11-05 11:42:22', '2021-11-05 11:42:22', NULL),
(21, NULL, 164, 'C2021021', 'fsd', 'fsd', NULL, NULL, NULL, NULL, NULL, '2021-11-05 11:43:48', '2021-11-05 11:43:48', NULL),
(22, NULL, 164, 'C2021022', 'uhu', 'rwe', NULL, NULL, NULL, NULL, NULL, '2021-11-05 11:53:12', '2021-11-05 11:53:12', NULL),
(23, 1, 164, 'C2021023', 'Emilia', 'Bejar', '1982-11-12', '41331753', 'emisabela@gmail.com', '987 285 985', NULL, '2021-11-05 12:04:44', '2021-11-05 12:04:44', NULL),
(24, NULL, 164, 'C2021024', 'gdsf', 'gfdgs', NULL, NULL, NULL, NULL, NULL, '2021-11-05 12:06:15', '2021-11-05 12:06:15', NULL),
(25, NULL, 164, 'C2021025', 'jjhiuh', 'jnihn', NULL, NULL, NULL, NULL, NULL, '2021-11-05 18:42:20', '2021-11-05 18:42:20', NULL),
(26, 1, 164, 'C2021026', 'Roxana', 'Escate', '2000-12-06', '45479610', 'roxana.escate@gmail.com', '933 999 725', NULL, '2021-11-11 09:15:02', '2021-11-11 09:15:02', NULL),
(27, 1, 164, 'C2021027', 'Jeremías', 'Lora', NULL, '12345678', NULL, '999 992 222', NULL, '2021-12-20 10:14:20', '2021-12-20 10:14:20', NULL),
(28, 1, 164, 'C2021028', 'Jeremías', 'Lora', NULL, '12345679', NULL, '999 992 223', NULL, '2021-12-20 10:17:02', '2021-12-20 10:17:02', NULL),
(29, 1, 164, 'C2021029', 'Jeremías', 'Lora', NULL, '12345677', NULL, '999 992 224', NULL, '2021-12-20 10:17:29', '2021-12-20 10:17:29', NULL),
(30, 1, 164, 'C2021030', 'Leoncio', 'Prado', NULL, '98743543', NULL, '994 732 432', NULL, '2021-12-20 15:07:52', '2021-12-20 15:07:52', NULL),
(31, 1, 164, 'C2021031', 'Maria', 'Roncal', NULL, '12346356', 'mroncal@gmail.com', '942 394 829', NULL, '2021-12-20 15:24:09', '2021-12-20 15:24:09', NULL),
(32, 1, 164, 'C2021032', 'Juan', 'Prieto', NULL, '58974789', 'jprieto@gmail.com', '978 457 957', NULL, '2021-12-20 15:27:18', '2021-12-20 15:27:18', NULL),
(33, 1, 164, 'C2021033', 'X', 'Y', NULL, '88888888', 'x@y.com', '987 657 687', NULL, '2021-12-21 08:44:32', '2021-12-21 08:44:32', NULL),
(34, 1, 164, 'C2021034', 'X', 'Y', NULL, '88888889', 'xy@gmail.com', '987 657 686', NULL, '2021-12-21 08:45:50', '2021-12-21 08:45:50', NULL),
(35, 1, 164, 'C2021035', 'iout', 'ipo', NULL, '99997777', NULL, '985 437 223', NULL, '2021-12-21 09:54:35', '2021-12-21 09:54:35', NULL),
(36, 1, 164, 'C2021036', 'X', 'Y', NULL, '99988243', NULL, '984 784 237', NULL, '2021-12-22 12:56:43', '2021-12-22 12:56:43', NULL),
(37, 1, 164, 'C2021037', 'iotuer', 'oitwu', NULL, '98537544', NULL, '928 443 443', NULL, '2021-12-22 13:34:37', '2021-12-22 13:34:37', NULL),
(38, 1, 164, 'C2021038', 'Talía Ximena', 'Gimenez Lindo', NULL, '70689930', 'taliaoioiu@gmail.com', '991 267 280', '01 632 0902', '2021-12-28 11:42:07', '2021-12-28 11:42:07', NULL),
(39, 1, 164, 'C2021039', 'Diego', 'Nuevo', NULL, '88832323', NULL, '998 432 743', NULL, '2021-12-29 17:24:16', '2021-12-29 17:24:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependents`
--

CREATE TABLE `dependents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dependent_type_id` bigint(20) UNSIGNED NOT NULL,
  `document_type_id` bigint(20) UNSIGNED NOT NULL,
  `gender_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dependents`
--

INSERT INTO `dependents` (`id`, `dependent_type_id`, `document_type_id`, `gender_id`, `user_id`, `name`, `lastname`, `document`, `birthdate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 3, 'Gia Macarena', 'Béjar Escate', '90986140', '2017-11-13', '2021-10-05 22:05:06', '2021-10-05 22:05:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependent_types`
--

CREATE TABLE `dependent_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dependent_types`
--

INSERT INTO `dependent_types` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cónyugue', 'CNY', NULL, NULL, NULL),
(2, 'Hijo(a) menor de edad', 'HME', NULL, NULL, NULL),
(3, 'Hijo(a) cursando estudios superiores', 'HUI', NULL, NULL, NULL),
(4, 'Conviviente', 'CON', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distributions`
--

CREATE TABLE `distributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `origin_id` bigint(20) UNSIGNED NOT NULL,
  `destiny_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `distributions`
--

INSERT INTO `distributions` (`id`, `origin_id`, `destiny_id`, `user_id`, `code`, `date`, `status`, `closed_at`, `verified_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 1, 'DCMS08012201', '2022-01-08 15:07:00', 'VERIFICADA', NULL, '2022-01-08 15:18:55', '2022-01-08 15:08:51', '2022-01-08 15:18:55', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribution_details`
--

CREATE TABLE `distribution_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distribution_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `openstock` int(11) NOT NULL,
  `opendestiny` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `returned` int(11) NOT NULL,
  `checked` tinyint(4) NOT NULL,
  `observation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `distribution_details`
--

INSERT INTO `distribution_details` (`id`, `distribution_id`, `product_id`, `openstock`, `opendestiny`, `quantity`, `received`, `returned`, `checked`, `observation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 9, 50, 0, 20, 20, 0, 1, NULL, '2022-01-08 15:08:51', '2022-01-08 15:18:55', NULL),
(2, 1, 4, 40, 0, 18, 18, 0, 1, NULL, '2022-01-08 15:08:51', '2022-01-08 15:18:56', NULL),
(3, 1, 6, 45, 0, 16, 16, 0, 1, NULL, '2022-01-08 15:08:51', '2022-01-08 15:18:56', NULL),
(4, 1, 5, 40, 0, 14, 14, 0, 1, NULL, '2022-01-08 15:08:51', '2022-01-08 15:18:56', NULL),
(5, 1, 3, 43, 0, 12, 12, 0, 1, NULL, '2022-01-08 15:08:51', '2022-01-08 15:18:56', NULL),
(6, 1, 1, 50, 0, 10, 10, 0, 1, NULL, '2022-01-08 15:08:51', '2022-01-08 15:18:56', NULL),
(7, 1, 2, 48, 0, 8, 8, 0, 1, NULL, '2022-01-08 15:08:51', '2022-01-08 15:18:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_types`
--

CREATE TABLE `document_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  `is_number` tinyint(1) NOT NULL,
  `is_exact` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `document_types`
--

INSERT INTO `document_types` (`id`, `name`, `code`, `length`, `is_number`, `is_exact`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Doc. Nacional de Identidad', '01', 8, 1, 1, NULL, NULL, NULL),
(2, 'Carnet de extranjería', '04', 12, 0, 0, NULL, NULL, NULL),
(3, 'Reg. Único de Contribuyente', '06', 11, 1, 1, NULL, NULL, NULL),
(4, 'Pasaporte', '07', 12, 0, 0, NULL, NULL, NULL),
(5, 'Partida de nacimiento-identidad', '11', 15, 0, 0, NULL, NULL, '2021-05-12 00:00:00'),
(6, 'Otros', '99', 15, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epss`
--

CREATE TABLE `epss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `epss`
--

INSERT INTO `epss` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Básico', 'ABA', NULL, NULL, NULL),
(2, 'Adicional 1', 'AD1', NULL, NULL, NULL),
(3, 'Adicional 2', 'AD2', NULL, NULL, NULL);

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
-- Estructura de tabla para la tabla `frequencies`
--

CREATE TABLE `frequencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `frequencies`
--

INSERT INTO `frequencies` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mensual', '001', NULL, NULL, NULL),
(2, 'Trimestral', '003', NULL, NULL, NULL),
(3, 'Semestral', '006', NULL, NULL, NULL),
(4, 'Anual', '012', NULL, NULL, NULL),
(5, 'No variable', '000', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garbage`
--

CREATE TABLE `garbage` (
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `genders`
--

INSERT INTO `genders` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Femenino', 'FEM', NULL, NULL, NULL),
(2, 'Masculino', 'MAS', NULL, NULL, NULL),
(3, 'Otros', 'OTR', NULL, NULL, NULL),
(4, 'Transgénero', 'BTR', NULL, NULL, '2021-03-03 22:00:00'),
(5, 'Intersexual', 'INT', NULL, NULL, '2021-03-03 22:00:00'),
(6, 'Sin especificar', 'SES', NULL, NULL, '2021-05-11 23:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_details`
--

CREATE TABLE `inventory_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `openstock` int(11) NOT NULL,
  `entry` int(11) NOT NULL,
  `exit` int(11) NOT NULL,
  `returned` int(11) NOT NULL,
  `removed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `ubigeo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_ubigeo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id`, `customer_id`, `ubigeo_id`, `address`, `other_ubigeo`, `ref`, `lat`, `lng`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'cochas 5088 los olivos', 'Algun lugar', '123', -11.9746887, -77.082912, '2021-10-12 12:31:29', '2021-10-18 19:42:28', '2021-10-18 19:42:28'),
(2, 3, NULL, 'calle diamantes los olivos', 'Lima / Lima / San Martín de Porresfsdfsdfsddfsd', 'Referencia', -11.9761054, -77.09547309999999, '2021-10-12 15:49:05', '2021-10-12 15:49:05', NULL),
(3, 1, 1297, 'cochas 5088 los olivos', NULL, '12345', -11.9746887, -77.082912, '2021-10-12 18:17:31', '2021-11-05 12:56:35', '2021-11-05 12:56:35'),
(4, 1, 1315, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-10-12 18:17:31', '2021-11-05 12:56:35', '2021-11-05 12:56:35'),
(5, 1, 1297, 'Yaracmarca 5078, Los Olivos 15306, Perú', NULL, '123', -11.974418, -77.0844954, '2021-10-18 19:42:28', '2021-11-05 12:56:35', '2021-11-05 12:56:35'),
(6, 4, 1320, 'Jirón Ricardo Aicardi 224, Santiago de Surco, Perú', NULL, 'Tocar 2do timbre / Casa', -12.1269448, -76.9930795, '2021-10-19 17:18:38', '2021-10-19 17:18:38', NULL),
(7, 4, 1297, 'calle cochas 5088 los olivos', NULL, 'Casa', -11.9746572, -77.0831347, '2021-10-19 17:18:38', '2021-10-19 17:19:48', '2021-10-19 17:19:48'),
(8, 4, 1297, 'C. 15 7, Lima 15306, Perú', NULL, 'Casa', -11.9729709, -77.0857576, '2021-10-19 17:19:48', '2021-11-05 15:53:37', '2021-11-05 15:53:37'),
(9, 5, 1285, 'Jirón Jorge Chávez 1456, Breña, Perú', NULL, 'Departamento 301 B', -12.0632135, -77.051152, '2021-10-28 18:14:57', '2021-10-28 18:14:57', NULL),
(10, 6, 1297, 'Cochas 5088, Los Olivos, Perú', NULL, NULL, -11.9746572, -77.0831347, '2021-11-03 14:59:53', '2021-11-03 14:59:53', NULL),
(11, 17, 1297, 'cochas 5088 los olivos', NULL, '12345', -11.9746887, -77.082912, '2021-11-05 10:52:25', '2021-11-05 10:52:25', NULL),
(12, 17, 1315, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-11-05 10:52:25', '2021-11-05 10:52:25', NULL),
(13, 17, 1297, 'Yaracmarca 5078, Los Olivos 15306, Perú', NULL, '123', -11.974418, -77.0844954, '2021-11-05 10:52:25', '2021-11-05 10:52:25', NULL),
(14, 18, 1297, 'cochas 5088 los olivos', NULL, '12345', -11.9746887, -77.082912, '2021-11-05 10:54:57', '2021-11-05 10:54:57', NULL),
(15, 18, 1315, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-11-05 10:54:57', '2021-11-05 10:54:57', NULL),
(16, 18, 1297, 'Yaracmarca 5078, Los Olivos 15306, Perú', NULL, '123', -11.974418, -77.0844954, '2021-11-05 10:54:58', '2021-11-05 10:54:58', NULL),
(17, 19, 1297, 'cochas 5088 los olivos', NULL, '12345', -11.9746887, -77.082912, '2021-11-05 11:08:20', '2021-11-05 11:08:20', NULL),
(18, 19, 1315, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-11-05 11:08:20', '2021-11-05 11:08:20', NULL),
(19, 19, 1297, 'Yaracmarca 5078, Los Olivos 15306, Perú', NULL, '123', -11.974418, -77.0844954, '2021-11-05 11:08:20', '2021-11-05 11:08:20', NULL),
(20, 20, 1297, 'cochas 5088 los olivos', NULL, '12345', -11.9746887, -77.082912, '2021-11-05 11:42:22', '2021-11-05 11:42:22', NULL),
(21, 20, 1315, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-11-05 11:42:23', '2021-11-05 11:42:23', NULL),
(22, 20, 1297, 'Yaracmarca 5078, Los Olivos 15306, Perú', NULL, '123', -11.974418, -77.0844954, '2021-11-05 11:42:23', '2021-11-05 11:42:23', NULL),
(23, 22, 1297, 'cochas 5088 los olivos', NULL, '12345', -11.9746887, -77.082912, '2021-11-05 11:53:12', '2021-11-05 11:53:12', NULL),
(24, 22, 1315, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-11-05 11:53:12', '2021-11-05 11:53:12', NULL),
(25, 22, 1297, 'Yaracmarca 5078, Los Olivos 15306, Perú', NULL, '123', -11.974418, -77.0844954, '2021-11-05 11:53:13', '2021-11-05 11:53:13', NULL),
(26, 23, 1297, 'C. 15 7, Lima 15306, Perú', NULL, 'Dep. 2B', -11.9729709, -77.0857576, '2021-11-05 12:04:44', '2021-11-05 12:04:44', NULL),
(27, 1, 1297, 'cochas 5088 los olivos', NULL, '1234567', -11.9746887, -77.082912, '2021-11-05 12:56:35', '2021-11-05 12:56:35', NULL),
(28, 1, 1294, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-11-05 12:56:35', '2021-11-09 21:00:14', '2021-11-09 21:00:14'),
(29, 1, 1315, 'Jiron Monte Blanco 409, San Martín de Porres 15109, Perú', NULL, 'Barrio picante', -11.9776237, -77.0869601, '2021-11-05 12:56:35', '2021-11-09 21:00:14', '2021-11-09 21:00:14'),
(30, 4, 1297, 'C. 15 7, Lima 15306, Perú', NULL, 'Casa blanca, puerta marrón', -11.9729709, -77.0857576, '2021-11-05 15:53:37', '2021-11-05 15:53:37', NULL),
(31, 1, 1315, 'Jaspes mza. Ñ lt 7, San Martín de Porres 15109, Perú', NULL, 'Tocar 2do timbre', -11.9848053, -77.0808804, '2021-11-09 21:00:15', '2021-11-24 12:28:44', NULL),
(32, 1, 1294, 'Santa Patricia, Avenida Flora Tristan, La Molina, Perú', NULL, 'Puerta marrón', -12.0709117, -76.9419144, '2021-11-09 21:00:15', '2021-11-09 21:00:15', NULL),
(33, 26, 1297, 'Complejo Deportivo Huaytapallana, Diamantes, Los Olivos, Perú', NULL, 'Timbre 2B', -11.9860657, -77.07852439999999, '2021-11-11 09:15:02', '2021-11-11 09:15:02', NULL),
(34, 34, 1297, 'av wreerw 98786867', NULL, 'nada', NULL, NULL, '2021-12-21 08:45:50', '2021-12-21 08:45:50', NULL),
(35, 35, 1315, 'C. los Mercurios 264, San Martín de Porres 15109, Perú', NULL, '423423', -11.9852478, -77.0813519, '2021-12-21 09:54:35', '2021-12-21 09:54:35', NULL),
(36, 36, 1297, '2W7C+RW2, Los Olivos 15301, Perú', NULL, 'Reja negra', -11.9854605, -77.0776494, '2021-12-22 12:56:43', '2021-12-22 12:56:43', NULL),
(37, 1, 1315, 'Av. Los Olivos 295, San Martín de Porres 15109, Perú', NULL, 'iijfvifvojfdsvojd', -11.9879422, -77.0837184, '2021-12-22 13:03:24', '2021-12-22 13:03:24', NULL),
(38, 37, 1297, '2W7C+RW2, Los Olivos 15301, Perú', NULL, NULL, -11.9854605, -77.0776494, '2021-12-22 13:34:37', '2021-12-22 13:34:37', NULL),
(39, 1, 1297, 'Granate 15301, Los Olivos 15301, Perú', NULL, 'fsdf', -11.9849374, -77.0781035, '2021-12-27 11:51:28', '2021-12-27 11:51:28', NULL),
(40, 1, 1315, 'C. Camilo Carrillo Mz F1 Lt 11, San Martín de Porres 15109, Perú', NULL, 'poiuytr', -11.9891349, -77.0852483, '2021-12-28 11:02:10', '2021-12-28 11:02:10', NULL),
(41, 1, 1281, 'Moquegua 131, Cercado de Lima 15024, Perú', NULL, 'Puerta marrón', -12.072056, -76.94350320000001, '2021-12-29 17:10:18', '2021-12-29 17:10:18', NULL),
(42, 39, 1294, 'Avenida la Fontana, La Molina, Perú', NULL, NULL, -12.0732418, -76.9497281, '2021-12-29 17:24:16', '2021-12-29 17:24:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_20_170339_create_project_types_table', 1),
(5, '2020_08_20_172143_create_businesses_table', 1),
(7, '2020_08_20_175204_create_projects_table', 1),
(8, '2020_08_20_190956_create_activities_table', 1),
(9, '2014_10_11_000000_create_roles_table', 2),
(10, '2020_08_20_190957_create_breakdowns_table', 2),
(11, '2021_01_12_172143_create_parameters_table', 2),
(12, '2021_01_13_172143_create_ubigeos_table', 3),
(13, '2021_01_13_170339_create_contact_types_table', 4),
(15, '2021_01_13_172143_create_districts_table', 6),
(16, '2021_01_13_170339_create_contacts_table', 7),
(18, '2020_08_20_170339_create_document_types_table', 8),
(20, '2021_01_13_170339_create_banks_table', 9),
(21, '2021_01_13_170339_create_relationships_table', 10),
(29, '2021_01_13_170339_create_profiles_table', 11),
(30, '2021_01_13_170339_create_dependent_types_table', 12),
(31, '2021_01_13_170339_create_dependents_table', 12),
(34, '2021_01_13_170339_create_epss_table', 14),
(35, '2021_01_13_172143_create_countries_table', 15),
(36, '2021_01_13_172143_create_genders_table', 16),
(37, '2021_01_13_170339_create_afps_table', 17),
(38, '2021_01_13_170339_create_commissions_table', 17),
(39, '2021_01_13_172143_create_frequencies_table', 18),
(41, '2021_05_13_170339_create_variations_table', 19),
(44, '2021_05_19_175204_create_visits_table', 20),
(54, '2021_05_25_175204_create_proposals_table', 25),
(67, '2021_06_15_172624_create_suppliers_table', 27),
(68, '2021_06_16_172624_create_freelancers_table', 27),
(69, '2021_01_13_170339_create_exchange_rates_table', 28),
(72, '2021_06_22_170339_create_employees_table', 29),
(73, '2021_09_07_172143_create_ubigeos_table', 29),
(74, '2021_06_22_170339_create_sellers_table', 30),
(75, '2021_05_23_170339_create_currencies_table', 31),
(76, '2021_09_07_170339_create_departments_table', 32),
(77, '2021_05_23_170339_create_types_table', 32),
(79, '2021_06_22_170339_create_independents_table', 33),
(80, '2021_09_01_000000_create_project_user_table', 34),
(83, '2021_09_04_000000_create_tasks_table', 35),
(84, '2021_09_20_172143_create_payment_methods_table', 36),
(94, '2021_10_06_170339_create_races_table', 39),
(95, '2020_08_20_172624_create_customers_table', 40),
(98, '2021_10_12_172624_create_pets_table', 41),
(99, '2021_10_12_172625_create_locations_table', 41),
(100, '2021_10_13_172625_create_centers_table', 42),
(107, '2021_10_13_172626_create_inventories_table', 43),
(108, '2021_10_13_172626_create_inventory_details_table', 43),
(120, '2021_10_15_170338_create_promos_table', 44),
(121, '2021_10_15_170339_create_promo_details_table', 44),
(128, '2021_10_21_172625_create_productions_table', 45),
(129, '2021_10_21_172626_create_production_details_table', 45),
(140, '2021_10_21_172627_create_distributions_table', 46),
(141, '2021_10_21_172628_create_distribution_details_table', 46),
(142, '2021_10_25_172627_create_receptions_table', 47),
(143, '2021_10_25_172628_create_reception_details_table', 47),
(152, '2021_11_10_172626_create_stocks_table', 49),
(153, '2021_11_10_172627_create_stock_details_table', 49),
(160, '2021_11_09_172624_create_sales_table', 50),
(161, '2021_11_09_172625_create_sale_details_table', 50),
(162, '2021_11_21_172625_create_choices_table', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parameters`
--

CREATE TABLE `parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parameters`
--

INSERT INTO `parameters` (`id`, `name`, `description`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'MAXSAL', 'Monto máximo permitido para un salario.', 10000, NULL, NULL, NULL),
(3, 'MONTHS', 'Cantidad de meses mínima permitida para un cambio de sueldo.', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('elopez@preciso.pe', '$2y$10$b4Jk3LKDCwmX18IYk9JjjO0wWQooOSUxTQ7y7oIfdSy7yybqXpJy6', '2021-01-11 14:34:23'),
('bvelasquez@preciso.pe', '$2y$10$4viQLS5CsyCLGAi1wszm3eF9UFk2M1JmYUug2isfN8FYoeoDtmExu', '2021-08-09 12:06:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PLIN', 'M03', NULL, NULL, '2021-10-19 00:00:00'),
(2, 'YAPE', 'M05', NULL, NULL, '2021-10-19 00:00:00'),
(3, 'Efectivo', 'M01', NULL, NULL, NULL),
(4, 'Transferencia bancaria', 'M10', NULL, NULL, NULL),
(5, 'Depósito BCP', 'M06', NULL, NULL, '2021-10-19 00:00:00'),
(6, 'Billetera electrónica', 'M02', NULL, NULL, NULL),
(7, 'Tarjeta de crédito o débito', 'M09', NULL, NULL, NULL),
(8, 'Tarjeta de débido', 'M08', NULL, NULL, '2021-10-19 00:00:00'),
(9, 'Depósito BBVA', 'M07', NULL, NULL, '2021-10-19 00:00:00'),
(10, 'TUNKI', 'M04', NULL, NULL, '2021-10-19 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `race_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `species` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_race` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `observation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pets`
--

INSERT INTO `pets` (`id`, `customer_id`, `race_id`, `name`, `species`, `gender`, `other_race`, `birthdate`, `observation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Taquito', 'Perro', 'Macho', 'Chusquito', NULL, NULL, '2021-10-12 12:31:29', '2021-11-05 12:56:35', '2021-11-05 12:56:35'),
(2, 2, 5, 'Boris', 'Perro', 'Macho', NULL, NULL, NULL, '2021-10-12 15:27:53', '2021-10-12 15:27:53', NULL),
(3, 2, NULL, 'Taquito', 'Gato', 'Hembra', 'Chusquerri', '2021-10-06', 'Flor pálida', '2021-10-12 15:27:54', '2021-10-12 15:27:54', NULL),
(4, 1, 123, 'Boris', 'Perro', 'Macho', NULL, '2000-07-14', 'Perro engreído', '2021-10-12 18:17:31', '2021-10-12 18:26:34', NULL),
(5, 4, 2, 'Taquito', 'Perro', 'Macho', NULL, NULL, NULL, '2021-10-19 17:18:38', '2021-10-19 17:18:38', NULL),
(6, 4, NULL, 'Felix', 'Gato', 'Hembra', 'Nueva raza', '2021-10-13', NULL, '2021-10-19 17:18:38', '2021-10-19 17:19:49', '2021-10-19 17:19:49'),
(7, 4, 54, 'Felix', 'Gato', 'Hembra', NULL, '2021-10-13', NULL, '2021-10-19 17:19:49', '2021-10-19 17:19:49', NULL),
(8, 5, NULL, 'Ñusta', 'Perro', 'Macho', 'No especificó', NULL, NULL, '2021-10-28 18:14:57', '2021-10-28 18:14:57', NULL),
(9, 6, NULL, 'Salma', 'Perro', 'Hembra', 'chusquita', '2020-11-14', NULL, '2021-11-03 14:59:53', '2021-11-03 14:59:53', NULL),
(10, 17, NULL, 'Taquito', 'Perro', 'Macho', 'Chusquito', NULL, NULL, '2021-11-05 10:52:25', '2021-11-05 10:52:25', NULL),
(11, 17, 123, 'Boris', 'Perro', 'Macho', NULL, '2000-07-14', 'Perro engreído', '2021-11-05 10:52:26', '2021-11-05 10:52:26', NULL),
(12, 18, NULL, 'Taquito', 'Perro', 'Macho', 'Chusquito', NULL, NULL, '2021-11-05 10:54:58', '2021-11-05 10:54:58', NULL),
(13, 18, 123, 'Boris', 'Perro', 'Macho', NULL, '2000-07-14', 'Perro engreído', '2021-11-05 10:54:58', '2021-11-05 10:54:58', NULL),
(14, 19, NULL, 'Taquito', 'Perro', 'Macho', 'Chusquito', NULL, NULL, '2021-11-05 11:08:20', '2021-11-05 11:08:20', NULL),
(15, 19, 123, 'Boris', 'Perro', 'Macho', NULL, '2000-07-14', 'Perro engreído', '2021-11-05 11:08:20', '2021-11-05 11:08:20', NULL),
(16, 20, NULL, 'Taquito', 'Perro', 'Macho', 'Chusquito', NULL, NULL, '2021-11-05 11:42:23', '2021-11-05 11:42:23', NULL),
(17, 20, 123, 'Boris', 'Perro', 'Macho', NULL, '2000-07-14', 'Perro engreído', '2021-11-05 11:42:23', '2021-11-05 11:42:23', NULL),
(18, 22, NULL, 'Taquito', 'Perro', 'Macho', 'Chusquito', NULL, NULL, '2021-11-05 11:53:13', '2021-11-05 11:53:13', NULL),
(19, 22, 123, 'Boris', 'Perro', 'Macho', NULL, '2000-07-14', 'Perro engreído', '2021-11-05 11:53:13', '2021-11-05 11:53:13', NULL),
(20, 23, NULL, 'Chuspi', 'Perro', 'Macho', 'Chusquito', NULL, NULL, '2021-11-05 12:04:44', '2021-11-05 12:04:44', NULL),
(21, 1, 343, 'Taquita', 'Gato', 'Hembra', NULL, NULL, NULL, '2021-11-05 12:56:35', '2021-11-05 12:59:43', '2021-11-05 12:59:43'),
(22, 1, 343, 'Taquita', 'Gato', 'Hembra', NULL, '2012-12-12', NULL, '2021-11-05 12:59:43', '2021-11-05 13:00:51', '2021-11-05 13:00:51'),
(23, 1, 343, 'Taquita', 'Gato', 'Hembra', NULL, '2012-12-12', 'kjlfjlkjfkssdsd', '2021-11-05 13:00:51', '2021-11-05 17:46:09', '2021-11-05 17:46:09'),
(24, 1, 343, 'Taquita', 'Gato', 'Hembra', NULL, '2012-12-12', 'Alergia a quedarse solo', '2021-11-05 17:46:09', '2021-11-05 17:46:09', NULL),
(25, 25, 5, 'Boris', 'Perro', 'Macho', NULL, NULL, NULL, '2021-11-05 18:42:20', '2021-11-05 18:42:20', NULL),
(26, 25, NULL, 'Taquito', 'Gato', 'Hembra', 'Chusquerri', '2021-10-06', 'Flor pálida', '2021-11-05 18:42:20', '2021-11-05 18:42:20', NULL),
(27, 26, 7, 'Kioto', 'Perro', 'Hembra', NULL, NULL, NULL, '2021-11-11 09:15:02', '2021-11-11 09:15:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productions`
--

CREATE TABLE `productions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productions`
--

INSERT INTO `productions` (`id`, `center_id`, `user_id`, `code`, `date`, `status`, `closed_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 'PCP121102101', '2021-10-21 12:36:00', 'CONFIRMADA', NULL, '2021-10-21 12:37:49', '2021-10-21 12:38:03', NULL),
(2, 5, 1, 'PCP121102103', '2021-10-21 12:38:00', 'CONFIRMADA', NULL, '2021-10-21 12:38:46', '2021-10-21 12:41:09', NULL),
(3, 6, 1, 'PCP222102101', '2021-10-22 23:00:00', 'CONFIRMADA', NULL, '2021-10-22 23:01:49', '2021-10-22 23:01:49', NULL),
(4, 6, 1, 'PCP222102103', '2021-10-22 23:52:00', 'CONFIRMADA', NULL, '2021-10-22 23:53:35', '2021-10-28 05:02:48', NULL),
(5, 5, 1, 'PCP124102101', '2021-10-24 22:47:00', 'CONFIRMADA', NULL, '2021-10-24 22:50:27', '2021-10-24 22:52:04', '2021-10-24 22:52:04'),
(6, 5, 1, 'PCP124102101', '2021-10-24 22:52:00', 'CONFIRMADA', NULL, '2021-10-24 22:52:53', '2021-10-24 22:52:53', NULL),
(7, 5, 1, 'PCP124102103', '2021-10-24 22:53:00', 'CONFIRMADA', NULL, '2021-10-24 22:56:12', '2021-10-24 23:37:19', NULL),
(8, 5, 1, 'PCP125102101', '2021-10-25 19:16:00', 'CONFIRMADA', NULL, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(9, 6, 1, 'PCP228102101', '2021-10-28 15:17:00', 'CONFIRMADA', NULL, '2021-10-28 15:19:15', '2021-10-28 15:19:38', NULL),
(10, 5, 1, 'PCP128102101', '2021-10-28 17:40:00', 'CONFIRMADA', NULL, '2021-10-28 17:48:23', '2021-10-28 17:48:23', NULL),
(11, 5, 1, 'PCP129122101', '2021-12-29 17:00:00', 'CONFIRMADA', NULL, '2021-12-29 17:01:31', '2021-12-29 17:01:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `production_details`
--

CREATE TABLE `production_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `batch` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `openstock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `removed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `production_details`
--

INSERT INTO `production_details` (`id`, `production_id`, `product_id`, `batch`, `openstock`, `quantity`, `removed`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 9, NULL, 0, 10, 0, '2021-10-21 12:37:49', '2021-10-21 12:37:49', NULL),
(2, 1, 4, NULL, 0, 2, 0, '2021-10-21 12:37:49', '2021-10-21 12:37:49', NULL),
(3, 1, 6, NULL, 0, 30, 0, '2021-10-21 12:37:49', '2021-10-21 12:37:49', NULL),
(4, 1, 5, NULL, 0, 40, 0, '2021-10-21 12:37:49', '2021-10-21 12:37:49', NULL),
(5, 1, 3, NULL, 0, 20, 1, '2021-10-21 12:37:49', '2021-10-21 12:37:49', NULL),
(6, 1, 1, NULL, 0, 10, 0, '2021-10-21 12:37:49', '2021-10-21 12:37:49', NULL),
(7, 1, 2, NULL, 0, 0, 0, '2021-10-21 12:37:49', '2021-10-21 12:37:49', NULL),
(8, 2, 9, NULL, 10, 10, 1, '2021-10-21 12:38:46', '2021-10-21 12:38:46', NULL),
(9, 2, 4, NULL, 2, 0, 0, '2021-10-21 12:38:46', '2021-10-21 12:38:46', NULL),
(10, 2, 6, NULL, 30, 10, 0, '2021-10-21 12:38:47', '2021-10-21 12:38:47', NULL),
(11, 2, 5, NULL, 40, 20, 10, '2021-10-21 12:38:47', '2021-10-21 12:38:47', NULL),
(12, 2, 3, NULL, 19, 11, 0, '2021-10-21 12:38:47', '2021-10-21 12:38:47', NULL),
(13, 2, 1, NULL, 10, 0, 0, '2021-10-21 12:38:47', '2021-10-21 12:38:47', NULL),
(14, 2, 2, NULL, 0, 10, 0, '2021-10-21 12:38:47', '2021-10-21 12:38:47', NULL),
(15, 3, 9, NULL, 0, 5, 0, '2021-10-22 23:01:49', '2021-10-22 23:01:49', NULL),
(16, 3, 4, NULL, 0, 10, 0, '2021-10-22 23:01:49', '2021-10-22 23:01:49', NULL),
(17, 3, 6, NULL, 0, 12, 0, '2021-10-22 23:01:50', '2021-10-22 23:01:50', NULL),
(18, 3, 5, NULL, 0, 15, 0, '2021-10-22 23:01:50', '2021-10-22 23:01:50', NULL),
(19, 3, 3, NULL, 0, 18, 0, '2021-10-22 23:01:50', '2021-10-22 23:01:50', NULL),
(20, 3, 1, NULL, 0, 10, 0, '2021-10-22 23:01:50', '2021-10-22 23:01:50', NULL),
(21, 3, 2, NULL, 0, 20, 0, '2021-10-22 23:01:50', '2021-10-22 23:01:50', NULL),
(22, 4, 9, '', 5, 1, 0, '2021-10-22 23:53:35', '2021-10-27 14:15:01', NULL),
(23, 4, 4, '456', 10, 2, 1, '2021-10-22 23:53:35', '2021-10-27 14:15:01', NULL),
(24, 4, 6, '123456', 12, 3, 0, '2021-10-22 23:53:35', '2021-10-27 14:34:56', NULL),
(25, 4, 5, '987', 15, 4, 1, '2021-10-22 23:53:36', '2021-10-27 14:15:01', NULL),
(26, 4, 3, '9827', 18, 5, 0, '2021-10-22 23:53:36', '2021-10-27 14:34:56', NULL),
(27, 4, 1, '', 10, 8, 0, '2021-10-22 23:53:36', '2021-10-27 14:15:01', NULL),
(28, 4, 2, '12/34665', 20, 8, 0, '2021-10-22 23:53:36', '2021-10-27 14:34:57', NULL),
(29, 5, 9, NULL, 19, 5, 0, '2021-10-24 22:50:27', '2021-10-24 22:51:01', '2021-10-24 22:51:01'),
(30, 5, 4, NULL, 0, 20, 0, '2021-10-24 22:50:27', '2021-10-24 22:51:01', '2021-10-24 22:51:01'),
(31, 5, 6, NULL, 40, 0, 0, '2021-10-24 22:50:27', '2021-10-24 22:51:01', '2021-10-24 22:51:01'),
(32, 5, 5, NULL, 25, 0, 0, '2021-10-24 22:50:27', '2021-10-24 22:51:01', '2021-10-24 22:51:01'),
(33, 5, 3, NULL, 15, 5, 0, '2021-10-24 22:50:27', '2021-10-24 22:51:01', '2021-10-24 22:51:01'),
(34, 5, 1, NULL, 0, 20, 0, '2021-10-24 22:50:27', '2021-10-24 22:51:01', '2021-10-24 22:51:01'),
(35, 5, 2, NULL, 0, 20, 0, '2021-10-24 22:50:27', '2021-10-24 22:51:01', '2021-10-24 22:51:01'),
(36, 5, 9, NULL, 19, 0, 0, '2021-10-24 22:51:01', '2021-10-24 22:52:03', '2021-10-24 22:52:03'),
(37, 5, 4, NULL, 0, 0, 0, '2021-10-24 22:51:01', '2021-10-24 22:52:03', '2021-10-24 22:52:03'),
(38, 5, 6, NULL, 40, 0, 0, '2021-10-24 22:51:01', '2021-10-24 22:52:04', '2021-10-24 22:52:04'),
(39, 5, 5, NULL, 25, 0, 0, '2021-10-24 22:51:01', '2021-10-24 22:52:04', '2021-10-24 22:52:04'),
(40, 5, 3, NULL, 15, 0, 0, '2021-10-24 22:51:01', '2021-10-24 22:52:04', '2021-10-24 22:52:04'),
(41, 5, 1, NULL, 0, 0, 0, '2021-10-24 22:51:02', '2021-10-24 22:52:04', '2021-10-24 22:52:04'),
(42, 5, 2, NULL, 0, 0, 0, '2021-10-24 22:51:02', '2021-10-24 22:52:04', '2021-10-24 22:52:04'),
(43, 6, 9, NULL, 19, 1, 0, '2021-10-24 22:52:53', '2021-10-24 22:52:53', NULL),
(44, 6, 4, NULL, 0, 20, 0, '2021-10-24 22:52:53', '2021-10-24 22:52:53', NULL),
(45, 6, 6, NULL, 40, 0, 0, '2021-10-24 22:52:53', '2021-10-24 22:52:53', NULL),
(46, 6, 5, NULL, 25, 0, 0, '2021-10-24 22:52:53', '2021-10-24 22:52:53', NULL),
(47, 6, 3, NULL, 15, 5, 0, '2021-10-24 22:52:53', '2021-10-24 22:52:53', NULL),
(48, 6, 1, NULL, 0, 20, 0, '2021-10-24 22:52:53', '2021-10-24 22:52:53', NULL),
(49, 6, 2, NULL, 0, 20, 0, '2021-10-24 22:52:54', '2021-10-24 22:52:54', NULL),
(50, 7, 9, NULL, 20, 0, 0, '2021-10-24 22:56:12', '2021-10-24 22:56:12', NULL),
(51, 7, 4, NULL, 20, 10, 0, '2021-10-24 22:56:12', '2021-10-24 22:56:12', NULL),
(52, 7, 6, NULL, 40, 0, 0, '2021-10-24 22:56:12', '2021-10-24 22:56:12', NULL),
(53, 7, 5, NULL, 25, 5, 0, '2021-10-24 22:56:12', '2021-10-24 22:56:12', NULL),
(54, 7, 3, NULL, 20, 10, 0, '2021-10-24 22:56:12', '2021-10-24 22:56:12', NULL),
(55, 7, 1, NULL, 20, 10, 0, '2021-10-24 22:56:12', '2021-10-24 22:56:12', NULL),
(56, 7, 2, NULL, 20, 0, 0, '2021-10-24 22:56:12', '2021-10-24 22:56:12', NULL),
(57, 8, 9, NULL, 20, 10, 0, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(58, 8, 4, NULL, 10, 0, 0, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(59, 8, 6, NULL, 25, 0, 0, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(60, 8, 5, NULL, 20, 0, 0, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(61, 8, 3, NULL, 16, 10, 0, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(62, 8, 1, NULL, 20, 10, 0, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(63, 8, 2, NULL, 18, 0, 0, '2021-10-25 19:17:06', '2021-10-25 19:17:06', NULL),
(64, 9, 9, 'WEWEWQ', 6, 14, 0, '2021-10-28 15:19:15', '2021-10-28 15:19:15', NULL),
(65, 9, 4, '3431241234', 11, 19, 0, '2021-10-28 15:19:16', '2021-10-28 15:19:16', NULL),
(66, 9, 6, '13131312', 15, 15, 0, '2021-10-28 15:19:16', '2021-10-28 15:19:16', NULL),
(67, 9, 5, '948489483', 18, 12, 0, '2021-10-28 15:19:16', '2021-10-28 15:19:16', NULL),
(68, 9, 3, '93939832', 23, 7, 0, '2021-10-28 15:19:17', '2021-10-28 15:19:17', NULL),
(69, 9, 1, '6464564', 18, 12, 0, '2021-10-28 15:19:17', '2021-10-28 15:19:17', NULL),
(70, 9, 2, 'REWRER544', 28, 2, 0, '2021-10-28 15:19:17', '2021-10-28 15:19:17', NULL),
(71, 10, 9, '', 30, 0, 0, '2021-10-28 17:48:23', '2021-10-28 17:48:23', NULL),
(72, 10, 4, '123456', 0, 20, 0, '2021-10-28 17:48:23', '2021-10-28 17:48:23', NULL),
(73, 10, 6, '', 25, 0, 0, '2021-10-28 17:48:23', '2021-10-28 17:48:23', NULL),
(74, 10, 5, '', 20, 0, 0, '2021-10-28 17:48:23', '2021-10-28 17:48:23', NULL),
(75, 10, 3, '7895894', 26, 15, 0, '2021-10-28 17:48:24', '2021-10-28 17:48:24', NULL),
(76, 10, 1, '', 30, 0, 0, '2021-10-28 17:48:24', '2021-10-28 17:48:24', NULL),
(77, 10, 2, '84384934789', 18, 10, 0, '2021-10-28 17:48:24', '2021-10-28 17:48:24', NULL),
(78, 11, 9, 'dasd', 30, 20, 0, '2021-12-29 17:01:31', '2021-12-29 17:01:31', NULL),
(79, 11, 4, 'sdfs', 20, 20, 0, '2021-12-29 17:01:31', '2021-12-29 17:01:31', NULL),
(80, 11, 6, 'iur', 25, 20, 0, '2021-12-29 17:01:31', '2021-12-29 17:01:31', NULL),
(81, 11, 5, 'kjw', 20, 20, 0, '2021-12-29 17:01:32', '2021-12-29 17:01:32', NULL),
(82, 11, 3, 'jkfsld', 41, 2, 0, '2021-12-29 17:01:32', '2021-12-29 17:01:32', NULL),
(83, 11, 1, 'flksd', 30, 20, 0, '2021-12-29 17:01:32', '2021-12-29 17:01:32', NULL),
(84, 11, 2, 'lfskdj', 28, 20, 0, '2021-12-29 17:01:32', '2021-12-29 17:01:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `price`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'P2021001', 'Pollo', 16.50, 'Una bola de 800g con 16 albóndigas', '2020-10-21 16:27:20', '2021-12-29 16:16:12', NULL),
(2, 'P2021002', 'Res', 16.50, 'Una bolsa de 800g con 16 albóndigas', '2020-10-21 16:27:20', '2021-12-29 16:16:40', NULL),
(3, 'P2021003', 'Pavo', 18.00, 'Una bolsa de 800g con 16 albóndigas', '2020-10-21 16:27:20', '2021-12-29 16:17:21', NULL),
(4, 'P2021004', 'Gato', 18.00, 'Una bolsa de 800g con 16 albóndigas', '2020-10-21 16:27:20', '2021-12-29 16:18:25', NULL),
(5, 'P2021005', 'Hueso S', 8.00, 'Juguete para dientes tamaño small de aprox. 180g', '2020-10-21 16:27:20', '2021-12-29 16:20:24', NULL),
(6, 'P2021006', 'Hueso L', 11.00, 'Juguete para dientes tamaño large de aprox. 250g', '2020-10-21 16:27:20', '2021-12-29 16:20:04', NULL),
(7, 'P2021007', 'jsmsfkm sflkma', 12.35, NULL, '2021-09-28 23:29:52', '2021-09-29 00:17:19', '2021-09-29 00:17:19'),
(8, 'P2021007', 'fjeojfocudmcksmcllsdwucu8u  dcncds csdcsdc sc dsc', 1000.00, 'dsdsdsdsdsoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', '2021-10-13 04:28:09', '2021-10-13 04:34:43', '2021-10-13 04:34:43'),
(9, 'P2021007', 'Cordero', 18.00, 'Una bola de 500g con 10 albóndigas', '2021-10-19 17:20:51', '2021-12-29 16:20:56', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `code`, `type`, `salary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vendedor', 'P01', 'C', 0, NULL, NULL, NULL),
(2, 'Servicio 1', 'P02', 'S', 0, NULL, NULL, NULL),
(3, 'Servicio 2', 'P03', 'S', 0, NULL, NULL, NULL),
(4, 'Otros', 'OTR', 'X', 0, NULL, NULL, NULL),
(5, 'Responsable de tienda / centro de producción', 'P04', 'C', 0, NULL, NULL, NULL),
(6, 'Responsable de cuentas', 'P05', 'C', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promos`
--

CREATE TABLE `promos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promos`
--

INSERT INTO `promos` (`id`, `code`, `name`, `start_at`, `end_at`, `type`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'O2021001', 'Nueva promoción', '2021-10-24', '2021-10-25', 'P', 70.00, '2021-10-18 15:39:27', '2021-10-18 18:33:57', NULL),
(2, 'O2021002', 'Nuevecita x2', '2021-11-01', '2021-11-06', 'M', 25.00, '2021-10-18 18:38:29', '2021-10-18 18:39:34', NULL),
(3, 'O2021003', 'kñlklñkk', '2021-10-19', '2021-10-20', 'P', 10.00, '2021-10-19 13:28:33', '2021-10-19 13:28:33', NULL),
(4, 'O2021004', 'Res + Pollo + Pavo', '2021-10-14', '2021-12-28', 'M', 75.00, '2021-10-19 17:38:34', '2021-12-29 16:22:02', NULL),
(5, 'O2021005', '3x35', '2021-10-19', '2021-10-20', 'M', 35.00, '2021-10-19 17:41:43', '2021-10-19 17:41:43', NULL),
(6, 'O2021006', '3x35', '2021-10-21', '2021-10-21', 'M', 35.00, '2021-10-21 04:30:20', '2021-10-21 04:35:45', '2021-10-22 00:00:00'),
(7, 'O2021007', '3x35', '2021-10-21', '2021-10-22', 'M', 35.00, '2021-10-21 04:32:24', '2021-10-21 04:35:51', '2021-10-21 04:35:51'),
(8, 'O2021008', '3x35', '2021-10-21', '2021-10-23', 'M', 35.00, '2021-10-21 04:35:20', '2021-10-21 04:35:20', NULL),
(9, 'O2021009', '4x30soles', '2021-10-25', '2021-10-26', 'M', 30.00, '2021-10-25 19:27:32', '2021-10-25 19:27:32', NULL),
(10, 'O2021010', 'Sixpack', '2021-12-01', '2021-12-28', 'M', 30.00, '2021-10-28 18:17:43', '2021-12-29 16:23:08', NULL),
(11, 'O2021011', 'Promo hueso', '2021-11-23', '2021-11-30', 'M', 25.00, '2021-11-23 20:37:38', '2021-11-23 20:37:38', NULL),
(12, 'O2021012', 'Tres sabores', '2021-12-20', '2021-12-28', 'M', 30.00, '2021-12-20 15:18:43', '2021-12-29 16:23:21', NULL),
(13, 'O2021013', 'Tripack', '2021-12-29', '2022-06-30', 'M', 45.00, '2021-12-29 16:22:48', '2021-12-29 16:22:48', NULL),
(14, 'O2021014', 'Tripack + hueso', '2021-12-29', '2022-06-30', 'M', 50.00, '2021-12-29 16:25:11', '2021-12-29 16:25:27', NULL),
(15, 'O2021015', 'Pack del ahorro', '2021-12-29', '2022-06-30', 'M', 135.00, '2021-12-29 16:27:28', '2021-12-29 16:27:28', NULL),
(16, 'O2021016', 'Superpack', '2021-12-29', '2022-06-30', 'M', 240.00, '2021-12-29 16:27:59', '2021-12-29 16:27:59', NULL),
(17, 'O2021017', 'Minipack', '2021-12-29', '2022-06-30', 'M', 70.00, '2021-12-29 16:29:01', '2021-12-29 16:29:01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promo_details`
--

CREATE TABLE `promo_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promo_details`
--

INSERT INTO `promo_details` (`id`, `promo_id`, `product_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, 4, '2021-10-18 15:39:27', '2021-10-18 18:33:57', NULL),
(2, 1, 2, 1, '2021-10-18 15:39:27', '2021-10-18 18:33:57', NULL),
(3, 1, 1, 6, '2021-10-18 17:23:23', '2021-10-18 18:33:57', NULL),
(4, 2, 5, 1, '2021-10-18 18:38:29', '2021-10-18 18:38:29', NULL),
(5, 2, 6, 1, '2021-10-18 18:38:29', '2021-10-18 18:38:29', NULL),
(6, 3, 6, 1, '2021-10-19 13:28:34', '2021-10-19 13:28:34', NULL),
(7, 3, 2, 3, '2021-10-19 13:28:34', '2021-10-19 13:28:34', NULL),
(8, 4, 2, 1, '2021-10-19 17:38:34', '2021-10-19 17:38:34', NULL),
(9, 4, 3, 2, '2021-10-19 17:38:34', '2021-10-19 17:38:34', NULL),
(10, 4, 1, 3, '2021-10-19 17:38:34', '2021-10-19 17:38:34', NULL),
(11, 5, 9, 3, '2021-10-19 17:41:44', '2021-10-19 17:41:44', NULL),
(12, 8, NULL, 3, '2021-10-21 04:35:20', '2021-10-21 04:35:20', NULL),
(13, 9, NULL, 4, '2021-10-25 19:27:32', '2021-10-25 19:27:32', NULL),
(14, 10, 3, 3, '2021-10-28 18:17:43', '2021-11-21 23:42:43', '2021-11-21 23:42:43'),
(15, 10, NULL, 6, '2021-11-21 23:42:43', '2021-11-21 23:42:43', NULL),
(16, 11, 5, 2, '2021-11-23 20:37:38', '2021-11-23 20:37:38', NULL),
(17, 12, NULL, 3, '2021-12-20 15:18:43', '2021-12-20 15:18:43', NULL),
(18, 13, NULL, 3, '2021-12-29 16:22:48', '2021-12-29 16:22:48', NULL),
(19, 14, NULL, 3, '2021-12-29 16:25:11', '2021-12-29 16:25:11', NULL),
(20, 14, 6, 1, '2021-12-29 16:25:11', '2021-12-29 16:25:11', NULL),
(21, 15, NULL, 10, '2021-12-29 16:27:28', '2021-12-29 16:27:28', NULL),
(22, 15, 6, 1, '2021-12-29 16:27:29', '2021-12-29 16:27:29', NULL),
(23, 16, NULL, 20, '2021-12-29 16:27:59', '2021-12-29 16:27:59', NULL),
(24, 17, NULL, 5, '2021-12-29 16:29:01', '2021-12-29 16:29:01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `races`
--

CREATE TABLE `races` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `races`
--

INSERT INTO `races` (`id`, `code`, `name`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'R0001', 'Otras', 'X', NULL, NULL, NULL),
(2, 'R0002', 'Mestizo (cruce)', 'X', NULL, NULL, NULL),
(3, 'R0003', 'Affenpinscher', 'P', NULL, NULL, NULL),
(4, 'R0004', 'Airedale terrier', 'P', NULL, NULL, NULL),
(5, 'R0005', 'Akita', 'P', NULL, NULL, NULL),
(6, 'R0006', 'Akita americano', 'P', NULL, NULL, NULL),
(7, 'R0007', 'Alaskan Husky', 'P', NULL, NULL, NULL),
(8, 'R0008', 'Alaskan malamute', 'P', NULL, NULL, NULL),
(9, 'R0009', 'American Foxhound', 'P', NULL, NULL, NULL),
(10, 'R0010', 'American pit bull terrier', 'P', NULL, NULL, NULL),
(11, 'R0011', 'American staffordshire terrier', 'P', NULL, NULL, NULL),
(12, 'R0012', 'Ariegeois', 'P', NULL, NULL, NULL),
(13, 'R0013', 'Artois', 'P', NULL, NULL, NULL),
(14, 'R0014', 'Australian silky terrier', 'P', NULL, NULL, NULL),
(15, 'R0015', 'Australian Terrier', 'P', NULL, NULL, NULL),
(16, 'R0016', 'Austrian Black & Tan Hound', 'P', NULL, NULL, NULL),
(17, 'R0017', 'Azawakh', 'P', NULL, NULL, NULL),
(18, 'R0018', 'Balkan Hound', 'P', NULL, NULL, NULL),
(19, 'R0019', 'Basenji', 'P', NULL, NULL, NULL),
(20, 'R0020', 'Basset Alpino', 'P', NULL, NULL, NULL),
(21, 'R0021', 'Basset Artesiano Normando', 'P', NULL, NULL, NULL),
(22, 'R0022', 'Basset Azul de Gascuña', 'P', NULL, NULL, NULL),
(23, 'R0023', 'Basset de Artois', 'P', NULL, NULL, NULL),
(24, 'R0024', 'Basset de Westphalie', 'P', NULL, NULL, NULL),
(25, 'R0025', 'Basset Hound', 'P', NULL, NULL, NULL),
(26, 'R0026', 'Basset Leonado de Bretaña', 'P', NULL, NULL, NULL),
(27, 'R0027', 'Bavarian Mountain Scenthound', 'P', NULL, NULL, NULL),
(28, 'R0028', 'Beagle', 'P', NULL, NULL, NULL),
(29, 'R0029', 'Beagle Harrier', 'P', NULL, NULL, NULL),
(30, 'R0030', 'Beauceron', 'P', NULL, NULL, NULL),
(31, 'R0031', 'Bedlington Terrier', 'P', NULL, NULL, NULL),
(32, 'R0032', 'Bichon Boloñes', 'P', NULL, NULL, NULL),
(33, 'R0033', 'Bichón Frisé', 'P', NULL, NULL, NULL),
(34, 'R0034', 'Bichón Habanero', 'P', NULL, NULL, NULL),
(35, 'R0035', 'Billy', 'P', NULL, NULL, NULL),
(36, 'R0036', 'Black and Tan Coonhound', 'P', NULL, NULL, NULL),
(37, 'R0037', 'Bloodhound (Sabueso de San Huberto)', 'P', NULL, NULL, NULL),
(38, 'R0038', 'Bobtail', 'P', NULL, NULL, NULL),
(39, 'R0039', 'Boerboel', 'P', NULL, NULL, NULL),
(40, 'R0040', 'Border Collie', 'P', NULL, NULL, NULL),
(41, 'R0041', 'Border terrier', 'P', NULL, NULL, NULL),
(42, 'R0042', 'Borzoi', 'P', NULL, NULL, NULL),
(43, 'R0043', 'Bosnian Hound', 'P', NULL, NULL, NULL),
(44, 'R0044', 'Boston terrier', 'P', NULL, NULL, NULL),
(45, 'R0045', 'Bouvier des Flandres', 'P', NULL, NULL, NULL),
(46, 'R0046', 'Boxer', 'P', NULL, NULL, NULL),
(47, 'R0047', 'Boyero de Appenzell', 'P', NULL, NULL, NULL),
(48, 'R0048', 'Boyero de Australia', 'P', NULL, NULL, NULL),
(49, 'R0049', 'Boyero de Entlebuch', 'P', NULL, NULL, NULL),
(50, 'R0050', 'Boyero de las Ardenas', 'P', NULL, NULL, NULL),
(51, 'R0051', 'Boyero de Montaña Bernes', 'P', NULL, NULL, NULL),
(52, 'R0052', 'Braco Alemán de pelo corto', 'P', NULL, NULL, NULL),
(53, 'R0053', 'Braco Alemán de pelo duro', 'P', NULL, NULL, NULL),
(54, 'R0054', 'Braco de Ariege', 'P', NULL, NULL, NULL),
(55, 'R0055', 'Braco de Auvernia', 'P', NULL, NULL, NULL),
(56, 'R0056', 'Braco de Bourbonnais', 'P', NULL, NULL, NULL),
(57, 'R0057', 'Braco de Saint Germain', 'P', NULL, NULL, NULL),
(58, 'R0058', 'Braco Dupuy', 'P', NULL, NULL, NULL),
(59, 'R0059', 'Braco Francés', 'P', NULL, NULL, NULL),
(60, 'R0060', 'Braco Italiano', 'P', NULL, NULL, NULL),
(61, 'R0061', 'Broholmer', 'P', NULL, NULL, NULL),
(62, 'R0062', 'Buhund Noruego', 'P', NULL, NULL, NULL),
(63, 'R0063', 'Bull terrier', 'P', NULL, NULL, NULL),
(64, 'R0064', 'Bulldog americano', 'P', NULL, NULL, NULL),
(65, 'R0065', 'Bulldog inglés', 'P', NULL, NULL, NULL),
(66, 'R0066', 'Bulldog francés', 'P', NULL, NULL, NULL),
(67, 'R0067', 'Bullmastiff', 'P', NULL, NULL, NULL),
(68, 'R0068', 'Ca de Bestiar', 'P', NULL, NULL, NULL),
(69, 'R0069', 'Cairn terrier', 'P', NULL, NULL, NULL),
(70, 'R0070', 'Cane Corso', 'P', NULL, NULL, NULL),
(71, 'R0071', 'Cane da Pastore Maremmano-Abruzzese', 'P', NULL, NULL, NULL),
(72, 'R0072', 'Caniche (Poodle)', 'P', NULL, NULL, NULL),
(73, 'R0073', 'Caniche Toy (Toy Poodle)', 'P', NULL, NULL, NULL),
(74, 'R0074', 'Cao da Serra de Aires', 'P', NULL, NULL, NULL),
(75, 'R0075', 'Cao da Serra de Estrela', 'P', NULL, NULL, NULL),
(76, 'R0076', 'Cao de Castro Laboreiro', 'P', NULL, NULL, NULL),
(77, 'R0077', 'Cao de Fila de Sao Miguel', 'P', NULL, NULL, NULL),
(78, 'R0078', 'Cavalier King Charles Spaniel', 'P', NULL, NULL, NULL),
(79, 'R0079', 'Cesky Fousek', 'P', NULL, NULL, NULL),
(80, 'R0080', 'Cesky Terrier', 'P', NULL, NULL, NULL),
(81, 'R0081', 'Chesapeake Bay Retriever', 'P', NULL, NULL, NULL),
(82, 'R0082', 'Chihuahua', 'P', NULL, NULL, NULL),
(83, 'R0083', 'Chin', 'P', NULL, NULL, NULL),
(84, 'R0084', 'Chow Chow', 'P', NULL, NULL, NULL),
(85, 'R0085', 'Cirneco del Etna', 'P', NULL, NULL, NULL),
(86, 'R0086', 'Clumber Spaniel', 'P', NULL, NULL, NULL),
(87, 'R0087', 'Cocker Spaniel Americano', 'P', NULL, NULL, NULL),
(88, 'R0088', 'Cocker Spaniel Inglés', 'P', NULL, NULL, NULL),
(89, 'R0089', 'Collie Barbudo', 'P', NULL, NULL, NULL),
(90, 'R0090', 'Collie de Pelo Cort', 'P', NULL, NULL, NULL),
(91, 'R0091', 'Collie de Pelo Largo', 'P', NULL, NULL, NULL),
(92, 'R0092', 'Cotón de Tuléar', 'P', NULL, NULL, NULL),
(93, 'R0093', 'Curly Coated Retriever', 'P', NULL, NULL, NULL),
(94, 'R0094', 'Dálmata', 'P', NULL, NULL, NULL),
(95, 'R0095', 'Dandie dinmont terrier', 'P', NULL, NULL, NULL),
(96, 'R0096', 'Deerhound', 'P', NULL, NULL, NULL),
(97, 'R0097', 'Dobermann', 'P', NULL, NULL, NULL),
(98, 'R0098', 'Dogo Argentino', 'P', NULL, NULL, NULL),
(99, 'R0099', 'Dogo de Burdeos', 'P', NULL, NULL, NULL),
(100, 'R0100', 'Dogo del Tibet', 'P', NULL, NULL, NULL),
(101, 'R0101', 'Drentse Partridge Dog', 'P', NULL, NULL, NULL),
(102, 'R0102', 'Drever', 'P', NULL, NULL, NULL),
(103, 'R0103', 'Dunker', 'P', NULL, NULL, NULL),
(104, 'R0104', 'Elkhound Noruego', 'P', NULL, NULL, NULL),
(105, 'R0105', 'Elkhound Sueco', 'P', NULL, NULL, NULL),
(106, 'R0106', 'English Foxhound', 'P', NULL, NULL, NULL),
(107, 'R0107', 'English Springer Spaniel', 'P', NULL, NULL, NULL),
(108, 'R0108', 'English Toy Terrier', 'P', NULL, NULL, NULL),
(109, 'R0109', 'Epagneul Picard', 'P', NULL, NULL, NULL),
(110, 'R0110', 'Eurasier', 'P', NULL, NULL, NULL),
(111, 'R0111', 'Fila Brasileiro', 'P', NULL, NULL, NULL),
(112, 'R0112', 'Finnish Lapphound', 'P', NULL, NULL, NULL),
(113, 'R0113', 'Flat Coated Retriever', 'P', NULL, NULL, NULL),
(114, 'R0114', 'Fox terrier de pelo de alambre', 'P', NULL, NULL, NULL),
(115, 'R0115', 'Fox terrier de pelo liso', 'P', NULL, NULL, NULL),
(116, 'R0116', 'Foxhound Inglés', 'P', NULL, NULL, NULL),
(117, 'R0117', 'Frisian Pointer', 'P', NULL, NULL, NULL),
(118, 'R0118', 'Galgo Español', 'P', NULL, NULL, NULL),
(119, 'R0119', 'Galgo húngaro (Magyar Agar)', 'P', NULL, NULL, NULL),
(120, 'R0120', 'Galgo Italiano', 'P', NULL, NULL, NULL),
(121, 'R0121', 'Galgo Polaco (Chart Polski)', 'P', NULL, NULL, NULL),
(122, 'R0122', 'Glen of Imaal Terrier', 'P', NULL, NULL, NULL),
(123, 'R0123', 'Golden Retriever', 'P', NULL, NULL, NULL),
(124, 'R0124', 'Gordon Setter', 'P', NULL, NULL, NULL),
(125, 'R0125', 'Gos dAtura Catalá', 'P', NULL, NULL, NULL),
(126, 'R0126', 'Gran Basset Griffon Vendeano', 'P', NULL, NULL, NULL),
(127, 'R0127', 'Gran Boyero Suizo', 'P', NULL, NULL, NULL),
(128, 'R0128', 'Gran Danés (Dogo Aleman)', 'P', NULL, NULL, NULL),
(129, 'R0129', 'Gran Gascón Saintongeois', 'P', NULL, NULL, NULL),
(130, 'R0130', 'Gran Griffon Vendeano', 'P', NULL, NULL, NULL),
(131, 'R0131', 'Gran Munsterlander', 'P', NULL, NULL, NULL),
(132, 'R0132', 'Gran Perro Japonés', 'P', NULL, NULL, NULL),
(133, 'R0133', 'Grand Anglo Francais Tricoleur', 'P', NULL, NULL, NULL),
(134, 'R0134', 'Grand Bleu de Gascogne', 'P', NULL, NULL, NULL),
(135, 'R0135', 'Greyhound', 'P', NULL, NULL, NULL),
(136, 'R0136', 'Griffon Bleu de Gascogne', 'P', NULL, NULL, NULL),
(137, 'R0137', 'Griffon de pelo duro', 'P', NULL, NULL, NULL),
(138, 'R0138', 'Griffon leonado de Bretaña', 'P', NULL, NULL, NULL),
(139, 'R0139', 'Griffon Nivernais', 'P', NULL, NULL, NULL),
(140, 'R0140', 'Grifon Belga', 'P', NULL, NULL, NULL),
(141, 'R0141', 'Grifón de Bruselas', 'P', NULL, NULL, NULL),
(142, 'R0142', 'Haldenstoever', 'P', NULL, NULL, NULL),
(143, 'R0143', 'Harrier', 'P', NULL, NULL, NULL),
(144, 'R0144', 'Hokkaido', 'P', NULL, NULL, NULL),
(145, 'R0145', 'Hovawart', 'P', NULL, NULL, NULL),
(146, 'R0146', 'Husky Siberiano', 'P', NULL, NULL, NULL),
(147, 'R0147', 'Ioujnorousskaia Ovtcharka', 'P', NULL, NULL, NULL),
(148, 'R0148', 'Irish Glen of Imaal terrier', 'P', NULL, NULL, NULL),
(149, 'R0149', 'Irish soft coated wheaten terrier', 'P', NULL, NULL, NULL),
(150, 'R0150', 'Irish terrier', 'P', NULL, NULL, NULL),
(151, 'R0151', 'Irish Water Spaniel', 'P', NULL, NULL, NULL),
(152, 'R0152', 'Irish Wolfhound', 'P', NULL, NULL, NULL),
(153, 'R0153', 'Jack Russell terrier', 'P', NULL, NULL, NULL),
(154, 'R0154', 'Jindo Coreano', 'P', NULL, NULL, NULL),
(155, 'R0155', 'Kai', 'P', NULL, NULL, NULL),
(156, 'R0156', 'Keeshond', 'P', NULL, NULL, NULL),
(157, 'R0157', 'Kelpie australiano', 'P', NULL, NULL, NULL),
(158, 'R0158', 'Kerry blue terrier', 'P', NULL, NULL, NULL),
(159, 'R0159', 'King Charles Spaniel', 'P', NULL, NULL, NULL),
(160, 'R0160', 'Kishu', 'P', NULL, NULL, NULL),
(161, 'R0161', 'Komondor', 'P', NULL, NULL, NULL),
(162, 'R0162', 'Kooiker', 'P', NULL, NULL, NULL),
(163, 'R0163', 'Kromfohrländer', 'P', NULL, NULL, NULL),
(164, 'R0164', 'Kuvasz', 'P', NULL, NULL, NULL),
(165, 'R0165', 'Labrador Retriever', 'P', NULL, NULL, NULL),
(166, 'R0166', 'Lagotto Romagnolo', 'P', NULL, NULL, NULL),
(167, 'R0167', 'Laika de Siberia Occidental', 'P', NULL, NULL, NULL),
(168, 'R0168', 'Laika de Siberia Oriental', 'P', NULL, NULL, NULL),
(169, 'R0169', 'Laika Ruso Europeo', 'P', NULL, NULL, NULL),
(170, 'R0170', 'Lakeland terrier', 'P', NULL, NULL, NULL),
(171, 'R0171', 'Landseer', 'P', NULL, NULL, NULL),
(172, 'R0172', 'Lapphund Sueco', 'P', NULL, NULL, NULL),
(173, 'R0173', 'Lebrel Afgano', 'P', NULL, NULL, NULL),
(174, 'R0174', 'Lebrel Arabe (Sloughi)', 'P', NULL, NULL, NULL),
(175, 'R0175', 'Leonberger', 'P', NULL, NULL, NULL),
(176, 'R0176', 'Lhasa Apso', 'P', NULL, NULL, NULL),
(177, 'R0177', 'Lowchen (Pequeño Perro León)', 'P', NULL, NULL, NULL),
(178, 'R0178', 'Lundehund Noruego', 'P', NULL, NULL, NULL),
(179, 'R0179', 'Malamute de Alaska', 'P', NULL, NULL, NULL),
(180, 'R0180', 'Maltés', 'P', NULL, NULL, NULL),
(181, 'R0181', 'Manchester terrier', 'P', NULL, NULL, NULL),
(182, 'R0182', 'Mastiff', 'P', NULL, NULL, NULL),
(183, 'R0183', 'Mastín de los Pirineos', 'P', NULL, NULL, NULL),
(184, 'R0184', 'Mastín Español', 'P', NULL, NULL, NULL),
(185, 'R0185', 'Mastín Napolitano', 'P', NULL, NULL, NULL),
(186, 'R0186', 'Mudi', 'P', NULL, NULL, NULL),
(187, 'R0187', 'Norfolk terrier', 'P', NULL, NULL, NULL),
(188, 'R0188', 'Norwich terrier', 'P', NULL, NULL, NULL),
(189, 'R0189', 'Nova Scotia duck tolling retriever', 'P', NULL, NULL, NULL),
(190, 'R0190', 'Ovejero alemán', 'P', NULL, NULL, NULL),
(191, 'R0191', 'Otterhound', 'P', NULL, NULL, NULL),
(192, 'R0192', 'Rafeiro do Alentejo', 'P', NULL, NULL, NULL),
(193, 'R0193', 'Ratonero Bodeguero Andaluz', 'P', NULL, NULL, NULL),
(194, 'R0194', 'Retriever de Nueva Escocia', 'P', NULL, NULL, NULL),
(195, 'R0195', 'Rhodesian Ridgeback', 'P', NULL, NULL, NULL),
(196, 'R0196', 'Ridgeback de Tailandia', 'P', NULL, NULL, NULL),
(197, 'R0197', 'Rottweiler', 'P', NULL, NULL, NULL),
(198, 'R0198', 'Saarloos', 'P', NULL, NULL, NULL),
(199, 'R0199', 'Sabueso de Hamilton', 'P', NULL, NULL, NULL),
(200, 'R0200', 'Sabueso de Hannover', 'P', NULL, NULL, NULL),
(201, 'R0201', 'Sabueso de Hygen', 'P', NULL, NULL, NULL),
(202, 'R0202', 'Sabueso de Istria', 'P', NULL, NULL, NULL),
(203, 'R0203', 'Sabueso de Posavaz', 'P', NULL, NULL, NULL),
(204, 'R0204', 'Sabueso de Schiller', 'P', NULL, NULL, NULL),
(205, 'R0205', 'Sabueso de Smaland', 'P', NULL, NULL, NULL),
(206, 'R0206', 'Sabueso de Transilvania', 'P', NULL, NULL, NULL),
(207, 'R0207', 'Sabueso del Tirol', 'P', NULL, NULL, NULL),
(208, 'R0208', 'Sabueso Español', 'P', NULL, NULL, NULL),
(209, 'R0209', 'Sabueso Estirio de pelo duro', 'P', NULL, NULL, NULL),
(210, 'R0210', 'Sabueso Finlandés', 'P', NULL, NULL, NULL),
(211, 'R0211', 'Sabueso Francés blanco y negro', 'P', NULL, NULL, NULL),
(212, 'R0212', 'Sabueso Francés tricolor', 'P', NULL, NULL, NULL),
(213, 'R0213', 'Sabueso Griego', 'P', NULL, NULL, NULL),
(214, 'R0214', 'Sabueso Polaco', 'P', NULL, NULL, NULL),
(215, 'R0215', 'Sabueso Serbio', 'P', NULL, NULL, NULL),
(216, 'R0216', 'Sabueso Suizo', 'P', NULL, NULL, NULL),
(217, 'R0217', 'Sabueso Yugoslavo de Montaña', 'P', NULL, NULL, NULL),
(218, 'R0218', 'Sabueso Yugoslavo tricolor', 'P', NULL, NULL, NULL),
(219, 'R0219', 'Saluki', 'P', NULL, NULL, NULL),
(220, 'R0220', 'Samoyedo', 'P', NULL, NULL, NULL),
(221, 'R0221', 'San Bernardo', 'P', NULL, NULL, NULL),
(222, 'R0222', 'Sarplaninac', 'P', NULL, NULL, NULL),
(223, 'R0223', 'Schapendoes', 'P', NULL, NULL, NULL),
(224, 'R0224', 'Schipperke', 'P', NULL, NULL, NULL),
(225, 'R0225', 'Schnauzer estándar', 'P', NULL, NULL, NULL),
(226, 'R0226', 'Schnauzer gigante', 'P', NULL, NULL, NULL),
(227, 'R0227', 'Schnauzer miniatura', 'P', NULL, NULL, NULL),
(228, 'R0228', 'Scottish terrier', 'P', NULL, NULL, NULL),
(229, 'R0229', 'Sealyham terrier', 'P', NULL, NULL, NULL),
(230, 'R0230', 'Segugio Italiano', 'P', NULL, NULL, NULL),
(231, 'R0231', 'Seppala Siberiano', 'P', NULL, NULL, NULL),
(232, 'R0232', 'Setter Inglés', 'P', NULL, NULL, NULL),
(233, 'R0233', 'Setter Irlandés', 'P', NULL, NULL, NULL),
(234, 'R0234', 'Setter Irlandés rojo y blanco', 'P', NULL, NULL, NULL),
(235, 'R0235', 'Shar Pei', 'P', NULL, NULL, NULL),
(236, 'R0236', 'Shiba Inu', 'P', NULL, NULL, NULL),
(237, 'R0237', 'Shih Tzu', 'P', NULL, NULL, NULL),
(238, 'R0238', 'Shikoku', 'P', NULL, NULL, NULL),
(239, 'R0239', 'Skye terrier', 'P', NULL, NULL, NULL),
(240, 'R0240', 'Slovensky Cuvac', 'P', NULL, NULL, NULL),
(241, 'R0241', 'Slovensky Kopov', 'P', NULL, NULL, NULL),
(242, 'R0242', 'Smoushond Holandés', 'P', NULL, NULL, NULL),
(243, 'R0243', 'Spaniel Alemán', 'P', NULL, NULL, NULL),
(244, 'R0244', 'Spaniel Azul de Picardía', 'P', NULL, NULL, NULL),
(245, 'R0245', 'Spaniel Bretón', 'P', NULL, NULL, NULL),
(246, 'R0246', 'Spaniel de Campo', 'P', NULL, NULL, NULL),
(247, 'R0247', 'Spaniel de Pont Audemer', 'P', NULL, NULL, NULL),
(248, 'R0248', 'Spaniel Francés', 'P', NULL, NULL, NULL),
(249, 'R0249', 'Spaniel Tibetano', 'P', NULL, NULL, NULL),
(250, 'R0250', 'Spinone Italiano', 'P', NULL, NULL, NULL),
(251, 'R0251', 'Spítz Alemán', 'P', NULL, NULL, NULL),
(252, 'R0252', 'Spitz de Norbotten', 'P', NULL, NULL, NULL),
(253, 'R0253', 'Spitz Finlandés', 'P', NULL, NULL, NULL),
(254, 'R0254', 'Spitz Japonés', 'P', NULL, NULL, NULL),
(255, 'R0255', 'Staffordshire bull terrier', 'P', NULL, NULL, NULL),
(256, 'R0256', 'Staffordshire terrier americano', 'P', NULL, NULL, NULL),
(257, 'R0257', 'Sussex Spaniel', 'P', NULL, NULL, NULL),
(258, 'R0258', 'Teckel (Dachshund)', 'P', NULL, NULL, NULL),
(259, 'R0259', 'Tchuvatch eslovaco', 'P', NULL, NULL, NULL),
(260, 'R0260', 'Terranova (Newfoundland)', 'P', NULL, NULL, NULL),
(261, 'R0261', 'Terrier australiano', 'P', NULL, NULL, NULL),
(262, 'R0262', 'Terrier brasilero', 'P', NULL, NULL, NULL),
(263, 'R0263', 'Terrier cazador alemán', 'P', NULL, NULL, NULL),
(264, 'R0264', 'Terrier checo (Ceský teriér)', 'P', NULL, NULL, NULL),
(265, 'R0265', 'Terrier galés', 'P', NULL, NULL, NULL),
(266, 'R0266', 'Terrier irlandés (Irish terrier)', 'P', NULL, NULL, NULL),
(267, 'R0267', 'Terrier japonés (Nihon teria)', 'P', NULL, NULL, NULL),
(268, 'R0268', 'Terrier negro ruso', 'P', NULL, NULL, NULL),
(269, 'R0269', 'Terrier tibetano', 'P', NULL, NULL, NULL),
(270, 'R0270', 'Tosa', 'P', NULL, NULL, NULL),
(271, 'R0271', 'Viejo Pastor Inglés', 'P', NULL, NULL, NULL),
(272, 'R0272', 'Viejo Pointer Danés', 'P', NULL, NULL, NULL),
(273, 'R0273', 'Vizsla', 'P', NULL, NULL, NULL),
(274, 'R0274', 'Volpino Italiano', 'P', NULL, NULL, NULL),
(275, 'R0275', 'Weimaraner', 'P', NULL, NULL, NULL),
(276, 'R0276', 'Welsh springer spaniel', 'P', NULL, NULL, NULL),
(277, 'R0277', 'Welsh Corgi Cardigan', 'P', NULL, NULL, NULL),
(278, 'R0278', 'Welsh Corgi Pembroke', 'P', NULL, NULL, NULL),
(279, 'R0279', 'Welsh terrier', 'P', NULL, NULL, NULL),
(280, 'R0280', 'West highland white terrier', 'P', NULL, NULL, NULL),
(281, 'R0281', 'Whippet', 'P', NULL, NULL, NULL),
(282, 'R0282', 'Wirehaired solvakian pointer', 'P', NULL, NULL, NULL),
(283, 'R0283', 'Xoloitzcuintle', 'P', NULL, NULL, NULL),
(284, 'R0284', 'Yorkshire Terrier', 'P', NULL, NULL, NULL),
(285, 'R0285', 'Vanco turco', 'G', NULL, NULL, NULL),
(286, 'R0286', 'Snowshoe', 'G', NULL, NULL, NULL),
(287, 'R0287', 'Chantilly-Tiffany', 'G', NULL, NULL, NULL),
(288, 'R0288', 'Colorpoint', 'G', NULL, NULL, NULL),
(289, 'R0289', 'Angora turco', 'G', NULL, NULL, NULL),
(290, 'R0290', 'Minskin', 'G', NULL, NULL, NULL),
(291, 'R0291', 'Kurilian bobtail', 'G', NULL, NULL, NULL),
(292, 'R0292', 'Habana', 'G', NULL, NULL, NULL),
(293, 'R0293', 'Común europeo', 'G', NULL, NULL, NULL),
(294, 'R0294', 'Ragamuffin', 'G', NULL, NULL, NULL),
(295, 'R0295', 'Ashera', 'G', NULL, NULL, NULL),
(296, 'R0296', 'Británico de pelo largo', 'G', NULL, NULL, NULL),
(297, 'R0297', 'Khao manee', 'G', NULL, NULL, NULL),
(298, 'R0298', 'Caracat', 'G', NULL, NULL, NULL),
(299, 'R0299', 'Singapur', 'G', NULL, NULL, NULL),
(300, 'R0300', 'Highland fold', 'G', NULL, NULL, NULL),
(301, 'R0301', 'Bobtail americano', 'G', NULL, NULL, NULL),
(302, 'R0302', 'Ural rex', 'G', NULL, NULL, NULL),
(303, 'R0303', 'Cymric', 'G', NULL, NULL, NULL),
(304, 'R0304', 'Skookum', 'G', NULL, NULL, NULL),
(305, 'R0305', 'Bobtail japonés', 'G', NULL, NULL, NULL),
(306, 'R0306', 'Toyger', 'G', NULL, NULL, NULL),
(307, 'R0307', 'Munchkin', 'G', NULL, NULL, NULL),
(308, 'R0308', 'American wirehair', 'G', NULL, NULL, NULL),
(309, 'R0309', 'Pixie bob', 'G', NULL, NULL, NULL),
(310, 'R0310', 'Tonkinés', 'G', NULL, NULL, NULL),
(311, 'R0311', 'LaPerm', 'G', NULL, NULL, NULL),
(312, 'R0312', 'Burmilla', 'G', NULL, NULL, NULL),
(313, 'R0313', 'Curl americano', 'G', NULL, NULL, NULL),
(314, 'R0314', 'Montés', 'G', NULL, NULL, NULL),
(315, 'R0315', 'Burmés', 'G', NULL, NULL, NULL),
(316, 'R0316', 'Chausie', 'G', NULL, NULL, NULL),
(317, 'R0317', 'Devon rex', 'G', NULL, NULL, NULL),
(318, 'R0318', 'Oriental de pelo largo o javanés', 'G', NULL, NULL, NULL),
(319, 'R0319', 'Scottish fold', 'G', NULL, NULL, NULL),
(320, 'R0320', 'Korat', 'G', NULL, NULL, NULL),
(321, 'R0321', 'Somalí', 'G', NULL, NULL, NULL),
(322, 'R0322', 'Sphynx o esfinge', 'G', NULL, NULL, NULL),
(323, 'R0323', 'Savannah', 'G', NULL, NULL, NULL),
(324, 'R0324', 'Cartujo chartreux', 'G', NULL, NULL, NULL),
(325, 'R0325', 'Sokoke', 'G', NULL, NULL, NULL),
(326, 'R0326', 'Selkirk rex', 'G', NULL, NULL, NULL),
(327, 'R0327', 'Nebelung', 'G', NULL, NULL, NULL),
(328, 'R0328', 'Lykoi o gato lobo', 'G', NULL, NULL, NULL),
(329, 'R0329', 'Cornish rex', 'G', NULL, NULL, NULL),
(330, 'R0330', 'Ocicat o gato ocelote', 'G', NULL, NULL, NULL),
(331, 'R0331', 'Peterbald', 'G', NULL, NULL, NULL),
(332, 'R0332', 'Oriental de pelo corto', 'G', NULL, NULL, NULL),
(333, 'R0333', 'Siberiano', 'G', NULL, NULL, NULL),
(334, 'R0334', 'Manx', 'G', NULL, NULL, NULL),
(335, 'R0335', 'Exótico de pelo corto', 'G', NULL, NULL, NULL),
(336, 'R0336', 'Birmano', 'G', NULL, NULL, NULL),
(337, 'R0337', 'Bosque de Noruega', 'G', NULL, NULL, NULL),
(338, 'R0338', 'Bengala o bengalí', 'G', NULL, NULL, NULL),
(339, 'R0339', 'Abisinio', 'G', NULL, NULL, NULL),
(340, 'R0340', 'Balinés', 'G', NULL, NULL, NULL),
(341, 'R0341', 'Maine coon', 'G', NULL, NULL, NULL),
(342, 'R0342', 'Británico de pelo corto', 'G', NULL, NULL, NULL),
(343, 'R0343', 'Azul ruso', 'G', NULL, NULL, NULL),
(344, 'R0344', 'Bombay', 'G', NULL, NULL, NULL),
(345, 'R0345', 'Mau egipcio', 'G', NULL, NULL, NULL),
(346, 'R0346', 'Australian mist', 'G', NULL, NULL, NULL),
(347, 'R0347', 'Himalayo', 'G', NULL, NULL, NULL),
(348, 'R0348', 'Persa', 'G', NULL, NULL, NULL),
(349, 'R0349', 'Siamés', 'G', NULL, NULL, NULL),
(350, 'R0350', 'Ragdoll', 'G', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptions`
--

CREATE TABLE `receptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distribution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `receptions`
--

INSERT INTO `receptions` (`id`, `distribution_id`, `user_id`, `code`, `date`, `status`, `closed_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'RCMS08012201', '2022-01-08 15:18:00', 'CONFIRMADA', NULL, '2022-01-08 15:18:55', '2022-01-08 15:18:55', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relationships`
--

CREATE TABLE `relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `relationships`
--

INSERT INTO `relationships` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Planilla', 'PLN', NULL, NULL, NULL),
(2, 'Practicante', 'PRC', NULL, NULL, '2021-10-15 00:00:00'),
(3, 'Recibo honorarios', 'RHO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `happened_at` datetime NOT NULL,
  `requested_at` date DEFAULT NULL,
  `ini_hour` time DEFAULT NULL,
  `end_hour` time DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `paidout` double(8,2) DEFAULT NULL,
  `delivery` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `center_id`, `customer_id`, `location_id`, `payment_method_id`, `code`, `status`, `happened_at`, `requested_at`, `ini_hour`, `end_hour`, `discount`, `paidout`, `delivery`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 37, 3, 'VCMS080122001', 'PENDIENTE', '2022-01-08 15:11:00', '2022-01-08', NULL, NULL, 0.00, 0.00, 0.00, '2022-01-08 15:19:10', '2022-01-08 15:19:10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `promo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `promo_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 13, 1, '2022-01-08 15:19:10', '2022-01-08 15:19:10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stocks`
--

INSERT INTO `stocks` (`id`, `center_id`, `code`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'SCMS08012201', '2022-01-08 15:18:00', '2022-01-08 15:18:55', '2022-01-08 15:18:55', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_details`
--

CREATE TABLE `stock_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stock_details`
--

INSERT INTO `stock_details` (`id`, `stock_id`, `product_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 9, 19, '2022-01-08 15:18:55', '2022-01-08 15:19:10', NULL),
(2, 1, 4, 17, '2022-01-08 15:18:56', '2022-01-08 15:19:11', NULL),
(3, 1, 6, 15, '2022-01-08 15:18:56', '2022-01-08 15:19:11', NULL),
(4, 1, 5, 14, '2022-01-08 15:18:56', '2022-01-08 15:18:56', NULL),
(5, 1, 3, 12, '2022-01-08 15:18:56', '2022-01-08 15:18:56', NULL),
(6, 1, 1, 10, '2022-01-08 15:18:56', '2022-01-08 15:18:56', NULL),
(7, 1, 2, 8, '2022-01-08 15:18:57', '2022-01-08 15:18:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `document_type_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `ubigeo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_profile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_ubigeo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cci` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `profile_id`, `document_type_id`, `country_id`, `ubigeo_id`, `bank_id`, `name`, `code`, `document`, `other_profile`, `other_ubigeo`, `address`, `mobile`, `phone`, `annex`, `email`, `account`, `cci`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 164, 1350, NULL, 'Proveedor de insumo tal', 'S2021001', '30985984', NULL, NULL, 'recrwcfdfdsfsfsd', '344 983 893', NULL, NULL, NULL, NULL, NULL, '2021-09-28 23:14:29', '2021-10-05 21:59:03', NULL),
(2, 4, 3, 164, 1349, NULL, 'Proveedor de otra cosa', 'S2021002', '98573795038', 'Comercio 3', NULL, 'dw9un9dqu', '992 874 835', NULL, NULL, NULL, NULL, NULL, '2021-10-05 21:59:49', '2021-10-05 22:27:32', NULL),
(3, 2, 1, 164, NULL, NULL, 'kfjgfñdlgsñdlk', 'S2021003', '34534534', NULL, 'kokook', 'cafdsaffdas', '999 432 423', NULL, NULL, NULL, NULL, NULL, '2021-10-19 08:31:27', '2021-10-19 09:05:45', NULL),
(4, 2, 3, 164, NULL, NULL, 'ikikikikik', 'S2021004', '99999999999', NULL, 'un pueblitojfsadkfajkshfkjashfjas', 'xaxaxaxa', '999 999 999', NULL, NULL, NULL, NULL, NULL, '2021-10-19 08:45:28', '2021-10-19 10:15:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeos`
--

CREATE TABLE `ubigeos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ubigeos`
--

INSERT INTO `ubigeos` (`id`, `department`, `province`, `district`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amazonas', 'Chachapoyas', 'Chachapoyas', NULL, NULL, NULL),
(2, 'Amazonas', 'Chachapoyas', 'Asunción', NULL, NULL, NULL),
(3, 'Amazonas', 'Chachapoyas', 'Balsas', NULL, NULL, NULL),
(4, 'Amazonas', 'Chachapoyas', 'Cheto', NULL, NULL, NULL),
(5, 'Amazonas', 'Chachapoyas', 'Chiliquin', NULL, NULL, NULL),
(6, 'Amazonas', 'Chachapoyas', 'Chuquibamba', NULL, NULL, NULL),
(7, 'Amazonas', 'Chachapoyas', 'Granada', NULL, NULL, NULL),
(8, 'Amazonas', 'Chachapoyas', 'Huancas', NULL, NULL, NULL),
(9, 'Amazonas', 'Chachapoyas', 'La Jalca', NULL, NULL, NULL),
(10, 'Amazonas', 'Chachapoyas', 'Leimebamba', NULL, NULL, NULL),
(11, 'Amazonas', 'Chachapoyas', 'Levanto', NULL, NULL, NULL),
(12, 'Amazonas', 'Chachapoyas', 'Magdalena', NULL, NULL, NULL),
(13, 'Amazonas', 'Chachapoyas', 'Mariscal Castilla', NULL, NULL, NULL),
(14, 'Amazonas', 'Chachapoyas', 'Molinopampa', NULL, NULL, NULL),
(15, 'Amazonas', 'Chachapoyas', 'Montevideo', NULL, NULL, NULL),
(16, 'Amazonas', 'Chachapoyas', 'Olleros', NULL, NULL, NULL),
(17, 'Amazonas', 'Chachapoyas', 'Quinjalca', NULL, NULL, NULL),
(18, 'Amazonas', 'Chachapoyas', 'San Francisco de Daguas', NULL, NULL, NULL),
(19, 'Amazonas', 'Chachapoyas', 'San Isidro de Maino', NULL, NULL, NULL),
(20, 'Amazonas', 'Chachapoyas', 'Soloco', NULL, NULL, NULL),
(21, 'Amazonas', 'Chachapoyas', 'Sonche', NULL, NULL, NULL),
(22, 'Amazonas', 'Bagua', 'Bagua', NULL, NULL, NULL),
(23, 'Amazonas', 'Bagua', 'Aramango', NULL, NULL, NULL),
(24, 'Amazonas', 'Bagua', 'Copallin', NULL, NULL, NULL),
(25, 'Amazonas', 'Bagua', 'El Parco', NULL, NULL, NULL),
(26, 'Amazonas', 'Bagua', 'Imaza', NULL, NULL, NULL),
(27, 'Amazonas', 'Bagua', 'La Peca', NULL, NULL, NULL),
(28, 'Amazonas', 'Bongara', 'Jumbilla', NULL, NULL, NULL),
(29, 'Amazonas', 'Bongara', 'Chisquilla', NULL, NULL, NULL),
(30, 'Amazonas', 'Bongara', 'Churuja', NULL, NULL, NULL),
(31, 'Amazonas', 'Bongara', 'Corosha', NULL, NULL, NULL),
(32, 'Amazonas', 'Bongara', 'Cuispes', NULL, NULL, NULL),
(33, 'Amazonas', 'Bongara', 'Florida', NULL, NULL, NULL),
(34, 'Amazonas', 'Bongara', 'Jazan', NULL, NULL, NULL),
(35, 'Amazonas', 'Bongara', 'Recta', NULL, NULL, NULL),
(36, 'Amazonas', 'Bongara', 'San Carlos', NULL, NULL, NULL),
(37, 'Amazonas', 'Bongara', 'Shipasbamba', NULL, NULL, NULL),
(38, 'Amazonas', 'Bongara', 'Valera', NULL, NULL, NULL),
(39, 'Amazonas', 'Bongara', 'Yambrasbamba', NULL, NULL, NULL),
(40, 'Amazonas', 'Condorcanqui', 'Nieva', NULL, NULL, NULL),
(41, 'Amazonas', 'Condorcanqui', 'El Cenepa', NULL, NULL, NULL),
(42, 'Amazonas', 'Condorcanqui', 'Rio Santiago', NULL, NULL, NULL),
(43, 'Amazonas', 'Luya', 'Lamud', NULL, NULL, NULL),
(44, 'Amazonas', 'Luya', 'Camporredondo', NULL, NULL, NULL),
(45, 'Amazonas', 'Luya', 'Cocabamba', NULL, NULL, NULL),
(46, 'Amazonas', 'Luya', 'Colcamar', NULL, NULL, NULL),
(47, 'Amazonas', 'Luya', 'Conila', NULL, NULL, NULL),
(48, 'Amazonas', 'Luya', 'Inguilpata', NULL, NULL, NULL),
(49, 'Amazonas', 'Luya', 'Longuita', NULL, NULL, NULL),
(50, 'Amazonas', 'Luya', 'Lonya Chico', NULL, NULL, NULL),
(51, 'Amazonas', 'Luya', 'Luya', NULL, NULL, NULL),
(52, 'Amazonas', 'Luya', 'Luya Viejo', NULL, NULL, NULL),
(53, 'Amazonas', 'Luya', 'Maria', NULL, NULL, NULL),
(54, 'Amazonas', 'Luya', 'Ocalli', NULL, NULL, NULL),
(55, 'Amazonas', 'Luya', 'Ocumal', NULL, NULL, NULL),
(56, 'Amazonas', 'Luya', 'Pisuquia', NULL, NULL, NULL),
(57, 'Amazonas', 'Luya', 'Providencia', NULL, NULL, NULL),
(58, 'Amazonas', 'Luya', 'San Cristobal', NULL, NULL, NULL),
(59, 'Amazonas', 'Luya', 'San Francisco de Yeso', NULL, NULL, NULL),
(60, 'Amazonas', 'Luya', 'San Jeronimo', NULL, NULL, NULL),
(61, 'Amazonas', 'Luya', 'San Juan de Lopecancha', NULL, NULL, NULL),
(62, 'Amazonas', 'Luya', 'Santa Catalina', NULL, NULL, NULL),
(63, 'Amazonas', 'Luya', 'Santo Tomas', NULL, NULL, NULL),
(64, 'Amazonas', 'Luya', 'Tingo', NULL, NULL, NULL),
(65, 'Amazonas', 'Luya', 'Trita', NULL, NULL, NULL),
(66, 'Amazonas', 'Rodriguez de Mendoza', 'San Nicolas', NULL, NULL, NULL),
(67, 'Amazonas', 'Rodriguez de Mendoza', 'Chirimoto', NULL, NULL, NULL),
(68, 'Amazonas', 'Rodriguez de Mendoza', 'Cochamal', NULL, NULL, NULL),
(69, 'Amazonas', 'Rodriguez de Mendoza', 'Huambo', NULL, NULL, NULL),
(70, 'Amazonas', 'Rodriguez de Mendoza', 'Limabamba', NULL, NULL, NULL),
(71, 'Amazonas', 'Rodriguez de Mendoza', 'Longar', NULL, NULL, NULL),
(72, 'Amazonas', 'Rodriguez de Mendoza', 'Mariscal Benavides', NULL, NULL, NULL),
(73, 'Amazonas', 'Rodriguez de Mendoza', 'Milpuc', NULL, NULL, NULL),
(74, 'Amazonas', 'Rodriguez de Mendoza', 'Omia', NULL, NULL, NULL),
(75, 'Amazonas', 'Rodriguez de Mendoza', 'Santa Rosa', NULL, NULL, NULL),
(76, 'Amazonas', 'Rodriguez de Mendoza', 'Totora', NULL, NULL, NULL),
(77, 'Amazonas', 'Rodriguez de Mendoza', 'Vista Alegre', NULL, NULL, NULL),
(78, 'Amazonas', 'Utcubamba', 'Bagua Grande', NULL, NULL, NULL),
(79, 'Amazonas', 'Utcubamba', 'Cajaruro', NULL, NULL, NULL),
(80, 'Amazonas', 'Utcubamba', 'Cumba', NULL, NULL, NULL),
(81, 'Amazonas', 'Utcubamba', 'El Milagro', NULL, NULL, NULL),
(82, 'Amazonas', 'Utcubamba', 'Jamalca', NULL, NULL, NULL),
(83, 'Amazonas', 'Utcubamba', 'Lonya Grande', NULL, NULL, NULL),
(84, 'Amazonas', 'Utcubamba', 'Yamon', NULL, NULL, NULL),
(85, 'Ancash', 'Huaraz', 'Huaraz', NULL, NULL, NULL),
(86, 'Ancash', 'Huaraz', 'Cochabamba', NULL, NULL, NULL),
(87, 'Ancash', 'Huaraz', 'Colcabamba', NULL, NULL, NULL),
(88, 'Ancash', 'Huaraz', 'Huanchay', NULL, NULL, NULL),
(89, 'Ancash', 'Huaraz', 'Independencia', NULL, NULL, NULL),
(90, 'Ancash', 'Huaraz', 'Jangas', NULL, NULL, NULL),
(91, 'Ancash', 'Huaraz', 'La Libertad', NULL, NULL, NULL),
(92, 'Ancash', 'Huaraz', 'Olleros', NULL, NULL, NULL),
(93, 'Ancash', 'Huaraz', 'Pampas Grande', NULL, NULL, NULL),
(94, 'Ancash', 'Huaraz', 'Pariacoto', NULL, NULL, NULL),
(95, 'Ancash', 'Huaraz', 'Pira', NULL, NULL, NULL),
(96, 'Ancash', 'Huaraz', 'Tarica', NULL, NULL, NULL),
(97, 'Ancash', 'Aija', 'Aija', NULL, NULL, NULL),
(98, 'Ancash', 'Aija', 'Coris', NULL, NULL, NULL),
(99, 'Ancash', 'Aija', 'Huacllan', NULL, NULL, NULL),
(100, 'Ancash', 'Aija', 'La Merced', NULL, NULL, NULL),
(101, 'Ancash', 'Aija', 'Succha', NULL, NULL, NULL),
(102, 'Ancash', 'Antonio Raymondi', 'Llamellin', NULL, NULL, NULL),
(103, 'Ancash', 'Antonio Raymondi', 'Aczo', NULL, NULL, NULL),
(104, 'Ancash', 'Antonio Raymondi', 'Chaccho', NULL, NULL, NULL),
(105, 'Ancash', 'Antonio Raymondi', 'Chingas', NULL, NULL, NULL),
(106, 'Ancash', 'Antonio Raymondi', 'Mirgas', NULL, NULL, NULL),
(107, 'Ancash', 'Antonio Raymondi', 'San Juan de Rontoy', NULL, NULL, NULL),
(108, 'Ancash', 'Asuncion', 'Chacas', NULL, NULL, NULL),
(109, 'Ancash', 'Asuncion', 'Acochaca', NULL, NULL, NULL),
(110, 'Ancash', 'Bolognesi', 'Chiquian', NULL, NULL, NULL),
(111, 'Ancash', 'Bolognesi', 'Abelardo Pardo Lezameta', NULL, NULL, NULL),
(112, 'Ancash', 'Bolognesi', 'Antonio Raymondi', NULL, NULL, NULL),
(113, 'Ancash', 'Bolognesi', 'Aquia', NULL, NULL, NULL),
(114, 'Ancash', 'Bolognesi', 'Cajacay', NULL, NULL, NULL),
(115, 'Ancash', 'Bolognesi', 'Canis', NULL, NULL, NULL),
(116, 'Ancash', 'Bolognesi', 'Colquioc', NULL, NULL, NULL),
(117, 'Ancash', 'Bolognesi', 'Huallanca', NULL, NULL, NULL),
(118, 'Ancash', 'Bolognesi', 'Huasta', NULL, NULL, NULL),
(119, 'Ancash', 'Bolognesi', 'Huayllacayan', NULL, NULL, NULL),
(120, 'Ancash', 'Bolognesi', 'La Primavera', NULL, NULL, NULL),
(121, 'Ancash', 'Bolognesi', 'Mangas', NULL, NULL, NULL),
(122, 'Ancash', 'Bolognesi', 'Pacllon', NULL, NULL, NULL),
(123, 'Ancash', 'Bolognesi', 'San Miguel de Corpanqui', NULL, NULL, NULL),
(124, 'Ancash', 'Bolognesi', 'Ticllos', NULL, NULL, NULL),
(125, 'Ancash', 'Carhuaz', 'Carhuaz', NULL, NULL, NULL),
(126, 'Ancash', 'Carhuaz', 'Acopampa', NULL, NULL, NULL),
(127, 'Ancash', 'Carhuaz', 'Amashca', NULL, NULL, NULL),
(128, 'Ancash', 'Carhuaz', 'Anta', NULL, NULL, NULL),
(129, 'Ancash', 'Carhuaz', 'Ataquero', NULL, NULL, NULL),
(130, 'Ancash', 'Carhuaz', 'Marcara', NULL, NULL, NULL),
(131, 'Ancash', 'Carhuaz', 'Pariahuanca', NULL, NULL, NULL),
(132, 'Ancash', 'Carhuaz', 'San Miguel de Aco', NULL, NULL, NULL),
(133, 'Ancash', 'Carhuaz', 'Shilla', NULL, NULL, NULL),
(134, 'Ancash', 'Carhuaz', 'Tinco', NULL, NULL, NULL),
(135, 'Ancash', 'Carhuaz', 'Yungar', NULL, NULL, NULL),
(136, 'Ancash', 'Carlos Fermin Fitzcarrald', 'San Luis', NULL, NULL, NULL),
(137, 'Ancash', 'Carlos Fermin Fitzcarrald', 'San Nicolas', NULL, NULL, NULL),
(138, 'Ancash', 'Carlos Fermin Fitzcarrald', 'Yauya', NULL, NULL, NULL),
(139, 'Ancash', 'Casma', 'Casma', NULL, NULL, NULL),
(140, 'Ancash', 'Casma', 'Buena Vista Alta', NULL, NULL, NULL),
(141, 'Ancash', 'Casma', 'Comandante Noel', NULL, NULL, NULL),
(142, 'Ancash', 'Casma', 'Yautan', NULL, NULL, NULL),
(143, 'Ancash', 'Corongo', 'Corongo', NULL, NULL, NULL),
(144, 'Ancash', 'Corongo', 'Aco', NULL, NULL, NULL),
(145, 'Ancash', 'Corongo', 'Bambas', NULL, NULL, NULL),
(146, 'Ancash', 'Corongo', 'Cusca', NULL, NULL, NULL),
(147, 'Ancash', 'Corongo', 'La Pampa', NULL, NULL, NULL),
(148, 'Ancash', 'Corongo', 'Yanac', NULL, NULL, NULL),
(149, 'Ancash', 'Corongo', 'Yupan', NULL, NULL, NULL),
(150, 'Ancash', 'Huari', 'Huari', NULL, NULL, NULL),
(151, 'Ancash', 'Huari', 'Anra', NULL, NULL, NULL),
(152, 'Ancash', 'Huari', 'Cajay', NULL, NULL, NULL),
(153, 'Ancash', 'Huari', 'Chavin de Huantar', NULL, NULL, NULL),
(154, 'Ancash', 'Huari', 'Huacachi', NULL, NULL, NULL),
(155, 'Ancash', 'Huari', 'Huacchis', NULL, NULL, NULL),
(156, 'Ancash', 'Huari', 'Huachis', NULL, NULL, NULL),
(157, 'Ancash', 'Huari', 'Huantar', NULL, NULL, NULL),
(158, 'Ancash', 'Huari', 'Masin', NULL, NULL, NULL),
(159, 'Ancash', 'Huari', 'Paucas', NULL, NULL, NULL),
(160, 'Ancash', 'Huari', 'Ponto', NULL, NULL, NULL),
(161, 'Ancash', 'Huari', 'Rahuapampa', NULL, NULL, NULL),
(162, 'Ancash', 'Huari', 'Rapayan', NULL, NULL, NULL),
(163, 'Ancash', 'Huari', 'San Marcos', NULL, NULL, NULL),
(164, 'Ancash', 'Huari', 'San Pedro de Chana', NULL, NULL, NULL),
(165, 'Ancash', 'Huari', 'Uco', NULL, NULL, NULL),
(166, 'Ancash', 'Huarmey', 'Huarmey', NULL, NULL, NULL),
(167, 'Ancash', 'Huarmey', 'Cochapeti', NULL, NULL, NULL),
(168, 'Ancash', 'Huarmey', 'Culebras', NULL, NULL, NULL),
(169, 'Ancash', 'Huarmey', 'Huayan', NULL, NULL, NULL),
(170, 'Ancash', 'Huarmey', 'Malvas', NULL, NULL, NULL),
(171, 'Ancash', 'Huaylas', 'Caraz', NULL, NULL, NULL),
(172, 'Ancash', 'Huaylas', 'Huallanca', NULL, NULL, NULL),
(173, 'Ancash', 'Huaylas', 'Huata', NULL, NULL, NULL),
(174, 'Ancash', 'Huaylas', 'Huaylas', NULL, NULL, NULL),
(175, 'Ancash', 'Huaylas', 'Mato', NULL, NULL, NULL),
(176, 'Ancash', 'Huaylas', 'Pamparomas', NULL, NULL, NULL),
(177, 'Ancash', 'Huaylas', 'Pueblo Libre', NULL, NULL, NULL),
(178, 'Ancash', 'Huaylas', 'Santa Cruz', NULL, NULL, NULL),
(179, 'Ancash', 'Huaylas', 'Santo Toribio', NULL, NULL, NULL),
(180, 'Ancash', 'Huaylas', 'Yuracmarca', NULL, NULL, NULL),
(181, 'Ancash', 'Mariscal Luzuriaga', 'Piscobamba', NULL, NULL, NULL),
(182, 'Ancash', 'Mariscal Luzuriaga', 'Casca', NULL, NULL, NULL),
(183, 'Ancash', 'Mariscal Luzuriaga', 'Eleazar Guzman Barron', NULL, NULL, NULL),
(184, 'Ancash', 'Mariscal Luzuriaga', 'Fidel Olivas Escudero', NULL, NULL, NULL),
(185, 'Ancash', 'Mariscal Luzuriaga', 'Llama', NULL, NULL, NULL),
(186, 'Ancash', 'Mariscal Luzuriaga', 'Llumpa', NULL, NULL, NULL),
(187, 'Ancash', 'Mariscal Luzuriaga', 'Lucma', NULL, NULL, NULL),
(188, 'Ancash', 'Mariscal Luzuriaga', 'Musga', NULL, NULL, NULL),
(189, 'Ancash', 'Ocros', 'Ocros', NULL, NULL, NULL),
(190, 'Ancash', 'Ocros', 'Acas', NULL, NULL, NULL),
(191, 'Ancash', 'Ocros', 'Cajamarquilla', NULL, NULL, NULL),
(192, 'Ancash', 'Ocros', 'Carhuapampa', NULL, NULL, NULL),
(193, 'Ancash', 'Ocros', 'Cochas', NULL, NULL, NULL),
(194, 'Ancash', 'Ocros', 'Congas', NULL, NULL, NULL),
(195, 'Ancash', 'Ocros', 'Llipa', NULL, NULL, NULL),
(196, 'Ancash', 'Ocros', 'San Cristobal de Rajan', NULL, NULL, NULL),
(197, 'Ancash', 'Ocros', 'San Pedro', NULL, NULL, NULL),
(198, 'Ancash', 'Ocros', 'Santiago de Chilcas', NULL, NULL, NULL),
(199, 'Ancash', 'Pallasca', 'Cabana', NULL, NULL, NULL),
(200, 'Ancash', 'Pallasca', 'Bolognesi', NULL, NULL, NULL),
(201, 'Ancash', 'Pallasca', 'Conchucos', NULL, NULL, NULL),
(202, 'Ancash', 'Pallasca', 'Huacaschuque', NULL, NULL, NULL),
(203, 'Ancash', 'Pallasca', 'Huandoval', NULL, NULL, NULL),
(204, 'Ancash', 'Pallasca', 'Lacabamba', NULL, NULL, NULL),
(205, 'Ancash', 'Pallasca', 'Llapo', NULL, NULL, NULL),
(206, 'Ancash', 'Pallasca', 'Pallasca', NULL, NULL, NULL),
(207, 'Ancash', 'Pallasca', 'Pampas', NULL, NULL, NULL),
(208, 'Ancash', 'Pallasca', 'Santa Rosa', NULL, NULL, NULL),
(209, 'Ancash', 'Pallasca', 'Tauca', NULL, NULL, NULL),
(210, 'Ancash', 'Pomabamba', 'Pomabamba', NULL, NULL, NULL),
(211, 'Ancash', 'Pomabamba', 'Huayllan', NULL, NULL, NULL),
(212, 'Ancash', 'Pomabamba', 'Parobamba', NULL, NULL, NULL),
(213, 'Ancash', 'Pomabamba', 'Quinuabamba', NULL, NULL, NULL),
(214, 'Ancash', 'Recuay', 'Recuay', NULL, NULL, NULL),
(215, 'Ancash', 'Recuay', 'Catac', NULL, NULL, NULL),
(216, 'Ancash', 'Recuay', 'Cotaparaco', NULL, NULL, NULL),
(217, 'Ancash', 'Recuay', 'Huayllapampa', NULL, NULL, NULL),
(218, 'Ancash', 'Recuay', 'Llacllin', NULL, NULL, NULL),
(219, 'Ancash', 'Recuay', 'Marca', NULL, NULL, NULL),
(220, 'Ancash', 'Recuay', 'Pampas Chico', NULL, NULL, NULL),
(221, 'Ancash', 'Recuay', 'Pararin', NULL, NULL, NULL),
(222, 'Ancash', 'Recuay', 'Tapacocha', NULL, NULL, NULL),
(223, 'Ancash', 'Recuay', 'Ticapampa', NULL, NULL, NULL),
(224, 'Ancash', 'Santa', 'Chimbote', NULL, NULL, NULL),
(225, 'Ancash', 'Santa', 'Caceres del Peru', NULL, NULL, NULL),
(226, 'Ancash', 'Santa', 'Coishco', NULL, NULL, NULL),
(227, 'Ancash', 'Santa', 'Macate', NULL, NULL, NULL),
(228, 'Ancash', 'Santa', 'Moro', NULL, NULL, NULL),
(229, 'Ancash', 'Santa', 'Nepeña', NULL, NULL, NULL),
(230, 'Ancash', 'Santa', 'Samanco', NULL, NULL, NULL),
(231, 'Ancash', 'Santa', 'Santa', NULL, NULL, NULL),
(232, 'Ancash', 'Santa', 'Nuevo Chimbote', NULL, NULL, NULL),
(233, 'Ancash', 'Sihuas', 'Sihuas', NULL, NULL, NULL),
(234, 'Ancash', 'Sihuas', 'Acobamba', NULL, NULL, NULL),
(235, 'Ancash', 'Sihuas', 'Alfonso Ugarte', NULL, NULL, NULL),
(236, 'Ancash', 'Sihuas', 'Cashapampa', NULL, NULL, NULL),
(237, 'Ancash', 'Sihuas', 'Chingalpo', NULL, NULL, NULL),
(238, 'Ancash', 'Sihuas', 'Huayllabamba', NULL, NULL, NULL),
(239, 'Ancash', 'Sihuas', 'Quiches', NULL, NULL, NULL),
(240, 'Ancash', 'Sihuas', 'Ragash', NULL, NULL, NULL),
(241, 'Ancash', 'Sihuas', 'San Juan', NULL, NULL, NULL),
(242, 'Ancash', 'Sihuas', 'Sicsibamba', NULL, NULL, NULL),
(243, 'Ancash', 'Yungay', 'Yungay', NULL, NULL, NULL),
(244, 'Ancash', 'Yungay', 'Cascapara', NULL, NULL, NULL),
(245, 'Ancash', 'Yungay', 'Mancos', NULL, NULL, NULL),
(246, 'Ancash', 'Yungay', 'Matacoto', NULL, NULL, NULL),
(247, 'Ancash', 'Yungay', 'Quillo', NULL, NULL, NULL),
(248, 'Ancash', 'Yungay', 'Ranrahirca', NULL, NULL, NULL),
(249, 'Ancash', 'Yungay', 'Shupluy', NULL, NULL, NULL),
(250, 'Ancash', 'Yungay', 'Yanama', NULL, NULL, NULL),
(251, 'Apurimac', 'Abancay', 'Abancay', NULL, NULL, NULL),
(252, 'Apurimac', 'Abancay', 'Chacoche', NULL, NULL, NULL),
(253, 'Apurimac', 'Abancay', 'Circa', NULL, NULL, NULL),
(254, 'Apurimac', 'Abancay', 'Curahuasi', NULL, NULL, NULL),
(255, 'Apurimac', 'Abancay', 'Huanipaca', NULL, NULL, NULL),
(256, 'Apurimac', 'Abancay', 'Lambrama', NULL, NULL, NULL),
(257, 'Apurimac', 'Abancay', 'Pichirhua', NULL, NULL, NULL),
(258, 'Apurimac', 'Abancay', 'San Pedro de Cachora', NULL, NULL, NULL),
(259, 'Apurimac', 'Abancay', 'Tamburco', NULL, NULL, NULL),
(260, 'Apurimac', 'Andahuaylas', 'Andahuaylas', NULL, NULL, NULL),
(261, 'Apurimac', 'Andahuaylas', 'Andarapa', NULL, NULL, NULL),
(262, 'Apurimac', 'Andahuaylas', 'Chiara', NULL, NULL, NULL),
(263, 'Apurimac', 'Andahuaylas', 'Huancarama', NULL, NULL, NULL),
(264, 'Apurimac', 'Andahuaylas', 'Huancaray', NULL, NULL, NULL),
(265, 'Apurimac', 'Andahuaylas', 'Huayana', NULL, NULL, NULL),
(266, 'Apurimac', 'Andahuaylas', 'Kishuara', NULL, NULL, NULL),
(267, 'Apurimac', 'Andahuaylas', 'Pacobamba', NULL, NULL, NULL),
(268, 'Apurimac', 'Andahuaylas', 'Pacucha', NULL, NULL, NULL),
(269, 'Apurimac', 'Andahuaylas', 'Pampachiri', NULL, NULL, NULL),
(270, 'Apurimac', 'Andahuaylas', 'Pomacocha', NULL, NULL, NULL),
(271, 'Apurimac', 'Andahuaylas', 'San Antonio de Cachi', NULL, NULL, NULL),
(272, 'Apurimac', 'Andahuaylas', 'San Jeronimo', NULL, NULL, NULL),
(273, 'Apurimac', 'Andahuaylas', 'San Miguel de Chaccrampa', NULL, NULL, NULL),
(274, 'Apurimac', 'Andahuaylas', 'Santa Maria de Chicmo', NULL, NULL, NULL),
(275, 'Apurimac', 'Andahuaylas', 'Talavera', NULL, NULL, NULL),
(276, 'Apurimac', 'Andahuaylas', 'Tumay Huaraca', NULL, NULL, NULL),
(277, 'Apurimac', 'Andahuaylas', 'Turpo', NULL, NULL, NULL),
(278, 'Apurimac', 'Andahuaylas', 'Kaquiabamba', NULL, NULL, NULL),
(279, 'Apurimac', 'Andahuaylas', 'Jose Maria Arguedas', NULL, NULL, NULL),
(280, 'Apurimac', 'Antabamba', 'Antabamba', NULL, NULL, NULL),
(281, 'Apurimac', 'Antabamba', 'El Oro', NULL, NULL, NULL),
(282, 'Apurimac', 'Antabamba', 'Huaquirca', NULL, NULL, NULL),
(283, 'Apurimac', 'Antabamba', 'Juan Espinoza Medrano', NULL, NULL, NULL),
(284, 'Apurimac', 'Antabamba', 'Oropesa', NULL, NULL, NULL),
(285, 'Apurimac', 'Antabamba', 'Pachaconas', NULL, NULL, NULL),
(286, 'Apurimac', 'Antabamba', 'Sabaino', NULL, NULL, NULL),
(287, 'Apurimac', 'Aymaraes', 'Chalhuanca', NULL, NULL, NULL),
(288, 'Apurimac', 'Aymaraes', 'Capaya', NULL, NULL, NULL),
(289, 'Apurimac', 'Aymaraes', 'Caraybamba', NULL, NULL, NULL),
(290, 'Apurimac', 'Aymaraes', 'Chapimarca', NULL, NULL, NULL),
(291, 'Apurimac', 'Aymaraes', 'Colcabamba', NULL, NULL, NULL),
(292, 'Apurimac', 'Aymaraes', 'Cotaruse', NULL, NULL, NULL),
(293, 'Apurimac', 'Aymaraes', 'Ihuayllo', NULL, NULL, NULL),
(294, 'Apurimac', 'Aymaraes', 'Justo Apu Sahuaraura', NULL, NULL, NULL),
(295, 'Apurimac', 'Aymaraes', 'Lucre', NULL, NULL, NULL),
(296, 'Apurimac', 'Aymaraes', 'Pocohuanca', NULL, NULL, NULL),
(297, 'Apurimac', 'Aymaraes', 'San Juan de Chacña', NULL, NULL, NULL),
(298, 'Apurimac', 'Aymaraes', 'Sañayca', NULL, NULL, NULL),
(299, 'Apurimac', 'Aymaraes', 'Soraya', NULL, NULL, NULL),
(300, 'Apurimac', 'Aymaraes', 'Tapairihua', NULL, NULL, NULL),
(301, 'Apurimac', 'Aymaraes', 'Tintay', NULL, NULL, NULL),
(302, 'Apurimac', 'Aymaraes', 'Toraya', NULL, NULL, NULL),
(303, 'Apurimac', 'Aymaraes', 'Yanaca', NULL, NULL, NULL),
(304, 'Apurimac', 'Cotabambas', 'Tambobamba', NULL, NULL, NULL),
(305, 'Apurimac', 'Cotabambas', 'Cotabambas', NULL, NULL, NULL),
(306, 'Apurimac', 'Cotabambas', 'Coyllurqui', NULL, NULL, NULL),
(307, 'Apurimac', 'Cotabambas', 'Haquira', NULL, NULL, NULL),
(308, 'Apurimac', 'Cotabambas', 'Mara', NULL, NULL, NULL),
(309, 'Apurimac', 'Cotabambas', 'Challhuahuacho', NULL, NULL, NULL),
(310, 'Apurimac', 'Chincheros', 'Chincheros', NULL, NULL, NULL),
(311, 'Apurimac', 'Chincheros', 'Anco_Huallo', NULL, NULL, NULL),
(312, 'Apurimac', 'Chincheros', 'Cocharcas', NULL, NULL, NULL),
(313, 'Apurimac', 'Chincheros', 'Huaccana', NULL, NULL, NULL),
(314, 'Apurimac', 'Chincheros', 'Ocobamba', NULL, NULL, NULL),
(315, 'Apurimac', 'Chincheros', 'Ongoy', NULL, NULL, NULL),
(316, 'Apurimac', 'Chincheros', 'Uranmarca', NULL, NULL, NULL),
(317, 'Apurimac', 'Chincheros', 'Ranracancha', NULL, NULL, NULL),
(318, 'Apurimac', 'Chincheros', 'Rocchacc', NULL, NULL, NULL),
(319, 'Apurimac', 'Chincheros', 'El Porvenir', NULL, NULL, NULL),
(320, 'Apurimac', 'Chincheros', 'Los Chankas', NULL, NULL, NULL),
(321, 'Apurimac', 'Grau', 'Chuquibambilla', NULL, NULL, NULL),
(322, 'Apurimac', 'Grau', 'Curpahuasi', NULL, NULL, NULL),
(323, 'Apurimac', 'Grau', 'Gamarra', NULL, NULL, NULL),
(324, 'Apurimac', 'Grau', 'Huayllati', NULL, NULL, NULL),
(325, 'Apurimac', 'Grau', 'Mamara', NULL, NULL, NULL),
(326, 'Apurimac', 'Grau', 'Micaela Bastidas', NULL, NULL, NULL),
(327, 'Apurimac', 'Grau', 'Pataypampa', NULL, NULL, NULL),
(328, 'Apurimac', 'Grau', 'Progreso', NULL, NULL, NULL),
(329, 'Apurimac', 'Grau', 'San Antonio', NULL, NULL, NULL),
(330, 'Apurimac', 'Grau', 'Santa Rosa', NULL, NULL, NULL),
(331, 'Apurimac', 'Grau', 'Turpay', NULL, NULL, NULL),
(332, 'Apurimac', 'Grau', 'Vilcabamba', NULL, NULL, NULL),
(333, 'Apurimac', 'Grau', 'Virundo', NULL, NULL, NULL),
(334, 'Apurimac', 'Grau', 'Curasco', NULL, NULL, NULL),
(335, 'Arequipa', 'Arequipa', 'Arequipa', NULL, NULL, NULL),
(336, 'Arequipa', 'Arequipa', 'Alto Selva Alegre', NULL, NULL, NULL),
(337, 'Arequipa', 'Arequipa', 'Cayma', NULL, NULL, NULL),
(338, 'Arequipa', 'Arequipa', 'Cerro Colorado', NULL, NULL, NULL),
(339, 'Arequipa', 'Arequipa', 'Characato', NULL, NULL, NULL),
(340, 'Arequipa', 'Arequipa', 'Chiguata', NULL, NULL, NULL),
(341, 'Arequipa', 'Arequipa', 'Jacobo Hunter', NULL, NULL, NULL),
(342, 'Arequipa', 'Arequipa', 'La Joya', NULL, NULL, NULL),
(343, 'Arequipa', 'Arequipa', 'Mariano Melgar', NULL, NULL, NULL),
(344, 'Arequipa', 'Arequipa', 'Miraflores', NULL, NULL, NULL),
(345, 'Arequipa', 'Arequipa', 'Mollebaya', NULL, NULL, NULL),
(346, 'Arequipa', 'Arequipa', 'Paucarpata', NULL, NULL, NULL),
(347, 'Arequipa', 'Arequipa', 'Pocsi', NULL, NULL, NULL),
(348, 'Arequipa', 'Arequipa', 'Polobaya', NULL, NULL, NULL),
(349, 'Arequipa', 'Arequipa', 'Quequeña', NULL, NULL, NULL),
(350, 'Arequipa', 'Arequipa', 'Sabandia', NULL, NULL, NULL),
(351, 'Arequipa', 'Arequipa', 'Sachaca', NULL, NULL, NULL),
(352, 'Arequipa', 'Arequipa', 'San Juan de Siguas', NULL, NULL, NULL),
(353, 'Arequipa', 'Arequipa', 'San Juan de Tarucani', NULL, NULL, NULL),
(354, 'Arequipa', 'Arequipa', 'Santa Isabel de Siguas', NULL, NULL, NULL),
(355, 'Arequipa', 'Arequipa', 'Santa Rita de Siguas', NULL, NULL, NULL),
(356, 'Arequipa', 'Arequipa', 'Socabaya', NULL, NULL, NULL),
(357, 'Arequipa', 'Arequipa', 'Tiabaya', NULL, NULL, NULL),
(358, 'Arequipa', 'Arequipa', 'Uchumayo', NULL, NULL, NULL),
(359, 'Arequipa', 'Arequipa', 'Vitor', NULL, NULL, NULL),
(360, 'Arequipa', 'Arequipa', 'Yanahuara', NULL, NULL, NULL),
(361, 'Arequipa', 'Arequipa', 'Yarabamba', NULL, NULL, NULL),
(362, 'Arequipa', 'Arequipa', 'Yura', NULL, NULL, NULL),
(363, 'Arequipa', 'Arequipa', 'Jose Luis Bustamante Y Rivero', NULL, NULL, NULL),
(364, 'Arequipa', 'Camana', 'Camana', NULL, NULL, NULL),
(365, 'Arequipa', 'Camana', 'Jose Maria Quimper', NULL, NULL, NULL),
(366, 'Arequipa', 'Camana', 'Mariano Nicolas Valcarcel', NULL, NULL, NULL),
(367, 'Arequipa', 'Camana', 'Mariscal Caceres', NULL, NULL, NULL),
(368, 'Arequipa', 'Camana', 'Nicolas de Pierola', NULL, NULL, NULL),
(369, 'Arequipa', 'Camana', 'Ocoña', NULL, NULL, NULL),
(370, 'Arequipa', 'Camana', 'Quilca', NULL, NULL, NULL),
(371, 'Arequipa', 'Camana', 'Samuel Pastor', NULL, NULL, NULL),
(372, 'Arequipa', 'Caraveli', 'Caraveli', NULL, NULL, NULL),
(373, 'Arequipa', 'Caraveli', 'Acari', NULL, NULL, NULL),
(374, 'Arequipa', 'Caraveli', 'Atico', NULL, NULL, NULL),
(375, 'Arequipa', 'Caraveli', 'Atiquipa', NULL, NULL, NULL),
(376, 'Arequipa', 'Caraveli', 'Bella Union', NULL, NULL, NULL),
(377, 'Arequipa', 'Caraveli', 'Cahuacho', NULL, NULL, NULL),
(378, 'Arequipa', 'Caraveli', 'Chala', NULL, NULL, NULL),
(379, 'Arequipa', 'Caraveli', 'Chaparra', NULL, NULL, NULL),
(380, 'Arequipa', 'Caraveli', 'Huanuhuanu', NULL, NULL, NULL),
(381, 'Arequipa', 'Caraveli', 'Jaqui', NULL, NULL, NULL),
(382, 'Arequipa', 'Caraveli', 'Lomas', NULL, NULL, NULL),
(383, 'Arequipa', 'Caraveli', 'Quicacha', NULL, NULL, NULL),
(384, 'Arequipa', 'Caraveli', 'Yauca', NULL, NULL, NULL),
(385, 'Arequipa', 'Castilla', 'Aplao', NULL, NULL, NULL),
(386, 'Arequipa', 'Castilla', 'Andagua', NULL, NULL, NULL),
(387, 'Arequipa', 'Castilla', 'Ayo', NULL, NULL, NULL),
(388, 'Arequipa', 'Castilla', 'Chachas', NULL, NULL, NULL),
(389, 'Arequipa', 'Castilla', 'Chilcaymarca', NULL, NULL, NULL),
(390, 'Arequipa', 'Castilla', 'Choco', NULL, NULL, NULL),
(391, 'Arequipa', 'Castilla', 'Huancarqui', NULL, NULL, NULL),
(392, 'Arequipa', 'Castilla', 'Machaguay', NULL, NULL, NULL),
(393, 'Arequipa', 'Castilla', 'Orcopampa', NULL, NULL, NULL),
(394, 'Arequipa', 'Castilla', 'Pampacolca', NULL, NULL, NULL),
(395, 'Arequipa', 'Castilla', 'Tipan', NULL, NULL, NULL),
(396, 'Arequipa', 'Castilla', 'Uñon', NULL, NULL, NULL),
(397, 'Arequipa', 'Castilla', 'Uraca', NULL, NULL, NULL),
(398, 'Arequipa', 'Castilla', 'Viraco', NULL, NULL, NULL),
(399, 'Arequipa', 'Caylloma', 'Chivay', NULL, NULL, NULL),
(400, 'Arequipa', 'Caylloma', 'Achoma', NULL, NULL, NULL),
(401, 'Arequipa', 'Caylloma', 'Cabanaconde', NULL, NULL, NULL),
(402, 'Arequipa', 'Caylloma', 'Callalli', NULL, NULL, NULL),
(403, 'Arequipa', 'Caylloma', 'Caylloma', NULL, NULL, NULL),
(404, 'Arequipa', 'Caylloma', 'Coporaque', NULL, NULL, NULL),
(405, 'Arequipa', 'Caylloma', 'Huambo', NULL, NULL, NULL),
(406, 'Arequipa', 'Caylloma', 'Huanca', NULL, NULL, NULL),
(407, 'Arequipa', 'Caylloma', 'Ichupampa', NULL, NULL, NULL),
(408, 'Arequipa', 'Caylloma', 'Lari', NULL, NULL, NULL),
(409, 'Arequipa', 'Caylloma', 'Lluta', NULL, NULL, NULL),
(410, 'Arequipa', 'Caylloma', 'Maca', NULL, NULL, NULL),
(411, 'Arequipa', 'Caylloma', 'Madrigal', NULL, NULL, NULL),
(412, 'Arequipa', 'Caylloma', 'San Antonio de Chuca', NULL, NULL, NULL),
(413, 'Arequipa', 'Caylloma', 'Sibayo', NULL, NULL, NULL),
(414, 'Arequipa', 'Caylloma', 'Tapay', NULL, NULL, NULL),
(415, 'Arequipa', 'Caylloma', 'Tisco', NULL, NULL, NULL),
(416, 'Arequipa', 'Caylloma', 'Tuti', NULL, NULL, NULL),
(417, 'Arequipa', 'Caylloma', 'Yanque', NULL, NULL, NULL),
(418, 'Arequipa', 'Caylloma', 'Majes', NULL, NULL, NULL),
(419, 'Arequipa', 'Condesuyos', 'Chuquibamba', NULL, NULL, NULL),
(420, 'Arequipa', 'Condesuyos', 'Andaray', NULL, NULL, NULL),
(421, 'Arequipa', 'Condesuyos', 'Cayarani', NULL, NULL, NULL),
(422, 'Arequipa', 'Condesuyos', 'Chichas', NULL, NULL, NULL),
(423, 'Arequipa', 'Condesuyos', 'Iray', NULL, NULL, NULL),
(424, 'Arequipa', 'Condesuyos', 'Rio Grande', NULL, NULL, NULL),
(425, 'Arequipa', 'Condesuyos', 'Salamanca', NULL, NULL, NULL),
(426, 'Arequipa', 'Condesuyos', 'Yanaquihua', NULL, NULL, NULL),
(427, 'Arequipa', 'Islay', 'Mollendo', NULL, NULL, NULL),
(428, 'Arequipa', 'Islay', 'Cocachacra', NULL, NULL, NULL),
(429, 'Arequipa', 'Islay', 'Dean Valdivia', NULL, NULL, NULL),
(430, 'Arequipa', 'Islay', 'Islay', NULL, NULL, NULL),
(431, 'Arequipa', 'Islay', 'Mejia', NULL, NULL, NULL),
(432, 'Arequipa', 'Islay', 'Punta de Bombon', NULL, NULL, NULL),
(433, 'Arequipa', 'La UniÃ²n', 'Cotahuasi', NULL, NULL, NULL),
(434, 'Arequipa', 'La UniÃ²n', 'Alca', NULL, NULL, NULL),
(435, 'Arequipa', 'La UniÃ²n', 'Charcana', NULL, NULL, NULL),
(436, 'Arequipa', 'La UniÃ²n', 'Huaynacotas', NULL, NULL, NULL),
(437, 'Arequipa', 'La UniÃ²n', 'Pampamarca', NULL, NULL, NULL),
(438, 'Arequipa', 'La UniÃ²n', 'Puyca', NULL, NULL, NULL),
(439, 'Arequipa', 'La UniÃ²n', 'Quechualla', NULL, NULL, NULL),
(440, 'Arequipa', 'La UniÃ²n', 'Sayla', NULL, NULL, NULL),
(441, 'Arequipa', 'La UniÃ²n', 'Tauria', NULL, NULL, NULL),
(442, 'Arequipa', 'La UniÃ²n', 'Tomepampa', NULL, NULL, NULL),
(443, 'Arequipa', 'La UniÃ²n', 'Toro', NULL, NULL, NULL),
(444, 'Ayacucho', 'Huamanga', 'Ayacucho', NULL, NULL, NULL),
(445, 'Ayacucho', 'Huamanga', 'Acocro', NULL, NULL, NULL),
(446, 'Ayacucho', 'Huamanga', 'Acos Vinchos', NULL, NULL, NULL),
(447, 'Ayacucho', 'Huamanga', 'Carmen Alto', NULL, NULL, NULL),
(448, 'Ayacucho', 'Huamanga', 'Chiara', NULL, NULL, NULL),
(449, 'Ayacucho', 'Huamanga', 'Ocros', NULL, NULL, NULL),
(450, 'Ayacucho', 'Huamanga', 'Pacaycasa', NULL, NULL, NULL),
(451, 'Ayacucho', 'Huamanga', 'Quinua', NULL, NULL, NULL),
(452, 'Ayacucho', 'Huamanga', 'San Jose de Ticllas', NULL, NULL, NULL),
(453, 'Ayacucho', 'Huamanga', 'San Juan Bautista', NULL, NULL, NULL),
(454, 'Ayacucho', 'Huamanga', 'Santiago de Pischa', NULL, NULL, NULL),
(455, 'Ayacucho', 'Huamanga', 'Socos', NULL, NULL, NULL),
(456, 'Ayacucho', 'Huamanga', 'Tambillo', NULL, NULL, NULL),
(457, 'Ayacucho', 'Huamanga', 'Vinchos', NULL, NULL, NULL),
(458, 'Ayacucho', 'Huamanga', 'Jesus Nazareno', NULL, NULL, NULL),
(459, 'Ayacucho', 'Huamanga', 'Andres Avelino Caceres Dorregaray', NULL, NULL, NULL),
(460, 'Ayacucho', 'Cangallo', 'Cangallo', NULL, NULL, NULL),
(461, 'Ayacucho', 'Cangallo', 'Chuschi', NULL, NULL, NULL),
(462, 'Ayacucho', 'Cangallo', 'Los Morochucos', NULL, NULL, NULL),
(463, 'Ayacucho', 'Cangallo', 'Maria Parado de Bellido', NULL, NULL, NULL),
(464, 'Ayacucho', 'Cangallo', 'Paras', NULL, NULL, NULL),
(465, 'Ayacucho', 'Cangallo', 'Totos', NULL, NULL, NULL),
(466, 'Ayacucho', 'Huanca Sancos', 'Sancos', NULL, NULL, NULL),
(467, 'Ayacucho', 'Huanca Sancos', 'Carapo', NULL, NULL, NULL),
(468, 'Ayacucho', 'Huanca Sancos', 'Sacsamarca', NULL, NULL, NULL),
(469, 'Ayacucho', 'Huanca Sancos', 'Santiago de Lucanamarca', NULL, NULL, NULL),
(470, 'Ayacucho', 'Huanta', 'Huanta', NULL, NULL, NULL),
(471, 'Ayacucho', 'Huanta', 'Ayahuanco', NULL, NULL, NULL),
(472, 'Ayacucho', 'Huanta', 'Huamanguilla', NULL, NULL, NULL),
(473, 'Ayacucho', 'Huanta', 'Iguain', NULL, NULL, NULL),
(474, 'Ayacucho', 'Huanta', 'Luricocha', NULL, NULL, NULL),
(475, 'Ayacucho', 'Huanta', 'Santillana', NULL, NULL, NULL),
(476, 'Ayacucho', 'Huanta', 'Sivia', NULL, NULL, NULL),
(477, 'Ayacucho', 'Huanta', 'Llochegua', NULL, NULL, NULL),
(478, 'Ayacucho', 'Huanta', 'Canayre', NULL, NULL, NULL),
(479, 'Ayacucho', 'Huanta', 'Uchuraccay', NULL, NULL, NULL),
(480, 'Ayacucho', 'Huanta', 'Pucacolpa', NULL, NULL, NULL),
(481, 'Ayacucho', 'Huanta', 'Chaca', NULL, NULL, NULL),
(482, 'Ayacucho', 'La Mar', 'San Miguel', NULL, NULL, NULL),
(483, 'Ayacucho', 'La Mar', 'Anco', NULL, NULL, NULL),
(484, 'Ayacucho', 'La Mar', 'Ayna', NULL, NULL, NULL),
(485, 'Ayacucho', 'La Mar', 'Chilcas', NULL, NULL, NULL),
(486, 'Ayacucho', 'La Mar', 'Chungui', NULL, NULL, NULL),
(487, 'Ayacucho', 'La Mar', 'Luis Carranza', NULL, NULL, NULL),
(488, 'Ayacucho', 'La Mar', 'Santa Rosa', NULL, NULL, NULL),
(489, 'Ayacucho', 'La Mar', 'Tambo', NULL, NULL, NULL),
(490, 'Ayacucho', 'La Mar', 'Samugari', NULL, NULL, NULL),
(491, 'Ayacucho', 'La Mar', 'Anchihuay', NULL, NULL, NULL),
(492, 'Ayacucho', 'La Mar', 'Oronccoy', NULL, NULL, NULL),
(493, 'Ayacucho', 'Lucanas', 'Puquio', NULL, NULL, NULL),
(494, 'Ayacucho', 'Lucanas', 'Aucara', NULL, NULL, NULL),
(495, 'Ayacucho', 'Lucanas', 'Cabana', NULL, NULL, NULL),
(496, 'Ayacucho', 'Lucanas', 'Carmen Salcedo', NULL, NULL, NULL),
(497, 'Ayacucho', 'Lucanas', 'Chaviña', NULL, NULL, NULL),
(498, 'Ayacucho', 'Lucanas', 'Chipao', NULL, NULL, NULL),
(499, 'Ayacucho', 'Lucanas', 'Huac-Huas', NULL, NULL, NULL),
(500, 'Ayacucho', 'Lucanas', 'Laramate', NULL, NULL, NULL),
(501, 'Ayacucho', 'Lucanas', 'Leoncio Prado', NULL, NULL, NULL),
(502, 'Ayacucho', 'Lucanas', 'Llauta', NULL, NULL, NULL),
(503, 'Ayacucho', 'Lucanas', 'Lucanas', NULL, NULL, NULL),
(504, 'Ayacucho', 'Lucanas', 'Ocaña', NULL, NULL, NULL),
(505, 'Ayacucho', 'Lucanas', 'Otoca', NULL, NULL, NULL),
(506, 'Ayacucho', 'Lucanas', 'Saisa', NULL, NULL, NULL),
(507, 'Ayacucho', 'Lucanas', 'San Cristobal', NULL, NULL, NULL),
(508, 'Ayacucho', 'Lucanas', 'San Juan', NULL, NULL, NULL),
(509, 'Ayacucho', 'Lucanas', 'San Pedro', NULL, NULL, NULL),
(510, 'Ayacucho', 'Lucanas', 'San Pedro de Palco', NULL, NULL, NULL),
(511, 'Ayacucho', 'Lucanas', 'Sancos', NULL, NULL, NULL),
(512, 'Ayacucho', 'Lucanas', 'Santa Ana de Huaycahuacho', NULL, NULL, NULL),
(513, 'Ayacucho', 'Lucanas', 'Santa Lucia', NULL, NULL, NULL),
(514, 'Ayacucho', 'Parinacochas', 'Coracora', NULL, NULL, NULL),
(515, 'Ayacucho', 'Parinacochas', 'Chumpi', NULL, NULL, NULL),
(516, 'Ayacucho', 'Parinacochas', 'Coronel Castañeda', NULL, NULL, NULL),
(517, 'Ayacucho', 'Parinacochas', 'Pacapausa', NULL, NULL, NULL),
(518, 'Ayacucho', 'Parinacochas', 'Pullo', NULL, NULL, NULL),
(519, 'Ayacucho', 'Parinacochas', 'Puyusca', NULL, NULL, NULL),
(520, 'Ayacucho', 'Parinacochas', 'San Francisco de Ravacayco', NULL, NULL, NULL),
(521, 'Ayacucho', 'Parinacochas', 'Upahuacho', NULL, NULL, NULL),
(522, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Pausa', NULL, NULL, NULL),
(523, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Colta', NULL, NULL, NULL),
(524, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Corculla', NULL, NULL, NULL),
(525, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Lampa', NULL, NULL, NULL),
(526, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Marcabamba', NULL, NULL, NULL),
(527, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Oyolo', NULL, NULL, NULL),
(528, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Pararca', NULL, NULL, NULL),
(529, 'Ayacucho', 'PÃ ucar del Sara Sara', 'San Javier de Alpabamba', NULL, NULL, NULL),
(530, 'Ayacucho', 'PÃ ucar del Sara Sara', 'San Jose de Ushua', NULL, NULL, NULL),
(531, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Sara Sara', NULL, NULL, NULL),
(532, 'Ayacucho', 'Sucre', 'Querobamba', NULL, NULL, NULL),
(533, 'Ayacucho', 'Sucre', 'Belen', NULL, NULL, NULL),
(534, 'Ayacucho', 'Sucre', 'Chalcos', NULL, NULL, NULL),
(535, 'Ayacucho', 'Sucre', 'Chilcayoc', NULL, NULL, NULL),
(536, 'Ayacucho', 'Sucre', 'Huacaña', NULL, NULL, NULL),
(537, 'Ayacucho', 'Sucre', 'Morcolla', NULL, NULL, NULL),
(538, 'Ayacucho', 'Sucre', 'Paico', NULL, NULL, NULL),
(539, 'Ayacucho', 'Sucre', 'San Pedro de Larcay', NULL, NULL, NULL),
(540, 'Ayacucho', 'Sucre', 'San Salvador de Quije', NULL, NULL, NULL),
(541, 'Ayacucho', 'Sucre', 'Santiago de Paucaray', NULL, NULL, NULL),
(542, 'Ayacucho', 'Sucre', 'Soras', NULL, NULL, NULL),
(543, 'Ayacucho', 'Victor Fajardo', 'Huancapi', NULL, NULL, NULL),
(544, 'Ayacucho', 'Victor Fajardo', 'Alcamenca', NULL, NULL, NULL),
(545, 'Ayacucho', 'Victor Fajardo', 'Apongo', NULL, NULL, NULL),
(546, 'Ayacucho', 'Victor Fajardo', 'Asquipata', NULL, NULL, NULL),
(547, 'Ayacucho', 'Victor Fajardo', 'Canaria', NULL, NULL, NULL),
(548, 'Ayacucho', 'Victor Fajardo', 'Cayara', NULL, NULL, NULL),
(549, 'Ayacucho', 'Victor Fajardo', 'Colca', NULL, NULL, NULL),
(550, 'Ayacucho', 'Victor Fajardo', 'Huamanquiquia', NULL, NULL, NULL),
(551, 'Ayacucho', 'Victor Fajardo', 'Huancaraylla', NULL, NULL, NULL),
(552, 'Ayacucho', 'Victor Fajardo', 'Hualla', NULL, NULL, NULL),
(553, 'Ayacucho', 'Victor Fajardo', 'Sarhua', NULL, NULL, NULL),
(554, 'Ayacucho', 'Victor Fajardo', 'Vilcanchos', NULL, NULL, NULL),
(555, 'Ayacucho', 'Vilcas Huaman', 'Vilcas Huaman', NULL, NULL, NULL),
(556, 'Ayacucho', 'Vilcas Huaman', 'Accomarca', NULL, NULL, NULL),
(557, 'Ayacucho', 'Vilcas Huaman', 'Carhuanca', NULL, NULL, NULL),
(558, 'Ayacucho', 'Vilcas Huaman', 'Concepcion', NULL, NULL, NULL),
(559, 'Ayacucho', 'Vilcas Huaman', 'Huambalpa', NULL, NULL, NULL),
(560, 'Ayacucho', 'Vilcas Huaman', 'Independencia', NULL, NULL, NULL),
(561, 'Ayacucho', 'Vilcas Huaman', 'Saurama', NULL, NULL, NULL),
(562, 'Ayacucho', 'Vilcas Huaman', 'Vischongo', NULL, NULL, NULL),
(563, 'Cajamarca', 'Cajamarca', 'Cajamarca', NULL, NULL, NULL),
(564, 'Cajamarca', 'Cajamarca', 'Asuncion', NULL, NULL, NULL),
(565, 'Cajamarca', 'Cajamarca', 'Chetilla', NULL, NULL, NULL),
(566, 'Cajamarca', 'Cajamarca', 'Cospan', NULL, NULL, NULL),
(567, 'Cajamarca', 'Cajamarca', 'Encañada', NULL, NULL, NULL),
(568, 'Cajamarca', 'Cajamarca', 'Jesus', NULL, NULL, NULL),
(569, 'Cajamarca', 'Cajamarca', 'Llacanora', NULL, NULL, NULL),
(570, 'Cajamarca', 'Cajamarca', 'Los Baños del Inca', NULL, NULL, NULL),
(571, 'Cajamarca', 'Cajamarca', 'Magdalena', NULL, NULL, NULL),
(572, 'Cajamarca', 'Cajamarca', 'Matara', NULL, NULL, NULL),
(573, 'Cajamarca', 'Cajamarca', 'Namora', NULL, NULL, NULL),
(574, 'Cajamarca', 'Cajamarca', 'San Juan', NULL, NULL, NULL),
(575, 'Cajamarca', 'Cajabamba', 'Cajabamba', NULL, NULL, NULL),
(576, 'Cajamarca', 'Cajabamba', 'Cachachi', NULL, NULL, NULL),
(577, 'Cajamarca', 'Cajabamba', 'Condebamba', NULL, NULL, NULL),
(578, 'Cajamarca', 'Cajabamba', 'Sitacocha', NULL, NULL, NULL),
(579, 'Cajamarca', 'Celendin', 'Celendin', NULL, NULL, NULL),
(580, 'Cajamarca', 'Celendin', 'Chumuch', NULL, NULL, NULL),
(581, 'Cajamarca', 'Celendin', 'Cortegana', NULL, NULL, NULL),
(582, 'Cajamarca', 'Celendin', 'Huasmin', NULL, NULL, NULL),
(583, 'Cajamarca', 'Celendin', 'Jorge Chavez', NULL, NULL, NULL),
(584, 'Cajamarca', 'Celendin', 'Jose Galvez', NULL, NULL, NULL),
(585, 'Cajamarca', 'Celendin', 'Miguel Iglesias', NULL, NULL, NULL),
(586, 'Cajamarca', 'Celendin', 'Oxamarca', NULL, NULL, NULL),
(587, 'Cajamarca', 'Celendin', 'Sorochuco', NULL, NULL, NULL),
(588, 'Cajamarca', 'Celendin', 'Sucre', NULL, NULL, NULL),
(589, 'Cajamarca', 'Celendin', 'Utco', NULL, NULL, NULL),
(590, 'Cajamarca', 'Celendin', 'La Libertad de Pallan', NULL, NULL, NULL),
(591, 'Cajamarca', 'Chota', 'Chota', NULL, NULL, NULL),
(592, 'Cajamarca', 'Chota', 'Anguia', NULL, NULL, NULL),
(593, 'Cajamarca', 'Chota', 'Chadin', NULL, NULL, NULL),
(594, 'Cajamarca', 'Chota', 'Chiguirip', NULL, NULL, NULL),
(595, 'Cajamarca', 'Chota', 'Chimban', NULL, NULL, NULL),
(596, 'Cajamarca', 'Chota', 'Choropampa', NULL, NULL, NULL),
(597, 'Cajamarca', 'Chota', 'Cochabamba', NULL, NULL, NULL),
(598, 'Cajamarca', 'Chota', 'Conchan', NULL, NULL, NULL),
(599, 'Cajamarca', 'Chota', 'Huambos', NULL, NULL, NULL),
(600, 'Cajamarca', 'Chota', 'Lajas', NULL, NULL, NULL),
(601, 'Cajamarca', 'Chota', 'Llama', NULL, NULL, NULL),
(602, 'Cajamarca', 'Chota', 'Miracosta', NULL, NULL, NULL),
(603, 'Cajamarca', 'Chota', 'Paccha', NULL, NULL, NULL),
(604, 'Cajamarca', 'Chota', 'Pion', NULL, NULL, NULL),
(605, 'Cajamarca', 'Chota', 'Querocoto', NULL, NULL, NULL),
(606, 'Cajamarca', 'Chota', 'San Juan de Licupis', NULL, NULL, NULL),
(607, 'Cajamarca', 'Chota', 'Tacabamba', NULL, NULL, NULL),
(608, 'Cajamarca', 'Chota', 'Tocmoche', NULL, NULL, NULL),
(609, 'Cajamarca', 'Chota', 'Chalamarca', NULL, NULL, NULL),
(610, 'Cajamarca', 'Contumaza', 'Contumaza', NULL, NULL, NULL),
(611, 'Cajamarca', 'Contumaza', 'Chilete', NULL, NULL, NULL),
(612, 'Cajamarca', 'Contumaza', 'Cupisnique', NULL, NULL, NULL),
(613, 'Cajamarca', 'Contumaza', 'Guzmango', NULL, NULL, NULL),
(614, 'Cajamarca', 'Contumaza', 'San Benito', NULL, NULL, NULL),
(615, 'Cajamarca', 'Contumaza', 'Santa Cruz de Toledo', NULL, NULL, NULL),
(616, 'Cajamarca', 'Contumaza', 'Tantarica', NULL, NULL, NULL),
(617, 'Cajamarca', 'Contumaza', 'Yonan', NULL, NULL, NULL),
(618, 'Cajamarca', 'Cutervo', 'Cutervo', NULL, NULL, NULL),
(619, 'Cajamarca', 'Cutervo', 'Callayuc', NULL, NULL, NULL),
(620, 'Cajamarca', 'Cutervo', 'Choros', NULL, NULL, NULL),
(621, 'Cajamarca', 'Cutervo', 'Cujillo', NULL, NULL, NULL),
(622, 'Cajamarca', 'Cutervo', 'La Ramada', NULL, NULL, NULL),
(623, 'Cajamarca', 'Cutervo', 'Pimpingos', NULL, NULL, NULL),
(624, 'Cajamarca', 'Cutervo', 'Querocotillo', NULL, NULL, NULL),
(625, 'Cajamarca', 'Cutervo', 'San Andres de Cutervo', NULL, NULL, NULL),
(626, 'Cajamarca', 'Cutervo', 'San Juan de Cutervo', NULL, NULL, NULL),
(627, 'Cajamarca', 'Cutervo', 'San Luis de Lucma', NULL, NULL, NULL),
(628, 'Cajamarca', 'Cutervo', 'Santa Cruz', NULL, NULL, NULL),
(629, 'Cajamarca', 'Cutervo', 'Santo Domingo de la Capilla', NULL, NULL, NULL),
(630, 'Cajamarca', 'Cutervo', 'Santo Tomas', NULL, NULL, NULL),
(631, 'Cajamarca', 'Cutervo', 'Socota', NULL, NULL, NULL),
(632, 'Cajamarca', 'Cutervo', 'Toribio Casanova', NULL, NULL, NULL),
(633, 'Cajamarca', 'Hualgayoc', 'Bambamarca', NULL, NULL, NULL),
(634, 'Cajamarca', 'Hualgayoc', 'Chugur', NULL, NULL, NULL),
(635, 'Cajamarca', 'Hualgayoc', 'Hualgayoc', NULL, NULL, NULL),
(636, 'Cajamarca', 'Jaen', 'Jaen', NULL, NULL, NULL),
(637, 'Cajamarca', 'Jaen', 'Bellavista', NULL, NULL, NULL),
(638, 'Cajamarca', 'Jaen', 'Chontali', NULL, NULL, NULL),
(639, 'Cajamarca', 'Jaen', 'Colasay', NULL, NULL, NULL),
(640, 'Cajamarca', 'Jaen', 'Huabal', NULL, NULL, NULL),
(641, 'Cajamarca', 'Jaen', 'Las Pirias', NULL, NULL, NULL),
(642, 'Cajamarca', 'Jaen', 'Pomahuaca', NULL, NULL, NULL),
(643, 'Cajamarca', 'Jaen', 'Pucara', NULL, NULL, NULL),
(644, 'Cajamarca', 'Jaen', 'Sallique', NULL, NULL, NULL),
(645, 'Cajamarca', 'Jaen', 'San Felipe', NULL, NULL, NULL),
(646, 'Cajamarca', 'Jaen', 'San Jose del Alto', NULL, NULL, NULL),
(647, 'Cajamarca', 'Jaen', 'Santa Rosa', NULL, NULL, NULL),
(648, 'Cajamarca', 'San Ignacio', 'San Ignacio', NULL, NULL, NULL),
(649, 'Cajamarca', 'San Ignacio', 'Chirinos', NULL, NULL, NULL),
(650, 'Cajamarca', 'San Ignacio', 'Huarango', NULL, NULL, NULL),
(651, 'Cajamarca', 'San Ignacio', 'La Coipa', NULL, NULL, NULL),
(652, 'Cajamarca', 'San Ignacio', 'Namballe', NULL, NULL, NULL),
(653, 'Cajamarca', 'San Ignacio', 'San Jose de Lourdes', NULL, NULL, NULL),
(654, 'Cajamarca', 'San Ignacio', 'Tabaconas', NULL, NULL, NULL),
(655, 'Cajamarca', 'San Marcos', 'Pedro Galvez', NULL, NULL, NULL),
(656, 'Cajamarca', 'San Marcos', 'Chancay', NULL, NULL, NULL),
(657, 'Cajamarca', 'San Marcos', 'Eduardo Villanueva', NULL, NULL, NULL),
(658, 'Cajamarca', 'San Marcos', 'Gregorio Pita', NULL, NULL, NULL),
(659, 'Cajamarca', 'San Marcos', 'Ichocan', NULL, NULL, NULL),
(660, 'Cajamarca', 'San Marcos', 'Jose Manuel Quiroz', NULL, NULL, NULL),
(661, 'Cajamarca', 'San Marcos', 'Jose Sabogal', NULL, NULL, NULL),
(662, 'Cajamarca', 'San Miguel', 'San Miguel', NULL, NULL, NULL),
(663, 'Cajamarca', 'San Miguel', 'Bolivar', NULL, NULL, NULL),
(664, 'Cajamarca', 'San Miguel', 'Calquis', NULL, NULL, NULL),
(665, 'Cajamarca', 'San Miguel', 'Catilluc', NULL, NULL, NULL),
(666, 'Cajamarca', 'San Miguel', 'El Prado', NULL, NULL, NULL),
(667, 'Cajamarca', 'San Miguel', 'La Florida', NULL, NULL, NULL),
(668, 'Cajamarca', 'San Miguel', 'Llapa', NULL, NULL, NULL),
(669, 'Cajamarca', 'San Miguel', 'Nanchoc', NULL, NULL, NULL),
(670, 'Cajamarca', 'San Miguel', 'Niepos', NULL, NULL, NULL),
(671, 'Cajamarca', 'San Miguel', 'San Gregorio', NULL, NULL, NULL),
(672, 'Cajamarca', 'San Miguel', 'San Silvestre de Cochan', NULL, NULL, NULL),
(673, 'Cajamarca', 'San Miguel', 'Tongod', NULL, NULL, NULL),
(674, 'Cajamarca', 'San Miguel', 'Union Agua Blanca', NULL, NULL, NULL),
(675, 'Cajamarca', 'San Pablo', 'San Pablo', NULL, NULL, NULL),
(676, 'Cajamarca', 'San Pablo', 'San Bernardino', NULL, NULL, NULL),
(677, 'Cajamarca', 'San Pablo', 'San Luis', NULL, NULL, NULL),
(678, 'Cajamarca', 'San Pablo', 'Tumbaden', NULL, NULL, NULL),
(679, 'Cajamarca', 'Santa Cruz', 'Santa Cruz', NULL, NULL, NULL),
(680, 'Cajamarca', 'Santa Cruz', 'Andabamba', NULL, NULL, NULL),
(681, 'Cajamarca', 'Santa Cruz', 'Catache', NULL, NULL, NULL),
(682, 'Cajamarca', 'Santa Cruz', 'Chancaybaños', NULL, NULL, NULL),
(683, 'Cajamarca', 'Santa Cruz', 'La Esperanza', NULL, NULL, NULL),
(684, 'Cajamarca', 'Santa Cruz', 'Ninabamba', NULL, NULL, NULL),
(685, 'Cajamarca', 'Santa Cruz', 'Pulan', NULL, NULL, NULL),
(686, 'Cajamarca', 'Santa Cruz', 'Saucepampa', NULL, NULL, NULL),
(687, 'Cajamarca', 'Santa Cruz', 'Sexi', NULL, NULL, NULL),
(688, 'Cajamarca', 'Santa Cruz', 'Uticyacu', NULL, NULL, NULL),
(689, 'Cajamarca', 'Santa Cruz', 'Yauyucan', NULL, NULL, NULL),
(690, 'Callao', 'Prov. Const. del Callao', 'Callao', NULL, NULL, NULL),
(691, 'Callao', 'Prov. Const. del Callao', 'Bellavista', NULL, NULL, NULL),
(692, 'Callao', 'Prov. Const. del Callao', 'Carmen de la Legua Reynoso', NULL, NULL, NULL),
(693, 'Callao', 'Prov. Const. del Callao', 'La Perla', NULL, NULL, NULL),
(694, 'Callao', 'Prov. Const. del Callao', 'La Punta', NULL, NULL, NULL),
(695, 'Callao', 'Prov. Const. del Callao', 'Ventanilla', NULL, NULL, NULL),
(696, 'Callao', 'Prov. Const. del Callao', 'Mi Peru', NULL, NULL, NULL),
(697, 'Cusco', 'Cusco', 'Cusco', NULL, NULL, NULL),
(698, 'Cusco', 'Cusco', 'Ccorca', NULL, NULL, NULL),
(699, 'Cusco', 'Cusco', 'Poroy', NULL, NULL, NULL),
(700, 'Cusco', 'Cusco', 'San Jeronimo', NULL, NULL, NULL),
(701, 'Cusco', 'Cusco', 'San Sebastian', NULL, NULL, NULL),
(702, 'Cusco', 'Cusco', 'Santiago', NULL, NULL, NULL),
(703, 'Cusco', 'Cusco', 'Saylla', NULL, NULL, NULL),
(704, 'Cusco', 'Cusco', 'Wanchaq', NULL, NULL, NULL),
(705, 'Cusco', 'Acomayo', 'Acomayo', NULL, NULL, NULL),
(706, 'Cusco', 'Acomayo', 'Acopia', NULL, NULL, NULL),
(707, 'Cusco', 'Acomayo', 'Acos', NULL, NULL, NULL),
(708, 'Cusco', 'Acomayo', 'Mosoc Llacta', NULL, NULL, NULL),
(709, 'Cusco', 'Acomayo', 'Pomacanchi', NULL, NULL, NULL),
(710, 'Cusco', 'Acomayo', 'Rondocan', NULL, NULL, NULL),
(711, 'Cusco', 'Acomayo', 'Sangarara', NULL, NULL, NULL),
(712, 'Cusco', 'Anta', 'Anta', NULL, NULL, NULL),
(713, 'Cusco', 'Anta', 'Ancahuasi', NULL, NULL, NULL),
(714, 'Cusco', 'Anta', 'Cachimayo', NULL, NULL, NULL),
(715, 'Cusco', 'Anta', 'Chinchaypujio', NULL, NULL, NULL),
(716, 'Cusco', 'Anta', 'Huarocondo', NULL, NULL, NULL),
(717, 'Cusco', 'Anta', 'Limatambo', NULL, NULL, NULL),
(718, 'Cusco', 'Anta', 'Mollepata', NULL, NULL, NULL),
(719, 'Cusco', 'Anta', 'Pucyura', NULL, NULL, NULL),
(720, 'Cusco', 'Anta', 'Zurite', NULL, NULL, NULL),
(721, 'Cusco', 'Calca', 'Calca', NULL, NULL, NULL),
(722, 'Cusco', 'Calca', 'Coya', NULL, NULL, NULL),
(723, 'Cusco', 'Calca', 'Lamay', NULL, NULL, NULL),
(724, 'Cusco', 'Calca', 'Lares', NULL, NULL, NULL),
(725, 'Cusco', 'Calca', 'Pisac', NULL, NULL, NULL),
(726, 'Cusco', 'Calca', 'San Salvador', NULL, NULL, NULL),
(727, 'Cusco', 'Calca', 'Taray', NULL, NULL, NULL),
(728, 'Cusco', 'Calca', 'Yanatile', NULL, NULL, NULL),
(729, 'Cusco', 'Canas', 'Yanaoca', NULL, NULL, NULL),
(730, 'Cusco', 'Canas', 'Checca', NULL, NULL, NULL),
(731, 'Cusco', 'Canas', 'Kunturkanki', NULL, NULL, NULL),
(732, 'Cusco', 'Canas', 'Langui', NULL, NULL, NULL),
(733, 'Cusco', 'Canas', 'Layo', NULL, NULL, NULL),
(734, 'Cusco', 'Canas', 'Pampamarca', NULL, NULL, NULL),
(735, 'Cusco', 'Canas', 'Quehue', NULL, NULL, NULL),
(736, 'Cusco', 'Canas', 'Tupac Amaru', NULL, NULL, NULL),
(737, 'Cusco', 'Canchis', 'Sicuani', NULL, NULL, NULL),
(738, 'Cusco', 'Canchis', 'Checacupe', NULL, NULL, NULL),
(739, 'Cusco', 'Canchis', 'Combapata', NULL, NULL, NULL),
(740, 'Cusco', 'Canchis', 'Marangani', NULL, NULL, NULL),
(741, 'Cusco', 'Canchis', 'Pitumarca', NULL, NULL, NULL),
(742, 'Cusco', 'Canchis', 'San Pablo', NULL, NULL, NULL),
(743, 'Cusco', 'Canchis', 'San Pedro', NULL, NULL, NULL),
(744, 'Cusco', 'Canchis', 'Tinta', NULL, NULL, NULL),
(745, 'Cusco', 'Chumbivilcas', 'Santo Tomas', NULL, NULL, NULL),
(746, 'Cusco', 'Chumbivilcas', 'Capacmarca', NULL, NULL, NULL),
(747, 'Cusco', 'Chumbivilcas', 'Chamaca', NULL, NULL, NULL),
(748, 'Cusco', 'Chumbivilcas', 'Colquemarca', NULL, NULL, NULL),
(749, 'Cusco', 'Chumbivilcas', 'Livitaca', NULL, NULL, NULL),
(750, 'Cusco', 'Chumbivilcas', 'Llusco', NULL, NULL, NULL),
(751, 'Cusco', 'Chumbivilcas', 'Quiñota', NULL, NULL, NULL),
(752, 'Cusco', 'Chumbivilcas', 'Velille', NULL, NULL, NULL),
(753, 'Cusco', 'Espinar', 'Espinar', NULL, NULL, NULL),
(754, 'Cusco', 'Espinar', 'Condoroma', NULL, NULL, NULL),
(755, 'Cusco', 'Espinar', 'Coporaque', NULL, NULL, NULL),
(756, 'Cusco', 'Espinar', 'Ocoruro', NULL, NULL, NULL),
(757, 'Cusco', 'Espinar', 'Pallpata', NULL, NULL, NULL),
(758, 'Cusco', 'Espinar', 'Pichigua', NULL, NULL, NULL),
(759, 'Cusco', 'Espinar', 'Suyckutambo', NULL, NULL, NULL),
(760, 'Cusco', 'Espinar', 'Alto Pichigua', NULL, NULL, NULL),
(761, 'Cusco', 'La Convencion', 'Santa Ana', NULL, NULL, NULL),
(762, 'Cusco', 'La Convencion', 'Echarate', NULL, NULL, NULL),
(763, 'Cusco', 'La Convencion', 'Huayopata', NULL, NULL, NULL),
(764, 'Cusco', 'La Convencion', 'Maranura', NULL, NULL, NULL),
(765, 'Cusco', 'La Convencion', 'Ocobamba', NULL, NULL, NULL),
(766, 'Cusco', 'La Convencion', 'Quellouno', NULL, NULL, NULL),
(767, 'Cusco', 'La Convencion', 'Kimbiri', NULL, NULL, NULL),
(768, 'Cusco', 'La Convencion', 'Santa Teresa', NULL, NULL, NULL),
(769, 'Cusco', 'La Convencion', 'Vilcabamba', NULL, NULL, NULL),
(770, 'Cusco', 'La Convencion', 'Pichari', NULL, NULL, NULL),
(771, 'Cusco', 'La Convencion', 'Inkawasi', NULL, NULL, NULL),
(772, 'Cusco', 'La Convencion', 'Villa Virgen', NULL, NULL, NULL),
(773, 'Cusco', 'La Convencion', 'Villa Kintiarina', NULL, NULL, NULL),
(774, 'Cusco', 'La Convencion', 'Megantoni', NULL, NULL, NULL),
(775, 'Cusco', 'Paruro', 'Paruro', NULL, NULL, NULL),
(776, 'Cusco', 'Paruro', 'Accha', NULL, NULL, NULL),
(777, 'Cusco', 'Paruro', 'Ccapi', NULL, NULL, NULL),
(778, 'Cusco', 'Paruro', 'Colcha', NULL, NULL, NULL),
(779, 'Cusco', 'Paruro', 'Huanoquite', NULL, NULL, NULL),
(780, 'Cusco', 'Paruro', 'Omacha', NULL, NULL, NULL),
(781, 'Cusco', 'Paruro', 'Paccaritambo', NULL, NULL, NULL),
(782, 'Cusco', 'Paruro', 'Pillpinto', NULL, NULL, NULL),
(783, 'Cusco', 'Paruro', 'Yaurisque', NULL, NULL, NULL),
(784, 'Cusco', 'Paucartambo', 'Paucartambo', NULL, NULL, NULL),
(785, 'Cusco', 'Paucartambo', 'Caicay', NULL, NULL, NULL),
(786, 'Cusco', 'Paucartambo', 'Challabamba', NULL, NULL, NULL),
(787, 'Cusco', 'Paucartambo', 'Colquepata', NULL, NULL, NULL),
(788, 'Cusco', 'Paucartambo', 'Huancarani', NULL, NULL, NULL),
(789, 'Cusco', 'Paucartambo', 'Kosñipata', NULL, NULL, NULL),
(790, 'Cusco', 'Quispicanchi', 'Urcos', NULL, NULL, NULL),
(791, 'Cusco', 'Quispicanchi', 'Andahuaylillas', NULL, NULL, NULL),
(792, 'Cusco', 'Quispicanchi', 'Camanti', NULL, NULL, NULL),
(793, 'Cusco', 'Quispicanchi', 'Ccarhuayo', NULL, NULL, NULL),
(794, 'Cusco', 'Quispicanchi', 'Ccatca', NULL, NULL, NULL),
(795, 'Cusco', 'Quispicanchi', 'Cusipata', NULL, NULL, NULL),
(796, 'Cusco', 'Quispicanchi', 'Huaro', NULL, NULL, NULL),
(797, 'Cusco', 'Quispicanchi', 'Lucre', NULL, NULL, NULL),
(798, 'Cusco', 'Quispicanchi', 'Marcapata', NULL, NULL, NULL),
(799, 'Cusco', 'Quispicanchi', 'Ocongate', NULL, NULL, NULL),
(800, 'Cusco', 'Quispicanchi', 'Oropesa', NULL, NULL, NULL),
(801, 'Cusco', 'Quispicanchi', 'Quiquijana', NULL, NULL, NULL),
(802, 'Cusco', 'Urubamba', 'Urubamba', NULL, NULL, NULL),
(803, 'Cusco', 'Urubamba', 'Chinchero', NULL, NULL, NULL),
(804, 'Cusco', 'Urubamba', 'Huayllabamba', NULL, NULL, NULL),
(805, 'Cusco', 'Urubamba', 'Machupicchu', NULL, NULL, NULL),
(806, 'Cusco', 'Urubamba', 'Maras', NULL, NULL, NULL),
(807, 'Cusco', 'Urubamba', 'Ollantaytambo', NULL, NULL, NULL),
(808, 'Cusco', 'Urubamba', 'Yucay', NULL, NULL, NULL),
(809, 'Huancavelica', 'Huancavelica', 'Huancavelica', NULL, NULL, NULL),
(810, 'Huancavelica', 'Huancavelica', 'Acobambilla', NULL, NULL, NULL),
(811, 'Huancavelica', 'Huancavelica', 'Acoria', NULL, NULL, NULL),
(812, 'Huancavelica', 'Huancavelica', 'Conayca', NULL, NULL, NULL),
(813, 'Huancavelica', 'Huancavelica', 'Cuenca', NULL, NULL, NULL),
(814, 'Huancavelica', 'Huancavelica', 'Huachocolpa', NULL, NULL, NULL),
(815, 'Huancavelica', 'Huancavelica', 'Huayllahuara', NULL, NULL, NULL),
(816, 'Huancavelica', 'Huancavelica', 'Izcuchaca', NULL, NULL, NULL),
(817, 'Huancavelica', 'Huancavelica', 'Laria', NULL, NULL, NULL),
(818, 'Huancavelica', 'Huancavelica', 'Manta', NULL, NULL, NULL),
(819, 'Huancavelica', 'Huancavelica', 'Mariscal Caceres', NULL, NULL, NULL),
(820, 'Huancavelica', 'Huancavelica', 'Moya', NULL, NULL, NULL),
(821, 'Huancavelica', 'Huancavelica', 'Nuevo Occoro', NULL, NULL, NULL),
(822, 'Huancavelica', 'Huancavelica', 'Palca', NULL, NULL, NULL),
(823, 'Huancavelica', 'Huancavelica', 'Pilchaca', NULL, NULL, NULL),
(824, 'Huancavelica', 'Huancavelica', 'Vilca', NULL, NULL, NULL),
(825, 'Huancavelica', 'Huancavelica', 'Yauli', NULL, NULL, NULL),
(826, 'Huancavelica', 'Huancavelica', 'Ascension', NULL, NULL, NULL),
(827, 'Huancavelica', 'Huancavelica', 'Huando', NULL, NULL, NULL),
(828, 'Huancavelica', 'Acobamba', 'Acobamba', NULL, NULL, NULL),
(829, 'Huancavelica', 'Acobamba', 'Andabamba', NULL, NULL, NULL),
(830, 'Huancavelica', 'Acobamba', 'Anta', NULL, NULL, NULL),
(831, 'Huancavelica', 'Acobamba', 'Caja', NULL, NULL, NULL),
(832, 'Huancavelica', 'Acobamba', 'Marcas', NULL, NULL, NULL),
(833, 'Huancavelica', 'Acobamba', 'Paucara', NULL, NULL, NULL);
INSERT INTO `ubigeos` (`id`, `department`, `province`, `district`, `created_at`, `updated_at`, `deleted_at`) VALUES
(834, 'Huancavelica', 'Acobamba', 'Pomacocha', NULL, NULL, NULL),
(835, 'Huancavelica', 'Acobamba', 'Rosario', NULL, NULL, NULL),
(836, 'Huancavelica', 'Angaraes', 'Lircay', NULL, NULL, NULL),
(837, 'Huancavelica', 'Angaraes', 'Anchonga', NULL, NULL, NULL),
(838, 'Huancavelica', 'Angaraes', 'Callanmarca', NULL, NULL, NULL),
(839, 'Huancavelica', 'Angaraes', 'Ccochaccasa', NULL, NULL, NULL),
(840, 'Huancavelica', 'Angaraes', 'Chincho', NULL, NULL, NULL),
(841, 'Huancavelica', 'Angaraes', 'Congalla', NULL, NULL, NULL),
(842, 'Huancavelica', 'Angaraes', 'Huanca-Huanca', NULL, NULL, NULL),
(843, 'Huancavelica', 'Angaraes', 'Huayllay Grande', NULL, NULL, NULL),
(844, 'Huancavelica', 'Angaraes', 'Julcamarca', NULL, NULL, NULL),
(845, 'Huancavelica', 'Angaraes', 'San Antonio de Antaparco', NULL, NULL, NULL),
(846, 'Huancavelica', 'Angaraes', 'Santo Tomas de Pata', NULL, NULL, NULL),
(847, 'Huancavelica', 'Angaraes', 'Secclla', NULL, NULL, NULL),
(848, 'Huancavelica', 'Castrovirreyna', 'Castrovirreyna', NULL, NULL, NULL),
(849, 'Huancavelica', 'Castrovirreyna', 'Arma', NULL, NULL, NULL),
(850, 'Huancavelica', 'Castrovirreyna', 'Aurahua', NULL, NULL, NULL),
(851, 'Huancavelica', 'Castrovirreyna', 'Capillas', NULL, NULL, NULL),
(852, 'Huancavelica', 'Castrovirreyna', 'Chupamarca', NULL, NULL, NULL),
(853, 'Huancavelica', 'Castrovirreyna', 'Cocas', NULL, NULL, NULL),
(854, 'Huancavelica', 'Castrovirreyna', 'Huachos', NULL, NULL, NULL),
(855, 'Huancavelica', 'Castrovirreyna', 'Huamatambo', NULL, NULL, NULL),
(856, 'Huancavelica', 'Castrovirreyna', 'Mollepampa', NULL, NULL, NULL),
(857, 'Huancavelica', 'Castrovirreyna', 'San Juan', NULL, NULL, NULL),
(858, 'Huancavelica', 'Castrovirreyna', 'Santa Ana', NULL, NULL, NULL),
(859, 'Huancavelica', 'Castrovirreyna', 'Tantara', NULL, NULL, NULL),
(860, 'Huancavelica', 'Castrovirreyna', 'Ticrapo', NULL, NULL, NULL),
(861, 'Huancavelica', 'Churcampa', 'Churcampa', NULL, NULL, NULL),
(862, 'Huancavelica', 'Churcampa', 'Anco', NULL, NULL, NULL),
(863, 'Huancavelica', 'Churcampa', 'Chinchihuasi', NULL, NULL, NULL),
(864, 'Huancavelica', 'Churcampa', 'El Carmen', NULL, NULL, NULL),
(865, 'Huancavelica', 'Churcampa', 'La Merced', NULL, NULL, NULL),
(866, 'Huancavelica', 'Churcampa', 'Locroja', NULL, NULL, NULL),
(867, 'Huancavelica', 'Churcampa', 'Paucarbamba', NULL, NULL, NULL),
(868, 'Huancavelica', 'Churcampa', 'San Miguel de Mayocc', NULL, NULL, NULL),
(869, 'Huancavelica', 'Churcampa', 'San Pedro de Coris', NULL, NULL, NULL),
(870, 'Huancavelica', 'Churcampa', 'Pachamarca', NULL, NULL, NULL),
(871, 'Huancavelica', 'Churcampa', 'Cosme', NULL, NULL, NULL),
(872, 'Huancavelica', 'Huaytara', 'Huaytara', NULL, NULL, NULL),
(873, 'Huancavelica', 'Huaytara', 'Ayavi', NULL, NULL, NULL),
(874, 'Huancavelica', 'Huaytara', 'Cordova', NULL, NULL, NULL),
(875, 'Huancavelica', 'Huaytara', 'Huayacundo Arma', NULL, NULL, NULL),
(876, 'Huancavelica', 'Huaytara', 'Laramarca', NULL, NULL, NULL),
(877, 'Huancavelica', 'Huaytara', 'Ocoyo', NULL, NULL, NULL),
(878, 'Huancavelica', 'Huaytara', 'Pilpichaca', NULL, NULL, NULL),
(879, 'Huancavelica', 'Huaytara', 'Querco', NULL, NULL, NULL),
(880, 'Huancavelica', 'Huaytara', 'Quito-Arma', NULL, NULL, NULL),
(881, 'Huancavelica', 'Huaytara', 'San Antonio de Cusicancha', NULL, NULL, NULL),
(882, 'Huancavelica', 'Huaytara', 'San Francisco de Sangayaico', NULL, NULL, NULL),
(883, 'Huancavelica', 'Huaytara', 'San Isidro', NULL, NULL, NULL),
(884, 'Huancavelica', 'Huaytara', 'Santiago de Chocorvos', NULL, NULL, NULL),
(885, 'Huancavelica', 'Huaytara', 'Santiago de Quirahuara', NULL, NULL, NULL),
(886, 'Huancavelica', 'Huaytara', 'Santo Domingo de Capillas', NULL, NULL, NULL),
(887, 'Huancavelica', 'Huaytara', 'Tambo', NULL, NULL, NULL),
(888, 'Huancavelica', 'Tayacaja', 'Pampas', NULL, NULL, NULL),
(889, 'Huancavelica', 'Tayacaja', 'Acostambo', NULL, NULL, NULL),
(890, 'Huancavelica', 'Tayacaja', 'Acraquia', NULL, NULL, NULL),
(891, 'Huancavelica', 'Tayacaja', 'Ahuaycha', NULL, NULL, NULL),
(892, 'Huancavelica', 'Tayacaja', 'Colcabamba', NULL, NULL, NULL),
(893, 'Huancavelica', 'Tayacaja', 'Daniel Hernandez', NULL, NULL, NULL),
(894, 'Huancavelica', 'Tayacaja', 'Huachocolpa', NULL, NULL, NULL),
(895, 'Huancavelica', 'Tayacaja', 'Huaribamba', NULL, NULL, NULL),
(896, 'Huancavelica', 'Tayacaja', 'Ã‘ahuimpuquio', NULL, NULL, NULL),
(897, 'Huancavelica', 'Tayacaja', 'Pazos', NULL, NULL, NULL),
(898, 'Huancavelica', 'Tayacaja', 'Quishuar', NULL, NULL, NULL),
(899, 'Huancavelica', 'Tayacaja', 'Salcabamba', NULL, NULL, NULL),
(900, 'Huancavelica', 'Tayacaja', 'Salcahuasi', NULL, NULL, NULL),
(901, 'Huancavelica', 'Tayacaja', 'San Marcos de Rocchac', NULL, NULL, NULL),
(902, 'Huancavelica', 'Tayacaja', 'Surcubamba', NULL, NULL, NULL),
(903, 'Huancavelica', 'Tayacaja', 'Tintay Puncu', NULL, NULL, NULL),
(904, 'Huancavelica', 'Tayacaja', 'Quichuas', NULL, NULL, NULL),
(905, 'Huancavelica', 'Tayacaja', 'Andaymarca', NULL, NULL, NULL),
(906, 'Huancavelica', 'Tayacaja', 'Roble', NULL, NULL, NULL),
(907, 'Huancavelica', 'Tayacaja', 'Pichos', NULL, NULL, NULL),
(908, 'Huancavelica', 'Tayacaja', 'Santiago de Tucuma', NULL, NULL, NULL),
(909, 'Huanuco', 'Huanuco', 'Huanuco', NULL, NULL, NULL),
(910, 'Huanuco', 'Huanuco', 'Amarilis', NULL, NULL, NULL),
(911, 'Huanuco', 'Huanuco', 'Chinchao', NULL, NULL, NULL),
(912, 'Huanuco', 'Huanuco', 'Churubamba', NULL, NULL, NULL),
(913, 'Huanuco', 'Huanuco', 'Margos', NULL, NULL, NULL),
(914, 'Huanuco', 'Huanuco', 'Quisqui (Kichki)', NULL, NULL, NULL),
(915, 'Huanuco', 'Huanuco', 'San Francisco de Cayran', NULL, NULL, NULL),
(916, 'Huanuco', 'Huanuco', 'San Pedro de Chaulan', NULL, NULL, NULL),
(917, 'Huanuco', 'Huanuco', 'Santa Maria del Valle', NULL, NULL, NULL),
(918, 'Huanuco', 'Huanuco', 'Yarumayo', NULL, NULL, NULL),
(919, 'Huanuco', 'Huanuco', 'Pillco Marca', NULL, NULL, NULL),
(920, 'Huanuco', 'Huanuco', 'Yacus', NULL, NULL, NULL),
(921, 'Huanuco', 'Huanuco', 'San Pablo de Pillao', NULL, NULL, NULL),
(922, 'Huanuco', 'Ambo', 'Ambo', NULL, NULL, NULL),
(923, 'Huanuco', 'Ambo', 'Cayna', NULL, NULL, NULL),
(924, 'Huanuco', 'Ambo', 'Colpas', NULL, NULL, NULL),
(925, 'Huanuco', 'Ambo', 'Conchamarca', NULL, NULL, NULL),
(926, 'Huanuco', 'Ambo', 'Huacar', NULL, NULL, NULL),
(927, 'Huanuco', 'Ambo', 'San Francisco', NULL, NULL, NULL),
(928, 'Huanuco', 'Ambo', 'San Rafael', NULL, NULL, NULL),
(929, 'Huanuco', 'Ambo', 'Tomay Kichwa', NULL, NULL, NULL),
(930, 'Huanuco', 'Dos de Mayo', 'La Union', NULL, NULL, NULL),
(931, 'Huanuco', 'Dos de Mayo', 'Chuquis', NULL, NULL, NULL),
(932, 'Huanuco', 'Dos de Mayo', 'Marias', NULL, NULL, NULL),
(933, 'Huanuco', 'Dos de Mayo', 'Pachas', NULL, NULL, NULL),
(934, 'Huanuco', 'Dos de Mayo', 'Quivilla', NULL, NULL, NULL),
(935, 'Huanuco', 'Dos de Mayo', 'Ripan', NULL, NULL, NULL),
(936, 'Huanuco', 'Dos de Mayo', 'Shunqui', NULL, NULL, NULL),
(937, 'Huanuco', 'Dos de Mayo', 'Sillapata', NULL, NULL, NULL),
(938, 'Huanuco', 'Dos de Mayo', 'Yanas', NULL, NULL, NULL),
(939, 'Huanuco', 'Huacaybamba', 'Huacaybamba', NULL, NULL, NULL),
(940, 'Huanuco', 'Huacaybamba', 'Canchabamba', NULL, NULL, NULL),
(941, 'Huanuco', 'Huacaybamba', 'Cochabamba', NULL, NULL, NULL),
(942, 'Huanuco', 'Huacaybamba', 'Pinra', NULL, NULL, NULL),
(943, 'Huanuco', 'Huamalies', 'Llata', NULL, NULL, NULL),
(944, 'Huanuco', 'Huamalies', 'Arancay', NULL, NULL, NULL),
(945, 'Huanuco', 'Huamalies', 'Chavin de Pariarca', NULL, NULL, NULL),
(946, 'Huanuco', 'Huamalies', 'Jacas Grande', NULL, NULL, NULL),
(947, 'Huanuco', 'Huamalies', 'Jircan', NULL, NULL, NULL),
(948, 'Huanuco', 'Huamalies', 'Miraflores', NULL, NULL, NULL),
(949, 'Huanuco', 'Huamalies', 'Monzon', NULL, NULL, NULL),
(950, 'Huanuco', 'Huamalies', 'Punchao', NULL, NULL, NULL),
(951, 'Huanuco', 'Huamalies', 'Puños', NULL, NULL, NULL),
(952, 'Huanuco', 'Huamalies', 'Singa', NULL, NULL, NULL),
(953, 'Huanuco', 'Huamalies', 'Tantamayo', NULL, NULL, NULL),
(954, 'Huanuco', 'Leoncio Prado', 'Rupa-Rupa', NULL, NULL, NULL),
(955, 'Huanuco', 'Leoncio Prado', 'Daniel Alomia Robles', NULL, NULL, NULL),
(956, 'Huanuco', 'Leoncio Prado', 'Hermilio Valdizan', NULL, NULL, NULL),
(957, 'Huanuco', 'Leoncio Prado', 'Jose Crespo y Castillo', NULL, NULL, NULL),
(958, 'Huanuco', 'Leoncio Prado', 'Luyando', NULL, NULL, NULL),
(959, 'Huanuco', 'Leoncio Prado', 'Mariano Damaso Beraun', NULL, NULL, NULL),
(960, 'Huanuco', 'Leoncio Prado', 'Pucayacu', NULL, NULL, NULL),
(961, 'Huanuco', 'Leoncio Prado', 'Castillo Grande', NULL, NULL, NULL),
(962, 'Huanuco', 'Leoncio Prado', 'Pueblo Nuevo', NULL, NULL, NULL),
(963, 'Huanuco', 'Leoncio Prado', 'Santo Domingo de Anda', NULL, NULL, NULL),
(964, 'Huanuco', 'Marañón', 'Huacrachuco', NULL, NULL, NULL),
(965, 'Huanuco', 'Marañón', 'Cholon', NULL, NULL, NULL),
(966, 'Huanuco', 'Marañón', 'San Buenaventura', NULL, NULL, NULL),
(967, 'Huanuco', 'Marañón', 'La Morada', NULL, NULL, NULL),
(968, 'Huanuco', 'Marañón', 'Santa Rosa de Alto Yanajanca', NULL, NULL, NULL),
(969, 'Huanuco', 'Pachitea', 'Panao', NULL, NULL, NULL),
(970, 'Huanuco', 'Pachitea', 'Chaglla', NULL, NULL, NULL),
(971, 'Huanuco', 'Pachitea', 'Molino', NULL, NULL, NULL),
(972, 'Huanuco', 'Pachitea', 'Umari', NULL, NULL, NULL),
(973, 'Huanuco', 'Puerto Inca', 'Puerto Inca', NULL, NULL, NULL),
(974, 'Huanuco', 'Puerto Inca', 'Codo del Pozuzo', NULL, NULL, NULL),
(975, 'Huanuco', 'Puerto Inca', 'Honoria', NULL, NULL, NULL),
(976, 'Huanuco', 'Puerto Inca', 'Tournavista', NULL, NULL, NULL),
(977, 'Huanuco', 'Puerto Inca', 'Yuyapichis', NULL, NULL, NULL),
(978, 'Huanuco', 'Lauricocha', 'Jesus', NULL, NULL, NULL),
(979, 'Huanuco', 'Lauricocha', 'Baños', NULL, NULL, NULL),
(980, 'Huanuco', 'Lauricocha', 'Jivia', NULL, NULL, NULL),
(981, 'Huanuco', 'Lauricocha', 'Queropalca', NULL, NULL, NULL),
(982, 'Huanuco', 'Lauricocha', 'Rondos', NULL, NULL, NULL),
(983, 'Huanuco', 'Lauricocha', 'San Francisco de Asis', NULL, NULL, NULL),
(984, 'Huanuco', 'Lauricocha', 'San Miguel de Cauri', NULL, NULL, NULL),
(985, 'Huanuco', 'Yarowilca', 'Chavinillo', NULL, NULL, NULL),
(986, 'Huanuco', 'Yarowilca', 'Cahuac', NULL, NULL, NULL),
(987, 'Huanuco', 'Yarowilca', 'Chacabamba', NULL, NULL, NULL),
(988, 'Huanuco', 'Yarowilca', 'Aparicio Pomares', NULL, NULL, NULL),
(989, 'Huanuco', 'Yarowilca', 'Jacas Chico', NULL, NULL, NULL),
(990, 'Huanuco', 'Yarowilca', 'Obas', NULL, NULL, NULL),
(991, 'Huanuco', 'Yarowilca', 'Pampamarca', NULL, NULL, NULL),
(992, 'Huanuco', 'Yarowilca', 'Choras', NULL, NULL, NULL),
(993, 'Ica', 'Ica', 'Ica', NULL, NULL, NULL),
(994, 'Ica', 'Ica', 'La Tinguiña', NULL, NULL, NULL),
(995, 'Ica', 'Ica', 'Los Aquijes', NULL, NULL, NULL),
(996, 'Ica', 'Ica', 'Ocucaje', NULL, NULL, NULL),
(997, 'Ica', 'Ica', 'Pachacutec', NULL, NULL, NULL),
(998, 'Ica', 'Ica', 'Parcona', NULL, NULL, NULL),
(999, 'Ica', 'Ica', 'Pueblo Nuevo', NULL, NULL, NULL),
(1000, 'Ica', 'Ica', 'Salas', NULL, NULL, NULL),
(1001, 'Ica', 'Ica', 'San Jose de Los Molinos', NULL, NULL, NULL),
(1002, 'Ica', 'Ica', 'San Juan Bautista', NULL, NULL, NULL),
(1003, 'Ica', 'Ica', 'Santiago', NULL, NULL, NULL),
(1004, 'Ica', 'Ica', 'Subtanjalla', NULL, NULL, NULL),
(1005, 'Ica', 'Ica', 'Tate', NULL, NULL, NULL),
(1006, 'Ica', 'Ica', 'Yauca del Rosario', NULL, NULL, NULL),
(1007, 'Ica', 'Chincha', 'Chincha Alta', NULL, NULL, NULL),
(1008, 'Ica', 'Chincha', 'Alto Laran', NULL, NULL, NULL),
(1009, 'Ica', 'Chincha', 'Chavin', NULL, NULL, NULL),
(1010, 'Ica', 'Chincha', 'Chincha Baja', NULL, NULL, NULL),
(1011, 'Ica', 'Chincha', 'El Carmen', NULL, NULL, NULL),
(1012, 'Ica', 'Chincha', 'Grocio Prado', NULL, NULL, NULL),
(1013, 'Ica', 'Chincha', 'Pueblo Nuevo', NULL, NULL, NULL),
(1014, 'Ica', 'Chincha', 'San Juan de Yanac', NULL, NULL, NULL),
(1015, 'Ica', 'Chincha', 'San Pedro de Huacarpana', NULL, NULL, NULL),
(1016, 'Ica', 'Chincha', 'Sunampe', NULL, NULL, NULL),
(1017, 'Ica', 'Chincha', 'Tambo de Mora', NULL, NULL, NULL),
(1018, 'Ica', 'Nasca', 'Nasca', NULL, NULL, NULL),
(1019, 'Ica', 'Nasca', 'Changuillo', NULL, NULL, NULL),
(1020, 'Ica', 'Nasca', 'El Ingenio', NULL, NULL, NULL),
(1021, 'Ica', 'Nasca', 'Marcona', NULL, NULL, NULL),
(1022, 'Ica', 'Nasca', 'Vista Alegre', NULL, NULL, NULL),
(1023, 'Ica', 'Palpa', 'Palpa', NULL, NULL, NULL),
(1024, 'Ica', 'Palpa', 'Llipata', NULL, NULL, NULL),
(1025, 'Ica', 'Palpa', 'Rio Grande', NULL, NULL, NULL),
(1026, 'Ica', 'Palpa', 'Santa Cruz', NULL, NULL, NULL),
(1027, 'Ica', 'Palpa', 'Tibillo', NULL, NULL, NULL),
(1028, 'Ica', 'Pisco', 'Pisco', NULL, NULL, NULL),
(1029, 'Ica', 'Pisco', 'Huancano', NULL, NULL, NULL),
(1030, 'Ica', 'Pisco', 'Humay', NULL, NULL, NULL),
(1031, 'Ica', 'Pisco', 'Independencia', NULL, NULL, NULL),
(1032, 'Ica', 'Pisco', 'Paracas', NULL, NULL, NULL),
(1033, 'Ica', 'Pisco', 'San Andres', NULL, NULL, NULL),
(1034, 'Ica', 'Pisco', 'San Clemente', NULL, NULL, NULL),
(1035, 'Ica', 'Pisco', 'Tupac Amaru Inca', NULL, NULL, NULL),
(1036, 'Junin', 'Huancayo', 'Huancayo', NULL, NULL, NULL),
(1037, 'Junin', 'Huancayo', 'Carhuacallanga', NULL, NULL, NULL),
(1038, 'Junin', 'Huancayo', 'Chacapampa', NULL, NULL, NULL),
(1039, 'Junin', 'Huancayo', 'Chicche', NULL, NULL, NULL),
(1040, 'Junin', 'Huancayo', 'Chilca', NULL, NULL, NULL),
(1041, 'Junin', 'Huancayo', 'Chongos Alto', NULL, NULL, NULL),
(1042, 'Junin', 'Huancayo', 'Chupuro', NULL, NULL, NULL),
(1043, 'Junin', 'Huancayo', 'Colca', NULL, NULL, NULL),
(1044, 'Junin', 'Huancayo', 'Cullhuas', NULL, NULL, NULL),
(1045, 'Junin', 'Huancayo', 'El Tambo', NULL, NULL, NULL),
(1046, 'Junin', 'Huancayo', 'Huacrapuquio', NULL, NULL, NULL),
(1047, 'Junin', 'Huancayo', 'Hualhuas', NULL, NULL, NULL),
(1048, 'Junin', 'Huancayo', 'Huancan', NULL, NULL, NULL),
(1049, 'Junin', 'Huancayo', 'Huasicancha', NULL, NULL, NULL),
(1050, 'Junin', 'Huancayo', 'Huayucachi', NULL, NULL, NULL),
(1051, 'Junin', 'Huancayo', 'Ingenio', NULL, NULL, NULL),
(1052, 'Junin', 'Huancayo', 'Pariahuanca', NULL, NULL, NULL),
(1053, 'Junin', 'Huancayo', 'Pilcomayo', NULL, NULL, NULL),
(1054, 'Junin', 'Huancayo', 'Pucara', NULL, NULL, NULL),
(1055, 'Junin', 'Huancayo', 'Quichuay', NULL, NULL, NULL),
(1056, 'Junin', 'Huancayo', 'Quilcas', NULL, NULL, NULL),
(1057, 'Junin', 'Huancayo', 'San Agustin', NULL, NULL, NULL),
(1058, 'Junin', 'Huancayo', 'San Jeronimo de Tunan', NULL, NULL, NULL),
(1059, 'Junin', 'Huancayo', 'Saño', NULL, NULL, NULL),
(1060, 'Junin', 'Huancayo', 'Sapallanga', NULL, NULL, NULL),
(1061, 'Junin', 'Huancayo', 'Sicaya', NULL, NULL, NULL),
(1062, 'Junin', 'Huancayo', 'Santo Domingo de Acobamba', NULL, NULL, NULL),
(1063, 'Junin', 'Huancayo', 'Viques', NULL, NULL, NULL),
(1064, 'Junin', 'Concepcion', 'Concepcion', NULL, NULL, NULL),
(1065, 'Junin', 'Concepcion', 'Aco', NULL, NULL, NULL),
(1066, 'Junin', 'Concepcion', 'Andamarca', NULL, NULL, NULL),
(1067, 'Junin', 'Concepcion', 'Chambara', NULL, NULL, NULL),
(1068, 'Junin', 'Concepcion', 'Cochas', NULL, NULL, NULL),
(1069, 'Junin', 'Concepcion', 'Comas', NULL, NULL, NULL),
(1070, 'Junin', 'Concepcion', 'Heroinas Toledo', NULL, NULL, NULL),
(1071, 'Junin', 'Concepcion', 'Manzanares', NULL, NULL, NULL),
(1072, 'Junin', 'Concepcion', 'Mariscal Castilla', NULL, NULL, NULL),
(1073, 'Junin', 'Concepcion', 'Matahuasi', NULL, NULL, NULL),
(1074, 'Junin', 'Concepcion', 'Mito', NULL, NULL, NULL),
(1075, 'Junin', 'Concepcion', 'Nueve de Julio', NULL, NULL, NULL),
(1076, 'Junin', 'Concepcion', 'Orcotuna', NULL, NULL, NULL),
(1077, 'Junin', 'Concepcion', 'San Jose de Quero', NULL, NULL, NULL),
(1078, 'Junin', 'Concepcion', 'Santa Rosa de Ocopa', NULL, NULL, NULL),
(1079, 'Junin', 'Chanchamayo', 'Chanchamayo', NULL, NULL, NULL),
(1080, 'Junin', 'Chanchamayo', 'Perene', NULL, NULL, NULL),
(1081, 'Junin', 'Chanchamayo', 'Pichanaqui', NULL, NULL, NULL),
(1082, 'Junin', 'Chanchamayo', 'San Luis de Shuaro', NULL, NULL, NULL),
(1083, 'Junin', 'Chanchamayo', 'San Ramon', NULL, NULL, NULL),
(1084, 'Junin', 'Chanchamayo', 'Vitoc', NULL, NULL, NULL),
(1085, 'Junin', 'Jauja', 'Jauja', NULL, NULL, NULL),
(1086, 'Junin', 'Jauja', 'Acolla', NULL, NULL, NULL),
(1087, 'Junin', 'Jauja', 'Apata', NULL, NULL, NULL),
(1088, 'Junin', 'Jauja', 'Ataura', NULL, NULL, NULL),
(1089, 'Junin', 'Jauja', 'Canchayllo', NULL, NULL, NULL),
(1090, 'Junin', 'Jauja', 'Curicaca', NULL, NULL, NULL),
(1091, 'Junin', 'Jauja', 'El Mantaro', NULL, NULL, NULL),
(1092, 'Junin', 'Jauja', 'Huamali', NULL, NULL, NULL),
(1093, 'Junin', 'Jauja', 'Huaripampa', NULL, NULL, NULL),
(1094, 'Junin', 'Jauja', 'Huertas', NULL, NULL, NULL),
(1095, 'Junin', 'Jauja', 'Janjaillo', NULL, NULL, NULL),
(1096, 'Junin', 'Jauja', 'Julcan', NULL, NULL, NULL),
(1097, 'Junin', 'Jauja', 'Leonor Ordoñez', NULL, NULL, NULL),
(1098, 'Junin', 'Jauja', 'Llocllapampa', NULL, NULL, NULL),
(1099, 'Junin', 'Jauja', 'Marco', NULL, NULL, NULL),
(1100, 'Junin', 'Jauja', 'Masma', NULL, NULL, NULL),
(1101, 'Junin', 'Jauja', 'Masma Chicche', NULL, NULL, NULL),
(1102, 'Junin', 'Jauja', 'Molinos', NULL, NULL, NULL),
(1103, 'Junin', 'Jauja', 'Monobamba', NULL, NULL, NULL),
(1104, 'Junin', 'Jauja', 'Muqui', NULL, NULL, NULL),
(1105, 'Junin', 'Jauja', 'Muquiyauyo', NULL, NULL, NULL),
(1106, 'Junin', 'Jauja', 'Paca', NULL, NULL, NULL),
(1107, 'Junin', 'Jauja', 'Paccha', NULL, NULL, NULL),
(1108, 'Junin', 'Jauja', 'Pancan', NULL, NULL, NULL),
(1109, 'Junin', 'Jauja', 'Parco', NULL, NULL, NULL),
(1110, 'Junin', 'Jauja', 'Pomacancha', NULL, NULL, NULL),
(1111, 'Junin', 'Jauja', 'Ricran', NULL, NULL, NULL),
(1112, 'Junin', 'Jauja', 'San Lorenzo', NULL, NULL, NULL),
(1113, 'Junin', 'Jauja', 'San Pedro de Chunan', NULL, NULL, NULL),
(1114, 'Junin', 'Jauja', 'Sausa', NULL, NULL, NULL),
(1115, 'Junin', 'Jauja', 'Sincos', NULL, NULL, NULL),
(1116, 'Junin', 'Jauja', 'Tunan Marca', NULL, NULL, NULL),
(1117, 'Junin', 'Jauja', 'Yauli', NULL, NULL, NULL),
(1118, 'Junin', 'Jauja', 'Yauyos', NULL, NULL, NULL),
(1119, 'Junin', 'Junin', 'Junin', NULL, NULL, NULL),
(1120, 'Junin', 'Junin', 'Carhuamayo', NULL, NULL, NULL),
(1121, 'Junin', 'Junin', 'Ondores', NULL, NULL, NULL),
(1122, 'Junin', 'Junin', 'Ulcumayo', NULL, NULL, NULL),
(1123, 'Junin', 'Satipo', 'Satipo', NULL, NULL, NULL),
(1124, 'Junin', 'Satipo', 'Coviriali', NULL, NULL, NULL),
(1125, 'Junin', 'Satipo', 'Llaylla', NULL, NULL, NULL),
(1126, 'Junin', 'Satipo', 'Mazamari', NULL, NULL, NULL),
(1127, 'Junin', 'Satipo', 'Pampa Hermosa', NULL, NULL, NULL),
(1128, 'Junin', 'Satipo', 'Pangoa', NULL, NULL, NULL),
(1129, 'Junin', 'Satipo', 'Rio Negro', NULL, NULL, NULL),
(1130, 'Junin', 'Satipo', 'Rio Tambo', NULL, NULL, NULL),
(1131, 'Junin', 'Satipo', 'Vizcatan del Ene', NULL, NULL, NULL),
(1132, 'Junin', 'Tarma', 'Tarma', NULL, NULL, NULL),
(1133, 'Junin', 'Tarma', 'Acobamba', NULL, NULL, NULL),
(1134, 'Junin', 'Tarma', 'Huaricolca', NULL, NULL, NULL),
(1135, 'Junin', 'Tarma', 'Huasahuasi', NULL, NULL, NULL),
(1136, 'Junin', 'Tarma', 'La Union', NULL, NULL, NULL),
(1137, 'Junin', 'Tarma', 'Palca', NULL, NULL, NULL),
(1138, 'Junin', 'Tarma', 'Palcamayo', NULL, NULL, NULL),
(1139, 'Junin', 'Tarma', 'San Pedro de Cajas', NULL, NULL, NULL),
(1140, 'Junin', 'Tarma', 'Tapo', NULL, NULL, NULL),
(1141, 'Junin', 'Yauli', 'La Oroya', NULL, NULL, NULL),
(1142, 'Junin', 'Yauli', 'Chacapalpa', NULL, NULL, NULL),
(1143, 'Junin', 'Yauli', 'Huay-Huay', NULL, NULL, NULL),
(1144, 'Junin', 'Yauli', 'Marcapomacocha', NULL, NULL, NULL),
(1145, 'Junin', 'Yauli', 'Morococha', NULL, NULL, NULL),
(1146, 'Junin', 'Yauli', 'Paccha', NULL, NULL, NULL),
(1147, 'Junin', 'Yauli', 'Santa Barbara de Carhuacayan', NULL, NULL, NULL),
(1148, 'Junin', 'Yauli', 'Santa Rosa de Sacco', NULL, NULL, NULL),
(1149, 'Junin', 'Yauli', 'Suitucancha', NULL, NULL, NULL),
(1150, 'Junin', 'Yauli', 'Yauli', NULL, NULL, NULL),
(1151, 'Junin', 'Chupaca', 'Chupaca', NULL, NULL, NULL),
(1152, 'Junin', 'Chupaca', 'Ahuac', NULL, NULL, NULL),
(1153, 'Junin', 'Chupaca', 'Chongos Bajo', NULL, NULL, NULL),
(1154, 'Junin', 'Chupaca', 'Huachac', NULL, NULL, NULL),
(1155, 'Junin', 'Chupaca', 'Huamancaca Chico', NULL, NULL, NULL),
(1156, 'Junin', 'Chupaca', 'San Juan de Iscos', NULL, NULL, NULL),
(1157, 'Junin', 'Chupaca', 'San Juan de Jarpa', NULL, NULL, NULL),
(1158, 'Junin', 'Chupaca', 'Tres de Diciembre', NULL, NULL, NULL),
(1159, 'Junin', 'Chupaca', 'Yanacancha', NULL, NULL, NULL),
(1160, 'La Libertad', 'Trujillo', 'Trujillo', NULL, NULL, NULL),
(1161, 'La Libertad', 'Trujillo', 'El Porvenir', NULL, NULL, NULL),
(1162, 'La Libertad', 'Trujillo', 'Florencia de Mora', NULL, NULL, NULL),
(1163, 'La Libertad', 'Trujillo', 'Huanchaco', NULL, NULL, NULL),
(1164, 'La Libertad', 'Trujillo', 'La Esperanza', NULL, NULL, NULL),
(1165, 'La Libertad', 'Trujillo', 'Laredo', NULL, NULL, NULL),
(1166, 'La Libertad', 'Trujillo', 'Moche', NULL, NULL, NULL),
(1167, 'La Libertad', 'Trujillo', 'Poroto', NULL, NULL, NULL),
(1168, 'La Libertad', 'Trujillo', 'Salaverry', NULL, NULL, NULL),
(1169, 'La Libertad', 'Trujillo', 'Simbal', NULL, NULL, NULL),
(1170, 'La Libertad', 'Trujillo', 'Victor Larco Herrera', NULL, NULL, NULL),
(1171, 'La Libertad', 'Ascope', 'Ascope', NULL, NULL, NULL),
(1172, 'La Libertad', 'Ascope', 'Chicama', NULL, NULL, NULL),
(1173, 'La Libertad', 'Ascope', 'Chocope', NULL, NULL, NULL),
(1174, 'La Libertad', 'Ascope', 'Magdalena de Cao', NULL, NULL, NULL),
(1175, 'La Libertad', 'Ascope', 'Paijan', NULL, NULL, NULL),
(1176, 'La Libertad', 'Ascope', 'Razuri', NULL, NULL, NULL),
(1177, 'La Libertad', 'Ascope', 'Santiago de Cao', NULL, NULL, NULL),
(1178, 'La Libertad', 'Ascope', 'Casa Grande', NULL, NULL, NULL),
(1179, 'La Libertad', 'Bolivar', 'Bolivar', NULL, NULL, NULL),
(1180, 'La Libertad', 'Bolivar', 'Bambamarca', NULL, NULL, NULL),
(1181, 'La Libertad', 'Bolivar', 'Condormarca', NULL, NULL, NULL),
(1182, 'La Libertad', 'Bolivar', 'Longotea', NULL, NULL, NULL),
(1183, 'La Libertad', 'Bolivar', 'Uchumarca', NULL, NULL, NULL),
(1184, 'La Libertad', 'Bolivar', 'Ucuncha', NULL, NULL, NULL),
(1185, 'La Libertad', 'Chepen', 'Chepen', NULL, NULL, NULL),
(1186, 'La Libertad', 'Chepen', 'Pacanga', NULL, NULL, NULL),
(1187, 'La Libertad', 'Chepen', 'Pueblo Nuevo', NULL, NULL, NULL),
(1188, 'La Libertad', 'Julcan', 'Julcan', NULL, NULL, NULL),
(1189, 'La Libertad', 'Julcan', 'Calamarca', NULL, NULL, NULL),
(1190, 'La Libertad', 'Julcan', 'Carabamba', NULL, NULL, NULL),
(1191, 'La Libertad', 'Julcan', 'Huaso', NULL, NULL, NULL),
(1192, 'La Libertad', 'Otuzco', 'Otuzco', NULL, NULL, NULL),
(1193, 'La Libertad', 'Otuzco', 'Agallpampa', NULL, NULL, NULL),
(1194, 'La Libertad', 'Otuzco', 'Charat', NULL, NULL, NULL),
(1195, 'La Libertad', 'Otuzco', 'Huaranchal', NULL, NULL, NULL),
(1196, 'La Libertad', 'Otuzco', 'La Cuesta', NULL, NULL, NULL),
(1197, 'La Libertad', 'Otuzco', 'Mache', NULL, NULL, NULL),
(1198, 'La Libertad', 'Otuzco', 'Paranday', NULL, NULL, NULL),
(1199, 'La Libertad', 'Otuzco', 'Salpo', NULL, NULL, NULL),
(1200, 'La Libertad', 'Otuzco', 'Sinsicap', NULL, NULL, NULL),
(1201, 'La Libertad', 'Otuzco', 'Usquil', NULL, NULL, NULL),
(1202, 'La Libertad', 'Pacasmayo', 'San Pedro de Lloc', NULL, NULL, NULL),
(1203, 'La Libertad', 'Pacasmayo', 'Guadalupe', NULL, NULL, NULL),
(1204, 'La Libertad', 'Pacasmayo', 'Jequetepeque', NULL, NULL, NULL),
(1205, 'La Libertad', 'Pacasmayo', 'Pacasmayo', NULL, NULL, NULL),
(1206, 'La Libertad', 'Pacasmayo', 'San Jose', NULL, NULL, NULL),
(1207, 'La Libertad', 'Pataz', 'Tayabamba', NULL, NULL, NULL),
(1208, 'La Libertad', 'Pataz', 'Buldibuyo', NULL, NULL, NULL),
(1209, 'La Libertad', 'Pataz', 'Chillia', NULL, NULL, NULL),
(1210, 'La Libertad', 'Pataz', 'Huancaspata', NULL, NULL, NULL),
(1211, 'La Libertad', 'Pataz', 'Huaylillas', NULL, NULL, NULL),
(1212, 'La Libertad', 'Pataz', 'Huayo', NULL, NULL, NULL),
(1213, 'La Libertad', 'Pataz', 'Ongon', NULL, NULL, NULL),
(1214, 'La Libertad', 'Pataz', 'Parcoy', NULL, NULL, NULL),
(1215, 'La Libertad', 'Pataz', 'Pataz', NULL, NULL, NULL),
(1216, 'La Libertad', 'Pataz', 'Pias', NULL, NULL, NULL),
(1217, 'La Libertad', 'Pataz', 'Santiago de Challas', NULL, NULL, NULL),
(1218, 'La Libertad', 'Pataz', 'Taurija', NULL, NULL, NULL),
(1219, 'La Libertad', 'Pataz', 'Urpay', NULL, NULL, NULL),
(1220, 'La Libertad', 'Sanchez Carrion', 'Huamachuco', NULL, NULL, NULL),
(1221, 'La Libertad', 'Sanchez Carrion', 'Chugay', NULL, NULL, NULL),
(1222, 'La Libertad', 'Sanchez Carrion', 'Cochorco', NULL, NULL, NULL),
(1223, 'La Libertad', 'Sanchez Carrion', 'Curgos', NULL, NULL, NULL),
(1224, 'La Libertad', 'Sanchez Carrion', 'Marcabal', NULL, NULL, NULL),
(1225, 'La Libertad', 'Sanchez Carrion', 'Sanagoran', NULL, NULL, NULL),
(1226, 'La Libertad', 'Sanchez Carrion', 'Sarin', NULL, NULL, NULL),
(1227, 'La Libertad', 'Sanchez Carrion', 'Sartimbamba', NULL, NULL, NULL),
(1228, 'La Libertad', 'Santiago de Chuco', 'Santiago de Chuco', NULL, NULL, NULL),
(1229, 'La Libertad', 'Santiago de Chuco', 'Angasmarca', NULL, NULL, NULL),
(1230, 'La Libertad', 'Santiago de Chuco', 'Cachicadan', NULL, NULL, NULL),
(1231, 'La Libertad', 'Santiago de Chuco', 'Mollebamba', NULL, NULL, NULL),
(1232, 'La Libertad', 'Santiago de Chuco', 'Mollepata', NULL, NULL, NULL),
(1233, 'La Libertad', 'Santiago de Chuco', 'Quiruvilca', NULL, NULL, NULL),
(1234, 'La Libertad', 'Santiago de Chuco', 'Santa Cruz de Chuca', NULL, NULL, NULL),
(1235, 'La Libertad', 'Santiago de Chuco', 'Sitabamba', NULL, NULL, NULL),
(1236, 'La Libertad', 'Gran Chimu', 'Cascas', NULL, NULL, NULL),
(1237, 'La Libertad', 'Gran Chimu', 'Lucma', NULL, NULL, NULL),
(1238, 'La Libertad', 'Gran Chimu', 'Marmot', NULL, NULL, NULL),
(1239, 'La Libertad', 'Gran Chimu', 'Sayapullo', NULL, NULL, NULL),
(1240, 'La Libertad', 'Viru', 'Viru', NULL, NULL, NULL),
(1241, 'La Libertad', 'Viru', 'Chao', NULL, NULL, NULL),
(1242, 'La Libertad', 'Viru', 'Guadalupito', NULL, NULL, NULL),
(1243, 'Lambayeque', 'Chiclayo', 'Chiclayo', NULL, NULL, NULL),
(1244, 'Lambayeque', 'Chiclayo', 'Chongoyape', NULL, NULL, NULL),
(1245, 'Lambayeque', 'Chiclayo', 'Eten', NULL, NULL, NULL),
(1246, 'Lambayeque', 'Chiclayo', 'Eten Puerto', NULL, NULL, NULL),
(1247, 'Lambayeque', 'Chiclayo', 'Jose Leonardo Ortiz', NULL, NULL, NULL),
(1248, 'Lambayeque', 'Chiclayo', 'La Victoria', NULL, NULL, NULL),
(1249, 'Lambayeque', 'Chiclayo', 'Lagunas', NULL, NULL, NULL),
(1250, 'Lambayeque', 'Chiclayo', 'Monsefu', NULL, NULL, NULL),
(1251, 'Lambayeque', 'Chiclayo', 'Nueva Arica', NULL, NULL, NULL),
(1252, 'Lambayeque', 'Chiclayo', 'Oyotun', NULL, NULL, NULL),
(1253, 'Lambayeque', 'Chiclayo', 'Picsi', NULL, NULL, NULL),
(1254, 'Lambayeque', 'Chiclayo', 'Pimentel', NULL, NULL, NULL),
(1255, 'Lambayeque', 'Chiclayo', 'Reque', NULL, NULL, NULL),
(1256, 'Lambayeque', 'Chiclayo', 'Santa Rosa', NULL, NULL, NULL),
(1257, 'Lambayeque', 'Chiclayo', 'Saña', NULL, NULL, NULL),
(1258, 'Lambayeque', 'Chiclayo', 'Cayalti', NULL, NULL, NULL),
(1259, 'Lambayeque', 'Chiclayo', 'Patapo', NULL, NULL, NULL),
(1260, 'Lambayeque', 'Chiclayo', 'Pomalca', NULL, NULL, NULL),
(1261, 'Lambayeque', 'Chiclayo', 'Pucala', NULL, NULL, NULL),
(1262, 'Lambayeque', 'Chiclayo', 'Tuman', NULL, NULL, NULL),
(1263, 'Lambayeque', 'Ferreñafe', 'Ferreñafe', NULL, NULL, NULL),
(1264, 'Lambayeque', 'Ferreñafe', 'Cañaris', NULL, NULL, NULL),
(1265, 'Lambayeque', 'Ferreñafe', 'Incahuasi', NULL, NULL, NULL),
(1266, 'Lambayeque', 'Ferreñafe', 'Manuel Antonio Mesones Muro', NULL, NULL, NULL),
(1267, 'Lambayeque', 'Ferreñafe', 'Pitipo', NULL, NULL, NULL),
(1268, 'Lambayeque', 'Ferreñafe', 'Pueblo Nuevo', NULL, NULL, NULL),
(1269, 'Lambayeque', 'Lambayeque', 'Lambayeque', NULL, NULL, NULL),
(1270, 'Lambayeque', 'Lambayeque', 'Chochope', NULL, NULL, NULL),
(1271, 'Lambayeque', 'Lambayeque', 'Illimo', NULL, NULL, NULL),
(1272, 'Lambayeque', 'Lambayeque', 'Jayanca', NULL, NULL, NULL),
(1273, 'Lambayeque', 'Lambayeque', 'Mochumi', NULL, NULL, NULL),
(1274, 'Lambayeque', 'Lambayeque', 'Morrope', NULL, NULL, NULL),
(1275, 'Lambayeque', 'Lambayeque', 'Motupe', NULL, NULL, NULL),
(1276, 'Lambayeque', 'Lambayeque', 'Olmos', NULL, NULL, NULL),
(1277, 'Lambayeque', 'Lambayeque', 'Pacora', NULL, NULL, NULL),
(1278, 'Lambayeque', 'Lambayeque', 'Salas', NULL, NULL, NULL),
(1279, 'Lambayeque', 'Lambayeque', 'San Jose', NULL, NULL, NULL),
(1280, 'Lambayeque', 'Lambayeque', 'Tucume', NULL, NULL, NULL),
(1281, 'Lima', 'Lima', 'Cercado de Lima', NULL, NULL, NULL),
(1282, 'Lima', 'Lima', 'Ancon', NULL, NULL, NULL),
(1283, 'Lima', 'Lima', 'Ate', NULL, NULL, NULL),
(1284, 'Lima', 'Lima', 'Barranco', NULL, NULL, NULL),
(1285, 'Lima', 'Lima', 'Breña', NULL, NULL, NULL),
(1286, 'Lima', 'Lima', 'Carabayllo', NULL, NULL, NULL),
(1287, 'Lima', 'Lima', 'Chaclacayo', NULL, NULL, NULL),
(1288, 'Lima', 'Lima', 'Chorrillos', NULL, NULL, NULL),
(1289, 'Lima', 'Lima', 'Cieneguilla', NULL, NULL, NULL),
(1290, 'Lima', 'Lima', 'Comas', NULL, NULL, NULL),
(1291, 'Lima', 'Lima', 'El Agustino', NULL, NULL, NULL),
(1292, 'Lima', 'Lima', 'Independencia', NULL, NULL, NULL),
(1293, 'Lima', 'Lima', 'Jesus Maria', NULL, NULL, NULL),
(1294, 'Lima', 'Lima', 'La Molina', NULL, NULL, NULL),
(1295, 'Lima', 'Lima', 'La Victoria', NULL, NULL, NULL),
(1296, 'Lima', 'Lima', 'Lince', NULL, NULL, NULL),
(1297, 'Lima', 'Lima', 'Los Olivos', NULL, NULL, NULL),
(1298, 'Lima', 'Lima', 'Lurigancho', NULL, NULL, NULL),
(1299, 'Lima', 'Lima', 'Lurin', NULL, NULL, NULL),
(1300, 'Lima', 'Lima', 'Magdalena del Mar', NULL, NULL, NULL),
(1301, 'Lima', 'Lima', 'Pueblo Libre', NULL, NULL, NULL),
(1302, 'Lima', 'Lima', 'Miraflores', NULL, NULL, NULL),
(1303, 'Lima', 'Lima', 'Pachacamac', NULL, NULL, NULL),
(1304, 'Lima', 'Lima', 'Pucusana', NULL, NULL, NULL),
(1305, 'Lima', 'Lima', 'Puente Piedra', NULL, NULL, NULL),
(1306, 'Lima', 'Lima', 'Punta Hermosa', NULL, NULL, NULL),
(1307, 'Lima', 'Lima', 'Punta Negra', NULL, NULL, NULL),
(1308, 'Lima', 'Lima', 'Rimac', NULL, NULL, NULL),
(1309, 'Lima', 'Lima', 'San Bartolo', NULL, NULL, NULL),
(1310, 'Lima', 'Lima', 'San Borja', NULL, NULL, NULL),
(1311, 'Lima', 'Lima', 'San Isidro', NULL, NULL, NULL),
(1312, 'Lima', 'Lima', 'San Juan de Lurigancho', NULL, NULL, NULL),
(1313, 'Lima', 'Lima', 'San Juan de Miraflores', NULL, NULL, NULL),
(1314, 'Lima', 'Lima', 'San Luis', NULL, NULL, NULL),
(1315, 'Lima', 'Lima', 'San Martin de Porres', NULL, NULL, NULL),
(1316, 'Lima', 'Lima', 'San Miguel', NULL, NULL, NULL),
(1317, 'Lima', 'Lima', 'Santa Anita', NULL, NULL, NULL),
(1318, 'Lima', 'Lima', 'Santa Maria del Mar', NULL, NULL, NULL),
(1319, 'Lima', 'Lima', 'Santa Rosa', NULL, NULL, NULL),
(1320, 'Lima', 'Lima', 'Santiago de Surco', NULL, NULL, NULL),
(1321, 'Lima', 'Lima', 'Surquillo', NULL, NULL, NULL),
(1322, 'Lima', 'Lima', 'Villa El Salvador', NULL, NULL, NULL),
(1323, 'Lima', 'Lima', 'Villa Maria del Triunfo', NULL, NULL, NULL),
(1324, 'Lima', 'Barranca', 'Barranca', NULL, NULL, NULL),
(1325, 'Lima', 'Barranca', 'Paramonga', NULL, NULL, NULL),
(1326, 'Lima', 'Barranca', 'Pativilca', NULL, NULL, NULL),
(1327, 'Lima', 'Barranca', 'Supe', NULL, NULL, NULL),
(1328, 'Lima', 'Barranca', 'Supe Puerto', NULL, NULL, NULL),
(1329, 'Lima', 'Cajatambo', 'Cajatambo', NULL, NULL, NULL),
(1330, 'Lima', 'Cajatambo', 'Copa', NULL, NULL, NULL),
(1331, 'Lima', 'Cajatambo', 'Gorgor', NULL, NULL, NULL),
(1332, 'Lima', 'Cajatambo', 'Huancapon', NULL, NULL, NULL),
(1333, 'Lima', 'Cajatambo', 'Manas', NULL, NULL, NULL),
(1334, 'Lima', 'Canta', 'Canta', NULL, NULL, NULL),
(1335, 'Lima', 'Canta', 'Arahuay', NULL, NULL, NULL),
(1336, 'Lima', 'Canta', 'Huamantanga', NULL, NULL, NULL),
(1337, 'Lima', 'Canta', 'Huaros', NULL, NULL, NULL),
(1338, 'Lima', 'Canta', 'Lachaqui', NULL, NULL, NULL),
(1339, 'Lima', 'Canta', 'San Buenaventura', NULL, NULL, NULL),
(1340, 'Lima', 'Canta', 'Santa Rosa de Quives', NULL, NULL, NULL),
(1341, 'Lima', 'Cañete', 'San Vicente de Cañete', NULL, NULL, NULL),
(1342, 'Lima', 'Cañete', 'Asia', NULL, NULL, NULL),
(1343, 'Lima', 'Cañete', 'Calango', NULL, NULL, NULL),
(1344, 'Lima', 'Cañete', 'Cerro Azul', NULL, NULL, NULL),
(1345, 'Lima', 'Cañete', 'Chilca', NULL, NULL, NULL),
(1346, 'Lima', 'Cañete', 'Coayllo', NULL, NULL, NULL),
(1347, 'Lima', 'Cañete', 'Imperial', NULL, NULL, NULL),
(1348, 'Lima', 'Cañete', 'Lunahuana', NULL, NULL, NULL),
(1349, 'Lima', 'Cañete', 'Mala', NULL, NULL, NULL),
(1350, 'Lima', 'Cañete', 'Nuevo Imperial', NULL, NULL, NULL),
(1351, 'Lima', 'Cañete', 'Pacaran', NULL, NULL, NULL),
(1352, 'Lima', 'Cañete', 'Quilmana', NULL, NULL, NULL),
(1353, 'Lima', 'Cañete', 'San Antonio', NULL, NULL, NULL),
(1354, 'Lima', 'Cañete', 'San Luis', NULL, NULL, NULL),
(1355, 'Lima', 'Cañete', 'Santa Cruz de Flores', NULL, NULL, NULL),
(1356, 'Lima', 'Cañete', 'Zuñiga', NULL, NULL, NULL),
(1357, 'Lima', 'Huaral', 'Huaral', NULL, NULL, NULL),
(1358, 'Lima', 'Huaral', 'Atavillos Alto', NULL, NULL, NULL),
(1359, 'Lima', 'Huaral', 'Atavillos Bajo', NULL, NULL, NULL),
(1360, 'Lima', 'Huaral', 'Aucallama', NULL, NULL, NULL),
(1361, 'Lima', 'Huaral', 'Chancay', NULL, NULL, NULL),
(1362, 'Lima', 'Huaral', 'Ihuari', NULL, NULL, NULL),
(1363, 'Lima', 'Huaral', 'Lampian', NULL, NULL, NULL),
(1364, 'Lima', 'Huaral', 'Pacaraos', NULL, NULL, NULL),
(1365, 'Lima', 'Huaral', 'San Miguel de Acos', NULL, NULL, NULL),
(1366, 'Lima', 'Huaral', 'Santa Cruz de Andamarca', NULL, NULL, NULL),
(1367, 'Lima', 'Huaral', 'Sumbilca', NULL, NULL, NULL),
(1368, 'Lima', 'Huaral', 'Veintisiete de Noviembre', NULL, NULL, NULL),
(1369, 'Lima', 'Huarochiri', 'Matucana', NULL, NULL, NULL),
(1370, 'Lima', 'Huarochiri', 'Antioquia', NULL, NULL, NULL),
(1371, 'Lima', 'Huarochiri', 'Callahuanca', NULL, NULL, NULL),
(1372, 'Lima', 'Huarochiri', 'Carampoma', NULL, NULL, NULL),
(1373, 'Lima', 'Huarochiri', 'Chicla', NULL, NULL, NULL),
(1374, 'Lima', 'Huarochiri', 'Cuenca', NULL, NULL, NULL),
(1375, 'Lima', 'Huarochiri', 'Huachupampa', NULL, NULL, NULL),
(1376, 'Lima', 'Huarochiri', 'Huanza', NULL, NULL, NULL),
(1377, 'Lima', 'Huarochiri', 'Huarochiri', NULL, NULL, NULL),
(1378, 'Lima', 'Huarochiri', 'Lahuaytambo', NULL, NULL, NULL),
(1379, 'Lima', 'Huarochiri', 'Langa', NULL, NULL, NULL),
(1380, 'Lima', 'Huarochiri', 'Laraos', NULL, NULL, NULL),
(1381, 'Lima', 'Huarochiri', 'Mariatana', NULL, NULL, NULL),
(1382, 'Lima', 'Huarochiri', 'Ricardo Palma', NULL, NULL, NULL),
(1383, 'Lima', 'Huarochiri', 'San Andres de Tupicocha', NULL, NULL, NULL),
(1384, 'Lima', 'Huarochiri', 'San Antonio', NULL, NULL, NULL),
(1385, 'Lima', 'Huarochiri', 'San Bartolome', NULL, NULL, NULL),
(1386, 'Lima', 'Huarochiri', 'San Damian', NULL, NULL, NULL),
(1387, 'Lima', 'Huarochiri', 'San Juan de Iris', NULL, NULL, NULL),
(1388, 'Lima', 'Huarochiri', 'San Juan de Tantaranche', NULL, NULL, NULL),
(1389, 'Lima', 'Huarochiri', 'San Lorenzo de Quinti', NULL, NULL, NULL),
(1390, 'Lima', 'Huarochiri', 'San Mateo', NULL, NULL, NULL),
(1391, 'Lima', 'Huarochiri', 'San Mateo de Otao', NULL, NULL, NULL),
(1392, 'Lima', 'Huarochiri', 'San Pedro de Casta', NULL, NULL, NULL),
(1393, 'Lima', 'Huarochiri', 'San Pedro de Huancayre', NULL, NULL, NULL),
(1394, 'Lima', 'Huarochiri', 'Sangallaya', NULL, NULL, NULL),
(1395, 'Lima', 'Huarochiri', 'Santa Cruz de Cocachacra', NULL, NULL, NULL),
(1396, 'Lima', 'Huarochiri', 'Santa Eulalia', NULL, NULL, NULL),
(1397, 'Lima', 'Huarochiri', 'Santiago de Anchucaya', NULL, NULL, NULL),
(1398, 'Lima', 'Huarochiri', 'Santiago de Tuna', NULL, NULL, NULL),
(1399, 'Lima', 'Huarochiri', 'Santo Domingo de Los Olleros', NULL, NULL, NULL),
(1400, 'Lima', 'Huarochiri', 'Surco', NULL, NULL, NULL),
(1401, 'Lima', 'Huaura', 'Huacho', NULL, NULL, NULL),
(1402, 'Lima', 'Huaura', 'Ambar', NULL, NULL, NULL),
(1403, 'Lima', 'Huaura', 'Caleta de Carquin', NULL, NULL, NULL),
(1404, 'Lima', 'Huaura', 'Checras', NULL, NULL, NULL),
(1405, 'Lima', 'Huaura', 'Hualmay', NULL, NULL, NULL),
(1406, 'Lima', 'Huaura', 'Huaura', NULL, NULL, NULL),
(1407, 'Lima', 'Huaura', 'Leoncio Prado', NULL, NULL, NULL),
(1408, 'Lima', 'Huaura', 'Paccho', NULL, NULL, NULL),
(1409, 'Lima', 'Huaura', 'Santa Leonor', NULL, NULL, NULL),
(1410, 'Lima', 'Huaura', 'Santa Maria', NULL, NULL, NULL),
(1411, 'Lima', 'Huaura', 'Sayan', NULL, NULL, NULL),
(1412, 'Lima', 'Huaura', 'Vegueta', NULL, NULL, NULL),
(1413, 'Lima', 'Oyon', 'Oyon', NULL, NULL, NULL),
(1414, 'Lima', 'Oyon', 'Andajes', NULL, NULL, NULL),
(1415, 'Lima', 'Oyon', 'Caujul', NULL, NULL, NULL),
(1416, 'Lima', 'Oyon', 'Cochamarca', NULL, NULL, NULL),
(1417, 'Lima', 'Oyon', 'Navan', NULL, NULL, NULL),
(1418, 'Lima', 'Oyon', 'Pachangara', NULL, NULL, NULL),
(1419, 'Lima', 'Yauyos', 'Yauyos', NULL, NULL, NULL),
(1420, 'Lima', 'Yauyos', 'Alis', NULL, NULL, NULL),
(1421, 'Lima', 'Yauyos', 'Allauca', NULL, NULL, NULL),
(1422, 'Lima', 'Yauyos', 'Ayaviri', NULL, NULL, NULL),
(1423, 'Lima', 'Yauyos', 'Azangaro', NULL, NULL, NULL),
(1424, 'Lima', 'Yauyos', 'Cacra', NULL, NULL, NULL),
(1425, 'Lima', 'Yauyos', 'Carania', NULL, NULL, NULL),
(1426, 'Lima', 'Yauyos', 'Catahuasi', NULL, NULL, NULL),
(1427, 'Lima', 'Yauyos', 'Chocos', NULL, NULL, NULL),
(1428, 'Lima', 'Yauyos', 'Cochas', NULL, NULL, NULL),
(1429, 'Lima', 'Yauyos', 'Colonia', NULL, NULL, NULL),
(1430, 'Lima', 'Yauyos', 'Hongos', NULL, NULL, NULL),
(1431, 'Lima', 'Yauyos', 'Huampara', NULL, NULL, NULL),
(1432, 'Lima', 'Yauyos', 'Huancaya', NULL, NULL, NULL),
(1433, 'Lima', 'Yauyos', 'Huangascar', NULL, NULL, NULL),
(1434, 'Lima', 'Yauyos', 'Huantan', NULL, NULL, NULL),
(1435, 'Lima', 'Yauyos', 'Huañec', NULL, NULL, NULL),
(1436, 'Lima', 'Yauyos', 'Laraos', NULL, NULL, NULL),
(1437, 'Lima', 'Yauyos', 'Lincha', NULL, NULL, NULL),
(1438, 'Lima', 'Yauyos', 'Madean', NULL, NULL, NULL),
(1439, 'Lima', 'Yauyos', 'Miraflores', NULL, NULL, NULL),
(1440, 'Lima', 'Yauyos', 'Omas', NULL, NULL, NULL),
(1441, 'Lima', 'Yauyos', 'Putinza', NULL, NULL, NULL),
(1442, 'Lima', 'Yauyos', 'Quinches', NULL, NULL, NULL),
(1443, 'Lima', 'Yauyos', 'Quinocay', NULL, NULL, NULL),
(1444, 'Lima', 'Yauyos', 'San Joaquin', NULL, NULL, NULL),
(1445, 'Lima', 'Yauyos', 'San Pedro de Pilas', NULL, NULL, NULL),
(1446, 'Lima', 'Yauyos', 'Tanta', NULL, NULL, NULL),
(1447, 'Lima', 'Yauyos', 'Tauripampa', NULL, NULL, NULL),
(1448, 'Lima', 'Yauyos', 'Tomas', NULL, NULL, NULL),
(1449, 'Lima', 'Yauyos', 'Tupe', NULL, NULL, NULL),
(1450, 'Lima', 'Yauyos', 'Viñac', NULL, NULL, NULL),
(1451, 'Lima', 'Yauyos', 'Vitis', NULL, NULL, NULL),
(1452, 'Loreto', 'Maynas', 'Iquitos', NULL, NULL, NULL),
(1453, 'Loreto', 'Maynas', 'Alto Nanay', NULL, NULL, NULL),
(1454, 'Loreto', 'Maynas', 'Fernando Lores', NULL, NULL, NULL),
(1455, 'Loreto', 'Maynas', 'Indiana', NULL, NULL, NULL),
(1456, 'Loreto', 'Maynas', 'Las Amazonas', NULL, NULL, NULL),
(1457, 'Loreto', 'Maynas', 'Mazan', NULL, NULL, NULL),
(1458, 'Loreto', 'Maynas', 'Napo', NULL, NULL, NULL),
(1459, 'Loreto', 'Maynas', 'Punchana', NULL, NULL, NULL),
(1460, 'Loreto', 'Maynas', 'Torres Causana', NULL, NULL, NULL),
(1461, 'Loreto', 'Maynas', 'Belen', NULL, NULL, NULL),
(1462, 'Loreto', 'Maynas', 'San Juan Bautista', NULL, NULL, NULL),
(1463, 'Loreto', 'Alto Amazonas', 'Yurimaguas', NULL, NULL, NULL),
(1464, 'Loreto', 'Alto Amazonas', 'Balsapuerto', NULL, NULL, NULL),
(1465, 'Loreto', 'Alto Amazonas', 'Jeberos', NULL, NULL, NULL),
(1466, 'Loreto', 'Alto Amazonas', 'Lagunas', NULL, NULL, NULL),
(1467, 'Loreto', 'Alto Amazonas', 'Santa Cruz', NULL, NULL, NULL),
(1468, 'Loreto', 'Alto Amazonas', 'Teniente Cesar Lopez Rojas', NULL, NULL, NULL),
(1469, 'Loreto', 'Loreto', 'Nauta', NULL, NULL, NULL),
(1470, 'Loreto', 'Loreto', 'Parinari', NULL, NULL, NULL),
(1471, 'Loreto', 'Loreto', 'Tigre', NULL, NULL, NULL),
(1472, 'Loreto', 'Loreto', 'Trompeteros', NULL, NULL, NULL),
(1473, 'Loreto', 'Loreto', 'Urarinas', NULL, NULL, NULL),
(1474, 'Loreto', 'Mariscal Ramon Castilla', 'Ramon Castilla', NULL, NULL, NULL),
(1475, 'Loreto', 'Mariscal Ramon Castilla', 'Pebas', NULL, NULL, NULL),
(1476, 'Loreto', 'Mariscal Ramon Castilla', 'Yavari', NULL, NULL, NULL),
(1477, 'Loreto', 'Mariscal Ramon Castilla', 'San Pablo', NULL, NULL, NULL),
(1478, 'Loreto', 'Requena', 'Requena', NULL, NULL, NULL),
(1479, 'Loreto', 'Requena', 'Alto Tapiche', NULL, NULL, NULL),
(1480, 'Loreto', 'Requena', 'Capelo', NULL, NULL, NULL),
(1481, 'Loreto', 'Requena', 'Emilio San Martin', NULL, NULL, NULL),
(1482, 'Loreto', 'Requena', 'Maquia', NULL, NULL, NULL),
(1483, 'Loreto', 'Requena', 'Puinahua', NULL, NULL, NULL),
(1484, 'Loreto', 'Requena', 'Saquena', NULL, NULL, NULL),
(1485, 'Loreto', 'Requena', 'Soplin', NULL, NULL, NULL),
(1486, 'Loreto', 'Requena', 'Tapiche', NULL, NULL, NULL),
(1487, 'Loreto', 'Requena', 'Jenaro Herrera', NULL, NULL, NULL),
(1488, 'Loreto', 'Requena', 'Yaquerana', NULL, NULL, NULL),
(1489, 'Loreto', 'Ucayali', 'Contamana', NULL, NULL, NULL),
(1490, 'Loreto', 'Ucayali', 'Inahuaya', NULL, NULL, NULL),
(1491, 'Loreto', 'Ucayali', 'Padre Marquez', NULL, NULL, NULL),
(1492, 'Loreto', 'Ucayali', 'Pampa Hermosa', NULL, NULL, NULL),
(1493, 'Loreto', 'Ucayali', 'Sarayacu', NULL, NULL, NULL),
(1494, 'Loreto', 'Ucayali', 'Vargas Guerra', NULL, NULL, NULL),
(1495, 'Loreto', 'Datem del Marañón', 'Barranca', NULL, NULL, NULL),
(1496, 'Loreto', 'Datem del Marañón', 'Cahuapanas', NULL, NULL, NULL),
(1497, 'Loreto', 'Datem del Marañón', 'Manseriche', NULL, NULL, NULL),
(1498, 'Loreto', 'Datem del Marañón', 'Morona', NULL, NULL, NULL),
(1499, 'Loreto', 'Datem del Marañón', 'Pastaza', NULL, NULL, NULL),
(1500, 'Loreto', 'Datem del Marañón', 'Andoas', NULL, NULL, NULL),
(1501, 'Loreto', 'Putumayo', 'Putumayo', NULL, NULL, NULL),
(1502, 'Loreto', 'Putumayo', 'Rosa Panduro', NULL, NULL, NULL),
(1503, 'Loreto', 'Putumayo', 'Teniente Manuel Clavero', NULL, NULL, NULL),
(1504, 'Loreto', 'Putumayo', 'Yaguas', NULL, NULL, NULL),
(1505, 'Madre de Dios', 'Tambopata', 'Tambopata', NULL, NULL, NULL),
(1506, 'Madre de Dios', 'Tambopata', 'Inambari', NULL, NULL, NULL),
(1507, 'Madre de Dios', 'Tambopata', 'Las Piedras', NULL, NULL, NULL),
(1508, 'Madre de Dios', 'Tambopata', 'Laberinto', NULL, NULL, NULL),
(1509, 'Madre de Dios', 'Manu', 'Manu', NULL, NULL, NULL),
(1510, 'Madre de Dios', 'Manu', 'Fitzcarrald', NULL, NULL, NULL),
(1511, 'Madre de Dios', 'Manu', 'Madre de Dios', NULL, NULL, NULL),
(1512, 'Madre de Dios', 'Manu', 'Huepetuhe', NULL, NULL, NULL),
(1513, 'Madre de Dios', 'Tahuamanu', 'Iñapari', NULL, NULL, NULL),
(1514, 'Madre de Dios', 'Tahuamanu', 'Iberia', NULL, NULL, NULL),
(1515, 'Madre de Dios', 'Tahuamanu', 'Tahuamanu', NULL, NULL, NULL),
(1516, 'Moquegua', 'Mariscal Nieto', 'Moquegua', NULL, NULL, NULL),
(1517, 'Moquegua', 'Mariscal Nieto', 'Carumas', NULL, NULL, NULL),
(1518, 'Moquegua', 'Mariscal Nieto', 'Cuchumbaya', NULL, NULL, NULL),
(1519, 'Moquegua', 'Mariscal Nieto', 'Samegua', NULL, NULL, NULL),
(1520, 'Moquegua', 'Mariscal Nieto', 'San Cristobal', NULL, NULL, NULL),
(1521, 'Moquegua', 'Mariscal Nieto', 'Torata', NULL, NULL, NULL),
(1522, 'Moquegua', 'General Sanchez Cerro', 'Omate', NULL, NULL, NULL),
(1523, 'Moquegua', 'General Sanchez Cerro', 'Chojata', NULL, NULL, NULL),
(1524, 'Moquegua', 'General Sanchez Cerro', 'Coalaque', NULL, NULL, NULL),
(1525, 'Moquegua', 'General Sanchez Cerro', 'Ichuña', NULL, NULL, NULL),
(1526, 'Moquegua', 'General Sanchez Cerro', 'La Capilla', NULL, NULL, NULL),
(1527, 'Moquegua', 'General Sanchez Cerro', 'Lloque', NULL, NULL, NULL),
(1528, 'Moquegua', 'General Sanchez Cerro', 'Matalaque', NULL, NULL, NULL),
(1529, 'Moquegua', 'General Sanchez Cerro', 'Puquina', NULL, NULL, NULL),
(1530, 'Moquegua', 'General Sanchez Cerro', 'Quinistaquillas', NULL, NULL, NULL),
(1531, 'Moquegua', 'General Sanchez Cerro', 'Ubinas', NULL, NULL, NULL),
(1532, 'Moquegua', 'General Sanchez Cerro', 'Yunga', NULL, NULL, NULL),
(1533, 'Moquegua', 'Ilo', 'Ilo', NULL, NULL, NULL),
(1534, 'Moquegua', 'Ilo', 'El Algarrobal', NULL, NULL, NULL),
(1535, 'Moquegua', 'Ilo', 'Pacocha', NULL, NULL, NULL),
(1536, 'Pasco', 'Pasco', 'Chaupimarca', NULL, NULL, NULL),
(1537, 'Pasco', 'Pasco', 'Huachon', NULL, NULL, NULL),
(1538, 'Pasco', 'Pasco', 'Huariaca', NULL, NULL, NULL),
(1539, 'Pasco', 'Pasco', 'Huayllay', NULL, NULL, NULL),
(1540, 'Pasco', 'Pasco', 'Ninacaca', NULL, NULL, NULL),
(1541, 'Pasco', 'Pasco', 'Pallanchacra', NULL, NULL, NULL),
(1542, 'Pasco', 'Pasco', 'Paucartambo', NULL, NULL, NULL),
(1543, 'Pasco', 'Pasco', 'San Francisco de Asis de Yarusyacan', NULL, NULL, NULL),
(1544, 'Pasco', 'Pasco', 'Simon Bolivar', NULL, NULL, NULL),
(1545, 'Pasco', 'Pasco', 'Ticlacayan', NULL, NULL, NULL),
(1546, 'Pasco', 'Pasco', 'Tinyahuarco', NULL, NULL, NULL),
(1547, 'Pasco', 'Pasco', 'Vicco', NULL, NULL, NULL),
(1548, 'Pasco', 'Pasco', 'Yanacancha', NULL, NULL, NULL),
(1549, 'Pasco', 'Daniel Alcides Carrion', 'Yanahuanca', NULL, NULL, NULL),
(1550, 'Pasco', 'Daniel Alcides Carrion', 'Chacayan', NULL, NULL, NULL),
(1551, 'Pasco', 'Daniel Alcides Carrion', 'Goyllarisquizga', NULL, NULL, NULL),
(1552, 'Pasco', 'Daniel Alcides Carrion', 'Paucar', NULL, NULL, NULL),
(1553, 'Pasco', 'Daniel Alcides Carrion', 'San Pedro de Pillao', NULL, NULL, NULL),
(1554, 'Pasco', 'Daniel Alcides Carrion', 'Santa Ana de Tusi', NULL, NULL, NULL),
(1555, 'Pasco', 'Daniel Alcides Carrion', 'Tapuc', NULL, NULL, NULL),
(1556, 'Pasco', 'Daniel Alcides Carrion', 'Vilcabamba', NULL, NULL, NULL),
(1557, 'Pasco', 'Oxapampa', 'Oxapampa', NULL, NULL, NULL),
(1558, 'Pasco', 'Oxapampa', 'Chontabamba', NULL, NULL, NULL),
(1559, 'Pasco', 'Oxapampa', 'Huancabamba', NULL, NULL, NULL),
(1560, 'Pasco', 'Oxapampa', 'Palcazu', NULL, NULL, NULL),
(1561, 'Pasco', 'Oxapampa', 'Pozuzo', NULL, NULL, NULL),
(1562, 'Pasco', 'Oxapampa', 'Puerto Bermudez', NULL, NULL, NULL),
(1563, 'Pasco', 'Oxapampa', 'Villa Rica', NULL, NULL, NULL),
(1564, 'Pasco', 'Oxapampa', 'Constitucion', NULL, NULL, NULL),
(1565, 'Piura', 'Piura', 'Piura', NULL, NULL, NULL),
(1566, 'Piura', 'Piura', 'Castilla', NULL, NULL, NULL),
(1567, 'Piura', 'Piura', 'Catacaos', NULL, NULL, NULL),
(1568, 'Piura', 'Piura', 'Cura Mori', NULL, NULL, NULL),
(1569, 'Piura', 'Piura', 'El Tallan', NULL, NULL, NULL),
(1570, 'Piura', 'Piura', 'La Arena', NULL, NULL, NULL),
(1571, 'Piura', 'Piura', 'La Union', NULL, NULL, NULL),
(1572, 'Piura', 'Piura', 'Las Lomas', NULL, NULL, NULL),
(1573, 'Piura', 'Piura', 'Tambo Grande', NULL, NULL, NULL),
(1574, 'Piura', 'Piura', 'Veintiseis de Octubre', NULL, NULL, NULL),
(1575, 'Piura', 'Ayabaca', 'Ayabaca', NULL, NULL, NULL),
(1576, 'Piura', 'Ayabaca', 'Frias', NULL, NULL, NULL),
(1577, 'Piura', 'Ayabaca', 'Jilili', NULL, NULL, NULL),
(1578, 'Piura', 'Ayabaca', 'Lagunas', NULL, NULL, NULL),
(1579, 'Piura', 'Ayabaca', 'Montero', NULL, NULL, NULL),
(1580, 'Piura', 'Ayabaca', 'Pacaipampa', NULL, NULL, NULL),
(1581, 'Piura', 'Ayabaca', 'Paimas', NULL, NULL, NULL),
(1582, 'Piura', 'Ayabaca', 'Sapillica', NULL, NULL, NULL),
(1583, 'Piura', 'Ayabaca', 'Sicchez', NULL, NULL, NULL),
(1584, 'Piura', 'Ayabaca', 'Suyo', NULL, NULL, NULL),
(1585, 'Piura', 'Huancabamba', 'Huancabamba', NULL, NULL, NULL),
(1586, 'Piura', 'Huancabamba', 'Canchaque', NULL, NULL, NULL),
(1587, 'Piura', 'Huancabamba', 'El Carmen de la Frontera', NULL, NULL, NULL),
(1588, 'Piura', 'Huancabamba', 'Huarmaca', NULL, NULL, NULL),
(1589, 'Piura', 'Huancabamba', 'Lalaquiz', NULL, NULL, NULL),
(1590, 'Piura', 'Huancabamba', 'San Miguel de El Faique', NULL, NULL, NULL),
(1591, 'Piura', 'Huancabamba', 'Sondor', NULL, NULL, NULL),
(1592, 'Piura', 'Huancabamba', 'Sondorillo', NULL, NULL, NULL),
(1593, 'Piura', 'Morropon', 'Chulucanas', NULL, NULL, NULL),
(1594, 'Piura', 'Morropon', 'Buenos Aires', NULL, NULL, NULL),
(1595, 'Piura', 'Morropon', 'Chalaco', NULL, NULL, NULL),
(1596, 'Piura', 'Morropon', 'La Matanza', NULL, NULL, NULL),
(1597, 'Piura', 'Morropon', 'Morropon', NULL, NULL, NULL),
(1598, 'Piura', 'Morropon', 'Salitral', NULL, NULL, NULL),
(1599, 'Piura', 'Morropon', 'San Juan de Bigote', NULL, NULL, NULL),
(1600, 'Piura', 'Morropon', 'Santa Catalina de Mossa', NULL, NULL, NULL),
(1601, 'Piura', 'Morropon', 'Santo Domingo', NULL, NULL, NULL),
(1602, 'Piura', 'Morropon', 'Yamango', NULL, NULL, NULL),
(1603, 'Piura', 'Paita', 'Paita', NULL, NULL, NULL),
(1604, 'Piura', 'Paita', 'Amotape', NULL, NULL, NULL),
(1605, 'Piura', 'Paita', 'Arenal', NULL, NULL, NULL),
(1606, 'Piura', 'Paita', 'Colan', NULL, NULL, NULL),
(1607, 'Piura', 'Paita', 'La Huaca', NULL, NULL, NULL),
(1608, 'Piura', 'Paita', 'Tamarindo', NULL, NULL, NULL),
(1609, 'Piura', 'Paita', 'Vichayal', NULL, NULL, NULL),
(1610, 'Piura', 'Sullana', 'Sullana', NULL, NULL, NULL),
(1611, 'Piura', 'Sullana', 'Bellavista', NULL, NULL, NULL),
(1612, 'Piura', 'Sullana', 'Ignacio Escudero', NULL, NULL, NULL),
(1613, 'Piura', 'Sullana', 'Lancones', NULL, NULL, NULL),
(1614, 'Piura', 'Sullana', 'Marcavelica', NULL, NULL, NULL),
(1615, 'Piura', 'Sullana', 'Miguel Checa', NULL, NULL, NULL),
(1616, 'Piura', 'Sullana', 'Querecotillo', NULL, NULL, NULL),
(1617, 'Piura', 'Sullana', 'Salitral', NULL, NULL, NULL),
(1618, 'Piura', 'Talara', 'Pariñas', NULL, NULL, NULL),
(1619, 'Piura', 'Talara', 'El Alto', NULL, NULL, NULL),
(1620, 'Piura', 'Talara', 'La Brea', NULL, NULL, NULL),
(1621, 'Piura', 'Talara', 'Lobitos', NULL, NULL, NULL),
(1622, 'Piura', 'Talara', 'Los Organos', NULL, NULL, NULL),
(1623, 'Piura', 'Talara', 'Mancora', NULL, NULL, NULL),
(1624, 'Piura', 'Sechura', 'Sechura', NULL, NULL, NULL),
(1625, 'Piura', 'Sechura', 'Bellavista de la Union', NULL, NULL, NULL),
(1626, 'Piura', 'Sechura', 'Bernal', NULL, NULL, NULL),
(1627, 'Piura', 'Sechura', 'Cristo Nos Valga', NULL, NULL, NULL),
(1628, 'Piura', 'Sechura', 'Vice', NULL, NULL, NULL),
(1629, 'Piura', 'Sechura', 'Rinconada Llicuar', NULL, NULL, NULL),
(1630, 'Puno', 'Puno', 'Puno', NULL, NULL, NULL),
(1631, 'Puno', 'Puno', 'Acora', NULL, NULL, NULL),
(1632, 'Puno', 'Puno', 'Amantani', NULL, NULL, NULL),
(1633, 'Puno', 'Puno', 'Atuncolla', NULL, NULL, NULL),
(1634, 'Puno', 'Puno', 'Capachica', NULL, NULL, NULL),
(1635, 'Puno', 'Puno', 'Chucuito', NULL, NULL, NULL),
(1636, 'Puno', 'Puno', 'Coata', NULL, NULL, NULL),
(1637, 'Puno', 'Puno', 'Huata', NULL, NULL, NULL),
(1638, 'Puno', 'Puno', 'Mañazo', NULL, NULL, NULL),
(1639, 'Puno', 'Puno', 'Paucarcolla', NULL, NULL, NULL),
(1640, 'Puno', 'Puno', 'Pichacani', NULL, NULL, NULL),
(1641, 'Puno', 'Puno', 'Plateria', NULL, NULL, NULL),
(1642, 'Puno', 'Puno', 'San Antonio', NULL, NULL, NULL),
(1643, 'Puno', 'Puno', 'Tiquillaca', NULL, NULL, NULL),
(1644, 'Puno', 'Puno', 'Vilque', NULL, NULL, NULL),
(1645, 'Puno', 'Azangaro', 'Azangaro', NULL, NULL, NULL),
(1646, 'Puno', 'Azangaro', 'Achaya', NULL, NULL, NULL),
(1647, 'Puno', 'Azangaro', 'Arapa', NULL, NULL, NULL),
(1648, 'Puno', 'Azangaro', 'Asillo', NULL, NULL, NULL),
(1649, 'Puno', 'Azangaro', 'Caminaca', NULL, NULL, NULL),
(1650, 'Puno', 'Azangaro', 'Chupa', NULL, NULL, NULL),
(1651, 'Puno', 'Azangaro', 'Jose Domingo Choquehuanca', NULL, NULL, NULL),
(1652, 'Puno', 'Azangaro', 'Muñani', NULL, NULL, NULL),
(1653, 'Puno', 'Azangaro', 'Potoni', NULL, NULL, NULL),
(1654, 'Puno', 'Azangaro', 'Saman', NULL, NULL, NULL),
(1655, 'Puno', 'Azangaro', 'San Anton', NULL, NULL, NULL),
(1656, 'Puno', 'Azangaro', 'San Jose', NULL, NULL, NULL),
(1657, 'Puno', 'Azangaro', 'San Juan de Salinas', NULL, NULL, NULL),
(1658, 'Puno', 'Azangaro', 'Santiago de Pupuja', NULL, NULL, NULL),
(1659, 'Puno', 'Azangaro', 'Tirapata', NULL, NULL, NULL),
(1660, 'Puno', 'Carabaya', 'Macusani', NULL, NULL, NULL),
(1661, 'Puno', 'Carabaya', 'Ajoyani', NULL, NULL, NULL),
(1662, 'Puno', 'Carabaya', 'Ayapata', NULL, NULL, NULL),
(1663, 'Puno', 'Carabaya', 'Coasa', NULL, NULL, NULL),
(1664, 'Puno', 'Carabaya', 'Corani', NULL, NULL, NULL),
(1665, 'Puno', 'Carabaya', 'Crucero', NULL, NULL, NULL),
(1666, 'Puno', 'Carabaya', 'Ituata', NULL, NULL, NULL),
(1667, 'Puno', 'Carabaya', 'Ollachea', NULL, NULL, NULL);
INSERT INTO `ubigeos` (`id`, `department`, `province`, `district`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1668, 'Puno', 'Carabaya', 'San Gaban', NULL, NULL, NULL),
(1669, 'Puno', 'Carabaya', 'Usicayos', NULL, NULL, NULL),
(1670, 'Puno', 'Chucuito', 'Juli', NULL, NULL, NULL),
(1671, 'Puno', 'Chucuito', 'Desaguadero', NULL, NULL, NULL),
(1672, 'Puno', 'Chucuito', 'Huacullani', NULL, NULL, NULL),
(1673, 'Puno', 'Chucuito', 'Kelluyo', NULL, NULL, NULL),
(1674, 'Puno', 'Chucuito', 'Pisacoma', NULL, NULL, NULL),
(1675, 'Puno', 'Chucuito', 'Pomata', NULL, NULL, NULL),
(1676, 'Puno', 'Chucuito', 'Zepita', NULL, NULL, NULL),
(1677, 'Puno', 'El Collao', 'Ilave', NULL, NULL, NULL),
(1678, 'Puno', 'El Collao', 'Capazo', NULL, NULL, NULL),
(1679, 'Puno', 'El Collao', 'Pilcuyo', NULL, NULL, NULL),
(1680, 'Puno', 'El Collao', 'Santa Rosa', NULL, NULL, NULL),
(1681, 'Puno', 'El Collao', 'Conduriri', NULL, NULL, NULL),
(1682, 'Puno', 'Huancane', 'Huancane', NULL, NULL, NULL),
(1683, 'Puno', 'Huancane', 'Cojata', NULL, NULL, NULL),
(1684, 'Puno', 'Huancane', 'Huatasani', NULL, NULL, NULL),
(1685, 'Puno', 'Huancane', 'Inchupalla', NULL, NULL, NULL),
(1686, 'Puno', 'Huancane', 'Pusi', NULL, NULL, NULL),
(1687, 'Puno', 'Huancane', 'Rosaspata', NULL, NULL, NULL),
(1688, 'Puno', 'Huancane', 'Taraco', NULL, NULL, NULL),
(1689, 'Puno', 'Huancane', 'Vilque Chico', NULL, NULL, NULL),
(1690, 'Puno', 'Lampa', 'Lampa', NULL, NULL, NULL),
(1691, 'Puno', 'Lampa', 'Cabanilla', NULL, NULL, NULL),
(1692, 'Puno', 'Lampa', 'Calapuja', NULL, NULL, NULL),
(1693, 'Puno', 'Lampa', 'Nicasio', NULL, NULL, NULL),
(1694, 'Puno', 'Lampa', 'Ocuviri', NULL, NULL, NULL),
(1695, 'Puno', 'Lampa', 'Palca', NULL, NULL, NULL),
(1696, 'Puno', 'Lampa', 'Paratia', NULL, NULL, NULL),
(1697, 'Puno', 'Lampa', 'Pucara', NULL, NULL, NULL),
(1698, 'Puno', 'Lampa', 'Santa Lucia', NULL, NULL, NULL),
(1699, 'Puno', 'Lampa', 'Vilavila', NULL, NULL, NULL),
(1700, 'Puno', 'Melgar', 'Ayaviri', NULL, NULL, NULL),
(1701, 'Puno', 'Melgar', 'Antauta', NULL, NULL, NULL),
(1702, 'Puno', 'Melgar', 'Cupi', NULL, NULL, NULL),
(1703, 'Puno', 'Melgar', 'Llalli', NULL, NULL, NULL),
(1704, 'Puno', 'Melgar', 'Macari', NULL, NULL, NULL),
(1705, 'Puno', 'Melgar', 'Nuñoa', NULL, NULL, NULL),
(1706, 'Puno', 'Melgar', 'Orurillo', NULL, NULL, NULL),
(1707, 'Puno', 'Melgar', 'Santa Rosa', NULL, NULL, NULL),
(1708, 'Puno', 'Melgar', 'Umachiri', NULL, NULL, NULL),
(1709, 'Puno', 'Moho', 'Moho', NULL, NULL, NULL),
(1710, 'Puno', 'Moho', 'Conima', NULL, NULL, NULL),
(1711, 'Puno', 'Moho', 'Huayrapata', NULL, NULL, NULL),
(1712, 'Puno', 'Moho', 'Tilali', NULL, NULL, NULL),
(1713, 'Puno', 'San Antonio de Putina', 'Putina', NULL, NULL, NULL),
(1714, 'Puno', 'San Antonio de Putina', 'Ananea', NULL, NULL, NULL),
(1715, 'Puno', 'San Antonio de Putina', 'Pedro Vilca Apaza', NULL, NULL, NULL),
(1716, 'Puno', 'San Antonio de Putina', 'Quilcapuncu', NULL, NULL, NULL),
(1717, 'Puno', 'San Antonio de Putina', 'Sina', NULL, NULL, NULL),
(1718, 'Puno', 'San Roman', 'Juliaca', NULL, NULL, NULL),
(1719, 'Puno', 'San Roman', 'Cabana', NULL, NULL, NULL),
(1720, 'Puno', 'San Roman', 'Cabanillas', NULL, NULL, NULL),
(1721, 'Puno', 'San Roman', 'Caracoto', NULL, NULL, NULL),
(1722, 'Puno', 'San Roman', 'San Miguel', NULL, NULL, NULL),
(1723, 'Puno', 'Sandia', 'Sandia', NULL, NULL, NULL),
(1724, 'Puno', 'Sandia', 'Cuyocuyo', NULL, NULL, NULL),
(1725, 'Puno', 'Sandia', 'Limbani', NULL, NULL, NULL),
(1726, 'Puno', 'Sandia', 'Patambuco', NULL, NULL, NULL),
(1727, 'Puno', 'Sandia', 'Phara', NULL, NULL, NULL),
(1728, 'Puno', 'Sandia', 'Quiaca', NULL, NULL, NULL),
(1729, 'Puno', 'Sandia', 'San Juan del Oro', NULL, NULL, NULL),
(1730, 'Puno', 'Sandia', 'Yanahuaya', NULL, NULL, NULL),
(1731, 'Puno', 'Sandia', 'Alto Inambari', NULL, NULL, NULL),
(1732, 'Puno', 'Sandia', 'San Pedro de Putina Punco', NULL, NULL, NULL),
(1733, 'Puno', 'Yunguyo', 'Yunguyo', NULL, NULL, NULL),
(1734, 'Puno', 'Yunguyo', 'Anapia', NULL, NULL, NULL),
(1735, 'Puno', 'Yunguyo', 'Copani', NULL, NULL, NULL),
(1736, 'Puno', 'Yunguyo', 'Cuturapi', NULL, NULL, NULL),
(1737, 'Puno', 'Yunguyo', 'Ollaraya', NULL, NULL, NULL),
(1738, 'Puno', 'Yunguyo', 'Tinicachi', NULL, NULL, NULL),
(1739, 'Puno', 'Yunguyo', 'Unicachi', NULL, NULL, NULL),
(1740, 'San Martin', 'Moyobamba', 'Moyobamba', NULL, NULL, NULL),
(1741, 'San Martin', 'Moyobamba', 'Calzada', NULL, NULL, NULL),
(1742, 'San Martin', 'Moyobamba', 'Habana', NULL, NULL, NULL),
(1743, 'San Martin', 'Moyobamba', 'Jepelacio', NULL, NULL, NULL),
(1744, 'San Martin', 'Moyobamba', 'Soritor', NULL, NULL, NULL),
(1745, 'San Martin', 'Moyobamba', 'Yantalo', NULL, NULL, NULL),
(1746, 'San Martin', 'Bellavista', 'Bellavista', NULL, NULL, NULL),
(1747, 'San Martin', 'Bellavista', 'Alto Biavo', NULL, NULL, NULL),
(1748, 'San Martin', 'Bellavista', 'Bajo Biavo', NULL, NULL, NULL),
(1749, 'San Martin', 'Bellavista', 'Huallaga', NULL, NULL, NULL),
(1750, 'San Martin', 'Bellavista', 'San Pablo', NULL, NULL, NULL),
(1751, 'San Martin', 'Bellavista', 'San Rafael', NULL, NULL, NULL),
(1752, 'San Martin', 'El Dorado', 'San Jose de Sisa', NULL, NULL, NULL),
(1753, 'San Martin', 'El Dorado', 'Agua Blanca', NULL, NULL, NULL),
(1754, 'San Martin', 'El Dorado', 'San Martin', NULL, NULL, NULL),
(1755, 'San Martin', 'El Dorado', 'Santa Rosa', NULL, NULL, NULL),
(1756, 'San Martin', 'El Dorado', 'Shatoja', NULL, NULL, NULL),
(1757, 'San Martin', 'Huallaga', 'Saposoa', NULL, NULL, NULL),
(1758, 'San Martin', 'Huallaga', 'Alto Saposoa', NULL, NULL, NULL),
(1759, 'San Martin', 'Huallaga', 'El Eslabon', NULL, NULL, NULL),
(1760, 'San Martin', 'Huallaga', 'Piscoyacu', NULL, NULL, NULL),
(1761, 'San Martin', 'Huallaga', 'Sacanche', NULL, NULL, NULL),
(1762, 'San Martin', 'Huallaga', 'Tingo de Saposoa', NULL, NULL, NULL),
(1763, 'San Martin', 'Lamas', 'Lamas', NULL, NULL, NULL),
(1764, 'San Martin', 'Lamas', 'Alonso de Alvarado', NULL, NULL, NULL),
(1765, 'San Martin', 'Lamas', 'Barranquita', NULL, NULL, NULL),
(1766, 'San Martin', 'Lamas', 'Caynarachi', NULL, NULL, NULL),
(1767, 'San Martin', 'Lamas', 'Cuñumbuqui', NULL, NULL, NULL),
(1768, 'San Martin', 'Lamas', 'Pinto Recodo', NULL, NULL, NULL),
(1769, 'San Martin', 'Lamas', 'Rumisapa', NULL, NULL, NULL),
(1770, 'San Martin', 'Lamas', 'San Roque de Cumbaza', NULL, NULL, NULL),
(1771, 'San Martin', 'Lamas', 'Shanao', NULL, NULL, NULL),
(1772, 'San Martin', 'Lamas', 'Tabalosos', NULL, NULL, NULL),
(1773, 'San Martin', 'Lamas', 'Zapatero', NULL, NULL, NULL),
(1774, 'San Martin', 'Mariscal Caceres', 'Juanjui', NULL, NULL, NULL),
(1775, 'San Martin', 'Mariscal Caceres', 'Campanilla', NULL, NULL, NULL),
(1776, 'San Martin', 'Mariscal Caceres', 'Huicungo', NULL, NULL, NULL),
(1777, 'San Martin', 'Mariscal Caceres', 'Pachiza', NULL, NULL, NULL),
(1778, 'San Martin', 'Mariscal Caceres', 'Pajarillo', NULL, NULL, NULL),
(1779, 'San Martin', 'Picota', 'Picota', NULL, NULL, NULL),
(1780, 'San Martin', 'Picota', 'Buenos Aires', NULL, NULL, NULL),
(1781, 'San Martin', 'Picota', 'Caspisapa', NULL, NULL, NULL),
(1782, 'San Martin', 'Picota', 'Pilluana', NULL, NULL, NULL),
(1783, 'San Martin', 'Picota', 'Pucacaca', NULL, NULL, NULL),
(1784, 'San Martin', 'Picota', 'San Cristobal', NULL, NULL, NULL),
(1785, 'San Martin', 'Picota', 'San Hilarion', NULL, NULL, NULL),
(1786, 'San Martin', 'Picota', 'Shamboyacu', NULL, NULL, NULL),
(1787, 'San Martin', 'Picota', 'Tingo de Ponasa', NULL, NULL, NULL),
(1788, 'San Martin', 'Picota', 'Tres Unidos', NULL, NULL, NULL),
(1789, 'San Martin', 'Rioja', 'Rioja', NULL, NULL, NULL),
(1790, 'San Martin', 'Rioja', 'Awajun', NULL, NULL, NULL),
(1791, 'San Martin', 'Rioja', 'Elias Soplin Vargas', NULL, NULL, NULL),
(1792, 'San Martin', 'Rioja', 'Nueva Cajamarca', NULL, NULL, NULL),
(1793, 'San Martin', 'Rioja', 'Pardo Miguel', NULL, NULL, NULL),
(1794, 'San Martin', 'Rioja', 'Posic', NULL, NULL, NULL),
(1795, 'San Martin', 'Rioja', 'San Fernando', NULL, NULL, NULL),
(1796, 'San Martin', 'Rioja', 'Yorongos', NULL, NULL, NULL),
(1797, 'San Martin', 'Rioja', 'Yuracyacu', NULL, NULL, NULL),
(1798, 'San Martin', 'San Martin', 'Tarapoto', NULL, NULL, NULL),
(1799, 'San Martin', 'San Martin', 'Alberto Leveau', NULL, NULL, NULL),
(1800, 'San Martin', 'San Martin', 'Cacatachi', NULL, NULL, NULL),
(1801, 'San Martin', 'San Martin', 'Chazuta', NULL, NULL, NULL),
(1802, 'San Martin', 'San Martin', 'Chipurana', NULL, NULL, NULL),
(1803, 'San Martin', 'San Martin', 'El Porvenir', NULL, NULL, NULL),
(1804, 'San Martin', 'San Martin', 'Huimbayoc', NULL, NULL, NULL),
(1805, 'San Martin', 'San Martin', 'Juan Guerra', NULL, NULL, NULL),
(1806, 'San Martin', 'San Martin', 'La Banda de Shilcayo', NULL, NULL, NULL),
(1807, 'San Martin', 'San Martin', 'Morales', NULL, NULL, NULL),
(1808, 'San Martin', 'San Martin', 'Papaplaya', NULL, NULL, NULL),
(1809, 'San Martin', 'San Martin', 'San Antonio', NULL, NULL, NULL),
(1810, 'San Martin', 'San Martin', 'Sauce', NULL, NULL, NULL),
(1811, 'San Martin', 'San Martin', 'Shapaja', NULL, NULL, NULL),
(1812, 'San Martin', 'Tocache', 'Tocache', NULL, NULL, NULL),
(1813, 'San Martin', 'Tocache', 'Nuevo Progreso', NULL, NULL, NULL),
(1814, 'San Martin', 'Tocache', 'Polvora', NULL, NULL, NULL),
(1815, 'San Martin', 'Tocache', 'Shunte', NULL, NULL, NULL),
(1816, 'San Martin', 'Tocache', 'Uchiza', NULL, NULL, NULL),
(1817, 'Tacna', 'Tacna', 'Tacna', NULL, NULL, NULL),
(1818, 'Tacna', 'Tacna', 'Alto de la Alianza', NULL, NULL, NULL),
(1819, 'Tacna', 'Tacna', 'Calana', NULL, NULL, NULL),
(1820, 'Tacna', 'Tacna', 'Ciudad Nueva', NULL, NULL, NULL),
(1821, 'Tacna', 'Tacna', 'Inclan', NULL, NULL, NULL),
(1822, 'Tacna', 'Tacna', 'Pachia', NULL, NULL, NULL),
(1823, 'Tacna', 'Tacna', 'Palca', NULL, NULL, NULL),
(1824, 'Tacna', 'Tacna', 'Pocollay', NULL, NULL, NULL),
(1825, 'Tacna', 'Tacna', 'Sama', NULL, NULL, NULL),
(1826, 'Tacna', 'Tacna', 'Coronel Gregorio Albarracin Lanchipa', NULL, NULL, NULL),
(1827, 'Tacna', 'Tacna', 'La Yarada los Palos', NULL, NULL, NULL),
(1828, 'Tacna', 'Candarave', 'Candarave', NULL, NULL, NULL),
(1829, 'Tacna', 'Candarave', 'Cairani', NULL, NULL, NULL),
(1830, 'Tacna', 'Candarave', 'Camilaca', NULL, NULL, NULL),
(1831, 'Tacna', 'Candarave', 'Curibaya', NULL, NULL, NULL),
(1832, 'Tacna', 'Candarave', 'Huanuara', NULL, NULL, NULL),
(1833, 'Tacna', 'Candarave', 'Quilahuani', NULL, NULL, NULL),
(1834, 'Tacna', 'Jorge Basadre', 'Locumba', NULL, NULL, NULL),
(1835, 'Tacna', 'Jorge Basadre', 'Ilabaya', NULL, NULL, NULL),
(1836, 'Tacna', 'Jorge Basadre', 'Ite', NULL, NULL, NULL),
(1837, 'Tacna', 'Tarata', 'Tarata', NULL, NULL, NULL),
(1838, 'Tacna', 'Tarata', 'Heroes Albarracin', NULL, NULL, NULL),
(1839, 'Tacna', 'Tarata', 'Estique', NULL, NULL, NULL),
(1840, 'Tacna', 'Tarata', 'Estique-Pampa', NULL, NULL, NULL),
(1841, 'Tacna', 'Tarata', 'Sitajara', NULL, NULL, NULL),
(1842, 'Tacna', 'Tarata', 'Susapaya', NULL, NULL, NULL),
(1843, 'Tacna', 'Tarata', 'Tarucachi', NULL, NULL, NULL),
(1844, 'Tacna', 'Tarata', 'Ticaco', NULL, NULL, NULL),
(1845, 'Tumbes', 'Tumbes', 'Tumbes', NULL, NULL, NULL),
(1846, 'Tumbes', 'Tumbes', 'Corrales', NULL, NULL, NULL),
(1847, 'Tumbes', 'Tumbes', 'La Cruz', NULL, NULL, NULL),
(1848, 'Tumbes', 'Tumbes', 'Pampas de Hospital', NULL, NULL, NULL),
(1849, 'Tumbes', 'Tumbes', 'San Jacinto', NULL, NULL, NULL),
(1850, 'Tumbes', 'Tumbes', 'San Juan de la Virgen', NULL, NULL, NULL),
(1851, 'Tumbes', 'Contralmirante Villar', 'Zorritos', NULL, NULL, NULL),
(1852, 'Tumbes', 'Contralmirante Villar', 'Casitas', NULL, NULL, NULL),
(1853, 'Tumbes', 'Contralmirante Villar', 'Canoas de Punta Sal', NULL, NULL, NULL),
(1854, 'Tumbes', 'Zarumilla', 'Zarumilla', NULL, NULL, NULL),
(1855, 'Tumbes', 'Zarumilla', 'Aguas Verdes', NULL, NULL, NULL),
(1856, 'Tumbes', 'Zarumilla', 'Matapalo', NULL, NULL, NULL),
(1857, 'Tumbes', 'Zarumilla', 'Papayal', NULL, NULL, NULL),
(1858, 'Ucayali', 'Coronel Portillo', 'Calleria', NULL, NULL, NULL),
(1859, 'Ucayali', 'Coronel Portillo', 'Campoverde', NULL, NULL, NULL),
(1860, 'Ucayali', 'Coronel Portillo', 'Iparia', NULL, NULL, NULL),
(1861, 'Ucayali', 'Coronel Portillo', 'Masisea', NULL, NULL, NULL),
(1862, 'Ucayali', 'Coronel Portillo', 'Yarinacocha', NULL, NULL, NULL),
(1863, 'Ucayali', 'Coronel Portillo', 'Nueva Requena', NULL, NULL, NULL),
(1864, 'Ucayali', 'Coronel Portillo', 'Manantay', NULL, NULL, NULL),
(1865, 'Ucayali', 'Atalaya', 'Raymondi', NULL, NULL, NULL),
(1866, 'Ucayali', 'Atalaya', 'Sepahua', NULL, NULL, NULL),
(1867, 'Ucayali', 'Atalaya', 'Tahuania', NULL, NULL, NULL),
(1868, 'Ucayali', 'Atalaya', 'Yurua', NULL, NULL, NULL),
(1869, 'Ucayali', 'Padre Abad', 'Padre Abad', NULL, NULL, NULL),
(1870, 'Ucayali', 'Padre Abad', 'Irazola', NULL, NULL, NULL),
(1871, 'Ucayali', 'Padre Abad', 'Curimana', NULL, NULL, NULL),
(1872, 'Ucayali', 'Padre Abad', 'Neshuya', NULL, NULL, NULL),
(1873, 'Ucayali', 'Padre Abad', 'Alexander Von Humboldt', NULL, NULL, NULL),
(1874, 'Ucayali', 'Purus', 'Purus', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ubigeo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_ubigeo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `str_salary` double(8,2) DEFAULT NULL,
  `cur_salary` double(8,2) DEFAULT NULL,
  `commission` float DEFAULT NULL,
  `frequency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cci` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `commission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cuspp` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cts_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cts_account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eps_id` bigint(20) UNSIGNED DEFAULT NULL,
  `essalud` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_fullname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_relationship` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_ubigeo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_other_ubigeo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `is_admin`, `code`, `name`, `lastname`, `email`, `document_type_id`, `document`, `gender_id`, `birthdate`, `address`, `country_id`, `ubigeo_id`, `other_ubigeo`, `mobile`, `phone`, `annex`, `alt_email`, `relationship_id`, `profile_id`, `center_id`, `str_salary`, `cur_salary`, `commission`, `frequency_id`, `start_at`, `end_at`, `bank_id`, `bank_account`, `cci`, `afp_id`, `commission_id`, `cuspp`, `cts_id`, `cts_account`, `eps_id`, `essalud`, `contact_fullname`, `contact_relationship`, `contact_address`, `contact_country_id`, `contact_ubigeo_id`, `contact_other_ubigeo`, `contact_mobile`, `contact_phone`, `contact_annex`, `email_verified_at`, `password`, `confirmation_code`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'U2020000', 'Administrador', NULL, 'admin@labarferiaperu.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2020-10-21 16:27:19', '$2y$10$R9MrGULc/CrND7.admt4BunTWtd1XZkS/0DuiWWgcP7oL3krHLDmG', 'uJ1RWt3dbmnYU3KjdJVrhMJfKcx0XuMB0MwFbpbX5fAmd6mq7Vy2Fx3pOe3v', NULL, '2020-10-21 16:27:19', '2020-10-21 16:27:19', NULL),
(2, 0, 'U2020001', 'Ricardo Joel', 'Béjar Luque', 'rbejar@labarferiaperu.com', 1, '70689935', 2, '1989-07-14', 'Calle Diamantes Mz. C Lt. 19 - Urb. Huaytapallana', 164, 1297, NULL, '991 267 284', '01 632 0902', NULL, NULL, 3, 5, 7, 930.00, 930.00, 0, 5, '2019-11-10', NULL, 5, '0011-0814-0211115268', '011-814-000211115268-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, 'Lima / Barranca / Paramonga City', NULL, NULL, NULL, '2020-10-21 16:27:19', '$2y$10$lNV7BmEe7h11v2jE3Q4VvuVCmwCXTfXENuFiabJ/dDJ/hObUr6k2S', 'ex9yx648XZH9hUetP0HcmscQv2HJuUSvJUgR2YlIgwASylZWVa8xZC8lMxwn', 'mpiPTEueHPWcNBiOP0nFNwvheSbBT56igWPQPRALI8mpEa0reqFHOFhIARct', '2020-10-21 16:27:19', '2021-10-25 00:37:25', NULL),
(3, 0, 'U2021001', 'Caren Janina', 'Pérez Salamanca', 'hola@labarferiaperu.com', 1, '99999999', 1, '1998-08-28', 'Vicente Angulo 274, Comas, Perú', 164, 1290, NULL, '992 432 709', NULL, NULL, NULL, 1, 5, 1, 1300.00, 1300.00, 0, 5, NULL, NULL, 2, '0011-8929-8439843894', NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, 'Guillermo Béjar Durand', 'Padre', 'Calle Cochas 5088 - Urb. Parque Naranjal', 164, 1297, NULL, '997 005 140', '01 250 2353', '1234', '2020-10-21 16:27:19', '$2y$10$aoiLQ.8qe.fmw8./Go6VweT5zon/8NcZZzYbpH4vzgexm4eZJM2Qy', '3g5UfTXHvNioXRsxtt5VGfi82d7m9EKmIUp8s4qTezltrDC1EZ8UYJDuBD87', NULL, '2021-10-05 22:02:32', '2021-12-30 14:40:17', NULL),
(4, 0, 'U2021002', 'Luis Alberto', 'Corvera Gálvez', 'lcorvera@preciso.pe', 1, '10199575', 2, '1975-07-01', 'Jirón Ricardo Aicardi 224, Santiago de Surco, Perú', 164, 1400, NULL, '987 412 444', NULL, NULL, NULL, 1, 5, 2, NULL, NULL, 0, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, NULL, NULL, NULL, NULL, '2020-10-21 16:27:19', '$2y$10$0pVMLtmBkgXqn97ru01xg.ttgma6BszXa7KMeV0zdm6quL/tcic1a', 'dNbGAifRpXmGLtZAfmhguiJO3f6NPPu4oAA191mLyxYRwy2P8j8xjMvnXzBP', NULL, '2021-10-19 11:31:50', '2021-12-30 14:42:45', NULL),
(5, 0, 'U2021003', 'Enrique', 'Revilla', 'erevilla@labarferiaperu.com', 1, '77777777', 2, '2003-10-06', 'Avenida 13 de Enero 2143, San Juan de Lurigancho, Perú', 164, 1312, NULL, '947 661 001', NULL, NULL, NULL, 1, 5, 3, NULL, NULL, 0, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, 1293, NULL, NULL, NULL, NULL, '2020-10-21 16:27:19', '$2y$10$RtYPLP4LHL15S2GguUnIL.E1QKVWpTdOlFEq6gTxOxahDpLufQTZ6', 'JVcIQBXT4PLdP0H5EuhZAulQLE07F7yxI9mlvz7BnZ8CH12z8cMPebdEvK4j', NULL, '2021-10-19 11:33:32', '2021-12-30 14:46:22', NULL),
(6, 0, 'U2021004', 'Claudia', 'Revilla', 'crevilla@3scperu.com', 1, '88888888', 1, '1981-01-09', 'Av. Santa Domitila 038', 164, 1301, NULL, '975 087 893', NULL, NULL, NULL, 1, 5, 4, NULL, NULL, 0, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, NULL, NULL, NULL, NULL, '2020-10-21 16:27:19', '$2y$10$cKg3n5mDFlt2OJWoJRifBuu7RMaQa6baUxzAcUswYO.50Ug/8UwGm', 'B6nbqLaMmrq8xcyh4UMP8icgnBXyOPF25mQp6WmmYS4sxNR5jjPC3yEFy9jd', NULL, '2021-10-20 20:12:49', '2021-12-30 14:48:09', NULL),
(7, 1, 'U2021005', 'Mario César', 'Huamaní Tirado', 'mhuamani@preciso.pe', 1, '75724152', 2, '1994-10-30', 'av. JulioC.Tello 239', 164, 1323, NULL, '965 090 493', NULL, NULL, NULL, 1, 4, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, NULL, NULL, NULL, NULL, '2020-10-21 16:27:19', '$2y$10$Ldr5GsetxmIP.k9zrmSnB.6H8yMOnK.BbV4NTwiXxondwOpqGVyX6', 'HQxXLdJCqkaGrwKpGEMQyGFtbIyiNDYTAYhQubqiztpbGLvmFpRv7fjLg2ES', NULL, '2021-12-29 16:46:53', '2021-12-30 14:49:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` date NOT NULL,
  `before` double(8,2) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `after` double(8,2) NOT NULL,
  `observation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `variations`
--

INSERT INTO `variations` (`id`, `user_id`, `type`, `start_at`, `before`, `amount`, `after`, `observation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Aumento', '2021-11-01', 1300.00, 500.00, 1800.00, 'Porque quiero', '2021-10-05 22:06:02', '2021-10-05 22:06:02', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afps`
--
ALTER TABLE `afps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `afps_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banks_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `centers_name_deleted_at_unique` (`name`,`deleted_at`) USING BTREE,
  ADD UNIQUE KEY `centers_nemo_deleted_at_unique` (`nemo`,`deleted_at`) USING BTREE,
  ADD UNIQUE KEY `centers_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `centers_ubigeo_id_foreign` (`ubigeo_id`);

--
-- Indices de la tabla `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `choices_sale_detail_id_foreign` (`sale_detail_id`),
  ADD KEY `choices_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commissions_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `customers_document_type_id_foreign` (`document_type_id`),
  ADD KEY `customers_country_id_foreign` (`country_id`);

--
-- Indices de la tabla `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dependents_dependent_type_id_foreign` (`dependent_type_id`),
  ADD KEY `dependents_user_id_foreign` (`user_id`),
  ADD KEY `dependents_document_type_id_foreign` (`document_type_id`),
  ADD KEY `dependents_gender_id_foreign` (`gender_id`);

--
-- Indices de la tabla `dependent_types`
--
ALTER TABLE `dependent_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dependent_types_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `distributions`
--
ALTER TABLE `distributions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `distributions_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `distributions_origin_id_foreign` (`origin_id`),
  ADD KEY `distributions_destiny_id_foreign` (`destiny_id`),
  ADD KEY `distributions_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `distribution_details`
--
ALTER TABLE `distribution_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distribution_details_distribution_id_foreign` (`distribution_id`),
  ADD KEY `distribution_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document_types_name_code_deleted_at_unique` (`name`,`code`,`deleted_at`);

--
-- Indices de la tabla `epss`
--
ALTER TABLE `epss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `epss_name_code_deleted_at_unique` (`name`,`code`,`deleted_at`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `frequencies`
--
ALTER TABLE `frequencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frequencies_name_code_deleted_at_unique` (`name`,`deleted_at`,`code`) USING BTREE;

--
-- Indices de la tabla `garbage`
--
ALTER TABLE `garbage`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genders_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventories_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `inventories_user_id_foreign` (`user_id`),
  ADD KEY `inventories_center_id_foreign` (`center_id`) USING BTREE;

--
-- Indices de la tabla `inventory_details`
--
ALTER TABLE `inventory_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_details_inventory_id_foreign` (`inventory_id`),
  ADD KEY `inventory_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_customer_id_foreign` (`customer_id`),
  ADD KEY `locations_ubigeo_id_foreign` (`ubigeo_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parameters_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_customer_id_foreign` (`customer_id`),
  ADD KEY `pets_race_id_foreign` (`race_id`);

--
-- Indices de la tabla `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productions_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `productions_center_id_foreign` (`center_id`),
  ADD KEY `productions_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `production_details`
--
ALTER TABLE `production_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `production_details_production_id_foreign` (`production_id`),
  ADD KEY `production_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_name_deleted_at_unique` (`name`,`deleted_at`) USING BTREE;

--
-- Indices de la tabla `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promos_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `promo_details`
--
ALTER TABLE `promo_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_details_promo_id_foreign` (`promo_id`),
  ADD KEY `promo_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `races_code_name_type_deleted_at_unique` (`code`,`name`,`type`,`deleted_at`);

--
-- Indices de la tabla `receptions`
--
ALTER TABLE `receptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receptions_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `receptions_distribution_id_foreign` (`distribution_id`),
  ADD KEY `receptions_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `relationships_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `sales_center_id_foreign` (`center_id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_location_id_foreign` (`location_id`),
  ADD KEY `sales_payment_method_id_foreign` (`payment_method_id`);

--
-- Indices de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_product_id_foreign` (`product_id`),
  ADD KEY `sale_details_promo_id_foreign` (`promo_id`);

--
-- Indices de la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stocks_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `stocks_center_id_foreign` (`center_id`);

--
-- Indices de la tabla `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_details_stock_id_foreign` (`stock_id`),
  ADD KEY `stock_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `suppliers_profile_id_foreign` (`profile_id`),
  ADD KEY `suppliers_document_type_id_foreign` (`document_type_id`),
  ADD KEY `suppliers_country_id_foreign` (`country_id`),
  ADD KEY `suppliers_bank_id_foreign` (`bank_id`),
  ADD KEY `suppliers_ubigeo_id_foreign` (`ubigeo_id`) USING BTREE;

--
-- Indices de la tabla `ubigeos`
--
ALTER TABLE `ubigeos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ubigeos_department_province_district_deleted_at_unique` (`department`,`province`,`district`,`deleted_at`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_deleted_at_unique` (`email`,`deleted_at`),
  ADD KEY `users_document_type_id_foreign` (`document_type_id`),
  ADD KEY `users_relationship_id_foreign` (`relationship_id`),
  ADD KEY `users_profile_id_foreign` (`profile_id`),
  ADD KEY `users_bank_id_foreign` (`bank_id`),
  ADD KEY `users_afp_id_foreign` (`afp_id`),
  ADD KEY `users_cts_id_foreign` (`cts_id`),
  ADD KEY `users_eps_id_foreign` (`eps_id`),
  ADD KEY `users_gender_id_foreign` (`gender_id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_commission_id_foreign` (`commission_id`),
  ADD KEY `users_contact_country_id_foreign` (`contact_country_id`),
  ADD KEY `users_frequency_id_foreign` (`frequency_id`),
  ADD KEY `users_contact_ubigeo_id_foreign` (`contact_ubigeo_id`) USING BTREE,
  ADD KEY `users_ubigeo_id_foreign` (`ubigeo_id`) USING BTREE,
  ADD KEY `users_center_id_foreign` (`center_id`) USING BTREE;

--
-- Indices de la tabla `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variations_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afps`
--
ALTER TABLE `afps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `centers`
--
ALTER TABLE `centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `choices`
--
ALTER TABLE `choices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `dependents`
--
ALTER TABLE `dependents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dependent_types`
--
ALTER TABLE `dependent_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `distributions`
--
ALTER TABLE `distributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `distribution_details`
--
ALTER TABLE `distribution_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `epss`
--
ALTER TABLE `epss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `frequencies`
--
ALTER TABLE `frequencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `garbage`
--
ALTER TABLE `garbage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventory_details`
--
ALTER TABLE `inventory_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `productions`
--
ALTER TABLE `productions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `production_details`
--
ALTER TABLE `production_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `promo_details`
--
ALTER TABLE `promo_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `races`
--
ALTER TABLE `races`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT de la tabla `receptions`
--
ALTER TABLE `receptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ubigeos`
--
ALTER TABLE `ubigeos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1875;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `choices_sale_detail_id_foreign` FOREIGN KEY (`sale_detail_id`) REFERENCES `sale_details` (`id`);

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `distributions`
--
ALTER TABLE `distributions`
  ADD CONSTRAINT `distributions_destiny_id_foreign` FOREIGN KEY (`destiny_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `distributions_origin_id_foreign` FOREIGN KEY (`origin_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `distributions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `distribution_details`
--
ALTER TABLE `distribution_details`
  ADD CONSTRAINT `distribution_details_distribution_id_foreign` FOREIGN KEY (`distribution_id`) REFERENCES `distributions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `distribution_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_shop_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inventory_details`
--
ALTER TABLE `inventory_details`
  ADD CONSTRAINT `inventory_details_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `locations_ubigeo_id_foreign` FOREIGN KEY (`ubigeo_id`) REFERENCES `ubigeos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pets_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productions`
--
ALTER TABLE `productions`
  ADD CONSTRAINT `productions_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `production_details`
--
ALTER TABLE `production_details`
  ADD CONSTRAINT `production_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `production_details_production_id_foreign` FOREIGN KEY (`production_id`) REFERENCES `productions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `promo_details`
--
ALTER TABLE `promo_details`
  ADD CONSTRAINT `promo_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promo_details_promo_id_foreign` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `receptions`
--
ALTER TABLE `receptions`
  ADD CONSTRAINT `receptions_distribution_id_foreign` FOREIGN KEY (`distribution_id`) REFERENCES `distributions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_details_promo_id_foreign` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `stock_details`
--
ALTER TABLE `stock_details`
  ADD CONSTRAINT `stock_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_details_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `variations`
--
ALTER TABLE `variations`
  ADD CONSTRAINT `variations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
