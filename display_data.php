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
            <div id="loadingSpinner">
                <i class="fas fa-spinner fa-spin"></i> Loading...
            </div>
            <a class="btn btn-primary" href="Fillup.php" role="button">New Patient</a>

            <br>&nbsp;
            <table class="table" id="clientTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID NUM</th>
                        <th>NAME</th>
                        <th>DIAGNOSIS</th>
                        <th>ILLNESS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password ="";
                    $database = "patient_db";

                    $connection = new mysqli($servername, $username, $password, $database);
                    if ($connection->connect_error){
                        die("Connection failed: " . $connection->connect_error);
                    }
                    $sql = "SELECT * FROM clients";
                    $result = $connection->query($sql);

                    if(!$result){
                        die("Invalid query: " . $connection->error);
                    }
                    $idCounter = 1;

                    while($row = $result->fetch_assoc()){
                        echo "
                            <tr>
                                <td>$idCounter</td>
                                <td>$row[WMSU_ID]</td>
                                <td>$row[NAME]</td>
                                <td>$row[DIAGNOSIS]</td>
                                <td>$row[ILLNESS]</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='view.php?ID=$row[ID]'>View</a>


                                </td>
                            </tr>
                        ";
                        $idCounter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            function searchTable() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("clientTable");
                tr = table.getElementsByTagName("tr");

                document.getElementById("loadingSpinner").style.display = "block";

                setTimeout(function() {
                    for (i = 0; i < tr.length; i++) {
                        tdName = tr[i].getElementsByTagName("td")[2];
                        tdDiagnosis = tr[i].getElementsByTagName("td")[3];
                        tdIllness = tr[i].getElementsByTagName("td")[4];

                        if (tdName || tdDiagnosis || tdIllness) {
                            txtValueName = tdName.textContent || tdName.innerText;
                            txtValueDiagnosis = tdDiagnosis.textContent || tdDiagnosis.innerText;
                            txtValueIllness = tdIllness.textContent || tdIllness.innerText;

                            if (txtValueDiagnosis.toUpperCase().indexOf(filter) > -1 ||
                                txtValueIllness.toUpperCase().indexOf(filter) > -1 ||
                                txtValueName.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }

                    document.getElementById("loadingSpinner").style.display = "none";
                }, 1000);
            }
        </script>
    </div>
</body>
</html>