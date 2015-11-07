<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 * All Right Reserved Cuadrolabs Private Limited
 */

class User_model extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library("entity/UserEntity");
    }

    public function getUserDetail($userID){
        $this->db->select("*");
        $this->db->where("ID", $userID);
        $this->db->from("wp_server_users AS u", false);
        $this->db->join('wp_user_detail AS ud', 'u.ID = ud.user_id', 'left');

        $query = $this->db->get();
        if ($query->num_rows()) {
            return parent::returnData($query->row());
        } else {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
        }
    }

    private function getUserType($userID) {
        $this->db->select("user_type");
        $this->db->where("ID", $userID);
        $this->db->from("wp_server_users", false);

        $query = $this->db->get();
        if ($query->num_rows()) {
            $userType = $query->row();
            return $userType->user_type;
        } else {
            return false;
        }
    }

    public function createUser(){
        $newUserEntity = new stdClass();
//        $newUserEntity = UserEntity::userInstance();
        $newUserEntity->email_id = $this->input->post('email_id');
        $newUserEntity->first_name = $this->input->post('first_name');
        $newUserEntity->last_name = $this->input->post('last_name');
        $newUserEntity->password = md5($this->input->post('user_password'));
//        $newUserEntity->subscription_id = $this->input->post('subscription_id');
        $newUserEntity->user_name = $this->input->post('user_name');
//        $newUserEntity->user_type = $this->input->post('user_type');

        if ($this->db->insert("wp_server_users", $newUserEntity)) {
            UserEntity::setUserValues($newUserEntity);
            return parent::returnData($this->db->insert_id());
        } else {
            return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
        }
    }

    public function resetPassword($userID, $password){
        $userEntity = new stdClass();
        $userEntity->password = $password;
        $this->db->where("ID", $userID);

        if ($this->db->update("wp_server_users", $userEntity)) {
            UserEntity::setUserValues($userEntity);
            return parent::returnData(true);
        } else {
            return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
        }
    }

    public function getLogedInUser(){
        if ($this->isLogin()){
            return $this->session->userdata('user_id');
        }

        return false;
    }

    public function isLogin(){
        if ($this->session->userdata('user_name') && $this->session->userdata('user_pass') && $this->session->userdata('user_id')){
            return true;
        }
        return false;
    }

    public function getUserEmailID($userID){
        $email_id = '';
        $this->db->select("email_id");
        $this->db->where("ID", $userID);
        $this->db->from("wp_server_users");

        $query = $this->db->get();
        if ($query->num_rows()) {
            $result = $query->row();
            $email_id = $result->email_id;
        }

        return $email_id;
    }

    public function isValidEmailForRegister($email){
        $this->db->where('email_id', $email);
        $this->db->from('wp_server_users');
        if ($this->db->count_all_results()) {
            return parent::returnData(false, ConstExceptionCode::SAME_EMAIL_ERROR);
        } else {
            return parent::returnData(true);
        }
    }

    public function isValidUserNameForRegister($name){
        $this->db->where('user_name', $name);
        $this->db->from('wp_server_users');
        if ($this->db->count_all_results()) {
            return parent::returnData(false, ConstExceptionCode::SAME_USERNAME_ERROR);
        } else {
            return parent::returnData(true);
        }
    }

    public function isValidEmailForUpdate($userID, $email){
        $this->db->where('ID !=', $userID);
        $this->db->where('email_id', $email);
        $this->db->from('wp_server_users');
        return $this->db->count_all_results() ? false : true;
    }

    public function updateProfile($userID){
        $this->db->trans_start();
        $newUserEntity = new stdClass();
        $newUserEntity->email_id = $this->input->post('email_id');
        $newUserEntity->first_name = $this->input->post('first_name');
        $newUserEntity->last_name = $this->input->post('last_name');
//        $newUserEntity->is_active = $this->input->post('is_active');
//        $newUserEntity->password = $this->input->post('password');
//        $newUserEntity->subscription_id = $this->input->post('subscription_id');
//        $newUserEntity->user_name = $this->input->post('user_name');
//        $newUserEntity->user_type = $this->input->post('user_type');

        $this->db->where("ID", $userID, false);

        if ($this->db->update("wp_server_users", $newUserEntity)) {
            UserEntity::setUserValues($newUserEntity);
            if ($this->updateUserDetail($userID)) {
                $user_type = $this->getUserType($userID);
                if ( $user_type && strcmp($user_type,'operator') == 0) {
                    $this->load->model("Operator_model");
                    if ($this->Operator_model->addOperator($userID)) {
                        return parent::returnData(true);
                    }
                } else {
                    $this->load->model("Driver_model");
                    if ($this->Driver_model->addDriver($userID)) {
                        return parent::returnData(true);
                    }
                }
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return parent::returnData(false, ConstExceptionCode::DATA_NOT_SAVED);
        }
        return parent::returnData(false, ConstExceptionCode::UNKNOWN_ERROR_CODE);
    }
    
    public function getUserID($user_name, $user_pass){
        $user_id = false;
        $this->db->select("ID");
        if (strpos('@', $user_name)) {
            $this->db->where("email_id", $user_name);
        } else {
            $this->db->where("user_name", $user_name);
        }

        $this->db->where("password", $user_pass);
        $this->db->from("wp_server_users");

        $query = $this->db->get();
//        echo $this->db->last_query();

        if ($query->num_rows()) {
            $result = $query->row();
            $user_id = $result->ID;
        }

//        echo $this->db->last_query();
        return $user_id;
    }

    public function updateUserDetail($userID) {
        $this->load->library("entity/UserDetailEntity");
        $userDetailEntity = new UserDetailEntity;
        $userDetailEntity->user_id = $userID;
        $userDetailEntity->mobile_1 = $this->input->post('mobile_1');
        $userDetailEntity->mobile_2 = $this->input->post('mobile_2');
        $userDetailEntity->phone = $this->input->post('phone');
        $userDetailEntity->fax = $this->input->post('fax');
        $userDetailEntity->state = $this->input->post('state');
        $userDetailEntity->area = $this->input->post('area');
        $userDetailEntity->street_name = $this->input->post('street_name');
        $userDetailEntity->street_number = $this->input->post('street_number');
        $userDetailEntity->suburb = $this->input->post('suburb');
        $userDetailEntity->postcode = $this->input->post('postcode');
//        $userDetailEntity->is_active = $this->input->post('is_active');
//        $userDetailEntity->comment = $this->input->post('comment');

        if ($this->insertOnDuplicateUpdate("wp_user_detail", "user_id", $userID, $userDetailEntity)) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($userID, $password){
        $data['password'] = md5($password);
        $this->db->where("ID", $userID, false);
        $this->db->set("password",md5($password));
        return $this->db->update("wp_server_users");
    }
}
