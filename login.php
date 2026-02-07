<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gaming Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <?php





$user_name = "";
if(isset($_GET["username"])){
    $user_name = $_GET["username"];
}

if(isset($_POST["b1"]))
{
    include("connect.php");
    session_start();
    
    $user_name = $_POST["username"];   // Getting username from form
    $tpassword = $_POST["password"]; // Getting password from form
    
    $sql = "SELECT * FROM users WHERE username='$user_name' AND password='$tpassword'";
    $result = mysqli_query($conn, $sql);//عشان نحكم اليوسر بالباسور ويوسر نيم موجودين فعلا

    if(mysqli_num_rows($result) === 1) //1 row
    {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];
      
        if($row['role'] == 'admin' && $tpassword == '123') {
            header("Location: admin_home.php"); 
            exit();
            
        } else {
            header("Location: home.php"); 
            exit();
           
        }
       
        
    }
    else 
    {
        echo "<script>alert('Incorrect Username, Password or Role!');</spcrit>";//fedback 
    }
}
?>

<div class="container-fluid p-0">
    <div class="row no-gutters">
        
        <div class="col-md-6 d-none d-md-flex intro-section">
            <div class="intro-content-wrapper">
                <h1 class="intro-title">Welcome back!</h1>
                <p class="intro-text">Welcome to the best gaming tournament platform. Join us and win big prizes.</p>
            </div>
        </div>

        <div class="col-md-6 form-section">
            <div class="login-wrapper">
                <h2 class="login-title">Sign in</h2>
                
                <form method="post">
                    <div class="form-group">
                        <label for="username" class="sr-only">User Name</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required value="<?php echo $user_name; ?>">
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>

                    <input name="b1" id="login" class="btn login-btn" type="submit" value="Login">
                </form>

                <a href="registration.php" class="forgot-password-link">Create New account</a>
            </div>
        </div>

    </div>
</div>

<a href="index.php" class="btn btn-dark" style="position: absolute; top: 10px; right: 10px;">back to home</a>

</body>
</html>