<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        h2 {
            text-align: center;
        }

        p {
            margin: 0 0 10px;
        }

        a {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        // Assuming you have a database connection
        // Replace these variables with your actual database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "patient_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $userId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($userId !== null) {
            // Corrected code to use prepared statements to prevent SQL injection
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display user information
                echo "<h2>User Profile</h2>";
                echo "<p>ID: " . $row['id'] . "</p>";
                echo "<p>Name: " . $row['name'] . "</p>";
                echo "<p>Email: " . $row['email'] . "</p>";

                // Add an "Edit" button that redirects to the edit page
                echo '<a href="edit.php?id=' . $row['id'] . '">Edit Profile</a>';
            } else {
                echo "User not found";
            }

            $stmt->close(); // Close the statement
        } else {
            echo "Invalid user ID";
        }

        $conn->close();
        ?>
    </div>

</body>

</html>