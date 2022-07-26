<?php include '../config/db.php';
$db = new db();
$res = $db->mysqli_query($db->con, 'SELECT * FROM users');
$return = $db->mysqli_fetch_object($res);
echo $res->t_password;