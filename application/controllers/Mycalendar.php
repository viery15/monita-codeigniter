<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/11/2019
 * Time: 3:19 PM
 */
?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mycalendar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->nik == NULL) {
            redirect(base_url());
        }

        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
//        $data["users"] = $this->user_model->getAll();
        $this->load->view("mycalendar");
    }

}

