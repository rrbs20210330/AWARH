DELIMITER $
CREATE PROCEDURE proDeleteEmployee 
(`id_employe` INT, `id_address` INT) 
	BEGIN 
		DELETE FROM `employees_charges`  WHERE `id_employee` = `id_employe`;
		DELETE FROM `employees_positions`  WHERE `id_employee` = `id_employe`;
		DELETE FROM `employee_training` WHERE `id_employee` = `id_employe`;
		DELETE FROM `employees` WHERE `id` = `id_employe`;
		DELETE FROM `addresses` WHERE `id` = `id_address`;
	END$