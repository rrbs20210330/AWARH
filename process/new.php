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
            case 9:#
                new_candidate($_POST);
                break;
            case 10:#
                new_area($_POST);
                break;
            default:
                // header('location: ../error.php');
                echo "efe";
                break;
        }
        
    }else{
        echo "efe";
        // header('location: ../error.php');
    }
    function new_user($data){
        $DataBase = new db();
        $user = $DataBase->sanitize($data['user']);
        $password = $DataBase->sanitize($data['password']);
        $res = $DataBase->insert_t_users($user, $password, true);//siempre sera true por que es un nuevo usuario activo, la fecha de ultima entrada no se añade por obvias razones

        if($res){
            header("location: ../users.php");
        }else{
            echo "efe";
        }
    }

    function new_training($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $date_start = $DataBase->sanitize($data['date_start']);
        $date_finish = $DataBase->sanitize($data['date_finish']);
        $employee = intval($DataBase->sanitize($data['employee']));
        $register_training = $DataBase->procedure_new_training($name,$description,$employee,$date_start,$date_finish);
        if(!$register_training){
            header('location: ../error.php');
        }
        foreach($_FILES["file"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["file"]["name"][$key] !== "" || $_FILES["file"]["name"][$key] !== null) {
                $filename = $DataBase->file_name($_FILES["file"]["name"][$key]); 
                $source = $_FILES["file"]["tmp_name"][$key];
                $file_type = $_FILES['file']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                
                $directorio = '../docs/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename . '.' . $extension;
                $file_path = 'docs/'.$filename.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	
                    $res = $DataBase->procedure_new_file_training($filename, $file_path);
                } else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                
            }
        }
        
        if($res){
            header("location: ../trainings.php");
        }else{
            header('location: ../error.php');
        }
    }

    function new_employee($data){
        $DataBase = new db();
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
        $rfc = $DataBase->sanitize($data['rfc']);
        $nss = $DataBase->sanitize($data['nss']);
        foreach($_FILES["photo"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["photo"]["name"][$key] !== "" || $_FILES["photo"]["name"][$key] !== null) {
                $filename = $DataBase->file_name($_FILES["photo"]["name"][$key]); 
                $source = $_FILES["photo"]["tmp_name"][$key];
                $file_type = $_FILES['photo']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                
                $directorio = '../docs/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename . '.' . $extension;
                $file_path = 'docs/'.$filename.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	} else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                
            }
        }

        foreach($_FILES["contract"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["contract"]["name"][$key] !== "" || $_FILES["contract"]["name"][$key] !== null) {
                $filename_c = $DataBase->file_name($_FILES["contract"]["name"][$key]); 
                $source = $_FILES["contract"]["tmp_name"][$key];
                $file_type = $_FILES['contract']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                
                $directorio = '../docs/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename_c . '.' . $extension;
                $file_path_c = 'docs/'.$filename_c.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	} else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                
            }
        }
        $res = $DataBase->proNewEmployee($names, $last_names, $birthday, $filename,$file_path, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge, $position, $filename_c,$file_path_c, $rfc,$nss);
        if($res){
            header("location: ../employees.php");
        }else{
            echo "efe";
        }
    }

    function new_activity($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $charge = intval($DataBase->sanitize($data['charge']));
        
        $res = $DataBase->proNewActivity($name, $description, $charge);
        if($res){
            header("location: ../activities.php");
        }else{
            header('location: ../error.php');
        }
    }
    
    function new_announcement($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $date_start = $DataBase->sanitize($_POST['date_start']);
        $date_finish = $DataBase->sanitize($_POST['date_finish']);
        $position = intval($_POST['position']);
        $process = $DataBase->sanitize($_POST['process']);
        $profile = $DataBase->sanitize($_POST['profile']);
        $functions  = $DataBase->sanitize($_POST['functions']);
        foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["archivo"]["name"][$key] !== "" || $_FILES["archivo"]["name"][$key] !== null) {
                $filename = $DataBase->file_name($_FILES["archivo"]["name"][$key]); 
                $source = $_FILES["archivo"]["tmp_name"][$key];
                $file_type = $_FILES['archivo']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                
                $directorio = '../docs/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename . '.' . $extension;
                $file_path = 'docs/'.$filename.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	} else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                
            }
        }
        $res =$DataBase->proNewAnnouncement($name, $description, $date_start,$date_finish, $position, $process, $profile, $functions, $filename,$file_path);
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
            header('location: ../charges.php');
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
            header('location: ../positions.php');
        }else{
            header('location: ../error.php');
        }
    }
    function new_candidate($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $phone_number = $DataBase->sanitize($data['phone_number']);
        $email = $DataBase->sanitize($data['email']);
        $appointment_date = $data['appointment_date'];
        $request_position = intval($data['request_position']);
        $perfil = $DataBase->sanitize($data['perfil']);
        foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["archivo"]["name"][$key] !== "" || $_FILES["archivo"]["name"][$key] !== null) {
                $filename = $DataBase->file_name($_FILES["archivo"]["name"][$key]); 
                $source = $_FILES["archivo"]["tmp_name"][$key];
                $file_type = $_FILES['archivo']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                
                $directorio = '../docs/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename . '.' . $extension;
                $file_path = 'docs/'.$filename.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	} else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                
            }
        }
        $res = $DataBase->proNewCandidate($name,$phone_number,$email,$appointment_date,$request_position,$perfil,$filename,$file_path);
        if($res){
            header('location: ../candidates.php');
        }else{
            print_r('efe');
        }
    }
    function new_area($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $res = $DataBase->insert_t_area($name,$description);
        if($res){
            header('location: ../areas.php');
        }else{
            header('location: ../error.php');
        }
}
?>