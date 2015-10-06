<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 3/25/15
 * Time: 2:06
 * Singleton class
 */
class SubscriptionEntity
{
    private static $subscriptions = array(
        array(
            "id" => 1,
            "title" => "Driver Subscription",
            "detail" => "Unlimited Drivers Wanted ad",
            "user_type" => "driver",
            "stripe_id" => "DriverSubscription",
            "amount" => 0
        ),
        array(
            "id" => 2,
            "title" => "Basic Subscription",
            "detail" => "Unlimited Drivers Wanted ad, upto 4 Taxi specific ads, up to 2 taxi profiles",
            "user_type" => "operator",
            "stripe_id" => "BasicSubscription",
            "amount" => 995
        ),
        array(
            "id" => 3,
            "title" => "Silver Subscription",
            "detail" => "Unlimited Drivers Wanted ad, up to 20 taxi  ads, up to 5 taxi profiles",
            "user_type" => "operator",
            "stripe_id" => "SilverSubscription",
            "amount" => 2995
        ),
        array(
            "id" => 4,
            "title" => "Golden Subscription",
            "detail" => "Unlimited Drivers Wanted ad, unlimited taxi ads, up to 10 taxi profiles",
            "user_type" => "operator",
            "stripe_id" => "GoldenSubscription",
            "amount" => 4995
        ),
        array(
            "id" => 5,
            "title" => "Platinum Subscription",
            "detail" => "Unlimited Drivers Wanted ad, unlimited taxi ads, up to 25 taxi profiles",
            "user_type" => "operator",
            "stripe_id" => "PlatinumSubscription",
            "amount" => 9995
        ),
        array(
            "id" => 6,
            "title" => "Diamond Subscription",
            "detail" => "Unlimited Drivers Wanted ad, unlimited taxi ads, up to 50 taxi profiles",
            "user_type" => "operator",
            "stripe_id" => "DiamondSubscription",
            "amount" => 17995
        )
    );

    private static $taxiLimit = array(
        "local" => array(0,1,2,3,4,5),
        "dev" => array(0,2,5,10,25,50),
        "qa" => array(0,2,5,10,25,50),
        "prod" => array(0,2,5,10,25,50)
    );
    private static $adsLimit = array(
        "local" => array(0,1,2,3,4,5),
        "dev" => array(0,2,5,10,25,50),
        "qa" => array(0,2,5,10,25,50),
        "prod" => array(0,4,20,-1,-1,-1)
    );

    private static $driverAdsLimit = array(
        "local" => array(0,1,2,3,4,5),
        "dev" => array(0,2,5,10,25,50),
        "qa" => array(0,2,5,10,25,50),
        "prod" => array(-1,-1,-1,-1,-1)
    );

    public function getAllSubscriptionDetail(){
        return self::$subscriptions;
    }
    
    public function getSubscriptionIDFromStripeID($stripeID){
        $subscription_id = 0;
        foreach(self::$subscriptions AS $subscription_information) {
            if (strcmp($subscription_information["stripe_id"], $stripeID) == 0) {
                $subscription_id = $subscription_information["id"];
                break;
            }
        }
        
        return $subscription_id;
    }

    public function getStripeIDFromSubscriptionID($subscriptionID){
        $stripe_id = 0;
        foreach(self::$subscriptions AS $stripe_information) {
            if (strcmp($stripe_information["id"], $subscriptionID) == 0) {
                $stripe_id = $stripe_information["stripe_id"];
                break;
            }
        }

        return $stripe_id;
    }

    public function getTaxiLimit($subscriptionID) {
        return ($subscriptionID && isset(self::$taxiLimit[config_item('environment')][$subscriptionID - 1])) ? self::$taxiLimit[config_item('environment')][$subscriptionID - 1] : 0;
    }

    public function getAdsLimit($subscriptionID) {
        return ($subscriptionID && isset(self::$adsLimit[config_item('environment')][$subscriptionID - 1])) ? self::$adsLimit[config_item('environment')][$subscriptionID - 1] : 0;
    }

    public function getDriverAdsLimit($subscriptionID) {
        return ($subscriptionID && isset(self::$driverAdsLimit[config_item('environment')][$subscriptionID - 1])) ? self::$driverAdsLimit[config_item('environment')][$subscriptionID - 1] : 0;
    }

    public function getSubscriptionDetailFromStripeID($stripeID){
        $subscriptionInfo = array();
        foreach (self::$subscriptions AS $subscription) {
            if (strcmp($subscription['stripe_id'], $stripeID) == 0) {
                $subscriptionInfo = $subscription;
            }
        }

        return $subscriptionInfo;
    }

    public function getSubscriptionDetail($subscriptionID){
        $subscriptionInfo = array();
        foreach (self::$subscriptions AS $subscription) {
            if (strcmp($subscription['id'], $subscriptionID) == 0) {
                $subscriptionInfo = $subscription;
            }
        }

        return $subscriptionInfo;
    }
}