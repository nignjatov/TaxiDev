<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class Driverads extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Driverads_model');
        $this->load->model('User_model');
    }

    public function canAddMoreDriverAds() {
        $returnData = $this->Driverads_model->canAddMoreDriverAds($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function addDriverAds() {
        $returnData = $this->Driverads_model->addAds($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function updateDriverAds() {
        $ads_id = $this->input->get('driverads_id');
        parent::returnData($this->Driverads_model->updateAds($this->userID, $ads_id));
    }

    public function removeDriverAds() {
        $ads_id = $this->input->get('driverads_id');
        parent::returnData($this->Driverads_model->removeAds($this->userID, $ads_id));
    }

    public function getAllDriverAdsDetail() {
        $userInfo = $this->User_model->getUserDetail($this->userID);
        parent::returnData($this->Driverads_model->getAllDriverAds($this->userID,$userInfo->result->user_type));
    }
}