<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class Journal extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Journal_model');
    }

    public function getAllJournal() {
        $userInfo = $this->User_model->getUserDetail($this->userID);
        $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();
        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        $this->load->view('header_with_side_menu', $user_name);
        $this->load->view('driver/journal', array());
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-script-journal');
        $this->load->view('footer_with_side_menu');
    }

    public function addJournal() {
        parent::returnData($this->Journal_model->addJournal($this->userID));
    }

    public function updateJournal() {
        $journal_id = $this->input->get('journal_id');
        parent::returnData($this->Journal_model->updateJournal($this->userID, $journal_id));
    }

    public function removeJournal() {
        $journal_id = $this->input->get('journal_id');
        parent::returnData($this->Journal_model->updateJournal($this->userID, $journal_id));
    }

    public function getAllJournalDetail() {
        parent::returnData($this->Journal_model->getAllJournal($this->userID));
    }

    public function getAllJournalDetailWithDateRange() {
        parent::returnData($this->Journal_model->getAllJournalWithDateRange($this->userID));
    }

    public function getJournalDetail($operatorID, $taxiID) {

    }
}