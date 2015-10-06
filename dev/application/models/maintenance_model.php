<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Maintenance_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/MaintenanceEntity");
    }

    private function getUserID($maintenanceID) {
        $user_id = 0;
        $this->db->select('user_id');
        $this->db->from('wp_maintenance_history');
        $this->db->where('ID', $maintenanceID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $user_id = $result->user_id;
        }

        $query->free_result();

        return $user_id;
    }

    public function getMaintenanceDetail($maintenanceID){
        $this->db->select("*");
        $this->db->where("ID", $maintenanceID);
        $this->db->from("wp_maintenance_history");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
            return $this->returnData;
        }
    }

    public function getAllMaintenance($userID){
        $this->db->select('m.*, t.license_plate_no');
        $this->db->from('wp_maintenance_history AS m');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('m.user_id', $userID);
        $this->db->where('m.taxi_id', 't.ID', false);
        $this->db->order_by('maintenance_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allMaintenance = array();
        $count = 0;
        foreach ($result AS $maintenanceInfo) {
            $maintenanceInfo->maintenance_date = $maintenanceInfo->maintenance_date > 0 ? $this->timezone->convertMKTimeToDate($maintenanceInfo->maintenance_date) : '';
            $allMaintenance[$count++] = $maintenanceInfo;
        }

        return parent::returnData($allMaintenance);
    }

    public function getAllMaintenanceWithDateRange($userID){
        $start_date = $this->input->get('maintenanceStart');
        $start_date = !empty($start_date) ? $this->timezone->convertDateToMKTime($start_date) : '';
        $end_date = $this->input->get('maintenanceEnd');
        $end_date = !empty($end_date) ? $this->timezone->convertDateToMKTime($end_date) : '';

        $this->db->select('m.*, t.license_plate_no');
        $this->db->from('wp_maintenance_history AS m');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('m.user_id', $userID);
        $this->db->where('m.taxi_id', 't.ID', false);
        if (strcmp($start_date, '') != 0) {
            $this->db->where('m.maintenance_date >=', $start_date);
        }

        if (strcmp($end_date, '') != 0) {
            $this->db->where('m.maintenance_date <=', $end_date + (24 * 3600) - 1);
        }
        $this->db->order_by('maintenance_date', 'DESC');

        $result = $this->db->get()->result();
//        echo $this->db->last_query();
        $allMaintenance = array();
        $count = 0;
        foreach ($result AS $maintenanceInfo) {
            $maintenanceInfo->maintenance_date = $maintenanceInfo->maintenance_date > 0 ? $this->timezone->convertMKTimeToDate($maintenanceInfo->maintenance_date) : '';
            $allMaintenance[$count++] = $maintenanceInfo;
        }

        return parent::returnData($allMaintenance);
    }

    public function getAllTaxiMaintenance($userID, $taxiID){
        $this->db->select('m.*, t.license_plate_no');
        $this->db->from('wp_maintenance_history AS m');
        $this->db->from('wp_taxi_details AS t');
        $this->db->where('m.user_id', $userID);
        $this->db->where('m.taxi_id', 't.ID', false);
        $this->db->where('m.taxi_id', $taxiID);
        $this->db->order_by('maintenance_date', 'DESC');

        $result = $this->db->get()->result();
//        die($this->db->last_query());
        $allMaintenance = array();
        $count = 0;
        foreach ($result AS $maintenanceInfo) {
            $maintenanceInfo->maintenance_date = $maintenanceInfo->maintenance_date > 0 ? $this->timezone->convertMKTimeToDate($maintenanceInfo->maintenance_date) : '';
            $allMaintenance[$count++] = $maintenanceInfo;
        }

        return parent::returnData($allMaintenance);
    }

    public function addMaintenance($userID) {
        $newMaintenanceEntity = new MaintenanceEntity;
        $newMaintenanceEntity->user_id = $userID;
        $newMaintenanceEntity->taxi_id = $this->input->post('taxi_id');
        $newMaintenanceEntity->maintenance_task = $this->input->post('maintenance_task');
        $newMaintenanceEntity->is_scheduled = $this->input->post('is_scheduled');
        $newMaintenanceEntity->time_required = $this->input->post('time_required');
        $newMaintenanceEntity->parts_required = $this->input->post('parts_required');
        $newMaintenanceEntity->parts_available = $this->input->post('parts_available');
        $newMaintenanceEntity->parts_cost = $this->input->post('parts_cost');
        $newMaintenanceEntity->repair_cost = $this->input->post('repair_cost');

        $maintenance_date = $this->input->post('maintenance_date');
        if (!empty($maintenance_date)) {
            $newMaintenanceEntity->maintenance_date = $this->timezone->convertDateToMKTime($maintenance_date);
        }

        $newMaintenanceEntity->comment = $this->input->post('comment');

//        echo $this->db->last_query().'<br>;
        if ($this->db->insert('wp_maintenance_history', $newMaintenanceEntity)) {
//            echo $this->db->last_query();
            return parent::returnData($this->db->insert_id());
        } else {
//            echo $this->db->last_query();
            return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
        }
    }

    public function updateMaintenance($userID, $maintenanceID) {
        if ($userID == $this->getUserID($maintenanceID)) {
            $newMaintenanceEntity = new MaintenanceEntity;
            $newMaintenanceEntity->user_id = $userID;
            $newMaintenanceEntity->taxi_id = $this->input->post('taxi_id');
            $newMaintenanceEntity->maintenance_task = $this->input->post('maintenance_task');
            $newMaintenanceEntity->is_scheduled = $this->input->post('is_scheduled');
            $newMaintenanceEntity->time_required = $this->input->post('time_required');
            $newMaintenanceEntity->parts_required = $this->input->post('parts_required');
            $newMaintenanceEntity->parts_available = $this->input->post('parts_available');
            $newMaintenanceEntity->parts_cost = $this->input->post('parts_cost');
            $newMaintenanceEntity->repair_cost = $this->input->post('repair_cost');

            $maintenance_date = $this->input->post('maintenance_date');
            if (!empty($maintenance_date)) {
                $newMaintenanceEntity->maintenance_date = $this->timezone->convertDateToMKTime($maintenance_date);
            }

            $newMaintenanceEntity->comment = $this->input->post('comment');

            $this->db->where("ID", $maintenanceID, false);
            $this->db->where("user_id", $userID, false);

            if ($this->db->update('wp_maintenance_history', $newMaintenanceEntity)) {
//                echo $this->db->last_query().'<br>';
                return parent::returnData($maintenanceID);
            } else {
//                echo $this->db->last_query().'<br>';
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }

    public function removeMaintenance($userID, $maintenanceID) {
        if ($userID == $this->getUserID($maintenanceID)) {
            $this->db->where("ID", $maintenanceID, false);
            if ($this->db->delete('wp_maintenance_history')) {
                return parent::returnData(true);
            } else {
                return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
            }
        }

        return parent::returnData(false, ConstExceptionCode::INVALID_ACTION);
    }
}