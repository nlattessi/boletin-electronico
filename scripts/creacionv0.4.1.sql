SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `boletines` DEFAULT CHARACTER SET utf8 ;
USE `boletines` ;

-- -----------------------------------------------------
-- Table `boletines`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`usuario` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_usuario` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `nombre_usuario_para_mostrar` VARCHAR(45) NOT NULL ,
  `nombre_real` VARCHAR(45) NULL DEFAULT NULL ,
  `telefono_usuario` VARCHAR(15) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_usuario`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`archivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`archivo` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`archivo` (
  `id_archivo` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_para_mostrar` VARCHAR(45) NOT NULL ,
  `nombre_archivo` VARCHAR(45) NOT NULL ,
  `ruta_archivo` VARCHAR(75) NOT NULL ,
  `id_usuario_carga` INT(11) NOT NULL ,
  `fecha_subida` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_archivo`) ,
  INDEX `usuario_fk_archivo` (`id_usuario_carga` ASC) ,
  CONSTRAINT `usuario_fk_archivo`
    FOREIGN KEY (`id_usuario_carga` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`actividad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`actividad` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`actividad` (
  `id_actividad` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario_creador` INT(11) NOT NULL ,
  `nombre_actividad` VARCHAR(45) NOT NULL ,
  `descripcion_actividad` VARCHAR(500) NOT NULL ,
  `fecha_desde` DATETIME NOT NULL ,
  `fecha_hasta` DATETIME NOT NULL ,
  `id_archivo` INT(11) NULL DEFAULT NULL ,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_actividad`) ,
  INDEX `usuario_fk_actividad` (`id_usuario_creador` ASC) ,
  INDEX `archivo_fk_actividad` (`id_archivo` ASC) ,
  CONSTRAINT `archivo_fk_actividad`
    FOREIGN KEY (`id_archivo` )
    REFERENCES `boletines`.`archivo` (`id_archivo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_fk_actividad`
    FOREIGN KEY (`id_usuario_creador` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`alumno` (
  `id_alumno` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_alumno` VARCHAR(45) NOT NULL ,
  `id_usuario_padre1` INT(11) NULL DEFAULT NULL ,
  `id_usuario_padre2` INT(11) NULL DEFAULT NULL ,
  `id_usuario_alumno` INT(11) NOT NULL ,
  PRIMARY KEY (`id_alumno`) ,
  INDEX `padre2_fk_alumno` (`id_usuario_padre2` ASC) ,
  INDEX `usuarior_fk_alumno` (`id_usuario_alumno` ASC) ,
  INDEX `padre1_fk_alumno` (`id_usuario_padre1` ASC) ,
  CONSTRAINT `padre2_fk_alumno`
    FOREIGN KEY (`id_usuario_padre2` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `padre1_fk_alumno`
    FOREIGN KEY (`id_usuario_padre1` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_fk_alumno`
    FOREIGN KEY (`id_usuario_alumno` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`calendario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`calendario` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`calendario` (
  `id_calendario` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario_propietario` INT(11) NOT NULL ,
  `nombre_calendario` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_calendario`) ,
  INDEX `usuario_fk_calendario` (`id_usuario_propietario` ASC) ,
  CONSTRAINT `usuario_fk_calendario`
    FOREIGN KEY (`id_usuario_propietario` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`tipo_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`tipo_materia` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`tipo_materia` (
  `id_tipo_materia` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_tipo_materia` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_tipo_materia`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`materia` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`materia` (
  `id_materia` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_materia` VARCHAR(45) NOT NULL ,
  `id_tipo_materia` INT(11) NOT NULL ,
  `id_calendario_materia` INT(11) NOT NULL ,
  PRIMARY KEY (`id_materia`) ,
  INDEX `calendario_fk_materia` (`id_calendario_materia` ASC) ,
  INDEX `tipo_materia_fk_materia` (`id_tipo_materia` ASC) ,
  CONSTRAINT `calendario_fk_materia`
    FOREIGN KEY (`id_calendario_materia` )
    REFERENCES `boletines`.`calendario` (`id_calendario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tipo_materia_fk_materia`
    FOREIGN KEY (`id_tipo_materia` )
    REFERENCES `boletines`.`tipo_materia` (`id_tipo_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`asistencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`asistencia` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`asistencia` (
  `id_asistencia` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_materia` INT(11) NOT NULL ,
  `fecha_asistencia` DATETIME NOT NULL ,
  `id_usuario_cargador` INT(11) NOT NULL ,
  `fecha_carga` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_asistencia`) ,
  INDEX `materia_fk_asistencia` (`id_materia` ASC) ,
  INDEX `usuario_fk_asistencia` (`id_usuario_cargador` ASC) ,
  CONSTRAINT `materia_fk_asistencia`
    FOREIGN KEY (`id_materia` )
    REFERENCES `boletines`.`materia` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_fk_asistencia`
    FOREIGN KEY (`id_usuario_cargador` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`justificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`justificacion` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`justificacion` (
  `id_justificacion` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario_carga` INT(11) NOT NULL ,
  `fecha_carga` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `justificacion` VARCHAR(255) NOT NULL ,
  `id_archivo` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_justificacion`) ,
  INDEX `usuario_fk_justificacion` (`id_usuario_carga` ASC) ,
  INDEX `archivo_fk_justificacion` (`id_archivo` ASC) ,
  CONSTRAINT `archivo_fk_justificacion`
    FOREIGN KEY (`id_archivo` )
    REFERENCES `boletines`.`archivo` (`id_archivo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_fk_justificacion`
    FOREIGN KEY (`id_usuario_carga` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`alumno_asistencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno_asistencia` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`alumno_asistencia` (
  `id_alumno_asistencia` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_alumno` INT(11) NOT NULL ,
  `id_asistencia` INT(11) NOT NULL ,
  `valor_asistencia` CHAR(1) NOT NULL DEFAULT 'P' ,
  `id_justificacion` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_alumno_asistencia`) ,
  INDEX `alumno_fk_asistencia` (`id_alumno` ASC) ,
  INDEX `asistencia_fk_alumno` (`id_asistencia` ASC) ,
  INDEX `justificacion_fk_alumno` (`id_justificacion` ASC) ,
  CONSTRAINT `alumno_fk_asistencia`
    FOREIGN KEY (`id_alumno` )
    REFERENCES `boletines`.`alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `asistencia_fk_alumno`
    FOREIGN KEY (`id_asistencia` )
    REFERENCES `boletines`.`asistencia` (`id_asistencia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `justificacion_fk_alumno`
    FOREIGN KEY (`id_justificacion` )
    REFERENCES `boletines`.`justificacion` (`id_justificacion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`grupo_alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`grupo_alumno` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`grupo_alumno` (
  `id_grupo_alumno` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_grupo_alumno` VARCHAR(45) NOT NULL ,
  `es_curso` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id_grupo_alumno`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`alumno_grupo_alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno_grupo_alumno` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`alumno_grupo_alumno` (
  `id_alumno_grupo_alumno` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_alumno` INT(11) NOT NULL ,
  `id_grupo` INT(11) NOT NULL ,
  PRIMARY KEY (`id_alumno_grupo_alumno`) ,
  INDEX `alumno_fk_grupo_alumno_idx` (`id_alumno` ASC) ,
  INDEX `grupo_alumno_fk_alumno_idx` (`id_grupo` ASC) ,
  CONSTRAINT `alumno_fk_grupo_alumno`
    FOREIGN KEY (`id_alumno` )
    REFERENCES `boletines`.`alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `grupo_alumno_fk_alumno`
    FOREIGN KEY (`id_grupo` )
    REFERENCES `boletines`.`grupo_alumno` (`id_grupo_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`alumno_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`alumno_materia` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`alumno_materia` (
  `id_alumno_materia` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_alumno` INT(11) NOT NULL ,
  `id_materia` INT(11) NOT NULL ,
  PRIMARY KEY (`id_alumno_materia`) ,
  INDEX `alumno_fk_materia_idx` (`id_alumno` ASC) ,
  INDEX `materia_fk_alumno_idx` (`id_materia` ASC) ,
  CONSTRAINT `alumno_fk_materia`
    FOREIGN KEY (`id_alumno` )
    REFERENCES `boletines`.`alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materia_fk_alumno`
    FOREIGN KEY (`id_materia` )
    REFERENCES `boletines`.`materia` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`calendario_actividad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`calendario_actividad` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`calendario_actividad` (
  `id_calendario_actividad` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_calendario` INT(11) NOT NULL ,
  `id_actividad` INT(11) NOT NULL ,
  PRIMARY KEY (`id_calendario_actividad`) ,
  INDEX `calendario_fk_actividad` (`id_calendario` ASC) ,
  INDEX `actividad_fk_calendario` (`id_actividad` ASC) ,
  CONSTRAINT `actividad_fk_calendario`
    FOREIGN KEY (`id_actividad` )
    REFERENCES `boletines`.`actividad` (`id_actividad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `calendario_fk_actividad`
    FOREIGN KEY (`id_calendario` )
    REFERENCES `boletines`.`calendario` (`id_calendario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`docente` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`docente` (
  `id_docente` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_docente` VARCHAR(45) NOT NULL ,
  `email_docente` VARCHAR(45) NOT NULL ,
  `telefono_docente` VARCHAR(45) NOT NULL ,
  `id_usuario` INT(11) NOT NULL ,
  PRIMARY KEY (`id_docente`) ,
  INDEX `usuario_fk_docente` (`id_usuario` ASC) ,
  CONSTRAINT `usuario_fk_docente`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`examen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`examen` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`examen` (
  `id_examen` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_examen` VARCHAR(45) NOT NULL ,
  `fecha_examen` DATETIME NOT NULL ,
  `id_docente` INT(11) NOT NULL ,
  `id_materia` INT(11) NOT NULL ,
  `id_actividad` INT(11) NOT NULL ,
  PRIMARY KEY (`id_examen`) ,
  INDEX `docente_fk_examen` (`id_docente` ASC) ,
  INDEX `materia_fk_examen` (`id_materia` ASC) ,
  INDEX `actividad_fk_examen` (`id_actividad` ASC) ,
  CONSTRAINT `actividad_fk_examen`
    FOREIGN KEY (`id_actividad` )
    REFERENCES `boletines`.`actividad` (`id_actividad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `docente_fk_examen`
    FOREIGN KEY (`id_docente` )
    REFERENCES `boletines`.`docente` (`id_docente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materia_fk_examen`
    FOREIGN KEY (`id_materia` )
    REFERENCES `boletines`.`materia` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`calificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`calificacion` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`calificacion` (
  `id_calificacion` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_alumno` INT(11) NOT NULL ,
  `id_examen` INT(11) NOT NULL ,
  `fecha_calificacion` DATETIME NULL DEFAULT NULL ,
  `valor_calificacion` VARCHAR(10) NULL DEFAULT NULL ,
  `comentario_calificacion` VARCHAR(127) NULL DEFAULT NULL ,
  `validada` VARCHAR(1) NOT NULL DEFAULT 'N' ,
  PRIMARY KEY (`id_calificacion`) ,
  INDEX `alumno_fk_examen_idx` (`id_alumno` ASC) ,
  INDEX `examen_fk_calificacion_idx` (`id_examen` ASC) ,
  CONSTRAINT `alumno_fk_calificacion`
    FOREIGN KEY (`id_alumno` )
    REFERENCES `boletines`.`alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `examen_fk_calificacion`
    FOREIGN KEY (`id_examen` )
    REFERENCES `boletines`.`examen` (`id_examen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`disciplina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`disciplina` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`disciplina` (
  `id_disciplina` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_alumno` INT(11) NOT NULL ,
  `id_docente` INT(11) NOT NULL ,
  `comentario_docente` VARCHAR(255) NOT NULL ,
  `descargo_alumno` VARCHAR(255) NULL DEFAULT NULL ,
  `fecha_suceso` DATETIME NOT NULL ,
  `fecha_carga` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `validado` TINYINT(1) NULL DEFAULT '0' ,
  PRIMARY KEY (`id_disciplina`) ,
  INDEX `alumno_fk_disciplina` (`id_alumno` ASC) ,
  INDEX `docente_fk_disciplina` (`id_docente` ASC) ,
  CONSTRAINT `alumno_fk_disciplina`
    FOREIGN KEY (`id_alumno` )
    REFERENCES `boletines`.`alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `docente_fk_disciplina`
    FOREIGN KEY (`id_docente` )
    REFERENCES `boletines`.`docente` (`id_docente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`docente_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`docente_materia` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`docente_materia` (
  `id_docente_materia` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_docente` INT(11) NOT NULL ,
  `id_materia` INT(11) NOT NULL ,
  PRIMARY KEY (`id_docente_materia`) ,
  INDEX `docente_fk_materia_idx` (`id_docente` ASC) ,
  INDEX `materia_fk_docente_idx` (`id_materia` ASC) ,
  CONSTRAINT `docente_fk_materia`
    FOREIGN KEY (`id_docente` )
    REFERENCES `boletines`.`docente` (`id_docente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materia_fk_docente`
    FOREIGN KEY (`id_materia` )
    REFERENCES `boletines`.`materia` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`institucion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`institucion` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`institucion` (
  `id_institucion` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_institucion` VARCHAR(45) NOT NULL ,
  `direccion_institucion` VARCHAR(45) NOT NULL ,
  `telefono_institucion` VARCHAR(45) NULL DEFAULT NULL ,
  `email_institucion` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_institucion`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`establecimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`establecimiento` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`establecimiento` (
  `id_establecimiento` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_establecimiento` VARCHAR(45) NOT NULL ,
  `direccion_establecimiento` VARCHAR(45) NULL DEFAULT NULL ,
  `telefono_establecimiento` VARCHAR(45) NULL DEFAULT NULL ,
  `email_establecimiento` VARCHAR(45) NULL DEFAULT NULL ,
  `id_institucion` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_establecimiento`) ,
  INDEX `institucion_fk_establecimiento` (`id_institucion` ASC) ,
  CONSTRAINT `institucion_fk_establecimiento`
    FOREIGN KEY (`id_institucion` )
    REFERENCES `boletines`.`institucion` (`id_institucion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`examen_archivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`examen_archivo` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`examen_archivo` (
  `id_examen_archivo` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_examen` INT(11) NOT NULL ,
  `id_archivo` INT(11) NOT NULL ,
  PRIMARY KEY (`id_examen_archivo`) ,
  INDEX `examen_fk_archivo` (`id_examen` ASC) ,
  INDEX `archivo_fk_examen` (`id_archivo` ASC) ,
  CONSTRAINT `archivo_fk_examen`
    FOREIGN KEY (`id_archivo` )
    REFERENCES `boletines`.`archivo` (`id_archivo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `examen_fk_archivo`
    FOREIGN KEY (`id_examen` )
    REFERENCES `boletines`.`examen` (`id_examen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`grupo_alumno_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`grupo_alumno_materia` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`grupo_alumno_materia` (
  `id_grupo_alumno_materia` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_grupo_alumno` INT(11) NOT NULL ,
  `id_materia` INT(11) NOT NULL ,
  PRIMARY KEY (`id_grupo_alumno_materia`) ,
  INDEX `grupo_alumno_fk_materia_idx` (`id_grupo_alumno` ASC) ,
  INDEX `materia_fk_grupo_alumno_idx` (`id_materia` ASC) ,
  CONSTRAINT `grupo_alumno_fk_materia`
    FOREIGN KEY (`id_grupo_alumno` )
    REFERENCES `boletines`.`grupo_alumno` (`id_grupo_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materia_fk_grupo_alumno`
    FOREIGN KEY (`id_materia` )
    REFERENCES `boletines`.`materia` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`grupo_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`grupo_usuario` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`grupo_usuario` (
  `id_grupo_usuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_grupo_usuario` VARCHAR(45) NOT NULL ,
  `id_usuario_carga` INT(11) NOT NULL ,
  `es_privado` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id_grupo_usuario`) ,
  INDEX `usuario_carga_fk_grupo_usuario` (`id_usuario_carga` ASC) ,
  CONSTRAINT `usuario_carga_fk_grupo_usuario`
    FOREIGN KEY (`id_usuario_carga` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`materia_archivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`materia_archivo` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`materia_archivo` (
  `id_materia_archivo` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_materia` INT(11) NOT NULL ,
  `id_archivo` INT(11) NOT NULL ,
  PRIMARY KEY (`id_materia_archivo`) ,
  INDEX `materia_fk_archivo` (`id_materia` ASC) ,
  INDEX `archivo_fk_materia` (`id_archivo` ASC) ,
  CONSTRAINT `archivo_fk_materia`
    FOREIGN KEY (`id_archivo` )
    REFERENCES `boletines`.`archivo` (`id_archivo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materia_fk_archivo`
    FOREIGN KEY (`id_materia` )
    REFERENCES `boletines`.`materia` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`materia_dia_horario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`materia_dia_horario` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`materia_dia_horario` (
  `id_materia_dia_horario` INT(11) NOT NULL ,
  `id_materia` INT(11) NOT NULL ,
  `dia` VARCHAR(10) NOT NULL ,
  `hora_catedra_inicio` INT(11) NOT NULL ,
  `hora_catedra_fin` INT(11) NOT NULL ,
  PRIMARY KEY (`id_materia_dia_horario`) ,
  INDEX `materia_fk_dia_hora` (`id_materia` ASC) ,
  CONSTRAINT `materia_fk_dia_hora`
    FOREIGN KEY (`id_materia` )
    REFERENCES `boletines`.`materia` (`id_materia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`mensaje`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`mensaje` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`mensaje` (
  `id_mensaje` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario_envia` INT(11) NOT NULL ,
  `id_usuario_recibe` INT(11) NOT NULL ,
  `titulo_mensaje` VARCHAR(100) NOT NULL ,
  `texto_mensaje` VARCHAR(500) NOT NULL ,
  `fecha_envio` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `borrado` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id_mensaje`) ,
  INDEX `usuario_envia_fk_mensaje` (`id_usuario_envia` ASC) ,
  INDEX `usuario_recibe_fk_mensaje` (`id_usuario_recibe` ASC) ,
  CONSTRAINT `usuario_envia_fk_mensaje`
    FOREIGN KEY (`id_usuario_envia` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_recibe_fk_mensaje`
    FOREIGN KEY (`id_usuario_recibe` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`notificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`notificacion` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`notificacion` (
  `id_notificacion` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario_envia` INT(11) NOT NULL ,
  `id_grupo_usuario_recibe` INT(11) NOT NULL ,
  `titulo_notificacion` VARCHAR(100) NOT NULL ,
  `texto_notificacion` VARCHAR(500) NOT NULL ,
  `fecha_envio` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_notificacion`) ,
  INDEX `usuario_envia_fk_notificacion` (`id_usuario_envia` ASC) ,
  INDEX `grupo_usuario_fk_notificacion` (`id_grupo_usuario_recibe` ASC) ,
  CONSTRAINT `grupo_usuario_fk_notificacion`
    FOREIGN KEY (`id_grupo_usuario_recibe` )
    REFERENCES `boletines`.`grupo_usuario` (`id_grupo_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_envia_fk_notificacion`
    FOREIGN KEY (`id_usuario_envia` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`rol` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`rol` (
  `id_rol` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_rol` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_rol`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`usuario_establecimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`usuario_establecimiento` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`usuario_establecimiento` (
  `id_usuario_establecimiento` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario` INT(11) NOT NULL ,
  `id_establecimiento` INT(11) NOT NULL ,
  PRIMARY KEY (`id_usuario_establecimiento`) ,
  INDEX `usuario_fk_establecimiento` (`id_usuario` ASC) ,
  INDEX `establecimiento_fk_usuario` (`id_establecimiento` ASC) ,
  CONSTRAINT `usuario_fk_establecimiento`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `establecimiento_fk_usuario`
    FOREIGN KEY (`id_establecimiento` )
    REFERENCES `boletines`.`establecimiento` (`id_establecimiento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`usuario_grupo_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`usuario_grupo_usuario` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`usuario_grupo_usuario` (
  `id_usuario_grupo_usuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario` INT(11) NOT NULL ,
  `id_grupo_usuario` INT(11) NOT NULL ,
  PRIMARY KEY (`id_usuario_grupo_usuario`) ,
  INDEX `usario_fk_grupo_usuario` (`id_usuario` ASC) ,
  INDEX `grupo_usuario_fk_usuario` (`id_grupo_usuario` ASC) ,
  CONSTRAINT `grupo_usuario_fk_usuario`
    FOREIGN KEY (`id_grupo_usuario` )
    REFERENCES `boletines`.`grupo_usuario` (`id_grupo_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usario_fk_grupo_usuario`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `boletines`.`usuario_rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `boletines`.`usuario_rol` ;

CREATE  TABLE IF NOT EXISTS `boletines`.`usuario_rol` (
  `id_usuario_rol` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_usuario` INT(11) NOT NULL ,
  `id_rol` INT(11) NOT NULL ,
  PRIMARY KEY (`id_usuario_rol`) ,
  INDEX `usuario_fk_rol` (`id_usuario` ASC) ,
  INDEX `rol_fk_usuario` (`id_rol` ASC) ,
  CONSTRAINT `usuario_fk_rol`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `boletines`.`usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rol_fk_usuario`
    FOREIGN KEY (`id_rol` )
    REFERENCES `boletines`.`rol` (`id_rol` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
