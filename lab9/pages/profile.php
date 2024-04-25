<?php
require "../connection.php";

// if (!isset($_COOKIE['name'])) {
//     header("Location: login.php");
//     exit();
// }

$username = $_COOKIE['name'];
$query = $pdo->prepare("SELECT * FROM Users WHERE name = ?");
$query->execute([$username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found";
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $newName = $_POST['newName'];
    $newUserName = $_POST['newUserName'];
    $newEmail = $_POST['newEmail'];
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

    $updateQuery = $pdo->prepare("UPDATE Users SET name = ?, userName = ?, email = ?, password = ? WHERE name = ?");
    $updateQuery->execute([$newName, $newUserName, $newEmail, $newPassword, $username]);

    $query = $pdo->prepare("SELECT * FROM Users WHERE name = ?");
    $query->execute([$newName]);
    $user = $query->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $deleteQuery = $pdo->prepare("DELETE FROM Users WHERE name = ?");
    $deleteQuery->execute([$username]);

    header("Location: logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container mt-5">
    <h2 class="display-2">Your Profile</h2>
    <hr class="my-4">
    <h5 class="mb-4">Welcome, <?php echo $user['name']; ?>!</h5>

    <form method="post" action="">
        <div class="form-group">
            <label for="newName">Update Name:</label>
            <input type="text" class="form-control" id="newName" name="newName" value="<?php echo $user['name']; ?>">
        </div>
        <div class="form-group">
            <label for="newUserName">Update Username:</label>
            <input type="text" class="form-control" id="newUserName" name="newUserName" value="<?php echo $user['userName']; ?>">
        </div>
        <div class="form-group">
            <label for="newEmail">Update Email:</label>
            <input type="email" class="form-control" id="newEmail" name="newEmail" value="<?php echo $user['email']; ?>">
        </div>
        <div class="form-group">
            <label for="newPassword">Update Password:</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword">
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <button type="submit" class="btn btn-danger" name="delete" id="updateButton">Delete Account</button>
    </form>

    <hr class="my-4">

    <a href="../index.php" class="btn btn-primary mt-3">Home</a>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>

</body>

</html>
