<?php 

// Authorization - Access control
// Check whether user is logged in or not
if(!isset($_SESSION['user']))

{
    // User is not logged in
    // Redirect To login page witg massege
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel.</div>";

    header('location:'.SITEURL.'admin/login.php');
}