<?php
include_once 'db.php';
$db = new db();

$result = "";

if(isset($_GET['action']) && $_GET['action'] == "search_date" && isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];

    $result = $db->get_data("order", "*", "date BETWEEN '$fromDate' AND '$toDate'");
} else {
    $result = $db->get_data("order");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Order</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bordered {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }

        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            padding: 2px;
        }

        .image-slider {
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .image-slider::-webkit-scrollbar {
            display: none;
        }

        .image-item {
            display: inline-block;
            margin-right: 10px;
        }

        .image-item img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
        }

        .centered-input {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <script>
function toggleImage(imageId, iconId) {
    var imageElement = document.getElementById(imageId);
    var iconElement = document.getElementById(iconId);
    if (imageElement.style.display === "none") {
        imageElement.style.display = "block";
        
        iconElement.textContent = "−"; 
    } else {
        imageElement.style.display = "none";
        iconElement.textContent = "+"; 
    }
}

function confirmCancel(orderId) {
    if (confirm("Are you sure you want to cancel this order?")) {
        // Assuming you have a PHP file named "btnSubmit.php" to handle the cancel order action
        window.location.href = "btnSubmit.php?action=cancel_order&id=" + orderId;
    } else {
        return false;
    }
}

function submitDateRange() {
    var fromDate = document.getElementById('dateFrom').value;
    var toDate = document.getElementById('dateTo').value;

    // Assuming you have a PHP file named "searchOrder.php" to handle the search action
    window.location.href = "orderUser.php?action=search_date&fromDate=" + fromDate + "&toDate=" + toDate;
}
</script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">My Order</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" alt="User Image" class="user-image">
                    Ebtesam
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4 bordered">
<div class="row mt-4 justify-content-center">
    <div class="col-md-4 mt-2">
        <input type="date" name="date_from" class="form-control" id="dateFrom" placeholder="Date From">
    </div>
    <div class="col-md-4 mt-2">
        <input type="date" name="date_to" class="form-control" id="dateTo" placeholder="Date To">
    </div>
    <div class="col-md-2 mt-2">
        <button class="btn btn-primary" onclick="submitDateRange()">Search</button>
    </div>
</div>


    <div class="row mt-4">
        <div class="col">
            <!-- Table to display orders -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Order Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $orderDetails = $db->get_data("order_details", "*", "order_id = " . $row['id'])->fetch(PDO::FETCH_ASSOC);

                            echo "<tr>";
                            echo "<td>"; 
                            echo $row['date'];
                            echo "<button onclick=\"toggleImage('product_image_" . $row['id'] . "', 'toggle_icon_" . $row['id'] . "')\">";
                            echo "<span id='toggle_icon_" . $row['id'] . "'>&plus;</span>";
                            echo "</button>";
                            echo "</td>"; 

                            if ($orderDetails) {
                                echo "<td>" . $orderDetails['status'] . "</td>";
                                echo "<td>" . $orderDetails['total'] . "</td>";

                                // Add Action based on Status
                                echo "<td>";
                                if ($orderDetails['status'] == 'processing') {
                                    echo "<a class='btn btn-danger' onclick=\"return confirmCancel('{$row['id']}')\" href='#' name='cancel_order'>Cancel</a>";
                                }
                                echo "</td>";
                            } else {
                                // Handle case when order details are not found
                                echo "<td colspan='3'>Order details not found</td>";
                            }

                            echo "</tr>";
                            
                            // Display product images
                            $product_items = json_decode($row['product_items'], true);
                            echo "<tr id='product_image_" . $row['id'] . "' style='display:none; text-align: center;'>";
                            echo "<td style='text-align: center;' colspan='3'>";

                            if (is_array($product_items)) {
                                foreach ($product_items as $product_item) {
                                    $product_data = $db->get_data("product", "*", "name = '" . $product_item['product'] . "'")->fetch(PDO::FETCH_ASSOC);
                                    if ($product_data) {
                                        echo "<div style='display: inline-block; margin: 10px; position: relative;'>";
                                        echo "<img src='uploads/" . $product_data['image'] . "' alt='Product Image' style='width: 100px; height: 100px;'>";
                                        echo "<div style='position: absolute; top: 0; right: 0; background-color: #873e23; color: #fff; padding: 5px;'>";
                                        echo "$" . $product_data['price'];
                                        echo "</div>";
                                        echo "<div style='text-align: center;'>";
                                        echo "<span style='font-size: 12px; color: #666;'>Quantity: " . $product_item['quantity'] . "</span>";
                                        echo "</div>";
                                        echo "</div>";
                                    } else {
                                        echo "Image not found";
                                    }
                                }
                            } else {
                                echo "No product items found";
                            }
                            echo "</td>";
                            
                            echo "</tr>";
                        }        
                    } else {
                        echo "<tr><td colspan='3'>No orders found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
