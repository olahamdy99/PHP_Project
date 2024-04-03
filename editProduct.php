<?php
include_once 'db.php';


$db = new db(); 


$data_product = null;
if (isset($_GET['id'])) {
    $data_product = $db->get_data('product', '*', "id =".$_GET['id'])->fetch(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Product</title>
</head>

<style>
    .form-container,.newCategory {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<body>

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
                            <a class="nav-link active" href="#" aria-current="page">Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">All Products</a>
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

<div class="container mt-3">
    <?php
        if (isset($_SESSION['updated_product'])) {
            echo "<div class='alert alert-success'>{$_SESSION['updated_product']}</div>";
            unset($_SESSION['updated_product']); 
        }
        if(isset($_SESSION['update_error']))
        {
            echo "<div class='alert alert-warning'>{$_SESSION['update_error']}</div>";
            unset($_SESSION['update_error']);
        }
        if(isset($_SESSION['updataError']))
        {
            echo "<div class='alert alert-warning'>{$_SESSION['updataError']}</div>";
            unset($_SESSION['updataError']);
        }
        
    ?>
    <div class="row">
        <div class="col-md-6 col-lg-6 mx-auto">
            <div class="card mb-3">
                <img src="uploads/<?php echo htmlspecialchars($data_product['image']); ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">Product Details</h5>
                    <form method="post" action="btnSubmit.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputNameProduct" class="form-label">Name product</label>
                            <input type="text" class="form-control" id="exampleInputNameProduct" name="nameProduct" value="<?php echo htmlspecialchars($data_product['name']); ?>">
                            <?php
                                if(isset($_SESSION['errors']['nameProduct_error']))
                                {
                                    echo "<div class='alert alert-warning'>{$_SESSION['errors']['nameProduct_error']}</div>";
                                    unset($_SESSION['errors']['nameProduct_error']);
                                }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="exampleInputPrice" name="price" value="<?php echo htmlspecialchars($data_product['price']); ?>">
                            <?php
                                if(isset($_SESSION['errors']['priceProduct_error']))
                                {
                                    echo "<div class='alert alert-warning'>{$_SESSION['errors']['priceProduct_error']}</div>";
                                    unset($_SESSION['errors']['priceProduct_error']);
                                }
                            ?>      
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="exampleInputQuantity" name="quantity" value="<?php echo htmlspecialchars($data_product['quantity']); ?>">
                            <?php
                                if(isset($_SESSION['errors']['quantityProduct_error']))
                                {
                                    echo "<div class='alert alert-warning'>{$_SESSION['errors']['quantityProduct_error']}</div>";
                                    unset($_SESSION['errors']['quantityProduct_error']);
                                }
                            ?>      
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Category</label>
                            <select class="form-select" id="productCategory" name="category">
                                <?php 
                                    $name_category = $db->get_data('category'); 

                                    foreach ($name_category as $row) {
                                        if($row['id'] == $data_product['errors']['category_id']){
                                            echo "<option  selceted value=\"{$row['id']}\">{$row['name']}</option>";
                                        }else{
                                            echo "<option  value=\"{$row['id']}\">{$row['name']}</option>";
                                        }
                                    }
                               ?>
                            </select>
                            <?php
                                if (isset($_SESSION['errors']['categoryProduct_error'])) {
                                    echo "<div class='alert alert-warning'>{$_SESSION['errors']['categoryProduct_error']}</div>";
                                    unset($_SESSION['errors']['categoryProduct_error']); 
                                }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputImage" class="form-label">Image Product</label>
                            <input type="file" class="form-control" id="exampleInputImage" name="image">

                            <?php
                                if(isset($_SESSION['errors']['imageProduct_error']))
                                {
                                    echo "<div class='alert alert-warning'>{$_SESSION['errors']['imageProduct_error']}</div>";
                                    unset($_SESSION['errors']['imageProduct_error']);
                                }
                            ?>
                        </div>
                        <div class="text-center">
                        <input type="hidden" class="form-control" name="id" value="<?php echo htmlspecialchars($data_product['id']); ?>">
                            <button type="submit" class="btn btn-success" name="updata_product">updata Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
