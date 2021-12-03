-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2021 a las 22:21:24
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `codCliente` int(10) NOT NULL,
  `DNI` varchar(9) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `apellido1` varchar(60) COLLATE utf8_bin NOT NULL,
  `apellido2` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codCliente`, `DNI`, `nombre`, `apellido1`, `apellido2`) VALUES
(1, '52229679Z', 'Miguel', 'Fombuena', 'Perera'),
(2, '983456728G', 'María', 'Fernández', 'López'),
(3, '49204968X', 'Juan Manuel', 'Zapatero', 'Cordero'),
(4, '14346657Q', 'Virgilio', 'Hidalgo', 'Cordero'),
(5, '34567653X', 'Rogelio', 'González', 'Salas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `codHabitacion` int(10) NOT NULL,
  `tipo` varchar(16) COLLATE utf8_bin NOT NULL,
  `capacidad` int(11) NOT NULL,
  `planta` int(1) NOT NULL,
  `tarifa` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`codHabitacion`, `tipo`, `capacidad`, `planta`, `tarifa`) VALUES
(1, 'Individual', 1, 1, 50),
(2, 'Individual', 1, 1, 60),
(3, 'Individual', 1, 1, 55),
(4, 'Individual', 1, 1, 65),
(5, 'Individual', 1, 1, 70),
(6, 'Individual', 1, 1, 75),
(7, 'Individual', 2, 1, 70),
(8, 'Individual', 2, 1, 50),
(9, 'Individual', 2, 1, 65),
(10, 'Individual', 2, 1, 70),
(11, 'Individual', 2, 2, 110),
(12, 'Individual', 2, 2, 110),
(13, 'Doble', 3, 2, 150),
(14, 'Doble', 3, 2, 155),
(15, 'Doble', 3, 2, 160),
(16, 'Doble', 3, 2, 160),
(17, 'Doble', 3, 2, 175),
(18, 'Doble', 4, 2, 180),
(19, 'Doble', 4, 3, 210),
(20, 'Doble', 4, 3, 220);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `codImagen` tinytext COLLATE utf8_bin NOT NULL,
  `ruta` tinytext COLLATE utf8_bin NOT NULL,
  `nombre` tinytext COLLATE utf8_bin NOT NULL,
  `estado` tinytext COLLATE utf8_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`codImagen`, `ruta`, `nombre`, `estado`) VALUES
('logoHotel', '../../View/img/uploads/logoHotelHeader.jpg', 'logoHotelHeader.jpg', NULL),
('img1Galeria', '../../View/img/uploads/img1Galeria.jpg', 'img1Galeria.jpg', NULL),
('img2Galeria', '../../View/img/uploads/img2Galeria.jpg', 'img2Galeria.jpg', NULL),
('img3Galeria', '../../View/img/uploads/img3Galeria.jpg', 'img3Galeria.jpg', NULL),
('img4Galeria', '../../View/img/uploads/img4Galeria.jpg', 'img4Galeria.jpg', NULL),
('img5Galeria', '../../View/img/uploads/img5Galeria.jpg', 'img5Galeria.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `usuario` varchar(25) COLLATE utf8_bin NOT NULL,
  `clave` varchar(25) COLLATE utf8_bin NOT NULL,
  `rol` varchar(25) COLLATE utf8_bin NOT NULL,
  `codCliente` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`usuario`, `clave`, `rol`, `codCliente`) VALUES
('administrador', '123456', 'administrador', NULL),
('virgiliohidalgo', '123456', 'usuario', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `codHabitacion` int(10) NOT NULL,
  `codCliente` int(10) NOT NULL,
  `fechaEntrada` date NOT NULL,
  `fechaSalida` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`codHabitacion`, `codCliente`, `fechaEntrada`, `fechaSalida`) VALUES
(1, 1, '2021-11-15', '2021-11-18'),
(1, 2, '2021-11-22', '2021-11-26'),
(2, 5, '2021-11-22', '2021-11-26'),
(2, 4, '2021-11-29', '2021-12-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texto`
--

CREATE TABLE `texto` (
  `comedor` text COLLATE utf8_spanish_ci NOT NULL,
  `habIndividual` text COLLATE utf8_spanish_ci NOT NULL,
  `habDoble` text COLLATE utf8_spanish_ci NOT NULL,
  `nombreHotel` tinytext COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `texto`
--

INSERT INTO `texto` (`comedor`, `habIndividual`, `habDoble`, `nombreHotel`) VALUES
('<p><img style=\"float: left; margin: 0px 10px;\" src=\"../../View/img/uploads/restaurante11.jpg\" width=\"233\" height=\"155\" />
 Nuestro restaurante ofrece magn&iacute;ficas vistas dentro de un enclave privilegiado, donde los clientes disfrutarán de nuestra 
 cocina nacional e internacional&nbsp;. El hotel dispone de cafeter&iacute;a, bar de copas y dos barras con los mejores c&oacute;ckteles
  y bebidas en nuestra zona de piscina.</p>', 
 '<p><img style=\"float: left; margin: 0px 10px;\" src=\"../../View/img/uploads/tipoHab13.jpg\" width=\"223\" height=\"167\" />
 Habitaciones individuales confortables, ideales para viajes de negocios o escapadas de fin de semana. Dispone de todo lo necesario 
 para descansar despu&eacute;s de un d&iacute;a intenso. Descubra nuestra habitaciones modernas y funcionales, pudiendo elegir 
 una habitaci&oacute; con vistas a la playa, o bien si lo prefiere con vistas interiores  a nuestro jard&iacute; para una mayor tranquilidad. 
 Dispone de todas las comodidades para pasar una estancia inolvidable.</p>', 
 '<p><img style=\"float: left; margin: 0px 10px;\" src=\"../../View/img/uploads/tipoHab24.jpg\" width=\"223\" height=\"167\" />
 Disfrute de estas maravillosas habitaciones completamente equipadas con todo lo necesario para que su estancia sea perfecta. 
 Todas ellas est&aacute;n totalmente insonorizadas para que pueda disponer del m&aacute;ximo confort y descanso. Adem&aacute;s, 
 puede solicitar habitaciones comunicadas si lo desea.</p>', 'Hotel Arrayán');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`codHabitacion`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `codCliente` (`codCliente`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`codHabitacion`,`codCliente`,`fechaEntrada`),
  ADD KEY `codCliente` (`codCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codCliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `codHabitacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
