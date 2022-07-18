
<?php 
    include('../components/header.php');
    include('../config/db.php');
    $DataBase = new db();
    if($_POST){
        //Esto iria en los procedimientos de new y update
        foreach($_POST["area"] as $key => $value){
            if(count($_POST['area']) === 0)echo 'efe';
            echo "Seleccionaste ",$_POST['area'][$key];
        }
    }
?>

<form method="post">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Areas
                </button>
            </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
        <?php 
            $l_area = $DataBase->read_data_table('areas');
            while ($row = mysqli_fetch_object($l_area)) {
                $id = $row->id_area; 
                $name = $row->t_name?>
            
            <input type="checkbox" name="area[]" value="<?php echo $id ?>" id="areas-<?php echo $id?>"><label for="areas-<?php echo $id?>"><?php echo $name ?></label><br>
        <?php }?>
                </div>
            </div>
        </div>
    </div>
        <button type="submit">registrar</button>
</form>

<?php include('../components/footer.php'); ?>