<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/7/2019
 * Time: 8:48 AM
 */
?>

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model
{
    private $_table = "monita.notification";

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

    public function getByUserTarget()
    {
        $this->db->order_by('created_at','DESC');
        $this->db->limit(5);
        return $this->db->get_where($this->_table, ["user_target" => $this->session->nik])->result();
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("task_id" => $id));
    }

    public function save($task_id)
    {
        $post = $this->input->post();
        $data['id_task'] = $task_id;
        $data['user_target'] = $post['user_to'];
        $data['user_from'] = $post['user_from'];
        $data['type'] = 'new';
        $data['created_at'] = date('m-d-Y H:i:s');

        $this->db->insert($this->_table, $data);
    }

    public function approve($post){
        $data['id_task'] = $post->id;
        $data['user_target'] = $post->user_from;
        $data['user_from'] = $post->user_to;
        $data['type'] = 'approve';
        $data['created_at'] = date('m-d-Y H:i:s');

        $this->db->insert($this->_table, $data);
    }

    public function reject($post){
        $data['id_task'] = $post->id;
        $data['user_target'] = $post->user_from;
        $data['user_from'] = $post->user_to;
        $data['type'] = 'reject';
        $data['created_at'] = date('m-d-Y H:i:s');

        $this->db->insert($this->_table, $data);
    }

    public function done($post){
        $data['id_task'] = $post->id;
        $data['user_target'] = $post->user_from;
        $data['user_from'] = $post->user_to;
        $data['type'] = 'done';
        $data['created_at'] = date('m-d-Y H:i:s');

        $this->db->insert($this->_table, $data);
    }

    public function resend($post){
        $data['id_task'] = $post->id;
        $data['user_target'] = $post->user_to;
        $data['user_from'] = $post->user_from;
        $data['type'] = 'new';
        $data['created_at'] = date('m-d-Y H:i:s');

        $this->db->insert($this->_table, $data);
    }

    public function comment($post){

        if ($post->user_to == $this->session->nik) {
            $user_target = $post->user_from;
            $type = "comment request";
        }
        else {
            $user_target = $post->user_to;
            $type = "comment task";
        }

        $data['id_task'] = $post->id;
        $data['user_target'] = $user_target;
        $data['user_from'] = $this->session->nik;
        $data['type'] = $type;
        $data['created_at'] = date('m-d-Y H:i:s');

        $this->db->insert($this->_table, $data);
    }
}