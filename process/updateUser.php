<?php
    if(isset($_POST['id'])){
        include('../config/db.php');
        $DataBase = new db();
        $id =intval($_POST['id']);
        $location = $_POST['location'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $res = $DataBase->update_t_users($id, $user,$password);
        if($res){
            header("location: ../$location.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>