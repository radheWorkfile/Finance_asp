<?php

    class Member_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function all_designation() {

            return $this->db->select('id, designation_name')->where('status', 1)-> get('designation_category')->result_array();

        }

        /* ============================== All Member Data Query ============================== */

        public function all_member_data_query($where = false)
        {
            
            $field = array(
                'mg.grp_id','m.member_id','m.first_name'
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

            $this->db->select('m.id,m.first_name, m.mid_name, m.last_name, m.nominee_name, m.religion, m.doj, m.member_id, m.status, m.disbursment_status, mg.grp_id, rc.category_name as relation_name')->from('member as m');
            $this->db->where('m.branch_id', $this->session->userdata('branch_id'));
            $this->db->join('master_group as mg', 'mg.grp_id = m.group_name', 'left');
            $this->db->join('relationship_category as rc', 'rc.id = m.nominee_relation', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'asc');
            }

        }

        public function all_member_data($where = false)
        {

            $this->all_member_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();

        }

        public function total_count($where = false)
        {

            $this->all_member_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function total_filter_count($where = false)
        {

            $this->all_member_data_query($where);
            return $this->db->get()->num_rows();
            
        }

        public function get_member_data($id) {

            return $this->db->select('m.*, rc.category_name as relation_name, mc.center_name as cent_name, mg.name as grp_name')->where('m.id', $id)->join('relationship_category as rc', 'rc.id = m.nominee_relation', 'left')->join('master_center as mc', 'mc.id = m.center_name', 'left')->join('master_group as mg', 'mg.grp_id = m.group_name', 'left')->get('member as m')->row_array();
            
        }

        public function all_document() {

            return $this->db->select('*')->get('document')->result_array();
        }

        public function get_sub_document($id) {

            $this->db->select('id, document_name, sub_document_name, input_name');
            $this->db->where('document_name', $id);
            $sub = $this->db->get('sub_document');
            return $sub->result_array();

        }

        public function all_group_data($id) {

            $this->db->select('mg.grp_id, mg.name as group_name');
            $this->db->where(array('mg.center_id' => $id, 'branch_id' => $this->session->userdata('branch_id')));
            $val = $this->db->get('master_group as mg');
            return $val->result_array();
 
        }

        public function get_last_id() {

            return $this->db->select('member_id')->order_by('id', 'DESC')->limit(1)->get('member')->row_array();
    
        }

        public function check_aadhar_no($val)
        {
            $query = $this->db->select('*')->where('aadhar_card_no', $val['aadhar_card_no'])->get($val['table'])->row_array();
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }

?>