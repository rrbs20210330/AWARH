<?php 
    include('../config/db.php');
	$DataBase = new db();
    if(isset($_POST) && !empty($_POST)){
        
        $names = $DataBase->sanitize($_POST['names']);
        $last_names = $DataBase->sanitize($_POST['last_names']);
        $birthday = $DataBase->sanitize($_POST['birthday']);
        $photo = $DataBase->sanitize($_POST['photo']);
        $phone_number = $DataBase->sanitize($_POST['phone_number']);
        $email = $DataBase->sanitize($_POST['email']);
        $no_interior = $DataBase->sanitize($_POST['no_interior']);
        $no_exterior = $DataBase->sanitize($_POST['no_exterior']);
        $references = $DataBase->sanitize($_POST['references']);
        $street = $DataBase->sanitize($_POST['street']);
        $colony = $DataBase->sanitize($_POST['colony']);
        $charge = $DataBase->sanitize($_POST['charge']);
        $position = intval($DataBase->sanitize($_POST['position']));
        $contract = $DataBase->sanitize($_POST['contract']);
        $rfc = $DataBase->sanitize($_POST['rfc']);
        $nss = $DataBase->sanitize($_POST['nss']);
        $location = $_POST['location'];
        $res = $DataBase->proNewEmployee($names, $last_names, $birthday, $photo, $phone_number,$email, $no_interior, $no_exterior, $references, $street, $colony, $charge,$position, $contract, $rfc,$nss);
        if($res){
            header("location: ../$location.php");
        }else{
            echo 'Error al eliminar un registro';
        }
    }
?>
