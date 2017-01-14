-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2017 a las 12:27:25
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(5) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(280) NOT NULL,
  `fecha_reg` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `direccion` varchar(260) NOT NULL,
  `fecha_reg_cliente` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `cedula`, `nombre`, `apellido`, `direccion`, `fecha_reg_cliente`) VALUES
(1, 20990397, 'Franciscose', 'Hernandez', 'Cagua , estado aragua', '2017-01-13'),
(2, 20990397, 'Franco', 'Rodriguezs', 'villa', '2017-01-13'),
(3, 20990397, 'fran', 'hernandezss', 'cagua', '2017-01-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_venta`
--

CREATE TABLE `reg_venta` (
  `idventa` int(11) NOT NULL,
  `idusuario` int(6) NOT NULL,
  `idcliente` int(4) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `descripcion` varchar(350) NOT NULL,
  `precio` float(5,3) NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `fecha_reg` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `idpersona` int(4) NOT NULL,
  `cedula` int(9) NOT NULL,
  `nombres` varchar(130) NOT NULL,
  `apellidos` varchar(210) NOT NULL,
  `fecha_nac` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL,
  `direccion` varchar(270) NOT NULL,
  `fecha_reg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idpersona`, `cedula`, `nombres`, `apellidos`, `fecha_nac`, `password`, `direccion`, `fecha_reg`) VALUES
(5, 20990397, 'Franciscos', 'Hernandez', '12/08/2016', '$2y$10$msjl7q1kDAHedf1ifiRU7eVZhOZFcEi8DhvQoXLHltb54jSpz1oqq', 'Cagua , estado aragua', '2016-12-13'),
(8, 20990397, 'fran', 'hernandez', '', '', 'cagua', '2017-01-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `reg_venta`
--
ALTER TABLE `reg_venta`
  ADD PRIMARY KEY (`idventa`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idpersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `reg_venta`
--
ALTER TABLE `reg_venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `idpersona` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
