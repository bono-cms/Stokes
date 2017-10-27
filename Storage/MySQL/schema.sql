
DROP TABLE IF EXISTS `bono_module_stokes`;
CREATE TABLE `bono_module_stokes` (

	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`start` TIMESTAMP,
	`end` TIMESTAMP,
    `published` varchar(1),
	`cover` varchar(254) NOT NULL

) DEFAULT CHARSET = UTF8;


DROP TABLE IF EXISTS `bono_module_stokes_translations`;
CREATE TABLE `bono_module_stokes_translations` (

	`id` INT NOT NULL,
	`lang_id` INT NOT NULL,
    `web_page_id` INT NOT NULL COMMENT 'Attached Web-Page ID',
	`name` varchar(254) NOT NULL,
	`title` varchar(254) NOT NULL,
	`introduction` LONGTEXT NOT NULL,
	`description` LONGTEXT NOT NULL,
	`keywords` TEXT NOT NULL,
	`meta_description` TEXT NOT NULL

) DEFAULT CHARSET = UTF8;