<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model
{
    private $_table = "monita.tasks";

    public $id;
    public $user_from;
    public $user_to;
    public $remark;
    public $status;
    public $description;
    public $date_from;
    public $date_to;
    public $updated_at;
    public $created_at;

    public function rules()
    {
        return [
            ['field' => 'user_from',
                'label' => 'user_from',
                'rules' => 'requires'],

            ['field' => 'user_to',
                'label' => 'user_to',
                'rules' => 'required'],

            ['field' => 'status',
                'label' => 'status',
                'rules' => 'requires'],

            ['field' => 'description',
                'label' => 'description',
                'rules' => 'requires'],

            ['field' => 'date_from',
                'label' => 'date_from',
                'rules' => 'requires'],

            ['field' => 'date_to',
                'label' => 'date_to',
                'rules' => 'requires'],

            ['field' => 'updated_at',
                'label' => 'updated_at',
                'rules' => 'requires'],

            ['field' => 'created_at',
                'label' => 'created_at',
                'rules' => 'requires'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getRequest()
    {
        $this->db->order_by('updated_at','DESC');
        $this->db->where('user_from', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getUserMonitoring()
    {
        $this->db->distinct();
        $this->db->select('nik');
        $this->db->from('monita.users');
        $this->db->group_start()
            ->where('tasks.user_to',$this->session->nik)
            ->or_where('tasks.user_from',$this->session->nik)
        ->group_end();
        $this->db->where('nik !=',$this->session->nik);
        $this->db->join('monita.tasks', 'monita.users.nik = monita.tasks.user_to OR monita.users.nik = monita.tasks.user_from');
        return $this->db->get()->result();
    }

    public function getTaskCalender(){
        $this->db->where('user_to', $this->session->nik);
        $this->db->where('status', 'progress');
        $this->db->or_where('status', 'done');

        return $this->db->get($this->_table)->result();
    }

    public function getRequestTimeline()
    {
        $this->db->where('user_from', $this->session->nik);
        $this->db->limit(5);
        $this->db->order_by('updated_at', 'DESC');
        return $this->db->get($this->_table)->result();
    }

    public function searchCalendar()
    {
        $post = $this->input->post();

        $this->db->where('date_from >=', $post['date_from']);
        $this->db->where('date_to <=', $post['date_to']);
        if ($post['category'] != 'all'){
            $this->db->where('category', $post['category']);
        }
        $this->db->order_by('updated_at','DESC');
        $this->db->where('user_to', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getTask()
    {
        $this->db->order_by('updated_at','DESC');
        $this->db->where('user_to', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getTaskByDate()
    {
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $category = $this->input->post('category');

        $this->db->where('date_from >=', $date_from);
        $this->db->where('date_to <=', $date_to);
        if ($category != 'all'){
            $this->db->where('category', $category);
        }
        $this->db->order_by('updated_at','DESC');
        $this->db->where('user_to', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getTaskTimeline()
    {
        $this->db->where('user_to', $this->session->nik);
        $this->db->limit(5);
        $this->db->order_by('updated_at', 'DESC');
        return $this->db->get($this->_table)->result();
    }

    public function getTaskPending()
    {
        $this->db->where('status','pending');
        $this->db->where('user_to', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getTaskDone()
    {
        $this->db->where('status','done');
        $this->db->where('user_to', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getTaskProgress()
    {
        $this->db->where('status','progress');
        $this->db->where('user_to', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getTaskRejected()
    {
        $this->db->where('status','rejected');
        $this->db->where('user_to', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getReqPending()
    {
        $this->db->where('status','pending');
        $this->db->where('user_from', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getReqDone()
    {
        $this->db->where('status','done');
        $this->db->where('user_from', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getReqProgress()
    {
        $this->db->where('status','progress');
        $this->db->where('user_from', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getReqRejected()
    {
        $this->db->where('status','rejected');
        $this->db->where('user_from', $this->session->nik);
        return $this->db->get($this->_table)->result();
    }

    public function getMonitoring($nik)
    {
        $this->db->where('user_to', $nik);
        return $this->db->get($this->_table)->result();
    }

    public function getCountTaskDone(){
        $post = $this->input->post();

        $this->db->where('user_from', $post['nik']);
        $this->db->where('status', 'done');

        return $this->db->count_all_results($this->_table);
    }

    public function getCountTaskProgress(){
        $post = $this->input->post();

        $this->db->where('user_from', $post['nik']);
        $this->db->where('status', 'progress');

        return $this->db->count_all_results($this->_table);
    }

    public function getCountRequestDone(){
        $post = $this->input->post();

        $this->db->where('user_to', $post['nik']);
        $this->db->where('status', 'done');

        return $this->db->count_all_results($this->_table);
    }

    public function getCountRequestProgress(){
        $post = $this->input->post();

        $this->db->where('user_to', $post['nik']);
        $this->db->where('status', 'progress');

        return $this->db->count_all_results($this->_table);
    }

    public function getProgress()
    {
        $post = $this->input->post();
        $type = $post['type'];
        if ($type == 'all') {
            $this->db->where('user_to', $post['nik']);
            $this->db->or_where('user_from', $post['nik']);
        }
        if ($type == 'mytask') {
            $this->db->where('user_from', $post['nik']);
        }
        if ($type == 'myrequest') {
            $this->db->where('user_to', $post['nik']);
        }

        $this->db->where('status', 'progress');

        return $this->db->get($this->_table)->result();
    }

    public function getDone()
    {
        $post = $this->input->post();
        $type = $post['type'];
        if ($type == 'all') {
            $this->db->where('user_to', $post['nik']);
            $this->db->or_where('user_from', $post['nik']);
        }
        if ($type == 'mytask') {
            $this->db->where('user_from', $post['nik']);
        }
        if ($type == 'myrequest') {
            $this->db->where('user_to', $post['nik']);
        }

        $this->db->where('status', 'done');

        return $this->db->get($this->_table)->result();
    }

    public function getCountProgress($nik){
        $this->db->where('user_to', $nik);
        $this->db->where('status', 'progress');

        $this->db->count_all_results($this->_table);
    }

    public function getCountDone($nik){
        $this->db->where('user_to', $nik);
        $this->db->where('status', 'done');

        $this->db->count_all_results($this->_table);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function getByCategory($category)
    {
        return $this->db->get_where($this->_table, ["category" => $category])->result();
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

    public function save()
    {
        $post = $this->input->post();

        $post['created_at'] = date('m-d-Y H:i:s');
        $post['updated_at'] = date('m-d-Y H:i:s');
        $this->db->insert($this->_table,$post);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->user_from = $post["user_from"];
        $this->status = $post["status"];
        $this->date_from = $post["date_from"];
        $this->date_to = $post["date_to"];
        $this->category = $post["category"];
        $this->user_to = $post["user_to"];
        $this->remark = $post["remark"];
        $this->description = $post["description"];
        $this->updated_at = date('m-d-Y H:i:s');

        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function approve()
    {
        $post = $this->input->post();

        $this->db->set('status', 'progress');
        $this->db->set('updated_at', date("m-d-Y H:i:s"));
        $this->db->where('id', $post['id']);
        $this->db->update($this->_table);
    }

    public function cancel()
    {
        $post = $this->input->post();

        $this->db->set('status', 'canceled');
        $this->db->set('updated_at', date("m-d-Y H:i:s"));
        $this->db->where('id', $post['id']);
        $this->db->update($this->_table);
    }

    public function done()
    {
        $date =
        $post = $this->input->post();

        $this->db->set('status', 'done');
        $this->db->set('updated_at', date("m-d-Y H:i:s"));
        $this->db->where('id', $post['id']);
        $this->db->update($this->_table);
    }

    public function reject()
    {
        $post = $this->input->post();

        $this->db->set('status', 'rejected');
        $this->db->set('updated_at', date("m-d-Y H:i:s"));
        $this->db->where('id', $post['id']);
        $this->db->update($this->_table);
    }

    public function resend()
    {
        $post = $this->input->post();

        $this->db->set('status', 'pending');
        $this->db->set('updated_at', date("m-d-Y H:i:s"));
        $this->db->where('id', $post['id']);
        $this->db->update($this->_table);
    }
}
