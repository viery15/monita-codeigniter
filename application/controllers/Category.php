<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->nik == NULL) {
            redirect(base_url());
        }
        if ($this->session->role != 'admin') {
            redirect('dashboard');
        }
        $this->load->model("category_model");
    }

    public function index()
    {
        $data["category"] = $this->category_model->getAll();
        $this->load->view("category",$data);
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->category_model->delete($id);

        $data["category"] = $this->category_model->getAll();
        $this->load->view("category_table_list", $data);
    }

    public function form_add(){
        $this->load->view("form_category");
    }

    public function form_update($id){
        $data = $this->category_model->getById($id);
        $this->load->view("form_category",$data);
    }

    public function create(){
        $this->category_model->save();

        $data["category"] = $this->category_model->getAll();
        $this->load->view("category_table_list", $data);
    }

    public function update(){
        $this->category_model->update();

        $data["category"] = $this->category_model->getAll();
        $this->load->view("category_table_list", $data);
    }
}
