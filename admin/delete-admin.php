<?php 

include ("../config/constants.php");

$id = $_GET['id'];

$sql = "DELETE FROM tbl_admin WHERE id = $id";

$res = mysqli_query($conn,$sql);

if ($res == TRUE) {

    $_SESSION['delete'] = "<div class='success'>Admin has been Deleted</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
    // echo "Admin has been Deleted";
    // sleep(3);
}else {
    $_SESSION['delete'] = "<div class='error'>Admin hasnot been Deleted</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

// echo 'Admin hasnot been Deleted';

}