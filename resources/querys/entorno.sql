-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.4.13-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla reality2_postalmarketing.country
CREATE TABLE IF NOT EXISTS `country` (
  `id_country` int(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla reality2_postalmarketing.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int(10) NOT NULL AUTO_INCREMENT,
  `id_modelo` int(10) NOT NULL,
  `empresa` varchar(30) NOT NULL,
  PRIMARY KEY (`id_empresa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

CREATE TABLE `express` (
	`id_cliente` INT(15) NOT NULL AUTO_INCREMENT,
	`id_local` INT(40) NULL DEFAULT NULL,
	`cod_empresa` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`tipo` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`empresa` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`equipo` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`tarjeta` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`terminal` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`serie` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`serie_base` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`idd` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_orden` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_actividad` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`identificacion` VARCHAR(60) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`nombre_cliente` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`direccion` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`localidad` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`codigo_postal` INT(8) NULL DEFAULT NULL,
	`provincia` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_creacion` VARCHAR(30) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono1` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono2` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono_fijo1` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono_fijo2` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono_fijo3` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono_fijo4` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono_fijo5` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`telefono_fijo6` VARCHAR(80) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_de_envio` VARCHAR(60) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cartera` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`baja` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_recolector` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_fecha_recolector` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`remito_rend` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`remito_cv` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_rend_cv` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_operador_ren` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_motivo_ren` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`master_box` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_operador` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha` VARCHAR(30) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_motivo` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`tabla_oper` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`multiples` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cable_hdmi` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cable_av` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fuente` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`control_1` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`email_enviado` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`otros` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`remito_sub` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_remito_sub` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_asignado` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`sub_asignado` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`ciclo` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`zona` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_premio` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`mes_base` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`R1` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`R2` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`R3` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`operador` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`tipo_de_recupero` VARCHAR(60) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`semanas` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`ano_semana` VARCHAR(30) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_de_liquidacion` VARCHAR(20) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`hist_pactados` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`estado_rec` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`horario_rec` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`estado_pac` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`horario_pac` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`password_rec` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`emailcliente` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_user` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`adicional` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`otrosaccesorios` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`id_orden_pass` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`order_rec` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`latitude` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`longitude` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`cod_search` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`url` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`fecha_add` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`data` DATETIME NULL DEFAULT NULL ON UPDATE current_timestamp(),
	PRIMARY KEY (`id_cliente`) USING BTREE,
	INDEX `identificacion` (`identificacion`) USING BTREE,
	INDEX `tarjeta` (`tarjeta`) USING BTREE,
	INDEX `id_motivo_ren` (`id_motivo_ren`) USING BTREE,
	INDEX `id_motivo` (`id_motivo`) USING BTREE,
	INDEX `tabla_oper` (`tabla_oper`) USING BTREE,
	INDEX `order_rec` (`order_rec`) USING BTREE,
	INDEX `emailcliente` (`emailcliente`) USING BTREE,
	INDEX `serie` (`terminal`) USING BTREE,
	INDEX `id` (`id_local`) USING BTREE,
	INDEX `id_recolector_2` (`id_user`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=100008
;


-- Volcando estructura para tabla reality2_postalmarketing.firmas
CREATE TABLE IF NOT EXISTS `firmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass_id` varchar(100) NOT NULL DEFAULT '',
  `fecha_firma` varchar(30) NOT NULL,
  `aclaracion` varchar(100) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `momento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla reality2_postalmarketing.localities
CREATE TABLE IF NOT EXISTS `localities` (
  `id_locate` int(11) NOT NULL AUTO_INCREMENT,
  `locate` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `postal_code` int(10) DEFAULT NULL,
  `id_province` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_locate`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1865 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla reality2_postalmarketing.modelos_equipos
CREATE TABLE IF NOT EXISTS `modelos_equipos` (
  `id_modelo` int(10) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `ini_empresa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_modelo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

CREATE TABLE `nuevos_clientes` (
	`id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
	`documento` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	`numero_documento` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nombre` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`apellido` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`direccion` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
	`provincia` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
	`localidad` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`codigo_postal` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`telefono` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`motivo_interno` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`empresa` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`terminal` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`serie` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`modelo` VARCHAR(80) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`motivo_solicitud` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fecha_solicitud` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`id_user` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id_cliente`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=8
;


CREATE TABLE `clientes_consignacion` (
	`id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
	`documento` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	`numero_documento` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nombre` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`apellido` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`direccion` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
	`provincia` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_general_ci',
	`localidad` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`codigo_postal` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`telefono` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`empresa` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`terminal` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`serie` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`modelo` VARCHAR(80) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`motivo_solicitud` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fecha_solicitud` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`motivo_interno` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`id_user` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id_cliente`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=12
;

-- Volcando estructura para tabla reality2_postalmarketing.numeros_oper
CREATE TABLE IF NOT EXISTS `numeros_oper` (
  `oper` varchar(20) DEFAULT NULL,
  `id_oper` int(10) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla reality2_postalmarketing.ordenes
CREATE TABLE IF NOT EXISTS `ordenes` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(100) DEFAULT NULL,
  `fecha_orden` varchar(100) DEFAULT NULL,
  `momento` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_orden`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=418 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla reality2_postalmarketing.postal_code
CREATE TABLE IF NOT EXISTS `postal_code` (
  `province` varchar(25) DEFAULT NULL,
  `postal_code` int(15) DEFAULT NULL,
  `id_province` int(5) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla reality2_postalmarketing.province
CREATE TABLE IF NOT EXISTS `province` (
  `id_province` int(10) NOT NULL AUTO_INCREMENT,
  `province` varchar(35) DEFAULT NULL,
  `id_country` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_province`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.



-- Volcando estructura para tabla reality2_postalmarketing.transito
CREATE TABLE IF NOT EXISTS `transito` (
  `id_transito` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(50) DEFAULT NULL,
  `id_orden_pass` varchar(100) NOT NULL,
  `id_orden` varchar(50) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_user_update` varchar(100) NOT NULL,
  `identificacion` varchar(100) NOT NULL,
  `nombre_recolector` varchar(100) DEFAULT NULL,
  `terminal` varchar(80) DEFAULT NULL,
  `serie` varchar(70) DEFAULT NULL,
  `serie_base` varchar(50) DEFAULT NULL,
  `tarjeta` varchar(20) DEFAULT NULL,
  `chip_alternativo` varchar(50) DEFAULT NULL,
  `accesorio_uno` varchar(20) NOT NULL,
  `accesorio_dos` varchar(20) NOT NULL,
  `accesorio_tres` varchar(20) NOT NULL,
  `accesorio_cuatro` varchar(20) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `fecha_update` varchar(50) NOT NULL,
  `accesorios` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `momento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_transito` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_transito`) USING BTREE,
  KEY `estado` (`estado`) USING BTREE,
  KEY `identificacion` (`identificacion`),
  KEY `id_local` (`id_cliente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

CREATE TABLE `users` (
	`id_user` INT(11) NOT NULL AUTO_INCREMENT,
	`user_managent_id` INT(11) NOT NULL DEFAULT '0',
	`mail` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`mail_hash` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`password` VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	`password_hash` VARCHAR(200) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	`first_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`last_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`name_alternative` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`date_of_birth` DATE NULL DEFAULT NULL,
	`id_number` VARCHAR(30) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`type_document` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`id_expiration_date` DATE NULL DEFAULT NULL,
	`knowledge_path` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`unemployment_insurance` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`insurance_expiration_date` DATE NULL DEFAULT NULL,
	`province` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`home_address` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`postal_code` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`country` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`location` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`phone_number` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`civil_status` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`sons` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`studies_completed` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`finished` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`other_knowledge` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`brand_of_vehicle` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`vehicle_type` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`vehicle_brand` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`vehicle_model` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`patent` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`year_of_vehicle` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`drivers_license` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`business_sector` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`drivers_license_expiration` DATE NULL DEFAULT NULL,
	`business_one` DATE NULL DEFAULT NULL,
	`business_two` DATE NULL DEFAULT NULL,
	`last_job` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`last_job_two` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`start_date` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`start_date_two` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`finish_date` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`finish_date_two` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`company_phone_number` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`company_phone_number_two` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`contact_company` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`reason_egress` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`reason_egress_two` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`antecedents_or_restrictions` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`customer_service_hours` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`monotribute` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`cbu` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`cuit` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`bank` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`type_request` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`rol` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`status_process` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`status_notifications` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`status_signed` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`status_pass` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`email_status` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`img_document_front` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`img_document_post` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`img_cuil_rut` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`img_monotribute` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`img_home` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`img_person` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`img_signed` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`signed_date` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`momento` DATETIME NULL DEFAULT NULL ON UPDATE current_timestamp(),
	`motion_data` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`date_pass` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id_user`) USING BTREE,
	UNIQUE INDEX `mail` (`mail`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=18
;




-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
