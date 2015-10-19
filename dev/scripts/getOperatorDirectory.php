<?php

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
	$sql = "SELECT u.subscription_id, o.number_of_taxi_operates, o.contact_name, d.mobile_1, d.mobile_2, d.phone, d.fax, "
		."d.state, d.postcode, d.suburb, d.street_number, d.street_name, o.abn_number FROM wp_operators o,wp_server_users u,wp_user_detail d "
		."WHERE u.user_type like 'operator' and u.id = d.user_id and d.user_id = o.user_id and o.user_id=u.id" ;
    	$result = $conn->query($sql);

    	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
    			$numbers = "";
    			$address = "";
    			$membership = "";
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
    					$membership = "Driver Subscription";
    				}    				
    				if($row['subscription_id'] == "2"){
    					$membership = "Basic Subscription";
    				}
        			if($row['subscription_id'] == "3"){
	    				$membership = "Silver Subscription";
    				}
      				if($row['subscription_id'] == "4"){
    					$membership = "Golden Subscription";			
    				}
        			if($row['subscription_id'] == "5"){
    					$membership = "Platinum Subscription";
    				}
    				if($row['subscription_id'] == "6"){
    					$membership = "Diamond Subscription";
    				}
    				if($row['subscription_id'] == "7"){
    					$membership = "Operator Subscription";
    				}
    			}
    			        
    			echo '[vc_row_inner][vc_column_inner width="1/3"][image_with_animation image_url="1533" alignment="center" animation="Fade In" img_link_target="_self"][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<span style="color: #767676;"><strong> Membership Type :</strong>'.$membership.'</span>

<span style="color: #767676;"><strong> Number of taxi operates :</strong>'.$row['number_of_taxi_operates'].'</span>

<span style="color: #767676;"><strong> Available network :</strong> TCS,RSL</span>[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]<span style="color: #767676;"><strong> Bussiness Name :</strong>'.$row['abn_number'].'</span>

<span style="color: #767676;"><strong> Contact name :</strong>'.$row['contact_name'].'</span>

<span style="color: #767676;"><strong> Contact numbers :</strong>'.$numbers.'</span>

<span style="color: #767676;"><strong> Address :</strong>'.$address.'</span>[/vc_column_text][/vc_column_inner][/vc_row_inner][divider line_type="Full Width Line"][/vc_column][/vc_row]';
            }
    	}
	$conn->close();
?>