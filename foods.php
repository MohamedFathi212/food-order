
<?php include ('partials-front/menu.php') ;?>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' ";
        $res2 = mysqli_query($conn, $sql2);
        if ($res2 == TRUE) {
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($rows2 = mysqli_fetch_assoc($res2)) {
                    $id = $rows2['id'];
                    $title = $rows2['title'];
                    $price = $rows2['price'];
                    $description = $rows2['description'];
                    $image_name = $rows2['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if($image_name == "")
                            {
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {

                                ?>
                                <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php 
                            }
                            
                            ?>
                        </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                    <?php 
                }
            }
        }
        else
        {
            echo "<div class='error'>Food NOT Available</div>";
        }
        ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include ('partials-front/footer.php') ;?>
