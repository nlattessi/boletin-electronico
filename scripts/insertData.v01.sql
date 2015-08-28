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


LOCK TABLES `rol` WRITE;
INSERT INTO `boletines`.`rol` (`id`,`nombre`, `descripcion`) VALUES ('1','ROLE_ADMIN', 'Administrador del sistema');
INSERT INTO `boletines`.`rol` (`id`,`nombre`, `descripcion`) VALUES ('2','ROLE_PADRE', 'Representa a los padres de los alumnos. Hasta 2 por alumno');
INSERT INTO `boletines`.`rol` (`id`,`nombre`, `descripcion`) VALUES ('3','ROLE_ALUMNO', 'Uno por alumno');
INSERT INTO `boletines`.`rol` (`id`,`nombre`, `descripcion`) VALUES ('4','ROLE_DOCENTE', 'Uno por cada docente. Puede calificar.');
INSERT INTO `boletines`.`rol` (`id`,`nombre`, `descripcion`) VALUES ('5','ROLE_DIRECTIVO', 'Rol administrativo para las instituciones y establecimientos');
INSERT INTO `boletines`.`rol` (`id`,`nombre`, `descripcion`) VALUES ('6','ROLE_BEDEL', 'Puede tomar asistencia y accines disciplianrias, no puede calificar');
UNLOCK TABLES;

LOCK TABLES `usuario` WRITE;
INSERT INTO `boletines`.`usuario` (`nombre`, `password`, `rol_id`, `email`) VALUES ('admin', 'admin', '1', 'admin@admin.com');
INSERT INTO `boletines`.`usuario` (`nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`) VALUES ('speacecraft', 'speacecraft', '2', '1', 'padre@padre.con');
INSERT INTO `boletines`.`usuario` (`nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`) VALUES ('juancarlos', 'juancarlos', '3', '1', 'alumno@alumno.com');
INSERT INTO `boletines`.`usuario` (`nombre`, `password`, `rol_id`, `id_entidad_asociada`, `email`) VALUES ('anadacol', 'anadacol', '4', '1', 'docente@docente.com');
INSERT INTO `boletines`.`usuario` (`nombre`, `password`, `rol_id`, `email`) VALUES ('dorita', 'dorita', '5', 'director@director.com');
INSERT INTO `boletines`.`usuario` (`nombre`, `password`, `rol_id`, `email`) VALUES ('maryrose', 'maryrose', '6', 'bedel@bedel.com');
UNLOCK TABLES;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
