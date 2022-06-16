
<center><h2>Lista de Actividades</h2></center>
<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Nueva Actividad
</button>
    <table class="table table-striped table-bordered" id="userTable">
        <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $l_areas = $DataBase->read_data_table('activities');
                while ($row = mysqli_fetch_object($l_areas)) {
                    $id = $row->id;
                    $nombre = $row->name;
                    $description = $row->description;
            ?>
            <tr>
                <td>
                    <?php echo $nombre ?>
                </td>
                <td>
                    <?php echo $description ?>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditActivity-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&typeOp=2"><i class="bi-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
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
                            $id = $row->id;
                            $name = $row->name;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
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
        $id = $row->id;
        $nombre = $row->name;
        $description = $row->description;
        $peticion = $DataBase->read_single_record_relation_charge_activity('charges_activities', $id);
        $object = $peticion ? $peticion->id_charge : 0;
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
                        <option>Selecciona un Cargo</option>
                        <?php     
                            $l_charges_select = $DataBase->read_data_table('charges');
                            while ($row = mysqli_fetch_object($l_charges_select)) {
                                $idc = $row->id;
                                $namec = $row->name;
                                ?>
                        <option value="<?php echo $idc ?>" <?php if($idc == $object){?> selected <?php }?>><?php echo $namec ?></option>
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
