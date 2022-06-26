DROP DATABASE if EXISTS `recursoshumanos`;
CREATE DATABASE IF NOT EXISTS `recursoshumanos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `recursoshumanos`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user` VARCHAR(20) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `active` BOOLEAN NOT NULL,
    `last_join` DATETIME,
    PRIMARY KEY (`id`)
);

CREATE TABLE `positions`(
    `id` INT(11) AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    PRIMARY key (id)
);


CREATE TABLE IF NOT EXISTS `charges` (
    `id` INT(11) AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    PRIMARY KEY(`id`)
);



CREATE TABLE IF NOT EXISTS `activities`(
    `id` INT(11) AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(200) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `charges_activities`(
    `id_charge` INT ,
    `id_activities` INT,
    FOREIGN KEY (`id_activities`) REFERENCES activities(`id`),
    FOREIGN KEY (`id_charge`) REFERENCES charges(`id`)
);


CREATE TABLE IF NOT EXISTS `files` (
    `id` INT(11) AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `type` VARCHAR(200) NOT NULL,
    `file` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `addresses` (
    `id` INT(11) AUTO_INCREMENT,
    `no_interior` VARCHAR(10) NOT NULL,
    `no_exterior` VARCHAR(10) NOT NULL,
    `references` VARCHAR(255) NOT NULL,
    `street` VARCHAR(100) NOT NULL,
    `colony` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `employees` (
    `id` INT(11) AUTO_INCREMENT ,
    `names` VARCHAR(100) NOT NULL,
    `last_names` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `rfc` VARCHAR(100) NOT NULL,
    `nss` VARCHAR(100) NOT NULL,
    `active` BOOLEAN NOT NULL,
    `phone_number` VARCHAR(100) NOT NULL,
    `birthday` date NOT NULL,
    `id_contract` INT NOT NULL,
    `id_img` INT NOT NULL,
    `id_address` INT NOT NULL,
    FOREIGN KEY (`id_contract`) REFERENCES files(`id`),
    FOREIGN KEY (`id_img`) REFERENCES files(`id`),
    FOREIGN KEY (`id_address`) REFERENCES addresses(`id`),
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `training` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `date_realization` date NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    `id_file` INT NOT NULL,
    FOREIGN KEY (`id_file`) REFERENCES files(`id`),
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `employee_training`(
    `id_employee` INT ,
    `id_training` INT ,
    FOREIGN KEY (`id_employee`) REFERENCES employees(`id`),
    FOREIGN KEY (`id_training`) REFERENCES training(`id`)
);

CREATE TABLE IF NOT EXISTS `employee_files`(
    `id` INT AUTO_INCREMENT,
    `id_employee` INT NOT NULL,
    `id_file` INT NOT NULL,
    FOREIGN KEY (`id_employee`) REFERENCES employees(`id`),
    FOREIGN KEY (`id_file`) REFERENCES files(`id`),
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `candidate` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `phone_number` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `appointment_date` DATETIME NOT NULL,
    `request_position` INT NOT NULL,
    `perfil` VARCHAR(100) NOT NULL,
    `id_cv` INT NOT NULL,
    FOREIGN KEY (`id_cv`) REFERENCES files(`id`),
    FOREIGN KEY (`request_position`) REFERENCES positions(`id`),
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_start` date NOT NULL,
  `date_finish` date NOT NULL,
  `position` varchar(100) NOT NULL,
  `process` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `functions` varchar(100) NOT NULL,
  `active` BOOLEAN NOT NULL, 
  `id_file` INT NOT NULL,
    FOREIGN KEY (`id_file`) REFERENCES files(`id`),
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `announcements_positions`(
    `id_announcement` INT,
    `id_position` INT,
    FOREIGN KEY (`id_announcement`) REFERENCES announcements(`id`),
    FOREIGN KEY (`id_position`) REFERENCES positions(`id`)
);
CREATE TABLE IF NOT EXISTS `employees_positions`(
    `id_employee` INT,
    `id_position` INT,
    FOREIGN KEY (`id_employee`) REFERENCES employees(`id`),
    FOREIGN KEY (`id_position`) REFERENCES positions(`id`)
);
CREATE TABLE IF NOT EXISTS `employees_charges`(
    `id_employee` INT,
    `id_charge` INT,
    FOREIGN KEY (`id_employee`) REFERENCES employees(`id`),
    FOREIGN KEY (`id_charge`) REFERENCES charges(`id`)
);







-- FUNCTIONS
DELIMITER $
CREATE FUNCTION `numActCh`(id INT) RETURNS int(11)
BEGIN
	select COUNT(r.id_charge) INTO @cant FROM charges c inner join charges_activities r ON r.id_charge = c.id where c.id = id; 
    RETURN @cant;
END$


-- PROCEDURES

DELIMITER $
CREATE PROCEDURE proDeleteActivity(`id_activity` INT) 
	BEGIN 
		DELETE FROM `charges_activities` WHERE `id_activities` = `id_activity`;
		DELETE FROM `activities` WHERE `id` = `id_activity`;
	END$

DELIMITER $
CREATE PROCEDURE proDeleteCharge(`id_charg` INT) 
	BEGIN 
		DELETE FROM `charges_activities` WHERE `id_charge` = `id_charg`;
		DELETE FROM `employees_charges` WHERE `id_charge` = `id_charg`;
		DELETE FROM `charges` WHERE `id` = `id_charg`;
	END$

DELIMITER $
CREATE PROCEDURE proDeleteEmployee(`id_employe` INT, `id_address` INT) 
	BEGIN 
		DELETE FROM `employees_charges`  WHERE `id_employee` = `id_employe`;
		DELETE FROM `employees_positions`  WHERE `id_employee` = `id_employe`;
		DELETE FROM `employee_training` WHERE `id_employee` = `id_employe`;
		DELETE FROM `employees` WHERE `id` = `id_employe`;
		DELETE FROM `addresses` WHERE `id` = `id_address`;
	END$

DELIMITER $
CREATE PROCEDURE proDeletePosition(`id_positio` INT) 
	BEGIN 
		DELETE FROM `announcements_positions` WHERE `id_position` = `id_positio`;
		DELETE FROM `employees_positions` WHERE `id_position` = `id_positio`;
		DELETE FROM `positions` WHERE `id` = `id_positio`;
	END$

DELIMITER $
CREATE PROCEDURE proDeleteTraining(`id_trainin` INT) 
	BEGIN 
		DELETE FROM `employee_training` WHERE `id_training` = `id_trainin`;
		DELETE FROM `training` WHERE `id` = `id_trainin`;
	END$

DELIMITER $
CREATE PROCEDURE proNewActivity(`name` VARCHAR(100), `description` VARCHAR(200), `id_charge` INT(10)) 
	BEGIN 
		INSERT INTO `activities`(`name`, `description`) 
		VALUES (`name`, `description`);
		SELECT MAX(id) INTO @idActivity FROM `activities`;
        INSERT INTO `charges_activities`(`id_charge`, `id_activities`)
        VALUES (`id_charge`,@idActivity);
	END$

DELIMITER $
CREATE PROCEDURE proNewCharge(`name` VARCHAR(100), `description` VARCHAR(200), `id_position` INT(10)) 
	BEGIN 
		INSERT INTO charges(`name`, `description`) 
		VALUES (`name`, `description`);
		SELECT MAX(id) INTO @idCharge FROM charges;
        INSERT INTO charges_positions(`id_charge`, `id_position`)
        VALUES (@idCharge, `id_position`);
		-- Fusionar con Activities - Actualmente no se usa este procedimiento
	END$

DELIMITER $
CREATE PROCEDURE proNewEmployee(`names` VARCHAR(100),`last_names` VARCHAR(100),`birthday` DATE,`photo` INT,`phone_number` VARCHAR(100),`email` VARCHAR(200),`no_interior` VARCHAR(10),`no_exterior` VARCHAR(10),`referencias` VARCHAR(255),`street` VARCHAR(100),`colony` VARCHAR(100),`charge` INT,`position` INT,`contract` INT,`rfc` VARCHAR(100),`nss` VARCHAR(100)) 
	BEGIN 
		INSERT INTO files(`name`, `type`, `file`) 
		VALUES ('foto', 'image', 'archivo');
		SELECT MAX(id) INTO @idFPhoto FROM files;	
		INSERT INTO files(`name`, `type`, `file`) 
		VALUES ('contrato', 'pdf', 'archivo');
		SELECT MAX(id) INTO @idFContract FROM files;	
		INSERT INTO addresses(no_exterior, no_interior, `references`, street, colony)
		VALUES (`no_exterior`, `no_interior`, `referencias`, `street`, `colony`);
		SELECT MAX(id) INTO @idAddressEmployee FROM addresses;
		INSERT INTO employees(names,last_names,birthday,phone_number, email, id_img, id_address, id_contract,active, rfc, nss) 
		VALUES (`names`, `last_names`, `birthday`, `phone_number`, `email`, @idFPhoto, @idAddressEmployee, @idFContract,true, `rfc`, `nss`); 
		SELECT MAX(id) INTO @idEmployee FROM employees;
		INSERT INTO employees_charges(id_employee, id_charge)
		VALUES (@idEmployee, `charge`);
		INSERT INTO employees_positions(id_employee, id_position)
		VALUES (@idEmployee, `position`);
	END$

DELIMITER $
CREATE PROCEDURE proNewTraining(`name` VARCHAR(100),`description` VARCHAR(200),`file` VARCHAR(100),`employee` INT(10),`date_realization` date) 
	BEGIN 
		INSERT INTO files(`name`, `type`, `file`) 
		VALUES ('capacitacion', 'pdf', 'archivo');
		SELECT MAX(id) INTO @idFTraining FROM files;
		INSERT INTO training(`name`, `description`, `date_realization`,`id_file`)
		VALUES (`name`, `description`, `date_realization`, @idFTraining);
		SELECT MAX(id) INTO @idTraining FROM training;
		INSERT INTO employee_training(`id_employee`, `id_training`)
		VALUES (`employee`, @idTraining);
	END$


-- VIEWS

CREATE VIEW infoEmployee as 
SELECT e.id, e.names, e.last_names, e.email, e.rfc, e.nss, e.phone_number, e.birthday, a.no_exterior, a.no_interior, a.`references`, a.street, a.colony,ec.id_charge, ep.id_position FROM employees as e INNER JOIN addresses AS a on e.id_address = a.id left JOIN employees_charges as ec on e.id = ec.id_employee left JOIN employees_positions as ep on e.id = ec.id_employee;

CREATE VIEW listCharges as 
select `c`.`id` AS `chargeID`,`c`.`description` AS `chargeDesc`,`c`.`name` AS `chargeName` from `recursoshumanos`.`charges` `c`

CREATE VIEW listEmployees as 
SELECT id, active, names, last_names, phone_number, email FROM employees;

CREATE VIEW viewlistTrainings as
SELECT t.id, t.name, date_realization, `description`, e.id as employee_id, CONCAT(e.names, " ", e.last_names) as employee_full_name  FROM training as t INNER JOIN employee_training as et on t.id = et.id_training INNER JOIN employees as e on et.id_employee = e.id;