<?php include('partials/menu.php'); ?>
<!-- <?php include ("../config/constants.php"); ?>; -->

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category </h1>

        <br><br>

        <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_category WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                            <?php
                        } else {
                            echo "<div class='error'> Image Not Added </div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // updating Image
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            // Auto rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "Category_" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;

            // Check if the directory exists, if not create it
            if (!is_dir('../images/category/')) {
                mkdir('../images/category/', 0777, true);
            }

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                die();
            }

            // Remove the current image if available
            if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql2 = "UPDATE tbl_category SET 
    title='$title', 
    image_name='$image_name',
    featured='$featured',
    active='$active'
    WHERE id='$id'";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['update'] = "<div class='success'>Category has been Updated</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Category has not been Updated</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
}
?>
