<?php
try {
    require ("db.php");
    $db = new db();
    $id = $_POST['id'];
    echo $id;
    var_dump($id);
    $from = $_FILES["user_img"]["tmp_name"];
    $img = $_FILES["user_img"]["name"];
    move_uploaded_file($from, "./img/" . $img);

    $db->update_data("users", "name='{$_POST['name']}', room='{$_POST['room']}', ext='{$_POST['ext']}',picture='{$img}'", "id='$id'");

    header("Location:users.php");
    exit();

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>