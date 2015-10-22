<?php

	$filter = "";
	if (isset($_GET["operator"])) {
		$filter= $_GET["operator"];
	}

	if($filter == ""){
		return json_encode("");
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
	$sql = "SELECT o.user_id, o.contact_name, d.mobile_1, d.mobile_2, d.phone, d.fax, "
		."d.state, d.postcode, d.suburb, d.street_number, d.street_name, o.abn_number FROM wp_operators o, wp_user_detail d "
		."WHERE d.user_id = o.user_id;" ;
    	$result = $conn->query($sql);

        $ret = "[";
        $cnt = 0;
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

					  $row['numbers'] = $numbers;
					  $row['address'] = $address;

					  $countSql = "SELECT * from wp_taxi_details WHERE user_id = ".$row['user_id'].";";
					  $taxiResult = $conn->query($countSql);
					  $taxi = "";
					  $taxiCounter = 0;
                      $taxis = "[";
					    if ($taxiResult->num_rows > 0) {
							while($taxirow = $taxiResult->fetch_assoc()) {
							    $taxiCounter = $taxiCounter + 1;
								$taxi = json_encode($taxirow);
							  if($taxiCounter != $taxiResult->num_rows)
									$taxis = $taxis.$taxi.",";
							  else
									$taxis = $taxis.$taxi;
							}
						}
					  $taxis .= "]";
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
