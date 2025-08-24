-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2025 a las 03:14:06
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
-- Base de datos: `pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tamano` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `fecha_recepcion` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `proveedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `tamano`, `marca`, `cantidad`, `precio_compra`, `precio_venta`, `fecha_recepcion`, `fecha_vencimiento`, `proveedor`) VALUES
(1, '12345678', 'Coca-Cola ', '3L', 'Cocacola', 149, 2000, 3000, '2025-06-15', '2025-07-27', 'Los Angeles'),
(2, '738374', 'Vino Blanco', '500ml', 'Gato', 22, 1800, 4000, '2025-06-09', '2025-12-28', 'Los Hermanos Torres'),
(3, '9876543', 'Pisco ', '700ml', 'Mistral', 92, 4990, 6890, '2025-06-15', '2025-07-06', 'Los Hermanos Torres'),
(4, '344566788', 'Wisky', '750 cc', 'Jack Daniels', 30, 17870, 23990, '0000-00-00', '2025-06-29', 'Distribuidora Ilusionista'),
(5, '12345333', 'Vodka Negro', '750 cc', 'Bacardi', 49, 5000, 8500, '0000-00-00', '2025-08-30', 'Los Hermanos Torres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `usuario`, `password`, `rol`) VALUES
(1, 'Almendra Manriquez', 'admin', '$2a$07$usesomesillystringforewOdLB5CheF5NZbm8TQfHJwIPWk0j23q', 'Administrador'),
(2, 'Matias Caceres', 'mati', '$2a$07$usesomesillystringforeWbVzYlorgmbfLnSWRwHce7G62sVyNeG', 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `productos` text NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `id_usuario`, `productos`, `total`, `metodo_pago`, `fecha`) VALUES
(5, 1, '[{\"id\":\"1\",\"nombre\":\"Coca-Cola \",\"cantidad\":\"1\",\"precioUnitario\":\"3000\",\"precioTotal\":\"3.000\"},{\"id\":\"2\",\"nombre\":\"Vino Blanco\",\"cantidad\":\"1\",\"precioUnitario\":\"4000\",\"precioTotal\":\"4.000\"}]', 7000, 'Tarjeta', '2025-06-15 07:54:28'),
(6, 1, '[{\"id\":\"1\",\"nombre\":\"Coca-Cola \",\"cantidad\":\"5\",\"precioUnitario\":\"3000\",\"precioTotal\":\"15.000\"}]', 15000, 'Tarjeta', '2025-06-15 07:54:38'),
(7, 1, '[{\"id\":\"2\",\"nombre\":\"Vino Blanco\",\"cantidad\":\"1\",\"precioUnitario\":\"4000\",\"precioTotal\":\"4.000\"},{\"id\":\"3\",\"nombre\":\"Pisco \",\"cantidad\":\"2\",\"precioUnitario\":\"6890\",\"precioTotal\":\"13.780\"},{\"id\":\"4\",\"nombre\":\"Wisky\",\"cantidad\":\"3\",\"precioUnitario\":\"23990\",\"precioTotal\":\"71.970\"}]', 89750, 'Efectivo', '2025-06-15 07:55:05'),
(8, 1, '[{\"id\":\"1\",\"nombre\":\"Coca-Cola \",\"cantidad\":\"5\",\"precioUnitario\":\"3000\",\"precioTotal\":\"15.000\"}]', 15000, 'Tarjeta', '2025-06-15 07:58:04'),
(9, 2, '[{\"id\":\"1\",\"nombre\":\"Coca-Cola \",\"cantidad\":\"1\",\"precioUnitario\":\"3000\",\"precioTotal\":\"3.000\"},{\"id\":\"2\",\"nombre\":\"Vino Blanco\",\"cantidad\":\"1\",\"precioUnitario\":\"4000\",\"precioTotal\":\"4.000\"},{\"id\":\"3\",\"nombre\":\"Pisco \",\"cantidad\":\"1\",\"precioUnitario\":\"6890\",\"precioTotal\":\"6.890\"},{\"id\":\"4\",\"nombre\":\"Wisky\",\"cantidad\":\"3\",\"precioUnitario\":\"23990\",\"precioTotal\":\"71.970\"},{\"id\":\"5\",\"nombre\":\"Vodka Negro\",\"cantidad\":\"1\",\"precioUnitario\":\"8500\",\"precioTotal\":\"8.500\"}]', 94360, 'Tarjeta', '2025-06-15 21:39:51');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
