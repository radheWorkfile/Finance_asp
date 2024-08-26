<?php
    class Income_source_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
      
          // ================================ Income Sources section start ======================================  

          public function all_list_income_sourse_query($where = false)
          {
              $field = array(
                  'id','status'
              );
              $i = 0;
              foreach ($field as $item) {
                  if (!empty($where['search']['value'])) {
                      if ($i === 0) {
                          $this->db->group_start();
                          $this->db->like($item, $where['search']['value']);
                      } else {
                          $this->db->or_like($item, $where['search']['value']);
                      }
                      if (count($field) - 1 == $i) {
                          $this->db->group_end();
                      }
                  }
                  $i++;
              }
  
              $this->db->select('*')->from('income_sources');

              if (isset($where['order']) && !empty($where['order'])) {
                  $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
              } else {
                  $this->db->order_by('id', 'desc');
              }
          }
  
          public function all_list_income_sourse($where = false)
          {
              $this->all_list_income_sourse_query($where);
  
              if ($where['length'] != -1) {
                  $this->db->limit($where['length'], $where['start']);
              }
              return $this->db->get()->result();
          }
  
          public function count_list_income_sourse($where = false)
          {
              $this->all_list_income_sourse_query($where);
              return $this->db->get()->num_rows();
          }
  
          public function filter_list_income_sourse($where = false)
          {
              $this->all_list_income_sourse_query($where);
              return $this->db->get()->num_rows();
          }
  
          public function get_view_Income_Sources($id) {
  
              return $this->db->select('*')->where('id', $id)->get('income_sources')->row_array();
          }
  
          
          public function get_Income_Sources($id) {
  
              return $this->db->select('*')->where('id', $id)->get('income_sources')->row_array();
          }
  

       
    }

?>