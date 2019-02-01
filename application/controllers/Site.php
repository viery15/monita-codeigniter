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

    }

    public function index()
    {
        $this->load->view("login");
    }

    public function dashboard()
    {
        $this->load->view("login");
    }

    public function login()
    {
        $this->load->model("user_model");
        $data = $this->user_model->getByNik();

        if ($data) {
            $newdata = array(
                'nik'  => $data->nik,
                'role'     => $data->role,
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