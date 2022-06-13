<?php 
    include('../config/db.php');
    const DataBase = new db();
    if(isset($_GET) && isset($_GET['id'])){
        return update_status($_GET);
    }
    if(isset($_POST) && isset($_POST['typeOp']) && isset($_POST['id'])){
        switch (intval($_POST['typeOp'])) {
            case 1:#
                update_user($_POST);
                break;
            case 2:#
                update_trainings($_POST);
                break;
            case 3:#
                update_charge($_POST);
                break;
            default:
                header('location: ../error.php');
                break;
        }
        
    }else{
        header('location: ../error.php');
    }
    
    function update_status($data){
        $id =intval($data['id']);
        $table = $data['table'];
        $location = $data['location'];
        
        $res = DataBase->update_active($table, $id);
        if($res){
            header("location: ../$location.php");
        }else{
            header('location: ../error.php');
        }
    }

    function update_user($data){
        $id = intval($data['id']);
        $user = $data['user'];
        $password = $data['password'];
        $res = DataBase->update_t_users($id, $user,$password);
        if($res){
            header("location: ../users.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_trainings($data){
        $id = intval($data['id']);
        $name = DataBase->sanitize($data['name']);
        $description = DataBase->sanitize($data['description']);
        $employee = intval($data['employee']);
        $date = intval($data['date_realization']);
        $res = DataBase->update_t_trainings($id, $name, $description, $employee, $date);
        if($res){
            header("location: ../training.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_charge($data){
        $id = intval($data['id']);
        $name = DataBase->sanitize($data['name']);
        $description = DataBase->sanitize($data['description']);
        $res = DataBase->update_t_charges($id,$name, $description);
        if($res){
            header("location: ../charges.php");
        }else{
            header('location: ../error.php');
        }
    }
?>