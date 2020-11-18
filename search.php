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

            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE  '%$search%'";
                $obj = mysqli_query($connection, $query);

                if (!$obj) {
                    die("Query Failed" . mysqli_error($connection));
                }
                $count = mysqli_num_rows($obj);
                if ($count == 0) {
                    echo "<h1>No results</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($obj)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        echo "<a href='#'>  {$post_title}</a>";
            ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> at 10:00 PM</p>
                        <hr>
                        <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
            <?php
                    }
                }
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