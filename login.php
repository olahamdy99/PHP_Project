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
                <form>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control p-2" id="email"  placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control p-2" id="Password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block ">Login</button>
                    <button type="submit" class="btn btn-danger btn-block ">forget password</button>

                </form>
            </div>
        </div>
    </div>
</body>
<script src="bootstrap.js"></script>
</html>