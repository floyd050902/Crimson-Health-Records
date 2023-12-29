
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8"/>
    <title>Dashboard Design</title>
    <link rel="Stylesheet" href="css/style2.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
                    <a href="#">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Patient Records</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Add records</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-person-circle-plus"></i>
                        <span>Add users</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-person-circle-exclamation"></i>
                        <span>User logs</span>
                    </a>
                </li>
                 <li class="logout">
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        <a href="logout.php" class="btn">logout</a>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <span>Primary</span>
                    <h2>Dashboard</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                <i class="fa-solid fa-search"></i>
                <input type="text"
                placeholder="Search"/>
            </div>
            <img src="./image/3.png" alt="">
            </div>
        </div>
    </div>
    </body>
    </html>