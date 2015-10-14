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


	$options = "";
	if (!empty($_REQUEST['option_1'])) {
		$options .= $_REQUEST['option_1'];
		$options .= ",";
	}
	if (!empty($_REQUEST['option_2'])) {
		$options .= $_REQUEST['option_2'];
	}

	$shift = "";
	if (!empty($_REQUEST['dshift'])) {
		$shift .= $_REQUEST['dshift'];
		$shift .= ",";
	}
	if (!empty($_REQUEST['nshift'])) {
		$shift .= $_REQUEST['nshift'];
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

	$ndays = "";
	if (!empty($_REQUEST['ndays_1'])) {
		$ndays .= $_REQUEST['ndays_1'];
		$ndays .= ",";
	}
	if (!empty($_REQUEST['ndays_2'])) {
		$ndays .= $_REQUEST['ndays_2'];
		$ndays .= ",";
	}
	if (!empty($_REQUEST['ndays_3'])) {
		$ndays .= $_REQUEST['ndays_3'];
		$ndays .= ",";
	}
	if (!empty($_REQUEST['ndays_4'])) {
		$ndays .= $_REQUEST['ndays_4'];
		$ndays .= ",";
	}
	if (!empty($_REQUEST['ndays_5'])) {
		$ndays .= $_REQUEST['ndays_5'];
		$ndays .= ",";
	}
	if (!empty($_REQUEST['ndays_6'])) {
		$ndays .= $_REQUEST['ndays_6'];
		$ndays .= ",";
	}
	if (!empty($_REQUEST['ndays_7'])) {
		$ndays .= $_REQUEST['ndays_7'];
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

	$sql = "INSERT INTO wp_general_ads_taxi_ads(user_id,name,contact,type,state,area,network,plate,shift,days,ndays,car,year,vehicles".
           							",fuel,kilometers,options,lease,comment) VALUES(0,'".$_REQUEST['name']."', '".$_REQUEST['contact']."', '"
           							.$_REQUEST['plate']."', '".$shift."', '".$days."', '".$ndays."', '"
           							.$_REQUEST['car']."', '".$_REQUEST['year']."', '".$vehicles."', '".$_REQUEST['fuel']."', '"
           							.$_REQUEST['kilometers']."', '".$options."', '".$_REQUEST['lease']."', '".$_REQUEST['comment']."');";

	echo $sql;
	$result = $conn->query("INSERT INTO wp_general_ads_taxi_ads(user_id,name,contact,type,state,area,network,plate,shift,days,ndays,car,year,vehicles".
							",fuel,kilometers,options,lease,comment) VALUES(0,'".$_REQUEST['name']."', '".$_REQUEST['contact']."', '"
							.$_REQUEST['type']."', '".$_REQUEST['state']."', '".$_REQUEST['area']."', '".$_REQUEST['network']."', '"
							.$_REQUEST['plate']."', '".$shift."', '".$days."', '".$ndays."', '"
							.$_REQUEST['car']."', '".$_REQUEST['year']."', '".$vehicles."', '".$_REQUEST['fuel']."', '"
							.$_REQUEST['kilometers']."', '".$options."', '".$_REQUEST['lease']."', '".$_REQUEST['comment']."');");

	echo $result;
	$conn->close();
?>