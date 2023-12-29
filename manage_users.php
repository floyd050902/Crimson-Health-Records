    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user_db";

    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Define the number of records per page
    $recordsPerPage = 8;

    // Get the current page number from the query parameters, default to 1
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the OFFSET value for the SQL query
    $offset = ($page - 1) * $recordsPerPage;

    $sql = "SELECT * FROM user_form LIMIT $recordsPerPage OFFSET $offset";
    $result = $connection->query($sql);

    if ($result === false) {
        die("Error in the query: " . $connection->error);
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
         <script>
        function grantAdminAccess(userId, userType) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_user_type.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Success
                        console.log(xhr.responseText);
                    } else {
                        // Error
                        console.error("Failed to update user type");
                    }
                }
            };
            xhr.send("userId=" + userId + "&userType=" + userType);
        }

        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table tbody");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Change index to the column you want to search
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
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
                    <a href="display_data.php">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Patient Records</span>
                    </a>
                </li>
                <li>
                    <a href="manage_users.php">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Grant Access</span>
                    </a>
                </li>
                <li>
                    <a href="statistical_data.php">
                        <i class="fa-solid fa-person-circle-exclamation"></i>
                        <span>Percentage</span>
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
                <h2>Manage Users</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are rows in the result
                        if ($result && $result->num_rows > 0) {
                            $counter = 1 + $offset; // Adjust the counter to account for the offset

                            while ($user = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td>{$counter}</td>
                                        <td>{$user['name']}</td>
                                        <td>{$user['email']}</td>
                                        <td>
                                            <select id='userType{$user['id']}' onchange='grantAdminAccess({$user['id']}, this.value)'>
                                                <option value='user' " . ($user['user_type'] === 'user' ? 'selected' : '') . ">User</option>
                                                <option value='admin2' " . ($user['user_type'] === 'admin2' ? 'selected' : '') . ">Staff</option>

                                            </select>
                                        </td>
                                    </tr>
                                ";
                                $counter++;
                            }
                        } else {
                            echo "No users found.";
                        }
                        ?>
                    </tbody>
                </table>

             <style>
        .pagination {
            display: flex;
            justify-content: center;
        }

        .pagination a {
            margin: 0 15px;
            text-decoration: underline;
            color: blue;
            font-size: 18px;
        }
    </style>

    <!-- Pagination links -->
    <div class="pagination">
        <?php
        // Calculate the total number of pages
        $totalPages = ceil($connection->query("SELECT COUNT(*) FROM user_form")->fetch_row()[0] / $recordsPerPage);

        // Display pagination links
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i'>$i</a>";
        }
        ?>
    </div>
            </div>


        
    </body>
    </html>

    <?php
    // Close the database connection when you're done
    $connection->close();
    ?>
