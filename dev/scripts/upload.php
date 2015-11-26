<?php

$data = $_POST['data'];
$data = explode(",", $data);
$data[1] = str_replace(' ', '+', $data[1]);
  
$fileName = $_POST['name'];
$serverFile = time().$fileName;
$fp = fopen('../uploads/'.$serverFile,'w'); //Prepends timestamp to prevent overwriting
fwrite($fp, base64_decode($data[1]));
fclose($fp);
$returnData = array( "serverFile" => $serverFile );
echo json_encode($returnData);

?>