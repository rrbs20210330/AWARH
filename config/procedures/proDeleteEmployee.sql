DELIMITER $
CREATE PROCEDURE proDeleteEmployee 
(`id_employee` INT) 
	BEGIN 
		DELETE FROM `employees_charges`  WHERE `id_employee` = id_employee;
		DELETE FROM `employees_positions`  WHERE `id_employee` = id_employee;
		DELETE FROM `employees` WHERE `id` = id_employee;
	END$