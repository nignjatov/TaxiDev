<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 3/25/15
 * Time: 2:12
 */

class TaxiEntity {
    // user id
    var $user_id;

    // taxi_network
    var $taxi_network;

    // license_plate_no
    var $license_plate_no;

    // state
    var $state = '';

    // area
    var $area = '';

    // suburb
    var $suburb = '';

    // options
    var $options = '';

    // car_type
    var $car_type = '';

    // car_style
    var $car_style = '';

    // car_manufacturer
    var $car_manufacturer;

    // year_manufactured
    var $year_manufactured;

    // fuel_type
    var $fuel_type = '';

    // kilometres
    var $kilometres = 0;

    // Plate Fee
    var $plate_fee = 0;

    // Network Fee
    var $network_fee = 0;

    // Insurance Fee
    var $insurance_fee = 0;

    // Car Finance Fee
    var $car_finance_fee = 0;

    // Registration Fee
    var $registration_fee = 0;

    // Registration Due date
    var $registration_due_date;

    // Insurance Due Date
    var $insurance_due_date;

    // comment
    var $comment = '';

    // is active
    var $is_active = true;
} 