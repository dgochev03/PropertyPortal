<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");

if (!isset($_SESSION['uemail'])) {
    header("location:login.php");
}

if (isset($_POST['submit_password'])) {
    $old_pass = $_POST['old_pass'];
    $new_pass1 = $_POST['new_pass1'];
    $new_pass2 = $_POST['new_pass2'];

    $uid = $_SESSION['uid'];

    if (!empty($old_pass) && !empty($new_pass1) && !empty($new_pass2) && $new_pass1 == $new_pass2) {
        $sql = "SELECT upass FROM user WHERE uid = '$uid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $current_pass = $row['upass'];

            if ($current_pass == $old_pass) {
                $sql = "UPDATE user SET upass = '$new_pass1' WHERE uid = '$uid'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $msg = "<p class='alert alert-success'>Password changed successfully</p>";
                } else {
                    $error = "<p class='alert alert-warning'>Password not updated successfully</p>";
                }
            } else {
                $error = "<p class='alert alert-warning'>Old password is incorrect</p>";
            }
        } else {
            $error = "<p class='alert alert-warning'>User not found</p>";
        }
    } else {
        $error = "<p class='alert alert-warning'>Please fill all the fields and ensure passwords match</p>";
    }
}

if (isset($_POST['submit_phone'])) {
    $new_phone = $_POST['new_phone'];
    $uid = $_SESSION['uid'];

    if (!empty($new_phone)) {
        $sql = "UPDATE user SET uphone = '$new_phone' WHERE uid = '$uid'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $msg = "<p class='alert alert-success'>Phone number changed successfully</p>";
        } else {
            $error = "<p class='alert alert-warning'>Phone number not updated successfully</p>";
        }
    } else {
        $error = "<p class='alert alert-warning'>Please enter a new phone number</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="images/logo/logo-house.svg">
        <link rel="stylesheet" href="style/profile.css"</link>

        <title>Real Estate Property</title>
    </head>
    <body>
        <?php include("include/header.php"); ?>

        <div class="container">
            <h2>Profile</h2>

            <?php
            $uid = $_SESSION['uid'];
            $query = mysqli_query($con, "SELECT * FROM `user` WHERE uid='$uid'");
            while ($row = mysqli_fetch_array($query)) {
                ?>

                <b>Name:</b> <?php echo $row['1']; ?><br>
                <b>Email:</b> <?php echo $row['2']; ?><br>
                <b>Phone:</b> <?php echo $row['3']; ?><br>
                <b>Role:</b> <?php echo $row['5']; ?><br><br>
            <?php } ?>

            <form method="POST">
                <label for="old-password">Old password:</label><br>
                <input type="password" name="old_pass" required><br><br>

                <label for="new-password">New Password:</label><br>
                <input type="password" name="new_pass1" required><br><br>

                <label for="confirm-password">Confirm the new password:</label><br>
                <input type="password" name="new_pass2" required><br><br>

                <button type="submit" name="submit_password">Change Password</button>
            </form>

            <br><br>

            <form method="POST">
                <label for="new-phone">New Phone Number:</label><br>
                <input type="text" name="new_phone" required><br><br>

                <button type="submit" name="submit_phone">Change Phone Number</button>
            </form>

            <?php
            if (isset($msg)) {
                echo $msg;
            }
            if (isset($error)) {
                echo $error;
            }
            ?>
        </div>
        <?php include("include/footer.php"); ?>
    </body>
</html>
