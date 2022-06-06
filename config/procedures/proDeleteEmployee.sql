DELIMITER $
CREATE PROCEDURE proDeleteEmployee 
(`id_employee` INT) 
	BEGIN 
		DELETE FROM `charges_employees` WHERE `id_employee` = id_employee;
		DELETE FROM `positions_employees` WHERE `id_employee` = id_employee;
		DELETE FROM `employees` WHERE `id` = id_employee;
	END$