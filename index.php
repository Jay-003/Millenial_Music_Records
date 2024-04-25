<?php
session_start();

include "connection.php";
include "includes/hipHop.php";
include "includes/jazz.php";
include "includes/rock.php";

$items = array_merge($hipHop, $jazz, $rock);

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
  session_regenerate_id(true);
}

if (isset($_POST['action']) && $_POST['action'] == 'AddToCart') {
  $item = array(
    'title' => $_POST['title'],
    'price' => $_POST['price'],
    'quantity' => 1
  );

  $found = false;
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as &$cartItem) {
      if ($cartItem['title'] === $item['title']) {
        $cartItem['quantity'] += 1;
        $found = true;
        break;
      }
    }
  }

  if (!$found) {
    $_SESSION['cart'][] = $item;
  }

  header('Location: .');
  exit;
}

if (isset($_GET['action']) and $_GET['action'] == 'EmptyCart') {
  unset($_SESSION['cart']);
  header('Location: index.php');
  exit;
}

if (isset($_GET['cart'])) {

  $cart = array();

  foreach ($_SESSION['cart'] as $cartItem) {
    foreach ($items as $item) {
      if ($item['Title'] == $cartItem['title']) {
        $cart[] = $item;
        break;
      }
    }
  }

  include 'pages/cart.php';
  exit;
}
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>CSCI 2170 - Lab9</title>
        <meta name="Millenial music records" content="Title of Site">
        <meta name="Jay Modi" content="Author Name">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </head>

    <body>
        <header>
            <?php include "sections/header.php"; ?>
        </header>
        <main>
            <?php include "sections/catalog.php"; ?>
        </main>

        <footer>
            <p>&copy;Copyright Jay Modi</p>
        </footer>
    </body>
    
</html>
