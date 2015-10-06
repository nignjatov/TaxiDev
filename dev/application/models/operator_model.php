<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 11/5/14
 * Time: 17:01
 */

class Operator_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/OperatorEntity");
    }

    public function getOperatorDetail($operatorID){
        $this->db->select("*");
        $this->db->where("ID", $operatorID);
        $this->db->from("wp_operators");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        }

        return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
    }

    public function getOperatorDetailFromUserID($userID){
        $this->db->select("*");
        $this->db->where("user_id", $userID);
        $this->db->from("wp_operators");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        }

        return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
    }

    public function addOperator($userID) {
        $operatorEntity = new OperatorEntity;
        $operatorEntity->user_id = $userID;
        $operatorEntity->operator_number = $this->input->post('operator_number');
        $operatorEntity->abn_number = $this->input->post('abn_number');
        $operatorEntity->contact_name = $this->input->post('contact_name');
        $operatorEntity->number_of_taxi_operates = $this->input->post("number_of_taxi_operates");

        if ($this->insertOnDuplicateUpdate("wp_operators", "user_id", $userID, $operatorEntity)) {
            return true;
        }

        return false;
    }
}