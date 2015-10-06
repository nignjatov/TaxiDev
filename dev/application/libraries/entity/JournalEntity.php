<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 3/25/15
 * Time: 2:06
 */

class JournalEntity {
    // user id
    var $user_id;
    var $license_plate_no;
    var $shift = 'Morning';
    var $kilometer_driven = 0;
    var $shift_rate = 0;
    var $fuel_cost = 0;
    var $other_cost = 0;
    var $cash_payment = 0;
    var $eftpos_shift_total = 0;
    var $docket = 0;
    var $comment = '';
} 