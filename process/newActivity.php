<?php 
    include('../config/db.php');
	$DataBase = new db();
    if(isset($_POST) && !empty($_POST)){
        
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $charge = intval($DataBase->sanitize($_POST['charge']));
        
        $res = $DataBase->proNewActivity($name, $description, $charge);
        if($res){
            header("location: ../activities.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>
