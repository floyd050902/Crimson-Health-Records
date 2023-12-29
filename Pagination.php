<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "patient_db";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$recordsPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

$sql = "SELECT * FROM clients LIMIT $offset, $recordsPerPage";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- your head content here -->
</head>

<body>
    <!-- your existing HTML content here -->

    <div class="container my-5">
        <h2>List of clients</h2>
        <a class="btn btn-primary" href="Fillup.php" role="button">New client</a>
        <br>
        <table class="table">
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
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[ID]</td>
                        <td>$row[WMSU_ID]</td>
                        <td>$row[NAME]</td>
                        <td>$row[course]</td>
                        <td>$row[AGE]</td>
                        <td>$row[WMSU_EMAIL]</td>
                        <td>$row[DATE_CREATED]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='edit.php?ID=$row[ID]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='delete.php?ID=$row[ID]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>

        <?php
        // Pagination links
        $sql = "SELECT COUNT(*) AS total FROM clients";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $totalPages = ceil($row['total'] / $recordsPerPage);

        echo "<nav aria-label='Page navigation example'>
              <ul class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='yourpage.php?page=$i'>$i</a></li>";
        }
        echo "</ul></nav>";
        ?>

    </div>
</body>

</html>