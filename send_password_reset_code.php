<?php
require("db.php");

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$db = new db();

$data = "reset_token_hash = '$token_hash', reset_token_expires_at = '$expiry'";

$condition = "email = '$email'";

$result = $db->update_data('users', $data, $condition);

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

echo "Message sent, please check your inbox.";
?>
