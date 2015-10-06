<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 * All Right Reserved Cuadrolabs Private Limited
 */
class Usersubscription_model extends MY_Model {
    var $subscriptionEntity;

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/SubscriptionEntity");
        $this->subscriptionEntity = new SubscriptionEntity;
    }

    public function getSubscription($userID){
        if (!is_numeric($userID)) return 0;
        $this->db->select("us.subscription_id");
        $this->db->from("wp_server_users AS u");
        $this->db->from("wp_user_subscription AS us");
        $this->db->where("u.ID", $userID, false);
        $this->db->where("u.ID", "us.user_id", false);
        $this->db->where("us.end_date > ", time());
        $this->db->order_by("us.end_date", "desc");
        $this->db->limit(1);
        $result = $this->db->get()->row();
//        echo $this->db->last_query();
        return isset($result->subscription_id) ? $result->subscription_id : 0;
    }

    public function getCurrentSubscriptionInfo($userID){
        $subscription_id = $this->getSubscription($userID);
        $subscriptionInfo = $this->subscriptionEntity->getSubscriptionDetail($subscription_id);
//        $this->util->echoObject($subscriptionInfo);
        $subscriptionInfo['amount_html'] = $subscriptionInfo["amount"] == 0 ? '<strong>Free</strong>' : '<strong>AU$ '.sprintf("%.2f",$subscriptionInfo["amount"] / 100).'</strong>/month';

        return $subscriptionInfo;
    }

    public function updateSubscription($userID, $subscriptionID){
        $userEntity = UserEntity::userInstance();
        $userEntity->subscription_id = $subscriptionID;
        $this->db->where("ID", $userID);

        if ($this->db->update("wp_server_users", $userEntity)) {
            $this->returnData->result = true;
            return $this->returnData;
        } else {
            $this->returnData->error = new ConstExceptionCode(ConstExceptionCode::UNKNOWN_ERROR_CODE);
            return $this->returnData;
        }
    }

    public function getTaxiLimit($userID){
        $subscriptionID = $this->getSubscription($userID);
        return $this->subscriptionEntity->getTaxiLimit($subscriptionID);
    }

    public function getAdsLimit($userID){
        $subscriptionID = $this->getSubscription($userID);
        return $this->subscriptionEntity->getAdsLimit($subscriptionID);
    }

    private function saveStripeCustomerId($userID, $customerID){
        $data = new stdClass();
        $data->stripe_id = $customerID;
        $this->db->where("ID", $userID);
        return $this->db->update("wp_server_users", $data);
    }

    private function updateUserProfile($userID, $customerID, $plan, $activationDate, $endDate, $amount, $currency, $discount, $name, $stripeSubscriptionID){
        if (!$this->saveStripeCustomerId($userID, $customerID)) return false;

        $data = new stdClass();
        $data->user_type =
        $update_user_info =
        $subscriptionEntity = new SubscriptionEntity();
        $subscriptionID = $subscriptionEntity->getSubscriptionIDFromStripeID($plan);

        $data = new UserSubscriptionEntity();
        $data->user_id = $userID;
        $data->subscription_id = $subscriptionID;
        $data->activation_date = $activationDate;
        $data->end_date = $endDate;
        $data->stripe_subscription_id = $stripeSubscriptionID;

        $clientSubscriptionID = $this->db->insert("wp_user_subscription", $data);
        if ($clientSubscriptionID) {
            $paymentData = new PaymentEntity();
            $paymentData->user_id = $userID;
            $paymentData->subscription_id = $subscriptionID;
            $paymentData->amount = $amount;
            $paymentData->currency = $currency;
            $paymentData->name = $name;
            $paymentData->discount = $discount;
            $paymentData->stripe_id = $stripeSubscriptionID;
            $paymentData->payment_date = $activationDate;
            $paymentID = $this->db->insert("wp_payment_history", $paymentData);

            return $paymentID ? true : false;
        }

        return false;
    }
}