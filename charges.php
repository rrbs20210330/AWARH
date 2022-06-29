
<center><h2>Lista de cargos</h2></center>

<div class="container">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Nuevo Cargo
    </button>
    <br>
    <br>
    <table class="table table-striped table-bordered userTable" >
        <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th># Actividades</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $l_charges = $DataBase->read_all_charges();
                while ($row = mysqli_fetch_object($l_charges)) {
                    $id = $row->chargeID;
                    $num = $DataBase->num_activities_charge($id) ? $DataBase->num_activities_charge($id)->numActCh : 0;
                    $nombre = $row->chargeName;
                    $description = $row->chargeDesc;
                    
            ?>
            <tr>
                <td>
                    <?php echo $nombre ?>
                </td>
                <td>
                    <?php echo $description ?>
                </td>
                <td>
                    <?php echo $num ?>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditCharge-<?php echo $id?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#DeleteCharge-<?php echo $id?>"><i class="bi-trash"></i></a>
                    <a class="btn btn-dark btn-sm " data-bs-toggle="modal" data-bs-target="#SeeActivitiesCharge-<?php echo $id?>"><i class="bi bi-eye"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Registro de cargos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="process/new.php" method="post">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Nombre </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Descripción </label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>                    
                    </div>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="typeOp" value="6">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php 
    $l_charges = $DataBase->read_all_charges();
    while ($row = mysqli_fetch_object($l_charges)) {
        $id = $row->chargeID;
        $nombre = $row->chargeName;
        $description = $row->chargeDesc;
        
?>
<div class="modal fade" id="EditCharge-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de cargos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="process/update.php" method="post">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Nombre </label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $nombre ?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Descripción </label>
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo $description ?>">
                        </div>                    
                    </div>
                    <br>
                </div>
                <input type="hidden" name="typeOp" value="3">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php } ?>


<?php 
  $l_charges = $DataBase->read_data_table('charges');
  while ($row = mysqli_fetch_object($l_charges)) {
    $id = $row->id_charge;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteCharge-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <input type="hidden" name="typeOp" id="typeOp" value="3">
          
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>




<?php 
    $l_charges = $DataBase->read_all_charges();
    while ($row = mysqli_fetch_object($l_charges)) {
        $id = $row->chargeID;
        $nombre = $row->chargeName;

?>
<div class="modal fade" id="SeeActivitiesCharge-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actividades del cargo <strong><?php echo $nombre ?></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <p>

                    </p>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php } ?>
