<?php
if ( isset($_GET["ID"])) {
	$ID = $_GET["ID"];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "patient_db";

	$connection = new mysqli($servername, $username, $password, $database);
	$sql = "DELETE FROM clients WHERE id=$ID";
	$connection->query($sql);
}
header("location: admin_page.php");
exit;
?>