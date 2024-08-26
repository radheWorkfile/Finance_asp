<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function all_data()
    {

        $this->db->select('u.id,u.name,u.email,u.mobile,u.status,u.photo,d.name as department_name');
        $this->db->join('department as d','d.id = u.department_type');
        return $this->db->get('users as u')->result_array();

    }

    function get_data($id)
    {

        $this->db->select('u.id,u.name,u.email,u.mobile,u.status,u.photo,u.show_ps,u.password,
        d.name as department_name');
        $this->db->where('u.id', $id);
        $this->db->join('department as d', 'd.id = u.department_type');
        return $this->db->get('users as u')->row_array();
        
    }
   
}
