<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class Maintenance extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Maintenance_model');
    }

    public function getAllMaintenance() {
        $userInfo = $this->User_model->getUserDetail($this->userID);
        $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();
        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        $this->load->view('header_with_side_menu', $user_name);
        $this->load->view('taxi/maintenance', array());
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-script-maintenance');
        $this->load->view('footer_with_side_menu');
    }

    public function addMaintenance() {
        parent::returnData($this->Maintenance_model->addMaintenance($this->userID));
    }

    public function updateMaintenance() {
        $maintenance_id = $this->input->get('maintenance_id');
        parent::returnData($this->Maintenance_model->updateMaintenance($this->userID, $maintenance_id));
    }

    public function removeMaintenance() {
        $maintenance_id = $this->input->get('maintenance_id');
        parent::returnData($this->Maintenance_model->updateMaintenance($this->userID, $maintenance_id));
    }

    public function getAllMaintenanceDetail() {
        parent::returnData($this->Maintenance_model->getAllMaintenance($this->userID));
    }

    public function getAllMaintenanceDetailWithDateRange() {
        parent::returnData($this->Maintenance_model->getAllMaintenanceWithDateRange($this->userID));
    }

    public function getMaintenanceDetail($operatorID, $taxiID) {

    }
}