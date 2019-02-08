<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myrequest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->nik == NULL) {
            redirect(base_url());
        }
        $this->load->model("task_model");
        $this->load->model("user_model");
        $this->load->model("comment_model");
        $this->load->model("notification_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest", $data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->task_model->delete($id);
        $this->comment_model->delete($id);

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function form_add(){
        $data["users"] = $this->user_model->getUserAssign();

        $this->load->view("myrequest_form",$data);
    }

    public function form_update($id){
        $data["request"] = $this->task_model->getById($id);
        $data["users"] = $this->user_model->getUserAssign();

        $this->load->view("myrequest_form", $data);
    }

    public function form_comment($id){
        $data["task"] = $this->task_model->getById($id);
        $data["comment"] = $this->comment_model->getByTaskId($id);

        $this->load->view("myrequest_form_comment", $data);
    }

    public function create(){
        $task_id = $this->task_model->save();
        $this->notification_model->save($task_id);

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function submitcomment(){
        $post = $this->input->post();

        $this->comment_model->save();

        $data["task"] = $this->task_model->getById($post['task_id']);
        $this->notification_model->comment($data['task']);

        $data["comment"] = $this->comment_model->getByTaskId($post['task_id']);

        $this->load->view("myrequest_form_comment", $data);

    }

    public function resend(){
        $post = $this->input->post();
        $data["task"] = $this->task_model->getById($post['id']);

        $this->notification_model->resend($data['task']);
        $this->task_model->resend();

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function update(){
        $this->task_model->update();

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function download($filename){
        $this->load->helper('download');
        force_download(FCPATH.'/uploads/'.$filename, null);
    }
}