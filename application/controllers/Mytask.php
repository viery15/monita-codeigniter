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
        if ($this->session->nik == NULL) {
            redirect(base_url());
        }
        $this->load->model("task_model");
        $this->load->model("user_model");
        $this->load->model("notification_model");
        $this->load->model("comment_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask", $data);
    }

    public function sendmail($email){
        $this->load->library('email');

        // Konfigurasi email
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'vierydarmawan3@gmail.com';
        $config['smtp_pass'] = 'mendol817';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;
        $this->email->initialize($config);

        $this->email->to($email['destination']);
        $this->email->from('vierydarmawan3@gmail.com','Viery Darmawan');
        if ($email['type'] == "approve") {
            $this->email->subject('New Request');
            $this->email->message('You have new request from '.$email["from"]);
        }

        $this->email->send();
    }

    public function task($id)
    {
        $data["task"] = $this->task_model->getById($id);
        $data['comment'] = $this->comment_model->getByTaskId($id);

        $this->load->view("task_page",$data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->task_model->delete($id);
        $this->comment_model->delete($id);

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
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

    public function approve(){
        $post = $this->input->post();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $this->task_model->approve();

        $email['destination'] = $data['user']->email;
        $email['type'] = "approve";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $this->sendmail($email);

        $this->notification_model->approve($data['task']);

        $data["mytask"] = $this->task_model->getTask();

        $this->load->view("mytask_table_list", $data);
    }

    public function approve2(){
        $post = $this->input->post();
        $this->task_model->approve();

        $data["task"] = $this->task_model->getById($post['id']);
        $this->notification_model->approve($data['task']);

        $data["mytask"] = $this->task_model->getTask();


        $this->load->view("task_page_content", $data);
    }

    public function done(){
        $post = $this->input->post();
        $data["task"] = $this->task_model->getById($post['id']);

        $this->notification_model->done($data['task']);
        $this->task_model->done();

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }

    public function done2(){
        $post = $this->input->post();
        $this->task_model->done();

        $data["task"] = $this->task_model->getById($post['id']);
        $this->notification_model->done($data['task']);


        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("task_page_content", $data);
    }

    public function reject(){
        $post = $this->input->post();
        $data["task"] = $this->task_model->getById($post['id']);

        $this->notification_model->reject($data['task']);
        $this->task_model->reject();

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }

    public function reject2(){
        $post = $this->input->post();
        $this->task_model->reject();
        $data["task"] = $this->task_model->getById($post['id']);

        $this->notification_model->reject($data['task']);

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("task_page_content", $data);
    }

    public function create(){
        $this->task_model->save();

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }

    public function update(){
        $this->task_model->update();

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }
}
