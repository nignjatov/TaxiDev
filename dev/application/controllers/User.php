<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class User extends CI_Controller {

    public  $userID;
    public  $CI;
    public $subscriptionID;
	
    function __construct()
    {
        parent::__construct();

        $this->CI = & get_instance();
//        var_dump($this->CI);

        $this->load->model('User_model');
        $this->load->model('Usersubscription_model');
        $this->load->model('Subscription_model');

        $this->userID = $this->User_model->getLogedInUser();

        $this->subscriptionID = $this->Usersubscription_model->getSubscription($this->userID);
    }

    private function returnData($result, $code = ConstExceptionCode::SUCCESS) {
//        echo $this->db->last_query();
        $errorInstance = new ConstExceptionCode($code);

        $returnData = new stdClass();
        $returnData->result = $result;
        $returnData->error = $errorInstance->getCodeMapping($code);

        echo $_GET['callback'].'('.(json_encode($returnData)).')';
    }

    public function register(){     //$userName, $email, $password, $deviceID, $secretKey){
        $this->load->view('header');
        $this->load->view('user/registration', array());
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-script-user');
        $this->load->view('footer');
    }

	public function activate(){   
		$this->load->view('header');
		$this->load->view('user/activate', array('status' => $this->User_model->accountActivate($this->decryptID($_GET["tag"]))));
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-script-user');
        $this->load->view('footer');
    }
	
    public function login(){
        if ($this->userID){
            if ($this->subscriptionID == 0){
                $this->chooseSubscription();
            } else {
                redirect('Operator/getAllTaxi');
            }
        } else {
            $this->load->view('header');
            $this->load->view('user/login', array());
            $this->load->view('general_popups');
            $this->load->view('js/cuadro-js/common-script');
            $this->load->view('js/cuadro-js/cuadro-script-subscription');
            $this->load->view('js/cuadro-js/cuadro-script-user');
            $this->load->view('footer');
        }
    }

    public function userLogin(){
		log_message('info', 'The purpose of some variable is to provide some value.');
        $user_name = $this->input->post('user_name');
        $user_password = $this->input->post('user_password');
        if (!empty($user_name) && !empty($user_password)){
            $this->userID = $this->User_model->getUserID($user_name, md5($user_password/*.config_item('encryption_key')*/));
            if ($this->userID){
                if (isset($_REQUEST['rememberMe']) && strcmp($_REQUEST['rememberMe'],'remember-me') == 0){
                    $this->session->sess_expiration = config_item('remember_session_expiry_time');
                } else {
                    $this->session->sess_expiration = config_item('session_expiry_time');
                }

                $user_detail = $this->User_model->getUserDetail($this->userID);
				
                if($user_detail->result->is_active != 1) {
                    $this->userID = null;
                    $this->sendActivationMail($user_detail->result->email_id, $user_detail->result->ID);
                    $this->session->sess_destroy();
                    UserEntity::setDefault();
                    self::returnData(true, ConstExceptionCode::NOT_ACTIVATED_ACCOUNT);
                } else /*if ($user_detail->result->subscription_id)*/ {
                    $userEntity = new stdClass();
                    $userEntity->first_name = $user_detail->result->first_name;
                    $userEntity->last_name = $user_detail->result->last_name;
                    $userEntity->email_id = $user_detail->result->email_id;
                    $userEntity->is_active = $user_detail->result->is_active;
                    $userEntity->password = $user_detail->result->password;
                    $userEntity->subscription_id = $user_detail->result->subscription_id;
                    $userEntity->user_name = $user_detail->result->user_name;
                    $userEntity->user_type = $user_detail->result->user_type;

                    UserEntity::setUserValues($userEntity);
                    $this->subscriptionID = $userEntity->subscription_id;
                    $array = array('user_id' => $this->userID, 'user_name' => $user_name,'user_pass' => md5($user_password/*.config_item('encryption_key')*/));
                    $this->session->set_userdata($array);
					
                    self::returnData(true);
                } /*else {
                    $this->chooseSubscription();
                }*/
            } else {
                self::returnData(false, ConstExceptionCode::INVALID_USER_ERROR);
            }
        } else {
            self::returnData(false, ConstExceptionCode::DATA_NOT_FOUND);
        }
    }

    public function viewProfile(){
        if ($this->subscriptionID == 0) {
            redirect("User/chooseSubscription");
        }
        $userInfo = $this->User_model->getUserDetail($this->userID);
        $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();

        $data['operatorInfo'] = array();
        $data['driverInfo'] = array();

        if (strcmp($userInfo->result->user_type, 'operator') == 0) {
            $this->load->model('Operator_model');
            $operatorInfo = $this->Operator_model->getOperatorDetailFromUserID($this->userID);
            $data['operatorInfo'] = $operatorInfo->error['code'] == 0 ? $operatorInfo->result : array();
        } else {
            $this->load->model('Driver_model');
            $driverInfo = $this->Driver_model->getDriverDetailFromUserID($this->userID);
            $data['driverInfo'] = $driverInfo->error['code'] == 0 ? $driverInfo->result : array();
        }

        $data["allSubscriptionDetail"] = $this->Subscription_model->getAllSubscriptionDetail();
        $data['recommendedSubscriptionID'] = 6;
        $data['currentSubscriptionInfo'] = $this->Usersubscription_model->getCurrentSubscriptionInfo($this->userID);

        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        $this->load->view('header_with_side_menu', $user_name);
        $this->load->view('user/profile', $data);
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-script-subscription');
        $this->load->view('js/cuadro-js/cuadro-script-user');
        $this->load->view('footer_with_side_menu');
    }

    public function createUser(){
	log_message('info', 'The purpose of some variable is to provide some value.');
        $email = $this->input->post('email_id');
        $isValidEmailForRegister = $this->User_model->isValidEmailForRegister($email);
        //$this->util->echoObject($isValidEmailForRegister);
        if ($isValidEmailForRegister->result) {
            $user_name = $this->input->post('user_name');
            $isValidUserNameForRegister = $this->User_model->isValidUserNameForRegister($user_name);
            //$this->util->echoObject($isValidUserNameForRegister);
            if ($isValidUserNameForRegister->result) {
                $result = $this->User_model->createUser($_REQUEST);
				
                //$this->util->echoObject($result);
                //if ($result->result) {
                    //$user_name = $this->input->post('user_name');
                    //$user_pass = $this->input->post('user_password');
                    //$array = array('user_id' => $result->result, 'user_name' => $user_name,'user_pass' => //md5($user_pass/*.config_item('encryption_key')*/));
                    //$this->session->set_userdata($array);
                //}
				
				$user_detail = $this->User_model->getUserDetail($result->result);
				$this->sendActivationMail($user_detail->result->email_id, $user_detail->result->ID);
				self::returnData(true, ConstExceptionCode::NOT_ACTIVATED_ACCOUNT);
                //echo $_GET['callback'].'('.(json_encode($result)).')';
            } else {
                echo $_GET['callback'].'('.(json_encode($isValidUserNameForRegister)).')';
            }
        } else {
            echo $_GET['callback'].'('.(json_encode($isValidEmailForRegister)).')';
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        UserEntity::setDefault();
        redirect('User/login');
    }

    public function forgotPassword($emailID, $domain){
        $success = 1;
        $email = $emailID.'@'.$domain;
        $emailInfo = $this->User_model->validEmailID($email);
        if (!empty($emailInfo)){
            $newPassword = $this->util->generateRandomString();
            $resetPassword = $this->User_model->resetPassword($emailInfo['UserID'], md5($newPassword));
            if ($resetPassword){
                $this->load->library('email');
                $message = sprintf("Your New Password is: %s",$newPassword);
                $this->email->from(config_item('support_email'), 'The LifeData Team');
                $this->email->to($email);
                $this->email->subject('LifeData New Password');
                $this->email->message($message);
                if (!$this->email->send()){
                    $success = 0;
                }
            } else {
                $success = 0;
            }
        } else {
            $success = 'invalid email';
        }

        echo $success;
    }

    public function checkSession(){
        echo $this->userID ? 0 : 1;
    }

    public function updateProfile(){
        $return = array();
        $return['result'] = false;
        $return['error_msg'] = config_item('general_error_msg');

        if ($this->userID){
            if (!$this->User_model->isValidEmailForUpdate($this->userID, $_REQUEST['email_id'])){
                $return['error_msg'] = config_item('same_email_error_msg');
            } else {
                $userInfo =  $this->User_model->getUserDetail($this->userID);

                if (isset($_GET["currentPassword"])){
                    if (strcmp($_REQUEST["UserPassword"], "") == 0) {
                        $return['result'] = false;
                        $return['error_msg'] = config_item('empty_password_error_msg');
                    } else {
//                        $this->util->echoObject($userInfo->result);
                        if (strcmp(md5($_REQUEST["currentPassword"]), $userInfo->result->password) == 0){
                            $return['result'] = $this->User_model->changePassword($this->userID, $_REQUEST["UserPassword"]);
                        } else {
                            $return['error_msg'] = config_item('wrong_password_error_msg');
                            $return['result'] = false;
                        }
                    }
                } else {
                    $return['result'] = true;
                }

                $return['result'] = $return['result'] ? $this->User_model->updateProfile($this->userID) : $return['result'];
            }
        }

        echo $_GET['callback'].'('.(json_encode($return)).')';
    }

    public function chooseSubscription() {
        if ($this->userID) {
            $this->subscriptionID = $this->Usersubscription_model->getSubscription($this->userID);
            if ($this->subscriptionID > 0){
                redirect('Dashboard/viewDashboard');
            } else {
                $userInfo = $this->User_model->getUserDetail($this->userID);

//                $this->util->echoObject($userInfo);
//                die('test');
                $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();
                $data["allSubscriptionDetail"] = $this->Subscription_model->getAllSubscriptionDetail();
                $data['recommendedSubscriptionID'] = 6;
                $this->load->view('header');
                $this->load->view('user/chooseSubscription', $data);
                $this->load->view('general_popups');
                $this->load->view('js/cuadro-js/common-script');
                $this->load->view('js/cuadro-js/cuadro-script-user');
            }
        }
    }

    public function updateSubscription(){
        $this->load->view('header');
        $data = array();
        $data['userInfo'] = $this->userID == '' ? array() : $this->User_model->getUserDetail($this->userID);
        $data['userInfo']["SubscriptionID"] = $this->Usersubscription_model->getSubscription($this->clientID);

        $subscriptionInfo = $this->Subscription_model->getAllSubscriptionDetail();
        $data["subscriptionInfo"] = $subscriptionInfo;
        $data['recommendedSubscriptionID'] = 3;
        $this->load->view('general_body', $data);
        $this->load->view('sidebar');
        $this->load->view('user/upgradeSubscription', $data);
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/commonMethods');
        $this->load->view('js/cuadro-js/cuadro-script-user', array("subscriptionInfo" => $subscriptionInfo));
    }
	
    public function sendActivationMail($email, $id){
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from(config_item('support_email'), 'Taxideals support service');
        $list = array($email);
        $ci->email->to($list);
        $this->email->reply_to($email, '');
        $ci->email->subject('User acount activation');
		
		$msg = "Click on: <a href=\"http://$_SERVER[HTTP_HOST]/dev/index.php/User/activate?tag='".$this->encryptID($id)."'\">activation_link</a>  to activate your account.";
        $ci->email->message($msg);
        $ci->email->send();
    }
	
	public function encryptID( $q ) {
		$output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);
    
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($q, $encrypt_method, $key, 0, $iv);
        return  base64_encode($output);
	}

	public function decryptID( $q ) {
		$output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);
    
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return openssl_decrypt(base64_decode($q), $encrypt_method, $key, 0, $iv);
    }
}