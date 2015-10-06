<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class Roster extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Roster_model');
        $this->load->model('Taxi_model');
    }

    public function getAllRoster() {
        $userInfo = $this->User_model->getUserDetail($this->userID);
        $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();
        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        $this->load->view('header_with_side_menu', $user_name);
        $this->load->view('taxi/roster', array());
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-script-roster');
        $this->load->view('footer_with_side_menu');
    }

    public function addRoster() {
        parent::returnData($this->Roster_model->addRoster($this->userID));
    }

    public function updateRoster() {
        $roster_id = $this->input->get('roster_id');
        parent::returnData($this->Roster_model->updateRoster($this->userID, $roster_id));
    }

    public function removeRoster() {
        $roster_id = $this->input->get('roster_id');
        parent::returnData($this->Roster_model->updateRoster($this->userID, $roster_id));
    }

    public function getAllRosterDetail() {
        $allTaxi = $this->Taxi_model->getAllTaxi($this->userID);
        $start_date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));// - 200 * 86400;
        $end_date = mktime(0, 0, 0, date('m'), date('d'), date('Y')) + config_item('next_schedule_date') * 86400 - 1;
        if (empty($allTaxi->result)) {
            parent::returnData(array());
        } else {
            parent::returnData($this->Roster_model->getAllRosterWithDateRange($this->userID, $allTaxi->result, $start_date, $end_date));
        }
    }

    public function getAllRosterDetailWithDateRange() {
        $allTaxi = $this->taxi_model->getAllTaxi($this->userID);
        $start_date = $this->input->get('rosterStart');
        $start_date = !empty($start_date) ? $this->timezone->convertDateToMKTime($start_date) : '';
        $end_date = $this->input->get('rosterEnd');
        $end_date = !empty($end_date) ? $this->timezone->convertDateToMKTime($end_date) : '';
        if (empty($allTaxi)) {
            parent::returnData(array());
        } else {
            parent::returnData($this->Roster_model->getAllRosterWithDateRange($this->userID, $allTaxi, $start_date, $end_date));
        }
    }

    public function getRosterDetail($operatorID, $taxiID) {

    }
}