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
        $this->load->model("category_model");
        $this->load->model("notification_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest", $data);
    }

    public function sendmail($email){
        $this->load->library('email');

        // Konfigurasi email
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'vierydarmawan3@gmail.com';
        $config['smtp_pass'] = 'Mendol817';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;
        $this->email->initialize($config);

        $this->email->to($email['destination']);
        $this->email->from('noreply@monita.citratubindo.com','MONITA');
        if ($email['type'] == "new") {
            $this->email->subject('MONITA - New Request');
        }

        $this->email->message(
            'Your request detail : <br><br><table>'.
            '<tr><td>Title</td> <td>:</td> <td>' . $email['title'] . '</td></tr>'.
            '<tr><td>Description</td> <td>:</td> <td>' . $email['description']. '</td>'.
            '<tr><td>Assigned from</td> <td>:</td> <td>'. $email['from'] . '</td>'.
            '<tr><td>Date</td> <td>:</td> <td>'. date('d M Y', strtotime($email['date_from'])) . ' - ' . date('d M Y', strtotime($email['date_to'])). '</td>'.
            '</table><br><br>'.
            'The current status is <b>' . strtoupper($email['status']) . '</b><br>'.
            'For more action, you can access on ' . base_url() . 'task/'. $email['task_id'].'<br><br>'.
            'do not reply this email.'
        );

        if($this->email->send()){
            echo "email sukses";
        }
        else {
            echo "gagal";
        }
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->task_model->delete($id);
        $this->comment_model->delete($id);

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function delete2(){
        $id = $this->input->post('id');
        $this->task_model->delete($id);
        $this->comment_model->delete($id);

//        $data["myrequest"] = $this->task_model->getRequest();
//        $this->load->view("myrequest_table_list", $data);
    }

    public function form_add(){
        $data["users"] = $this->user_model->getUserAssign();
        $data["category"] = $this->category_model->getAll();

        $this->load->view("myrequest_form",$data);
    }

    public function form_update($id){
        $data["request"] = $this->task_model->getById($id);
        $data["users"] = $this->user_model->getUserAssign();
        $data["category"] = $this->category_model->getAll();

        $this->load->view("myrequest_form", $data);
    }

    public function form_update2($id){
        $data["request"] = $this->task_model->getById($id);
        $data["users"] = $this->user_model->getUserAssign();
        $data["category"] = $this->category_model->getAll();

        $this->load->view("myrequest_form2", $data);
    }

    public function form_comment($id){
        $data["task"] = $this->task_model->getById($id);
        $data["comment"] = $this->comment_model->getByTaskId($id);

        $this->load->view("myrequest_form_comment", $data);
    }

    public function create(){
        $task_id = $this->task_model->save();
        $this->notification_model->save($task_id);

        $data["task"] = $this->task_model->getById($task_id);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_to);

        $email['destination'] = $data['user']->email;
        $email['type'] = "new";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);

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

    public function deletefile($file){
        unlink(FCPATH.'/uploads/'.$file);
    }

    public function deletecomment(){
        $post = $this->input->post();

        $file = $this->comment_model->getById($post['id']);
        if (isset($file->attachment)) {
            $this->deletefile($file->attachment);
        }
        $this->comment_model->delete($post['id']);

        $data["task"] = $this->task_model->getById($post['task_id']);
        $data["comment"] = $this->comment_model->getByTaskId($post['task_id']);

        $this->load->view("myrequest_form_comment", $data);
    }

    public function deletecomment2(){
        $post = $this->input->post();

        $file = $this->comment_model->getById($post['id']);
        if (isset($file->attachment)) {
            $this->deletefile($file->attachment);
        }
        $this->comment_model->delete($post['id']);

        $data["task"] = $this->task_model->getById($post['task_id']);
        $data["comment"] = $this->comment_model->getByTaskId($post['task_id']);
        $this->load->view("comment_page", $data);
    }

    public function submitcomment2(){
        $post = $this->input->post();

        $this->comment_model->save();

        $data["task"] = $this->task_model->getById($post['task_id']);
        $this->notification_model->comment($data['task']);

        $data["comment"] = $this->comment_model->getByTaskId($post['task_id']);

        $this->load->view("comment_page", $data);

    }

    public function resend(){
        $post = $this->input->post();
        $this->task_model->resend();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_to);

        $this->notification_model->resend($data['task']);

        $email['destination'] = $data['user']->email;
        $email['type'] = "new";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function resend2(){
        $post = $this->input->post();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_to);

        $this->notification_model->resend($data['task']);
        $this->task_model->resend();

        $email['destination'] = $data['user']->email;
        $email['type'] = "new";
        $email['from'] = $data['task']->user_from;
        $email['task_id'] = $data['task']->id;

        $this->sendmail($email);

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("task_page_content", $data);
    }

    public function update(){
        $this->task_model->update();

        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function update2(){
        $post = $this->input->post();
        $this->task_model->update();
        $data["task"] = $this->task_model->getById($post['id']);
        $this->load->view("task_page_content", $data);
    }

    public function download($filename){
        $this->load->helper('download');
        $filename2 = str_replace('%20', ' ', $filename);
        force_download(FCPATH.'/uploads/'.$filename2, null);

    }
}
