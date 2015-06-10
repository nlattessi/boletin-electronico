-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: boletines
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `id_archivo` int(11) DEFAULT NULL,
  `nombre_actividad` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_actividad` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_desde` datetime NOT NULL,
  `fecha_hasta` datetime NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  PRIMARY KEY (`id_actividad`),
  KEY `IDX_8DF2BD06305820DC` (`id_usuario_creador`),
  KEY `IDX_8DF2BD06EBB41DF2` (`id_archivo`),
  CONSTRAINT `FK_8DF2BD06305820DC` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `FK_8DF2BD06EBB41DF2` FOREIGN KEY (`id_archivo`) REFERENCES `archivo` (`id_archivo`)
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
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_alumno` int(11) DEFAULT NULL,
  `id_usuario_padre1` int(11) DEFAULT NULL,
  `id_usuario_padre2` int(11) DEFAULT NULL,
  `nombre_alumno` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `IDX_1435D52DD3418B22` (`id_usuario_alumno`),
  KEY `IDX_1435D52D73A3EF22` (`id_usuario_padre1`),
  KEY `IDX_1435D52DEAAABE98` (`id_usuario_padre2`),
  CONSTRAINT `FK_1435D52D73A3EF22` FOREIGN KEY (`id_usuario_padre1`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `FK_1435D52DD3418B22` FOREIGN KEY (`id_usuario_alumno`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `FK_1435D52DEAAABE98` FOREIGN KEY (`id_usuario_padre2`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_asistencia`
--

DROP TABLE IF EXISTS `alumno_asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_asistencia` (
  `id_alumno_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_justificacion` int(11) DEFAULT NULL,
  `id_asistencia` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `valor_asistencia` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_alumno_asistencia`),
  KEY `IDX_D30A866455D9EBE2` (`id_justificacion`),
  KEY `IDX_D30A86647DACCA5A` (`id_asistencia`),
  KEY `IDX_D30A8664320260C0` (`id_alumno`),
  CONSTRAINT `FK_D30A8664320260C0` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `FK_D30A866455D9EBE2` FOREIGN KEY (`id_justificacion`) REFERENCES `justificacion` (`id_justificacion`),
  CONSTRAINT `FK_D30A86647DACCA5A` FOREIGN KEY (`id_asistencia`) REFERENCES `asistencia` (`id_asistencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_asistencia`
--

LOCK TABLES `alumno_asistencia` WRITE;
/*!40000 ALTER TABLE `alumno_asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_grupo_alumno`
--

DROP TABLE IF EXISTS `alumno_grupo_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_grupo_alumno` (
  `id_alumno_grupo_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_alumno_grupo_alumno`),
  KEY `IDX_55DB706628BDAE3` (`id_grupo`),
  KEY `IDX_55DB706320260C0` (`id_alumno`),
  CONSTRAINT `FK_55DB706320260C0` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `FK_55DB706628BDAE3` FOREIGN KEY (`id_grupo`) REFERENCES `grupo_alumno` (`id_grupo_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_grupo_alumno`
--

LOCK TABLES `alumno_grupo_alumno` WRITE;
/*!40000 ALTER TABLE `alumno_grupo_alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_grupo_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_materia`
--

DROP TABLE IF EXISTS `alumno_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_materia` (
  `id_alumno_materia` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_alumno_materia`),
  KEY `IDX_43E74FC0B36DFBF4` (`id_materia`),
  KEY `IDX_43E74FC0320260C0` (`id_alumno`),
  CONSTRAINT `FK_43E74FC0320260C0` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `FK_43E74FC0B36DFBF4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_materia`
--

LOCK TABLES `alumno_materia` WRITE;
/*!40000 ALTER TABLE `alumno_materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archivo`
--

DROP TABLE IF EXISTS `archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivo` (
  `id_archivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_carga` int(11) DEFAULT NULL,
  `nombre_para_mostrar` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_archivo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_archivo` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_subida` datetime NOT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `IDX_3529B4827FA0C10D` (`id_usuario_carga`),
  CONSTRAINT `FK_3529B4827FA0C10D` FOREIGN KEY (`id_usuario_carga`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivo`
--

LOCK TABLES `archivo` WRITE;
/*!40000 ALTER TABLE `archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_cargador` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `fecha_asistencia` datetime NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `IDX_D8264A8DE01E0B5D` (`id_usuario_cargador`),
  KEY `IDX_D8264A8DB36DFBF4` (`id_materia`),
  CONSTRAINT `FK_D8264A8DB36DFBF4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  CONSTRAINT `FK_D8264A8DE01E0B5D` FOREIGN KEY (`id_usuario_cargador`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendario`
--

DROP TABLE IF EXISTS `calendario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendario` (
  `id_calendario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_propietario` int(11) DEFAULT NULL,
  `nombre_calendario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_calendario`),
  KEY `IDX_2F19AB8CC1CA56B5` (`id_usuario_propietario`),
  CONSTRAINT `FK_2F19AB8CC1CA56B5` FOREIGN KEY (`id_usuario_propietario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendario`
--

LOCK TABLES `calendario` WRITE;
/*!40000 ALTER TABLE `calendario` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendario_actividad`
--

DROP TABLE IF EXISTS `calendario_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendario_actividad` (
  `id_calendario_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `id_calendario` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_calendario_actividad`),
  KEY `IDX_A78AD08A932B5B` (`id_calendario`),
  KEY `IDX_A78AD0DC70121` (`id_actividad`),
  CONSTRAINT `FK_A78AD08A932B5B` FOREIGN KEY (`id_calendario`) REFERENCES `calendario` (`id_calendario`),
  CONSTRAINT `FK_A78AD0DC70121` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendario_actividad`
--

LOCK TABLES `calendario_actividad` WRITE;
/*!40000 ALTER TABLE `calendario_actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendario_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificacion`
--

DROP TABLE IF EXISTS `calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificacion` (
  `id_calificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `fecha_calificacion` datetime DEFAULT NULL,
  `valor_calificacion` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comentario_calificacion` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validada` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_calificacion`),
  KEY `IDX_8A3AF218777B3A01` (`id_examen`),
  KEY `IDX_8A3AF218320260C0` (`id_alumno`),
  CONSTRAINT `FK_8A3AF218320260C0` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `FK_8A3AF218777B3A01` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`id_examen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion`
--

LOCK TABLES `calificacion` WRITE;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `id_docente` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `comentario_docente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descargo_alumno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_suceso` datetime NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `validado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `IDX_72D32A26230266D4` (`id_docente`),
  KEY `IDX_72D32A26320260C0` (`id_alumno`),
  CONSTRAINT `FK_72D32A26230266D4` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`),
  CONSTRAINT `FK_72D32A26320260C0` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente`
--

DROP TABLE IF EXISTS `docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_docente` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email_docente` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_docente` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_docente`),
  KEY `IDX_FD9FCFA4FCF8192D` (`id_usuario`),
  CONSTRAINT `FK_FD9FCFA4FCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente`
--

LOCK TABLES `docente` WRITE;
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente_materia`
--

DROP TABLE IF EXISTS `docente_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente_materia` (
  `id_docente_materia` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_docente_materia`),
  KEY `IDX_517E8597B36DFBF4` (`id_materia`),
  KEY `IDX_517E8597230266D4` (`id_docente`),
  CONSTRAINT `FK_517E8597230266D4` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`),
  CONSTRAINT `FK_517E8597B36DFBF4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente_materia`
--

LOCK TABLES `docente_materia` WRITE;
/*!40000 ALTER TABLE `docente_materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `docente_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id_establecimiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_institucion` int(11) DEFAULT NULL,
  `nombre_establecimiento` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_establecimiento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_establecimiento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_establecimiento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_establecimiento`),
  KEY `IDX_94A4D17EEF433A34` (`id_institucion`),
  CONSTRAINT `FK_94A4D17EEF433A34` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` VALUES (1,NULL,'a','a','a','a');
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen`
--

DROP TABLE IF EXISTS `examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen` (
  `id_examen` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `nombre_examen` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_examen` datetime NOT NULL,
  PRIMARY KEY (`id_examen`),
  KEY `IDX_514C8FECB36DFBF4` (`id_materia`),
  KEY `IDX_514C8FEC230266D4` (`id_docente`),
  KEY `IDX_514C8FECDC70121` (`id_actividad`),
  CONSTRAINT `FK_514C8FEC230266D4` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`),
  CONSTRAINT `FK_514C8FECB36DFBF4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  CONSTRAINT `FK_514C8FECDC70121` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen`
--

LOCK TABLES `examen` WRITE;
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;
/*!40000 ALTER TABLE `examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen_archivo`
--

DROP TABLE IF EXISTS `examen_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen_archivo` (
  `id_examen_archivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `id_archivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_examen_archivo`),
  KEY `IDX_96A9D3A6777B3A01` (`id_examen`),
  KEY `IDX_96A9D3A6EBB41DF2` (`id_archivo`),
  CONSTRAINT `FK_96A9D3A6777B3A01` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`id_examen`),
  CONSTRAINT `FK_96A9D3A6EBB41DF2` FOREIGN KEY (`id_archivo`) REFERENCES `archivo` (`id_archivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen_archivo`
--

LOCK TABLES `examen_archivo` WRITE;
/*!40000 ALTER TABLE `examen_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `examen_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_alumno`
--

DROP TABLE IF EXISTS `grupo_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_alumno` (
  `id_grupo_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_grupo_alumno` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_curso` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_grupo_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_alumno`
--

LOCK TABLES `grupo_alumno` WRITE;
/*!40000 ALTER TABLE `grupo_alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_alumno_materia`
--

DROP TABLE IF EXISTS `grupo_alumno_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_alumno_materia` (
  `id_grupo_alumno_materia` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `id_grupo_alumno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_grupo_alumno_materia`),
  KEY `IDX_7B2FAA0DB36DFBF4` (`id_materia`),
  KEY `IDX_7B2FAA0D3BF20F66` (`id_grupo_alumno`),
  CONSTRAINT `FK_7B2FAA0D3BF20F66` FOREIGN KEY (`id_grupo_alumno`) REFERENCES `grupo_alumno` (`id_grupo_alumno`),
  CONSTRAINT `FK_7B2FAA0DB36DFBF4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_alumno_materia`
--

LOCK TABLES `grupo_alumno_materia` WRITE;
/*!40000 ALTER TABLE `grupo_alumno_materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_alumno_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_usuario`
--

DROP TABLE IF EXISTS `grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_usuario` (
  `id_grupo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_carga` int(11) DEFAULT NULL,
  `nombre_grupo_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `es_privado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_grupo_usuario`),
  KEY `IDX_7D6C3EFA7FA0C10D` (`id_usuario_carga`),
  CONSTRAINT `FK_7D6C3EFA7FA0C10D` FOREIGN KEY (`id_usuario_carga`) REFERENCES `usuario` (`id_usuario`)
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
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_institucion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_institucion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_institucion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_institucion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institucion`
--

LOCK TABLES `institucion` WRITE;
/*!40000 ALTER TABLE `institucion` DISABLE KEYS */;
/*!40000 ALTER TABLE `institucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `justificacion`
--

DROP TABLE IF EXISTS `justificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `justificacion` (
  `id_justificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_carga` int(11) DEFAULT NULL,
  `id_archivo` int(11) DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `justificacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_justificacion`),
  KEY `IDX_EBF13A877FA0C10D` (`id_usuario_carga`),
  KEY `IDX_EBF13A87EBB41DF2` (`id_archivo`),
  CONSTRAINT `FK_EBF13A877FA0C10D` FOREIGN KEY (`id_usuario_carga`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `FK_EBF13A87EBB41DF2` FOREIGN KEY (`id_archivo`) REFERENCES `archivo` (`id_archivo`)
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
  `id_materia` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_materia` int(11) DEFAULT NULL,
  `id_calendario_materia` int(11) DEFAULT NULL,
  `nombre_materia` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `IDX_6DF052845DC80656` (`id_tipo_materia`),
  KEY `IDX_6DF05284BCEAFDD1` (`id_calendario_materia`),
  CONSTRAINT `FK_6DF052845DC80656` FOREIGN KEY (`id_tipo_materia`) REFERENCES `tipo_materia` (`id_tipo_materia`),
  CONSTRAINT `FK_6DF05284BCEAFDD1` FOREIGN KEY (`id_calendario_materia`) REFERENCES `calendario` (`id_calendario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_archivo`
--

DROP TABLE IF EXISTS `materia_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_archivo` (
  `id_materia_archivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `id_archivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_materia_archivo`),
  KEY `IDX_566A8CA4B36DFBF4` (`id_materia`),
  KEY `IDX_566A8CA4EBB41DF2` (`id_archivo`),
  CONSTRAINT `FK_566A8CA4B36DFBF4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  CONSTRAINT `FK_566A8CA4EBB41DF2` FOREIGN KEY (`id_archivo`) REFERENCES `archivo` (`id_archivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_archivo`
--

LOCK TABLES `materia_archivo` WRITE;
/*!40000 ALTER TABLE `materia_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_dia_horario`
--

DROP TABLE IF EXISTS `materia_dia_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_dia_horario` (
  `id_materia_dia_horario` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `dia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hora_catedra_inicio` int(11) NOT NULL,
  `hora_catedra_fin` int(11) NOT NULL,
  PRIMARY KEY (`id_materia_dia_horario`),
  KEY `IDX_BE9CEB52B36DFBF4` (`id_materia`),
  CONSTRAINT `FK_BE9CEB52B36DFBF4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_dia_horario`
--

LOCK TABLES `materia_dia_horario` WRITE;
/*!40000 ALTER TABLE `materia_dia_horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_dia_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_recibe` int(11) DEFAULT NULL,
  `id_usuario_envia` int(11) DEFAULT NULL,
  `titulo_mensaje` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto_mensaje` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `borrado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `IDX_9B631D0165089FEB` (`id_usuario_recibe`),
  KEY `IDX_9B631D013109A1A9` (`id_usuario_envia`),
  CONSTRAINT `FK_9B631D013109A1A9` FOREIGN KEY (`id_usuario_envia`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `FK_9B631D0165089FEB` FOREIGN KEY (`id_usuario_recibe`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion` (
  `id_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_envia` int(11) DEFAULT NULL,
  `id_grupo_usuario_recibe` int(11) DEFAULT NULL,
  `titulo_notificacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto_notificacion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_envio` datetime NOT NULL,
  PRIMARY KEY (`id_notificacion`),
  KEY `IDX_729A19EC3109A1A9` (`id_usuario_envia`),
  KEY `IDX_729A19EC6C563684` (`id_grupo_usuario_recibe`),
  CONSTRAINT `FK_729A19EC3109A1A9` FOREIGN KEY (`id_usuario_envia`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `FK_729A19EC6C563684` FOREIGN KEY (`id_grupo_usuario_recibe`) REFERENCES `grupo_usuario` (`id_grupo_usuario`)
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
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'docente'),(2,'alumno'),(3,'padre');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_materia`
--

DROP TABLE IF EXISTS `tipo_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_materia` (
  `id_tipo_materia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_materia` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tipo_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_materia`
--

LOCK TABLES `tipo_materia` WRITE;
/*!40000 ALTER TABLE `tipo_materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_usuario_para_mostrar` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_real` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_usuario` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `IDX_2265B05D90F1D76D` (`id_rol`),
  CONSTRAINT `FK_2265B05D90F1D76D` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (4,'f','f','f',NULL,NULL,1),(5,'bb','b','b',NULL,NULL,2),(6,'c','c','c',NULL,NULL,2),(9,'g','g','g',NULL,NULL,1),(10,'h','h','hhh',NULL,NULL,3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_establecimiento`
--

DROP TABLE IF EXISTS `usuario_establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_establecimiento` (
  `id_usuario_establecimiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_establecimiento` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_establecimiento`),
  KEY `IDX_7110F23F7DFA12F6` (`id_establecimiento`),
  KEY `IDX_7110F23FFCF8192D` (`id_usuario`),
  CONSTRAINT `FK_7110F23F7DFA12F6` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`),
  CONSTRAINT `FK_7110F23FFCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
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
  `id_usuario_grupo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_grupo_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_grupo_usuario`),
  KEY `IDX_8BDF2024FCF8192D` (`id_usuario`),
  KEY `IDX_8BDF2024C344EF9F` (`id_grupo_usuario`),
  CONSTRAINT `FK_8BDF2024C344EF9F` FOREIGN KEY (`id_grupo_usuario`) REFERENCES `grupo_usuario` (`id_grupo_usuario`),
  CONSTRAINT `FK_8BDF2024FCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
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
-- Table structure for table `usuario_rol`
--

DROP TABLE IF EXISTS `usuario_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_rol`),
  KEY `IDX_72EDD1A490F1D76D` (`id_rol`),
  KEY `IDX_72EDD1A4FCF8192D` (`id_usuario`),
  CONSTRAINT `FK_72EDD1A490F1D76D` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  CONSTRAINT `FK_72EDD1A4FCF8192D` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_rol`
--

LOCK TABLES `usuario_rol` WRITE;
/*!40000 ALTER TABLE `usuario_rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_rol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-10 12:13:47
