<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "phptutorials" );

if(isset($_POST['save_multiple_checkbox']))
{
	$diagnosis = $_POST['diagnose'];
	echo $diagnosis;
}