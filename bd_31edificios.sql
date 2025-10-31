-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdgestiondeedificios
CREATE DATABASE IF NOT EXISTS `bdgestiondeedificios` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `bdgestiondeedificios`;

-- Volcando estructura para tabla bdgestiondeedificios.boletaxservicio
CREATE TABLE IF NOT EXISTS `boletaxservicio` (
  `idBoleta` int(11) NOT NULL AUTO_INCREMENT,
  `tipoServicioFK` int(11) DEFAULT NULL,
  `fechaEmision` timestamp NOT NULL DEFAULT current_timestamp(),
  `departamentoFK` int(11) DEFAULT NULL,
  `importe` decimal(7,2) DEFAULT NULL,
  `estadoFK` int(11) DEFAULT NULL,
  `fechaPago` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idBoleta`),
  KEY `BoletaXServicio_fk1_idx` (`departamentoFK`),
  KEY `BoletaXServicio_fk2_idx` (`estadoFK`),
  KEY `BoletaXsServicio_fk0_idx` (`tipoServicioFK`),
  CONSTRAINT `BoletaXServicio_fk1` FOREIGN KEY (`departamentoFK`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `BoletaXServicio_fk2` FOREIGN KEY (`estadoFK`) REFERENCES `estadoboleta` (`idEstadoBoleta`),
  CONSTRAINT `BoletaXsServicio_fk0` FOREIGN KEY (`tipoServicioFK`) REFERENCES `tiposervicio` (`idTipoServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.boletaxservicio: ~2 rows (aproximadamente)
DELETE FROM `boletaxservicio`;
INSERT INTO `boletaxservicio` (`idBoleta`, `tipoServicioFK`, `fechaEmision`, `departamentoFK`, `importe`, `estadoFK`, `fechaPago`) VALUES
	(181, 5, '2025-06-05 20:58:00', 41, 70.00, 3, NULL),
	(182, 7, '2025-06-05 20:58:00', 42, 50.00, 3, NULL);

-- Volcando estructura para tabla bdgestiondeedificios.controlvisita
CREATE TABLE IF NOT EXISTS `controlvisita` (
  `idVisita` int(11) NOT NULL AUTO_INCREMENT,
  `visitanteFK` int(11) DEFAULT NULL,
  `departamentoFK` int(11) DEFAULT NULL,
  `ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `salida` timestamp NULL DEFAULT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idVisita`),
  KEY `ControlVisita_fk0_idx` (`visitanteFK`),
  KEY `ControlVisita_fk1_idx` (`departamentoFK`),
  CONSTRAINT `ControlVisita_fk0` FOREIGN KEY (`visitanteFK`) REFERENCES `visitante` (`idVisitante`),
  CONSTRAINT `ControlVisita_fk1` FOREIGN KEY (`departamentoFK`) REFERENCES `departamento` (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.controlvisita: ~0 rows (aproximadamente)
DELETE FROM `controlvisita`;
INSERT INTO `controlvisita` (`idVisita`, `visitanteFK`, `departamentoFK`, `ingreso`, `salida`, `fechaRegistro`, `estado`, `comentario`) VALUES
	(17, 24, 42, '2025-06-05 22:11:49', NULL, '2025-06-05 22:11:49', 'Activo', 'No lleva nada');

-- Volcando estructura para tabla bdgestiondeedificios.departamento
CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `edificioFK` int(11) NOT NULL,
  `nroHabitaciones` int(11) NOT NULL,
  `nroDepartamento` int(11) NOT NULL,
  `areaM2` decimal(3,0) NOT NULL,
  `tipoDepartamentoFK` int(11) NOT NULL,
  `estadoFK` int(11) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `autorregistro` int(11) DEFAULT NULL,
  `piso` int(11) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`),
  KEY `Departamento_fk0` (`edificioFK`),
  KEY `Departamento_fk1` (`tipoDepartamentoFK`),
  KEY `Departamento_fk2` (`estadoFK`),
  KEY `Departamento_fk3_idx` (`autorregistro`),
  CONSTRAINT `Departamento_fk0` FOREIGN KEY (`edificioFK`) REFERENCES `edificio` (`idEdificio`),
  CONSTRAINT `Departamento_fk1` FOREIGN KEY (`tipoDepartamentoFK`) REFERENCES `tipodepartamento` (`idTipo`),
  CONSTRAINT `Departamento_fk2` FOREIGN KEY (`estadoFK`) REFERENCES `estadodepartamento` (`idEstado`),
  CONSTRAINT `Departamento_fk4` FOREIGN KEY (`autorregistro`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.departamento: ~2 rows (aproximadamente)
DELETE FROM `departamento`;
INSERT INTO `departamento` (`idDepartamento`, `edificioFK`, `nroHabitaciones`, `nroDepartamento`, `areaM2`, `tipoDepartamentoFK`, `estadoFK`, `fechaRegistro`, `autorregistro`, `piso`, `telefono`) VALUES
	(41, 29, 3, 101, 99, 12, 3, '2025-07-01 21:50:43', 10, 1, '987456123'),
	(42, 37, 2, 102, 75, 12, 4, '2025-07-02 22:18:04', 10, 11, '985236744'),
	(54, 29, 2, 105, 45, 12, 4, '2025-07-04 23:26:14', 10, 6, '949567275');

-- Volcando estructura para tabla bdgestiondeedificios.edificio
CREATE TABLE IF NOT EXISTS `edificio` (
  `idEdificio` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion` varchar(30) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `nroDePisos` int(11) NOT NULL,
  `nroDeDepartamentos` int(11) DEFAULT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEdificio`),
  UNIQUE KEY `denominacion` (`denominacion`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.edificio: ~5 rows (aproximadamente)
DELETE FROM `edificio`;
INSERT INTO `edificio` (`idEdificio`, `denominacion`, `direccion`, `nroDePisos`, `nroDeDepartamentos`, `fechaRegistro`, `estado`) VALUES
	(29, 'Sky Towers T1', 'Av. Arequipa 2562', 16, 116, '2025-06-12 20:48:07', 'Habilitado'),
	(30, 'Sky Towers T2', 'Av. Arequipa 2612', 12, 36, '2025-06-12 20:48:39', 'Habilitado'),
	(36, 'Sky Towers T3', 'Av arequipa 2571', 12, 30, '2025-07-01 14:39:12', 'Habilitado'),
	(37, 'Sky Tower 757', 'Javier Prado Oeste 757', 16, 116, '2025-07-01 14:39:00', 'Habilitado');

-- Volcando estructura para tabla bdgestiondeedificios.especiemascota
CREATE TABLE IF NOT EXISTS `especiemascota` (
  `idEspecie` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`idEspecie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.especiemascota: ~3 rows (aproximadamente)
DELETE FROM `especiemascota`;
INSERT INTO `especiemascota` (`idEspecie`, `descripcion`) VALUES
	(4, 'Perro'),
	(5, 'Gato'),
	(6, 'Ave');

-- Volcando estructura para tabla bdgestiondeedificios.estadoboleta
CREATE TABLE IF NOT EXISTS `estadoboleta` (
  `idEstadoBoleta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idEstadoBoleta`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.estadoboleta: ~3 rows (aproximadamente)
DELETE FROM `estadoboleta`;
INSERT INTO `estadoboleta` (`idEstadoBoleta`, `descripcion`) VALUES
	(3, 'Pendiente'),
	(4, 'En proceso'),
	(5, 'Completado');

-- Volcando estructura para tabla bdgestiondeedificios.estadodepartamento
CREATE TABLE IF NOT EXISTS `estadodepartamento` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.estadodepartamento: ~3 rows (aproximadamente)
DELETE FROM `estadodepartamento`;
INSERT INTO `estadodepartamento` (`idEstado`, `descripcion`) VALUES
	(3, 'Ocupado'),
	(4, 'Desocupado'),
	(5, 'En mantenimiento');

-- Volcando estructura para tabla bdgestiondeedificios.estadoincidente
CREATE TABLE IF NOT EXISTS `estadoincidente` (
  `idEstadoIncidente` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idEstadoIncidente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.estadoincidente: ~3 rows (aproximadamente)
DELETE FROM `estadoincidente`;
INSERT INTO `estadoincidente` (`idEstadoIncidente`, `descripcion`) VALUES
	(3, 'Reportado'),
	(4, 'En revisión'),
	(5, 'Solucionado');

-- Volcando estructura para tabla bdgestiondeedificios.incidentes
CREATE TABLE IF NOT EXISTS `incidentes` (
  `idIncidentes` int(11) NOT NULL AUTO_INCREMENT,
  `departamentoFK` int(11) NOT NULL,
  `usuarioFK` int(11) NOT NULL,
  `tipoIncidenteFK` int(11) NOT NULL,
  `estadoFK` int(11) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `fechaIncidente` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idIncidentes`),
  KEY `Incidentes_fk0_idx` (`departamentoFK`),
  KEY `Incidentes_fk2_idx` (`tipoIncidenteFK`),
  KEY `Incidente_fk3_idx` (`estadoFK`),
  KEY `Incidentes_fk4_idx` (`usuarioFK`),
  CONSTRAINT `Incidente_fk3` FOREIGN KEY (`estadoFK`) REFERENCES `estadoincidente` (`idEstadoIncidente`),
  CONSTRAINT `Incidentes_fk0` FOREIGN KEY (`departamentoFK`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `Incidentes_fk2` FOREIGN KEY (`tipoIncidenteFK`) REFERENCES `tipoincidente` (`idTipoIncidente`),
  CONSTRAINT `Incidentes_fk4` FOREIGN KEY (`usuarioFK`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.incidentes: ~2 rows (aproximadamente)
DELETE FROM `incidentes`;
INSERT INTO `incidentes` (`idIncidentes`, `departamentoFK`, `usuarioFK`, `tipoIncidenteFK`, `estadoFK`, `comentario`, `fechaIncidente`) VALUES
	(7, 41, 11, 6, 3, 'Revisando', '2025-06-05 21:59:58'),
	(8, 42, 11, 6, 4, 'Quedo bien', '2025-06-05 21:59:58');

-- Volcando estructura para tabla bdgestiondeedificios.mascotas
CREATE TABLE IF NOT EXISTS `mascotas` (
  `idMascota` int(11) NOT NULL AUTO_INCREMENT,
  `departamentoFK` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `especieFK` int(11) NOT NULL,
  PRIMARY KEY (`idMascota`),
  KEY `Mascotas_fk0` (`departamentoFK`),
  KEY `Mascotas_fk1` (`especieFK`),
  CONSTRAINT `Mascotas_fk0` FOREIGN KEY (`departamentoFK`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `Mascotas_fk1` FOREIGN KEY (`especieFK`) REFERENCES `especiemascota` (`idEspecie`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.mascotas: ~3 rows (aproximadamente)
DELETE FROM `mascotas`;
INSERT INTO `mascotas` (`idMascota`, `departamentoFK`, `nombre`, `especieFK`) VALUES
	(10, 41, 'Rocky', 4),
	(11, 41, 'Gata', 4);

-- Volcando estructura para tabla bdgestiondeedificios.ocupantes
CREATE TABLE IF NOT EXISTS `ocupantes` (
  `idOcupante` int(11) NOT NULL AUTO_INCREMENT,
  `departamentoFK` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apePaterno` varchar(255) NOT NULL,
  `apeMaterno` varchar(255) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `celular` varchar(9) DEFAULT NULL,
  `sexoFK` int(11) NOT NULL,
  `relacionFK` int(11) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idOcupante`),
  KEY `Ocupantes_fk0` (`departamentoFK`),
  KEY `Ocupantes_fk1` (`sexoFK`),
  KEY `Ocupantes_fk2` (`relacionFK`),
  CONSTRAINT `Ocupantes_fk0` FOREIGN KEY (`departamentoFK`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `Ocupantes_fk1` FOREIGN KEY (`sexoFK`) REFERENCES `sexo` (`idSexo`),
  CONSTRAINT `Ocupantes_fk2` FOREIGN KEY (`relacionFK`) REFERENCES `relacionconpropietario` (`idRelacion`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.ocupantes: ~2 rows (aproximadamente)
DELETE FROM `ocupantes`;
INSERT INTO `ocupantes` (`idOcupante`, `departamentoFK`, `nombres`, `apePaterno`, `apeMaterno`, `dni`, `celular`, `sexoFK`, `relacionFK`, `fechaRegistro`, `estado`) VALUES
	(20, 41, 'Miguel', 'Valencia', 'Martinez', '75696123', '987456369', 6, 6, '2025-06-05 22:33:11', 'Activo');

-- Volcando estructura para tabla bdgestiondeedificios.propietariodep
CREATE TABLE IF NOT EXISTS `propietariodep` (
  `idPropietario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) NOT NULL,
  `apePaterno` varchar(255) NOT NULL,
  `apeMaterno` varchar(255) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `celular` varchar(9) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `sexoFK` int(11) NOT NULL,
  `departamentoFK` int(11) DEFAULT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  `autorregistro` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPropietario`),
  KEY `PropietarioDep_fk0` (`sexoFK`),
  KEY `PropietarioDep_fk1_idx` (`departamentoFK`),
  KEY `PropietarioDep_fk2_idx` (`autorregistro`),
  CONSTRAINT `PropietarioDep_fk0` FOREIGN KEY (`sexoFK`) REFERENCES `sexo` (`idSexo`),
  CONSTRAINT `PropietarioDep_fk1` FOREIGN KEY (`departamentoFK`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `PropietarioDep_fk2` FOREIGN KEY (`autorregistro`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.propietariodep: ~4 rows (aproximadamente)
DELETE FROM `propietariodep`;
INSERT INTO `propietariodep` (`idPropietario`, `nombres`, `apePaterno`, `apeMaterno`, `dni`, `celular`, `correo`, `sexoFK`, `departamentoFK`, `fechaRegistro`, `estado`, `autorregistro`) VALUES
	(39, 'Juan', 'Valencia', 'Torres', '76708963', '963258741', 'dueno1@gmail.com', 6, 41, '2025-06-05 21:34:28', 'Activo', 10),
	(40, 'Vanessa', 'Ponte', 'Mori', '76708741', '963258842', 'dueno2@gmail.com', 7, 42, '2025-06-05 21:34:28', 'Activo', 10),
	(41, 'Kevin', 'Torres', 'Arista', '76706249', '970838672', 'torres.arista99@gmail.com', 6, 41, '2025-07-04 19:33:54', 'Activo', 10);

-- Volcando estructura para tabla bdgestiondeedificios.relacionconpropietario
CREATE TABLE IF NOT EXISTS `relacionconpropietario` (
  `idRelacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idRelacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.relacionconpropietario: ~4 rows (aproximadamente)
DELETE FROM `relacionconpropietario`;
INSERT INTO `relacionconpropietario` (`idRelacion`, `descripcion`) VALUES
	(4, 'Padre'),
	(5, 'Madre'),
	(6, 'Hijo/a'),
	(7, 'Otro');

-- Volcando estructura para tabla bdgestiondeedificios.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionRol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.rol: ~3 rows (aproximadamente)
DELETE FROM `rol`;
INSERT INTO `rol` (`idRol`, `descripcionRol`) VALUES
	(4, 'Administrador'),
	(5, 'Usuario'),
	(6, 'Vigilante');

-- Volcando estructura para tabla bdgestiondeedificios.sexo
CREATE TABLE IF NOT EXISTS `sexo` (
  `idSexo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`idSexo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.sexo: ~2 rows (aproximadamente)
DELETE FROM `sexo`;
INSERT INTO `sexo` (`idSexo`, `descripcion`) VALUES
	(6, 'Masculino'),
	(7, 'Femenino');

-- Volcando estructura para tabla bdgestiondeedificios.tipodepartamento
CREATE TABLE IF NOT EXISTS `tipodepartamento` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.tipodepartamento: ~7 rows (aproximadamente)
DELETE FROM `tipodepartamento`;
INSERT INTO `tipodepartamento` (`idTipo`, `descripcion`) VALUES
	(8, 'Estudio'),
	(9, 'Estandar'),
	(10, 'Flats'),
	(11, 'Duplex'),
	(12, 'Penthouses'),
	(14, 'Lofts');

-- Volcando estructura para tabla bdgestiondeedificios.tipoincidente
CREATE TABLE IF NOT EXISTS `tipoincidente` (
  `idTipoIncidente` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idTipoIncidente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.tipoincidente: ~3 rows (aproximadamente)
DELETE FROM `tipoincidente`;
INSERT INTO `tipoincidente` (`idTipoIncidente`, `descripcion`) VALUES
	(6, 'Electrico'),
	(7, 'Plomería'),
	(8, 'Seguridad');

-- Volcando estructura para tabla bdgestiondeedificios.tiposervicio
CREATE TABLE IF NOT EXISTS `tiposervicio` (
  `idTipoServicio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idTipoServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.tiposervicio: ~3 rows (aproximadamente)
DELETE FROM `tiposervicio`;
INSERT INTO `tiposervicio` (`idTipoServicio`, `descripcion`) VALUES
	(5, 'Limpieza'),
	(6, 'Mantenimiento'),
	(7, 'Jardinería');

-- Volcando estructura para tabla bdgestiondeedificios.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) DEFAULT NULL,
  `apePaterno` varchar(255) DEFAULT NULL,
  `apeMaterno` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `Usuario_fk0_idx` (`idRol`),
  CONSTRAINT `Usuario_fk0` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.usuario: ~2 rows (aproximadamente)
DELETE FROM `usuario`;
INSERT INTO `usuario` (`idUsuario`, `nombres`, `apePaterno`, `apeMaterno`, `usuario`, `contrasena`, `idRol`) VALUES
	(10, 'Sergio', 'Ventura', 'Matto', 'sventura', '8963', 4),
	(11, 'Kevin', 'Torres', 'Arista', 'ktorres', '5678', 5);

-- Volcando estructura para tabla bdgestiondeedificios.visitante
CREATE TABLE IF NOT EXISTS `visitante` (
  `idVisitante` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) DEFAULT NULL,
  `apePaterno` varchar(255) DEFAULT NULL,
  `apeMaterno` varchar(255) DEFAULT NULL,
  `dni` char(8) DEFAULT NULL,
  `sexoFK` int(11) DEFAULT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idVisitante`),
  KEY `Visitante_fk0_idx` (`sexoFK`),
  CONSTRAINT `Visitante_fk0` FOREIGN KEY (`sexoFK`) REFERENCES `sexo` (`idSexo`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla bdgestiondeedificios.visitante: ~2 rows (aproximadamente)
DELETE FROM `visitante`;
INSERT INTO `visitante` (`idVisitante`, `nombres`, `apePaterno`, `apeMaterno`, `dni`, `sexoFK`, `fechaRegistro`, `estado`) VALUES
	(23, 'Pablo', 'Rios', 'Martinez', '78415263', 6, '2025-06-05 22:06:30', 'Activo'),
	(24, 'Fabio', 'Agostini', 'Tiny', '33225566', 6, '2025-06-05 22:06:30', 'Activo');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
