
<?php 
    if(isset($_POST) && isset($_POST['typeOp']) && isset($_POST['id']) && isset($_POST['update'])){
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
            case 9:#
                update_area($_POST);
                break;
            case 10:#
                update_pass($_POST);
                break;
            case 11:
                update_status_employee($_POST);
                break;
            case 12:
                update_status_announcement($_POST);
                break;
            case 13:
                update_status_user($_POST);
                break;
            case 14:
                update_status_employee_announcement($_POST);
                break;
            default:
                header('location: ../error.php');
                break;
        }
        
    }
    
    function update_status_employee($data){
        $DataBase = new db();
        $id =intval($data['id']);
        $idu = intval($data['idu']);
        $res = $DataBase->update_active_employees($id, $idu);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_status_user($data){
        $DataBase = new db();
        $id =intval($data['id']);
        
        $res = $DataBase->update_active_users($id);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_status_announcement($data){
        $DataBase = new db();
        $id =intval($data['id']);
        
        $res = $DataBase->update_active_announcements($id);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                icon: 'success',
                button: 'Ok!',
              });</script>";
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
            echo "<script> swal({
                title: 'Listo!',
                text: 'El usuario seleccionado fue editado correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_trainings($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $date_start = $data['date_start'] == false ? 0 : $data['date_start'];
        $date_finish = $data['date_finish'] == false ? 0 : $data['date_finish'];
        $res = $DataBase->update_t_trainings($id, $name, $description, $date_start, $date_finish);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'La capacitación seleccionada fue editada correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
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
            echo "<script> swal({
                title: 'Listo!',
                text: 'El cargo seleccionado fue editado correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_employee($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $names = $DataBase->sanitize($data['names']);
        $last_names = $DataBase->sanitize($data['last_names']);
        $birthday = $DataBase->sanitize($data['birthday']);
        $phone_number = $DataBase->sanitize($data['phone_number']);
        $email = $DataBase->sanitize($data['email']);
        $no_interior = $DataBase->sanitize($data['no_interior']);
        $no_exterior = $DataBase->sanitize($data['no_exterior']);
        $references = $DataBase->sanitize($data['references']);
        $street = $DataBase->sanitize($data['street']);
        $colony = $DataBase->sanitize($data['colony']);
        $charge = intval($data['charge']);
        $position = intval($data['position']);
        $nss = $DataBase->sanitize($data['nss']);
        $rfc = $DataBase->sanitize($data['rfc']);
        $res = $DataBase->proEditEmployee($id,$names, $last_names, $birthday, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge, $position,$nss,$rfc);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El empleado seleccionado fue editado correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_position($data){
        $DataBase = new db();
        $id = intval($data['id']);
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $area = intval($data['area']);
        $res = $DataBase->update_t_positions($id, $name, $description, $area);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El puesto seleccionado fue editado correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo ("error");
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
            echo "<script> swal({
                title: 'Listo!',
                text: 'La actividad seleccionada fue editada correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
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
        $appointment_date = $data['appointment_date'] === false ? 0 : $DataBase->sanitize($data['appointment_date']);
        $request_position = intval($data['request_position']);
        $perfil = $DataBase->sanitize($data['perfil']);
        $res = $DataBase->update_candidate($id, $name, $phone_number, $email, $appointment_date, $request_position, $perfil);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El candidato seleccionado fue editado correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_announcement($data){
        $DataBase = new db();
        $id = intval($_POST['id']);
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $date_start = $DataBase->sanitize($_POST['date_start']);
        $position = intval($_POST['position']);
        $charge = intval($_POST['charge']);
        $area = intval($_POST['area']);
        $process = $DataBase->sanitize($_POST['process']);
        $profile = $DataBase->sanitize($_POST['profile']);
        $functions  = $DataBase->sanitize($_POST['functions']);

        $res =$DataBase->update_t_announcements($id,$name,$description,$date_start,$position,$process,$profile,$functions,$charge,$area);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'La convocatoria seleccionada fue editada correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_area($data){
        $DataBase = new db();
        $id = intval($_POST['id']);
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $res = $DataBase->update_t_area($id,$name,$description);

        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El area seleccionada fue editada correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_pass($data){
        $DataBase = new db();
        $id = intval($_POST['id']);
        $password = $DataBase->sanitize($_POST['password']);
        $res = $DataBase->update_t_pass($id,$password);

        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'La contraseña fue editada correctamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
    function update_status_employee_announcement($data){
        $DataBase = new db();
        $ide = intval($_POST['id']);
        $ida = intval($_POST['ida']);
        $status = intval($_POST['status']);
        $notice = $DataBase->sanitize($_POST['notice']);
        $res = $DataBase->update_status_emp_announcement($ide,$ida,$status,$notice);
        $msg;
        if($status == 1){
            $msg = "fue aceptado";
        }else{
            $msg = "fue rechazado";
        }
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El aspirante $msg.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            header('location: ../error.php');
        }
    }
?>