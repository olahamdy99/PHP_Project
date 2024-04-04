<?php
include_once "../db.php"; // Include the database connection file
$db = new db(); // Create a new instance of the db class
$getProduct = $db->get_data("product");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Page</title>
    <link rel="stylesheet" href="./layout/css/style.css">
    <link rel="stylesheet" href="./layout/css/order.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <ul class="routes">
                <li><a href="./">home</a></li>
                <li><a href="./userOrder.php">user orders</a></li>
                <li><a href="./adminOrder.php">admin orders</a></li>
            </ul>

            <div class="profile">
                <div class="image">
                    <img src="./layout/images/user.jpg" alt="profile image">
                </div>
                <div class="name">islam asker</div>
            </div>
        </header>

        <div class="wrapper">
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
</body>

</html>
