<?php

// Get the user id
$MMSI = $_REQUEST['MMSI'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "kp_projek");

if ($MMSI !== "") {
	
	// Get corresponding first name and
	// last name for that user id	
	$query = mysqli_query($con, "SELECT Nama_kapal FROM kapal WHERE MMSI='$MMSI'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Nama_kapal = $row["Nama_kapal"];

}

// Store it in a array
$result = array("$Nama_kapal");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>