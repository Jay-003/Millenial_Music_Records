<?php
session_start();
require "../connection.php";

if (!isset($_COOKIE['name'])) {
  header("Location: login.php");
  exit();
}

$username = $_COOKIE['name'];
$queryUser = $pdo->prepare("SELECT * FROM Users WHERE name = ?");
$queryUser->execute([$username]);
$user = $queryUser->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo "User not found";
  header("Location: login.php");
  exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$total = 0;
foreach ($cart as $item) {
  $total += floatval($item['price']) * $item['quantity'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buyNow"])) {
  if (count($cart) > 0) {
    $orderDate = date("Y-m-d");
    $insertOrder = $pdo->prepare("INSERT INTO Orders (Order_Date, UserID, Total) VALUES (?, ?, ?)");
    $success = $insertOrder->execute([$orderDate, $user['UserID'], $total]);
    $orderID = $pdo->lastInsertId();

    if ($success) {
      foreach ($cart as $cartItem) {
        $title = $cartItem['title'];
        $record = $pdo->prepare("SELECT * FROM Records WHERE Title = ?");
        $record->execute([$title]);
        $recordData = $record->fetch(PDO::FETCH_ASSOC);

        if ($recordData) {
          $recordID = $recordData['RecordID'];
          $itemTotal = floatval($cartItem['price']);
          $insertOrderDetail = $pdo->prepare("INSERT INTO OrderDetails (OrderID, RecordID, Quantity, TotalAmount) VALUES (?, ?, ?, ?)");
          $insertOrderDetail->execute([$orderID, $recordID, $cartItem['quantity'], $itemTotal]);
        }
      }

      unset($_SESSION['cart']);
      header('Location: cart.php');
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lab 9: Shopping Cart</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"
          integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="card">
        <h1 class="card-header text-center">Your Cart</h1>
        <div class="card-body">
            <?php if (count($cart) > 0): ?>
                      <table class="table table-bordered ">
                          <thead class="thead-dark">
                          <tr>
                              <th>Item Description</th>
                              <th>Price</th>
                              <th>Quantity</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($cart as $item): ?>
                                    <tr class="table-info">
                                      <td><?php echo htmlspecialchars($item["title"]); ?></td>
                                      <td>
                                          <p class="font-weight-bold">$<?php echo htmlspecialchars($item["price"]); ?></p>
                                      </td>
                                      <td><?php echo $item["quantity"]; ?></td>
                                    </tr>
                          <?php endforeach; ?>
                          </tbody>
                          <tfoot>
                          <tr class="table-danger">
                              <td>Total:</td>
                              <td class="font-weight-bold">$<?php echo number_format($total, 2); ?></td>
                              <td></td>
                          </tr>
                          <tr>
                            <td colspan="3">
                              <form action="" method="post">
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                <button type="submit" name="buyNow" class="btn btn-success">Buy Now</button>
                              </form>
                            </td>
                          </tr>
                          </tfoot>
                      </table>
                      <form action="../index.php?action=EmptyCart" method="post">
                    <p class="card-text">
                        <a href="../index.php" class="btn btn-primary">Continue shopping</a> or
                        <input type="submit" name="action" value="EmptyCart" class="btn btn-danger"/>
                    </p>
                </form>
            <?php else: ?>
                    <p>Your cart is empty!</p>
                    <form action="../index.php?action=EmptyCart" method="post">
                    <p class="card-text">
                        <a href="../index.php" class="btn btn-primary">Continue shopping</a>
                    </p>
                </form>
            <?php endif; ?>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"
            integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
            crossorigin="anonymous"></script>
</body>
</html>
