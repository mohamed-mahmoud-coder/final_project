<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Registrations</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">

    <style>
        
        body {
            background-color: #1a1d20;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #ffc107;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .card-custom {
            background-color: #2c3034;
            border: 1px solid #454d55;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            border-radius: 12px;
        }

        .table-custom {
            margin-bottom: 0;
            border-color: #454d55;
        }
        
        .table-custom th {
            background-color: #212529;
            color: #ffc107;
            border-bottom: 2px solid #ffc107;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        
        .table-custom td {
            background-color: #2c3034;
            color: #fff;
            vertical-align: middle;
            border-color: #454d55;
        }

        .table-hover tbody tr:hover td {
            background-color: #3d4248;
            color: #ffc107;
            transition: 0.3s;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary mb-5">
        <div class="container">
            <a class="navbar-brand text-uppercase fw-bold" href="admin_home.php"><i class="fa-solid fa-gamepad text-warning"></i>  Go To Admin Control Panel</a>
        </div>
    </nav>

    <div class="container">
        
        <div class="card card-custom p-4">
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