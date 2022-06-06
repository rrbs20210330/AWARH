DELIMITER $
CREATE PROCEDURE proNewActivity
(name VARCHAR(100),
description VARCHAR(200),
id_charge INT(10)) 
	BEGIN 
		INSERT INTO `activities`(`name`, `description`) 
		VALUES (name, description);
		SELECT MAX(id) INTO @idActivity FROM `activities`;
        INSERT INTO `charges_activities`(`id_charge`, `id_activities`)
        VALUES (id_charge,@idActivity);
	END$