INSERT INTO avatar (nombre, path) VALUES ('1', '1.png');
INSERT INTO avatar (nombre, path) VALUES ('2', '2.png');
INSERT INTO avatar (nombre, path) VALUES ('3', '3.png');
INSERT INTO avatar (nombre, path) VALUES ('4', '4.png');
INSERT INTO avatar (nombre, path) VALUES ('5', '5.png');
INSERT INTO avatar (nombre, path) VALUES ('6', '6.png');
INSERT INTO avatar (nombre, path) VALUES ('7', '7.png');
INSERT INTO avatar (nombre, path) VALUES ('8', '8.png');
INSERT INTO avatar (nombre, path) VALUES ('9', '9.png');
INSERT INTO avatar (nombre, path) VALUES ('10', '10.png');
INSERT INTO avatar (nombre, path) VALUES ('11', '11.png');
INSERT INTO avatar (nombre, path) VALUES ('12', '12.png');

UPDATE alumno SET avatar_id = 1 WHERE id = 1;
UPDATE alumno SET avatar_id = 2 WHERE id = 2;
UPDATE alumno SET avatar_id = 3 WHERE id = 3;

UPDATE alumno SET foto = '1.jpg' WHERE id = 1;
UPDATE alumno SET foto = '2.jpg' WHERE id = 2;
UPDATE alumno SET foto = '3.jpg' WHERE id = 3;

UPDATE docente SET foto = '1.jpg' WHERE id = 1;

UPDATE institucion SET logo = '1.jpg' WHERE id = 1;
