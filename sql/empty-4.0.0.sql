DROP TABLE IF EXISTS `glpi_plugin_webapplications_webapplicationservertypes`;
CREATE TABLE `glpi_plugin_webapplications_webapplicationservertypes` (
  `id`      int unsigned NOT NULL        AUTO_INCREMENT,
  `name`    VARCHAR(255)
            COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` TEXT COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `glpi_plugin_webapplications_webapplicationservertypes` VALUES ('1', 'Apache', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationservertypes` VALUES ('2', 'IIS', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationservertypes` VALUES ('3', 'Nginx', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationservertypes` VALUES ('4', 'PRTG', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationservertypes` VALUES ('5', 'Tomcat', '');


DROP TABLE IF EXISTS `glpi_plugin_webapplications_webapplicationtypes`;
CREATE TABLE `glpi_plugin_webapplications_webapplicationtypes` (
  `id`           int unsigned NOT NULL        AUTO_INCREMENT,
  `entities_id`  int unsigned NOT NULL        DEFAULT '0',
  `name`         VARCHAR(255)
                 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment`      TEXT COLLATE utf8mb4_unicode_ci,
  `is_recursive` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `entities_id` (`entities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `glpi_plugin_webapplications_webapplicationtechnics`;
CREATE TABLE `glpi_plugin_webapplications_webapplicationtechnics` (
  `id`      int unsigned NOT NULL        AUTO_INCREMENT,
  `name`    VARCHAR(255)
            COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` TEXT COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `glpi_plugin_webapplications_webapplicationtechnics` VALUES ('1', 'Asp', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationtechnics` VALUES ('2', 'Cgi', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationtechnics` VALUES ('3', 'Java', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationtechnics` VALUES ('4', 'Perl', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationtechnics` VALUES ('5', 'Php', '');
INSERT INTO `glpi_plugin_webapplications_webapplicationtechnics` VALUES ('6', '.Net', '');

DROP TABLE IF EXISTS `glpi_plugin_webapplications_webapplicationexternalexpositions`;
CREATE TABLE `glpi_plugin_webapplications_webapplicationexternalexpositions` (
  `id`      int unsigned NOT NULL        AUTO_INCREMENT,
  `name`    VARCHAR(255)
            COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` TEXT COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `glpi_plugin_webapplications_appliances`;
CREATE TABLE `glpi_plugin_webapplications_appliances` (
   `id` int unsigned NOT NULL auto_increment,
   `appliances_id`  int unsigned NOT NULL        DEFAULT '0',
   `webapplicationtypes_id`       int unsigned    NOT NULL     DEFAULT '0'
        COMMENT 'RELATION to glpi_plugin_webapplications_webapplicationtypes (id)',
   `webapplicationservertypes_id` int unsigned    NOT NULL     DEFAULT '0'
        COMMENT 'RELATION to glpi_plugin_webapplications_webapplicationservertypes (id)',
   `webapplicationtechnics_id`    int unsigned    NOT NULL     DEFAULT '0'
        COMMENT 'RELATION to glpi_plugin_webapplications_webapplicationtechnics (id)',
   `webapplicationexternalexpositions_id` int unsigned  NOT NULL     DEFAULT '0'
       COMMENT 'RELATION to glpi_plugin_webapplications_webapplicationexternalexpositions (id)',
   `webapplicationreferringdepartmentvalidation` tinyint NOT NULL default '0',
   `webapplicationciovalidation` tinyint NOT NULL default '0',
   `webapplicationavailabilities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationintegrities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationconfidentialities` int unsigned   NOT NULL     DEFAULT '0',
   `webapplicationtraceabilities` int unsigned   NOT NULL     DEFAULT '1',
   `address` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `backoffice`  VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   PRIMARY KEY  (`id`),
   KEY `appliances_id` (`appliances_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `glpi_plugin_webapplications_databases`;
CREATE TABLE `glpi_plugin_webapplications_databases` (
   `id` int unsigned NOT NULL auto_increment,
   `databases_id`  int unsigned NOT NULL        DEFAULT '0',
   `webapplicationexternalexpositions_id` int unsigned  NOT NULL     DEFAULT '0'
       COMMENT 'RELATION to glpi_plugin_webapplications_webapplicationexternalexpositions (id)',
   `webapplicationavailabilities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationintegrities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationconfidentialities` int unsigned   NOT NULL     DEFAULT '0',
   `webapplicationtraceabilities` int unsigned   NOT NULL     DEFAULT '1',
   PRIMARY KEY  (`id`),
   KEY `databases_id` (`databases_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `glpi_plugin_webapplications_streams`;
CREATE TABLE `glpi_plugin_webapplications_streams` (
   `id` int unsigned NOT NULL auto_increment,
   `entities_id`  int unsigned NOT NULL        DEFAULT '0',
   `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `transmitter` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `receiver` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `encryption` tinyint NOT NULL default '0',
   `encryption_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `ports` int(5) unsigned NOT NULL,
   `protocole` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   PRIMARY KEY  (`id`),
   KEY `entities_id` (`entities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `glpi_plugin_webapplications_entities`;
CREATE TABLE `glpi_plugin_webapplications_entities` (
   `id` int unsigned NOT NULL auto_increment,
   `entities_id` int unsigned NOT NULL,
   `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `owner` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `security_contact` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `relation_nature` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   PRIMARY KEY  (`id`),
   KEY `entities_id` (`entities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `glpi_plugin_webapplications_processes`;
CREATE TABLE `glpi_plugin_webapplications_processes` (
   `id` int unsigned NOT NULL auto_increment,
   `entities_id`  int unsigned NOT NULL        DEFAULT '0',
   `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `owner` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `webapplicationavailabilities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationintegrities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationconfidentialities` int unsigned   NOT NULL     DEFAULT '0',
   `webapplicationtraceabilities` int unsigned   NOT NULL     DEFAULT '1',
   `is_recursive` tinyint NOT NULL DEFAULT '0',
   `comment` varchar(255) DEFAULT NULL,
   PRIMARY KEY  (`id`),
   KEY `entities_id` (`entities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `glpi_plugin_webapplications_processes_entities`;
CREATE TABLE `glpi_plugin_webapplications_processes_entities` (
    `id` int(11) NOT NULL auto_increment,
    `plugin_webapplications_entities_id` int unsigned NOT NULL default '0',
    `plugin_webapplications_processes_id` int unsigned NOT NULL default '0',
    PRIMARY KEY  (`id`),
    UNIQUE KEY `unicity` (`plugin_webapplications_entities_id`,`plugin_webapplications_processes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `glpi_plugin_webapplications_dashboards`;
CREATE TABLE `glpi_plugin_webapplications_dashboards` (
    `id` int(11) NOT NULL auto_increment,
    `users_id` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `glpi_plugin_webapplications_webapplicationtechnics` VALUES ('1', 0);
