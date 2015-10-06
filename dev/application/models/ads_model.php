<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Ads_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/TaxiAdsEntity");
    }

    private function getUserID($adsID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_taxi_ads');
        $this->db->where('ID', $adsID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $user_id = $result->user_id;
        }

        $query->free_result();

        return $user_id;
    }

    public function getAllAds($userID){
        $this->db->select('t.license_plate_no, ta.days, ta.shift_start, ta.shift_end, ta.lease_rate, ta.comment, ta.is_active');
        $this->db->from('wp_taxi_ads AS ta');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('ta.user_id', $userID);
        $this->db->where('ta.taxi_id', 't.ID', false);
        $this->db->order_by('shift_end', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allTaxiAds = array();
        $count = 0;
        foreach ($result AS $taxiAdsInfo) {
            $taxiAdsInfo->shift_end = $taxiAdsInfo->shift_end > 0 ? $this->timezone->convertMKTimeToDate($taxiAdsInfo->shift_end) : '';
            $taxiAdsInfo->shift_start = $taxiAdsInfo->shift_start > 0 ? $this->timezone->convertMKTimeToDate($taxiAdsInfo->shift_start) : '';
            $allTaxiAds[$count++] = $taxiAdsInfo;
        }

        return parent::returnData($allTaxiAds);
    }

    public function getAllTaxiAds($userID, $taxiID){
        $this->db->select('ta.*, t.license_plate_no');
        $this->db->from('wp_taxi_ads AS ta');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('ta.user_id', $userID);
        $this->db->where('ta.taxi_id', $taxiID);
        $this->db->where('ta.taxi_id', 't.ID', false);
        $this->db->order_by('shift_end', 'DESC');

        $result = $this->db->get()->result();
        $allTaxiAds = array();
        $count = 0;
        foreach ($result AS $taxiAdsInfo) {
            $taxiAdsInfo->shift_end = $taxiAdsInfo->shift_end > 0 ? $this->timezone->convertMKTimeToDate($taxiAdsInfo->shift_end) : '';
            $taxiAdsInfo->shift_start = $taxiAdsInfo->shift_start > 0 ? $this->timezone->convertMKTimeToDate($taxiAdsInfo->shift_start) : '';
            $allTaxiAds[$count++] = $taxiAdsInfo;
        }

        return parent::returnData($allTaxiAds);
    }

    public function getLocationBasedTaxiAds($location){
        $sql = sprintf("SELECT * FROM wp_taxi_ads WHERE user_id IN (SELECT user_id FROM wp_operators WHERE state LIKE '%s' OR state LIKE '%%s%' OR street_name LIKE '%%s%')", $location, $location);
        $this->db->query($sql);
        return parent::returnData($this->db->get()->result());
    }

    public function getAdsDetail($adsID){
        $this->db->select("*");
        $this->db->where("ID", $adsID);
        $this->db->from("wp_taxi_ads");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
        }
    }

    public function canAddMoreTaxiAds($userID, $subscriptionID = 0) {
        if ($subscriptionID == 0) {
            return parent::returnData(false, ConstExceptionCode::UPDATE_SUBSCRIPTION_ERROR);
        } else {
            $this->db->select('*');
            $this->db->from('wp_taxi_ads');
            $this->db->where('user_id', $userID);
            $this->db->where('is_active', true, false);
            $totalTaxi = $this->db->count_all_results();
            $permittedAmount = $this->subscriptionEntity->getAdsLimit($subscriptionID);
            if ($permittedAmount != -1 && $permittedAmount <= $totalTaxi){
                return parent::returnData(false, ConstExceptionCode::UPDATE_SUBSCRIPTION_ERROR);
            }
        }

        return parent::returnData(true, 0);
    }

    public function addAds($userID, $subscriptionID = 0) {
        $canAddMoreTaxi = $this->canAddMoreTaxiAds($userID, $subscriptionID);
        if ($canAddMoreTaxi->error['code'] == 0) {
            $newAdsEntity = new TaxiAdsEntity;
            $newAdsEntity->user_id = $userID;
            $newAdsEntity->taxi_id = $this->input->post('taxi_id');
            $newAdsEntity->days = $this->input->post('days');

            $shift_end = $this->input->post('shift_end');
            if (!empty($shift_end)) {
                $newAdsEntity->shift_end = $this->timezone->convertDateToMKTime($shift_end);
            }

            $shift_start = $this->input->post('shift_start');
            if (!empty($shift_start)) {
                $newAdsEntity->shift_start = $this->timezone->convertDateToMKTime($shift_start);
            }

            $newAdsEntity->lease_rate = $this->input->post('lease_rate');
            $newAdsEntity->comment = $this->input->post('comment');

//        echo $this->db->last_query().'<br>;
            if ($this->db->insert('wp_taxi_ads', $newAdsEntity)) {
                return parent::returnData($this->db->insert_id());
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }
    }

    public function updateAds($userID, $adsID) {
        if ($userID == $this->getUserID($adsID)) {
            $newAdsEntity = new TaxiAdsEntity;
            $newAdsEntity->user_id = $userID;
            $newAdsEntity->taxi_id = $this->input->post('taxi_id');
            $newAdsEntity->days = $this->input->post('days');

            $shift_end = $this->input->post('shift_end');
            if (!empty($shift_end)) {
                $newAdsEntity->shift_end = $this->timezone->convertDateToMKTime($shift_end);
            }

            $shift_start = $this->input->post('shift_start');
            if (!empty($shift_start)) {
                $newAdsEntity->shift_start = $this->timezone->convertDateToMKTime($shift_start);
            }

            $newAdsEntity->lease_rate = $this->input->post('lease_rate');
            $newAdsEntity->comment = $this->input->post('comment');

//        echo $this->db->last_query().'<br>;

            $this->db->where("ID", $adsID, false);
            $this->db->where("user_id", $userID, false);
            if ($this->db->update('wp_taxi_ads', $newAdsEntity)) {
                return parent::returnData($adsID);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }

    public function removeAds($userID, $adsID) {
        if ($userID == $this->getUserID($adsID)) {
            $this->db->where("ID", $adsID, false);
            if ($this->db->delete('wp_taxi_ads')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
}