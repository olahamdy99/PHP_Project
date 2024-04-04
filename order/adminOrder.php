<?php
include_once "../db.php"; // Include the database connection file
$db = new db(); // Create a new instance of the db class
$getProduct = $db->get_data("product");


if ($_SESSION['type_user'] != 'admin') {
    header("Location: ../login.php"); 
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Page</title>
    <link rel="stylesheet" href="./layout/css/style.css">
    <link rel="stylesheet" href="./layout/css/order.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   
</head>

<body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../product.php" aria-current="page">Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="..products.php">All Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../adduser1.php">Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../users.php">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../adminorder.php">adminorder</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../checks.php">Checks</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center ps-3 pe-3">
                    <img src="profile-image.jpg" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px;">
                    <span class="ms-2">User Name</span>
                </div>
            </div>
        </nav>

        <?php
        if (isset($_SESSION['msg_order'])) {
            echo "<div class='alert alert-success'>{$_SESSION['msg_order']}</div>";
            unset($_SESSION['msg_order']);
        }
        ?>

        <div class="wrapper container mt-5 ">
            <div class="cart">
                <form action="./admin/includes/create_order.php?role=admin" method="POST" id="makeOrderForm">
                    <label id="error_items" class="error items"></label>
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="items[]" id="items">
                    <div id="itemsContainer" class="items"></div>

                    <div class="notes">
                        <label for="notes">notes</label>
                        <textarea name="notes" id="notes" class="notes"></textarea>
                    </div>

                    <div class="room">
                        <label for="room">room</label>
                        <select name="room" id="room">
                            <option value="-1"></option>
                            <?php
                            // Prepare and execute the query using PDO
                            $query = "SELECT * FROM `users`";
                            $statement = $db->getConnection()->prepare($query);
                            $statement->execute();

                            // Fetch users from the database using PDO
                            $users = $statement->fetchAll(PDO::FETCH_ASSOC);

                            // Loop through the fetched users to populate the select options
                            foreach ($users as $user) {
                                echo '<option value="' . $user['room'] . '_' . $user['ext'] . '">' . $user['room'] . '_' . $user['ext'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <label id="error_room" class="error error_room"></label>

                    <div class="total">EGP <span id="allTitle">0</span></div>

                    <div class="confirm">
                        <button name="create_order" type="submit" id="confirm">confirm</button>
                    </div>
                </form>
            </div>

            <div class="menu">
                <div class="head">
                    <h3>latest orders</h3>

                    <div class="search">
                        <input type="search" placeholder="search...">
                    </div>
                </div>

                <div class="select_user">
                    <label for="select_user_id">select user</label>

                    <select name="user_id" id="select_user_id">
                        <option value="-1"></option>
                        <?php
                        // Loop through the fetched users to populate the select options
                        foreach ($users as $user) {
                            echo '<option value="' . $user['id'] . '">' . $user['name'] . '</option>';
                        }
                        ?>
                    </select>
                    <label id="error_user" class="error"></label>
                </div>

                <div id="orders" class="orders">
                    <?php
                    // Using PDO to fetch menu orders
                    $menuOrders = $db->get_data("product");
                    foreach ($menuOrders as $order) {
                        echo '<div class="order" data-id="' . $order['id'] . '" data-name="' . $order['name'] . '" data-price="' . $order['price'] . '">';
                        echo '<div class="image">';
                        echo '<img src="../uploads/' . $order['image'] . '" alt="' . $order['name'] . '">';
                        echo '</div>';
                        echo '<div class="price">EGP ' . $order['price'] . '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="./layout/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
