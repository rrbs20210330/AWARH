<?php
    if(isset($_GET['id'])){
        include('../config/db.php');
        $DataBase = new db();
        $id =intval($_GET['id']);
        $status = intval($_GET['status']);
        $table = $_GET['table'];
        $location = $_GET['location'];
        if($status == 0){
            $status = true;
        }else{
            $status = false;
        }
        $res = $DataBase->update_active($table, $status, $id);
        if($res){
            header("location: ../$location.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>