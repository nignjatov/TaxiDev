<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 * All Right Reserved Cuadrolabs Private Limited
 */

class Dashboard extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->model('taxi_model');
        $this->load->model('roster_model');
    }

    public function viewDashboard(){
        $userInfo = $this->User_model->getUserDetail($this->userID);
        $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();
        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        if($userInfo->result->user_type == 'operator'){
            $this->load->view('header_with_side_menu', $user_name);
        } else {
            $this->load->view('header_with_side_menu_driver', $user_name);
        }
        $data['type'] = "operator";
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-dashboard');
        $this->load->view('footer_with_side_menu');
    }

    public function viewDriverDashboard(){
        $userInfo = $this->User_model->getUserDetail($this->userID);
        $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();
        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        if($userInfo->result->user_type == 'operator'){
            $this->load->view('header_with_side_menu', $user_name);
        } else {
            $this->load->view('header_with_side_menu_driver', $user_name);
        }
        $data['type'] = "Driver";
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-dashboard');
        $this->load->view('footer_with_side_menu');
    }

    public function getDashboardDetail(){
        $userInfo = $this->User_model->getUserDetail($this->userID);
        if($userInfo->result->user_type == 'operator'){
            $taxis = $this->taxi_model->getAllTaxi($this->userID);
            foreach($taxis->result as $taxi){
                $last = $this->roster_model->getLatestEntryForTaxi($taxi->ID);
                if(count($last->result) > 0){
                    $current_date = strtotime(date("Y-M-d"));
                    for ($i = 0 ; $i < 366; $i++) {
                        if(($current_date+$i*86400) > (intval(reset($last->result)->paying_date))){
                            $this->roster_model->addRosterTemplate($this->userID,$taxi->ID,'Evening',$current_date+$i*86400);
                            $this->roster_model->addRosterTemplate($this->userID,$taxi->ID,'Morning',$current_date+$i*86400);
                        }
                    }
                } else {
                    $current_date = strtotime(date("Y-M-d"));
                    for ($i = 0 ; $i < 366; $i++) {
                        $this->roster_model->addRosterTemplate($this->userID,$taxi->ID,'Evening',$current_date+$i*86400);
                        $this->roster_model->addRosterTemplate($this->userID,$taxi->ID,'Morning',$current_date+$i*86400);
                    }
                }
            }
        }

        $args = $this->uri->uri_to_assoc(3);
        $type = "";
        if((count($args) > 0) && ($args['type'] != "")){
            $type = $args['type'];
        }

        parent::returnData($this->Dashboard_model->getDashboardDetail($this->userID,$type));

    }
}
?>