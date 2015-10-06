<?php
/**
 * Created by Amalesh Debnath
 * Date: 4/8/14
 * Time: 9:34 PM
 */

class Payment extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Payment_model');
    }
}