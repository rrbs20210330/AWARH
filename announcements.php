<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>

<?php if($tipo === 1){ ?>
  <center><h1>Convocatorias</h1></center>
<?php 
require('process/new.php');
require('process/delete.php');
require('process/update.php');}else{ ?>
  <center><h1>Tus Convocatorias</h1></center>
<?php } ?>
  <br>

<div class="container">
  <?php if($tipo === 1){ ?>
    <div class="col-sm-4">
    <abbr title=" Nueva Convocatoria "><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal1">
    <i style='font-size:24px' class="bi bi-megaphone-fill"><span class="glyphicon">&#x2b;</span></i>
    </button></abbr>
  </div>  
  <br>
  <?php $l_annoucements = $DataBase->read_data_table('announcements');
      if(mysqli_num_rows($l_annoucements) === 0){ ?> <center><h3>No hay ninguna convocatoria</h3></center> <?php } ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php 
      $l_annoucements = $DataBase->read_data_table('announcements');
      while ($row = mysqli_fetch_object($l_annoucements)) {
        $id = $row->id_announcement;
        $name = $row->t_name;
        $description = $row->t_description;
        $active = $row->b_active;
        $file = $row->fk_file;
        $path_file = $DataBase->read_single_record_files($file)->t_path;
    ?>
      <div class="col">
        <div class="card text-bg-dark mb-3" style="max-width: 18rem ; ">
          <div class="card-header">
            <center>
              <a href="announcement.php?id=<?php echo $id ?>">
                <i class="fa-5x bi bi-file-earmark-text-fill"></i>
              </a>
            </center>
            <br>
            <h5 class="card-title"><strong><?php echo $name ?></strong></h5>
          </div>
          <div class="card-body">
            <p class="card-text"><?php echo $description ?></p>
            <br>
            <p class="card-text">
              <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteAnnouncement-<?php echo $id ?>"><i class="bi-trash"></i></a>
              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eA-<?php echo $id ?>"><i class="bi bi-pencil-square"></i></a>
              <form method="post">
                <input type="hidden" name="update" value="1">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="typeOp" value="12">
              <?php if ($active == 0){ ?>
                <button type="submit" class="btn btn-secondary"><i class="bi bi-eye-slash-fill"></i></button>
                <?php }else{ ?>
                  <button type="submit" class="btn btn-success"><i class="bi bi-eye-fill"></i></button>
                  <?php }?>
              </form>
            </p>
          </div>
        </div>     
      </div>
    <?php } ?>  
<?php }else{ ?>
      <?php $l_annoucements = $DataBase->read_data_table('announcements');
          if(mysqli_num_rows($l_annoucements) === 0) {?> <center><h3>Aún no hay ninguna convocatoria disponible para ti.</h3></center> <?php } ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php 
          $id_user = $_SESSION['id_usuario'];
          $id_employee = $DataBase->read_single_record_user_employee($id_user)->fk_employee;
          $employee_info = $DataBase->read_info_employee(intval($id_employee));
          $count = 0;
          while ($row = mysqli_fetch_object($l_annoucements)) {
            $id = $row->id_announcement;
            $name = $row->t_name;
            $description = $row->t_description;
            $active = $row->b_active;
            $position = $DataBase->read_single_record_announcement_position($id) ? $DataBase->read_single_record_announcement_position($id)->fk_position : 0;
            $charge = $DataBase->read_single_record_announcement_charge($id) ? $DataBase->read_single_record_announcement_charge($id)->fk_charge : 0;
            if($active){
              if(intval($position) === intval($employee_info->fk_position) || intval($charge) === intval($employee_info->fk_charge)){?>
                <?php $count += 1; ?>
                <div class="col">
                  <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                      <center>
                        <a href="announcement.php?id=<?php echo $id ?>">
                          <i class="fa-5x bi bi-file-earmark-text-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Click para ver."></i>
                        </a>
                      </center>
                      <br>
                      <h5 class="card-title"><strong><?php echo $name ?></strong></h5>
                    </div>
                    <div class="card-body">
                      <p class="card-text"><?php echo $description ?></p>
                    </div>
                  </div>     
                </div>
        <?php } } }?> 
        </div>
        <?php if($count === 0 && mysqli_num_rows($l_annoucements) !== 0) {;?><center><h3>Aún no hay ninguna convocatoria disponible para ti.</h3></center>  <?php } ?> 
 <?php } ?>



<?php if($tipo === 1){ ?>
  <!--Modal para el boton  nueva convocatoria--->

<div class="modal fade" tabindex="-1" id="modal1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva convocatoria </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="efe" method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <center><label>Nombre de convocatoria </label></center>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-sm-6">
              <center><label >Descripción de convocatoria</label></center>
              <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="col-sm-28">
              <center><label >Imagen <i class="bi bi-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Solo se permite una imagen."></i></label></center>
              <input type="file" class="form-control" id="archivo[]" name="archivo[]" required>
            </div> 
            <div class="col-sm-6">
              <center><label >Fecha de inicio</label></center>
              <input type="date" class="form-control" id="date_start" name="date_start" required>
            </div>
            <div class="col-sm-6">
              <center><label >Fecha Final</label></center>
              <input type="date" class="form-control" id="date_finish" name="date_finish" required>
            </div>
            <div class="col-sm-4">
              <center><label >Puesto</label></center>
              <select class="form-select" aria-label="Default select example" id="position" name="position">
                <option selected disabled value="">Selecciona un puesto</option>
                <?php     
                  $l_charges_select = $DataBase->read_data_table('positions');
                  while ($row = mysqli_fetch_object($l_charges_select)) {
                    $id = $row->id_position;
                    $name = $row->t_name;
                ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php } ?>
                <option value="0">Ninguno</option>
              </select>
            </div>
            <div class="col-sm-4">
              <center><label >Cargo</label></center>
              <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                <option selected disabled value="">Selecciona un cargo</option>
                <?php     
                  $l_charges_select = $DataBase->read_data_table('charges');
                  while ($row = mysqli_fetch_object($l_charges_select)) {
                    $id = $row->id_charge;
                    $name = $row->t_name;
                ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php } ?>
                <option value="0">Ninguno</option>
              </select>
            </div>
            <div class="col-sm-4">
              <center><label >Área</label></center>
              <select class="form-select" aria-label="Default select example" id="area" name="area">
                <option selected disabled value="">Selecciona una área</option>
                <?php     
                  $l_charges_select = $DataBase->read_data_table('areas');
                  while ($row = mysqli_fetch_object($l_charges_select)) {
                    $id = $row->id_area;
                    $name = $row->t_name;
                ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php } ?>
                <option value="0">Ninguno</option>
              </select>
            </div>
            <div class="col-sm-4">
              <center><label >Procedimiento</label></center>
              <textarea type="text" class="form-control" id="process" name="process" required ></textarea>
            </div> 
            <div class="col-sm-4">
              <center><label >Perfil solicitado</label></center>
              <textarea type="text" class="form-control" id="profile" name="profile" required ></textarea>
            </div>

            <div class="col-sm-4">
              <label >Funciones</label>
              <textarea type="text" class="form-control" id="functions" name="functions" required ></textarea>
              <input type="hidden" name="typeOp" value="5">
              <input type="hidden" name="new" value="1">
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





<?php 
  $l_annoucements = $DataBase->read_data_table('announcements');
  while ($row = mysqli_fetch_object($l_annoucements)) {
    $ida = $row->id_announcement;
    $name = $row->t_name;
    $description = $row->t_description;
    $active = $row->b_active;
    $date_start = $row->d_date_start;
    $date_finish = $row->d_date_finish;
    $process = $row->t_process;
    $profile = $row->t_profile;
    $functions = $row->t_functions;
?>
    <!--Modal para el boton  editar convocatoria--->
  <div class="modal fade" tabindex="-1" id="eA-<?php echo $ida ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar convocatoria </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="efe" method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
          <div class="modal-body">
          
            <div class="row">
              <div class="col-sm-6">
                <center><label>Nombre de convocatoria </label></center>
                <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name?>">
              </div>
              <div class="col-sm-6">
                <center><label >Descripción de convocatoria</label></center>
                <input type="text" class="form-control" id="description" name="description" required value="<?php echo $description?>">
              </div>
              <div class="col-sm-28">
                <center><label >Imagen <i class="bi bi-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Solo se permite una imagen."></i></label></center>
                <input type="file" disabled class="form-control" id="archivo[]" name="archivo[]" data-bs-toggle="tooltip" data-bs-placement="top" title="No se puede modificar el archivo.">
              </div> 
              <div class="col-sm-6">
                <center><label >Fecha de inicio</label></center>
                <input type="date" class="form-control" id="date_start" name="date_start" required value="<?php echo $date_start?>">
              </div>
              <div class="col-sm-6">
                <center><label >Fecha Final</label></center>
                <input type="date" class="form-control" id="date_finish" name="date_finish" required value="<?php echo $date_finish?>">
              </div>
              <div class="col-sm-4">
                <center><label >Puesto</label></center>
                <select class="form-select" aria-label="Default select example" id="position" name="position">
                  <option selected disabled value="">Selecciona un puesto</option>
                  <?php     
                    $l_charges_select = $DataBase->read_data_table('positions');
                    while ($row = mysqli_fetch_object($l_charges_select)) {
                      $idp = $row->id_position;
                      $namep = $row->t_name;
                  ?>
                  <option value="<?php echo $idp ?>" <?php if($idp == $ida){ ?> selected <?php }?>><?php echo $namep ?></option>
                  <?php } ?>
                  
                </select>
              </div>
              <div class="col-sm-4">
                <center><label >Cargo</label></center>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                  <option selected disabled value="">Selecciona un cargo</option>
                  <?php     
                    $l_charges_select = $DataBase->read_data_table('charges');
                    while ($row = mysqli_fetch_object($l_charges_select)) {
                      $idp = $row->id_charge;
                      $namep = $row->t_name;
                  ?>
                  <option value="<?php echo $idp ?>" <?php if($idp == $ida){ ?> selected <?php }?>><?php echo $namep ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-sm-4">
              <center><label >Área</label></center>
              <select class="form-select" aria-label="Default select example" id="area" name="area">
                <option selected disabled value="">Selecciona una área</option>
                <?php     
                  $l_charges_select = $DataBase->read_data_table('areas');
                  while ($row = mysqli_fetch_object($l_charges_select)) {
                    $id = $row->id_area;
                    $name = $row->t_name;
                ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php } ?>
                <option value="0">Ninguno</option>
              </select>
            </div>
              <div class="col-sm-4">
                <center><label >Procedimiento</label></center>
                <textarea type="text" class="form-control" id="process" name="process" required ><?php echo $process?></textarea>
              </div> 
              <div class="col-sm-4">
                <center><label >Perfil solicitado</label></center>
                <textarea type="text" class="form-control" id="profile" name="profile" required ><?php echo $profile?></textarea>
              </div>

              <div class="col-sm-4">
                <label >Funciones</label>
                <textarea type="text" class="form-control" id="functions" name="functions" required ><?php echo $functions?></textarea>
                <input type="hidden" name="typeOp" value="8">
                <input type="hidden" name="id" value="<?php echo $ida ?>">
                <input type="hidden" name="update" value="1">
              </div>
            <div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" >Editar</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  </div>

<?php } ?>



<?php 
  $l_annoucements = $DataBase->read_data_table('announcements');
  while ($row = mysqli_fetch_object($l_annoucements)) {
    $id = $row->id_announcement;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteAnnouncement-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">¿Estás Seguro?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          El dato será eliminado y no podrá ser recuperado.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="8">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php }?>
<script>
  var elemento = document.getElementById('announcement_list');
elemento.classList.add("active");
</script>
<?php
include("components/footer.php");
?>

