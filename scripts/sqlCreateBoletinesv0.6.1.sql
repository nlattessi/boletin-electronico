-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema boletines
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `boletines` ;

-- -----------------------------------------------------
-- Schema boletines
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `boletines` DEFAULT CHARACTER SET latin1 ;
USE `boletines` ;

-- -----------------------------------------------------
-- Table `boletines`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`rol` ;

CREATE TABLE IF NOT EXISTS `boletines`.`rol` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(15) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `descripcion` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`usuario` ;

CREATE TABLE IF NOT EXISTS `boletines`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `password` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `rol_id` INT(11) NULL DEFAULT NULL,
  `id_entidad_asociada` INT(11) NOT NULL,
  `email` VARCHAR(65) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_2265B05D90F1D76D` (`rol_id` ASC),
  CONSTRAINT `FK_2265B05D90F1D76D`
    FOREIGN KEY (`rol_id`)
    REFERENCES `boletines`.`rol` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`archivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`archivo` ;

CREATE TABLE IF NOT EXISTS `boletines`.`archivo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` INT(11) NULL DEFAULT NULL,
  `nombre_para_mostrar` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `ruta_archivo` VARCHAR(75) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `fecha_subida` DATETIME NOT NULL,
  `fecha_actualizacion` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_3529B4827FA0C10D` (`usuario_carga_id` ASC),
  CONSTRAINT `FK_3529B4827FA0C10D`
    FOREIGN KEY (`usuario_carga_id`)
    REFERENCES `boletines`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`institucion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`institucion` ;

CREATE TABLE IF NOT EXISTS `boletines`.`institucion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `logo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `cuit` VARCHAR(11) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`pais` ;

CREATE TABLE IF NOT EXISTS `boletines`.`pais` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`provincia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`provincia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`provincia` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `pais_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pais_provincia_idx` (`pais_id` ASC),
  CONSTRAINT `fk_pais_provincia`
    FOREIGN KEY (`pais_id`)
    REFERENCES `boletines`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`ciudad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`ciudad` ;

CREATE TABLE IF NOT EXISTS `boletines`.`ciudad` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `provincia_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_provincida_id` (`provincia_id` ASC),
  CONSTRAINT `FK_provincida_id`
    FOREIGN KEY (`provincia_id`)
    REFERENCES `boletines`.`provincia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`establecimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`establecimiento` ;

CREATE TABLE IF NOT EXISTS `boletines`.`establecimiento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `institucion_id` INT(11) NULL DEFAULT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `ciudad_id` INT(11) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codigo_postal` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `longitud` FLOAT NULL DEFAULT NULL,
  `latitud` FLOAT NULL DEFAULT NULL,
  `fecha_inauguracion` DATE NULL DEFAULT NULL,
  `codigo_pais` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codigo_area` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `telefono` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `observaciones` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_94A4D17EEF433A34` (`institucion_id` ASC),
  INDEX `fk_ciudad_establecimiento` (`ciudad_id` ASC),
  CONSTRAINT `FK_94A4D17EEF433A34`
    FOREIGN KEY (`institucion_id`)
    REFERENCES `boletines`.`institucion` (`id`),
  CONSTRAINT `fk_ciudad_establecimiento`
    FOREIGN KEY (`ciudad_id`)
    REFERENCES `boletines`.`ciudad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`actividad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`actividad` ;

CREATE TABLE IF NOT EXISTS `boletines`.`actividad` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` INT(11) NULL DEFAULT NULL,
  `archivo_id` INT(11) NULL DEFAULT NULL,
  `nombre` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `fecha_hora_inicio` DATETIME NOT NULL,
  `fecha_hora_fin` DATETIME NOT NULL,
  `institucion_id` INT(11) NULL DEFAULT NULL,
  `establecimiento_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NOT NULL,
  `update_time` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_usuario` (`usuario_carga_id` ASC),
  INDEX `FK_archivo_id` (`archivo_id` ASC),
  INDEX `FK_institucion_id` (`institucion_id` ASC),
  INDEX `FK_establecimiento_id` (`establecimiento_id` ASC),
  CONSTRAINT `FK_usuario`
    FOREIGN KEY (`usuario_carga_id`)
    REFERENCES `boletines`.`usuario` (`id`),
  CONSTRAINT `FK_archivo_id`
    FOREIGN KEY (`archivo_id`)
    REFERENCES `boletines`.`archivo` (`id`),
  CONSTRAINT `FK_institucion_id`
    FOREIGN KEY (`institucion_id`)
    REFERENCES `boletines`.`institucion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_establecimiento_id`
    FOREIGN KEY (`establecimiento_id`)
    REFERENCES `boletines`.`establecimiento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`padre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`padre` ;

CREATE TABLE IF NOT EXISTS `boletines`.`padre` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NULL DEFAULT NULL,
  `nombre` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `apellido` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `dni` VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `ciudad_id` INT(11) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `direccion_laboral` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codigo_postal` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codigo_pais` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codio_area` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `telefono` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `celular` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `telefono_laboral` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `ocupacion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `observaciones` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `establecimiento_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NOT NULL,
  `update_time` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_usuario_padre` (`usuario_id` ASC),
  INDEX `fk_ciudad_padre` (`ciudad_id` ASC),
  CONSTRAINT `FK_usuario_padre`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`),
  CONSTRAINT `fk_ciudad_padre`
    FOREIGN KEY (`ciudad_id`)
    REFERENCES `boletines`.`ciudad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno` ;

CREATE TABLE IF NOT EXISTS `boletines`.`alumno` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `nombre` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `apellido` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `dni` VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `ciudad_id` INT(11) NOT NULL,
  `direccion` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `codigo_postal` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `telefono_codigo_pais` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `telefono_codigo_area` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `telefono` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `nacionalidad` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `sexo` CHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `padre1_id` INT(11) NOT NULL,
  `padre2_id` INT(11) NOT NULL,
  `obra_social` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `obra_social_numero_afiliado` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `telefono_emergencia` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `apodo` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `foto` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `avatar_id` INT(11) NULL DEFAULT NULL,
  `fecha_ingreso` DATE NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `especialidad_id` INT(11) NULL DEFAULT NULL,
  `observaciones` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `establecimiento_id` INT(11) NOT NULL,
  `creation_time` DATETIME NOT NULL,
  `update_time` DATETIME NOT NULL,
  `grupo_sanguineo` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_usuario_id` (`usuario_id` ASC),
  INDEX `FK_direccion_ciudad_id` (`ciudad_id` ASC),
  INDEX `FK_padre_1_id` (`padre1_id` ASC),
  INDEX `FK_padre_2_id` (`padre2_id` ASC),
  CONSTRAINT `FK_usuario_id`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_direccion_ciudad_id`
    FOREIGN KEY (`ciudad_id`)
    REFERENCES `boletines`.`ciudad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_padre_1_id`
    FOREIGN KEY (`padre1_id`)
    REFERENCES `boletines`.`padre` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_padre_2_id`
    FOREIGN KEY (`padre2_id`)
    REFERENCES `boletines`.`padre` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`justificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`justificacion` ;

CREATE TABLE IF NOT EXISTS `boletines`.`justificacion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `comentario` VARCHAR(250) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `usuario_carga_id` INT(11) NULL DEFAULT NULL,
  `archivo_id` INT(11) NULL DEFAULT NULL,
  `fecha_carga` DATETIME NOT NULL,
  `fecha_modificacion` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_EBF13A877FA0C10D` (`usuario_carga_id` ASC),
  INDEX `FK_EBF13A87EBB41DF2` (`archivo_id` ASC),
  CONSTRAINT `FK_EBF13A877FA0C10D`
    FOREIGN KEY (`usuario_carga_id`)
    REFERENCES `boletines`.`usuario` (`id`),
  CONSTRAINT `FK_EBF13A87EBB41DF2`
    FOREIGN KEY (`archivo_id`)
    REFERENCES `boletines`.`archivo` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`tipo_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`tipo_materia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`tipo_materia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`materia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`materia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `tipo_materia_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_6DF052845DC80656` (`tipo_materia_id` ASC),
  CONSTRAINT `FK_6DF052845DC80656`
    FOREIGN KEY (`tipo_materia_id`)
    REFERENCES `boletines`.`tipo_materia` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`asistencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`asistencia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`asistencia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_cargador_id` INT(11) NOT NULL,
  `materia_id` INT(11) NULL DEFAULT NULL,
  `fecha` DATE NOT NULL,
  `fecha_carga` DATETIME NOT NULL,
  `fecha_actualizacion` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_D8264A8DB36DFBF4` (`materia_id` ASC),
  INDEX `FK_D8264A8DE01E0B5D` (`usuario_cargador_id` ASC),
  CONSTRAINT `FK_D8264A8DB36DFBF4`
    FOREIGN KEY (`materia_id`)
    REFERENCES `boletines`.`materia` (`id`),
  CONSTRAINT `FK_D8264A8DE01E0B5D`
    FOREIGN KEY (`usuario_cargador_id`)
    REFERENCES `boletines`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`alumno_asistencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno_asistencia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`alumno_asistencia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `justificacion_id` INT(11) NULL DEFAULT NULL,
  `asistencia_id` INT(11) NULL DEFAULT NULL,
  `alumno_id` INT(11) NULL DEFAULT NULL,
  `valor` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_D30A8664320260C0` (`alumno_id` ASC),
  INDEX `FK_D30A866455D9EBE2` (`justificacion_id` ASC),
  INDEX `FK_D30A86647DACCA5A` (`asistencia_id` ASC),
  CONSTRAINT `FK_D30A8664320260C0`
    FOREIGN KEY (`alumno_id`)
    REFERENCES `boletines`.`alumno` (`id`),
  CONSTRAINT `FK_D30A866455D9EBE2`
    FOREIGN KEY (`justificacion_id`)
    REFERENCES `boletines`.`justificacion` (`id`),
  CONSTRAINT `FK_D30A86647DACCA5A`
    FOREIGN KEY (`asistencia_id`)
    REFERENCES `boletines`.`asistencia` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`grupo_alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`grupo_alumno` ;

CREATE TABLE IF NOT EXISTS `boletines`.`grupo_alumno` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `es_curso` TINYINT(1) NOT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`alumno_grupo_alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno_grupo_alumno` ;

CREATE TABLE IF NOT EXISTS `boletines`.`alumno_grupo_alumno` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `grupo_alumno_id` INT(11) NOT NULL,
  `alumno_id` INT(11) NOT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_55DB706320260C0` (`alumno_id` ASC),
  INDEX `FK_55DB706628BDAE3` (`grupo_alumno_id` ASC),
  CONSTRAINT `FK_55DB706320260C0`
    FOREIGN KEY (`alumno_id`)
    REFERENCES `boletines`.`alumno` (`id`),
  CONSTRAINT `FK_55DB706628BDAE3`
    FOREIGN KEY (`grupo_alumno_id`)
    REFERENCES `boletines`.`grupo_alumno` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`alumno_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno_materia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`alumno_materia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `materia_id` INT(11) NULL DEFAULT NULL,
  `alumno_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_43E74FC0320260C0` (`alumno_id` ASC),
  INDEX `FK_43E74FC0B36DFBF4` (`materia_id` ASC),
  CONSTRAINT `FK_43E74FC0320260C0`
    FOREIGN KEY (`alumno_id`)
    REFERENCES `boletines`.`alumno` (`id`),
  CONSTRAINT `FK_43E74FC0B36DFBF4`
    FOREIGN KEY (`materia_id`)
    REFERENCES `boletines`.`materia` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`avatar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`avatar` ;

CREATE TABLE IF NOT EXISTS `boletines`.`avatar` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `path` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`docente` ;

CREATE TABLE IF NOT EXISTS `boletines`.`docente` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NULL DEFAULT NULL,
  `nombre` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `apellido` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `dni` VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `ciudad_id` INT(11) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codigo_postal` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codigo_pais` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `codio_area` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `telefono` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `titulo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `fecha_ingreso` DATE NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `foto` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `es_titular` TINYINT(1) NULL DEFAULT NULL,
  `observaciones` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `establecimiento_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NOT NULL,
  `update_time` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_FD9FCFA4FCF8192D` (`usuario_id` ASC),
  INDEX `fk_ciudad_docente` (`ciudad_id` ASC),
  CONSTRAINT `FK_FD9FCFA4FCF8192D`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`),
  CONSTRAINT `fk_ciudad_docente`
    FOREIGN KEY (`ciudad_id`)
    REFERENCES `boletines`.`ciudad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`evaluacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`evaluacion` ;

CREATE TABLE IF NOT EXISTS `boletines`.`evaluacion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `fecha` DATETIME NOT NULL,
  `materia_id` INT(11) NULL DEFAULT NULL,
  `docente_id` INT(11) NULL DEFAULT NULL,
  `actividad_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_514C8FEC230266D4` (`docente_id` ASC),
  INDEX `FK_514C8FECB36DFBF4` (`materia_id` ASC),
  INDEX `FK_514C8FECDC70121` (`actividad_id` ASC),
  CONSTRAINT `FK_514C8FEC230266D4`
    FOREIGN KEY (`docente_id`)
    REFERENCES `boletines`.`docente` (`id`),
  CONSTRAINT `FK_514C8FECB36DFBF4`
    FOREIGN KEY (`materia_id`)
    REFERENCES `boletines`.`materia` (`id`),
  CONSTRAINT `FK_514C8FECDC70121`
    FOREIGN KEY (`actividad_id`)
    REFERENCES `boletines`.`actividad` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`calificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`calificacion` ;

CREATE TABLE IF NOT EXISTS `boletines`.`calificacion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` INT(11) NULL DEFAULT NULL,
  `alumno_id` INT(11) NULL DEFAULT NULL,
  `fecha` DATETIME NULL DEFAULT NULL,
  `valor` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `comentario` VARCHAR(127) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `validada` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `usuario_carga_id` INT(11) NULL DEFAULT NULL,
  `fecha_creacion` DATETIME NULL DEFAULT NULL,
  `fecha_actualizacion` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_8A3AF218320260C0` (`alumno_id` ASC),
  INDEX `fk_calificacion_evaluacion` (`evaluacion_id` ASC),
  INDEX `fk_usuario_calificacion_idx` (`usuario_carga_id` ASC),
  CONSTRAINT `FK_8A3AF218320260C0`
    FOREIGN KEY (`alumno_id`)
    REFERENCES `boletines`.`alumno` (`id`),
  CONSTRAINT `fk_calificacion_evaluacion`
    FOREIGN KEY (`evaluacion_id`)
    REFERENCES `boletines`.`evaluacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_calificacion`
    FOREIGN KEY (`usuario_carga_id`)
    REFERENCES `boletines`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`convivencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`convivencia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`convivencia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` INT(11) NULL DEFAULT NULL,
  `alumno_id` INT(11) NULL DEFAULT NULL,
  `comentario` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `descargo` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `fecha_suceso` DATETIME NOT NULL,
  `validado` TINYINT(1) NULL DEFAULT NULL,
  `valor` TINYINT(1) NULL DEFAULT '0',
  `fecha_creacion` DATETIME NOT NULL,
  `fecha_actualizacion` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_72D32A26320260C0` (`alumno_id` ASC),
  INDEX `FK_72D32A26230266D4` (`usuario_carga_id` ASC),
  CONSTRAINT `FK_72D32A26230266D4`
    FOREIGN KEY (`usuario_carga_id`)
    REFERENCES `boletines`.`usuario` (`id`),
  CONSTRAINT `FK_72D32A26320260C0`
    FOREIGN KEY (`alumno_id`)
    REFERENCES `boletines`.`alumno` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`docente_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`docente_materia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`docente_materia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `materia_id` INT(11) NULL DEFAULT NULL,
  `docente_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_517E8597230266D4` (`docente_id` ASC),
  INDEX `FK_517E8597B36DFBF4` (`materia_id` ASC),
  CONSTRAINT `FK_517E8597230266D4`
    FOREIGN KEY (`docente_id`)
    REFERENCES `boletines`.`docente` (`id`),
  CONSTRAINT `FK_517E8597B36DFBF4`
    FOREIGN KEY (`materia_id`)
    REFERENCES `boletines`.`materia` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`especialidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`especialidad` ;

CREATE TABLE IF NOT EXISTS `boletines`.`especialidad` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `descripcion` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`evaluacion_archivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`evaluacion_archivo` ;

CREATE TABLE IF NOT EXISTS `boletines`.`evaluacion_archivo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` INT(11) NULL DEFAULT NULL,
  `archivo_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_96A9D3A6EBB41DF2` (`archivo_id` ASC),
  INDEX `FK_96A9D3A6777B3A01` (`evaluacion_id` ASC),
  CONSTRAINT `FK_96A9D3A6777B3A01`
    FOREIGN KEY (`evaluacion_id`)
    REFERENCES `boletines`.`evaluacion` (`id`),
  CONSTRAINT `FK_96A9D3A6EBB41DF2`
    FOREIGN KEY (`archivo_id`)
    REFERENCES `boletines`.`archivo` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`grupo_alumno_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`grupo_alumno_materia` ;

CREATE TABLE IF NOT EXISTS `boletines`.`grupo_alumno_materia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `materia_id` INT(11) NULL DEFAULT NULL,
  `grupo_alumno_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_7B2FAA0D3BF20F66` (`grupo_alumno_id` ASC),
  INDEX `FK_7B2FAA0DB36DFBF4` (`materia_id` ASC),
  CONSTRAINT `FK_7B2FAA0D3BF20F66`
    FOREIGN KEY (`grupo_alumno_id`)
    REFERENCES `boletines`.`grupo_alumno` (`id`),
  CONSTRAINT `FK_7B2FAA0DB36DFBF4`
    FOREIGN KEY (`materia_id`)
    REFERENCES `boletines`.`materia` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`grupo_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`grupo_usuario` ;

CREATE TABLE IF NOT EXISTS `boletines`.`grupo_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_carga_id` INT(11) NULL DEFAULT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `es_privado` TINYINT(1) NOT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_7D6C3EFA7FA0C10D` (`usuario_carga_id` ASC),
  CONSTRAINT `FK_7D6C3EFA7FA0C10D`
    FOREIGN KEY (`usuario_carga_id`)
    REFERENCES `boletines`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`materia_archivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`materia_archivo` ;

CREATE TABLE IF NOT EXISTS `boletines`.`materia_archivo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `materia_id` INT(11) NULL DEFAULT NULL,
  `archivo_id` INT(11) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_566A8CA4B36DFBF4` (`materia_id` ASC),
  INDEX `FK_566A8CA4EBB41DF2` (`archivo_id` ASC),
  CONSTRAINT `FK_566A8CA4B36DFBF4`
    FOREIGN KEY (`materia_id`)
    REFERENCES `boletines`.`materia` (`id`),
  CONSTRAINT `FK_566A8CA4EBB41DF2`
    FOREIGN KEY (`archivo_id`)
    REFERENCES `boletines`.`archivo` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`materia_dia_horario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`materia_dia_horario` ;

CREATE TABLE IF NOT EXISTS `boletines`.`materia_dia_horario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `materia_id` INT(11) NULL DEFAULT NULL,
  `dia` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `hora_inicio` INT(11) NOT NULL,
  `hora_fin` INT(11) NOT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_BE9CEB52B36DFBF4` (`materia_id` ASC),
  CONSTRAINT `FK_BE9CEB52B36DFBF4`
    FOREIGN KEY (`materia_id`)
    REFERENCES `boletines`.`materia` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`mensaje`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`mensaje` ;

CREATE TABLE IF NOT EXISTS `boletines`.`mensaje` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NULL DEFAULT NULL,
  `titulo` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `texto` VARCHAR(500) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `fecha_envio` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_9B631D0165089FEB` (`usuario_id` ASC),
  CONSTRAINT `FK_9B631D0165089FEB`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`mensaje_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`mensaje_usuario` ;

CREATE TABLE IF NOT EXISTS `boletines`.`mensaje_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `mensaje_id` INT(11) NULL DEFAULT NULL,
  `usuario_id` INT(11) NULL DEFAULT NULL,
  `leido` TINYINT(1) NULL DEFAULT NULL,
  `borrado` TINYINT(1) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sfsdfsdfsdf_idx` (`mensaje_id` ASC),
  INDEX `fk_qwqwqwqqw_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_qwqwqwqqw`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sfsdfsdfsdf`
    FOREIGN KEY (`mensaje_id`)
    REFERENCES `boletines`.`mensaje` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `boletines`.`notificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`notificacion` ;

CREATE TABLE IF NOT EXISTS `boletines`.`notificacion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `texto` VARCHAR(500) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `fecha_envio` DATETIME NOT NULL,
  `url` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`notificacion_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`notificacion_usuario` ;

CREATE TABLE IF NOT EXISTS `boletines`.`notificacion_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `notificacion_id` INT(11) NULL DEFAULT NULL,
  `usuario_id` INT(11) NULL DEFAULT NULL,
  `notificado` TINYINT(1) NULL DEFAULT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_not_usuario_idx` (`notificacion_id` ASC),
  INDEX `fk_usuario_not_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_not_usuario`
    FOREIGN KEY (`notificacion_id`)
    REFERENCES `boletines`.`notificacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_not`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `boletines`.`token`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`token` ;

CREATE TABLE IF NOT EXISTS `boletines`.`token` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `token` VARCHAR(45) NOT NULL,
  `expiration_time` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_token_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_usuario_token`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `boletines`.`usuario_establecimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`usuario_establecimiento` ;

CREATE TABLE IF NOT EXISTS `boletines`.`usuario_establecimiento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `establecimiento_id` INT(11) NULL DEFAULT NULL,
  `usuario_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_7110F23F7DFA12F6` (`establecimiento_id` ASC),
  INDEX `FK_7110F23FFCF8192D` (`usuario_id` ASC),
  CONSTRAINT `FK_7110F23F7DFA12F6`
    FOREIGN KEY (`establecimiento_id`)
    REFERENCES `boletines`.`establecimiento` (`id`),
  CONSTRAINT `FK_7110F23FFCF8192D`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `boletines`.`usuario_grupo_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`usuario_grupo_usuario` ;

CREATE TABLE IF NOT EXISTS `boletines`.`usuario_grupo_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `grupo_usuario_id` INT(11) NOT NULL,
  `creation_time` DATETIME NULL DEFAULT NULL,
  `update_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `IDX_8BDF2024FCF8192D` (`usuario_id` ASC),
  INDEX `IDX_8BDF2024C344EF9F` (`grupo_usuario_id` ASC),
  CONSTRAINT `FK_8BDF2024C344EF9F`
    FOREIGN KEY (`grupo_usuario_id`)
    REFERENCES `boletines`.`grupo_usuario` (`id`),
  CONSTRAINT `FK_8BDF2024FCF8192D`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `boletines`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
