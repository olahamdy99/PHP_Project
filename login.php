<?php
require("db.php");

// Instantiate the database connection
$db = new db();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Get the email and password from the form
        $email = $_POST['email'];
        $password = $_POST['Password'];

        // Fetch user data from the database based on the provided email
        $user = $db->get_data('users', "*", "`email`='$email'");

        // If user data is found
        if ($user && $user->rowCount() > 0) {
            // Fetch user data as an associative array
            $userData = $user->fetch(PDO::FETCH_ASSOC);
            // Get the hashed password from the user data
            $hashedPassword = $userData['hash_password'];

            // Verify the provided password against the hashed password
            if (password_verify($password, $hashedPassword)) {
                // Redirect to success page if login is successful
                header("Location: success.html");
                exit;
            } else {
                // Redirect to login page with error message if password is incorrect
                header("Location: login.php?error=1");
                exit;
            }
        } else {
            // Redirect to login page with error message if user does not exist
            header("Location: login.php?error=1");
            exit;
        }
    } catch (PDOException $e) {
        // Handle database errors
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
