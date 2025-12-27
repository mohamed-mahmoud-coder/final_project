<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
<?php

 $user_name=$_GET["username"];




if(isset($_POST["b1"]))
{
    include("connect.php");
   session_start();
    
    $user_name = $_POST["username"];
    $tpassword = $_POST["password"];
    
    $sql = "SELECT * FROM users WHERE username='$user_name' AND password='$tpassword'";
    $result = mysqli_query($conn, $sql);

    
    if(mysqli_num_rows($result) === 1) 
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];
      

      
        if($row['role'] == 'admin'&& $tpassword == '123') {
            header("Location: admin_home.php"); 
        } 
       
        else {
            header("Location: home.php"); 
        }
        
       
    }
    else 
    {
        echo "<script>alert('Incorrect Username, Password or Role!');</script>";
    }
}
?>



  <center>
<h2>login</h2>
<table>
<form  method="post">
<tr>
    <td>User Name :</td>
<td> <input type="text" name="username" required value="<?php echo $user_name  ?>"></td>
</tr>
<tr>
    <td>Password :</td>
<td> <input type="password" name="password"required></td>
</tr>
<tr>
 
    <td><input type="submit" name="b1"  value="Login"></td>
</tr>




</form>



</table>
<p>
  <a href="registration.php">Craeat New account </a>
</p>


  </center>  
  
</body>
</html>