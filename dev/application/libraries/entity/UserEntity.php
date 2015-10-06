<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 3/25/15
 * Time: 2:06
 * Singleton class
 */
final class UserEntity
{
    var $first_name;
    var $last_name;
    var $email_id;
    var $user_name;
//    var $password;
    var $subscription_id;
    var $user_type;
    var $is_active = true;
    private static $singleton_instance = null;

    /**
     * Private constructor, so nobody else can instance it
     *
     */
    private function construct__() {}

    /**
     * Call this method to get singleton
     *
     * @return UserEntity
     */

    public static function userInstance() {
        if(self::$singleton_instance === null) {
            self::$singleton_instance = new UserEntity();
        }

        return self::$singleton_instance;
    }

    public static function setDefault() {
        self::$singleton_instance = null;
    }

    public static function setUserValues($userEntity){
        self::$singleton_instance->first_name = isset($userEntity->first_name) ? $userEntity->first_name : self::$singleton_instance->first_name;
        self::$singleton_instance->last_name = isset($userEntity->last_name) ? $userEntity->last_name : self::$singleton_instance->last_name;
//        self::$singleton_instance->user_name = isset($userEntity->user_name) ? $userEntity->user_name : self::$singleton_instance->user_name;
        self::$singleton_instance->user_type = isset($userEntity->user_type) ? $userEntity->user_type : '';
        self::$singleton_instance->subscription_id = isset($userEntity->subscription_id) ? $userEntity->subscription_id : '';
//        self::$singleton_instance->password = isset($userEntity->password) ? $userEntity->password : self::$singleton_instance->password;
        self::$singleton_instance->is_active = isset($userEntity->is_active) ? $userEntity->is_active : true;
        self::$singleton_instance->email_id = isset($userEntity->email_id) ? $userEntity->email_id : self::$singleton_instance->email_id;
    }
}