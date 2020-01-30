-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2020 a las 20:55:49
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `multasnew`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuatrimestre`
--

CREATE TABLE `cuatrimestre` (
  `id_cuatrimestre` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_direccion` int(11) NOT NULL,
  `cp` varchar(8) DEFAULT NULL,
  `colonia` varchar(100) DEFAULT NULL,
  `municipio` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `division`
--

CREATE TABLE `division` (
  `id_division` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `puesto` int(11) NOT NULL,
  `curd` varchar(20) NOT NULL,
  `institucion` int(11) NOT NULL,
  `direccion` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `sexo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `matricula` varchar(15) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `perfil` int(11) NOT NULL,
  `sexo` int(11) NOT NULL,
  `curd` varchar(20) NOT NULL,
  `direccion` int(11) NOT NULL,
  `movil` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `folio` int(11) NOT NULL,
  `fecha_creada` date DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `tipo_materia` int(11) NOT NULL,
  `tipo_personal` int(11) NOT NULL,
  `multado` varchar(15) NOT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas_atrasadas`
--

CREATE TABLE `multas_atrasadas` (
  `id` int(11) NOT NULL,
  `id_multa` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `programa` int(11) NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `turno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preciosmulta`
--

CREATE TABLE `preciosmulta` (
  `precio` float DEFAULT NULL,
  `tipo_personal` int(11) NOT NULL,
  `years` varchar(4) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `id_puesto` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL,
  `nombre` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `cuatrimestre`
--
ALTER TABLE `cuatrimestre`
  ADD PRIMARY KEY (`id_cuatrimestre`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id_division`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `puesto` (`puesto`),
  ADD KEY `institucion` (`institucion`),
  ADD KEY `area` (`area`),
  ADD KEY `sexo` (`sexo`),
  ADD KEY `direccion` (`direccion`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `perfil` (`perfil`),
  ADD KEY `sexo` (`sexo`),
  ADD KEY `direccion` (`direccion`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `multas`
--
ALTER TABLE `multas`
  ADD PRIMARY KEY (`folio`),
  ADD KEY `tipo_materia` (`tipo_materia`),
  ADD KEY `tipo_personal` (`tipo_personal`),
  ADD KEY `multas_ibfk_4` (`multado`);

--
-- Indices de la tabla `multas_atrasadas`
--
ALTER TABLE `multas_atrasadas`
  ADD PRIMARY KEY (`id`,`id_multa`),
  ADD KEY `id_multa` (`id_multa`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`),
  ADD KEY `division` (`division`),
  ADD KEY `status` (`status`),
  ADD KEY `programa` (`programa`),
  ADD KEY `cuatrimestre` (`cuatrimestre`),
  ADD KEY `grupo` (`grupo`),
  ADD KEY `turno` (`turno`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indices de la tabla `preciosmulta`
--
ALTER TABLE `preciosmulta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_personal` (`tipo_personal`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuatrimestre`
--
ALTER TABLE `cuatrimestre`
  MODIFY `id_cuatrimestre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `division`
--
ALTER TABLE `division`
  MODIFY `id_division` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multas`
--
ALTER TABLE `multas`
  MODIFY `folio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multas_atrasadas`
--
ALTER TABLE `multas_atrasadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preciosmulta`
--
ALTER TABLE `preciosmulta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`id_municipio`),
  ADD CONSTRAINT `direccion_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`puesto`) REFERENCES `puesto` (`id_puesto`),
  ADD CONSTRAINT `docente_ibfk_2` FOREIGN KEY (`institucion`) REFERENCES `institucion` (`id_institucion`),
  ADD CONSTRAINT `docente_ibfk_3` FOREIGN KEY (`area`) REFERENCES `area` (`id_area`),
  ADD CONSTRAINT `docente_ibfk_4` FOREIGN KEY (`sexo`) REFERENCES `sexo` (`id_sexo`),
  ADD CONSTRAINT `docente_ibfk_5` FOREIGN KEY (`direccion`) REFERENCES `direccion` (`id_direccion`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `sexo` (`id_sexo`),
  ADD CONSTRAINT `estudiante_ibfk_3` FOREIGN KEY (`direccion`) REFERENCES `direccion` (`id_direccion`);

--
-- Filtros para la tabla `multas`
--
ALTER TABLE `multas`
  ADD CONSTRAINT `multas_ibfk_1` FOREIGN KEY (`tipo_materia`) REFERENCES `material` (`id_material`),
  ADD CONSTRAINT `multas_ibfk_2` FOREIGN KEY (`tipo_personal`) REFERENCES `personal` (`id_personal`),
  ADD CONSTRAINT `multas_ibfk_4` FOREIGN KEY (`multado`) REFERENCES `estudiante` (`matricula`),
  ADD CONSTRAINT `multase_ibfk_3` FOREIGN KEY (`multado`) REFERENCES `docente` (`id`);

--
-- Filtros para la tabla `multas_atrasadas`
--
ALTER TABLE `multas_atrasadas`
  ADD CONSTRAINT `multas_atrasadas_ibfk_1` FOREIGN KEY (`id_multa`) REFERENCES `multas` (`folio`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`division`) REFERENCES `division` (`id_division`),
  ADD CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `perfil_ibfk_3` FOREIGN KEY (`programa`) REFERENCES `programa` (`id_programa`),
  ADD CONSTRAINT `perfil_ibfk_4` FOREIGN KEY (`cuatrimestre`) REFERENCES `cuatrimestre` (`id_cuatrimestre`),
  ADD CONSTRAINT `perfil_ibfk_5` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `perfil_ibfk_6` FOREIGN KEY (`turno`) REFERENCES `turno` (`id_turno`);

--
-- Filtros para la tabla `preciosmulta`
--
ALTER TABLE `preciosmulta`
  ADD CONSTRAINT `preciosmulta_ibfk_1` FOREIGN KEY (`tipo_personal`) REFERENCES `personal` (`id_personal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
