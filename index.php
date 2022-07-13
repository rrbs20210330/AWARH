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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</html>