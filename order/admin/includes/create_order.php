<?php
include_once "../../../db.php";
$db = new db();
$conn = $db->getConnection(); // Establishing database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_order'])) {

        $user_id = $_POST['user_id'];
        $product_items = $_POST['items'][0];
        $notes = $_POST['notes'];
        $ext = explode('_', $_POST['room'])[0];
        $room = explode('_', $_POST['room'])[1];

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

        // Check if the query was successful
        if ($stmt->rowCount() > 0) {
            echo json_encode(array('status' => 'success', 'message' => 'Order created successfully.'));
            // if ($_GET['role'] == 'admin') {
            //     header('REFRESH:1; url=http://localhost/coffee_v_2/adminOrder.php');
            // } elseif ($_GET['role'] == 'user') {
            //     header('REFRESH:1; url=http://localhost/coffee_v_2/userOrder.php');
            // }
            // exit();
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to create order.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'The request must be from the form.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Please use the appropriate form to submit data. This page can only be accessed via POST requests.'));
}
?>
