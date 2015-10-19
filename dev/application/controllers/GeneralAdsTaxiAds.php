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
}