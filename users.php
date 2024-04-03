<?php
require ("db.php");
if ($_SESSION['type_user'] != 'admin') {
    header("Location: login.php"); 
    exit;
}

$db = new db();

$records_per_page = 4;

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $records_per_page;

$total_records = $db->count_records('users');

$users = $db->get_data('users', '*', null, $records_per_page, $offset);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Pagination</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<?php include 'nav.php' ?>
    <div class="container">
        <h2>All Users</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Exit</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $users->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td>
                            <?= $user['name'] ?>
                        </td>
                        <td>
                            <?= $user['room'] ?>
                        </td>
                        <td>
                            <?= $user['ext'] ?>
                        </td>
                        <td><img src="./img/<?= $user['picture'] ?>" width="100" height="100"></td>
                        <td>
                            <a href="editUser.php?id=<?= $user['id'] ?>">Edit</a>
                            <a href="deleteUser.php?id=<?= $user['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                $total_pages = ceil($total_records / $records_per_page);

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>