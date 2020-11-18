<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Categorie</th>
            <th>Status</th>
            <th>image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
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
            echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            $query = "SELECT * FROM categories WHERE id={$post_cat_id}";
            $obj2 = mysqli_query($connection, $query);
            while ($rows2 = mysqli_fetch_assoc($obj2)) {
                $cat_title = $rows2['cat_title'];
                $cat_id = $rows2['id'];
                echo "<td>{$cat_title}</td>";
            }



            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' src='../images/$post_image' alt='image'</img></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comments}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?source=view_all_posts&delete={$post_id}' >Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>


<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
    $obj = mysqli_query($connection, $query);
    header("Location: posts.php?source=view_all_posts");
}
?>