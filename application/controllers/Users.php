<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["users"] = $this->user_model->getAll();
        $this->load->view("user_list", $data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->user_model->delete($id);

        $data["users"] = $this->user_model->getAll();
        $this->load->view("user_table_list", $data);
    }

    public function form_add(){
        $this->load->view("form_user");
    }

    public function form_update($id){
        $data = $this->user_model->getById($id);
        $this->load->view("form_user",$data);
    }

    public function create(){
        $this->user_model->save();

        $data["users"] = $this->user_model->getAll();
        $this->load->view("user_table_list", $data);
    }

    public function update(){
        $this->user_model->update();

        $data["users"] = $this->user_model->getAll();
        $this->load->view("user_table_list", $data);
    }
}
