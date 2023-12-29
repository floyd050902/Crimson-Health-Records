<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userId"]) && isset($_POST["userType"])) {
    $userId = $_POST["userId"];
    $userType = $_POST["userType"];

    // Debugging output
    echo "Received userId: $userId, userType: $userType";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user_db";

    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Use parameterized query to avoid SQL injection
    $updateQuery = "UPDATE user_form SET user_type = ? WHERE id = ?";
    
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("si", $userType, $userId);

    if ($stmt->execute()) {
        echo "Admin access toggled successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
        error_log("SQL Query: " . $updateQuery);
    }

    $stmt->close();
    $connection->close();
} else {
    echo "Invalid request";
}
?>