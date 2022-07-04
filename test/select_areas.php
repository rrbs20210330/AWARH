<?php 
    include('../config/db.php');
    $DataBase = new db();
    if($_POST){
        foreach($_POST["area"] as $key => $value){
            echo "Seleccionaste ",$_POST['area'][$key];
        }
    }
?>

<form method="post">
    <?php 
        $l_area = $DataBase->read_data_table('areas');
        while ($row = mysqli_fetch_object($l_area)) {
        $id = $row->id_area; 
        $name = $row->t_name?>
            <label for="areas-<?php echo $id?>"><?php echo $name ?></label>
            <input type="checkbox" name="area[]" value="<?php echo $id ?>" id="areas-<?php echo $id?>">
        <?php }?>
        <button type="submit">registrar</button>
</form>