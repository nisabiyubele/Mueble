/*
La contraseña: incriptada es: test12345 
*/
CREATE DATABASE login;

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) DEFAULT NULL,
  `Apellido` varchar(80) DEFAULT NULL,
  `Correo` varchar(40) DEFAULT NULL,
  `Contra` varchar(255) DEFAULT NULL,
  `CodRecup` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tb_login` VALUES ('1', 'Marcos', 'Mamani Quispe', 'marcos@gmail.com', '$P$9IQRaTwmfeRo7ud9Fh4E2PdI0S3r.L0', null);

