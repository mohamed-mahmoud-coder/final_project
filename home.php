<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
     
.game-card {
    transition: transform 0.3s ease;
    cursor: pointer;
}
.game-card:hover {
    transform: scale(1.05); 
    opacity: 0.8;
}
.game-img {
    width: 100%;
    height: 150px; 
    object-fit: cover; 
    border-radius: 15px;
    border: 2px solid #2a2a40;
}
.game-title {
    text-align: center;
    margin-top: 5px;
    font-size: 0.9rem;
    color: #ccc;
}
     
        body {
            background-color: #1a1a2e;
            color: #fff;
            font-family: sans-serif;
        }
        .card {
            background-color: #16213e;
            border: 1px solid #0f3460;
            color: white;
            margin-top: 20px;
        }
        
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #e94560;
            object-fit: cover;
            margin-top: -75px;
            background-color: #1a1a2e;
        }
        
        .header-bg {
            background: linear-gradient(90deg, #0f3460 0%, #e94560 100%);
            height: 150px;
            border-radius: 0 0 20px 20px;
        }
        .table-dark { background-color: #16213e; }
        .btn-custom { background-color: #e94560; color: white; border: none; }
        .btn-custom:hover { background-color: #c0354e; color: white; }
    </style>
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
?>



</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Gaming Hub</span>
            <a href="login.php" class="btn btn-outline-danger btn-sm">Logout</a>
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
                                <th>Tournament</th>
                                <th>Game</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Summer Cup</td>
                                <td>Call of Duty</td>
                                <td>2025-5-17</td>
                                <td><button class="btn btn-sm btn-custom">Join Now</button></td>
                            </tr>
                            <tr>
                                <td>FIFA League</td>
                                <td>FIFA</td>
                                <td>2026-01-05</td>
                                <td><button class="btn btn-sm btn-custom">Join Now</button></td>
                            </tr>
                            <tr>
                                    <td>Summer Championship</td>
                                    <td>Call of Duty</td>
                                    <td>2025-12-30</td>
                                    <td><button class="btn btn-sm btn-custom">Join Now</button></td>
                                </tr>
                                <tr>
                                    <td>Sniper Elite</td>
                                    <td>PUBG</td>
                                    <td>2026-06-18</td>
                                    <td><button class="btn btn-sm btn-custom">Join Now</button></td>
                                </tr>
                                <tr>
                                    <td>Valorent Cup</td>
                                    <td>Valorent</td>
                                    <td>2026-03-10</td>
                                    <td><button class="btn btn-sm btn-custom">Join Now</button></td>
                                </tr>
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
                    <img src="https://image.api.playstation.com/vulcan/ap/rnd/202310/0212/8673a005e83f3951cb7e527d21650b28e6704043232eb2c1.png" class="game-img" alt="CoD">
                    <div class="game-title">Call of Duty</div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="https://upload.wikimedia.org/wikipedia/en/b/bb/EA_Sports_FC_24_cover.jpg" class="game-img" alt="FIFA">
                    <div class="game-title">EA FC (FIFA)</div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/1/14/Valorant_cover_art.jpg/220px-Valorant_cover_art.jpg" class="game-img" alt="Valorant">
                    <div class="game-title">Valorant</div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png" class="game-img" alt="GTA V">
                    <div class="game-title">GTA V</div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="game-card">
                    <img src="https://upload.wikimedia.org/wikipedia/en/2/25/PUBG_Battlegrounds_key_art.jpg" class="game-img" alt="PUBG">
                    <div class="game-title">PUBG</div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>