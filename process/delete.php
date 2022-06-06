<?php
    if(isset($_GET['id'])){
        include('../config/db.php');
        $DataBase = new db();
        $id =intval($_GET['id']);
        $tabla = $_GET['table'];
        $location = $_GET['location'];
        $res = $DataBase->delete_data_table($tabla,$id);
        if($res){
            header("location: ../$location.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>