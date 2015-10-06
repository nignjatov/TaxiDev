<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Taxi_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/TaxiEntity");
    }

    private function getUserID($taxiID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_taxi_details');
        $this->db->where('ID', $taxiID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $user_id = $result->user_id;
        }

        $query->free_result();

        return $user_id;
    }

    public function getTaxiDetail($taxiID){
        $this->db->select("*");
        $this->db->where("ID", $taxiID);
        $this->db->from("wp_taxi_details");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
        }
    }

    public function getTaxiDetailFromLicensePlateNo($taxiID){
        $this->db->select("*");
        $this->db->where("license_plate_no", $taxiID);
        $this->db->from("wp_taxi_details");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
        }
    }

    public function getAllTaxi($userID){
        $this->db->select('*');
        $this->db->from('wp_taxi_details');
        $this->db->where('user_id', $userID);
        $this->db->order_by('license_plate_no');
        $result = $this->db->get()->result();
        $allTaxi = array();
        $count = 0;
        foreach ($result AS $taxiInfo) {
            $taxiInfo->registration_due_date = $taxiInfo->registration_due_date > 0 ? $this->timezone->convertMKTimeToDate($taxiInfo->registration_due_date) : '';
            $taxiInfo->insurance_due_date = $taxiInfo->insurance_due_date > 0 ? $this->timezone->convertMKTimeToDate($taxiInfo->insurance_due_date) : '';
            $allTaxi[$count++] = $taxiInfo;
        }

        return parent::returnData($allTaxi);
    }

    public function canAddMoreTaxi($userID, $subscriptionID = 0) {
        if ($subscriptionID == 0) {
            return parent::returnData(false, ConstExceptionCode::UPDATE_SUBSCRIPTION_ERROR);
        } else {
            $this->db->select('*');
            $this->db->from('wp_taxi_details');
            $this->db->where('user_id', $userID);
            $this->db->where('is_active', true, false);
            $totalTaxi = $this->db->count_all_results();
            $permittedAmount = $this->subscriptionEntity->getTaxiLimit($subscriptionID);
//            $this->util->echoObject($permittedAmount);
            if ($permittedAmount != -1 && $permittedAmount <= $totalTaxi){
                return parent::returnData(false, ConstExceptionCode::UPDATE_SUBSCRIPTION_ERROR);
            }
        }

        return parent::returnData(true, 0);
    }

    public function addTaxi($userID, $subscriptionID = 0) {
        $canAddMoreTaxi = $this->canAddMoreTaxi($userID, $subscriptionID);

        if ($canAddMoreTaxi->error['code'] == 0) {
            $newTaxiEntity = new TaxiEntity;
            $newTaxiEntity->user_id = $userID;
            $newTaxiEntity->car_finance_fee = $this->input->post('car_finance_fee');
            $newTaxiEntity->car_style = $this->input->post('car_style');
            $newTaxiEntity->car_type = $this->input->post('car_type');
            $newTaxiEntity->taxi_network = $this->input->post('taxi_network');
            $newTaxiEntity->license_plate_no = $this->input->post('license_plate_no');
            $newTaxiEntity->car_manufacturer = $this->input->post('car_manufacturer');
            $newTaxiEntity->year_manufactured = $this->input->post('year_manufactured');
            $newTaxiEntity->fuel_type = $this->input->post('fuel_type');
            $newTaxiEntity->kilometres = $this->input->post('kilometres');
            $newTaxiEntity->plate_fee = $this->input->post('plate_fee');
            $newTaxiEntity->network_fee = $this->input->post('network_fee');
            $newTaxiEntity->insurance_fee = $this->input->post('insurance_fee');
            $newTaxiEntity->registration_fee = $this->input->post('registration_fee');

            $registration_due_date = $this->input->post('registration_due_date');
            if (!empty($registration_due_date)) {
                $newTaxiEntity->registration_due_date = $this->timezone->convertDateToMKTime($registration_due_date);
            }

            $insurance_due_date = $this->input->post('insurance_due_date');
            if (!empty($insurance_due_date)) {
                $newTaxiEntity->insurance_due_date = $this->timezone->convertDateToMKTime($insurance_due_date);
            }

            $newTaxiEntity->comment = $this->input->post('comment');

            if ($this->db->insert('wp_taxi_details', $newTaxiEntity)) {
                return parent::returnData($this->db->insert_id());
            }

            return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
        }

        return $canAddMoreTaxi;
    }

    public function updateTaxi($userID, $taxiID) {
        if ($userID == $this->getUserID($taxiID)) {
            $newTaxiEntity = new TaxiEntity;
            $newTaxiEntity->user_id = $userID;
            $newTaxiEntity->car_finance_fee = $this->input->post('car_finance_fee');
            $newTaxiEntity->car_style = $this->input->post('car_style');
            $newTaxiEntity->car_type = $this->input->post('car_type');
            $newTaxiEntity->taxi_network = $this->input->post('taxi_network');
            $newTaxiEntity->license_plate_no = $this->input->post('license_plate_no');
            $newTaxiEntity->car_manufacturer = $this->input->post('car_manufacturer');
            $newTaxiEntity->year_manufactured = $this->input->post('year_manufactured');
            $newTaxiEntity->fuel_type = $this->input->post('fuel_type');
            $newTaxiEntity->kilometres = $this->input->post('kilometres');
            $newTaxiEntity->plate_fee = $this->input->post('plate_fee');
            $newTaxiEntity->network_fee = $this->input->post('network_fee');
            $newTaxiEntity->insurance_fee = $this->input->post('insurance_fee');
            $newTaxiEntity->registration_fee = $this->input->post('registration_fee');

            $registration_due_date = $this->input->post('registration_due_date');
            if (!empty($registration_due_date)) {
                $newTaxiEntity->registration_due_date = $this->timezone->convertDateToMKTime($registration_due_date);
            }

            $insurance_due_date = $this->input->post('insurance_due_date');
            if (!empty($insurance_due_date)) {
                $newTaxiEntity->insurance_due_date = $this->timezone->convertDateToMKTime($insurance_due_date);
            }

            $newTaxiEntity->comment = $this->input->post('comment');
            $newTaxiEntity->is_active = $this->input->post('is_active');

//        echo $this->db->last_query().'<br>;

            $this->db->where("ID", $taxiID, false);
            $this->db->where("user_id", $userID, false);

            if ($this->db->update('wp_taxi_details', $newTaxiEntity)) {
                return parent::returnData($taxiID);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }

    public function removeTaxi($userID, $taxiID) {
        if ($userID == $this->getUserID($taxiID)) {
            $this->db->where("ID", $taxiID, false);
            if ($this->db->delete('wp_taxi_details')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
}