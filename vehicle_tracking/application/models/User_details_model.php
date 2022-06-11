<?php
class User_details_model extends CI_Model
{
    public $table = 'user_details';

    public function insert($data)
    {
        $query = $this->db->insert('user_details', $data);
        if ($query) return $this->db->insert_id();
    }

    public function get_where($limit,$offset)
    {
        $query = $this->db->get($this->table, $limit, $offset);
        //echo $this->db->last_query();die();
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else return array();
    }

    public function get_where_single($conditions)
    {
        $query = $this->db->get_where($this->table, $conditions, false, false);
        if($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else return false;
    }

    public function get_details($id)
    {
        $this->db->select('*');
        $this->db->where(array('id'=>$id));
        $query = $this->db->get('user_details');

        if($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else return array();
    }

    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->where(array('email'=>$email));
        $query = $this->db->get('user_details');

        if($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else return false;
    }

    public function update($data, $id)
    {
        $query = $this->db->update('user_details', $data, array('id'=>$id));
        return true;
    }

    
}
?>