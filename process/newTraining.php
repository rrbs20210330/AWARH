<?php 
    include('../config/db.php');
	$DataBase = new db();
    if(isset($_POST) && !empty($_POST)){
        
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $file = $DataBase->sanitize($_POST['file']);
        $date_realization = $DataBase->sanitize($_POST['date_realization']);
        $employee = intval($DataBase->sanitize($_POST['employee']));
        $res = $DataBase->proNewTraining($name, $description, '0', $employee, $date_realization);
        if($res){
            header("location: ../training.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>
