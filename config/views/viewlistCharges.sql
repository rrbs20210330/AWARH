CREATE VIEW listCharges as 
select `c`.`id` AS `chargeID`,`c`.`description` AS `chargeDesc`,`c`.`name` AS `chargeName` from `recursoshumanos`.`charges` `c`