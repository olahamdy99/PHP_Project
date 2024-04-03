<?php

require ("db.php");
if ($_SESSION['type_user'] != 'admin') {
    header("Location: login.php"); 
    exit;
}
$db = new db();
$users = $db->get_data("users", 'name');

$selectedUser = "User";

if (isset($_POST['user'])) {
    $selectedUser = $_POST['user'];
}

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$total_records = $db->count_records("order");

$total_pages = ceil($total_records / $limit);

$result = "";

if (isset($_GET['action']) && $_GET['action'] == "search_date" && isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];


    $result1 = $db->get_data("order", "*", "date BETWEEN '$fromDate' AND '$toDate'", $limit, $offset);

    $result = $db->get_data("order", "*", "date BETWEEN '$fromDate' AND '$toDate'", $limit, $offset);
} else {
    $result = $db->get_data("order");
    $result1 = $db->get_data("order");

}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Checks</title>
    <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
    <link rel='stylesheet' href='assets/css/style.css'>
    <style>
        .accordion-button::after {
            background-image: url('data:image/svg+xml,%3Csvg xmlns=' http: //www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus' viewBox='0 0 16 16'%3E%3Cpath d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/%3E%3C/svg%3E');
                    transition: all 0.5s;
            }

            .accordion-button:not(.collapsed)::after {
                background-image: url('data:image/svg+xml,%3Csvg xmlns=' http: //www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-dash' viewBox='0 0 16 16'%3E%3Cpath d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z'/%3E%3C/svg%3E');
                }

                table {
                    table-layout: fixed;
                    width: 100%;
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

        function submitDateRange() {
            var fromDate = document.getElementById('dateFrom').value;
            var toDate = document.getElementById('dateTo').value;

            window.location.href = "checks.php?action=search_date&fromDate=" + fromDate + "&toDate=" + toDate;
        }


        $(document).ready(function () {
            $('#user').change(function () {
                var selectedUser = $(this).val();
                $('tbody tr').hide();
                $('tbody tr[data-user="' + selectedUser + '"]').show();
            });
        });
    </script>
</head>

<body>
<?php include 'nav.php' ?>


    <div class='container'>
        <h2>Checks</h2>
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
            <form method="POST">

                <div class='form-group'>
                    <label for='user_type'>User</label>
                    <!-- Select user dropdown -->
                    <select class='form-control' id='user' name='user' onchange="this.form.submit()">
                        <option value="User" <?php if ($selectedUser === "User")
                            echo "selected"; ?>>User</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['name']; ?>" <?php if ($selectedUser === $user['name'])
                                   echo "selected"; ?>>
                                <?php echo $user['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
            </form>

            <br>

            <table class="table table-striped" id="orderTable">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userTotals = array();

                    if ($result && $result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $user_details = $db->get_data("users", "*", "id = " . $row['user_id'])->fetch(PDO::FETCH_ASSOC);
                            $username = $user_details['name'];

                            $order_details = $db->get_data("order_details", "*", "order_id = " . $row['id'])->fetch(PDO::FETCH_ASSOC);
                            $totalAmount = $order_details['total'];

                            if (isset($userTotals[$username])) {
                                $userTotals[$username] += $totalAmount;
                            } else {
                                $userTotals[$username] = $totalAmount;
                            }
                        }
                    }

                    if (!empty($userTotals)) {
                        foreach ($userTotals as $username => $totalAmount) {
                            if ($selectedUser === "User" || $username === $selectedUser) {
                                echo "<tr>";
                                echo "<td>$username</td>";
                                echo "<td>$totalAmount</td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        echo "<tr><td colspan='2'>No orders found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Order Date</th>
                        <th scope="col">User</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result1 && $result1->rowCount() > 0) {
                        while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
                            $orderDetails = $db->get_data("order_details", "*", "order_id = " . $row['id'])->fetch(PDO::FETCH_ASSOC);

                            echo "<tr>";
                            echo "<td>" . $row['date'] . "</td>";
                            $user_details = $db->get_data("users", "*", "id = " . $row['user_id'])->fetch(PDO::FETCH_ASSOC);
                            $username = $user_details['name'];

                            echo "<td>" . $username . "</td>";
                            echo "<td>" . $orderDetails['total'] . "</td>";

                            echo "<td>";
                            echo "<button type='button' class='toggle-button' onclick=\"toggleImage('product_image_" . $row['id'] . "', 'toggle_icon_" . $row['id'] . "')\">";
                            echo "<span id='toggle_icon_" . $row['id'] . "'>&plus;</span>";
                            echo "</button>";
                            echo "</td>";

                            echo "</tr>";

                            $product_items = json_decode($row['product_items'], true);
                            echo "<tr id='product_image_" . $row['id'] . "' style='display:none; text-align: center;'>";
                            echo "<td style='text-align: center;' colspan='4'>";

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
                        echo "<tr><td colspan='4'>No orders found</td></tr>";
                    }
                    ?>
                </tbody>



            </table>


            </form>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php if ($i === $page)
                            echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js"></script>


</body>

</html>