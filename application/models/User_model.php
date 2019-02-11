<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "monita.users";

    public $id;
    public $nik;
    public $role;


    public function rules()
    {
        return [
            ['field' => 'nik',
                'label' => 'NIK',
                'rules' => 'requires'],

            ['field' => 'role',
                'label' => 'role',
                'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getUserAssign()
    {
        $this->db->where('nik !=', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function getByNik()
    {
        $post = $this->input->post();
        return $this->db->get_where($this->_table, ["nik" => $post['nik']])->row();
    }

    public function getByNik2($nik)
    {
//        $post = $this->input->post();
        return $this->db->get_where($this->_table, ["nik" => $nik])->row();
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

    public function save()
    {
        $post = $this->input->post();
        $this->db->insert($this->_table, $post);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->nik = $post["nik"];
        $this->role = $post["role"];
        $this->email = $post["email"];

        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }
}