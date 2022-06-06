<?php 
    include('../config/db.php');
    $DataBase = new db();
    if(isset($_POST) && !empty($_POST)){
        
        $user = $DataBase->sanitize($_POST['user']);
        $password= $DataBase->sanitize($_POST['password']);
        $location = $_POST['location'];
        $res = $DataBase->insert_t_users($user, $password, true);//siempre sera true por que es un nuevo usuario activo, la fecha de ultima entrada no se añade por obvias razones

        if($res){
            header("location: ../$location.php");
        }else{
            echo 'Error al eliminar un registro';
        }
        
        
       
    }
    
?>