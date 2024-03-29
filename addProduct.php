<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<br>
    <div class="container">
<h2>
    Add Product....
</h2>

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
                        
                <a href="#" class="link-primary">Add Category</a>
            </div>
            </div>
            </div>
<br>
<div class="input-group mb-3">
    <label class=" input-group-text" for="inputGroupFile01">Upload Image</label>
    <input type="file" class="form-control" id="inputGroupFile01">
  </div>
  <br>
<div class="form-group">
                <button type="submit" class=" btn btn-outline-primary">Save</button>
                <button type="reset" class="btn btn-outline-primary">Reset</button>

            </div>
                </div>
            

            </div>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/main.js"></script>
</body>

</html>
