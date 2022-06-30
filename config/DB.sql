DROP DATABASE IF EXISTS `rh`;
CREATE DATABASE IF NOT EXISTS `rh` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rh`;

CREATE TABLE IF NOT EXISTS `users` (
    `id_user` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la tabla de user',
    `t_user` VARCHAR(20) NOT NULL COMMENT 'Nombre del usuario',
    `t_password` VARCHAR(100) NOT NULL COMMENT 'Contraseña del usuario',
    `b_active` BOOLEAN NOT NULL COMMENT 'El estado del usuario esto desmuestra si esta activo o inactivo',
    `i_type` INT(11) NOT NULL COMMENT 'El tipo de usuario ya sea Administrador, empleado o aspirante',
    `dt_last_join` DATETIME COMMENT 'La última conexión que tuvo la persona al entrar al sistema',
    PRIMARY KEY (`id_user`)
);

CREATE TABLE IF NOT EXISTS `positions`(
    `id_position` INT(11) AUTO_INCREMENT COMMENT 'Id de la tabla de puestos',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'Nombre del puesto',
    `t_description` VARCHAR(255) NOT NULL COMMENT 'La descripción del puesto',
    PRIMARY key (`id_position`)
);

CREATE TABLE IF NOT EXISTS `areas`(
    `id_area` INT(11) AUTO_INCREMENT COMMENT 'Id de la tabla de áreas',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'Es el nombre de la área',
    `t_description` VARCHAR(200) NOT NULL COMMENT 'Es la descripción de áreas',
    PRIMARY KEY (`id_area`)
);

CREATE TABLE IF NOT EXISTS `charges` (
    `id_charge` INT(11) AUTO_INCREMENT COMMENT'Id de la tabla de cargos',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'Es el nombre de los cargos',
    `t_description` VARCHAR(100) NOT NULL COMMENT 'La descripción de cargos',
    PRIMARY KEY(`id_charge`)
);

CREATE TABLE IF NOT EXISTS `activities`(
    `id_activity` INT(11) AUTO_INCREMENT COMMENT 'Id de la tabla actividades',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'Nombre de actividades',
    `t_description` VARCHAR(200) NOT NULL COMMENT 'La descripción de actividades',
    PRIMARY KEY (`id_activity`)
);

CREATE TABLE IF NOT EXISTS `charges_activities`(
    `fk_charge` INT COMMENT 'La Id de la tabla de cargos, es lo que relaciona las actividades con los cargos',
    `fk_activity` INT COMMENT 'La Id de la tabla de actividades , es lo que relaciona los cargos con las actividades',
    FOREIGN KEY (`fk_activity`) REFERENCES `activities`(`id_activity`),
    FOREIGN KEY (`fk_charge`) REFERENCES `charges`(`id_charge`)
);


CREATE TABLE IF NOT EXISTS `files` (
    `id_file` INT(11) AUTO_INCREMENT COMMENT 'Id de la tabla de archivos',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'El nombre del archivo',
    `t_path` VARCHAR(255) NOT NULL COMMENT 'La referencia del archivo',
    PRIMARY KEY (`id_file`)
);

CREATE TABLE IF NOT EXISTS `addresses` (
    `id_address` INT(11) AUTO_INCREMENT COMMENT 'Id de la tabla de direcciones',
    `t_no_interior` VARCHAR(10) NOT NULL COMMENT 'El número interior',
    `t_no_exterior` VARCHAR(10) NOT NULL COMMENT 'El número exterior',
    `t_references` VARCHAR(255) NOT NULL COMMENT 'Las referencias que posee la dirección',
    `t_street` VARCHAR(100) NOT NULL COMMENT 'La calle de la dirección',
    `t_colony` VARCHAR(100) NOT NULL COMMENT 'La colonia',
    PRIMARY KEY (`id_address`)
);

CREATE TABLE IF NOT EXISTS `employees` (
    `id_employee` INT(11) AUTO_INCREMENT COMMENT 'Id de la tabla empleados/employees',
    `t_names` VARCHAR(100) NOT NULL COMMENT 'Los nombres del empleado',
    `t_last_names` VARCHAR(100) NOT NULL COMMENT 'Los apellidos del empleado',
    `t_email` VARCHAR(100) NOT NULL COMMENT 'El correo electrónico',
    `t_rfc` VARCHAR(100) NOT NULL COMMENT 'El RFC del empleado',
    `t_nss` VARCHAR(100) NOT NULL COMMENT 'El número social',
    `b_active` BOOLEAN NOT NULL COMMENT 'El estado que puede tener el empleado esto desmuestra si esta activo o inactivo',
    `t_phone_number` VARCHAR(100) NOT NULL COMMENT 'El numero de teléfono',
    `d_birthday` date NOT NULL COMMENT 'El cumpleaños',
    `fk_contract` INT NOT NULL COMMENT 'La relación que tiene con la tabla de archivos',
    `fk_img` INT NOT NULL COMMENT 'La relación que tiene con la tabla de archivos ',
    `fk_address` INT NOT NULL COMMENT 'La relación que tiene con la tabla de direcciones',
    -- `fk_user` INT NOT NULL COMMENT 'La relación que tiene con la tabla de usuarios',
    FOREIGN KEY (`fk_contract`) REFERENCES `files`(`id_file`),
    -- FOREIGN KEY (`fk_user`) REFERENCES `users`(`id_user`),
    FOREIGN KEY (`fk_img`) REFERENCES `files`(`id_file`),
    FOREIGN KEY (`fk_address`) REFERENCES `addresses`(`id_address`),
    PRIMARY KEY(`id_employee`)
);

CREATE TABLE IF NOT EXISTS `trainings` (
    `id_training` INT AUTO_INCREMENT COMMENT 'Id de la tabla de capacitaciones',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'El nombre de la capacitación',
    `d_date_start` DATE NOT NULL COMMENT 'La fecha que comienza la capacitación',
    `d_date_finish` DATE NOT NULL COMMENT 'La fecha que termina la capacitación',
    `t_description` VARCHAR(100) NOT NULL COMMENT 'La descripción de la capacitación',
    PRIMARY KEY (`id_training`)
);

CREATE TABLE IF NOT EXISTS `employees_trainings`(
    `fk_employee` INT COMMENT 'La Id de la tabla de empleados, es lo que relaciona empleados con las capacitaciones',
    `fk_training` INT COMMENT 'La Id de la tabla de capacitaciones, es lo que relaciona capacitaciones con los empleados',
    FOREIGN KEY (`fk_employee`) REFERENCES `employees`(`id_employee`),
    FOREIGN KEY (`fk_training`) REFERENCES `trainings`(`id_training`)
);

CREATE TABLE IF NOT EXISTS `trainings_files`(
    `fk_training` INT NOT NULL COMMENT 'La Id de la tabla de capacitaciones, es lo que relaciona capacitaciones con los archivos',
    `fk_file` INT NOT NULL COMMENT 'La Id de la tabla de archivos, es lo que relaciona archivos con las capacitaciones esto nos permite subir archivos',
    FOREIGN KEY (`fk_training`) REFERENCES `trainings`(`id_training`),
    FOREIGN KEY (`fk_file`) REFERENCES `files`(`id_file`)
);

CREATE TABLE IF NOT EXISTS `candidates` (
    `id_candidate` INT AUTO_INCREMENT COMMENT 'Id de la tabla de candidatos',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'Nombre de los candidatos',
    `t_phone_number` VARCHAR(100) NOT NULL COMMENT 'Numero de teléfono de los candidatos',
    `t_email` VARCHAR(100) NOT NULL COMMENT 'Correo Electrónico del candidato',
    `dt_appointment_date` DATETIME NOT NULL COMMENT 'La fecha para la cita del candidato',
    `fk_request_position` INT NOT NULL COMMENT 'La Id de la tabla puestos que lo relaciona con candidatos',
    `t_profile` VARCHAR(100) NOT NULL COMMENT 'El perfil que se necesita para ser el nuevo candidato',
    `fk_cv` INT NOT NULL COMMENT 'La Id de la tabla de archivos para subir el Curriculum',
    `b_is_employee` BOOLEAN NOT NULL COMMENT 'Es para saber si un candidato fue contratado y es un empleado',
    FOREIGN KEY (`fk_cv`) REFERENCES `files`(`id_file`),
    FOREIGN KEY (`fk_request_position`) REFERENCES `positions`(`id_position`),
    PRIMARY KEY (`id_candidate`)
);

CREATE TABLE IF NOT EXISTS `announcements` (
    `id_announcement` int(11) AUTO_INCREMENT NOT NULL COMMENT 'Id de la tabla de convocatorias',
    `t_name` VARCHAR(100) NOT NULL COMMENT 'Nombre de la convocatoria',
    `t_description` VARCHAR(100) NOT NULL COMMENT 'Descripción de la convocatoria',
    `d_date_start` DATE NOT NULL COMMENT 'Fecha de comienzo de la convocatoria',
    `d_date_finish` DATE NOT NULL COMMENT 'Fecha de finalización de la convocatoria',
    `t_process` VARCHAR(100) NOT NULL COMMENT 'Procedimiento de la convocatoria',
    `t_profile` VARCHAR(100) NOT NULL COMMENT 'Perfil de la convocatoria',
    `t_functions` VARCHAR(100) NOT NULL COMMENT 'Función de la convocatoria',
    `b_active` BOOLEAN NOT NULL COMMENT 'Estatus de la convocatoria saber si esta ctiva o inactiva',  
    `fk_file` INT NOT NULL COMMENT 'Id de la tabla de archivo para subir una imagen de la convocatoria',
    FOREIGN KEY (`fk_file`) REFERENCES `files`(`id_file`),
    PRIMARY KEY (`id_announcement`)
);

CREATE TABLE IF NOT EXISTS `announcements_positions`(
    `fk_announcement` INT COMMENT 'Id de la tabla de convocatorias, es lo que relaciona convocatorias con puesto',
    `fk_position` INT COMMENT 'Id de la tabla de puesto, es lo que relaciona puesto con convocatorias',
    FOREIGN KEY (`fk_announcement`) REFERENCES `announcements`(`id_announcement`),
    FOREIGN KEY (`fk_position`) REFERENCES `positions`(`id_position`)
);
CREATE TABLE IF NOT EXISTS `employees_positions`(
    `fk_employee` INT COMMENT 'Id de la tabla de empleados, es lo que relaciona empleados con puesto',
    `fk_position` INT COMMENT 'Id de la tabla de puesto, es lo que relaciona puesto con empleados',
    FOREIGN KEY (`fk_employee`) REFERENCES `employees`(`id_employee`),
    FOREIGN KEY (`fk_position`) REFERENCES `positions`(`id_position`)
);
CREATE TABLE IF NOT EXISTS `employees_charges`(
    `fk_employee` INT COMMENT 'Id de la tabla de empleados, es lo que relaciona empleados con cargo',
    `fk_charge` INT COMMENT 'Id de la tabla de cargo, es lo que relaciona cargo con empleado',
    FOREIGN KEY (`fk_employee`) REFERENCES `employees`(`id_employee`),
    FOREIGN KEY (`fk_charge`) REFERENCES `charges`(`id_charge`)
);


-- FUNCTIONS
DELIMITER $
CREATE FUNCTION `number_activities_charges`(`id` INT) RETURNS int(11)
BEGIN
	SELECT COUNT(ca.fk_charge) INTO @cant FROM `charges` AS `c` INNER JOIN `charges_activities` AS `ca` ON ca.fk_charge = c.id_charge WHERE c.id_charge = id; 
    RETURN @cant;
END$


-- PROCEDURES

DELIMITER $
CREATE PROCEDURE procedure_delete_activity(`id` INT) 
	BEGIN 
		DELETE FROM `charges_activities` WHERE `fk_activity` = `id`;
		DELETE FROM `activities` WHERE `id_activity` = `id`;
	END$

DELIMITER $
CREATE PROCEDURE procedure_delete_charge(`id` INT) 
	BEGIN 
		DELETE FROM `charges_activities` WHERE `fk_charge` = `id`;
		DELETE FROM `employees_charges` WHERE `fk_charge` = `id`;
		DELETE FROM `charges` WHERE `id_charge` = `id`;
	END$

DELIMITER $
CREATE PROCEDURE procedure_delete_candidate(`id` INT) 
	BEGIN 
        SELECT `fk_cv` INTO @cv_file FROM `candidates` WHERE `id_candidate` = `id`;
        DELETE FROM `candidates` WHERE `id_candidate` = `id`;
        DELETE FROM `files`  WHERE `id_file` = @cv_file;
	END$

DELIMITER $
CREATE PROCEDURE procedure_delete_employee(`id` INT) 
	BEGIN 
		DELETE FROM `employees_charges`  WHERE `fk_employee` = `id`;
		DELETE FROM `employees_positions`  WHERE `fk_employee` = `id`;
		DELETE FROM `employees_trainings` WHERE `fk_employee` = `id`;
        SELECT `fk_address` INTO @address FROM `employees` WHERE `id_employee` = `id`;
		DELETE FROM `employees` WHERE `id_employee` = `id`;
		DELETE FROM `addresses` WHERE `id_address` = @address;
	END$

DELIMITER $
CREATE PROCEDURE procedure_delete_position(`id` INT) 
	BEGIN 
		DELETE FROM `announcements_positions` WHERE `fk_position` = `id`;
		DELETE FROM `employees_positions` WHERE `fk_position` = `id`;
		DELETE FROM `positions` WHERE `id_position` = `id`;
	END$

DELIMITER $
CREATE PROCEDURE procedure_delete_training(`id` INT) 
	BEGIN 
		DELETE FROM `employees_trainings` WHERE `fk_training` = `id`;
		DELETE FROM `trainings` WHERE `id_training` = `id`;
	END$

DELIMITER $
CREATE PROCEDURE procedure_delete_announcement(`id` INT) 
	BEGIN 
        SELECT `fk_file` INTO @id_file FROM `announcements` WHERE `id_announcement` = `id`;
        DELETE FROM `announcements_positions` WHERE `fk_announcement` = `id`;
		DELETE FROM `announcements` WHERE `id_announcement` = `id`;
		DELETE FROM `files` WHERE `id_file` = @id_file;
	END$

DELIMITER $
CREATE PROCEDURE procedure_delete_area(`id` INT) 
	BEGIN 
		DELETE FROM `areas` WHERE `id_area` = `id`;
	END$

DELIMITER $
CREATE PROCEDURE procedure_new_activity(`name` VARCHAR(100), `description` VARCHAR(200), `charge` INT(10)) 
	BEGIN 
		INSERT INTO `activities`(`t_name`, `t_description`) 
		VALUES (`name`, `description`);
		SELECT MAX(`id_activity`) INTO @id_activity FROM `activities`;
        INSERT INTO `charges_activities`(`fk_charge`, `fk_activity`)
        VALUES (`charge`, @id_activity);
	END$

DELIMITER $
CREATE PROCEDURE procedure_new_charge(`name` VARCHAR(100), `description` VARCHAR(200), `position` INT(10)) 
	BEGIN 
		INSERT INTO `charges`(`t_name`, `t_description`) 
		VALUES (`name`, `description`);
		SELECT MAX(`id_charge`) INTO @id_charge FROM `charges`;
        INSERT INTO `charges_positions`(`fk_charge`, `fk_position`)
        VALUES (@id_charge, `position`);
	END$

DELIMITER $
CREATE PROCEDURE procedure_new_employee(`names` VARCHAR(100),`last_names` VARCHAR(100),`birthday` DATE,`photo_name` VARCHAR(200),`photo_path` VARCHAR(200),`phone_number` VARCHAR(100),`email` VARCHAR(200),`no_interior` VARCHAR(10),`no_exterior` VARCHAR(10),`references` VARCHAR(255),`street` VARCHAR(100),`colony` VARCHAR(100),`charge` INT,`position` INT,`contract_name` VARCHAR(200),`contract_path` VARCHAR(200),`rfc` VARCHAR(100),`nss` VARCHAR(100)) 
	BEGIN 
		INSERT INTO `files`(`t_name`, `t_path`) 
		VALUES (`photo_name`, `photo_path`);
		SELECT MAX(`id_file`) INTO @id_file_photo FROM `files`;	
		INSERT INTO `files`(`t_name`, `t_path`) 
		VALUES (`contract_name`, `contract_path`);
		SELECT MAX(`id_file`) INTO @id_file_contract FROM `files`;		
		INSERT INTO `addresses`(`t_no_exterior`, `t_no_interior`, `t_references`, `t_street`, `t_colony`)
		VALUES (`no_exterior`, `no_interior`, `references`, `street`, `colony`);
		SELECT MAX(`id_address`) INTO @id_address_employee FROM `addresses`;
		INSERT INTO `employees`(`t_names`,`t_last_names`,`d_birthday`,`t_phone_number`, `t_email`, `fk_img`, `fk_address`, `fk_contract`,`b_active`, `t_rfc`, `t_nss`) 
		VALUES (`names`, `last_names`, `birthday`, `phone_number`, `email`, @id_file_photo, @id_address_employee, @id_file_contract,true, `rfc`, `nss`); 
		SELECT MAX(`id_employee`) INTO @id_employee FROM `employees`;
		INSERT INTO `employees_charges`(`fk_employee`, `fk_charge`)
		VALUES (@id_employee, `charge`);
		INSERT INTO `employees_positions`(`fk_employee`, `fk_position`)
		VALUES (@id_employee, `position`);
	END$

DELIMITER $
CREATE PROCEDURE procedure_new_training(`name` VARCHAR(100),`description` VARCHAR(200),`employee` INT(10),`date_start` date,`date_finish` date) 
	BEGIN 
		INSERT INTO `trainings`(`t_name`, `t_description`, `d_date_start`,`d_date_finish`)
		VALUES (`name`, `description`, `date_start`,`date_finish`);
		SELECT MAX(`id_training`) INTO @id_training FROM `trainings`;
		INSERT INTO `employees_trainings`(`fk_employee`, `fk_training`)
		VALUES (`employee`, @id_training);
	END$

DELIMITER $
CREATE PROCEDURE procedure_new_file_training(`file_name` VARCHAR(100),`file_path` VARCHAR(200)) 
	BEGIN 
		INSERT INTO files(`t_name`, `t_path`) 
		VALUES (`file_name`, `file_path`);
		SELECT MAX(`id_file`) INTO @id_file_training FROM `files`;
		SELECT MAX(`id_training`) INTO @id_training FROM `trainings`;
		INSERT INTO `trainings_files`(`fk_file`, `fk_training`)
		VALUES (@id_file_training, @id_training);
	END$

DELIMITER $
CREATE PROCEDURE procedure_new_candidate(`name` VARCHAR(100),`phone_number` VARCHAR(100),`email` VARCHAR(100), `appointment_date` DATETIME,`request_position` INT,`perfil` VARCHAR(200), `cv_name` VARCHAR(100),`cv_path` VARCHAR(100)) 
	BEGIN 
		INSERT INTO files(`t_name`, `t_path`) 
		VALUES (`cv_name`, `cv_path`);
		SELECT MAX(`id_file`) INTO @id_cvfile_candidate FROM `files`;
		INSERT INTO `candidates`(`t_name`, `t_phone_number`, `t_email`,`dt_appointment_date`,`fk_request_position`, `t_profile`,`fk_cv`, `b_is_employee`)
		VALUES (`name`, `phone_number`, `email`,`appointment_date`, `request_position`, `perfil`, @id_cvfile_candidate, false);
	END$

DELIMITER $
CREATE PROCEDURE procedure_new_announcement(`name` VARCHAR(100),`description` VARCHAR(100),`date_start` DATE,`date_finish` DATE, `position` INT,`process` VARCHAR(200),`profile` VARCHAR(200), `functions` VARCHAR(200),`file_name` VARCHAR(200),`file_path` VARCHAR(200)) 
	BEGIN 
		INSERT INTO `files`(`t_name`, `t_path`) VALUES (`file_name`, `file_path`);
		SELECT MAX(`id_file`) INTO @id_file_announcement FROM `files`;
		INSERT INTO `announcements`(`t_name`, `t_description`, `d_date_start`,`d_date_finish`,`t_process`, `t_profile`,`t_functions`, `b_active`,`fk_file`)VALUES (`name`, `description`, `date_start`,`date_finish`,`process`, `profile`,`functions`,true, @id_file_announcement);
        SELECT MAX(`id_announcement`) INTO @id_announcement FROM `announcements`;
        INSERT INTO `announcements_positions`(`fk_position`, `fk_announcement`) VALUES (`position`, @id_announcement);
	END$

-- VIEWS

CREATE VIEW infoEmployee as 
SELECT e.*, a.*, ec.fk_charge, ep.fk_position FROM employees as e INNER JOIN addresses AS a on e.fk_address = a.id_address LEFT JOIN employees_charges as ec on e.id_employee = ec.fk_employee LEFT JOIN employees_positions as ep on e.id_employee = ec.fk_employee;

CREATE VIEW listCharges as 
select id_charge AS chargeID,t_description AS chargeDesc,t_name AS chargeName from charges c;

CREATE VIEW listEmployees as 
SELECT id_employee, b_active, t_names, t_last_names, t_phone_number, t_email FROM employees;

CREATE VIEW viewlistTrainings as
SELECT t.id_training, t.t_name, t.d_date_start, t.d_date_finish, t_description, e.id_employee as employee_id, CONCAT(e.t_names, " ", e.t_last_names) as employee_full_name  FROM trainings as t INNER JOIN employees_trainings as et on t.id_training = et.fk_training INNER JOIN employees as e on et.fk_employee = e.id_employee;