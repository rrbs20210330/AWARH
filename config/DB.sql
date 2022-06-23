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