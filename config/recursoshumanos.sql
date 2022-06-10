-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2022 a las 18:29:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `recursoshumanos`
--
CREATE DATABASE IF NOT EXISTS `recursoshumanos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `recursoshumanos`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `proDeleteActivity`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proDeleteActivity` (`id_activity` INT)   BEGIN 
		DELETE FROM `charges_activities` WHERE `id_activities` = id_activity;
		DELETE FROM `activities` WHERE `id` = id_activity;
	END$$

DROP PROCEDURE IF EXISTS `proDeleteCharge`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proDeleteCharge` (`id_charge` INT)   BEGIN 
		DELETE FROM `charges_activities` WHERE `id_charge` = id_charge;
		DELETE FROM `charges_employees` WHERE `id_charge` = id_charge;
		DELETE FROM `charges` WHERE `id` = id_charge;
	END$$

DROP PROCEDURE IF EXISTS `proDeleteEmployee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proDeleteEmployee` (`id_employee` INT)   BEGIN 
		DELETE FROM `charges_employees` WHERE `id_employee` = id_employee;
		DELETE FROM `positions_employees` WHERE `id_employee` = id_employee;
		DELETE FROM `employees` WHERE `id` = id_employee;
	END$$

DROP PROCEDURE IF EXISTS `proDeletePosition`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proDeletePosition` (`id_position` INT)   BEGIN 
	 	DELETE FROM `positions_employees` WHERE `id_position` = id_position;
		DELETE FROM `announcements_positions` WHERE `id_position` = id_position;
		DELETE FROM `positions` WHERE `id` = id_position;
	END$$

DROP PROCEDURE IF EXISTS `proNewActivity`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proNewActivity` (`name` VARCHAR(100), `description` VARCHAR(200), `id_charge` INT(10))   BEGIN 
		INSERT INTO `activities`(`name`, `description`) 
		VALUES (name, description);
		SELECT MAX(id) INTO @idActivity FROM `activities`;
        INSERT INTO `charges_activities`(`id_charge`, `id_activities`)
        VALUES (id_charge,@idActivity);
	END$$

DROP PROCEDURE IF EXISTS `proNewCharge`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proNewCharge` (`name` VARCHAR(100), `description` VARCHAR(200), `id_position` INT(10))   BEGIN 
		INSERT INTO charges(`name`, `description`) 
		VALUES (name, description);
		SELECT MAX(id) INTO @idCharge FROM charges;
        INSERT INTO charges_positions(`id_charge`, `id_position`)
        VALUES (@idCharge, id_position);
		-- Fusionar con Activities - Actualmente no se usa este procedimiento
	END$$

DROP PROCEDURE IF EXISTS `proNewEmployee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proNewEmployee` (`names` VARCHAR(100), `last_names` VARCHAR(100), `birthday` DATE, `photo` INT, `phone_number` VARCHAR(100), `email` VARCHAR(200), `no_interior` VARCHAR(10), `no_exterior` VARCHAR(10), `referencias` VARCHAR(255), `street` VARCHAR(100), `colony` VARCHAR(100), `charge` INT, `position` INT, `contract` INT, `rfc` VARCHAR(100), `nss` VARCHAR(100))   BEGIN 
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
	END$$

DROP PROCEDURE IF EXISTS `proNewTraining`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proNewTraining` (`name` VARCHAR(100), `description` VARCHAR(200), `file` VARCHAR(100), `employee` INT(10), `date_realization` DATE)   BEGIN 
		INSERT INTO files(`name`, `type`, `file`) 
		VALUES ('capacitacion', 'pdf', 'archivo');
		SELECT MAX(id) INTO @idFTraining FROM files;
		INSERT INTO training(`name`, `description`, `date_realization`, `id_employee`,`id_file`)
		VALUES (name, description, date_realization, employee, @idFTraining);
	END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `numActCh`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `numActCh` (`id` INT) RETURNS INT(11)  BEGIN
	select COUNT(r.id_charge) INTO @cant FROM charges c inner join charges_activities r ON r.id_charge = c.id where c.id = id; 
    RETURN @cant;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `name`, `description`) VALUES
(3, 'zxc', 'zxc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `no_interior` varchar(10) NOT NULL,
  `no_exterior` varchar(10) NOT NULL,
  `references` varchar(255) NOT NULL,
  `street` varchar(100) NOT NULL,
  `colony` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_start` date NOT NULL,
  `date_finish` date NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `announcements_positions`
--

DROP TABLE IF EXISTS `announcements_positions`;
CREATE TABLE `announcements_positions` (
  `id_announcement` int(11) NOT NULL,
  `id_position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `id_special` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidate`
--

DROP TABLE IF EXISTS `candidate`;
CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `request_position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charges`
--

DROP TABLE IF EXISTS `charges`;
CREATE TABLE `charges` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `charges`
--

INSERT INTO `charges` (`id`, `name`, `description`) VALUES
(1, 'dwada', 'dwa'),
(2, 'zxc', 'zxc'),
(3, 'asdasdaada', 'asdasdadasd'),
(4, 'asdasd', 'asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charges_activities`
--

DROP TABLE IF EXISTS `charges_activities`;
CREATE TABLE `charges_activities` (
  `id_charge` int(11) NOT NULL,
  `id_activities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `charges_activities`
--

INSERT INTO `charges_activities` (`id_charge`, `id_activities`) VALUES
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charges_employees`
--

DROP TABLE IF EXISTS `charges_employees`;
CREATE TABLE `charges_employees` (
  `id_charge` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `last_names` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rfc` varchar(100) NOT NULL,
  `nss` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `id_contract` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  `id_address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee_files`
--

DROP TABLE IF EXISTS `employee_files`;
CREATE TABLE `employee_files` (
  `id` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(200) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `infoemployee`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `infoemployee`;
CREATE TABLE `infoemployee` (
`id` int(11)
,`employee_full_name` varchar(201)
,`email` varchar(100)
,`rfc` varchar(100)
,`nss` varchar(100)
,`phone_number` varchar(100)
,`birthday` date
,`no_exterior` varchar(10)
,`no_interior` varchar(10)
,`references` varchar(255)
,`street` varchar(100)
,`colony` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listcharges`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `listcharges`;
CREATE TABLE `listcharges` (
`chargeID` int(11)
,`chargeDesc` varchar(100)
,`chargeName` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listemployees`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `listemployees`;
CREATE TABLE `listemployees` (
`id` int(11)
,`active` tinyint(1)
,`names` varchar(100)
,`last_names` varchar(100)
,`phone_number` varchar(100)
,`email` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listtrainings`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `listtrainings`;
CREATE TABLE `listtrainings` (
`id` int(11)
,`name` varchar(100)
,`employee_full_name` varchar(201)
,`date_realization` date
,`description` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions_employees`
--

DROP TABLE IF EXISTS `positions_employees`;
CREATE TABLE `positions_employees` (
  `id_employee` int(11) DEFAULT NULL,
  `id_position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `id_form` int(11) NOT NULL,
  `question` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `training`
--

DROP TABLE IF EXISTS `training`;
CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `date_realization` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `id_file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `last_join` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `active`, `last_join`) VALUES
(20, '', '', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura para la vista `infoemployee`
--
DROP TABLE IF EXISTS `infoemployee`;

DROP VIEW IF EXISTS `infoemployee`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `infoemployee`  AS SELECT `e`.`id` AS `id`, concat(`e`.`names`,' ',`e`.`last_names`) AS `employee_full_name`, `e`.`email` AS `email`, `e`.`rfc` AS `rfc`, `e`.`nss` AS `nss`, `e`.`phone_number` AS `phone_number`, `e`.`birthday` AS `birthday`, `a`.`no_exterior` AS `no_exterior`, `a`.`no_interior` AS `no_interior`, `a`.`references` AS `references`, `a`.`street` AS `street`, `a`.`colony` AS `colony` FROM (`employees` `e` join `addresses` `a` on(`e`.`id_address` = `a`.`id`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listcharges`
--
DROP TABLE IF EXISTS `listcharges`;

DROP VIEW IF EXISTS `listcharges`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listcharges`  AS SELECT `c`.`id` AS `chargeID`, `c`.`description` AS `chargeDesc`, `c`.`name` AS `chargeName` FROM `charges` AS `c``c`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listemployees`
--
DROP TABLE IF EXISTS `listemployees`;

DROP VIEW IF EXISTS `listemployees`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listemployees`  AS SELECT `employees`.`id` AS `id`, `employees`.`active` AS `active`, `employees`.`names` AS `names`, `employees`.`last_names` AS `last_names`, `employees`.`phone_number` AS `phone_number`, `employees`.`email` AS `email` FROM `employees``employees`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listtrainings`
--
DROP TABLE IF EXISTS `listtrainings`;

DROP VIEW IF EXISTS `listtrainings`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listtrainings`  AS SELECT `t`.`id` AS `id`, `t`.`name` AS `name`, concat(`e`.`names`,' ',`e`.`last_names`) AS `employee_full_name`, `t`.`date_realization` AS `date_realization`, `t`.`description` AS `description` FROM (`training` `t` left join `employees` `e` on(`t`.`id_employee` = `e`.`id`))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_file` (`id_file`);

--
-- Indices de la tabla `announcements_positions`
--
ALTER TABLE `announcements_positions`
  ADD KEY `id_announcement` (`id_announcement`),
  ADD KEY `id_position` (`id_position`);

--
-- Indices de la tabla `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_question` (`id_question`);

--
-- Indices de la tabla `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_position` (`request_position`);

--
-- Indices de la tabla `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `charges_activities`
--
ALTER TABLE `charges_activities`
  ADD KEY `id_activities` (`id_activities`),
  ADD KEY `id_charge` (`id_charge`);

--
-- Indices de la tabla `charges_employees`
--
ALTER TABLE `charges_employees`
  ADD KEY `id_charge` (`id_charge`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contract` (`id_contract`),
  ADD KEY `id_img` (`id_img`),
  ADD KEY `id_address` (`id_address`);

--
-- Indices de la tabla `employee_files`
--
ALTER TABLE `employee_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_file` (`id_file`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `positions_employees`
--
ALTER TABLE `positions_employees`
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_position` (`id_position`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_form` (`id_form`);

--
-- Indices de la tabla `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_file` (`id_file`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `employee_files`
--
ALTER TABLE `employee_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`id_file`) REFERENCES `files` (`id`);

--
-- Filtros para la tabla `announcements_positions`
--
ALTER TABLE `announcements_positions`
  ADD CONSTRAINT `announcements_positions_ibfk_1` FOREIGN KEY (`id_announcement`) REFERENCES `announcements` (`id`),
  ADD CONSTRAINT `announcements_positions_ibfk_2` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id`);

--
-- Filtros para la tabla `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`);

--
-- Filtros para la tabla `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`request_position`) REFERENCES `charges` (`id`);

--
-- Filtros para la tabla `charges_activities`
--
ALTER TABLE `charges_activities`
  ADD CONSTRAINT `charges_activities_ibfk_1` FOREIGN KEY (`id_activities`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `charges_activities_ibfk_2` FOREIGN KEY (`id_charge`) REFERENCES `charges` (`id`);

--
-- Filtros para la tabla `charges_employees`
--
ALTER TABLE `charges_employees`
  ADD CONSTRAINT `charges_employees_ibfk_1` FOREIGN KEY (`id_charge`) REFERENCES `charges` (`id`),
  ADD CONSTRAINT `charges_employees_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`);

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`id_contract`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`id_img`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`);

--
-- Filtros para la tabla `employee_files`
--
ALTER TABLE `employee_files`
  ADD CONSTRAINT `employee_files_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `employee_files_ibfk_2` FOREIGN KEY (`id_file`) REFERENCES `files` (`id`);

--
-- Filtros para la tabla `positions_employees`
--
ALTER TABLE `positions_employees`
  ADD CONSTRAINT `positions_employees_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `positions_employees_ibfk_2` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id`);

--
-- Filtros para la tabla `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_form`) REFERENCES `forms` (`id`);

--
-- Filtros para la tabla `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `training_ibfk_2` FOREIGN KEY (`id_file`) REFERENCES `files` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
