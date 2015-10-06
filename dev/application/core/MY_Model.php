<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 2/14/15
 * Time: 17:44
 */

require_once(APPPATH . 'libraries/exceptions/ConstExceptionCode.php');

class MY_Model extends CI_Model {
    public  $CI;
    public  $subscriptionEntity;

    public function __construct()
    {
        parent::__construct();
        $this->CI = & get_instance();
        $this->load->library("entity/SubscriptionEntity");
        $this->subscriptionEntity = new SubscriptionEntity;
    }

    public function returnData($result, $code = ConstExceptionCode::SUCCESS) {
//        echo $this->db->last_query();
        $errorInstance = new ConstExceptionCode($code);

        $returnData = new stdClass();
        $returnData->result = $result;
        $returnData->error = $errorInstance->getCodeMapping($code);

        return $returnData;
    }

    protected function insertOnDuplicateUpdate($table,$id_key, $id_value, $data)
    {
        $this->db->where($id_key, $id_value);
        $q = $this->db->get($table)->row();

        if ( $q )
        {
            $this->db->where($id_key,$id_value);
            return $this->db->update($table,$data);
        } else {
            $this->db->set($id_key, $id_value);
            return $this->db->insert($table, $data);
        }
    }
}