DELIMITER $
CREATE PROCEDURE proDeleteTraining
(`id_trainin` INT) 
	BEGIN 
		DELETE FROM `employee_training` WHERE `id_training` = `id_trainin`;
		DELETE FROM `training` WHERE `id` = `id_trainin`;
	END$