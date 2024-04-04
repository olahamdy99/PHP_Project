<?php
include_once "../db.php";
$db = new db();

if ($_SESSION['type_user'] != 'user') {
    header("Location: ../login.php"); 
    exit;
}

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
                            <a class="nav-link" href="../orderUser.php" aria-current="page">order</a>
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

    <div class="container">
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
                    $latestOrders = $db->get_data("order", "*", "user_id=".$_SESSION['user_id']);
                    // foreach ($latestOrders as $order) {
                    //     $items = json_decode($order['product_items']);
                    //     foreach ($items as $item) {
                    //         echo '<div class="order" data-id="' . $item->id . '" data-name="' . $item->product . '" data-price="' . $item->price . '">';
                    //         echo '<div class="image">';
                    //         echo '<img src="./layout/" alt="order 1">';
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</html>
