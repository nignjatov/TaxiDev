<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 3/25/15
 * Time: 2:06
 */

class MaintenanceEntity {
    // user id
    var $user_id;
    var $taxi_id;
    var $maintenance_task;
    var $is_scheduled = false;
    var $maintenance_date;
    var $time_required;
    var $parts_required = '';
    var $parts_available = true;
    var $parts_cost = 0;
    var $repair_cost = 0;
    var $comment = '';
} 