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
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` (`id`, `usuario_id`, `nombre`, `apellido`, `dni`, `ciudad_id`, `direccion`, `codigo_postal`, `codigo_pais`, `codigo_area`, `telefono`, `nacionalidad`, `sexo`, `padre1_id`, `padre2_id`, `obra_social`, `obra_social_numero_afiliado`, `telefono_emergencia`, `apodo`, `foto`, `avatar_id`, `fecha_ingreso`, `fecha_nacimiento`, `especialidad_id`, `observaciones`, `establecimiento_id`, `creation_time`, `update_time`, `grupo_sanguineo`) VALUES (1,18,'FEDE','CASTA','33300316',NULL,'',NULL,'','','',NULL,NULL,1,2,'','','',NULL,NULL,0,'0000-00-00','0000-00-00',NULL,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);
INSERT INTO `alumno` (`id`, `usuario_id`, `nombre`, `apellido`, `dni`, `ciudad_id`, `direccion`, `codigo_postal`, `codigo_pais`, `codigo_area`, `telefono`, `nacionalidad`, `sexo`, `padre1_id`, `padre2_id`, `obra_social`, `obra_social_numero_afiliado`, `telefono_emergencia`, `apodo`, `foto`, `avatar_id`, `fecha_ingreso`, `fecha_nacimiento`, `especialidad_id`, `observaciones`, `establecimiento_id`, `creation_time`, `update_time`, `grupo_sanguineo`) VALUES (2,17,'GADI','CASTA','4234234',NULL,'',NULL,'','','',NULL,NULL,1,2,'','','',NULL,NULL,0,'0000-00-00','0000-00-00',NULL,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);
INSERT INTO `alumno` (`id`, `usuario_id`, `nombre`, `apellido`, `dni`, `ciudad_id`, `direccion`, `codigo_postal`, `codigo_pais`, `codigo_area`, `telefono`, `nacionalidad`, `sexo`, `padre1_id`, `padre2_id`, `obra_social`, `obra_social_numero_afiliado`, `telefono_emergencia`, `apodo`, `foto`, `avatar_id`, `fecha_ingreso`, `fecha_nacimiento`, `especialidad_id`, `observaciones`, `establecimiento_id`, `creation_time`, `update_time`, `grupo_sanguineo`) VALUES (3,19,'SEBI','CASTA','23423423',NULL,'',NULL,'','','',NULL,NULL,1,2,'','','',NULL,NULL,0,'0000-00-00','0000-00-00',NULL,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `alumno_asistencia`
--

LOCK TABLES `alumno_asistencia` WRITE;
/*!40000 ALTER TABLE `alumno_asistencia` DISABLE KEYS */;
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (1,NULL,2,1,'P',NULL,NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (2,NULL,3,1,'A',NULL,NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (3,NULL,4,1,'T',NULL,NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (4,NULL,5,2,'A',NULL,NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (5,NULL,6,3,'P','2015-11-19 14:30:57',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (6,NULL,6,1,'T','2015-11-19 14:30:57',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (7,NULL,6,2,'A','2015-11-19 14:30:57',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (8,NULL,7,3,'A','2015-11-19 16:47:45',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (9,NULL,7,1,'T','2015-11-19 16:47:45',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (10,NULL,7,2,'P','2015-11-19 16:47:45',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (11,NULL,8,3,'A','2015-11-19 16:48:17',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (12,NULL,8,1,'T','2015-11-19 16:48:17',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (13,NULL,8,2,'P','2015-11-19 16:48:17',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (14,NULL,9,3,'A','2015-11-19 16:50:17',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (15,NULL,9,1,'T','2015-11-19 16:50:17',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (16,NULL,9,2,'P','2015-11-19 16:50:17',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (17,NULL,10,3,'A','2015-11-19 16:51:00',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (18,NULL,10,1,'T','2015-11-19 16:51:00',NULL);
INSERT INTO `alumno_asistencia` (`id`, `justificacion_id`, `asistencia_id`, `alumno_id`, `valor`, `creation_time`, `update_time`) VALUES (19,NULL,10,2,'A','2015-11-19 16:51:00',NULL);
/*!40000 ALTER TABLE `alumno_asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `alumno_grupo_alumno`
--

LOCK TABLES `alumno_grupo_alumno` WRITE;
/*!40000 ALTER TABLE `alumno_grupo_alumno` DISABLE KEYS */;
INSERT INTO `alumno_grupo_alumno` (`id`, `grupo_alumno_id`, `alumno_id`, `creation_time`, `update_time`) VALUES (1,1,1,NULL,NULL);
INSERT INTO `alumno_grupo_alumno` (`id`, `grupo_alumno_id`, `alumno_id`, `creation_time`, `update_time`) VALUES (2,1,2,NULL,NULL);
/*!40000 ALTER TABLE `alumno_grupo_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `alumno_materia`
--

LOCK TABLES `alumno_materia` WRITE;
/*!40000 ALTER TABLE `alumno_materia` DISABLE KEYS */;
INSERT INTO `alumno_materia` (`id`, `materia_id`, `alumno_id`, `creation_time`, `update_time`) VALUES (3,3,3,NULL,NULL);
/*!40000 ALTER TABLE `alumno_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `archivo`
--

LOCK TABLES `archivo` WRITE;
/*!40000 ALTER TABLE `archivo` DISABLE KEYS */;
INSERT INTO `archivo` (`id`, `usuario_carga_id`, `nombre_para_mostrar`, `nombre`, `ruta_archivo`, `fecha_subida`, `fecha_actualizacion`) VALUES (1,2,'Resumen Matem','res.pdf','saraza','0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `archivo` (`id`, `usuario_carga_id`, `nombre_para_mostrar`, `nombre`, `ruta_archivo`, `fecha_subida`, `fecha_actualizacion`) VALUES (2,2,'Progrmaa Matematica','fert.pdf','archivo/zara','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (2,1,1,'2015-10-16','2015-10-16 17:18:24','0000-00-00 00:00:00');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (3,1,1,'2015-10-15','2015-10-16 17:18:56','0000-00-00 00:00:00');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (4,1,2,'2015-10-16','2015-10-16 17:19:42','0000-00-00 00:00:00');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (5,6,3,'2015-10-16','2015-10-16 17:19:42','0000-00-00 00:00:00');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (6,4,3,'2015-11-15','2015-11-19 14:30:57','2015-11-19 14:30:57');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (7,4,3,'2015-11-16','2015-11-19 16:47:45','2015-11-19 16:47:45');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (8,4,3,'2015-11-17','2015-11-19 16:48:17','2015-11-19 16:48:17');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (9,4,3,'2015-11-18','2015-11-19 16:50:17','2015-11-19 16:50:17');
INSERT INTO `asistencia` (`id`, `usuario_cargador_id`, `materia_id`, `fecha`, `fecha_carga`, `fecha_actualizacion`) VALUES (10,4,3,'2015-11-19','2015-11-19 16:51:00','2015-11-19 16:51:00');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `avatar`
--

LOCK TABLES `avatar` WRITE;
/*!40000 ALTER TABLE `avatar` DISABLE KEYS */;
/*!40000 ALTER TABLE `avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `calificacion`
--

LOCK TABLES `calificacion` WRITE;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
INSERT INTO `calificacion` (`id`, `evaluacion_id`, `alumno_id`, `fecha`, `valor`, `comentario`, `usuario_carga_id`, `fecha_creacion`, `fecha_actualizacion`, `validada`) VALUES (68,1,3,'2015-10-16 00:00:00',19,'343',4,'2015-11-15 17:46:17','2015-11-15 17:47:22',NULL);
INSERT INTO `calificacion` (`id`, `evaluacion_id`, `alumno_id`, `fecha`, `valor`, `comentario`, `usuario_carga_id`, `fecha_creacion`, `fecha_actualizacion`, `validada`) VALUES (69,1,1,'2015-10-16 00:00:00',1,'ggss3gg',4,'2015-11-15 17:46:17','2015-11-15 17:47:22',NULL);
INSERT INTO `calificacion` (`id`, `evaluacion_id`, `alumno_id`, `fecha`, `valor`, `comentario`, `usuario_carga_id`, `fecha_creacion`, `fecha_actualizacion`, `validada`) VALUES (70,1,2,'2015-10-16 00:00:00',3,'6777',4,'2015-11-15 17:46:17','2015-11-15 17:47:22',NULL);
INSERT INTO `calificacion` (`id`, `evaluacion_id`, `alumno_id`, `fecha`, `valor`, `comentario`, `usuario_carga_id`, `fecha_creacion`, `fecha_actualizacion`, `validada`) VALUES (71,2,3,'2015-10-17 00:00:00',3,'',4,'2015-11-15 20:07:48',NULL,NULL);
INSERT INTO `calificacion` (`id`, `evaluacion_id`, `alumno_id`, `fecha`, `valor`, `comentario`, `usuario_carga_id`, `fecha_creacion`, `fecha_actualizacion`, `validada`) VALUES (72,2,1,'2015-10-17 00:00:00',1,'',4,'2015-11-15 20:07:48',NULL,NULL);
INSERT INTO `calificacion` (`id`, `evaluacion_id`, `alumno_id`, `fecha`, `valor`, `comentario`, `usuario_carga_id`, `fecha_creacion`, `fecha_actualizacion`, `validada`) VALUES (73,2,2,'2015-10-17 00:00:00',1,'',4,'2015-11-15 20:07:48',NULL,NULL);
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `convivencia`
--

LOCK TABLES `convivencia` WRITE;
/*!40000 ALTER TABLE `convivencia` DISABLE KEYS */;
INSERT INTO `convivencia` (`id`, `usuario_carga_id`, `alumno_id`, `comentario`, `descargo`, `fecha_suceso`, `validado`, `valor`, `fecha_creacion`, `fecha_actualizacion`) VALUES (1,4,1,'Estuvo muy bien',NULL,'2015-10-16 00:00:00',1,1,'0000-00-00 00:00:00',NULL);
INSERT INTO `convivencia` (`id`, `usuario_carga_id`, `alumno_id`, `comentario`, `descargo`, `fecha_suceso`, `validado`, `valor`, `fecha_creacion`, `fecha_actualizacion`) VALUES (2,NULL,1,'La pudrió groso',NULL,'2015-10-16 00:00:00',1,0,'0000-00-00 00:00:00',NULL);
INSERT INTO `convivencia` (`id`, `usuario_carga_id`, `alumno_id`, `comentario`, `descargo`, `fecha_suceso`, `validado`, `valor`, `fecha_creacion`, `fecha_actualizacion`) VALUES (3,NULL,1,'No aparece',NULL,'2015-10-16 00:00:00',0,NULL,'0000-00-00 00:00:00',NULL);
INSERT INTO `convivencia` (`id`, `usuario_carga_id`, `alumno_id`, `comentario`, `descargo`, `fecha_suceso`, `validado`, `valor`, `fecha_creacion`, `fecha_actualizacion`) VALUES (4,NULL,2,'otro alumno la pudrio',NULL,'2015-10-16 00:00:00',1,1,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `convivencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `docente`
--

LOCK TABLES `docente` WRITE;
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` (`id`, `usuario_id`, `nombre`, `apellido`, `dni`, `ciudad_id`, `direccion`, `codigo_postal`, `codigo_pais`, `codigo_area`, `telefono`, `titulo`, `fecha_ingreso`, `fecha_nacimiento`, `foto`, `es_titular`, `observaciones`, `establecimiento_id`, `creation_time`, `update_time`) VALUES (1,4,'Ana María','DaCol','4546325',NULL,NULL,NULL,NULL,NULL,'','Maestra Normal',NULL,NULL,NULL,1,NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `docente_materia`
--

LOCK TABLES `docente_materia` WRITE;
/*!40000 ALTER TABLE `docente_materia` DISABLE KEYS */;
INSERT INTO `docente_materia` (`id`, `materia_id`, `docente_id`, `creation_time`, `update_time`) VALUES (1,2,1,NULL,NULL);
INSERT INTO `docente_materia` (`id`, `materia_id`, `docente_id`, `creation_time`, `update_time`) VALUES (2,3,1,NULL,NULL);
/*!40000 ALTER TABLE `docente_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `especialidad`
--

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `esquema_calificacion`
--

LOCK TABLES `esquema_calificacion` WRITE;
/*!40000 ALTER TABLE `esquema_calificacion` DISABLE KEYS */;
INSERT INTO `esquema_calificacion` (`id`, `nombre`) VALUES (1,'General');
INSERT INTO `esquema_calificacion` (`id`, `nombre`) VALUES (2,'1 a 100');
INSERT INTO `esquema_calificacion` (`id`, `nombre`) VALUES (3,'F a A');
INSERT INTO `esquema_calificacion` (`id`, `nombre`) VALUES (4,'I a S');
INSERT INTO `esquema_calificacion` (`id`, `nombre`) VALUES (5,'Insuficiente a Sobresaliente');
INSERT INTO `esquema_calificacion` (`id`, `nombre`) VALUES (6,'1 a 10');
/*!40000 ALTER TABLE `esquema_calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` (`id`, `institucion_id`, `nombre`, `ciudad_id`, `direccion`, `codigo_postal`, `longitud`, `latitud`, `fecha_inauguracion`, `codigo_pais`, `codigo_area`, `telefono`, `email`, `observaciones`, `maximo_faltas`, `tardes_faltas`, `esquema_calificacion_id`, `creation_time`, `update_time`) VALUES (1,1,'America',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,30,4,4,NULL,NULL);
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` (`id`, `nombre`, `fecha`, `materia_id`, `docente_id`, `actividad_id`, `calificada`, `creation_time`, `update_time`) VALUES (1,'Parcial','2015-10-16 00:00:00',3,1,NULL,1,NULL,NULL);
INSERT INTO `evaluacion` (`id`, `nombre`, `fecha`, `materia_id`, `docente_id`, `actividad_id`, `calificada`, `creation_time`, `update_time`) VALUES (2,'Recuperatorio','2015-10-17 00:00:00',3,1,NULL,1,NULL,NULL);
INSERT INTO `evaluacion` (`id`, `nombre`, `fecha`, `materia_id`, `docente_id`, `actividad_id`, `calificada`, `creation_time`, `update_time`) VALUES (3,'TST -integrak','2015-11-15 17:52:21',3,1,NULL,0,NULL,NULL);
INSERT INTO `evaluacion` (`id`, `nombre`, `fecha`, `materia_id`, `docente_id`, `actividad_id`, `calificada`, `creation_time`, `update_time`) VALUES (4,'teset integrl','2015-11-15 19:23:07',3,1,NULL,0,NULL,NULL);
INSERT INTO `evaluacion` (`id`, `nombre`, `fecha`, `materia_id`, `docente_id`, `actividad_id`, `calificada`, `creation_time`, `update_time`) VALUES (5,'Test finañ','2015-11-15 19:25:17',3,1,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `evaluacion_archivo`
--

LOCK TABLES `evaluacion_archivo` WRITE;
/*!40000 ALTER TABLE `evaluacion_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluacion_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `grupo_alumno`
--

LOCK TABLES `grupo_alumno` WRITE;
/*!40000 ALTER TABLE `grupo_alumno` DISABLE KEYS */;
INSERT INTO `grupo_alumno` (`id`, `nombre`, `es_curso`, `creation_time`, `update_time`) VALUES (1,'4b',1,NULL,NULL);
INSERT INTO `grupo_alumno` (`id`, `nombre`, `es_curso`, `creation_time`, `update_time`) VALUES (2,'5a',0,NULL,NULL);
INSERT INTO `grupo_alumno` (`id`, `nombre`, `es_curso`, `creation_time`, `update_time`) VALUES (3,'mujeres 4to c',0,NULL,NULL);
/*!40000 ALTER TABLE `grupo_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `grupo_alumno_materia`
--

LOCK TABLES `grupo_alumno_materia` WRITE;
/*!40000 ALTER TABLE `grupo_alumno_materia` DISABLE KEYS */;
INSERT INTO `grupo_alumno_materia` (`id`, `materia_id`, `grupo_alumno_id`, `creation_time`, `update_time`) VALUES (1,3,1,NULL,NULL);
INSERT INTO `grupo_alumno_materia` (`id`, `materia_id`, `grupo_alumno_id`, `creation_time`, `update_time`) VALUES (2,3,2,NULL,NULL);
INSERT INTO `grupo_alumno_materia` (`id`, `materia_id`, `grupo_alumno_id`, `creation_time`, `update_time`) VALUES (3,2,3,NULL,NULL);
/*!40000 ALTER TABLE `grupo_alumno_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `grupo_usuario`
--

LOCK TABLES `grupo_usuario` WRITE;
/*!40000 ALTER TABLE `grupo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `institucion`
--

LOCK TABLES `institucion` WRITE;
/*!40000 ALTER TABLE `institucion` DISABLE KEYS */;
INSERT INTO `institucion` (`id`, `nombre`, `logo`, `cuit`, `creation_time`, `update_time`) VALUES (1,'America',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `institucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `justificacion`
--

LOCK TABLES `justificacion` WRITE;
/*!40000 ALTER TABLE `justificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `justificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`id`, `nombre`, `tipo_materia_id`, `creation_time`, `update_time`, `establecimiento_id`) VALUES (1,'Matematica 3ro B',1,NULL,NULL,NULL);
INSERT INTO `materia` (`id`, `nombre`, `tipo_materia_id`, `creation_time`, `update_time`, `establecimiento_id`) VALUES (2,'Matematica 4A',1,NULL,NULL,NULL);
INSERT INTO `materia` (`id`, `nombre`, `tipo_materia_id`, `creation_time`, `update_time`, `establecimiento_id`) VALUES (3,'Lengua 7 rojo',2,NULL,NULL,NULL);
INSERT INTO `materia` (`id`, `nombre`, `tipo_materia_id`, `creation_time`, `update_time`, `establecimiento_id`) VALUES (4,'Sociales 7mo rojo nombre largo',3,NULL,NULL,NULL);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `materia_archivo`
--

LOCK TABLES `materia_archivo` WRITE;
/*!40000 ALTER TABLE `materia_archivo` DISABLE KEYS */;
INSERT INTO `materia_archivo` (`id`, `materia_id`, `archivo_id`, `creation_time`, `update_time`) VALUES (1,3,1,NULL,NULL);
INSERT INTO `materia_archivo` (`id`, `materia_id`, `archivo_id`, `creation_time`, `update_time`) VALUES (2,3,2,NULL,NULL);
/*!40000 ALTER TABLE `materia_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `materia_dia_horario`
--

LOCK TABLES `materia_dia_horario` WRITE;
/*!40000 ALTER TABLE `materia_dia_horario` DISABLE KEYS */;
INSERT INTO `materia_dia_horario` (`id`, `materia_id`, `dia`, `hora_inicio`, `hora_fin`, `creation_time`, `update_time`) VALUES (1,2,'Lunes',1,3,NULL,NULL);
INSERT INTO `materia_dia_horario` (`id`, `materia_id`, `dia`, `hora_inicio`, `hora_fin`, `creation_time`, `update_time`) VALUES (2,2,'Miercoles',4,6,NULL,NULL);
INSERT INTO `materia_dia_horario` (`id`, `materia_id`, `dia`, `hora_inicio`, `hora_fin`, `creation_time`, `update_time`) VALUES (3,3,'Lunes',1,2,NULL,NULL);
INSERT INTO `materia_dia_horario` (`id`, `materia_id`, `dia`, `hora_inicio`, `hora_fin`, `creation_time`, `update_time`) VALUES (4,3,'Miércoles',3,12,NULL,NULL);
INSERT INTO `materia_dia_horario` (`id`, `materia_id`, `dia`, `hora_inicio`, `hora_fin`, `creation_time`, `update_time`) VALUES (5,3,'Sábado',2,3,NULL,NULL);
/*!40000 ALTER TABLE `materia_dia_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` (`id`, `usuario_id`, `titulo`, `texto`, `fecha_envio`) VALUES (4,4,'concha e tu ma','asdasdasdasdasdasdasd','2015-11-10 20:09:13');
INSERT INTO `mensaje` (`id`, `usuario_id`, `titulo`, `texto`, `fecha_envio`) VALUES (5,18,'RE: concha e tu ma','sasacasc','2015-11-10 20:09:58');
INSERT INTO `mensaje` (`id`, `usuario_id`, `titulo`, `texto`, `fecha_envio`) VALUES (6,4,'asfas','fasfasfasfaf','2015-11-10 20:12:04');
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mensaje_usuario`
--

LOCK TABLES `mensaje_usuario` WRITE;
/*!40000 ALTER TABLE `mensaje_usuario` DISABLE KEYS */;
INSERT INTO `mensaje_usuario` (`id`, `mensaje_id`, `usuario_id`, `leido`, `borrado`, `creation_time`, `update_time`) VALUES (4,4,18,1,1,'2015-11-10 20:09:13','2015-11-10 20:10:56');
INSERT INTO `mensaje_usuario` (`id`, `mensaje_id`, `usuario_id`, `leido`, `borrado`, `creation_time`, `update_time`) VALUES (5,5,4,1,0,'2015-11-10 20:09:58','2015-11-10 20:11:35');
INSERT INTO `mensaje_usuario` (`id`, `mensaje_id`, `usuario_id`, `leido`, `borrado`, `creation_time`, `update_time`) VALUES (6,6,4,1,0,'2015-11-10 20:12:04','2015-11-11 03:38:47');
/*!40000 ALTER TABLE `mensaje_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `notificacion_usuario`
--

LOCK TABLES `notificacion_usuario` WRITE;
/*!40000 ALTER TABLE `notificacion_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacion_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `padre`
--

LOCK TABLES `padre` WRITE;
/*!40000 ALTER TABLE `padre` DISABLE KEYS */;
INSERT INTO `padre` (`id`, `usuario_id`, `nombre`, `apellido`, `dni`, `ciudad_id`, `direccion`, `direccion_laboral`, `codigo_postal`, `codigo_pais`, `codigo_area`, `telefono`, `celular`, `telefono_laboral`, `ocupacion`, `observaciones`, `establecimiento_id`, `creation_time`, `update_time`) VALUES (1,20,'DIEGO','CASTA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `padre` (`id`, `usuario_id`, `nombre`, `apellido`, `dni`, `ciudad_id`, `direccion`, `direccion_laboral`, `codigo_postal`, `codigo_pais`, `codigo_area`, `telefono`, `celular`, `telefono_laboral`, `ocupacion`, `observaciones`, `establecimiento_id`, `creation_time`, `update_time`) VALUES (2,21,'MARCEA','CHIAPPE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `padre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `creation_time`, `update_time`) VALUES (1,'ROLE_ADMIN','Administrador del sistema',NULL,NULL);
INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `creation_time`, `update_time`) VALUES (2,'ROLE_PADRE','Representa a los padres de los alumnos. Hasta 2 por alumno',NULL,NULL);
INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `creation_time`, `update_time`) VALUES (3,'ROLE_ALUMNO','Uno por alumno',NULL,NULL);
INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `creation_time`, `update_time`) VALUES (4,'ROLE_DOCENTE','Uno por cada docente. Puede calificar.',NULL,NULL);
INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `creation_time`, `update_time`) VALUES (5,'ROLE_DIRECTIVO','Rol administrativo para las instituciones y establecimientos',NULL,NULL);
INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `creation_time`, `update_time`) VALUES (6,'ROLE_BEDEL','Puede tomar asistencia y accines disciplianrias, no puede calificar',NULL,NULL);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipo_materia`
--

LOCK TABLES `tipo_materia` WRITE;
/*!40000 ALTER TABLE `tipo_materia` DISABLE KEYS */;
INSERT INTO `tipo_materia` (`id`, `nombre`, `creation_time`, `update_time`) VALUES (1,'Matematica',NULL,NULL);
INSERT INTO `tipo_materia` (`id`, `nombre`, `creation_time`, `update_time`) VALUES (2,'lengua',NULL,NULL);
INSERT INTO `tipo_materia` (`id`, `nombre`, `creation_time`, `update_time`) VALUES (3,'sociales',NULL,NULL);
/*!40000 ALTER TABLE `tipo_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (1,'admin','admin',1,NULL,'admin@admin.com',NULL,NULL,1,'');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (2,'speacecraft','1',2,1,'padre@padre.con',NULL,NULL,1,'');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (3,'juancarlos','juancarlos',3,1,'alumno@alumno.com',NULL,NULL,1,'juanca');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (4,'anadacol','anadacol',4,1,'docente@docente.com',NULL,NULL,1,'anada');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (5,'dorita','dorita',5,NULL,'director@director.com',NULL,NULL,1,'');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (6,'maryrose','maryrose',6,NULL,'bedel@bedel.com',NULL,NULL,1,'');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (17,'GADI','1',3,2,NULL,NULL,NULL,1,'CASTA');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (18,'FEDE','1',3,1,NULL,NULL,NULL,1,'CASTA');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (19,'SEBI','1',3,3,NULL,NULL,NULL,1,'CASTA');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (20,'DIEGO','1',2,NULL,NULL,NULL,NULL,1,'CASTA');
INSERT INTO `usuario` (`id`, `nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`, `creation_time`, `update_time`, `institucion_id`, `apellido`) VALUES (21,'MARCELA','1',2,NULL,NULL,NULL,NULL,1,'CASTA');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario_actividad`
--

LOCK TABLES `usuario_actividad` WRITE;
/*!40000 ALTER TABLE `usuario_actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario_establecimiento`
--

LOCK TABLES `usuario_establecimiento` WRITE;
/*!40000 ALTER TABLE `usuario_establecimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario_grupo_usuario`
--

LOCK TABLES `usuario_grupo_usuario` WRITE;
/*!40000 ALTER TABLE `usuario_grupo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_grupo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `valor_calificacion`
--

LOCK TABLES `valor_calificacion` WRITE;
/*!40000 ALTER TABLE `valor_calificacion` DISABLE KEYS */;
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (1,1,'No Evaluado',0);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (2,1,'Ausente',2);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (3,4,'B',3);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (4,4,'MB',4);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (5,4,'S',5);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (8,6,'1',1);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (9,6,'2',2);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (10,6,'3',3);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (11,6,'4',4);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (12,6,'5',5);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (13,6,'6',6);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (14,6,'7',7);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (15,6,'8',8);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (16,6,'9',9);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (17,6,'10',10);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (19,4,'I',1);
INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES (20,4,'R',2);
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

-- Dump completed on 2015-11-24 10:13:49
