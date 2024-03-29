<?php
require_once 'db.php';

if (isset($_GET['newCategory'])) {

    $database = new db();
    if ($database->getConnection()) {
        $newCategory = $_GET['newCategory'];
        $columns = 'name'; 
        $values = "'$newCategory'"; 
        
        $inserted = $database->insertData('category', $columns, $values);
        if ($inserted) {
            $_SESSION['add_successfully'] = "Category added successfully"; 
        }
    } else {
        $_SESSION['db_connection_error'] = "Error connecting to the database"; 
    }

    header("Location: product.php"); 
    exit; 
} else {
    header("Location: product.php"); 
    exit;
}

?>
