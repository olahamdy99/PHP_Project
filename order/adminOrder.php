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
                <form action="./admin/includes/create_userOrder.php" method="POST" id="makeOrderForm">
                    <input type="hidden" name="user_id" id="user_id" value="">
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

                <div class="select_user">
                    <label for="select_user_id">select user</label>
                    <select name="user_id" id="select_user_id">
                        <option value="-1"></option>
                        <option value="1">ola hamdy</option>
                        <option value="2">islam alsayed</option>
                        <option value="3">ahmed mohammed</option>
                    </select>
                </div>

                <div id="orders" class="orders">
                    <div class="order" data-id="1" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/1.webp" alt="order 1">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="2" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/2.webp" alt="order 2">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="3" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/3.webp" alt="order 3">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="4" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/4.webp" alt="order 4">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="5" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/5.webp" alt="order 5">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="6" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/6.webp" alt="order 6">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="7" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/7.webp" alt="order 7">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="8" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/8.webp" alt="order 8">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>

                    <div class="order" data-id="9" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/9.webp" alt="order 9">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>


                    <div class="order" data-id="10" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/10.webp" alt="order 10">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>
                    <div class="order" data-id="11" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/11.webp" alt="order 11">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>
                    <div class="order" data-id="12" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/12.webp" alt="order 12">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>
                    <div class="order" data-id="13" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/13.webp" alt="order 13">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>
                    <div class="order" data-id="14" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/14.webp" alt="order 14">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>
                    <div class="order" data-id="15" data-title="item example" data-price="14">
                        <div class="image">
                            <img src="./layout/images/menu/15.webp" alt="order 15">
                        </div>
                        <div class="price">EGP 14</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./layout/js/script.js"></script>

</html>