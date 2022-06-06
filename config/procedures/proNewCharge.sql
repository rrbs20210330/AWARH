DELIMITER $
CREATE PROCEDURE proNewCharge
(`name` VARCHAR(100),
`description` VARCHAR(200),
`id_position` INT(10)) 
	BEGIN 
		INSERT INTO charges(`name`, `description`) 
		VALUES (name, description);
		SELECT MAX(id) INTO @idCharge FROM charges;
        INSERT INTO charges_positions(`id_charge`, `id_position`)
        VALUES (@idCharge, id_position);
		-- Fusionar con Activities - Actualmente no se usa este procedimiento
	END$