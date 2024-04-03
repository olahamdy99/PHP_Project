<?php
require("db.php");

$errors = [];

if (empty($_POST["name"])) {
    $errors['name'] = "Name is required";
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Valid email is required";
}

if (strlen($_POST["Password"]) < 8) {
    $errors['Password'] = "Password must be at least 8 characters";
}

if (!preg_match("/[a-z]/i", $_POST["Password"])) {
    $errors['Password'] = "Password must contain at least one letter";
}

if (!preg_match("/[0-9]/", $_POST["Password"])) {
    $errors['Password'] = "Password must contain at least one number";
}

if ($_POST["Password"] !== $_POST["confirm_Password"]) {
    $errors['confirm_Password'] = "Passwords must match";
}

if(count($errors) > 0) {
    header("Location: adduser1.php?errors=" . json_encode($errors));
    exit;
} 
$hash_password = password_hash($_POST["Password"], PASSWORD_DEFAULT);

$db = new db();

$from = $_FILES['user_img']['tmp_name'];
$img = $_FILES['user_img']['name'];
move_uploaded_file($from, "./img/".$img);

$table = 'users';
$cols = 'name, email, hash_password,room,Ext, picture'; 
$values = '?, ?, ?, ?,?,?'; 
$name = $_POST["name"];
$email = $_POST["email"];
$room = $_POST["room"];
$Ext = $_POST["Ext"];

$hash_password = $hash_password; 

$result = $db->insert_data($table, $cols, $values, [$name, $email, $hash_password,$room, $Ext,$img]); 

if ($result) {
    header("Location: users.html");
    exit;
} else {
    die("Failed to insert data");
}
?>
<?php include 'nav.php' ?>
