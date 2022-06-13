<?php
include("components/header.php");
?>


<br/>
<button class="btn btn-success" onclick="functionUno()">Chargues</button>
<button class="btn btn-primary" onclick="functionDos()">Activities</button>
<button class="btn btn-dark" onclick="functionTres()">Positions</button>
<button class="btn btn-danger" onclick="functionCuatro()">Users</button>


<!-- DIV 1 CHARGUES --> 
<div id="div1" class="container-fluid">
    
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
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>"><i class="bi-trash"></i></a>
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

</div>


                             <!----------------- DIV 2 ACTIVITIES ------------------------> 
<div id="div2" class="container-fluid">


<center><h2>Lista de Actividades</h2></center>
<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
  Nueva Actividad
</button>
    <table class="table table-bordered" id="userTable">
        <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cargo</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $l_areas = $DataBase->read_data_table('activities');
                while ($row = mysqli_fetch_object($l_areas)) {
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
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarusuario" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>"><i class="bi-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Áreas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="process/newActivity.php">
        <div class="row">
            <div class="col-sm-4">
            <label for="">Nombre </label>
            <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-sm-4">
            <label for="">Descripción </label>
            <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="col-sm-4">
                <label>Cargo</label>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                    <option selected>Selecciona una área</option>
                    <?php     
                        $l_charges_select = $DataBase->read_data_table('charges');
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $id = $row->id;
                            $name = $row->name;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
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

</div>
                        <!----------------- DIV 3 POSITIONS ------------------------> 

<div id="div3" class="container-fluid">
<center><h2>Lista de Puestos</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3">
  Nuevo puesto
</button>
    <table class="table table-bordered" id="userTable">
        <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $DataBase = new db();
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
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarusuario" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>"><i class="bi-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Areas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post">
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

</div>
<div id="div4" class="container-fluid">
<label >TEST</label>
</div>


<script type="text/javascript">
    function functionUno() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");

        if (x.style.display == "none" || y.style.display=="block" || q.style.display=="block" || c.style.display=="block") {
            y.style.display = "none";
            x.style.display = "block";
            q.style.display = "none";
            c.style.display = "none"
        }
        else{
            x.style.display= "none";
        }
    }

    function functionDos() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");

        if (x.style.display == "block" || y.style.display=="none" || q.style.display=="block" || c.style.display=="block") {
            y.style.display = "block";
            x.style.display = "none";
            q.style.display = "none";
            c.style.display = "none";
        }
        else{
            y.style.display= "none";
        }
    }
    
    
    function functionTres() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");
        
        if (x.style.display == "block" || y.style.display=="block" || q.style.display=="none" || c.style.display=="block") {
            y.style.display = "none";
            q.style.display = "block";
            x.style.display = "none";
            c.style.display = "none"

        }
        else{
            q.style.display= "none";
        }
    }

    function functionCuatro() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");

        if (x.style.display == "block" || y.style.display=="block" || q.style.display=="block" || c.style.display=="none") {
            y.style.display = "none";
            x.style.display = "none";
            q.style.display = "none";
            c.style.display = "block";
        }
        else{
            c.style.display= "none";
        }
    }
    element = document.getElementById("div1");
    element2 = document.getElementById("div2");
    element3 = document.getElementById("div3");
    element4 = document.getElementById("div4");


    element.style.display = 'none';
    element2.style.display = 'none';
    element3.style.display = 'none';
    element4.style.display = 'none';
    
</script>



<?php
include("components/footer.php");
?>
