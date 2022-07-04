<?php
$mysqli = new mysqli("localhost", "root", "", "rh");

function is_session_started()
{
  return session_status() === 2 ? TRUE : FALSE;
}

if (is_session_started() === true ) header('Location: overview.php');
if(!empty($_SESSION['id_usuario']) && !empty($_SESSION['usuario']) && !empty($_SESSION['tipo_usuario']))header('Location: overview.php');
session_start();

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWARH</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid ps-md-0">
  <div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4">Bienvenido!</h3>

              <!-- Sign In Form -->
              <form method="post">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="user" >
                  <label for="floatingInput">Usuario</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" name="password" >
                  <label for="floatingPassword">Contraseña</label>
                </div>

                <div class="d-grid">
                  <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Iniciar Sesión</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</html>