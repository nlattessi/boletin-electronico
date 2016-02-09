-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: boletines
-- ------------------------------------------------------
-- Server version	5.7.10

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
  `establecimiento_id` int(11) DEFAULT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DF2BD0671B61351` (`establecimiento_id`),
  KEY `IDX_8DF2BD06B239FBC6` (`institucion_id`),
  KEY `IDX_8DF2BD068924462A` (`usuario_carga_id`),
  KEY `IDX_8DF2BD06B54DBBCB` (`materia_id`),
  CONSTRAINT `FK_8DF2BD0671B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_8DF2BD068924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_8DF2BD06B239FBC6` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`),
  CONSTRAINT `FK_8DF2BD06B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` VALUES (1,NULL,NULL,4,11,'Evaluacion1','Actividad automatica de evaluacion','2016-02-03 09:00:00','2016-02-03 11:00:00','2016-02-04 19:06:38','2016-02-04 19:06:38'),(2,NULL,NULL,4,11,'Eval2','Actividad automatica de evaluacion','2016-02-05 09:00:00','2016-02-05 11:00:00','2016-02-04 19:11:04','2016-02-04 19:11:04'),(3,NULL,NULL,4,11,'Eval3','Actividad automatica de evaluacion','2016-02-06 09:00:00','2016-02-06 11:00:00','2016-02-04 19:11:21','2016-02-04 19:11:21'),(4,NULL,NULL,4,11,'Evaluacion1b','Actividad automatica de evaluacion','2016-02-05 09:00:00','2016-02-05 11:00:00','2016-02-04 19:25:56','2016-02-04 19:25:56'),(5,NULL,NULL,4,11,'Evaluacion2b','Actividad automatica de evaluacion','2016-03-10 09:00:00','2016-03-10 11:00:00','2016-02-04 19:26:16','2016-02-04 19:26:16'),(6,NULL,NULL,4,11,'Evaluacion3b','Actividad automatica de evaluacion','2016-03-15 09:00:00','2016-03-15 11:00:00','2016-02-04 19:26:25','2016-02-04 19:26:25');
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actividad_archivo`
--

DROP TABLE IF EXISTS `actividad_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividad_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `actividad_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D780BE2946EBF93B` (`archivo_id`),
  KEY `IDX_D780BE296014FACA` (`actividad_id`),
  CONSTRAINT `FK_D780BE2946EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D780BE296014FACA` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad_archivo`
--

LOCK TABLES `actividad_archivo` WRITE;
/*!40000 ALTER TABLE `actividad_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `padre2_id` int(11) DEFAULT NULL,
  `padre1_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `avatar_id` int(11) DEFAULT NULL,
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
  KEY `IDX_1435D52D86383B10` (`avatar_id`),
  CONSTRAINT `FK_1435D52D71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_1435D52D86383B10` FOREIGN KEY (`avatar_id`) REFERENCES `avatar` (`id`),
  CONSTRAINT `FK_1435D52DA1086757` FOREIGN KEY (`padre2_id`) REFERENCES `padre` (`id`),
  CONSTRAINT `FK_1435D52DB3BDC8B9` FOREIGN KEY (`padre1_id`) REFERENCES `padre` (`id`),
  CONSTRAINT `FK_1435D52DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_1435D52DE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES (1,2,1,1,NULL,18,NULL,'FEDE','CASTA','33300316','',NULL,'','','',NULL,NULL,'','','',NULL,NULL,'0000-00-00','0000-00-00',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(2,2,1,1,NULL,17,NULL,'GADI','CASTA','4234234','',NULL,'','','',NULL,NULL,'','','',NULL,NULL,'0000-00-00','0000-00-00',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(3,2,1,1,NULL,19,NULL,'SEBI','CASTA','23423423','',NULL,'','','',NULL,NULL,'','','',NULL,NULL,'0000-00-00','0000-00-00',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(4,2,1,1,NULL,22,NULL,'Nahuel','Lattessi','33300581',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-02-03 17:59:38',NULL,NULL),(5,2,1,1,NULL,23,NULL,'Nazareno','Lattessi','1231231',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-02-03 17:59:47',NULL,NULL),(6,2,1,1,NULL,24,NULL,'Melina','Sabuncuyan','33737768',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-02-03 17:59:58',NULL,NULL);
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
  `asistencia_id` int(11) DEFAULT NULL,
  `justificacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `valor` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D30A866457376F49` (`asistencia_id`),
  KEY `IDX_D30A86646D28D42D` (`justificacion_id`),
  KEY `IDX_D30A8664FC28E5EE` (`alumno_id`),
  CONSTRAINT `FK_D30A866457376F49` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`),
  CONSTRAINT `FK_D30A86646D28D42D` FOREIGN KEY (`justificacion_id`) REFERENCES `justificacion` (`id`),
  CONSTRAINT `FK_D30A8664FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_asistencia`
--

LOCK TABLES `alumno_asistencia` WRITE;
/*!40000 ALTER TABLE `alumno_asistencia` DISABLE KEYS */;
INSERT INTO `alumno_asistencia` VALUES (1,2,NULL,1,'P',NULL,NULL),(2,3,NULL,1,'A',NULL,NULL),(3,4,NULL,1,'T',NULL,NULL),(4,5,NULL,2,'A',NULL,NULL),(5,6,NULL,3,'P','2015-11-19 14:30:57',NULL),(6,6,NULL,1,'T','2015-11-19 14:30:57',NULL),(7,6,NULL,2,'A','2015-11-19 14:30:57',NULL),(8,7,NULL,3,'A','2015-11-19 16:47:45',NULL),(9,7,NULL,1,'T','2015-11-19 16:47:45',NULL),(10,7,NULL,2,'P','2015-11-19 16:47:45',NULL),(11,8,NULL,3,'A','2015-11-19 16:48:17',NULL),(12,8,NULL,1,'T','2015-11-19 16:48:17',NULL),(13,8,NULL,2,'P','2015-11-19 16:48:17',NULL),(14,9,NULL,3,'A','2015-11-19 16:50:17',NULL),(15,9,NULL,1,'T','2015-11-19 16:50:17',NULL),(16,9,NULL,2,'P','2015-11-19 16:50:17',NULL),(17,10,NULL,3,'A','2015-11-19 16:51:00',NULL),(18,10,NULL,1,'T','2015-11-19 16:51:00',NULL),(19,10,NULL,2,'A','2015-11-19 16:51:00',NULL);
/*!40000 ALTER TABLE `alumno_asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_grupo_alumno`
--

DROP TABLE IF EXISTS `alumno_grupo_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_grupo_alumno` (
  `grupo_alumno_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  PRIMARY KEY (`grupo_alumno_id`,`alumno_id`),
  KEY `IDX_55DB706176E3EEE` (`grupo_alumno_id`),
  KEY `IDX_55DB706FC28E5EE` (`alumno_id`),
  CONSTRAINT `FK_55DB706176E3EEE` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`),
  CONSTRAINT `FK_55DB706FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_grupo_alumno`
--

LOCK TABLES `alumno_grupo_alumno` WRITE;
/*!40000 ALTER TABLE `alumno_grupo_alumno` DISABLE KEYS */;
INSERT INTO `alumno_grupo_alumno` VALUES (4,4),(4,5),(4,6);
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
  KEY `IDX_43E74FC0B54DBBCB` (`materia_id`),
  KEY `IDX_43E74FC0FC28E5EE` (`alumno_id`),
  CONSTRAINT `FK_43E74FC0B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_43E74FC0FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
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
  `path` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3529B4828924462A` (`usuario_carga_id`),
  CONSTRAINT `FK_3529B4828924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivo`
--

LOCK TABLES `archivo` WRITE;
/*!40000 ALTER TABLE `archivo` DISABLE KEYS */;
INSERT INTO `archivo` VALUES (1,2,'Resumen Matem','res.pdf','saraza','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(2,2,'Progrmaa Matematica','fert.pdf','archivo/zara','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);
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
  KEY `IDX_D8264A8D5D340050` (`usuario_cargador_id`),
  KEY `IDX_D8264A8DB54DBBCB` (`materia_id`),
  CONSTRAINT `FK_D8264A8D5D340050` FOREIGN KEY (`usuario_cargador_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_D8264A8DB54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
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
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avatar`
--

LOCK TABLES `avatar` WRITE;
/*!40000 ALTER TABLE `avatar` DISABLE KEYS */;
/*!40000 ALTER TABLE `avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bullying`
--

DROP TABLE IF EXISTS `bullying`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bullying` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_13D17F25FC28E5EE` (`alumno_id`),
  CONSTRAINT `FK_13D17F25FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bullying`
--

LOCK TABLES `bullying` WRITE;
/*!40000 ALTER TABLE `bullying` DISABLE KEYS */;
/*!40000 ALTER TABLE `bullying` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificacion`
--

DROP TABLE IF EXISTS `calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificacion` (
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
  KEY `IDX_8A3AF218FC28E5EE` (`alumno_id`),
  CONSTRAINT `FK_8A3AF2182E892728` FOREIGN KEY (`valor`) REFERENCES `valor_calificacion` (`id`),
  CONSTRAINT `FK_8A3AF2188924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_8A3AF218E715F406` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`),
  CONSTRAINT `FK_8A3AF218FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion`
--

LOCK TABLES `calificacion` WRITE;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
INSERT INTO `calificacion` VALUES (68,19,4,1,3,'2015-10-16 00:00:00','343','2015-11-15 17:46:17','2015-11-15 17:47:22',NULL),(69,1,4,1,1,'2015-10-16 00:00:00','ggss3gg','2015-11-15 17:46:17','2015-11-15 17:47:22',NULL),(70,3,4,1,2,'2015-10-16 00:00:00','6777','2015-11-15 17:46:17','2015-11-15 17:47:22',NULL),(71,3,4,2,3,'2015-10-17 00:00:00','','2015-11-15 20:07:48',NULL,NULL),(72,1,4,2,1,'2015-10-17 00:00:00','','2015-11-15 20:07:48',NULL,NULL),(73,1,4,2,2,'2015-10-17 00:00:00','','2015-11-15 20:07:48',NULL,NULL),(74,3,4,6,4,'2016-02-04 19:25:43','','2016-02-05 16:23:56',NULL,NULL),(75,4,4,6,5,'2016-02-04 19:25:43','','2016-02-05 16:23:56',NULL,NULL),(76,5,4,6,6,'2016-02-04 19:25:43','','2016-02-05 16:23:56',NULL,NULL),(77,3,4,7,4,'2016-02-05 19:25:32','','2016-02-05 16:24:06',NULL,NULL),(78,4,4,7,5,'2016-02-05 19:25:32','','2016-02-05 16:24:06',NULL,NULL),(79,5,4,7,6,'2016-02-05 19:25:32','','2016-02-05 16:24:06',NULL,NULL),(80,3,4,9,4,'2016-02-05 19:25:56','','2016-02-05 16:24:31',NULL,NULL),(81,4,4,9,5,'2016-02-05 19:25:56','','2016-02-05 16:24:31',NULL,NULL),(82,5,4,9,6,'2016-02-05 19:25:56','','2016-02-05 16:24:31',NULL,NULL),(83,3,4,10,4,'2016-03-10 19:26:16','','2016-02-05 16:24:42',NULL,NULL),(84,4,4,10,5,'2016-03-10 19:26:16','','2016-02-05 16:24:42',NULL,NULL),(85,5,4,10,6,'2016-03-10 19:26:16','','2016-02-05 16:24:42',NULL,NULL),(86,3,4,11,4,'2016-03-15 19:26:40','','2016-02-05 16:24:49',NULL,NULL),(87,4,4,11,5,'2016-03-15 19:26:40','','2016-02-05 16:24:49',NULL,NULL),(88,5,4,11,6,'2016-03-15 19:26:40','','2016-02-05 16:24:49',NULL,NULL);
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
  `provincia_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8E86059E4E7121AF` (`provincia_id`),
  CONSTRAINT `FK_8E86059E4E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `alumno_id` int(11) DEFAULT NULL,
  `usuario_carga_id` int(11) DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descargo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_suceso` datetime NOT NULL,
  `validado` tinyint(1) DEFAULT NULL,
  `valor` tinyint(1) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F1A6B7B7FC28E5EE` (`alumno_id`),
  KEY `IDX_F1A6B7B78924462A` (`usuario_carga_id`),
  CONSTRAINT `FK_F1A6B7B78924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_F1A6B7B7FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convivencia`
--

LOCK TABLES `convivencia` WRITE;
/*!40000 ALTER TABLE `convivencia` DISABLE KEYS */;
INSERT INTO `convivencia` VALUES (1,1,4,'Estuvo muy bien',NULL,'2015-10-16 00:00:00',1,1,NULL,'0000-00-00 00:00:00',NULL),(2,1,NULL,'La pudrió groso',NULL,'2015-10-16 00:00:00',1,0,NULL,'0000-00-00 00:00:00',NULL),(3,1,NULL,'No aparece',NULL,'2015-10-16 00:00:00',0,NULL,NULL,'0000-00-00 00:00:00',NULL),(4,2,NULL,'otro alumno la pudrio',NULL,'2015-10-16 00:00:00',1,1,NULL,'0000-00-00 00:00:00',NULL);
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
  `activo` tinyint(1) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FD9FCFA4E8608214` (`ciudad_id`),
  KEY `IDX_FD9FCFA4DB38439E` (`usuario_id`),
  KEY `IDX_FD9FCFA471B61351` (`establecimiento_id`),
  CONSTRAINT `FK_FD9FCFA471B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_FD9FCFA4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_FD9FCFA4E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente`
--

LOCK TABLES `docente` WRITE;
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` VALUES (1,NULL,4,1,'Ana María','DaCol','4546325',NULL,NULL,NULL,NULL,'','Maestra Normal',NULL,NULL,NULL,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
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
  KEY `IDX_517E8597B54DBBCB` (`materia_id`),
  KEY `IDX_517E859794E27525` (`docente_id`),
  CONSTRAINT `FK_517E859794E27525` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  CONSTRAINT `FK_517E8597B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente_materia`
--

LOCK TABLES `docente_materia` WRITE;
/*!40000 ALTER TABLE `docente_materia` DISABLE KEYS */;
INSERT INTO `docente_materia` VALUES (1,2,1,NULL,NULL),(2,3,1,NULL,NULL),(4,7,1,NULL,NULL),(7,10,1,NULL,NULL),(8,11,1,'2016-02-03 17:15:49',NULL);
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
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
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
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `activo` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94A4D17EE8608214` (`ciudad_id`),
  KEY `IDX_94A4D17EB239FBC6` (`institucion_id`),
  KEY `IDX_94A4D17EDF1613E4` (`esquema_calificacion_id`),
  CONSTRAINT `FK_94A4D17EB239FBC6` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`),
  CONSTRAINT `FK_94A4D17EDF1613E4` FOREIGN KEY (`esquema_calificacion_id`) REFERENCES `esquema_calificacion` (`id`),
  CONSTRAINT `FK_94A4D17EE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` VALUES (1,NULL,1,4,'America',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,30,4,NULL,NULL,NULL);
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
  `actividad_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `calificada` tinyint(1) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DEEDCA536014FACA` (`actividad_id`),
  KEY `IDX_DEEDCA53B54DBBCB` (`materia_id`),
  KEY `IDX_DEEDCA5394E27525` (`docente_id`),
  KEY `IDX_DEEDCA539C3921AB` (`periodo_id`),
  CONSTRAINT `FK_DEEDCA536014FACA` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`),
  CONSTRAINT `FK_DEEDCA5394E27525` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  CONSTRAINT `FK_DEEDCA539C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`),
  CONSTRAINT `FK_DEEDCA53B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` VALUES (1,NULL,3,1,'Parcial','2015-10-16 00:00:00',1,NULL,NULL,NULL,NULL),(2,NULL,3,1,'Recuperatorio','2015-10-17 00:00:00',1,NULL,NULL,NULL,NULL),(3,NULL,3,1,'TST -integrak','2015-11-15 17:52:21',0,NULL,NULL,NULL,NULL),(4,NULL,3,1,'teset integrl','2015-11-15 19:23:07',0,NULL,NULL,NULL,NULL),(5,NULL,3,1,'Test finañ','2015-11-15 19:25:17',0,NULL,NULL,NULL,NULL),(6,NULL,11,1,'Evaluacion1a','2016-02-04 19:25:43',1,1,NULL,NULL,1),(7,NULL,11,1,'Evaluacion2a','2016-02-05 19:25:32',1,1,NULL,NULL,2),(8,NULL,11,1,'Eval3','2016-02-06 19:25:18',0,0,NULL,NULL,2),(9,NULL,11,1,'Evaluacion1b','2016-02-05 19:25:56',1,1,NULL,NULL,1),(10,NULL,11,1,'Evaluacion2b','2016-03-10 19:26:16',1,1,NULL,NULL,2),(11,NULL,11,1,'Evaluacion2c','2016-03-15 19:26:40',1,1,NULL,NULL,2);
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
  `archivo_id` int(11) DEFAULT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EBAA87B46EBF93B` (`archivo_id`),
  KEY `IDX_6EBAA87BE715F406` (`evaluacion_id`),
  CONSTRAINT `FK_6EBAA87B46EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6EBAA87BE715F406` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`)
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
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_curso` tinyint(1) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_18337A1471B61351` (`establecimiento_id`),
  CONSTRAINT `FK_18337A1471B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_alumno`
--

LOCK TABLES `grupo_alumno` WRITE;
/*!40000 ALTER TABLE `grupo_alumno` DISABLE KEYS */;
INSERT INTO `grupo_alumno` VALUES (1,1,'4b',1,1,'2016-01-01 09:00:00',NULL),(2,1,'5a',0,1,'2016-01-01 09:00:00',NULL),(3,1,'mujeres 4to c',0,1,'2016-01-01 09:00:00',NULL),(4,1,'Test',0,1,'2016-02-03 18:05:28',NULL);
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
  KEY `IDX_7B2FAA0DB54DBBCB` (`materia_id`),
  KEY `IDX_7B2FAA0D176E3EEE` (`grupo_alumno_id`),
  CONSTRAINT `FK_7B2FAA0D176E3EEE` FOREIGN KEY (`grupo_alumno_id`) REFERENCES `grupo_alumno` (`id`),
  CONSTRAINT `FK_7B2FAA0DB54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_alumno_materia`
--

LOCK TABLES `grupo_alumno_materia` WRITE;
/*!40000 ALTER TABLE `grupo_alumno_materia` DISABLE KEYS */;
INSERT INTO `grupo_alumno_materia` VALUES (1,3,1,NULL,NULL),(2,3,2,NULL,NULL),(3,2,3,NULL,NULL),(5,7,1,NULL,NULL),(8,10,1,NULL,NULL),(9,11,1,'2016-02-03 17:15:49',NULL),(10,11,4,'2016-02-03 18:05:42',NULL);
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
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_privado` tinyint(1) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D6C3EFA8924462A` (`usuario_carga_id`),
  KEY `IDX_7D6C3EFA71B61351` (`establecimiento_id`),
  CONSTRAINT `FK_7D6C3EFA71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_7D6C3EFA8924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`)
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
  `activo` tinyint(1) DEFAULT NULL,
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
INSERT INTO `institucion` VALUES (1,'America',NULL,NULL,NULL,NULL,NULL);
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
  `usuario_carga_id` int(11) DEFAULT NULL,
  `asistencia_id` int(11) DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EBF13A878924462A` (`usuario_carga_id`),
  KEY `IDX_EBF13A8757376F49` (`asistencia_id`),
  CONSTRAINT `FK_EBF13A8757376F49` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`),
  CONSTRAINT `FK_EBF13A878924462A` FOREIGN KEY (`usuario_carga_id`) REFERENCES `usuario` (`id`)
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
-- Table structure for table `justificacion_archivo`
--

DROP TABLE IF EXISTS `justificacion_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `justificacion_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `justificacion_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_95461F5246EBF93B` (`archivo_id`),
  KEY `IDX_95461F526D28D42D` (`justificacion_id`),
  CONSTRAINT `FK_95461F5246EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_95461F526D28D42D` FOREIGN KEY (`justificacion_id`) REFERENCES `justificacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `justificacion_archivo`
--

LOCK TABLES `justificacion_archivo` WRITE;
/*!40000 ALTER TABLE `justificacion_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `justificacion_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_materia_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6DF0528424CBB9E3` (`tipo_materia_id`),
  KEY `IDX_6DF0528471B61351` (`establecimiento_id`),
  CONSTRAINT `FK_6DF0528424CBB9E3` FOREIGN KEY (`tipo_materia_id`) REFERENCES `tipo_materia` (`id`),
  CONSTRAINT `FK_6DF0528471B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,1,NULL,'Matematica 3ro B',NULL,NULL,NULL),(2,1,NULL,'Matematica 4A',NULL,NULL,NULL),(3,2,NULL,'Lengua 7 rojo',NULL,NULL,NULL),(4,3,NULL,'Sociales 7mo rojo nombre largo',NULL,NULL,NULL),(7,1,1,'Matematica 1A',0,'2016-02-03 16:53:50',NULL),(10,1,1,'Matematica 1A',0,'2016-02-03 17:09:34',NULL),(11,3,1,'Test 4b',1,'2016-02-03 17:15:49',NULL);
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
  `archivo_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_566A8CA446EBF93B` (`archivo_id`),
  KEY `IDX_566A8CA4B54DBBCB` (`materia_id`),
  CONSTRAINT `FK_566A8CA446EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_566A8CA4B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_archivo`
--

LOCK TABLES `materia_archivo` WRITE;
/*!40000 ALTER TABLE `materia_archivo` DISABLE KEYS */;
INSERT INTO `materia_archivo` VALUES (1,1,3,NULL,NULL),(2,2,3,NULL,NULL);
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
  KEY `IDX_BE9CEB52B54DBBCB` (`materia_id`),
  CONSTRAINT `FK_BE9CEB52B54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_dia_horario`
--

LOCK TABLES `materia_dia_horario` WRITE;
/*!40000 ALTER TABLE `materia_dia_horario` DISABLE KEYS */;
INSERT INTO `materia_dia_horario` VALUES (1,2,'Lunes',1,3,NULL,NULL),(2,2,'Miercoles',4,6,NULL,NULL),(3,3,'Lunes',1,2,NULL,NULL),(4,3,'Miércoles',3,12,NULL,NULL),(5,3,'Sábado',2,3,NULL,NULL),(6,10,'Lunes',8,10,'2016-02-03 17:09:34',NULL),(7,11,'Lunes',10,12,'2016-02-03 17:15:49',NULL);
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
  `borrador` tinyint(1) DEFAULT NULL,
  `fecha_envio` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B631D01DB38439E` (`usuario_id`),
  CONSTRAINT `FK_9B631D01DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` VALUES (4,4,'concha e tu ma','asdasdasdasdasdasdasd',NULL,'2015-11-10 20:09:13'),(5,18,'RE: concha e tu ma','sasacasc',NULL,'2015-11-10 20:09:58'),(6,4,'asfas','fasfasfasfaf',NULL,'2015-11-10 20:12:04');
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje_archivo`
--

DROP TABLE IF EXISTS `mensaje_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_id` int(11) DEFAULT NULL,
  `mensaje_id` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A374C39A46EBF93B` (`archivo_id`),
  KEY `IDX_A374C39A4C54F362` (`mensaje_id`),
  CONSTRAINT `FK_A374C39A46EBF93B` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A374C39A4C54F362` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_archivo`
--

LOCK TABLES `mensaje_archivo` WRITE;
/*!40000 ALTER TABLE `mensaje_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje_archivo` ENABLE KEYS */;
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
  `borrador` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438C7454C54F362` (`mensaje_id`),
  KEY `IDX_B438C745DB38439E` (`usuario_id`),
  CONSTRAINT `FK_B438C7454C54F362` FOREIGN KEY (`mensaje_id`) REFERENCES `mensaje` (`id`),
  CONSTRAINT `FK_B438C745DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_usuario`
--

LOCK TABLES `mensaje_usuario` WRITE;
/*!40000 ALTER TABLE `mensaje_usuario` DISABLE KEYS */;
INSERT INTO `mensaje_usuario` VALUES (4,4,18,1,1,NULL,'2015-11-10 20:09:13','2015-11-10 20:10:56'),(5,5,4,1,0,NULL,'2015-11-10 20:09:58','2015-11-10 20:11:35'),(6,6,4,1,0,NULL,'2015-11-10 20:12:04','2015-11-11 03:38:47');
/*!40000 ALTER TABLE `mensaje_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota_periodo`
--

DROP TABLE IF EXISTS `nota_periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota_periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `nota_id` int(11) DEFAULT NULL,
  `comentario` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validada` tinyint(1) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `docente_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AF5C517B9C3921AB` (`periodo_id`),
  KEY `IDX_AF5C517BB54DBBCB` (`materia_id`),
  KEY `IDX_AF5C517BFC28E5EE` (`alumno_id`),
  KEY `IDX_AF5C517BA98F9F02` (`nota_id`),
  KEY `IDX_AF5C517B94E27525` (`docente_id`),
  CONSTRAINT `FK_AF5C517B94E27525` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
  CONSTRAINT `FK_AF5C517B9C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`),
  CONSTRAINT `FK_AF5C517BA98F9F02` FOREIGN KEY (`nota_id`) REFERENCES `valor_calificacion` (`id`),
  CONSTRAINT `FK_AF5C517BB54DBBCB` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  CONSTRAINT `FK_AF5C517BFC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota_periodo`
--

LOCK TABLES `nota_periodo` WRITE;
/*!40000 ALTER TABLE `nota_periodo` DISABLE KEYS */;
INSERT INTO `nota_periodo` VALUES (184,1,11,4,3,'una b',0,'2016-02-08 20:30:10','2016-02-08 20:30:10',1),(185,1,11,5,4,'un mb',1,'2016-02-08 20:30:10','2016-02-08 20:30:10',1),(186,1,11,6,5,'un S!',1,'2016-02-08 20:30:10','2016-02-08 20:30:10',1),(187,2,11,4,5,'mejoro mucho!',1,'2016-02-08 20:34:39','2016-02-08 20:34:39',1),(188,2,11,5,3,'se quedo',0,'2016-02-08 20:34:39','2016-02-08 20:34:39',1),(189,2,11,6,4,'se tiro a vaga; Posta?',0,'2016-02-08 20:34:39','2016-02-08 20:34:39',1);
/*!40000 ALTER TABLE `nota_periodo` ENABLE KEYS */;
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
  `texto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_envio` datetime NOT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
INSERT INTO `notificacion` VALUES (1,'Nueva actividad de evaluación creada para Nahuel','Se creó una actividad para la evaluacíón Evaluacion1 de la materia Test 4b','2016-02-04 19:06:38','/evaluacion/6'),(2,'Nueva actividad de evaluación creada para Nazareno','Se creó una actividad para la evaluacíón Evaluacion1 de la materia Test 4b','2016-02-04 19:06:38','/evaluacion/6'),(3,'Nueva actividad de evaluación creada para Melina','Se creó una actividad para la evaluacíón Evaluacion1 de la materia Test 4b','2016-02-04 19:06:38','/evaluacion/6'),(4,'Nueva actividad de evaluación creada para Nahuel','Se creó una actividad para la evaluacíón Eval2 de la materia Test 4b','2016-02-04 19:11:04','/evaluacion/7'),(5,'Nueva actividad de evaluación creada para Nazareno','Se creó una actividad para la evaluacíón Eval2 de la materia Test 4b','2016-02-04 19:11:04','/evaluacion/7'),(6,'Nueva actividad de evaluación creada para Melina','Se creó una actividad para la evaluacíón Eval2 de la materia Test 4b','2016-02-04 19:11:04','/evaluacion/7'),(7,'Nueva actividad de evaluación creada para Nahuel','Se creó una actividad para la evaluacíón Eval3 de la materia Test 4b','2016-02-04 19:11:21','/evaluacion/8'),(8,'Nueva actividad de evaluación creada para Nazareno','Se creó una actividad para la evaluacíón Eval3 de la materia Test 4b','2016-02-04 19:11:21','/evaluacion/8'),(9,'Nueva actividad de evaluación creada para Melina','Se creó una actividad para la evaluacíón Eval3 de la materia Test 4b','2016-02-04 19:11:21','/evaluacion/8'),(10,'Nueva actividad de evaluación creada para Nahuel','Se creó una actividad para la evaluacíón Evaluacion1b de la materia Test 4b','2016-02-04 19:25:56','/evaluacion/9'),(11,'Nueva actividad de evaluación creada para Nazareno','Se creó una actividad para la evaluacíón Evaluacion1b de la materia Test 4b','2016-02-04 19:25:56','/evaluacion/9'),(12,'Nueva actividad de evaluación creada para Melina','Se creó una actividad para la evaluacíón Evaluacion1b de la materia Test 4b','2016-02-04 19:25:56','/evaluacion/9'),(13,'Nueva actividad de evaluación creada para Nahuel','Se creó una actividad para la evaluacíón Evaluacion2b de la materia Test 4b','2016-02-04 19:26:16','/evaluacion/10'),(14,'Nueva actividad de evaluación creada para Nazareno','Se creó una actividad para la evaluacíón Evaluacion2b de la materia Test 4b','2016-02-04 19:26:16','/evaluacion/10'),(15,'Nueva actividad de evaluación creada para Melina','Se creó una actividad para la evaluacíón Evaluacion2b de la materia Test 4b','2016-02-04 19:26:16','/evaluacion/10'),(16,'Nueva actividad de evaluación creada para Nahuel','Se creó una actividad para la evaluacíón Evaluacion3b de la materia Test 4b','2016-02-04 19:26:25','/evaluacion/11'),(17,'Nueva actividad de evaluación creada para Nazareno','Se creó una actividad para la evaluacíón Evaluacion3b de la materia Test 4b','2016-02-04 19:26:25','/evaluacion/11'),(18,'Nueva actividad de evaluación creada para Melina','Se creó una actividad para la evaluacíón Evaluacion3b de la materia Test 4b','2016-02-04 19:26:25','/evaluacion/11'),(19,'Calificacion cargada en Test 4b para Nahuel','Se cargaron las calificaciones para la evaluación Evaluacion1a','2016-02-05 16:23:56','/calificacion/'),(20,'Calificacion cargada en Test 4b para Nazareno','Se cargaron las calificaciones para la evaluación Evaluacion1a','2016-02-05 16:23:57','/calificacion/'),(21,'Calificacion cargada en Test 4b para Melina','Se cargaron las calificaciones para la evaluación Evaluacion1a','2016-02-05 16:23:57','/calificacion/'),(22,'Calificacion cargada en Test 4b para Nahuel','Se cargaron las calificaciones para la evaluación Evaluacion2a','2016-02-05 16:24:06','/calificacion/'),(23,'Calificacion cargada en Test 4b para Nazareno','Se cargaron las calificaciones para la evaluación Evaluacion2a','2016-02-05 16:24:06','/calificacion/'),(24,'Calificacion cargada en Test 4b para Melina','Se cargaron las calificaciones para la evaluación Evaluacion2a','2016-02-05 16:24:06','/calificacion/'),(25,'Calificacion cargada en Test 4b para Nahuel','Se cargaron las calificaciones para la evaluación Evaluacion1b','2016-02-05 16:24:31','/calificacion/'),(26,'Calificacion cargada en Test 4b para Nazareno','Se cargaron las calificaciones para la evaluación Evaluacion1b','2016-02-05 16:24:31','/calificacion/'),(27,'Calificacion cargada en Test 4b para Melina','Se cargaron las calificaciones para la evaluación Evaluacion1b','2016-02-05 16:24:31','/calificacion/'),(28,'Calificacion cargada en Test 4b para Nahuel','Se cargaron las calificaciones para la evaluación Evaluacion2b','2016-02-05 16:24:42','/calificacion/'),(29,'Calificacion cargada en Test 4b para Nazareno','Se cargaron las calificaciones para la evaluación Evaluacion2b','2016-02-05 16:24:42','/calificacion/'),(30,'Calificacion cargada en Test 4b para Melina','Se cargaron las calificaciones para la evaluación Evaluacion2b','2016-02-05 16:24:42','/calificacion/'),(31,'Calificacion cargada en Test 4b para Nahuel','Se cargaron las calificaciones para la evaluación Evaluacion2c','2016-02-05 16:24:49','/calificacion/'),(32,'Calificacion cargada en Test 4b para Nazareno','Se cargaron las calificaciones para la evaluación Evaluacion2c','2016-02-05 16:24:49','/calificacion/'),(33,'Calificacion cargada en Test 4b para Melina','Se cargaron las calificaciones para la evaluación Evaluacion2c','2016-02-05 16:24:49','/calificacion/');
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
  `usuario_id` int(11) DEFAULT NULL,
  `notificacion_id` int(11) DEFAULT NULL,
  `notificado` tinyint(1) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4FFB3E99DB38439E` (`usuario_id`),
  KEY `IDX_4FFB3E994D633FC4` (`notificacion_id`),
  CONSTRAINT `FK_4FFB3E994D633FC4` FOREIGN KEY (`notificacion_id`) REFERENCES `notificacion` (`id`),
  CONSTRAINT `FK_4FFB3E99DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion_usuario`
--

LOCK TABLES `notificacion_usuario` WRITE;
/*!40000 ALTER TABLE `notificacion_usuario` DISABLE KEYS */;
INSERT INTO `notificacion_usuario` VALUES (1,22,1,0,'2016-02-04 19:06:38','2016-02-04 19:06:38'),(2,23,2,0,'2016-02-04 19:06:38','2016-02-04 19:06:38'),(3,24,3,0,'2016-02-04 19:06:38','2016-02-04 19:06:38'),(4,22,4,0,'2016-02-04 19:11:04','2016-02-04 19:11:04'),(5,23,5,0,'2016-02-04 19:11:04','2016-02-04 19:11:04'),(6,24,6,0,'2016-02-04 19:11:04','2016-02-04 19:11:04'),(7,22,7,0,'2016-02-04 19:11:21','2016-02-04 19:11:21'),(8,23,8,0,'2016-02-04 19:11:21','2016-02-04 19:11:21'),(9,24,9,0,'2016-02-04 19:11:21','2016-02-04 19:11:21'),(10,22,10,0,'2016-02-04 19:25:56','2016-02-04 19:25:56'),(11,23,11,0,'2016-02-04 19:25:56','2016-02-04 19:25:56'),(12,24,12,0,'2016-02-04 19:25:56','2016-02-04 19:25:56'),(13,22,13,0,'2016-02-04 19:26:16','2016-02-04 19:26:16'),(14,23,14,0,'2016-02-04 19:26:16','2016-02-04 19:26:16'),(15,24,15,0,'2016-02-04 19:26:16','2016-02-04 19:26:16'),(16,22,16,0,'2016-02-04 19:26:25','2016-02-04 19:26:25'),(17,23,17,0,'2016-02-04 19:26:25','2016-02-04 19:26:25'),(18,24,18,0,'2016-02-04 19:26:25','2016-02-04 19:26:25'),(19,22,19,0,'2016-02-05 16:23:57','2016-02-05 16:23:57'),(20,23,20,0,'2016-02-05 16:23:57','2016-02-05 16:23:57'),(21,24,21,0,'2016-02-05 16:23:57','2016-02-05 16:23:57'),(22,22,22,0,'2016-02-05 16:24:06','2016-02-05 16:24:06'),(23,23,23,0,'2016-02-05 16:24:06','2016-02-05 16:24:06'),(24,24,24,0,'2016-02-05 16:24:06','2016-02-05 16:24:06'),(25,22,25,0,'2016-02-05 16:24:31','2016-02-05 16:24:31'),(26,23,26,0,'2016-02-05 16:24:31','2016-02-05 16:24:31'),(27,24,27,0,'2016-02-05 16:24:31','2016-02-05 16:24:31'),(28,22,28,0,'2016-02-05 16:24:42','2016-02-05 16:24:42'),(29,23,29,0,'2016-02-05 16:24:42','2016-02-05 16:24:42'),(30,24,30,0,'2016-02-05 16:24:42','2016-02-05 16:24:42'),(31,22,31,0,'2016-02-05 16:24:49','2016-02-05 16:24:49'),(32,23,32,0,'2016-02-05 16:24:49','2016-02-05 16:24:49'),(33,24,33,0,'2016-02-05 16:24:49','2016-02-05 16:24:49');
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
  `ciudad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genero` tinyint(1) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `IDX_D3656AEBE8608214` (`ciudad_id`),
  KEY `IDX_D3656AEBDB38439E` (`usuario_id`),
  KEY `IDX_D3656AEB71B61351` (`establecimiento_id`),
  CONSTRAINT `FK_D3656AEB71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_D3656AEBDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_D3656AEBE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `padre`
--

LOCK TABLES `padre` WRITE;
/*!40000 ALTER TABLE `padre` DISABLE KEYS */;
INSERT INTO `padre` VALUES (1,NULL,20,1,'DIEGO','CASTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,NULL,21,1,'MARCEA','CHIAPPE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
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
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_desde` datetime NOT NULL,
  `fecha_hasta` datetime NOT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `anio_lectivo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7316C4ED71B61351` (`establecimiento_id`),
  CONSTRAINT `FK_7316C4ED71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'Periodo1','2016-02-02 19:00:55','2016-02-09 19:00:55','2016-02-04 19:00:55','2016-02-04 19:00:55',1,2016),(2,'Periodo2','2016-03-01 19:07:45','2016-02-27 19:07:45','2016-02-04 19:07:45','2016-02-04 19:07:45',1,2016);
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo_establecimiento`
--

DROP TABLE IF EXISTS `periodo_establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_12C79D8D9C3921AB` (`periodo_id`),
  KEY `IDX_12C79D8D71B61351` (`establecimiento_id`),
  CONSTRAINT `FK_12C79D8D71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_12C79D8D9C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo_establecimiento`
--

LOCK TABLES `periodo_establecimiento` WRITE;
/*!40000 ALTER TABLE `periodo_establecimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodo_establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D39AF213C604D5C6` (`pais_id`),
  CONSTRAINT `FK_D39AF213C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `token` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `expiration_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F37A13BDB38439E` (`usuario_id`),
  CONSTRAINT `FK_5F37A13BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `rol_id` int(11) DEFAULT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_entidad_asociada` int(11) DEFAULT NULL,
  `email` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2265B05D4BAB96C` (`rol_id`),
  KEY `IDX_2265B05DB239FBC6` (`institucion_id`),
  CONSTRAINT `FK_2265B05D4BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  CONSTRAINT `FK_2265B05DB239FBC6` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,1,'admin','','admin',NULL,'admin@admin.com',NULL,NULL),(2,2,1,'speacecraft','','1',1,'padre@padre.con',NULL,NULL),(3,3,1,'juancarlos','juanca','juancarlos',1,'alumno@alumno.com',NULL,NULL),(4,4,1,'anadacol','anada','anadacol',1,'docente@docente.com',NULL,NULL),(5,5,1,'dorita','','dorita',NULL,'director@director.com',NULL,NULL),(6,6,1,'maryrose','','maryrose',NULL,'bedel@bedel.com',NULL,NULL),(17,3,1,'GADI','CASTA','1',2,NULL,NULL,NULL),(18,3,1,'FEDE','CASTA','1',1,NULL,NULL,NULL),(19,3,1,'SEBI','CASTA','1',3,NULL,NULL,NULL),(20,2,1,'DIEGO','CASTA','1',1,NULL,NULL,NULL),(21,2,1,'MARCELA','CASTA','1',NULL,NULL,NULL,NULL),(22,3,1,'Nahuel','Lattessi','Lattessi',4,NULL,'2016-02-03 17:59:38',NULL),(23,3,1,'Nazareno','Lattessi','Lattessi',5,NULL,'2016-02-03 17:59:47',NULL),(24,3,1,'Melina','Sabuncuyan','Sabuncuyan',6,NULL,'2016-02-03 17:59:58',NULL);
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
  `usuario_id` int(11) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7110F23FDB38439E` (`usuario_id`),
  KEY `IDX_7110F23F71B61351` (`establecimiento_id`),
  CONSTRAINT `FK_7110F23F71B61351` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`),
  CONSTRAINT `FK_7110F23FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
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
  `grupo_usuario_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`grupo_usuario_id`,`usuario_id`),
  UNIQUE KEY `UNIQ_8BDF2024DB38439E` (`usuario_id`),
  KEY `IDX_8BDF2024DBD30545` (`grupo_usuario_id`),
  CONSTRAINT `FK_8BDF2024DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_8BDF2024DBD30545` FOREIGN KEY (`grupo_usuario_id`) REFERENCES `grupo_usuario` (`id`)
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
  `esquema_calificacion_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_88D0227DF1613E4` (`esquema_calificacion_id`),
  CONSTRAINT `FK_88D0227DF1613E4` FOREIGN KEY (`esquema_calificacion_id`) REFERENCES `esquema_calificacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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

-- Dump completed on 2016-02-08 21:35:05
