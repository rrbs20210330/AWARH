DELIMITER $
CREATE PROCEDURE proDeleteEmployee 
(`id_employee` INT) 
	BEGIN 
		DELETE FROM `employees` WHERE `id` = id_employee;
	END$