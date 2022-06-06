<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Animated Sidebar CSS</title> </head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>  
  <body>
  

    <nav class="navbar navbar-expand-lg" style='background: #10529f '>
      <div class="container-fluid">
        <span class="navbar-toggler-icon"></span>
        <div class="d-flex">
          <a class="nav-link dropdown-toggle" href="#" id="close_sesion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="close_sesion">
            <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Navbar vertical-->
    <div class="navvertical">
      <div class="side-nav">
        <ul class="nav-links">
          <li><a class="dropdown-item" href="overview.php">Menu General</a></li>
          <li><a class="dropdown-item" href="config.php">Configuración</a></li>
          <ul>
            <li><a class="dropdown-item" href="positions.php">Puestos</a></li>
            <li><a class="dropdown-item" href="charges.php">Cargos</a></li>
            <li><a class="dropdown-item" href="activities.php">Actividades</a></li>
            <li><a class="dropdown-item" href="users.php">Usuarios</a></li>
          </ul>
          <li><a class="dropdown-item" href="employees.php">Empleados</a></li>
          <li><a class="dropdown-item" href="training.php">Capacitaciones</a></li>
          <li><a class="dropdown-item" href="announcements.php">Convocatorias</a></li>
          <li><a class="dropdown-item" href="forms.php">Formularios</a></li>
          
        </ul>
      </div>          
    </div>

  