-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: mariadb:3306
-- Tiempo de generación: 04-11-2022 a las 17:21:47
-- Versión del servidor: 10.6.10-MariaDB
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `recursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(15) NOT NULL,
  `diaSemana` varchar(20) NOT NULL,
  `empieza` varchar(30) NOT NULL,
  `acaba` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `diaSemana`, `empieza`, `acaba`) VALUES
(2, 'Lunes', '8:05', '9:05'),
(10, 'Lunes', '9:05', '10:05'),
(11, 'Lunes', '10:05', '11:05'),
(12, 'Martes', '8:05', '9:05'),
(13, 'Martes', '9:05', '10:05'),
(14, 'Martes', '10:05', '11:05'),
(15, 'Miercoles', '8:05', '9:05'),
(16, 'Miercoles', '10:05', '11:05'),
(17, 'Miercoles', '10:05', '11:05'),
(18, 'Miercoles', '12:35', '13:35'),
(19, 'Jueves', '8:05', '9:05'),
(20, 'Jueves', '10:05', '11:05'),
(21, 'Viernes', '8:05', '9:05'),
(22, 'Viernes', '10:05', '11:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `localizacion` varchar(50) NOT NULL,
  `imagen` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `nombre`, `Descripcion`, `localizacion`, `imagen`) VALUES
(43, 'Portatil', 'Portatil para trabajos', 'Aula 8', 'images/1.jpg'),
(61, 'Proyector', 'Proyector para peliculas', 'Sala TIC', 'images/2.jpg'),
(62, 'Biblioteca', 'Zona de estudio o trabajos grupales', 'Aula 17', 'images/3.jpg'),
(66, 'Television', 'Recurso para administrar material audio visual', 'Aula 15', 'images/51MLuc3O88L.jpg'),
(67, 'Laboratorio', 'Sala para probar experimentos ', 'Planta baja', 'images/masterhacks_tipos_laboratorio.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idRecurso` int(15) NOT NULL,
  `idUsuarios` int(15) NOT NULL,
  `idHorario` int(15) NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(15) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`, `nombre`, `tipo`) VALUES
(8, 'jose', '1234', 'usuario', 1),
(9, 'manolo', '9090', 'Manolo', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idRecurso`,`idUsuarios`,`idHorario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
