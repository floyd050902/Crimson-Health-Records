<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

$user_name = $_SESSION['user_name'];
$newPassword = $_POST['newPassword'];

// Update the password in the database
$updateQuery = "UPDATE user_form SET password = '$newPassword' WHERE name = '$user_name'";
$updateResult = mysqli_query($conn, $updateQuery);

if ($updateResult) {
    echo 'Password updated successfully';
} else {
    echo 'Error updating password';
}

mysqli_close($conn);
?>