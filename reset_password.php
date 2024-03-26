<?php

require("db.php");

$token = $_GET["token"];
echo $token;

// $token_hash = hash("sha256", $token);

$db = new db();

// $condition = "reset_token_hash = '$token_hash'";
$condition = "reset_token_hash = '$token'";
$result = $db->get_data('forgetpassword', '*', $condition);

$user = $result->fetch(PDO::FETCH_ASSOC);

if ($user === false) {
    die("Token not found..");
}


if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Reset Password</h1>

    <form method="post" action="updated_password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Send</button>
    </form>

</body>
</html>
