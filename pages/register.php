<?php
require "../connection.php";

$validate = true;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

  $name = $_POST["name"];
  if (!filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z]+( [a-zA-Z]+)*$/")))) {
    echo '<p class="text-danger text-center">First name must contain letters and if it includes a middle name, there should be a space between first and middle names.</p>';
    $validate = false;
  }

  $userName = $_POST["userName"];
  if (!filter_var($userName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-]+$/")))) {
    echo '<p class="text-danger text-center">Last name must contain letters, apostrophes, and hyphens.</p>';
    $validate = false;
  }

  $email = $_POST["email"];
  if (empty($email)) {
    echo '<p class="text-danger text-center">Email is required.</p>';
    $validate = false;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<p class="text-danger text-center">Invalid email format.</p>';
    $validate = false;
  }

  $password = $_POST["password"];
  if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{12,}$/")))) {
    echo '<p class="text-danger text-center">Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and be at least 12 characters long.</p>';
    $validate = false;
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  }

  $confirmPassword = $_POST["confirmPassword"];
  if ($confirmPassword != $password) {
    echo '<p class="text-danger text-center">Password and Confirm password must match.</p>';
    $validate = false;
  }

  if ($validate) {
    $queryUsers = $pdo->prepare("INSERT INTO Users (name, userName, email, password) VALUES (?, ?, ?, ?)");

    if (!$queryUsers->execute([$name, $userName, $email, $hashedPassword])) {
      echo "Database error: " . implode(" ", $queryUsers->errorInfo());
      exit();
    }

    header("Location: login.php");
    exit();
  }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <h2 class="display-2">Registration Form</h2>
    <hr class="my-4">
  </header>
  <main>
    <div class="container">

      <form method="post" action="">
        <div class="mb-3">
          <label for="validationCustom01" class="form-label">Name</label>
          <input type="text" class="form-control" id="validationCustom01" name="name" required>
        </div>
        <div class="mb-3">
          <label for="validationCustom02" class="form-label">User name</label>
          <input type="text" class="form-control" id="validationCustom02" name="userName" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputConfirmPassword1" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="confirmPassword" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>

    </div>
  </main>

  <footer>
    <p>&copy;Copyright Jay Modi</p>
  </footer>

</body>

</html>