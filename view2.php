<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: crimson;
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
            padding: 40px;
            width: 600px;
            color: black;
            overflow-y: auto;
            max-height: 80vh;
        }

        h2 {
            text-align: center;
            color: crimson;
        }

        p {
            margin: 0 0 15px; /* Increased margin for better spacing */
        }

        label {
            display: block;
            margin-bottom: 5px; /* Adjusted margin for better spacing */
        }

        input[type="text"],
        input[type="number"] {
            width: 100%; /* Set width to 100% for full container width */
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
    </style>    
</head>
<body>

<div class="container my-5">
    <h2>User Details</h2>
     <a href="display_data2.php" class="back-button">Back</a>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "patient_db";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['ID'])) {
        $userId = $_GET['ID'];

        $sql = "SELECT * FROM clients WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();



            echo "<p><label>WMSU ID:</label> <input type='text' readonly value='" . $row['WMSU_ID'] . "'></p>";
            echo "<p><label>Name:</label> <input type='text' readonly value='" . $row['NAME'] . "'></p>";
            echo "<p><label>Course:</label> <input type='text' readonly value='" . $row['course'] . "'></p>";
            echo "<p><label>Age:</label> <input type='number' readonly value='" . $row['AGE'] . "'></p>";
            echo "<p><label>Address:</label> <input type='text' readonly value='" . $row['ADDRESS'] . "'></p>";
            echo "<p><label>Contact Number:</label> <input type='text' readonly value='" . $row['CONTACT'] . "'></p>";
            echo "<p><label>Year Level:</label> <input type='text' readonly value='" . $row['Yearlvl'] . "'></p>";
            echo "<p><label>Birthdate:</label> <input type='text' readonly value='" . $row['Birthdate'] . "'></p>";
            echo "<p><label>Civil Status:</label> <input type='text' readonly value='" . $row['CIVILSTAT'] . "'></p>";
            echo "<p><label>WMSU Email:</label> <input type='text' readonly value='" . $row['WMSU_EMAIL'] . "'></p>";
            echo "<p><label>Sex:</label> <input type='text' readonly value='" . $row['GENDER'] . "'></p>";
            echo "<p><label>Nationality:</label> <input type='text' readonly value='" . $row['nationality'] . "'></p>";
            echo "<p><label>Name (Emergency Contact Info):</label> <input type='text' readonly value='" . $row['XTNAME'] . "'></p>";
            echo "<p><label>Contact (Emergency Contact Info):</label> <input type='text' readonly value='" . $row['XTCONTACT'] . "'></p>";
            echo "<p><label>Address (Emergency Contact Info):</label> <input type='text' readonly value='" . $row['XTADDRESS'] . "'></p>";
            echo "<p><label>Relationship (Emergency Contact Info):</label> <input type='text' readonly value='" . $row['XTRELATION'] . "'></p>";
            echo "<p><label>Diagnosis:</label> <input type='text' readonly value='" . $row['DIAGNOSIS'] . "'></p>";
            echo "<p><label>Illness:</label> <input type='text' readonly value='" . $row['ILLNESS'] . "'></p>";
            echo "<p><label>Vaccination:</label> <input type='text' readonly value='" . $row['VACCINE'] . "'></p>";
            echo "<p><label>Generic Name of Drug:</label> <input type='text' readonly value='" . $row['DRUG'] . "'></p>";
            echo "<p><label>Age when menstruation began:</label> <input type='number' readonly value='" . $row['MENSTRUATION'] . "'></p>";
            echo "<p><label>Monthly Menstruation:</label> <input type='text' readonly value='" . $row['MONTHLY'] . "'></p>";
            echo "<p><label>Menstrual Symptoms:</label> <input type='text' readonly value='" . $row['MENSTRUAL'] . "'></p>";
            echo "<p><label>Past Medical and Surgical History:</label> <input type='text' readonly value='" . $row['PAST'] . "'></p>";
            echo "<p><label>Family Medical History:</label> <input type='text' readonly value='" . $row['FAMILY'] . "'></p>";
            echo "<p><label>Psychiatric Illness:</label> <input type='text' readonly value='" . $row['XTFAMILY'] . "'></p>";

            // Add more fields as needed

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
