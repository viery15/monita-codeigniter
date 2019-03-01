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

    public function getNotifTask()
    {

        $this->db->select('monita.notification.*,monita.tasks.user_to');
        $this->db->from('monita.notification');
        $this->db->where('user_target',$this->session->nik);
        $this->db->where('user_to',$this->session->nik);
        $this->db->order_by('notification.created_at','DESC');
        $this->db->join('monita.tasks', 'monita.notification.id_task = monita.tasks.id');
        return $this->db->get()->result();
    }

    public function getNotifReq()
    {

        $this->db->select('monita.notification.*');
        $this->db->from('monita.notification');
        $this->db->where('user_target',$this->session->nik);
        $this->db->where('tasks.user_from',$this->session->nik);
        $this->db->join('monita.tasks', 'monita.notification.id_task = monita.tasks.id');
        $this->db->order_by('notification.created_at','DESC');
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function getByTaskId($id)
    {
        return $this->db->get_where($this->_table, ["id_task" => $id])->result();
    }

    public function getByUserTarget()
    {
        $this->db->order_by('created_at','DESC');
        $this->db->limit(5);
        return $this->db->get_where($this->_table, ["user_target" => $this->session->nik])->result();
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_task" => $id));
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

    public function cancel($post){
        $data['id_task'] = $post->id;
        $data['user_target'] = $post->user_from;
        $data['user_from'] = $post->user_to;
        $data['type'] = 'cancel';
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

    public function clearReq(){
        $this->db->where('type','approve');
        $this->db->or_where('type','reject');
        $this->db->or_where('type','done');
        $this->db->or_where('type','cancel');
        $this->db->or_where('type','comment request');
        $this->db->where('user_target',$this->session->nik);
        return $this->db->delete($this->_table);
    }

    public function clearTask(){
        $this->db->where('type','new');
        $this->db->or_where('type','comment task');
        $this->db->where('user_target',$this->session->nik);
        return $this->db->delete($this->_table);
    }
}