<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class GeneralAdsTaxiAds extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('generaladstaxiads_model');
    }

    public function canAddMoreDriverAds() {
        $returnData = $this->generaladstaxiads_model->canAddMoreDriverAds($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function addDriverAds() {
        $returnData = $this->generaladstaxiads_model->addAds($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function updateDriverAds() {
        $ads_id = $this->input->get('driverads_id');
        parent::returnData($this->generaladstaxiads_model->updateAds($this->userID, $ads_id));
    }

    public function removeDriverAds() {
        $ads_id = $this->input->get('driverads_id');
        parent::returnData($this->generaladstaxiads_model->removeAds($this->userID, $ads_id));
    }

    public function getAllDriverAdsDetail() {
        parent::returnData($this->generaladstaxiads_model->getAllDriverAds($this->userID));
    }
	
	public function uploadFile() {
        $data = $_POST['data'];
        $data = explode(",", $data);
        $data[1] = str_replace(' ', '+', $data[1]);
  
		$allowedImageTypes = array( "image/pjpeg","image/jpeg","image/jpg","image/png","image/x-png","image/gif");
		$fileType = str_replace('data:', '', $data[0]);
		$fileType = substr($fileType, 0, strpos($fileType, ";"));
		if (in_array($fileType, $allowedImageTypes)) { 
			$serverFile = $_POST['name'];
			$fp = fopen($_SERVER['DOCUMENT_ROOT'].'dev/uploads/'.$serverFile,'w'); //Prepends timestamp to prevent overwriting
			fwrite($fp, base64_decode($data[1]));
			fclose($fp);
			$returnData = array( "serverFile" => $serverFile );
			echo true;
		} else {
			echo "Invalid file type";
		}	
    }
}