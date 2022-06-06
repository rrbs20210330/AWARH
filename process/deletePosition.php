<?php
    if(isset($_GET['id'])){
        include('../config/db.php');
        $DataBase = new db();
        $id = intval($_GET['id']);
        $res = $DataBase->proDeletePosition($id);
        if($res ){
            header("location: ../positions.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>