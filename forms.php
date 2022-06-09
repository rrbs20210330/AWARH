<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>
<center><h2>Lista de Formularios</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrousuario">
  Nuevo Formulario
</button>
    <table class="table table-bordered"  id="userTable">
        <thead>
            <th>Activo</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>No. Preguntas</th>
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
                    <a class="btn btn-secondary btn-sm" href="process/updateStatus.php?id=<?php echo $id?>&table=forms&location=forms"><i class="bi bi-circle"></i></a>
                    <?php

                    }else{?>
                    <a class="btn btn-success btn-sm" href="process/updateStatus.php?id=<?php echo $id?>&table=forms&location=forms"><i class="bi bi-circle-fill"></i></a>
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
                    <?php echo $lastjoin ?>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarusuario" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&table=forms&location=forms"><i class="bi-trash"></i></a>
                    <a class="btn btn-primary btn-sm "href="employee.php?id=<?php echo $id?>"><i class="bi bi-eye"></i></a>
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
                <label for="">Nombre </label>
                <input type="text" class="form-control" id="name" name="name" required value="">
                </div>
                <div class="col-sm-4">
                <label for="">Descripcion</label>
                <input type="text" class="form-control" id="description" name="description" required>
                </div>   
                <div class="col-sm-4">
                <label for="">Añadir Pregunta</label>
                <a class="btn btn-secondary" onclick="questions();">+</a>
                </div>  
            </div>
            <div class="row" id="preguntas">

            </div>
            
            
            <input type="hidden" name="location" value="users">
            <input type="hidden" id="cantidadpreguntas">
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
include("components/footer.html");
?>
<script>
  var id = 0;
  function questions() {
    id = id + 1; 
    let usersList = document.getElementById("preguntas");
    var cad = '<label>Pregunta No '+ id+'</label><input type="text" class="form-control" id='+id+'>';
    usersList.innerHTML += cad;
    document.getElementById("cantidadpreguntas").value = id;
  }
  
</script>