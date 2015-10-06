<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 5/4/14
 * Time: 8:31 PM
 */
class Timezone {
    function __construct() {
        date_default_timezone_set("GMT");
    }

    private function getDateStartTime($timeStamp = 0){
        $timeStamp = $timeStamp ? $timeStamp : time();
        return strtotime("midnight", $timeStamp);
    }

    private function getDateEndTime($timeStamp = 0){
        $timeStamp = $timeStamp ? $timeStamp : time();
        return strtotime("tomorrow", $timeStamp) - 1;
    }

    public function getCurrentDateTime($separator='/'){
        return date("Y").$separator.date("m").$separator.date("d")." ".date("H").":".date("i").":".date("s");
    }

    public function convertDateToMKTime($date, $dateSeparator = '/') {
        $temp = explode(' ',$date);
        $dateValues = explode($dateSeparator, $temp[0]);
        return mktime(0, 0, 0, intval($dateValues[0]), intval($dateValues[1]), intval($dateValues[2]));
    }

    public function convertMKTimeToDate($value, $dateOnly = true, $dateSeparator = '/'){
        $day = date("d", $value);
        $month = date("m", $value);
        $year = date("Y", $value);
        $hour = date("H", $value);
        $minute = date("i", $value);
        $second = date("s", $value);
        return $dateOnly ? $month.$dateSeparator.$day.$dateSeparator.$year : $month.$dateSeparator.$day.$dateSeparator.$year.' '.$hour.':'.$minute.':'.$second;
    }

    public function getInBetweenDates($start_time, $end_time){
        $dates = array();
        for($i = $start_time; $i < $end_time; ) {
            $dates[count($dates)] = date("m/d/Y", $i);
            $i += 86400;
        }

        return $dates;
    }
}
?>