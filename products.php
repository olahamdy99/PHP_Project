<?php
include_once 'db.php';


$db = new db(); 
$result = $db->get_data('product'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Product</title>
</head>
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#" aria-current="page">All Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Manual Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Checks</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center ps-3 pe-3">
                    <img src="profile-image.jpg" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px;">
                    <span class="ms-2">User Name</span>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="row container mt-5">
    <div class="col text-end">
        <a href="product.php" class="btn btn-success">Add Product</a>
    </div>
</div>

<div class="container mt-5">
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th> 
        </tr>
    </thead>
    <tbody>

        <?php 
            foreach ($result as $row) {
                if($row['quantity'] > 0){
                    $status = "Available" ;
                }else{
                    $status = "Unavailable" ;
                }
                echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td><img src='uploads/{$row['image']}' width='70'/></td>
                <td>
                    
                    <a class='btn btn-outline-warning'>$status</a>
                    <a class='btn btn-info' href='btnSubmit.php?action=edit_product&id={$row['id']}' name='edit_product'>Edit</a>
                    <a class='btn btn-danger' onclick=\"return confirmDelete('{$row['name']}', {$row['id']})\" href='#' name='delete_product'>Delete</a>
                </td>
            </tr>";
        
            }                 
        ?>
       
    </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function confirmDelete(productName, productId) {
        if (confirm("Are you sure you want to delete the product '" + productName + "'?")) {
            window.location.href = "btnSubmit.php?action=delete_product&id=" + productId;
        } else {
            return false;
        }
    }
</script>


</body>
</html>