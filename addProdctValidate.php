
<?php
require ("db.php");
$db = new db();

    $productName =validate($_POST["productName"]);
    $productPrice = validate($_POST["productPrice"]);
    $productCategory =validate( $_POST["productCategory"]);
    $img = $_FILES["img"]["name"];
    $from = $_FILES["img"]["tmp_name"];
    $img = $_FILES["img"]["name"];
    move_uploaded_file($from, "./img/" . $img);
    
    $errors = [];



    if (strlen($productName) < 2) {
        $errors['productName'] = "Product name must be more than 2 char";
    }


    if (count($errors) > 0) {
        header("Location:addProduct.php?errors=" . json_encode($errors));
    } else {
        try {
            
            $stm = $db->insert_data(
                "products",
                "productName,productPrice,productCategory,img",
                "'{$_POST['productName']}', '{$_POST['productPrice']}', '{$_POST['productCategory']}', '{$img}'"
            );

            header("Location:success.html");

        } catch (PDOException $e) {
            echo $e->getMessage();
            header("Location:addProduct.php?errors=$e");
        }
    }

function validate($data)
{
    $data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>