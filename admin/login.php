<?php include("../config/constants.php");?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>


            <?php 
            
            if(isset($_SESSION['login']))
            
            {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            } 
            

            if(isset($_SESSION['no-login-message']))
            
            {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            } 
            
            ?>
            <br><br>
                <form action="" method="post">

                        <table class="tbl-30">
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" placeholder=" Your Username" ></td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" placeholder=" Your Password" ></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Login" class="btn-secondry">
                            </td>
                        </tr>

                        </table>
                        <br><br>
                </form>
            <p class="text-center">Created By - <a href="www.Fott">Mohamed Fathi</a></p>
        </div>
    </body>
</html>

<?php

if(isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // تأكد من إحاطة $username بعلامات الاقتباس في استعلام SQL
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($conn, $sql);
    
    if($res == TRUE) {
        $count = mysqli_num_rows($res);

        if($count == 1) {
            $_SESSION['login'] = "<div class='success'>Login Successfully</div>";
            $_SESSION['user']  =$username;
            header('location:'.SITEURL.'admin/');
        } else {
            $_SESSION['login'] = "<div class='error'> Username Or Password Wrong</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
}









?>