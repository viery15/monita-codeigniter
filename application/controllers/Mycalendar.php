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

        $this->load->model("category_model");
        $this->load->model("task_model");
    }

    public function index()
    {
        $data["task"] = $this->task_model->getTaskCalender();
        $data["category"] = $this->category_model->getAll();

        $this->load->view("mycalendar",$data);
    }

    public function search($category)
    {
        $data["task"] = $this->task_model->getByCategory($category);

//        print_r($data);
        $this->load->view("mycalendar_content",$data);
    }

}

