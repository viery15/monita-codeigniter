<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/2/2019
 * Time: 1:12 PM
 */

class Monitoring extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("task_model");
        $this->load->model("user_model");

    }

    public function index()
    {
        $data["users"] = $this->user_model->getUserAssign();
        $this->load->view("monitoring",$data);
    }

    public function search($nik) {
        $data['progress'] = $this->task_model->getProgress($nik);
        $data['done'] = $this->task_model->getDone($nik);
//        $data['count_progress'] = $this->task_model->getCountProgress($nik);
//        $data['count_done'] = $this->task_model->getCountDone($nik);
        $data['nik'] = $nik;

        $this->load->view("monitoring_content",$data);
    }

}
