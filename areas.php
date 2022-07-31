<?php
include("components/header.php");
$DataBase = new db();
if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>
<center><h2>Áreas</h2></center>

<div class="container">
  <abbr title="Nueva Área"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#RegistroArea">
  <i style='font-size:24px' class="bi bi-person-workspace"><span class="glyphicon">&#x2b;</span></i>
  </button></abbr>
  <br><br>
  <table class="table table-striped table-bordered userTable" style='background: #00252e '>
    <thead style="color: white">
      <th>Nombre</th>
      <th>Descripción</th>
      <th># Puestos</th>
      <th></th>
    </thead>
    <tbody>
      <?php 
        $l_area = $DataBase->read_data_table('areas');
        while ($row = mysqli_fetch_object($l_area)){
          $id = $row->id_area;
          $nombre = $row->t_name;
          $description = $row->t_description;
          $num = $DataBase->num_position_area($id) ? $DataBase->num_position_area($id)->numPosAr : 0;
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
              <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditArea-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
              <a class="btn btn-danger btn-sm "data-bs-toggle="modal" data-bs-target="#DeleteArea-<?php echo $id ?>"><i class="bi-trash"></i></a>
              <a class="btn btn-dark btn-sm " data-bs-toggle="modal" data-bs-target="#SeePositionArea-<?php echo $id?>"><i class="bi bi-eye"></i></a>
            </td>
          </tr>
        <?php }?>
    </tbody>
  </table>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="RegistroArea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Áreas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
        <div class="modal-body">
          <div class="row">
              <div class="col-sm-12">
              <label for="">Nombre </label>
              <input autocomplete="off"  type="text" class="form-control" id="name" name="name" maxlength="50" required>
              </div>
              <div class="col-sm-12">
              <label for="">Descripción </label>
              <textarea class="form-control" id="description" name="description" maxlength="256" rows="1" required></textarea>
              </div>
              <input autocomplete="off"  type="hidden" name="typeOp" value="10">
              <input autocomplete="off"  type="hidden" name="new" value="1">
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
    $l_area = $DataBase->read_data_table('areas');
    while ($row = mysqli_fetch_object($l_area)) {
        $id = $row->id_area;
        $nombre = $row->t_name;
        $description = $row->t_description;
?>
<div class="modal fade" id="EditArea-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de Área</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
        <div class="row">
            <div class="col-sm-12">
            <label for="">Nombre </label>
            <input autocomplete="off"  value="<?php echo $nombre ?>" type="text" class="form-control" id="name" name="name" maxlength="50">
            </div>
            <div class="col-sm-12">
            <label for="">Descripción </label>
            <textarea class="form-control" id="description" name="description" maxlength="256" rows="1"><?php echo $description ?></textarea>
            </div>
        </div>
        <br>
        <input autocomplete="off"  type="hidden" name="id" value="<?php echo $id ?>">
        <input autocomplete="off"  type="hidden" name="typeOp" value="9">
        <input autocomplete="off"  type="hidden" name="update" value="1">
    
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-success" >Editar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php } ?>



<?php 
  $l_area = $DataBase->read_data_table('areas');
  while ($row = mysqli_fetch_object($l_area)) {
    $id = $row->id_area;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteArea-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <input autocomplete="off"  type="hidden" name="typeOp" id="typeOp" value="9">
            <input autocomplete="off"  type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>



<?php 
$l_area = $DataBase->read_data_table('areas');
while ($row = mysqli_fetch_object($l_area)) {
  $id = $row->id_area;
  $nombre = $row->t_name;
?>

<!------------------MODAL OJO------------------->
<div class="modal fade" id="SeePositionArea-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Puestos del Area <strong><?php echo $nombre ?></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <?php $l_positions = $DataBase->read_positions_areas($id);
                    $cont = 0;
                    if($l_positions->num_rows === 0){?>
                        <p>Esta área no tiene ningun puesto.</p>
                    <?php }else{
                        while($row = mysqli_fetch_object($l_positions)){ ?>
                            <p><?php 
                            $cont +=1;
                            echo '<strong>'.$cont.'.</strong> '.$row->t_name;?></p><br>
                        <?php } 
                    }?>
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
  var elemento = document.getElementById('area_list');
elemento.classList.add("active");
var elemento = document.getElementById('config_list');
elemento.classList.add("active");
</script>
<?php
include("components/footer.php");
?>