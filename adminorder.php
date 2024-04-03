<?php
require("db.php");

if ($_SESSION['type_user'] != 'admin') {
    header("Location: login.php"); 
    exit;
}
function deleteOrderAndDetails($orderId, $db) {
    // Update the order status to 'done'
    $db->update_data("order_details", "status='done'", "order_id='$orderId'");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["orderId"])) {
    $orderId = $_POST["orderId"];
    deleteOrderAndDetails($orderId, new db());
}

try {
    $db = new db();

    $query = "SELECT o.*, u.name AS user_name, od.total AS order_total 
              FROM `order` o 
              JOIN `users` u ON o.user_id = u.id
              JOIN `order_details` od ON o.id = od.order_id 
              WHERE od.status != 'done'
              GROUP BY o.id";
    
    $order_result = $db->getConnection()->query($query);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
</head>
<style>
    .form-group label {
        margin-bottom: 0.5rem; 
    }

    h1 {
        padding: 2rem;
        background: blanchedalmond;
        display: flex;
        justify-content: center;
    }

    .p-2,
    .btn {
        margin-bottom: 0.5rem;
    }
</style>
<body>
<?php include 'nav.php' ?>

<div class ="container">

    <div style="padding:30px">
        <table class="table rounded table-hover mt-3">
            <thead class="bg-info">
                <tr>
                    <th>Order Date</th>
                    <th>User Name</th>
                    <th>Room</th>
                    <th>Ext.</th>
                    <th>Details</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $order_result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr id="order_<?= $order['id'] ?>">
                        <td><?= $order['date'] ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td><?= $order['room'] ?></td>
                        <td><?= $order['Ext'] ?></td>
                        <td><?= $order['product_items'] ?></td>
                        <td><?= $order['order_total'] ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
                                <button type="submit">delevery</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    </div>

</body>
</html>
