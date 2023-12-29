<?php
@include 'config.php';

session_start();

// Check if the default admin account exists
$defaultAdminEmail = 'admin@example.com';
$defaultAdminPassword = 'admin_password';

$checkDefaultAdmin = "SELECT * FROM user_form WHERE email = '$defaultAdminEmail'";
$resultDefaultAdmin = mysqli_query($conn, $checkDefaultAdmin);

if (mysqli_num_rows($resultDefaultAdmin) === 0) {
    // The default admin account doesn't exist, create it
    $insertDefaultAdmin = "INSERT INTO user_form (name, email, password, user_type) VALUES ('Default Admin', '$defaultAdminEmail', '$defaultAdminPassword', 'admin')";
    mysqli_query($conn, $insertDefaultAdmin);
}

if (isset($_POST['submit'])) {
    // Your existing login code

    // Check if keys exist in the $_POST array
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $pass = isset($_POST['password']) ? ($_POST['password']) : '';

    // Validate and sanitize input to prevent SQL injection
    // (Note: You should use prepared statements for better security)

    $select = "SELECT * FROM user_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if ($result === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($pass === $row['password']) {
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                header('location: admin_page.php');
            } elseif ($row['user_type'] == 'admin2') {
                $_SESSION['admin_name'] = $row['name'];
                header('location: admin_page2.php');
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                header('location: user_page.php');
            }
        } else {
            $error[] = 'Incorrect password!';
        }
    } else {
        $error[] = 'Email does not exist!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
      <style>
      .form-container {
         min-height: 100vh;
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         padding: 20px;
         padding-bottom: 60px;
         background: #eee;
      }

      .logo-container {
         margin-bottom: 20px;
      }

      .logo-container img {
         max-width: 100px; /* Adjust the max-width as needed */
         height: auto;
      }

      .form-container form {
         padding: 20px;
         border-radius: 5px;
         box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
         background: #fff;
         text-align: center;
         width: 500px;
      }

      /* Rest of your existing styles */
   </style>
</head>
<body>
   
<div class="form-container">
   <div class="logo-container">
      <img src="Logo/logo1.png" alt="Logo1">
      <img src="Logo/logo3.png" alt="Logo3">
      <img src="Logo/logo2.png" alt="Logo2">
      
      <img src="Logo/logo4.png" alt="Logo4">
   </div>

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">Register now</a></p>
      <p><a href="forgot_password.php">Forget Password?</a></p>
   </form>

</div>

</body>
</html>
