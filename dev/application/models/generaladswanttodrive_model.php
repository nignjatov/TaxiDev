<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class GeneralAdsWantToDrive_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/GeneralAdsWantToDriveEntity");
    }

        private function getUserID($adsID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_general_ads_want_to_drive');
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
        $this->db->from('wp_general_ads_want_to_drive');
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
        $sql = sprintf("SELECT * FROM wp_general_ads_want_to_drive WHERE user_id IN (SELECT user_id FROM wp_operators WHERE state LIKE '%s' OR state LIKE '%%s%' OR street_name LIKE '%%s%')", $location, $location);
        $this->db->query($sql);
        return parent::returnData($this->db->get()->result());
    }

    public function getAdsDetail($adsID){
        $this->db->select("*");
        $this->db->where("ID", $adsID);
        $this->db->from("wp_general_ads_want_to_drive");

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
            $this->db->from('wp_general_ads_want_to_drive');
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
            $newAdsEntity = new GeneralAdsWantToDriveEntity;
            $newAdsEntity->user_id = $userID;

            $newAdsEntity->name = $this->input->post('name');
			$newAdsEntity->contact = $this->input->post('contact');
			$newAdsEntity->type = $this->input->post('type');
			$newAdsEntity->state = $this->input->post('state');
			$newAdsEntity->area = $this->input->post('area');
			
			$newAdsEntity->network = $this->input->post('network');
			if ($this->input->post('taxiOther') != "") 
				$newAdsEntity->network .= ",".$this->input->post('taxiOther');
			
			$newAdsEntity->shift = "";
			if ($this->input->post('shift_1') != "") 
				$newAdsEntity->shift .= $this->input->post('shift_1').",";

			if ($this->input->post('shift_2') != "") 
				$newAdsEntity->shift .= $this->input->post('shift_2').",";

			if ($this->input->post('shift_3') != "")
				$newAdsEntity->shift .= $this->input->post('shift_3');

			$newAdsEntity->shift = trim($newAdsEntity->shift, ",");
			
			$newAdsEntity->days = "";
			if ($this->input->post('days_1') != "")
				$newAdsEntity->days .= $this->input->post('days_1').",";

			if ($this->input->post('days_2') != "") 
				$newAdsEntity->days .= $this->input->post('days_2').",";

			if ($this->input->post('days_3') != "") 
				$newAdsEntity->days .= $this->input->post('days_3').",";

			if ($this->input->post('days_4') != "") 
				$newAdsEntity->days .= $this->input->post('days_4').",";

			if ($this->input->post('days_5') != "") 
				$newAdsEntity->days .= $this->input->post('days_5').",";

			if ($this->input->post('days_6') != "") 
				$newAdsEntity->days .= $this->input->post('days_6').",";

			if ($this->input->post('days_7') != "") 
				$newAdsEntity->days .= $this->input->post('days_7');
			

                        $newAdsEntity->days = trim($newAdsEntity->days, ",");
			
			$newAdsEntity->vehicles = "";
			if ($this->input->post('vehicles_1') != "")
				$newAdsEntity->vehicles .= $this->input->post('vehicles_1').",";

			if ($this->input->post('vehicles_2') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_2').",";

			if ($this->input->post('vehicles_3') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_3').",";

			if ($this->input->post('vehicles_4') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_4').",";

			if ($this->input->post('vehicles_5') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_5');
			
			if ($this->input->post('vehicles_6') != "")
				$newAdsEntity->vehicles .= $this->input->post('vehicles_6');
			
			if ($this->input->post('vehicles_7') != "")
				$newAdsEntity->vehicles .= $this->input->post('vehicles_7');
			
                        $newAdsEntity->vehicles = trim($newAdsEntity->vehicles, ",");
			
			$newAdsEntity->options = "";
			if ($this->input->post('option_1') != "") 
				$newAdsEntity->options .= $this->input->post('option_1').",";

			if ($this->input->post('option_2') != "")
				$newAdsEntity->options .= $this->input->post('option_2');

			$newAdsEntity->options = trim($newAdsEntity->options, ",");
			
            $newAdsEntity->comment = $this->input->post('comment');
            $newAdsEntity->postal_code= $this->input->post('postal_code');
			$newAdsEntity->add_type = 3;
			
            if ($this->db->insert('wp_general_ads_want_to_drive', $newAdsEntity)) {
                return parent::returnData($this->db->insert_id());
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }
    }

    public function updateAds($userID, $adsID) {
        if ($userID == $this->getUserID($adsID)) {
            $newAdsEntity = new GeneralAdsWantToDriveEntity;
            $newAdsEntity->user_id = $userID;

            $newAdsEntity->name = $this->input->post('name');
			$newAdsEntity->contact = $this->input->post('contact');
			$newAdsEntity->type = $this->input->post('type');
			$newAdsEntity->state = $this->input->post('state');
			$newAdsEntity->area = $this->input->post('area');
			
			$newAdsEntity->network = $this->input->post('network');
			if ($this->input->post('taxiOther') != "") 
				$newAdsEntity->network .= ",".$this->input->post('taxiOther');
			
			$newAdsEntity->shift = "";
			if ($this->input->post('shift_1') != "") 
				$newAdsEntity->shift .= $this->input->post('shift_1').",";

			if ($this->input->post('shift_2') != "") 
				$newAdsEntity->shift .= $this->input->post('shift_2').",";

			if ($this->input->post('shift_3') != "")
				$newAdsEntity->shift .= $this->input->post('shift_3');

			$newAdsEntity->shift = trim($newAdsEntity->shift, ",");
			
			$newAdsEntity->days = "";
			if ($this->input->post('days_1') != "")
				$newAdsEntity->days .= $this->input->post('days_1').",";

			if ($this->input->post('days_2') != "") 
				$newAdsEntity->days .= $this->input->post('days_2').",";

			if ($this->input->post('days_3') != "") 
				$newAdsEntity->days .= $this->input->post('days_3').",";

			if ($this->input->post('days_4') != "") 
				$newAdsEntity->days .= $this->input->post('days_4').",";

			if ($this->input->post('days_5') != "") 
				$newAdsEntity->days .= $this->input->post('days_5').",";

			if ($this->input->post('days_6') != "") 
				$newAdsEntity->days .= $this->input->post('days_6').",";

			if ($this->input->post('days_7') != "") 
				$newAdsEntity->days .= $this->input->post('days_7');
			

                        $newAdsEntity->days = trim($newAdsEntity->days, ",");
			
			$newAdsEntity->vehicles = "";
			if ($this->input->post('vehicles_1') != "")
				$newAdsEntity->vehicles .= $this->input->post('vehicles_1').",";

			if ($this->input->post('vehicles_2') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_2').",";

			if ($this->input->post('vehicles_3') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_3').",";

			if ($this->input->post('vehicles_4') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_4').",";

			if ($this->input->post('vehicles_5') != "") 
				$newAdsEntity->vehicles .= $this->input->post('vehicles_5');
			
			if ($this->input->post('vehicles_6') != "")
				$newAdsEntity->vehicles .= $this->input->post('vehicles_6');
			
			if ($this->input->post('vehicles_7') != "")
				$newAdsEntity->vehicles .= $this->input->post('vehicles_7');
			
                        $newAdsEntity->vehicles = trim($newAdsEntity->vehicles, ",");
			
			$newAdsEntity->options = "";
			if ($this->input->post('option_1') != "") 
				$newAdsEntity->options .= $this->input->post('option_1').",";

			if ($this->input->post('option_2') != "")
				$newAdsEntity->options .= $this->input->post('option_2');

			$newAdsEntity->options = trim($newAdsEntity->options, ",");
			
            $newAdsEntity->comment = $this->input->post('comment');
            $newAdsEntity->postal_code= $this->input->post('postal_code');
			$newAdsEntity->add_type = 3;

            $this->db->where("ID", $adsID, false);
            $this->db->where("user_id", $userID, false);
            if ($this->db->update('wp_general_ads_want_to_drive', $newAdsEntity)) {
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
            if ($this->db->delete('wp_general_ads_want_to_drive')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
}