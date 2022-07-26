<?php
include('../config/reports.php');
    if(isset($_GET) && isset($_GET['typeOp']) && isset($_GET['report'])){
        if(isset($_GET['id'])){

        }
        switch (intval($_GET['typeOp'])) {
            case 1:#Borrado general de una sola tabla e id, dando como entrada de que archivo viene y que tabla y fila eliminara de la base de datos.
                delete_general_info($_GET);
                break;
            case 2:#Borrado de una actividad, por ende tambien su relacion con sus cargos
                delete_activity($_GET);
                break;
            case 3:#Borrado de un cargo, por ende tambien su relacion con sus actividades y empleados
                delete_charge($_GET);
                break;
            default:
                header('location: ../error.php');
                break;
        }
    }
$pdf = new Report();
$pdf->GenerateReportAllEmployees();?>