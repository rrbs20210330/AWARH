
INSERT INTO `users`(`t_user`, `t_password`, `b_active`, `i_type`) VALUES ('admin1', '321tamarindo', 1, 1);


INSERT INTO `areas`(`t_name`, `t_description`) VALUES ('TICS', 'Area destinada al desarrollo y manejo de tecnologias');
SELECT MAX(`id_area`) INTO @Area FROM `areas`;
INSERT INTO `areas`(`t_name`, `t_description`) VALUES ('Gastro', 'Area destinada a la cocina y manejo de especias');
SELECT MAX(`id_area`) INTO @Gastro FROM `areas`;
INSERT INTO `areas`(`t_name`, `t_description`) VALUES ('Quimica', 'Area destinada a la investigacion y manejo de quimicos');
SELECT MAX(`id_area`) INTO @Quimica FROM `areas`;
INSERT INTO `positions`(`t_name`, `t_description`) VALUES ('PTC', 'Un puesto');
SELECT MAX(`id_position`) INTO @Puesto FROM `positions`;
INSERT INTO `positions_areas`(`fk_position`,`fk_area`) VALUES(@Puesto, @Area);
INSERT INTO `positions`(`t_name`, `t_description`) VALUES ('PA', 'Un puesto');
SELECT MAX(`id_position`) INTO @P1 FROM `positions`;
INSERT INTO `positions_areas`(`fk_position`,`fk_area`) VALUES(@P1, @Gastro);
INSERT INTO `positions`(`t_name`, `t_description`) VALUES ('Secretario', 'Un puesto');
SELECT MAX(`id_position`) INTO @P2 FROM `positions`;
INSERT INTO `positions_areas`(`fk_position`,`fk_area`) VALUES(@P2, @Quimica);


INSERT INTO `charges`(`t_name`, `t_description`) VALUES ('PTC A', 'Un cargo');
SELECT MAX(`id_charge`) INTO @Cargo FROM `charges`;
INSERT INTO `charges`(`t_name`, `t_description`) VALUES ('PTC B', 'Un cargo');
SELECT MAX(`id_charge`) INTO @C1 FROM `charges`;
INSERT INTO `charges`(`t_name`, `t_description`) VALUES ('PTC C', 'Un cargo');
SELECT MAX(`id_charge`) INTO @C2 FROM `charges`;
INSERT INTO `charges`(`t_name`, `t_description`) VALUES ('PTC D', 'Un cargo');
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Enseñar', 'Tendrá que aguantar a los alumnos');
SELECT MAX(`id_activity`) INTO @Act1 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act2 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act3 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act4 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act5 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act6 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act7 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act8 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act9 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act10 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act11 FROM `activities`;
INSERT INTO `activities`(`t_name`, `t_description`)VALUES('Administración', 'Una descripción');
SELECT MAX(`id_activity`) INTO @Act12 FROM `activities`;
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@Cargo, @Act1);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@Cargo, @Act2);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@Cargo, @Act3);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@Cargo, @Act4);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@Cargo, @Act5);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@Cargo, @Act6);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@C1, @Act7);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@C1, @Act8);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@C1, @Act9);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@C1, @Act10);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@C2, @Act11);
INSERT INTO `charges_activities`(`fk_charge`,`fk_activity`) VALUES(@C2, @Act12);


INSERT INTO `files`(`t_name`, `t_path`) VALUES ('CVrdcc','docs/CVrdcc.pdf');
SELECT MAX(`id_file`) INTO @CV FROM `files`;
INSERT INTO `candidates`(`t_name`,`t_phone_number`,`t_email`, `dt_appointment_date`, `t_profile`,`fk_cv`,`b_is_employee`) VALUES ('Roque Donato Cioara Caparroz', '3141743531','gdroquedonato3@yopmail.com', '2022-08-11 06:32:25','Decidido, Confiable, Egresado de alguna universidad chingona como la utem o algo asi.',@CV,false);
SELECT MAX(`id_candidate`) INTO @Cand1 FROM `candidates`;
INSERT INTO `candidates_positions`(`fk_candidate`, `fk_position`) VALUES (@Cand1, @Puesto);
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('CVadur','docs/CVadur.pdf');
SELECT MAX(`id_file`) INTO @CV2 FROM `files`;
INSERT INTO `candidates`(`t_name`,`t_phone_number`,`t_email`, `dt_appointment_date`, `t_profile`,`fk_cv`,`b_is_employee`) VALUES ('Adrian D. Urrutia Rel', '3141083423','ahrel7@yopmail.com', '2022-09-11 12:43:25','Decidido, Confiable, Egresado de alguna universidad chingona como la utem o algo asi.',@CV2,false);
SELECT MAX(`id_candidate`) INTO @Cand2 FROM `candidates`;
INSERT INTO `candidates_positions`(`fk_candidate`, `fk_position`) VALUES (@Cand2, @P1);
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('CVaasv','docs/CVaasv.pdf');
SELECT MAX(`id_file`) INTO @CV3 FROM `files`;
INSERT INTO `candidates`(`t_name`,`t_phone_number`,`t_email`, `dt_appointment_date`, `t_profile`,`fk_cv`,`b_is_employee`) VALUES ('Avril Alicia Santamaria Vallines', '3141004881','hpavrilalicia15@yopmail.com', '2022-11-23 10:13:25','Decidida, Confiable, Egresada de alguna universidad chingona como la utem o algo asi.',@CV3,false);
SELECT MAX(`id_candidate`) INTO @Cand3 FROM `candidates`;
INSERT INTO `candidates_positions`(`fk_candidate`, `fk_position`) VALUES (@Cand3, @P2);

INSERT INTO `files`(`t_name`, `t_path`) VALUES ('Contractnoc','docs/Contractnoc.pdf');
SELECT MAX(`id_file`) INTO @Contrato FROM `files`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('Photonoc','docs/Photonoc.pdf');
SELECT MAX(`id_file`) INTO @Foto FROM `files`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('CVnoc','docs/CVnoc.pdf');
SELECT MAX(`id_file`) INTO @CV FROM `files`;
INSERT INTO `addresses`(`t_no_exterior`, `t_no_interior`, `t_references`, `t_street`, `t_colony`)VALUES ('38', '304', 'En algun lugar cerca de una tienda de algun color', 'GOLDSMITH', 'POLANCO');
SELECT MAX(`id_address`) INTO @Direccion FROM `addresses`;
INSERT INTO `employees`(`t_names`,`t_last_names`,`d_birthday`,`t_phone_number`, `t_email`, `fk_img`, `fk_address`, `fk_contract`,`b_active`, `t_rfc`, `t_nss`, `fk_cv`) 
VALUES ('Nicholas', 'Obieta Carricajo', '2000-01-13', '3141083423', 'hjnicholas9@yopmail.com', @Foto, @Direccion, @Contrato,true, 'OICN000113L95', 'OICN000113L95', @CV); 
SELECT MAX(`id_employee`) INTO @Empleado FROM `employees`;
INSERT INTO `employees_charges`(`fk_employee`, `fk_charge`)
VALUES (@Empleado, @Cargo);
INSERT INTO `employees_positions`(`fk_employee`, `fk_position`)
VALUES (@Empleado, @Puesto);
SET @PASSWRD = CONCAT('psswrd',@Empleado);
SET @USER = CONCAT('e',@Empleado);
INSERT INTO `users`(`t_user`, `t_password`,`b_active`, `i_type`)
VALUES (@USER, @PASSWRD, true, 2);
SELECT MAX(`id_user`) INTO @Usuario FROM `users`;
INSERT INTO `employees_users`(`fk_employee`, `fk_user`)
VALUES (@Empleado, @Usuario);

INSERT INTO `files`(`t_name`, `t_path`) VALUES ('Contractmmf','docs/Contractmmf.pdf');
SELECT MAX(`id_file`) INTO @Contrato1 FROM `files`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('Photommf','docs/Photommf.pdf');
SELECT MAX(`id_file`) INTO @Foto1 FROM `files`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('CVmmf','docs/CVmmf.pdf');
SELECT MAX(`id_file`) INTO @CV1 FROM `files`;
INSERT INTO `addresses`(`t_no_exterior`, `t_no_interior`, `t_references`, `t_street`, `t_colony`)VALUES ('430', 'A-304', 'En algun lugar cerca de una tienda de algun color', 'MARTIN DE MAYORGA', 'VIRREYES OBRERA');
SELECT MAX(`id_address`) INTO @Direccion1 FROM `addresses`;
INSERT INTO `employees`(`t_names`,`t_last_names`,`d_birthday`,`t_phone_number`, `t_email`, `fk_img`, `fk_address`, `fk_contract`,`b_active`, `t_rfc`, `t_nss`, `fk_cv`) 
VALUES ('Maximino', 'Mehdaoui Fernández', '1998-07-21', '3141092271', 'hqmaximino16@yopmail.com', @Foto1, @Direccion1, @Contrato1,true, 'MEFM980721QP4', 'MEFM980721QP4', @CV1); 
SELECT MAX(`id_employee`) INTO @Empleado2 FROM `employees`;
INSERT INTO `employees_charges`(`fk_employee`, `fk_charge`)
VALUES (@Empleado2, @C1);
INSERT INTO `employees_positions`(`fk_employee`, `fk_position`)
VALUES (@Empleado2, @Puesto);
SET @PASSWRD = CONCAT('psswrd',@Empleado2);
SET @USER = CONCAT('e',@Empleado2);
INSERT INTO `users`(`t_user`, `t_password`,`b_active`, `i_type`)
VALUES (@USER, @PASSWRD, true, 2);
SELECT MAX(`id_user`) INTO @Usuario1 FROM `users`;
INSERT INTO `employees_users`(`fk_employee`, `fk_user`)
VALUES (@Empleado2, @Usuario1);


INSERT INTO `trainings`(`t_name`, `t_description`, `d_dates`)VALUES ('Capacitacion1', 'Una Descripción','07/14/2022 - 07/14/2022');
SELECT MAX(`id_training`) INTO @Capacitacion1 FROM `trainings`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('A1C1E1','docs/A1C1E1.pdf');
SELECT MAX(`id_file`) INTO @Archivo1C1E1 FROM `files`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('A2C1E1','docs/A2C1E1.pdf');
SELECT MAX(`id_file`) INTO @Archivo2C1E1 FROM `files`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('A2C1E1','docs/A2C1E1.pdf');
SELECT MAX(`id_file`) INTO @Archivo3C1E1 FROM `files`;
INSERT INTO `trainings_files`(`fk_training`, `fk_file`) VALUES (@Capacitacion1,@Archivo1C1E1);
INSERT INTO `trainings_files`(`fk_training`, `fk_file`) VALUES (@Capacitacion1,@Archivo2C1E1);
INSERT INTO `trainings_files`(`fk_training`, `fk_file`) VALUES (@Capacitacion1,@Archivo3C1E1);

INSERT INTO `trainings`(`t_name`, `t_description`, `d_dates`)VALUES ('Capacitacion2', 'Una Descripción','07/14/2022 - 07/14/2022');
SELECT MAX(`id_training`) INTO @Capacitacion2 FROM `trainings`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('A1C2E1','docs/A1C2E1.pdf');
SELECT MAX(`id_file`) INTO @Archivo1C2E1 FROM `files`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('A2C2E1','docs/A2C2E1.pdf');
SELECT MAX(`id_file`) INTO @Archivo2C2E1 FROM `files`;
INSERT INTO `trainings_files`(`fk_training`, `fk_file`) VALUES (@Capacitacion2,@Archivo1C2E1);
INSERT INTO `trainings_files`(`fk_training`, `fk_file`) VALUES (@Capacitacion2,@Archivo2C2E1);

INSERT INTO `trainings`(`t_name`, `t_description`, `d_dates`)VALUES ('Capacitacion3', 'Una Descripción','07/14/2022 - 07/14/2022');
SELECT MAX(`id_training`) INTO @Capacitacion3 FROM `trainings`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('A1C3E1','docs/A1C3E1.pdf');
SELECT MAX(`id_file`) INTO @Archivo1C3E1 FROM `files`;
INSERT INTO `trainings_files`(`fk_training`, `fk_file`) VALUES (@Capacitacion3,@Archivo1C3E1);

INSERT INTO `trainings`(`t_name`, `t_description`, `d_dates`)VALUES ('Capacitacion4', 'Una Descripción','07/14/2022 - 07/14/20221');
SELECT MAX(`id_training`) INTO @Capacitacion4 FROM `trainings`;
INSERT INTO `files`(`t_name`, `t_path`) VALUES ('A1C4E1','docs/A1C4E1.pdf');
SELECT MAX(`id_file`) INTO @Archivo1C4E2 FROM `files`;
INSERT INTO `trainings_files`(`fk_training`, `fk_file`) VALUES (@Capacitacion4,@Archivo1C4E2);
INSERT INTO `employees_trainings`(`fk_employee`, `fk_training`) VALUES (@Empleado, @Capacitacion1);
INSERT INTO `employees_trainings`(`fk_employee`, `fk_training`) VALUES (@Empleado, @Capacitacion2);
INSERT INTO `employees_trainings`(`fk_employee`, `fk_training`) VALUES (@Empleado, @Capacitacion3);
INSERT INTO `employees_trainings`(`fk_employee`, `fk_training`) VALUES (@Empleado2, @Capacitacion4);

