DELIMITER $
CREATE PROCEDURE proDeleteActivity
(id_activity INT) 
	BEGIN 
		DELETE FROM `charges_activities` WHERE `id_activities` = id_activity;
		DELETE FROM `activities` WHERE `id` = id_activity;
	END$