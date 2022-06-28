
<center><h2>Lista de Actividades</h2></center>
<div class="container">
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#RegistroActivity">
  Nueva Actividad
</button>
    <table class="table table-striped table-bordered userTable" >
        <thead>
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
                    $object = $DataBase->read_single_record_relation_charge_activity('charges_activities', $id) ? $DataBase->read_single_record_relation_charge_activity('charges_activities', $id)->fk_charge : 0;
                    $charge;
                    
                    if(intval($object) === 0){
                        $charge = "Ninguno";
                    }else{
                        $charge = $DataBase->read_single_record_charges('charges', intval($object))->t_name;
                    }
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
      <form method="post" action="process/new.php">
        <div class="row">
            <div class="col-sm-4">
            <label >Nombre </label>
            <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-sm-4">
            <label >Descripción </label>
            <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="col-sm-4">
                <label>Cargo</label>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                    <option selected>Selecciona una área</option>
                    <?php     
                        $l_charges_select = $DataBase->read_data_table('charges');
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $idc = $row->id_charge;
                            $namec = $row->t_name;
                            ?>
                    <option value="<?php echo $idc ?>"><?php echo $namec ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="hidden" name="typeOp" value="4">
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
        $object = $DataBase->read_single_record_relation_charge_activity('charges_activities', $id) ? $DataBase->read_single_record_relation_charge_activity('charges_activities', $id)->fk_charge : 0;
?>
    <div class="modal fade" id="EditActivity-<?php echo $id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edicion de Actividades</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post" action="process/update.php">
            <div class="row">
                <div class="col-sm-4">
                <label >Nombre </label>
                <input value="<?php echo $nombre?>"type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-sm-4">
                <label >Descripción </label>
                <input value="<?php echo $description ?>"type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="col-sm-4">
                    <label>Cargo</label>
                    
                    <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                         <option <?php if(intval($object) === 0){ ?>selected <?php } ?>>Selecciona un Cargo</option> 
                        <?php     
                            $l_charges_select = $DataBase->read_data_table('charges');
                            while ($row = mysqli_fetch_object($l_charges_select)) {
                                $idc = $row->id_charge;
                                $namec = $row->t_name;
                                ?>
                        <option value="<?php echo $idc ?>" <?php if(intval($idc) === intval($object)){?> selected <?php }?>><?php echo $namec ?></option>
                        <?php } ?>
                    </select>
                </div>
                <input type="hidden" name="typeOp" value="6">
                <input type="hidden" name="id" value="<?php echo $id?>">
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
          <form action="process/delete.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="2">
          
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>