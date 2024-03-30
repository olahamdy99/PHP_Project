<?php
require ("db.php");
$db = new db();
try {

    $id = $_GET['id'];
    
    $db->delete_data("users", "id='$id'");
    header("Location:users.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
$connection = null
    ?>