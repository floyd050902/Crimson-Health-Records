<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "patient_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure that the form is submitted using the POST method

    $userId = $_POST['ID'];

    // Retrieve the updated information from the form
    $WMSU_ID = $_POST['WMSU_ID'];
    $NAME = $_POST['name'];
    $course = $_POST['COURSE'];
    $AGE = $_POST['age'];
    $ADDRESS = $_POST['address'];
    $CONTACT = $_POST['numb'];
    $Yearlvl = $_POST['year'];
    $Birthdate = $_POST['birthday'];
    $CIVILSTAT = $_POST['civil'];
    $WMSU_EMAIL = $_POST['WMSU_EMAIL'];
    $GENDER = $_POST['gender'];
    $nationality = $_POST['NATIONALITY'];
    $XTNAME = $_POST['names'];
    $XTCONTACT = $_POST['cont'];
    $XTADDRESS = $_POST['add'];
    $XTRELATION = $_POST['relate'];
    $DIAGNOSIS = implode(',', $_POST['Diagnosis']);
    $ILLNESS = implode(',', $_POST['Illness']);
    $VACCINE = isset($_POST['Vaccine']) ? implode(',', $_POST['Vaccine']) : '';
    $DRUG = $_POST['drugs'];
    $MENSTRUATION = $_POST['men'];
    $MONTHLY = $_POST['month'];
    $MENSTRUAL = isset($_POST['symptoms']) ? implode(',', $_POST['symptoms']) : '';    
    $FAMILY = implode(',', $_POST['fam']);
    $XTFAMILY = implode(',', $_POST['famILL']);

    // Update the user's information in the database
    $sql = "UPDATE clients SET
            WMSU_ID = ?,
            NAME = ?,
            course = ?,
            AGE = ?,
            ADDRESS = ?,
            CONTACT = ?,
            Yearlvl = ?,
            Birthdate = ?,
            CIVILSTAT = ?,
            WMSU_EMAIL = ?,
            GENDER = ?,
            nationality = ?,
            XTNAME = ?,
            XTCONTACT = ?,
            XTADDRESS = ?,
            XTRELATION = ?,
            DIAGNOSIS = ?,
            ILLNESS = ?,
            VACCINE = ?,
            DRUG = ?,
            MENSTRUATION = ?,
            MONTHLY = ?,
            MENSTRUAL = ?,
            PAST = ?,
            FAMILY = ?,
            XTFAMILY = ?
            WHERE ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssssssssssi",
        $WMSU_ID, $NAME, $course, $AGE, $ADDRESS, $CONTACT, $Yearlvl, $Birthdate, $CIVILSTAT,
        $WMSU_EMAIL, $GENDER, $nationality, $XTNAME, $XTCONTACT, $XTADDRESS, $XTRELATION,
        $DIAGNOSIS, $ILLNESS, $VACCINE, $DRUG, $MENSTRUATION, $MONTHLY, $MENSTRUAL,
        $PAST, $FAMILY, $XTFAMILY, $userId);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close(); // Close the statement
} else {
    echo "Invalid request method";
}

$conn->close();
?>
