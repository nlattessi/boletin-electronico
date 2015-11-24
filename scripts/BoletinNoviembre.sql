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
  `usuario_carga_id` int(11) DEFAULT NULL,
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
  KEY `FK_usuario` (`usuario_carga_id`),
  KEY `FK_archivo_id` (`archivo_id`),
  KEY `FK_institucion_id` (`institucion_id`),
  KEY `FK_establecimiento_id` (`establecimiento_id`),
  CONSTRAINT `FK_archivo_id` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`),
  CONSTRAINT `FK_establecimiento_id` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_institucion_id` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `direccion` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_pais` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_area` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `nacionalidad` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `padre1_id` int(11) DEFAULT NULL,
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
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `grupo_sanguineo` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuario_id` (`usuario_id`),
  KEY `FK_direccion_ciudad_id` (`ciudad_id`),
  KEY `FK_padre_1_id` (`padre1_id`),
  KEY `FK_padre_2_id` (`padre2_id`),
  KEY `FK_establecimiento_idx` (`establecimiento_id`),
  CONSTRAINT `FK_direccion_ciudad_id` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_establecimiento` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_padre_1_id` FOREIGN KEY (`padre1_id`) REFERENCES `padre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_padre_2_id` FOREIGN KEY (`padre2_id`) REFERENCES `padre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES (1,18,'FEDE','CASTA','33300316',NULL,'',NULL,'','','',NULL,NULL,1,2,'','','',NULL,NULL,0,'0000-00-00','0000-00-00',NULL,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(2,17,'GADI','CASTA','4234234',NULL,'',NULL,'','','',NULL,NULL,1,2,'','','',NULL,NULL,0,'0000-00-00','0000-00-00',NULL,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(3,19,'SEBI','CASTA','23423423',NULL,'',NULL,'','','',NULL,NULL,1,2,'','','',NULL,NULL,0,'0000-00-00','0000-00-00',NULL,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_asistencia`
--

DROP TABLE IF EXISTS `alumno_asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `justificacion_id` int(11) DEFAULT NULL,
  `asistencia_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `valor` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_D30A8664320260C0` (`alumno_id`),
  KEY `FK_D30A866455D9EBE2` (`justificacion_id`),
  KEY `FK_D30A86647DACCA5A` (`asistencia_id`),
  CONSTRAINT `FK_D30A8664320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `FK_D30A866455D9EBE2` FOREIGN KEY (`justificacion_id`) REFERENCES `justificacion` (`id`),
  CONSTRAINT `FK_D30A86647DACCA5A` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_asistencia`
--

LOCK TABLES `alumno_asistencia` WRITE;
/*!40000 ALTER TABLE `alumno_asistencia` DISABLE KEYS */;
INSERT INTO `alumno_asistencia` VALUES (1,NULL,2,1,'P',NULL,NULL),(2,NULL,3,1,'A',NULL,NULL),(3,NULL,4,1,'T',NULL,NULL),(4,NULL,5,2,'A',NULL,NULL),(5,NULL,6,3,'P','2015-11-19 14:30:57',NULL),(6,NULL,6,1,'T','2015-11-19 14:30:57',NULL),(7,NULL,6,2,'A','2015-11-19 14:30:57',NULL),(8,NULL,7,3,'A','2015-11-19 16:47:45',NULL),(9,NULL,7,1,'T','2015-11-19 16:47:45',NULL),(10,NULL,7,2,'P','2015-11-19 16:47:45',NULL),(11,NULL,8,3,'A','2015-11-19 16:48:17',NULL),(12,NULL,8,1,'T','2015-11-19 16:48:17',NULL),(13,NULL,8,2,'P','2015-11-19 16:48:17',NULL),(14,NULL,9,3,'A','2015-11-19 16:50:17',NULL),(15,NULL,9,1,'T','2015-11-19 16:50:17',NULL),(16,NULL,9,2,'P','2015-11-19 16:50:17',NULL),(17,NULL,10,3,'A','2015-11-19 16:51:00',NULL),(18,NULL,10,1,'T','2015-11-19 16:51:00',NULL),(19,NULL,10,2,'A','2015-11-19 16:51:00',NULL);
/*!40000 ALTER TABLE `alumno_asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_grupo_alumno`
--

DROP TABLE IF EXISTS `alumno_grupo_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_grupo_alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_alumno_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_55DB706320260C0` (`alumno_id`),
  KEY `FK_55DB706628BDAE3` (`grupo_alumno_id`),
  CONSTRAINT `FK_55DB706320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `FK_55DB706628BDAE3` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_grupo_alumno`
--

LOCK TABLES `alumno_grupo_alumno` WRITE;
/*!40000 ALTER TABLE `alumno_grupo_alumno` DISABLE KEYS */;
INSERT INTO `alumno_grupo_alumno` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL);
/*!40000 ALTER TABLE `alumno_grupo_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_materia`
--

DROP TABLE IF EXISTS `alumno_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_43E74FC0320260C0` (`alumno_id`),
  KEY `FK_43E74FC0B36DFBF4` (`materia_id`),
  CONSTRAINT `FK_43E74FC0320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `FK_43E74FC0B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_materia`
--

LOCK TABLES `alumno_materia` WRITE;
/*!40000 ALTER TABLE `alumno_materia` DISABLE KEYS */;
INSERT INTO `alumno_materia` VALUES (3,3,3,NULL,NULL);
/*!40000 ALTER TABLE `alumno_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archivo`
--

DROP TABLE IF EXISTS `archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `nombre_para_mostrar` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_archivo` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_3529B4827FA0C10D` (`usuario_carga_id`),
  CONSTRAINT `FK_3529B4827FA0C10D` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivo`
--

LOCK TABLES `archivo` WRITE;
/*!40000 ALTER TABLE `archivo` DISABLE KEYS */;
INSERT INTO `archivo` VALUES (1,2,'Resumen Matem','res.pdf','saraza','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,2,'Progrmaa Matematica','fert.pdf','archivo/zara','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_cargador_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_D8264A8DB36DFBF4` (`materia_id`),
  KEY `FK_D8264A8DE01E0B5D` (`usuario_cargador_id`),
  CONSTRAINT `FK_D8264A8DB36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_D8264A8DE01E0B5D` FOREIGN KEY (`usuario_cargador_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` VALUES (2,1,1,'2015-10-16','2015-10-16 17:18:24','0000-00-00 00:00:00'),(3,1,1,'2015-10-15','2015-10-16 17:18:56','0000-00-00 00:00:00'),(4,1,2,'2015-10-16','2015-10-16 17:19:42','0000-00-00 00:00:00'),(5,6,3,'2015-10-16','2015-10-16 17:19:42','0000-00-00 00:00:00'),(6,4,3,'2015-11-15','2015-11-19 14:30:57','2015-11-19 14:30:57'),(7,4,3,'2015-11-16','2015-11-19 16:47:45','2015-11-19 16:47:45'),(8,4,3,'2015-11-17','2015-11-19 16:48:17','2015-11-19 16:48:17'),(9,4,3,'2015-11-18','2015-11-19 16:50:17','2015-11-19 16:50:17'),(10,4,3,'2015-11-19','2015-11-19 16:51:00','2015-11-19 16:51:00');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `path` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avatar`
--

LOCK TABLES `avatar` WRITE;
/*!40000 ALTER TABLE `avatar` DISABLE KEYS */;
/*!40000 ALTER TABLE `avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificacion`
--

DROP TABLE IF EXISTS `calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `valor` int(11) DEFAULT '1',
  `comentario` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `validada` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_8A3AF218320260C0` (`alumno_id`),
  KEY `fk_calificacion_evaluacion` (`evaluacion_id`),
  KEY `fk_usuario_calificacion_idx` (`usuario_carga_id`),
  KEY `fk_calificacion_valor_idx` (`valor`),
  CONSTRAINT `FK_8A3AF218320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  CONSTRAINT `fk_calificacion_evaluacion` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_calificacion` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_valorPD_calificacion` FOREIGN KEY (`valor`) REFERENCES `valor_calificacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion`
--

LOCK TABLES `calificacion` WRITE;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
INSERT INTO `calificacion` VALUES (68,1,3,'2015-10-16 00:00:00',19,'343',4,'2015-11-15 17:46:17','2015-11-15 17:47:22',NULL),(69,1,1,'2015-10-16 00:00:00',1,'ggss3gg',4,'2015-11-15 17:46:17','2015-11-15 17:47:22',NULL),(70,1,2,'2015-10-16 00:00:00',3,'6777',4,'2015-11-15 17:46:17','2015-11-15 17:47:22',NULL),(71,2,3,'2015-10-17 00:00:00',3,'',4,'2015-11-15 20:07:48',NULL,NULL),(72,2,1,'2015-10-17 00:00:00',1,'',4,'2015-11-15 20:07:48',NULL,NULL),(73,2,2,'2015-10-17 00:00:00',1,'',4,'2015-11-15 20:07:48',NULL,NULL);
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_provincida_id` (`provincia_id`),
  CONSTRAINT `FK_provincida_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convivencia`
--

DROP TABLE IF EXISTS `convivencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convivencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descargo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_suceso` datetime NOT NULL,
  `validado` tinyint(1) DEFAULT NULL,
  `valor` tinyint(1) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_72D32A26320260C0` (`alumno_id`),
  KEY `FK_72D32A26230266D4` (`usuario_carga_id`),
  CONSTRAINT `FK_72D32A26230266D4` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_72D32A26320260C0` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convivencia`
--

LOCK TABLES `convivencia` WRITE;
/*!40000 ALTER TABLE `convivencia` DISABLE KEYS */;
INSERT INTO `convivencia` VALUES (1,4,1,'Estuvo muy bien',NULL,'2015-10-16 00:00:00',1,1,'0000-00-00 00:00:00',NULL),(2,NULL,1,'La pudrió groso',NULL,'2015-10-16 00:00:00',1,0,'0000-00-00 00:00:00',NULL),(3,NULL,1,'No aparece',NULL,'2015-10-16 00:00:00',0,NULL,'0000-00-00 00:00:00',NULL),(4,NULL,2,'otro alumno la pudrio',NULL,'2015-10-16 00:00:00',1,1,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `convivencia` ENABLE KEYS */;
UNLOCK TABLES;

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
  KEY `fk_ciudad_docente` (`ciudad_id`),
  CONSTRAINT `fk_ciudad_docente` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_FD9FCFA4FCF8192D` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente`
--

LOCK TABLES `docente` WRITE;
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` VALUES (1,4,'Ana María','DaCol','4546325',NULL,NULL,NULL,NULL,NULL,'','Maestra Normal',NULL,NULL,NULL,1,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente_materia`
--

DROP TABLE IF EXISTS `docente_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_517E8597230266D4` (`docente_id`),
  KEY `FK_517E8597B36DFBF4` (`materia_id`),
  CONSTRAINT `FK_517E8597230266D4` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  CONSTRAINT `FK_517E8597B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente_materia`
--

LOCK TABLES `docente_materia` WRITE;
/*!40000 ALTER TABLE `docente_materia` DISABLE KEYS */;
INSERT INTO `docente_materia` VALUES (1,2,1,NULL,NULL),(2,3,1,NULL,NULL);
/*!40000 ALTER TABLE `docente_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ACB064F971B61351` (`establecimiento_id`),
  CONSTRAINT `FK_ACB064F971B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad`
--

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `esquema_calificacion`
--

DROP TABLE IF EXISTS `esquema_calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esquema_calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `esquema_calificacion`
--

LOCK TABLES `esquema_calificacion` WRITE;
/*!40000 ALTER TABLE `esquema_calificacion` DISABLE KEYS */;
INSERT INTO `esquema_calificacion` VALUES (1,'General'),(2,'1 a 100'),(3,'F a A'),(4,'I a S'),(5,'Insuficiente a Sobresaliente'),(6,'1 a 10');
/*!40000 ALTER TABLE `esquema_calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institucion_id` int(11) DEFAULT NULL,
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
  `esquema_calificacion_id` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_94A4D17EEF433A34` (`institucion_id`),
  KEY `fk_ciudad_establecimiento` (`ciudad_id`),
  KEY `fk_establecimiento_esquema_idx` (`esquema_calificacion_id`),
  CONSTRAINT `FK_94A4D17EEF433A34` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`),
  CONSTRAINT `fk_ciudad_establecimiento` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_establecimiento_esquema` FOREIGN KEY (`esquema_calificacion_id`) REFERENCES `esquema_calificacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` VALUES (1,1,'America',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,30,4,4,NULL,NULL);
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
  `materia_id` int(11) DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `actividad_id` int(11) DEFAULT NULL,
  `calificada` tinyint(1) DEFAULT '0',
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_514C8FEC230266D4` (`docente_id`),
  KEY `FK_514C8FECB36DFBF4` (`materia_id`),
  KEY `FK_514C8FECDC70121` (`actividad_id`),
  CONSTRAINT `FK_514C8FEC230266D4` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  CONSTRAINT `FK_514C8FECB36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_514C8FECDC70121` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` VALUES (1,'Parcial','2015-10-16 00:00:00',3,1,NULL,1,NULL,NULL),(2,'Recuperatorio','2015-10-17 00:00:00',3,1,NULL,1,NULL,NULL),(3,'TST -integrak','2015-11-15 17:52:21',3,1,NULL,0,NULL,NULL),(4,'teset integrl','2015-11-15 19:23:07',3,1,NULL,0,NULL,NULL),(5,'Test finañ','2015-11-15 19:25:17',3,1,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion_archivo`
--

DROP TABLE IF EXISTS `evaluacion_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) DEFAULT NULL,
  `archivo_id` int(11) DEFAULT NULL,
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
-- Dumping data for table `evaluacion_archivo`
--

LOCK TABLES `evaluacion_archivo` WRITE;
/*!40000 ALTER TABLE `evaluacion_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluacion_archivo` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_alumno`
--

LOCK TABLES `grupo_alumno` WRITE;
/*!40000 ALTER TABLE `grupo_alumno` DISABLE KEYS */;
INSERT INTO `grupo_alumno` VALUES (1,'4b',1,NULL,NULL),(2,'5a',0,NULL,NULL),(3,'mujeres 4to c',0,NULL,NULL);
/*!40000 ALTER TABLE `grupo_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_alumno_materia`
--

DROP TABLE IF EXISTS `grupo_alumno_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_alumno_materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `grupo_alumno_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_7B2FAA0D3BF20F66` (`grupo_alumno_id`),
  KEY `FK_7B2FAA0DB36DFBF4` (`materia_id`),
  CONSTRAINT `FK_7B2FAA0D3BF20F66` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`),
  CONSTRAINT `FK_7B2FAA0DB36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_alumno_materia`
--

LOCK TABLES `grupo_alumno_materia` WRITE;
/*!40000 ALTER TABLE `grupo_alumno_materia` DISABLE KEYS */;
INSERT INTO `grupo_alumno_materia` VALUES (1,3,1,NULL,NULL),(2,3,2,NULL,NULL),(3,2,3,NULL,NULL);
/*!40000 ALTER TABLE `grupo_alumno_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_usuario`
--

DROP TABLE IF EXISTS `grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` int(11) DEFAULT NULL,
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
-- Dumping data for table `grupo_usuario`
--

LOCK TABLES `grupo_usuario` WRITE;
/*!40000 ALTER TABLE `grupo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institucion`
--

LOCK TABLES `institucion` WRITE;
/*!40000 ALTER TABLE `institucion` DISABLE KEYS */;
INSERT INTO `institucion` VALUES (1,'America',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `institucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `justificacion`
--

DROP TABLE IF EXISTS `justificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `justificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `archivo_id` int(11) DEFAULT NULL,
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
-- Dumping data for table `justificacion`
--

LOCK TABLES `justificacion` WRITE;
/*!40000 ALTER TABLE `justificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `justificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_materia_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_6DF052845DC80656` (`tipo_materia_id`),
  KEY `IDX_6DF0528471B61351` (`establecimiento_id`),
  CONSTRAINT `FK_6DF052845DC80656` FOREIGN KEY (`tipo_materia_id`) REFERENCES `tipo_materia` (`id`),
  CONSTRAINT `FK_6DF0528471B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,'Matematica 3ro B',1,NULL,NULL,NULL),(2,'Matematica 4A',1,NULL,NULL,NULL),(3,'Lengua 7 rojo',2,NULL,NULL,NULL),(4,'Sociales 7mo rojo nombre largo',3,NULL,NULL,NULL);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_archivo`
--

DROP TABLE IF EXISTS `materia_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `archivo_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_566A8CA4B36DFBF4` (`materia_id`),
  KEY `FK_566A8CA4EBB41DF2` (`archivo_id`),
  CONSTRAINT `FK_566A8CA4B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_566A8CA4EBB41DF2` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_archivo`
--

LOCK TABLES `materia_archivo` WRITE;
/*!40000 ALTER TABLE `materia_archivo` DISABLE KEYS */;
INSERT INTO `materia_archivo` VALUES (1,3,1,NULL,NULL),(2,3,2,NULL,NULL);
/*!40000 ALTER TABLE `materia_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_dia_horario`
--

DROP TABLE IF EXISTS `materia_dia_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_dia_horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) DEFAULT NULL,
  `dia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hora_inicio` int(11) NOT NULL,
  `hora_fin` int(11) NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_BE9CEB52B36DFBF4` (`materia_id`),
  CONSTRAINT `FK_BE9CEB52B36DFBF4` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_dia_horario`
--

LOCK TABLES `materia_dia_horario` WRITE;
/*!40000 ALTER TABLE `materia_dia_horario` DISABLE KEYS */;
INSERT INTO `materia_dia_horario` VALUES (1,2,'Lunes',1,3,NULL,NULL),(2,2,'Miercoles',4,6,NULL,NULL),(3,3,'Lunes',1,2,NULL,NULL),(4,3,'Miércoles',3,12,NULL,NULL),(5,3,'Sábado',2,3,NULL,NULL);
/*!40000 ALTER TABLE `materia_dia_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_envio` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_9B631D0165089FEB` (`usuario_id`),
  CONSTRAINT `FK_9B631D0165089FEB` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` VALUES (4,4,'concha e tu ma','asdasdasdasdasdasdasd','2015-11-10 20:09:13'),(5,18,'RE: concha e tu ma','sasacasc','2015-11-10 20:09:58'),(6,4,'asfas','fasfasfasfaf','2015-11-10 20:12:04');
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje_usuario`
--

DROP TABLE IF EXISTS `mensaje_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `leido` tinyint(1) DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sfsdfsdfsdf_idx` (`mensaje_id`),
  KEY `fk_qwqwqwqqw_idx` (`usuario_id`),
  CONSTRAINT `fk_qwqwqwqqw` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sfsdfsdfsdf` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_usuario`
--

LOCK TABLES `mensaje_usuario` WRITE;
/*!40000 ALTER TABLE `mensaje_usuario` DISABLE KEYS */;
INSERT INTO `mensaje_usuario` VALUES (4,4,18,1,1,'2015-11-10 20:09:13','2015-11-10 20:10:56'),(5,5,4,1,0,'2015-11-10 20:09:58','2015-11-10 20:11:35'),(6,6,4,1,0,'2015-11-10 20:12:04','2015-11-11 03:38:47');
/*!40000 ALTER TABLE `mensaje_usuario` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacion_usuario`
--

DROP TABLE IF EXISTS `notificacion_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificacion_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
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
-- Dumping data for table `notificacion_usuario`
--

LOCK TABLES `notificacion_usuario` WRITE;
/*!40000 ALTER TABLE `notificacion_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacion_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `padre`
--

DROP TABLE IF EXISTS `padre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `padre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
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
  KEY `FK_usuario_padre` (`usuario_id`),
  KEY `fk_ciudad_padre` (`ciudad_id`),
  CONSTRAINT `fk_ciudad_padre` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_padre` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `padre`
--

LOCK TABLES `padre` WRITE;
/*!40000 ALTER TABLE `padre` DISABLE KEYS */;
INSERT INTO `padre` VALUES (1,20,'DIEGO','CASTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,21,'MARCEA','CHIAPPE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `padre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `pais_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pais_provincia_idx` (`pais_id`),
  CONSTRAINT `fk_pais_provincia` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'ROLE_ADMIN','Administrador del sistema',NULL,NULL),(2,'ROLE_PADRE','Representa a los padres de los alumnos. Hasta 2 por alumno',NULL,NULL),(3,'ROLE_ALUMNO','Uno por alumno',NULL,NULL),(4,'ROLE_DOCENTE','Uno por cada docente. Puede calificar.',NULL,NULL),(5,'ROLE_DIRECTIVO','Rol administrativo para las instituciones y establecimientos',NULL,NULL),(6,'ROLE_BEDEL','Puede tomar asistencia y accines disciplianrias, no puede calificar',NULL,NULL);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_materia`
--

LOCK TABLES `tipo_materia` WRITE;
/*!40000 ALTER TABLE `tipo_materia` DISABLE KEYS */;
INSERT INTO `tipo_materia` VALUES (1,'Matematica',NULL,NULL),(2,'lengua',NULL,NULL),(3,'sociales',NULL,NULL);
/*!40000 ALTER TABLE `tipo_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `token` varchar(45) NOT NULL,
  `expiration_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_token_idx` (`usuario_id`),
  CONSTRAINT `fk_usuario_token` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

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
  `rol_id` int(11) DEFAULT NULL,
  `id_entidad_asociada` int(11) DEFAULT NULL,
  `email` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `apellido` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_2265B05D90F1D76D` (`rol_id`),
  KEY `IDX_2265B05DB239FBC6` (`institucion_id`),
  CONSTRAINT `FK_2265B05D90F1D76D` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  CONSTRAINT `FK_2265B05DB239FBC6` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin',1,NULL,'admin@admin.com',NULL,NULL,1,''),(2,'speacecraft','1',2,1,'padre@padre.con',NULL,NULL,1,''),(3,'juancarlos','juancarlos',3,1,'alumno@alumno.com',NULL,NULL,1,'juanca'),(4,'anadacol','anadacol',4,1,'docente@docente.com',NULL,NULL,1,'anada'),(5,'dorita','dorita',5,NULL,'director@director.com',NULL,NULL,1,''),(6,'maryrose','maryrose',6,NULL,'bedel@bedel.com',NULL,NULL,1,''),(17,'GADI','1',3,2,NULL,NULL,NULL,1,'CASTA'),(18,'FEDE','1',3,1,NULL,NULL,NULL,1,'CASTA'),(19,'SEBI','1',3,3,NULL,NULL,NULL,1,'CASTA'),(20,'DIEGO','1',2,NULL,NULL,NULL,NULL,1,'CASTA'),(21,'MARCELA','1',2,NULL,NULL,NULL,NULL,1,'CASTA');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_actividad`
--

DROP TABLE IF EXISTS `usuario_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_actividad` (
  `usuario_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`actividad_id`),
  KEY `IDX_4C95714DB38439E` (`usuario_id`),
  KEY `IDX_4C957146014FACA` (`actividad_id`),
  CONSTRAINT `FK_4C957146014FACA` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`),
  CONSTRAINT `FK_4C95714DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_actividad`
--

LOCK TABLES `usuario_actividad` WRITE;
/*!40000 ALTER TABLE `usuario_actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_establecimiento`
--

DROP TABLE IF EXISTS `usuario_establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_7110F23F7DFA12F6` (`establecimiento_id`),
  KEY `FK_7110F23FFCF8192D` (`usuario_id`),
  CONSTRAINT `FK_7110F23F7DFA12F6` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_7110F23FFCF8192D` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_establecimiento`
--

LOCK TABLES `usuario_establecimiento` WRITE;
/*!40000 ALTER TABLE `usuario_establecimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_grupo_usuario`
--

DROP TABLE IF EXISTS `usuario_grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_grupo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `grupo_usuario_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8BDF2024FCF8192D` (`usuario_id`),
  KEY `IDX_8BDF2024C344EF9F` (`grupo_usuario_id`),
  CONSTRAINT `FK_8BDF2024C344EF9F` FOREIGN KEY (`grupo_usuario_id`) REFERENCES `grupo_usuario` (`id`),
  CONSTRAINT `FK_8BDF2024FCF8192D` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_grupo_usuario`
--

LOCK TABLES `usuario_grupo_usuario` WRITE;
/*!40000 ALTER TABLE `usuario_grupo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_grupo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valor_calificacion`
--

DROP TABLE IF EXISTS `valor_calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valor_calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `esquema_calificacion_id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_esquema_valor_idx` (`esquema_calificacion_id`),
  CONSTRAINT `fk_esquema_valor` FOREIGN KEY (`esquema_calificacion_id`) REFERENCES `esquema_calificacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valor_calificacion`
--

LOCK TABLES `valor_calificacion` WRITE;
/*!40000 ALTER TABLE `valor_calificacion` DISABLE KEYS */;
INSERT INTO `valor_calificacion` VALUES (1,1,'No Evaluado',0),(2,1,'Ausente',2),(3,4,'B',3),(4,4,'MB',4),(5,4,'S',5),(8,6,'1',1),(9,6,'2',2),(10,6,'3',3),(11,6,'4',4),(12,6,'5',5),(13,6,'6',6),(14,6,'7',7),(15,6,'8',8),(16,6,'9',9),(17,6,'10',10),(19,4,'I',1),(20,4,'R',2);
/*!40000 ALTER TABLE `valor_calificacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-23 15:31:26
