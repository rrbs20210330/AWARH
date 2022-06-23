<?php 
    class db{
        private $con;
        private $dbhost = "localhost";
        private $dbuser = "root";
        private $dbpass = "";
        private $dbname = "recursoshumanos";

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

        public function delete_data_table($where, $id){
            $sql = "DELETE FROM `$where` WHERE `id` = '$id'";
            
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
        public function count_data_table($table){
            $sql = "SELECT count(*) as count_data FROM `$table`";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function proEditActivity($id, $name, $description, $id_charge){
            $sql = "UPDATE activities as a, charges_activities as ca SET a.name = '$name', a.description = '$description', ca.id_charge = $id_charge WHERE a.id = $id and ca.id_activities = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function read_single_record($table, $id){
            $sql = "SELECT * FROM $table WHERE id = '$id'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }
        public function read_single_record_relation_charge_activity($table, $id){
            $sql = "SELECT * FROM $table WHERE id_activities = $id";
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

        public function update_active($table,$id){
            $sql="SELECT active FROM $table WHERE id='$id'"; 
            $res= mysqli_query($this->con, $sql);
            $return=mysqli_fetch_object($res);
            if($return->active){
                $sql ="UPDATE $table SET active=0 WHERE id='$id'";
            }
            else{
                $sql ="UPDATE $table SET active=1 WHERE id='$id'";
            }
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function proNewEmployee($names, $last_names, $birthday, $photo, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge, $position, $contract, $rfc, $nss){
            $sql = "CALL proNewEmployee('$names','$last_names','$birthday','0','$phone_number','$email','$no_interior','$no_exterior','$references', '$street', '$colony','$charge', '$position','0', '$rfc', '$nss');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function proDeleteEmployee($id){
            $sql1 = "SELECT id_address FROM employees WHERE id=$id";
            $eres = mysqli_query($this->con, $sql1);
            $eresobject = mysqli_fetch_object($eres);
            $idaddress = $eresobject->id_address;
            $sql = "CALL proDeleteEmployee('$id','$idaddress');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteCharge($id){
            $sql = "CALL proDeleteCharge($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteTraining($id){
            $sql = "CALL proDeleteTraining($id);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeletePosition($id){
            $sql = "CALL proDeletePosition('$id');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteActivity($id){
            $sql = "CALL proDeleteActivity('$id');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proNewActivity($name, $description, $charge){
            $sql = "CALL proNewActivity('$name','$description', $charge);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function read_all_employees(){
            $sql = "SELECT * FROM listEmployees";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_all_charges(){
            $sql = "SELECT * FROM listCharges";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function read_info_employee($id){
            $sql = "SELECT * FROM infoEmployee WHERE id = '$id'";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function insert_t_charges($name, $description){
            $sql = "INSERT INTO `charges` (`name`, `description`) VALUES ('$name','$description')";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function update_t_charges($id,$name, $description){
            $sql = "UPDATE charges SET `name`='$name', `description`='$description' WHERE id='$id'";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function proNewTraining($name, $description, $file, $employee, $date_realization){
            $sql = "CALL proNewTraining('$name', '$description', '0', $employee, $date_realization);";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function read_all_trainings(){
            $sql = "SELECT * FROM viewlistTrainings";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
        public function update_t_trainings($id, $name, $description, $employee, $date_realization){
            $sql = "UPDATE training SET `name`='$name',`description`='$description', `date_realization` = $date_realization WHERE `id` = $id";
            $sql1 = "UPDATE employee_training SET `id_employee` = $employee WHERE `id_training` = $id";

            $res = mysqli_query($this->con, $sql);
            $res1 = mysqli_query($this->con, $sql1);
            if($res && $res1){
                return true;
            }else{
                return false;
            }
        }
        public function proDeleteCandidate($id){
            $sql = "DELETE FROM candidate WHERE id = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proNewCandidate($name,$phone_number,$email,$appointment_date,$request_position,$perfil,$id_cv){
            $sql = "INSERT INTO `candidate` (`name`,phone_number,email,appointment_date,request_position,perfil, id_cv) 
            VALUES ('$name','$phone_number','$email',$appointment_date, $request_position,'$perfil', 1)";
            $res = mysqli_query($this->con, $sql);
            if ($res){
                return true;
            }
            else{
                return false;
            }
        }
        public function update_candidate($id, $name, $phone_number, $email, $appointment_date, $request_position, $perfil, $id_cv){
            $sql = "UPDATE `candidate` SET `name` = '$name',`phone_number`='$phone_number',`email`='$email',`appointment_date` = $appointment_date, `request_position` = $request_position, `perfil` = '$perfil', `id_cv` = $id_cv WHERE `id`= $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        
        #CRUD (USERS)
        public function insert_t_users($user, $password, $active){
            $sql = "INSERT INTO `users` (`user`, `password`, `active`)
            VALUES ('$user', '$password', '$active')";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_users($id, $user, $password){
            $sql = "UPDATE `users` SET `user` = '$user', `password` = '$password' WHERE `id` = '$id'";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }

        #CRUD (POSITIONS)
        public function insert_t_positions($name, $description){
            $sql = "INSERT INTO `positions` (`name`, `description`) VALUES ('$name', '$description')";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_positions($id, $name, $description){
            $sql = "UPDATE `positions` SET `name` = '$name', `description` = '$description' WHERE `id` = '$id'";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }
        #CRUD ANNOUNCEMENTS

        public function insert_t_announcements($name,$description,$date_start,$date_finish,$position,$process,$profile,$functions,$active){
            $sql = "INSERT INTO `announcements` (`name`, `description`, `date_start`, `date_finish`, `position`,`process`, `profile`, `functions`, `active`,`id_file`) VALUES ('$name','$description',$date_start,$date_finish,$position,'$process','$profile','$functions',$active,1)";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }

        public function update_t_announcements($id,$name,$description,$date_start,$date_finish,$position,$process,$profile,$functions,$active){
            $sql = "UPDATE `announcements` SET `name` = '$name', `description` = '$description', `date_start` = $date_start, `date_finish` = $date_finish, `position` = $position,`process` = '$process', `profile` = '$profile', `functions` = '$functions',`active` = $active WHERE `id` = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        public function proDeleteAnnouncement($id){
            $sql = "DELETE FROM announcements WHERE `id` = $id";
            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        
        #NUM OF ACTIVITIES FROM CHARGE

        public function num_activities_carge($id){
            $sql= "SELECT `numActCh`($id) AS `numActCh`;" ;
            $res = mysqli_query($this->con, $sql);
            $obj = mysqli_fetch_object($res);
            if($res){
                return $obj;
            }else{
                return false;
            }
            
        }
    }
?>