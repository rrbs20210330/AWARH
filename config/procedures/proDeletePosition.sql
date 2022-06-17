DELIMITER $
CREATE PROCEDURE proDeletePosition
(`id_positio` INT) 
	BEGIN 
		DELETE FROM `announcements_positions` WHERE `id_position` = `id_positio`;
		DELETE FROM `employees_positions` WHERE `id_position` = `id_positio`;
		DELETE FROM `positions` WHERE `id` = `id_positio`;
	END$