
<?php
include_once 'db.php';
if ($_SESSION['type_user'] != 'admin') {
    header("Location: login.php"); 
    exit;
}
if ($_SESSION['type_user'] != 'admin') {
    header("Location: login.php"); 
    exit;}

$db = new db(); 
$result = $db->get_data('category', 'id, name'); 

$options = '';
foreach ($result as $row) {
    $options .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Product</title>
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
<?php include 'nav.php' ?>



<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php
                if (isset($_SESSION['inserted_product'])) {
                    echo "<div class='alert alert-success'>{$_SESSION['inserted_product']}</div>";
                    unset($_SESSION['inserted_product']); 
                }
                if(isset($_SESSION['add_error']))
                {
                    echo "<div class='alert alert-warning'>{$_SESSION['add_error']}</div>";
                    unset($_SESSION['add_error']);
                }
            ?>
            <form method="post" action="btnSubmit.php" enctype="multipart/form-data">
            <div class="form-container">
                    <div class="mb-3">
                        <label for="exampleInputNameProduct" class="form-label">Name product</label>
                        <input type="text" class="form-control" id="exampleInputNameProduct" name="nameProduct">
                        <?php
                            if (isset($_SESSION['errors']['nameProduct_error'])) {
                                echo "<div class='alert alert-warning'>{$_SESSION['errors']['nameProduct_error']}</div>";
                                unset($_SESSION['errors']['nameProduct_error']); 
                            }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="exampleInputPrice" name="price">
                        <?php
                            if (isset($_SESSION['errors']['priceProduct_error'])) {
                                echo "<div class='alert alert-warning'>{$_SESSION['errors']['priceProduct_error']}</div>";
                                unset($_SESSION['errors']['priceProduct_error']); 
                            }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="exampleInputQuantity" name="quantity">
                        <?php
                            if (isset($_SESSION['errors']['quantityProduct_error'])) {
                                echo "<div class='alert alert-warning'>{$_SESSION['errors']['quantityProduct_error']}</div>";
                                unset($_SESSION['errors']['quantityProduct_error']); 
                            }
                        ?>
                    </div>
                    <div class="mb-3">

                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="category">
                            <option selected>Select Category</option>
                            <?php echo $options; ?> 
                        </select>
                        <?php
                            if (isset($_SESSION['errors']['categoryProduct_error'])) {
                                echo "<div class='alert alert-warning'>{$_SESSION['errors']['categoryProduct_error']}</div>";
                                unset($_SESSION['errors']['categoryProduct_error']); 
                            }
                        ?>
                        <a href="" id="addCategoryLink">Add New Category</a>
                            <?php
                                if (isset($_SESSION['add_successfully'])) {
                                    echo "<div class='alert alert-success'>{$_SESSION['add_successfully']}</div>";
                                    unset($_SESSION['add_successfully']); 
                                }
                            ?>
                            <div class="mb-3 newCategory" id="newCategoryInput" style="display: none;">
                                <form method="post" action="btnSubmit.php">
                                    <div class="mb-3">
                                        <label for="exampleInputNewCategory" class="form-label">New Category</label>
                                        <input type="text" class="form-control" id="exampleInputNewCategory" name="newCategory">
                                    </div>
                                    <div class="text-center mb-3">
                                        <button type="submit" class="btn btn-primary" name="addCategory">Add Category</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputImage" class="form-label">Image Product</label>
                        <input type="file" class="form-control" id="exampleInputImage" name="image">
                    </div>
                    <?php
                        if (isset($_SESSION['errors']['imageProduct_error'])) {
                            echo "<div class='alert alert-warning'>{$_SESSION['errors']['imageProduct_error']}</div>";
                            unset($_SESSION['errors']['imageProduct_error']); 
                        }
                    ?>
                    <div class="text-center">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-primary" name="addProduct">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.getElementById('addCategoryLink').addEventListener('click', function(event) {
        event.preventDefault(); 
        var newCategoryInput = document.getElementById('newCategoryInput');
        if (newCategoryInput.style.display === 'none') {
            newCategoryInput.style.display = 'block';
        } else {
            newCategoryInput.style.display = 'none';
        }
    });
</script>
</body>
</html>
