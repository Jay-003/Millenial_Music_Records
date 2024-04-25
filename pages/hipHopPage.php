<?php
session_start();

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

    header('Location: hipHopPage.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HipHop Albums</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <?php
    include '../includes/hipHop.php';
    ?>
</head>
<body>
    <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
                    <div class="container-fluid">
                    <a class="navbar-brand" href="../index.php">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav">
                           <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="hipHopPage.php">HipHop</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="jazzPage.php">Jazz</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="rockPage.php">Rock</a>
                        </li>
                      </ul>
                    </div>
                    <div class="navbar-nav ml-auto">
                      <li class="nav-item">
                        <?php
                        $totalItems = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $cartItem) {
                                $totalItems += $cartItem['quantity'];
                            }
                        }
                        ?>
                        <a class="nav-link" href="cart.php">Cart(<?php echo $totalItems; ?>)</a>
                      </li>
                         <?php if (isset($_COOKIE["username"])) {
                             $username = $_COOKIE["username"];
                             echo '<span class="navbar-text mr-3">Welcome back, ' .
                                 $username .
                                 "!</span>";
                             echo '<a href="pages/logout.php" class="btn btn-danger">Logout</a>';
                         } else {
                             echo '<a href="pages/login.php" class="btn btn-primary">Login</a>';
                         } ?>
                    </div>
                  </div>
            </nav>
            <section id="description">
                <h1>Millenial music records</h1>
            </section>
        </header>
        <main>
            <div class="container px-4">
                <div class="row gx-5">
                    <?php foreach ($hipHop as $album): ?>
                                    <div class="col">
                                        <div class="p-3 border bg-light">
                                            <?php
                                            $basePath = "../";
                                            $imagePath = $basePath . $album['cover_image'];
                                            ?>
                                            <img src="<?php echo $imagePath; ?>" class="figure-img img-fluid rounded" alt="Album Cover">
                                            <p>Band Name: <?php echo $album['Band Name']; ?></p>
                                            <p>Title: <?php echo $album['Title']; ?></p>
                                            <p>Price: $<?php echo $album['Price']; ?></p>
                                            <p>Format: <?php echo $album['Format']; ?></p>
                                            <p>Record Label: <?php echo $album['Record Label']; ?></p>
                                            <p>Year of Release: <?php echo $album['Year of Release']; ?></p>

                                            <form action="" method="post">
                                                <input type="hidden" name="title" value="<?php echo htmlspecialchars($album["Title"]); ?>">
                                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($album["Price"]); ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-primary" name="action" value="AddToCart">Buy Now</button>
                                            </form>
                                        </div>
                                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        <footer>
            <p>&copy;Copyright Jay Modi</p>
        </footer>
        </body>
</html>
