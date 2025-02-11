-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2025 a las 19:41:18
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
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `id_amigo` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `nombre_amigo` varchar(20) NOT NULL,
  `apellido_amigo` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id_amigo`, `id_usuario`, `nombre_amigo`, `apellido_amigo`, `fecha_nacimiento`) VALUES
(1, 2, 'Juan', 'Pérez', '1990-05-15'),
(2, 2, 'Ana', 'Gómez', '1985-08-22'),
(3, 3, 'Carlos', 'López', '1992-11-30'),
(4, 2, 'Angel', 'jksdadhaj', '2005-09-28'),
(5, 2, 'Pera', 'Limon', '1992-07-10'),
(6, 2, 'otro', 'algo', '1994-11-10'),
(7, 2, 'Elisa', 'Gomez', '1972-05-16'),
(14, 2, 'Antonio', 'Ruiz', '2005-05-09'),
(15, 3, 'Pepito', 'Grillo', '2025-02-10'),
(16, 3, 'Carla', 'Gomez', '2006-12-15'),
(17, 1, 'Ejemplo', 'Si', '2025-02-02'),
(18, 1, 'Paula', 'Ruiz', '2015-02-03'),
(19, 2, 'Noemi', 'Torreblanca', '2005-09-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_juego` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `plataforma` varchar(20) NOT NULL,
  `anno_lanzamiento` int(5) NOT NULL,
  `foto` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id_juego`, `id_usuario`, `titulo`, `plataforma`, `anno_lanzamiento`, `foto`) VALUES
(1, 2, 'The Legend of Zelda', 'Nintendo Switch', 2017, '../imagenes/juegos/zelda.jpg'),
(2, 2, 'Halo 3', 'Xbox 360', 2007, '../imagenes/juegos/halo3.jpg'),
(3, 3, 'God of War', 'PS4', 2018, '../imagenes/juegos/godofwar.jpg'),
(4, 2, 'Merequetengue', 'PC', 2025, '../imagenes/juegos/merequetengue.jpg'),
(5, 2, 'Splatoon 3', 'Switch', 2022, '../imagenes/juegos/splatoon3.jpg'),
(6, 2, 'sjdlkajlkjl', 'PC', 2025, '../imagenes/juegos/merequetengue.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` bigint(20) UNSIGNED NOT NULL,
  `id_amigo` bigint(20) UNSIGNED NOT NULL,
  `id_juego` bigint(20) UNSIGNED NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `devuelto` enum('NO','SI') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_amigo`, `id_juego`, `fecha_prestamo`, `devuelto`) VALUES
(1, 1, 1, '2023-10-01', 'SI'),
(2, 2, 2, '2023-10-05', 'SI'),
(3, 3, 3, '2023-10-10', 'NO'),
(7, 14, 5, '2025-02-10', 'SI'),
(8, 7, 4, '2025-02-20', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `contrasenna` varchar(20) NOT NULL,
  `tipo` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasenna`, `tipo`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'usuario1', 'user123', 'usuario'),
(3, 'usuario2', 'user456', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id_amigo`),
  ADD UNIQUE KEY `id_amigo` (`id_amigo`),
  ADD KEY `fk_ami_usu` (`id_usuario`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`),
  ADD UNIQUE KEY `id_juego` (`id_juego`),
  ADD KEY `fk_jue_usu` (`id_usuario`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD UNIQUE KEY `id_prestamo` (`id_prestamo`),
  ADD KEY `fk_pres_ami` (`id_amigo`),
  ADD KEY `fk_pres_jue` (`id_juego`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id_amigo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `fk_ami_usu` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `fk_jue_usu` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fk_pres_ami` FOREIGN KEY (`id_amigo`) REFERENCES `amigos` (`id_amigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pres_jue` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
