<?php
include("components/header.php");
?>


<?php 
    include('config/db.php');
    $DataBase = new db();
    if(isset($_POST) && !empty($_POST)){
        $name = $DataBase->sanitize($_POST['name']);
        $description = $DataBase->sanitize($_POST['description']);
        $res = $DataBase->insert_t_charges($name, $description);

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

<center><h2>Lista de cargos</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Nueva cargo
</button>

    <table class="table table-bordered" id="userTable">
        <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th># ACtividades</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $DataBase = new db();
                $l_charges = $DataBase->read_all_charges();
                while ($row = mysqli_fetch_object($l_charges)) {
                    $id = $row->chargeID;
                    $cons =  $DataBase->num_activities_carge($id);
                    $num = $cons->numActCh;
                    $nombre = $row->chargeName;
                    $description = $row->chargeDesc;
                    
            ?>
            <tr>
                <td>
                    <?php echo $nombre ?>
                </td>
                <td>
                    <?php echo $description ?>
                </td>
                <td>
                    <?php echo $num; ?>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarusuario" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/deleteCharge.php?id=<?php echo $id?>"><i class="bi-trash"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Registro de cargos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
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
include("components/footer.html");
?>
