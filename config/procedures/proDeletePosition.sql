DELIMITER $
CREATE PROCEDURE proDeletePosition
(id_position INT) 
	BEGIN 
		DELETE FROM `announcements_positions` WHERE `id_position` = id_position;
		DELETE FROM `employees_positions` WHERE `id_position` = id_position;
		DELETE FROM `positions` WHERE `id` = id_position;
	END$