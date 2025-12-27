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

// 2. كود إضافة بطولة جديدة عند ضغط الزر
if (isset($_POST['add_tournament'])) {
    $name = $_POST['name'];
    $game_name = $_POST['game_name'];
    $date = $_POST['date'];
    $prize = $_POST['prize'];

    $sql = "INSERT INTO tournaments (name, game_name, date, prize, status) 
            VALUES ('$name', '$game_name', '$date', '$prize', 'open')";
    
    if (mysqli_query($conn, $sql)) {
        $msg = "Tournament Added Successfully!";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}
?>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">Admin Control Panel</span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    <?php if ($msg != "") echo "<div class='alert alert-success'>$msg</div>"; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4 class="mb-3 text-center">Add New Tournament</h4>
                <form method="post">
                    <div class="mb-2">
                        <label>Tournament Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Game:</label>
                        <select name="game_name" class="form-select">
                            <option value="Call of Duty">Call of Duty</option>
                            <option value="FIFA">FIFA</option>
                            <option value="Valorant">Valorant</option>
                            <option value="PUBG">PUBG</option>
                            <option value="GTA V">GTA V</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Date:</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Prize ($):</label>
                        <input type="text" name="prize" class="form-control" placeholder="e.g. 1000$" required>
                    </div>
                    <button type="submit" name="add_tournament" class="btn btn-primary w-100 mt-3">Add Tournament</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-3 shadow">
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
                    </thead>
                    <tbody>
                        <?php
                        // جلب البطولات من قاعدة البيانات
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>