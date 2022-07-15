<?php
include("components/header.php");
include('config/db.php');
include('process/new.php');
include('process/update.php');
//la  creacion para ver toda la Información junta como reporte

$DataBase = new db();
$id = $_GET['id'];
$announcement = $DataBase->read_single_record_announcement($id);
$nombre = $announcement->t_name;
$descripcion = $announcement->t_description;
$fechadeinicio = $announcement->d_dates;
$Procedimiento = $announcement->t_process;
$Perfilsolicitado = $announcement->t_profile;
$funciones = $announcement->t_functions;
$estado = $announcement->b_active;
$file = $announcement->fk_file;
$path_file = $DataBase->read_single_record_files($file)->t_path;;
if($tipo == 2){
  $id_user = $_SESSION['id_usuario'];
  $id_employee = $DataBase->read_single_record_user_employee($id_user)->fk_employee;
  $employee_info = $DataBase->read_info_employee(intval($id_employee));
  $position = $DataBase->read_single_record_announcement_position($id) ? $DataBase->read_single_record_announcement_position($id)->fk_position : 0;
  $charge = $DataBase->read_single_record_announcement_charge($id) ? $DataBase->read_single_record_announcement_charge($id)->fk_charge : 0;
  if(!$estado)echo "estado";
  // if(intval($position) !== intval($employee_info->fk_position) || intval($charge) !== intval($employee_info->fk_charge))echo $employee_info->fk_position."-".$position."-".$employee_info->fk_charge."-".$charge;
}
?>
<br>

<div class="container">
  <div class="card-group">
    <div class="card" >
      <center><div class="card-header"><h3>Informe de la Convocatoria</h3> </div></center>
      <div class="card-body">
        <h5 class="card-title">Información General</h5>
        <p class="card-text">
        <b>Nombre de la convocatoria:</b> <?php echo $nombre?><br>
        <b>Descripción de la convocatoria:</b> <?php echo $descripcion ?><br>
        <b>Fecha de la convocatoria:</b> <?php echo $fechadeinicio?><br>
        <b>Procedimiento:</b> <?php echo $Perfilsolicitado?><br>
        <b>Perfil solicitado:</b> <?php echo $Procedimiento?><br>
        <b>Funciones:</b> <?php echo $funciones?><br>
        <b>Estado:</b> <?php echo $estado == 0 ? "Inactiva" : "Activa"?><br>
      </div>
    </div>
    <div class="card">
    <iframe src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/awarh/'.$path_file ?>" width="" height="100%"></iframe>
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
        $l_em_ann_list = $DataBase->read_data_table_announcements_employees($id);
        while ($row = mysqli_fetch_object($l_em_ann_list)) { 
          $employee_info = $DataBase->read_info_employee($row->fk_employee);
          $estado_e = intval($row->b_status);
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
        $l_em_ann_list = $DataBase->read_data_table_announcements_employees($id);
        while ($row = mysqli_fetch_object($l_em_ann_list)) { 
          $employee_info = $DataBase->read_info_employee($row->fk_employee);
          $estado_e = intval($row->b_status);
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
                      <input type="hidden" name="id" value="<?php echo $employee_info->id_employee ?>">
                      <input type="hidden" name="ida" value="<?php echo $id ?>">
                      <input type="hidden" name="status" value="1">
                      <input type="hidden" name="typeOp" value="14">
                      <input type="hidden" name="update" value="1">
                    
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
                      <input type="hidden" name="id" value="<?php echo $employee_info->id_employee ?>">
                      <input type="hidden" name="ida" value="<?php echo $id ?>">
                      <input type="hidden" name="status" value="0">
                      <input type="hidden" name="typeOp" value="14">
                      <input type="hidden" name="update" value="1">
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
    $consult = $DataBase->read_single_record_employee_announcement($id_employee);
    $is_applied = $consult ? intval($consult->b_status) : null;?>
    <?php if($is_applied === null){?>
      <form method="post">
        <input type="hidden" name="announcement" value="<?php echo $id ?>">
        <input type="hidden" name="employee" value="<?php echo $id_employee ?>">
        <input type="hidden" name="new" value="1">
        <input type="hidden" name="typeOp" value="11">
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

