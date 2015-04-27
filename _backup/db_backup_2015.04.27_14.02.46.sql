-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `authassignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `authassignment`;
CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `bizrule` text COLLATE utf8_spanish_ci,
  `data` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `authitem`
-- -------------------------------------------
DROP TABLE IF EXISTS `authitem`;
CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish_ci,
  `bizrule` text COLLATE utf8_spanish_ci,
  `data` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `authitemchild`
-- -------------------------------------------
DROP TABLE IF EXISTS `authitemchild`;
CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `rights`
-- -------------------------------------------
DROP TABLE IF EXISTS `rights`;
CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_areas`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_areas`;
CREATE TABLE IF NOT EXISTS `vu_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(1024) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_comunicaciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_comunicaciones`;
CREATE TABLE IF NOT EXISTS `vu_comunicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  `titulo` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `autores` text COLLATE utf8_spanish_ci,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `observaciones` text COLLATE utf8_spanish_ci,
  `url` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Url a la carpeta de dropbox correspondiente',
  `tipo` tinyint(1) NOT NULL COMMENT '0: Comunicación; 1: Poster',
  `revisado` int(11) DEFAULT NULL,
  `aprobado` tinyint(1) DEFAULT NULL COMMENT '0 -> sin especificar; 1-> Aprobado; 2-> NO Aprobado',
  `id_area` int(11) NOT NULL,
  `edicion` varchar(128) COLLATE utf8_spanish_ci NOT NULL DEFAULT '2014',
  PRIMARY KEY (`id`),
  KEY `area` (`id_area`),
  KEY `id_area` (`id_area`),
  KEY `revisado` (`revisado`),
  KEY `revisado_2` (`revisado`),
  KEY `revisado_3` (`revisado`),
  CONSTRAINT `vu_comunicaciones_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `vu_areas` (`id`),
  CONSTRAINT `vu_comunicaciones_ibfk_2` FOREIGN KEY (`revisado`) REFERENCES `vu_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_datos`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_datos`;
CREATE TABLE IF NOT EXISTS `vu_datos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `valor` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_inscritos`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_inscritos`;
CREATE TABLE IF NOT EXISTS `vu_inscritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido1` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido2` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nif` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nacionalidad` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cp` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `localidad` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `provincia` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `sexo` tinyint(1) NOT NULL,
  `pais` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cargo` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Cargo en la empresa',
  `razonSocial` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `nifEmpresa` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `direccionEmpresa` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `titulacion` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `edicion` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `observaciones` text CHARACTER SET latin1 COLLATE latin1_spanish_ci,
  `observaciones2` text COLLATE utf8_spanish_ci,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pagado` tinyint(1) NOT NULL DEFAULT '0',
  `talleres` tinyint(1) NOT NULL DEFAULT '0',
  `coursesites` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Si esta registrado en coursesites:"si"; Si no: "No"; Si está con otro email: "elemail@blabla.com',
  `certificado` tinyint(1) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `FK_inscritos` FOREIGN KEY (`id_rol`) REFERENCES `vu_rol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Inscritos a las Jornadas VirtualUSATIC';

-- -------------------------------------------
-- TABLE `vu_inscritos_comunicaciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_inscritos_comunicaciones`;
CREATE TABLE IF NOT EXISTS `vu_inscritos_comunicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_comunicacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`,`id_comunicacion`),
  KEY `id_comunicacion` (`id_comunicacion`),
  CONSTRAINT `vu_inscritos_comunicaciones_ibfk_1` FOREIGN KEY (`id_comunicacion`) REFERENCES `vu_comunicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vu_inscritos_comunicaciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `vu_inscritos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_inscritos_talleres`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_inscritos_talleres`;
CREATE TABLE IF NOT EXISTS `vu_inscritos_talleres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_taller` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_taller` (`id_taller`),
  CONSTRAINT `vu_inscritos_talleres_ibfk_2` FOREIGN KEY (`id_taller`) REFERENCES `vu_talleres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vu_inscritos_talleres_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `vu_inscritos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_pagos`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_pagos`;
CREATE TABLE IF NOT EXISTS `vu_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `cantidad_pagar` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `vu_pagos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `vu_inscritos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_paises`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_paises`;
CREATE TABLE IF NOT EXISTS `vu_paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_profiles`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_profiles`;
CREATE TABLE IF NOT EXISTS `vu_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `rol` int(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `vu_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `vu_profiles_fields`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_profiles_fields`;
CREATE TABLE IF NOT EXISTS `vu_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `vu_rol`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_rol`;
CREATE TABLE IF NOT EXISTS `vu_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_talleres`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_talleres`;
CREATE TABLE IF NOT EXISTS `vu_talleres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci,
  `jornada` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float DEFAULT NULL,
  `abreviacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `precio_detalle` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_users`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_users`;
CREATE TABLE IF NOT EXISTS `vu_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `vu_usuarioroles`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_usuarioroles`;
CREATE TABLE IF NOT EXISTS `vu_usuarioroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE `vu_usuarios`
-- -------------------------------------------
DROP TABLE IF EXISTS `vu_usuarios`;
CREATE TABLE IF NOT EXISTS `vu_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `rol` tinyint(4) NOT NULL,
  `activado` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- -------------------------------------------
-- TABLE DATA vu_areas
-- -------------------------------------------
INSERT INTO `vu_areas` (`id`,`nombre`) VALUES
('1','Plataformas y Entornos de Aprendizaje');
INSERT INTO `vu_areas` (`id`,`nombre`) VALUES
('2','Materiales y Recursos');
INSERT INTO `vu_areas` (`id`,`nombre`) VALUES
('3','Herramientas 2.0');
INSERT INTO `vu_areas` (`id`,`nombre`) VALUES
('4','Redes Sociales y uLearning');



-- -------------------------------------------
-- TABLE DATA vu_comunicaciones
-- -------------------------------------------
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('1','C1-001','RADIO SOLIDARIA AMIGA, ONLINE y RADIOSOLAMICHILDREN’S','Mª Magdalena Galiana Lloret','2014-05-27 11:10:00','','https://www.dropbox.com/sh/abl5brc15xqowui/AAC7WPegZvdEE4yr9Fnnm6Hfa','0','6','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('2','P2-001','Filmaciones como herramientas TIC en Anatomía','Julio Gil Garcia','2014-05-08 09:44:10','Muy interesante. La web funciona perfectamente','https://www.dropbox.com/sh/lk0ha6ive37c3jo/AAA_b0KkNhe6WHw1cZhv30KNa','1','3','2','2','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('3','C2-001','El uso de fotografía en enseñanzas plásticas y artísticas; de la técnica a la realización de la imagen fotográfica','Alfonso Revilla Carrasco, Jo
ana Soto Merola','2014-05-13 11:19:47','Sería interesante ver la aplicación en el aula','https://www.dropbox.com/sh/g6w99yw9gyl27ns/AACR0GFUOvcRf3KYmgUYMI4ea','0','3','1','2','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('4','C2-002','Sistemas de análisis de la imagen utilizando las nuevas tecnologías con fines didácticos','Alfonso Revilla Carrasco','2014-05-13 12:09:26','Aplicación didáctica en otros grados que no sean periodismo?','https://www.dropbox.com/sh/3qh9vwxaz5wvhpo/AAB8w8PEhzPr2kPq5KIvzF15a','0','6','1','2','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('5','C2-003','Análisis de la posición actual de las nuevas tecnologías y el arte','Alfonso Revilla Carrasco','2014-05-13 12:16:14','Aplicación de las nuevas tecnologías en la didáctica de la expresión plástica','https://www.dropbox.com/sh/ij47cxtmt0a1f6i/AAAGkcaSvWAKGGkojCTYTZMza','0','3','1','2','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('6','P4-004','El Modelo de Aceptación Tecnológica (TAM) como herramienta para explorar los factores que motivan el uso del mobile learning en estudiantes universitarios','Alejandro Valencia Arias (jhoanyvalencia@itm.edu.co) - Piedad Betancur Zuluaga (piedadbetancur@itm.edu.co) - Vanessa Rodrí-guez Lora (vanessarodriguez@itm.edu.co)','2014-05-29 10:51:15','adsdf','https://www.dropbox.com/sh/dhqu0pll76uvp1o/AAAfOzrs2UQzSl5wT9vpT_PJa','1','3','0','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('7','P3-001','Herramientas on - line de elaboración de mapas conceptuales para el apoyo de clases magistrales','María Dolores Víctor, Ortega y Diego Airado Rodríguez
','2014-05-15 09:58:40','Es el mismo que el P1-017','https://www.dropbox.com/sh/x5ncq8k1i39s6gy/AACNwNxHJDWde_zsksA0eFCda','1','','1','3','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('8','P4-006','Potencial de uso del Mobile learning en Colombia','Néstor Lotero Chica (nestorlotero124383@correo.itm.edu.co) - Jackeline Valencia Arias (javalenca.a@gmail.com) Piedad Betancur, Zuluaga (piedadbetancur@itm.edu.co) - Vanessa, Rodríguez Lora (vanessarodriguez@itm.edu.co)','2014-05-29 10:53:27','','https://www.dropbox.com/sh/cgz5dffnbn87nd5/AABfeW6U53f4ARSRMMEiUJIKa','1','3','2','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('9','P1-003','El laboratorio de Administración Tecnológica como herramienta de aprendizaje práctico en los estudiantes del ITM','Diego Gutiérrez Uribe, Néstor Lotero Chica, Daniela Ramirez Cuartas','2014-05-26 13:40:27','','https://www.dropbox.com/sh/8wsz0ye1hjwv13b/AADiNCTLgq1tTo_jMBbB5wsha','1','3','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('10','P1-004','Estudio exploratorio de la formación en TIC en las PYME de Medellín','Juan Carlos Villa Bustamante
(
juancvilla14@hotmail.com
)
Ana Roldan Duque
(
roldan079@gmail.com
)
Astrid Marín Henao
(
astridjmarin@hotmail.com
)
Carlos Mario Ortega Rojas','2014-05-15 10:30:23','NO TRATA SOBRE NINGÚN TEMA DOCENTE. Se podría estirar, para aceptarlo, por el hecho de que en el fondo está relacionado con las TIC, en el sentido de que realizan una encuesta sobre herramientas TIC entre el personal de la pequeña y mediana empresa. Pero nada más.','https://www.dropbox.com/sh/bmyipi1jg5daa3t/AABoX0cRQvXgfhy1LqxuRyI6a','1','3','2','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('11','C1-002','La importancia del diseño en un MOOC','Elena Ayala Bailador - elena.ayala@outlook.com','2014-05-21 09:17:18','','https://www.dropbox.com/sh/o5ixudtgap8qois/AACz7MFuw3G0yIg6SJkltQWNa','0','3','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('12','C2-004','Herramientas de la Web 2.0: wikis y blogs','Montserrat Vaqueiro Romero','2014-05-21 09:26:47','El resumen no es tal, sino más bien una introducción.
INTENTA hacer una presentación de wiki y blog, recogiendo información de otros. Muy flojo y muy largo.
- ¿Ha utilizado estas herramientas en docencia? ¿cómo?','https://www.dropbox.com/sh/h48w9480iqfqch8/AACL5_yi4AMH65uOEyzdou56a','0','','1','2','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('14','P1-005','Proyecto Ciber-Notario 1.0 ','Aurelio Barrio Gallardo','2014-05-22 10:07:23','El póster no es autoexplicativo, hay que leer todo el resumen','https://www.dropbox.com/sh/ea0dymsahag69oa/AAB8jYJpLmi0QGyrpdaZ4_XMa','1','','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('15','C1-001','Primera comuniación 2015','','2015-02-16 13:00:45','','','0','','','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('16','C2-005','Las NTIC para divulgar ciertos aspectos de la cultura popular de tradición oral','Leonor Zozaya, Pepe Moltó','2014-05-22 10:40:14','urgente','https://www.dropbox.com/sh/kk4bwuyaid9e6xu/AACS_GOaxM76z68SUa3zM8yLa','0','3','1','2','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('17','C1-002','asdfv aslj vsl asina','','2015-02-17 13:58:42','','','0','3','2','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('18','P1-007','Uso de Moodle y Doodle para el seguimiento de trabajos en grupo','Cristina Ferrer García','2014-05-22 13:06:39','Se presenta una experiencia en una asignatura en la que se entrega varias veces, y de modo parcial, un trabajo a través de una tarea de Moodle. Posteriormente, se mantiene una sesión no presencial.
- No me ha quedado claro como desarrolláis las sesiones prácticas no presenciales, ¿Cómo lo hacéis?
- Y, una duda más: la sesión no presencial, ¿tiene lugar después de cada entrega, o sólo después de la última?','https://www.dropbox.com/sh/smf75nryyfc2qcw/AAD4_VNG8nhB6VKyekTvxuKSa','1','','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('19','C3-001','Proyectos e iniciativas de información y orientación académica y laboral en el IES García Barbón','Daniel Veiga Martínez veigaorama@gmail.com, Carmen Berenguer Ortuño berenguerverin@gmail.com','2014-05-27 09:25:01','','https://www.dropbox.com/sh/6seahqjvwui3i0d/AACdiVueRwvUZwo8j6HuMsU9a','0','','1','3','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('20','P1-008','El uso de las TIC como herramientas para la autoevaluación','Yolanda Echegoyen','2014-05-29 09:32:13','Explica que mediante herramientas TIC es posible proponer un cuestionario al alumnado, para que luego se lo corrija él mismo al facilitarle unos días después una plantilla de corrección. Luego el prof. valora el nivel de comprensión, etc.

- Al leer el resumen, pensaba que se trataba de preguntas abiertas, pero según el póster es un cuestionario de respuestas múltiples. En ese caso, no me queda claro qué ventajas aporta que la corrección no sea automática, y tenga que hacerla \"a mano\" el propio alumno. ¿Podrías explicarmelo, por favor?','https://www.dropbox.com/sh/sbj4c4r206vmu1l/AACYTRLTCNX49jwsd2da5CjBa','1','','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('21','C1-003','Diseño de un PLE (Personal Learning Environment) como apoyo de aprendizaje en los Trabajos de Módulo del Grado en Ingeniería en Diseño Industrial y Desarrollo de Producto','Ana Serrano Tierz, Pilar Biel Ibáñez, Ester Pérez Sinusía, Carmen Rodrigo Cardiel','2014-06-02 09:31:50','asaa','https://www.dropbox.com/sh/707n6ya8fewmq1f/AAC_0f7SY1hXLZkWX68Lv4d7a','0','','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('22','C1-004','U-prácticas educativas mediadas por TIC','Marcela Adriana Tagua','2014-06-03 10:27:33','La autora no aparece como inscrita','https://www.dropbox.com/sh/i5p730je627g738/AAAvseVKiXAT7kPWNmRzc2gra','0','','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('23','C2-006','Enseñanza colaborativa en el grado de Arquitectura. Experiencias en la formación en software informático','R.Bravo, F. Lamas','2014-06-03 10:48:09','La manda en el área temática 1 pero dice que la pongamos donde mejor encaje. La pongo en el área temática 2','https://www.dropbox.com/sh/xwcg0dhescbj4zl/AADJ0ChYSOLciVWPYoWB5AP2a','0','3','1','2','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('24','P3-002','El portafolio electrónico','Raquel Tudela Romero','2014-06-03 11:04:51','','https://www.dropbox.com/sh/o8lbko1m0zime56/AABeavbhgQxgFi0aFeKTNTJ8a','1','3','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('25','C1-005','Estrategias de Enseñanza Online, para un Aprendizaje Eficaz','Doris Laury Beatriz Dzib Moo','2014-06-03 11:20:52','','https://www.dropbox.com/sh/16mtz67ykpu4ld0/AADJCnMNi3Gde89npRe8M1mca','0','3','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('26','P1-009','Evolución de la tecnología','Doris Laury Beatriz Dzib Moo','2014-06-03 11:30:10','aaa','https://www.dropbox.com/sh/mac90d5b40t7lt5/AAAi2WU49u830RbmDC5Bu55Ka','1','6','0','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('27','C3-002','El buen uso de la Web 2.0','Dzib Moo Doris  Laury Beatriz ','2014-06-03 12:30:52','','https://www.dropbox.com/sh/btid96s3nb3gdrp/AABvwgaGVzdfomVMndFe_Wfya','0','','1','3','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('28','C1-006','TermodinámICa con Termograf: Evaluación continua en grandes grupos','Javier Pallarés, Amaya Martínez, Tomás Gómez, Carmen Velasco, José Antonio Turégano','2014-06-04 11:12:04','','https://www.dropbox.com/sh/ginnm41r5ya3y5d/AABn1V_3t4HpziiyEnOVfMDUa','0','3','1','1','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('29','C3-003','Primeras andaduras del ePortafolio Mahara en la Universidad de Zaragoza','Alfredo
Berbegal
Vázquez
Ana
Arraiz
Pérez
Fernando
Sabirón
Sierra
Carolina
Falcón
Linares','2014-06-05 09:21:31','','https://www.dropbox.com/sh/ujsoa7wb4txnflj/AADT-U--r7UwTt6mzpUdlYu8a','0','','1','3','2015');
INSERT INTO `vu_comunicaciones` (`id`,`identificador`,`titulo`,`autores`,`fecha`,`observaciones`,`url`,`tipo`,`revisado`,`aprobado`,`id_area`,`edicion`) VALUES
('30','P2-003','Gestión de un expediente electrónico para el área de Trabajo Social en Educación Básica','Ignacio Gutiérrez Campos, Rolando Salazar-Hernández, Clarisa Pérez-Jasso, Eliezer Loredo Campos','2014-06-05 09:41:39','muy flojico. el póster no transmite información con una secuencia lógica. el resumen apenas dice nada. podría compensarse con una explicación on line?, pues dicen que es una experiencia en pruebas','https://www.dropbox.com/sh/vweqdxaajqmuske/AAA0fISaYTVDhbgIVBV5AGc8a','1','3','1','2','2015');



-- -------------------------------------------
-- TABLE DATA vu_datos
-- -------------------------------------------
INSERT INTO `vu_datos` (`id`,`clave`,`valor`) VALUES
('1','edicion','2015');
INSERT INTO `vu_datos` (`id`,`clave`,`valor`) VALUES
('2','preciotalleres','25');



-- -------------------------------------------
-- TABLE DATA vu_inscritos
-- -------------------------------------------
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('21','Hugo','Langa','','hugoepila@gmail.com','72996711R','1','C','50009','zaragoza','zaragoza','677651060','0','','','','','','','2015','','','2014-03-27 14:15:11','1','1','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('23','Hugo','Langa','','hugoepila@gmail.com','72996711R','1','C','50009','zaragoza','','677651060','0','','','','','','','2015','','','2014-03-27 14:43:41','1','1','','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('27','Hugo','Langa','Roya','hlanga@unizar.es','','1','','','','','','0','','','','','','','2015','','','2014-04-03 10:40:14','1','0','','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('28','Huga','Langa','Roya','hlanga@unizar.es','','1','','','','','','0','','','','','','','2015','tasa','asd','2014-04-03 10:42:40','1','0','','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('29','Huga','Langa','Roya','hlanga@unizar.es','','1','','','','','','0','','','','','','','2015','','aassdd','2014-04-03 10:43:52','1','0','','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('31','Huga','Langa','Roya','hugoepila@gmail.com','72996711R','1','c/Pianista Luis Galve, 2, 179','50009','zaragoza','','677651060','0','','','','','','','2015','','','2014-04-04 10:02:14','1','0','','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('32','Hugo Fernandez','Langa','Roya','hugoepila@gmail.com','72996711R','7','c/Pianista Luis Galve, 2, 179','50009','Bogotá','Bogotá','677651060','0','','','','','','','2015',' ajkdñladf','','2014-04-04 10:25:22','1','0','si','','1');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('36','Eduardo','Gracia','Jaja','elinares@unizar.es','','1','','','','','','1','','','','','','','2015','','','2015-02-17 09:45:18','0','0','','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('37','Romina','Dascoli','García','rominadascoli@yahoo.com.ar','','2','','','','','','0','','','','','','','2015','','','2014-04-03 15:16:14','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('40','Minerva','Bueno','Ramírez','minervabueno@gmail.com','','17','','','','','','0','','','','','','','2015','','','2014-04-03 16:38:29','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('41','clarisa ','mori ','riesco','moriyriesco@gmail.com','','2','','','','','','0','','','','','','','2015','','','2014-04-03 18:39:52','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('42','Victor Hugo','Ferreira','Montes','hugotranque@hotmail.com','','3','','','','','','1','','','','','','','2015','','','2014-04-03 19:14:15','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('43','María Alejandra','Lamberti','','alelamberti71@gmail.com','22179242','2','Bulnes 1330 4 A','1176','Capital Federal','','0541159056667','0','','','','','','Especialista en Educación y Nuevas Tecnologías / Licenciada en Letras','2015','','','2014-04-03 21:55:11','0','0','no','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('44','ARMANDO','REYNA BALLESTEROS','','areynab@gmail.com','','11','','','','','','1','','','','','','','2015','','','2014-04-03 22:42:34','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('45','maria isabel','carrizo','de parravicini','mariaisabelcarrizodeparravicini@yahoo.com.ar','','0','','','','','','0','Argentina','','','','','','2015','','','2014-04-04 01:15:47','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('46','LUZ MARINA ','ESCAMILLA','FONSECA','lumaesfo@yahoo.es','','7','','','','','','0','','','','','','','2015','','','2014-04-04 02:27:12','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('49','Maria Luisa','Velasquez','','luisavl@yahoo.es','','3','','','','','','0','','','','','','','2015','','','2014-04-04 05:12:55','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('50','Victoria','Marín','','vmarin87@gmail.com','','1','','','','','','0','','','','','','','2015','','','2014-04-04 07:28:55','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('53','carmen ','lozano','salas','carmen.lozano@ehu.es','','1','','','','','','0','','','','','','','2015','','','2014-04-04 11:08:11','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('54','María Florencia','Gonzalo','Lozano','flor@unizar.es','','1','','','','','','0','','','','','','','2015','','','2014-04-04 11:56:09','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('55','Zaida María','Pérez ','Sánchez','romario@uci.cu','','8','','','','','','0','','','','','','','2015','','','2014-04-04 16:44:47','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('56','Azucena','del Aguila','Aguilar','azdelaguila@hotmail.com','','0','','','','','','0','Perú','','','','','','2015','','','2014-04-04 18:00:54','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('57','Raúl','López','Fernández','raulito_p@yahoo.com','','8','','','','','','1','','','','','','','2015','','','2014-04-04 21:14:43','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('58','Fernando','Córdova','Freyre','fcordovaf@usmp.pe','','0','','','','','','1','Perú','','','','','','2015','','','2014-04-05 00:51:21','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('59','Edith Elizabeth','Luna ','Villanueva','luna_edith@yahoo.com','','2','','','','','','0','','','','','','','2015','','','2014-04-05 15:32:46','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('60','Juan','Dalmau','','jcdalmau2003@yahoo.com.ar','','2','','','','','','1','','','','','','','2015','','','2014-04-05 19:39:25','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('61','misley','baute','rodriguez','misleyalejandra@gmail.com','','17','','','','','','0','','','','','','','2015','','','2014-04-05 21:12:55','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('62','EUSTAQUIO','SORIANO','CAYETANO','soriano2009@hotmail.com','','11','','','','','','1','','','','','','','2015','','','2014-04-05 22:22:21','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('63','NELLY JOHANNA','NIÑO ','NIÑO','njohannita3404@hotmail.com','','7','','','','','','0','','','','','','','2015','','','2014-05-12 10:02:25','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('64','Bernardo','Tabuenca','Archilla','bernardo.tabuenca@ou.nl','53021893q','1','Mariahilfstr 2A','52062','Aachen','Alemania','0034652542350','1','','','','','','','2015','','P4-001, C4-001','2014-04-07 10:05:03','1','0','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('65','CARMEN','RUIZ DE AZCARATE','VARELA','cruizdeazcarate@gmail.com','','1','','','','','','0','','','','','','','2015','','','2014-04-07 11:51:16','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('66','LUIS ARTURO','PORTALS','MARTINEZ','calculo_56@hotmail.com','','11','','','','','','1','','','','','','','2015','','','2014-04-07 13:43:27','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('67','Carlos','Nevarez','Reyes','carlos.nevarez@itesm.mx','','11','','','','','','1','','','','','','','2015','','','2014-04-07 14:27:08','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('69','Nina','Vocilka','','eoi.nina@gmail.com','','1','','','','','','0','','','','','','','2015','','','2014-04-09 12:01:19','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('70','Hugo','Seijas','Gamuzi','hugo.seijas@prosegur.com','','2','','','','','','1','','','','','','','2015','','','2014-04-09 13:25:38','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('71','Daniel','Veiga','Martínez','veigaorama@gmail.com','34253011P','1','Rosalía de Castro, 48-3ºD ','32600','Verín','Ourense','988412430','1','','','','','','','2015','','C3-001','2014-04-10 07:26:14','1','0','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('72','Carolina','Tovar','Torres','carolinatovartorres@gmail.com','CC.33379122','1','Calle Alfonso XII No. 33 Piso 2B','41001','Sevilla','Andalucia','954223111','0','','','','','','','2015','','C4-014','2014-04-10 11:54:30','1','1','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('73','Jorge Eliécer','Cárdenas','Vargas','joecardenasv@gmail.com','CC.82393862','1','Calle Alfonso XII No. 33 Piso 2B','41001','Sevilla','Andalucia','954223111','1','','','','','','','2015','','C4-014','2014-04-10 12:03:07','1','1','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('74','Gemma','Rubio','Rodrigo','gemma@symbaloo.com','','0','','','','','','0','Holanda','','','','','','2015','','','2014-04-11 08:08:09','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('75','ANA BELEN','PEREZ','MARTINEZ','ab.perez@upm.es','53002150F','1','Universidad Pólitécnica de Madrid- GATE. Calle Ramiro de Maeztu, 7','28040','Madrid','Madrid','91 336 46 79 (ext. 21446)','0','','','Universidad Politécnica de Madrid','Q2818015F','Calle Ramiro de Maeztu, 7/28040/Madrid/Madrid/España','','2015','','','2014-04-11 09:32:41','1','1','no','','1');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('76','ESTER','LANGA','ROSADO','ester.langa@hotmail.com','','1','','','','','','0','','','','','','','2015','','','2014-04-11 09:39:02','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('77','Ester','Pérez','Sinusia','ester.perez@unizar.es','17745953G','1','C/ María de Luna, 3 Edificio Torres Quevedo, Campus Río Ebro, Universidad de Zaragoza','50018','Zaragoza','Zaragoza','976762148','0','','','','','','','2015','','C1-003','2014-04-11 10:11:57','1','1','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('78','Sara','Villena','Rubal','svrubal@yahoo.es','','1','','','','','','0','','','','','','','2015','','','2014-04-12 06:38:55','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('79','María Teresa','Giménez ','Esteban','mteresag@unizar.es','25455093G','1','Fray Luis Amigó, 2, 11G','50006','Zaragoza','Zaragoza','647065883','0','','','María Teresa Giménez Esteban','25455093G','Fray Luis Amigó, 2, 11G/50006/Zaragoza/Zaragoza/España','','2015','','','2014-04-13 16:14:55','1','1','mteresagim2001@yahoo.es','','1');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('80','Chelo','Ferreira','González','cferrei@unizar.es','','1','','','','','','0','','','','','','','2015','','','2014-04-14 07:15:31','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('81','Jorge','Ampudia','Ortega','jampudiaortega@yahoo.es','','1','','','','','','1','','','','','','','2015','','','2014-04-15 08:17:23','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('82','Mª Magdalena','Galiana','Lloret','radiosolami@gmail.com','21462661G','1','Avd/ Almadraba nº 44- 1ºA','03570','Villajoyosa','Alicante','625321635','0','','','','','','','2015','','C1-001','2014-04-20 14:36:08','1','0','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('83','Gracia','Caicedo','Esquivias','gracefully7214@gmail.com','','1','','','','','','0','','','','','','','2015','','','2014-04-21 17:12:04','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('84','Ana','Serrano','Tierz','anatierz@unizar.es','25469783C','1','Avda. Gómez Laguna 8, 4ºC','50.009','Zaragoza','Zaragoza','696405052','0','','','','','','','2015','','C1-003','2014-04-22 09:18:00','0','0','no','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('85','ISABEL','LÓPEZ','COBO','ilopez@uloyola.es','','1','','','','','','0','','','','','','','2015','','','2014-04-24 07:44:54','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('86','Sandra','Garcia','Garcia','garciasandra766@gmail.com','','16','','','','','','0','','','','','','','2015','','','2014-04-26 03:33:05','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('87','Celes','Arteta','Iribarren','cartetai@gmail.com','','1','','','','','','1','','','','','','','2015','','','2014-04-26 07:57:53','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('89','Hilda Yaneth','Flechas','Becerra','hilda.flechas@unad.edu.co','','7','','','','','','0','','','','','','','2015','','','2014-04-27 09:38:44','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('90','Julio','Gil','Garcia','juliogil@unizar.es','17849493K','1','(Fac. Veterinaria) Miguel Servet 177, Zaragoza 50013','50013','Zaragoza','Zaragoza','976762015','1','','','','','','','2015','','P2-001','2014-04-28 10:08:52','1','0','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('91','Adriana','Bakhos','','adrianabakhos@gmail.com','','17','','','','','','0','','','','','','','2015','','','2014-04-28 23:33:50','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('92','Corina Liliana','Acosta','-','acosta.corina@gmail.com','','2','','','','','','0','','','','','','','2015','','','2014-04-29 11:04:51','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('93','Maria','Bermudez','Lopez','mariajotabrmdz3@gmail.com','','17','','','','','','0','','','','','','','2015','','','2014-04-29 14:32:23','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('94','Jaime','Quiceno ','Guerrero','jquicenog@ucentral.edu.co','','7','','','','','','1','','','','','','','2015','','','2014-04-30 15:40:40','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('95','Franco Gonzalo','Cabrera','','gonzalocabrer@hotmail.com','','2','','','','','','1','','','','','','','2015','','','2014-05-01 22:29:15','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('97','Luis','López','López','n_luis2300-reg@yahoo.com','','0','','','','','','1','Guatemala','','','','','','2015','','','2014-05-03 19:13:55','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('98','Luz Fabiola','Guadalupe','Sifuentes','lguadalupes@unmsm.edu.pe','07829902','0','Aurelio Fernández Concha 141 ','Lima 18','Miraflores','Lima','01992797425','0','Perú','','','','','','2015','','','2014-06-05 09:06:50','1','0','si','','1');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('99','JOSÉ DE JESÚS','SIMÓN','PÉREZ','josedejesussimon@gmail.com','G11440999','11','SAN JUAN BAUTISTA NO. 7','42300','DIOS PADRE','IXMIQUILPAN, HIDALGO, MEXICO','5217711435819','1','','','','','','','2015','','','2014-05-05 01:52:11','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('100','Maria','Zavalia','Lagos','mazava@gmail.com','','2','','','','','','0','','','','','','','2015','','','2014-05-05 15:50:17','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('101','MAYRA','HERNÁNDEZ','GARCÍA','mayra_hega_18@hotmail.com','','11','','','','','','0','','','','','','','2015','','','2014-05-05 21:48:32','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('102','José Manuel','Sota','Eguizábal','jose.sota@fund.unirioja.es','','1','','','','','','1','','','','','','','2015','','','2014-05-06 11:42:29','0','0','no','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('103','Zoila','Suárez','Viera','zoilasuarezviera@gmail.com','','1','','','','','','0','','','','','','','2015','','','2014-05-06 21:20:39','0','0','zoilasuarezviera@hotmail.com','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('104','María Asunción','Martínez','Mayoral','asun.mayoral@umh.es','07556579K','1','Avda. Universidad s/n. Universidad Miguel Hernández. Edificio Torrepinet','03202','Elche','Alicante','608259542','0','','','Universidad Miguel Hernández de Elche','Q5350015C','Avda. Universidad s/n /03202/Alicante/Elche/España','','2015','','C2-009,C3-011','2014-05-07 11:15:32','1','0','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('106','Javier','Morales','Socuéllamos','j.morales@umh.es','20152028A','1','Avda. Universidad s/n. Universidad Miguel Hernández. Edificio Torrepinet','03202','Elche','Alicante','635323190','1','','','Universidad Miguel Hernández de Elche','Q5350015C','Avda. Universidad s/n /03202/Alicante/Elche/España','','2015','','C2-009','2014-05-07 12:06:25','1','0','si','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('107','Julia','Martínez','López','jmar@unizar.es','17208060N','1','Miguel Servet 5 dpdo., 4º,4ª','50002','Zaragoza','','626166787','0','','','','','','','2015','','','2014-05-07 17:07:00','1','1','si','','1');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('108','Rodrigo','González','Aróstegui','rognark@gmail.com','','5','','','','','','1','','','','','','','2015','','','2014-05-08 05:31:32','0','0','rodrigo.gonzalez.arostegui@gmail.com','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('109','Ana Carmen','Lucha','López','analucha@unizar.es','','1','','','','','','0','','','','','','','2015','','','2014-05-08 19:23:15','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('110','Pedro','Roman','Gravan','promanito@hotmail.com','','1','','','','','','1','','','','','','','2015','','','2014-05-08 20:27:40','0','0','si','','3');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('111','Eduardo','Gracia','Jaja','egracia@unizar.es','874512214','1','No lo sé','50004','Zaragoza','Zaragoza','654114785','1','','','','','','','2015','','','2015-04-17 10:59:07','0','1','','','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('112','Marciano','Rajoy','','notengo@gmail.com','854785697','1','c/ Pianista Luis Galve, 2','50004','Zaragoza','Zaragoza','654114785','1','','','','','','','2015','','','2015-04-20 09:56:00','0','1','','0','2');
INSERT INTO `vu_inscritos` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`nif`,`nacionalidad`,`direccion`,`cp`,`localidad`,`provincia`,`telefono`,`sexo`,`pais`,`cargo`,`razonSocial`,`nifEmpresa`,`direccionEmpresa`,`titulacion`,`edicion`,`observaciones`,`observaciones2`,`fecha`,`pagado`,`talleres`,`coursesites`,`certificado`,`id_rol`) VALUES
('113','Arnaldo','Monastegui','Tamarote','amonastegui@alsj.es','','1','','','','','','1','','','','','','','2015','','','2015-04-21 09:28:47','0','0','','0','3');



-- -------------------------------------------
-- TABLE DATA vu_inscritos_comunicaciones
-- -------------------------------------------
INSERT INTO `vu_inscritos_comunicaciones` (`id`,`id_usuario`,`id_comunicacion`) VALUES
('10','36','15');



-- -------------------------------------------
-- TABLE DATA vu_inscritos_talleres
-- -------------------------------------------
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('1','23','1');
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('2','23','2');
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('3','23','5');
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('13','111','6');
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('14','111','10');
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('15','112','6');
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('16','112','7');
INSERT INTO `vu_inscritos_talleres` (`id`,`id_usuario`,`id_taller`) VALUES
('17','112','8');



-- -------------------------------------------
-- TABLE DATA vu_pagos
-- -------------------------------------------
INSERT INTO `vu_pagos` (`id`,`id_usuario`,`cantidad_pagar`) VALUES
('18','21','150');
INSERT INTO `vu_pagos` (`id`,`id_usuario`,`cantidad_pagar`) VALUES
('20','23','180');
INSERT INTO `vu_pagos` (`id`,`id_usuario`,`cantidad_pagar`) VALUES
('23','31','50');
INSERT INTO `vu_pagos` (`id`,`id_usuario`,`cantidad_pagar`) VALUES
('24','32','30');
INSERT INTO `vu_pagos` (`id`,`id_usuario`,`cantidad_pagar`) VALUES
('27','111','100');
INSERT INTO `vu_pagos` (`id`,`id_usuario`,`cantidad_pagar`) VALUES
('28','112','100');



-- -------------------------------------------
-- TABLE DATA vu_paises
-- -------------------------------------------
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('1','España');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('2','Argenina');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('3','Bolivia');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('4','Brasil');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('5','Chile');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('6','Canadá');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('7','Colombia');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('8','Cuba');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('9','Ecuador');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('10','El Salvador');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('11','México');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('12','Paraguay');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('13','Puerto Rico');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('14','República Dominicana');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('15','Uruguay');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('16','USA');
INSERT INTO `vu_paises` (`id`,`nombre`) VALUES
('17','Venezuela');



-- -------------------------------------------
-- TABLE DATA vu_profiles
-- -------------------------------------------
INSERT INTO `vu_profiles` (`user_id`,`lastname`,`firstname`,`rol`) VALUES
('3','Langa','Hugo','2');
INSERT INTO `vu_profiles` (`user_id`,`lastname`,`firstname`,`rol`) VALUES
('4','Gracia Linares','Eduardo','2');
INSERT INTO `vu_profiles` (`user_id`,`lastname`,`firstname`,`rol`) VALUES
('5','Unizar','Feuz','4');
INSERT INTO `vu_profiles` (`user_id`,`lastname`,`firstname`,`rol`) VALUES
('6','Rador','Colabo','3');
INSERT INTO `vu_profiles` (`user_id`,`lastname`,`firstname`,`rol`) VALUES
('7','Siaus','Prueba','2');
INSERT INTO `vu_profiles` (`user_id`,`lastname`,`firstname`,`rol`) VALUES
('8','asaaa','asaa','2');



-- -------------------------------------------
-- TABLE DATA vu_profiles_fields
-- -------------------------------------------
INSERT INTO `vu_profiles_fields` (`id`,`varname`,`title`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`widget`,`widgetparams`,`position`,`visible`) VALUES
('1','lastname','Last Name','VARCHAR','50','3','1','','','Incorrect Last Name (length between 3 and 50 characters).','','','','','1','3');
INSERT INTO `vu_profiles_fields` (`id`,`varname`,`title`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`widget`,`widgetparams`,`position`,`visible`) VALUES
('2','firstname','First Name','VARCHAR','50','3','1','','','Incorrect First Name (length between 3 and 50 characters).','','','','','0','3');
INSERT INTO `vu_profiles_fields` (`id`,`varname`,`title`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`widget`,`widgetparams`,`position`,`visible`) VALUES
('3','rol','Rol','INTEGER','1','1','3','','','Rol incorrecto','','2','','','3','0');



-- -------------------------------------------
-- TABLE DATA vu_rol
-- -------------------------------------------
INSERT INTO `vu_rol` (`id`,`nombre`,`precio`) VALUES
('1','Asistente','30');
INSERT INTO `vu_rol` (`id`,`nombre`,`precio`) VALUES
('2','PONENTE','50');
INSERT INTO `vu_rol` (`id`,`nombre`,`precio`) VALUES
('3','gratuito','0');



-- -------------------------------------------
-- TABLE DATA vu_talleres
-- -------------------------------------------
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('1','Google Sites + Códigos QR','23 al 27 de junio (50 Euros, incluye asistencia y dos certificados cada uno por 10 horas de formación)','2014','50','T1','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('2','Web 2.0','1 al 15 de julio (50 Euros, incluye asistencia y certificado cada uno por 20 horas de formación)','2014','50','T2','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('3','Encuestafácil','1 al 15 de julio (50 Euros, incluye asistencia certificado por 20 horas de formación)','2014','50','T1 + T2','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('4','Google Sites','1 al 15 de junio (30 Euros, incluye asistencia y certificado por 10 horas de formación)','2014','30','T3','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('5','QR','23 al 27 de junio (30 Euros, incluye asistencia y certificado por 10 horas de formación)','2014','30','T4','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('6','Google Sites','bada adsfa','2015','25','T1','55');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('7','QR','','2015','25','T2','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('8','Licencias','','2015','25','T3','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('9','Productividad','','2015','25','T4','');
INSERT INTO `vu_talleres` (`id`,`nombre`,`observaciones`,`jornada`,`precio`,`abreviacion`,`precio_detalle`) VALUES
('10','Formularios-1','','2015','','T5','');



-- -------------------------------------------
-- TABLE DATA vu_users
-- -------------------------------------------
INSERT INTO `vu_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) VALUES
('3','hlanga','','hlanga@unizar.es','','2015-02-11 13:38:23','2015-04-27 14:01:40','1','1');
INSERT INTO `vu_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) VALUES
('4','elinares','d41d8cd98f00b204e9800998ecf8427e','elinares@unizar.es','20dfa86cf5bd22de63eb4269bfd99ba2','2015-02-26 14:08:29','0000-00-00 00:00:00','0','1');
INSERT INTO `vu_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) VALUES
('5','feuz','5f4d98c9499da75d0fd440fc11447087','feuz@unizar.es','be59e35dea75c8037916b64f2e1b34ee','2015-02-27 13:14:44','2015-04-21 12:31:52','0','1');
INSERT INTO `vu_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) VALUES
('6','colaborador','c8f37be17cb9c58521083d062f500b3b','colabo@unizar.es','901353396f4366972b3bfd8267acb759','2015-04-21 12:15:58','2015-04-27 13:13:57','0','1');
INSERT INTO `vu_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) VALUES
('7','prueba','c893bad68927b457dbed39460e6afd62','prueba@p.com','82ca5638dd25edcadb0cbdcdf7d722e2','2015-04-27 12:52:13','0000-00-00 00:00:00','0','1');
INSERT INTO `vu_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) VALUES
('8','aaaaaaa','5d793fc5b00a2348c3fb9ab59e5ca98a','aaa@s.es','08392946782b271fa0e16270c8051c12','2015-04-27 12:54:33','0000-00-00 00:00:00','0','1');
INSERT INTO `vu_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) VALUES
('9','invitado','a6ae8a143d440ab8c006d799f682d48d','inv@itado.es','b0a7597828cc0fc30d6056213cfbe3c5','2015-04-27 12:57:16','0000-00-00 00:00:00','0','1');



-- -------------------------------------------
-- TABLE DATA vu_usuarioroles
-- -------------------------------------------
INSERT INTO `vu_usuarioroles` (`id`,`rol`) VALUES
('1','superadmin');
INSERT INTO `vu_usuarioroles` (`id`,`rol`) VALUES
('2','administrador');
INSERT INTO `vu_usuarioroles` (`id`,`rol`) VALUES
('3','colaborador');
INSERT INTO `vu_usuarioroles` (`id`,`rol`) VALUES
('4','consultor');
INSERT INTO `vu_usuarioroles` (`id`,`rol`) VALUES
('5','invitado');



-- -------------------------------------------
-- TABLE DATA vu_usuarios
-- -------------------------------------------
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('1','hlanga','hlanga@unizar.es','1','1');
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('2','allueva','allueva@unizar.es','1','1');
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('3','jlalejan','jlalejan@unizar.es','1','1');
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('4','elinares','elinares@unizar.es','1','1');
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('5','feuz','feuz@uniza.es','2','1');
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('6','raqueltl','raqueltl@unizar.es','3','1');
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('7','maytelo','maytelo@unizar.es','3','1');
INSERT INTO `vu_usuarios` (`id`,`usuario`,`email`,`rol`,`activado`) VALUES
('8','sergio','sergiocantin91@gmail.com','4','1');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
