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
    <table class="table table-bordered"  id="userTable">
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
                    <?php if ($active == 0){
                      ?>
                    <a class="btn btn-secondary btn-sm" href="process/updateStatus.php?id=<?php echo $id?>&status=0&table=users&location=users"><i class="bi bi-circle"></i></a>
                    <?php

                    }else{?>
                    <a class="btn btn-success btn-sm" href="process/updateStatus.php?id=<?php echo $id?>&status=1&table=users&location=users"><i class="bi bi-circle-fill"></i></a>
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
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarusuario" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&table=users&location=users"><i class="bi-trash"></i></a>
                </td>
            </tr>  
            <?php }?>
        </tbody>
    </table>
</div>

<!-- FORMULARIO DE REGISTRO DE USUARIOS -->
<div class="modal fade" id="registrousuario" tabindex="-1"  aria-hidden="true">
    <?php ?>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Formulario de registro de Usuarios Administradores</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="process/newUser.php" method="post" id="formul">
            <div class="row">
                <div class="col-sm-4">
                <label for="">Usuario </label>
                <input type="text" class="form-control" id="user" name="user" required value="">
                </div>
                <div class="col-sm-4">
                <label for="">Contraseña</label>
                <input type="text" class="form-control" id="password" name="password" required>
                </div>           
            </div>
            <input type="hidden" name="location" value="users">
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

<div class="modal fade" id="editarusuario" tabindex="-1" aria-hidden="true">
  
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edicion de Usuario Administrador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form>
            <div class="row">
                <div class="col-sm-4">
                <label for="">Usuario </label>
                <input type="text" class="form-control" id="user" name="user" required>
                </div>
                <div class="col-sm-4">
                <label for="">Contraseña</label>
                <input type="text" class="form-control" id="password" name="password" required>
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

