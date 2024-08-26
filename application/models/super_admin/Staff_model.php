<?php

    class Staff_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function all_designation() {

            return $this->db->select('id, designation_name')->where('status', 1)->get('designation_category')->result_array();
        }

        
        /* ===================================== All Staff Data Query ==================================== */

        public function all_staff_data_query($where = false)
        {
            $field = array(
                's.id','s.full_name', 's.mobile_no', 's.email', 's.address', 's.status', 'mb.branch_name'
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

            $this->db->select('s.id, s.full_name, s.mobile_no, s.email, s.address, s.status, mb.branch_name')->from('staff as s');
            $this->db->join('master_branch as mb', 'mb.id = s.branch_id', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function all_staff_data($where = false)
        {
            $this->all_staff_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function total_count($where = false)
        {
            
            $this->all_staff_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function total_filter_count($where = false)
        {

            $this->all_staff_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function get_staff_data($id) 
        {

            $this->db->select('s.*, dc.designation_name,br.branch_name');
            $this->db->where('s.id', $id);
            $this->db->join('designation_category as dc', 'dc.id = s.designation','left');
			$this->db->join('master_branch as br', 'br.id = s.branch_id','left');
            $staff = $this->db->get('staff as s');
            return $staff->row_array();

        }

    }
?>