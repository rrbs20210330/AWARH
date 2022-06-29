<?php
    include('../config/db.php');
    if(isset($_POST) && isset($_POST['typeOp']) && isset($_POST['id'])){
        switch (intval($_POST['typeOp'])) {
            case 1:#Borrado general de una sola tabla e id, dando como entrada de que archivo viene y que tabla y fila eliminara de la base de datos.
                delete_general_info($_POST);
                break;
            case 2:#Borrado de una actividad, por ende tambien su relacion con sus cargos
                delete_activity($_POST);
                break;
            case 3:#Borrado de un cargo, por ende tambien su relacion con sus actividades y empleados
                delete_charge($_POST);
                break;
            case 4:#Borrado de un empleado, por ende tambien su relacion con un puesto, cargo, y archivos
                delete_employee($_POST);
                break;
            case 5:#Borrado de una posicion, por ende su relacion con empleado
                delete_position($_POST);
                break;
            case 6:
                delete_candidate($_POST);
                break;
            case 7: 
                delete_training($_POST);
                break;
            case 8:
                delete_announcements($_POST);
                break;
            case 9: 
                delete_area($_POST);
                break;
            default:
                header('location: ../error.php');
                break;
        }
        
    }else{
        header('location: ../error.php');
    }

    function delete_general_info($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->delete_data_users($id);
        if($res){
            header("location: ../users.php");
        }else{
            header('location: ../error.php');
        }
    }
    
    function delete_activity($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeleteActivity($id);
        if($res ){
            header("location: ../activities.php");
        }else{
            header('location: ../error.php');
        }
    }
    function delete_charge($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeleteCharge($id);
        if($res ){
            header("location: ../charges.php");
        }else{
            header('location: ../error.php');
        }
    }
    function delete_employee($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeleteEmployee($id);
        if($res ){
            header("location: ../employees.php");
        }else{
            header('location: ../error.php');
        }
    }
    function delete_position($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeletePosition($id);
        if($res ){
            header("location: ../positions.php");
        }else{
            header('location: ../error.php');
        }
    }
    function delete_candidate($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeleteCandidate($id);
        if($res){
            header("location: ../candidates.php");
        }else{
            header('location: ../error.php');
        }
    }
    function delete_training($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeleteTraining($id);
        if($res){
            header("location: ../trainings.php");
        }else{
            header('location: ../error.php');
        }
        
    }
    function delete_announcements($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeleteAnnouncement($id);
        if($res){
            header("location: ../announcements.php");
        }else{
            header('location: ../error.php');
        }
    }
    function delete_area($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $res = $DataBase->proDeleteArea($id);
        if($res){
            header("location: ../areas.php");
        }else{
            header("location: ../error.php");
        }
    }
?>