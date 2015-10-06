<?php
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
    public function getDashboardDetail($userID){
        $start_date = $this->input->get('start_date');
        $start_date = !empty($start_date) ? $this->timezone->convertDateToMKTime($start_date) : '';
        $end_date = $this->input->get('end_date');
        $end_date = !empty($end_date) ? $this->timezone->convertDateToMKTime($end_date) + 24 * 60 - 1 : '';
        $select = sprintf("license_plate_no, plate_fee, network_fee, insurance_fee, car_finance_fee, registration_fee,
        sum(parts_cost + repair_cost) AS %s, sum(amount_paid - mf_amount - m7_amount - fine_toll_amount) AS %s,
        MAX(maintenance_date) AS max_maintenance_date, MIN(maintenance_date) AS min_maintenance_date,
        MAX(paying_date) AS max_paying_date, MIN(paying_date) AS min_paying_date", "maintenance_cost", "balance");

        $m_where = empty($start_date) ? "" : " AND m.maintenance_date >= " . $start_date;
        $m_where .= empty($end_date) ? "" : " AND m.maintenance_date <= " . $end_date;

        $r_where = empty($start_date) ? "" : " AND r.paying_date >= " . $start_date;
        $r_where .= empty($end_date) ? "" : " AND r.paying_date <= " . $end_date;

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
            $dashboardMaintenanceData[$count]['taxi_id'] = $info->license_plate_no;
            $dashboardProfitData[$count]['taxi_id'] = $info->license_plate_no;

            $date_start = $start_date == '' ? $info->min_paying_date : $start_date;
            $date_end = $end_date == '' ? $info->max_paying_date : $end_date;
            $date_diff = (($date_end - $date_start) / (24 * 3600)) + 1;
            $info->plate_fee = ($info->plate_fee / 30) * $date_diff;
            $info->network_fee = ($info->network_fee / 30) * $date_diff;
            $info->insurance_fee = ($info->insurance_fee / 30) * $date_diff;
            $info->car_finance_fee = ($info->car_finance_fee / 30) * $date_diff;
            $info->total = $info->maintenance_cost + $info->plate_fee + $info->network_fee + $info->insurance_fee + $info->car_finance_fee;
//            $info->registration_fee = ($info->registration_fee / 30) * $date_diff;
            $info->balance = $info->balance;
            $info->profit = $info->balance - $info->total;

            $info->maintenance_cost = intval($info->maintenance_cost) ? intval($info->maintenance_cost) : 0;
            $info->profit = intval($info->profit) ? intval($info->profit) : 0;

            $dashboardMaintenanceData[$count]['value'] = $info->maintenance_cost;
            $dashboardProfitData[$count]['value'] = $info->profit;

            $dashboardDetail[$count++] = $info;
        }

        $data['profitData'] = $dashboardProfitData;
        $data['maintenanceData'] = $dashboardMaintenanceData;
        $data['detail'] = $dashboardDetail;
//        $this->util->echoObject($result);

        return parent::returnData($data);
    }
}