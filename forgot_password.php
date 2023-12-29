<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        if ($newPassword !== $confirmPassword) {
            $error[] = 'New password and confirmation do not match!';
        } elseif (strlen($newPassword) < 8) { // Checks Password Length
            $error[] = 'Password must be at least 8 characters long!';
        } else {
            // Update User Password
            $hashedNewPassword = md5($newPassword);
            $update = "UPDATE user_form SET password = '$hashedNewPassword' WHERE email = '$email'";
            mysqli_query($conn, $update);

            // to the login page
            header('location: login_form.php');
            exit;
        }
    } else {
        $error[] = 'Email not found!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-container">

    <form action="" method="post">
        <h3>Forgot Password</h3>
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            }
        }
        ?>
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="new_password" required placeholder="Enter new password">
        <input type="password" name="confirm_password" required placeholder="Confirm new password">
        <input type="submit" name="submit" value="Reset Password" class="form-btn">
        <p>Remember your password? <a href="login_form.php">Login now</a></p>
    </form>

</div>

</body>