<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 * All Right Reserved Cuadrolabs Private Limited
 */

class Subscription_model extends MY_Model {
    var $subscriptionEntity;

    public function __construct() {
        parent::__construct();
        $this->load->library("entity/SubscriptionEntity");
        $this->load->library("entity/UserSubscriptionEntity");
        $this->load->library("entity/PaymentEntity");
        $this->subscriptionEntity = new SubscriptionEntity;
    }

    public function getStripeSubscription($userID){
        $this->db->select("u.stripe_id, us.stripe_subscription_id");
        $this->db->from("wp_server_users AS u");
        $this->db->from("wp_user_subscription AS us");
        $this->db->where("u.ID", $userID, false);
        $this->db->where("u.ID", "us.user_id", false);
        $this->db->where("us.end_date > ", time());
        $this->db->order_by("us.end_date", "desc");
        $this->db->limit(1);
        $result = $this->db->get()->row();
        if (isset($result)) {
            return array($result->stripe_id, $result->stripe_subscription_id);
        }

        return array("", "");
    }

    public function getAllSubscriptionDetail(){
        return $this->subscriptionEntity->getAllSubscriptionDetail();
    }

    private function saveStripeCustomerId($userID, $customerID){
        $data = new stdClass();
        $data->stripe_id = $customerID;
        $this->db->where("ID", $userID);
        return $this->db->update("wp_server_users", $data);
    }

    private function updateUserProfile($userID, $customerID, $plan, $activationDate, $endDate, $amount, $currency, $discount, $name, $stripeSubscriptionID){
        if (!$this->saveStripeCustomerId($userID, $customerID)) return false;

        $subscriptionID = $this->subscriptionEntity->getSubscriptionIDFromStripeID($plan);
        $subscriptionInfo = $this->subscriptionEntity->getSubscriptionDetail($subscriptionID);
        $data = new stdClass();
        $data->user_type = $subscriptionInfo['user_type'];
        $data->subscription_id = $subscriptionInfo['id'];
        $this->db->where("ID", $userID);
        $update_user_info = $this->db->update("wp_server_users", $data);

        if (!$update_user_info) return false;

        $data = new UserSubscriptionEntity();
        $data->user_id = $userID;
        $data->subscription_id = $subscriptionID;
        $data->activation_date = $activationDate;
        $data->end_date = $endDate;
        $data->stripe_subscription_id = $stripeSubscriptionID;

        $clientSubscriptionID = $this->db->update("wp_user_subscription", $data);
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


    public function upgradeSubscription($user_detail, $stripeCustomerID, $stripeSubscriptionID, $plan){
        try {
            $secret_key = config_item('stripe_secret');
            Stripe::setApiKey($secret_key);

            $customer = Stripe_Customer::retrieve($stripeCustomerID);

//            echo "Customer: <br>";
//            $this->util->echoObject($customer);

            $subscription = $customer->subscriptions->retrieve($customer->subscriptions->data[0]->id);

//            echo "Subscription: <br>";
//            $this->util->echoObject($subscription);

            $subscription->plan = $plan;
            $response = $subscription->save();

//            echo "Response: <br>";
//            $this->util->echoObject($response);

            if (isset($response->current_period_end)) {
                $activationDate = $response->current_period_start;
                $endDate = $response->current_period_end;
                $amount = $response->plan->amount;
                $currency = $response->plan->currency;
                $discount = empty($response->discount) ? 0 : $response->discount;
                $name = "";//$customer->cards->data[0]->name;
                $updateUserProfile = $this->updateUserProfile($user_detail->ID, $stripeCustomerID, $plan, $activationDate, $endDate, $amount, $currency, $discount, $name, $stripeSubscriptionID);
                if ($updateUserProfile) {
                    $email_body = $this->makeSuccessEmailBody($user_detail->first_name, $user_detail->last_name, $plan, $user_detail->email_id);
                    $this->sendSuccessEmail("accounts@taxideals.com.au", $user_detail->email_id, "Welcome to " . config_item("site_title"), $email_body);
                    return true;
                }
            }
            return false;
        } catch(Stripe_CardError $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (Stripe_InvalidRequestError $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (Stripe_AuthenticationError $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (Stripe_ApiConnectionError $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (Stripe_Error $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (Exception $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (ErrorException $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        }
    }

    public function buySubscription($userDetail, $token, $plan, $userEmail) {
        try {
            $secret_key = config_item('stripe_secret');
            Stripe::setApiKey($secret_key);

            $description = sprintf("One year subscription fee for %s", $plan);
            $customerOption = array(
                "card" => $token,
                "email" => $userEmail
            );

            $customer = Stripe_Customer::create($customerOption);
//            echo "Customer Information: <br>";
//            $this->util->echoObject($customer);

            $subscriptionOption = array(
                "plan" => $plan
            );

            $subscriptionInfo = $customer->subscriptions->create($subscriptionOption);
//            echo "Customer Information: <br>";
//            $this->util->echoObject($subscriptionInfo);

            $stripeCustomerID = $customer->id;

            $amount = $subscriptionInfo->plan->amount;
            $currency = $subscriptionInfo->plan->currency;
            $discount = 0;
            $invoice_item = Stripe_InvoiceItem::create( array(
                'customer'    => $stripeCustomerID,
                'amount'      => $amount,
                'currency'    => $currency,
                'description' => $description
            ) );

//            echo "Invoice Item: <br>";
//            $this->util->echoObject($invoice_item);

            $invoice = Stripe_Invoice::create( array(
                'customer'    => $stripeCustomerID
            ) );

//            echo "Invoice: <br>";
//            $this->util->echoObject($invoice);

            $invoice->pay();

            if (!$invoice->paid) return false;

            $this->updateUserProfile($userDetail->ID, $stripeCustomerID, $plan, $subscriptionInfo->current_period_start, $subscriptionInfo->current_period_end, $amount, $currency, $discount, $subscriptionInfo->name, $subscriptionInfo->id);
            $order_no = $invoice->id;
            if ($order_no) {
                $pdf_html = $this->util->makeInvoicePDFContent($userDetail, $subscriptionInfo, $invoice, $order_no, $customer->sources->data[0]->last4, $discount);

                $this->load->library('dompdf_lib');

                $pdf_content = $this->dompdf_lib->convert_html_to_pdf($pdf_html, $order_no, false);

                $file_name = $this->util->getEncryptedFileName($order_no);
                $this->util->uploadFileToServer($file_name, $pdf_content);
            }

            return $order_no;
        } catch(Stripe_CardError $e) {
            $this->printError($e);
            return false;
        } catch (Stripe_InvalidRequestError $e) {
            $this->printError($e);
            return false;
        } catch (Stripe_AuthenticationError $e) {
            $this->printError($e);
            return false;
        } catch (Stripe_ApiConnectionError $e) {
            $this->printError($e);
            return false;
        } catch (Stripe_Error $e) {
            $this->printError($e);
            return false;
        } catch (Exception $e) {
            $this->printError($e);
            return false;
        } catch (ErrorException $e) {
            $this->printError($e);
            return false;
        }
    }

    public function buyFreeSubscription($userDetail, $plan, $userEmail) {
        try {

            if (!$this->saveStripeCustomerId($userDetail->ID, NULL)) return false;

            $subscriptionID = $this->subscriptionEntity->getSubscriptionIDFromStripeID($plan);
            $subscriptionInfo = $this->subscriptionEntity->getSubscriptionDetail($subscriptionID);
            $data = new stdClass();
            $data->user_type = $subscriptionInfo['user_type'];
            $data->subscription_id = $subscriptionInfo['id'];
            $this->db->where("ID", $userDetail->ID);
            $update_user_info = $this->db->update("wp_server_users", $data);

            if (!$update_user_info) return false;

            $data = new UserSubscriptionEntity();
            $data->user_id = $userDetail->ID;
            $data->subscription_id = $subscriptionID;
            $data->activation_date = time();
            $data->end_date = time() + (60*60*24*30);
            $data->stripe_subscription_id = '';

            $clientSubscriptionID = $this->db->insert("wp_user_subscription", $data);
            return true;
        } catch (Exception $e) {
            $this->printError($e);
            return false;
        } catch (ErrorException $e) {
            $this->printError($e);
            return false;
        }
    }

    private function makeSuccessEmailBody($first_name, $last_name, $plan, $user_email){
        $emailBody = sprintf('Hi %s %s,

        “Thank you for  purchasing a %s [%s] subscription
        We want to support you in your efforts and value feedback. Please do not hesitate to reach out to us, whatever the need.
        This email is confirming that we received your payment.
        Log in to your %s account now using your email address [%s] to make any modifications to your account, or to start creating:\r\n
        %s

        HOW TO GET HELP

        For technical questions related to %s products, please email %s

        For all other questions, please feel free to reply to this email or contact us using the details below.



        Gratefully,
        The %s Team
        %s
        %s
', config_item("site_title"), $first_name, $last_name, $plan, config_item("site_title"), $user_email, site_url(), config_item("site_title"), config_item('support_email'), config_item("site_title"), site_url(), config_item('accounts_email_id'));

        return $emailBody;
    }

    private function sendSuccessEmail($email_from, $email_to, $email_subject, $email_body){
//        $email_to = 'amalesh.debnath@gmail.com';
        $this->load->library('email');
        $this->email->initialize(array(
            'priority' => 1,
            'mailtype' => "html",
            'charset' => 'charset=ISO-8859-1'
        ));
        $this->email->from($email_from);
        $this->email->to($email_to);
        $this->email->subject($email_subject);
        $this->email->message($email_body);
        $this->email->send();
    }
}
