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

        /* ===================================== All Member Data Query ==================================== */

        public function all_member_data_query($where = false)
        {
            $field = array(
                'id','user_id', 'full_name', 'mobile_no', 'email', 'address', 'status'
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

            $this->db->select('id,full_name, mobile_no, email, address, member_id, status')->from('member');
            $this->db->where('created_by_user_type_id', $this->session->userdata('user_id'));
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
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

            return $this->db->select('*')->where('id', $id)->get('member')->row_array();
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

    }

?>