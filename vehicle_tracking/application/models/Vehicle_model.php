<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vehicle_model extends CI_Model {

    public $table = 'vehicle_details';

    public function __construct()
    {
        $this->load->database();
    }

    public function insert($data) {
        $res = $this->db->insert($this->table,$data);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function get_where($limit,$offset)
    {
        $query = $this->db->get($this->table, $limit, $offset);
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else return array();
    }

    public function get_details($id,$single= false)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        
        if($query->num_rows() > 0)
        {
            if($single == true) return $query->row_array();
            else return $query->result_array();
        }
        else return array();
    }

    public function update($conditions)
    {
        $this->db->where($conditions['condition']);
        $query = $this->db->update($this->table, $conditions['data']);
        if($query) return true;
        else return false;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);	
	    $query = $this->db->delete($this->table);
        if($query) return true;
        else return false;
    }

}
?>