<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $obj = mysqli_query($connection, $query);
        while ($rows = mysqli_fetch_assoc($obj)) {
            $user_id = $rows['user_id'];
            $username = $rows['username'];
            $user_password = $rows['user_password'];
            $user_firstname = $rows['user_firstname'];
            $user_lastname = $rows['user_lastname'];
            $user_email = $rows['user_email'];
            $user_image = $rows['user_image'];
            $user_role = $rows['user_role'];
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";


            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_image}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";

            echo "<td><a href='users.php?source=view_all_users&to_admin={$user_id}'>Change To Admin</a></td>";
            echo "<td><a href='users.php?source=view_all_users&to_sub={$user_id}'>Change to Subscriber</a></td>";
            echo "<td><a href='users.php?source=view_all_users&delete={$user_id}' >Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>


<?php
if (isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id={$the_user_id}";
    $obj = mysqli_query($connection, $query);
    if (!$obj) {
        die("QWERY FAILED" . mysqli_error($connection));
    }
    if (!$obj) {
        die("QWERY FAILED" . mysqli_error($connection));
    }
    header("Location: users.php?source=view_all_users");
}

if (isset($_GET['to_admin'])) {
    $user_id = $_GET['to_admin'];
    $_SESSION['role'] = "admin";

    $query = "UPDATE users SET user_role='admin' WHERE user_id={$user_id}";
    $obj = mysqli_query($connection, $query);
    header("Location: users.php?source=view_all_users");
}
if (isset($_GET['to_sub'])) {
    $user_id = $_GET['to_sub'];
    $_SESSION['role'] = "subscriber";

    $query = "UPDATE users SET user_role='subscriber' WHERE user_id={$user_id}";
    $obj = mysqli_query($connection, $query);
    header("Location: users.php?source=view_all_users");
}
?>