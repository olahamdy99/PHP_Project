<?php
session_start(); 
$errors = [];

if(isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'], true); 
}

if ($_SESSION['type_user'] != 'admin') {
    header("Location: login.php"); 
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
</head>
<style>
        .form-group label {
            margin-bottom: 0.5rem; 
        }
      
h1 {
    padding: 2rem;
    background: blanchedalmond;
    display: flex;
    justify-content: center;
}
.p-2,
        .btn {
            margin-bottom: 0.5rem;
        }
    </style>
<body>
<?php include 'nav.php' ?>
<div class ="container">
        <form action="adduser.php" method="post" id="adduser" novalidate enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control p-2" id="name" name="name" placeholder="name">
                <?php
        if(isset($errors['name'])) { echo $errors['name']; }?>
            </div>
    
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control p-2" id="email" name ="email" placeholder="Enter email">
              <?php  if(isset($errors['email'])) { echo $errors['email']; }?>

            </div>
    
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" class="form-control p-2" id="Password" name="Password" placeholder="Password">
                <?php  if(isset($errors['password'])) { echo $errors['password']; }?>

            </div>
    
            <div class="form-group">
                <label for="confirm_Password">Confirm Password</label>
                <input type="password" class="form-control p-2" id="confirm_Password" name="confirm_Password" placeholder="Confirm Password">
                <?php  if(isset($errors['confirm_Password'])) { echo $errors['confirm_Password']; }?>

            </div>
    
            <div class="form-group">
                <label for="room">Room Number</label>
                <input type="number" class="form-control p-2" id="room" name="room" placeholder="Room Number">
            </div>
            <div class="form-group">
                <label for="Ext">Ext</label>
                <input type="Ext" class="form-control p-2" id="Ext" name="Ext" placeholder=" Ext">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Profile Picture</label>
                <input type="file" class="form-control-file" id="user_img" name="user_img">
            </div>
    
            <button type="submit" class="btn btn-primary btn-block">adduser</button>
            <button type="reset" class="btn btn-danger btn-block">Reset</button>
        </form>
    </div>
    </div>

</body>
<script src="bootstrap.js"></script>
</html>

