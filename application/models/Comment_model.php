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

        $path = FCPATH.'/uploads/'. $_FILES["attachment"]['name'];
        $file_name = $_FILES["attachment"]['name'];
        $num = 0;
//        $max_file_size = 1048576 * 50;
        while(file_exists($path)) {
            $num++;
            $path = FCPATH.'/uploads/'. $num . $_FILES["attachment"]['name'];
            $file_name = $num . $_FILES["attachment"]['name'];
        }

//        if (filesize($_FILES['attachment']['tmp_name']) < $max_file_size) {
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $path)) {
                $post['attachment'] = $file_name;
            }
            $post['user_comment'] = $this->session->nik;
            $post['created_at'] = date('m-d-Y H:i:s');

            $this->db->insert($this->_table, $post);
//        }
//
//        else {
//            print_r($_FILES);
//            echo "too large";
//        }

    }
}