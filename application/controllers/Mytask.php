<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/2/2019
 * Time: 10:00 AM
 */
?>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mytask extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("task_model");
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask", $data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->task_model->delete($id);
    }

    public function form_add(){
        $data["users"] = $this->user_model->getUserAssign();

        $this->load->view("mytask_form",$data);
    }

    public function form_update($id){
        $data["task"] = $this->task_model->getById($id);
        $data["users"] = $this->user_model->getUserAssign();

        $this->load->view("mytask_form",$data);
    }

    public function create(){
        $this->task_model->save();
    }

    public function update(){
        $this->task_model->update();
    }
}
