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
    <div class="row justify-content-center">
        <h1>cafeteria</h1>
</div>
        <div class="row justify-content-center">
            
        <div class="col-md-6">
        <form action="send_password_reset_code.php" method="post">
                <h2>reset password</h2>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control p-2" id="email"  placeholder="Enter email" name="email">
                    </div>
                  
                    <button type="submit" class="btn btn-danger btn-block">send password reset link </button>
                    
                </form>
            </div>
        </div>
    </div>
</body>
<script src="bootstrap.js"></script>
</html>
