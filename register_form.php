<?php

@include 'config.php';

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = ($_POST['password']);
   $cpass = ($_POST['cpassword']);

   // Restriction # 1: Name should be 4-48 characters
   if (strlen($name) < 4 || strlen($name) > 48) {
      $error[] = 'Name should be between 4 and 48 characters!';
   }

   // Restriction # 2: (only accepts @wmsu.edu.ph)
   if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/@wmsu\.edu\.ph$/", $email)) {
      $error[] = 'Invalid WMSU email address. Use WMSU email only.';
   }

   // Restriction # 3: Validate password length (at least 8 characters)
   if (strlen($_POST['password']) < 8) {
      $error[] = 'Password must be at least 8 characters long.';
   }

   // Restriction # 4: Check if the email already exists
   $select = "SELECT * FROM user_form WHERE email = '$email'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $error[] = 'Email already exists.';
   }

   // Restriction # 6: Check if the name already exists
   $select = "SELECT * FROM user_form WHERE name = '$name'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $error[] = 'Name already exists. Try a different name.';
   }

   // Restriction # 8: Password Checking 
   if ($pass != $cpass) {
      $error[] = 'Password not matched!';
   } else {
      if (empty($error)) {
         $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
         mysqli_query($conn, $insert);

         // Debugging: Print out the plain text password
         echo "Plain Text Password: $pass";

         header('location:login_form.php');
      }
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="Enter your name (4-48 characters)">
      <input type="email" name="email" required placeholder="WMSU Email Only" pattern="^[a-zA-Z0-9._%+-]+@wmsu\.edu\.ph$" title="Enter a valid WMSU email address">
      <input type="password" name="password" required placeholder="Enter your password (min. 8 characters)">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>

</div>

</body>
</html>