<?php
if (isset($_POST['create_user'])) {

    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    //move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users (username, user_firstname, user_lastname, user_role, user_email, user_password) 
    VALUES ('{$username}','{$user_firstname}','{$user_lastname}','{$user_role}','{$user_email}','{$user_password}')";
    $obj = mysqli_query($connection, $query);
    confirm($obj);
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <select name="user_role" id="">
        <option value="subscriber">Select Option</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>
    <!-- <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" name="user_image">
    </div> -->

    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>