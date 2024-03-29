<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Product</title>

    <style>
        body, html {
            height: 100%;
        }
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 30px;
        }
        label {
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: #333;
        }
        .category {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Add Product....</h2>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="productName">
                </div>
                <br>
                <div class="form-group">
                    <label for="productPrice">Price</label>
                    <input type="text" class="form-control" id="productPrice">
                </div>
                <br>
                <div class="form-group">
                    <label for="productCategory">Category</label>
                    <div class="row">
                        <div class="col">
                            <select class="form-select" id="productCategory" name="productCategory">
                                <option value="Electronics">Electronics</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Books">Books</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="link-primary" id="toggleCategory">Add Category</a>
                        </div>
                    </div>
                </div>
                <?php
                    session_start();

                    if (isset($_SESSION['add_successfully'])) {
                        echo "<div class='alert alert-success'>{$_SESSION['add_successfully']}</div>";
                        unset($_SESSION['add_successfully']); 
                    }

                    if (isset($_SESSION['add_already'])) {
                        echo "<div class='alert alert-warning'>{$_SESSION['add_already']}</div>";
                        unset($_SESSION['add_already']); 
                    }
                ?>
                <div class="category">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-container">
                                    <h2 class="text-center mb-4">Add Category</h2> 
                                    <form id="categoryForm" action="addcategory.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="exampleInputNameCategory" class="col-sm-4 col-form-label">Name Category</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="exampleInputNameCategory" name="nameCategory" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-center">
                                                <button type="submit" class="btn btn-primary">Add Category</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Upload Image</label>
                    <input type="file" class="form-control" id="inputGroupFile01">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary">Save</button>
                    <button type="reset" class="btn btn-outline-primary">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
            $('#toggleCategory').click(function (e){
                e.preventDefault();
                $('.category').toggle();
            });
        });
    </script>
</body>

</html>



               