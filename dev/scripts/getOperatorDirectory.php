<?php

	$filter ="";

	$filter = "";
	if (isset($_GET["state"])) {
		$filter = $filter." AND d.state like '%".$_GET["state"]."%'";
	}

	if (isset($_GET["area"])) {
		$filter = $filter." AND d.suburb like '%".$_GET["area"]."%'";
	}

	if (isset($_GET["postcode"])) {
		$filter = $filter." AND d.postcode like '%".$_GET["postcode"]."%'";
		}

	if (isset($_GET["operatortype"])) {
	//	$filter = $filter." AND d.state like '%".$_GET["operatortype"]."%'";
	}

	$network ="";
	$vehicle = "";
	if (isset($_GET["network"])) {
		$network = $_GET["network"];
	}

	if (isset($_GET["vehicle"])) {
		$vehicle = $_GET["vehicle"];
	}

	include_once $_SERVER['DOCUMENT_ROOT'].'/dev/scripts/serverConfig.php';

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
	$sql = "SELECT u.id, u.subscription_id, o.number_of_taxi_operates, o.contact_name, d.mobile_1, d.mobile_2, d.phone, d.fax, "
		."d.state, d.postcode, d.suburb, d.street_number, d.street_name, o.abn_number FROM wp_operators o,wp_server_users u,wp_user_detail d "
		."WHERE u.user_type like 'operator' and u.id = d.user_id and d.user_id = o.user_id and o.user_id=u.id".$filter.";" ;
    	$result = $conn->query($sql);

        $ret = "[";
        $cnt = 0;
        var_dump($result);
    	if ($result->num_rows > 0) {
    	        while($row = $result->fetch_assoc()) {

					$numbers = "";
					$address = "";
					if($row['mobile_1'] != ""){
					  $numbers .= $row['mobile_1'] .',  ';
					}

					if($row['mobile_2'] != ""){
					  $numbers .= $row['mobile_2'] .',  ';
					}

						if($row['phone'] != ""){
					  $numbers .= $row['phone'] .'(Tel.), ';
					}

						if($row['fax'] != ""){
					  $numbers .= $row['fax'] .'(Fax)  ';
					}



					if($row['state'] != ""){
					  $address.= $row['state'] .'  ';
					}

					if($row['postcode'] != ""){
					  $address.= '('.$row['postcode'].'), ';
					}

						if($row['suburb'] != ""){
					  $address.= $row['suburb'] .', ';
					}

					if($row['street_name'] != ""){
					  $address.= $row['street_name'] .' ';
					}
						if($row['street_number'] != ""){
					  $address.= $row['street_number'];
					}
    	        	  if($row['subscription_id'] != ""){
							if($row['subscription_id'] == "1"){
								$row['subscription_id'] = "Driver Subscription";
							}
							if($row['subscription_id'] == "2"){
								$row['subscription_id'] = "Basic Subscription";
							}
							if($row['subscription_id'] == "3"){
								$row['subscription_id'] = "Silver Subscription";
							}
								if($row['subscription_id'] == "4"){
								$row['subscription_id'] = "Golden Subscription";
							}
							if($row['subscription_id'] == "5"){
								$row['subscription_id'] = "Platinum Subscription";
							}
							if($row['subscription_id'] == "6"){
								$row['subscription_id'] = "Diamond Subscription";
							}
							if($row['subscription_id'] == "7"){
								$row['subscription_id'] = "Operator Subscription";
							}
					  }
					  $row['numbers'] = $numbers;
					  $row['address'] = $address;

					  $countSql = "SELECT taxi_network from wp_taxi_details WHERE user_id = ".$row['id']." AND taxi_network like '%".$network."%' AND car_type like '%".$vehicle."%';";
					  $taxiResult = $conn->query($countSql);
					  $taxis = "";

					    if ($taxiResult->num_rows > 0) {
							while($taxirow = $taxiResult->fetch_assoc()) {
								if($taxirow['taxi_network'] != ""){
									$taxis .= $taxirow['taxi_network'] . ",";
								}
							}
						}
						$taxis = rtrim($taxis,",");
						$row['taxis'] = $taxis;

                      $tmp = json_encode($row);

                      $cnt = $cnt + 1;
                      if($cnt != $result->num_rows)
                            $ret = $ret.$tmp.",";
                      else
                            $ret = $ret.$tmp;
    		}
        }

        $ret = $ret."]";
        echo $ret;
	$conn->close();
?>
