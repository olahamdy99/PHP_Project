<?php
require ("db.php");
$db = new db();
try {

    $id = $_GET['id'];

    $result = $db->get_data("users", '*', "id='$id'");

    $user = $result->fetch(PDO::FETCH_ASSOC);
    // var_dump($user);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Update User</title>
</head>
<style>
    .form-group label {
        margin-bottom: 0.5rem;
    }


    .p-2,
    .btn {
        margin-bottom: 0.5rem;
    }
</style>

<body>
<div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <h5 class="text-white h4">update </h5>
            <span class="text-muted">Welcome to update</span>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <br>
    <div class="container">

        <form action="updateUser.php" method="post" enctype="multipart/form-data">


            <div class="form-group">

                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                <label for="name">name</label>
                <input type="text" class="form-control p-2" id="name" name="name" value="<?php echo $user['name'] ?>">
                <?php
                if (isset($errors['name'])) {
                    echo $errors['name'];
                } ?>
            </div>

            <div class="form-group">
                <label for="room_no">Room Number</label>
                <input type="text" class="form-control p-2" id="room_no" name="room"
                    value="<?php echo $user['room'] ?>">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Exit</label>
                <input type="text" class="form-control p-2" id="ext" name="ext" value="<?php echo $user['ext'] ?>">
            </div>
<br>
            <div class="form-group">
                <label for="exampleFormControlFile1">Profile Picture</label>
                <input type="file" class="form-control-file" id="user_img" name="user_img">
            </div>
<br>


            <button type="submit" class="btn btn-primary btn-block">Update User</button>
            <button type="reset" class="btn btn-danger btn-block">Reset</button>
        </form>
    </div>

</body>
<script src="bootstrap.js"></script>

</html>