
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
            <h2>List of Patients</h2>
            <a class="btn btn-primary" href="Fillup.php" role="button">New Female Patient</a>
            &nbsp;
            <a class="btn btn-primary" href="Fillup2.php" role="button" style="background-color: green;">New Male Patient</a>

            <br>&nbsp;
            <table class="table" id="clientTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID NUM</th>
                        <th>NAME</th>
                        <th>COURSE</th>
                        <th>AGE</th>
                        <th>EMAIL</th>
                        <th>DATE CREATED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "patient_db";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$recordsPerPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startFrom = ($page - 1) * $recordsPerPage;

$sql = "SELECT * FROM clients LIMIT $startFrom, $recordsPerPage";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}
$idCounter = 1;
$totalRecords = $result->num_rows;
            $totalPages = ceil($totalRecords / $recordsPerPage);

             echo "<ul class='pagination'>";
for ($i = 1; $i <= $totalPages; $i++) {
    // Calculate the next page
    $nextPage = $i + 1;
    $pageLink = isset($_GET['search']) ? "?page=$nextPage&search=" . urlencode($_GET['search']) : "?page=$nextPage";

    // If it's the first page, display "Next" instead of the page number
    $displayText = ($i == 1) ? "Next" : $i;

    echo "<li class='page-item'><a class='page-link' href='$_SERVER[PHP_SELF]$pageLink'>$displayText</a></li>";
}
echo "</ul>";

while ($row = $result->fetch_assoc()) {
    echo "
        <tr>
            <td>$idCounter</td>
            <td>{$row['WMSU_ID']}</td>
            <td>{$row['NAME']}</td>
            <td>{$row['course']}</td>
            <td>{$row['AGE']}</td>
            <td>{$row['WMSU_EMAIL']}</td>
            <td>{$row['DATE_CREATED']}</td>
            <td>
                <a class='btn btn-primary btn-sm' href='view.php?ID={$row['ID']}'>View</a>
                <a class='btn btn-danger btn-sm' href='javascript:void(0);' onclick='confirmDelete({$row['ID']})'>Delete</a>
            </td>
        </tr>
    ";
    $idCounter++; 
    // Increment the counter for the next iteration
}
?>
                </tbody>
            </table>
             <div id="noResultMessage" style="display: none;">No patient found</div>
        </div>

        <script>
             function showStatisticalData() {
        // You can redirect to the statistical data page or show a modal, etc.
        // For simplicity, let's redirect to a page named statistical_data.php
        window.location.href = 'statistical_data.php';
    }
      function confirmDelete(userID) {
        var result = confirm("Are you sure you want to delete this user?");
        if (result) {
            // If the user confirms, redirect to the delete.php page
            window.location.href = 'delete.php?ID=' + userID;
        }
    }
         function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("clientTable");
        tr = table.getElementsByTagName("tr");

        // Declare and initialize found variable
        var found = false;

        // Declare noResultMessage variable
        var noResultMessage = document.getElementById("noResultMessage");

        for (i = 0; i < tr.length; i++) {
            // Change the index to the column you want to search
            tdIdNum = tr[i].getElementsByTagName("td")[1];
            tdName = tr[i].getElementsByTagName("td")[2]; // Change index to the column you want to search (2 for NAME)
            tdCourse = tr[i].getElementsByTagName("td")[3];
            tdAge = tr[i].getElementsByTagName("td")[4];
            tdEmail = tr[i].getElementsByTagName("td")[5];

            if (tdName || tdIdNum || tdCourse || tdAge || tdEmail) {
                txtValueIdNum = tdIdNum.textContent || tdIdNum.innerText;
                txtValueName = tdName.textContent || tdName.innerText;
                txtValueCourse = tdCourse.textContent || tdCourse.innerText;
                txtValueAge = tdAge.textContent || tdAge.innerText;
                txtValueEmail = tdEmail.textContent || tdEmail.innerText;

                // Change the condition to check against the filter for name column
                if (txtValueName.toUpperCase().indexOf(filter) > -1 ||
                    txtValueIdNum.toUpperCase().indexOf(filter) > -1 ||
                    txtValueCourse.toUpperCase().indexOf(filter) > -1 ||
                    txtValueAge.toUpperCase().indexOf(filter) > -1 ||
                    txtValueEmail.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    found = true;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Show or hide the "No patient found" message
        if (found) {
            noResultMessage.style.display = "none";
        } else {
            noResultMessage.style.display = "block";
        }
    }
        
    </script>
    </div>
</body>
</html>
