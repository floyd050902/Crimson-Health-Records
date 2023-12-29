<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Design</title>
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
    <style>
        #loadingSpinner {
            display: none;
            margin-top: 10px;
            text-align: center;
        }
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="admin_page.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Patient Records</span>
                </a>
            </li>
            <li>
                <a href="Fillup.php">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Add records</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-person-circle-exclamation"></i>
                    <span>User logs</span>
                </a>
            </li>
            <li>
                <a href="statistics.php">
                    <i class="fas fa-chart-pie"></i>
                    <span>Statistics</span>
                </a>
            </li>
            <li class="logout">
                <a href="#">
                    <i class="fas fa-sign-out-alt"></i>
                    <a href="logout.php" class="btn">Logout</a>
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

        <div class="container my-5">
            <h2>List of Patients</h2>
            <div id="loadingSpinner">
                <i class="fas fa-spinner fa-spin"></i> Loading...
            </div>
            <a class="btn btn-primary" href="Fillup.php" role="button">New Patient</a>
            <br>&nbsp;
            <table class="table" id="clientTable">
                <?php
                // Your existing PHP code for displaying the table
                ?>
            </table>
        </div>

        <script>
            function searchTable() {
                // Your existing JavaScript code for searching the table
            }
        </script>
    </div>
</body>
</html>