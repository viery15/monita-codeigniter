<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/30/2019
 * Time: 10:45 AM
 */

class Overview extends CI_Controller {
    public function __construct()
    {
    	header('Access-Control-Allow-Origin: *');
        parent::__construct();
    }

    public function index()
    {
        // load view admin/overview.php
        $this->load->view("overview");
    }
}