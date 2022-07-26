<?php
include("components/header.php");
$DataBase = new db();
if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>
<center><h2>Lista de cargos</h2></center>

<div class="container">
    <abbr title="Nuevo cargo"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    <i style='font-size:24px' class="bi bi-person-badge"><span class="glyphicon">&#x2b;</span></i>
    </button></abbr>
    <br>
    <br>
    <table class="table table-striped table-bordered userTable" style='background: #00252e '>
        <thead style="color: white">
            <th>Nombre</th>
            <th>Descripción</th>
            <th># Actividades</th>
            <th># Empleados</th>
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
                    <?php echo $DataBase->num_employees_charge($id)->numEmpc ?>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditCharge-<?php echo $id?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#DeleteCharge-<?php echo $id?>"><i class="bi-trash"></i></a>
                    <a class="btn btn-dark btn-sm " data-bs-toggle="modal" data-bs-target="#SeeInfoCharge-<?php echo $id?>"><i class="bi bi-eye"></i></a>
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
            <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Nombre </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="">Descripción</label>
                            <textarea class="form-control" id="description" name="description" required rows="1"></textarea>
                        </div>                    
                    </div>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="typeOp" value="6">
                    <input type="hidden" name="new" value="1">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Registrar</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edición de cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Nombre </label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $nombre ?>">
                        </div>
                        <div class="col-sm-12">
                            <label for="">Descripción </label>
                            <textarea class="form-control" id="description" name="description" required rows="1"><?php echo $description ?></textarea>
                        </div>                    
                    </div>
                    <br>
                </div>
                <input type="hidden" name="typeOp" value="3">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="update" value="1">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Editar</button>
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
          <form method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="3">
            <input type="hidden" name="delete" value="1">
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
<div class="modal fade" id="SeeInfoCharge-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del cargo <strong><?php echo $nombre ?></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <center><h3>Actividades</h3></center>
                        <?php $l_activities = $DataBase->read_activities_charges($id);
                        $cont = 0;
                        if($l_activities->num_rows === 0){?>
                            <p>Este cargo no tiene ninguna actividad.</p>
                        <?php }else{
                            while($row = mysqli_fetch_object($l_activities)){ ?>
                                <p><?php 
                                $cont +=1;
                                echo '<strong>'.$cont.'.</strong> '.$row->t_name;?></p>
                            <?php } 
                        }?>
                    </div>
                    <div class="col">
                        <center><h3>Empleados</h3></center>
                        <?php $l_activities = $DataBase->read_employees_charges($id);
                        $cont = 0;
                        if($l_activities->num_rows === 0){?>
                            <p>Este cargo no lo tiene ningun empleado.</p>
                        <?php }else{
                            while($row = mysqli_fetch_object($l_activities)){ ?>
                                <p><?php 
                                $cont +=1;
                                echo '<strong>'.$cont.'.</strong> '.$row->full_name;?></p>
                            <?php } 
                        }?>
                    </div>
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
<script>
var elemento = document.getElementById('charge_list');
elemento.classList.add("active");
var elemento = document.getElementById('config_list');
elemento.classList.add("active");
</script>
<?php
include("components/footer.php");
?>