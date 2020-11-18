    <?php
    if (isset($_GET['p_id'])) {
        $get_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id={$get_post_id}";
    $obj = mysqli_query($connection, $query);
    while ($rows = mysqli_fetch_assoc($obj)) {
        $post_id = $rows['post_id'];
        $post_author = $rows['post_author'];
        $post_title = $rows['post_title'];
        $post_cat_id = $rows['post_category_id'];
        $post_status = $rows['status'];
        $post_image = $rows['post_image'];
        $post_tags = $rows['post_tags'];
        $post_comments = $rows['post_comments_count'];
        $post_date = $rows['post_date'];
        $post_content = $rows['post_content'];
    }
    if (isset($_POST['update_post'])) {
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if (empty($post_image)) {
            $query = "SELECT * From posts where post_id={$get_post_id}";
            $obj = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($obj)) {
                $post_image = $row['post_image'];
            }
            confirm($obj);
        }

        $query = "UPDATE posts SET post_title='{$post_title}', post_author='{$post_author}',";
        $query .= " post_image='{$post_image}', post_date=now(), post_category_id={$post_category_id},";
        $query .= " status='{$post_status}', post_tags='{$post_tags}', post_content='{$post_content},'";
        $query .= " WHERE post_id = {$get_post_id}";

        $obj = mysqli_query($connection, $query);
        confirm($obj);
    }

    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Post Title</label>
            <input value="<?php echo $post_title ?>" type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label for="post_category">Post Category ID</label>
            <select name="post_category_id" id="">
                <?php
                $query = "SELECT * FROM categories";
                $obj = mysqli_query($connection, $query);
                confirm($obj);
                while ($rows = mysqli_fetch_assoc($obj)) {
                    $cat_title = $rows['cat_title'];
                    $cat_id = $rows['id'];
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
                ?> ?>

            </select>
        </div>
        <div class="form-group">
            <label for="title">Post Author</label>
            <input value="<?php echo $post_author ?>" type="text" class="form-control" name="author">
        </div>
        <div class="form-group">
            <label for="post_status">Post Status</label>
            <input value="<?php echo $post_status ?>" type="text" class="form-control" name="post_status">
        </div>

        <div class="form-group">
            <label for="post_image">Post Image</label>
            <img width="100" src="../images/<?php echo $post_image ?>" alt="">
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
        </div>
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
            <?php echo $post_content ?>
            </textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="update_post" value="Edit Post">
        </div>
    </form>