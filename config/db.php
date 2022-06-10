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

        public function read_single_record($table, $id){
            $sql = "SELECT * FROM $table WHERE id = '$id'";
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
            $sql = "CALL proDeleteEmployee('$id');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function proDeleteCharge($id){
            $sql = "CALL proDeleteCharge('$id');";

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
        public function proNewTraining($name, $description, $file, $employee, $date_realization){
            $sql = "CALL proNewTraining('$name', '$description', '0', $employee, '$date_realization');";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }
        public function read_all_trainings(){
            $sql = "SELECT * FROM listTrainings";
            $res = mysqli_query($this->con, $sql);
            return $res;
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
            $sql = "INSERT INTO `positions` (`name`, `description`)
            VALUES ('$name', '$description')";

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
        
        #CRUD FORMS (FORMS, QUESTIONS AND ANSWERS)

        public function insert_t_forms($name, $description, $active){
            $sql = "INSERT INTO `forms` (`name`,`description`, `active`)
            VALUES ('$name','$description', '$active')";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_forms($id, $name, $description, $active){
            $sql = "UPDATE `forms` SET `name` = '$name',`description` = '$description', `active` = '$active' WHERE `id` = '$id'";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }

        #QUESTIONS

        public function insert_t_questions($question, $idform){
            $sql = "INSERT INTO `questions` (`question`, `id_form`)
            VALUES ('$question', '$idform')";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_questions($id, $question){
            $sql = "UPDATE `questions` SET `question` = '$question' WHERE `id` = '$id'";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }

        #ANSWERS

        public function insert_t_answer($answer, $idform){
            $sql = "INSERT INTO `answers` (`answer`, `id_form`)
            VALUES ('$answer', '$idform')";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_answers($id, $answer){
            $sql = "UPDATE `answers` SET `answer` = '$answer' WHERE `id` = '$id'";
            
            $res = mysqli_query($this->con, $sql);
            
            if($res){
                return true;
            }else{
                return false;
            }
        }


        #CRUD ANNOUNCEMENTS

        public function insert_t_announcements($name, $description, $area){
            $sql = "INSERT INTO `announcements` (`name`, `description`, `id_area`)
            VALUES ('$name', '$description', '$area')";

            $res = mysqli_query($this->con, $sql);
            if($res){
                return true;
            }else{
                return false;
            }

        }

        public function update_t_announcements($id, $name, $description, $area, $file){
            $sql = "UPDATE `announcements` SET `name` = '$name', `description` = '$description', `id_area` = '$area', `id_file` = '$file' WHERE `id` = '$id'";
            
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