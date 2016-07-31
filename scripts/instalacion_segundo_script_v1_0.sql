USE communitas;

INSERT INTO `esquema_calificacion` (`id`, `nombre`) VALUES
(1, 'General'),
(2, '1 a 100'),
(3, 'F a A'),
(4, 'I a S'),
(5, 'Insuficiente a Sobresaliente'),
(6, '1 a 10');

INSERT INTO `valor_calificacion` (`id`, `esquema_calificacion_id`, `nombre`, `valor`) VALUES
(1, 1, 'No Evaluado', 0),
(2, 1, 'Ausente', 0),
(3, 2, '1', 1),
(4, 2, '2', 2),
(5, 2, '3', 3),
(6, 2, '4', 4),
(7, 2, '5', 5),
(8, 2, '6', 6),
(9, 2, '7', 7),
(10, 2, '8', 8),
(11, 2, '9', 9),
(12, 2, '10', 10),
(13, 2, '11', 11),
(14, 2, '12', 12),
(15, 2, '13', 13),
(16, 2, '14', 14),
(17, 2, '15', 15),
(18, 2, '16', 16),
(19, 2, '17', 17),
(20, 2, '18', 18),
(21, 2, '19', 19),
(22, 2, '20', 20),
(23, 2, '21', 21),
(24, 2, '22', 22),
(25, 2, '23', 23),
(26, 2, '24', 24),
(27, 2, '25', 25),
(28, 2, '26', 26),
(29, 2, '27', 27),
(30, 2, '28', 28),
(31, 2, '29', 29),
(32, 2, '30', 30),
(33, 2, '31', 31),
(34, 2, '32', 32),
(35, 2, '33', 33),
(36, 2, '34', 34),
(37, 2, '35', 35),
(38, 2, '36', 36),
(39, 2, '37', 37),
(40, 2, '38', 38),
(41, 2, '39', 39),
(42, 2, '40', 40),
(43, 2, '41', 41),
(44, 2, '42', 42),
(45, 2, '43', 43),
(46, 2, '44', 44),
(47, 2, '45', 45),
(48, 2, '46', 46),
(49, 2, '47', 47),
(50, 2, '48', 48),
(51, 2, '49', 49),
(52, 2, '50', 50),
(53, 2, '51', 51),
(54, 2, '52', 52),
(55, 2, '53', 53),
(56, 2, '54', 54),
(57, 2, '55', 55),
(58, 2, '56', 56),
(59, 2, '57', 57),
(60, 2, '58', 58),
(61, 2, '59', 59),
(62, 2, '60', 60),
(63, 2, '61', 61),
(64, 2, '62', 62),
(65, 2, '63', 63),
(66, 2, '64', 64),
(67, 2, '65', 65),
(68, 2, '66', 66),
(69, 2, '67', 67),
(70, 2, '68', 68),
(71, 2, '69', 69),
(72, 2, '70', 70),
(73, 2, '71', 71),
(74, 2, '72', 72),
(75, 2, '73', 73),
(76, 2, '74', 74),
(77, 2, '75', 75),
(78, 2, '76', 76),
(79, 2, '77', 77),
(80, 2, '78', 78),
(81, 2, '79', 79),
(82, 2, '80', 80),
(83, 2, '81', 81),
(84, 2, '82', 82),
(85, 2, '83', 83),
(86, 2, '84', 84),
(87, 2, '85', 85),
(88, 2, '86', 86),
(89, 2, '87', 87),
(90, 2, '88', 88),
(91, 2, '89', 89),
(92, 2, '90', 90),
(93, 2, '91', 91),
(94, 2, '92', 92),
(95, 2, '93', 93),
(96, 2, '94', 94),
(97, 2, '95', 95),
(98, 2, '96', 96),
(99, 2, '97', 97),
(100, 2, '98', 98),
(101, 2, '99', 99),
(102, 2, '100', 100),
(103, 3, 'F', 1),
(104, 3, 'D', 2),
(105, 3, 'C', 3),
(106, 3, 'B', 4),
(107, 3, 'A', 5),
(108, 4, 'I', 1),
(109, 4, 'R', 2),
(110, 4, 'B', 3),
(111, 4, 'MB', 4),
(112, 4, 'S', 5),
(113, 5, 'Insuficiente', 1),
(114, 5, 'Regular', 2),
(115, 5, 'Bueno', 3),
(116, 5, 'Muy Bueno', 4),
(117, 5, 'Sobresaliente', 5),
(118, 6, '1', 100),
(119, 6, '1.25', 125),
(120, 6, '1.5', 150),
(121, 6, '1.75', 175),
(122, 6, '2', 200),
(123, 6, '2.25', 225),
(124, 6, '2.5', 250),
(125, 6, '2.75', 275),
(126, 6, '3', 300),
(127, 6, '3.25', 325),
(128, 6, '3.5', 350),
(129, 6, '3.75', 375),
(130, 6, '4', 400),
(131, 6, '4.25', 425),
(132, 6, '4.5', 450),
(133, 6, '4.75', 475),
(134, 6, '5', 500),
(135, 6, '5.25', 525),
(136, 6, '5.5', 550),
(137, 6, '5.75', 575),
(138, 6, '6', 600),
(139, 6, '6.25', 625),
(140, 6, '6.5', 650),
(141, 6, '6.75', 675),
(142, 6, '7', 700),
(143, 6, '7.25', 725),
(144, 6, '7.5', 750),
(145, 6, '7.75', 775),
(146, 6, '8', 800),
(147, 6, '8.25', 825),
(148, 6, '8.5', 850),
(149, 6, '8.75', 875),
(150, 6, '9', 900),
(151, 6, '9.25', 925),
(152, 6, '9.5', 950),
(153, 6, '9.75', 975),
(154, 6, '10', 1000);

INSERT INTO `rol` (`id`, `nombre`, `descripcion`) VALUES
(1, 'ROLE_ADMIN', 'Administrador del sistema'),
(2, 'ROLE_PADRE', 'Representa a los padres de los alumnos. Hasta 2 por alumno'),
(3, 'ROLE_ALUMNO', 'Uno por alumno'),
(4, 'ROLE_DOCENTE', 'Uno por cada docente. Puede calificar.'),
(5, 'ROLE_DIRECTIVO', 'Rol administrativo para las instituciones y establecimientos'),
(6, 'ROLE_BEDEL', 'Puede tomar asistencia y accines disciplianrias, no puede calificar');

INSERT INTO `usuario` (`id`, `rol_id`, `institucion_id`, `nombre`, `apellido`, `password`, `id_entidad_asociada`, `email`, `dni`) VALUES
(1, 1, NULL, 'admin', 'admin', '$2a$12$8fItcMDaaDuIk8A2IS4/Fubi6F9s9.Ti5426a7QLpykmjkZ1ifAYe', NULL, 'admin@admin.com', 'admin');
