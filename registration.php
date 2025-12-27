<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Account</title>
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
if ($result) // success
            {
                session_start();
                $_SESSION["username"] = $user_name;
                $_SESSION["password"] = $tpassword;
                $_SESSION["role"] = $role;
                
                header("location: login.php?username=$user_name");
            }
            else
            {
                echo "An error is occurred";
            }

            //echo $sql;
       }

?>



    <center>
<h2>Create New Account</h2>
<table>
<form  method="post">

<tr>
    <td>User Name :</td>
<td> <input type="text" name="username" required ></td>
</tr>

<tr>
    <td>Email :</td>
<td> <input type="text" name="email"  > </td>

</tr>


<tr>
    <td> Password :</td>
<td> <input type="password" name="password" required ></td>
</tr>
<tr>
    <td>Favorite Game:</td>
    <td>
        <select name="game_name">
            <option value="Call of Duty">Call of Duty</option>
            <option value="FIFA">FIFA</option>
            <option value="Valorant">Valorant</option>
            <option value="GTA V">GTA V</option>
            <option value="PUBG">PUBG</option>
        </select>
    </td>
</tr>
<tr>
    <td>Choose Avatar:</td>
    <td>
        <input type="radio" name="avatar" value="avatar1.jpg" id="av1" checked>
        <label for="av1">
            <img src="image/avatar1.jpg" alt="Avatar 1" width="60">
        </label>

        <input type="radio" name="avatar" value="avatar2.jpg" id="av2">
        <label for="av2">
            <img src="image/avatar2.jpg" alt="Avatar 2" width="60">
        </label>

        <input type="radio" name="avatar" value="avatar3.jpg" id="av3">
        <label for="av3">
            <img src="image/avatar3.jpg" alt="Avatar 3" width="60">
        </label>
    </td>
</tr>
<tr>
    <td colspan="2" align="center">
        <input type="submit" name="b1"  value="Create Account"></td>
</tr>

</form>


</table>
<p>
            Already have an account? <a href="login.php">Login here</a>
        </p>


  </center> 
</body>
</html>