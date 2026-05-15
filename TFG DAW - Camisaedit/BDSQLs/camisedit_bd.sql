-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2026 a las 21:47:10
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
-- Base de datos: `camisedit_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ped_id` int(11) NOT NULL,
  `ped_user_id` int(11) NOT NULL,
  `ped_ropa_id` int(11) NOT NULL,
  `ped_estado` varchar(15) NOT NULL,
  `ped_dateIni` date NOT NULL,
  `ped_dateStart` date NOT NULL,
  `ped_dateEnd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ped_id`, `ped_user_id`, `ped_ropa_id`, `ped_estado`, `ped_dateIni`, `ped_dateStart`, `ped_dateEnd`) VALUES
(4, 1, 17, 'Pendiente', '2026-05-11', '2026-05-12', '0000-00-00'),
(5, 1, 18, 'Producción', '2026-05-11', '2026-05-15', '0000-00-00'),
(6, 2, 19, 'Reparto', '2026-05-11', '2026-05-16', '0000-00-00'),
(7, 2, 20, 'Entregado', '2026-05-12', '0000-00-00', '0000-00-00'),
(9, 1, 22, 'Cancelado', '2026-05-12', '0000-00-00', '0000-00-00'),
(10, 1, 23, 'Pendiente', '2026-05-13', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropa`
--

CREATE TABLE `ropa` (
  `ropa_id` int(11) NOT NULL,
  `ropa_tamano` varchar(10) NOT NULL,
  `ropa_colBase` varchar(15) NOT NULL,
  `ropa_dis` varchar(15) NOT NULL,
  `ropa_colDis` varchar(15) NOT NULL,
  `ropa_txtCont` varchar(15) NOT NULL,
  `ropa_txtCol` varchar(15) NOT NULL,
  `ropa_txtPos` varchar(15) NOT NULL,
  `ropa_txtTam` varchar(15) NOT NULL,
  `ropa_txtTip` varchar(15) NOT NULL,
  `ropa_logo` varchar(15) NOT NULL,
  `ropa_logoElev` varchar(15) NOT NULL,
  `ropa_logoPos` varchar(15) NOT NULL,
  `ropa_logoTam` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ropa`
--

INSERT INTO `ropa` (`ropa_id`, `ropa_tamano`, `ropa_colBase`, `ropa_dis`, `ropa_colDis`, `ropa_txtCont`, `ropa_txtCol`, `ropa_txtPos`, `ropa_txtTam`, `ropa_txtTip`, `ropa_logo`, `ropa_logoElev`, `ropa_logoPos`, `ropa_logoTam`) VALUES
(9, 'medium', 'verde', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'),
(10, 'medium', 'rojo', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'),
(11, 'medium', 'azul', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'),
(12, 'medium', 'azul', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'),
(13, 'medium', 'verde', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'),
(17, 'xtra-large', 'verde', '-', '-', '-', '-', 'bottom', '-', 'Times New Roman', 'avion', '-', '-', '-'),
(18, 'large', 'azul', 'mitades', 'azul', 'Holaquetal', 'rojo', 'middle', 'medium', 'Times New Roman', '-', '-', '-', '-'),
(19, 'small', 'azul', 'fuego', 'azul', '-', '-', '-', '-', '-', '-', '-', '-', 'medium'),
(20, 'large', 'verde', '-', '-', '-', '-', '-', '-', 'Courier New', '-', '-', '-', 'medium'),
(22, 'large', 'verde', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'),
(23, 'medium', 'azul', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_passwd` varchar(15) NOT NULL,
  `user_nomCom` varchar(40) NOT NULL,
  `user_tlf` varchar(11) NOT NULL,
  `user_dateCreado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_passwd`, `user_nomCom`, `user_tlf`, `user_dateCreado`) VALUES
(1, 'camisedit.admin@email.com', '!123ABcd', 'Admin Istrador', '12345678', '2026-04-05'),
(2, 'ejemplo@email.com', '!1234ABcd', 'Juanito Alcachofa', '123456789', '2026-05-03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ped_id`),
  ADD KEY `ped_FK_ropa_id` (`ped_ropa_id`),
  ADD KEY `ped_FK_user_id` (`ped_user_id`);

--
-- Indices de la tabla `ropa`
--
ALTER TABLE `ropa`
  ADD PRIMARY KEY (`ropa_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UNIQUE_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ped_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ropa`
--
ALTER TABLE `ropa`
  MODIFY `ropa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `ped_FK_ropa_id` FOREIGN KEY (`ped_ropa_id`) REFERENCES `ropa` (`ropa_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ped_FK_user_id` FOREIGN KEY (`ped_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
