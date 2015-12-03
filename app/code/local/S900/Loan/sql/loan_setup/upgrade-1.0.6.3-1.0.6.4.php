<?php

$installer = $this;
$installer->startSetup();

$installer->run("

	DROP TABLE IF EXISTS {$this->getTable('loan/account')};

	CREATE TABLE {$this->getTable('loan/account')} (
		`id` int(10) UNSIGNED NOT NULL,
		`title` varchar(10) NOT NULL,
		`first_name` varchar(255) NOT NULL,
		`last_name` varchar(255) NOT NULL,
		`email` varchar(255) NOT NULL,
		`birthday` date DEFAULT NULL,
		`address` varchar(255) NOT NULL,
		`address_info` TEXT NOT NULL,
		`mobile_phone` int(25) NOT NULL,
		`created_at` datetime NOT NULL,
		`updated_at` datetime NOT NULL
		PRIMARY KEY (`id`)
	)ENGINE=InnoDB Default Charset=utf8;

	DROP TABLE IF EXISTS {$this->getTable('loan/income')};

	CREATE TABLE {$this->getTable('loan/income')} (
		`income_id` int(10) UNSIGNED NOT NULL,
		`account_id` int(10) UNSIGNED NOT NULL,
		`income_details` text NOT NULL,
		PRIMARY KEY (`income_id`)
	)ENGINE=InnoDB Default Charset=utf8;

	DROP TABLE IF EXISTS {$this->getTable('loan/loan')};

	CREATE TABLE {$this->getTable('loan/loan')} (
		`loan_id` int(10) UNSIGNED NOT NULL,
		`account_id` int(10) UNSIGNED NOT NULL,
		`amount` decimal(11,2) UNSIGNED NOT NULL,
		`duration` varchar(255) NOT NULL,
		`interest` decimal(5,2) UNSIGNED NOT NULL,
		`reason_cat_id` int(10) UNSIGNED NOT NULL,
		`reason_details` varchar(255) NOT NULL,
		`status` INT(11) NOT NULL DEFAULT -1,
		`apply_at` DATETIME,
		`loan_updated_at` DATETIME
		PRIMARY KEY (`loan_id`)
	)ENGINE=InnoDB Default Charset=utf8;
	
	DROP TABLE IF EXISTS {$this->getTable('loan/reason')};

	CREATE TABLE {$this->getTable('loan/reason')} (
		`cat_id` INT(10) UNSIGNED NOT NULL,
		`parent_id` INT(10) UNSIGNED NOT NULL,
		`cat_name` varchar(255) NOT NULL,
		PRIMARY KEY (`cat_id`)
	)ENGINE=InnoDB Default Charset=utf8;

	DROP TABLE IF EXISTS {$this->getTable('loan/status_attr')};

	CREATE TABLE {$this->getTable('loan/status_attr')} (
		`status_code` int(3) NOT NULL,
		`status_value` varchar(255) NOT NULL,
		PRIMARY KEY (`status_code`)
	)ENGINE=InnoDB Default Charset=utf8;

	INSERT INTO {$this->getTable('loan/status_attr')} (`status_code`,`status_value`) VALUES
			('-1','Pending'),
			('0', 'Decline'),
			('1','Approved');

");


$installer->endSetup();