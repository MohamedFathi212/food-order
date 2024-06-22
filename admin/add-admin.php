<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Add Admin </h1>

            <br><br>

            <?php if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            } 

            if(isset($_SESSION['delete']))

            {
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            } 

            if(isset($_SESSION['update']))
            
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            } 
            
            ?>

            <form action="" method="post">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"  ></td>
                    </tr>

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
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondry">
                        </td>
                    </tr>

                </table>
            </form>


        </div>
</div>           



<?php include('partials/footer.php'); ?>


<?php 

if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);



    $sql = "INSERT INTO tbl_admin SET 
        full_name = '$full_name',
        username = '$username',
        password = '$password'
    
    ";

    $res = mysqli_query($conn,$sql);

    if($res == TRUE) {


        $_SESSION['add'] = "Admin Added Successfully";
        header("location:".SITEURL.'admin/manage-admin.php');
        // echo "Data Inserted";


    }else {
        $_SESSION['add'] = "Failed Added Admin";
        header("location:".SITEURL.'admin/add-admin.php');


        // echo "Data is not Inserted";


    }

    // mysqli_set_charset($conn, "utf8");


    // Prepare the SQL statement
    // $in = "INSERT INTO `tbl_admin` (`full_name`, `username`, `password`) VALUES ('$full_name', '$username', '$password')";


}




