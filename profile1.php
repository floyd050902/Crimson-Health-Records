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
    $name = $row['name']; // Assuming 'name' is the field for the username
    $password = $row['password'];
} else {
    // Handle error or redirect to login page
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .menu li {
            margin-bottom: 50px; /* You can adjust this value as needed */
        }

        .main--content {
            padding: 40px;

        }


        .user-info li {
            list-style: none;
            margin-bottom: 15px;
        }

        .user-info span {
            font-weight: bold;
            margin-right: 10px;
        }

        .user-info div {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 18px; /* Adjust the font size as needed */
            border-radius: 5px;
            background-color: #fff;
        }

        .user-info img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }

        /* Profile-like design */
        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-info img {
            max-width: 80px;
            height: auto;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-info-details {
            flex-grow: 1;
        }

        .profile-info-details input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
            font-size: 18px;
            color: #555;
            pointer-events: none; /* Make the input non-editable */
        }
         .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .change-password-btn {
            font-size: 18px;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        .dropdown-menu {
    background-color: #fff; 
}

.dropdown-item {
    color: #000 !important; 
}


        
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="">
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
        
    
    <div class="main--content" >
        <div class="header--wrapper">
            <div class="header--title">

                <h2>PROFILE </h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                  
        
                </div>
              
            </div>
        </div>

        
      <div class="main--content" style="text-align: center;">
    <ul class="list-unstyled" style="display: inline-block; text-align: left;">
        <li class="mb-3">
            <label for="email" class="form-label" style="font-size: 40px;">Email:</label>
            <input type="text" id="email" name="emails" value="<?php echo isset($email) ? $email : 'N/A'; ?>" class="form-control" style="width: 500px; height: 50px;" readonly>
        </li>
        <li class="mb-3">
            <label for="user_name" class="form-label" style="font-size: 40px;">Username:</label>
            <input type="text" id="names" name="user_name" value="<?php echo isset($name) ? $name : 'N/A'; ?>" class="form-control" style="width: 500px; height: 50px;" readonly>
        </li>
        <li class="mb-3">
            <label for="password" class="form-label" style="font-size: 40px;">Password:</label>
            <input type="password" id="password" name="passwords" value="<?php echo isset($password) ? $password : 'N/A'; ?>" class="form-control" style="width: 500px; height: 50px;" readonly>
            &nbsp;
              <button class="change-password-btn" onclick="openModal()">Change Password</button>
              <div id="passwordModal" class="modal">
    <div class="modal-content">

        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Change Password</h2>
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" class="form-control" style="width: 100%;" required>
        <button onclick="saveNewPassword()">Save Changes</button>
    </div>
</div>
    </div>
        </li>
    </ul>
</div>

    </div>
     <script>
    
    function openModal() {
        document.getElementById('passwordModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('passwordModal').style.display = 'none';
    }

    function saveNewPassword() {
        
        var newPassword = document.getElementById('newPassword').value;
        document.getElementById('password').value = newPassword;
        
        $.ajax({
            type: 'POST',
            url: 'update_password.php',
            data: {
                newPassword: newPassword
            },
            success: function (response) {
                
                console.log(response);
            },
            error: function (error) {
                
                console.error(error);
            }
        });

       
        closeModal();
    }
</script>
</body>
</html>
