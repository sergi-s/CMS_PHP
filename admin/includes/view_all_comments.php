<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM comments";
        $obj = mysqli_query($connection, $query);
        while ($rows = mysqli_fetch_assoc($obj)) {
            $comment_id = $rows['comment_id'];
            $comment_author = $rows['comment_author'];
            $comment_post_id = $rows['comment_post_id'];
            $comment_email = $rows['comment_email'];
            $comment_status = $rows['comment_status'];
            $comment_content = $rows['comment_content'];
            $comment_date = $rows['comment_date'];
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";


            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
            $obj2 = mysqli_query($connection, $query);
            while ($row2 = mysqli_fetch_assoc($obj2)) {
                $post_id = $row2['post_id'];
                $post_title = $row2['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }

            echo "<td>{$comment_date}</td>";


            echo "<td><a href='comments.php?source=view_all_comments&approve_comment={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?source=view_all_comments&unapprove_comment={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='comments.php?source=view_all_comments&delete={$comment_id}' >Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>


<?php
if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id={$the_comment_id}";
    $obj = mysqli_query($connection, $query);
    if (!$obj) {
        die("QWERY FAILED" . mysqli_error($connection));
    }
    $query = "UPDATE posts SET post_comments_count=post_comments_count-1 ";
    $query .= "WHERE post_id={$post_id}";
    $obj = mysqli_query($connection, $query);
    if (!$obj) {
        die("QWERY FAILED" . mysqli_error($connection));
    }
    header("Location: comments.php?source=view_all_comments");
}

if (isset($_GET['unapprove_comment'])) {
    echo "<h1>Hello</h1>";
    $the_comment_id = $_GET['unapprove_comment'];
    $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id={$the_comment_id}";
    $obj = mysqli_query($connection, $query);
    header("Location: comments.php?source=view_all_comments");
}
if (isset($_GET['approve_comment'])) {
    $the_comment_id = $_GET['approve_comment'];
    $query = "UPDATE comments SET comment_status='approved' WHERE comment_id={$the_comment_id}";
    $obj = mysqli_query($connection, $query);
    header("Location: comments.php?source=view_all_comments");
}
?>