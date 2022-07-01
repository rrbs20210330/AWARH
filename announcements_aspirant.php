<?php
include("components/header-user.php");
include('config/db.php');
$DataBase = new db();
?>

<center><h1>Tus Convocatorias</h1></center>

  <br>

  <div class="container">

  <br>
  <?php $l_annoucements = $DataBase->read_data_table('announcements');
      if(mysqli_num_rows($l_annoucements) === 0) {?> <center><h3>Aún no hay ninguna convocatoria disponible para ti.</h3></center> <?php } ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php 
      while ($row = mysqli_fetch_object($l_annoucements)) {
        $id = $row->id_announcement;
        $name = $row->t_name;
        $description = $row->t_description;
        $active = $row->b_active;
        if($active){
    ?>
      <div class="col">
        <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
          <div class="card-header">
            <center>
              <a href="announcement.php?id=<?php echo $id ?>">
                <i class="fa-5x bi bi-file-earmark-text-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Click para ver."></i>
              </a>
            </center>
            <br>
            <h5 class="card-title"><strong><?php echo $name ?></strong></h5>
          </div>
          <div class="card-body">
            <p class="card-text"><?php echo $description ?></p>
          </div>
        </div>     
      </div>
    <?php } }?>                
</div>

<?php 
include("components/footer.php");
?>

