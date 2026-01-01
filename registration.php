<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Account</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="stylere2.css">
    
</head>
<body>
    <?php
$user_name="";
$email="";
$tpassword=0;
$role="";
$game_name="";
$avatar="";

if(isset($_POST["b1"]))
{
    $user_name=$_POST["username"];
    $email=$_POST["email"];
    $tpassword=$_POST["password"];
    $avatar=$_POST["avatar"];
    $game_name=$_POST["game_name"];
    $role="player";

    include("connect.php");
    $sql = "INSERT INTO `users` (`username`, `email`, `password`, `role`, `game_name`, `avatar`) 
            VALUES ('$user_name', '$email', '$tpassword', '$role', '$game_name', '$avatar')";

    $result = mysqli_query($conn , $sql);
    if ($result) {
        session_start();
        $_SESSION["username"] = $user_name;
        $_SESSION["password"] = $tpassword;
        $_SESSION["role"] = $role;
        header("location: login.php?username=$user_name");
    } else {
        echo "An error is occurred";
    }
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4">
                <div class="text-center">
                    <h2 class="card-title">Create New Account</h2>
                    <p class="" style="color: white;">Join the Gaming Hub community!</p>
                </div>

                <form method="post">
                    
                    <div class="mb-3"style="color: #ffffff">
                        <label class="form-label">User Name</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                    </div>

                    <div class="mb-3" style="color: #ffffff">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com">
                    </div>

                    <div class="mb-3" style="color: #ffffff">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>

                    <div class="mb-3" style="color: #ffffff">
                        <label class="form-label">Favorite Game</label>
                        <select name="game_name" class="form-select">
                            <option value="Call of Duty">Call of Duty</option>
                            <option value="FIFA">FIFA</option>
                            <option value="Valorant">Valorant</option>
                            <option value="GTA V">GTA V</option>
                            <option value="PUBG">PUBG</option>
                        </select>
                    </div>

                    <div class="mb-4 text-center" style="color: #ffffff">
                        <label class="form-label d-block mb-2">Choose Avatar</label>
                        
                        <input type="radio" name="avatar" value="avatar1.jpg" id="av1" checked>
                        <label for="av1" class="mx-2">
                            <img src="image/avatar1.jpg" alt="Avatar 1" width="70" class="avatar-option">
                        </label>

                        <input type="radio" name="avatar" value="avatar2.jpg" id="av2">
                        <label for="av2" class="mx-2">
                            <img src="image/avatar2.jpg" alt="Avatar 2" width="70" class="avatar-option">
                        </label>

                        <input type="radio" name="avatar" value="avatar3.jpg" id="av3">
                        <label for="av3" class="mx-2">
                            <img src="image/avatar3.jpg" alt="Avatar 3" width="70" class="avatar-option">
                        </label>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" name="b1" class="btn btn-custom" value="Create Account">
                    </div>

                </form>

                <div class="text-center mt-3" style="color: #ffffff">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    
                    <div class="card p-4">
                       </div>

                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>


</body>
</html>