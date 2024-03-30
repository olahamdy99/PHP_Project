<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
</head>

<body>

    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <h5 class="text-white h4">Collapsed content</h5>
            <span class="text-muted">Toggleable via the navbar brand.</span>
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
        <div class="row">
            <div class="col">
                <h2>All Users</h2>
            </div>
            <div class="col-auto">
                <a href="adduser1.php" class="btn btn-primary">Add User</a>
            </div>
        </div>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Exit</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require ("db.php");
                $db = new db();
                $result = $db->get_data("users");

                while ($user = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    foreach ($user as $key => $value) {

    
                        if ($key == "name") {
                            echo "<td>$value</td>";
                        } if ($key == "room") {
                            echo "<td>$value</td>";
                        }
                        if ($key == "picture") {
                            echo "<td><img src='./img/$value' width=100 height=100 ></td>";
                        }
                     if ($key == "ext") {
                        
                        echo "<td>$value</td>";
                    }

                       
                    }
                    echo "<td>
        <a href='editUser.php?id={$user['id']}'>Edit</a>
        
        <a href='deleteUser.php?id={$user['id']}'>Delete</a>
    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Exit</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js"></script>
</body>

</html>