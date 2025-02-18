-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2025 a las 15:29:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `km` decimal(10,0) DEFAULT NULL,
  `año` int(11) NOT NULL,
  `matriculacion` date DEFAULT NULL,
  `potencia` int(11) NOT NULL,
  `combustible` varchar(50) DEFAULT NULL,
  `cambio` varchar(50) DEFAULT NULL,
  `traccion` varchar(50) DEFAULT NULL,
  `distribucion` varchar(50) DEFAULT NULL,
  `plazas` int(11) NOT NULL,
  `etiqueta_medioambiental` varchar(50) DEFAULT NULL,
  `precio` decimal(10,3) DEFAULT NULL,
  `estado` varchar(255) DEFAULT 'En_venta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`id`, `numero`, `marca`, `modelo`, `km`, `año`, `matriculacion`, `potencia`, `combustible`, `cambio`, `traccion`, `distribucion`, `plazas`, `etiqueta_medioambiental`, `precio`, `estado`) VALUES
(1, 1001, 'NISSAN', 'Qashqai E-POWER Acenta', 9940, 2023, '2023-05-11', 190, 'Hibrido', 'Automatico', '4x2', 'Cadena', 5, 'ECO', 26.290, 'reservado'),
(2, 1002, 'BMW', 'Serie 1 102iA', 66948, 2022, '2023-06-22', 178, 'Gasolina', 'Automático', 'Delantera', 'Cadena', 5, 'C', 24.690, 'reservado'),
(3, 1003, 'ALFA ROMEO', 'Tonale 1.5 MHEV Sprint FWD', 14262, 2023, '2023-06-22', 130, 'Mild Hybrid', 'Automático', 'Delantera', 'Cadena', 5, 'ECO', 28.990, 'reservado'),
(4, 1004, 'DS', '7 Crossback E-Tense Rivoli', 29854, 2022, '2022-12-13', 299, 'Híbrido enchufable', 'Automático', '4x4', 'Cadena', 5, '0', 29.990, 'En_venta'),
(5, 1005, 'BMW', 'Serie 2 M235iA Coupé', 41052, 2016, '2016-07-22', 326, 'Gasolina', 'Manual', 'Trasera', 'Cadena', 5, 'C', 36.990, 'En_venta'),
(6, 1006, 'KIA', 'Sportage 1.6 TGDi HEV Drive', 79491, 2023, '2023-03-17', 230, 'Híbrido ', 'Automático', 'Delantera', 'Cadena', 5, 'ECO', 30.290, 'En_venta'),
(7, 1007, 'KIA', 'Niro 1,6 PHEV Concept', 28894, 2022, '2022-09-22', 183, 'Híbrido enchufable', 'Automático', 'Delantera', 'Cadena', 5, '0', 28.990, 'En_venta'),
(8, 1008, 'PEUGEOT', '208 1.2 Puretech S&S Active 100', 4577, 2024, '2024-05-23', 100, 'Gasolina', 'Manual', 'Delantera', 'Correa', 5, 'C', 17.990, 'En_venta'),
(9, 1009, 'SEAT', 'Ibiza 1.0 TGI S&S Reference 90', 80071, 2021, '2021-11-01', 90, 'GNC', 'Manual', 'Delantera', 'Correa', 5, 'ECO', 13.490, 'En_venta'),
(10, 1010, 'AUDI', 'A6 Avant 40 TDI Sport S tronic', 98867, 2020, '2020-10-21', 240, 'Mild Hybrid', 'Automático', 'Delantera', 'Correa', 5, 'ECO', 34.990, 'En_venta'),
(11, 1011, 'CUPRA', 'Formentor 1.5 TSI 150', 17999, 2023, '2023-07-27', 150, 'Gasolina', 'Manual', 'Delantera', 'Correa', 5, 'C', 26.990, 'En_venta'),
(12, 1012, 'VOLKSWAGEN', 'T-ROC 1.5 Tsi Advance Style DSG7', 33633, 2021, '2021-06-04', 150, 'Gasolina', 'Automático', 'Delantera', 'Correa', 5, 'C', 25.990, 'En_venta'),
(13, 1013, 'FIAT', '500 1,0 Hybrid Sport', 68588, 2022, '2022-02-25', 70, 'Mild Hybrid', 'Manual', 'Delantera', 'Cadena', 5, 'ECO', 13.490, 'En_venta'),
(14, 1014, 'RENAULT', 'Megane E-TECH Bussines', 27752, 2021, '2021-12-21', 160, 'Híbrido enchufable', 'Automático', 'Delantera', 'Cadena', 5, '0', 23.990, 'En_venta'),
(15, 1015, 'CUPRA', 'Leon Sportstourer 1.4 TSI VZ E', 104392, 2021, '2021-09-16', 245, 'Híbrido enchufable', 'Automático', 'Delantera', 'Correa', 5, '0', 24.490, 'En_venta'),
(16, 1016, 'PEUGEOT', 'Rifter 1.5 Blue HDI S&S Estándar Allure', 77247, 2019, '2019-11-26', 131, 'Diesel', 'Automático', 'Delantera', 'Correa', 5, 'C', 23.490, 'En_venta'),
(17, 1017, 'TOYOTA', 'CH-R 200H Advance', 19, 2024, '2024-09-10', 196, 'Híbrido', 'Automático', 'Delantera', 'Cadena', 5, 'ECO', 36.490, 'En_venta'),
(18, 1018, 'CITROEN', 'C3 Origin 1.2 PureTech S&S Max', 10575, 2024, '2024-03-26', 110, 'Gasolina', 'Automático', 'Delantera', 'Correa', 5, 'C', 17.690, 'En_venta'),
(19, 1019, 'HYUNDAI', 'i30 1.0 TGDI N Line 30A 120', 16987, 2023, '2023-12-20', 120, 'Gasolina', 'Manual', 'Delantera', 'Correa', 5, 'C', 21.490, 'En_venta'),
(20, 1020, 'VOLVO', 'XC40 D4 R-Design Premium Edition A', 125024, 2019, '2019-05-13', 190, 'Diesel', 'Automático', '4x4', 'Correa', 5, 'C', 26.990, 'En_venta'),
(21, 1021, 'HYUNDAI', 'Tucson 1.6 TGDI HEV Maxx Sky', 48751, 2022, '2022-10-14', 230, 'Híbrido', 'Automático', 'Delantera', 'Cadena', 5, 'ECO', 48.759, 'En_venta'),
(22, 1022, 'OPEL', 'Corsa 1.2T XHT S&S GS-100', 25222, 2024, '2024-01-31', 100, 'Gasolina', 'Manual', 'Delantera', 'Correa', 5, 'C', 16.990, 'En_venta'),
(23, 1023, 'OPEL', 'Crossland 1.2 S&S Line-130', 39608, 2022, '2022-05-18', 130, 'Gasolina', 'Manual', 'Delantera', 'Correa', 5, 'C', 15.990, 'En_venta'),
(24, 1024, 'KIA', 'Niro 1.6 HEV Drive', 36890, 2020, '2020-09-24', 141, 'Híbrido', 'Automático', 'Delantera', 'Cadena', 5, 'ECO', 21.990, 'En_venta'),
(25, 1025, 'NISSAN', 'Leaf Acenta Access', 70910, 2020, '2020-03-30', 150, 'Eléctrico', 'Automático', 'Delantera', NULL, 5, '0', 13.990, 'En_venta'),
(26, 1026, 'FIAT', '500 1.0 Hybrid Dorcevita', 13723, 2024, '2024-03-25', 70, 'Mild Hybrid', 'Manual', 'Delantera', 'Cadena', 5, 'ECO', 14.290, 'En_venta'),
(27, 1027, 'VOLVO', 'S90 D4 Inscription', 126631, 2018, '2018-08-20', 190, 'Diesel', 'Automático', 'Delantera', 'Correa', 5, 'C', 25.990, 'En_venta'),
(28, 1028, 'OPEL', 'Mokka 1.2T S&S GS-130', 44903, 2023, '2023-01-31', 130, 'Gasolina', 'Automático', 'Delantera', 'Correa', 5, 'C', 20.990, 'En_venta'),
(29, 1029, 'RENAULT', 'Clio Tce Zen', 72014, 2021, '2021-05-25', 90, 'Gasolina', 'Manual', 'Delantera', 'Cadena', 5, 'C', 15.590, 'En_venta'),
(30, 1030, 'AUDI', 'Q3 35 TDI S line S tronic', 121359, 2020, '2020-02-25', 150, 'Diesel', 'Automático', 'Delantera', 'Correa', 5, 'C', 30.490, 'En_venta'),
(31, 1031, 'TOYOTA', 'Corolla Touring Sports 140H Style', 13339, 2023, '2023-10-02', 140, 'Híbrido', 'Automático', 'Delantera', 'Cadena', 5, 'ECO', 26.990, 'En_venta'),
(32, 1032, 'MERCEDES', 'Clase C C-State 220d', 118541, 2018, '2018-09-19', 170, 'Diesel', 'Automático', 'Trasera', 'Cadena', 5, 'C', 24.490, 'En_venta'),
(33, 1033, 'TOYOTA', 'Camry Híbrido Luxury', 126751, 2020, '2020-07-31', 218, 'Híbrido', 'Automático', 'Delantera', 'Cadena', 5, 'ECO', 26.990, 'reservado'),
(34, 1034, 'DACIA', 'Sandero Stepway Tce Confort', 36910, 2023, '2023-02-17', 91, 'Gasolina', 'Manual', 'Delantera', 'Cadena', 5, 'C', 16.490, 'En_venta'),
(35, 1035, 'SKODA', 'Octavia Combi 2.0 Tdi CR Ambition DSG', 138402, 2020, '2020-01-30', 150, 'Diesel', 'Automático', 'Delantera', 'Correa', 5, 'C', 17.990, 'En_venta'),
(36, 1036, 'CITROEN', 'C3 Aircross Blue Hdi S&S YOU', 14510, 2024, '2024-03-25', 110, 'Diesel', 'Manual', 'Delantera', 'Correa', 5, 'C', 18.490, 'En_venta'),
(37, 1037, 'MAZDA', 'Serie 2 1.5 e-skyActiv-s Homura', 33764, 2023, '2023-03-13', 75, 'Mild Hybrid', 'Manual', 'Delantera', 'Cadena', 5, 'C', 18.990, 'En_venta'),
(38, 1038, 'MINI', 'Countryman Cooper SE All4', 105223, 2021, '2021-12-16', 220, 'Híbridos enchufable', 'Automático', '4x4', 'Cadena', 5, '0', 23.990, 'En_venta'),
(39, 1039, 'AUDI', 'Q3 35 TFSi S-Line Stronic', 64738, 2019, '2019-03-29', 150, 'Gasolina', 'Automático', 'Delantera', 'Correa', 5, 'C', 30.990, 'En_venta'),
(40, 1040, 'CUPRA', 'Born', 43807, 2021, '2021-10-13', 204, 'Eléctrico', 'Automático', 'Trasera', NULL, 5, '0', 24.990, 'En_venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `nombre_usuario`, `contraseña`, `fecha_registro`) VALUES
(1, 'Sergio', 'ZsErGiiO', '$2y$10$UUGitJzK1OPtNTwISOgrXuhQVlY0j5NwPCcoPtA2hxw/c3z.2s6jW', '2025-01-21 17:43:04'),
(5, 'Miguel Angel', 'magorania', '$2y$10$uv1iJl.N2X2f9Yppl3SaC.FNmdPwtVgsyOMNYKZz32Fj55MiE0k52', '2025-01-21 21:37:22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `coches`
--
ALTER TABLE `coches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
