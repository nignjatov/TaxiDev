<?php

	include_once './config.php';

	$username = ''.USERNAME;
	$password = ''.PASSWORD;
	$hostname = ''.HOST;

	//connection to the database
	$conn  = new mysqli($hostname, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$conn->select_db(''.DBNAME);


	$shift = "";
	if ($_REQUEST['shift_1'] != "") {
		$shift .= $_REQUEST['shift_1'];
		$shift .= ",";
	}
	if ($_REQUEST['shift_2'] != "") {
		$shift .= $_REQUEST['shift_2'];
		$shift .= ",";
	}
	if ($_REQUEST['shift_3'] != "") {
		$shift .= $_REQUEST['shift_3'];
	}

	$shift = rtrim($shift, ",");

	$days = "";
	if ($_REQUEST['days_1'] != "") {
		$days .= $_REQUEST['days_1'];
		$days .= ",";
	}
	if ($_REQUEST['days_2'] != "") {
		$days .= $_REQUEST['days_2'];
		$days .= ",";
	}
	if ($_REQUEST['days_3'] != "") {
		$days .= $_REQUEST['days_3'];
		$days .= ",";
	}
	if ($_REQUEST['days_4'] != "") {
		$days .= $_REQUEST['days_4'];
		$days .= ",";
	}
	if ($_REQUEST['days_5'] != "") {
		$days .= $_REQUEST['days_5'];
		$days .= ",";
	}
	if ($_REQUEST['days_6'] != "") {
		$days .= $_REQUEST['days_6'];
		$days .= ",";
	}
	if ($_REQUEST['days_7'] != "") {
		$days .= $_REQUEST['days_7'];
	}


	$days = rtrim($days, ",");


	$vehicles = "";
	if ($_REQUEST['vehicles_1'] != "") {
		$vehicles .= $_REQUEST['vehicles_1'];
		$vehicles .= ",";
	}
	if ($_REQUEST['vehicles_2'] != "") {
		$vehicles .= $_REQUEST['vehicles_2'];
		$vehicles .= ",";
	}
	if ($_REQUEST['vehicles_3'] != "") {
		$vehicles .= $_REQUEST['vehicles_3'];
		$vehicles .= ",";
	}
	if ($_REQUEST['vehicles_4'] != "") {
		$vehicles .= $_REQUEST['vehicles_4'];
		$vehicles .= ",";
	}
	if ($_REQUEST['vehicles_5'] != "") {
		$vehicles .= $_REQUEST['vehicles_5'];
	}

	$vehicles = rtrim($vehicles, ",");

	$result = $conn->query("INSERT INTO wp_general_ads_want_to_drive(user_id,name,contact,type,state,area,network,shift,days,vehicles,comment,postal_code)".
							  " VALUES(0,'".$_REQUEST['name']."', '".$_REQUEST['contact']."', '".$_REQUEST['type']."', '".$_REQUEST['state'].
							  "', '".$_REQUEST['area']."','".$_REQUEST['network']."', '".$shift."', '".$days."', '".$vehicles.
							  "', '".$_REQUEST['comment']."', '".$_REQUEST['postal_code']."');");

	$conn->close();
	?>