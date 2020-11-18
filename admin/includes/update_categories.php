<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit category</label>
        <?php
        if (isset($_GET["edit"])) {
            $E_cat_id = $_GET["edit"];
            $query = "SELECT * FROM categories WHERE id={$E_cat_id}";
            $obj = mysqli_query($connection, $query);
            while ($rows = mysqli_fetch_assoc($obj)) {
                $cat_title = $rows['cat_title'];
                $cat_id = $rows['id'];
        ?>
                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" class="form-control" type="text" name="cat_title">
        <?php
            }
        }
        ?>
        <?php
        if (isset($_POST['update_category'])) {
            $U_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title='{$U_cat_title}' WHERE id={$cat_id}";
            $obj = mysqli_query($connection, $query);
            if (!$obj) {
                die("Query failed" . mysqli_error(($connection)));
            }
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update">
    </div>
</form>