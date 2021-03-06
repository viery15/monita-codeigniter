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
            '<tr><td valign="top">Description</td> <td valign="top">:</td> <td valign="top">' . nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($email['description']))). '</td>'.
            '<tr><td>Assigned from</td> <td>:</td> <td>'. $email['from'] . '</td>'.
            '<tr><td>Date</td> <td>:</td> <td>'. date('d M Y', strtotime($email['date_from'])) . ' - ' . date('d M Y', strtotime($email['date_to'])). '</td>'.
            '</table><br><br>'.
            'The current status is <b>' . strtoupper($email['status']) . '</b><br>'.
            'For more action, you can access on ' . base_url() . 'task/'. $email['task_id'].'<br><br>'.
            'do not reply this email. <br>'.
            '( MONITA - Monitoring Task Application )'
        );

        if($this->email->send()){
          return "email sent suuccessful";
        }
        else {
          return "failed to send email";
        }
    }

    public function myrequest_table_list(){
      $data["myrequest"] = $this->task_model->getRequest();
      $this->load->view("myrequest_table_list", $data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->comment_model->deleteByTaskId($id);
        $this->notification_model->delete($id);
        $this->task_model->delete($id);


        $data["myrequest"] = $this->task_model->getRequest();
        $this->load->view("myrequest_table_list", $data);
    }

    public function delete2(){
        $id = $this->input->post('id');
        $this->comment_model->deleteByTaskId($id);
        $this->notification_model->delete($id);
        $this->task_model->delete($id);


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

    public function emailConnection(){
      $connected = @fsockopen("www.gmail.com", 80);

      if ($connected){
          $is_conn = true;
          fclose($connected);
      }else{
          $is_conn = false;
      }
      return $is_conn;
    }

    public function create(){
        $post = $this->input->post();

        $task_id = $this->task_model->save();
        $this->notification_model->save($task_id);
        $date = explode(" - ",$post['daterange']);
        $date_from = $date[0];
        $date_to = $date[1];

        $data["task"] = $this->task_model->getById($task_id);
        $data["user"] = $this->user_model->getByNik2($data['task']->user_to);

        $email['destination'] = $data['user']->email;
        $email['type'] = "new";
        $email['from'] = $data['task']->user_to;
        $email['task_id'] = $data['task']->id;
        $email['date_from'] = $date_from;
        $email['date_to'] = $date_to;
        $email['description'] = $data['task']->description;
        $email['status'] = $data['task']->status;
        $email['title'] = $data['task']->remark;

        $email_connection = $this->emailConnection();
        if ($email_connection == 'true') {
          $return = $this->sendmail($email);
        }
        else {
          $return = "Failed to send email";
        }

        $response = array(
          'msg' => 'Data Saved',
          'msg_email' => $return
        );

        echo json_encode($response);
    }

    public function loadRequestTable(){
      $data["myrequest"] = $this->task_model->getRequest();
      $this->load->view("myrequest_table_list", $data);
    }

    public function submitcomment(){
        header('Content-type: application/json');

        $post = $this->input->post();

        if ($_FILES['attachment']['size'] > 20755230) {
          $response = array(
            'msg' => 'File too large (max : 20 MB)',
            'type' => 'error'
          );

          echo json_encode($response);
        }
        else {
          $this->comment_model->save();

          $data["task"] = $this->task_model->getById($post['task_id']);
          $this->notification_model->comment($data['task']);

          $response = array(
            'msg' => 'Comment submited',
            'type' => 'Success',
            'task_id' => $post['task_id']
          );

          echo json_encode($response);
        }
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
        header('Content-type: application/json');

        $post = $this->input->post();

        if ($_FILES['attachment']['size'] > 20755230) {
          $response = array(
            'msg' => 'File too large (max: 20 MB)',
            'type' => 'error'
          );

          echo json_encode($response);
        }
        else {
          $this->comment_model->save();

          $data["task"] = $this->task_model->getById($post['task_id']);
          $this->notification_model->comment($data['task']);

          $response = array(
            'msg' => 'Comment submited',
            'type' => 'Success',
            'task_id' => $post['task_id']
          );

          echo json_encode($response);
        }
    }

    public function comment_list($task_id){
      $data["comment"] = $this->comment_model->getByTaskId($task_id);
      $data["task"] = $this->task_model->getById($task_id);

      $this->load->view("comment_page", $data);
    }

    public function comment_list_dashboard($task_id){
      $data["comment"] = $this->comment_model->getByTaskId($task_id);
      $data["task"] = $this->task_model->getById($task_id);

      $this->load->view("myrequest_form_comment", $data);
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

        $email_connection = $this->emailConnection();

        if ($email_connection == 'true') {
          $return = $this->sendmail($email);
        }
        else {
          $return = "Failed to send email";
        }

        $response = array(
          'msg' => 'Data saved',
          'msg_email' => $return
        );

        echo json_encode($response);
    }

    public function resend2(){
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
