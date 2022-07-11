<?php
include('config/db.php');
include("components/header.php");

$DataBase = new db();
if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>

<center><h2>Lista de Candidatos</h2></center>

<div class="container">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registrocandidato">
        Nuevo Candidato
    </button>
    <br>
    <br>
    <table class="table table-striped table-bordered userTable" style='background: #00252e '>
        <thead style="color: white">
            <tr>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Fecha de Cita</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $candidates = $DataBase->read_data_table('candidates');
                while ($row = mysqli_fetch_object($candidates)) {
                    $id = $row->id_candidate;
                    $name =$row->t_name;
                    $email = $row->t_email;
                    $phone_number = $row->t_phone_number;
                    $appointment_date = $row->dt_appointment_date;
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
                    <?php echo $appointment_date ?>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditCandidate-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#DeleteCandidate-<?php echo $id ?>" ><i class="bi-trash"></i></a>
                    <a class="btn btn-dark btn-sm " data-bs-toggle="modal" data-bs-target="#SeeInfoCandidate-<?php echo $id?>"><i class="bi bi-eye"></i></a>
                </td>
            </tr>  
            <?php }?>
        </tbody>
    </table>
</div>

<!-- FORMULARIO DE REGISTRO DE CANDIDATO -->
<div class="modal fade" id="registrocandidato" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo de Candidato</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="post" id="formul" enctype="multipart/form-data">
            <div class="modal-body">
                <center><label for="">Información General</label></center>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Nombre Completo </label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-sm-6">
                        <label >Teléfono</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" required min="1111111111" onkeypress="return verificaNumeros(event);" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>    
                    <div class="col-sm-6">
                        <label >Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-sm-6">
                        <label >Fecha y Hora de Cita</label>
                        <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>
                    <div class="col-sm-12">
                        <label >Puesto solicitado</label>
                        <select class="form-select" aria-label="Default select example" id="request_position" name="request_position" required>
                        <?php     
                            $l_positions_select = $DataBase->read_data_table('positions');
                            if(mysqli_num_rows($l_positions_select) === 0 ) { ?>
                            <option selected disabled value="">Necesitas crear un puesto primero</option>
                            <?php } else { ?> <option selected disabled value="">Selecciona una Puesto</option><?php } ?>
                            <?php 
                            while ($row = mysqli_fetch_object($l_positions_select)) {
                                $idc = $row->id_position;
                                $namec = $row->t_name;
                                ?>
                            <option value="<?php echo $idc ?>"  ><?php echo $namec ?></option>
                            <?php } ?>
                            
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label >Perfil</label>
                        <textarea class="form-control" id="perfil" name="perfil" required rows="1"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <label>CV</label>
                        <input type="file" class="form-control" id="archivo[]" name="archivo[]" required>
                    </div>
                    
                </div>
                <input type="hidden" name="typeOp" value="9">
                <input type="hidden" name="new" value="1">
                <br>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" onclick="confirmSave()">Registrar</button>
            </div>
          </form>
        </div>
    </div>
</div>

<?php 
    $candidates = $DataBase->read_data_table('candidates');
    while ($candidate = mysqli_fetch_object($candidates)){
        $id = $candidate->id_candidate;
        $id_cv = $candidate->fk_cv;
        $name = $candidate->t_name;
        $phone_number = $candidate->t_phone_number;
        $email = $candidate->t_email;
        $appointment_date = $candidate->dt_appointment_date;
        $request_position = $DataBase->read_single_record_candidates_position($id) ? $DataBase->read_single_record_candidates_position($id)->fk_position : 0;
        $perfil  = $candidate->t_profile;
?>
    <!-- FORMULARIO DE EDICION DE CANDIDATO -->
    <div class="modal fade" id="EditCandidate-<?php echo $id ?>" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Candidato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formul">
                <div class="modal-body">
                    <center><label for="">Información General</label></center>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Nombre Completo </label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name?>">
                        </div>
                        <div class="col-sm-6">
                            <label >Teléfono</label>
                            <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number?>" min="1111111111" onkeypress="return verificaNumeros(event);" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>  
                        <div class="col-sm-6">
                            <label >Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>">
                        </div>
                        <div class="col-sm-6">
                            <label >Fecha y Hora de Cita</label>
                            <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $appointment_date?>">
                        </div>  
                        <div class="col-sm-12">
                            <label >Puesto Solicitado</label>
                            <select class="form-select" aria-label="Default select example" id="request_position" name="request_position" required>
                                <?php     
                                    $l_positions_select = $DataBase->read_data_table('positions');
                                    if(mysqli_num_rows($l_positions_select) === 0 ) { ?>
                                    <option selected disabled value="">Necesitas crear un puesto primero</option>
                                    <?php } else { ?> <option <?php if(intval($request_position) === 0){?> selected <?php }?> disabled value="">Selecciona una Puesto</option><?php } ?>
                                    <?php 
                                    while ($row = mysqli_fetch_object($l_positions_select)) {
                                        $idc = $row->id_position;
                                        $namec = $row->t_name;
                                        ?>
                                <option value="<?php echo $idc ?>" <?php if($idc === $request_position){ ?> selected <?php } ?>><?php echo $namec ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label >Perfil</label>
                            <textarea class="form-control" id="perfil" name="perfil" rows="1"><?php echo $perfil?></textarea>
                        </div>
                        <div class="col-sm-12">
                            <label>CV</label>
                            <input type="file" disabled class="form-control" id="archivo[]" name="archivo[]" data-bs-toggle="tooltip" data-bs-placement="top" title="No se puede editar el archivo">
                        </div>
                        
                        <input type="hidden" name="typeOp" value="7">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="update" value="1">
                        <br>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="confirmSave()">Editar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php 
  $l_candidates = $DataBase->read_data_table('candidates');
  while ($row = mysqli_fetch_object($l_candidates)) {
    $id = $row->id_candidate;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteCandidate-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
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
            <input type="hidden" name="typeOp" id="typeOp" value="6">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php 
  $l_candidates = $DataBase->read_data_table('candidates');
  while ($row = mysqli_fetch_object($l_candidates)) {
    $id = $row->id_candidate;
    $candidate = $DataBase->read_single_record_candidates($id);
    $id_cv = $candidate->fk_cv;
    $name = $candidate->t_name;
    $phone_number = $candidate->t_phone_number;
    $email = $candidate->t_email;
    $appointment_date = $candidate->dt_appointment_date;
    $request_position_id = $DataBase->read_single_record_candidates_position($id) ? $DataBase->read_single_record_candidates_position($id)->fk_position : 0;
    $request_position_name = $DataBase->read_single_record_position($request_position_id) ? $DataBase->read_single_record_position($request_position_id)->t_name : "No seleccionado";
    $perfil  = $candidate->t_profile;

    $path_cv = $DataBase->read_single_record_files($id_cv)->t_path;
?>
  <!-- Modal See Info-->
  <div class="modal fade" id="SeeInfoCandidate-<?php echo $id ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Información General</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Nombre Completo: <?php echo $name?><br>
            Email: <?php echo $email ?><br>
            Telefono: <?php echo $phone_number ?><br>
            Puesto a ocupar: <?php echo $request_position_name?><br>
            Fecha de Cita: <?php echo $appointment_date?><br>
            Perfil: <?php echo $perfil?><br>
            CV: <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_cv ?>" target="_blank">Click Aqui</a> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<script>
  function verificaNumeros(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}
var elemento = document.getElementById('candidate_list');
elemento.classList.add("active");
  </script>
  
<?php
include("components/footer.php");
?>

