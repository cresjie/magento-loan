<?php
$installer = $this;
$installer->startSetup();

$installer->run("

	DROP TABLE IF EXISTS {$this->getTable('loan')};

	CREATE TABLE {$this->getTable('loan')} (
		`loan_id` int(11) unsigned NOT NULL auto_increment,
		`email` varchar(255) NOT NULL,
		`first_name` varchar(255) NOT NULL,
		`last_name` varchar(255) NOT NULL,
		`loan_value` decimal(7,2) NOT NULL,
		`status` int(3) NOT NULL DEFAULT '-1',
		`created_at` datetime NULL,
		`updated_at` datetime NULL,
		PRIMARY KEY (`loan_id`)
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