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
        $this->load->model("category_model");
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
        $config['smtp_pass'] = 'Mendol817';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;
        $this->email->initialize($config);

        $this->email->to($email['destination']);
        $this->email->from('noreply@monita.citratubindo.com','MONITA');
        if ($email['type'] == "approve") {
            $this->email->subject('MONITA - Approved Request');
        }

        if ($email['type'] == "done") {
            $this->email->subject('MONITA - Finished Request');
        }

        if ($email['type'] == "reject") {
            $this->email->subject('MONITA - Rejected Request');
        }

        if ($email['type'] == "cancel") {
            $this->email->subject('MONITA - Canceled Request');
        }

        $this->email->message(
            'Your request detail : <br><br><table>'.
            '<tr><td>Title</td> <td>:</td> <td>' . $email['title'] . '</td></tr>'.
            '<tr><td>Description</td> <td>:</td> <td>' . $email['description']. '</td>'.
            '<tr><td>Assigned to</td> <td>:</td> <td>'. $email['from'] . '</td>'.
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

    public function task($id)
    {
        $data["task"] = $this->task_model->getById($id);

        if (isset($data['task']->user_from) == $this->session->nik || isset($data['task']->user_to) == $this->session->nik || $this->session->role == 'admin') {

            $data['comment'] = $this->comment_model->getByTaskId($id);

            $this->load->view("task_page", $data);
        }
        else {
            redirect('dashboard');
        }
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
        $data["category"] = $this->category_model->getAll();

        $this->load->view("mytask_form",$data);
    }

    public function form_update($id){
        $data["task"] = $this->task_model->getById($id);
        $data["users"] = $this->user_model->getUserAssign();
        $data["category"] = $this->category_model->getAll();

        $this->load->view("mytask_form",$data);
    }

    public function approve(){
        $post = $this->input->post();
        $this->task_model->approve();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $email['destination'] = $data['user']->email;
        $email['type'] = "approve";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);

        $this->notification_model->approve($data['task']);

        $data["mytask"] = $this->task_model->getTask();

        $this->load->view("mytask_table_list", $data);
    }

    public function approve2(){
        $post = $this->input->post();
        $this->task_model->approve();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $email['destination'] = $data['user']->email;
        $email['type'] = "approve";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);

        $this->notification_model->approve($data['task']);

        $data["mytask"] = $this->task_model->getTask();


        $this->load->view("task_page_content", $data);
    }

    public function done(){
        $post = $this->input->post();
        $this->task_model->done();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $this->notification_model->done($data['task']);

        $email['destination'] = $data['user']->email;
        $email['type'] = "done";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);
        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }

    public function done2(){
        $post = $this->input->post();
        $this->task_model->done();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $this->notification_model->done($data['task']);

        $email['destination'] = $data['user']->email;
        $email['type'] = "done";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);
        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("task_page_content", $data);
    }

    public function reject(){
        $post = $this->input->post();
        $this->task_model->reject();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $this->notification_model->reject($data['task']);

        $email['destination'] = $data['user']->email;
        $email['type'] = "reject";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }

    public function cancel(){
        $post = $this->input->post();
        $this->task_model->cancel();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $this->notification_model->cancel($data['task']);

        $email['destination'] = $data['user']->email;
        $email['type'] = "cancel";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);
        $data["mytask"] = $this->task_model->getTask();

        if ($post['page'] == 'page detail') {
            $this->load->view("task_page_content", $data);
        }

        else {
            $this->load->view("mytask_table_list", $data);
        }
    }

    public function reject2(){
        $post = $this->input->post();
        $this->task_model->reject();
        $data["task"] = $this->task_model->getById($post['id']);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $this->notification_model->reject($data['task']);

        $email['destination'] = $data['user']->email;
        $email['type'] = "reject";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("task_page_content", $data);
    }

    public function create(){
        $id_task = $this->task_model->save();

        $data["task"] = $this->task_model->getById($id_task);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_from);

        $email['destination'] = $data['user']->email;
        $email['type'] = "reject";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $data['task']->date_from;
        $email['date_to'] = $data['task']->date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $this->sendmail($email);

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }

    public function update(){
        $this->task_model->update();

        $data["mytask"] = $this->task_model->getTask();
        $this->load->view("mytask_table_list", $data);
    }

    public function clearnotifreq(){
        $this->notification_model->clearReq();
        redirect('site/notification');
    }

    public function clearnotiftask(){
        $this->notification_model->clearTask();
        redirect('site/notification');
    }
}