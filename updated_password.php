<?php

require("db.php");

$token = $_POST["token"];
$password = $_POST["password"];
$passwordConfirmation = $_POST["password_confirmation"];

if ($password !== $passwordConfirmation) {
    die("Passwords must match");
}

// $token_hash = hash("sha256", $token);
$token_hash =$token ;
$db = new db();

$sql = "SELECT * FROM forgetpassword WHERE reset_token_hash = :token_hash";
$stmt = $db->getConnection()->prepare($sql);
$stmt->bindParam(":token_hash", $token_hash);
$stmt->execute(); 
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result === false) {
    die("Token not found");
}

// Check if token has expired
if (strtotime($result["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

// Validate password strength
if (strlen($password) < 8 || !preg_match("/[a-z]/i", $password) || !preg_match("/[0-9]/", $password)) {
    die("Password must be at least 8 characters and contain at least one letter and one number");
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$data = "hash_password = :password";
$condition = "id = :id";

$stmt = $db->getConnection()->prepare("UPDATE users SET $data WHERE $condition");
$stmt->bindValue(":password", $password_hash);
$stmt->bindValue(":id", $result["user_id"]);

if ($stmt->execute()) {
    echo "Password updated. You can now login.";
} else {
    echo "Failed to update password";
}

?>
