<?php
include("components/header.php");
$DataBase = new db();
if($tipo === 1){ ?>
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
    <?php $l_annoucements = $DataBase->read_data_table('announcements');?>
    <abbr title="Generar Reporte de todas los candidatos">
      <?php if(mysqli_num_rows($l_annoucements) == 0){?> 
            <button  disabled target="_blank" class="btn btn-dark"><i style='font-size:24px' class="bi bi-filetype-pdf"></i></button>    
        <?php }else{?>
            <a href="process/report.php?typeOp=1"  target="_blank" class="btn btn-dark"><i style='font-size:24px' class="bi bi-filetype-pdf"></i></a>
        <?php } ?>
    </abbr>
  </div>  
  <br>
  
    <?php if(mysqli_num_rows($l_annoucements) === 0){ ?> <center><h3>No hay ninguna convocatoria</h3></center> <?php } ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php 
      $l_annoucements = $DataBase->read_data_table('announcements');
      while ($row = mysqli_fetch_object($l_annoucements)) {
        $id = $row->id_announcement;
        $name = $row->t_name;
        $description = substr($row->t_description,0,30)."...";
        $active = $row->b_active;
        $file = $row->fk_file;
        $path_file = $DataBase->read_single_record_files($file)->t_path;
    ?>
      <div class="col">
        <div class="card text-bg-dark mb-3" style="max-width: 90% ; ">
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
            
          </div>
          <div class="card-footer">
            <form method="post">
              <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteAnnouncement-<?php echo $id ?>"><i class="bi-trash"></i></a>
              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eA-<?php echo $id ?>"><i class="bi bi-pencil-square"></i></a>     
              <abbr title="Generar Reporte">
                <a href="process/report.php?typeOp=1&id=<?php echo $id ?>" target="_blank" class="btn btn-dark"><i class="bi bi-filetype-pdf"></i></a>
              </abbr>      
              <input autocomplete="off"  type="hidden" name="update" value="1">
              <input autocomplete="off"  type="hidden" name="id" value="<?php echo $id ?>">
              <input autocomplete="off"  type="hidden" name="typeOp" value="12">
              <?php if ($active == 0){ ?>
              <button type="submit" class="btn btn-secondary"><i class="bi bi-eye-slash-fill"></i></button>
              <?php }else{ ?>
              <button type="submit" class="btn btn-success"><i class="bi bi-eye-fill"></i></button>
              <?php }?>
            </form>
          </div>
        </div>     
      </div>
    <?php } ?>  
<?php }else{ ?>
      <?php $l_annoucements = $DataBase->read_data_table('announcements');
          if(mysqli_num_rows($l_annoucements) === 0) {?> <center><h3>Aún no hay ninguna convocatoria disponible para ti.</h3></center> <?php } ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php 
          $id_employee = $DataBase->read_single_record_user_employee($id_usuario)->fk_employee;
          $employee_info = $DataBase->read_info_employee(intval($id_employee));
          $area_id = $DataBase->read_single_record_positions_areas($employee_info->fk_position) ? $DataBase->read_single_record_positions_areas($employee_info->fk_position)->fk_area : 0;
          $count = 0;
          while ($row = mysqli_fetch_object($l_annoucements)) {
            $id = $row->id_announcement;
            $name = $row->t_name;
            
            $description = substr($row->t_description,0,30)."...";
            $active = $row->b_active;
            $positions = (
              $DataBase->read_single_record_announcement_position($id) && mysqli_num_rows($DataBase->read_single_record_announcement_position($id)) !== 0
            ) ? $DataBase->read_single_record_announcement_position($id) : null;
            $charges = (
              $DataBase->read_single_record_announcement_charge($id) && mysqli_num_rows($DataBase->read_single_record_announcement_charge($id)) !== 0
            ) ? $DataBase->read_single_record_announcement_charge($id) : null;
            $areas = (
              $DataBase->read_single_record_announcement_area($id) && mysqli_num_rows($DataBase->read_single_record_announcement_area($id)) !== 0
            ) ? $DataBase->read_single_record_announcement_area($id) : null;
            if($active){
              $position = false;
              $charge = false;
              $area = false;
              if($positions !== null){
                while ($row = mysqli_fetch_object($positions)) {
                  $id_position = intval($row->fk_position);
                  if($id_position === intval($employee_info->fk_position)){
                    $position = true;
                  }
                }
              }
              if($charges !== null){
                while ($row = mysqli_fetch_object($charges)) {
                  $id_charge = intval($row->fk_charge);
                  if($id_charge === intval($employee_info->fk_charge)){
                    $charge = true;
                  }
                }
              }
              if($areas !== null){
                while ($row = mysqli_fetch_object($areas)) {
                  $id_area = intval($row->fk_area);
                  if($id_area === intval($area_id)){
                    $area = true;
                  }
                }
              }
              if(($positions == null && $charges == null && $areas == null) || $position  || $charge || $area ){?>
                <?php $count += 1; ?>
                <div class="col">
                  <div class="card text-bg-dark mb-3" style="max-width: 90% ; ">
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
      <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <center><label>Nombre de convocatoria </label></center>
              <input autocomplete="off"  type="text" class="form-control" id="name" name="name" maxlength="50" required>
            </div>
            <div class="col-sm-6">
              <center><label >Descripción de convocatoria</label></center>
              <input autocomplete="off"  type="text" class="form-control" id="description" name="description" maxlength="256" required>
            </div>
            <div class="col-sm-28">
              <center><label >Imagen <i class="bi bi-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Solo se permite una imagen."></i></label></center>
              <input autocomplete="off"  type="file" class="form-control" id="archivo[]" name="archivo[]" required>
            </div> 
            <div class="col-sm-12">
              <center><label >Fecha de la convocatoria</label></center>
              <input autocomplete="off"  type="text" class="form-control" id="dates" name="dates" required>
            </div>
            <div class="col-sm-4">
            <br>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-positions" aria-expanded="true" aria-controls="collapseOne">
                      Puestos
                    </button>
                  </h2>
                  <div id="collapse-positions" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?php 
                        $l_position = $DataBase->read_data_table('positions');
                        if($l_position->num_rows == 0){
                          ?>No tienes ningun puesto, si quieres seleccionar que cierto puesto vea esta convocatoria, tendras que crear un puesto primero.
                        <?php }else{
                        while ($row = mysqli_fetch_object($l_position)) {
                          $id = $row->id_position; 
                          $name = $row->t_name?>
                          <input autocomplete="off"  type="checkbox" name="positions[]" value="<?php echo $id ?>" id="positions-<?php echo $id?>"><label for="positions-<?php echo $id?>"><?php echo $name ?></label><br>
                      <?php } }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
            <br>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-charges" aria-expanded="true" aria-controls="collapseOne">
                      Cargos
                    </button>
                  </h2>
                  <div id="collapse-charges" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?php 
                        $l_charge = $DataBase->read_data_table('charges');
                        if($l_charge->num_rows == 0){
                          ?>No tienes ningun cargo, si quieres seleccionar que cierto cargo vea esta convocatoria, tendras que crear un cargo primero.
                        <?php }else{
                        while ($row = mysqli_fetch_object($l_charge)) {
                          $id = $row->id_charge; 
                          $name = $row->t_name?>
                          <input autocomplete="off"  type="checkbox" name="charges[]" value="<?php echo $id ?>" id="charges-<?php echo $id?>"><label for="charges-<?php echo $id?>"><?php echo $name ?></label><br>
                      <?php } }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
            <br>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-areas" aria-expanded="true" aria-controls="collapseOne">
                      Areas
                    </button>
                  </h2>
                  <div id="collapse-areas" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?php 
                        $l_area = $DataBase->read_data_table('areas');
                        if($l_area->num_rows == 0){
                          ?>No tienes ninguna area, si quieres seleccionar que cierta area vea esta convocatoria, tendras que crear una area primero.
                        <?php }else{
                        while ($row = mysqli_fetch_object($l_area)) {
                          $id = $row->id_area; 
                          $name = $row->t_name?>
                          <input autocomplete="off"  type="checkbox" name="areas[]" value="<?php echo $id ?>" id="areas-<?php echo $id?>"><label for="areas-<?php echo $id?>"><?php echo $name ?></label><br>
                      <?php } }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <center><label >Procedimiento</label></center>
              <textarea type="text" class="form-control" id="process" name="process" required ></textarea>
            </div> 
            <div class="col-sm-4">
              <center><label >Perfil solicitado</label></center>
              <textarea type="text" class="form-control" id="profile" name="profile" maxlength="256" required ></textarea>
            </div>

            <div class="col-sm-4">
              <label >Funciones</label>
              <textarea type="text" class="form-control" id="functions" name="functions" maxlength="256" required ></textarea>
              <input autocomplete="off"  type="hidden" name="typeOp" value="5">
              <input autocomplete="off"  type="hidden" name="new" value="1">
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
  function isChecked(int $id, int $id_announcement, int $action)
  {
      $DataBase = new db();
      switch ($action) {
          case 1:
              $consult = $DataBase->read_single_record_announcement_position($id_announcement);
              break;
          case 2:
              $consult = $DataBase->read_single_record_announcement_charge($id_announcement);
              break;
          case 3:
              $consult = $DataBase->read_single_record_announcement_area($id_announcement);
              break;
          default:
              throw new Exception("Esa acción  no existe", 1);
              break;
      }
      
      while ($row = mysqli_fetch_object($consult)) {
          switch ($action) {
              case 1:
                  $id_consult = intval($row->fk_position);
                  break;
              case 2:
                  $id_consult = intval($row->fk_charge);
                  break;
              case 3:
                  $id_consult = intval($row->fk_area);
                  break;
          }
        if($id_consult === $id){
          return true;
        }
      }
      return false;
  }
  while ($row = mysqli_fetch_object($l_annoucements)) {
    $ida = $row->id_announcement;
    $name = $row->t_name;
    $description = $row->t_description;
    $active = $row->b_active;
    $date = $row->d_dates;
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
        <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
          <div class="modal-body">
          
            <div class="row">
              <div class="col-sm-6">
                <center><label>Nombre de convocatoria </label></center>
                <input autocomplete="off"  type="text" class="form-control" id="name" name="name" maxlength="50" required value="<?php echo $name?>">
              </div>
              <div class="col-sm-6">
                <center><label >Descripción de convocatoria</label></center>
                <input autocomplete="off"  type="text" class="form-control" id="description" name="description" maxlength="256" required value="<?php echo $description?>">
              </div>
              <div class="col-sm-28">
                <center><label >Imagen <i class="bi bi-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Solo se permite una imagen."></i></label></center>
                <input autocomplete="off"  type="file" disabled class="form-control" id="archivo[]" name="archivo[]" data-bs-toggle="tooltip" data-bs-placement="top" title="No se puede modificar el archivo.">
              </div> 
              <div class="col-sm-12">
                <center><label >Fecha de la convocatoria</label></center>
                <input autocomplete="off"  type="text" class="form-control" id="dates" name="dates" required value="<?php echo $date?>">
              </div>
              <div class="col-sm-4">
            <br>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-positions" aria-expanded="true" aria-controls="collapseOne">
                      Puestos
                    </button>
                  </h2>
                  <div id="collapse-positions" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?php 
                        $l_position = $DataBase->read_data_table('positions');
                        while ($row = mysqli_fetch_object($l_position)) {
                          $id = $row->id_position; 
                          $name = $row->t_name?>
                          <input autocomplete="off"  type="checkbox" name="positions[]" disabled <?php if(isChecked($id,$ida,1)){ ?> checked <?php }?> value="<?php echo $id ?>" id="positions-<?php echo $id?>"><label for="positions-<?php echo $id?>"><?php echo $name ?></label><br>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
            <br>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-charges" aria-expanded="true" aria-controls="collapseOne">
                      Cargos
                    </button>
                  </h2>
                  <div id="collapse-charges" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?php 
                        $l_charge = $DataBase->read_data_table('charges');
                        while ($row = mysqli_fetch_object($l_charge)) {
                          $id = $row->id_charge; 
                          $name = $row->t_name?>
                          <input autocomplete="off"  type="checkbox" name="charges[]" disabled <?php if(isChecked($id,$ida,2)){ ?> checked <?php }?> value="<?php echo $id ?>" id="charges-<?php echo $id?>"><label for="charges-<?php echo $id?>"><?php echo $name ?></label><br>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
            <br>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-areas" aria-expanded="true" aria-controls="collapseOne">
                      Areas
                    </button>
                  </h2>
                  <div id="collapse-areas" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?php 
                        $l_area = $DataBase->read_data_table('areas');
                        while ($row = mysqli_fetch_object($l_area)) {
                          $id = $row->id_area; 
                          $name = $row->t_name?>
                          <input autocomplete="off"  type="checkbox" name="areas[]" disabled <?php if(isChecked($id,$ida,3)){ ?> checked <?php }?>value="<?php echo $id ?>" id="areas-<?php echo $id?>"><label for="areas-<?php echo $id?>"><?php echo $name ?></label><br>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-sm-4">
                <center><label >Procedimiento</label></center>
                <textarea type="text" class="form-control" id="process" name="process" required ><?php echo $process?></textarea>
              </div> 
              <div class="col-sm-4">
                <center><label >Perfil solicitado</label></center>
                <textarea type="text" class="form-control" id="profile" name="profile" maxlength="256" required ><?php echo $profile?></textarea>
              </div>

              <div class="col-sm-4">
                <label >Funciones</label>
                <textarea type="text" class="form-control" id="functions" name="functions" maxlength="256" required ><?php echo $functions?></textarea>
                <input autocomplete="off"  type="hidden" name="typeOp" value="8">
                <input autocomplete="off"  type="hidden" name="id" value="<?php echo $ida ?>">
                <input autocomplete="off"  type="hidden" name="update" value="1">
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
            <input autocomplete="off"  type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input autocomplete="off"  type="hidden" name="typeOp" id="typeOp" value="8">
            <input autocomplete="off"  type="hidden" name="delete" value="1">
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

