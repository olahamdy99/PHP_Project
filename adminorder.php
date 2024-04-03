<?php
require("db.php");

try {
    $db = new db();

    $query = "SELECT o.*, u.name AS user_name FROM `order` o JOIN `users` u ON o.user_id = u.id";
    
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
    <div>
        <h1 class="alert bg-light text-center text-primary">Orders</h1>
    </div>
    <div style="padding:30px">
        <table class="table rounded table-hover mt-3">
            <thead class="bg-info">
                <tr>
                    <th>Order Date</th>
                    <th>User Name</th>
                    <th>Room</th>
                    <th>Ext.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $order_result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $order['date'] ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td><?= $order['room'] ?></td>
                        <td><?= $order['Ext'] ?></td>
                        <!-- Action column -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
