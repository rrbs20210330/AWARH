<?php 
    include('../config/db.php');
    if(isset($_GET) && isset($_GET['id']) && isset($_GET['typeOp'])){
        switch (intval($_GET['typeOp'])) {
            case 1:
                update_status_employee($_GET);
                break;
            case 2:
                update_status_announcement($_GET);
                break;
            case 3:
                update_status_user($_GET);
                break;
            default:
                header('location: ../error.php');
                break;
        }
        
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
            case 4:#
                update_employee($_POST);
                break;
            case 5:#
                update_position($_POST);
                break;
            case 6:#
                update_activity($_POST);
                break;
            case 7:#
                update_candidate($_POST);
                break;
            case 8:
                update_announcement($_POST);
                break;
            default:
                header('location: ../error.php');
                break;
        }
        
    }
    
    function update_status_employee($data){
        $DataBase = new db();
        $id =intval($data['id']);
        $table = $data['table'];
        $location = $data['location'];
        
        $res = $DataBase->update_active_employees($id);
        if($res){
            header("location: ../$location.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_status_user($data){
        $DataBase = new db();
        $id =intval($data['id']);
        $table = $data['table'];
        $location = $data['location'];
        
        $res = $DataBase->update_active_users($id);
        if($res){
            header("location: ../$location.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_status_announcement($data){
        $DataBase = new db();
        $id =intval($data['id']);
        $table = $data['table'];
        $location = $data['location'];
        
        $res = $DataBase->update_active_announcements($id);
        if($res){
            header("location: ../$location.php");
        }else{
            header('location: ../error.php');
        }
    }

    function update_user($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $user = $data['user'];
        $password = $data['password'];
        $res = $DataBase->update_t_users($id, $user,$password);
        if($res){
            header("location: ../config.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_trainings($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $employee = intval($data['employee']);
        $date = $data['date_realization'] == false ? 0 : $data['date_realization'];
        $res = $DataBase->update_t_trainings($id, $name, $description, $employee, $date);
        if($res){
            header("location: ../trainings.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_charge($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $res = $DataBase->update_t_charges($id,$name, $description);
        if($res){
            header("location: ../config.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_employee($data){
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
    function update_position($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);

        $res = $DataBase->update_t_positions($id, $name, $description);
        if($res){
            header("location: ../config.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_activity($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $charge = intval($data['charge']);
        
        $res = $DataBase->proEditActivity($id,$name, $description, $charge);
        if($res){
            header("location: ../config.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_candidate($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $name = $DataBase->sanitize($data['name']);
        $phone_number = $DataBase->sanitize($data['phone_number']);
        $email = $DataBase->sanitize($data['email']);
        $appointment_date = $data['appointment_date'] == false ? 0 : $data['appointment_date'];
        $request_position = intval($data['request_position']);
        $perfil = $DataBase->sanitize($data['perfil']);
        $id_cv = 1;
        $res = $DataBase->update_candidate($id, $name, $phone_number, $email, $appointment_date, $request_position, $perfil, $id_cv);
        if($res){
            header("location: ../candidates.php");
        }else{
            header('location: ../error.php');
        }
    }
    function update_announcement($data){
        $DataBase = new db();
        $id = intval($_POST['id']);
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $date_start = $_POST['date_start'] == false ? 0 : $data['date_start'];
        $date_finish = $_POST['date_finish'] == false ? 0 : $data['date_finish'];
        $position = intval($_POST['position']);
        $process = $DataBase->sanitize($_POST['process']);
        $profile = $DataBase->sanitize($_POST['profile']);
        $functions  = $DataBase->sanitize($_POST['functions']);

        $res =$DataBase->update_t_announcements($id,$name,$description,$date_start,$date_finish,$position,$process,$profile,$functions,true);
        if($res){
            header("location: ../announcements.php");
        }else{
            header('location: ../error.php');
        }
    }
?>