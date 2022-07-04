<?php
$mysqli = new mysqli("localhost", "root", "", "rh");

function is_session_started()
{
  return session_status() === 2 ? TRUE : FALSE;
}

if (is_session_started() === true ) header('Location: overview.php');
session_start();
if(!empty($_SESSION['id_usuario']) && !empty($_SESSION['usuario']) && !empty($_SESSION['tipo_usuario']))header('Location: overview.php');


if ($_POST) { //va a guardar lo que lleve en método post
    $usuario = $_POST['user']; //$ es para indicar que es variable en php
    $password = $_POST['password'];
    $sql = "SELECT * FROM users  WHERE t_user = '$usuario'";
    $resultado = $mysqli->query($sql);
    $num = $resultado->num_rows;

    if ($num > 0) {
        $row = $resultado->fetch_assoc();
        $password_bd = $row['t_password']; //cifrando en la bdd
        
        $pass_C = ($password);
        if ($password_bd == $pass_C) { //comparar en este if, agregando un &&
            $activo = $row['b_active'];
            if($activo){
                $_SESSION['id_usuario']=$row['id_user']; //
                $_SESSION['usuario']=$row['t_user'];
                $_SESSION['tipo_usuario']=$row['i_type'];
                // session_write_close();
                header("Location: overview.php"); //si puedes iniciar sesión te manda a esto
            }else{
                echo "El usuario ha sido desactivado";
            }
            
 
        }
        else{
            echo"Contraseña incorrecta";
        }
    }//en caso de que no se encuentre el usuario
        else{
            echo"NO EXISTE USUARIO";
        }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>AWARH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
    <link rel="icon" href="assets/img/descarga.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css?3.0" media="all">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/style.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/images/utem.png');">
			<div class="wrap-login100">
				<form method="post" class="login100-form validate-form">

					<span class="login100-form-title p-b-34 p-t-27">
						Bienvenido!!!
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Inserta el nombre de usuario">
						<input class="input100" type="text" name="user" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Inserta Contraseña">
						<input class="input100" type="password" name="password" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Iniciar Sesión
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
</body>
<!--===============================================================================================-->
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</html>