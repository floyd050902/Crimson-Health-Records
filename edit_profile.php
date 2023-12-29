<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
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
        label[for='COURSE'] {
        margin-bottom: 10px;
    }


    </style> 
</head>
<body>

<div class="container my-5">
    <h2>Edit User Profile</h2>
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
            

            echo "<form method='post' action='update_profile.php'>";
            echo "<input type='hidden' name='ID' value='" . $row['ID'] . "'>";
            echo "<label for='WMSU_ID'>WMSU ID:</label><input type='text' name='WMSU_ID' value='" . $row['WMSU_ID'] . "'>";
            echo "<label for='name'>Name:</label><input type='text' name='name' value='" . $row['NAME'] . "'>";
            echo "<label for='COURSE'>Course:</label>";
                echo "<select name='COURSE'>";
                echo "<option value='' " . (($row['course'] == '') ? 'selected' : '') . ">--Select--</option>";
                echo "<option value='Engineering' " . (($row['course'] == 'Engineering') ? 'selected' : '') . ">College of Engineering</option>";
                echo "<option value='Nursing' " . (($row['course'] == 'Nursing') ? 'selected' : '') . ">College of Nursing</option>";
                echo "<option value='CLA' " . (($row['course'] == 'CLA') ? 'selected' : '') . ">College of Liberal Arts</option>";
                echo "<option value='Agriculture' " . (($row['course'] == 'Agriculture') ? 'selected' : '') . ">College of Agriculture</option>";
                echo "<option value='Architecture' " . (($row['course'] == 'Architecture') ? 'selected' : '') . ">College of Architecture</option>";
                echo "<option value='CCJE' " . (($row['course'] == 'CCJE') ? 'selected' : '') . ">College of Criminal Justice Education</option>";
                echo "<option value='Education' " . (($row['course'] == 'Education') ? 'selected' : '') . ">College of Education</option>";
                echo "<option value='CFES' " . (($row['course'] == 'CFES') ? 'selected' : '') . ">College of Forestry and Environmental Studies</option>";
                echo "<option value='Economics' " . (($row['course'] == 'Economics') ? 'selected' : '') . ">College of Home Economics</option>";
                echo "<option value='Law' " . (($row['course'] == 'Law') ? 'selected' : '') . ">College of Law</option>";
                echo "<option value='PE' " . (($row['course'] == 'PE') ? 'selected' : '') . ">College of Physical Education</option>";
                echo "<option value='CSM' " . (($row['course'] == 'CSM') ? 'selected' : '') . ">College of Science and Mathematics</option>";
                echo "<option value='Social Science' " . (($row['course'] == 'Social Science') ? 'selected' : '') . ">College of Social Science</option>";
                echo "<option value='Veterinary' " . (($row['course'] == 'Veterinary') ? 'selected' : '') . ">College of Veterinary Medicine</option>";
                echo "<option value='CAIS' " . (($row['course'] == 'CAIS') ? 'selected' : '') . ">College of Asian Studies</option>";
                echo "<option value='CCS' " . (($row['course'] == 'CCS') ? 'selected' : '') . ">College of Computer Science</option>";
                echo "<option value='IT' " . (($row['course'] == 'IT') ? 'selected' : '') . ">College of Information Technology</option>";
                echo "</select>";
echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='age'>Age:</label><input type='number' name='age' value='" . $row['AGE'] . "'>";
            echo "<label for='address'>Address:</label><input type='text' name='address' value='" . $row['ADDRESS'] . "'>";
            echo "<label for='numb'>Contact Number:</label><input type='text' name='numb' value='" . $row['CONTACT'] . "'>";
            echo "<label for='year'>Year Level:</label><input type='text' name='year' value='" . $row['Yearlvl'] . "'>";
            echo "<label for='birthday'>Birthdate:</label><input type='text' name='birthday' value='" . $row['Birthdate'] . "'>";
           echo "<label for='civil'>Civil Status:</label>";
            echo "<select name='civil'>";
            echo "<option value='Single' " . (($row['CIVILSTAT'] == 'Single') ? 'selected' : '') . ">Single</option>";
            echo "<option value='Married' " . (($row['CIVILSTAT'] == 'Married') ? 'selected' : '') . ">Married</option>";
            echo "<option value='Divorced' " . (($row['CIVILSTAT'] == 'Divorced') ? 'selected' : '') . ">Divorced</option>";
            echo "<option value='Widowed' " . (($row['CIVILSTAT'] == 'Widowed') ? 'selected' : '') . ">Widowed</option>";
            echo "</select>";
            echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='WMSU_EMAIL'>WMSU Email:</label><input type='text' name='WMSU_EMAIL' value='" . $row['WMSU_EMAIL'] . "'>";
           echo "<label for='gender'>Sex:</label>";
                echo "<select name='gender'>";
                echo "<option value='Male' " . (($row['GENDER'] == 'male') ? 'selected' : '') . ">Male</option>";
                echo "<option value='Female' " . (($row['GENDER'] == 'female') ? 'selected' : '') . ">Female</option>";
                echo "</select>";
                echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='NATIONALITY'>Nationality:</label><input type='text' name='NATIONALITY' value='" . $row['nationality'] . "'>";
            echo "<label for='names'>Emergency Contact Name:</label><input type='text' name='names' value='" . $row['XTNAME'] . "'>";
            echo "<label for='cont'>Emergency Contact Number:</label><input type='text' name='cont' value='" . $row['XTCONTACT'] . "'>";
            echo "<label for='add'>Emergency Contact Address:</label><input type='text' name='add' value='" . $row['XTADDRESS'] . "'>";
            echo "<label for='relate'>Emergency Contact Relationship:</label><input type='text' name='relate' value='" . $row['XTRELATION'] . "'>";
            echo "<label for='Diagnosis'>Diagnosis:</label>";

$diagnosisOptions = array(
    'None',
    'Bronchial Asthma (“Hika”)',
    'Food Allergies',
    'Allergic Rhinitis',
    'Hyperthyroidism',
    'Anemia',
    'Migraine',
    'Epilepsy/Seizures',
    'Gastroesophageal Reflux Disease',
    'Irritable Bowel Syndrome',
    'Hypertension (elevated blood pressure)',
    'Diabetes mellitus (elevated blood sugar)',
    'Dyslipidemia (elevated cholesterol level)',
    'Arthritis (joint pains)',
    'Systemic Lupus Erythematosus (SLE)',
    'Polycystic Ovarian Syndrome (PCOS)',
    'Cancer'
);

foreach ($diagnosisOptions as $option) {
    $isChecked = in_array($option, explode(',', $row['DIAGNOSIS']));
    echo "<input type='checkbox' name='Diagnosis[]' value='" . htmlspecialchars($option) . "' " . ($isChecked ? 'checked' : '') . "> " . htmlspecialchars($option) . "<br>";
}
echo "<div style='margin-bottom: 10px;'></div>";


            echo "<label for='Illness'>Illness:</label>";

$illnessOptions = array(
    'None',
    'Major Depressive Disorder',
    'Bipolar Disorder',
    'Allergic Rhinitis',
    'Generalized Anxiety Disorder',
    'Panic Disorder',
    'Post Traumatic Disorder',
    'Schizophrenia'
);

foreach ($illnessOptions as $option) {
    $isChecked = in_array($option, explode(',', $row['ILLNESS']));
    echo "<input type='checkbox' name='Illness[]' value='" . htmlspecialchars($option) . "' " . ($isChecked ? 'checked' : '') . "> " . htmlspecialchars($option) . "<br>";
}
echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='Vaccine'>Vaccination:</label>";

$vaccineOptions = array(
    'Fully vaccinated (Primary series with or without booster shot/s)',
    'Partially Vaccinated (Incomplete primary series)',
    'Not Vaccinated'
);

foreach ($vaccineOptions as $option) {
    $isChecked = in_array($option, explode(',', $row['VACCINE']));
    echo "<input type='checkbox' name='Vaccine[]' value='" . htmlspecialchars($option) . "' " . ($isChecked ? 'checked' : '') . "> " . htmlspecialchars($option) . "<br>";
}
echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='drugs'>Generic Name of Drug:</label><input type='text' name='drugs' value='" . $row['DRUG'] . "'>";
            echo "<label for='men'>Age when menstruation began:</label><input type='text' name='men' value='" . $row['MENSTRUATION'] . "'>";
            echo "<label for='month'>Monthly Menstruation Period:</label><input type='text' name='month' value='" . $row['MONTHLY'] . "'>";
            echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='symptoms'>Menstrual Symptoms:</label>";

$menstrualOptions = array(
    'Dysmenorrhea (cramps)',
    'Migraine',
    'Loss of Consciousness',
    'Others:'
);

foreach ($menstrualOptions as $option) {
    $isChecked = in_array($option, explode(',', $row['MENSTRUAL']));
    echo "<input type='checkbox' name='symptoms[]' value='" . htmlspecialchars($option) . "' " . ($isChecked ? 'checked' : '') . "> " . htmlspecialchars($option) . "<br>";
}

            echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='past'>Which of these conditions have you had in the past?</label>";

$pastOptions = array(
    'None',
    'Varicella (Chicken Pox)',
    'Dengue',
    'Tubercolosis',
    'Pneumonia',
    'Urinary Tract Infection',
    'Appendicitis',
    'Cholecystitis',
    'Measles',
    'Typhoid Fever',
    'Amoebiasis',
    'Nephro/Urolithiasis
              (kidney stones)',
    'Injury (Burn, Laceration, etc)',
    'Others:'
);

foreach ($pastOptions as $option) {
    $isChecked = in_array($option, explode(',', $row['PAST']));
    echo "<input type='checkbox' name='past[]' value='" . htmlspecialchars($option) . "' " . ($isChecked ? 'checked' : '') . "> " . htmlspecialchars($option) . "<br>";
}
echo "<div style='margin-bottom: 10px;'></div>";
            echo "<label for='past'>Family Medical History:</label>";

$famOptions = array(
    'None',
    'Bronchial Asthma (“Hika”)',
    'Allergic Rhinitis',
    'Hyperthyroidism',
    'Anemia',
    'Migraine (recurrent headaches)',
    'Epilepsy/Seizures',
    'Gastroesophageal Reflux Disease',
    'Irritable Bowel Syndrome',
    'Hypertension (elevated blood pressure)',
    'Diabetes mellitus (elevated blood sugar)',
    'Dyslipidemia (elevated cholesterol level)',
    'Arthritis (joint pains)',
    'Systemic Lupus Erythematosus (SLE)',
    'Polycystic Ovarian Syndrome (PCOS)',
    'Cancer',
    'Others:'
);

foreach ($famOptions as $option) {
    $isChecked = in_array($option, explode(',', $row['FAMILY']));
    echo "<input type='checkbox' name='fam[]' value='" . htmlspecialchars($option) . "' " . ($isChecked ? 'checked' : '') . "> " . htmlspecialchars($option) . "<br>";
}
echo "<div style='margin-bottom: 10px;'></div>";


            echo "<label for='famILL'>Psychiatric Illness:</label>";

$xtfamOptions = array(
    'None',
    'Major Depressive Disorder',
    'Bipolar Disorder',
    'Allergic Rhinitis',
    'Generalized Anxiety Disorder',
    'Panic Disorder',
    'Post Traumatic Disorder',
    'Schizophrenia'
);

foreach ($xtfamOptions as $option) {
    $isChecked = in_array($option, explode(',', $row['XTFAMILY']));
    echo "<input type='checkbox' name='famILL[]' value='" . htmlspecialchars($option) . "' " . ($isChecked ? 'checked' : '') . "> " . htmlspecialchars($option) . "<br>";
}
echo "<div style='margin-bottom: 10px;'></div>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
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
