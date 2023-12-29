<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["data"])) {
    $requestData = json_decode($_POST["data"], true);

    if ($requestData !== null) {
        $userId = $requestData["userId"];
        $userType = $requestData["userType"];

        // Log received values
        error_log("User ID: " . $userId);
        error_log("User Type: " . $userType);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "user_db";

        $connection = new mysqli($servername, $username, $password, $database);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Adjust the column name to match your database structure
      $updateQuery = "UPDATE user_form SET user_type = '" . ($userType === 'admin' ? 'user' : 'admin') . "' WHERE id = '$userId'";


        if ($connection->query($updateQuery) === TRUE) {
            echo "Admin access toggled successfully";
        } else {
            echo "Error updating record: " . $connection->error;
        }

        $connection->close();
    } else {
        echo "Invalid data format";
    }
} else {
    echo "Invalid request";
}
?>