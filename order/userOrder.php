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
    <link rel="stylesheet" href="../assets/css/stylee.css">
    <link rel="stylesheet" href="../assets/css/order.css">
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
                <form action="" method="POST" id="makeOrderForm">
                    <input disabled type="hidden" name="user_id" id="user_id" value="1">
                    <input disabled type="hidden" name="items[]" id="items">
                    <div id="itemsContainer" class="items"></div>

                    <div class="notes">
                        <label for="notes">notes</label>
                        <textarea name="notes" id="notes" class="notes"></textarea>
                    </div>

                    <div class="room">
                        <label for="room">room</label>
                        <select name="room" id="room">
                            <option value="-1"></option>
                            <option value="r_1">room 1</option>
                            <option value="r_2">room 2</option>
                        </select>
                    </div>

                    <div class="total">EGP ..</div>

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
                <?php  
                if ($getProduct && $getProduct->rowCount() > 0) {
                    echo '<div id="orders" class="orders">';
                    while ($product = $getProduct->fetch(PDO::FETCH_ASSOC)) {
                        $name_test = $product['name'];
                        echo "
                        <div class='order proItem' data-name='{$product['name']}' data-price='{$product['price']}'>

                            <div class='image'>
                                <img src='../uploads/{$product['image']}' alt='{$product['name']}'>
                            </div>
                            <div class='price'>{$product['price']} EGP</div>
                            <div class='product_name'>{$product['name']}</div>
                        </div>";
                    }
                    echo '</div>';
                }
                ?>

                
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/script.js"></script>

</html>