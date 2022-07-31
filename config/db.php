<?php 
    class db{
        protected $con;
        private $dbhost = "localhost";
        private $dbuser = "c1451710_rh";
        private $dbpass = "palilu69NE";
        private $dbname = "c1451710_rh";

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
            $sql = "UPDATE users SET b_deleted = 1 WHERE `id_user` = $id";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            } 
        }
        public function read_data_table($table){
            $sql = "SELECT * FROM `$table` WHERE b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_data_table_files_trainings($id){
            $sql = "SELECT * FROM trainings_files WHERE fk_training = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function count_data_table($table){
            $sql = "SELECT count(*) as count_data FROM `$table` where b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function proEditActivity($id, $name, $description, $id_charge){
            $consult = mysqli_query($this->con, "SELECT fk_charge FROM charges_activities WHERE fk_activity = $id and b_deleted = 0");
            $charge = intval($consult->num_rows) == 0 ? false : true; 
            if($charge){
                $sql = "UPDATE activities as a, charges_activities as ca SET a.t_name = '$name', a.t_description = '$description', ca.fk_charge = $id_charge WHERE a.id_activity = $id and ca.fk_activity = $id";
            }else{
                $sql = "CALL procedure_update_activity($id, '$name', '$description', $id_charge)";
            }
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function update_status_emp_announcement($ide, $ida ,$status,$notice){
            $sql = "UPDATE employees_announcements SET i_status = $status, t_notice = '$notice' WHERE fk_announcement = $ida AND fk_employee = $ide";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function read_data_table_announcements_employees($id){
            $sql = "SELECT * FROM employees_announcements WHERE fk_announcement = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function count_data_announcements_employees($id){
            $sql = "SELECT count(*) as contador FROM employees_announcements WHERE fk_announcement = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_employee_announcement($ide,$ida){
            $sql = "SELECT * FROM employees_announcements WHERE fk_employee = $ide and fk_announcement = $ida and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function count_data_training($id){
            $sql = "SELECT count(*) as count_data FROM `employees_trainings` where fk_employee = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function count_data_training_files($id){
            $sql = "SELECT count(*) as count_data FROM `trainings_files` where fk_training= $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_user_employee($id){
            $sql = "SELECT * FROM employees_users WHERE fk_user = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_employee_user($id){
            $sql = "SELECT * FROM employees_users WHERE fk_employee = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_announcement_position($id){
            $sql = "SELECT * FROM announcements_positions WHERE fk_announcement = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_single_record_announcement_area($id){
            $sql = "SELECT * FROM announcements_areas WHERE fk_announcement = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_single_record_announcement_charge($id){
            $sql = "SELECT * FROM announcements_charges WHERE fk_announcement = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_single_record_candidates_position($id){
            $sql = "SELECT * FROM candidates_positions WHERE fk_candidate = $id AND b_deleted = 0";
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
        public function read_single_record_request_edit_data($id){
            $sql = "SELECT * FROM request_info_employees WHERE fk_employee = $id and i_status = 2 and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_positions_areas($id){
            $sql = "SELECT * FROM positions_areas WHERE fk_position = $id AND b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_training($id){
            $sql = "SELECT * FROM trainings WHERE id_training = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_announcement($id){
            $sql = "SELECT * FROM announcements WHERE id_announcement = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_announcement_report($id){
            $sql = "SELECT * FROM announcements WHERE id_announcement = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_single_record_files($id){
            $sql = "SELECT * FROM files WHERE id_file = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_candidates($id){
            $sql = "SELECT * FROM candidates WHERE id_candidate = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_candidates_report($id){
            $sql = "SELECT * FROM candidates WHERE id_candidate = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_single_record_charges($id){
            $sql = "SELECT * FROM charges WHERE id_charge = $id";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_relation_charge_activity($id){
            $sql = "SELECT * FROM charges_activities WHERE fk_activity = $id AND b_deleted = 0";
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
            $sql="SELECT b_active FROM users WHERE id_user =$id"; 
            $res= mysqli_query($this->con, $sql);
            $return=mysqli_fetch_object($res);
            if($return->b_active == 1){
                $sql ="UPDATE users SET b_active=0 WHERE id_user =$id";
            }
            else{
                $sql ="UPDATE users SET b_active=1 WHERE id_user =$id";
            }
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function insert_t_employees_announcements($announcement, $employee, $date, $status, $notice){
            $sql = "INSERT INTO employees_announcements(`fk_announcement`, `fk_employee`, `d_registry_date`, `i_status`) VALUES ($announcement, $employee,'$date', $status)";
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
            $sql="SELECT b_active FROM announcements WHERE id_announcement =$id"; 
            $res= mysqli_query($this->con, $sql);
            $return=mysqli_fetch_object($res);
            if($return->b_active == 1){
                $sql ="UPDATE announcements SET b_active=0 WHERE id_announcement =$id";
            }
            else{
                $sql ="UPDATE announcements SET b_active=1 WHERE id_announcement =$id";
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
            $l_trainings = mysqli_query($this->con, "SELECT * FROM employees_trainings WHERE fk_employee = $id");
            while ($row = mysqli_fetch_object($l_trainings)) {
                $id_t = $row->fk_training;
                mysqli_query($this->con, "CALL procedure_delete_training($id_t)");
            }
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
            $sql = "CALL procedure_delete_position($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteActivity($id){
            $sql = "CALL procedure_delete_activity($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proNewAnnouncement($name, $description, $dates, $process, $profile, $functions, $file_name,$file_path){
            $sql = "CALL procedure_new_announcement('$name','$description','$dates','$process','$profile', '$functions','$file_name','$file_path');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proNewAnnouncement_position($id_position){
            $sql = "CALL procedure_new_announcement_positions($id_position);";
            
            $res = mysqli_query($this->con, $sql);
                if($res){
                    return true;
                }else{
                    return false;
                }
        }
        public function proNewAnnouncement_charges($id_charge){
            $sql = "CALL procedure_new_announcement_charges($id_charge);";
            
            $res = mysqli_query($this->con, $sql);
                if($res){
                    return true;
                }else{
                    return false;
                }
        }
        public function proNewAnnouncement_areas($id_area){
            $sql = "CALL procedure_new_announcement_areas($id_area);";
            
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
        public function read_all_employees_info(){
            $sql = "SELECT * FROM view_info_employee WHERE b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_all_charges(){
            $sql = "SELECT * FROM view_list_charges";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_info_employee($id){
            $sql = "SELECT * FROM view_info_employee WHERE id_employee = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            return $obj;
        }
        public function read_info_employee_Report($id){
            $sql = "SELECT * FROM view_info_employee WHERE id_employee = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_single_record_user($id){
            $sql = "SELECT * FROM users WHERE id_user = $id and b_deleted = 0";
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
            $sql = "SELECT fk_area FROM positions_areas WHERE fk_position = $id and b_deleted = 0";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            return $obj;
        }
        public function read_activities_charges($id){
            $sql = "SELECT * FROM view_number_activities_charges WHERE fk_charge = $id";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_employees_charges($id){
            $sql = "SELECT * FROM view_number_employees_charges WHERE fk_charge = $id";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_employees_positions($id){
            $sql = "SELECT * FROM view_number_employees_positions WHERE fk_position = $id";
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
        public function procedure_new_training($name, $description, $employee, $dates){
            $sql = "CALL procedure_new_training('$name', '$description', $employee, '$dates');";

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
        public function update_t_trainings($id, $name, $description, $dates){
            $sql = "UPDATE trainings SET `t_name`='$name',`t_description`='$description', `d_dates` = '$dates' WHERE `id_training` = $id";
            
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
        public function act_data_employee($id, $phone_number, $email, $street,$no_exterior,$no_interior,$colony, $references){
            $today = date("Y/m/d");
            $sql = "INSERT INTO request_info_employees(fk_employee, t_phone_number,t_email,t_street,t_no_exterior,t_no_interior,t_colony,t_references,i_status,d_registry_date) VALUES ($id,'$phone_number', '$email','$street','$no_exterior','$no_interior', '$colony','$references',2,'$today')";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function act_data_employee_adm($id, $action){
            if($action === 1){
                $newinfo = mysqli_fetch_object(mysqli_query($this->con, "SELECT * FROM request_info_employees WHERE fk_employee = $id and b_deleted = 0"));
                $infoemployee = mysqli_fetch_object(mysqli_query($this->con, "SELECT * FROM employees WHERE id_employee = $id"));
                $update = "UPDATE employees as e, addresses as a SET e.t_phone_number = '$newinfo->t_phone_number',e.t_email = '$newinfo->t_email',a.t_street = '$newinfo->t_street',a.t_no_exterior = '$newinfo->t_no_exterior',a.t_no_interior = '$newinfo->t_no_interior' ,a.t_colony = '$newinfo->t_colony',a.t_references = '$newinfo->t_references' WHERE id_employee = $id and id_address = $infoemployee->fk_address";
                $res = mysqli_query($this->con, $update);
            }
            $sql = "UPDATE request_info_employees SET `i_status` = $action, `b_deleted` = 1 WHERE fk_employee = $id";

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
            $consult = mysqli_query($this->con, "SELECT fk_position FROM candidates_positions WHERE fk_candidate = $id and b_deleted = 0");
            $charge = intval($consult->num_rows) == 0 ? false : true; 
            if($charge){
                $sql = "UPDATE candidates as c, candidates_positions as cp SET c.`t_name` = '$name', c.`t_phone_number` = '$phone_number', c.`t_email` = '$email',c.`dt_appointment_date` = '$appointment_date', c.`t_profile` = '$perfil', cp.`fk_position` = $request_position  WHERE `id_candidate` = $id and `fk_candidate` = $id";
            }else{
                $sql = "CALL procedure_update_candidate($id, '$name', '$phone_number', '$email', '$appointment_date', $request_position, '$perfil')";
            }
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
            $sql = "UPDATE `users` SET `t_user` = '$user', `t_password` = '$password' WHERE `id_user` = $id";
            
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
            $consult = mysqli_query($this->con, "SELECT fk_area FROM positions_areas WHERE fk_position = $id and b_deleted = 0");
            $charge = intval($consult->num_rows) == 0 ? false : true; 
            if($charge){
                $sql = "UPDATE positions as p, positions_areas as pa SET p.t_name = '$name', p.t_description = '$description', pa.fk_area = $area WHERE p.id_position = $id and pa.fk_position = $id";
            }else{
                $sql = "CALL procedure_update_position($id, '$name', '$description', $area)";
            }
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }
        #CRUD ANNOUNCEMENTS

        public function update_t_announcements($id,$name,$description,$dates,$process,$profile,$functions){
            $sql = "CALL procedure_update_announcement($id,'$name','$description','$dates','$process','$profile','$functions')";
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
            $sql= "SELECT COUNT(ca.fk_charge) as numActCh FROM `charges` AS `c` INNER JOIN `charges_activities` AS `ca` ON ca.fk_charge = c.id_charge WHERE c.id_charge = $id and ca.b_deleted = 0; " ;
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            if($res){
                return $obj;
            }else{
                return false;
            }
            
        }
        public function num_position_area($id){
            $sql = "SELECT COUNT(ap.fk_area) as numPosAr FROM `areas` AS `a` INNER JOIN `positions_areas` AS `ap` ON ap.fk_area = a.id_area WHERE a.id_area = $id and ap.b_deleted = 0;";
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            if($res){
                return $obj;
            }else{
                return false;
            }
        }
        public function read_data_table_employees_trainings($id){
            $sql = "SELECT * FROM employees_trainings WHERE fk_employee = $id and b_deleted = 0";
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
            $sql = "SELECT COUNT(ec.fk_employee) as numEmpc FROM employees_charges ec INNER JOIN employees e on ec.fk_employee = e.id_employee WHERE fk_charge = $id and ec.b_deleted = 0";
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