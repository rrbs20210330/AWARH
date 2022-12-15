INSERT INTO `addresses`(`no_interior`, `no_exterior`, `references`, `street`, `colony`) VALUES ('[value-2]','[value-3]','[value-4]','[value-5]','[value-6]');

SELECT MAX(id) INTO @id_address FROM addresses;

INSERT INTO `files`(`name`, `type`, `file`) VALUES ('[value-2]','[value-3]','[value-4]');
SELECT MAX(id) INTO @id_contract FROM files;

INSERT INTO `files`(`name`, `type`, `file`) VALUES ('[value-2]','[value-3]','[value-4]');
SELECT MAX(id) INTO @id_img FROM files;

INSERT INTO `charges`(`name`, `description`) VALUES ('[value-2]','[value-3]');
SELECT MAX(id) INTO @id_charge FROM charges;

INSERT INTO `positions`(`name`, `description`) VALUES ('[value-1]','[value-2]');
SELECT MAX(id) INTO @id_position FROM positions;
INSERT INTO `employees`(`names`, `last_names`, `email`, `rfc`, `nss`, `active`, `phone_number`, `birthday`, `id_contract`, `id_img`, `id_address`) VALUES ('[value-2]','[value-3]','[value-4]','[value-5]','[value-6]',true,'[value-8]','[value-9]',@id_contract, @id_img, @id_address);
SELECT MAX(id) INTO @id_employee FROM employees;

INSERT INTO `employees_charges`(`id_employee`, `id_charge`) VALUES (@id_employee,@id_charge);

INSERT INTO `employees_positions`(`id_employee`, `id_position`) VALUES (@id_employee,@id_position);

INSERT INTO `files`(`name`, `type`, `file`) VALUES ('[value-2]','[value-3]','[value-4]');
SELECT MAX(id) INTO @id_file_training FROM files;
INSERT INTO `training`(`name`, `date_realization`, `description`, `id_file`) VALUES ('[value-1]','[value-2]','[value-3]',@id_file_training);
SELECT MAX(id) INTO @id_training FROM training;


INSERT INTO `employee_training`(`id_employee`, `id_training`) VALUES (@id_employee,@id_training);