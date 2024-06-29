<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <?php
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];  
                $price = $row2['price'];  
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>Food Not Found</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                die(); 
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
                    <td>Description: </td>
                    <td><textarea name="description"><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class='error'> Image Not Available.</div>";
                        } else {
                            echo "<img src='" . SITEURL . "images/food/" . $current_image . "' width='100px'>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                            $sql = "SELECT * FROM tbl_category WHERE active ='Yes'";
                            $res = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    ?>
                                    <option <?php if ($current_category == $category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
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
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // updating Image
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            $ext = explode('.', $image_name);
            $file_extension = end($ext);
            $image_name = "Food_Name_" . rand(000, 999) . '.' . $file_extension;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;

            // Check if the directory exists, if not create it
            if (!is_dir('../images/food/')) {
                mkdir('../images/food/', 0777, true);
            }

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                die();  
            }

            // Remove the current image if available
            if ($current_image != "") {
                $remove_path = "../images/food/" . $current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    die(); 
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql3 = "UPDATE tbl_food SET 
        title='$title', 
        description='$description', 
        price='$price',
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'
        WHERE id='$id'";

    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == TRUE) {
        $_SESSION['update'] = "<div class='success'>Food has been Updated</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Food has not been Updated</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
}
?>
