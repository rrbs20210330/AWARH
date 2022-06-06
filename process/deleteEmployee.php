<?php
    if(isset($_GET['id'])){
        include('../config/db.php');
        $DataBase = new db();
        $id = intval($_GET['id']);
        $res = $DataBase->proDeleteEmployee($id);
        if($res ){
            header("location: ../employees.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>