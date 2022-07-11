<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>
<center><h2>Lista de usuarios</h2></center>

<div class="container">
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registrousuario">
    Nuevo Usuario
  </button>
  <br>
    <br>
  <table class="table table-striped table-bordered userTable"  style='background: #00252e '>
    <thead style="color: white">
        <th>Estado</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Tipo</th>
        <th>Última entrada</th>
        <th></th>
    </thead>
    <tbody>
      <?php 
          $l_users = $DataBase->read_data_table('users');
          while ($row = mysqli_fetch_object($l_users)) {
              $id = $row->id_user;
              $active = $row->b_active;
              $user = $row->t_user;
              $password = $row->t_password;
              $type = $row->i_type;
              $lastjoin = $row->dt_last_join;
      ?>
      <tr>
          <td>
              <form method="post">
                <input type="hidden" name="update" value="1">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="typeOp" value="13">
              <?php if ($active == 0){?>
                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-eye-slash-fill"></i></button>
              <?php }else{?>
                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i></button>
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
            <?php if(intval($type) === 1){echo "Admin";} else {echo "Empleado";}  ?>
          </td>
          <td>
              <?php if($lastjoin){
                echo $lastjoin;
              }else{
                echo "No se ha iniciado sesión con este usuario";
              } ?>
          </td>
          <td>
              <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditUser-<?php echo $id?>"><i class="bi bi-pencil-square"></i></a>
              <button class="btn btn-danger btn-sm " <?php if(intval($type) === 2){ ?> disabled <?php }else if($id === $id_usuario){ ?> disabled <?php } else{ ?> data-bs-toggle="modal" data-bs-target="#DeleteUser-<?php echo $id?>" <?php } ?>><i class="bi-trash"></i></button>
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
      <form  method="post" id="formul">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <label for="user">Usuario </label>
              <input type="text" class="form-control" id="user" name="user" required value="">
            </div>
            <div class="col-sm-6">
              <label for="password">Contraseña</label>
              <input type="text" class="form-control" id="password" name="password" required>
            </div>          
          </div>
          <input type="hidden" name="typeOp" value="1">
          <input type="hidden" name="new" value="1">
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
    $id = $row->id_user;
    $active = $row->b_active;
    $user = $row->t_user;
    $password = $row->t_password;
    $tipo = $row->i_type;
?>
    <div class="modal fade" id="EditUser-<?php echo $id?>" tabindex="-1"  aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edicion de Usuario Administrador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="post" id="formul">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-4">
                  <label >Usuario </label>
                  <input type="text" class="form-control" id="user" name="user" <?php if($tipo === 2){ ?> disabled <?php }?> value="<?php echo $user?>">
                </div>
                <div class="col-sm-4">
                  <label >Contraseña</label>
                  <input type="text" class="form-control" id="password" name="password" required value="<?php echo $password?>">
                </div>           
              </div>
              <input type="hidden" name="id" value="<?php echo $id?>">
              <input type="hidden" name="typeOp" value="1">
              <input type="hidden" name="update" value="1">
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
?>


<?php 
  $l_charges = $DataBase->read_data_table('users');
  while ($row = mysqli_fetch_object($l_charges)) {
    $id = $row->id_user;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteUser-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <input type="hidden" name="typeOp" id="typeOp" value="1">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<script>
  var elemento = document.getElementById('user_list');
elemento.classList.add("active");
var elemento = document.getElementById('config_list');
elemento.classList.add("active");
</script>
<?php
include("components/footer.php");
?>