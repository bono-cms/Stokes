
DROP TABLE IF EXISTS `bono_module_stokes`;
CREATE TABLE `bono_module_stokes` (

	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`lang_id` INT NOT NULL,
	`timestamp_start` INT NOT NULL,
	`timestamp_end` INT NOT NULL,
	`name` varchar(254) NOT NULL,
	`title` varchar(254) NOT NULL,
	`introduction` TEXT NOT NULL,
	`description` TEXT NOT NULL,
	`keywords` TEXT NOT NULL,
	`meta_description` TEXT NOT NULL,
	`cover` varchar(254) NOT NULL

) DEFAULT CHARSET = UTF8;