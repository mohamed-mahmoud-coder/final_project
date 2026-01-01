<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tournament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style4.css"> </head>
<body>
<?php
session_start();
include("connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tournaments` WHERE `id` = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $game_name = $row['game_name'];
    $date = $row['date'];
    $prize = $row['prize'];
    $status = $row['status'];
} else {
    header("Location: admin_home.php");
    exit();
}

if (isset($_POST['b1'])) {
    $name = $_POST['name'];
    $game_name = $_POST['game_name'];
    $date = $_POST['date'];
    $prize = $_POST['prize'];
    $status = $_POST['status'];

    $sql2 = "UPDATE `tournaments` SET
             `name`='$name',
             `game_name`='$game_name',
             `date`='$date',
             `prize`='$prize',
             `status`='$status'
             WHERE `id`=$id";
             
    $result2 = mysqli_query($conn, $sql2);
    
    if ($result2) {
        header("Location: admin_home.php?msg=updated");
    } else {
        echo "<script>alert('An error occurred');</script>";
    }
}
?>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Admin Control Panel</span>
            <a href="admin_home.php" class="btn btn-outline-light btn-sm">Back</a>
        </div>
    </nav>

    <div class="wrapper">
        <div class="card p-4">
            <h3 class="text-center mb-4 card-title-text">Edit Tournament</h3>
            
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Tournament Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Game Name</label>
                    <select name="game_name" class="form-select">
                        <option value="Call of Duty" <?php if($game_name == 'Call of Duty') echo 'selected'; ?>>Call of Duty</option>
                        <option value="FIFA" <?php if($game_name == 'FIFA') echo 'selected'; ?>>FIFA</option>
                        <option value="Valorant" <?php if($game_name == 'Valorant') echo 'selected'; ?>>Valorant</option>
                        <option value="PUBG" <?php if($game_name == 'PUBG') echo 'selected'; ?>>PUBG</option>
                        <option value="GTA V" <?php if($game_name == 'GTA V') echo 'selected'; ?>>GTA V</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prize ($)</label>
                    <input type="text" name="prize" class="form-control" value="<?php echo $prize; ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="open" <?php if($status=="open") echo "selected"; ?>>Open</option>
                        <option value="closed" <?php if($status=="closed") echo "selected"; ?>>Closed</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <input type="submit" name="b1" class="btn btn-custom" value="Update Tournament">
                </div>
            </form>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>