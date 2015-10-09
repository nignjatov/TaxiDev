<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 * All Right Reserved Cuadrolabs Private Limited
 * Plans
 * PremiumPlan = sub_5PtgFGS1OaQ2NG
 * PersonalPlan =
 * BasicPlan =
 */

require_once(APPPATH.'libraries/stripe/Stripe.php');

class Subscription extends CI_Controller {

    var $userDetail;

    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Usersubscription_model');
        $this->load->model('Subscription_model');

        $user_id = $this->User_model->getLogedInUser();
        if (!$user_id){
            redirect('User/login');
        }
        $userDetail = $this->User_model->getUserDetail($user_id);
        $this->userDetail = $userDetail->result;
    }

    public function updateSubscription(){
        $data = array();
        $data['userInfo'] = $this->userDetail;
        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        $data["allSubscriptionDetail"] = $this->Subscription_model->getAllSubscriptionDetail();
        $data['recommendedSubscriptionID'] = 6;
        $data['currentSubscriptionInfo'] = $this->Usersubscription_model->getCurrentSubscriptionInfo($this->userDetail->ID);

        $this->load->view('header_with_side_menu', $user_name);
        $this->load->view('user/upgradeSubscription', $data);
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-script-subscription');
        $this->load->view('js/cuadro-js/cuadro-script-user');
        $this->load->view('footer_with_side_menu');
    }

    public function buySubscription(){
        $plan = $this->input->get("plan");
        $token  = $this->input->get('stripeToken');
        $user_email = $this->userDetail->email_id;
        $charge = $this->Subscription_model->buySubscription($this->userDetail, $token, $plan, $user_email);
        if ($charge) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function buyFreeSubscription(){
        $plan = $this->input->get("plan");
        $user_email = $this->userDetail->email_id;
        $charge = $this->Subscription_model->buyFreeSubscription($this->userDetail, $plan, $user_email);
        if ($charge) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function upgradeSubscription(){
        list($stripeCustomerID, $stripeSubscriptionID) = $this->Subscription_model->getStripeSubscription($this->userDetail->ID);
        $plan = $this->input->get("plan");
        $charge = $this->Subscription_model->upgradeSubscription($this->userDetail, $stripeCustomerID, $stripeSubscriptionID, $plan);
        if ($charge) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function getAllSubscriptionDetail(){
        $allSubscriptionDetail = $this->Subscription_model->getAllSubscriptionDetail();
        echo $_GET['callback'].'('.(json_encode($allSubscriptionDetail)).')';
    }
}