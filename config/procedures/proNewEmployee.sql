DELIMITER $
CREATE PROCEDURE proNewEmployee 
(names VARCHAR(100),
last_names VARCHAR(100),
birthday DATE,
photo INT,
phone_number VARCHAR(100),
email VARCHAR(200),
no_interior VARCHAR(10),
no_exterior VARCHAR(10),
referencias VARCHAR(255),
street VARCHAR(100),
colony VARCHAR(100),
charge INT,
position INT,
`contract` INT,
rfc VARCHAR(100),
nss VARCHAR(100)) 
	BEGIN 
		INSERT INTO files(`name`, `type`, `file`) 
		VALUES ('foto', 'image', 'archivo');
		SELECT MAX(id) INTO @idFPhoto FROM files;	
		INSERT INTO files(`name`, `type`, `file`) 
		VALUES ('contrato', 'pdf', 'archivo');
		SELECT MAX(id) INTO @idFContract FROM files;	
		INSERT INTO addresses(no_exterior, no_interior, `references`, street, colony)
		VALUES (no_exterior, no_interior, referencias, street, colony);
		SELECT MAX(id) INTO @idAddressEmployee FROM addresses;
		INSERT INTO employees(names,last_names,birthday,phone_number, email, id_img, id_address, id_contract,active, rfc, nss) 
		VALUES (names, last_names, birthday, phone_number, email, @idFPhoto, @idAddressEmployee, @idFContract,true, rfc, nss); 
		SELECT MAX(id) INTO @idNewEmployee FROM employees;
		INSERT INTO charges_employees(id_charge, id_employee)
		VALUES (charge, @idNewEmployee);
		INSERT INTO positions_employees(id_position, id_employee)
		VALUES (position, @idNewEmployee);
	END$