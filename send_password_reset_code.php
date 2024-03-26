<?php
require("db.php");
$db = new db();

$email = $_POST["email"];
$condition = "email = '$email'";

$check= $db->get_data('users', '*', $condition);
$user = $check->fetch(PDO::FETCH_ASSOC);

if ($user){
$user_id=$user['id'];
echo"$user_id";

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 5);



$data = "reset_token_hash = '$token_hash', reset_token_expires_at = '$expiry', user_id = '$user_id'";
// $data = "reset_token_hash = '$token', reset_token_expires_at = '$expiry', user_id = '$user_id'";

$cols='reset_token_hash,reset_token_expires_at,user_id';
$values='?,?,?';
$condition1="user_id='$user_id'";
$check1= $db->get_data('forgetpassword', '*', $condition1);
$id = $check1->fetch(PDO::FETCH_ASSOC);
if($id)
{

$result = $db->update_data('forgetpassword', $data , $condition1);

}
else{
    
$result = $db->insert_data('forgetpassword', $cols, $values, [$token_hash, $expiry, $user_id]); 
// $result = $db->insert_data('forgetpassword', $cols, $values, [$token, $expiry, $user_id]); 

}

if ($result) {
    $mail = require("mailer.php");
    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
    Click <a href="http://localhost/phpp/PHP_Project/reset_password.php?token=$token">here</a> 
    to reset your password.
    END;

    try {

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}

echo "Message sent, please check your inbox.";}
else{
    echo "email not found.";
}
?>
