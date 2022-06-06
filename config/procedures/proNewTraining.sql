DELIMITER $
CREATE PROCEDURE proNewTraining 
(`name` VARCHAR(100),
`description` VARCHAR(200),
`file` VARCHAR(100),
employee INT(10),
date_realization date) 
	BEGIN 
		INSERT INTO files(`name`, `type`, `file`) 
		VALUES ('capacitacion', 'pdf', 'archivo');
		SELECT MAX(id) INTO @idFTraining FROM files;
		INSERT INTO training(`name`, `description`, `date_realization`, `id_employee`,`id_file`)
		VALUES (name, description, date_realization, employee, @idFTraining);
	END$