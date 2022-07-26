
<!DOCTYPE html>
<html lang="en">
<head>
	<title>AWARH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/login.css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--===============================================================================================-->
</head>
<body>
	   <div class="limiter">
		  <div class="container-login100">
			<div class="wrap-login100">
        <div class="login-container">
        <div class="login-info-container">
				<form method="post" class="inputs-container login100-form validate-form ">

					<span class="login100-form-title p-b-34 p-t-27"><h1 class="title">
						Bienvenido</h1>
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
       <img class="image-container" src="assets/img/Logo.png" alt="">
		</div>
	</div>
</div>
	

	<div id="dropDownSelect1"></div>
	
</body>
<!--===============================================================================================-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href)
    }
    </script>
</html>
<?php
$mysqli = new mysqli("localhost", "root", "", "rh");

function is_session_started()
{
  return session_status() === 2 ? TRUE : FALSE;
}

if (is_session_started() === true )header('Location: overview.php');
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
                echo "<script> swal({
                    title: 'Ups!',
                    text: 'Parece que el usuario ingresado fue desactivado por un administrador.',
                    icon: 'error',
                    button: 'Ok!',
                });</script>";
            }
            
 
        }
        else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'La contraseña ingresada es incorrecta.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }
    }
        else{
            echo "<script> swal({
                title: 'Ups!',
                text: 'Ese usuario no existe.',
                icon: 'error',
                button: 'Ok!',
            });</script>";
        }

}

?>