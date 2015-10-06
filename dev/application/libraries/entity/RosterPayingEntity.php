<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 3/25/15
 * Time: 2:06
 */

class RosterPayingEntity {
    // operator id
    var $taxi_id;
    var $user_id;
    var $paying_date;
    var $shift = 'Morning';     // Morning/Afternoon
    var $is_leased = true;
    var $driver_name;
    var $is_paid = false;
    var $amount_paid = 0;
    var $mf_amount = 0;
    var $m7_amount = 0;
    var $cash_amount = 0;
    var $fine_toll_amount = 0;
    var $expenses = 0;
    var $comment = '';
} 