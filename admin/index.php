<?php include "partials/menu.php"; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBORD</h1>

            <?php 
        if(isset($_SESSION['login']))
            
        {
            echo $_SESSION['login'];
            unset ($_SESSION['login']);
        } 
    
            ?>
            <br><br>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="clearfix">

            </div>
        </div>    
    </div>

    <!-- Main Content Section End -->

    
    <?php include "partials/footer.php"; ?>
