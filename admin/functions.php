<?php
function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "This feild should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) Value('{$cat_title}')";
            $obj = mysqli_query($connection, $query);

            if (!$obj) {
                die('Query Failed' . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $obj = mysqli_query($connection, $query);
    while ($rows = mysqli_fetch_assoc($obj)) {
        $cat_title = $rows['cat_title'];
        $cat_id = $rows['id'];
        echo "<tr><td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td></tr>";
    }
}

function delete_categories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $D_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE id={$D_cat_id}";
        $obj = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function confirm($obj)
{
    global $connection;
    if (!$obj) {
        die("Query failed" . mysqli_error($connection));
    }
}
