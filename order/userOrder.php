<?php
include_once "../db.php";
$db = new db();
$getProduct = $db->get_data("product");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <link rel="stylesheet" href="./layout/css/style.css">
    <link rel="stylesheet" href="./layout/css/order.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <ul class="routes">
                <li><a href="./">index</a></li>
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
                <form action="admin/includes/create_order.php" method="POST" id="makeOrderForm">
                    <input type="hidden" name="user_id" id="user_id" value="18">
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
                            // Using PDO to fetch users
                            $users = $db->get_data("users");
                            foreach ($users as $position) {
                                echo '<option value="' . $position['room'] . '_' . $position['ext'] . '">' . $position['room'] . '_' . $position['ext'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

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

                <div id="orders" class="orders latestOrders">
                    <?php
                    // Using PDO to fetch latest orders
                    // $latestOrders = $db->get_data("order", "*", "user_id=18");
                    // foreach ($latestOrders as $order) {
                    //     $items = json_decode($order['product_items']);
                    //     foreach ($items as $item) {
                    //         echo '<div class="order" data-id="' . $item->id . '" data-name="' . $item->product . '" data-price="' . $item->price . '">';
                    //         echo '<div class="image">';
                    //         echo '<img src="./layout/images/menu/1.webp" alt="order 1">';
                    //         echo '</div>';
                    //         echo '<div class="price">EGP ' . $item->price . '</div>';
                    //         echo '</div>';
                    //     }
                    // }
                    // ?>
                </div>

                <h3>menu orders</h3>
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
</body>
<script src="./layout/js/script.js"></script>

</html>
