DROP SCHEMA IF EXISTS `boletines` ;
CREATE DATABASE  IF NOT EXISTS `boletines` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `boletines`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: boletines
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) NOT NULL,
  `archivo_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_usuario` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_archivo_id` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`),
  CONSTRAINT `FK_institucion_id` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_establecimiento_id` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `direccion` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_pais` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_area` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `nacionalidad` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `padre1_id` int(11) NOT NULL,
  `padre2_id` int(11) DEFAULT NULL,
  `obra_social` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `obra_social_numero_afiliado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_emergencia` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apodo` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_id` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci,
  `establecimiento_id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `grupo_sanguineo` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_direccion_ciudad_id` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_padre_1_id` FOREIGN KEY (`padre1_id`) REFERENCES `padre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_padre_2_id` FOREIGN KEY (`padre2_id`) REFERENCES `padre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumno_asistencia`
--

DROP TABLE IF EXISTS `alumno_asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `justificacion_id` int(11) DEFAULT NULL,
  `asistencia_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `valor` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_D30A8664320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `FK_D30A866455D9EBE2` FOREIGN KEY (`justificacion_id`) REFERENCES `justificacion` (`id`),
  CONSTRAINT `FK_D30A86647DACCA5A` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumno_grupo_alumno`
--

DROP TABLE IF EXISTS `alumno_grupo_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_grupo_alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_alumno_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_55DB706320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `FK_55DB706628BDAE3` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumno_materia`
--

DROP TABLE IF EXISTS `alumno_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_43E74FC0320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `FK_43E74FC0B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `archivo`
--

DROP TABLE IF EXISTS `archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) NOT NULL,
  `nombre_para_mostrar` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_archivo` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_3529B4827FA0C10D` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_cargador_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_D8264A8DB36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_D8264A8DE01E0B5D` FOREIGN KEY (`usuario_cargador_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `path` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `calificacion`
--

DROP TABLE IF EXISTS `calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `valor` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validada` tinyint(1) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_carga_id` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_8A3AF218320260C0` (`alumno_id`),
  KEY `fk_calificacion_evaluacion` (`evaluacion_id`),
  KEY `fk_usuario_calificacion_idx` (`usuario_carga_id`),
  CONSTRAINT `FK_8A3AF218320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `fk_calificacion_evaluacion` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_calificacion` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_provincida_id` (`provincia_id`),
  CONSTRAINT `FK_provincida_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `convivencia`
--

DROP TABLE IF EXISTS `convivencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convivencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descargo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_suceso` datetime NOT NULL,
  `validado` tinyint(1) DEFAULT NULL,
  `valor` tinyint(1) DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_72D32A26320260C0` (`alumno_id`),
  KEY `FK_72D32A26230266D4` (`usuario_carga_id`),
  CONSTRAINT `FK_72D32A26230266D4` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_72D32A26320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `docente`
--

DROP TABLE IF EXISTS `docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
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
  `establecimiento_id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_FD9FCFA4FCF8192D` (`usuario_id`),
  CONSTRAINT `FK_FD9FCFA4FCF8192D` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `fk_ciudad_docente` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `docente_materia`
--

DROP TABLE IF EXISTS `docente_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_517E8597230266D4` (`docente_id`),
  KEY `FK_517E8597B36DFBF4` (`materia_id`),
  CONSTRAINT `FK_517E8597230266D4` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  CONSTRAINT `FK_517E8597B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institucion_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `fecha_inauguracion` date DEFAULT NULL,
  `codigo_pais` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_area` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maximo_faltas` int(2) NOT NULL,
  `tardes_faltas` int(1) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_94A4D17EEF433A34` (`institucion_id`),
  CONSTRAINT `FK_94A4D17EEF433A34` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`),
  CONSTRAINT `fk_ciudad_establecimiento` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `materia_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_514C8FEC230266D4` (`docente_id`),
  KEY `FK_514C8FECB36DFBF4` (`materia_id`),
  KEY `FK_514C8FECDC70121` (`actividad_id`),
  CONSTRAINT `FK_514C8FEC230266D4` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  CONSTRAINT `FK_514C8FECB36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_514C8FECDC70121` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evaluacion_archivo`
--

DROP TABLE IF EXISTS `evaluacion_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) NOT NULL,
  `archivo_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_96A9D3A6EBB41DF2` (`archivo_id`),
  KEY `FK_96A9D3A6777B3A01` (`evaluacion_id`),
  CONSTRAINT `FK_96A9D3A6777B3A01` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`),
  CONSTRAINT `FK_96A9D3A6EBB41DF2` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grupo_alumno`
--

DROP TABLE IF EXISTS `grupo_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_curso` tinyint(1) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grupo_alumno_materia`
--

DROP TABLE IF EXISTS `grupo_alumno_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_alumno_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) NOT NULL,
  `grupo_alumno_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_7B2FAA0D3BF20F66` (`grupo_alumno_id`),
  KEY `FK_7B2FAA0DB36DFBF4` (`materia_id`),
  CONSTRAINT `FK_7B2FAA0D3BF20F66` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`),
  CONSTRAINT `FK_7B2FAA0DB36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grupo_usuario`
--

DROP TABLE IF EXISTS `grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_privado` tinyint(1) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_7D6C3EFA7FA0C10D` (`usuario_carga_id`),
  CONSTRAINT `FK_7D6C3EFA7FA0C10D` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `institucion`
--

DROP TABLE IF EXISTS `institucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuit` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `justificacion`
--

DROP TABLE IF EXISTS `justificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `justificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_carga_id` int(11) NOT NULL,
  `archivo_id` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_EBF13A877FA0C10D` (`usuario_carga_id`),
  KEY `FK_EBF13A87EBB41DF2` (`archivo_id`),
  CONSTRAINT `FK_EBF13A877FA0C10D` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_EBF13A87EBB41DF2` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_materia_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_6DF052845DC80656` (`tipo_materia_id`),
  CONSTRAINT `FK_6DF052845DC80656` FOREIGN KEY (`tipo_materia_id`) REFERENCES `tipo_materia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `materia_archivo`
--

DROP TABLE IF EXISTS `materia_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) NOT NULL,
  `archivo_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_566A8CA4B36DFBF4` (`materia_id`),
  KEY `FK_566A8CA4EBB41DF2` (`archivo_id`),
  CONSTRAINT `FK_566A8CA4B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_566A8CA4EBB41DF2` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `materia_dia_horario`
--

DROP TABLE IF EXISTS `materia_dia_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_dia_horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) NOT NULL,
  `dia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hora_inicio` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_BE9CEB52B36DFBF4` (`materia_id`),
  CONSTRAINT `FK_BE9CEB52B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_envio` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_9B631D0165089FEB` (`usuario_id`),
  CONSTRAINT `FK_9B631D0165089FEB` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mensaje_usuario`
--

DROP TABLE IF EXISTS `mensaje_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `leido` tinyint(1) DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sfsdfsdfsdf_idx` (`mensaje_id`),
  KEY `fk_qwqwqwqqw_idx` (`usuario_id`),
  CONSTRAINT `fk_qwqwqwqqw` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sfsdfsdfsdf` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notificacion_usuario`
--

DROP TABLE IF EXISTS `notificacion_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificacion_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `notificado` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_not_usuario_idx` (`notificacion_id`),
  KEY `fk_usuario_not_idx` (`usuario_id`),
  CONSTRAINT `fk_not_usuario` FOREIGN KEY (`notificacion_id`) REFERENCES `notificacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_not` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `padre`
--

DROP TABLE IF EXISTS `padre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `padre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
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
  `establecimiento_id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_usuario_padre` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `fk_ciudad_padre` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pais_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pais_provincia_idx` (`pais_id`),
  CONSTRAINT `fk_pais_provincia` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tipo_materia`
--

DROP TABLE IF EXISTS `tipo_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(45) NOT NULL,
  `expiration_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_token_idx` (`usuario_id`),
  CONSTRAINT `fk_usuario_token` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rol_id` int(11) NOT NULL,
  `id_entidad_asociada` int(11) DEFAULT NULL,
  `email` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_2265B05D90F1D76D` (`rol_id`),
  CONSTRAINT `FK_2265B05D90F1D76D` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `usuario_establecimiento`
--

DROP TABLE IF EXISTS `usuario_establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_7110F23F7DFA12F6` (`establecimiento_id`),
  KEY `FK_7110F23FFCF8192D` (`usuario_id`),
  CONSTRAINT `FK_7110F23F7DFA12F6` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_7110F23FFCF8192D` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario_grupo_usuario`
--

DROP TABLE IF EXISTS `usuario_grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_grupo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `grupo_usuario_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8BDF2024FCF8192D` (`usuario_id`),
  KEY `IDX_8BDF2024C344EF9F` (`grupo_usuario_id`),
  CONSTRAINT `FK_8BDF2024C344EF9F` FOREIGN KEY (`grupo_usuario_id`) REFERENCES `grupo_usuario` (`id`),
  CONSTRAINT `FK_8BDF2024FCF8192D` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

ALTER TABLE asistencia CHANGE materia_id materia_id INT DEFAULT NULL, CHANGE usuario_cargador_id usuario_cargador_id INT DEFAULT NULL;
ALTER TABLE usuario_grupo_usuario CHANGE grupo_usuario_id grupo_usuario_id INT DEFAULT NULL, CHANGE usuario_id usuario_id INT DEFAULT NULL;
ALTER TABLE provincia CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE pais_id pais_id INT DEFAULT NULL;
ALTER TABLE actividad CHANGE usuario_carga_id usuario_carga_id INT DEFAULT NULL;
ALTER TABLE token CHANGE usuario_id usuario_id INT DEFAULT NULL;
ALTER TABLE justificacion CHANGE usuario_carga_id usuario_carga_id INT DEFAULT NULL, CHANGE archivo_id archivo_id INT DEFAULT NULL;
ALTER TABLE alumno CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE ciudad_id ciudad_id INT DEFAULT NULL, CHANGE padre1_id padre1_id INT DEFAULT NULL, CHANGE sexo sexo VARCHAR(1) DEFAULT NULL;
ALTER TABLE materia_archivo CHANGE materia_id materia_id INT DEFAULT NULL, CHANGE archivo_id archivo_id INT DEFAULT NULL;
ALTER TABLE pais CHANGE id id INT AUTO_INCREMENT NOT NULL;
ALTER TABLE evaluacion CHANGE docente_id docente_id INT DEFAULT NULL, CHANGE materia_id materia_id INT DEFAULT NULL, CHANGE actividad_id actividad_id INT DEFAULT NULL;
ALTER TABLE notificacion_usuario CHANGE notificacion_id notificacion_id INT DEFAULT NULL, CHANGE usuario_id usuario_id INT DEFAULT NULL;
ALTER TABLE avatar CHANGE id id INT AUTO_INCREMENT NOT NULL;
ALTER TABLE alumno_grupo_alumno CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE grupo_alumno_id grupo_alumno_id INT DEFAULT NULL;
ALTER TABLE calificacion CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE evaluacion_id evaluacion_id INT DEFAULT NULL, CHANGE usuario_carga_id usuario_carga_id INT DEFAULT NULL;
ALTER TABLE ciudad CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE provincia_id provincia_id INT DEFAULT NULL;
ALTER TABLE evaluacion_archivo CHANGE evaluacion_id evaluacion_id INT DEFAULT NULL, CHANGE archivo_id archivo_id INT DEFAULT NULL;
ALTER TABLE mensaje_usuario CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE mensaje_id mensaje_id INT DEFAULT NULL;
ALTER TABLE grupo_usuario CHANGE usuario_carga_id usuario_carga_id INT DEFAULT NULL;
ALTER TABLE especialidad CHANGE id id INT AUTO_INCREMENT NOT NULL;
ALTER TABLE grupo_alumno_materia CHANGE grupo_alumno_id grupo_alumno_id INT DEFAULT NULL, CHANGE materia_id materia_id INT DEFAULT NULL;
ALTER TABLE usuario_establecimiento CHANGE establecimiento_id establecimiento_id INT DEFAULT NULL, CHANGE usuario_id usuario_id INT DEFAULT NULL;
ALTER TABLE establecimiento CHANGE institucion_id institucion_id INT DEFAULT NULL;
ALTER TABLE padre CHANGE usuario_id usuario_id INT DEFAULT NULL;
ALTER TABLE alumno_materia CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE materia_id materia_id INT DEFAULT NULL;
ALTER TABLE usuario ADD institucion_id INT DEFAULT NULL, CHANGE rol_id rol_id INT DEFAULT NULL;
ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DB239FBC6 FOREIGN KEY (institucion_id) REFERENCES institucion (id);
CREATE INDEX IDX_2265B05DB239FBC6 ON usuario (institucion_id);
ALTER TABLE convivencia CHANGE usuario_carga_id usuario_carga_id INT DEFAULT NULL, CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE valor valor TINYINT(1) DEFAULT NULL;
ALTER TABLE archivo CHANGE usuario_carga_id usuario_carga_id INT DEFAULT NULL;
ALTER TABLE materia_dia_horario CHANGE materia_id materia_id INT DEFAULT NULL;
ALTER TABLE materia CHANGE tipo_materia_id tipo_materia_id INT DEFAULT NULL;
ALTER TABLE docente_materia CHANGE docente_id docente_id INT DEFAULT NULL, CHANGE materia_id materia_id INT DEFAULT NULL;
ALTER TABLE alumno_asistencia CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE asistencia_id asistencia_id INT DEFAULT NULL;
ALTER TABLE mensaje CHANGE usuario_id usuario_id INT DEFAULT NULL;

CREATE TABLE usuario_actividad (usuario_id INT NOT NULL, actividad_id INT NOT NULL, INDEX IDX_4C95714DB38439E (usuario_id), INDEX IDX_4C957146014FACA (actividad_id), PRIMARY KEY(usuario_id, actividad_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE usuario_actividad ADD CONSTRAINT FK_4C95714DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id);
ALTER TABLE usuario_actividad ADD CONSTRAINT FK_4C957146014FACA FOREIGN KEY (actividad_id) REFERENCES actividad (id);

ALTER TABLE especialidad ADD establecimiento_id INT DEFAULT NULL;
ALTER TABLE especialidad ADD CONSTRAINT FK_ACB064F971B61351 FOREIGN KEY (establecimiento_id) REFERENCES establecimiento (id);
ALTER TABLE usuario ADD apellido VARCHAR(45) NOT NULL;
CREATE INDEX IDX_ACB064F971B61351 ON especialidad (establecimiento_id);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-11 17:36:12
