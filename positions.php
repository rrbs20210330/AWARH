

<center><h2>Lista de Puestos</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Nuevo puesto
</button>
    <table class="table table-striped table-bordered userTable" id="userTable">
        <thead>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $l_positions = $DataBase->read_data_table('positions');
                while ($row = mysqli_fetch_object($l_positions)) {
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
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditPosition-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&typeOp=5"><i class="bi-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Registro de Areas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="process/new.php"method="post">
        <div class="row">
            <div class="col-sm-4">
            <label for="">Nombre </label>
            <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-sm-4">
            <label for="">Descripcion </label>
            <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <input type="hidden" name="typeOp" value="7">
            
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
    $l_positions = $DataBase->read_data_table('positions');
    while ($row = mysqli_fetch_object($l_positions)) {
        $id = $row->id;
        $nombre = $row->name;
        $description = $row->description;
?>
<div class="modal fade" id="EditPosition-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Areas</h5>
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
            <label for="">Descripcion </label>
            <input value="<?php echo $description ?>" type="text" class="form-control" id="description" name="description">
            </div>
        </div>
        <br>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="typeOp" value="5">
    
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
