
DROP TABLE IF EXISTS `bono_module_stokes`;


CREATE TABLE `bono_module_stokes` (
	
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`lang_id` INT NOT NULL,
	
	`timestamp_star` INT NOT NULL,
	`timestamp_end` INT NOT NULL,
	
	`name` varchar(254) NOT NULL,
	`title` varchar(254) NOT NULL,
	`intro` TEXT NOT NULL,
	`full` TEXT NOT NULL,
	`slug` varchar(254) NOT NULL,
	`keywords` TEXT NOT NULL,
	`metaDescription` TEXT NOT NULL,
	`cover` varchar(254) NOT NULL
	
) DEFAULT CHARSET = UTF8;

