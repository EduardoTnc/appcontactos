-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para app-contactos
CREATE DATABASE IF NOT EXISTS `app-contactos` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `app-contactos`;

-- Volcando estructura para tabla app-contactos.contactos
CREATE TABLE IF NOT EXISTS `contactos` (
  `contacto_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `foto_perfil` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `etiqueta` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`contacto_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- Volcando datos para la tabla app-contactos.contactos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla app-contactos.contacto_grupo
CREATE TABLE IF NOT EXISTS `contacto_grupo` (
  `contacto_grupo_id` int NOT NULL AUTO_INCREMENT,
  `contacto_id` int DEFAULT NULL,
  `creacion_grupo_id` int DEFAULT NULL,
  PRIMARY KEY (`contacto_grupo_id`),
  KEY `contacto_id` (`contacto_id`),
  KEY `creacion_grupo_id` (`creacion_grupo_id`),
  CONSTRAINT `contacto_grupo_ibfk_1` FOREIGN KEY (`contacto_id`) REFERENCES `contactos` (`contacto_id`) ON DELETE CASCADE,
  CONSTRAINT `contacto_grupo_ibfk_2` FOREIGN KEY (`creacion_grupo_id`) REFERENCES `creacion_grupo` (`creacion_grupo_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- Volcando datos para la tabla app-contactos.contacto_grupo: ~0 rows (aproximadamente)

-- Volcando estructura para tabla app-contactos.creacion_grupo
CREATE TABLE IF NOT EXISTS `creacion_grupo` (
  `creacion_grupo_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `nombre_grupo` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `foto_grupo` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`creacion_grupo_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `creacion_grupo_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- Volcando datos para la tabla app-contactos.creacion_grupo: ~0 rows (aproximadamente)

-- Volcando estructura para tabla app-contactos.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `contrasenia` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- Volcando datos para la tabla app-contactos.usuarios: ~0 rows (aproximadamente)
INSERT IGNORE INTO `usuarios` (`usuario_id`, `nombre`, `email`, `contrasenia`, `fecha_registro`) VALUES
	(1, 'admin', 'admin@gmail.com', '$2y$10$D9TvQWtHJ936LIB1pQzM8ezhMbo8f2Jv57pN.zKS2TWnmodl2Q.nS', '2024-05-21 15:42:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
