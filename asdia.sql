-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql208.mipropia.com
-- Tiempo de generación: 13-12-2019 a las 17:42:23
-- Versión del servidor: 5.6.45-86.1
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mipc_24649162_DB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(100) NOT NULL,
  `src` varchar(100) NOT NULL DEFAULT '',
  `titulo` varchar(255) NOT NULL DEFAULT 'Inserte Titulo',
  `descripcion` tinytext NOT NULL,
  `mostrar` char(1) NOT NULL DEFAULT 'N',
  `pos` int(3) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `src`, `titulo`, `descripcion`, `mostrar`, `pos`) VALUES
(22, 'w8jsv1aeld7xhqytg9z6pr2i534kcmnbouf.jpeg', 'Nuestras pistas\n', 'Disponemos de tres pistas.', 'S', 1),
(24, 'km4f8lryaxoduzs15pcq3wvbgej792in6ht.jpeg', 'Lobby', 'Guardería, máquinas de vending, vestuarios y recepción.', 'S', 1),
(25, '2otzndkpif6ry1l9xguv3hs8w5jqmcb4ea7.jpeg', 'Tenis para niños', 'Día de la clausura del curso de verano de tenis para niños. Año 2019.', 'S', 1),
(23, '26tnvjh4wyzpl8mq5gsxur1b9o7ek3fciad.jpeg', 'Vestuario', 'Tenemos duchas con agua caliente, servicio de taquilla.', 'N', 1),
(26, 'ygd6mirb2u9n7ewjztl4sac3h1vq5o8fpkx.jpeg', 'Torneo ASDIA 2019', 'Ganadora del torneo celebrado en Septiembre en nuestras instalaciones. Enhorabuena campeona.', 'S', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE `liga` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT 'Inserte nombre',
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`id`, `nombre`, `estado`, `fecha`) VALUES
(1, 'ninguna', 'F', '0000-00-00 00:00:00'),
(12, 'Liga 1', 'A', '2019-12-13 19:41:58'),
(11, 'Liga 2', 'A', '2019-12-13 16:33:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Inserte el título de la noticia',
  `cuerpo` text COLLATE utf8_spanish_ci NOT NULL,
  `mostrar` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'N',
  `imagenes` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '[]',
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `cuerpo`, `mostrar`, `imagenes`, `fecha`) VALUES
(2, 'Campeona del Torneo', '<div id=\"lipsum\">\r\n<div>El domingo pasado tuvo lugar la final del torneo ASDIA. La ganadora ha sido Andrea Correa, de 19 años, natural de Villafranca de los Barros. El premio, 300 euros en material deportivo, lo ha donado al colegio de educación especial Los Ángeles de Badajoz ya que \"a ellos le hacen más falta que a mi\", nos confesó. Felicidades campeona.</div></div>', 'S', '[\"img/noticias/2/fotoclausuratenistalavera2.jpg\"]', '2019-11-27'),
(3, 'Clausura curso de verano', '<span times=\"\" new=\"\" roman\",=\"\" times,=\"\" serif;=\"\" font-size:=\"\" 17px;\"=\"\" style=\"font-size: 2rem; color: rgb(32, 32, 32);\"></span><span style=\"font-size:18px;\">Este sábado ha tenido lugar en nuestras instalaciones la clausura del curso de verano para niños de tenis. Este año, nuestros cursos estivales han tenido una gran acogida entre las familias de nuestra localidad. El día de la clausura se esperaba la asistencia de unos 60 alumnos con sus respectivos familiares.&nbsp;Aunque se avecinaba tormenta, el tiempo nos dio una tregua y se pudieron realizar todas las actividades y talleres previstos al aire libre, entre ellos:<br><ul><li><span style=\"font-size:18px;\">\r\nTorneo dúos \"Hoy con papá\"</span></li><li>Carreras de sacos</li><li>Almuerzo saludable</li><li>Concurso \"El saque perfecto\"</li><li>Taller \"Nudos de zapatillas molonas\"</li><li>\"¿Quién es el mejor recogepelotas?\"</li></ul>\r\nNuestros niños y papis se lo pasaron bomba en un día diferente.&nbsp;<br>\r\nDesde ASDIA queremos agradecer a todos los papis la confianza que han depositado en nosotros. Les deseamos mucha suerte a todos nuestros niños. Nos vemos el próximo verano!</span><div><div><font color=\"#202020\"></font></div></div>', 'S', '[\"img/noticias/3/_tpkfestaestiu2017_2108cf19.jpg\"]', '2019-09-14'),
(4, 'Notición', 'Este es el cuerpo de la noticia', 'N', '[]', '2019-12-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `no_socio`
--

CREATE TABLE `no_socio` (
  `id` int(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `credit_card` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `no_socio`
--

INSERT INTO `no_socio` (`id`, `id_user`, `credit_card`) VALUES
(1, 'v88', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido_liga`
--

CREATE TABLE `partido_liga` (
  `id` int(11) NOT NULL,
  `participante1` varchar(50) NOT NULL DEFAULT 'Jugador 1',
  `participante2` varchar(50) NOT NULL DEFAULT 'Jugador 2',
  `resultado` int(1) NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `liga` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partido_liga`
--

INSERT INTO `partido_liga` (`id`, `participante1`, `participante2`, `resultado`, `fecha`, `liga`) VALUES
(8, 'Alba López sa dasdsa asdd asdas ', '  Antonio', 1, '2019-12-08 23:40:49', 9),
(9, 'Jugador 1', 'Jugador 2', 2, '2019-12-08 23:45:44', 10),
(10, 'Cosas rararsss', ' Jugador 2', 1, '2019-12-08 23:47:20', 10),
(11, 'Jugador 1', 'Jugador 2', 2, '2019-12-08 23:50:46', 10),
(12, 'Jugador 1', 'Jugador 2', 1, '2019-12-09 12:01:05', 10),
(13, 'Alba López sa dasdsa asdd asdas ', '  Antonio', 1, '2019-12-09 14:02:47', 9),
(17, 'Antonio González', 'Alba López', 2, '2019-12-13 16:33:52', 11),
(18, 'Antonio González', 'Isidro Sánchez', 1, '2019-12-13 16:34:39', 11),
(19, 'Isidro Sánchez', 'Alba López', 1, '2019-12-13 16:35:00', 11),
(20, 'Manuel Jacinto Algar ', 'Agustin Javier Cancela ', 1, '2019-12-13 19:42:11', 12),
(21, 'Agustin Javier Cancela ', 'Manuel Jacinto Algar ', 1, '2019-12-13 19:42:13', 12),
(22, 'Felipe Antonio Redondo ', 'Manuel Jacinto Algar ', 2, '2019-12-13 19:42:14', 12),
(23, 'Felipe Antonio Redondo ', 'Agustin Javier Cancela ', 1, '2019-12-13 19:42:15', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `puesto`, `imagen`) VALUES
(13, 'Laura Prieto', 'Recepcionista', '6z2oc4widu8fmeqspvnhjb3lrt9a17g5xyk.jpeg'),
(14, 'Esteban Álvarez', 'Mantenimiento', '2kpxjo8qlgvm5sawcb96trzif4ynd3hu71e.jpeg'),
(15, 'Carla Bravo', 'Administración-Recepción', 'hd6qua72slk3j4rxnbw5pivgyfo1zcm8t9e.jpeg'),
(16, 'Claudio Sanserván', 'Monitor', 'hp1i6a3jnf9lv8xwzym57d2rkqugoe4bstc.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(100) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `pista` int(3) NOT NULL,
  `id_empleado` int(100) DEFAULT NULL,
  `tarifa` float NOT NULL DEFAULT '1.65',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(10) NOT NULL DEFAULT 'libre',
  `liga` int(100) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `id_user`, `fecha`, `hora_inicio`, `hora_fin`, `pista`, `id_empleado`, `tarifa`, `fecha_registro`, `estado`, `liga`) VALUES
(45, 'agonzalez73', '2019-12-02', '09:00:00', '10:00:00', 1, NULL, 1.65, '2019-12-02 22:18:17', 'libre', 1),
(46, 'alopez5', '2019-12-02', '10:00:00', '11:00:00', 2, NULL, 1.65, '2019-12-02 22:18:25', 'libre', 1),
(47, 'alopez5', '2019-12-02', '09:00:00', '10:00:00', 3, NULL, 1.65, '2019-12-02 22:18:30', 'libre', 1),
(48, 'alopez5', '2019-12-02', '10:30:00', '11:30:00', 1, NULL, 1.65, '2019-12-02 22:18:44', 'libre', 1),
(49, 'agonzalez73', '2019-12-02', '10:30:00', '11:30:00', 3, NULL, 1.65, '2019-12-02 22:18:50', 'libre', 1),
(50, 'alopez5', '2019-12-06', '09:30:00', '10:30:00', 2, NULL, 1.65, '2019-12-06 12:12:59', 'libre', 1),
(53, 'alopez5', '2019-12-06', '10:00:00', '10:30:00', 3, NULL, 1.65, '2019-12-06 12:13:20', 'libre', 1),
(54, 'agonzalez73', '2019-12-06', '10:00:00', '10:30:00', 1, NULL, 1.65, '2019-12-06 19:46:40', 'libre', 1),
(72, 'bloqueo', '2019-12-11', '09:00:00', '14:00:00', 3, NULL, 1.65, '2019-12-11 23:17:10', 'bloqueo', 1),
(73, 'bloqueo', '2019-12-11', '09:00:00', '14:00:00', 1, NULL, 1.65, '2019-12-11 23:17:14', 'bloqueo', 1),
(83, 'bloqueo', '2019-12-12', '16:30:00', '23:00:00', 3, NULL, 1.65, '2019-12-12 19:54:49', 'B', 1),
(127, 'agonzalez2', '2019-12-13', '10:30:00', '11:30:00', 1, NULL, 1.65, '2019-12-13 17:37:54', 'libre', 1),
(102, 'agonzalez75', '2019-12-12', '18:30:00', '20:30:00', 1, NULL, 1.65, '2019-12-12 22:51:22', 'libre', 1),
(103, 'agonzalez75', '2019-12-12', '20:30:00', '22:30:00', 1, NULL, 1.65, '2019-12-12 22:53:27', 'libre', 1),
(104, 'agonzalez75', '2019-12-12', '20:30:00', '22:30:00', 2, NULL, 1.65, '2019-12-12 22:54:21', 'libre', 1),
(110, 'agonzalez99', '2019-12-12', '09:30:00', '10:30:00', 1, NULL, 1.65, '2019-12-12 23:05:46', 'libre', 1),
(111, 'agonzalez99', '2019-12-12', '10:00:00', '11:00:00', 2, NULL, 1.65, '2019-12-12 23:07:22', 'libre', 1),
(130, 'agonzalez2', '2019-12-13', '11:00:00', '13:00:00', 2, NULL, 1.65, '2019-12-13 18:00:46', 'libre', 11),
(131, 'agonzalez2', '2019-12-13', '10:00:00', '11:00:00', 3, NULL, 1.65, '2019-12-13 18:06:36', 'libre', 1),
(121, 'agonzalez14', '2019-12-13', '18:30:00', '20:30:00', 2, NULL, 1.65, '2019-12-13 01:26:40', 'libre', 1),
(129, 'agonzalez2', '2019-12-13', '09:00:00', '09:30:00', 1, NULL, 1.65, '2019-12-13 18:00:28', 'libre', 1),
(123, 'agonzalez14', '2019-12-14', '13:00:00', '15:00:00', 2, NULL, 1.65, '2019-12-13 02:53:30', 'libre', 1),
(128, 'agonzalez2', '2019-12-13', '18:00:00', '19:00:00', 1, NULL, 1.65, '2019-12-13 17:53:47', 'libre', 1),
(132, 'agonzalez2', '2019-12-13', '11:30:00', '12:30:00', 3, NULL, 1.65, '2019-12-13 18:06:44', 'libre', 1),
(133, 'agonzalez2', '2019-12-13', '09:00:00', '00:00:00', 2, NULL, 1.65, '2019-12-13 19:52:40', 'libre', 1),
(134, 'agonzalez2', '2019-12-13', '10:00:00', '10:30:00', 1, NULL, 1.65, '2019-12-13 19:54:09', 'libre', 1),
(135, 'agonzalez2', '2019-12-13', '12:30:00', '13:30:00', 1, NULL, 1.65, '2019-12-13 21:44:09', 'libre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE `socio` (
  `id` int(100) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `bonos` int(3) NOT NULL DEFAULT '2',
  `credit_card` int(20) DEFAULT NULL,
  `strikes` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`id`, `id_user`, `bonos`, `credit_card`, `strikes`) VALUES
(2, 'agonzalez14', 5, NULL, 1),
(3, 'agonzalez2', 1, NULL, 0),
(4, 'a32', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `user` varchar(30) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` char(1) NOT NULL DEFAULT 'U',
  `pwd` varchar(255) NOT NULL,
  `id_creador` varchar(255) DEFAULT NULL,
  `tel` varchar(12) NOT NULL DEFAULT '00000000000'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user`, `nombre`, `apellidos`, `email`, `passwd`, `fecha_ingreso`, `tipo`, `pwd`, `id_creador`, `tel`) VALUES
('agonzalez2', 'ANTONIO', 'GONZÁLEZ MORENO', 'asdsadds@asdssad', '37108c1d31be28c3c1550954fa348cbf', '2019-12-13 15:59:37', 'S', '4FGEA57BI86D', NULL, '00000000000'),
('anton1o', NULL, NULL, 'asdad@ads.com', 'bb45aafc0ab11aab73b53b3b0b2a0af8', '2019-11-27 21:03:13', 'A', 'practicas', NULL, '00000000000'),
('bloqueo', NULL, 'Bloqueo', '', '', '2019-11-30 21:34:12', 'O', '', NULL, '00000000000'),
('c83', 'CARLA ', 'BRAVO', 'carla.bravo@asdiaclubtenis.es', '3cb61eb45df3d9546074ad883aa28c62', '2019-12-13 21:55:02', 'A', '43BGK2EI197H', NULL, '00000000000'),
('l63', 'LAURA', 'PRIETO', 'laura.prieto@asdiaclubdetenis.', 'a1e3532f07cba71953aa31627d04fc41', '2019-12-13 21:55:29', 'E', '12H49I86DFKA', NULL, '00000000000'),
('a32', 'ANDREA', 'CUERVO', 'andrea@gmail.net', '072da559dddf32fbf510eb17df207aa7', '2019-12-13 21:56:26', 'S', '4K2856B109JH', NULL, '00000000000'),
('v88', 'VASILI', 'STADNIK', 'vasili@gmail.net', '7d7de69b030ab9358262e68b7235b512', '2019-12-13 21:56:47', 'N', 'G1F7AEB9CHJ5', NULL, '00000000000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `no_socio`
--
ALTER TABLE `no_socio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partido_liga`
--
ALTER TABLE `partido_liga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liga` (`liga`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a` (`id_user`),
  ADD KEY `reserva_ibfk_1` (`liga`);

--
-- Indices de la tabla `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socio_ibfk_1` (`id_user`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `no_socio`
--
ALTER TABLE `no_socio`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `partido_liga`
--
ALTER TABLE `partido_liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `socio`
--
ALTER TABLE `socio`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
