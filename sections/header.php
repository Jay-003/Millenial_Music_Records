<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                 <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="pages/hipHopPage.php">HipHop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/jazzPage.php">Jazz</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/rockPage.php">Rock</a>
                </li>
              </ul>
            </div>
            <div class="d-flex align-items-center">
                <?php if (isset($_COOKIE["name"])) {
                  $username = $_COOKIE["name"];
                  echo '<span class="navbar-text mr-3">Hey, ' .
                    $username .
                    "!</span>";
                }
                ?>
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
                  <a class="nav-link" href="pages/cart.php">Cart(<?php echo $totalItems; ?>)</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="pages/orders.php">Order History</a>
              </li>
                  <?php if (isset($_COOKIE["name"])) {
                    echo '<a href="pages/logout.php" class="btn btn-danger">Logout</a>&nbsp;';
                    echo '<a href="pages/profile.php" class="btn btn-primary">View Profile</a>';
                  } else {
                    echo '<a href="pages/login.php" class="btn btn-primary">Login</a>&nbsp;';
                    echo '<a href="pages/register.php" class="btn btn-primary">Register </a>';
                  } ?>
            </div>
          </div>
      </nav>
      <section id="description">
        <h1>Millenial music records</h1>
      </section>