DELIMITER $
CREATE PROCEDURE proDeleteEmployee 
(`id_employee` INT, id_address INT) 
	BEGIN 
		DELETE FROM `employees_charges`  WHERE `id_employee` = id_employee;
		DELETE FROM `employees_positions`  WHERE `id_employee` = id_employee;
		DELETE FROM `employees` WHERE `id` = id_employee;
		DELETE FROM `addresses` WHERE id = id_address;
	END$