<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>
<center><h2>Lista de usuarios</h2></center>

<div class="container">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrousuario">
    Nuevo usuario
  </button>
  <table class="table table-striped table-bordered"  id="userTable">
    <thead>
        <th>Activo</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Ultima entrada</th>
        <th></th>
    </thead>
    <tbody>
      <?php 
          $l_users = $DataBase->read_data_table('users');
          while ($row = mysqli_fetch_object($l_users)) {
              $id = $row->id;
              $active = $row->active;
              $user = $row->user;
              $password = $row->password;
              $lastjoin = $row->last_join;
      ?>
      <tr>
          <td>
              <?php if ($active == 0){?>
                <a class="btn btn-secondary btn-sm" href="process/update.php?id=<?php echo $id?>&table=users&location=users"><i class="bi bi-circle"></i></a>
              <?php }else{?>
                <a class="btn btn-success btn-sm" href="process/update.php?id=<?php echo $id?>&table=users&location=users"><i class="bi bi-circle-fill"></i></a>
              <?php
              }?>
          </td>
          <td>
              <?php echo $user ?>
          </td>
          <td>
              <?php echo $password ?>
          </td>
          <td>
              <?php if($lastjoin){
                echo $lastjoin;
              }else{
                echo "No se ha iniciado sesión con este usuario";
              } ?>
          </td>
          <td>
              <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditUser-<?php echo $id?>"><i class="bi bi-pencil-square"></i></a>
              <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&table=users&location=users&typeOp=1"><i class="bi-trash"></i></a>
          </td>
      </tr>  
      <?php }?>
    </tbody>
  </table>
</div>

<!-- FORMULARIO DE REGISTRO DE USUARIOS -->
<div class="modal fade" id="registrousuario" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Usuarios Administradores</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="process/new.php" method="post" id="formul">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-4">
              <label>Usuario </label>
              <input type="text" class="form-control" id="user" name="user" required value="">
            </div>
            <div class="col-sm-4">
              <label>Contraseña</label>
              <input type="text" class="form-control" id="password" name="password" required>
            </div>           
          </div>
          <input type="hidden" name="typeOp" value="1">
          <br>    
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- FORMULARIO DE EDICION DE USUARIOS -->
<?php 
  $l_users = $DataBase->read_data_table('users');
  while ($row = mysqli_fetch_object($l_users)) {
    $id = $row->id;
    $active = $row->active;
    $user = $row->user;
    $password = $row->password;
?>
    <div class="modal fade" id="EditUser-<?php echo $id?>" tabindex="-1"  aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edicion de Usuario Administrador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="process/update.php" method="post" id="formul">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-4">
                  <label >Usuario </label>
                  <input type="text" class="form-control" id="user" name="user" required value="<?php echo $user?>">
                </div>
                <div class="col-sm-4">
                  <label >Contraseña</label>
                  <input type="text" class="form-control" id="password" name="password" required value="<?php echo $password?>">
                </div>           
              </div>
              <input type="hidden" name="id" value="<?php echo $id?>">
              <input type="hidden" name="typeOp" value="1">
              <br>    
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php } 
include("components/footer.php");
?>