<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Registrations</title>                  
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style3.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="admin_home.php">
                <i class="fa-solid fa-gamepad"></i> Go To Admin Control Panel
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="card card-custom">
            <h2 class="text-center mb-4"><i class="fa-solid fa-users"></i> Tournament Registrations</h2>
            
            <div class="table-responsive">
                <table class="table table-custom table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-hashtag"></i> ID</th>
                            <th><i class="fa-solid fa-trophy"></i> Tournament Name</th>
                            <th><i class="fa-solid fa-user"></i> Player Username</th>
                            <th><i class="fa-solid fa-envelope"></i> Player Email</th>
                            <th><i class="fa-regular fa-calendar"></i> Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    session_start();
                    include("connect.php");

                    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
                        header("Location: login.php");
                        exit();
                    }
                    $tournament_id=$_GET['id'];
                    $sql = "SELECT `registrations`.`id`, `tournaments`.`name`, `users`.`username`, `users`.`email`, `registrations`.`registration_date`
                    FROM `registrations` 
                    LEFT JOIN `tournaments` ON `registrations`.`tournament_id` = `tournaments`.`id` 
                    LEFT JOIN `users` ON `registrations`.`user_id` = `users`.`id`
                    WHERE `registrations`.`tournament_id` = $tournament_id";
                    
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['registration_date'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>