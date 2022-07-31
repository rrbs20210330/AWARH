<?php
include("components/header.php");
$DataBase = new db();
$id = $_GET['id'];
$announcement = $DataBase->read_single_record_announcement($id);
$va = $DataBase->read_single_record_announcement($id) ? true : false;

if(!$va)echo "<script> window.location.href = 'error.php';</script>";
include('process/new.php');
include('process/update.php');

$estado = $announcement->b_active;
if($tipo === 2){
  $id_employee = $DB->read_single_record_user_employee($id_usuario)->fk_employee;
  $employee_info = $DB->read_info_employee(intval($id_employee));
  $area_id = $DataBase->read_single_record_positions_areas($employee_info->fk_position) ? $DataBase->read_single_record_positions_areas($employee_info->fk_position)->fk_area : null;
  if(!$estado) header('Location: announcements.php');
  $positions = $DataBase->read_single_record_announcement_position($id) ? $DataBase->read_single_record_announcement_position($id) : null;
  $charges = $DataBase->read_single_record_announcement_charge($id) ? $DataBase->read_single_record_announcement_charge($id) : null;
  $areas = $DataBase->read_single_record_announcement_area($id) ? $DataBase->read_single_record_announcement_area($id) : null;
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
  if($position === false && $charge === false && $area === false && $positions !== null && $charges !== null && $areas !== null)header('Location: announcements.php');
  // if($position  || $charge || $area || ($positions === null && $charges === null && $areas === null)) header('Location: announcements.php');
}

$nombre = $announcement->t_name;
$descripcion = $announcement->t_description;
$fechadeinicio = $announcement->d_dates;
$Procedimiento = $announcement->t_process;
$Perfilsolicitado = $announcement->t_profile;
$funciones = $announcement->t_functions;

$file = $announcement->fk_file;
$path_file = $DB->read_single_record_files($file)->t_path;;
?>
<br>

<div class="container">
<a href="announcements.php" class="btn btn-dark">Regresar</a>
  <br>
<center><h1>Información general de la convocatoria</h1></center>
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <div class="embed-responsive embed-responsive-16by9 table-responsive">
        <table style="table-layout: fixed; width: 100%; " class="table">
        <tr>
            <th>
              <b>Nombre: </b>
            </th>
            <td style="word-wrap: break-word">
              <?php echo $nombre?>
            </td>
          </tr>
          <tr>
            <th>
              <b>Estado: </b>
            </th>
            <td style="word-wrap: break-word">
              <?php echo $estado == 0 ? "Inactiva" : "Activa"?>
            </td>
          </tr>
          <tr>
            <th>
              <b>Fechas: </b>
            </th>
            <td style="word-wrap: break-word">
              <?php echo $fechadeinicio?>
            </td>
          </tr>
          <tr>
            <th>
              <b>Descripción: </b>
            </th>
            <td style="word-wrap: break-word;">
              <?php echo $descripcion ?>
            </td>
          </tr>
          <tr>
            <th>
              <b>Procedimiento: </b>
            </th>
            <td style="word-wrap: break-word">
              <?php echo $Perfilsolicitado?>
            </td>
          </tr>
          <tr>
            <th>
              <b>Perfil solicitado: </b>
            </th>
            <td style="word-wrap: break-word">
              <?php echo $Procedimiento?>
            </td>
          </tr>
          <tr>
            <th>
              <b>Funciones: </b>
            </th>
            <td style="word-wrap: break-word">
              <?php echo $funciones?>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col">
      <iframe alias="Imagen Informativa" display="block" frameborder="0" scrolling="no" height="100%" width="100%" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$path_file?>"></iframe>
    </div>
  </div>
  <br>
  <?php if($tipo === 1){?>
    <center><h1>Lista de Aspirantes</h1></center>
    <table class="table table-striped table-bordered userTable"  style='background: #00252e '>
      <thead style="color: white">
          <th>Aspirante</th>
          <th>Estado</th>
          <th></th>
      </thead>
      <tbody>
        <?php 
        $l_em_ann_list = $DB->read_data_table_announcements_employees($id);
        while ($row = mysqli_fetch_object($l_em_ann_list)) { 
          $employee_info = $DB->read_info_employee($row->fk_employee);
          $estado_e = intval($row->i_status);
          ?>
          <tr>
            <td>
                <?php echo $employee_info->t_names." ".$employee_info->t_last_names ?>
            </td>
            <td>
                <?php switch ($estado_e) {
                  case 0:
                    echo "Rechazado";
                    break;
                  case 1:
                    echo "Aceptado";
                    break;
                  default:
                    echo "Pendiente";
                    break;
                } ?>
            </td>
            <td>
                <?php if($estado_e == 2){?>
                  <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Accept-<?php echo $employee_info->id_employee?>"><i class="bi bi-check-lg"></i></a>
                  <a class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#Dismiss-<?php echo $employee_info->id_employee?>"><i class="bi bi-x-lg"></i></a>
                <?php }else{?>
                  <!-- <a class="btn btn-info btn-sm">Mostrar Más</a> -->
                <?php } ?>
            </td>
        </tr>  
        <?php } ?>
      </tbody>
    </table>

    <?php 
        $l_em_ann_list = $DB->read_data_table_announcements_employees($id);
        while ($row = mysqli_fetch_object($l_em_ann_list)) { 
          $employee_info = $DB->read_info_employee($row->fk_employee);
          $estado_e = intval($row->i_status);
          if($estado_e == 2){?>
            <div class="modal fade" id="Accept-<?php echo $employee_info->id_employee ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aceptar Aspirante <?php echo $employee_info->t_names." ".$employee_info->t_last_names ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Al aceptar se le sera notificado al aspirante a esta convocatoria. <br>
                    Una vez aceptado, no podra modificarse.
                    <form method="post">
                      <label for="notice"><strong>Nota:</strong></label>
                      <textarea name="notice" id="notice" class="form-control" rows="1" required></textarea>
                      <input autocomplete="off"  type="hidden" name="id" value="<?php echo $employee_info->id_employee ?>">
                      <input autocomplete="off"  type="hidden" name="ida" value="<?php echo $id ?>">
                      <input autocomplete="off"  type="hidden" name="status" value="1">
                      <input autocomplete="off"  type="hidden" name="typeOp" value="14">
                      <input autocomplete="off"  type="hidden" name="update" value="1">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Aceptar</button>
                  </div>
                  </form> 
                </div>
              </div>
            </div>
            <div class="modal fade" id="Dismiss-<?php echo $employee_info->id_employee ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rechazar Aspirante <?php echo $employee_info->t_names." ".$employee_info->t_last_names ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Al rechazar se le sera notificado al aspirante a esta convocatoria. <br>
                    Una vez rechazado, no podra modificarse.
                    <form method="post">
                      <label for="notice"><strong>Nota:</strong></label>
                      <textarea name="notice" id="notice" class="form-control" rows="1" required></textarea>
                      <input autocomplete="off"  type="hidden" name="id" value="<?php echo $employee_info->id_employee ?>">
                      <input autocomplete="off"  type="hidden" name="ida" value="<?php echo $id ?>">
                      <input autocomplete="off"  type="hidden" name="status" value="0">
                      <input autocomplete="off"  type="hidden" name="typeOp" value="14">
                      <input autocomplete="off"  type="hidden" name="update" value="1">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Rechazar</button>
                  </div>
                  </form> 
                </div>
              </div>
            </div>
          <?php }else{?> 
            
            <?php } ?>
        <?php } ?>
  <?php }else{
    $consult = $DB->read_single_record_employee_announcement($id_employee, $id);
    $is_applied = $consult ? intval($consult->i_status) : null;?>
    <?php if($is_applied === null){?>
      <form method="post">
        <input autocomplete="off"  type="hidden" name="announcement" value="<?php echo $id ?>">
        <input autocomplete="off"  type="hidden" name="employee" value="<?php echo $id_employee ?>">
        <input autocomplete="off"  type="hidden" name="new" value="1">
        <input autocomplete="off"  type="hidden" name="typeOp" value="11">
        <button class="btn btn-dark btn-sm" type="submit">Aplicar</button>
      </form>
    <?php }else{ ?>
    <div>
    <button class="btn btn-secondary btn-sm" disabled>Ya has aplicado</button>
    <?php if($is_applied === 1){?>
        <label class="alert alert-success" role="alert">Fuiste aceptado <br><strong>NOTA:</strong><br><?php echo $consult->t_notice ?></label>
    </div>
    <?php }else if($is_applied === 0){?>
      <label class="alert alert-danger" role="alert">Fuiste rechazado <br><strong>Razón:</strong><br><?php echo $consult->t_notice ?></label>
    <?php } else{ ?>
      <label class="alert alert-info" role="alert">Tu Confirmacion esta pendiente</label>
  <?php } ?>
  
  <?php } }?>
</div>
<?php 
include("components/footer.php");
?>

