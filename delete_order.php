<?php
// delete_order.php

if(isset($_GET['id'])) {
    $order_id = $_GET['id'];

    include_once 'db.php';
    $db = new db();
    error_log("Order ID received: ".$_GET['id']);


    // Delete order from both "order" and "order_details" tables
    $db->delete_data("order", "id = $order_id");
    $db->delete_data("order_details", "order_id = $order_id");

    // Return success response
    echo json_encode(['success' => true]);
    exit();
} else {
    // Return error response if order ID is not provided
    echo json_encode(['success' => false, 'message' => 'Order ID not provided']);
    exit();
}
?>
