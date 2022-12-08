/*
SQLyog Community v13.1.8 (64 bit)
MySQL - 8.0.31 : Database - square-app
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `avvisi` */

DROP TABLE IF EXISTS `avvisi`;

CREATE TABLE `avvisi` (
  `id_avviso` INT NOT NULL AUTO_INCREMENT,
  `titolo` VARCHAR(100) DEFAULT NULL,
  `descrizione` VARCHAR(255) DEFAULT NULL,
  `descrizione_lunga` TEXT,
  `dal` DATETIME DEFAULT NULL,
  `al` DATETIME DEFAULT NULL,
  `record_attivo` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_avviso`)
) ENGINE=INNODB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `denominazione` VARCHAR(100) DEFAULT NULL,
  `sede` VARCHAR(100) DEFAULT NULL,
  `telefono` VARCHAR(20) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `email_support` VARCHAR(100) DEFAULT NULL,
  `web` VARCHAR(100) DEFAULT NULL COMMENT 'Indirizzo del gestionale',
  `is_offline` TINYINT(1) NOT NULL DEFAULT '0',
  `is_debug` TINYINT(1) NOT NULL DEFAULT '0',
  `is_collaudo` TINYINT(1) NOT NULL DEFAULT '0',
  `mail_enable` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Abilitare l''invio della mail',
  `mail_smtp` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Abilitare l''invio tramite server SMTP',
  `mail_smtp_server` VARCHAR(45) DEFAULT NULL,
  `mail_smtp_auth` TINYINT(1) NOT NULL DEFAULT '0',
  `mail_smtp_user` VARCHAR(45) DEFAULT NULL,
  `mail_smtp_password` VARCHAR(45) DEFAULT NULL,
  `mail_smtp_port` INT DEFAULT NULL,
  `mail_smtp_secure` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Abilitare la protezione',
  `mail_smtp_secure_type` VARCHAR(45) DEFAULT NULL,
  `mail_smtp_debug` CHAR(1) DEFAULT NULL COMMENT '0 = disattivato, 4: massimo',
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

/*Table structure for table `faq` */

DROP TABLE IF EXISTS `faq`;

CREATE TABLE `faq` (
  `id_faq` INT NOT NULL AUTO_INCREMENT,
  `answer` TEXT,
  `question` TEXT,
  PRIMARY KEY (`id_faq`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `help` */

DROP TABLE IF EXISTS `help`;

CREATE TABLE `help` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `alias` VARCHAR(100) NOT NULL,
  `text` TEXT,
  `title` TINYTEXT,
  `id_gruppo` INT DEFAULT NULL,
  `stato` VARCHAR(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Inserito',
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`) USING BTREE,
  KEY `id_gruppo` (`id_gruppo`) USING BTREE,
  CONSTRAINT `help_ibfk_1` FOREIGN KEY (`id_gruppo`) REFERENCES `utenti_gruppi` (`id_gruppo_utente`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `servizi` */

DROP TABLE IF EXISTS `servizi`;

CREATE TABLE `servizi` (
  `id_servizio` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `servizio` VARCHAR(45) DEFAULT NULL,
  `descrizione` VARCHAR(100) DEFAULT NULL,
  `menu` VARCHAR(100) DEFAULT NULL,
  `posizione` TINYINT NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_servizio`),
  KEY `servizio` (`servizio`)
) ENGINE=INNODB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `servizi_config_gruppo` */

DROP TABLE IF EXISTS `servizi_config_gruppo`;

CREATE TABLE `servizi_config_gruppo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_servizio` INT UNSIGNED NOT NULL,
  `id_gruppo_utente` INT NOT NULL,
  `is_attivo` TINYINT(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_servizio` (`id_servizio`) USING BTREE,
  KEY `id_gruppo_utente` (`id_gruppo_utente`) USING BTREE,
  CONSTRAINT `servizi_config_gruppo_ibfk_1` FOREIGN KEY (`id_servizio`) REFERENCES `servizi` (`id_servizio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `servizi_config_gruppo_ibfk_3` FOREIGN KEY (`id_gruppo_utente`) REFERENCES `utenti_gruppi` (`id_gruppo_utente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `servizi_default` */

DROP TABLE IF EXISTS `servizi_default`;

CREATE TABLE `servizi_default` (
  `id_servizio_default` INT NOT NULL AUTO_INCREMENT,
  `id_servizio` INT UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_servizio_default`),
  KEY `id_servizio` (`id_servizio`) USING BTREE,
  CONSTRAINT `servizi_default_ibfk_1` FOREIGN KEY (`id_servizio`) REFERENCES `servizi` (`id_servizio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `servizi_gruppo` */

DROP TABLE IF EXISTS `servizi_gruppo`;

CREATE TABLE `servizi_gruppo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_servizio` INT UNSIGNED NOT NULL,
  `id_gruppo_utente` INT NOT NULL,
  `is_attivo` TINYINT(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_servizio` (`id_servizio`),
  KEY `id_gruppo_utente` (`id_gruppo_utente`),
  CONSTRAINT `servizi_gruppo_ibfk_1` FOREIGN KEY (`id_servizio`) REFERENCES `servizi` (`id_servizio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `servizi_gruppo_ibfk_3` FOREIGN KEY (`id_gruppo_utente`) REFERENCES `utenti_gruppi` (`id_gruppo_utente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `servizi_utenti` */

DROP TABLE IF EXISTS `servizi_utenti`;

CREATE TABLE `servizi_utenti` (
  `id_utente` INT NOT NULL,
  `id_azienda` INT NOT NULL,
  `id_servizio` INT UNSIGNED NOT NULL,
  `id_gruppo` INT NOT NULL,
  PRIMARY KEY (`id_utente`,`id_azienda`,`id_servizio`,`id_gruppo`),
  KEY `id_servizio` (`id_servizio`) USING BTREE,
  KEY `id_utente` (`id_utente`) USING BTREE,
  CONSTRAINT `servizi_utenti_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `servizi_utenti_ibfk_2` FOREIGN KEY (`id_servizio`) REFERENCES `servizi` (`id_servizio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `traduzioni` */

DROP TABLE IF EXISTS `traduzioni`;

CREATE TABLE `traduzioni` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `alias` VARCHAR(255) NOT NULL,
  `en_US` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`alias`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=INNODB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `uploads` */

DROP TABLE IF EXISTS `uploads`;

CREATE TABLE `uploads` (
  `id_upload` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(100) DEFAULT NULL,
  `descrizione` VARCHAR(100) DEFAULT NULL,
  `id_utente` INT DEFAULT NULL,
  `tipo` VARCHAR(45) DEFAULT NULL,
  `dettaglio` VARCHAR(100) DEFAULT NULL,
  `dettaglio2` VARCHAR(100) DEFAULT NULL,
  `folder` VARCHAR(100) DEFAULT NULL,
  `record_attivo` TINYINT(1) DEFAULT '1',
  `orario` DATETIME DEFAULT NULL,
  `is_fonte_sian` TINYINT(1) DEFAULT '0',
  `is_public` TINYINT(1) DEFAULT '0',
  PRIMARY KEY (`id_upload`)
) ENGINE=INNODB AUTO_INCREMENT=4885 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `utenti` */

DROP TABLE IF EXISTS `utenti`;

CREATE TABLE `utenti` (
  `id_utente` INT NOT NULL AUTO_INCREMENT,
  `record_attivo` TINYINT(1) DEFAULT '0',
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `readonly` TINYINT(1) DEFAULT '0',
  `cognome` VARCHAR(45) DEFAULT NULL,
  `nome` VARCHAR(45) DEFAULT NULL,
  `email` VARCHAR(45) DEFAULT NULL,
  `ts_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ts_confirm` TIMESTAMP NULL DEFAULT NULL,
  `token` VARCHAR(45) DEFAULT NULL,
  `default_page` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`id_utente`)
) ENGINE=INNODB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb3;

/*Table structure for table `utenti_gruppi` */

DROP TABLE IF EXISTS `utenti_gruppi`;

CREATE TABLE `utenti_gruppi` (
  `id_gruppo_utente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descrizione` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_gruppo_utente`)
) ENGINE=INNODB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
INSERT INTO `utenti_gruppi` (`nome`, `descrizione`)VALUES('superuser', 'Superuser');

/*Table structure for table `utenti_has_gruppi` */

DROP TABLE IF EXISTS `utenti_has_gruppi`;

CREATE TABLE `utenti_has_gruppi` (
  `id_utente` int NOT NULL,
  `id_gruppo_utente` int NOT NULL,
  `id_organizzazione` int DEFAULT NULL,
  `tipo_organizzazione` varchar(100) DEFAULT NULL,
  `codice_organizzazione` varchar(45) DEFAULT NULL,
  `organizzazione` varchar(255) DEFAULT NULL,
  `istat_provincia` char(3) DEFAULT NULL,
  PRIMARY KEY (`id_utente`,`id_gruppo_utente`),
  KEY `id_gruppo_utente` (`id_gruppo_utente`) USING BTREE,
  CONSTRAINT `utenti_has_gruppi_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `utenti_has_gruppi_ibfk_2` FOREIGN KEY (`id_gruppo_utente`) REFERENCES `utenti_gruppi` (`id_gruppo_utente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `utenti_online` */

DROP TABLE IF EXISTS `utenti_online`;

CREATE TABLE `utenti_online` (
  `id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_utente` int NOT NULL,
  `ip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tm` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `page` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id_utente`),
  KEY `user` (`id`),
  KEY `tm` (`tm`) USING BTREE,
  KEY `id_utente` (`id_utente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `utenti_permessi` */

DROP TABLE IF EXISTS `utenti_permessi`;

CREATE TABLE `utenti_permessi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_gruppo` int DEFAULT NULL,
  `id_risorsa` int unsigned DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `update` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_risorsa` (`id_risorsa`),
  KEY `utenti_permessi_ibfk_1` (`id_gruppo`),
  CONSTRAINT `utenti_permessi_ibfk_1` FOREIGN KEY (`id_gruppo`) REFERENCES `utenti_gruppi` (`id_gruppo_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `utenti_permessi_ibfk_2` FOREIGN KEY (`id_risorsa`) REFERENCES `utenti_permessi_risorse` (`id_risorsa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `utenti_permessi_risorse` */

DROP TABLE IF EXISTS `utenti_permessi_risorse`;

CREATE TABLE `utenti_permessi_risorse` (
  `id_risorsa` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('OBJECT','PAGE') NOT NULL,
  `default` tinyint(1) DEFAULT '0' COMMENT 'Solo per i tipi OBJECT, escluso Fascicolo ed Azienda',
  PRIMARY KEY (`id_risorsa`,`name`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=535 DEFAULT CHARSET=utf8mb3;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
