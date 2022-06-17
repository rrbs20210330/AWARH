<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>

<center><h2>Lista de Candidatos</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrocandidato">
  Nuevo Candidato
</button>
    <table class="table table-striped table-bordered userTable">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Telefono</th>
                <th>Correo Electronico</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $candidates = $DataBase->read_data_table('candidate');
                while ($row = mysqli_fetch_object($candidates)) {
                    $id = $row->id;
                    $name =$row->name;
                    $email = $row->email;
                    $phone_number = $row->phone_number;
            ?>
            <tr>
                <td>
                    <?php echo $name ?>
                </td>
                <td>
                    <?php echo $phone_number ?>
                </td>
                <td>
                    <?php echo $email ?>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditCandidate-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&typeOp=6"><i class="bi-trash"></i></a>
                    <a class="btn btn-primary btn-sm "href="candidate.php?id=<?php echo $id?>"><i class="bi bi-eye"></i></a>
                </td>
            </tr>  
            <?php }?>
        </tbody>
    </table>
</div>

<!-- FORMULARIO DE REGISTRO DE CANDIDATO -->
<div class="modal fade" id="registrocandidato" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo de Candidato</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form method="post" action="process/new.php" id="formul">
          <center><label for="">Informacion General</label></center>
            <div class="row">
                
                <div class="col-sm-4">
                <label>Nombre Completo </label>
                <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-sm-4">
                <label >Telefono</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" required>
                </div>    
                <div class="col-sm-4">
                <label >Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-sm-4">
                <label >Fecha de Cita</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                </div>
                <div class="col-sm-4">
                <label >Posicion de la solicitud</label>
                <select class="form-select" aria-label="Default select example" id="request_position" name="request_position">
                        <option >Selecciona una Posición</option>
                        <?php     
                            $l_charges_select = $DataBase->read_data_table('positions');
                            while ($row = mysqli_fetch_object($l_charges_select)) {
                                $idc = $row->id;
                                $namec = $row->name;
                                ?>
                        <option value="<?php echo $idc ?>"  ><?php echo $namec ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                <label >Perfil</label>
                <input type="text" class="form-control" id="perfil" name="perfil" required>
                </div>
                <div class="col-sm-4">
                <label>CV</label>
                <input type="file" class="form-control" id="id_cv" name="id_cv" required>
                </div>
            </div>
            <input type="hidden" name="typeOp" value="9">
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
    $candidates = $DataBase->read_data_table('candidate');
    while ($candidate = mysqli_fetch_object($candidates)){
        $id = $candidate->id;
        $id_cv = $candidate->id_cv;
        $name = $candidate->name;
        $phone_number = $candidate->phone_number;
        $email = $candidate->email;
        $appointment_date = $candidate->appointment_date;
        $request_position = $candidate->request_position;
        $perfil  = $candidate->perfil;
?>
    <!-- FORMULARIO DE EDICION DE CANDIDATO -->
    <div class="modal fade" id="EditCandidate-<?php echo $id ?>" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edición<nav></nav> de Candidato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="process/update.php" id="formul">
            <center><label for="">Informacion General</label></center>
            <div class="row">
                
                <div class="col-sm-4">
                <label>Nombre Completo </label>
                <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name?>">
                </div>
                <div class="col-sm-4">
                <label >Telefono</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" required value="<?php echo $phone_number?>">
                </div>    
                <div class="col-sm-4">
                <label >Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email?>">
                </div>
                <div class="col-sm-4">
                <label >Fecha de Cita</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" required value="<?php echo $appointment_date?>">
                </div>
                <div class="col-sm-4">
                <label >Posicion de la solicitud</label>
                <select class="form-select" aria-label="Default select example" id="request_position" name="request_position" >
                        <option >Selecciona una posición</option>
                        <?php     
                            $l_charges_select = $DataBase->read_data_table('positions');
                            while ($row = mysqli_fetch_object($l_charges_select)) {
                                $idc = $row->id;
                                $namec = $row->name;
                                ?>
                        <option value="<?php echo $idc ?>" <?php if($idc === $request_position){ ?> selected <?php } ?>><?php echo $namec ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                <label >Perfil</label>
                <input type="text" class="form-control" id="perfil" name="perfil" required value="<?php echo $perfil?>">
                </div>
    </div>
                <input type="hidden" name="typeOp" value="7">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <br>    
            </div>
            <div class="modal-footer">
                
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
            </form>
            </div>
        </div>
    </div>    
<?php }
include("components/footer.php");
?>

