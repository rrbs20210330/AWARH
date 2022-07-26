<?php 
    if(isset($_POST) && isset($_POST['typeOp']) && isset($_POST['new'])){
        
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
            case 11: 
                apply_announcement($_POST);
                break;
            case 12:
                new_act_data_employee($_POST);
                break;
            default:
                echo "<script> swal({
                    title: 'Error!',
                    text: 'Parece ser que algo salio mal.',
                    icon: 'error',
                    button: 'Ok!',
                  });</script>";
                break;
        }
        
    }
    function new_act_data_employee($data)
    {
        $DataBase = new db();
        $id = intval($data['id']);
        $phone_number = $data['phone_number']; 
        $email = $data['email'];
        $street = $data['street'];
        $no_exterior = $data['no_exterior'];
        $no_interior = $data['no_interior'];
        $colony = $data['colony'];
        $references = $data['references'];
        $res = $DataBase->act_data_employee($id, $phone_number, $email, $street,$no_exterior,$no_interior,$colony, $references);
        if($res){
            echo "<script>
                window.history.replaceState(null, null, window.location.href);
                window.location.reload();
            </script>";
        }else{
            echo "<script> swal({
                title: 'Error!',
                text: 'Parece ser que algo salio mal',
                icon: 'error',
                button: 'Ok!',
              });</script>";
        }
        
    }
    function new_user($data){
        $DataBase = new db();
        $user = $DataBase->sanitize($data['user']);
        $password = $DataBase->sanitize($data['password']);
        
        try {
            $res = $DataBase->insert_t_users($user, $password, true);
            if($res){
                echo "<script> swal({
                    title: 'Listo!',
                    text: 'El usuario $user fue creado exitosamente.',
                    icon: 'success',
                    button: 'Ok!',
                  });</script>";
            }else{
                echo "<script> swal({
                    title: 'Ups!',
                    text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                    icon: 'error',
                    button: 'Ok!',
                });</script>";
            }
        } catch (\Throwable $th) {
            echo "<script> swal({
                title: 'Error!',
                text: 'El usuario $user ya existe, intenta con otro nombre.',
                icon: 'error',
                button: 'Ok!',
              });</script>";
        }
        
    }

    function new_training($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $dates = $DataBase->sanitize($data['dates']);
        foreach($data["employee"] as $key => $value){
            foreach($_FILES["file"]['tmp_name'] as $key => $tmp_name){
                if($_FILES["file"]["name"][$key] !== "" || $_FILES["file"]["name"][$key] !== null) {
                    $filename = $DataBase->file_name($_FILES["file"]["name"][$key]); 
                    $source = $_FILES["file"]["tmp_name"][$key];
                    $file_type = $_FILES['file']['type'][$key];
                    list($type, $extension) = explode('/', $file_type);
                    if($extension === 'pdf' || $extension === 'jpg' || $extension === 'png' || $extension === 'jpeg'){
                        continue;
                    }else{
                        echo "<script> swal({
                            title: 'Ups!',
                            text: 'Parece que un archivo no es admitible, aregurate de que todos los archivos subidos tengan las extensiones: jpg, png, jpge o pdf.',
                            icon: 'error',
                            button: 'Ok!',
                        });</script>";
                        return;
                    }
                }
            }
            $id_employee = intval($data['employee'][$key]);
            $register_training = $DataBase->procedure_new_training($name,$description,$id_employee,$dates);
            if(!$register_training){
                header('location: ../error.php');
            }
            foreach($_FILES["file"]['tmp_name'] as $key => $tmp_name){
                if($_FILES["file"]["name"][$key] !== "" || $_FILES["file"]["name"][$key] !== null) {
                    $filename = $DataBase->file_name($_FILES["file"]["name"][$key]); 
                    $source = $_FILES["file"]["tmp_name"][$key];
                    $file_type = $_FILES['file']['type'][$key];
                    list($type, $extension) = explode('/', $file_type);
                    
                    $directorio = 'files/'; 
                    if(!file_exists($directorio)){
                        mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                    }
                    
                    $target_path = $directorio . $filename . '.' . $extension;
                    $file_path = 'files/'.$filename.'.'.$extension;
                    if(copy($source, $target_path)) {	
                        $res = $DataBase->procedure_new_file_training($filename, $file_path);
                    } else {
                        echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                    }
                    
                }
            }
        }
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'La capacitacion $name fue creada exitosamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
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
        $errors_files = array();
        foreach($_FILES["photo"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["photo"]["name"][$key] !== "" || $_FILES["photo"]["name"][$key] !== null) {
                $filename = $DataBase->file_name($_FILES["photo"]["name"][$key]); 
                $source = $_FILES["photo"]["tmp_name"][$key];
                $file_type = $_FILES['photo']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                
                if($extension === 'jpg' || $extension === 'png' || $extension === 'jpeg'){ continue;}else{
                    array_push($errors_files, 'La extensión de la fotografia debe de ser: jpg, jpeg o png.\n');
                    break;
                }
                $directorio = 'files/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename . '.' . $extension;
                $file_path = 'files/'.$filename.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	} else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                
            }
        }
        foreach($_FILES["cv"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["cv"]["name"][$key] !== "" || $_FILES["cv"]["name"][$key] !== null) {
                $filename_cv = $DataBase->file_name($_FILES["cv"]["name"][$key]); 
                $source = $_FILES["cv"]["tmp_name"][$key];
                $file_type = $_FILES['cv']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                
                if ($extension !== 'pdf') {
                    array_push($errors_files, 'La extensión del documento en "CV" debe de ser pdf.\n');
                    break;
                }
                $directorio = 'files/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename_cv . '.' . $extension;
                $file_path_cv = 'files/'.$filename_cv.'.'.$extension;
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
                if ($extension !== 'pdf') {
                    array_push($errors_files, 'La extensión del documento en "Contrato" debe de ser pdf.\n');
                    break;
                }
                $directorio = 'files/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename_c . '.' . $extension;
                $file_path_c = 'files/'.$filename_c.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	} else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                
            }
        }
        if(count($errors_files) !== 0){
            $text = " ";
            for ($i=0; $i <= count($errors_files)-1; $i++) { 
                $text .= $errors_files[$i];
            }
            echo "<script> swal({
                title: 'Ups!',
                text: '$text',
                icon: 'error',
                button: 'Ok!',
            });</script>";
            return;
        }
        try {
            $res = $DataBase->proNewEmployee($names, $last_names, $birthday, $filename,$file_path, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge, $position, $filename_c,$file_path_c, $rfc,$nss,$filename_cv,$file_path_cv);
            if($res){
                echo "<script> swal({
                    title: 'Listo!',
                    text: 'El empleado $names $last_names fue creado exitosamente.',
                    icon: 'success',
                    button: 'Ok!',
                });</script>";
            }else{
                echo "<script> swal({
                    title: 'Ups!',
                    text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                    icon: 'error',
                    button: 'Ok!',
                });</script>";
            }
        } catch (\Throwable $th) {
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que el Numero de Seguridad Social o El RFC ya existe, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }

    function new_activity($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $charge = intval($DataBase->sanitize($data['charge']));
        
        $res = $DataBase->proNewActivity($name, $description, $charge);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'La actividad $name fue creada exitosamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }
    
    function new_announcement($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $dates = $DataBase->sanitize($_POST['dates']);
        $process = $DataBase->sanitize($_POST['process']);
        $profile = $DataBase->sanitize($_POST['profile']); 
        $functions  = $DataBase->sanitize($_POST['functions']);
        foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
            if($_FILES["archivo"]["name"][$key] !== "" || $_FILES["archivo"]["name"][$key] !== null) {
                $filename = $DataBase->file_name($_FILES["archivo"]["name"][$key]); 
                $source = $_FILES["archivo"]["tmp_name"][$key];
                $file_type = $_FILES['archivo']['type'][$key];
                list($type, $extension) = explode('/', $file_type);
                if($extension === 'jpg' || $extension === 'png' || $extension === 'jpeg'){
                    
                    $directorio = 'files/'; 
                    if(!file_exists($directorio)){
                        mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                    }
                    
                    $target_path = $directorio . $filename . '.' . $extension;
                    $file_path = 'files/'.$filename.'.'.$extension;
                    if(move_uploaded_file($source, $target_path)) {	} else {
                        echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                    }
                }else{
                    echo "<script> swal({
                        title: 'Ups!',
                        text: 'La extensión de la imagen debe de ser: jpg, jpeg o png.',
                        icon: 'error',
                        button: 'Ok!',
                    });</script>"; 
                    return;
                }
            }
        }
              
        $res =$DataBase->proNewAnnouncement($name, $description, $dates,$process, $profile, $functions, $filename,$file_path);
        if(isset($data['positions'])){
            foreach($data['positions'] as $key => $value){
                $id_position = intval($data['positions'][$key]);
                $register_positions = $DataBase->proNewAnnouncement_position($id_position);
                if(!$register_positions){
                 header('location: ../error.php');
               }
            }
        }
        if(isset($data['charges'])){
            foreach($data['charges'] as $key => $value){
                $id_charge = intval($data['charges'][$key]);
                $register_charges = $DataBase->proNewAnnouncement_charges($id_charge);
                if(!$register_charges){
                header('location: ../error.php');
                }
            }
        }
        if(isset($data['areas'])){
            foreach($data['areas'] as $key => $value){
                $id_area = intval($data['areas'][$key]);
                $register_area = $DataBase->proNewAnnouncement_areas($id_area);
                if(!$register_area){
                    header('location: ../error.php');
                }
            }  
        }
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'La convocatoria $name fue creada exitosamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }

    function new_charge($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $res = $DataBase->insert_t_charges($name, $description);

        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El cargo $name fue creado exitosamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }
    function new_position($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($data['name']);
        $description = $DataBase->sanitize($data['description']);
        $area = intval($data['area']);
        $res = $DataBase->insert_t_positions($name, $description, $area);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El puesto $name fue creado exitosamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
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
                if ($extension !== 'pdf') {
                    echo "<script> swal({
                        title: 'Ups!',
                        text: 'El Documento insertado debe de ser un pdf.',
                        icon: 'error',
                        button: 'Ok!',
                    });</script>";
                    return;
                }
                $directorio = 'files/'; 
                if(!file_exists($directorio)){
                    mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                }
                
                $target_path = $directorio . $filename . '.' . $extension;
                $file_path = 'files/'.$filename.'.'.$extension;
                if(move_uploaded_file($source, $target_path)) {	} else {
                    echo "<script> swal({
                        title: 'Ups!',
                        text: 'Ha ocurrido un error, por favor inténtelo de nuevo',
                        icon: 'error',
                        button: 'Ok!',
                    });</script>";
                }
            }
        }
        $res = $DataBase->proNewCandidate($name,$phone_number,$email,$appointment_date,$request_position,$perfil,$filename,$file_path);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El candidato $name fue creado exitosamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }
    function new_area($data){
        $DataBase = new db();
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $res = $DataBase->insert_t_area($name,$description);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'El area $name fue creada exitosamente.',
                icon: 'success',
                button: 'Ok!',
              });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, verifica la informacion ingresada.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }
    function apply_announcement($data){
        $DataBase = new db();
        $announcement = intval($data['announcement']);
        $employee = intval($data['employee']);
        $date = date("Y/m/d");//current date; 
        $status = 2; //2 pending - 1 approved - 0 dennied
        $notice = null; //el administrador cambia el valor cuando el estado deja de ser 2
        $res = $DataBase->insert_t_employees_announcements($announcement, $employee, $date, $status, $notice);
        if($res){
            echo "<script> swal({
                title: 'Listo!',
                text: 'Has aplicado, espera a que un administrador revise tu solicitud.',
                icon: 'success',
                button: 'Ok!',
            });</script>";
        }else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Parece ser que algo salio mal, intenta denuevo mas tarde.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }
?>