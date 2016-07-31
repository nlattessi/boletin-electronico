SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `communitas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `communitas`;

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) DEFAULT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `materia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DF2BD0671B61351` (`establecimiento_id`),
  KEY `IDX_8DF2BD06B239FBC6` (`institucion_id`),
  KEY `IDX_8DF2BD068924462A` (`usuario_carga_id`),
  KEY `IDX_8DF2BD06B54DBBCB` (`materia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

DROP TABLE IF EXISTS `actividad_archivo`;
CREATE TABLE IF NOT EXISTS `actividad_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `actividad_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D780BE2946EBF93B` (`archivo_id`),
  KEY `IDX_D780BE296014FACA` (`actividad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `padre2_id` int(11) DEFAULT NULL,
  `padre1_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_pais` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_area` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nacionalidad` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obra_social` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obra_social_numero_afiliado` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_emergencia` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apodo` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `grupo_sanguineo` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1435D52DA1086757` (`padre2_id`),
  KEY `IDX_1435D52DB3BDC8B9` (`padre1_id`),
  KEY `IDX_1435D52D71B61351` (`establecimiento_id`),
  KEY `IDX_1435D52DE8608214` (`ciudad_id`),
  KEY `IDX_1435D52DDB38439E` (`usuario_id`),
  KEY `IDX_1435D52D86383B10` (`avatar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

DROP TABLE IF EXISTS `alumno_asistencia`;
CREATE TABLE IF NOT EXISTS `alumno_asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistencia_id` int(11) DEFAULT NULL,
  `justificacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `valor` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D30A866457376F49` (`asistencia_id`),
  KEY `IDX_D30A86646D28D42D` (`justificacion_id`),
  KEY `IDX_D30A8664FC28E5EE` (`alumno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=130 ;

DROP TABLE IF EXISTS `alumno_grupo_alumno`;
CREATE TABLE IF NOT EXISTS `alumno_grupo_alumno` (
  `grupo_alumno_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  PRIMARY KEY (`grupo_alumno_id`,`alumno_id`),
  KEY `IDX_55DB706176E3EEE` (`grupo_alumno_id`),
  KEY `IDX_55DB706FC28E5EE` (`alumno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `alumno_materia`;
CREATE TABLE IF NOT EXISTS `alumno_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_43E74FC0B54DBBCB` (`materia_id`),
  KEY `IDX_43E74FC0FC28E5EE` (`alumno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

DROP TABLE IF EXISTS `archivo`;
CREATE TABLE IF NOT EXISTS `archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `nombre_para_mostrar` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3529B4828924462A` (`usuario_carga_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_cargador_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8264A8D5D340050` (`usuario_cargador_id`),
  KEY `IDX_D8264A8DB54DBBCB` (`materia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

DROP TABLE IF EXISTS `avatar`;
CREATE TABLE IF NOT EXISTS `avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

DROP TABLE IF EXISTS `bullying`;
CREATE TABLE IF NOT EXISTS `bullying` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_13D17F25FC28E5EE` (`alumno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

DROP TABLE IF EXISTS `calificacion`;
CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(11) DEFAULT NULL,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `validada` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A3AF2182E892728` (`valor`),
  KEY `IDX_8A3AF2188924462A` (`usuario_carga_id`),
  KEY `IDX_8A3AF218E715F406` (`evaluacion_id`),
  KEY `IDX_8A3AF218FC28E5EE` (`alumno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=113 ;

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8E86059E4E7121AF` (`provincia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `convivencia`;
CREATE TABLE IF NOT EXISTS `convivencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) DEFAULT NULL,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descargo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_suceso` datetime NOT NULL,
  `validado` tinyint(1) DEFAULT NULL,
  `valor` tinyint(1) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F1A6B7B7FC28E5EE` (`alumno_id`),
  KEY `IDX_F1A6B7B78924462A` (`usuario_carga_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

DROP TABLE IF EXISTS `docente`;
CREATE TABLE IF NOT EXISTS `docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_pais` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_area` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `es_titular` tinyint(1) DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FD9FCFA4E8608214` (`ciudad_id`),
  KEY `IDX_FD9FCFA4DB38439E` (`usuario_id`),
  KEY `IDX_FD9FCFA471B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

DROP TABLE IF EXISTS `docente_materia`;
CREATE TABLE IF NOT EXISTS `docente_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_517E8597B54DBBCB` (`materia_id`),
  KEY `IDX_517E859794E27525` (`docente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE IF NOT EXISTS `especialidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ACB064F971B61351` (`establecimiento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `esquema_calificacion`;
CREATE TABLE IF NOT EXISTS `esquema_calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

DROP TABLE IF EXISTS `establecimiento`;
CREATE TABLE IF NOT EXISTS `establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad_id` int(11) DEFAULT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `esquema_calificacion_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `latitud` double DEFAULT NULL,
  `fecha_inauguracion` date DEFAULT NULL,
  `codigo_pais` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_area` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maximo_faltas` int(11) NOT NULL,
  `tardes_faltas` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94A4D17EE8608214` (`ciudad_id`),
  KEY `IDX_94A4D17EB239FBC6` (`institucion_id`),
  KEY `IDX_94A4D17EDF1613E4` (`esquema_calificacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `calificada` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DEEDCA536014FACA` (`actividad_id`),
  KEY `IDX_DEEDCA53B54DBBCB` (`materia_id`),
  KEY `IDX_DEEDCA5394E27525` (`docente_id`),
  KEY `IDX_DEEDCA539C3921AB` (`periodo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

DROP TABLE IF EXISTS `evaluacion_archivo`;
CREATE TABLE IF NOT EXISTS `evaluacion_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EBAA87B46EBF93B` (`archivo_id`),
  KEY `IDX_6EBAA87BE715F406` (`evaluacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

DROP TABLE IF EXISTS `grupo_alumno`;
CREATE TABLE IF NOT EXISTS `grupo_alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_curso` tinyint(1) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_18337A1471B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

DROP TABLE IF EXISTS `grupo_alumno_materia`;
CREATE TABLE IF NOT EXISTS `grupo_alumno_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `grupo_alumno_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7B2FAA0DB54DBBCB` (`materia_id`),
  KEY `IDX_7B2FAA0D176E3EEE` (`grupo_alumno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

DROP TABLE IF EXISTS `grupo_usuario`;
CREATE TABLE IF NOT EXISTS `grupo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_privado` tinyint(1) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D6C3EFA8924462A` (`usuario_carga_id`),
  KEY `IDX_7D6C3EFA71B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

DROP TABLE IF EXISTS `institucion`;
CREATE TABLE IF NOT EXISTS `institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuit` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

DROP TABLE IF EXISTS `justificacion`;
CREATE TABLE IF NOT EXISTS `justificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `asistencia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EBF13A878924462A` (`usuario_carga_id`),
  KEY `IDX_EBF13A8757376F49` (`asistencia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

DROP TABLE IF EXISTS `justificacion_archivo`;
CREATE TABLE IF NOT EXISTS `justificacion_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `justificacion_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_95461F5246EBF93B` (`archivo_id`),
  KEY `IDX_95461F526D28D42D` (`justificacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_materia_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6DF0528424CBB9E3` (`tipo_materia_id`),
  KEY `IDX_6DF0528471B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

DROP TABLE IF EXISTS `materia_archivo`;
CREATE TABLE IF NOT EXISTS `materia_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_566A8CA446EBF93B` (`archivo_id`),
  KEY `IDX_566A8CA4B54DBBCB` (`materia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

DROP TABLE IF EXISTS `materia_dia_horario`;
CREATE TABLE IF NOT EXISTS `materia_dia_horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `dia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hora_inicio` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BE9CEB52B54DBBCB` (`materia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE IF NOT EXISTS `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `borrador` tinyint(1) DEFAULT NULL,
  `fecha_envio` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B631D01DB38439E` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

DROP TABLE IF EXISTS `mensaje_archivo`;
CREATE TABLE IF NOT EXISTS `mensaje_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `mensaje_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A374C39A46EBF93B` (`archivo_id`),
  KEY `IDX_A374C39A4C54F362` (`mensaje_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

DROP TABLE IF EXISTS `mensaje_usuario`;
CREATE TABLE IF NOT EXISTS `mensaje_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `leido` tinyint(1) DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL,
  `borrador` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438C7454C54F362` (`mensaje_id`),
  KEY `IDX_B438C745DB38439E` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

DROP TABLE IF EXISTS `nota_periodo`;
CREATE TABLE IF NOT EXISTS `nota_periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `nota_id` int(11) DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validada` tinyint(1) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AF5C517B9C3921AB` (`periodo_id`),
  KEY `IDX_AF5C517BB54DBBCB` (`materia_id`),
  KEY `IDX_AF5C517BFC28E5EE` (`alumno_id`),
  KEY `IDX_AF5C517BA98F9F02` (`nota_id`),
  KEY `IDX_AF5C517B94E27525` (`docente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

DROP TABLE IF EXISTS `notificacion`;
CREATE TABLE IF NOT EXISTS `notificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_envio` datetime NOT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=142 ;

DROP TABLE IF EXISTS `notificacion_usuario`;
CREATE TABLE IF NOT EXISTS `notificacion_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `notificacion_id` int(11) DEFAULT NULL,
  `notificado` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4FFB3E99DB38439E` (`usuario_id`),
  KEY `IDX_4FFB3E994D633FC4` (`notificacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=230 ;

DROP TABLE IF EXISTS `padre`;
CREATE TABLE IF NOT EXISTS `padre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_laboral` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_pais` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_area` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_laboral` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `ocupacion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `email` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genero` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D3656AEBE8608214` (`ciudad_id`),
  KEY `IDX_D3656AEBDB38439E` (`usuario_id`),
  KEY `IDX_D3656AEB71B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_desde` datetime NOT NULL,
  `fecha_hasta` datetime NOT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `anio_lectivo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7316C4ED71B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D39AF213C604D5C6` (`pais_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `reporte`;
CREATE TABLE IF NOT EXISTS `reporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `dql` varchar(255) NOT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reporte_institucion_idx` (`institucion_id`),
  KEY `fk_reporte_rol_idx` (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

DROP TABLE IF EXISTS `tipo_materia`;
CREATE TABLE IF NOT EXISTS `tipo_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `token` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `expiration_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F37A13BDB38439E` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_entidad_asociada` int(11) DEFAULT NULL,
  `email` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `dni` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2265B05D4BAB96C` (`rol_id`),
  KEY `IDX_2265B05DB239FBC6` (`institucion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

DROP TABLE IF EXISTS `usuario_actividad`;
CREATE TABLE IF NOT EXISTS `usuario_actividad` (
  `usuario_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`actividad_id`),
  KEY `IDX_4C95714DB38439E` (`usuario_id`),
  KEY `IDX_4C957146014FACA` (`actividad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `usuario_establecimiento`;
CREATE TABLE IF NOT EXISTS `usuario_establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7110F23FDB38439E` (`usuario_id`),
  KEY `IDX_7110F23F71B61351` (`establecimiento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

DROP TABLE IF EXISTS `usuario_grupo_usuario`;
CREATE TABLE IF NOT EXISTS `usuario_grupo_usuario` (
  `grupo_usuario_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`grupo_usuario_id`,`usuario_id`),
  KEY `IDX_8BDF2024DBD30545` (`grupo_usuario_id`),
  KEY `IDX_8BDF2024DB38439E` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `valor_calificacion`;
CREATE TABLE IF NOT EXISTS `valor_calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `esquema_calificacion_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_88D0227DF1613E4` (`esquema_calificacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=155 ;


ALTER TABLE `actividad`
  ADD CONSTRAINT `FK_8DF2BD0671B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_8DF2BD068924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_8DF2BD06B239FBC6` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`),
  ADD CONSTRAINT `FK_8DF2BD06B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

ALTER TABLE `actividad_archivo`
  ADD CONSTRAINT `FK_D780BE2946EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D780BE296014FACA` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`);

ALTER TABLE `alumno`
  ADD CONSTRAINT `FK_1435D52D71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_1435D52D86383B10` FOREIGN KEY (`avatar_id`) REFERENCES `avatar` (`id`),
  ADD CONSTRAINT `FK_1435D52DA1086757` FOREIGN KEY (`padre2_id`) REFERENCES `padre` (`id`),
  ADD CONSTRAINT `FK_1435D52DB3BDC8B9` FOREIGN KEY (`padre1_id`) REFERENCES `padre` (`id`),
  ADD CONSTRAINT `FK_1435D52DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_1435D52DE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`);

ALTER TABLE `alumno_asistencia`
  ADD CONSTRAINT `FK_D30A866457376F49` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`),
  ADD CONSTRAINT `FK_D30A86646D28D42D` FOREIGN KEY (`justificacion_id`) REFERENCES `justificacion` (`id`),
  ADD CONSTRAINT `FK_D30A8664FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`);

ALTER TABLE `alumno_grupo_alumno`
  ADD CONSTRAINT `FK_55DB706176E3EEE` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`),
  ADD CONSTRAINT `FK_55DB706FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`);

ALTER TABLE `alumno_materia`
  ADD CONSTRAINT `FK_43E74FC0B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `FK_43E74FC0FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`);

ALTER TABLE `archivo`
  ADD CONSTRAINT `FK_3529B4828924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `asistencia`
  ADD CONSTRAINT `FK_D8264A8D5D340050` FOREIGN KEY (`usuario_cargador_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_D8264A8DB54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

ALTER TABLE `bullying`
  ADD CONSTRAINT `FK_13D17F25FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`);

ALTER TABLE `calificacion`
  ADD CONSTRAINT `FK_8A3AF2182E892728` FOREIGN KEY (`valor`) REFERENCES `valor_calificacion` (`id`),
  ADD CONSTRAINT `FK_8A3AF2188924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_8A3AF218E715F406` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`),
  ADD CONSTRAINT `FK_8A3AF218FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`);

ALTER TABLE `ciudad`
  ADD CONSTRAINT `FK_8E86059E4E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`);

ALTER TABLE `convivencia`
  ADD CONSTRAINT `FK_F1A6B7B78924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_F1A6B7B7FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`);

ALTER TABLE `docente`
  ADD CONSTRAINT `FK_FD9FCFA471B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_FD9FCFA4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_FD9FCFA4E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`);

ALTER TABLE `docente_materia`
  ADD CONSTRAINT `FK_517E859794E27525` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  ADD CONSTRAINT `FK_517E8597B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

ALTER TABLE `especialidad`
  ADD CONSTRAINT `FK_ACB064F971B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`);

ALTER TABLE `establecimiento`
  ADD CONSTRAINT `FK_94A4D17EB239FBC6` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`),
  ADD CONSTRAINT `FK_94A4D17EDF1613E4` FOREIGN KEY (`esquema_calificacion_id`) REFERENCES `esquema_calificacion` (`id`),
  ADD CONSTRAINT `FK_94A4D17EE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`);

ALTER TABLE `evaluacion`
  ADD CONSTRAINT `FK_DEEDCA536014FACA` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`),
  ADD CONSTRAINT `FK_DEEDCA5394E27525` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  ADD CONSTRAINT `FK_DEEDCA539C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`),
  ADD CONSTRAINT `FK_DEEDCA53B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

ALTER TABLE `evaluacion_archivo`
  ADD CONSTRAINT `FK_6EBAA87B46EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6EBAA87BE715F406` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`);

ALTER TABLE `grupo_alumno`
  ADD CONSTRAINT `FK_18337A1471B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`);

ALTER TABLE `grupo_alumno_materia`
  ADD CONSTRAINT `FK_7B2FAA0D176E3EEE` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`),
  ADD CONSTRAINT `FK_7B2FAA0DB54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

ALTER TABLE `grupo_usuario`
  ADD CONSTRAINT `FK_7D6C3EFA71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_7D6C3EFA8924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `justificacion`
  ADD CONSTRAINT `FK_EBF13A8757376F49` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`),
  ADD CONSTRAINT `FK_EBF13A878924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `justificacion_archivo`
  ADD CONSTRAINT `FK_95461F5246EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_95461F526D28D42D` FOREIGN KEY (`justificacion_id`) REFERENCES `justificacion` (`id`);

ALTER TABLE `materia`
  ADD CONSTRAINT `FK_6DF0528424CBB9E3` FOREIGN KEY (`tipo_materia_id`) REFERENCES `tipo_materia` (`id`),
  ADD CONSTRAINT `FK_6DF0528471B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`);

ALTER TABLE `materia_archivo`
  ADD CONSTRAINT `FK_566A8CA446EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_566A8CA4B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

ALTER TABLE `materia_dia_horario`
  ADD CONSTRAINT `FK_BE9CEB52B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

ALTER TABLE `mensaje`
  ADD CONSTRAINT `FK_9B631D01DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `mensaje_archivo`
  ADD CONSTRAINT `FK_A374C39A46EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A374C39A4C54F362` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id`);

ALTER TABLE `mensaje_usuario`
  ADD CONSTRAINT `FK_B438C7454C54F362` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id`),
  ADD CONSTRAINT `FK_B438C745DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `nota_periodo`
  ADD CONSTRAINT `FK_AF5C517B94E27525` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  ADD CONSTRAINT `FK_AF5C517B9C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`),
  ADD CONSTRAINT `FK_AF5C517BA98F9F02` FOREIGN KEY (`nota_id`) REFERENCES `valor_calificacion` (`id`),
  ADD CONSTRAINT `FK_AF5C517BB54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `FK_AF5C517BFC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`);

ALTER TABLE `notificacion_usuario`
  ADD CONSTRAINT `FK_4FFB3E994D633FC4` FOREIGN KEY (`notificacion_id`) REFERENCES `notificacion` (`id`),
  ADD CONSTRAINT `FK_4FFB3E99DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `padre`
  ADD CONSTRAINT `FK_D3656AEB71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_D3656AEBDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_D3656AEBE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`);

ALTER TABLE `periodo`
  ADD CONSTRAINT `FK_7316C4ED71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`) ON DELETE CASCADE;

ALTER TABLE `provincia`
  ADD CONSTRAINT `FK_D39AF213C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`);

ALTER TABLE `reporte`
  ADD CONSTRAINT `fk_reporte_institucion` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reporte_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `token`
  ADD CONSTRAINT `FK_5F37A13BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05D4BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `FK_2265B05DB239FBC6` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`);

ALTER TABLE `usuario_actividad`
  ADD CONSTRAINT `FK_4C957146014FACA` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`),
  ADD CONSTRAINT `FK_4C95714DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `usuario_establecimiento`
  ADD CONSTRAINT `FK_7110F23F71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  ADD CONSTRAINT `FK_7110F23FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `usuario_grupo_usuario`
  ADD CONSTRAINT `FK_8BDF2024DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_8BDF2024DBD30545` FOREIGN KEY (`grupo_usuario_id`) REFERENCES `grupo_usuario` (`id`);

ALTER TABLE `valor_calificacion`
  ADD CONSTRAINT `FK_88D0227DF1613E4` FOREIGN KEY (`esquema_calificacion_id`) REFERENCES `esquema_calificacion` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
