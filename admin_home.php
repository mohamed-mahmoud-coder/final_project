<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1a1a2e; color: #fff; }
        .card { background-color: #16213e; border: 1px solid #0f3460; }
        .form-control, .form-select { background-color: #0f3460; border: none; color: white; }
        .form-control:focus { background-color: #0f3460; color: white; box-shadow: none; }
    </style>
</head>
<body>
    <?php
session_start();
include("connect.php");


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$msg = "";


if (isset($_POST['b2'])) {
    $name = $_POST['name'];
    $game_name = $_POST['game_name'];
    $date = $_POST['date'];
    $prize = $_POST['prize'];
    $status = "open";
    $sql1 = "INSERT INTO `tournaments` (`name`, `game_name`, `date`, `prize`, `status`)
     VALUES ( '$name', '$game_name', '$date', '$prize', '$status');";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1) {
        header("Location: admin_home.php?success=1");
       
    } else {
        $msg = "Error adding tournament: " . mysqli_error($conn);
    }
    
}
if (isset($_GET['success'])) {
    $msg = "Tournament Added Successfully!";
}
?>
           
                   


<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">Admin Control Panel</span>
        <a href="login.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    <?php if ($msg != "") echo "<div class='alert alert-success'>$msg</div>"; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4 class="mb-3 text-center" style="color: #ffffff">Add New Tournament</h4>
                <form method="post">
                    <div class="mb-2" style="color: #ffffff">
                        <label>Tournament Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2" style="color: #ffffff">
                        <label>Game:</label>
                        <select name="game_name" class="form-select">
                            <option value="Call of Duty">Call of Duty</option>
                            <option value="FIFA">FIFA</option>
                            <option value="Valorant">Valorant</option>
                            <option value="PUBG">PUBG</option>
                            <option value="GTA V">GTA V</option>
                        </select>
                    </div>
                    <div class="mb-2" style="color: #ffffff">
                        <label>Date:</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-2" style="color: #ffffff">
                        <label>Prize ($):</label>
                        <input type="text" name="prize" class="form-control" placeholder="e.g. 1000$" required>
                    </div>
                    <button type="submit" name="b2" class="btn btn-primary w-100 mt-3">Add Tournament</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-3 shadow" style="color: #ffffff">
                <h4>Manage Tournaments</h4>
                <table class="table table-dark table-hover mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Game</th>
                            <th>Date</th>
                            <th>Prize</th>
                            <th>Status</th>
                        </tr>
                        <?php
                         $sql2 = "SELECT * FROM tournaments ORDER BY id DESC";
               $result2 = mysqli_query($conn, $sql2);
                        
                while ($row = mysqli_fetch_assoc($result2)) {
                           echo "<tr>";
                 echo "<td>" . $row['id'] . "</td>";
                     echo "<td>" . $row['name'] . "</td>";
                   echo "<td>" . $row['game_name'] . "</td>";
                          echo "<td>" . $row['date'] . "</td>";
                          echo "<td>" . $row['prize'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>