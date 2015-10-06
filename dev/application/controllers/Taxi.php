<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class Taxi extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Taxi_model');
    }

    public function getAllTaxiDetail(){
        parent::returnData($this->Taxi_model->getAllTaxi($this->userID));
    }

    public function getTaxiDetailFromLicensePlateNo(){
        $license_plate_no = $this->input->get('license_plate_no');
        parent::returnData($this->Taxi_model->getTaxiDetailFromLicensePlateNo($license_plate_no));
    }

    public function canAddMoreTaxi() {
        $returnData = $this->Taxi_model->canAddMoreTaxi($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function addTaxi() {
        $returnData = $this->Taxi_model->addTaxi($this->userID, $this->subscriptionID);
        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function updateTaxi() {
        $taxi_id = $this->input->get('taxi_id');
        parent::returnData($this->Taxi_model->updateTaxi($this->userID, $taxi_id));
    }

    public function removeTaxi() {
        $taxi_id = $this->input->get('taxi_id');
        parent::returnData($this->Taxi_model->removeTaxi($this->userID, $taxi_id));
    }

    public function getTaxiDetail($operatorID, $taxiID) {

    }


}