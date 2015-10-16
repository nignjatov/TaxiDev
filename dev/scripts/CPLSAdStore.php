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
		
		

        $result = $conn->query("INSERT INTO wp_general_ads_cpls(user_id,name,contact,want_to,item,state,area,network,car,model,comment,postal_code)".
								  " VALUES(0,'".$_REQUEST['name']."', '".$_REQUEST['contact']."', '".$_REQUEST['want_to']."', '".$_REQUEST['item'].
								  "', '".$_REQUEST['state']."','".$_REQUEST['area']."', '".$_REQUEST['network']."', '".$_REQUEST['car']."', '".$_REQUEST['model'].
								  "', '".$_REQUEST['comment']."', '".$_REQUEST['postal_code']."');");

        $conn->close();
		?>