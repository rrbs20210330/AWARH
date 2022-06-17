<?php
include("components/header.php");
?>

<center><h1>Convocatoria</h1></center>
<center>
  <br>
<?php 
    include('config/db.php');
    $announcements = new db();
    if (isset($_POST) && !empty($_POST)) {
   //EL DOBLE amplesan se ignifica que vamos a usar las dos cosas dentro del condicional
  $nombre = $announcements->sanitize($_POST['nombre']);
  $descripcion = $announcements->sanitize($_POST['descripcion']);
  $fechadeinicio = $announcements->sanitize($_POST['fechadeinicio']);
  $fechafinal = $announcements->sanitize($_POST['fechafinal']);
  $position = intval($_POST['position']);
  $Procedimiento=$announcements->sanitize($_POST['Procedimiento']);
  $Perfilsolicitado = $announcements->sanitize($_POST['Perfilsolicitado']);
  $funciones  = $announcements->sanitize($_POST['funciones']);

  $res =$announcements->insert_t_announcements($nombre,$descripcion,$fechadeinicio,$fechafinal,$position,$Procedimiento,$Perfilsolicitado,$funciones);

  if ($res) {
    $message ="Datos insertados con exito";
    $class = "alert alert-success";
  }else {
    $message = "No se pudieron insertar los datos...";
    $class = "alert alert-danger";
  }
 
?>

<div class="<?php echo $class ?>"><?php echo $message?>  
</div>
<?php
}
?>
 <div class="container-fluid col-sm-6">
    <form method="post">
        <div class="row">
         <div class="col-sm-4">
            <label for=""><h5>Lista de convocatorias</h5></label>
            </div>
            <div class="col-sm-4">
           <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
      </form>
            </div>
            <!--boton para crear nueva convocatoria relacionada con el modal-->
             <div class="col-sm-4">
            <label for="">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
                Nueva convocatoria
              </button>
               <!--Modal para el boton  nueva convocatoria--->
 <div class="modal" tabindex="-1" id="modal1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva convocatoria </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
        <div class="modal-body">
          <div class="row">
                <div class="col-sm-4">
                <label>Nombre de la convocatoria </label>
                <input type="text" class="form-control" id="nombre" name="nombre" required value=""  placeholder="Nombre">
                </div>
                <div class="col-sm-4">
                <label >Descripcion de la convocatoria</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required placeholder="Descripcion">
                </div>
                <div class="col-sm-4">
                <label >Archivo</label>
                <input type="file" class="form-control" id="id_file" name="id_file" required  placeholder="Archivo">
                </div> 
                <div class="col-sm-4">
                <label >Fecha de inicio</label>
                <input type="date" class="form-control" id="fechadeinicio" name="fechadeinicio" required placeholder="Fecha de inicio">
                </div>
                    <div class="col-sm-4">
                <label >Fecha Final</label>
                <input type="date" class="form-control" id="fechafinal" name="fechafinal" required placeholder="Fecha final">
                </div>
                <div class="col-sm-4">
                <label >cargo</label>
                <select class="form-select" aria-label="Default select example" id="position" name="position">
                    <option selected>Selecciona una área</option>
                    <?php     
                        $l_charges_select = $announcements->read_data_table('positions');
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $id = $row->id;
                            $name = $row->name;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php } ?>
                </select>
                </div>
                <div>
                 <div class="col-sm-10">
                <label >Procedimiento</label>
                <textarea type="text" class="form-control" id="Procedimiento" name="Procedimiento" required placeholder="Procedimiento">
                </textarea>
</div> 
</div>
                <div>
                <div class="col-sm-10">
                <label >Perfil solicitado</label>
                 <textarea type="text" class="form-control" id="Perfilsolicitado" name="Perfilsolicitado" required placeholder="Perfil solicitado">
                </textarea>
</div>
</div>
                <div>
                <div class="col-sm-10">
                <label >Funciones</label>
               <textarea type="text" class="form-control" id="funciones" name="funciones" required placeholder="funciones">
               </textarea>
</div>
                <br>
                </div>
            </div>
        </div>
        <div  class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">eliminar</button>
          <button type="submit" class="btn btn-success">crear</button>     
          </div>
                
        </div>
        </div>
      </div>
      </div>
      </div>
     </label>
    </div>
    <!--final del modal-->
     <br>
     <br>
     <!--Cajas para ver las convocatorias-->      
</form metthod="post"> 
 </div>
 <div class="container">
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      <center>
    <a href="announcements.php"><i class="fa-5x bi bi-file-earmark-image"></i></a>
</center>
    <div class="card-body">
        <h5 class="card-title">Convocatoria 1</h5>
        <p class="card-text">esta convocatoria tiene una descripcion</p>
      </div>
      <div class="card-footer">
      <center> 
      <a class="btn btn-primary" href="#" role="button">ver</a>
        <a class="btn btn-success" href="#" role="button">editar</a>
        <a class="btn btn-danger" href="#" role="button">borrar</a>
        <center>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <center>
         <a href="announcements.php"><i class="fa-5x bi bi-file-earmark-image"></i></a>
</center>
      <div class="card-body">
        <h5 class="card-title">convocatoria 2</h5>
        <p class="card-text">esta convocatoria tiene una descripcion</p>
      </div>
      <div class="card-footer">
         <center> 
      <a class="btn btn-primary" href="#" role="button">ver</a>
        <a class="btn btn-success" href="#" role="button">editar</a>
        <a class="btn btn-danger" href="#" role="button">borrar</a>
        <center>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <center>
    <a href="announcements.php"><i class="fa-5x bi bi-file-earmark-image"></i></a>
</center>  
    <div class="card-body">
        <h5 class="card-title">Convocatorias 3</h5>
        <p class="card-text">esta convocatoria tiene una descripcion</p>
      </div>
      <div class="card-footer">
       <center> 
      <a class="btn btn-primary" href="#" role="button">ver</a>
        <a class="btn btn-success" href="#" role="button">editar</a>
        <a class="btn btn-danger" href="#" role="button">borrar</a>
        <center>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<?php
include("components/footer.html");
?>

