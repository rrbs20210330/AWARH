CREATE VIEW listTrainings as 
SELECT t.id, t.name,e.id as employee_id, CONCAT(e.names," ", e.last_names) as employee_full_name, date_realization, `description` FROM training as t LEFT JOIN employees as e on t.id_employee = e.id;
