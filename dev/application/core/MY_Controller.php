<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 2/14/15
 * Time: 17:44
 */

require_once(APPPATH . 'libraries/exceptions/ConstExceptionCode.php');

class MY_Controller extends CI_Controller {
    public $clientID;
    public  $userID;
    public $subscriptionID;
    public  $CI;

    public function __construct()
    {
        parent::__construct();

        $this->CI = & get_instance();
//        var_dump($this->CI);

        $this->load->model('User_model');
        $this->load->model('Usersubscription_model');

        $this->userID = $this->User_model->getLogedInUser();

        if (!$this->userID) {
            redirect('User/login');
            return;
        }

        $this->subscriptionID = $this->Usersubscription_model->getSubscription($this->userID);
        if ($this->subscriptionID == 0) {
            redirect("User/chooseSubscription");
            return;
        }
    }

    public function returnData($result, $code = ConstExceptionCode::SUCCESS) {
//        echo $this->db->last_query();
        $errorInstance = new ConstExceptionCode($code);

        $returnData = new stdClass();
        $returnData->result = $result;
        $returnData->error = $errorInstance->getCodeMapping($code);

        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }
}