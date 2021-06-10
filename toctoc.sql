-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2021 a las 19:37:56
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `toctoc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hinchable`
--

CREATE TABLE `hinchable` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dimensiones` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `descripcion` varchar(1200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio1` float NOT NULL,
  `precio2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hinchable`
--

INSERT INTO `hinchable` (`id`, `nombre`, `dimensiones`, `tipo`, `descripcion`, `precio1`, `precio2`) VALUES
(16, 'Castillo Clown', '4,2X3,3X5,00', 2, 'El Castillo Hinchable Clown es perfecto para los más pequeños,ideado para niños a partir de 2 años.\r\nUn castillo hinchable clásico, con temática de payasos y sin obstáculos, perfecto para saltar y divertirse.\r\nLa estructura tiene 3 paredes lo que le hace seguro para saltar, con una capacidad recomendada de 6 a 8 niños dependiendo de sus edades y estatura.\r\nRequisitos: Toma de corriente 220V/1500W', 150, 120),
(17, 'Castillo Hinchable MultiJungla', '4,20X2,65X5,00', 2, 'Alquilar un castillo hinchable para una fiesta de cumpleaños infantil nunca fue tan barato y eficaz. Una buenísima opción es este castillo hinchable Multi Jungla, con temática de animales de la jungla y obstáculos, siguiendo la línea de animación infantil, este castillo con tres paredes, obstáculos con formas de animales que permiten una experiencia completa que divertirá desde los más pequeños hasta los más mayorcitos. ', 150, 120),
(18, 'Castillo Hinchable Mini-Multi', '4,50X2,50X5,00', 2, 'Si estás pensando en alquilar el castillo hinchable Mini – Multi disfrutarás de una experiencia única, sobre todo para fiestas infantiles y cumpleaños, un castillo de pequeñas dimensiones idóneo para los más pequeños, con capacidad sobre 8 niños (puede variar) tiene tres paredes, lo que ayuda mucho a tener controlados a los niños de menor edad. ', 150, 130),
(19, 'Castillo Hinchable Bomberos', '5,00X4,00X5,00', 2, 'El castillo hinchable de bomberos es un sencillo inflable adaptado para los más pequeños, con un tobogán pequeño en un lateral, es perfecto para que los niños y niñas más pequeños puedan disfrutar sin problemas.\r\nTiene unas medidas de 5x5x4 metros y cuenta con un bombero. Una forma barata y sencilla para poder ver cómo disfrutan los niños pequeñitos saltando en un inflable para los peques.\r\nPara poder utilizar este castillo hinchable pequeño se necesita una toma de corriente de 220 v/ 1500 W.', 160, 120),
(20, 'Tobogan Hawaiano', '5,00X5,00X8,00', 2, 'La opción de alquilar el tobogán hawaiano es perfecta para verano, pues es un hinchable que tiene una pequeña piscina de agua a la cual puedes tirarte deslizándote por el tobogán. Por si no fuese suficiente, con el tobogán se pueden crear 2 super hinchables, combinándolo con el resbalín o la pista hawaiana. Uno de los mejores hinchables que hay.', 160, 130),
(21, 'Futbolín humano', '6,00X2,5X16', 1, 'El hinchable de Futbolín Humano es un clásico dentro de los eventos de animación. Con capacidad para 14 personas, los partidos de futbolín humano serán intensos y muy divertidos. \r\n\r\nDispone de barras con protecciones para cada equipo, aunque también se puede jugar sin barras. Podrás alquilar este futbolín humano para niños y para adultos', 170, 140),
(22, 'Toro mecánico', '6,0X3,00X6,00', 1, 'Si te interesa alquilar el toro mecánico para tu fiesta, tan solo contacta con nosotros. El Toro tiene capacidad para 1 jinete y el control lo llevará uno de nuestros monitores. No disponible alquiler sin monitor.\r\n\r\nLa edad mínima es de 6 años, aunque los menores de 6 años podrán subir con un adulto y el programa del toro será al mínimo.', 160, 0),
(23, 'Gladiadores', '6,00X3,00X6,00', 1, 'Una atracción hinchable en la que 2 luchadores subirán a la plataforma del centro y lucharán por ver quién se mantiene en pie. Un divertido juego tanto para adultos como para niños y que tiene mucho éxito en las fiestas de colegios e incluso empresas.', 120, 150),
(24, 'Simulador de snow', '6,00X3,00X6,00', 1, 'Un simulador de tabla de snowboard parecida al toro mecánico pero de pie, manteniendo el equilibrio en una tabla. El nivel de complicación es mayor que el del toro. ¿Podrás aguantar?', 150, 0),
(25, 'Circuito de Karts', '20,00X0X20,00', 1, 'Karts a pedales, una actividad que triunfa en las fiestas, el circuito se ajusta al espacio.\r\nUn circuito ajustable a la zona donde se celebre el evento, delimitado con conos, los karts a pedales son una divertida forma de movilidad ecológica. Los más pequeños quedarán encantados, los más mayores darán unas divertidas vueltas. Si quieres alquilar los karts a pedales, estarás acertando en tu evento, indispensables.', 170, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hinchable` int(11) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `direccion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cod_postal` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float NOT NULL,
  `monitor` tinyint(1) NOT NULL,
  `hora_inicio` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `hora_final` varchar(5) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `id_user`, `id_hinchable`, `fecha_reserva`, `direccion`, `ciudad`, `cod_postal`, `precio`, `monitor`, `hora_inicio`, `hora_final`) VALUES
(32, 1, 16, '2021-06-11', 'Calle Zorzales 19a 3b', 'Aranjuez', '28300', 150, 1, '10:28', '14:28'),
(33, 2, 16, '2021-06-11', 'Calle Zorzales 19a 3b', 'Aranjuez', '28300', 150, 1, '16:30', '20:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'Atracciones'),
(2, 'Hinchables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `identificador` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenna` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `codigoCookie` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caducidadCodigoCookie` timestamp NULL DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `identificador`, `contrasenna`, `codigoCookie`, `caducidadCodigoCookie`, `nombre`, `apellidos`, `telefono`) VALUES
(1, 'jlopez', 'luismi12345', NULL, NULL, 'José', 'López', '098765431'),
(2, 'mgarcia', 'm', NULL, NULL, 'María', 'García', '987654321'),
(3, 'fpi', 'f', NULL, NULL, 'Felipe', 'Pi', '123456789');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hinchable`
--
ALTER TABLE `hinchable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo` (`tipo`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`),
  ADD KEY `fk_id_hinchable` (`id_hinchable`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificador` (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hinchable`
--
ALTER TABLE `hinchable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hinchable`
--
ALTER TABLE `hinchable`
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_id_hinchable` FOREIGN KEY (`id_hinchable`) REFERENCES `hinchable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
