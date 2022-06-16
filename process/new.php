<?php 
    include('../config/db.php');
     //!empty($_POST)
    // return print_r($_POST['typeOp']);
    if(isset($_POST) && isset($_POST['typeOp'])){
        
        switch (intval($_POST['typeOp'])) {
            case 1:#
                new_user($_POST);
                break;
            case 2:#
                new_activity($_POST);
                break;
            case 3:#
                new_employee($_POST);
                break;
            case 4:#
                new_activity($_POST);
                break;
            case 5:#
                new_announcement($_POST);
                break;
            case 6: 
                new_charge($_POST);
                break;
            case 7:
                new_position($_POST);
                break;
            case 8:
                new_training($_POST);
                break;
            default:
                header('location: ../error.php');
                break;
        }
        
    }else{
        header('location: ../error.php');
    }
    function new_user($data){
        $DataBase = new db();
        $user = $DataBase->sanitize($data['user']);
        $password = $DataBase->sanitize($data['password']);
        $res = $DataBase->insert_t_users($user, $password, true);//siempre sera true por que es un nuevo usuario activo, la fecha de ultima entrada no se añade por obvias razones

        if($res){
            header("location: ../config.php");
        }else{
            header('location: ../error.php');
        }
    }

    function new_training($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $file = $DataBase->sanitize($data['file']);
        $date_realization = $DataBase->sanitize($data['date_realization']);
        $employee = intval($DataBase->sanitize($data['employee']));
        $res = $DataBase->proNewTraining($name, $description, '0', $employee, $date_realization);
        if($res){
            header("location: ../training.php");
        }else{
            header('location: ../error.php');
        }
    }

    function new_employee($data){
        $DataBase = new db();
        $names = $DataBase->sanitize($data['names']);
        $last_names = $DataBase->sanitize($data['last_names']);
        $birthday = $DataBase->sanitize($data['birthday']);
        $photo = $DataBase->sanitize($data['photo']);
        $phone_number = $DataBase->sanitize($data['phone_number']);
        $email = $DataBase->sanitize($data['email']);
        $no_interior = $DataBase->sanitize($data['no_interior']);
        $no_exterior = $DataBase->sanitize($data['no_exterior']);
        $references = $DataBase->sanitize($data['references']);
        $street = $DataBase->sanitize($data['street']);
        $colony = $DataBase->sanitize($data['colony']);
        $charge = intval($data['charge']);
        $position = intval($data['position']);
        $contract = $DataBase->sanitize($data['contract']);
        $rfc = $DataBase->sanitize($data['rfc']);
        $nss = $DataBase->sanitize($data['nss']);
        $res = $DataBase->proNewEmployee($names, $last_names, $birthday, $photo, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge, $position, $contract, $rfc,$nss);
        if($res){
            header("location: ../employees.php");
        }else{
            header('location: ../error.php');
        }
    }

    function new_activity($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $charge = intval($DataBase->sanitize($data['charge']));
        
        $res = $DataBase->proNewActivity($name, $description, $charge);
        if($res){
            header("location: ../config.php");
        }else{
            header('location: ../error.php');
        }
    }
    
    function new_announcement($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $charge = intval($DataBase->sanitize($data['charge']));
        
        $res = $DataBase->proNewAnnouncement($name, $description, $charge);
        if($res){
            header("location: ../announcements.php");
        }else{
            header('location: ../error.php');
        }
    }

    function new_charge($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $res = $DataBase->insert_t_charges($name, $description);

        if($res){
            header('location: ../config.php');
        }else{
            header('location: ../error.php');
        }
    }
    function new_position($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $res = $DataBase->insert_t_positions($name, $description);
        if($res){
            header('location: ../config.php');
        }else{
            header('location: ../error.php');
        }
    }
?>