<?php
if (isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];
    $query = "SELECT * FROM users WHERE user_id=$the_user_id";
    $obj = mysqli_query($connection, $query);
    while ($rows = mysqli_fetch_assoc($obj)) {
        // $user_id = $rows['user_id'];
        $username = $rows['username'];
        $user_password = $rows['user_password'];
        $user_firstname = $rows['user_firstname'];
        $user_lastname = $rows['user_lastname'];
        $user_email = $rows['user_email'];
        $user_image = $rows['user_image'];
        $user_role = $rows['user_role'];
    }
}

if (isset($_POST['edit_user'])) {

    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    //move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE users SET username='{$username}', user_firstname='{$user_firstname}',";
    $query .= " user_lastname='{$user_lastname}', user_role='{$user_role}', ";
    $query .= " user_email='{$user_email}', user_password='{$user_password}' ";
    $query .= " WHERE user_id = {$the_user_id}";

    $obj = mysqli_query($connection, $query);
    confirm($obj);
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber"><?php echo $user_role; ?></option>
            <?php
            if ($user_role == 'admin') {
                echo "<option value='subscriber'>subscriber</option>";
            } else echo "<option value='admin'>admin</option>";
            ?>

        </select>
    </div>
    <!-- <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" name="user_image">
    </div> -->

    <div class="form-group">
        <label for="user_username">Username</label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>