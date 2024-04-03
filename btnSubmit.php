<?php

session_start();
require_once("db.php");

// Start btn add category
if (isset($_POST["addCategory"])) {
    if (isset($_POST['newCategory'])) {
        $newCategory = $_POST['newCategory'];
        
        if (strlen($newCategory) < 2) {
            $_SESSION['category_error'] = "Category name must be at least 2 characters long.";
            header("Location: product.php");
            exit;
        }
        // Send data category to page add Category to insert data
        header("Location: addCategory.php?newCategory=" . urlencode($newCategory));
        exit;
    }
}

// Start btn add product
if (isset($_POST["addProduct"])) {
    $nameProduct = $_POST['nameProduct'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];


    $errors = [];

    // Name product
    if (strlen($nameProduct) < 3) {
        $errors['nameProduct_error'] = "Name product must be at least 3 characters";
    }

    // Price product
    if (!is_numeric($price) || $price <= 0) {
        $errors['priceProduct_error'] = "Price must be a numeric value greater than 1.";
    }

    // quantity product
    if (!is_numeric($quantity) || $quantity <= 0) {
        $errors['quantityProduct_error'] = "Quantity must be a numeric value greater than 1.";
    }

    // Image product
    $db = new db();
    $categoryExists = $db->get_data('category', '*', "id = '$category'")->rowCount();
    if ($categoryExists == 0) {
        $errors['categoryProduct_error'] = "Selected category does not exist.";
    }

    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpeg", "jpg", "png");
    if (!in_array($file_ext, $allowed_extensions)) {
        $errors['imageProduct_error'] = "Image extension not allowed, please choose a JPEG or PNG file.";
    }
    if ($file_size > 2097152) {
        $errors['imageProduct_error'] .= "<br/>File size must be less than 2 MB.";
    }

    // Send errors and old data to form
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: product.php");
        exit;
    }

    // Send data to database
    if ($db->getConnection()) {
        if (!empty($file_tmp)) { 
            $random_name = uniqid() . '_' . mt_rand() . '.' . $file_ext;
            $upload_directory = "uploads/";
            if (move_uploaded_file($file_tmp, $upload_directory . $random_name)) {
                $image_value = "'$random_name'";
            } else {
                $image_value = "NULL";
            }
        } else {
            $image_value = "NULL";
        }

        // Insert
        $cols = 'name, price, quantity, category_id, image';
        $values = "'$nameProduct', '$price', '$quantity', '$category', $image_value";
        $inserted = $db->insertData('product', $cols, $values);
        if ($inserted) {
            $_SESSION['inserted_product'] = "Product added successfully.";
        } else {
            if (!empty($random_name)) {
                unlink($upload_directory . $random_name);
            }
        }
    } else {
        $_SESSION['db_connection_error'] = "Error connecting to the database"; 
    }

    header("Location: product.php");
    exit;
}
// End btn add product

// Start btn edit product
if(isset($_GET['action']) && $_GET['action'] == "edit_product" && isset($_GET['id']))
{
    header("Location: editProduct.php?id={$_GET['id']}");   
}
// End btn edit product

// Start btn updata product
if(isset($_POST["updata_product"]))
{
    $nameProduct = $_POST['nameProduct'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $productId = $_POST['id'];
    $quantity = $_POST['quantity'];


    $errors = [];

    if (strlen($nameProduct) < 3) {
        $errors['nameProduct_error'] = "Name product must be at least 3 characters";
    }

    if (!is_numeric($price) || $price <= 0) {
        $errors['priceProduct_error'] = "Price must be a numeric value greater than 1.";
    }
    if (!is_numeric($quantity) || $quantity <= 0) {
        $errors['quantityProduct_error'] = "Quantity must be a numeric value greater than 1.";
    }

    // Category
    $db = new db();
    $categoryExists = $db->get_data('category', '*', "id = '$category'")->rowCount();
    if ($categoryExists == 0) {
        $errors['categoryProduct_error'] = "Selected category does not exist.";
    }

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpeg", "jpg", "png");
        if (!in_array($file_ext, $allowed_extensions)) {
            $errors['imageProduct_error'] = "Image extension not allowed, please choose a JPEG or PNG file.";
        }
        if ($file_size > 2097152) {
            $errors['imageProduct_error'] .= "<br/>File size must be less than 2 MB.";
        }
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: editProduct.php?id=$productId");
        exit;
    }

 
    $setData = "name = '$nameProduct', price = '$price', quantity ='$quantity',category_id = $category";
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $random_name = uniqid() . '_' . mt_rand() . '.' . $file_ext;
        $upload_directory = "uploads/";
        if (move_uploaded_file($file_tmp, $upload_directory . $random_name)) {
            $setData .= ", image = '$random_name'";
        }
    }

    $updated = $db->update_data("product", $setData, "id = $productId");
    if ($updated) {
        $_SESSION['updated_product'] = "Product updated successfully.";
    } else {
        $_SESSION['update_error'] = "Error updating product.";
    }

    header("Location: editProduct.php?id=$productId");
    exit;
}
// end btn updata product


// Start btn deleted product

if(isset($_GET['action']) && $_GET['action'] == "delete_product" && isset($_GET['id']))
{
    //echo"delet";
    $db = new db();
    $deleted = $db->delete_data("product", "id = " . $_GET['id']);
    header("Location: products.php");
    exit;
}

// End btn delted product


// start btn cancel order
if(isset($_GET['action']) && $_GET['action'] == "cancel_order" && isset($_GET['id']))
{
    $db = new db();
    $deleted = $db->delete_data("`order`", "id = " . $_GET['id']);
    $deleted = $db->delete_data("`order_details`", "order_id = " . $_GET['id']);

    header("Location: orderUser.php");
    exit;
}
// end btn cancel order















?>

