DELIMITER $
CREATE PROCEDURE proDeleteCharge
(`id_charg` INT) 
	BEGIN 
		DELETE FROM `charges_activities` WHERE `id_charge` = `id_charg`;
		DELETE FROM `employees_charges` WHERE `id_charge` = `id_charg`;
		DELETE FROM `charges` WHERE `id` = `id_charg`;
	END$