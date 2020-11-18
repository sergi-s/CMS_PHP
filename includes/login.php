<?php include "db.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username='$username'";
    $obj = mysqli_query($connection, $query);
    if (!$query) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
    if ($obj->num_rows <= 0) header("Location: ../index.php");

    while ($row = mysqli_fetch_assoc($obj)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_role = $row['user_role'];
        $db_password = $row['user_password'];
        if ($password == $db_password) {
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['role'] = $db_role;
            header("Location: ../admin");
        } else {
            header("Location: ../index.php");
        }
    }
}
