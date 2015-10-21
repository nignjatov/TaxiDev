<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class GeneralAdsCPLS_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/GeneralAdsCPLSEntity");
    }

        private function getUserID($adsID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_general_ads_cpls');
        $this->db->where('ID', $adsID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $user_id = $result->user_id;
        }

        $query->free_result();

        return $user_id;
    }

    public function getAllDriverAds($userID){
        $this->db->select('*');
        $this->db->from('wp_general_ads_cpls');
        $this->db->where('user_id', $userID);

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allDriverAds = array();
        $count = 0;
        foreach ($result AS $driverAdsInfo) {
            $allDriverAds[$count++] = $driverAdsInfo;
        }

        return parent::returnData($allDriverAds);
    }

    public function getLocationBasedDriverAds($location){
        $sql = sprintf("SELECT * FROM wp_general_ads_cpls WHERE user_id IN (SELECT user_id FROM wp_operators WHERE state LIKE '%s' OR state LIKE '%%s%' OR street_name LIKE '%%s%')", $location, $location);
        $this->db->query($sql);
        return parent::returnData($this->db->get()->result());
    }

    public function getAdsDetail($adsID){
        $this->db->select("*");
        $this->db->where("ID", $adsID);
        $this->db->from("wp_general_ads_cpls");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
        }
    }

    public function canAddMoreDriverAds($userID, $subscriptionID = 0) {
        if ($subscriptionID == 0) {
            return parent::returnData(false, ConstExceptionCode::UPDATE_SUBSCRIPTION_ERROR);
        } else {
            $this->db->select('*');
            $this->db->from('wp_general_ads_cpls');
            $this->db->where('user_id', $userID);
            $this->db->where('is_active', true, false);
            $totalTaxi = $this->db->count_all_results();
            $permittedAmount = $this->subscriptionEntity->getDriverAdsLimit($subscriptionID);
            if ($permittedAmount != -1 && $permittedAmount <= $totalTaxi){
                return parent::returnData(false, ConstExceptionCode::UPDATE_SUBSCRIPTION_ERROR);
            }
        }

        return parent::returnData(true, 0);
    }

    public function addAds($userID, $subscriptionID = 0) {
        $canAddMoreTaxi = 1;//$this->canAddMoreDriverAds($userID, $subscriptionID);
        if ($canAddMoreTaxi==1){//->error['code'] == 0) {
            $newAdsEntity = new GeneralAdsCPLSEntity;
            $newAdsEntity->user_id = $userID;

            $newAdsEntity->name = $this->input->post('name');
			$newAdsEntity->contact = $this->input->post('contact');
			$newAdsEntity->want_to = $this->input->post('want_to');
			$newAdsEntity->item = $this->input->post('item');
			$newAdsEntity->state = $this->input->post('state');
			$newAdsEntity->area = $this->input->post('area');
			$newAdsEntity->network = $this->input->post('network');
			$newAdsEntity->car = $this->input->post('car');
			$newAdsEntity->model = $this->input->post('model');
            $newAdsEntity->comment = $this->input->post('comment');
            $newAdsEntity->postal_code= $this->input->post('postal_code');
			$newAdsEntity->add_type = 4;
            
			if ($this->db->insert('wp_general_ads_cpls', $newAdsEntity)) {
                return parent::returnData($this->db->insert_id());
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }
    }

    public function updateAds($userID, $adsID) {
        if ($userID == $this->getUserID($adsID)) {
            $newAdsEntity = new GeneralAdsCPLSEntity;

            $newAdsEntity->user_id = $userID;

            $newAdsEntity->name = "ss";//$this->input->post('name');
			$newAdsEntity->contact = "ss";//$this->input->post('contact');
			$newAdsEntity->looking_for = "ss";//$this->input->post('lookingFor');
			$newAdsEntity->type = "ss";//$this->input->post('type');
			$newAdsEntity->state = "ss";//$this->input->post('state');
			$newAdsEntity->area = "ss";//$this->input->post('area');
			$newAdsEntity->network = "ss";//$this->input->post('network');
			$newAdsEntity->shift = "ss";//$this->input->post('shift');
			$newAdsEntity->days = "ss";//$this->input->post('days');
			$newAdsEntity->vehicles = "ss";//$this->input->post('vehicles');
            $newAdsEntity->comment = "ss";//$this->input->post('comment');

//        echo $this->db->last_query().'<br>;

            $this->db->where("ID", $adsID, false);
            $this->db->where("user_id", $userID, false);
            if ($this->db->update('wp_general_ads_cpls', $newAdsEntity)) {
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
            if ($this->db->delete('wp_general_ads_cpls')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
}