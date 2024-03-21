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
    <div class="container">
        <h1>Cafeteria</h1>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control p-2" id="username" name="username" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control p-2" id="email" name ="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" class="form-control p-2" id="Password" name="Password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="confirm_Password">Confirm Password</label>
                <input type="password" class="form-control p-2" id="confirm_Password" name="confirm_Password" placeholder="Confirm Password">
            </div>

            <div class="form-group">
                <label for="room_no">Room Number</label>
                <input type="text" class="form-control p-2" id="room_no" name="room_no" placeholder="Room Number">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Profile Picture</label>
                <input type="file" class="form-control-file" id="user_img" name="user_img">
            </div>
  
            <button type="submit" class="btn btn-primary btn-block">Save</button>
            <button type="reset" class="btn btn-danger btn-block">Reset</button>
        </form>
    </div>
</body>
<script src="bootstrap.js"></script>
</html>