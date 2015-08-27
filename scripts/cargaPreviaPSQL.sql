INSERT INTO rol (id,nombre, descripcion) VALUES ('1','ROLE_ADMIN', 'Administrador del sistema');                                                      
INSERT INTO rol (id,nombre, descripcion) VALUES ('2','ROLE_PADRE', 'Representa a los padres de los alumnos. Hasta 2 por alumno');
INSERT INTO rol (id,nombre, descripcion) VALUES ('3','ROLE_ALUMNO', 'Uno por alumno');
INSERT INTO rol (id,nombre, descripcion) VALUES ('4','ROLE_DOCENTE', 'Uno por cada docente. Puede calificar.');
INSERT INTO rol (id,nombre, descripcion) VALUES ('5','ROLE_DIRECTIVO', 'Rol administrativo para las instituciones y establecimientos');
INSERT INTO rol (id,nombre, descripcion) VALUES ('6','ROLE_BEDEL', 'Puede tomar asistencia y accines disciplianrias, no puede calificar');

INSERT INTO usuario (nombre, password, rol_id, email) VALUES ('admin', 'admin', '1', 'admin@admin.com');
INSERT INTO usuario (nombre, password, rol_id, id_entidad_asociada, email) VALUES ('speacecraft', 'speacecraft', '2', '1', 'padre@padre.con');
INSERT INTO usuario (nombre, password, rol_id, id_entidad_asociada, email) VALUES ('juancarlos', 'juancarlos', '3', '1', 'alumno@alumno.com');
INSERT INTO usuario (nombre, password, rol_id, id_entidad_asociada, email) VALUES ('anadacol', 'anadacol', '4', '1', 'docente@docente.com');
INSERT INTO usuario (nombre, password, rol_id, email) VALUES ('dorita', 'dorita', '5', 'director@director.com');
INSERT INTO usuario (nombre, password, rol_id, email) VALUES ('maryrose', 'maryrose', '6', 'bedel@bedel.com');

