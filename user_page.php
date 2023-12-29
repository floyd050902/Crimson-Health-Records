<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

// Retrieve user information from the database
$user_name = $_SESSION['user_name'];
$query = "SELECT * FROM user_form WHERE name = '$user_name'";
$result = mysqli_query($conn, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $email = $row['email'];
    $password = $row['password']; 
} else {
    
    header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Design</title>
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<style>
    .menu li {
        margin-bottom: 50px; 
    }
     .dropdown-menu {
    background-color: #fff; 
}

.dropdown-item {
    color: #000 !important; 
}
</style>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="profile1.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
               
            <li class="dropdown">
    <a href="#" class="dropdown-toggle" id="fillUpFormDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-user-plus"></i>
        <span>Fill-Up Form</span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="fillUpFormDropdown">
        <li><a class="dropdown-item" href="fillup2.php">Fillup Form for Male</a></li>
        <li><a class="dropdown-item" href="fillup.php">Fillup Form for Female</a></li>
    </ul>
</li>
            <li>
                <a href="logout.php" class="btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                
                <h2>Dashboard</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search" onkeyup="searchTable()">
                </div>
                <img src="./image/3.png" alt="">
            </div>
        </div>
</body>
</html>
