<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_order'])) {

        $user_id = $_POST['user_id'];
        $product_items = $_POST['items'][0];
        $notes = $_POST['notes'];
        $ext = explode('_', $_POST['room'])[0];
        $room = explode('_', $_POST['room'])[1];

        $total = 0;
        foreach (json_decode($product_items) as $item)  $total += $item->quantity * $item->price;

        // echo $total;

        $stmt = $conn->prepare("INSERT INTO `order` (date, product_items, room, Ext, note, user_id)
                                VALUES (:date, :product_items, :room, :Ext, :note, :user_id)");

        // Execute the statement
        $stmt->execute([
            'date' => date("Y-m-d H:i:s"),
            'product_items' => $product_items,
            'room' => $room,
            'Ext' => $ext,
            'note' => $notes,
            'user_id' => $user_id,
        ]);

        $order_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO `order_details` (total,order_id)VALUES (:total,:order_id)");

        // Execute the statement
        $stmt->execute(['total' => $total, 'order_id' => $order_id]);

        // Check if the query was successful
            if ($stmt->rowCount() > 0) {
                $_SESSION['msg_order'] = "Order added successfully";
                if($_SESSION['type_user'] == 'admin')
                {
                    header("location:../../adminOrder.php");
                    exit();
                }elseif($_SESSION['type_user'] == 'user')
                {
                    header("location:../../userOrder.php");

                }
           

            }
        } 
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'The request must be from the form.'));
    }
?>