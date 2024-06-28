<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>
        <?php 

            if(isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data" class="food-form">
            <table>
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the Food" required></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food" required></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" required></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image" required></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" required>
                            <?php 
                                // استعلام SQL لاسترداد الفئات النشطة فقط
                                $sql = "SELECT * FROM tbl_category WHERE active ='Yes'";
                                $res = mysqli_query($conn, $sql);
                                
                                if(mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$id'>$title</option>";
                                    }
                                } else {
                                    echo "<option value='0'>No Category Found</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes" required> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes" required> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) {

                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $featured = isset($_POST['featured']) ? $_POST['featured'] : 'no';
                $active = isset($_POST['active']) ? $_POST['active'] : 'no';


                $image_name = '';

                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];
                    $image_temp = $_FILES['image']['tmp_name'];


                    $upload_directory = '../images/food/';


                    if (!is_dir($upload_directory)) {
                        mkdir($upload_directory, 0777, true);
                    }


                    $destination = $upload_directory . $image_name;
                    if (move_uploaded_file($image_temp, $destination)) {

                    } else {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header('location: ' . SITEURL . 'admin/add-food.php');
                        exit();
                    }
                }

                $sql2 = "INSERT INTO tbl_food (title, description, price, image_name, categories_id, featured, active)
                        VALUES ('$title', '$description', $price, '$image_name', $category, '$featured', '$active')";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2) {
                    $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                    header("location: " . SITEURL . "admin/manage-food.php");
                    exit();
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                    header("location: " . SITEURL . "admin/manage-food.php");
                    exit();
                }
            }
        ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
