
<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password </h1>

            <br><br>

            <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                }

            ?>

            <form action="" method="post">
                <table class="tbl-30">

                    <tr>
                        <td>Current_Password: </td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current_Password">
                        </td>

                    </tr>

                    <tr>
                        <td>New_Password: </td>
                        <td>
                        <input type="password" name="new_password" placeholder="New_Password">
                        </td>

                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm_Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ;?>">
                            <input type="submit" name="submit" value="change_password">
                        </td>
                    </tr>

                </table>
            </form>

            </div>
    </div>


<?php include('partials/footer.php'); ?>


<?php 

if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

    $res = mysqli_query($conn, $sql);
    
    if($res == TRUE) 
    {
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // $row = mysqli_fetch_assoc($res);
            echo "User Found";
        }
        else 
        {
            $_SESSION['user-not-found'] = "<div class='error'> User Not Found</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
} 








