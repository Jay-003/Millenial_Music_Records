<?php

require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $username = trim($_POST["userName"]);
  $password = trim($_POST["password"]);

  $query = $pdo->prepare("SELECT * FROM Users WHERE userName = ?");
  $query->execute([$username]);
  $user = $query->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    $name = $user['name'];
    setcookie("name", $name, time() + 3600 * 24 * 365, "/", "", true, true);
    header("Location: ../index.php");
    exit();
  } else {
    echo '<p class="text-danger text-center">Invalid username or password.</p>';
  }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>
  
  <header>
    <h2 class="display-2">Login Page</h2>
    <hr class="my-4">
  </header>
  <main>
    <div class="container">
      <form method="post" action="">
        <div class="mb-3">
          <label for="username" class="form-label">User Name</label>
          <input type="text" class="form-control" id="userName" name="userName" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy;Copyright Jay Modi</p>
  </footer>

</body>

</html>