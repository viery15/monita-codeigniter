<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/4/2019
 * Time: 2:05 PM
 */
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{
    private $_table = "monita.comments";

//    public $id;
//    public $comment;
//    public $attachment;

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function getByTaskId($id)
    {
        return $this->db->get_where($this->_table, ["task_id" => $id])->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $post['user_comment'] = $this->session->nik;
        $post['created_at'] = date('m-d-Y H:i:s');

        $this->db->insert($this->_table, $post);
    }

}
