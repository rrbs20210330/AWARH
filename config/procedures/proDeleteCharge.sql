DELIMITER $
CREATE PROCEDURE proDeleteCharge
(id_charge INT) 
	BEGIN 
		DELETE FROM `charges_activities` WHERE `id_charge` = id_charge;
		DELETE FROM `charges` WHERE `id` = id_charge;
	END$