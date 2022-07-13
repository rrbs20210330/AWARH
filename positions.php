<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>
<center><h2>Lista de Puestos</h2></center>

<div class="container">
  <abbr title="Nuevo puesto"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#RegistroPosicion">
  <i style='font-size:24px' class="bi bi-file-earmark-person"><span class="glyphicon">&#x2b;</span></i>
  </button></abbr>
  <br>
    <br>
  <table class="table table-striped table-bordered userTable" style='background: #00252e '>
    <thead style="color: white">
      <th>Nombre</th>
      <th>Descripción</th>
      <th># Empleados</th>
      <th></th>
    </thead>
    <tbody>
      <?php 
        $l_positions = $DataBase->read_data_table('positions');
        while ($row = mysqli_fetch_object($l_positions)) {
          $id = $row->id_position;
          $nombre = $row->t_name;
          $description = $row->t_description;?>
          <tr>
            <td>
              <?php echo $nombre ?>
            </td>
            <td>
              <?php echo $description ?>
            </td>
            <td>
              <?php echo $DataBase->num_employees_position($id)->numEmpp ?>
            </td>
            <td>
              <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditPosition-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
              <a class="btn btn-danger btn-sm "data-bs-toggle="modal" data-bs-target="#DeletePosition-<?php echo $id ?>"><i class="bi-trash"></i></a>
            </td>
          </tr>
        <?php }?>
    </tbody>
  </table>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="RegistroPosicion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Puesto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
        <div class="row">
            <div class="col-sm-6">
            <label for="">Nombre </label>
            <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-sm-6">
            <label for="">Descripción </label>
            <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="col-sm-12">  
              <label>Área</label>
              <select class="form-select" aria-label="Default select example" id="area" name="area" required>
              <?php     
                      $l_areas_select = $DataBase->read_data_table('areas');
                      if(mysqli_num_rows($l_areas_select) === 0 ) { ?>
                      <option selected disabled value="">Necesitas crear una área primero</option>
                      <?php } else { ?> <option selected disabled value="">Selecciona una Área</option><?php } ?>
                      
                      <?php 
                      while ($row = mysqli_fetch_object($l_areas_select)) {
                          $idc = $row->id_area;
                          $namec = $row->t_name;
                          ?>
                  <option value="<?php echo $idc ?>" ><?php echo $namec ?></option>
                  <?php } ?>
              </select>
            </div>
            <input type="hidden" name="typeOp" value="7">
            <input type="hidden" name="new" value="1">
        </div>
        
        <br>
        
    
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-success" >Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php 
    $l_positions = $DataBase->read_data_table('positions');
    while ($row = mysqli_fetch_object($l_positions)) {
        $id = $row->id_position;
        $nombre = $row->t_name;
        $description = $row->t_description;
        $object = $DataBase->read_single_record_area_position($id) ? $DataBase->read_single_record_area_position($id)->fk_area : 0;
?>
<div class="modal fade" id="EditPosition-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de Puesto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  method="post" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
        <div class="row">
            <div class="col-sm-6">
            <label for="">Nombre </label>
            <input value="<?php echo $nombre ?>" type="text" class="form-control" id="name" name="name">
            </div>
            <div class="col-sm-6">
            <label for="">Descripción </label>
            <input value="<?php echo $description ?>" type="text" class="form-control" id="description" name="description">
            </div>
            <div class="col-sm-12">
              <label>Área</label>
              
              <select class="form-select" aria-label="Default select example" id="area" name="area" required>
                    <?php     
                      $l_areas_select = $DataBase->read_data_table('areas');
                      if(mysqli_num_rows($l_areas_select) === 0 ) { ?>
                      <option disabled value="">Necesitas crear una área primero</option>
                      <?php } else { ?> <option disabled value="">Selecciona una Área</option><?php } ?>
                      
                      <?php 
                      while ($row = mysqli_fetch_object($l_areas_select)) {
                          $idc = $row->id_areas;
                          $namec = $row->t_name;
                          ?>
                  <option value="<?php echo $idc ?>" <?php if(intval($idc) === intval($object)){?> selected <?php }?>><?php echo $namec ?></option>
                  <?php } ?>
              </select>
          </div>
        </div>
        <br>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="typeOp" value="5">
        <input type="hidden" name="update" value="1">
    
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
  $l_positions = $DataBase->read_data_table('positions');
  while ($row = mysqli_fetch_object($l_positions)) {
    $id = $row->id_position;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeletePosition-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
          <form  method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="5">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<script>
  var elemento = document.getElementById('position_list');
elemento.classList.add("active");
var elemento = document.getElementById('config_list');
elemento.classList.add("active");
</script>
<?php
include("components/footer.php");
?>