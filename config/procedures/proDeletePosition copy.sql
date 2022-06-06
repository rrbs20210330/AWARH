DELIMITER $
CREATE PROCEDURE proDeletePosition
(id_position INT) 
	BEGIN 
	 	DELETE FROM `positions_employees` WHERE `id_position` = id_position;
		DELETE FROM `positions` WHERE `id` = id_position;
	END$