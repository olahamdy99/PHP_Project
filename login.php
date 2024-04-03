<?php
require("db.php");

$db = new db();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $email = $_POST['email'];
        $password = $_POST['Password'];

        $user = $db->get_data('users', "*", "`email`='$email'");

        if ($user && $user->rowCount() > 0) {
            $userData = $user->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $userData['hash_password'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['type_user'] = $userData['type_user'];

                if ($userData['type_user'] == 'admin') {
                    header("Location: adduser1.php");
                    exit;
                } elseif ($userData['type_user'] == 'user') {
                    header("Location: sucsses2.php");
                    exit;
                } else {
                    header("Location: login.php?error=1");
                    exit;
                }
            } else {
                header("Location: login.php?error=1");
                exit;
            }
        } else {
            header("Location: login.php?error=1");
            exit;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Login</title>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <h1>Cafeteria</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <a href="password_reset.php" class="btn btn-danger btn-block">Forgot Password</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_GET['error'])) {
    echo "<div class='container'><div class='alert alert-danger'>Email or password is incorrect</div></div>";
}
?>
