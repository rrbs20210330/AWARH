DELIMITER $
CREATE FUNCTION `numActCh`(id INT) RETURNS int(11)
BEGIN
	select COUNT(r.id_charge) INTO @cant FROM charges c inner join charges_activities r ON r.id_charge = c.id where c.id = id; 
    RETURN @cant;
 END$