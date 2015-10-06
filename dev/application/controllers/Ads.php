<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class Ads extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Ads_model');
    }

    public function canAddMoreTaxiAds() {
        $returnData = $this->Ads_model->canAddMoreTaxiAds($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function addTaxiAds() {
        $returnData = $this->Ads_model->addAds($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function updateTaxiAds() {
        $ads_id = $this->input->get('taxiads_id');
        parent::returnData($this->Ads_model->updateAds($this->userID, $ads_id));
    }

    public function removeTaxiAds() {
        $ads_id = $this->input->get('taxiads_id');
        parent::returnData($this->Ads_model->updateAds($this->userID, $ads_id));
    }

    public function getAllAdsDetail() {
        parent::returnData($this->Ads_model->getAllAds($this->userID));
    }

    public function getTaxiAdsDetail($operatorID, $taxiID) {

    }
}