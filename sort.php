<?php
// ...

// Calculate total users for percentage calculation
$totalUsersQuery = "SELECT COUNT(*) as total FROM clients";
$totalUsersResult = $connection->query($totalUsersQuery);

if ($totalUsersResult) {
    $totalUsers = $totalUsersResult->fetch_assoc()['total'];

    // Fetch diagnosis and illness data for the specified options
    $diagnosisData = array();

    foreach ($diagnosisOptions as $option) {
        $diagnosisQuery = "SELECT COUNT(*) as count FROM clients WHERE DIAGNOSIS = '$option'";
        $diagnosisResult = $connection->query($diagnosisQuery);

        if ($diagnosisResult) {
            $count = $diagnosisResult->fetch_assoc()['count'];
            $percentage = ($count / $totalUsers) * 100;
            $diagnosisData[] = array('Diagnosis' => $option, 'Count' => $count, 'Percentage' => $percentage);
        } else {
            die("Invalid query: " . $connection->error);
        }
    }
} else {
    die("Invalid query for total users: " . $connection->error);
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis and Illness Statistics</title>
    <!-- Add your CSS and other necessary links here -->
    <link rel="stylesheet" href="css/style2.css" /> <!-- Assuming you have a CSS file for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
</head>
<body>
    <div class="container my-5">
        <h2>Diagnosis and Illness Statistics</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Diagnosis</th>
                    <th>Total Users</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($diagnosisData as $row) {
                    echo "
                        <tr>
                            <td>{$row['Diagnosis']}</td>
                            <td>{$row['Count']}</td>
                            <td>{$row['Percentage']}%</td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
