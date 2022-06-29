DELIMITER $
CREATE PROCEDURE proEditEmployee 
(`id_employee` INT) 
	BEGIN 
		SELECT id_address INTO @address FROM employees WHERE id=id_employee;

        UPDATE employees as e ,addresses as ae SET e.names = "names", e.last_names = "last_names", e.birthday = "birthday", e.phone_number = "phone_number", e.email = "email", e.rfc = "rfc", e.nss = "nss", ae.no_interior = "no_interior", ae.no_exterior = "no_exterior", ae.references = "references", ae.street = "street", ae.colony = "colony" WHERE e.id = id_employee and ae.id = @address;
        
    END$