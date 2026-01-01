<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .game-card { transition: transform 0.3s ease; cursor: pointer; }
        .game-card:hover { transform: scale(1.05); opacity: 0.8; }
        .game-img { 
            width: 100%; 
            height: 220px; 
            object-fit: cover; 
            object-position: top; 
            border-radius: 15px; 
            border: 2px solid #2a2a40; 
        }
        .game-title { text-align: center; margin-top: 5px; font-size: 0.9rem; color: #ccc; }
        body { background-color: #1a1a2e; color: #fff; font-family: sans-serif; }
        .card { background-color: #16213e; border: 1px solid #0f3460; color: white; margin-top: 20px; }
        .profile-img { width: 150px; height: 150px; border-radius: 50%; border: 4px solid #e94560; object-fit: cover; margin-top: -75px; background-color: #1a1a2e; }
        .header-bg { background: linear-gradient(90deg, #0f3460 0%, #e94560 100%); height: 150px; border-radius: 0 0 20px 20px; }
        .table-dark { background-color: #16213e; }
        .btn-custom { background-color: #e94560; color: white; border: none; }
        .btn-custom:hover { background-color: #c0354e; color: white; }
    </style>

</head>
<?php
session_start();
include("connect.php");

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'player') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['b1'])) {
    $tournament_id = $_POST['tournament_id'];
    $user_id = $_SESSION['id'];

    $sql3 = "SELECT * FROM `registrations` WHERE `user_id` = $user_id AND `tournament_id` = $tournament_id";
    $check_result = mysqli_query($conn, $sql3);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('You have already joined this tournament!');</script>";
    } else {
        $sql4 = "INSERT INTO `registrations` (`user_id`, `tournament_id`)
         VALUES ($user_id, $tournament_id)";
        if (mysqli_query($conn, $sql4)) {
            echo "<script>alert('Successfully joined the tournament!');</script>";
        } else {
            echo "<script>alert('Error joining tournament. Please try again.');</script>";
        }
    }
}








?>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Gaming Hub</span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="header-bg"></div>

    <div class="container">
        <div class="row">
            
            <div class="col-md-4">
                <div class="card text-center p-3 shadow">
                    <center>
                        <img src="image/<?php echo $row['avatar']; ?>" class="profile-img" alt="User Avatar">
                    </center>
                    
                    <div class="card-body mt-2">
                        <h3><?php echo $row['username']; ?></h3>
                        <p class="text-muted"><?php echo $row['email']; ?></p>
                        
                        <div style="background-color: #e94560; padding: 5px; border-radius: 10px; display: inline-block;">
                           Game: <?php echo $row['game_name']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card p-3 shadow">
                    <h4>🏆 Available Tournaments</h4>
                    
                    <table class="table table-dark table-hover mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tournament</th>
                                <th>Game</th>
                                <th>Date</th>
                                <th>Prize</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql2 = "SELECT * FROM `tournaments`";
                            $result2 = mysqli_query($conn , $sql2);
                            
                      while($row2 = mysqli_fetch_assoc($result2))
                            {
                                echo "<tr>";
                             echo "<td>".$row2['id']."</td>";
                                echo "<td>".$row2['name']."</td>";
                             echo "<td>".$row2['game_name']."</td>";
                                echo "<td>".$row2['date']."</td>";
                             echo "<td>".$row2['prize']."</td>";
                                echo "<td>".$row2['status']."</td>";
                            echo "<td>";
                                echo "<form method='post'>"; 
                                echo "<input type='hidden' name='tournament_id' value='".$row2['id']."'>";
                                echo "<button type='submit' name='b1' class='btn btn-sm btn-custom'>Join</button>";
                                echo "</form>";
                                echo "</td>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

  <div class="container mt-5 mb-5">
        <h4 class="mb-3">🎮 Popular Games</h4>
        <div class="row justify-content-center">
            
            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="image/cod.jpg" class="game-img" alt="CoD">
                    <div class="game-title">Call of Duty</div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="image/fifa.jpg" class="game-img" alt="FIFA">
                    <div class="game-title">EA FC (FIFA)</div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="image/valorant.jpg" class="game-img" alt="Valorant">
                    <div class="game-title">Valorant</div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="image/gta.jpg" class="game-img" alt="GTA V">
                    <div class="game-title">GTA V</div>
                </div>
            </div>

           <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="image/pubg.jpg" class="game-img" alt="PUBG">
                    <div class="game-title">PUBG</div>
                </div>
            </div>

        </div>
    </div> 
    
    <?php include('footer.php'); ?>

</body>
</html>