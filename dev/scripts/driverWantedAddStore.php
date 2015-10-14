<?php

	var_dump($_REQUEST);

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

	$looking_for = "";
	if (!empty($_REQUEST['looking_for_1'])) {
		$looking_for.= $_REQUEST['looking_for_1'];
		$looking_for .= ",";
	}
	if (!empty($_REQUEST['looking_for_1'])) {
		$looking_for .= $_REQUEST['looking_for_2'];
	}

	$shift = "";
	if (!empty($_REQUEST['shift_1'])) {
		$shift .= $_REQUEST['shift_1'];
		$shift .= ",";
	}
	if (!empty($_REQUEST['shift_2'])) {
		$shift .= $_REQUEST['shift_2'];
		$shift .= ",";
	}
	if (!empty($_REQUEST['shift_3'])) {
		$shift .= $_REQUEST['shift_3'];
	}

	$days = "";
	if (!empty($_REQUEST['days_1'])) {
		$days .= $_REQUEST['days_1'];
		$days .= ",";
	}
	if (!empty($_REQUEST['days_2'])) {
		$days .= $_REQUEST['days_2'];
		$days .= ",";
	}
	if (!empty($_REQUEST['days_3'])) {
		$days .= $_REQUEST['days_3'];
		$days .= ",";
	}
	if (!empty($_REQUEST['days_4'])) {
		$days .= $_REQUEST['days_4'];
		$days .= ",";
	}
	if (!empty($_REQUEST['days_5'])) {
		$days .= $_REQUEST['days_5'];
		$days .= ",";
	}
	if (!empty($_REQUEST['days_6'])) {
		$days .= $_REQUEST['days_6'];
		$days .= ",";
	}
	if (!empty($_REQUEST['days_7'])) {
		$days .= $_REQUEST['days_7'];
	}

	$vehicles = "";
	if (!empty($_REQUEST['vehicles_1'])) {
		$vehicles .= $_REQUEST['vehicles_1'];
		$vehicles .= ",";
	}
	if (!empty($_REQUEST['vehicles_2'])) {
		$vehicles .= $_REQUEST['vehicles_2'];
		$vehicles .= ",";
	}
	if (!empty($_REQUEST['vehicles_3'])) {
		$vehicles .= $_REQUEST['vehicles_3'];
		$vehicles .= ",";
	}
	if (!empty($_REQUEST['vehicles_4'])) {
		$vehicles .= $_REQUEST['vehicles_4'];
		$vehicles .= ",";
	}
	if (!empty($_REQUEST['vehicles_5'])) {
		$vehicles .= $_REQUEST['vehicles_5'];
	}



	$result = $conn->query("INSERT INTO wp_general_ads_driver_wanted(user_id,name,contact,looking_for,type,state,area,network,shift,days,vehicles,comment)".
							  " VALUES(0,'".$_REQUEST['name']."', '".$_REQUEST['contact']."', '".$looking_for."', '".$_REQUEST['type']."', '".$_REQUEST['state'].
							  "', '".$_REQUEST['area']."','".$_REQUEST['network']."', '".$shift."', '".$days."', '".$vehicles.
							  "', '".$_REQUEST['comment']."');");

	$conn->close();
?>