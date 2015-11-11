<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Journal_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/JournalEntity");
    }

    private function getUserID($journalID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_driver_journal');
        $this->db->where('ID', $journalID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $user_id = $result->user_id;
        }

        $query->free_result();

        return $user_id;
    }

    public function getJournalDetail($journalID){
        $this->db->select("*");
        $this->db->where("ID", $journalID);
        $this->db->from("wp_driver_journal");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
            return $this->returnData;
        }
    }

    public function getAllJournal($userID){
        $this->db->select('*');
        $this->db->from('wp_driver_journal');
        $this->db->where('user_id', $userID);
        $this->db->order_by('paying_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allJournal = array();
        $count = 0;
        foreach ($result AS $journalInfo) {
            $journalInfo->paying_date = $journalInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($journalInfo->paying_date) : '';
            $allJournal[$count++] = $journalInfo;
        }

        return parent::returnData($allJournal);
    }

    public function getAllJournalWithDateRange($userID){
        $start_date = $this->input->get('journalStart');
        $start_date = !empty($start_date) ? $this->timezone->convertDateToMKTime($start_date) : '';
        $end_date = $this->input->get('journalEnd');
        $end_date = !empty($end_date) ? $this->timezone->convertDateToMKTime($end_date) : '';

        $this->db->select('*');
        $this->db->from('wp_driver_journal');
        $this->db->where('user_id', $userID);
        if (strcmp($start_date, '') != 0) {
            $this->db->where('m.paying_date >=', $start_date);
        }

        if (strcmp($end_date, '') != 0) {
            $this->db->where('m.paying_date <=', $end_date + (24 * 3600) - 1);
        }
        $this->db->order_by('paying_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allJournal = array();
        $count = 0;
        foreach ($result AS $journalInfo) {
            $journalInfo->paying_date = $journalInfo->paying_date > 0 ? $this->timezone->convertMKTimeToDate($journalInfo->paying_date) : '';
            $allJournal[$count++] = $journalInfo;
        }

        return parent::returnData($allJournal);
    }

    public function addJournal($userID) {
        $newJournalEntity = new JournalEntity;
        $newJournalEntity->user_id = $userID;
        $newJournalEntity->license_plate_no = $this->input->post('license_plate_no');//taxi number
        $newJournalEntity->shift = $this->input->post('journal_shift');
        $newJournalEntity->shift_rate = $this->input->post('shift_rate');//shift rate
        $newJournalEntity->fuel_cost = $this->input->post('fuel_cost');//fuel cost
        $newJournalEntity->other_cost = $this->input->post('other_cost');//other cost
        $newJournalEntity->cash_payment = $this->input->post('cash_payment');//total cash
        $newJournalEntity->eftpos_shift_total = $this->input->post('eftpos_shift_total');//total eftpos
        $newJournalEntity->docket = $this->input->post('docket');//docket

        $paying_date = $this->input->post('paying_date');//date

        //operator name
        $newJournalEntity->operator_name = $this->input->post('operator_name');//operator
        //paid
        $newJournalEntity->paid = $this->input->post('journal_paid');//paid
        if (!empty($paying_date)) {
            $newJournalEntity->paying_date = $this->timezone->convertDateToMKTime($paying_date);
        }

        $newJournalEntity->comment = $this->input->post('comment');//comment

//        echo $this->db->last_query().'<br>;
        if ($this->db->insert('wp_driver_journal', $newJournalEntity)) {
//            echo $this->db->last_query();
            return parent::returnData($this->db->insert_id());
        } else {
//            echo $this->db->last_query();
            return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
        }
    }

    public function updateJournal($userID, $journalID) {
        if ($userID == $this->getUserID($journalID)) {
            $newJournalEntity = new JournalEntity;
            $newJournalEntity->user_id = $userID;
            $newJournalEntity->license_plate_no = $this->input->post('license_plate_no');
            $newJournalEntity->shift = $this->input->post('journal_shift');
            $newJournalEntity->shift_rate = $this->input->post('shift_rate');
            $newJournalEntity->fuel_cost = $this->input->post('fuel_cost');
            $newJournalEntity->other_cost = $this->input->post('other_cost');
            $newJournalEntity->cash_payment = $this->input->post('cash_payment');
            $newJournalEntity->eftpos_shift_total = $this->input->post('eftpos_shift_total');
            $newJournalEntity->docket = $this->input->post('docket');

            $paying_date = $this->input->post('paying_date');
            if (!empty($paying_date)) {
                $newJournalEntity->paying_date = $this->timezone->convertDateToMKTime($paying_date);
            }

            $newJournalEntity->operator_name = $this->input->post('operator_name');//operator
            $newJournalEntity->paid = $this->input->post('journal_paid');//paid
            $newJournalEntity->comment = $this->input->post('comment');

            $this->db->where("ID", $journalID, false);
            $this->db->where("user_id", $userID, false);

            if ($this->db->update('wp_driver_journal', $newJournalEntity)) {
//                echo $this->db->last_query().'<br>';
                return parent::returnData($journalID);
            } else {
//                echo $this->db->last_query().'<br>';
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }

    public function removeJournal($userID, $journalID) {
        if ($userID == $this->getUserID($journalID)) {
            $this->db->where("ID", $journalID, false);
            if ($this->db->delete('wp_driver_journal')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
}