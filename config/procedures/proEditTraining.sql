DELIMITER $
CREATE PROCEDURE proEditTraining
(id_position INT) 
	BEGIN 
		UPDATE activities as a, charges_activities as ca SET a.name = '$name', a.description = '$description', ca.id_charge = $id_charge WHERE a.id = $id and ca.id_activities = $id
	END$