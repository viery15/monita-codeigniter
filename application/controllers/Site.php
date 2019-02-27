<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/31/2019
 * Time: 3:08 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/30/2019
 * Time: 10:45 AM
 */

class Site extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model("task_model");
        $this->load->model("notification_model");
    }

    public function index()
    {
        if ($this->session->nik != null) {
            redirect('/dashboard');
        }
        else {
            $this->load->view("login");
        }
    }

    public function timeline()
    {
        $data['mytask'] = $this->task_model->getTaskTimeline();
        $data['myrequest'] = $this->task_model->getRequestTimeline();

        $data['task_pending'] = $this->task_model->getTaskPending();
        $data['task_done'] = $this->task_model->getTaskDone();
        $data['task_progress'] = $this->task_model->getTaskProgress();
        $data['task_rejected'] = $this->task_model->getTaskRejected();
        $data['task_canceled'] = $this->task_model->getTaskCanceled();

        $data['req_pending'] = $this->task_model->getReqPending();
        $data['req_done'] = $this->task_model->getReqDone();
        $data['req_progress'] = $this->task_model->getReqProgress();
        $data['req_rejected'] = $this->task_model->getReqRejected();
        $data['req_canceled'] = $this->task_model->getReqCanceled();

        $this->load->view("dashboard_timeline",$data);
    }

    public function notification()
    {
        $data['notif_task'] = $this->notification_model->getNotifTask();
        $data['notif_req'] = $this->notification_model->getNotifReq();
//        print_r($data['notif_req']);

        $this->load->view("notification_page",$data);
    }

    public function dashboard()
    {
        if ($this->session->nik == NULL) {
            redirect(base_url());
        }
        $data['mytask'] = $this->task_model->getTaskTimeline();
        $data['myrequest'] = $this->task_model->getRequestTimeline();

        $data['task_pending'] = $this->task_model->getTaskPending();
        $data['task_done'] = $this->task_model->getTaskDone();
        $data['task_progress'] = $this->task_model->getTaskProgress();
        $data['task_rejected'] = $this->task_model->getTaskRejected();
        $data['task_canceled'] = $this->task_model->getTaskCanceled();

        $data['req_pending'] = $this->task_model->getReqPending();
        $data['req_done'] = $this->task_model->getReqDone();
        $data['req_progress'] = $this->task_model->getReqProgress();
        $data['req_rejected'] = $this->task_model->getReqRejected();
        $data['req_canceled'] = $this->task_model->getReqCanceled();

        $this->load->view("dashboard",$data);
    }

    public function login()
    {
        $this->load->model("user_model");
        $data = $this->user_model->getByNik();

        if ($data) {
            $last_login = date('d M Y h:i a');
            $newdata = array(
                'nik'  => $data->nik,
                'role'     => $data->role,
                'last_login' => $last_login
            );

            $this->session->set_userdata($newdata);
            echo json_encode(array('failed'=>'false'));
        }
        else {
            echo json_encode(array('failed'=>'true'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}