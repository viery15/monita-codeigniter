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
        if ($this->session->nik == NULL) {
            redirect(base_url());
        }
        $this->load->model("task_model");
        $this->load->model("user_model");

    }

    public function index()
    {
        $data["users"] = $this->task_model->getUserMonitoring();
//        $data["users2"] = $this->task_model->getUserMonitoring2();
//        print_r($data);
        $this->load->view("monitoring",$data);
    }

    public function search() {
        $post = $this->input->post();
        $data['progress'] = $this->task_model->getProgress();
        $data['done'] = $this->task_model->getDone();
        $data['nik'] = $post['nik'];
        $data['type'] = $post['type'];

        $data['count_task_done'] = $this->task_model->getCountTaskDone();
        $data['count_task_progress'] = $this->task_model->getCountTaskProgress();

        $data['count_request_done'] = $this->task_model->getCountRequestDone();
        $data['count_request_progress'] = $this->task_model->getCountRequestProgress();

        $this->load->view("monitoring_content",$data);
    }

}
