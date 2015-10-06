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
    }

    public function viewDashboard(){
        $userInfo = $this->User_model->getUserDetail($this->userID);
        $data['userInfo'] = $userInfo->error['code'] == 0 ? $userInfo->result : array();
        $user_name['username'] = $data['userInfo']->first_name . ' ' . $data['userInfo']->last_name;
        $this->load->view('header_with_side_menu', $user_name);
        $this->load->view('dashboard/dashboard', array());
        $this->load->view('general_popups');
        $this->load->view('js/cuadro-js/common-script');
        $this->load->view('js/cuadro-js/cuadro-dashboard');
        $this->load->view('footer_with_side_menu');
    }

    public function getDashboardDetail(){
        parent::returnData($this->Dashboard_model->getDashboardDetail($this->userID));
    }
}
?>