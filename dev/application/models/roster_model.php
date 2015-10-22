<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Roster_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/RosterPayingEntity");
    }

    private function getUserID($rosterID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_roster_paying');
        $this->db->where('ID', $rosterID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $user_id = $result->user_id;
        }

        $query->free_result();

        return $user_id;
    }

    public function getRosterDetail($rosterID){
        $this->db->select("*");
        $this->db->where("ID", $rosterID);
        $this->db->from("wp_roster_paying");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
            return $this->returnData;
        }
    }

    public function getAllRoster($userID){
        $this->db->select('r.*, t.license_plate_no');
        $this->db->from('wp_roster_paying AS r');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('r.user_id', $userID);
        $this->db->where('r.taxi_id', 't.ID', false);
        $this->db->order_by('paying_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allRoster = array();
        $count = 0;
        foreach ($result AS $rosterInfo) {
            $rosterInfo->paying_date = $rosterInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($rosterInfo->paying_date) : '';
            $allRoster[$count++] = $rosterInfo;
        }

        return parent::returnData($allRoster);
    }

    public function getAllRosterWithDateRange($userID, $allTaxi, $start_date, $end_date){
        $dates = $this->timezone->getInBetweenDates($start_date, $end_date);
//        $this->util->echoObject($dates);
//        $this->util->echoObject($allTaxi);
        $this->db->select('r.*, t.license_plate_no');
        $this->db->from('wp_roster_paying AS r');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('r.user_id', $userID);
        $this->db->where('r.taxi_id', 't.ID', false);
        if (strcmp($start_date, '') != 0) {
            $this->db->where('r.paying_date >=', $start_date);
        }

        if (strcmp($end_date, '') != 0) {
            $this->db->where('r.paying_date <=', $end_date + (24 * 3600) - 1);
        }

        $this->db->order_by('license_plate_no', 'ASC');
        $this->db->order_by('paying_date', 'ASC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allRoster = array();
        $count = 0;
        foreach ($result AS $rosterInfo) {
            $rosterInfo->paying_date = $rosterInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($rosterInfo->paying_date) : '';
            $allRoster[$count++] = $rosterInfo;
        }

//        $this->util->echoObject($allRoster);

        if(empty($allRoster)) {
            $fields = $this->db->list_fields('wp_roster_paying');
//            $this->util->echoObject($fields);

            $allRoster[0] = new stdClass();
            foreach ($fields AS $key) {
                $allRoster[0]->$key = '';
            }

            $allRoster[0]->license_plate_no = '';
        }

        $roster_info = array();
        $count = 0;
        $shifts = array('Morning', 'Evening');

        foreach($allTaxi AS $taxi) {
            foreach($dates AS $date) {
                foreach($shifts AS $shift) {
                    foreach($allRoster AS $roster) {
                        if (strcmp($taxi->ID, $roster->taxi_id) == 0 && strcmp($date, $roster->paying_date) == 0 && strcmp($shift, $roster->shift) == 0) {
                            $roster_info[$count++] = $roster;
                        } else {
                            foreach($roster AS $key => $value) {
                                switch($key) {
                                    case 'taxi_id':
                                        $roster_info[$count]->taxi_id = $taxi->ID;
                                        break;
                                    case 'user_id':
                                        $roster_info[$count]->user_id = $taxi->user_id;
                                        break;
                                    case 'license_plate_no':
                                        $roster_info[$count]->license_plate_no = $taxi->license_plate_no;
                                        break;
                                    case 'paying_date':
                                        $roster_info[$count]->paying_date = $date;
                                        break;
                                    case 'shift':
                                        $roster_info[$count]->shift = $shift;
                                        break;
                                    default:
                                        $roster_info[$count]->$key = '';
                                        break;
                                }
                            }
                            $count++;
                        }
                    }
                }
            }
        }

//        $this->util->echoObject($roster_info);

        return parent::returnData($roster_info);
    }

    public function getAllTaxiRoster($userID, $taxiID){
        $this->db->select('r.*, t.license_plate_no');
        $this->db->from('wp_roster_paying AS r');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('r.user_id', $userID);
        $this->db->where('r.taxi_id', 't.ID', false);
        $this->db->where('r.taxi_id', $taxiID);
        $this->db->order_by('paying_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allRoster = array();
        $count = 0;
        foreach ($result AS $rosterInfo) {
            $rosterInfo->paying_date = $rosterInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($rosterInfo->paying_date) : '';
            $allRoster[$count++] = $rosterInfo;
        }

        return parent::returnData($allRoster);
    }

    public function addRoster($userID) {
        $newRosterEntity = new RosterPayingEntity();
        $newRosterEntity->user_id = $userID;
        $newRosterEntity->taxi_id = $this->input->post('taxi_id');
        $newRosterEntity->shift = $this->input->post('shift');
        $newRosterEntity->is_leased = $this->input->post('is_leased');
        $newRosterEntity->driver_name = $this->input->post('driver_name');
        $newRosterEntity->is_paid = $this->input->post('is_paid');
        $newRosterEntity->amount_paid = $this->input->post('amount_paid');
        $newRosterEntity->mf_amount = $this->input->post('mf_amount');
        $newRosterEntity->m7_amount = $this->input->post('m7_amount');
        $newRosterEntity->cash_amount = $this->input->post('cash_amount');
        $newRosterEntity->fine_toll_amount = $this->input->post('fine_toll_amount');
        $newRosterEntity->expenses = $this->input->post('expenses');

        $paying_date = $this->input->post('paying_date');
        if (!empty($paying_date)) {
            $newRosterEntity->paying_date = $this->timezone->convertDateToMKTime($paying_date);
        }

		/* Ensure that taxi can be rented only once specific shift in a day */
		$this->db->select('*');
        $this->db->from('wp_roster_paying');
        $this->db->where('paying_date', $newRosterEntity->paying_date);
		$this->db->where('shift', $newRosterEntity->shift);
		$this->db->where('taxi_id', $newRosterEntity->taxi_id);
		$is_already_rented = $this->db->get()->result();
        if (!empty($is_already_rented)) {
            return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
        }

        $newRosterEntity->comment = $this->input->post('comment');

//        echo $this->db->last_query().'<br>;
        if ($this->db->insert('wp_roster_paying', $newRosterEntity)) {
            return parent::returnData($this->db->insert_id());
        }

        return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
    }

    public function updateRoster($userID, $rosterID) {
        if ($userID == $this->getUserID($rosterID)) {
            $newRosterEntity = new RosterPayingEntity();
            $newRosterEntity->user_id = $userID;
            $newRosterEntity->taxi_id = $this->input->post('taxi_id');
            $newRosterEntity->shift = $this->input->post('shift');
            $newRosterEntity->is_leased = $this->input->post('is_leased');
            $newRosterEntity->driver_name = $this->input->post('driver_name');
            $newRosterEntity->is_paid = $this->input->post('is_paid');
            $newRosterEntity->amount_paid = $this->input->post('amount_paid');
            $newRosterEntity->mf_amount = $this->input->post('mf_amount');
            $newRosterEntity->m7_amount = $this->input->post('m7_amount');
            $newRosterEntity->cash_amount = $this->input->post('cash_amount');
            $newRosterEntity->fine_toll_amount = $this->input->post('fine_toll_amount');
            $newRosterEntity->expenses = $this->input->post('expenses');

            $paying_date = $this->input->post('paying_date');
            if (!empty($paying_date)) {
                $newRosterEntity->paying_date = $this->timezone->convertDateToMKTime($paying_date);
            }

            $newRosterEntity->comment = $this->input->post('comment');

//        echo $this->db->last_query().'<br>;

            $this->db->where("ID", $rosterID, false);
            $this->db->where("user_id", $userID, false);

            if ($this->db->update('wp_roster_paying', $newRosterEntity)) {
                return parent::returnData($rosterID);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }

    public function removeRoster($userID, $rosterID) {
        if ($userID == $this->getUserID($rosterID)) {
            $this->db->where("ID", $rosterID, false);
            if ($this->db->delete('wp_roster_paying')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
}