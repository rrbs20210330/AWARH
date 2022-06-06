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
                    <?php echo $lastjoin ?>
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



<?php
include("components/footer.php");
?>