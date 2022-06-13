<?php
include("components/header.php");
?>


<?php 
    include('config/db.php');
    $DataBase = new db();
    if(isset($_POST) && !empty($_POST)){
        
        $user = $DataBase->sanitize($_POST['user']);
        $password= $DataBase->sanitize($_POST['password']);

        $res = $DataBase->insert_t_users($user, $password, true);//siempre sera true por que es un nuevo usuario activo, la fecha de ultima entrada no se añade por obvias razones

        if($res){
            $message = "Datos insertados con éxito";
            $class = "alert alert-success";
        }else{
            $message = "No se pudieron insertar los datos..";
            $class = "alert alert-danger";
        }
        
        ?>
        <center><div class="<?php echo $class ?>"><?php echo $message?></div></center>
        <?php
    }
    
?>

<center><h2>Lista de Convocatorias</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Nueva Convocatorias
</button>
  <table class="table table-bordered"  id="userTable">
    <thead>
      <th>Activo</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Fecha Inicio</th>    
      <th>Fecha Termino</th>
      <th></th>
    </thead>
    <tbody>
      <?php 
        $l_users = $DataBase->read_data_table('announcements');
        while ($row = mysqli_fetch_object($l_users)) {
          $id = $row->id;
          $active = $row->active;
          $name = $row->name;
          $description = $row->description;
          $start = $row->date_start;
          $finish = $row->date_finish;?>
          <tr>
            <td>
              <?php if ($active == 0){?>
                <a class="btn btn-secondary btn-sm" href="process/updateStatus.php?id=<?php echo $id?>&table=announcements&location=announcements"><i class="bi bi-circle"></i></a>
              <?php
              }else{?>
                <a class="btn btn-success btn-sm" href="process/updateStatus.php?id=<?php echo $id?>&table=announcements&location=announcements"><i class="bi bi-circle-fill"></i></a>
              <?php
              }?>
            </td>
            <td>
              <?php echo $name ?>
            </td>
            <td>
              <?php echo $description ?>
            </td>
            <td>
              <?php echo $date_start ?>
            </td>
            <td>
              <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarusuario" ><i class="bi bi-pencil-square"></i></a>
              <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&table=users&location=users"><i class="bi-trash"></i></a>
              <a class="btn btn-success btn-sm "href="announcement.php?id=<?php echo $id?>"><i class="bi bi-eye"></i></a>
            </td>
          </tr>  
      <?php
        }?>
    </tbody>
  </table>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de cargos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="process/newAnnouncement.php">
        <div class="row">
            <div class="col-sm-4">
            <label for="">Nombre </label>
            <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-sm-4">
            <label for="">Descripcion </label>
            <input type="text" class="form-control" id="description" name="description" required>
            </div>
            
            <div class="col-sm-4">
            <label for="">Fecha de Inicio </label>
            <input type="date" class="form-control" id="description" name="description" required>
            </div>
            <div class="col-sm-4">
            <label for="">Fecha de Termino </label>
            <input type="date" class="form-control" id="description" name="description" required>
            </div>
            <div class="col-sm-4">
            <label for="">Imagen </label>
            <input type="file" class="form-control" id="description" name="description" required>
            </div>
            <div class="col-sm-4">
              <label>Lista de Cargos</label>
                <?php     
                    $l_positions_select = $DataBase->read_data_table('charges');
                    while ($row = mysqli_fetch_object($l_positions_select)) {
                        $id = $row->id;
                        $name = $row->name;
                        ?>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="<?php echo $id ?>" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    <?php echo $name ?>
                  </label>
                </div>
                <?php } ?>
              </select>
            </div>
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
include("components/footer.php");
?>

