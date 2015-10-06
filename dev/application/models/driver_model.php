<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Driver_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/DriverEntity");
    }

    public function getDriverDetail($driverID){
        $this->db->select("*");
        $this->db->where("ID", $driverID);
        $this->db->from("wp_drivers");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        }

        return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
    }

    public function getDriverDetailFromUserID($userID){
        $this->db->select("*");
        $this->db->where("user_id", $userID);
        $this->db->from("wp_drivers");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        }

        return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
    }

    public function addDriver($userID) {
        $driverEntity = new DriverEntity;
        $driverEntity->user_id = $userID;
        $driverEntity->authority_card_acquired_in = $this->input->post('authority_card_acquired_in');
        $driverEntity->authority_card_number = $this->input->post('authority_card_number');

        if ($this->insertOnDuplicateUpdate("wp_drivers", "user_id", $userID, $driverEntity)) {
            return true;
        }

        return false;
    }
}