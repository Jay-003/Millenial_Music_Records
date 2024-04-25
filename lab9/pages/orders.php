<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$queryOrders = $pdo->prepare("SELECT Orders.OrderID, Orders.Order_Date, Records.RecordID, GROUP_CONCAT(CONCAT(Records.Title, '(', OrderDetails.Quantity, ')') SEPARATOR ', ') as RecordTitles, SUM(OrderDetails.Quantity) as TotalQuantity, Orders.Total as OrderTotal
                              FROM Orders
                              JOIN OrderDetails ON Orders.OrderID = OrderDetails.OrderID
                              JOIN Records ON OrderDetails.RecordID = Records.RecordID
                              WHERE Orders.UserID = ?
                              GROUP BY Orders.OrderID
                              ORDER BY Orders.Order_Date DESC");
$queryOrders->execute([$user['UserID']]);
$orders = $queryOrders->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete']) && isset($_POST['ordID'])) {

  $orderIDToDelete = $_POST['ordID'];

  $queryOrderDetails = $pdo->prepare("DELETE FROM OrderDetails WHERE OrderID = ?");
  $queryOrderDetails->execute([$orderIDToDelete]);

  $queryOrdersTable = $pdo->prepare("DELETE FROM Orders WHERE OrderID = ?");
  $queryOrdersTable->execute([$orderIDToDelete]);

  header('Location: orders.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container mt-5">
    <h2 class="display-2">Order History</h2>
    <hr class="my-4">
    <?php if (count($orders) > 0): ?>
        <table class="table table-bordered">
          <thead class="thead-dark">
          <tr>
              <th>Order Date</th>
              <th>Record Titles</th>
              <th>Quantity</th>
              <th>Order Total</th>
              <th>Edit Order</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($orders as $order): ?>
                  <tr class="table-info">
                      <td><?php echo $order['Order_Date']; ?></td>
                      <td><?php echo $order['RecordTitles']; ?></td>
                      <td><?php echo $order['TotalQuantity']; ?></td>
                      <td>$<?php echo $order['OrderTotal']; ?></td>
                      <td>
                        <form method="post" action="">
                            <input type="hidden" name="ordID" value="<?php echo $order['OrderID']; ?>">
                            <button type="submit" class="btn btn-primary" name="update" id="updateButton">Update</button>
                            <button type="submit" class="btn btn-danger" name="delete" id="deleteButton">Delete</button>
                        </form>
                      </td>
                  </tr>

          <?php endforeach; ?>
          </tbody>
        </table>
                            
    <?php else: ?>
          <p>No orders found.</p>
    <?php endif; ?>

    <hr class="my-4">

    <a href="../index.php" class="btn btn-primary mt-3">Home</a>
</div>

</body>

</html>
