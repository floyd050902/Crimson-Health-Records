<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "patient_db";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$diagnosis = $_GET['diagnosis'];

$sql = "SELECT COUNT(*) as count FROM clients WHERE diagnosis = '$diagnosis'";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}

$count = $result->fetch_assoc()['count'];

$sql = "SELECT COUNT(*) as total FROM clients";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}

$totalUsers = $result->fetch_assoc()['total'];

$percentage = ($count / $totalUsers) * 100;

echo "<p>Users with diagnosis '$diagnosis': $count</p>";
echo "<p>Percentage of users with diagnosis '$diagnosis': " . number_format($percentage, 2) . "%</p>";

$connection->close();
?>
