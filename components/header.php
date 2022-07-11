<?php 

function is_session_started()
{
  return (session_status() === 0) ? false : true; 
}

if (is_session_started() === false) header('Location: index.php');
session_start();
if(empty($_SESSION['id_usuario']) && empty($_SESSION['usuario']) && empty($_SESSION['tipo_usuario']))header('Location: index.php');

$id_usuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['usuario'];
$tipo = intval($_SESSION['tipo_usuario']);

?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>AWARH</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/descarga.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>
    <div id="mySidenav" class="sidenav">
      <h2 style="color: white"><center>AWARH</center></h2>
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a class="navitem" href="overview.php" id="overview_list"><i class="bi bi-sliders"></i> Menu</a>
      <?php if($tipo === 1) { ?>
      <ul id="myUL">
        <li><a class="navitem caret" id="config_list"><i class="bi bi-gear-fill"></i> Configuración <i class=""></i></a>
          <ul class="nested">
            <li><a class="navitem" href="charges.php" id="charge_list"> Cargos</a></li>
            <li>
              <a class="navitem" href="activities.php" id="activity_list"> Actividades</a>
            </li>
            <li>
              <a class="navitem" href="positions.php" id="position_list"> Puestos</a>
            </li>
            <li>
              <a class="navitem" href="areas.php" id="area_list"> Áreas</a>
            </li>
            <li>
              <a class="navitem" href="users.php" id="user_list"> Usuarios</a>
            </li>
          </ul>
        </li>
      </ul>
      <a class="navitem" href="candidates.php" id="candidate_list"><i class="bi bi-person-badge-fill"></i> Candidatos</a>
      <a class="navitem" href="employees.php" id="employee_list"><i class="bi bi-person-fill"></i> Empleados</a>
      <a class="navitem" href="trainings.php" id="training_list"> <i class="bi bi-file-earmark-text-fill"></i> Capacitaciones</a>
      <?php } ?>
      <a class="navitem" href="announcements.php" id="announcement_list"><i class="bi bi-megaphone-fill"></i> Convocatorias</a>
    </div>
    <div id="main">
      <nav class="navbar navbar-expand-lg" style='background: #00252e '>
        <div class="container-fluid">
          <span onclick="openNav()"><i class="fa fa-bars" style="color: white"></i></span>
          <div class="d-flex">            
            <a class=" btn btn-link" href="#" id="close_sesion" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
              <i class="bi bi-person-circle"></i> <?php echo $usuario ?>
            </a>
            <ul class="toggler">
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDrop">
                  <li><a class="dropdown-item" href="logout.php">Cerrar Sesión <i class="bi bi-box-arrow-right"></i></a></li>
              </ul>
            </ul>
          </div>
        </div>
      </nav>
      <script>

var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("activo");
    this.classList.toggle("caret-down");
  });
} 
</script>

    