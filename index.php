<?php
include "./includes/db.php";
include "./includes/header.php";
include "./includes/navigation.php";
?>

<!-- Navigation -->


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>


            <?php
            $query = "SELECT * FROM posts WHERE status='published'";
            $obj = mysqli_query($connection, $query);
            if ($obj->num_rows <= 0) echo "<h1>No post found</h1>";
            while ($row = mysqli_fetch_assoc($obj)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_status = $row['status'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
            ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="image">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- footer -->
    <?php
    include "./includes/footer.php"
    ?>