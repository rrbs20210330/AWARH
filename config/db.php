<?php 
    class db{
        private $con;
        private $dbhost = "localhost";
        private $dbuser = "root";
        private $dbpass = "";
        private $dbname = "rh";

        function __construct(){
            $this->connect_db();
        }

        public function connect_db(){
            $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if(mysqli_connect_error()){
                die("La conexion a la base de datos falló".mysqli_connect_error().mysqli_connect_errno());
            }
        }

        public function sanitize($var){
            $return = mysqli_real_escape_string($this->con, $var);
            return $return;
        }

        public function delete_data_users($id){
            $sql = "DELETE FROM users WHERE `id_user` = '$id'";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            } 
        }
        public function read_data_table($table){
            $sql = "SELECT * FROM `$table`";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_data_table_files_trainings($id){
            $sql = "SELECT * FROM trainings_files WHERE fk_training = $id";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function count_data_table($table){
            $sql = "SELECT count(*) as count_data FROM `$table`";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function proEditActivity($id, $name, $description, $id_charge){
            $sql = "UPDATE activities as a, charges_activities as ca SET a.t_name = '$name', a.t_description = '$description', ca.fk_charge = $id_charge WHERE a.id_activity = $id and ca.fk_activity = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function update_status_emp_announcement($ide, $ida ,$status,$notice){
            $sql = "UPDATE employees_announcements SET b_status = $status, t_notice = '$notice' WHERE fk_announcement = $ida AND fk_employee = $ide";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function read_data_table_announcements_employees($id){
            $sql = "SELECT * FROM employees_announcements WHERE fk_announcement = $id";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_single_record_employee_announcement($id){
            $sql = "SELECT * FROM employees_announcements WHERE fk_employee = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function count_data_training($id){
            $sql = "SELECT count(*) as count_data FROM `employees_trainings` where fk_employee = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function count_data_training_files($id){
            $sql = "SELECT count(*) as count_data FROM `trainings_files` where fk_training= $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_user_employee($id){
            $sql = "SELECT * FROM employees_users WHERE fk_user = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_employee_user($id){
            $sql = "SELECT * FROM employees_users WHERE fk_employee = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_announcement_position($id){
            $sql = "SELECT * FROM announcements_positions WHERE fk_announcement = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_announcement_charge($id){
            $sql = "SELECT * FROM announcements_charges WHERE fk_announcement = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_candidates_position($id){
            $sql = "SELECT * FROM candidates_positions WHERE fk_candidate = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_position($id){
            $sql = "SELECT * FROM positions WHERE id_position = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_positions_areas($id){
            $sql = "SELECT * FROM positions_areas WHERE fk_position = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_training($id){
            $sql = "SELECT * FROM trainings WHERE id_training = '$id'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_announcement($id){
            $sql = "SELECT * FROM announcements WHERE id_announcement = '$id'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_files($id){
            $sql = "SELECT * FROM files WHERE id_file = '$id'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_candidates($id){
            $sql = "SELECT * FROM candidates WHERE id_candidate = '$id'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_charges($id){
            $sql = "SELECT * FROM charges WHERE id_charge = '$id'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_relation_charge_activity($id){
            $sql = "SELECT * FROM charges_activities WHERE fk_activity = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_relation_employee_training($table, $id){
            $sql = "SELECT * FROM $table WHERE id_training = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function update_t_area($id,$name,$description){
            $sql = "UPDATE areas SET `t_name`='$name', `t_description` = '$description' WHERE id_area = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function proDeleteArea($id){
            $sql = "CALL procedure_delete_area($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function update_t_pass($id,$password){
            $sql = "UPDATE users SET `t_password`='$password' WHERE id_user = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function insert_t_area($name, $description){
            $sql = "INSERT INTO `areas` (`t_name`, `t_description`) VALUES ('$name','$description')";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function update_active_users($id){
            $sql="SELECT b_active FROM users WHERE id_user ='$id'"; 
            $res= mysqli_query($this->con, $sql);
            $return=mysqli_fetch_object($res);
            if($return->b_active == 1){
                $sql ="UPDATE users SET b_active=0 WHERE id_user ='$id'";
            }
            else{
                $sql ="UPDATE users SET b_active=1 WHERE id_user ='$id'";
            }
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function insert_t_employees_announcements($announcement, $employee, $date, $status, $notice){
            $sql = "INSERT INTO employees_announcements(`fk_announcement`, `fk_employee`, `d_registry_date`, `b_status`) VALUES ($announcement, $employee,'$date', $status)";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function update_active_employees($id, $idu){
            $sql="SELECT employees.b_active as eb, users.b_active AS ub FROM employees, users WHERE id_employee = $id AND id_user = $idu"; 
            $res= mysqli_query($this->con, $sql);
            $return=mysqli_fetch_object($res);
            if($return->eb == 1){
                $sql ="UPDATE employees,users SET employees.b_active = 0, users.b_active = 0 WHERE id_employee = $id AND id_user = $idu";
            }
            else{
                $sql ="UPDATE employees,users SET employees.b_active = 1, users.b_active = 1 WHERE id_employee = $id AND id_user = $idu";
            }
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function update_active_announcements($id){
            $sql="SELECT b_active FROM announcements WHERE id_announcement ='$id'"; 
            $res= mysqli_query($this->con, $sql);
            $return=mysqli_fetch_object($res);
            if($return->b_active == 1){
                $sql ="UPDATE announcements SET b_active=0 WHERE id_announcement ='$id'";
            }
            else{
                $sql ="UPDATE announcements SET b_active=1 WHERE id_announcement ='$id'";
            }
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function proNewEmployee($names, $last_names, $birthday, $photo_name,$photo_path, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge, $position, $contract_name, $contract_path, $rfc, $nss,$filename_cv,$file_path_cv){
            $sql = "CALL procedure_new_employee('$names','$last_names','$birthday','$photo_name','$photo_path','$phone_number','$email','$no_interior','$no_exterior','$references', '$street', '$colony','$charge', '$position','$contract_name', '$contract_path', '$rfc', '$nss','$filename_cv','$file_path_cv');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proEditEmployee($id, $names, $last_names, $birthday, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge, $position, $nss,$rfc){
            $sql = "CALL procedure_edit_employee($id,'$names','$last_names','$birthday','$phone_number','$email','$no_interior','$no_exterior','$references', '$street', '$colony','$charge', '$position', '$nss','$rfc');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteEmployee($id){
            #aqui insertar un loop obteniendo todas las capacitaciones y haciendo una llamada a el procedimiento de eliminar capacitaciones
            $sql = "CALL procedure_delete_employee($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteCharge($id){
            $sql = "CALL procedure_delete_charge($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteTraining($id){
            $sql = "CALL procedure_delete_training($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeletePosition($id){
            $sql = "CALL procedure_delete_position('$id');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteActivity($id){
            $sql = "CALL procedure_delete_activity('$id');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proNewAnnouncement($name, $description, $date_start,$date_finish, $position, $process, $profile, $functions, $file_name,$file_path,$charge,$area){
            $sql = "CALL procedure_new_announcement('$name','$description','$date_start','$date_finish', $position,'$process','$profile', '$functions','$file_name','$file_path', $charge,$area)";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proNewActivity($name, $description, $charge){
            $sql = "CALL procedure_new_activity('$name','$description', $charge);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function read_all_employees(){
            $sql = "SELECT * FROM view_list_employees";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_all_charges(){
            $sql = "SELECT * FROM view_list_charges";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_info_employee($id){
            $sql = "SELECT * FROM view_info_employee WHERE id_employee = $id";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            return $obj;
        }
        public function read_single_record_user($id){
            $sql = "SELECT * FROM users WHERE id_user = $id";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            return $obj;
        }
        public function read_single_record_area($id){
            $sql = "SELECT * FROM areas WHERE id_area = $id";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            return $obj;
        }
        public function read_single_record_area_position($id){
            $sql = "SELECT fk_area FROM positions_areas WHERE fk_position = $id";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            return $obj;
        }
        public function read_activities_charges($id){
            $sql = "SELECT * FROM view_number_activities_charges WHERE fk_charge = $id";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function insert_t_charges($name, $description){
            $sql = "INSERT INTO `charges` (`t_name`, `t_description`) VALUES ('$name','$description')";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function update_t_charges($id,$name, $description){
            $sql = "UPDATE charges SET `t_name`='$name', `t_description`='$description' WHERE id_charge = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function procedure_new_training($name, $description, $employee, $date_start, $date_finish){
            $sql = "CALL procedure_new_training('$name', '$description', $employee, '$date_start', '$date_finish');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function procedure_new_file_training($name, $path){
            $sql = "CALL procedure_new_file_training('$name', '$path');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function read_all_trainings(){
            $sql = "SELECT * FROM view_list_trainings";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function update_t_trainings($id, $name, $description, $date_start, $date_finish){
            $sql = "UPDATE trainings SET `t_name`='$name',`t_description`='$description', `d_date_start` = '$date_start', `d_date_finish` = '$date_finish' WHERE `id_training` = $id";
            
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function proDeleteCandidate($id){
            $sql = "CALL procedure_delete_candidate($id)";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proNewCandidate($name,$phone_number,$email,$appointment_date,$request_position,$perfil,$cv_name, $cv_path){
            $sql = "CALL procedure_new_candidate('$name','$phone_number','$email','$appointment_date', $request_position,'$perfil', '$cv_name','$cv_path')";
            $res = mysqli_query($this->con, $sql);
            if ($res){
                return true;
            }
            else{
                return false;
            }
        }
        public function update_candidate($id, $name, $phone_number, $email, $appointment_date, $request_position, $perfil){
            $sql = "CALL procedure_update_candidate($id, '$name', '$phone_number', '$email', '$appointment_date', $request_position, '$perfil')";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        
        
        #CRUD (USERS)
        public function insert_t_users($user, $password, $active){
            $sql = "INSERT INTO `users` (`t_user`, `t_password`, `b_active`, `i_type`)
            VALUES ('$user', '$password', $active, 1)";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_users($id, $user, $password){
            $sql = "UPDATE `users` SET `t_user` = '$user', `t_password` = '$password' WHERE `id_user` = '$id'";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }

        #CRUD (POSITIONS)
        public function insert_t_positions($name, $description, $area){
            $sql = "CALL procedure_new_position('$name', '$description', $area)";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_positions($id, $name, $description, $area){
            $sql = "CALL procedure_update_position($id, '$name', '$description', $area)";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }
        #CRUD ANNOUNCEMENTS

        public function update_t_announcements($id,$name,$description,$date_start,$date_finish,$position,$process,$profile,$functions,$charge,$area){
            $sql = "CALL procedure_update_announcement($id,'$name','$description','$date_start','$date_finish',$position,'$process','$profile','$functions',$charge,$area)";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function proDeleteAnnouncement($id){
            $sql = "CALL procedure_delete_announcement($id)";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        
        #NUM OF ACTIVITIES FROM CHARGE

        public function num_activities_charge($id){
            $sql= "SELECT `number_activities_charges`($id) AS `numActCh`;" ;
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            if($res){
                return $obj;
            }else{
                return false;
            }
            
        }
        public function num_position_area($id){
            $sql = "SELECT `number_positions_areas`($id) AS `numPosAr`;";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            if($res){
                return $obj;
            }else{
                return false;
            }
        }
        public function read_data_table_employees_trainings($id){
            $sql = "SELECT * FROM employees_trainings WHERE fk_employee = $id";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_positions_areas($id){
            $sql = "SELECT * FROM view_number_positions_areas WHERE fk_area = $id";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function num_employees_position($id){
            $sql = "SELECT COUNT(ep.fk_employee) as numEmpp FROM employees_positions ep INNER JOIN employees e on ep.fk_employee = e.id_employee WHERE fk_position = $id";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            if($res){
                return $obj;
            }else{
                return false;
            }
        }
        public function num_employees_charge($id){
            $sql = "SELECT COUNT(ec.fk_employee) as numEmpc FROM employees_charges ec INNER JOIN employees e on ec.fk_employee = e.id_employee WHERE fk_charge = $id";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            if($res){
                return $obj;
            }else{
                return false;
            }
        }
        function file_name($string){
            // Tranformamos todo a minusculas
            $string = strtolower($string);
            //Rememplazamos caracteres especiales latinos
            $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
            $repl = array('a', 'e', 'i', 'o', 'u', 'n');
            $string = str_replace($find, $repl, $string);
            // Añadimos los guiones
            $find = array(' ', '&', '\r\n', '\n', '+');
            $string = str_replace($find, '-', $string);
            // Eliminamos y Reemplazamos otros carácteres especiales
            $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
            $repl = array('', '-', '');
            $string = preg_replace($find, $repl, $string);
            return $string;
        }
    }
?>