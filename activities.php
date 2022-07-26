<?php
include("components/header.php");

$DataBase = new db();

if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>
<center><h2>Lista de Actividades</h2></center>
<div class="container">
<abbr title="Nueva Actividad"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#RegistroActivity">
<i style='font-size:24px' class="bi bi-card-checklist"><span class="glyphicon">&#x2b;</span></i>
</button></abbr>
<br>
    <br>
    <table class="table table-striped table-bordered userTable" style='background: #00252e '>
        <thead style="color: white">
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cargo</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $l_areas = $DataBase->read_data_table('activities');
                while ($row = mysqli_fetch_object($l_areas)) {
                    $id = $row->id_activity;
                    $nombre = $row->t_name;
                    $description = $row->t_description;
                    $charge_id = $DataBase->read_single_record_relation_charge_activity($id) ? $DataBase->read_single_record_relation_charge_activity($id)->fk_charge : 0;
                    $charge = $charge_id == 0 ? "Ninguno" : ($DataBase->read_single_record_charges($charge_id) ? $DataBase->read_single_record_charges($charge_id)->t_name : "Ninguno");
            ?>
            <tr>
                <td>
                    <?php echo $nombre ?>
                </td>
                <td>
                    <?php echo $description ?>
                </td>
                <td>
                    <?php echo $charge ?>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditActivity-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#DeleteActivity-<?php echo $id ?>"><i class="bi-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="RegistroActivity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Actividades</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
        <div class="row needs-validation" novalidate>
            <div class="col-sm-12">
            <label >Nombre </label>
            <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="col-sm-12">
            <label >Descripción </label>
            <textarea class="form-control" id="description" name="description" required rows="1"></textarea>
            </div>
            <div class="col-sm-12">
                <center><label>Cargo</label></center>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge" required>
                    <?php     
                    $l_charges_select = $DataBase->read_data_table('charges');
                    if(mysqli_num_rows($l_charges_select) === 0 ) { ?>
                    <option selected disabled value="">Necesitas crear un cargo primero</option>
                    <?php } else { ?> <option selected disabled value="">Selecciona un cargo</option><?php } ?>
                    
                    <?php 
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $idc = $row->id_charge;
                            $namec = $row->t_name;
                            ?>
                    <option value="<?php echo $idc ?>"><?php echo $namec ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="hidden" name="typeOp" value="4">
            <input type="hidden" name="new" value="1">
        </div>
        
        <br>
        
    
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php 
    $l_areas = $DataBase->read_data_table('activities');
    while ($row = mysqli_fetch_object($l_areas)) {
        $id = $row->id_activity;
        $nombre = $row->t_name;
        $description = $row->t_description;
        $object = $DataBase->read_single_record_relation_charge_activity($id) ? $DataBase->read_single_record_relation_charge_activity($id)->fk_charge : 0;
?>
    <div class="modal fade" id="EditActivity-<?php echo $id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edición de Actividad</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
            <div class="row">
                <div class="col-sm-12">
                <label >Nombre </label>
                <input value="<?php echo $nombre?>"type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-sm-12">
                <label >Descripción </label>
                <textarea class="form-control" id="description" name="description" required rows="1"><?php echo $description ?></textarea>
                </div>
                <div class="col-sm-12">
                    <label>Cargo </label>
                    
                    <select class="form-select" aria-label="Default select example" id="charge" name="charge" required>
                         <?php     
                            $l_charges_select = $DataBase->read_data_table('charges');
                            if(mysqli_num_rows($l_charges_select) === 0 ) { ?>
                            <option selected disabled value="">Necesitas crear un cargo primero</option>
                            <?php } else { ?> <option <?php if(intval($object) === 0){?> selected <?php }?> disabled value="">Selecciona una Cargo</option><?php } ?>
                            <?php 
                            while ($row = mysqli_fetch_object($l_charges_select)) {
                                $idc = $row->id_charge;
                                $namec = $row->t_name;
                                ?>
                        <option value="<?php echo $idc ?>" <?php if(intval($idc) === intval($object)){?> selected <?php }?>><?php echo $namec ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <input type="hidden" name="typeOp" value="6">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="hidden" name="update" value="1">
            </div>
            
            <br>
            
        
        </div>
        <div class="modal-footer">
            
            <button type="submit" class="btn btn-success" >Editar</button>
        </div>
        </form>
        </div>
    </div>
    </div>

<?php }
?>

<?php 
  $l_activities = $DataBase->read_data_table('activities');
  while ($row = mysqli_fetch_object($l_activities)) {
    $id = $row->id_activity;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteActivity-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <input type="hidden" name="typeOp" id="typeOp" value="2">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<script>
  var elemento = document.getElementById('activity_list');
elemento.classList.add("active");
var elemento = document.getElementById('config_list');
elemento.classList.add("active");
</script>
<?php
include("components/footer.php");
?>