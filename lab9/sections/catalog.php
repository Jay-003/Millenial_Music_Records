<div class="container px-4">
        <div class="row gx-5">
            <div class="col-md-4">
                <div class="p-3 border bg-light">
                    <?php echo '<img src="' .
                      $hipHop[0]["cover_image"] .
                      '" class="figure-img img-fluid rounded;" alt="Album Cover">'; ?>
                    <div class="container fluid">
                        <div class="p-3 border bg-light">
                            <p>Band Name: <?php echo $hipHop[0][
                              "Band Name"
                            ]; ?></p>
                            <p>Title: <?php echo $hipHop[0]["Title"]; ?></p>
                            <p>Price: $<?php echo $hipHop[0]["Price"]; ?></p>
                            <p>Format: <?php echo $hipHop[0]["Format"]; ?></p>
                            <p>Record Label: <?php echo $hipHop[0][
                              "Record Label"
                            ]; ?></p>
                            <p>Year of Release: <?php echo $hipHop[0][
                              "Year of Release"
                            ]; ?></p>
                            <form action="" method="post">
                                <input type="hidden" name="title" value="<?php echo htmlspecialchars($hipHop[0]["Title"]); ?>">
                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($hipHop[0]["Price"]); ?>">
                                <button type="submit" class="btn btn-primary" name="action" value="AddToCart">Buy Now</button>
                            </form>
                            <a href="pages/hipHopPage.php">
                                <button type="button" class="btn btn-link">Explore More</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border bg-light">
                    <?php echo '<img src="' .
                      $jazz[0]["cover_image"] .
                      '" class="figure-img img-fluid rounded;" alt="Album Cover">'; ?>
                    <div class="container fluid">
                        <div class="p-3 border bg-light">
                            <p>Band Name: <?php echo $jazz[0][
                              "Band Name"
                            ]; ?></p>
                            <p>Title: <?php echo $jazz[0]["Title"]; ?></p>
                            <p>Price: $<?php echo $jazz[0]["Price"]; ?></p>
                            <p>Format: <?php echo $jazz[0]["Format"]; ?></p>
                            <p>Record Label: <?php echo $jazz[0][
                              "Record Label"
                            ]; ?></p>
                            <p>Year of Release: <?php echo $jazz[0][
                              "Year of Release"
                            ]; ?></p>
                            <form action="" method="post">
                                <input type="hidden" name="title" value="<?php echo htmlspecialchars($jazz[0]["Title"]); ?>">
                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($jazz[0]["Price"]); ?>">
                                <button type="submit" class="btn btn-primary" name="action" value="AddToCart">Buy Now</button>
                            </form>
                            <a href="pages/jazzPage.php">
                                <button type="button" class="btn btn-link">Explore More</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border bg-light">
                    <?php echo '<img src="' .
                      $rock[0]["cover_image"] .
                      '" class="figure-img img-fluid rounded;" alt="Album Cover">'; ?>
                    <div class="container fluid">
                        <div class="p-3 border bg-light">
                            <p>Band Name: <?php echo $rock[0][
                              "Band Name"
                            ]; ?></p>
                            <p>Title: <?php echo $rock[0]["Title"]; ?></p>
                            <p>Price: $<?php echo $rock[0]["Price"]; ?></p>
                            <p>Format: <?php echo $rock[0]["Format"]; ?></p>
                            <p>Record Label: <?php echo $rock[0][
                              "Record Label"
                            ]; ?></p>
                            <p>Year of Release: <?php echo $rock[0][
                              "Year of Release"
                            ]; ?></p>
                            <form action="" method="post">
                                <input type="hidden" name="title" value="<?php echo htmlspecialchars($rock[0]["Title"]); ?>">
                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($rock[0]["Price"]); ?>">
                                <button type="submit" class="btn btn-primary" name="action" value="AddToCart">Buy Now</button>
                            </form>
                            <a href="pages/rockPage.php">
                                <button type="button" class="btn btn-link">Explore More</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>