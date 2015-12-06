<?php

include 'MonthInfo.php';

/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 * All Right Reserved Cuadrolabs Private Limited
 */

class Dashboard_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public function getDashboardDetail($userID,$user_type){
        if($user_type == 'operator'){

            $args = $this->uri->uri_to_assoc(3);

            if((count($args) > 0) && ($args['start_date'] != "")){
                $start_date = $args['start_date'];
                $start_date_int = strtotime($start_date);
            }

            if((count($args) > 0) && ($args['end_date'] != "")){
                $end_date = $args['end_date'];
                $end_date_int = strtotime($end_date);
            }

            $select = sprintf("license_plate_no, plate_fee, network_fee, insurance_fee, car_finance_fee, registration_fee, amount_paid,
            sum(parts_cost + repair_cost) AS %s, sum(amount_paid - mf_amount - m7_amount - fine_toll_amount) AS %s,
            MAX(maintenance_date) AS max_maintenance_date, MIN(maintenance_date) AS min_maintenance_date,
            MAX(paying_date) AS max_paying_date, MIN(paying_date) AS min_paying_date", "maintenance_cost", "balance");

            $m_where = " AND m.maintenance_date >= " . $start_date_int;
            $m_where .= " AND m.maintenance_date <= " . $end_date_int;

            $r_where = " AND r.paying_date >= " . $start_date_int;
            $r_where .= " AND r.paying_date <= " . $end_date_int;

            $where = sprintf("t.user_id = %s", $userID);

            $from = sprintf("(SELECT t.ID AS taxi_id, t.license_plate_no, t.plate_fee, t.network_fee, t.insurance_fee,
            t.car_finance_fee, t.registration_fee, m.parts_cost, m.repair_cost, r.amount_paid, r.mf_amount, r.m7_amount,
            r.fine_toll_amount, m.maintenance_date, r.paying_date from wp_taxi_details AS t left join wp_maintenance_history AS m on (t.ID = m.taxi_id%s)
            left join wp_roster_paying AS r on (t.ID = r.taxi_id%s) WHERE %s) dashboard", $m_where, $r_where, $where);

            $group_by = sprintf("taxi_id");

            $query = sprintf("SELECT %s FROM %s GROUP BY %s", $select, $from, $group_by);
            $result = $this->db->query($query)->result();
            $dashboardDetail = array();
            $dashboardProfitData = array();
            $dashboardMaintenanceData = array();
            $count = 0;
            foreach ($result AS $info) {
                $date_start = 0;
                $date_end = 0;
                $month_diff = -1;
                $dashboardMaintenanceData[$count]['taxi_id'] = $info->license_plate_no;
                $dashboardProfitData[$count]['taxi_id'] = $info->license_plate_no;
                if(count($date_start) == 0){
                   $date_start = $info->min_paying_date;
                }

                if(count($date_end) == 0){
                   $date_end = $info->max_paying_date;
                }

                if($month_diff < 0 ){
                    $end_month = date("n",strtotime($date_end));
                    $end_year = date("Y",strtotime($date_end));
                    $start_month = date("n",strtotime($date_start));
                    $start_year = date("Y",strtotime($date_start));
                    $num_of_years = $end_year - $start_year;
                    $month_diff = $end_month - $start_month + 1 + $num_of_years*12;
                }

                $info->plate_fee = $info->plate_fee  * $month_diff;
                $info->network_fee = $info->network_fee * $month_diff;
                $info->insurance_fee = $info->insurance_fee * $month_diff;
                $info->car_finance_fee = $info->car_finance_fee * $month_diff;
                $info->total = $info->maintenance_cost + $info->plate_fee + $info->network_fee + $info->insurance_fee + $info->car_finance_fee;
    //            $info->registration_fee = ($info->registration_fee / 30) * $date_diff;
                $info->balance = $info->balance;
                $info->profit = $info->amount_paid - $info->total;

                $info->maintenance_cost = floatval($info->maintenance_cost) ? floatval($info->maintenance_cost) : 0;
                $info->profit = floatval($info->profit) ? floatval($info->profit) : 0;

                $dashboardMaintenanceData[$count]['value'] = $info->maintenance_cost;
                $dashboardProfitData[$count]['value'] = $info->profit;

                $dashboardDetail[$count++] = $info;
            }

            $data['profitData'] = $dashboardProfitData;
            $data['maintenanceData'] = $dashboardMaintenanceData;
            $data['detail'] = $dashboardDetail;
            $data['type'] = $user_type;
        } else if ($user_type == 'driver') {
            $data['type'] = $user_type;

            $dashboardProfitData = array();
            $jan_info = new MonthInfo();
            $feb_info = new MonthInfo();
            $march_info = new MonthInfo();
            $april_info = new MonthInfo();
            $may_info = new MonthInfo();
            $jun_info = new MonthInfo();
            $july_info = new MonthInfo();
            $august_info = new MonthInfo();
            $sep_info = new MonthInfo();
            $oct_info = new MonthInfo();
            $nov_info = new MonthInfo();
            $dec_info = new MonthInfo();
            $q1_info = new MonthInfo();
            $q2_info = new MonthInfo();
            $q3_info = new MonthInfo();
            $q4_info = new MonthInfo();
            $fin_info = new MonthInfo();

            $jan_info->title = "January";
            $feb_info->title = "February";
            $march_info->title = "March";
            $april_info->title = "April";
            $may_info->title = "May";
            $jun_info->title = "Jun";
            $july_info->title = "July";
            $august_info->title = "August";
            $sep_info->title = "September";
            $oct_info->title = "October";
            $nov_info->title = "November";
            $dec_info->title = "December";
            $q1_info->title = "Q1";
            $q2_info->title = "Q2";
            $q3_info->title = "Q3";
            $q4_info->title = "Q4";
            $fin_info->title = "Final Year";

            $args = $this->uri->uri_to_assoc(3);
            $year = "";
            if((count($args) > 0) && ($args['year'] != "")){
                $year = $args['year'];
            }

            $start = strtotime($year."/01/01");
            $end = strtotime($year."/12/31");

            $jan = strtotime($year."/02/01");
            $feb = strtotime($year."/03/01");
            $march = strtotime($year."/04/01");
            $april = strtotime($year."/05/01");
            $may = strtotime($year."/06/01");
            $jun = strtotime($year."/07/01");
            $july = strtotime($year."/08/01");
            $aug = strtotime($year."/09/01");
            $sep = strtotime($year."/10/01");
            $oct = strtotime($year."/11/01");
            $nov = strtotime($year."/12/01");

            $sql = "SELECT * from wp_driver_journal WHERE user_id = ".$userID." AND paying_date BETWEEN ".$start." AND "
                    .$end." ORDER BY paying_date";
            $result = $this->db->query($sql)->result();
            foreach($result as $item){
                if($item->paying_date < $jan){
                    $jan_info->shiftPay+=$item->shift_rate;
                    $jan_info->fuelCost+=$item->fuel_cost;
                    $jan_info->otherCost+=$item->other_cost;
                    $jan_info->cash+=$item->cash_payment;
                    $jan_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $jan_info->docket+=$item->docket;
                    $jan_info->kilometer+=$item->kilometer;
                } else if($item->paying_date < $feb){
                    $feb_info->shiftPay+=$item->shift_rate;
                    $feb_info->fuelCost+=$item->fuel_cost;
                    $feb_info->otherCost+=$item->other_cost;
                    $feb_info->cash+=$item->cash_payment;
                    $feb_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $feb_info->docket+=$item->docket;
                    $feb_info->kilometer+=$item->kilometer;
                } else if($item->paying_date < $march){
                    $march_info->shiftPay+=$item->shift_rate;
                    $march_info->fuelCost+=$item->fuel_cost;
                    $march_info->otherCost+=$item->other_cost;
                    $march_info->cash+=$item->cash_payment;
                    $march_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $march_info->docket+=$item->docket;
                    $march_info->kilometer+=$item->kilometer;
                } else if($item->paying_date < $april){
                    $april_info->shiftPay+=$item->shift_rate;
                    $april_info->fuelCost+=$item->fuel_cost;
                    $april_info->otherCost+=$item->other_cost;
                    $april_info->cash+=$item->cash_payment;
                    $april_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $april_info->docket+=$item->docket;
                    $april_info->kilometer+=$item->kilometer;
                } else if($item->paying_date < $may){
                    $may_info->shiftPay+=$item->shift_rate;
                    $may_info->fuelCost+=$item->fuel_cost;
                    $may_info->otherCost+=$item->other_cost;
                    $may_info->cash+=$item->cash_payment;
                    $may_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $may_info->docket+=$item->docket;
                    $may_info->kilometer+=$item->kilometer;
                } else if($item->paying_date < $jun){
                    $jun_info->shiftPay+=$item->shift_rate;
                    $jun_info->fuelCost+=$item->fuel_cost;
                    $jun_info->otherCost+=$item->other_cost;
                    $jun_info->cash+=$item->cash_payment;
                    $jun_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $jun_info->docket+=$item->docket;
                    $jun_info->kilometer+=$item->kilometer;
                } else if($item->paying_date < $july){
                    $july_info->shiftPay+=$item->shift_rate;
                    $july_info->fuelCost+=$item->fuel_cost;
                    $july_info->otherCost+=$item->other_cost;
                    $july_info->cash+=$item->cash_payment;
                    $july_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $july_info->docket+=$item->docket;
                    $july_info->kilometer+=$item->kilometer;
                } else if($item->paying_date < $aug){
                    $august_info->shiftPay+=$item->shift_rate;
                    $august_info->fuelCost+=$item->fuel_cost;
                    $august_info->otherCost+=$item->other_cost;
                    $august_info->cash+=$item->cash_payment;
                    $august_info->eftposShiftTotal+=$item->eftpos_shift_total;
                    $august_info->docket+=$item->docket;
                    $august_info->kilometer+=$item->kilometer;
                 } else if($item->paying_date < $sep){
                     $sep_info->shiftPay+=$item->shift_rate;
                     $sep_info->fuelCost+=$item->fuel_cost;
                     $sep_info->otherCost+=$item->other_cost;
                     $sep_info->cash+=$item->cash_payment;
                     $sep_info->eftposShiftTotal+=$item->eftpos_shift_total;
                     $sep_info->docket+=$item->docket;
                     $sep_info->kilometer+=$item->kilometer;
                 } else if($item->paying_date < $oct){
                     $oct_info->shiftPay+=$item->shift_rate;
                     $oct_info->fuelCost+=$item->fuel_cost;
                     $oct_info->otherCost+=$item->other_cost;
                     $oct_info->cash+=$item->cash_payment;
                     $oct_info->eftposShiftTotal+=$item->eftpos_shift_total;
                     $oct_info->docket+=$item->docket;
                     $oct_info->kilometer+=$item->kilometer;
                 } else if($item->paying_date < $nov){
                     $nov_info->shiftPay+=$item->shift_rate;
                     $nov_info->fuelCost+=$item->fuel_cost;
                     $nov_info->otherCost+=$item->other_cost;
                     $nov_info->cash+=$item->cash_payment;
                     $nov_info->eftposShiftTotal+=$item->eftpos_shift_total;
                     $nov_info->docket+=$item->docket;
                     $nov_info->kilometer+=$item->kilometer;
                 } else {
                     $dec_info->shiftPay+=$item->shift_rate;
                     $dec_info->fuelCost+=$item->fuel_cost;
                     $dec_info->otherCost+=$item->other_cost;
                     $dec_info->cash+=$item->cash_payment;
                     $dec_info->eftposShiftTotal+=$item->eftpos_shift_total;
                     $dec_info->docket+=$item->docket;
                     $dec_info->kilometer+=$item->kilometer;
                 }
            }

            $jan_info->totalExpense =$jan_info->shiftPay + $jan_info->fuelCost + $jan_info->otherCost;
            $feb_info->totalExpense =$feb_info->shiftPay + $feb_info->fuelCost + $feb_info->otherCost;
            $march_info->totalExpense =$march_info->shiftPay + $march_info->fuelCost + $march_info->otherCost;
            $april_info->totalExpense =$april_info->shiftPay + $april_info->fuelCost + $april_info->otherCost;
            $may_info->totalExpense =$may_info->shiftPay + $may_info->fuelCost + $may_info->otherCost;
            $jun_info->totalExpense =$jun_info->shiftPay + $jun_info->fuelCost + $jun_info->otherCost;
            $july_info->totalExpense =$july_info->shiftPay + $july_info->fuelCost + $july_info->otherCost;
            $august_info->totalExpense =$august_info->shiftPay + $august_info->fuelCost + $august_info->otherCost;
            $sep_info->totalExpense =$sep_info->shiftPay + $sep_info->fuelCost + $sep_info->otherCost;
            $oct_info->totalExpense =$oct_info->shiftPay + $oct_info->fuelCost + $oct_info->otherCost;
            $nov_info->totalExpense =$nov_info->shiftPay + $nov_info->fuelCost + $nov_info->otherCost;
            $dec_info->totalExpense =$dec_info->shiftPay + $dec_info->fuelCost + $dec_info->otherCost;

            $jan_info->grossIncome =$jan_info->cash + $jan_info->eftposShiftTotal + $jan_info->docket;
            $feb_info->grossIncome =$feb_info->cash + $feb_info->eftposShiftTotal + $feb_info->docket;
            $march_info->grossIncome =$march_info->cash + $march_info->eftposShiftTotal + $march_info->docket;
            $april_info->grossIncome =$april_info->cash + $april_info->eftposShiftTotal + $april_info->docket;
            $may_info->grossIncome =$may_info->cash + $may_info->eftposShiftTotal + $may_info->docket;
            $jun_info->grossIncome =$jun_info->cash + $jun_info->eftposShiftTotal + $jun_info->docket;
            $july_info->grossIncome =$july_info->cash + $july_info->eftposShiftTotal + $july_info->docket;
            $august_info->grossIncome =$august_info->cash + $august_info->eftposShiftTotal + $august_info->docket;
            $sep_info->grossIncome =$sep_info->cash + $sep_info->eftposShiftTotal + $sep_info->docket;
            $oct_info->grossIncome =$oct_info->cash + $oct_info->eftposShiftTotal + $oct_info->docket;
            $nov_info->grossIncome =$nov_info->cash + $nov_info->eftposShiftTotal + $nov_info->docket;
            $dec_info->grossIncome =$dec_info->cash + $dec_info->eftposShiftTotal + $dec_info->docket;

            $jan_info->gst+=$jan_info->grossIncome / 10;
            $feb_info->gst+=$feb_info->grossIncome / 10;
            $march_info->gst+=$march_info->grossIncome / 10;
            $april_info->gst+=$april_info->grossIncome / 10;
            $may_info->gst+=$may_info->grossIncome / 10;
            $jun_info->gst+=$jun_info->grossIncome / 10;
            $july_info->gst+=$july_info->grossIncome / 10;
            $august_info->gst+=$august_info->grossIncome / 10;
            $sep_info->gst+=$sep_info->grossIncome / 10;
            $oct_info->gst+=$oct_info->grossIncome / 10;
            $nov_info->gst+=$nov_info->grossIncome / 10;
            $dec_info->gst+=$dec_info->grossIncome / 10;

            $jan_info->netIncome+=$jan_info->grossIncome - $jan_info->totalExpense - $jan_info->gst;
            $feb_info->netIncome+=$feb_info->grossIncome - $feb_info->totalExpense - $feb_info->gst;
            $march_info->netIncome+=$march_info->grossIncome - $march_info->totalExpense - $march_info->gst;
            $april_info->netIncome+=$april_info->grossIncome - $april_info->totalExpense - $april_info->gst;
            $may_info->netIncome+=$may_info->grossIncome - $may_info->totalExpense - $may_info->gst;
            $jun_info->netIncome+=$jun_info->grossIncome - $jun_info->totalExpense - $jun_info->gst;
            $july_info->netIncome+=$july_info->grossIncome - $july_info->totalExpense - $july_info->gst;
            $august_info->netIncome+=$august_info->grossIncome - $august_info->totalExpense - $august_info->gst;
            $sep_info->netIncome+=$sep_info->grossIncome - $sep_info->totalExpense - $sep_info->gst;
            $oct_info->netIncome+=$oct_info->grossIncome - $oct_info->totalExpense - $oct_info->gst;
            $nov_info->netIncome+=$nov_info->grossIncome - $nov_info->totalExpense - $nov_info->gst;
            $dec_info->netIncome+=$dec_info->grossIncome - $dec_info->totalExpense - $dec_info->gst;


            $q1_info->shiftPay= $jan_info->shiftPay + $feb_info->shiftPay + $march_info->shiftPay;
            $q1_info->fuelCost= $jan_info->fuelCost + $feb_info->fuelCost + $march_info->fuelCost;
            $q1_info->otherCost= $jan_info->otherCost + $feb_info->otherCost + $march_info->otherCost;
            $q1_info->cash= $jan_info->cash + $feb_info->cash + $march_info->cash;
            $q1_info->eftposShiftTotal= $jan_info->eftposShiftTotal + $feb_info->eftposShiftTotal + $march_info->eftposShiftTotal;
            $q1_info->docket= $jan_info->docket + $feb_info->docket + $march_info->docket;
            $q1_info->kilometer= $jan_info->kilometer + $feb_info->kilometer + $march_info->kilometer;
            $q1_info->totalExpense= $jan_info->totalExpense + $feb_info->totalExpense + $march_info->totalExpense;
            $q1_info->grossIncome= $jan_info->grossIncome + $feb_info->grossIncome + $march_info->grossIncome;
            $q1_info->gst= $jan_info->gst + $feb_info->gst + $march_info->gst;
            $q1_info->netIncome= $jan_info->netIncome + $feb_info->netIncome + $march_info->netIncome;

            $q2_info->shiftPay= $april_info->shiftPay + $may_info->shiftPay + $jun_info->shiftPay;
            $q2_info->fuelCost= $april_info->fuelCost + $may_info->fuelCost + $jun_info->fuelCost;
            $q2_info->otherCost= $april_info->otherCost + $may_info->otherCost + $jun_info->otherCost;
            $q2_info->cash= $april_info->cash + $may_info->cash + $jun_info->cash;
            $q2_info->eftposShiftTotal= $april_info->eftposShiftTotal + $may_info->eftposShiftTotal + $jun_info->eftposShiftTotal;
            $q2_info->docket= $april_info->docket + $may_info->docket + $jun_info->docket;
            $q2_info->kilometer= $april_info->kilometer + $may_info->kilometer + $jun_info->kilometer;
            $q2_info->totalExpense= $april_info->totalExpense + $may_info->totalExpense + $jun_info->totalExpense;
            $q2_info->grossIncome= $april_info->grossIncome + $may_info->grossIncome + $jun_info->grossIncome;
            $q2_info->gst= $april_info->gst + $may_info->gst + $jun_info->gst;
            $q2_info->netIncome= $april_info->netIncome + $may_info->netIncome + $jun_info->netIncome;

            $q3_info->shiftPay= $july_info->shiftPay + $august_info->shiftPay + $sep_info->shiftPay;
            $q3_info->fuelCost= $july_info->fuelCost + $august_info->fuelCost + $sep_info->fuelCost;
            $q3_info->otherCost= $july_info->otherCost + $august_info->otherCost + $sep_info->otherCost;
            $q3_info->cash= $july_info->cash + $august_info->cash + $sep_info->cash;
            $q3_info->eftposShiftTotal= $july_info->eftposShiftTotal + $august_info->eftposShiftTotal + $sep_info->eftposShiftTotal;
            $q3_info->docket= $july_info->docket + $august_info->docket + $sep_info->docket;
            $q3_info->kilometer= $july_info->kilometer + $august_info->kilometer + $sep_info->kilometer;
            $q3_info->totalExpense= $july_info->totalExpense + $august_info->totalExpense + $sep_info->totalExpense;
            $q3_info->grossIncome= $july_info->grossIncome + $august_info->grossIncome + $sep_info->grossIncome;
            $q3_info->gst= $july_info->gst + $august_info->gst + $sep_info->gst;
            $q3_info->netIncome= $july_info->netIncome + $august_info->netIncome + $sep_info->netIncome;

            $q4_info->shiftPay= $oct_info->shiftPay + $nov_info->shiftPay + $dec_info->shiftPay;
            $q4_info->fuelCost= $oct_info->fuelCost + $nov_info->fuelCost + $dec_info->fuelCost;
            $q4_info->otherCost= $oct_info->otherCost + $nov_info->otherCost + $dec_info->otherCost;
            $q4_info->cash= $oct_info->cash + $nov_info->cash + $dec_info->cash;
            $q4_info->eftposShiftTotal= $oct_info->eftposShiftTotal + $nov_info->eftposShiftTotal + $dec_info->eftposShiftTotal;
            $q4_info->docket= $oct_info->docket + $nov_info->docket + $dec_info->docket;
            $q4_info->kilometer= $oct_info->kilometer + $nov_info->kilometer + $dec_info->kilometer;
            $q4_info->totalExpense= $oct_info->totalExpense + $nov_info->totalExpense + $dec_info->totalExpense;
            $q4_info->grossIncome= $oct_info->grossIncome + $nov_info->grossIncome + $dec_info->grossIncome;
            $q4_info->gst= $oct_info->gst + $nov_info->gst + $dec_info->gst;
            $q4_info->netIncome= $oct_info->netIncome + $nov_info->netIncome + $dec_info->netIncome;

            $fin_info->shiftPay= $q1_info->shiftPay + $q2_info->shiftPay + $q3_info->shiftPay + $q4_info->shiftPay;
            $fin_info->fuelCost= $q1_info->fuelCost + $q2_info->fuelCost + $q3_info->fuelCost + $q4_info->fuelCost;
            $fin_info->otherCost= $q1_info->otherCost + $q2_info->otherCost + $q3_info->otherCost + $q4_info->otherCost;
            $fin_info->cash= $q1_info->cash + $q2_info->cash + $q3_info->cash + $q4_info->cash;
            $fin_info->eftposShiftTotal= $q1_info->eftposShiftTotal + $q2_info->eftposShiftTotal + $q3_info->eftposShiftTotal + $q4_info->eftposShiftTotal;
            $fin_info->docket= $q1_info->docket + $q2_info->docket + $q3_info->docket + $q4_info->docket;
            $fin_info->kilometer= $q1_info->kilometer + $q2_info->kilometer + $q3_info->kilometer + $q4_info->kilometer;
            $fin_info->totalExpense= $q1_info->totalExpense + $q2_info->totalExpense + $q3_info->totalExpense + $q4_info->totalExpense;
            $fin_info->grossIncome= $q1_info->grossIncome + $q2_info->grossIncome + $q3_info->grossIncome + $q4_info->grossIncome;
            $fin_info->gst= $q1_info->gst + $q2_info->gst + $q3_info->gst + $q4_info->gst;
            $fin_info->netIncome= $q1_info->netIncome + $q2_info->netIncome + $q3_info->netIncome + $q4_info->netIncome;

            $dashboardProfitData[0] = $jan_info;
            $dashboardProfitData[1] = $feb_info;
            $dashboardProfitData[2] = $march_info;
            $dashboardProfitData[3] = $april_info;
            $dashboardProfitData[4] = $may_info;
            $dashboardProfitData[5] = $jun_info;
            $dashboardProfitData[6] = $july_info;
            $dashboardProfitData[7] = $august_info;
            $dashboardProfitData[8] = $sep_info;
            $dashboardProfitData[9] = $oct_info;
            $dashboardProfitData[10] = $nov_info;
            $dashboardProfitData[11] = $dec_info;
            $dashboardProfitData[12] = $q1_info;
            $dashboardProfitData[13] = $q2_info;
            $dashboardProfitData[14] = $q3_info;
            $dashboardProfitData[15] = $q4_info;
            $dashboardProfitData[16] = $fin_info;

            $data['profitData'] = $dashboardProfitData;

        }


        return parent::returnData($data);
    }
}