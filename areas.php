<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>
<center><h2>Áreas</h2></center>

<div class="container">
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#RegistroArea">
    Nueva Área
  </button>
  <br><br>
  <table class="table table-striped table-bordered userTable" style='background: #00252e '>
    <thead style="color: white">
      <th>Nombre</th>
      <th>Descripción</th>
      <th></th>
    </thead>
    <tbody>
      <?php 
        $l_area = $DataBase->read_all_area();
        while ($row = mysqli_fetch_object($l_area)){
          $id = $row->id_area;
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
              <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditArea-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
              <a class="btn btn-danger btn-sm "data-bs-toggle="modal" data-bs-target="#DeleteArea-<?php echo $id ?>"><i class="bi-trash"></i></a>
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
      <form action="process/new.php"method="post">
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
              <input type="hidden" name="typeOp" value="10">
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
    $l_area = $DataBase->read_all_area();
    while ($row = mysqli_fetch_object($l_area)) {
        $id = $row->id_area;
        $nombre = $row->t_name;
        $description = $row->t_description;
?>
<div class="modal fade" id="EditArea-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de Áreas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="process/update.php" method="post">
        <div class="row">
            <div class="col-sm-4">
            <label for="">Nombre </label>
            <input value="<?php echo $nombre ?>" type="text" class="form-control" id="name" name="name">
            </div>
            <div class="col-sm-4">
            <label for="">Descripción </label>
            <input value="<?php echo $description ?>" type="text" class="form-control" id="description" name="description">
            </div>
        </div>
        <br>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="typeOp" value="9">
    
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-success">Editar</button>
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
          <form action="process/delete.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="9">
          
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php
include("components/footer.php");
?>