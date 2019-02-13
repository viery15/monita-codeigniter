<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/4/2019
 * Time: 2:05 PM
 */
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    private $_table = "monita.category";

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

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

    public function save(){
      $post = $this->input->post();
      $this->db->insert($this->_table, $post);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->label = $post["label"];
        $this->name = $post["name"];

        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }
}
