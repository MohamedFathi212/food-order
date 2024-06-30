<?php include ('partials-front/menu.php') ;?>


<?php 

if(isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    $res= mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($res);

    $category_title = $row['title'];


}
else
{
    // category not passed
    // Redirect home page

    header('location:'.SITEURL);

}
?>

<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>

</section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                $res2 = mysqli_query($conn, $sql2);
        if ($res2 == TRUE) {
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($rows2 = mysqli_fetch_assoc($res2)) {
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
    