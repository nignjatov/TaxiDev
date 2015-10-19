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
	$type = $_GET['type'];// 1 driver wanted, 2 taxi,3 wanttodrive, 4 cpls
	$id = $_GET['id'];
	
	$sql = "";
	if($type == '1'){
		$sql = "DELETE FROM`wp_general_ads_driver_wanted` WHERE ID = ".$id.";";
	} else if($type == '2'){
		$sql = "DELETE FROM`wp_general_ads_taxi_ads` WHERE ID = ".$id.";";
	} else if($type == '3'){
		$sql = "DELETE FROM `wp_general_ads_want_to_drive` WHERE ID = ".$id.";";
	} else if($type == '4'){
		$sql = "DELETE FROM`wp_general_ads_cpls' WHERE ID = ".$id.";";
	} 

	echo $sql;
	$result = $conn->query($sql);
			
	echo '$$$$ '.$result;				  
	$conn->close();
?>


