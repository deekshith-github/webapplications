DROP TABLE IF EXISTS `glpi_plugin_webapplications_webapplicationexternalexpositions`;
CREATE TABLE `glpi_plugin_webapplications_webapplicationexternalexpositions` (
  `id`      int unsigned NOT NULL        AUTO_INCREMENT,
  `name`    VARCHAR(255)
            COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` TEXT COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

ALTER TABLE `glpi_plugin_webapplications_appliances`

  ADD `webapplicationexternalexpositions_id` int unsigned  NOT NULL     DEFAULT '0',
  ADD `webapplicationreferringdepartmentvalidation` TINYINT(1) NOT NULL default '0',
  ADD `webapplicationciovalidation` TINYINT(1) NOT NULL default '0',
  ADD `webapplicationavailabilities` int unsigned   NOT NULL     DEFAULT '1',
  ADD `webapplicationintegrities` int unsigned   NOT NULL     DEFAULT '1',
  ADD `webapplicationconfidentialities` int unsigned   NOT NULL     DEFAULT '0',
  ADD `webapplicationtraceabilities` int unsigned   NOT NULL     DEFAULT '1';

DROP TABLE IF EXISTS `glpi_plugin_webapplications_databases`;
CREATE TABLE `glpi_plugin_webapplications_databases` (
   `id` int unsigned NOT NULL auto_increment,
   `databases_id` int unsigned NOT NULL,
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
   `streams_id` int unsigned NOT NULL,
   `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `transmitter` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `receiver` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `encryption` TINYINT(1) NOT NULL default '0',
   `encryption_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `ports` int(5) unsigned NOT NULL,
   `protocole` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   PRIMARY KEY  (`id`),
   KEY `streams_id` (`streams_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `glpi_plugin_webapplications_processes`;
CREATE TABLE `glpi_plugin_webapplications_processes` (
   `id` int unsigned NOT NULL auto_increment,
   `process_id` int unsigned NOT NULL,
   `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `owner` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `webapplicationavailabilities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationintegrities` int unsigned   NOT NULL     DEFAULT '1',
   `webapplicationconfidentialities` int unsigned   NOT NULL     DEFAULT '0',
   `webapplicationtraceabilities` int unsigned   NOT NULL     DEFAULT '1',
   `comment` varchar(255) DEFAULT NULL,
   PRIMARY KEY  (`id`),
   KEY `processes_id` (`process_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
