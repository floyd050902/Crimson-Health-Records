<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistical Diagnosis Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="font-family: 'Arial', sans-serif;">


<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "patient_db";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$diagnoses = array(
    "None",
    "Bronchial Asthma (“Hika”)",
    "Food Allergies:",
    "Allergic Rhinitis",
    "Hyperthyroidism",
    "Anemia",
    "Migraine",
    "Epilepsy/Seizures",
    "Gastroesophageal Reflux Disease",
    "Irritable Bowel Syndrome",
    "Hypertension",
    "Diabetes",
    "Dyslipidemia",
    "Arthritis",
    "SLE",
    "PCOS"
);

// Initialize counts for each diagnosis
$diagnosisCount = array_fill_keys($diagnoses, 0);
$totalRecords = 0;

$sql = "SELECT * FROM clients";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
    $diagnosesFromDatabase = explode(', ', $row['DIAGNOSIS']); // Split multiple diagnoses

    foreach ($diagnosesFromDatabase as $diagnosis) {
        // Increment the count for each diagnosis
        if (isset($diagnosisCount[$diagnosis])) {
            $diagnosisCount[$diagnosis]++;
            $totalRecords++;
        } else {
            // Print out the value that doesn't match
            echo "Unrecognized Diagnosis: $diagnosis<br>";
        }
    }
}

$connection->close();
?>

<div style="max-width: 1000px; margin: 20px auto;">
    <h2 style="text-align: center;">Statistical Diagnosis Data</h2>
    <canvas id="myChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    var diagnoses = <?php echo json_encode($diagnoses); ?>;
    var counts = <?php echo json_encode(array_values($diagnosisCount)); ?>;
    var totalRecords = <?php echo $totalRecords; ?>;

    var percentageData = counts.map(count => ((count / totalRecords) * 100).toFixed(2));

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: diagnoses,
            datasets: [{
                label: 'Diagnosis Count',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Percentage',
                data: percentageData,
                type: 'line',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                yAxisID: 'percentage-y-axis'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Diagnosis Count'
                    }
                },
                'percentage-y-axis': {
                    beginAtZero: true,
                    max: 100,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Percentage'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
