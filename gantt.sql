-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-03-2014 a las 17:45:24
-- Versión del servidor: 5.5.35
-- Versión de PHP: 5.3.10-1ubuntu3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gantt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigs`
--

CREATE TABLE IF NOT EXISTS `assigs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de asignacion',
  `task_id` int(11) NOT NULL COMMENT 'Identificador de tarea',
  `resourceId` int(11) NOT NULL COMMENT 'Identificador de recurso asignado a tarea',
  `roleId` int(11) NOT NULL COMMENT 'Identificador del rol, del recuros para esta tarea.',
  `effort` int(11) NOT NULL COMMENT 'Tiempo estimado de esfuerzo a ser aplicado a la tarea.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Distribucion de recursos, roles y tareas. http://goo.gl/2ZJ9i ' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `assigs`
--

INSERT INTO `assigs` (`id`, `task_id`, `resourceId`, `roleId`, `effort`) VALUES
(1, 3, 1, 1, 10800000),
(2, 4, 1, 1, 14400000),
(3, 6, 2, 2, 14400000),
(4, 7, 2, 2, 14400000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `project`
--

INSERT INTO `project` (`id`, `name`) VALUES
(1, 'proyecto de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de recurso.',
  `name` varchar(140) NOT NULL COMMENT 'Inidca el nombre del recurso',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Indica los recusos disponibles para el proyecto.  http://goo.gl/2ZJ9i' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `resource`
--

INSERT INTO `resource` (`id`, `name`) VALUES
(1, 'Resource 1'),
(2, 'Resource 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Rol del recurso',
  `name` varchar(140) NOT NULL COMMENT 'Nombre del rol del recurso',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Indica los roles disponibles para cada recurso Link http://goo.gl/2ZJ9i' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Web Designer'),
(2, 'Web Developer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de Tarea',
  `name` varchar(250) NOT NULL COMMENT 'Nombre o descripcion de tarea.',
  `code` varchar(75) DEFAULT NULL COMMENT 'Nombre de corto de la tarea.',
  `description` text NOT NULL COMMENT 'Descripcion de la tarea',
  `level` smallint(6) NOT NULL COMMENT 'Nivel de la tarea',
  `status` enum('STATUS_ACTIVE','STATUS_DONE','STATUS_FAILED','STATUS_SUSPENDED','STATUS_UNDEFINED') NOT NULL DEFAULT 'STATUS_ACTIVE' COMMENT 'Indica el estatus de la tarea',
  `start` bigint(20) unsigned NOT NULL COMMENT 'Fecha de Inicio de la tarea',
  `end` bigint(20) unsigned NOT NULL COMMENT 'Fecha de Finalizacion de la tarea	',
  `duration` int(10) unsigned NOT NULL COMMENT 'Tiempo de duracion de la tarea.',
  `startIsMilestone` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indica si la tarea inicia un HITO',
  `endIsMilestone` tinyint(1) NOT NULL DEFAULT '0',
  `collapsed` tinyint(1) DEFAULT NULL,
  `depends` varchar(140) DEFAULT NULL COMMENT 'Almacena las dependencias de la tarea separadas por coma.',
  `progress` varchar(25) NOT NULL DEFAULT '0' COMMENT 'Indica el progreso de la tarea.',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indica si la tarea fue borrada',
  `project_id` int(11) NOT NULL COMMENT 'Identificador del proyecto al cual pertenece la tarea.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contiene las tareas asociadas a un proyectos. Link http://goo.gl/2ZJ9i' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `task`
--

INSERT INTO `task` (`id`, `name`, `code`, `description`, `level`, `status`, `start`, `end`, `duration`, `startIsMilestone`, `endIsMilestone`, `collapsed`, `depends`, `progress`, `deleted`, `project_id`) VALUES
(1, 'APP', '', '', 0, 'STATUS_ACTIVE', 1396326600000, 1397536199999, 10, 0, 0, 0, '', '0', 0, 1),
(2, 'Diseño', '', '', 1, 'STATUS_ACTIVE', 1396326600000, 1396672199999, 4, 0, 0, 0, '', '0', 0, 1),
(3, 'Formulario 1', 'F1', 'Descripción F1', 2, 'STATUS_ACTIVE', 1396326600000, 1396499399999, 2, 0, 0, 0, '', '0', 0, 1),
(4, 'Formulario 2', 'F2', 'Descripción F2', 2, 'STATUS_SUSPENDED', 1396499400000, 1396672199999, 2, 0, 0, 0, '3', '0', 0, 1),
(5, 'Desarrollo', '', '', 1, 'STATUS_ACTIVE', 1396326600000, 1397536199999, 10, 0, 0, 0, '', '0', 0, 1),
(6, 'Formulario 1', 'DF1', 'DF1', 2, 'STATUS_SUSPENDED', 1396845000000, 1397104199999, 3, 0, 0, 0, '4', '0', 0, 1),
(7, 'Formulario 2', 'DF2', 'DF2', 2, 'STATUS_SUSPENDED', 1397104200000, 1397536199999, 3, 0, 0, 0, '6', '0', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
