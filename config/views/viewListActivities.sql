CREATE VIEW listCharges as 
SELECT c.id, c.`name`, c.`description` FROM charges as c;