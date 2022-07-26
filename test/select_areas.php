
<?php 
    include('../config/db.php');
    $DataBase = new db();
    if($_POST){
        if(!isset($_POST['area'])){
            echo 'efe';
            return;
        }
        foreach($_POST["area"] as $key => $value){
            echo "Seleccionaste ",$_POST['area'][$key].count($_POST['area']);
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
            function isChecked(int $id, int $id_announcement, int $action)
            {
                $DataBase = new db();
                switch ($action) {
                    case 1:
                        $consult = $DataBase->read_single_record_announcement_position($id_announcement);
                        break;
                    case 2:
                        $consult = $DataBase->read_single_record_announcement_charge($id_announcement);
                        break;
                    case 3:
                        $consult = $DataBase->read_single_record_announcement_area($id_announcement);
                        break;
                    default:
                        throw new Exception("Esa acción  no existe", 1);
                        break;
                }
                
                while ($row = mysqli_fetch_object($consult)) {
                    switch ($action) {
                        case 1:
                            $id_consult = intval($row->fk_position);
                            break;
                        case 2:
                            $id_consult = intval($row->fk_charge);
                            break;
                        case 3:
                            $id_consult = intval($row->fk_area);
                            break;
                    }
                  if($id_consult === $id){
                    return true;
                  }
                }
                return false;
            }
            $l_area = $DataBase->read_data_table('charges');
            
            while ($row = mysqli_fetch_object($l_area)) {
                $id = intval($row->id_charge); 
                $name = $row->t_name;
                ?>
                <input type="checkbox" name="area[]" <?php if(isChecked($id,1,2)){?> checked <?php } ?> value="<?php echo $id ?>" id="areas-<?php echo $id?>"><label for="areas-<?php echo $id?>"><?php echo $name ?></label><br>
                
        <?php }?>
                </div>
            </div>
        </div>
    </div>
    <input type="text" name="efe" >
        <button type="submit">registrar</button>
</form>
