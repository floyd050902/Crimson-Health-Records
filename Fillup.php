<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "patient_db";

  $connection = new mysqli($servername, $username, $password, $database);
  $ID = "";
  $WMSU_ID = "";
  $NAME = "";
  $course = "";
  $AGE = "";
  $ADDRESS = "";
  $CONTACT ="";
  $Yearlvl = "";
  $Birthdate = "";
  $CIVILSTAT ="";
  $WMSU_EMAIL = "";
  $GENDER = "";
  $nationality = "";
  $XTNAME = "";
  $XTCONTACT = "";
  $XTADDRESS = "";
  $XTRELATION = "";
  $DIAGNOSIS = "";
  $ILLNESS = "";
  $VACCINE ="";
  $DRUG ="";
  $MENSTRUATION ="";
  $MONTHLY ="";
  $MENSTRUAL ="";
  $PAST ="";
  $FAMILY ="";
  $XTFAMILY ="";
  $errorMessage = "";
  $successMessage = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $WMSU_ID = $_POST["WMSU_ID"];
      $NAME = $_POST["name"];
      $course = $_POST["COURSE"];
      $AGE = $_POST["age"];
      $ADDRESS = $_POST["address"];
      $CONTACT = $_POST["numb"];
      $Yearlvl = $_POST["year"];
      $Birthdate = $_POST["birthday"];
      $CIVILSTAT = $_POST["civil"];
      $WMSU_EMAIL = $_POST["WMSU_EMAIL"];
      $GENDER = $_POST["gender"];
      $nationality = $_POST["NATIONALITY"];
      $XTNAME = $_POST["names"];
      $XTCONTACT = $_POST["cont"];
      $XTADDRESS = $_POST["add"];
      $XTRELATION = $_POST["relate"];
      $DIAGNOSIS = isset($_POST["Diagnosis"]) ? implode(', ', $_POST["Diagnosis"]) : '';
      $ILLNESS = isset($_POST["Illness"]) ? implode(', ', $_POST["Illness"]) : '';
      $VACCINE = isset($_POST["Vaccine"]) ? implode(', ', $_POST["Vaccine"]) : '';
      $DRUG = isset($_POST["drugs"]) ? implode(', ', $_POST["drugs"]) : '';
      $MENSTRUATION = $_POST["men"];
      $MONTHLY = $_POST["month"];
      $MENSTRUAL = isset($_POST["symptoms"]) ? implode(', ', $_POST["symptoms"]) : '';
      $PAST = isset($_POST["past"]) ? implode(', ', $_POST["past"]) : '';
      $FAMILY = isset($_POST["fam"]) ? implode(', ', $_POST["fam"]) : '';
      $XTFAMILY = isset($_POST["famILL"]) ? implode(', ', $_POST["famILL"]) : '';
      
       $checkNameQuery = "SELECT * FROM clients WHERE name = '$NAME'";
      $resultCheckName = $connection->query($checkNameQuery);
      if ($resultCheckName->num_rows > 0) {
        $errorMessage = "Name already taken. Please choose a different name.";
    } else {


      if (empty($WMSU_ID) || empty($NAME) || empty($course) || empty($AGE) || empty($ADDRESS) || empty($CONTACT) || empty($Yearlvl) || empty($Birthdate) || empty($CIVILSTAT) || empty($WMSU_EMAIL) || empty($GENDER) || empty($nationality) || empty($XTNAME) || empty($XTCONTACT) || empty($XTADDRESS) || empty($course) || empty($DIAGNOSIS) || empty($ILLNESS) || empty($VACCINE) || empty($DRUG) || empty($MENSTRUATION) || empty($MONTHLY) || empty($MENSTRUAL) || empty($PAST) || empty($FAMILY) || empty($XTFAMILY)){
          $errorMessage = "All the fields are required";
      } else {
          $sql = "INSERT INTO clients (WMSU_ID, name, course, age, ADDRESS, CONTACT,  Yearlvl, Birthdate, CIVILSTAT, WMSU_EMAIL, gender, nationality, XTNAME, XTCONTACT, XTADDRESS, XTRELATION, DIAGNOSIS, ILLNESS, VACCINE, DRUG, MENSTRUATION, MONTHLY, MENSTRUAL, PAST, FAMILY, XTFAMILY) VALUES ('$WMSU_ID', '$NAME', '$course', '$AGE', '$ADDRESS', '$CONTACT', '$Yearlvl',  '$Birthdate', '$CIVILSTAT',  '$WMSU_EMAIL', '$GENDER', '$nationality', '$XTNAME', '$XTCONTACT', '$XTADDRESS', '$XTRELATION', '$DIAGNOSIS', '$ILLNESS', '$VACCINE', '$DRUG', '$MENSTRUATION', '$MONTHLY', '$MENSTRUAL', '$PAST', '$FAMILY', '$XTFAMILY')";
          $result = $connection->query($sql);

          if (!$result) {
              $errorMessage = "Invalid query: " . $connection->error;
          } elseif ($connection->affected_rows > 0) {
              $successMessage = "Patient added successfully";
              header("location: admin_page.php");
              exit;
          } else {
              $errorMessage = "Failed to add patient";
          }
      }
  }
}
  ?>
    
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
  <script>
  $(document).ready(function () {
    var totalSteps = 3;
    var currentStep = 1;
    var progressWidth = 0;
    var steps = $(".step");
    var progressBar = $("#progress");
    var btnSubmit = $(".btn-submit");

    showStep(currentStep);

    $('.btn-next').click(function (e) {
      e.preventDefault();
      if (validateStep(currentStep)) {
        currentStep++;
        progressWidth += 100 / totalSteps;
        updateProgress(progressWidth);
        showStep(currentStep);
      }
    });

    $('.btn-prev').click(function () {
      currentStep--;
      progressWidth -= 100 / totalSteps;
      updateProgress(progressWidth);
      showStep(currentStep);
    });

    function showStep(step) {
      steps.hide();
      steps.eq(step - 1).show();

      $('.btn-prev').toggle(step > 1);
      btnSubmit.toggle(step === totalSteps);
      $('.btn-next').toggle(step < totalSteps);

      // If it's the third step, disable validation
      if (step === totalSteps) {
        btnSubmit.prop('disabled', false);
      } else {
        btnSubmit.prop('disabled', true);
      }
    }

    function validateStep(step) {
      // Skip validation for the third step
      if (step === totalSteps) {
        return true;
      }

      var inputs = steps.eq(step - 1).find("input[required]");
      var isValid = true;

      inputs.each(function () {
        if (!this.checkValidity()) {
          isValid = false;
          return false;
        }
      });

      if (!isValid) {
        alert("Please fill out all required fields before proceeding.");
      }

      return isValid;
    }

    function updateProgress(width) {
      progressBar.css("width", width + "%");
    }
  });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>


</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: crimson;
}

.container {
  position: relative;
  max-width: 900px;
  width: 100%;
  border-radius: 6px;
  padding: 30px;
  margin: 0 15px;
  background-color: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.container header {
  position: relative;
  font-size: 20px;
  font-weight: 600;
  color: #333;
}

.container header::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  height: 3px;
  width: 27px;
  border-radius: 8px;
  background-color: crimson;
}

.container form {
  position: relative;
  margin-top: 16px;
  min-height: 490px;
  background-color: #fff;
}

.container form .details {
  margin-top: 30px;
}

.container form .details .ID {
  margin-top: 10px;
}

.container form .title {
  display: block;
  margin-bottom: 8px;
  font-size: 16px;
  font-weight: 500;
  margin: 6px 0;
  color: #333;
}

.container .row.mb-3 .label {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
}

.container form .fields .input-field {
  display: flex;
  width: calc(100% / 3 - 15px);
  flex-direction: column;
  margin: 4px 0;
}

.input-field label {
  font-size: 12px;
  font-weight: 500;
  color: #2e2e2e;
  margin-bottom: 2px;
}

.input-field input {
  outline: none;
  font-size: 14px;
  font-weight: 400;
  color: #333;
  border-radius: 5px;
  border: 1px solid #aaa;
  padding: 0 15px;
  height: 42px;
  margin: 8px 0;
}

.input-field input:focus,
.input-field input:valid {
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.13);
}

.input-field input[type="date"] {
  color: #707070;
}

.input-field input[type="date"]:valid {
  color: #333;
}

.container form button,
.container form .backBtn {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 45px;
  max-width: 200px;
  width: 100%;
  border: none;
  outline: none;
  color: #fff;
  background-color: crimson;
  border-radius: 5px;
  margin: 25px 0;
  transition: all 0.3s linear;
  cursor: pointer;
}

.container form button,
.container form .backBtn {
  font-size: 14px;
  font-weight: 400;
}

form button:hover {
  background-color: crimson;
}

form button i,
form .backBtn i {
  margin: 0 6px;
}

form .backBtn i {
  transform: rotate(180deg);
}

form .buttons {
  display: flex;
  align-items: center;
}

form .buttons button,
.backBtn {
  margin-right: 14px;
}

/* Additional styling for checkboxes */

.form-check {
  margin-bottom: 8px;
}

.form-check input {
  margin-top: 2px;
  margin-right: 8px; /* Adjust the margin-right value to create the desired gap */
}


</style>


  <body>
      <div class="container my-5">
      <h2>PATIENT FILL UP FORM</h2>
     <div class="progress">
    <div class="progress-bar" id="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
      
      <?php
      if (!empty($errorMessage)) {
        echo "
          <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>$errorMessage</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
        ";
      }
      ?>
      <form method="post">
        <div class="step">
          <h2>Personal Information</h2>
        <div class="row mb-3">
    <label class="col-sm-3 col-form-label">WMSU ID</label>
   <div class="col-sm-6">
    <input type="text" class="form-control" name="WMSU_ID" pattern="\d{4}-\d{5}" title="Please enter in the format xxxx-xxxxx" oninput="this.value=this.value.replace(/[^\d-]/g,'')" maxlength="10" placeholder="Enter WMSU ID (e.g., xxxx-xxxxx)" value="<?php echo $WMSU_ID; ?>" required>
</div>
</div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="<?php echo $NAME; ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">College</label>
          <div class="col-sm-6">
            <?php echo $course; ?>
            <select name="COURSE">
              <option value=""> --Select--</option>
              <option value="Engineering">College of Engineering</option>
              <option value="Nursing">College of Nursing</option>
              <option value="CLA">College of Liberal Arts</option>
              <option value="Agriculture">College of Agriculture</option>
              <option value="Architechture">College of Architecture</option>
              <option value="CCJE">College of Criminal Justice Education</option>
              <option value="Education">College of Education</option>
              <option value="CFES">College of Forestry and Environmental Studies</option>
              <option value="Economics">College of Home Economics</option>
              <option value="Law">College of Law</option>
              <option value="PE">College of Physical Education</option>
              <option value="CSM">College of Science and Mathematics</option>
              <option value="Social Science">College of Social Science</option>
              <option value="Veterinary">College of Veterinary Medicine</option>
              <option value="CAIS">College of Asian Studies</option>
              <option value="CCS">College of Computer Science</option>
              <option value="IT">College of Information Technology</option>
            </select>


          
          </div>
        </div>
        <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Age</label>
<div class="col-sm-6">
    <input type="text" class="form-control" name="age" pattern="\d{2}" title="Please enter exactly 2 digits" oninput="this.value=this.value.replace(/[^\d]/g,'')" maxlength="2" value="<?php echo $AGE; ?>" required>
</div>

</div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Address</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="address" value="<?php echo $ADDRESS; ?>">
          </div>
        </div>
        <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Contact Number</label>
    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-text font-weight-bold">+63</span>
            <input type="text" class="form-control" name="numb" pattern="\d{3}-\d{3}-\d{4}" title="Please enter the number in the format xxx-xxx-xxxx" placeholder="e.g., xxx-xxx-xxxx" oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')" value="<?php echo $CONTACT; ?>" required>

        </div>
    </div>
</div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Year Level/Position</label>
          <div class="col-sm-6">
            <?php echo $Yearlvl; ?>
            <select name="year">
              <option value=""> --Select--</option>
              <option value="1st Year">1st Year College</option>
              <option value="2nd Year">2nd Year College</option>
              <option value="3rd Year">3rd Year College</option>
              <option value="4th Year">4th Year College</option>
              <option value="4th Year">5th Year College</option>
              <option value="Faculty">Faculty</option>
              <option value="Staff">Staff</option>
            </select>


          
          </div>
        </div>

          <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Birth Date</label>
          <div class="col-sm-6">
            <input type="date" class="form-control" name="birthday" value="
            <?php echo $Birthdate; ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Civil Status</label>
          <div class="col-sm-6">
            <?php echo $CIVILSTAT; ?>
            <select name="civil">
              <option value=""> --Select--</option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Divorced">Divorced</option>
              <option value="Widowed">Widowed</option>
            </select>
          
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">WMSU Email</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="WMSU_EMAIL" value="<?php echo $WMSU_EMAIL; ?>">
          </div>
        </div>
      
       <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Sex</label>
          <div class="col-sm-6">
            <?php echo $GENDER; ?>
            <select name="gender">
              <option value=""> --Select--</option>
              <option value="Single">Male</option>
              <option value="Married">Female</option>
              
            </select>
          
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Nationality</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="NATIONALITY" value="<?php echo $nationality; ?>">
          </div>
        </div>
      </div>
        <div class="step" style="display: none;">
        <div class="row mb-3">
        <h2>Emergency Contact Person</h2>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="names" value="<?php echo $XTNAME; ?>">
          </div>
        </div>

    <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Contact Number</label>
    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-text font-weight-bold">+63</span>
            <input type="text" class="form-control" name="cont" pattern="\d{3}-\d{3}-\d{4}" title="Please enter the number in the format xxx-xxx-xxxx" placeholder="e.g., xxx-xxx-xxxx" oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')" value="<?php echo $XTCONTACT; ?>" required>
        </div>
    </div>
</div>

      <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Address</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="add" value="<?php echo $XTADDRESS; ?>">
          </div>
        </div>
      <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Relationship</label>
          <div class="col-sm-6">
            <?php echo $Yearlvl; ?>
            <select name="relate">
              <option value=""> --Select--</option>
              <option value="Father">Father</option>
              <option value="Mother">Mother</option>
              <option value="Daughter">Daughter</option>
              <option value="Son">Son</option>
              <option value="Sister">Sister</option>
              <option value="Brother">Brother</option>
              <option value="GrandFather">GrandFather</option>
              <option value="GrandMother">GrandMother</option>
              <option value="Others">Others/Guardian</option>
            </select>


</div>
</div>
          
          </div>
        </div>
        <div class="step" style="display: none;">
        <div class="row mb-3">
      <h2>Which of these conditions do you currently have?</h2>
      <div class="card-body">
          <div class="form-group">
            <input type="checkbox" name="Diagnosis[]" value="None"> None <br>

            <input type="checkbox" name="Diagnosis[]" value="Bronchial Asthma (“Hika”)"> Bronchial Asthma (“Hika”) <br>
            <input type="checkbox" name="Diagnosis[]" value="Others"> Food Allergies: 
                <input type="text" name="OtherDiagnosis" placeholder="Specify Food"><br>
              <input type="checkbox" name="Diagnosis[]"  value="Allergic Rhinitis"> Allergic Rhinitis<br>
              <input type="checkbox" name="Diagnosis[]"  value="Hyperthyroidism"> Hyperthyroidism <br>
              <input type="checkbox" name="Diagnosis[]"  value="Anemia"> Anemia <br>
              <input type="checkbox" name="Diagnosis[]" value="Migraine"> Migraine (recurrent headaches) <br>
              <input type="checkbox" name="Diagnosis[]" value="Epilepsy"> Epilepsy/Seizures <br>
              <input type="checkbox" name="Diagnosis[]" value="GERD"> Gastroesophageal Reflux Disease  <br>
              <input type="checkbox" name="Diagnosis[]" value="Irritable Bowel Syndrome">Irritable Bowel Syndrome <br>
              <input type="checkbox" name="Diagnosis[]" value="Hypertension">Hypertension (elevated blood pressure) <br>
              <input type="checkbox" name="Diagnosis[]" value="Diabetes">Diabetes mellitus (elevated blood sugar) <br>
              <input type="checkbox" name="Diagnosis[]" value="Dyslipidemia">Dyslipidemia (elevated cholesterol level) <br>
              <input type="checkbox" name="Diagnosis[]" value="Arthritis">Arthritis (joint pains) <br>
              <input type="checkbox" name="Diagnosis[]" value="SLE">Systemic Lupus Erythematosus (SLE) <br>
               <input type="checkbox" name="Diagnosis[]" value="PCOS">Polycystic Ovarian Syndrome (PCOS)<br>
               <input type="checkbox" name="Diagnosis[]" value="Others"> Cancer: 
                <input type="text" name="OtherDiagnosis" placeholder="Please specify"><br>

              

              &nbsp;
              <h5>Psychiatric Illness:</h5>
              <input type="checkbox" name="Illness[]" value="None"> None <br>

              <input type="checkbox" name="Illness[]"  value="Major Depressive Disorder">Major Depressive Disorder<br>
              <input type="checkbox" name="Illness[]"  value="Bipolar Disorder"> Bipolar Disorder <br>
              <input type="checkbox" name="Illness[]"  value="Generalized Anxiety Disorder"> Generalized Anxiety Disorder <br>
              <input type="checkbox" name="Illness[]" value="Panic Disorder"> Panic Disorder <br>
              <input type="checkbox" name="Illness[]" value="Panic Post Traumatic Disorder "> Post Traumatic Disorder <br>
              <input type="checkbox" name="Illness[]" value="Schizophrenia"> Schizophrenia <br>
              <input type="text" name="OtherDiagnosis" style="border-bottom: 1px solid #000;" placeholder="Please specify"><br>
               &nbsp;
               <h5>COVID-19 Vaccination</h5>
               <input type="checkbox" name="Vaccine[]"  value="Fully vaccinated">Fully vaccinated (Primary series with or without booster shot/s) <br>
              <input type="checkbox" name="Vaccine[]"  value="Partially Vaccinated"> Partially Vaccinated (Incomplete primary series)<br>
              <input type="checkbox" name="Vaccine[]"  value="Not Vaccinated">Not Vaccinated<br>
              &nbsp;
              <h5>Maintenance Medication</h5>
               <input type="checkbox" name="drugs[]" value="None"> None <br>
               <input type="checkbox" name="drugs[]" value="1"> Generic Name of Drug 1: 
                <input type="text" name="drugs[]" placeholder="Please specify"><br>
                <input type="checkbox" name="drugs[]" value="2"> Generic Name of Drug 2: 
                <input type="text" name="drugs[]" placeholder="Please specify"><br>
                <input type="checkbox" name="drugs[]" value="3"> Generic Name of Drug 3: 
                <input type="text" name="drugs[]" placeholder="Please specify"><br>
                &nbsp;
              <h5>Menstrual & Obstretic History (for females only)</h5>
              <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Age when Menstruation began</label>
          <div class="col-sm-6">
            <input type="number" class="form-control" name="men" value="<?php echo $MENSTRUATION; ?>">
          </div>
        </div>
              <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Monthly Menstruation</label>
          <div class="col-sm-6">
            <?php echo $MONTHLY; ?>
            <select name="month">
              <option value=""> --Select--</option>
              <option value="Regular">Regular</option>
              <option value="Irregular">Irregular</option>
            </select>
          </div>
        </div>
        <h5>Menstrual Symptoms</h5>
        <input type="checkbox" name="symptoms[]" value="None"> None <br>

              <input type="checkbox" name="symptoms[]"  value="Dysmenorrhea (cramps)">Dysmenorrhea (cramps)<br>
              <input type="checkbox" name="symptoms[]"  value="Migraine">Migraine<br>
              <input type="checkbox" name="symptoms[]"  value="Loss of Consciousness"> Loss of Consciousness<br>
              <input type="checkbox" name="symptoms[]" value="Others"> Others: 
                <input type="text" name="OtherDiagnosis" placeholder=" Please specify"><br>
                &nbsp;
              <h5>Which of these conditions have you had in the past?</h5>
              <input type="checkbox" name="past[]" value="None"> None <br>

              <input type="checkbox" name="past[]"  value="Varicella">Varicella (Chicken Pox)<br>
              <input type="checkbox" name="past[]"  value="Dengue"> Dengue <br>
              <input type="checkbox" name="past[]"  value="Tubercolosis"> Tubercolosis<br>
              <input type="checkbox" name="past[]" value="Pneumonia"> Pneumonia<br>
              <input type="checkbox" name="past[]" value="Urinary Tract Infection">Urinary Tract Infection<br>
              <input type="checkbox" name="past[]" value="Appendicitis"> Appendicitis<br>
              <input type="checkbox" name="past[]" value="Cholecystitis">Cholecystitis<br>
              <input type="checkbox" name="past[]" value="Measles"> Measles<br>
              <input type="checkbox" name="past[]" value="Typhoid"> Typhoid Fever<br>
              <input type="checkbox" name="past[]" value="Amoebiasis">Amoebiasis<br>
              <input type="checkbox" name="past[]" value="Kidney Stone">Nephro/Urolithiasis
              (kidney stones)<br>
              <input type="checkbox" name="past[]" value="Injury">Injury (Burn, Laceration, etc)<br>
              &nbsp;

               <h5>Family Medical History</h5>
               <input type="checkbox" name="fam[]" value="None"> None <br>

            <input type="checkbox" name="fam[]" value="Bronchial Asthma (“Hika”)"> Bronchial Asthma (“Hika”) <br>
            
              <input type="checkbox" name="fam[]"  value="Allergic Rhinitis"> Allergic Rhinitis<br>
              <input type="checkbox" name="fam[]"  value="Hyperthyroidism"> Hyperthyroidism <br>
              <input type="checkbox" name="fam[]"  value="Anemia"> Anemia <br>
              <input type="checkbox" name="fam[]" value="Migraine"> Migraine (recurrent headaches) <br>
              <input type="checkbox" name="fam[]" value="Epilepsy"> Epilepsy/Seizures <br>
              <input type="checkbox" name="fam[]" value="GERD"> Gastroesophageal Reflux Disease  <br>
              <input type="checkbox" name="fam[]" value="Irritable Bowel Syndrome">Irritable Bowel Syndrome <br>
              <input type="checkbox" name="fam[]" value="Hypertension">Hypertension (elevated blood pressure) <br>
              <input type="checkbox" name="fam[]" value="Diabetes">Diabetes mellitus (elevated blood sugar) <br>
              <input type="checkbox" name="fam[]" value="Dyslipidemia">Dyslipidemia (elevated cholesterol level) <br>
              <input type="checkbox" name="fam[]" value="Arthritis">Arthritis (joint pains) <br>
              <input type="checkbox" name="fam[]" value="SLE">Systemic Lupus Erythematosus (SLE) <br>
               <input type="checkbox" name="fam[]" value="PCOS">Polycystic Ovarian Syndrome (PCOS)<br>
               <input type="checkbox" name="fam[]" value="Others"> Cancer: 
                <input type="text" name="OtherDiagnosis" placeholder="Please specify"><br>

               <input type="checkbox" name="fam[]" value="Others"> Others: 
                <input type="text" name="OtherDiagnosis" placeholder="Please specify"><br>

              &nbsp;
              <h5>Psychiatric Illness:</h5>
              <input type="checkbox" name="famILL[]" value="None"> None <br>

              <input type="checkbox" name="famILL[]"  value="Major Depressive Disorder">Major Depressive Disorder<br>
              <input type="checkbox" name="famILL[]"  value="Bipolar Disorder"> Bipolar Disorder <br>
              <input type="checkbox" name="famILL[]"  value="Generalized Anxiety Disorder"> Generalized Anxiety Disorder <br>
              <input type="checkbox" name="famILL[]" value="Panic Disorder"> Panic Disorder <br>
              <input type="checkbox" name="famILL[]" value="Panic Post Traumatic Disorder "> Post Traumatic Disorder <br>
              <input type="checkbox" name="famILL[]" value="Schizophrenia"> Schizophrenia <br>
             


             


            </div>
</div>
</div>

</div>

        



          
        <?php
        if (!empty($successMessage)) {
          echo "
          <div class='row mb-3'>
          <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>$successMessage</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          </div
          </div
          ";
        }
        ?>
        <div class="row mb-3">
  <div class="offset-sm-3 col-sm-6">
    <div class="row align-items-center">
      <div class="col-md-6 mb-2">
        <button type="button" class="btn btn-secondary btn-prev">Previous</button>
      </div>
      <div class="col-md-6 mb-2">
        <button type="button" class="btn btn-primary btn-next">Next</button>
        <button type="submit" class="btn btn-primary btn-submit" style="display: none;">Submit</button>
      </div>
    </div>
  </div>
</div>
  

      </form>


    </div>
    </div>

    </body>
  </body>
  </html>