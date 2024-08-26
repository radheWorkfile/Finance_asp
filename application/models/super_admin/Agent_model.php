<?php

    class Agent_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function all_designation() {

            return $this->db->select('id, designation_name')->where('status', 1)-> get('designation_category')->result_array();
        }

        /* ===================================== All Agent Data Query ==================================== */

        public function all_agent_data_query($where = false)
        {
            $field = array(
                'id','agent_id', 'name', 'mobile_no', 'email', 'address', 'status'
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

            $this->db->select('id, name, mobile_no, email, address, agent_id, status')->from('agent');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function all_agent_data($where = false)
        {
            $this->all_agent_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function total_count($where = false)
        {
            $this->all_agent_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function total_filter_count($where = false)
        {
            $this->all_agent_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function get_agent_data($id) {

            $this->db->select('*');
            $this->db->where('id', $id);
            $age = $this->db->get('agent');
            return $age->row_array();
            
        }

    }

?>