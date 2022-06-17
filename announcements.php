<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>

<center><h1>Convocatoria</h1></center>

  <br>

<div class="container">
  <div class="col-sm-4">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
      Nueva convocatoria
    </button>
  </div>  
  <br>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php 
      $l_annoucements = $DataBase->read_data_table('announcements');
      while ($row = mysqli_fetch_object($l_annoucements)) {
        $id = $row->id;
        $name = $row->name;
        $description = $row->description;
        $active = $row->active;
    ?>
      <div class="col">
        <div class="card h-100">
          <center>
            <a href="announcement.php?id=<?php echo $id ?>"><i class="fa-5x bi bi-file-earmark-image"></i></a>
          </center>
          <div class="card-body">
            <h5 class="card-title">Convocatoria <?php echo $name ?></h5>
            <p class="card-text"><?php echo $description ?></p>
          </div>
          <div class="card-footer">
            <center> 
            <?php if ($active == 0){ ?>
              <a class="btn btn-secondary btn-sm" href="process/update.php?id=<?php echo $id?>&table=announcements&location=announcements"><i class="bi-circle"></i></a>
              <?php }else{ ?>
              <a class="btn btn-success btn-sm" href="process/update.php?id=<?php echo $id?>&table=announcements&location=announcements"><i class="bi-circle-fill"></i></a>
              <?php }?>
              <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#eA-<?php echo $id ?>"><i class="bi bi-pencil-square"></i></a>
              <a class="btn btn-danger" href="process/delete.php?id=<?php echo $id?>&typeOp=8" role="button"><i class="bi-trash"></i></a>
            </center>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


<!--Modal para el boton  nueva convocatoria--->

<div class="modal fade" tabindex="-1" id="modal1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva convocatoria </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>  
      <div class="modal-body">
      <form id="efe" action="process/new.php" method="post">
        <div class="row">
          <div class="col-sm-4">
            <label>Nombre de convocatoria </label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="col-sm-4">
            <label >Descripcion de convocatoria</label>
            <input type="text" class="form-control" id="description" name="description" required>
          </div>
          <div class="col-sm-4">
            <label >Archivo</label>
            <input type="file" class="form-control" id="id_file" name="id_file" required>
          </div> 
          <div class="col-sm-4">
            <label >Fecha de inicio</label>
            <input type="date" class="form-control" id="date_start" name="date_start" required>
          </div>
          <div class="col-sm-4">
            <label >Fecha Final</label>
            <input type="date" class="form-control" id="date_finish" name="date_finish" required>
          </div>
          <div class="col-sm-4">
            <label >Posición</label>
            <select class="form-select" aria-label="Default select example" id="position" name="position">
              <option selected>Selecciona una Posición</option>
              <?php     
                $l_charges_select = $DataBase->read_data_table('positions');
                while ($row = mysqli_fetch_object($l_charges_select)) {
                  $id = $row->id;
                  $name = $row->name;
              ?>
              <option value="<?php echo $id ?>"><?php echo $name ?></option>
              <?php } ?>
            </select>
          </div>
          <center>
            <div class="col-sm-10">
              <label >Procedimiento</label>
              <textarea type="text" class="form-control" id="process" name="process" required ></textarea>
            </div> 
            <div class="col-sm-10">
              <label >Perfil solicitado</label>
              <textarea type="text" class="form-control" id="profile" name="profile" required ></textarea>
            </div>
            <div class="col-sm-10">
              <label >Funciones</label>
              <textarea type="text" class="form-control" id="functions" name="functions" required ></textarea>
              <input type="hidden" name="typeOp" value="5">
            </div>
          </center>
        <div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-success">Crear</button> 
  </div>
  </form>
</div>
</div>
</div>




<!--Modal para el boton  editar convocatoria--->
<?php 
  $l_annoucements = $DataBase->read_data_table('announcements');
  while ($row = mysqli_fetch_object($l_annoucements)) {
    $ida = $row->id;
    $name = $row->name;
    $description = $row->description;
    $active = $row->active;
    $date_start = $row->date_start;
    $date_finish = $row->date_finish;
    $position = $row->position;
    $process = $row->process;
    $profile = $row->profile;
    $functions = $row->functions;
?>
    
  <div class="modal fade" tabindex="-1" id="eA-<?php echo $id ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar convocatoria </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
        <form id="efe" action="process/update.php" method="post">
          <div class="row">
            <div class="col-sm-4">
              <label>Nombre de convocatoria </label>
              <input type="text" class="form-control" id="name" name="name" value="<?php echo $name?>">
            </div>
            <div class="col-sm-4">
              <label >Descripcion de convocatoria</label>
              <input type="text" class="form-control" id="description" name="description" value="<?php echo $description ?>">
            </div>
            <div class="col-sm-4">
              <label >Archivo</label>
              <input type="file" class="form-control" id="id_file" name="id_file">
            </div> 
            <div class="col-sm-4">
              <label >Fecha de inicio</label>
              <input type="date" class="form-control" id="date_start" name="date_start" value="<?php echo $date_start?>">
            </div>
            <div class="col-sm-4">
              <label >Fecha Final</label>
              <input type="date" class="form-control" id="date_finish" name="date_finish" value="<?php echo $date_finish?>">
            </div>
            <div class="col-sm-4">
              <label >Puesto</label>
              <select class="form-select" aria-label="Default select example" id="position" name="position">
                <option>Selecciona un puesto</option>
                <?php     
                  $l_charges_select = $DataBase->read_data_table('positions');
                  while ($row = mysqli_fetch_object($l_charges_select)) {
                    $idp = $row->id;
                    $namep = $row->name;
                ?>
                <option value="<?php echo $idp ?>" <?php if($idp == $ida){ ?> selected <?php }?>><?php echo $namep ?></option>
                <?php } ?>
              </select>
            </div>
            <center>
              <div class="col-sm-10">
                <label >Procedimiento</label>
                <textarea type="text" class="form-control" id="process" name="process" ><?php echo $process?></textarea>
              </div> 
              <div class="col-sm-10">
                <label >Perfil solicitado</label>
                <textarea type="text" class="form-control" id="profile" name="profile" ><?php echo $profile ?></textarea>
              </div>
              <div class="col-sm-10">
                <label >Funciones</label>
                <textarea type="text" class="form-control" id="functions" name="functions" ><?php echo $functions ?></textarea>
                <input type="hidden" name="typeOp" value="8">
                <input type="hidden" name="id" value="<?php echo $id ?>">
              </div>
            </center>
          <div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-success">Editar</button> 
    </div>
    </form>
  </div>
<?php } ?>

<?php 
include("components/footer.php");
?>

