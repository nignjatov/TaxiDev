<?php
        $filter = "";
        if (isset($_GET["filter"])) {
            if($filter == "")
                $filter = $filter." WHERE state like '%".$_GET["filter"]."%' or area like '%".$_GET["filter"]."%' or network like '%".$_GET["filter"]."%'";
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
	$sql = "SELECT * FROM wp_general_ads_driver_wanted ".$filter;
    	$result = $conn->query($sql);

        $ret = "[";
        $cnt = 0;
    	if ($result->num_rows > 0) {
    	        while($row = $result->fetch_assoc()) {
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
