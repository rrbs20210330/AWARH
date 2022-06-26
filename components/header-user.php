<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>AWARH</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  
  <body>
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a class="navitem" href="overview.php"><i class="bi bi-sliders"></i> Menu</a>
      <a class="navitem" href="announcements.php"><i class="bi bi-megaphone-fill"></i> Convocatorias</a>
    </div>
    <div id="main">
      <nav class="navbar navbar-expand-lg" style='background: #10529f '>
        <div class="container-fluid">
          <span onclick="openNav()"><i class='fa fa-bars'></i></span>
          <div class="d-flex">
            <a class="nav-link dropdown-toggle" href="#" id="close_sesion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="close_sesion">
              <li><a class="dropdown-item" href="/awarh">Cerrar Sesión</a></li>
            </ul>
          </div>
        </div>
      </nav>